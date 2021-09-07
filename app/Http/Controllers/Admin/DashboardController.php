<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Log;

class DashboardController
{
    public function index()
    {
        $users    = User::count();
        $payments = Payment::sum('amount');

        $userAmounts = $months = [];

        $signUpUsers = User::groupBy('monthRegister')
            ->selectRaw(
                'COUNT(*) AS user_permonth, DATE_FORMAT(created_at, \'%m-%Y\') as monthRegister'
            )
            ->orderBy('monthRegister')
            ->get();

        $paymentsSummary = Payment::selectRaw(
            'SUM(amount) AS payPermonth'
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
            $users = User::join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
                ->select(['users.name', 'users.phone_number', 'subscriptions.status AS status']);

            return DataTables::of($users)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->filled('month')) {
                        $query->whereRaw("MONTHNAME(users.created_at) = '{$request->month}'");
                    }
                })
                ->editColumn('status', function ($user) {
                    return $user->status
                        ? '<span class="btn btn-success">Aktif</span>'
                        : '<span class="btn btn-secondary">Tidak Aktif</span>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('admin.users');
    }
}
