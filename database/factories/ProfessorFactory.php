<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Professor;
use Faker\Generator as Faker;

$factory->define(Professor::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
        'user_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});
