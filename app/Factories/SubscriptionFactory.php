<?php

namespace App\Factories;

use App\Models\Subscription;
use App\Models\Type;

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

    public static function paidSubscription($type, $days)
    {
        $startDate = now();

        return auth()->user()->subscription()->create([
            'type_id'    => $type,
            'started_at' => $startDate,
            'end_at'     => $startDate->addDays($days),
            'status'     => Subscription::STATUS_ACTIVE
        ]);
    }
}
