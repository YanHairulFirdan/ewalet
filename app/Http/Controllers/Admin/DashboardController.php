<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        $users    = User::count();
        $payments = Payment::sum('amount');
        $userAmounts = $months = [];

        $signUpUsers = User::groupBy(DB::raw('MONTHNAME(created_at)'))->select(DB::raw('COUNT(*) AS user_permonth, MONTHNAME(created_at) as monthRegister'),)
            ->get();
        $paymentsSummary = Payment::groupBy(DB::raw('MONTHNAME(created_at)'))->select(DB::raw('COUNT(*) AS pay_permonth, MONTHNAME(created_at) as monthRegister'),)
            ->get();

        dd($paymentsSummary);
        foreach ($signUpUsers as $key => $user) {
            $userAmounts[] = $user['user_permonth'];
            $months[]      = $user['monthRegister'];
        }

        unset($signUpUsers);

        return view('admin.dashboard', compact('users', 'payments', 'userAmounts', 'months'));
    }
}
