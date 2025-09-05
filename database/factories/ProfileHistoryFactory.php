<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Profile;
use App\Http\Models\ProfileHistory;
use Faker\Generator as Faker;

$factory->define(ProfileHistory::class, function (Faker $faker) {
    return [
            'profile_id' => function () {
                // Usar perfil EXISTENTE ou criar se não houver
                return Profile::inRandomOrder()->first()->id ?? factory(Profile::class)->create()->id;
            },
            'weight_prev' => $faker->randomFloat(2, 50, 150),
            'goal_prev' => $faker->randomFloat(2, 45, 100),
            'metabolism_prev' => $faker->numberBetween(1200, 2500),
            'recorded_at' => $faker->dateTimeBetween('-1 year', 'now'),
    ];
});
