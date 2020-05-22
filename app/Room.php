<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
         return $this->belongsToMany(User::class)
         ->using(RoomUser::class);
    }
    public function createdExams()
    {
        return $this->hasMany(Examination::class);
    }

}
