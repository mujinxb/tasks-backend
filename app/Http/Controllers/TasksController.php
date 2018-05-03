<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class TasksController extends Controller
{
    /**
     * return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(Task::OrderBy('updated_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2'
        ]);

        $task = Task::create($validatedData);

        return new TaskResource($task);
    }

    /**
     * return the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($this->canAccessTask($task)) {
            return new TaskResource($task);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:2|max:255',
            'description' => 'required|string|min:2'
        ]);

        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];

        if ($task->save()) {
            return new TaskResource($task);
        } else {
            return response()->json(['error' => 'Unprocessable'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['error' => 'Unprocessable'], 422);
        }
    }

    public function canAccessTask($task)
    {
        $user = auth()->user();

        if ($user->isAdmin() || $user->tasks()->where('task_id', $task->id)->exists()) {
            return true;
        }

        return false;
    }
}
