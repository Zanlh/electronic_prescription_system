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

    Route::post('doctor-register','AuthController@doctorRegister');
    Route::post('doctor-login','AuthController@doctorLogin');

    Route::get('hello', function(){
        return 'hello';
    });

    Route::middleware('auth:api')->group(function(){
        Route::get('profile','PageController@profile'); 
        Route::post('user-logout','AuthController@userLogout');

        // Medicine and Treatments plans Contra-Indication

        Route::post('store-medicine','PageController@storeMedicine');
        Route::post('store-treatment','PageController@storeTreatment');
        Route::get('medicine','PageController@Medicine');
        Route::get('treatment','PageController@Treatment');

        // prescription
        Route::get('prescription/{id}','PageController@Prescription');
        Route::get('issue','PageController@Issue');
    });

    Route::middleware('auth:doctor-api')->group(function(){
        Route::post('doctor-profile','PageController@doctorProfile'); 
        Route::post('doctor-logout','AuthController@doctorLogout');

        // Prescription
        Route::POST('add-issue','PageController@addIssue');
        Route::POST('add-prescription','PageController@addPrescription');

        Route::GET('users','PageController@Users');
        Route::GET('get-medicines/{id}','PageController@userMedicines');
        Route::GET('get-treatments/{id}','PageController@userTreatments');
        Route::GET('get-issues/{id}','PageController@userIssues');

         // prescription
         Route::get('user-prescription/{id}','PageController@userPrescription');
         Route::get('user-issue/{id}','PageController@userIssue');
    });

});