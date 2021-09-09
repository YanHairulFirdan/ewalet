<?php

namespace App\Filters;

use App\Contracts\Filter;

class TransactionFilter extends Filter
{
    public function month($value)
    {
        return $this->query->whereRaw("MONTHNAME(created_at) = '{$value}'");
    }

    public function year($value)
    {
        return $this->query->whereRaw("YEAR(created_at) = '{$value}'");
    }
}
