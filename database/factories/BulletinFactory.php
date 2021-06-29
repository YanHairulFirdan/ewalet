<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bulletin;
use Faker\Generator as Faker;

$factory->define(Bulletin::class, function (Faker $faker) {
    return [
        'title'    => $faker->text(10),
        'body'     => $faker->text(),
        'password' => $faker->text(4),
    ];
});
