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
    Route::get('/booking','API\BookingAPI@index');
    Route::get('/booking/{id}','API\BookingAPI@show');
    Route::post('/booking','API\BookingAPI@store');
    Route::post('/booking/{id}','API\BookingAPI@update');
    Route::delete('/booking/{id}','API\BookingAPI@destroy');
});
