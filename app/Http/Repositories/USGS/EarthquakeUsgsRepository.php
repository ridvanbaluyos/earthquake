<?php
namespace App\Repositories\USGS;

use App\Repositories\EarthquakeRepositoryInterface;
use Cache;

/**
 * USGS - Earthquake Catalog
 * https://earthquake.usgs.gov/fdsnws/event/1/
 *
 * @package    Earthquake Alert
 * @author     Ridvan Baluyos <ridvan@baluyos.net>
 * @link       https://github.com/ridvanbaluyos/earthquake-alert
 * @license    MIT
 */
class EarthquakeUsgsRepository implements EarthquakeRepositoryInterface
{
    private $url;

    public function __construct() {
        $this->url = 'https://earthquake.usgs.gov/fdsnws/event/1/';
    }
    /**
     * This function queries the Digital Siesmograph Networks based from the parameters
     * provided.
     *
     * @param $params - parameters provided (see https://earthquake.usgs.gov/fdsnws/event/1/#parameters)
     * @return mixed $result - json format of earthquake information results
     */
    public function getEarthquakes($params = [])
    {
        $params['format'] = 'geojson';
        $params['minlatitude'] = 5;
        $params['maxlatitude'] = 20;
        $params['minlongitude'] = 115;
        $params['maxlongitude'] = 130;

        $serializedKey = md5(serialize($params));

        if (Cache::get($serializedKey)) {
            return Cache::get($serializedKey);
        } else {
            $endpoint = 'query';
            $url = $this->url . $endpoint . '?' . http_build_query($params);

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 240);
            $result = curl_exec($ch);
            curl_close($ch);
            $earthquakes = json_decode($result);

            Cache::forever($serializedKey, $earthquakes);

            return $earthquakes;
        }

    }
}