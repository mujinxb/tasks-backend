<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'name' => $this->name,
            'email' => $this->email,
            'active' => (bool) $this->active,
            'admin' => (bool) $this->admin,
            'assignedTasksCount' => $this->tasks()->count(),
            'completedTasksCount' => $this->tasks()->where('status', true)->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
