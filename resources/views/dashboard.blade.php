@extends('layouts.app')

@section('title', 'Dashboard - Flare Spark Global')

@section('content')
<div style="padding: 40px 0; background: #F9FAFB; min-height: 100vh;">
    <div class="container">
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 40px; color: #7C3AED;">
            Welcome, {{ Auth::user()->name }}!
        </h2>

        <div class="row" style="margin-bottom: 40px;">
            <div class="col-md-3" style="margin-bottom: 20px;">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                    <h5 style="color: #6B7280; font-size: 0.9rem; margin-bottom: 10px;">Total Invested</h5>
                    <h3 style="color: #7C3AED; font-size: 1.8rem; font-weight: 700;">
                        ${{ number_format($totalInvested, 2) }}
                    </h3>
                </div>
            </div>
            <div class="col-md-3" style="margin-bottom: 20px;">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                    <h5 style="color: #6B7280; font-size: 0.9rem; margin-bottom: 10px;">Total Withdrawn</h5>
                    <h3 style="color: #7C3AED; font-size: 1.8rem; font-weight: 700;">
                        ${{ number_format($totalWithdrawn, 2) }}
                    </h3>
                </div>
            </div>
            <div class="col-md-3" style="margin-bottom: 20px;">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                    <h5 style="color: #6B7280; font-size: 0.9rem; margin-bottom: 10px;">Active Plans</h5>
                    <h3 style="color: #7C3AED; font-size: 1.8rem; font-weight: 700;">
                        {{ $investmentPlans->count() }}
                    </h3>
                </div>
            </div>
            <div class="col-md-3" style="margin-bottom: 20px;">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                    <h5 style="color: #6B7280; font-size: 0.9rem; margin-bottom: 10px;">Net Balance</h5>
                    <h3 style="color: #7C3AED; font-size: 1.8rem; font-weight: 700;">
                        ${{ number_format($totalInvested - $totalWithdrawn, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <a href="/investments" class="btn" style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; border: none; padding: 12px 30px; border-radius: 50px; margin-bottom: 30px; text-decoration: none;">
            View Investment Plans
        </a>

        <div style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); overflow: hidden;">
            <div style="padding: 30px; border-bottom: 1px solid #E5E7EB;">
                <h3 style="color: #7C3AED; font-size: 1.3rem; font-weight: 600; margin: 0;">Recent Transactions</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #F9FAFB;">
                        <tr>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>
                                    <span style="display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; background: {{ $transaction->type === 'deposit' ? '#D1FAE5' : '#FEE2E2' }}; color: {{ $transaction->type === 'deposit' ? '#047857' : '#B91C1C' }};">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                                <td><strong>${{ number_format($transaction->amount, 2) }}</strong></td>
                                <td>{{ $transaction->investmentPlan->name ?? 'N/A' }}</td>
                                <td>
                                    <span style="display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; background: {{ $transaction->status === 'completed' ? '#D1FAE5' : ($transaction->status === 'pending' ? '#FEF08A' : '#FEE2E2') }}; color: {{ $transaction->status === 'completed' ? '#047857' : ($transaction->status === 'pending' ? '#92400E' : '#B91C1C') }};">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 30px; color: #6B7280;">
                                    No transactions yet. <a href="/investments" style="color: #7C3AED; text-decoration: none; font-weight: 600;">Start investing</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->count() > 0)
                <div style="padding: 20px; text-align: center;">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
