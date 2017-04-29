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
        foreach (config('references.intensity_labels.richter') as $range=>$properties) {
            $label = strtolower($properties['label']);
            $$label = [];
        }

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
            if (!isset($earthquakes[$date])) {
                $earthquakes[$date] = [];
            }

            $mag = $earthquake->properties->mag;
            foreach (config('references.intensity_labels.richter') as $range=>$properties) {
                list($min, $max) = explode(',', $range);
                $label = strtolower($properties['label']);
                if ($mag >= $min && $mag < $max) {
                    if (!isset($earthquakes[$date][$label])) {
                        $earthquakes[$date][$label] = [];
                    }
                    array_push($earthquakes[$date][$label], $earthquake->properties);
                }
            }
        }

        if ($filter == 'byhour') {
            ksort($earthquakes, true);
        } else {
            $earthquakes = array_reverse($earthquakes, true);
        }
        $dateLabels = '[\'' . implode('\',\'', array_keys($earthquakes)) . '\']';

        foreach ($earthquakes as $earthquake) {
            foreach (config('references.intensity_labels.richter') as $range=>$properties) {
                $label = strtolower($properties['label']);

                if (!isset($earthquake[$label])) {
                    array_push($$label, 0);
                } else {
                    array_push($$label, count($earthquake[$label]));
                }
            }
        }

        $areaChart['labels'] = $dateLabels;
        foreach (config('references.intensity_labels.richter') as $range=>$properties) {
            $label = strtolower($properties['label']);
            $areaChart[$label . 'Labels'] = '[' . implode(',', $$label) . ']';
        }

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