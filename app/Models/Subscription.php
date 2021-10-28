<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'type_id',
        'started_at',
        'end_at',
        'status',
    ];

    const STATUS_ACTIVE     = 1;
    const STATUS_NOT_ACTIVE = 2;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
