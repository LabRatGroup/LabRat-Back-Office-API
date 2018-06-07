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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::get('profile', 'ProfileController@update')->name('profile.update');
    Route::patch('profile/save', 'ProfileController@save')->name('profile.save');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('demo', 'HomeController@demo')->name('demo');
});


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

Route::group(['middleware' => ['auth']], function () {
    Route::get('models', 'MlModelController@index')->name('model.index');
    Route::get('models/{id}/show', 'MlModelController@show')->name('model.show');
    Route::get('models/{id}/create', 'MlModelController@create')->name('model.create');
    Route::post('models/store', 'MlModelController@store')->name('model.store');
    Route::get('models/{id}/update', 'MlModelController@update')->name('model.update');
    Route::patch('models/{id}/save', 'MlModelController@save')->name('model.save');
    Route::delete('models/{id}/delete', 'MlModelController@delete')->name('model.delete');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('state/model/{id}', 'MlModelStateController@index')->name('state.index');
    Route::get('state/show/{id}', 'MlModelStateController@show')->name('state.show');
    Route::get('state/{id}/create', 'MlModelStateController@create')->name('state.create');
    Route::post('state/store', 'MlModelStateController@store')->name('state.store');
    Route::get('state/{id}/update', 'MlModelStateController@update')->name('state.update');
    Route::patch('state/{id}/save', 'MlModelStateController@save')->name('state.save');
    Route::delete('state/{id}/delete', 'MlModelStateController@delete')->name('state.delete');
    Route::get('state/{id}/current', 'MlModelStateController@current')->name('state.current');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('predictions', 'MlModelPredictionController@index')->name('prediction.index');
    Route::get('predictions/{id}/show', 'MlModelPredictionController@show')->name('prediction.show');
    Route::get('predictions/{id}/create', 'MlModelPredictionController@create')->name('prediction.create');
    Route::post('predictions/store', 'MlModelPredictionController@store')->name('prediction.store');
    Route::get('predictions/{id}/update', 'MlModelPredictionController@update')->name('prediction.update');
    Route::patch('predictions/{id}/save', 'MlModelPredictionController@save')->name('prediction.save');
    Route::delete('predictions/{id}/delete', 'MlModelPredictionController@delete')->name('prediction.delete');
    Route::get('predictions/{id}/run', 'MlModelPredictionController@run')->name('prediction.run');

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
