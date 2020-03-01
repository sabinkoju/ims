<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{

    use SoftDeletes;

    public function courses(){
        return $this->belongsToMany(Course::class, 'course_teacher');
    }

    public function batches(){
        return $this->belongsToMany(Batch::class, 'teacher_batch');
    }

    public function teacher_category(){
        return $this->belongsTo(TeacherCategory::class);
    }
}
