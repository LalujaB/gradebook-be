<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Diary;
use Faker\Generator as Faker;

$factory->define(Diary::class, function (Faker $faker) {
    return [
        'title' => $faker->numerify('Razred ##'),
        'professor_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
