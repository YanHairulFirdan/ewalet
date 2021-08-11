<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'user_id'             => factory(App\User::class),
        'subcription_type_id' => factory(App\Models\SubscriptionType::class),
    ];
});
