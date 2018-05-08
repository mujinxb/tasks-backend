<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Resources\FeedbackResource;
use App\User;
use App\Feedback;

class FeedbacksController extends Controller
{
    public function taskFeedbacks(Task $task)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $feedbacks = $task->feedbacks()->OrderBy('created_at', 'desc')->get();
        } elseif ($task->users()->where('user_id', $user->id)->exists()) {
            $feedbacks = $user->feedbacks()->where('task_id', $task->id)->OrderBy('created_at', 'desc')->get();
        } else {
            return response()->json(['error' => 'Task no assigned!'], 403);
        }

        return FeedbackResource::collection($feedbacks);
    }

    public function userFeedbacks(User $user)
    {
        $feedbacks = $user->feedbacks()->OrderBy('created_at', 'desc')->get();

        return FeedbackResource::collection($feedbacks);
    }

    public function createFeedback(Request $request, Task $task)
    {
        $feedbackData = $request->validate([
            'description' => 'required|string|min:2'
        ]);

        $user = auth()->user();

        if (!$task->users()->where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Task not assigned!'], 403);
        }

        $feedbackData['user_id'] = $user->id;

        $feedback = $task->feedbacks()->create($feedbackData);

        return new FeedbackResource($feedback);
    }

    public function deleteFeedback(Feedback $feedback)
    {
        if ($this->canAccessFeedback($feedback)) {
            $feedback->delete();

            return response()->json($feedback, 200);
        }

        return response()->json(['error' => 'Feedback not provided!'], 403);
    }

    public function canAccessFeedback($feedback)
    {
        $user = auth()->user();

        if ($user->isAdmin() || $user->feedbacks()->where('feedback.id', $feedback->id)->exists()) {
            return true;
        }

        return false;
    }
}
