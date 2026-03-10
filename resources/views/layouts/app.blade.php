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

        /* MOBILE-FIRST NAVIGATION */
        .navbar {
            padding: 1rem 0.5rem !important;
            background-color: white !important;
        }

        .navbar-brand {
            font-size: 1.25rem;
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
            color: var(--primary);
        }

        .navbar-toggler:focus {
            box-shadow: none;
            outline: 2px solid var(--primary);
        }

        .navbar-collapse {
            padding-top: 1rem;
        }

        /* Tablet and larger */
        @media (min-width: 992px) {
          .navbar {
            padding: 1rem 0 !important;
          }

          .navbar-brand {
            font-size: 1.5rem;
          }

          .navbar-collapse {
            padding-top: 0;
          }
        }

        /* MOBILE-FIRST FOOTER */
        footer {
            background: var(--primary);
            color: white;
            padding: 30px 20px 20px;
            margin-top: 60px;
        }

        .footer-section {
            margin-bottom: 25px;
        }

        .footer-section h5 {
            font-size: 1rem;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .footer-section a {
            color: white;
            opacity: 0.8;
            transition: opacity 0.3s ease;
            display: block;
            font-size: 0.9rem;
            margin-bottom: 8px;
            text-decoration: none;
        }

        .footer-section a:hover {
            opacity: 1;
            color: var(--accent);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            text-align: center;
            opacity: 0.8;
            margin-top: 25px;
            font-size: 0.9rem;
        }

        /* Tablet screens */
        @media (min-width: 768px) {
          footer {
            padding: 50px 40px 20px;
            margin-top: 80px;
          }

          .footer-section {
            margin-bottom: 0;
          }

          .footer-section h5 {
            font-size: 1.1rem;
          }

          .footer-bottom {
            font-size: 1rem;
          }
        }

        /* Desktop screens */
        @media (min-width: 1024px) {
          footer {
            padding: 60px 0 20px;
          }

          .footer-section h5 {
            font-size: 1.2rem;
          }
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
        <div class="container-fluid px-0">
            <div class="row g-4 mx-0">
                <div class="col-12 col-md-6 col-lg-3 footer-section">
                    <h5 style="color: var(--accent);">About</h5>
                    <a href="/about">About Us</a>
                    <a href="/contact">Contact</a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 footer-section">
                    <h5 style="color: var(--accent);">Investments</h5>
                    <a href="/investments">Investment Plans</a>
                    <a href="/dashboard">My Portfolio</a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 footer-section">
                    <h5 style="color: var(--accent);">Legal</h5>
                    <a href="#">Terms of Service</a>
                    <a href="#">Privacy Policy</a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 footer-section">
                    <h5 style="color: var(--accent);">Support</h5>
                    <a href="/contact">Get Help</a>
                    <a href="#">FAQ</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 PRISM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
