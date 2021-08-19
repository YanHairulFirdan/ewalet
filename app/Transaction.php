<?php

namespace App;

use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Transaction extends Model
{
    // use HasFactory;
    protected $fillable = ['user_id', 'buyer', 'weight', 'price_per_kilo', 'total_price', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y'
    ];

    public function user()
    {
        return $this->belongsTo(App\User::class);
    }

    // public function type()
    // {
    //     return $this->belongsTo(Type::class);
    // }

    public function getWeightAttribute($weight)
    {
        return $weight;
    }

    public function getPricePerKiloAttribute($value)
    {
        return number_format($value);
    }

    public function getTotalPriceAttribute($value)
    {
        return number_format($value);
    }
}
