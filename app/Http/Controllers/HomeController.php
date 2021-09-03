<?php

namespace App\Http\Controllers;

use App\Transaction;
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

        $monthlyReport = $user->transactions()->select(
            DB::raw('SUM(weight) as monthlyWeight'),
            DB::raw('SUM(total_price) as monthlyIncome')
        )
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $totalReport = $user->transactions()->select(
            DB::raw("DATE_FORMAT(created_at, '%m-%Y') as month"),
            DB::raw("SUM(weight) as weight"),
            DB::raw("SUM(total_price) as total_price")
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        dd($totalReport);

        return view('welcome', [
            'monthlyReport' => $monthlyReport[0],
            'totalReport'   => $totalReport[0]
        ]);
    }
}
