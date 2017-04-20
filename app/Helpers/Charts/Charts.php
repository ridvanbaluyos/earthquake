<?php

namespace App\Helpers\Charts;

class ChartHelper
{
    public static function formatStackedAreaChart($data, $filter = 'days')
    {
        $earthquakes = [];
        $above = [];
        $below = [];

        switch ($filter) {
            case 'days':
                $dateFormat = 'd M Y';
                break;
            case 'months':
                $dateFormat = 'M Y';
                break;
            case 'years':
                $dateFormat = 'Y';
                break;
            default:
                $dateFormat = 'M Y';
        }
        foreach ($data->features as $earthquake) {
            $date = date($dateFormat, intval($earthquake->properties->time)/1000);
            if (!isset($earthquakes[$date])) {
                $earthquakes[$date] = [];
            }

            if ($earthquake->properties->mag >= 5) {
                if (!isset($earthquakes[$date]['above'])) {
                    $earthquakes[$date]['above'] = [];
                }
                array_push($earthquakes[$date]['above'], $earthquake->properties);
            } else {
                if (!isset($earthquakes[$date]['below'])) {
                    $earthquakes[$date]['below'] = [];
                }
                array_push($earthquakes[$date]['below'], $earthquake->properties);
            }
        }

        $earthquakes = array_reverse($earthquakes, true);
        $dateLabels = '[\'' . implode('\',\'', array_keys($earthquakes)) . '\']';

        foreach ($earthquakes as $earthquake) {
            if (!isset($earthquake['above'])) {
                array_push($above, 0);
            } else {
                array_push($above, count($earthquake['above']));
            }

            if (!isset($earthquake['below'])) {
                array_push($below, 0);
            } else {
                array_push($below, count($earthquake['below']));
            }

        }

        $aboveLabels = '[' . implode(',', $above) . ']';
        $belowLabels = '[' . implode(',', $below) . ']';

        $areaChart['labels'] = $dateLabels;
        $areaChart['aboveLabels'] = $aboveLabels;
        $areaChart['belowLabels'] = $belowLabels;

        return $areaChart;
    }
}