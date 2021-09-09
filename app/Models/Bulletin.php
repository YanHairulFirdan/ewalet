<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Bulletin extends Model
{
    protected $fillable = ['title', 'body', 'password'];

    public function passwordCheck($password, $action)
    {
        if (empty($this->password)) {
            return ['error' => "This message can't {$action}, because this message has no been set password", 'slotName' => 'previousButton'];
        }

        if (strlen($password) != 4) {
            return ['error' => 'Your password must be 4 digit', 'slotName' => 'form'];
        }

        if (!Hash::check($password, $this->password)) {
            return ['error' => 'The password you entered does not match. Please try again', 'slotName' => 'form'];
        }
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = $password ? Hash::make($password) : null;
    }
}
