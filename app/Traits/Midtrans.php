<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Midtrans\Config;

/**
 * For midtrans setup
 */
trait Midtrans
{
    private function setup()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY_API');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY_API');

        Log::info([env('MIDTRANS_SERVER_KEY_API'), env('MIDTRANS_CLIENT_KEY_API')]);
    }

    private function getPriceAmount($midtransResponse)
    {
        return substr(
            $midtransResponse['gross_amount'],
            0,
            strpos($midtransResponse['gross_amount'], '.')
        );
    }

    public function getTransactionStatus($transactionStatus)
    {
        Log::info($transactionStatus);
        if (in_array($transactionStatus, ['pending'])) return 1;

        if (in_array($transactionStatus, ['capture', 'settlement'])) return 2;

        if (in_array($transactionStatus, ['deny', 'cancel'])) return 4;

        if ($transactionStatus == 'expired') return 3;
    }
}
