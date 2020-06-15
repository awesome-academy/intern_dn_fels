<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    $courses = \App\Models\Course::pluck('id')->toArray();

    return [
        'name' => $faker->sentence(10),
        'description' => $faker->paragraph(30),
        'course_id' => $faker->randomElement($courses),
    ];
});
