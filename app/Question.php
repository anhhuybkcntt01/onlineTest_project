<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function examination_owner()
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }

    public function createdAnswers(){
        return $this->hasMany(Answer::class);
    }
}
