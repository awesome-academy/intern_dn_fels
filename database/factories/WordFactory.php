<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Word;
use Faker\Generator as Faker;

$factory->define(Word::class, function (Faker $faker) {
    $categories = Category::pluck('id')->toArray();

    return [
        'value' => $faker->word(),
        'category_id' => $faker->randomElement($categories),
    ];
});
