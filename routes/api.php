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
    Route::get('team', 'TeamController@index')->name('team.index');
    Route::get('team/show/{id}', 'TeamController@show')->name('team.show');
    Route::post('team/create', 'TeamController@create')->name('team.create');
    Route::post('team/{id}/update', 'TeamController@update')->name('team.update');
    Route::delete('team/{id}/delete', 'TeamController@delete')->name('team.delete');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('team/addMember', 'TeamMemberController@addMember')->name('team.addMember');
    Route::post('team/updateMember', 'TeamMemberController@updateMember')->name('team.updateMember');
    Route::post('team/deleteMember', 'TeamMemberController@deleteMember')->name('team.deleteMember');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('project', 'ProjectController@index')->name('project.index');
    Route::get('project/show/{id}', 'ProjectController@show')->name('project.show');
    Route::post('project/create', 'ProjectController@create')->name('project.create');
    Route::post('project/{id}/update', 'ProjectController@update')->name('project.update');
    Route::delete('project/{id}/delete', 'ProjectController@delete')->name('project.delete');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('project/addMember', 'ProjectMemberController@addMember')->name('project.addMember');
    Route::post('project/updateMember', 'ProjectMemberController@updateMember')->name('project.updateMember');
    Route::post('project/deleteMember', 'ProjectMemberController@deleteMember')->name('project.deleteMember');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('project/addTeam', 'ProjectTeamController@addTeam')->name('project.addTeam');
    Route::post('project/deleteTeam', 'ProjectTeamController@deleteTeam')->name('project.deleteTeam');
});

Route::group(['middleware' => ['jwt.auth']], function () {
//    Route::get('model', 'MlModelController@index')->name('model.index');
    Route::get('model/show/{id}', 'MlModelController@show')->name('model.show');
    Route::post('model/create', 'MlModelController@create')->name('model.create');
    Route::post('model/{id}/update', 'MlModelController@update')->name('model.update');
    Route::delete('model/{id}/delete', 'MlModelController@delete')->name('model.delete');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('algorithm', 'MlAlgorithmController@index')->name('algorithm.index');
    Route::get('algorithm/show/{id}', 'MlAlgorithmController@show')->name('algorithm.show');
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('state/model/{id}', 'MlModelStateController@index')->name('state.index');
    Route::get('state/show/{id}', 'MlModelStateController@show')->name('state.show');
    Route::post('state/create', 'MlModelStateController@create')->name('state.create');
    Route::post('state/{id}/update', 'MlModelStateController@update')->name('state.update');
    Route::delete('state/{id}/delete', 'MlModelStateController@delete')->name('state.delete');
    Route::post('state/{id}/current', 'MlModelStateController@current')->name('state.current');
});
