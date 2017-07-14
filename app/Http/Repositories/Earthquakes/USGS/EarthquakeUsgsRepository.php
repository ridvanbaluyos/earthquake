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
 * @link       https://github.com/ridvanbaluyos/earthquake
 * @license    MIT
 */
class EarthquakeUsgsRepository implements EarthquakeRepositoryInterface
{
    private $url;
    private $coordinates;
    private $disableCache;
    private $cacheTime;
    private $cacheKeyPrefix = null;

    // parameters provided (see https://earthquake.usgs.gov/fdsnws/event/1/#parameters)
    private $params;

    /**
     * EarthquakeUsgsRepository constructor.
     *
     * Set coordinates to Philippines if none is provided.
     *
     * @param array $coordinates
     */
    public function __construct() {
        $this->url = 'https://earthquake.usgs.gov/fdsnws/event/1/';
        $this->disableCache = false;
        $this->cacheTime = 60 * 24; // 1 day;

        // Default to Philippines
        $this->coordinates = $this->getPhilippineCoordinates();
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

        // Cache forever if query date is more than a month
        $cacheableForever = false;
        if (isset($params['starttime'])) {
            $cacheableForever = $this->checkIfCacheableForever($params['starttime']);
        }

        $serializedKey = md5(serialize($params) . date('Y-m-d'));
        if (!is_null($this->cacheKeyPrefix)) {
            $serializedKey = $this->cacheKeyPrefix . $serializedKey;
        }
        $this->url = $url = $this->url . 'query?' . http_build_query($params);

        if (!$this->disableCache && Cache::has($serializedKey)) {
            return Cache::get($serializedKey);
        } else {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 240);
            $result = curl_exec($ch);
            curl_close($ch);
            $earthquakes = json_decode($result);

            if ($cacheableForever && is_null($this->cacheTime)) {
                Cache::forever($serializedKey, $earthquakes);
            } else {
                // Cache for X minutes
                $expiresAt = Carbon::now()->addMinutes($this->cacheTime);
                Cache::put($serializedKey, $earthquakes, $expiresAt);
            }


            return $earthquakes;
        }
    }

    /**
     * Sets the coordinates.
     *
     * @param $coordinates
     * @return $this
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * Sets the parameters.
     *
     * @param $params
     * @return $this
     */
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

        if (Cache::get($serializedKey) && !$this->disableCache) {
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

    /**
     * Returns the USGS source url.
     *
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->url;
    }

    /**
     * Disables caching. For fresh results.
     *
     * @return $this
     */
    public function disableCache()
    {
        $this->disableCache = true;

        return $this;
    }

    /**
     * Sets the cache time in minutes.
     *
     * @param $minutes
     * @return $this
     */
    public function setCacheTime($minutes)
    {
        $this->cacheTime = $minutes;

        return $this;
    }

    /**
     * Sets the cache prefix.
     *
     * @param $prefix
     * @return $this
     */
    public function setCacheKeyPrefix($prefix)
    {
        $this->cacheKeyPrefix = $prefix;

        return $this;
    }

    /**
     * Overrides any other caching options. Results will be cached
     * if query date is more than 30 days.
     *
     * @param $date
     * @return bool
     */
    private function checkIfCacheableForever($date)
    {
        // convert to Y-m-d first
        $date = date('Y-m-d', strtotime($date));

        list($year, $month, $day) = explode('-', $date);
        $queryDate = Carbon::create($year, $month, $day);
        $now = Carbon::now(); // cacheable if date is more than a month
        $diff = $queryDate->diffInDays($now);

        return ($diff >= 30) ? true : false;
    }

    /**
     * Returns the coordinates of the Philippines
     *
     * @return mixed
     */
    public function getPhilippineCoordinates()
    {
        $coordinates = [
            'minlatitude' => config('app.minlatitude'),
            'maxlatitude' => config('app.maxlatitude'),
            'minlongitude' => config('app.minlongitude'),
            'maxlongitude' => config('app.maxlongitude'),
        ];

        return $coordinates;
    }

    public function getLuzonCoordinates()
    {
        $coordinates = [
            'minlatitude' => '12',
            'maxlatitude' => '20',
            'minlongitude' => '115',
            'maxlongitude' => '127',
        ];

        return $coordinates;
    }

    public function getVisayasCoordinates()
    {
        $coordinates = [
            'minlatitude' => '12',
            'maxlatitude' => '20',
            'minlongitude' => '115',
            'maxlongitude' => '127',
        ];

        return $coordinates;
    }

    public function getGlobalCoordinates()
    {
        $coordinates = [
            'minlatitude' => '-90',
            'maxlatitude' => '90',
            'minlongitude' => '-180',
            'maxlongitude' => '180',
        ];

        return $coordinates;
    }
}
