<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class SubscriptionController extends Controller
{
    public function index()
    {
        $types = Type::get();

        $clientKey = env('MIDTRANS_CLIENT_KEY');

        return view('user.subscription', compact('types', 'clientKey'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'type' => 'required|exists:types,id'
        ]);

        $amount = Type::find($request->type)->price;

        $payment = Payment::crete([
            'user_id' => Auth::id(),
            'amount'  =>  $amount
        ]);

        Log::info("auth id " . Auth::id());
        Log::info("payment id " . $payment->id);

        return response()->json([
            'user_id' => Auth::id(),
            'payment_id' => $payment->id
        ]);

        $transaction = [
            'transaction_details' => [
                'order_id'     => $payment->id,
                'gross_amount' => $amount
            ]
        ];

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

        $snapToken = Snap::getSnapToken($transaction);

        return response()->json(['token' => $snapToken]);
    }

    public function paymentfinished(Request $request)
    {
        Log::info("request : " . $request);

        return redirect('/');
    }
}
