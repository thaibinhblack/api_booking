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
    Route::get('/booking/check','API\BookingAPI@check');
    Route::get('/booking/{id}','API\BookingAPI@show');
    Route::post('/booking','API\BookingAPI@store');
    Route::post('/booking/update','API\BookingAPI@action');
    Route::delete('/booking/{id}','API\BookingAPI@destroy');

    //provice
    Route::get('/province','API\ProvinceAPI@index');
    Route::post('/province', 'API\ProvinceAPI@store');

    //country
    Route::get('/country','API\CountryAPI@index');
    Route::get('/country/{id}','API\CountryAPI@show');
    Route::post('/country','API\CountryAPI@store');
    Route::put('/country/{id}', 'API\CountryAPI@update');

     //store
     Route::get('/store','API\StoreAPI@index');
     Route::get('/store/{id}','API\StoreAPI@show');
     Route::post('/store','API\StoreAPI@store');
     Route::post('/store/{id}/update','API\StoreAPI@update');
     Route::delete('/store/{id}','API\StoreAPI@destroy');

     //service 
    Route::get('/service','API\ServiceAPI@index');
    Route::post('/service', 'API\ServiceAPI@store');
    Route::post('/service/{id}/update','API\ServiceAPI@update');

     //room
     Route::get('/room','API\RoomAPI@index');
     Route::get('/room/{id}','API\RoomAPI@show');
     Route::post("/room",'API\RoomAPI@store');
     Route::post("/room/{id}/update",'API\RoomAPI@update');

    //stylist
    Route::get('/stylist','API\StylistAPI@index');
    Route::get('/stylist/{id}','API\StylistAPI@show');
    Route::post('/stylist','API\StylistAPI@store');
    Route::post('/stylist/{id}/update','API\StylistAPI@update');

    //detail service booking
    Route::get('/detail-service/{id}','API\DetailServiceAPI@show');
    Route::post('/detail_service_booking','API\DetailServiceAPI@store');
    Route::delete('/detail-service/{id}','API\DetailServiceAPI@destroy');

    //SMS
    Route::get('/sms','API\SMSAPI@index');
    Route::post('/sms','API\SMSAPI@store');

    //EMAIL
    Route::post('/email','API\EmailAPI@store');

     //user
    Route::get('/user/info','API\UserAPI@getUserByToken');
    Route::get('/user/{id}','API\UserAPI@show');
    Route::get('/user/{id}/update','API\UserAPI@update');
    Route::post('/user','API\UserAPI@store');
    Route::get('/user','API\UserAPI@index');
    Route::delete('/user/{id}','API\UserAPI@destroy');
    //question
    Route::get('/question','API\QuestionAPI@index');
    Route::post('/question','API\QuestionAPI@store');
    Route::post('/question/{id}/update','API\QuestionAPI@update');
    Route::delete('/question/{id}','API\QuestionAPI@destroy');
    //answer
    Route::get('/answer','API\AnswerAPI@index');
    Route::post('/answer','API\AnswerAPI@store');
    Route::post('/answer/{id}/update','API\AnswerAPI@update');

    //user question answer 
    Route::get('/user-question/{id}','API\UserQuestionAPI@show');
    Route::post('/user-question','API\UserQuestionAPI@store');

    Route::post('/register', 'API\UserAPI@register');
    Route::post('/login', 'API\UserAPI@login');
    
    Route::get('/history','API\HistoryAPI@index');
    //code

    Route::get('/code','API\CodeAPI@index');
    Route::post('/code','API\CodeAPI@store');
});
