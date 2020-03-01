<?php

namespace App\Repositories;

use App\Student;
use App\StudentCategory;

class StudentRepository{

    public function student_category_all(){

        return StudentCategory::all();
    }

    public function student_all(){

        return Student::all();
    }




}
