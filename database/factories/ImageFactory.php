<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl(640, 480, 'image', true),
        'img_id' => $faker->uuid,
        'img_parent' => $faker->randomElement(['food', 'user']),
    ];
});
