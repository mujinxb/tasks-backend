<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\User;
use App\Http\Resources\TaskResource;

class TaskUserController extends Controller
{
    public function users(Task $task)
    {
        $taskUsers = $task->users;

        return UserResource::collection($taskUsers);
    }

    public function userTasks(User $user)
    {
        $tasks = $user->tasks;

        return TaskResource::collection($tasks);
    }

    public function unassignedUsers(Task $task)
    {
        $ids = $task->users()->pluck('user_id');

        $unAssignedUsers = User::whereNotIn('id', $ids)->get();

        return UserResource::collection($unAssignedUsers);
    }

    public function assignTask(Request $request, Task $task)
    {
        $data = $request->validate([
            'userIds' => 'required|array'
        ]);

        $users = User::find($data['userIds']);

        $task->users()->syncWithoutDetaching($users);

        return UserResource::collection(collect($users));
    }

    public function unAssignTask(Request $request, Task $task, User $user)
    {
        if ($task->users()->detach($user)) {
            return new UserResource($user);
        } else {
            return response()->json(['Error' => 'Not Found'], 404);
        }
    }
}
