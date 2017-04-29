<?php

namespace App\Helpers\Charts;

use App\Helpers\DateHelper\DateHelper;
/**
 * Class ChartHelper
 * @package App\Helpers\Charts
 */
class ChartHelper
{
    /**
     * This functions formats the data result from USGS to Charts.js data format.
     *
     * @param $data
     * @param string $filter
     * @return mixed
     */
    public static function formatStackedAreaChart($data, $filter = 'days')
    {
        $earthquakes = [];
        $above = [];
        $below = [];

        switch ($filter) {
            case 'day':
                $dateFormat = 'd M Y';
                break;
            case 'month':
                $dateFormat = 'M Y';
                break;
            case 'bymonth':
                $dateFormat = 'M';
                break;
            case 'year':
                $dateFormat = 'Y';
                break;
            case 'byweekday':
                $dateFormat = 'l';
                break;
            case 'byhour':
                $dateFormat = 'H';
                break;
            default:
                $dateFormat = 'M Y';
        }


        foreach ($data->features as $earthquake) {
            $date = date($dateFormat, intval($earthquake->properties->time)/1000 + (8 * 3600));
//            $date = DateHelper::convertDate($earthquake->properties->time, true);
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

    /**
     * This function returns the magnitude label depending on the scale used.
     *
     * @param $value
     * @param string $scale
     * @return string
     */
    public static function getMagnitudeLabel($value, $scale = 'richter')
    {
        $properties = self::getMagnitudeLabelProperties($value, $scale);
        $html = '<span class="label" style="background: ' . $properties['color'] . '">' . $properties['label'] . '</span>';

        return $html;
    }

    /**
     * This function returns the scale properties (color and label).
     *
     * @param int $value
     * @param string $scale
     * @return array
     */
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

    /**
     * This function returns the richter scale properties.
     *
     * @param $value
     * @return array
     */
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

    /**
     * This function returns the mercalli scale properties.
     * @param $value
     * @return array
     */
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