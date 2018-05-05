<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/secure', 'HomeController@secure')->name('secure');

Route::group(['middleware' => ['auth']], function () {
    Route::get('projects', 'ProjectController@index')->name('project.index');
    Route::get('projects/{id}/show', 'ProjectController@show')->name('project.show');
    Route::get('projects/create', 'ProjectController@create')->name('project.create');
    Route::post('projects/store', 'ProjectController@store')->name('project.store');
    Route::get('projects/{id}/update', 'ProjectController@update')->name('project.update');
    Route::patch('projects/{id}/save', 'ProjectController@save')->name('project.save');
    Route::delete('projects/{id}/delete', 'ProjectController@delete')->name('project.delete');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('teams', 'TeamController@index')->name('team.index');
    Route::get('teams/{id}/show', 'TeamController@show')->name('team.show');
    Route::get('teams/create', 'TeamController@create')->name('team.create');
    Route::post('teams/store', 'TeamController@store')->name('team.store');
    Route::get('teams/{id}/update', 'TeamController@update')->name('team.update');
    Route::patch('teams/{id}/save', 'TeamController@save')->name('team.save');
    Route::delete('teams/{id}/delete', 'TeamController@delete')->name('team.delete');
});

