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

Route::get('/', 'HomeController@getIndex');
Route::post('/', 'HomeController@getIndex');
Route::get('/earthquake-history', 'HomeController@getEarthquakeHistory');
Route::post('/earthquake-history', 'HomeController@postEarthquakeHistory');

Route::get('/earthquake-heatmap', 'HomeController@getHeatmap');
Route::post('/earthquake-heatmap', 'HomeController@getHeatmap');