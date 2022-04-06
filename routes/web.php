<?php

use Illuminate\Support\Facades\Auth;
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
//Admin User Auth
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm');
Route::post('admin/login','Auth\AdminLoginController@login')-> name('admin.login');
Route::post('admin/logout','Auth\AdminLoginController@logout')-> name('admin.logout');

Route::get('/', function () {
    return redirect('admin/login');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->namespace('Backend')->middleware('auth:admin_user')->group(function(){
    Route::get('/' , 'AdminUserController@home' ) -> name('home');

});