<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('ciudades');
});

Route::get('/ciudades', 'CityController@index');
Route::get('/ciudades/{name}', 'CityController@show');

Route::get('ciudades/comparar', function (){
    return view('compare');
});

Route::get('dashboard/registros', 'RegistryController@index');
Route::post('dashboard/registros', 'RegistryController@index');
Route::get('dashboard/registros/crear', 'RegistryController@create');
Route::post('dashboard/registros/crear', 'RegistryController@store');

Route::get('acceder-sistema', 'LoginController@form')->name('login');
Route::post('login', 'LoginController@attempt');
Route::post('logout', 'LoginController@logout');
