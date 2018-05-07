<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\User;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;

class TaskUserController extends Controller
{
    public function users(Task $task)
    {
        $taskUsers = $task->users;

        return UserResource::collection($taskUsers);
    }

    public function userTasks(User $user)
    {
        if (Gate::denies('userAccess', $user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $tasks = $user->tasks;

        return TaskResource::collection($tasks);
    }

    public function unassignedUsers(Task $task)
    {
        $ids = $task->users()->pluck('user_id');

        $unAssignedUsers = User::whereNotIn('id', $ids)->where('admin', false)->get();

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

    public function completeTask(Request $request, User $user, Task $task)
    {
        if ($user->tasks()->where('task_id', $task->id)->exists()) {
            $result = $user->tasks()->updateExistingPivot($task->id, ['status' => 1]);

            return response()->json($result, 200);
        } else {
            return response()->json(['Error' => 'Not Assigned'], 403);
        }
    }
}
