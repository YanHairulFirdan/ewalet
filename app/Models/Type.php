<?php

namespace App\Models;

use App\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // use HasFactory;
    const FREE_TRIAL = 1;
    const MONTHLY    = 2;
    const YEARLY     = 3;

    protected $fillable = ['name', 'price', 'subscription_days'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
