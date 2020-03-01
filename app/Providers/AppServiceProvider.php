<?php

namespace App\Providers;

use App\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\StudentRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer(['admin.*'], function($view){
            $view->with('site', SiteSetting::first());
        });

        View::composer(['admin.*'], function($view){
            $view->with('link', "http://localhost:8888/greencomputing/ims");
        });

        $this->app->bind(
            StudentRepository::class
        );


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

    }
}
