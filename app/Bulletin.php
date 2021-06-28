<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $fillable = ['title', 'body', 'password'];

    public function passwordCheck($password, $mode)
    {
        if (empty($this->password)) {
            return ['error' => "This message can't {$mode}, because this message has no been set password", 'slotName' => 'previousButton'];
        }

        if (strlen($password) != 4) {
            return ['error' => 'Your password must be 4 digit', 'slotName' => 'form'];
        }

        if ($this->password !== $password) {
            return ['error' => 'The password you entered does not match. Please try again', 'slotName' => 'form'];
        }
    }
}
