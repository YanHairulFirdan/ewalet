<?php

namespace App\Observers\User;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $transaction->user_id = Auth::id();
        $transaction->total_price = intval($transaction->weight) * intval($transaction->price_per_kilo);
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
        // $transaction->weight         = $transaction->weight . ' Kg';
        // $transaction->price_per_kilo = 'Rp.' . number_format($transaction->price_per_kilo);
        // $transaction->total_price    = 'Rp' . number_format($transaction->total_price);
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
