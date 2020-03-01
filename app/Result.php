<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id');
    }

}
