<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TaskResource extends Resource
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
            'title' => $this->title,
            'description' => $this->description,
            $this->mergeWhen(isset($this->pivot), [
                'completed' => (bool) @$this->pivot->status,
                'assigned_at' => @$this->pivot->created_at,
                'completed_at' => @$this->pivot->updated_at,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
