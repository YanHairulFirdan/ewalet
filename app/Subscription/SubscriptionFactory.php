<?php

namespace App\Subscription;

class SubscriptionFactory
{
    private static $subscriptionType = [
        'paid'  => PaidSubscription::class,
        'trial' => TrialSubscription::class
    ];

    public static function make($type = 'trial')
    {
        try {
            return new static::$subscriptionType[$type](request());
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
