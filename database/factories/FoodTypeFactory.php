<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Food;
use App\Http\Models\FoodType;
use Faker\Generator as Faker;

$factory->define(FoodType::class, function (Faker $faker) {
    return [
        'food_id' =>  function () {
            // Usar food EXISTENTE ou criar se não houver
            return Food::inRandomOrder()->first()->id ?? factory(Food::class)->create()->id;
        },
        'group' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
        'food_type' => $faker->randomElement(['PÃES E CERAIS', 'LEITE E DERIVADOS', 'FRUTAS', 'VEGETAIS A', 'VEGETAIS B', 'CARNES', 'ARROZ, MASSAS, TUBÉRCULOS', 'LEGUMINOSAS', 'CASTANHAS, SEMENTES']),
    ];
});
