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

Route::post('/register', 'Api\RegisterController@index');
Route::post('/login', 'Api\LoginController@index');

// check if request has a valid jwt token
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', 'Api\LogoutController@index');
    Route::post('/find/ip', 'Api\AddressController@index');
    Route::post('/find/url', 'Api\AddressController@url');
    Route::get('/addresses', 'Api\AddressController@myList');
    Route::delete('/addresses/{id}', 'Api\AddressController@remove')->where(['id' => '\d+']);
    Route::put('/addresses/{id}', 'Api\AddressController@edit')->where(['id' => '\d+']);
    Route::post('/addresses', 'Api\AddressController@add');
});

