<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => '/v1'], function () {
    Route::get('/booking','BookingController@index');
    Route::get('/booking/{id}','BookingController@show');
    Route::post('/booking','BookingController@store');
    Route::post('/booking/{id}','BookingController@update');
    Route::delete('/booking/{id}','BookingController@destroy');
});
