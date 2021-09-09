<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class Transaction implements FromCollection
{
    private $request;

    public function __construct(Request $request)
    {
        $this->$request = $request;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
    }
}
