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

// implicit inject Article instance in our methods and return 404 if it isn't found
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('articles', 'ArticleController@index');
    
    Route::get('articles/{article}', 'ArticleController@show');
    
    Route::post('articles', 'ArticleController@store');
    
    Route::put('articles/{article}', 'ArticleController@update');
    
    Route::delete('articles/{article}', 'ArticleController@delete');
});

Route::post('register', 'Auth\RegisterController@register');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout');