<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function getLatestCourseNumber(){
        $course_no = 1;
        $row = self::orderBy('id', 'DESC')->first();
        $course_new = (is_null($row)) ? 'COURSE-'.$course_no : 'COURSE-'.((int)(
            str_replace("COURSE-", "", $row->code)
            ) + 1);
        return $course_new;
    }

    public function batches(){
        return $this->belongsToMany(Batch::class, 'batch_course');
    }

     public function fees(){
        return $this->belongsTo(Fee::class, 'courses');

    }
    public function students(){
        return $this->belongsToMany(Student::class, 'course_student');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class, 'course_teacher');
    }
}
