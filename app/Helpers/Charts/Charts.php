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
            case 'month':
                $dateFormat = 'M';
                break;
            case 'year':
                $dateFormat = 'Y';
                break;
            case 'weekday':
                $dateFormat = 'l';
                break;
            case 'hour':
                $dateFormat = 'gA';
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

        if ($filter == 'hour') {
            ksort($earthquakes, true);
        } else {
            $earthquakes = array_reverse($earthquakes, true);
        }

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

    public static function getMagnitudeLabel($value, $scale = 'richter')
    {
        $properties = self::getMagnitudeLabelProperties($value, $scale);
        $html = '<span class="label" style="background: ' . $properties['color'] . '">' . $properties['label'] . '</span>';

        return $html;
    }

    public static function getMagnitudeLabelProperties($value = 0, $scale = 'richter')
    {
        $properties = [];
        switch ($scale) {
            case 'richter':
                $properties = self::getRichterScaleProperties($value);
                break;
            case 'mercalli':
                $properties = self::getMercalliScaleProperties($value);
                break;
            default:
                break;
        }

        return $properties;
    }

    public static function getRichterScaleProperties($value)
    {
        $scaleReference = config('references.intensity_labels.richter');

        foreach ($scaleReference as $scale=>$properties) {
            list($min, $max) = explode(',', $scale);

            if ($value >= $min && $value <= $max) {
                return $properties;
            }

        }

        return ['color' => '#000000', 'label' => 'Unknown'];
    }

    public static function getMercalliScaleProperties($value)
    {
        $scaleReference = config('references.intensity_labels.richter');

        foreach ($scaleReference as $scale=>$properties) {
            list($min, $max) = explode(',', $scale);

            if ($value >= $min && $value <= $max) {
                return $properties;
            }

        }

        return ['color' => '#000000', 'label' => 'Unknown'];
    }
}