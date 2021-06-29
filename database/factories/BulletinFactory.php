<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bulletin;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Bulletin::class, function (Faker $faker) {
    return [
        'title'    => Str::random(10),
        'body'     => $faker->text,
        'password' => '1234'
    ];
});
