<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'price' => $faker->randomFloat(2, 0, 50),
        'image' => "http://lorempixel.com/400/200/food/",
    ];
});
