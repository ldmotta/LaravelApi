<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Pastel;
use Faker\Generator as Faker;

$factory->define(Pastel::class, function (Faker $faker) {
    return [
        'nome' => $faker->unique()->word,
        'preco' => $faker->randomFloat(2, 0, 50),
        'foto' => "http://lorempixel.com/400/200/food/",
    ];
});
