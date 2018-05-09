# tasks-backend

## Backend API for -[tasks-app-angular](https://github.com/mujinxb/tasks-app-angular)

Laravel 5.5 used for API development

## API Setup
1. Clone the project

2. Go to the application folder using cd

3. Run composer install on your cmd or terminal

4. Copy .env.example file to .env on root folder

5. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. 

6. Run php artisan migrate

7. serve it

8. Your API is ready!

## Available routes [api.php](https://github.com/mujinxb/tasks-backend/blob/master/routes/api.php)

```php
Route::middleware(['guest'])->post('login', 'AuthController@login');

Route::middleware(['auth:api', 'active'])->group(function () {
    Route::post('logout', 'AuthController@logout');

    // only for admin or for loggedin user having same id
    Route::get('users/{user}', 'UsersController@show');
    Route::get('tasks/{task}', 'TasksController@show');
    Route::get('users/{user}/tasks', 'TaskUserController@userTasks');
    Route::post('users/{user}/tasks/{task}', 'TaskUserController@completeTask');
    // feedback
    Route::get('tasks/{task}/feedbacks', 'FeedbacksController@taskFeedbacks');
    Route::post('tasks/{task}/feedbacks', 'FeedbacksController@createFeedback');
    Route::get('users/{user}/feedbacks', 'FeedbacksController@userFeedbacks');
    Route::delete('feedbacks/{feedback}', 'FeedbacksController@deleteFeedback');
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
```
