@extends('layouts.app')

@section('title', 'Dashboard - Flare Spark Global')

@section('styles')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
        color: white;
        padding: 40px 0;
        margin-top: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .stat-label {
        color: #6B7280;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #7C3AED;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1F2937;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .transaction-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        background-color: #F3F4F6;
        font-weight: 600;
        color: #1F2937;
        border-color: #E5E7EB;
    }

    .badge-pending {
        background-color: #FEF3C7;
        color: #92400E;
    }

    .badge-completed {
        background-color: #D1FAE5;
        color: #065F46;
    }

    .badge-failed {
        background-color: #FEE2E2;
        color: #991B1B;
    }
</style>
@endsection

@section('content')
<div class="container" style="margin-top: 40px;">
    <div class="dashboard-header">
        <div class="container">
            <h1 class="mb-2">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="mb-0">Manage your investments and track your portfolio</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-label">Total Invested</div>
                <div class="stat-value">${{ number_format($totalInvested, 2) }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-label">Total Withdrawn</div>
                <div class="stat-value">${{ number_format($totalWithdrawn, 2) }}</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="stat-label">Active Investments</div>
                <div class="stat-value">{{ $transactions->count() }}</div>
            </div>
        </div>
    </div>

    <h2 class="section-title">Available Investment Plans</h2>
    <div class="row mb-4">
        @forelse($investmentPlans as $plan)
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card h-100" style="border-left: 4px solid #7C3AED;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $plan->name }}</h5>
                        <p class="card-text small text-muted">{{ $plan->description }}</p>
                        <div class="my-2">
                            <span class="badge bg-info">{{ $plan->monthly_return_percentage }}% Monthly</span>
                        </div>
                        <form action="{{ route('invest') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="investment_plan_id" value="{{ $plan->id }}">
                            <input type="number" name="amount" placeholder="Amount" min="{{ $plan->minimum_investment }}" class="form-control form-control-sm mb-2" required>
                            <button type="submit" class="btn btn-sm btn-primary w-100">Invest</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No investment plans available.</p>
            </div>
        @endforelse
    </div>

    <h2 class="section-title">Your Transactions</h2>
    <div class="transaction-table">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td>
                                <strong>{{ $transaction->investmentPlan->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($transaction->type) }}</span>
                            </td>
                            <td>${{ number_format($transaction->amount, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span>
                            </td>
                            <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No transactions yet. Start investing to see your transactions here!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($transactions->count() > 0)
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    @endif
</div>
@endsection
