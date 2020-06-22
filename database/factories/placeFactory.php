<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Place;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'woreda_id' => $faker->numberBetween($min = 377, $max = 476),
        'comment' => $faker->word
    ];
});
