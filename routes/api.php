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
    Route::get('tasks/{task}', 'TasksController@show');
    Route::get('users/{user}/tasks', 'TaskUserController@userTasks');
});

// admin routes
Route::middleware(['auth:api', 'active', 'admin'])->group(function () {
    Route::get('users', 'UsersController@index');
    Route::post('users', 'UsersController@store');
    Route::patch('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@destroy');

    Route::get('tasks', 'TasksController@index');
    Route::post('tasks', 'TasksController@store');

    Route::patch('tasks/{task}', 'TasksController@update');
    Route::delete('tasks/{task}', 'TasksController@destroy');

    Route::get('tasks/{task}/users', 'TaskUserController@users');

    Route::get('tasks/{task}/unassignedusers', 'TaskUserController@unassignedUsers');

    Route::post('tasks/{task}/assigntask', 'TaskUserController@assignTask');
    Route::delete('tasks/{task}/users/{user}', 'TaskUserController@unassignTask');
});
