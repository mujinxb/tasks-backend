<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description'
    ];

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('status')->withTimestamps();
    }
}
