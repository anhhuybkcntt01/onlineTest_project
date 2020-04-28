<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
         return $this->belongsToMany(User::class);
    }

}
