<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $weight         = $faker->randomNumber(2);
    $price_per_kilo = rand(8000000, 10000000);

    return [
        'user_id'        => factory(\App\Models\User::class),
        'buyer'          => $faker->name,
        'weight'         => $weight,
        'price_per_kilo' => $price_per_kilo,
        'total_price'    => $weight * $price_per_kilo,
    ];
});
