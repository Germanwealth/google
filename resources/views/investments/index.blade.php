@extends('layouts.app')

@section('title', 'Investment Plans - Flare Spark Global')

@section('content')
<div style="padding: 80px 0; background: #F9FAFB;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 50px; color: #7C3AED;">
            Investment Plans
        </h2>
        <div class="row">
            @forelse($plans as $plan)
                <div class="col-md-4" style="margin-bottom: 30px;">
                    <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); height: 100%; display: flex; flex-direction: column;">
                        <h3 style="color: #7C3AED; margin-bottom: 15px; font-weight: 600; font-size: 1.5rem;">{{ $plan->name }}</h3>
                        <p style="color: #6B7280; margin-bottom: 20px; flex-grow: 1;">{{ $plan->description }}</p>
                        
                        <div style="margin-bottom: 20px; padding: 20px; background: #F9FAFB; border-radius: 8px;">
                            <p style="margin-bottom: 10px;"><strong>Min Investment:</strong> ${{ number_format($plan->minimum_investment, 2) }}</p>
                            @if($plan->maximum_investment)
                                <p style="margin-bottom: 10px;"><strong>Max Investment:</strong> ${{ number_format($plan->maximum_investment, 2) }}</p>
                            @endif
                            <p style="margin-bottom: 10px;"><strong>Monthly Return:</strong> {{ $plan->monthly_return_percentage }}%</p>
                            <p><strong>Duration:</strong> {{ $plan->duration_months }} months</p>
                        </div>

                        @auth
                            <button type="button" class="btn" style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; border: none; padding: 12px 30px; border-radius: 50px; cursor: pointer; width: 100%;" 
                                data-bs-toggle="modal" data-bs-target="#investModal{{ $plan->id }}">
                                Invest Now
                            </button>
                        @else
                            <a href="/login" class="btn" style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; border: none; padding: 12px 30px; border-radius: 50px; text-decoration: none; display: block; text-align: center; width: 100%;">
                                Login to Invest
                            </a>
                        @endauth
                    </div>
                </div>

                @auth
                    <div class="modal fade" id="investModal{{ $plan->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Invest in {{ $plan->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="/invest">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="investment_plan_id" value="{{ $plan->id }}">
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Investment Amount</label>
                                            <input type="number" class="form-control" name="amount" step="0.01" min="{{ $plan->minimum_investment }}" required>
                                            <small class="text-muted">Min: ${{ number_format($plan->minimum_investment, 2) }}</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Wallet Address (Optional)</label>
                                            <input type="text" class="form-control" name="wallet_address">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%); color: white; border: none;">
                                            Confirm Investment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            @empty
                <div class="col-12" style="text-align: center; padding: 40px;">
                    <p style="color: #6B7280; font-size: 1.1rem;">No investment plans available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
