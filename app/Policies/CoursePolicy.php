<?php

namespace App\Policies;

use App\Course;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

//    public function addCourse(User $user){
//        return $user->role_id === 1;
//    }


}
