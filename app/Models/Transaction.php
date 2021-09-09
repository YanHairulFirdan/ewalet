<?php

namespace App\Models;

use App\Models\Type;
use App\Traits\Filterable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use Filterable;
    protected $fillable = ['user_id', 'buyer', 'weight', 'price_per_kilo', 'total_price', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTotalReport($query)
    {
        return $query->select(
            DB::raw('SUM(weight) as totalWeight'),
            DB::raw('SUM(total_price) as totalIncome')
        );
    }
}
