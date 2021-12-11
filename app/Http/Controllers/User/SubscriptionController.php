<?php

namespace App\Http\Controllers\User;

use App\Factories\SubscriptionFactory as FactoriesSubscriptionFactory;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Type;
use App\Subscription\SubscriptionFactory;
use App\Traits\Midtrans;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class SubscriptionController extends Controller
{
    use Midtrans;

    public function index()
    {
        $types = Type::get();

        $clientKey = env('MIDTRANS_CLIENT_KEY_API');

        return view('user.subscription', compact('types', 'clientKey'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'type' => 'required|exists:types,id'
        ]);

        $type = Type::find($request->type);

        if ($request->type != Type::FREE_TRIAL) {
            $snapToken = $this->setPaidSubscription($type);

            $response = ['token' => $snapToken];
        } else {
            $response = [
                'status'       => 'success',
                'redirect_url' => route('transactions.index')
            ];

            FactoriesSubscriptionFactory::freeTrial();
        }


        return response()->json($response);
    }

    public function paymentfinished(Request $request)
    {
        $midtransResponse = json_decode($request->getContent(), true);
        $transactionId    = $midtransResponse['order_id'];

        $status = $this->getTransactionStatus($midtransResponse['transaction_status']);
        $userId = $this->updatePaymentStatus((int)$transactionId, $status);
        $price  = $this->getPriceAmount($midtransResponse);

        $type = Type::where('price', $price)->first();

        FactoriesSubscriptionFactory::paidSubscription(
            $type->id,
            $type->subscription_days
        );

        return response()->json(['status' => 200, 'message' => 'success']);
    }

    private function startSubscription($type, $userId)
    {

        $subscription = new Subscription([
            'user_id'    => $userId,
            'type_id'    => $type->id,
            'started_at' => Carbon::now(),
            'end_at'     => Carbon::now()->addDays($type->subscription_days),
            'status'     => Subscription::STATUS_ACTIVE,
        ]);

        $subscription->save();
    }

    private function updatePaymentStatus($id, $status)
    {
        $payment = Payment::find($id);

        $userId = $payment->user_id;

        $payment->update(['status' => $status]);

        return $userId;
    }

    private function setPaidSubscription($type)
    {
        $price = $type->price;

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'amount'  =>  $price
        ]);

        $transaction = [
            'transaction_details' => [
                'order_id'          => $payment->id,
                'gross_amount'      => $price,
                'subscription_days' => $type->subscription_days
            ]
        ];

        $this->setup();

        return Snap::getSnapToken($transaction);
    }
}
