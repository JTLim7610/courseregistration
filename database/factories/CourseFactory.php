<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\CourseDetails;
use App\Models\Courses;
use Faker\Generator as Faker;

$factory->define(Courses::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->words(3, true)), 
        'code' => $faker->bothify('?###??##'), 
        'course_details_id' => CourseDetails::all(['id'])->random()
    ];
});