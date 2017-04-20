<?php
namespace App\Repositories;

interface EarthquakeRepositoryInterface
{
    public function getEarthquakes($params);
}