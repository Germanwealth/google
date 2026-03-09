<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        $plans = InvestmentPlan::where('is_active', true)->get();
        return view('investments.index', compact('plans'));
    }

    public function show(InvestmentPlan $investmentPlan)
    {
        return view('investments.show', compact('investmentPlan'));
    }

    public function invest(Request $request)
    {
        $request->validate([
            'investment_plan_id' => 'required|exists:investment_plans,id',
            'amount' => 'required|numeric|min:1',
            'wallet_address' => 'nullable|string',
        ]);

        $plan = InvestmentPlan::find($request->investment_plan_id);

        if ($request->amount < $plan->minimum_investment) {
            return back()->withErrors(['amount' => 'Amount is below minimum investment']);
        }

        if ($plan->maximum_investment && $request->amount > $plan->maximum_investment) {
            return back()->withErrors(['amount' => 'Amount exceeds maximum investment']);
        }

        auth()->user()->transactions()->create([
            'investment_plan_id' => $plan->id,
            'type' => 'deposit',
            'amount' => $request->amount,
            'wallet_address' => $request->wallet_address,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Investment created successfully! Awaiting confirmation.');
    }
}
