<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use App\Models\Type;
use App\User;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    $type = (Type::inRandomOrder()->first())->id;
    return [
        'user_id' => factory(User::class),
        'type_id' => $type,
    ];
});
