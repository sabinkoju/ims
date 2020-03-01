<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Student extends Model
{
    //
    use SoftDeletes;

    public function student_category(){
        return $this->belongsTo(StudentCategory::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class, 'course_student');
    }

    public function sections(){
        return $this->belongsTo(Section::class,'section_id');
    }
    public function batches(){
        return $this->belongsTo(Batch::class, 'batch_id');
    }


}
