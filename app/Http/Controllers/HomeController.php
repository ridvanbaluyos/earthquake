<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Repositories\EarthquakeRepository;
use App\Helpers\Charts\ChartHelper;

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getIndex(Request $request)
    {
        $data = [];

        $period = $request->input('period', 7200);
        $chart = $request->input('chart', 'bar');
        $filter = $request->input('filter', 'months');

        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 10,
            'starttime' => date('Y-m-d', strtotime('-' . $period . ' days'))
        ];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->getEarthquakes($params);
        $areaChart = ChartHelper::formatStackedAreaChart($earthquakes, $filter);

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = 30;
        $data['params']['chart'] = $chart;
        $data['params']['period'] = $period;
        $data['params']['filter'] = $filter;
        $data['area_chart'] = $areaChart;

        return response()
            ->view('dashboard', ['data' => $data]);
    }

    private function getFilterBasedFromDays($period)
    {
        $filter = 'days';

        if ($period <= 30) {
            $filter = 'days';
        } else if ($period > 30 && $period <= 1800) {
            $filter = 'months';
        } else if ($period > 1800) {
            $filter = 'years';
        }

        return $filter;
    }

    public function getEarthquakeHistory()
    {
        $data = [];

        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->getEarthquakes();

        $params = [
            'minmagnitude' => 0,
            'maxmagnitude' => 10,
        ];

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = 30;

        return response()
            ->view('earthquake-history', ['data' => $data]);
    }

    public function postEarthquakeHistory(Request $request)
    {
        $data = [];

        // date
        $period = $request->input('period');
        $startDate = date('Y-m-d', strtotime('- ' . $period . 'days'));
        $endDate = date('Y-m-d');

        // magnitude
        $minMagnitude = $request->input('minmagnitude');
        $maxMagnitude = $request->input('maxmagnitude');

        $params = [
            'starttime' => $startDate,
            'endtime' => $endDate,
            'minmagnitude' => $minMagnitude,
            'maxmagnitude' => $maxMagnitude,

        ];
        $usgs = new EarthquakeRepository();
        $earthquakes = $usgs->getEarthquakes($params);

        $data['earthquakes'] = $earthquakes;
        $data['params'] = $params;
        $data['params']['period'] = $period;

        return response()
            ->view('earthquake-history', ['data' => $data]);
    }
}
