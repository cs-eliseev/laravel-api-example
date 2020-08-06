<?php

use Illuminate\Http\Request;
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
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {
    Route::post('auth/login', 'AuthController@login')->name('login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('auth/logout', 'AuthController@logout');

        Route::prefix('clients')->group(function() {
            Route::get('/', 'ClientController@index');
            Route::post('/', 'ClientController@create');
            Route::get('/{id}', 'ClientController@read');
            Route::patch('/{id}', 'ClientController@update');
            Route::delete('/{id}', 'ClientController@delete');
        });

        Route::get('search', 'SearchController@index');
    });
});
