<?php

namespace App\Traits;

use App\Contracts\Filter;

/**
 * For custom filter model
 */
trait Filterable
{
    public function scopeFilter($query, Filter $filter, $request)
    {
        return $filter->apply($query, $request);
    }
}
