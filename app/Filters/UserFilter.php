<?php

namespace App\Filters;

use App\Contracts\Filter;

class UserFilter extends Filter
{
    public function month($value)
    {
        return $this->query->whereRaw("MONTHNAME(users.created_at) = '{$value}'");
    }

    public function year($value)
    {
        return $this->query->whereRaw("YEAR(users.created_at) = '{$value}'");
    }

    public function status($value)
    {
        return $this->query->whereHas('subscription', function ($query) use ($value) {
            $query->where('status', $value);
        });
    }
}
