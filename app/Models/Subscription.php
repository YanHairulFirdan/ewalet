<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Subscription extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($value)
    {
        return $value ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>';
    }
}
