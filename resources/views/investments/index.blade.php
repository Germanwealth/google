@extends('layouts.app')

@section('title', 'Investment Plans - Flare Spark Global')

@section('styles')
<style>
    .plans-hero {
        background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
        color: white;
        padding: 60px 0;
        margin-top: 20px;
    }

    .plans-section {
        padding: 80px 0;
        background: #F9FAFB;
    }

    .plan-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        border-top: 4px solid #7C3AED;
    }

    .plan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .plan-card h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #7C3AED;
        margin-bottom: 15px;
    }

    .plan-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: #FCD34D;
        margin: 20px 0;
    }

    .plan-features {
        list-style: none;
        padding: 20px 0;
        text-align: left;
    }

    .plan-features li {
        padding: 10px 0;
        border-bottom: 1px solid #E5E7EB;
        color: #6B7280;
    }

    .plan-features li:last-child {
        border-bottom: none;
    }

    .plan-features i {
        color: #10B981;
        margin-right: 10px;
    }

    .plan-button {
        background: #7C3AED;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 40px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 20px;
    }

    .plan-button:hover {
        background: #6D28D9;
        transform: translateY(-2px);
    }

    .plan-button:disabled {
        background: #D1D5DB;
        cursor: not-allowed;
        transform: none;
    }
</style>
@endsection

@section('content')
<section class="plans-hero">
    <div class="container">
        <h1 class="mb-3">Investment Plans</h1>
        <p class="lead">Choose the perfect investment plan for your financial goals</p>
    </div>
</section>

<section class="plans-section">
    <div class="container">
        <div class="row">
            @forelse($plans as $plan)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="plan-card">
                        <h3>{{ $plan->name }}</h3>
                        <div class="plan-price">${{ number_format($plan->minimum_investment, 0) }}+</div>
                        
                        <p class="text-muted">{{ $plan->description }}</p>
                        
                        <ul class="plan-features">
                            <li><i class="fas fa-check"></i> Min: ${{ number_format($plan->minimum_investment, 0) }}</li>
                            @if($plan->maximum_investment)
                                <li><i class="fas fa-check"></i> Max: ${{ number_format($plan->maximum_investment, 0) }}</li>
                            @endif
                            <li><i class="fas fa-check"></i> {{ $plan->monthly_return_percentage }}% Monthly Return</li>
                            <li><i class="fas fa-check"></i> Duration: {{ $plan->duration_months }} months</li>
                        </ul>

                        @auth
                            <form action="{{ route('invest') }}" method="POST">
                                @csrf
                                <input type="hidden" name="investment_plan_id" value="{{ $plan->id }}">
                                <input type="number" name="amount" placeholder="Enter amount" min="{{ $plan->minimum_investment }}" @if($plan->maximum_investment) max="{{ $plan->maximum_investment }}" @endif class="form-control mb-2" required>
                                <button type="submit" class="plan-button">Invest Now</button>
                            </form>
                        @else
                            <a href="{{ route('register') }}" class="plan-button" style="text-decoration: none;">Sign Up to Invest</a>
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h5>No investment plans available yet</h5>
                        <p>Check back soon for investment opportunities!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
