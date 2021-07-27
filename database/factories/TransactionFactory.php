<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'buyer' => $faker->name,
        'weight' => $faker->randomFloat(),
        'price_per_kilo' => rand(8000000, 10000000),
    ];
});
