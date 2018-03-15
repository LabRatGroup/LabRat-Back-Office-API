<?php

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

Route::post('recover', 'UserController@recover')->name('user.recover');
Route::post('register', 'UserController@register')->name('user.register');
Route::post('login', 'UserController@login')->name('user.login');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('logout', 'UserController@logout')->name('user.logout');
});
