<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        $users    = User::count();
        $payments = Payment::sum('amount');

        $userAmounts = $months = [];

        $signUpUsers = User::groupBy('monthRegister')->select(
            DB::raw('COUNT(*) AS user_permonth'),
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') as monthRegister"),
        )
            ->orderBy('monthRegister', 'ASC')
            ->get();
        $paymentsSummary = Payment::select(
            DB::raw('SUM(amount) AS payPermonth'),
        )
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))->get();

        foreach ($signUpUsers as $key => $user) {
            $userAmounts[] = $user['user_permonth'];
            $months[]      = $user['monthRegister'];
        }


        unset($signUpUsers);

        return view('admin.dashboard', compact('users', 'payments', 'userAmounts', 'months', 'paymentsSummary'));
    }

    public function showUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderByDesc('created_at')->get();

            $datatable = datatables()->of($users)
                ->addIndexColumn();

            return $datatable->make(true);
        }

        return view('admin.users');
    }
}
