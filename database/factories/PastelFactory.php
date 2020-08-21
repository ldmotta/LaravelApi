<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Pastel;
use Faker\Generator as Faker;

$factory->define(Pastel::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'price' => $faker->randomFloat(2, 0, 50),
        'image' => "http://lorempixel.com/400/200/food/",
    ];
});
