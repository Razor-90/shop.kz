<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->realText(rand(150, 200)),
        'slug' => Str::slug($faker->name),
        //
    ];
});
