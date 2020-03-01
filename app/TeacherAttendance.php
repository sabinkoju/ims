<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
