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

## API Endpoints Docs

**Login**
----
Login a user

* **URL:**
    `/api/login`

* **Method:**
  `POST`

* **Permisssions:**
    guest: unauthenticated user 
  
* **Data Params:**
    `{
        email: [string], 
        password: [string]
    }`

* **Success Response:**
  
    **Code:** `200`  
    **Content:** `{
        id: [number],
        name: [string],
        token: [string],
        isAuthenticated: [boolean],
        isAdmin: [boolean]
    }`
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED  
  * **Content:** `{ error : "Unauthorized" }`
  * **Reason:** email/password mismatch, not found

--------

**Logout**
----
Logout an authenticated user

* **URL:**
    `/api/logout`

* **Method:**
  `POST`

* **Permisssions:**
    authenticated, active user/admin 
  
* **Data Params:**
    None

* **Success Response:**
  
    **Code:** `200`  
    **Content:**  `{ message : 'Successfully logged out' }`
 
* **Error Response:**

  * **Code:** 401 UNAUTHORIZED
  * **Content:** `{ error : "Unauthorized" }`
  * **Reason:** unactuenticated, inactive user/admin

--------

**Get All Users**
----
Get list of all users
* **URL:**
    `/api/users`

* **Method:**
  `GET`

* **Permisssions:**
   authenticated, active admin
  
* **Data Params:**
    None

* **Success Response:**
  
    **Code:** `200`
    **Content:**  
    `[
    {
        id: [number],
        name: [string],
        email: [string],
        active: [boolean],
        admin: [boolean],
        assignedTasksCount: [number],
        completedTasksCount: [number],
        created_at: {
            date: [string],
            timezone_type: [number],
            timezone: [string]
        },
        updated_at: {
            date: [string],
            timezone_type: [number],
            timezone: [string]
        }
    },
    ....
   ]`

    **Sample Response:** 
    ``` 
    [
	    {
	        "id": 2,
	        "name": "John Doe",
	        "email": "jhonny@tm.com",
	        "active": true,
	        "admin": false,
	        "assignedTasksCount": 2,
	        "completedTasksCount": 1,
	        "created_at": {
	            "date": "2018-05-02 07:05:27.000000",
	            "timezone_type": 3,
	            "timezone": "UTC"
	        },
	        "updated_at": {
	            "date": "2018-05-08 08:20:24.000000",
	            "timezone_type": 3,
	            "timezone": "UTC"
	        }
	    },
	    {
	        "id": 3,
	        "name": "ali",
	        "email": "ali@tm.com",
	        "active": true,
	        "admin": false,
	        "assignedTasksCount": 1,
	        "completedTasksCount": 0,
	        "created_at": {
	            "date": "2018-05-02 07:06:05.000000",
	            "timezone_type": 3,
	            "timezone": "UTC"
	        },
	        "updated_at": {
	            "date": "2018-05-04 09:39:30.000000",
	            "timezone_type": 3,
	            "timezone": "UTC"
	        }
	    },
	    ...
	]
    ```
 
* **Error Response:**
 
    * **Code:** 401 UNAUTHORIZED
    * **Content:** `{ error : "Unauthorized" }`
    * **Reason:** unautherized, or user is not admin and accessing someone else's info

--------

**Get User**
----
Get User info

* **URL:**
    `/api/user/:id`

* **Method:**
  `GET`

* **Permisssions:**
   authenticated, active user/admin
  
* **Data Params:**
    None

* **Success Response:**
  
    **Code:** `200`
    **Content:** `{
        id: [number],
        name: [string],
        email: [string],
        active: [boolean],
        admin: [boolean],
        assignedTasksCount: [number],
        completedTasksCount: [number],
        created_at: {
            date: [string],
            timezone_type: [number],
            timezone: [string]
        },
        updated_at: {
            date: [string],
            timezone_type: [number],
            timezone: [string]
        }
    }`

    **Sample Response:** 
    ```
    {
        "id": 1,
        "name": "Muajhid",
        "email": "mujahid@tm.com",
        "active": true,
        "admin": true,
        "assignedTasksCount": 0,
        "completedTasksCount": 0,
        "created_at": {
            "date": "2018-04-01 00:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2018-04-01 00:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
    ```
 
* **Error Response:**
    * **Code:** 404
    * **Content:** 
    * **Reason:** User Not Found  
    OR  
    * **Code:** 401 UNAUTHORIZED
    * **Content:** `{ error : "Unauthorized" }`
    * **Reason:** unautherized, or user is not admin and accessing someone else's info

--------
