<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Transaction;
use App\User;

class DashboardController
{
    public function index()
    {
        $users    = User::count();
        $payments = Payment::sum('amount');

        return view('admin.dashboard', compact('users', 'payments'));
    }
}
