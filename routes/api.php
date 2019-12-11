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


// Ces routes nécessitent l'utilisation d'un Bearer token (JWT) obtenu après le login
Route::middleware(['auth.jwt','auth:api'])->group(function () {
  Route::prefix('event')->group(function () {
    Route::post('create', 'Api\EventApiController@create');
    Route::get('user', 'Api\UserApiController@getAuthUser');
  });

  Route::prefix('location')->group(function () {
    Route::post('create', 'Api\EventApiController@create');
    Route::get('user', 'Api\UserApiController@getAuthUser');
  });

  Route::prefix('user')->group(function () {
    Route::get('logout', 'Api\UserApiController@logout');
    Route::post('{user}', 'Api\UserApiController@update');
    Route::get('me', 'Api\UserApiController@getAuthUser');
    Route::delete('{user}', 'Api\UserApiController@destroy');
    Route::post('{id}', 'Api\UserApiController@restore');
    Route::get('/', 'Api\UserApiController@index');
  });
});

// Route::middleware(['auth.jwt','auth:api'])->prefix('user')->group(function () {
//   Route::get('logout', 'Api\UserApiController@logout');
//   Route::get('user', 'Api\UserApiController@getAuthUser');
//
//   // Route::get('/', 'UserController@index');
//   // Route::get('/{user}', 'UserController@show');
//   // Route::post('/', 'UserController@store');
//   // Route::put('/{user}', 'UserController@update');
//   // Route::delete('/{user}', 'UserController@destroy');
// });


// Ces routes son ouvertes et ne nécessitent pas l'utilisation d'un Bearer token (JWT)
Route::prefix('user')->group(function () {
  Route::post('login', 'Api\UserApiController@login');
  Route::post('register', 'Api\UserApiController@register');
});
