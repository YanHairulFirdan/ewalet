<?php

use Illuminate\Database\Eloquent\Model;

function set_redirect_index($offset, $limit, Model $model)
{
    $numberOfRecords = $model->count();
    $startRecord     = $offset * $limit;
    $countLimit      = count($model->offset($startRecord)->limit($limit)->orderBy('created_at', 'DESC')->get());

    if (
        $numberOfRecords === $startRecord
        ||
        $countLimit === 0
    ) {
        $offset = $offset > 1 ? $offset-- : $offset;
    }

    return $offset;
}
