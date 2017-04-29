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
            'limit' => '8'
        ];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setCacheTime(5)
                        ->setCacheKeyPrefix('home')
                        ->setParameters($params)
                        ->getEarthquakes();

        unset($usgs);

        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 11,
            'starttime' => date('Y-m-d', strtotime('-1 days')),
            'orderby' => 'magnitude',
            'limit' => '5',

        ];
        $usgs = new EarthquakeRepository();
        $biggestEarthquakeToday = $usgs->setCacheTime(5)
                                    ->setCacheKeyPrefix('biggest')
                                    ->setCoordinates($usgs->getGlobalCoordinates())
                                    ->setParameters($params)
                                    ->getEarthquakes();

        unset($params['orderby']);
        $latestEarthquakesToday = $usgs->setCacheTime(5)
                                    ->setCacheKeyPrefix('latest')
                                    ->setCoordinates($usgs->getGlobalCoordinates())
                                    ->setParameters($params)
                                    ->getEarthquakes($params);

        $data['earthquakes'] = $earthquakes;
        $data['biggest_earthquake_today'] = $biggestEarthquakeToday;
        $data['latest_earthquake_today'] = $latestEarthquakesToday;

        return response()
            ->view('home', ['data' => $data]);
    }

    public function getGraphCharts(Request $request)
    {
        $data = [];

        $period = 30;

        $period = $request->input('period', $period);
        $graphType = $request->input('type', 'line');
        $filter = $request->input('filter', 'day');

        $params = [
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
        ];

        if ($period >= 1080 && $period < 7200) {
            $filter = 'month';
        }
        if ($period >= 7200) {
            $filter = 'year';
        }

        ini_set('memory_limit', '1024M');
        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setCacheKeyPrefix('graphs')->setParameters($params)->getEarthquakes();

        $areaChart['graph'] = ChartHelper::formatStackedAreaChart($earthquakes, $filter);
        $areaChart['bymonth'] = ChartHelper::formatStackedAreaChart($earthquakes, 'bymonth');
        $areaChart['byweekday'] = ChartHelper::formatStackedAreaChart($earthquakes, 'byweekday');
        $areaChart['byhour'] = ChartHelper::formatStackedAreaChart($earthquakes, 'byhour');

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
        $earthquakes = $usgs->setCacheKeyPrefix('history')->setParameters($params)->getEarthquakes();

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
        $earthquake = $usgs->setCacheTime(60)->getEarthquake($id);

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
        $findme    = 'a';
        $mystring1 = 'xyz';
        $mystring2 = 'ABC';

        $pos1 = stripos($mystring1, $findme);
        $pos2 = stripos($mystring2, $findme);

        // Nope, 'a' is certainly not in 'xyz'
        if ($pos1 === false) {
            echo "The string '$findme' was not found in the string '$mystring1'";
        }

        // Note our use of ===.  Simply == would not work as expected
        // because the position of 'a' is the 0th (first) character.
        if ($pos2 !== false) {
            echo "We found '$findme' in '$mystring2' at position $pos2";
        }
    }

}
