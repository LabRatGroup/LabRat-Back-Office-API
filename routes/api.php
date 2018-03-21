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

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('logout', 'UserController@logout')->name('user.logout');
    Route::post('un-register', 'UserController@unRegister')->name('user.un-register');
});


Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('team/create', 'TeamController@create')->name('team.create');
    Route::post('team/{id}/update', 'TeamController@update')->name('team.update');
    Route::delete('team/{id}/delete', 'TeamController@delete')->name('team.delete');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('team/addMember', 'TeamMemberController@addMember')->name('team.addMember');
    Route::post('team/updateMember', 'TeamMemberController@updateMember')->name('team.updateMember');
    Route::post('team/deleteMember', 'TeamMemberController@deleteMember')->name('team.deleteMember');
});
