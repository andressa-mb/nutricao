<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            // Usar usuário EXISTENTE ou criar se não houver
            return User::inRandomOrder()->first()->id ?? factory(User::class)->create()->id;
        },
        'birthday' => $faker->dateTimeBetween('-60 years', '-18 years'),
        'weight' => $faker->randomFloat(2, 50, 150),
        'height' => $faker->randomFloat(2, 1.50, 2.10),
        'goal' => $faker->randomFloat(2, 45, 100),
        'metabolism' => $faker->numberBetween(1200, 2500),
    ];
});
