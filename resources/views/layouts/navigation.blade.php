<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); box-shadow: 0 8px 32px rgba(0,0,0,0.15);">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}" style="font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px;">💎 PRISM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/connect">Connect Wallet</a></li>
                <li class="nav-item"><a class="nav-link" href="/investments">Investments</a></li>
                
                @auth
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
