<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    public function room_owner()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function members()
    {
        return $this->belongsToMany(User::class);
    }
    public function createdQuestions()
    {
        return $this->hasMany(Question::class);
    }


}
