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
//updateRepository
Route::put('repository/admin/update/{firebase}', 'RepositoryController@updateRepository');
Route::post('repository/create/{firebase}', 'RepositoryController@createRepository');
Route::get('repository/signout', 'RepositoryController@logout');
Route::get('repository/{firebase}', 'RepositoryController@index');
Route::post('repository/{repository}/{firebase}', 'RepositoryController@destroy');

Route::post('user/check', function (Request $request) {
    $user = \App\User::where('name', $request->name)->first();
    return response()->json($user['email']);
});

Route::get('user/admin/chat', 'UserController@adminChat');
Route::get('user/{firebase}', 'UserController@index');
Route::get('user/firebase/{firebase}', 'UserController@show');
Route::post('user/{user}/{firebase}', 'UserController@destroy');
Route::put('user/{user}/update/{firebase}', 'UserController@updateUser');

Route::get('vegetation/{firebase}', 'VegetationController@index');
Route::get('family/{firebase}', 'FamilyController@index');
Route::get('distribution/{firebase}', 'DistributionController@index');
Route::get('category/{firebase}', 'CategoryController@index');
Route::apiResource('vegetation', 'DistributionController');
Route::apiResource('family', 'DistributionController');
Route::apiResource('distribution', 'DistributionController');
Route::apiResource('category', 'CategoryController');

Route::apiResource('repository', 'RepositoryController');

Route::apiResource('user', 'UserController');
