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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::middleware('auth.jwt')->prefix('user')->group(function () {
  Route::get('logout', 'Api\UserApiController@logout');
  Route::get('user', 'Api\UserApiController@getAuthUser');

  // Route::get('/', 'UserController@index');
  // Route::get('/{user}', 'UserController@show');
  // Route::post('/', 'UserController@store');
  // Route::put('/{user}', 'UserController@update');
  // Route::delete('/{user}', 'UserController@destroy');
});

Route::prefix('user')->group(function () {
  Route::post('login', 'Api\UserApiController@login');
  Route::post('register', 'Api\UserApiController@register');
});
