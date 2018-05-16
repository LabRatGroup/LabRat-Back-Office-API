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

Route::post('recover', 'Api\UserController@recover')->name('api.user.recover');
Route::post('register', 'Api\UserController@register')->name('api.user.register');
Route::post('login', 'Api\UserController@login')->name('api.user.login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('users/findByEmail', 'Api\UserController@findByEmail')->name('api.user.findByEmail');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', 'Api\UserController@logout')->name('api.user.logout');
    Route::post('un-register', 'Api\UserController@unRegister')->name('api.user.un-register');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('team', 'Api\TeamController@index')->name('api.team.index');
    Route::get('team/show/{id}', 'Api\TeamController@show')->name('api.team.show');
    Route::post('team/create', 'Api\TeamController@create')->name('api.team.create');
    Route::post('team/{id}/update', 'Api\TeamController@update')->name('api.team.update');
    Route::delete('team/{id}/delete', 'Api\TeamController@delete')->name('api.team.delete');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('team/addMember', 'Api\TeamMemberController@addMember')->name('api.team.addMember');
    Route::post('team/updateMember', 'Api\TeamMemberController@updateMember')->name('api.team.updateMember');
    Route::post('team/deleteMember', 'Api\TeamMemberController@deleteMember')->name('api.team.deleteMember');
    Route::get('team/getDefaultCollaboratorRole', 'Api\TeamMemberController@getDefaultCollaboratorRole')->name('api.team.getDefaultCollaboratorRole');


});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('project', 'Api\ProjectController@index')->name('api.project.index');
    Route::get('project/show/{id}', 'Api\ProjectController@show')->name('api.project.show');
    Route::post('project/create', 'Api\ProjectController@create')->name('api.project.create');
    Route::post('project/{id}/update', 'Api\ProjectController@update')->name('api.project.update');
    Route::delete('project/{id}/delete', 'Api\ProjectController@delete')->name('api.project.delete');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('project/addMember', 'Api\ProjectMemberController@addMember')->name('api.project.addMember');
    Route::post('project/updateMember', 'Api\ProjectMemberController@updateMember')->name('api.project.updateMember');
    Route::post('project/deleteMember', 'Api\ProjectMemberController@deleteMember')->name('api.project.deleteMember');
    Route::get('project/getDefaultCollaboratorRole', 'Api\ProjectMemberController@getDefaultCollaboratorRole')->name('api.project.getDefaultCollaboratorRole');

});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('project/addTeam', 'Api\ProjectTeamController@addTeam')->name('api.project.addTeam');
    Route::post('project/deleteTeam', 'Api\ProjectTeamController@deleteTeam')->name('api.project.deleteTeam');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('models/project/{id}', 'Api\MlModelController@index')->name('api.model.index');
    Route::get('model/show/{id}', 'Api\MlModelController@show')->name('api.model.show');
    Route::post('model/create', 'Api\MlModelController@create')->name('api.model.create');
    Route::post('model/{id}/update', 'Api\MlModelController@update')->name('api.model.update');
    Route::delete('model/{id}/delete', 'Api\MlModelController@delete')->name('api.model.delete');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('algorithm', 'Api\MlAlgorithmController@index')->name('api.algorithm.index');
    Route::get('algorithm/show/{id}', 'Api\MlAlgorithmController@show')->name('api.algorithm.show');
    Route::get('algorithm/getResamplingMethods', 'Api\MlAlgorithmController@getResamplingMethods')->name('api.algorithm.resampling');

});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('state/model/{id}', 'Api\MlModelStateController@index')->name('api.state.index');
    Route::get('state/show/{id}', 'Api\MlModelStateController@show')->name('api.state.show');
    Route::post('state/create', 'Api\MlModelStateController@create')->name('api.state.create');
    Route::post('state/{id}/update', 'Api\MlModelStateController@update')->name('api.state.update');
    Route::delete('state/{id}/delete', 'Api\MlModelStateController@delete')->name('api.state.delete');
    Route::post('state/{id}/current', 'Api\MlModelStateController@current')->name('api.state.current');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('score/state/{id}/show', 'Api\MlModelStateScoreController@show')->name('api.score.show');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('prediction/model/{id}', 'Api\MlModelPredictionController@index')->name('api.prediction.index');
    Route::get('prediction/show/{id}', 'Api\MlModelPredictionController@show')->name('api.prediction.show');
    Route::post('prediction/create', 'Api\MlModelPredictionController@create')->name('api.prediction.create');
    Route::post('prediction/{id}/update', 'Api\MlModelPredictionController@update')->name('api.prediction.update');
    Route::delete('prediction/{id}/delete', 'Api\MlModelPredictionController@delete')->name('api.prediction.delete');
    Route::get('prediction/{id}/run', 'Api\MlModelPredictionController@run')->name('api.prediction.run');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('score/prediction/{id}/show', 'Api\MlModelPredictionScoreController@show')->name('api.score.prediction.show');
    Route::delete('score/prediction/{id}/delete', 'Api\MlModelPredictionScoreController@delete')->name('api.score.prediction.delete');

});
