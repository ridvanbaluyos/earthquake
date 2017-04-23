<?php
namespace App\Repositories\USGS;

use App\Repositories\EarthquakeRepositoryInterface;
use Cache;
use Carbon\Carbon;

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
        $params['minlatitude'] = config('app.minlatitude');
        $params['maxlatitude'] = config('app.maxlatitude');
        $params['minlongitude'] = config('app.minlongitude');
        $params['maxlongitude'] = config('app.maxlongitude');

        $serializedKey = md5(serialize($params));
        $this->url = $url = $this->url . 'query?' . http_build_query($params);

        if (Cache::get($serializedKey)) {
            return Cache::get($serializedKey);
        } else {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 240);
            $result = curl_exec($ch);
            curl_close($ch);
            $earthquakes = json_decode($result);

            // Cache for 1 day
            $expiresAt = Carbon::now()->addDays(1);
            Cache::put($serializedKey, $earthquakes, $expiresAt);

            return $earthquakes;
        }
    }

    public function getSourceUrl()
    {
        return $this->url;
    }
}