<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;

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
//     return $request->user();
// });

Route::middleware(['guest'])->post('login', 'AuthController@login');

Route::middleware(['auth:api', 'active'])->group(function () {
    Route::post('logout', 'AuthController@logout');
    Route::get('me', 'AuthController@me');
    Route::post('refresh', 'AuthController@refresh');

    // only for admin or for loggedin user having same id
    Route::get('users/{user}', 'UsersController@show');
});

// admin routes
Route::middleware(['auth:api', 'active', 'admin'])->group(function () {
    Route::post('users', 'UsersController@store');
    Route::get('users', 'UsersController@index');
    Route::patch('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@destroy');
});
