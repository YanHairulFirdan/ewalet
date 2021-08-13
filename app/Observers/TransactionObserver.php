<?php

namespace App\Observers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    /**
     * Handle the Transaction "creating" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function creating(Transaction $transaction)
    {
        Log::info("called from observer");

        $transaction->total_price = $transaction->weight * $transaction->price_per_kilo;
    }
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        //
    }

    public function retrieved(Transaction $transaction)
    {
        $transaction->created_at     = Carbon::createFromFormat('Y-m-d H:i:s', $transaction->created_at)->format('d-m-Y');
        $transaction->weight         = $transaction->weight . ' Kg';
        $transaction->price_per_kilo = 'Rp.' . number_format($transaction->price_per_kilo);
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
