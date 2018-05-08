<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\User;
use App\Task;

class FeedbackResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'user_name' => User::find($this->user_id)->name,
            'task_id' => $this->task_id,
            'task_title' => Task::find($this->task_id)->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
