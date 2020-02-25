<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5, 10)), '.'),
        'body' => $faker->paragraphs(rand(3, 7), true),
        'views' => $faker->randomDigit(0.1)
        //'answers_count' => $faker->randomDigit(0.10),
        //'votes_count' => $faker->randomDigit(-3.1)
    ];
});