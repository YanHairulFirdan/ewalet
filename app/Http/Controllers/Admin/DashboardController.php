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
        $signUpUsers = User::select(DB::raw('COUNT(*) AS user_permonth, MONTH(created_at) as monthRegister, YEAR(created_at) as yearRegister'),)
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('created_at')->get();

        dd($signUpUsers);

        return view('admin.dashboard', compact('users', 'payments'));
    }
}
