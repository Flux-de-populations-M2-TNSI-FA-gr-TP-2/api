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
Route::middleware(['webMiddleware:api'])->prefix('user')->group(function () {
  Route::post('login', 'Api\UserApiController@login');
  Route::post('register', 'Api\UserApiController@create');
});

/* SENSORS ROUTES */
Route::prefix('sensors')->group(function () {
  Route::get('/', 'Api\SensorsApiController@index');
});

// Ces routes nécessitent l'utilisation d'un Bearer token (JWT) obtenu après le login
Route::middleware(['auth.jwt','auth:api'])->group(function () {
  /* LOCATION ROUTES */
  Route::prefix('location')->group(function () {
    Route::get('/', 'Api\LocationApiController@index');
    Route::post('create', 'Api\LocationApiController@create');
    Route::get('{location}', 'Api\LocationApiController@show');
    Route::put('{location}', 'Api\LocationApiController@update');
    Route::delete('{location}', 'Api\LocationApiController@destroy');
  });

  /* ROOM ROUTES */
  Route::prefix('room')->group(function() {
    Route::get('/', 'Api\RoomApiController@index');
    Route::post('create', 'Api\RoomApiController@create');
    Route::get('{room}', 'Api\RoomApiController@show');
    Route::put('{room}', 'Api\RoomApiController@update');
    Route::delete('{room}', 'Api\RoomApiController@destroy');
  });

   /* Events Routes */
   Route::prefix('event')->group(function() {
     Route::get('/', 'Api\EventApiController@index');
     Route::post('create', 'Api\EventApiController@create');
     Route::get('{event}', 'Api\EventApiController@show');
     Route::put('{event}', 'Api\EventApiController@update');
     Route::delete('{event}', 'Api\EventApiController@destroy');
    });

    /* USER ROUTES */
    Route::prefix('user')->group(function () {
      Route::get('/', 'Api\UserApiController@index');
      Route::get('{user}', 'Api\EventApiController@show');
      Route::put('{user}', 'Api\UserApiController@update');
      Route::delete('{user}', 'Api\UserApiController@destroy');
      Route::post('{id}', 'Api\UserApiController@restore');
      Route::get('logout', 'Api\UserApiController@logout');
      Route::get('me', 'Api\UserApiController@getAuthUser');
    });
});
