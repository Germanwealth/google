<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\InvestmentPlan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        
        $investmentPlans = InvestmentPlan::where('is_active', true)->get();
        
        $totalInvested = Transaction::where('user_id', $user->id)
            ->where('type', 'deposit')
            ->sum('amount');
        
        $totalWithdrawn = Transaction::where('user_id', $user->id)
            ->where('type', 'withdrawal')
            ->sum('amount');

        return view('dashboard', compact('transactions', 'investmentPlans', 'totalInvested', 'totalWithdrawn'));
    }
}
