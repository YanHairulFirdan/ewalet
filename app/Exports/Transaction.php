<?php

namespace App\Exports;

use App\Contracts\Filter;
use Maatwebsite\Excel\Concerns\FromCollection;
// use App\Models\Transaction as TransactionModel;
use App\Models\Transaction as Model;
use Illuminate\Foundation\Http\FormRequest;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Transaction implements FromCollection, WithHeadings
{
    // use Exportable;

    private $transaction;


    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->transaction;
    }

    public function headings(): array
    {
        return [
            'no',
            'Pembeli',
            'Berat',
            'Harga Perkilogram',
            'Pendapatan',
            'Tanggal Transaksi'
        ];
    }
}
