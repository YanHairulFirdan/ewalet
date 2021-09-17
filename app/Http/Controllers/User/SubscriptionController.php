<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $subscriptionDays = $type->subscription_days;

        if ($request->type > 1) {
            $price = $type->price;

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

            $response = ['token' => $snapToken];
        } else {
            $this->startSubscription($type, Auth::id());

            $response = [
                'status' => 'success',
                'redirect_url' => route('transactions.index')
            ];
        }

        return response()->json($response);
    }

    public function paymentfinished(Request $request)
    {
        $midtransResponse  = json_decode($request->getContent());
        $transactionId     = $midtransResponse->order_id;
        $transactionStatus = $midtransResponse->transaction_status;

        $status = 1;

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

        $userId = $this->updatePaymentStatus($transactionId, $status);

        $type = Type::wherePrice(intval($midtransResponse->gross_amount))->get();

        $this->startSubscription($type, $userId);
    }

    private function startSubscription($type, $userId)
    {
        $subscription             = new Subscription();
        $subscription->user_id    = $userId;
        $subscription->type_id    = $type->id;
        $subscription->started_at = Carbon::now();
        $subscription->end_at     = Carbon::now()->addDays($type->subscription_days);
        $subscription->status     = 1;
        $subscription->save();
    }

    private function updatePaymentStatus($id, $status)
    {
        $payment = Payment::find($id);

        $userId = $payment->user_id;

        $payment->update(['status' => $status]);

        return $userId;
    }
}
