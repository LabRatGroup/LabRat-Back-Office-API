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
    Route::get('project', 'ProjectController@index')->name('project.index');
    Route::get('project/{id}/show', 'ProjectController@show')->name('project.show');
    Route::get('project/create', 'ProjectController@create')->name('project.create');
    Route::post('project/store', 'ProjectController@store')->name('project.store');
    Route::get('project/{id}/update', 'ProjectController@update')->name('project.update');
    Route::patch('project/{id}/save', 'ProjectController@save')->name('project.save');
    Route::delete('project/{id}/delete', 'ProjectController@delete')->name('project.delete');
});

