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
    Route::post('/booking/update','API\BookingAPI@action');
    Route::delete('/booking/{id}','API\BookingAPI@destroy');

    //provice
    Route::get('/province','API\ProvinceAPI@index');
    Route::post('/province', 'API\ProvinceController@store');

    //country
    Route::get('/country','API\CountryAPI@index');
    Route::get('/country/{id}','API\CountryAPI@show');
    Route::post('/country','API\CountryAPI@store');
    Route::put('/country/{id}', 'API\CountryAPI@update');

     //store
     Route::get('/store','API\StoreAPI@index');
     Route::get('/store/{id}','API\StoreAPI@show');
     Route::post('/store','API\StoreAPI@store');
     Route::put('/store/{id}','API\StoreAPI@update');

     //service 
    Route::get('/service','API\ServiceAPI@index');
    Route::post('/service', 'API\ServiceAPI@store');

     //room
     Route::get('/room','API\RoomAPI@index');
     Route::get('/room/{id}','API\RoomAPI@show');
     Route::post("/room",'API\RoomAPI@store');
     Route::put("/room",'API\RoomAPI@update');

    //stylist
    Route::get('/stylist','StylistController@index');
    Route::post('/stylist','StylistController@store');
    Route::post('/stylist/{id}/update','StylistController@update');
      
});
