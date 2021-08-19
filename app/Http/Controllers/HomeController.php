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

        $totalWeight   = $user->transactions()->sum('weight');
        $currentHarvest = $user->transactions()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('weight');
        $currentIncome  = $user->transactions()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        $summaryReports = Transaction::select(DB::raw("DATE_FORMAT(created_at, '%m-%Y') as month"), DB::raw("SUM(weight) as weight"), DB::raw("SUM(total_price) as total_price"))
            ->where('user_id', Auth::id())
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        $totalIncome = $user->transactions()->sum('total_price');

        return view('welcome', compact('totalWeight', 'totalIncome', 'currentHarvest', 'currentIncome', 'summaryReports'));
    }
}
