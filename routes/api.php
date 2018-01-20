<?php

use Illuminate\Http\Request;

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
Route::post('login', 'LoginController@login');

Route::get('repository/signout', 'RepositoryController@logout');
Route::get('repository/{firebase}', 'RepositoryController@index');
Route::get('user/{user}/{firebase}', 'UserController@show');
Route::post('repository/{repository}/{firebase}', 'RepositoryController@destroy');

Route::apiResource('repository', 'RepositoryController');
Route::apiResource('user', 'UserController');
