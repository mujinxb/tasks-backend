## API Endpoints Documentation

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
        }
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
	    }
	]
    ```
 
* **Error Response:**
 
    * **Code:** 401 UNAUTHORIZED
    * **Content:** `{ error : "Unauthorized" }`
    * **Reason:** unautherized, or user is not admin and accessing someone else's info

--------


**Get Single User**

----

Get User information

  

*  **URL:**

`/api/users/:id`

  
*  **Method:**

`GET`


*  **Permisssions:**

authenticated, active user/admin

*  **Data Params:**

None


*  **Success Response:**


    **Code:**  `200`  

    **Content:** 
    `{
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

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** User Not Found  
	OR  
	*  **Code:** 401 UNAUTHORIZED
	*  **Content:**  `{ error : "Unauthorized" }`
	*  **Reason:** unautherized, or user is not admin and accessing someone else's info

--------

**Get All Tasks**

----

Get list of all tasks

  

*  **URL:**

`/api/tasks`

  

*  **Method:**

`GET`

  

*  **Permisssions:**

authenticated, active admin

*  **Data Params:**

None

  

*  **Success Response:**

    **Code:**  `200`  

    **Content:** `[
        {
            "id": [number],
            "title": [string],
            description: [string],
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
    ]`

    **Sample Response:**

    ```
    [
        
        {
            "id": 9,
            "title": "test task single form",
            "description": "test task single form test task single form test task single form test task single form test task single form",
            "created_at": {
                "date": "2018-05-08 07:16:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-08 07:16:57.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 1,
            "title": "First Task modiifed",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "created_at": {
                "date": "2018-04-01 00:00:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-08 06:55:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
    ```


*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** Task Not Found  
	OR  
	*  **Code:** 401 UNAUTHORIZED
	*  **Content:**  `{ error : "Unauthorized" }`
	*  **Reason:** unauthorized, or user is not admin and accessing unassigned task

--------

**Get Single Task**

----

Get Single task information

  

*  **URL:**
    `/api/tasks/:id`

*  **Method:**
    `GET`

*  **Permisssions:**
    authenticated, active admin or user who is assigned this task

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `{
        "id": [number],
        "title": [string],
        description: [string],
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
        "title": "First Task modiifed",
        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
        "created_at": {
            "date": "2018-04-01 00:00:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2018-05-08 06:55:14.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }

    ```

    **Note:** If this resource is accessed by a non-admin user, response will inlcude completed: boolean,   assigned_at: date, completed_at: date fields as well

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** Task Not Found  
	OR  
	*  **Code:** 401 UNAUTHORIZED
	*  **Content:**  `{ error : "Unauthorized" }`
	*  **Reason:** unauthorized, or user is not admin and accessing unassigned task

--------


**Get User Task**

----

Get list of tasks assigned to a specified user

*  **URL:**
    `/api/users/:id/tasks`

*  **Method:**
    `GET`

*  **Permisssions:**
    authenticated, active admin or user

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `[ 
        {
            id: [number],
            title: [string],
            description: [string],
            completed: [boolean],
            assigned_at: {
                date: [string],
                timezone_type: [number],
                timezone: [string]
            },
            completed_at: {
                date: [string],
                timezone_type: [number],
                timezone: [string]
            },
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
        }
    ]`

    **Sample Response:**
    
    ```
    
    [
        {
            "id": 3,
            "title": "this is third one",
            "description": "this is third one description",
            "completed": true,
            "assigned_at": {
                "date": "2018-05-04 09:57:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "completed_at": {
                "date": "2018-05-04 12:51:48.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "created_at": {
                "date": "2018-05-02 11:36:55.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-02 11:36:55.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 1,
            "title": "First Task modiifed",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "completed": false,
            "assigned_at": {
                "date": "2018-05-07 12:04:16.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "completed_at": {
                "date": "2018-05-07 12:04:16.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "created_at": {
                "date": "2018-04-01 00:00:00.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-08 06:55:14.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
    
    ```

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** User Not Found  
	OR  
	*  **Code:** 401 UNAUTHORIZED
	*  **Content:**  `{ error : "Unauthorized" }`
	*  **Reason:** unauthorized, or currenlty authenticated user is not admin and accessing other's tasks

--------


**Mark Task Completed**

----

Mark an specified task as completed for the speificed user

*  **URL:**
    `/api/users/:id/tasks/:id`

*  **Method:**
    `POST`

*  **Permisssions:**
    authenticated, active non-admin user

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `{
            id: [number],
            title: [string],
            description: [string],
            completed: [boolean],
            assigned_at: {
                date: [string],
                timezone_type: [number],
                timezone: [string]
            },
            completed_at: {
                date: [string],
                timezone_type: [number],
                timezone: [string]
            },
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
        "id": 3,
        "title": "this is third one",
        "description": "this is third one description",
        "completed": true,
        "assigned_at": {
            "date": "2018-05-04 09:57:00.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "completed_at": {
            "date": "2018-05-04 12:51:48.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "created_at": {
            "date": "2018-05-02 11:36:55.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2018-05-02 11:36:55.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
    
    ```

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** Task or User Not Found  
	OR  
	*  **Code:** 403
	*  **Content:**  `{ error : "Task Not Assigned" }`
	*  **Reason:** unauthorized, or currenlty authenticated user is and not assigned the specified task

--------


**Get all feedbacks aginst a task**

----

Get the list of all feedbacks agaist a task, if admin user, then return feedbacks by all user otherwise feedbacks by the currently authenticated user

*  **URL:**
    `/api/tasks/:id/feedbacks`

*  **Method:**
    `GET`

*  **Permisssions:**
    authenticated, active user

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `[
        {
            id: [number],
            description: [string],
            completed: [boolean],
            user_id: [number],
            user_naem: [string],
            task_id: [number],
            task_title:,
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
        }
    ]`

    **Sample Response:**
    
    ```
    [
        {
            "id": 58,
            "description": "gdfgdfgdf",
            "user_id": 2,
            "user_name": "John Doe",
            "task_id": 1,
            "task_title": "First Task modiifed",
            "created_at": {
                "date": "2018-05-07 14:50:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-07 14:50:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 57,
            "description": "jhghjghj",
            "user_id": 3,
            "user_name": "ali",
            "task_id": 1,
            "task_title": "First Task modiifed",
            "created_at": {
                "date": "2018-05-07 13:49:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-07 13:49:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
    
    ```

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** Task Not Found  
	OR  
	*  **Code:** 403
	*  **Content:**  `{ error : "Task Not Assigned" }`
	*  **Reason:** unauthorized, or currenlty authenticated user is not admin and not assigned the specified task

--------



**Create feedback aginst a task**

----

Create feedback against a task by currently authenticated user

*  **URL:**
    `/api/tasks/:id/feedbacks`

*  **Method:**
    `POST`

*  **Permisssions:**
    authenticated, active user

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `{
            id: [number],
            description: [string],
            completed: [boolean],
            user_id: [number],
            user_naem: [string],
            task_id: [number],
            task_title:,
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
        "id": 58,
        "description": "gdfgdfgdf",
        "user_id": 2,
        "user_name": "John Doe",
        "task_id": 1,
        "task_title": "First Task modiifed",
        "created_at": {
            "date": "2018-05-07 14:50:50.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2018-05-07 14:50:50.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
    ```

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** Task Not Found  
	OR  
	*  **Code:** 403
	*  **Content:**  `{ error : "Task Not Assigned" }`
	*  **Reason:** unauthorized, or currenlty authenticated user is not assigned the specified task

--------


**Get all feedbacks aginst a task by a user**

----

Get the list of all feedbacks agaist a specified task by the specified user

*  **URL:**
    `/api/users/:id/feedbacks`

*  **Method:**
    `GET`

*  **Permisssions:**
    authenticated, active user

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `[
            {
                id: [number],
                description: [string],
                completed: [boolean],
                user_id: [number],
                user_naem: [string],
                task_id: [number],
                task_title:,
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
            }
        ]`

    **Sample Response:**
    
    ```
    [
        {
            "id": 58,
            "description": "first feedback",
            "user_id": 3,
            "user_name": "ali",
            "task_id": 1,
            "task_title": "First Task modiifed",
            "created_at": {
                "date": "2018-05-07 14:50:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-07 14:50:50.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 57,
            "description": "jhghjghj",
            "user_id": 3,
            "user_name": "ali",
            "task_id": 2,
            "task_title": "second Task",
            "created_at": {
                "date": "2018-05-07 13:49:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-05-07 13:49:17.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
    
    ```

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** user Not Found

--------


**Delete a feedback**

----

Delete a specified feedback

*  **URL:**
    `/api/users/:id/feedbacks`

*  **Method:**
    `GET`

*  **Permisssions:**
    authenticated, active user

*  **Data Params:**
    None

*  **Success Response:**

    **Code:**  `200`   
    **Content:** `{
        id: [number],
        description: [string],
        completed: [boolean],
        user_id: [number],
        user_naem: [string],
        task_id: [number],
        task_title:,
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
        "id": 58,
        "description": "first feedback",
        "user_id": 3,
        "user_name": "ali",
        "task_id": 1,
        "task_title": "First Task modiifed",
        "created_at": {
            "date": "2018-05-07 14:50:50.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2018-05-07 14:50:50.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
    ```

*  **Error Response:**

	*  **Code:** 404
	*  **Content:**
	*  **Reason:** feedback Not Found  
	OR  
	*  **Code:** 403
	*  **Content:**  `{ error : "Feedback not given by the user" }`
	*  **Reason:** unauthorized, or currenlty authenticated user is not admin and Feedback not given by the his/her

--------

