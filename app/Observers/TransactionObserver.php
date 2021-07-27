<?php

namespace App\Observers;

use App\Transaction;

class TransactionObserver
{
    /**
     * Handle the transaction "creating" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function creating(Transaction $transaction)
    {
        $transaction->total_price = $transaction->weight * $transaction->price_per_kilo;
    }
    /**
     * Handle the transaction "created" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "updated" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "deleted" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function deleted(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "restored" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function restored(Transaction $transaction)
    {
        //
    }

    /**
     * Handle the transaction "force deleted" event.
     *
     * @param  \App\transaction  $transaction
     * @return void
     */
    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
