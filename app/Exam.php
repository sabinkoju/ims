<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function courses(){
            return $this->belongsTo(Course::class,'course_id');

    }
}
