<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text($maxNbChars = 100),
        'diary_id' => $faker->numberBetween($min = 1, $max = 10),
        'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
