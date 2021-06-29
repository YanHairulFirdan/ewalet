<?php

use Illuminate\Database\Eloquent\Model;

function set_redirect_index($currentPage, $perPage, Model $model)
{
    $numberOfRecords = $model->count();
    $countLimit      = $model->offset($currentPage)->limit($perPage)->count();

    if (
        $numberOfRecords === ($currentPage * $perPage)
        ||
        $countLimit === 0
    ) {
        $currentPage = $currentPage > 1 ? $currentPage - 1 : $currentPage;
    }

    return $currentPage;
}
