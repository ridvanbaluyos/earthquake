<?php
namespace App\Http\Controllers;

use App\Repositories\USGS\EarthquakeUsgsRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\EarthquakeRepository;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getIndex()
    {
        $data = [];
        return response()
            ->view('dashboard', ['data' => $data]);
    }

    public function getEarthquakeHistory()
    {
        $data = [];

        $params = [
            'format' => 'geojson',
//            'starttime' => '2017-04-01 00:00:01', //date('Y-m-d', strtotime('-1 days')),
//            'endtime' => '2017-04-17 23:59:59', //date('Y-m-d'),
            'minlatitude' => 5,
            'maxlatitude' => 20,
            'minlongitude' => 115,
            'maxlongitude' =>130,
        ];
        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->getEarthquakes($params);

        $data['earthquakes'] = $earthquakes;

        return response()
            ->view('earthquake-history', ['data' => $data]);
    }
}
