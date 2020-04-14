<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'diary_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
