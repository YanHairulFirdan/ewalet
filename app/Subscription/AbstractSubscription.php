<?php

namespace App\Subscription;

use Illuminate\Http\Request;

abstract class AbstractSubscription
{
    public $props;

    abstract public function subscribe();
}
