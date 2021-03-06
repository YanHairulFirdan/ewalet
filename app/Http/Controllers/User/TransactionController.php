<?php

namespace App\Http\Controllers\User;

use App\Exports\Transaction as ExportsTransaction;
use App\Filters\TransactionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\TransactionFilterRequest;
use App\Http\Requests\User\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Alert;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionFilterRequest $request, TransactionFilter $filter)
    {
        if ($request->ajax()) {
            $transactions = Auth::user()->transactions()->filter($filter, $request)
                ->get();

            return datatables()->of($transactions)
                ->addIndexColumn()
                ->editColumn('price_per_kilo', 'Rp.{{$price_per_kilo}}')
                ->editColumn('total_price', 'Rp.{{$total_price}}')
                ->editColumn('weight', '{{$weight}} Kg')
                ->addColumn('Aksi', function ($transaction) {
                    $html = '<button data-id="' . $transaction->id .
                        '" class="btn btn-xs btn-success btn-edit"
                         onclick="crudDataTable.edit(event)">Edit</button>';
                    $html .= '<button data-id="' . $transaction->id .
                        '" class="btn btn-xs btn-danger btn-delete"
                        onclick="crudDataTable.delete(event, ' . "transactions" . ')">Del</button>';

                    return $html;
                })
                ->rawColumns(['Aksi'])
                ->make(true);
        }

        $transactionYears = Transaction::selectRaw('DISTINCT YEAR(created_at) as year')
            ->where('user_id', Auth::id())
            ->groupBy('year')
            ->get();

        return view('user.transaction.index', compact('transactionYears'));
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
    public function store(TransactionRequest $request)
    {
        $validated = $request->validated();

        $transaction = new Transaction($validated);
        $transaction->save();

        // Alert::success('Success Title', 'data has been created');
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
        return TransactionResource::make($transaction);
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
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->except('_token'));
        $transaction->save();

        return new SuccessResource((object)['message' => 'data has been updated', 'class' => 'success']);
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

    public function exportExcel(TransactionFilterRequest $request, TransactionFilter $filter)
    {
        $transaction = Auth::user()
            ->transactions()
            ->select('id', 'buyer', 'weight', 'price_per_kilo', 'total_price', 'created_at')
            ->filter($filter, $request)
            ->get();

        $title  = 'Laporan Transaksi ';
        $title .= $request->filled('month') ? 'Bulan ' . $request->month : '';
        $title .= $request->filled('year') ? ' Tahun ' . $request->year : '';

        return Excel::download(new ExportsTransaction($transaction), $title . '.xlsx');
    }

    public function exportPdf(TransactionFilterRequest $request, TransactionFilter $filter)
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->filter($filter, $request)
            ->select('id', 'buyer', 'weight', 'price_per_kilo', 'total_price', 'created_at')
            ->filter($filter, $request)
            ->get();
        $title  = 'Laporan Transaksi ';
        $title .= $request->filled('month') ? 'Bulan ' . $request->month : '';
        $title .= $request->filled('year') ? ' Tahun ' . $request->year : '';

        // view()->share('employee', $transactions);

        // $pdf = PDF::loadView('user.transaction.export');
        $pdf = PDF::loadView('user.transaction.export', compact('transactions', 'title'));

        // dd($pdf->download($title));

        return $pdf->download($title . '.pdf');
    }
}
