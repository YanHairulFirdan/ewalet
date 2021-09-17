<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transaction;
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

        Log::channel('errorlog')->info("called in heroku");

        $clientKey = env('MIDTRANS_CLIENT_KEY');

        return view('user.subscription', compact('types', 'clientKey'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'type' => 'required|exists:types,id'
        ]);

        $type             = Type::find($request->type);
        $price            = $type->price;
        $subscriptionDays = $type->subscription_days;

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'amount'  =>  $price
        ]);

        $transaction = [
            'transaction_details' => [
                'order_id'          => $payment->id,
                'gross_amount'      => $price,
                'subscription_days' => $subscriptionDays
            ]
        ];

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

        $snapToken = Snap::getSnapToken($transaction);

        return response()->json(['token' => $snapToken]);
    }

    public function paymentfinished(Request $request)
    {
        $midtransResponse  = json_decode($request->getContent());
        $transactionId     = $midtransResponse->order_id;
        $transactionStatus = $midtransResponse->transaction_status;

        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $status = 2;
                break;
            case 'deny':
            case 'cancel':
                $status = 4;
                break;
            case 'expired':
                $status = 3;
                break;
        }

        $transaction = Transaction::find($transactionId);
        $transaction->status = $status;
        $transaction->save();

        $subscription = new Subscription();
        $subscription->user_id = $transaction->user_id;

        return redirect('/');
    }
}
