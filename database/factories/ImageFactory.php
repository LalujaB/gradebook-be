<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 640, $height = 480, 'people'),
        'professor_id' => $faker->numberBetween($min = 1, $max = 10),
        'student_id' => $faker->numberBetween($min = 1, $max = 30),

    ];
});
