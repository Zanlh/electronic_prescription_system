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

Route::namespace('Api')->group(function(){
    Route::post('user-register','AuthController@userRegister');
    Route::post('user-login','AuthController@userLogin');

    Route::get('hello', function(){
        return 'hello';
    });

    Route::middleware('auth:api')->group(function(){
        Route::post('user-logout','AuthController@userLogout');
    });

});