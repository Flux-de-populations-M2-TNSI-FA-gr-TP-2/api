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

/* Logs Routes */
Route::prefix('log')->group(function() {
  Route::post('create', 'Api\LogApiController@create');
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
    Route::get('{location}', 'Api\LocationApiController@show')->where('location', '[0-9]+');
    Route::put('{location}', 'Api\LocationApiController@update')->where('location', '[0-9]+');
    Route::delete('{location}', 'Api\LocationApiController@destroy')->where('location', '[0-9]+');
  });

  /* ROOM ROUTES */
  Route::prefix('room')->group(function() {
    Route::get('/', 'Api\RoomApiController@index');
    Route::post('create', 'Api\RoomApiController@create');
    Route::get('{room}', 'Api\RoomApiController@show')->where('room', '[0-9]+');
    Route::put('{room}', 'Api\RoomApiController@update')->where('room', '[0-9]+');
    Route::delete('{room}', 'Api\RoomApiController@destroy')->where('room', '[0-9]+');
  });

   /* Events Routes */
   Route::prefix('event')->group(function() {
     Route::get('/', 'Api\EventApiController@index');
     Route::post('create', 'Api\EventApiController@create');
     Route::get('{event}', 'Api\EventApiController@show')->where('event', '[0-9]+');
     Route::put('{event}', 'Api\EventApiController@update')->where('event', '[0-9]+');
     Route::delete('{event}', 'Api\EventApiController@destroy')->where('event', '[0-9]+');
    });
    Route::prefix('eventgroup')->group(function() {
      Route::get('/', 'Api\EventGroupApiController@index');
      Route::post('create', 'Api\EventGroupApiController@create');
      Route::get('{eventgroup}', 'Api\EventGroupApiController@show')->where('eventgroup', '[0-9]+');
      Route::put('{eventgroup}', 'Api\EventGroupApiController@update')->where('eventgroup', '[0-9]+');
      Route::delete('{eventgroup}', 'Api\EventGroupApiController@destroy')->where('eventgroup', '[0-9]+');
     });

    /* Logs Routes */
    Route::prefix('log')->group(function() {
      Route::get('/', 'Api\LogApiController@index');
      Route::get('{log}', 'Api\LogApiController@show')->where('log', '[0-9]+');
      Route::put('{log}', 'Api\LogApiController@update')->where('log', '[0-9]+');
      Route::delete('{log}', 'Api\LogApiController@destroy')->where('log', '[0-9]+');
     });

    /* USER ROUTES */
    Route::prefix('user')->group(function () {
      Route::get('/', 'Api\UserApiController@index');
      Route::get('{user}', 'Api\UserApiController@show')->where('user', '[0-9]+');
      Route::put('{user}', 'Api\UserApiController@update')->where('user', '[0-9]+');
      Route::delete('{user}', 'Api\UserApiController@destroy')->where('user', '[0-9]+');
      Route::post('{id}', 'Api\UserApiController@restore')->where('id', '[0-9]+');
      Route::get('logout', 'Api\UserApiController@logout');
      Route::get('me', 'Api\UserApiController@getAuthUser');
    });
});
