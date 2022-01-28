<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use App\Models\Type;
use App\Models\User as ModelsUser;
use App\User;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    $type = (Type::inRandomOrder()->first())->price;
    return [
        'user_id' => factory(ModelsUser::class),
        'amount' => $type,
    ];
});
