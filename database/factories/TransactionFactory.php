<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Log;

$factory->define(Transaction::class, function (Faker $faker) {
    $weight           = $faker->randomNumber(2);
    $price_per_kilo   = rand(8000000, 10000000);
    $user             = User::query()->inRandomOrder()->first();
    Log::info($user->id);
    return [
        'user_id'        => $user->id,
        'buyer'          => $faker->name,
        'weight'         => $weight,
        'price_per_kilo' => $price_per_kilo,
        'total_price'    => $weight * $price_per_kilo
    ];
});
