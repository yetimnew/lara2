<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Zone;
use Faker\Generator as Faker;

$factory->define(Zone::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'region_id' => 1,
        'comment' => $faker->word
    ];
});
