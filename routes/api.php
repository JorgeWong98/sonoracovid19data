<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('cities', 'CityAPIController@getAll');
Route::post('cities/{id}', 'CityAPIController@find');
Route::post('cities/{id}/data', 'CityAPIController@getCityData');
Route::post('cities/{id}/accumulated', 'CityAPIController@getAccumulated');
