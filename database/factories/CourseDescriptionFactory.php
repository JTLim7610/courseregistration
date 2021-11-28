<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CourseDetails;
use Faker\Generator as Faker;

$factory->define(CourseDetails::class, function (Faker $faker) {
    return [
        'capacity' => $faker->numberBetween(100, 250), 
        'date' =>  $faker->dateTimeBetween('now', '+1 years')->format('Y-m-d'), 
        'time' => $faker->time(),
        'price' => $faker->numberBetween(1000, 3000),
        'description' => $faker->realText(1000,5), 
    ];
});
