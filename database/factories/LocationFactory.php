<?php

$factory->define(\App\Models\Location::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->city
    ];
});