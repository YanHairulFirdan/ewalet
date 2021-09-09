<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $monthlyReport = $user->transactions()
            ->selectRaw('SUM(weight) AS monthlyWeight, SUM(total_price) AS monthlyPrice')
            ->thisMonth()
            ->thisYear()
            ->get();

        $totalReport = $user->transactions()
            ->selectRaw('SUM(weight) AS totalWeight, SUM(total_price) AS totalPrice')
            ->get();

        $graphReport = Transaction::selectRaw(
            "DATE_FORMAT(created_at, '%m-%Y') as month,
                SUM(weight) as weight,
                SUM(total_price) as total_price
                "
        )
            ->where('user_id', $user->id)
            ->thisYear()
            ->groupBy('month')
            ->get();

        return view('welcome', [
            'monthlyReport' => $monthlyReport[0],
            'totalReport'   => $totalReport[0],
            'graphReport'   => $graphReport
        ]);
    }
}
