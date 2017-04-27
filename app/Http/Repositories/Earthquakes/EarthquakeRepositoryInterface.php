<?php
namespace App\Repositories;

interface EarthquakeRepositoryInterface
{
    public function getEarthquakes();

    function setCoordinates($coordinates);

    function setParameters($params);
}