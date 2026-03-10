<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PRISM - Advanced Crypto Asset Management Platform">
    <title>@yield('title', 'PRISM - Dashboard')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;0,700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #3B82F6;
            --secondary: #1E293B;
            --accent: #06B6D4;
            --text-dark: #0F172A;
            --text-light: #475569;
            --bg-light: #F8FAFC;
            --border: #E2E8F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background: white;
            line-height: 1.6;
        }

        .navbar {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover { color: var(--accent) !important; }

        footer {
            background: var(--primary);
            color: white;
            padding: 50px 0 20px;
            margin-top: 80px;
        }

        .footer-section a {
            color: white;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .footer-section a:hover {
            opacity: 1;
            color: var(--accent);
        }
    </style>

    @yield('styles')
</head>
<body>
    @include('layouts.navigation')

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-section">
                    <h5 style="color: var(--accent);">About</h5>
                    <a href="/about">About Us</a>
                    <a href="/contact">Contact</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h5 style="color: var(--accent);">Investments</h5>
                    <a href="/investments">Investment Plans</a>
                    <a href="/dashboard">My Portfolio</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h5 style="color: var(--accent);">Legal</h5>
                    <a href="#">Terms of Service</a>
                    <a href="#">Privacy Policy</a>
                </div>
                <div class="col-md-3 footer-section">
                    <h5 style="color: var(--accent);">Support</h5>
                    <a href="/contact">Get Help</a>
                    <a href="#">FAQ</a>
                </div>
            </div>
            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; text-align: center; opacity: 0.8; margin-top: 30px;">
                <p>&copy; 2026 PRISM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
