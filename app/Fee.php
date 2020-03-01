<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
  public function courses(){
        return $this->belongsTo(Course::class, 'course');
    }
    public function students(){
      return $this->belongsTo(Student::class, 'student_id');
  }
}
