<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $fillable = ['user_id', 'invoice', 'amount', 'status'];

    public static function boot()
    {
        static::creating(function (Payment $payment) {
            $payment->invoice = 'INV-' . time() . '-' . Str::random();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
