<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use App\Models\Type;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Log;

$factory->define(Subscription::class, function (Faker $faker) {

    $type = Type::inRandomOrder()->first();
    $subscriptionDays = $type->name == 'Coba Gratis' || $type->name == 'Bulanan' ? 30 : 360;

    $started_at = Carbon::now();
    $ended_at   = Carbon::now()->addDays($subscriptionDays);

    Log::info("started at " . $started_at);
    Log::info("ended at " . $ended_at);
    return
        [
            'user_id'    => factory(User::class),
            'type_id'    => $type->id,
            'started_at' => $started_at,
            'end_at'     => $ended_at,
            'status'     => true
        ];
});
