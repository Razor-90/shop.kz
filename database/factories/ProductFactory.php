<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'category_id' => rand(1, 4),
        'brand_id' => rand(1, 4),
        'name' => $faker->name,
        'content' => $faker->realText(rand(400, 500)),
        'slug' => Str::slug($faker->name),
        'price' => rand(1000, 2000),
    ];
});
