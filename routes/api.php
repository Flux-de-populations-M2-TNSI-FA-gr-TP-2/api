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

// Ces routes son ouvertes et ne nécessitent pas l'utilisation d'un Bearer token (JWT)
Route::prefix('user')->group(function () {
  Route::post('login', 'Api\UserApiController@login');
  Route::post('register', 'Api\UserApiController@register');
});

// Ces routes nécessitent l'utilisation d'un Bearer token (JWT) obtenu après le login
Route::middleware(['auth.jwt','auth:api'])->group(function () {
  Route::prefix('event')->group(function () {
    Route::post('create', 'Api\EventApiController@create');
    Route::get('user', 'Api\UserApiController@getAuthUser');
  });

  /* LOCATION ROUTES */
  Route::prefix('location')->group(function () {
    Route::get('all', 'Api\LocationApiController@index');
    Route::post('create', 'Api\LocationApiController@create');
    Route::post('update/{id}', 'Api\LocationApiController@update');
    Route::post('delete/{id}', 'Api\LocationApiController@delete');
  });

  /* ROOM ROUTES */
  Route::prefix('room')->group(function() {
    Route::get('all', 'Api\RoomApiController@index');
    Route::post('create', 'Api\RoomApiController@create');
    Route::post('update/{id}', 'Api\RoomApiController@update');
    Route::post('delete/{id}', 'Api\RoomApiController@delete');
  });

  Route::prefix('user')->group(function () {
    Route::get('/', 'Api\UserApiController@index');
    Route::get('logout', 'Api\UserApiController@logout');
    Route::post('{user}', 'Api\UserApiController@update');
    Route::delete('{user}', 'Api\UserApiController@destroy');
    Route::post('{id}', 'Api\UserApiController@restore');
    Route::get('me', 'Api\UserApiController@getAuthUser');
  });
});
