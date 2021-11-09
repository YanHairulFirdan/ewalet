<?php

namespace Tests\Unit;

use App\Subscription\PaidSubscription;
use App\Subscription\SubscriptionFactory;
use App\Subscription\TrialSubscription;
use PHPUnit\Framework\TestCase;

class SubscriptionFactoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreatPaidSubsription()
    {
        $type = 'paid';
        $subscription = new PaidSubscription();
        $this->assertEquals($subscription, SubscriptionFactory::make($type));
    }

    public function testCreatTrialSubsription()
    {
        $type = 'trial';
        $subscription = new TrialSubscription();
        $this->assertEquals($subscription, SubscriptionFactory::make($type));
    }
}
