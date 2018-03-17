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
use App\Helpers\MachineLearning\Predictor;

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


        if ($request->route()->uri() === 'amp') {
            // disable newrelic monitoring for AMP pages.
            if (extension_loaded('newrelic')) { // Ensure PHP agent is available
                newrelic_disable_autorum();
            }

            return response()
                ->view('amp.home', ['data' => $data]);
        } else {
            return response()
                ->view('home', ['data' => $data]);
        }

    }

    public function getGraphCharts(Request $request)
    {
        $data = [];

        $period = 180;

        $period = $request->input('period', $period);
        $graphType = $request->input('type', 'bar');
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

    public function getHeatmap(Request $request)
    {
        $data = [];
        $period = $request->input('period', 180);
        $graphType = $request->input('type', 'line');

        $params = [
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
        ];

        ini_set('memory_limit', '1024M');
        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setCacheKeyPrefix('graphs')->setParameters($params)->getEarthquakes();

        $url = $usgs->getSourceUrl();

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = $period;
        $data['params']['type'] = $graphType;
        $data['url'] = $url;

        return response()
            ->view('heatmap', ['data' => $data]);
    }


    public function getEarthquakeHistory(Request $request)
    {
        $data = [];

        $period = $request->input('period', 30);
        $params = [
            'minmagnitude' => $request->input('minmagnitude', 0),
            'maxmagnitude' => $request->input('maxmagnitude', 10),
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
        ];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->setCacheKeyPrefix('history')->setParameters($params)->getEarthquakes();

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

    public function getPredict(Request $request)
    {
        $data = [];
        $period = $request->input('period', 180);
        $month = $request->input('month', 1);
        $day = $request->input('day', 1);
        $year = $request->input('year', date('Y', strtotime('+1 year')));
        $hour = $request->input('hour', 0);

        if ($request->method() === 'POST')
        {
            $params = [
                'starttime' => date('Y-m-d', strtotime('-' . $period . ' days')),
            ];

            ini_set('memory_limit', '1024M');
            $usgs = new EarthquakeRepository();
            $earthquakes = $usgs->setCacheKeyPrefix('graphs')->setParameters($params)->getEarthquakes();

            $dayOfWeek = date('w', mktime($hour, 0, 0, $month, $day, $year));

            $predictor = new Predictor($earthquakes->features);
            $earthquakeId = $predictor->predict([$dayOfWeek, $hour]);

            $usgs = new EarthquakeRepository();
            $earthquake = $usgs->setCacheTime(60)->getEarthquake($earthquakeId);

            $data['earthquake'] = $earthquake;
            $data['url'] = $usgs->getSourceUrl();

            $data['params']['sample_count'] = $predictor->getSampleCount();

        }

        $data['params']['period'] = $period;
        $data['params']['month'] = $month;
        $data['params']['day'] = $day;
        $data['params']['year'] = $year;
        $data['params']['hour'] = $hour;

        return response()
            ->view('predict', ['data' => $data]);
    }
}
