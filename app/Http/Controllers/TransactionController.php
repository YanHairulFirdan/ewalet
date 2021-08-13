<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $transactions = Transaction::where('user_id', Auth::id())->get();
            $datatables =  datatables()->of($transactions)
                ->addIndexColumn()
                // ->editColumn('created_at', function ($transaction) {
                //     $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('d-m-Y');

                //     return $formattedDate;
                // })
                // ->editColumn('weight', function ($transaction) {
                //     $formattedWeight = $transaction->weight . ' Kg';

                //     return $formattedWeight;
                // })
                // ->editColumn('price_per_kilo', function ($transaction) {
                //     $formattedPrice = 'Rp.' . number_format($transaction->price_per_kilo);

                //     return $formattedPrice;
                // })
                // ->editColumn('total_price', function ($transaction) {
                //     $formattedTotalPrice = 'Rp.' . number_format($transaction->total_price);

                //     return $formattedTotalPrice;
                // })
                ->addColumn('Aksi', function ($transaction) {
                    $html = '<button href="#" data-id="' . $transaction->id . '" class="btn btn-xs btn-success btn-edit">Edit</button>';
                    $html .= '<button data-id="' . $transaction->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';

                    return $html;
                })
                ->rawColumns(['Aksi']);

            return $datatables->make(true);
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
        $request->validate([
            'buyer'          => 'required|min:3',
            'weight'         => 'required|numeric',
            'price_per_kilo' => 'required|numeric',
        ]);

        $totalPrice = $request->weight * $request->price_per_kilo;

        $transaction = new Transaction($request->except('_token'));
        $transaction->user_id = Auth::id();
        $transaction->total_price = $totalPrice;
        $transaction->save();

        return response()->json(['message' => 'data has been created', 'class' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return response()->json(['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
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
        // return response()->json(['request' => $request->except('_token')]);
        $request->validate([
            'buyer'          => 'required|min:3',
            'weight'         => 'required|numeric',
            'price_per_kilo' => 'required|numeric',
        ]);

        $totalPrice = $request->weight * $request->price_per_kilo;

        $transaction->update($request->except('_token'));
        $transaction->user_id = Auth::id();
        $transaction->total_price = $totalPrice;
        $transaction->save();

        return response()->json(['message' => 'data has been updated', 'class' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        $result = $transaction->delete();

        return response()->json(['message' => 'transaction has been deleted', 'class' => 'success', 'result' => $result]);
    }
}
