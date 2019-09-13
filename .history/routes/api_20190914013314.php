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

    //provice
    Route::get('/province','API\ProvinceAPI@index');
    Route::post('/province', 'API\ProvinceController@store');

    //country
    Route::get('/country','CountryController@index');
    Route::get('/country/{id}','CountryController@show');
    Route::post('/country','CountryController@store');
    Route::put('/country/{id}', 'CountryController@update');

     //store
     Route::get('/store','StoreController@index');
     Route::get('/store/{id}','StoreController@show');
     Route::post('/store','StoreController@store');
     Route::put('/store/{id}','StoreController@update');
      
});
