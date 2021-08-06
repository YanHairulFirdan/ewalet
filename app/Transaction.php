<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'buyer', 'weight', 'price_per_kilo', 'total_price'];

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }
}
