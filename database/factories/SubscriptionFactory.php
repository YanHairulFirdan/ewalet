<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use App\Models\Type;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {

    $type = Type::inRandomOrder()->first();
    $now  = Carbon::now();
    switch ($type->name) {
        case 'Coba Gratis':
        case 'Bulanan':
            $ended_at = $now->addDays(30);
            break;

        default:
            $ended_at = $now->addDays(360);
            break;
    }

    return [
        'user_id'             => factory(User::class),
        'type_id'             => $type->id,
        'started_at'          => $now,
        'end_at'              => $ended_at,
        'status'              => true
    ];
});
