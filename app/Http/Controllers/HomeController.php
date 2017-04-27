<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Repositories\EarthquakeRepository;
use App\Helpers\Charts\ChartHelper;
use App\Helpers\Bible\BibleHelper;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getIndex(Request $request)
    {
        $data = [];
        $period = $request->input('period', 60);
        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 10,
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
            'limit' => '4'
        ];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setParameters($params)->getEarthquakes();

        unset($usgs);

        $coordinates = [
            'minlatitude' => '-90',
            'maxlatitude' => '90',
            'minlongitude' => '-180',
            'maxlongitude' => '180',
        ];
        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 11,
            'starttime' => date('Y-m-d', strtotime('-1 days')),
            'orderby' => 'magnitude',
            'limit' => '5',

        ];
        $usgs = new EarthquakeRepository();
        $biggestEarthquakeToday = $usgs->setCoordinates($coordinates)->setParameters($params)->getEarthquakes();

        unset($params['orderby']);
        $latestEarthquakesToday = $usgs->setParameters($params)->getEarthquakes($params);

        $data['earthquakes'] = $earthquakes;
        $data['biggest_earthquake_today'] = $biggestEarthquakeToday;
        $data['latest-earthquake_today'] = $latestEarthquakesToday;

        return response()
            ->view('home', ['data' => $data]);
    }

    public function getGraphCharts(Request $request)
    {
        $data = [];

        $period = 30;

        $period = $request->input('period', $period);
        $graphType = $request->input('type', 'line');
        $filter = $request->input('filter', 'days');

        $params = [
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
        ];

        if ($period > 7200) {
            $params['minmagnitude'] = '4';
            $filter = 'years';
        }

        ini_set('memory_limit', '1024M');
        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setParameters($params)->getEarthquakes();

        $areaChart['graph'] = ChartHelper::formatStackedAreaChart($earthquakes, $filter);
        $areaChart['month'] = ChartHelper::formatStackedAreaChart($earthquakes, 'month');
        $areaChart['weekday'] = ChartHelper::formatStackedAreaChart($earthquakes, 'weekday');
        $areaChart['hour'] = ChartHelper::formatStackedAreaChart($earthquakes, 'hour');

        $url = $usgs->getSourceUrl();

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = $period;
        $data['params']['filter'] = $filter;
        $data['params']['type'] = $graphType;
        $data['area_chart'] = $areaChart;
        $data['url'] = $url;

        return response()
            ->view('graph-charts', ['data' => $data]);

    }

    public function getEarthquakeHistory()
    {
        $data = [];

        $period = 90;
        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 10,
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
        ];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setParameters($params)->getEarthquakes();

        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 10,
        ];

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = $period;

        return response()
            ->view('history', ['data' => $data]);
    }

    public function postEarthquakeHistory(Request $request)
    {
        $data = [];

        // date
        $period = $request->input('period', 30);
        $startDate = date('Y-m-d', strtotime('- ' . $period . 'days'));
        $endDate = date('Y-m-d');

        // magnitude
        $minMagnitude = $request->input('minmagnitude', 0);
        $maxMagnitude = $request->input('maxmagnitude', 10);

        $params = [
            'starttime' => $startDate,
            'endtime' => $endDate,
            'minmagnitude' => $minMagnitude,
            'maxmagnitude' => $maxMagnitude,

        ];
        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setParameters($params)->getEarthquakes();

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = $period;

        return response()
            ->view('history', ['data' => $data]);
    }


    public function getEarthquakeDetails(Request $request, $id)
    {
        $data = [];

        $usgs =  new EarthquakeRepository();
        $earthquake = $usgs->getEarthquake($id);

        $data['earthquake'] = $earthquake;
        $data['url'] = $usgs->getSourceUrl();

        return response()
            ->view('details', ['data' => $data]);
    }

    public function getEarthquake101(Request $request)
    {
        $data = [];

        return response()
            ->view('earthquake101', ['data' => $data]);
    }

    public function getHotlines()
    {
        $data = [];

        return response()
            ->view('hotlines', ['data' => $data]);
    }

    public function getAbout()
    {
        $data = [];

        return response()
            ->view('about', ['data' => $data]);
    }

    public function getTest()
    {
        for($x = 1; $x <= 2; $x++){
            for($y = 1; $y <= 3; $y++){
                if ($x == $y) continue;
                print("x = $x  y =  $y");
            }
        }
    }

}
