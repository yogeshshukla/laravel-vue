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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
    Route::post('/post/create', 'PostController@store');
    Route::get('/post/edit/{id}', 'PostController@edit');
    Route::post('/post/update/{id}', 'PostController@update');
    Route::delete('/post/delete/{id}', 'PostController@delete');
    Route::get('/posts', 'PostController@index');
});