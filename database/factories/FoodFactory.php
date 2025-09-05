<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Food;
use Faker\Generator as Faker;

$factory->define(Food::class, function (Faker $faker) {
    return [
        'food_name' => $faker->word,
        'quantity' => $faker->randomFloat(2, 50, 500),
        'measure_type' => $faker->randomElement(['g', 'ml', 'unidade', 'colher', 'pedaço', 'fatia']),
        'energy_value' => $faker->numberBetween(50, 500),
        'carbohydrates' => $faker->randomFloat(2, 0, 100),
        'sugars' => $faker->randomFloat(2, 0, 50),
        'proteins' => $faker->randomFloat(2, 0, 50),
        'fats' => $faker->randomFloat(2, 0, 30),
        'dietary_fiber' => $faker->randomFloat(2, 0, 20),
        'sodium' => $faker->randomFloat(2, 0, 5),
        'other' => $faker->randomFloat(2, 0, 20),
    ];
});
