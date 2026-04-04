<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); box-shadow: 0 8px 32px rgba(0,0,0,0.15);">
    @php
        $isAdminArea = request()->routeIs('admin.*');
    @endphp
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/" style="text-decoration: none; color: white;">
            <x-application-logo style="width: 184px; height: auto; display: block;" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ auth()->check() && auth()->user()->is_admin ? route('admin.dashboard') : route('home') }}">
                        {{ $isAdminArea ? 'Admin Home' : 'Dashboard' }}
                    </a>
                </li>
                @unless($isAdminArea)
                    <li class="nav-item"><a class="nav-link" href="/connect">Connect Wallet</a></li>
                    <li class="nav-item"><a class="nav-link" href="/investments">Investments</a></li>
                @endunless

                @auth
                    @if(Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}" style="color: #FCD34D;">Admin Dashboard</a></li>
                    @endif
                    <li class="nav-item">
                        <span class="nav-link">Welcome, {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border:none; cursor:pointer; color: rgba(255,255,255,0.9);">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Sign Up</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
