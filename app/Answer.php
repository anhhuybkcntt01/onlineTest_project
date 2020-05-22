<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function examination_owner()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
