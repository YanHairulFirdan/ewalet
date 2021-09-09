<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

abstract class Filter
{
    protected $query;

    public function apply(Builder $query, FormRequest $request)
    {
        $this->query = $query;

        foreach ($request->validated() as $name => $value) {
            if ($request->filled($name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }
    }
}
