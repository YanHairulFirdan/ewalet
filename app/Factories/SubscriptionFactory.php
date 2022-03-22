<?php

namespace App\Factories;

use App\Models\Subscription;
use App\Models\Type;
use App\Models\User;

class SubscriptionFactory
{
    public static function freeTrial()
    {
        $startDate = now();

        return auth()->user()->subscription()->create([
            'type_id'    => Type::FREE_TRIAL,
            'started_at' => $startDate,
            'end_at'     => $startDate->addDays(30),
            'status'     => Subscription::STATUS_ACTIVE
        ]);
    }

    public static function paidSubscription($userId, $type, $days)
    {
        $startDate = now();
        $user      = User::find($userId);

        return $user->subscription()->create([
            'type_id'    => $type,
            'started_at' => $startDate,
            'end_at'     => $startDate->addDays($days),
            'status'     => Subscription::STATUS_ACTIVE
        ]);
    }
}
