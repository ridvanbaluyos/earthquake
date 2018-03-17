<?php

namespace App\Helpers\MachineLearning;

use Phpml\Classification\KNearestNeighbors;
use App\Repositories\EarthquakeRepository;

class Predictor
{
    private $earthquakes;
    private $labels;
    private $samples;

    public function __construct(Array $earthquakes)
    {
        $this->earthquakes = $earthquakes;

        $samples = [];
        $labels = [];

        foreach ($this->earthquakes as $earthquake) {
            // Samples
            $day = date('w', intval($earthquake->properties->time)/1000 + (8 * 3600));
            $hour = date('h', intval($earthquake->properties->time)/1000 + (8 * 3600));

            $data = [intval($day), intval($hour)];
            array_push($samples, $data);

            // Labels
            array_push($labels, $earthquake->id);
        }

        $this->samples = $samples;
        $this->labels = $labels;
    }

    public function predict($input)
    {
        $classifier = new KNearestNeighbors($k = 3);
        $classifier->train($this->samples, $this->labels);
        $earthquakeId = $classifier->predict($input);

        return $earthquakeId;
    }

    public function getSampleCount()
    {
        return count($this->samples);
    }
}