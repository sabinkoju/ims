<?php

namespace App\Providers;

use App\Course;
use App\Policies\CoursePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //  Course::class => CoursePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

       \Gate::define('admin', function ($user){
           return $user->role_id == 1;
       });

       \Gate::define('student', function ($user){
        return $user->role_id == 4;
    });

    \Gate::define('teacher', function ($user){
        return $user->role_id == 3;
    });

    \Gate::define('staff', function ($user){
        return $user->role_id == 2;
    });

    \Gate::define('admin_staff', function ($user){
        return $user->role_id == 1 || $user->role_id === 2 ;
    });

    }
}
