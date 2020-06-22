<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Woreda;
use Faker\Generator as Faker;

$factory->define(Woreda::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'zone_id' => 1,
        'comment' => $faker->word
    ];
});
