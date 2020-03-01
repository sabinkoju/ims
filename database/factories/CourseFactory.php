<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'code' => $faker->userName,
        'slug' => str_slug($name),
        'duration' => rand(10,90),
        'fees' => rand(2000,10000),
        'description' => $faker->sentence,
        'status' => rand(0,1)
    ];
});
