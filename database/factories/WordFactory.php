<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Word;
use Faker\Generator as Faker;

$factory->define(Word::class, function (Faker $faker) {
    $categories = Category::pluck('id')->toArray();

    $imageSeed = $faker->word();

    return [
        'value' => $faker->word(),
        'category_id' => $faker->randomElement($categories),
        'definition' => $faker->sentence(),
        'image_url' => "https://picsum.photos/seed/$imageSeed/300/300",
    ];
});
