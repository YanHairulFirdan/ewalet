<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use App\Models\SubscriptionType;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {

    $type       = factory(SubscriptionType::class);
    $started_at = $faker->dateTimeThisMonth();

    switch ($type->name) {
        case 'Coba Gratis':
        case 'Bulanan':
            $ended_at = Carbon::create($started_at)->addDays(30);
            break;

        default:
            $ended_at = Carbon::create($started_at)->addDays(360);
            break;
    }

    return [
        'user_id'             => factory(User::class),
        'subcription_type_id' => $type,
        'started_at'          => $started_at,
        'ended_at'            => $ended_at
    ];
});
