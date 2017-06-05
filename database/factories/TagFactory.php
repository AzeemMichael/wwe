<?php

$factory->define(\App\Models\Tag::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->unique()->monthName,
    ];
});