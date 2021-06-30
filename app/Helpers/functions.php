<?php

use Illuminate\Database\Eloquent\Model;

function set_redirect_index($offset, $limit, Model $model)
{
    $numberOfRecords = $model->count();
    $startRecord     = ($offset - 1) * $limit;
    $countLimit      = count($model->offset($startRecord)->limit($limit)->orderBy('created_at', 'DESC')->get());

    if (
        $numberOfRecords === ($offset * $limit)
        ||
        $countLimit === 0
    ) {
        $offset = $offset > 1 ? $offset - 1 : $offset;
    }

    return $offset;
}

function store_image($request, $file, $path, $fileName)
{
    $extension = $request->file($file)->getClientOriginalExtension();
    $path      = $request->file($file)->storeAs($path, $fileName . $extension);
}
function delete_image(string $path)
{
    if (file_exists($path)) {
        unlink($path);
    }
}
