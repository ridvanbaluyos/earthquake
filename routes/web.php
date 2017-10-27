<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['get', 'post'], '/', 'HomeController@getIndex');

Route::match(['get', 'post'], '/earthquakes', 'HomeController@getEarthquakeHistory');

Route::match(['get'], '/earthquakes/{id}', 'HomeController@getEarthquakeDetails');

Route::match(['get', 'post'], '/earthquake-heatmap', 'HomeController@getHeatmap');

Route::match(['get', 'post'], '/earthquake-graphs-charts', 'HomeController@getGraphCharts');

Route::match(['get'], '/earthquake-101', 'HomeController@getEarthquake101');

Route::match(['get'], '/earthquake-hotlines', 'HomeController@getHotlines');

Route::match(['get'], '/about', 'HomeController@getAbout');

Route::match(['get'], '/test', 'HomeController@getTest');


Route::prefix('amp')->group(function () {
    Route::get('/', 'HomeController@getIndex')
        ->name('amp-homepage');

    
});