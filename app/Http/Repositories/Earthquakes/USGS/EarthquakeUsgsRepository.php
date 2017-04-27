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
    private $coordinates;

    // parameters provided (see https://earthquake.usgs.gov/fdsnws/event/1/#parameters)
    private $params;

    /**
     * EarthquakeUsgsRepository constructor.
     *
     * Set coordinates to Philippines if none is provided.
     *
     * @param array $coordinates
     */
    public function __construct(Array $coordinates = []) {
        $this->url = 'https://earthquake.usgs.gov/fdsnws/event/1/';

        if (empty($coordinates)) {
            $coordinates['minlatitude'] = config('app.minlatitude');
            $coordinates['maxlatitude'] = config('app.maxlatitude');
            $coordinates['minlongitude'] = config('app.minlongitude');
            $coordinates['maxlongitude'] = config('app.maxlongitude');

            $this->coordinates = $coordinates;
        } else {
            $this->coordinates = $coordinates;
        }

    }

    /**
     * This function queries the Digital Siesmograph Networks based from the parameters
     * provided.
     *
     * @return mixed $result - json format of earthquake information results
     */
    public function getEarthquakes()
    {
        $this->params['format'] = 'geojson';

        $params = array_merge($this->params, $this->coordinates);

        $serializedKey = md5(serialize($params) . date('Y-m-d'));
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

    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function setParameters($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * This function queries the Digital Siesmograph Networks based from the event id
     * provided.
     *
     * @param integer $params - parameters provided (see https://earthquake.usgs.gov/fdsnws/event/1/#parameters)
     * @return mixed $result - json format of earthquake information results
     */
    public function getEarthquake($id)
    {
        $params['eventid'] = $id;
        $params['format'] = 'geojson';

        $serializedKey = md5(serialize($params) . date('Y-m-d'));
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
