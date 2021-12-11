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
        // dd(class_exists('PaidSubscription'));
        $this->assertEquals($subscription, SubscriptionFactory::make($type));
        // $this->assertClassHasAttribute('props', 'App\Subscription\PaidSubscription');
    }

    public function testCreatTrialSubsription()
    {
        $type = 'trial';
        $subscription = new TrialSubscription();
        $this->assertEquals($subscription, SubscriptionFactory::make($type));
    }
}
