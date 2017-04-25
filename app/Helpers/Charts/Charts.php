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

    public static function getMagnitudeLabel($magnitude)
    {
        if ($magnitude < 2.0) {
            // not felt - blue
            $color = "#0000ff";
            $label = "Not Felt";
        } elseif ($magnitude > 2.0 && $magnitude <= 4.0) {
            // minor - blue green
            $color = "#0d98ba";
            $label = "Minor";
        } elseif ($magnitude > 4.0 && $magnitude <= 5.0) {
            // small - green
            $color = "#00ff00";
            $label = "Small";
        } elseif ($magnitude > 5.0 && $magnitude <= 6.0) {
            // moderate - orange
            $color = "#ffa500";
            $label = "Moderate";
        } elseif ($magnitude > 6.0 && $magnitude <= 7.0) {
            // strong
            $color = "#ff69b4";
            $label = "Strong";
        } elseif ($magnitude > 7.0 && $magnitude <= 8.0) {
            // major
            $color = "#ff1493";
            $label = "Major";
        } elseif ($magnitude > 8.0) {
            // great
            $color = "#ff0000";
            $label = "Great";
        } else {
            $color = '';
            $label = 'Unknown';
        }

        $html = "<span class=\"label\" style=\"background: {$color}\"><i class=\"fa fa-flash\"></i> {$magnitude} {$label}</span>";

        return $html;
    }
}