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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
  Route::post('login', 'AuthController@login')->name('auth.login');
  Route::post('logout', 'AuthController@logout')->name('auth.logout');
});

Route::group(['middleware' => 'api'], function () {
  Route::get('devices/{deviceId}/data', 'DeviceClientController@data')->name('device.data');
  Route::get('clear_data', 'DataController@clearData')->name('data.clear');
});

Route::post('store_data', 'DataController@storeData')->name('data.store');
Route::post('devices', 'DeviceClientController@store')->name('device.store');
Route::get('get_data', 'DataController@getData')->name('data.get');
Route::get('devices', 'DeviceClientController@index')->name('device.index');
