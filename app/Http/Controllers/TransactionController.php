<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = Transaction::all();

            return datatables()->of($transactions)
                ->addColumn('aksi', function ($transaction) {
                    $html = '<a href="#" class-"btn-xs btn-secondary btn-edit">Edit</a>';
                    $html .= '<button data-rowid="' . $transaction->id . '" class-"btn-xs btn-danger btn-delete">Del</a>';

                    return $html;
                })
                ->editColumn('created_at', function ($transaction) {
                    $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('d-m-Y');

                    return $formattedDate;
                })
                ->editColumn('weight', function ($transaction) {
                    $formattedWeight = $transaction->weight . ' Kg';

                    return $formattedWeight;
                })
                ->editColumn('price_per_kilo', function ($transaction) {
                    $formattedPrice = 'Rp.' . number_format($transaction->price_per_kilo);

                    return $formattedPrice;
                })
                ->editColumn('total_price', function ($transaction) {
                    $formattedTotalPrice = 'Rp.' . number_format($transaction->total_price);

                    return $formattedTotalPrice;
                })
                ->toJson();
        }

        return view('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
