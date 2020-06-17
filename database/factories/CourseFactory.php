<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(6),
        'code' => $faker->word(),
        'description' => $faker->paragraph(20),
        'category_id' => $faker->randomElement(Category::pluck('id')->toArray()),
    ];
});
