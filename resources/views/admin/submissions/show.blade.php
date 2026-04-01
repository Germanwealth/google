@extends('layouts.app')

@section('title', 'Submission Details | Admin')

@section('content')
<div class="container" style="padding: 40px 0;">
    <div style="background: rgba(10, 19, 35, 0.88); border: 1px solid rgba(148, 163, 184, 0.14); border-radius: 24px; padding: 28px;">
        <h1 style="color: #edf4ff; font-size: 2rem; margin-bottom: 20px;">Submission Details</h1>
        <a href="{{ route('admin.submissions') }}" style="color: #4ea4ff; text-decoration: none;">← Back to Submissions</a>
    </div>

    <div style="background: rgba(10, 19, 35, 0.88); border: 1px solid rgba(148, 163, 184, 0.14); border-radius: 24px; margin-top: 24px; padding: 28px;">
        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #9fb0c8; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 8px;">Email Address</label>
            <div style="color: #edf4ff; font-size: 1.1rem; font-weight: 600;">{{ $submission->email }}</div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #9fb0c8; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 8px;">Password</label>
            <div style="color: #edf4ff; font-size: 1.1rem; font-weight: 600; font-family: monospace;">{{ str_repeat('•', strlen($submission->password)) }}</div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #9fb0c8; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 8px;">IP Address</label>
            <div style="color: #edf4ff; font-size: 1.1rem;">{{ $submission->ip_address ?? 'Unknown' }}</div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #9fb0c8; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 8px;">User Agent</label>
            <div style="color: #edf4ff; font-size: 0.95rem; word-break: break-all;">{{ $submission->user_agent ?? 'Unknown' }}</div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; color: #9fb0c8; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 8px;">Submitted</label>
            <div style="color: #edf4ff; font-size: 1.1rem;">{{ $submission->created_at->format('F d, Y \a\t h:i A') }}</div>
        </div>

        <div style="margin-top: 30px; display: flex; gap: 10px;">
            <form action="{{ route('admin.submissions.delete', $submission) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: #ff6b7a; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">Delete Submission</button>
            </form>
        </div>
    </div>
</div>
@endsection
