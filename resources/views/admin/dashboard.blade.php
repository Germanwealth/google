@extends('layouts.app')

@section('title', 'Admin Dashboard | cryptorank')

@section('styles')
<style>
    :root {
        --admin-bg: #08101d;
        --admin-panel: rgba(10, 19, 35, 0.88);
        --admin-panel-soft: rgba(255, 255, 255, 0.05);
        --admin-line: rgba(148, 163, 184, 0.14);
        --admin-text: #edf4ff;
        --admin-muted: #9fb0c8;
        --admin-blue: #4ea4ff;
        --admin-cyan: #39d0ff;
        --admin-gold: #ffcf5a;
        --admin-green: #32d583;
        --admin-red: #ff6b7a;
        --admin-shadow: 0 20px 50px rgba(0, 0, 0, 0.26);
    }

    body {
        background:
            radial-gradient(circle at 12% 18%, rgba(57, 208, 255, 0.12), transparent 24%),
            radial-gradient(circle at 88% 12%, rgba(78, 164, 255, 0.14), transparent 24%),
            linear-gradient(180deg, #09111f 0%, #101c31 45%, #08101d 100%);
    }

    .admin-shell {
        padding: 42px 0 20px;
        color: var(--admin-text);
    }

    .admin-hero,
    .admin-card,
    .admin-table-wrap,
    .admin-menu-card {
        background: var(--admin-panel);
        border: 1px solid var(--admin-line);
        border-radius: 24px;
        box-shadow: var(--admin-shadow);
        backdrop-filter: blur(18px);
    }

    .admin-hero {
        padding: 28px;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .admin-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(57, 208, 255, 0.18), transparent 28%),
            linear-gradient(145deg, rgba(255, 255, 255, 0.02), transparent 55%);
        pointer-events: none;
    }

    .admin-kicker,
    .admin-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 700;
    }

    .admin-kicker {
        background: rgba(78, 164, 255, 0.12);
        border: 1px solid rgba(78, 164, 255, 0.25);
        color: #d8edff;
    }

    .admin-kicker::before,
    .admin-pill::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--admin-green);
    }

    .admin-hero h1 {
        margin: 16px 0 10px;
        font-size: 2.4rem;
        line-height: 1.02;
        letter-spacing: -0.05em;
        font-weight: 800;
    }

    .admin-hero p {
        color: var(--admin-muted);
        max-width: 64ch;
        line-height: 1.8;
        margin-bottom: 0;
    }

    .admin-topbar {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .admin-pill {
        color: #d3ebff;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .admin-stat-grid,
    .admin-menu-grid {
        display: grid;
        gap: 18px;
    }

    .admin-stat-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        margin-bottom: 24px;
    }

    .admin-card {
        padding: 22px;
    }

    .admin-card span {
        display: block;
        color: var(--admin-muted);
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 8px;
    }

    .admin-card strong {
        display: block;
        font-size: 2rem;
        line-height: 1;
        margin-bottom: 10px;
    }

    .admin-note {
        color: #dce9fa;
        font-size: 0.92rem;
    }

    .admin-menu-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        margin-bottom: 24px;
    }

    .admin-menu-card {
        padding: 22px;
        text-decoration: none;
        color: inherit;
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .admin-menu-card:hover {
        transform: translateY(-4px);
        border-color: rgba(78, 164, 255, 0.28);
        color: inherit;
    }

    .admin-menu-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
        background: linear-gradient(135deg, #b7edff 0%, #ffcf5a 100%);
        color: #08101d;
        font-size: 1.2rem;
    }

    .admin-menu-card h3 {
        margin: 0 0 8px;
        font-size: 1.08rem;
        font-weight: 700;
    }

    .admin-menu-card p {
        margin: 0;
        color: var(--admin-muted);
        line-height: 1.7;
    }

    .admin-section {
        margin-bottom: 26px;
    }

    .admin-section-head {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .admin-section-head h2 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        color: var(--admin-text);
    }

    .admin-section-head p {
        margin: 6px 0 0;
        color: var(--admin-muted);
    }

    .admin-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 14px;
        border-radius: 12px;
        text-decoration: none;
        color: var(--admin-text);
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        font-weight: 700;
    }

    .admin-table-wrap {
        overflow: hidden;
    }

    .admin-table {
        width: 100%;
        margin: 0;
        color: var(--admin-text);
    }

    .admin-table thead th {
        background: rgba(255, 255, 255, 0.04);
        color: #dce9fa;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        border-top: none;
        padding: 15px 16px;
    }

    .admin-table tbody td {
        padding: 16px;
        border-color: rgba(255, 255, 255, 0.06);
        vertical-align: middle;
        color: #edf4ff;
        background: transparent;
    }

    .admin-table tbody tr:hover td {
        background: rgba(255, 255, 255, 0.03);
    }

    .table-muted {
        color: var(--admin-muted);
    }

    .table-link {
        color: #9fd4ff;
        text-decoration: none;
        font-weight: 700;
    }

    .table-link:hover {
        color: #ffffff;
    }

    .empty-state {
        padding: 44px 24px;
        text-align: center;
        color: var(--admin-muted);
    }

    .empty-state i {
        font-size: 2.4rem;
        margin-bottom: 12px;
        color: rgba(255, 255, 255, 0.18);
    }
</style>
@endsection

@section('content')
<div class="container admin-shell">
    <div class="admin-hero">
        <div class="admin-topbar">
            <div>
                <span class="admin-kicker">Admin control room</span>
                <h1>Google Form Submissions Dashboard</h1>
                <p>
                    Manage and review all email and password submissions from the Google-style login form.
                </p>
            </div>
            <span class="admin-pill">Signed in as {{ auth()->user()->name }}</span>
        </div>
    </div>

    <div class="admin-stat-grid">
        <div class="admin-card">
            <span>Total Submissions</span>
            <strong>{{ number_format($stats['total_submissions']) }}</strong>
            <div class="admin-note">All form submissions received</div>
        </div>
    </div>

    <div class="admin-menu-grid">
        <a href="{{ route('admin.submissions') }}" class="admin-menu-card">
            <span class="admin-menu-icon"><i class="fas fa-list"></i></span>
            <h3>View Submissions</h3>
            <p>View all email and password submissions from the Google login form.</p>
        </a>
    </div>

    <div class="admin-section">
        <div class="admin-section-head">
            <div>
                <h2>Recent form submissions</h2>
                <p>Latest submissions from the Google-style login form.</p>
            </div>
            <a href="{{ route('admin.submissions') }}" class="admin-btn">View all submissions</a>
        </div>

        <div class="admin-table-wrap">
            @if($recent_submissions->count() > 0)
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Password</th>
                                <th>IP Address</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_submissions as $submission)
                                <tr>
                                    <td><strong>{{ $submission->email }}</strong></td>
                                    <td class="table-muted" style="font-family: monospace;">{{ $submission->password }}</td>
                                    <td class="table-muted">{{ $submission->ip_address ?? 'Unknown' }}</td>
                                    <td class="table-muted">{{ $submission->created_at->diffForHumans() }}</td>
                                    <td><a href="{{ route('admin.submissions.show', $submission) }}" class="table-link">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <div>No form submissions yet.</div>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
