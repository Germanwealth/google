<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%); box-shadow: 0 8px 32px rgba(0,0,0,0.15);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}" style="font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; text-decoration: none; color: white;">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 40px;">
                <defs>
                    <linearGradient id="prismGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                        <stop offset="50%" style="stop-color:#A855F7;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#EC4899;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <polygon points="100,20 160,80 160,160 100,200 40,160 40,80" fill="url(#prismGradient)" opacity="0.9"/>
                <polygon points="100,40 140,80 140,150 100,180 60,150 60,80" fill="white" opacity="0.15"/>
                <circle cx="100" cy="100" r="8" fill="white" opacity="0.8"/>
            </svg>
            PRISM
        </a>
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
