@extends('layouts.app')

@section('title', 'PRISM - Advanced Crypto Asset Management Platform')

@section('styles')
<style>
    /* MOBILE FIRST - Default for small screens */
    .hero {
      background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%);
      color: white;
      padding: 60px 20px 50px;
      position: relative;
      overflow: hidden;
      margin-top: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 40%),
                  radial-gradient(circle at 20% 80%, rgba(168, 85, 247, 0.1) 0%, transparent 40%);
    }

    .hero-content { 
      position: relative; 
      z-index: 1;
      width: 100%;
    }

    .hero h1 {
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 20px;
      line-height: 1.2;
      background: linear-gradient(135deg, #F8FAFC 0%, #CBD5E1 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero p {
      font-size: 0.95rem;
      margin-bottom: 30px;
      opacity: 0.9;
      line-height: 1.8;
      color: #CBD5E1;
    }

    /* Tablet and larger screens */
    @media (min-width: 768px) {
      .hero {
        padding: 100px 40px 80px;
      }
      
      .hero h1 {
        font-size: 2.8rem;
      }
      
      .hero p {
        font-size: 1.05rem;
      }
    }

    /* Desktop screens */
    @media (min-width: 1024px) {
      .hero {
        padding: 140px 0 100px;
      }
      
      .hero h1 {
        font-size: 3.5rem;
      }
      
      .hero p {
        font-size: 1.15rem;
      }
    }

    .btn-primary-hero {
      background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 14px 28px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      margin-right: 0;
      margin-bottom: 12px;
      text-decoration: none;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
      font-size: 0.95rem;
      width: 100%;
      text-align: center;
    }

    .btn-primary-hero:hover {
      background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
      transform: translateY(-3px);
      box-shadow: 0 14px 35px rgba(59, 130, 246, 0.4);
      color: white;
    }

    .btn-secondary-hero {
      background: transparent;
      color: #E2E8F0;
      border: 2px solid #475569;
      border-radius: 8px;
      padding: 12px 26px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      text-decoration: none;
      font-size: 0.95rem;
      width: 100%;
      text-align: center;
    }

    /* Tablet and larger */
    @media (min-width: 768px) {
      .btn-primary-hero,
      .btn-secondary-hero {
        width: auto;
        margin-bottom: 0;
      }
      
      .btn-primary-hero {
        margin-right: 15px;
        padding: 16px 42px;
      }
      
      .btn-secondary-hero {
        padding: 14px 40px;
      }
    }

    .btn-secondary-hero:hover {
      background: #1E293B;
      color: #F8FAFC;
      border-color: #CBD5E1;
    }

    /* FEATURES/BASIC SECTION - MOBILE FIRST */
    .basic-1 {
      padding: 40px 20px;
      background: #F8FAFC;
    }

    .basic-1 h2 {
      font-size: 1.75rem;
      font-weight: 800;
      margin-bottom: 25px;
      color: #0F172A;
      text-align: center;
    }

    .basic-1 p {
      font-size: 0.95rem;
      color: #475569;
      line-height: 1.9;
      margin-bottom: 20px;
    }

    /* Tablet screens */
    @media (min-width: 768px) {
      .basic-1 {
        padding: 60px 40px;
      }
      
      .basic-1 h2 {
        font-size: 2.2rem;
        text-align: left;
      }
      
      .basic-1 p {
        font-size: 1.02rem;
      }
    }

    /* Desktop screens */
    @media (min-width: 1024px) {
      .basic-1 {
        padding: 100px 0;
      }
      
      .basic-1 h2 {
        font-size: 2.8rem;
      }
      
      .basic-1 p {
        font-size: 1.05rem;
      }
    }

    /* TRANSACTIONS SECTION - MOBILE FIRST */
    .transactions-section {
      background: white;
      padding: 40px 20px;
    }

    .card-header {
      background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important;
      color: white !important;
      padding: 12px 16px !important;
      font-size: 0.95rem;
    }

    .table {
      font-size: 0.85rem;
      margin-bottom: 0;
    }

    .table th {
      background-color: #F1F5F9;
      font-weight: 700;
      color: #0F172A;
      border-bottom: 2px solid #E2E8F0;
      padding: 10px 8px;
      font-size: 0.85rem;
    }

    .table td {
      vertical-align: middle;
      border-color: #E2E8F0;
      color: #334155;
      padding: 10px 8px;
    }

    .badge {
      font-size: 0.75rem;
      padding: 4px 8px;
    }

    /* Tablet screens */
    @media (min-width: 768px) {
      .transactions-section {
        padding: 60px 40px;
      }
      
      .table {
        font-size: 0.95rem;
      }
      
      .table th,
      .table td {
        padding: 12px 12px;
        font-size: 0.95rem;
      }
      
      .card-header {
        padding: 15px 20px !important;
        font-size: 1rem;
      }
      
      .badge {
        font-size: 0.8rem;
      }
    }

    /* Desktop screens */
    @media (min-width: 1024px) {
      .transactions-section {
        padding: 80px 0;
      }
      
      .table {
        font-size: 1rem;
      }
      
      .table th,
      .table td {
        padding: 14px 16px;
        font-size: 1rem;
      }
      
      .badge {
        font-size: 0.85rem;
      }
    }

    /* GENERAL RESPONSIVE UTILITIES */
    .container-responsive {
      width: 100%;
      padding: 0 20px;
      margin: 0 auto;
    }

    @media (min-width: 768px) {
      .container-responsive {
        padding: 0 40px;
        max-width: 1200px;
      }
    }

    @media (min-width: 1024px) {
      .container-responsive {
        padding: 0 60px;
      }
    }

    /* Touch-friendly touch targets (48px minimum for mobile) */
    button, a.btn, .btn {
      min-height: 44px;
      min-width: 44px;
    }

    @media (min-width: 768px) {
      button, a.btn, .btn {
        min-height: 40px;
        min-width: 40px;
      }
    }

    /* RESPONSIVE IMAGE HANDLING */
    img {
      max-width: 100%;
      height: auto;
      display: block;
    }

    svg {
      max-width: 100%;
      height: auto;
    }

    /* Prevent horizontal scrolling on mobile */
    .hero, .basic-1, .transactions-section {
      overflow-x: hidden;
    }

    /* SPACING RESPONSIVE UTILITIES */
    .pt-responsive {
      padding-top: 30px;
    }

    .pb-responsive {
      padding-bottom: 30px;
    }

    .px-responsive {
      padding-left: 20px;
      padding-right: 20px;
    }

    @media (min-width: 768px) {
      .pt-responsive {
        padding-top: 50px;
      }

      .pb-responsive {
        padding-bottom: 50px;
      }

      .px-responsive {
        padding-left: 40px;
        padding-right: 40px;
      }
    }

    @media (min-width: 1024px) {
      .pt-responsive {
        padding-top: 70px;
      }

      .pb-responsive {
        padding-bottom: 70px;
      }

      .px-responsive {
        padding-left: 0;
        padding-right: 0;
      }
    }

    /* TYPOGRAPHY MOBILE-FIRST */
    h1 { line-height: 1.2; }
    h2 { line-height: 1.3; }
    h3 { line-height: 1.4; }
    p { line-height: 1.6; word-break: break-word; }

    /* GRID RESPONSIVE */
    .row {
      margin-right: -10px;
      margin-left: -10px;
    }

    [class*='col-'] {
      padding-right: 10px;
      padding-left: 10px;
      margin-bottom: 20px;
    }

    @media (min-width: 768px) {
      [class*='col-'] {
        margin-bottom: 0;
      }
    }

    /* Prevent text selection on interactive elements */
    button, a, .btn {
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* HIGH DPI SCREENS */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
    }

</style>
@endsection

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1>Advanced Crypto Asset Management</h1>
                    <p>Manage, grow, and secure your digital wealth with institutional-grade tools and real-time analytics. PRISM is the platform where traders and investors thrive.</p>
                    <div>
                        <a href="/investments" class="btn-primary-hero">Start Investing</a>
                        @auth
                            <a href="/dashboard" class="btn-secondary-hero">Dashboard</a>
                        @else
                            <a href="/register" class="btn-secondary-hero">Create Account</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <svg class="img-fluid rounded-3" viewBox="0 0 520 420" style="box-shadow: 0 20px 60px rgba(0,0,0,0.2); background: linear-gradient(135deg, #1E293B 0%, #334155 100%); border-radius: 12px;" xmlns="http://www.w3.org/2000/svg">
                    <!-- Grid background -->
                    <defs>
                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(59, 130, 246, 0.1)" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="520" height="420" fill="url(#grid)" />
                    
                    <!-- Analytics Chart -->
                    <g transform="translate(50, 50)">
                        <!-- Chart title -->
                        <text x="0" y="20" font-size="20" font-weight="bold" fill="#F8FAFC">Portfolio Performance</text>
                        
                        <!-- Chart line -->
                        <polyline points="0,150 30,130 60,110 90,125 120,85 150,95 180,60 210,70 220,50" 
                                  fill="none" stroke="#3B82F6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <!-- Chart area gradient -->
                        <defs>
                            <linearGradient id="chartGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.3" />
                                <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:0" />
                            </linearGradient>
                        </defs>
                        <polygon points="0,150 30,130 60,110 90,125 120,85 150,95 180,60 210,70 220,50 220,200 0,200" 
                                 fill="url(#chartGrad)" />
                        
                        <!-- Y-axis labels -->
                        <text x="-30" y="155" font-size="12" fill="#94A3B8">$0</text>
                        <text x="-30" y="85" font-size="12" fill="#94A3B8">$50K</text>
                        <text x="-30" y="15" font-size="12" fill="#94A3B8">$100K</text>
                        
                        <!-- X-axis -->
                        <line x1="0" y1="200" x2="220" y2="200" stroke="#475569" stroke-width="1" />
                        
                        <!-- Data points -->
                        <circle cx="0" cy="150" r="4" fill="#3B82F6" />
                        <circle cx="30" cy="130" r="4" fill="#3B82F6" />
                        <circle cx="60" cy="110" r="4" fill="#3B82F6" />
                        <circle cx="220" cy="50" r="4" fill="#10B981" />
                    </g>
                    
                    <!-- Stats boxes -->
                    <g transform="translate(50, 280)">
                        <rect x="0" y="0" width="100" height="80" rx="8" fill="rgba(59, 130, 246, 0.1)" stroke="#3B82F6" stroke-width="1"/>
                        <text x="10" y="20" font-size="12" fill="#94A3B8">Total Assets</text>
                        <text x="10" y="45" font-size="18" font-weight="bold" fill="#F8FAFC">$1.2M</text>
                        <text x="10" y="65" font-size="11" fill="#10B981">+12.5% 24h</text>
                        
                        <rect x="130" y="0" width="100" height="80" rx="8" fill="rgba(16, 185, 129, 0.1)" stroke="#10B981" stroke-width="1"/>
                        <text x="140" y="20" font-size="12" fill="#94A3B8">Daily Gain</text>
                        <text x="140" y="45" font-size="18" font-weight="bold" fill="#F8FAFC">$8,420</text>
                        <text x="140" y="65" font-size="11" fill="#10B981">+2.3% Today</text>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</section>

<section class="basic-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <svg class="img-fluid rounded-3" viewBox="0 0 520 420" style="background: linear-gradient(135deg, #1E293B 0%, #334155 100%); border-radius: 12px;" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background grid -->
                    <defs>
                        <pattern id="grid2" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(168, 85, 247, 0.1)" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="520" height="420" fill="url(#grid2)" />
                    
                    <!-- Wallet illustration -->
                    <g transform="translate(160, 80)">
                        <!-- Wallet main body -->
                        <rect x="0" y="40" width="200" height="120" rx="12" fill="none" stroke="#A855F7" stroke-width="2"/>
                        
                        <!-- Wallet flap -->
                        <path d="M 0 40 Q 100 0 200 40" fill="none" stroke="#A855F7" stroke-width="2"/>
                        
                        <!-- Coins visualization -->
                        <circle cx="50" cy="100" r="28" fill="rgba(251, 191, 36, 0.2)" stroke="#FBbF24" stroke-width="2"/>
                        <circle cx="50" cy="100" r="20" fill="none" stroke="#FBbF24" stroke-width="1"/>
                        <text x="50" y="105" font-size="16" font-weight="bold" fill="#FBbF24" text-anchor="middle">B</text>
                        
                        <circle cx="130" cy="85" r="28" fill="rgba(59, 130, 246, 0.2)" stroke="#3B82F6" stroke-width="2"/>
                        <circle cx="130" cy="85" r="20" fill="none" stroke="#3B82F6" stroke-width="1"/>
                        <text x="130" y="90" font-size="16" font-weight="bold" fill="#3B82F6" text-anchor="middle">E</text>
                        
                        <circle cx="100" cy="130" r="28" fill="rgba(34, 197, 94, 0.2)" stroke="#22C55E" stroke-width="2"/>
                        <circle cx="100" cy="130" r="20" fill="none" stroke="#22C55E" stroke-width="1"/>
                        <text x="100" y="135" font-size="16" font-weight="bold" fill="#22C55E" text-anchor="middle">$</text>
                    </g>
                    
                    <!-- Features list -->
                    <g transform="translate(50, 260)">
                        <g>
                            <circle cx="10" cy="10" r="5" fill="#3B82F6" />
                            <text x="25" y="14" font-size="14" fill="#F8FAFC">Multi-Chain Support</text>
                        </g>
                        <g transform="translate(0, 35)">
                            <circle cx="10" cy="10" r="5" fill="#10B981" />
                            <text x="25" y="14" font-size="14" fill="#F8FAFC">Real-Time Analytics</text>
                        </g>
                        <g transform="translate(0, 70)">
                            <circle cx="10" cy="10" r="5" fill="#A855F7" />
                            <text x="25" y="14" font-size="14" fill="#F8FAFC">Advanced Security</text>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="col-lg-6 ps-lg-4">
                <h2>Why Choose PRISM?</h2>
                <p>PRISM combines cutting-edge blockchain technology with professional-grade portfolio management tools. Our platform gives you complete control over your digital assets with transparent, real-time insights.</p>
                <p>With multi-chain support, advanced security features, and a user-friendly interface, PRISM is built for both beginners and seasoned crypto professionals.</p>
                <p>Experience seamless wallet integration, automated portfolio tracking, and intelligent market insights all in one place.</p>
                <a href="#transactions" class="btn btn-primary" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); border: none; padding: 13px 38px; border-radius: 8px; font-weight: 600;">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section style="background: white; padding: 100px 0; border-top: 1px solid #E2E8F0;">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 style="font-size: 2.5rem; font-weight: 800; color: #0F172A; margin-bottom: 20px;">Why PRISM Stands Out</h2>
                <p style="font-size: 1.1rem; color: #475569;">Enterprise-grade features designed for modern investors</p>
            </div>
        </div>
        <div class="row">
            <!-- Security Feature -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); border: 1px solid #E2E8F0; transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0, 0, 0, 0.12)'; this.style.borderColor='#3B82F6';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#E2E8F0';">
                    <div style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                            <defs>
                                <linearGradient id="secGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <rect x="12" y="16" width="40" height="48" rx="4" fill="url(#secGrad1)"/>
                            <path d="M32 16V8l-16 6v12c0 12 16 16 16 16s16-4 16-16V14l-16-6v8z" fill="white" opacity="0.9"/>
                        </svg>
                    </div>
                    <div style="width: 4px; height: 40px; background: linear-gradient(135deg, #3B82F6, #A855F7); border-radius: 2px; margin-bottom: 15px;"></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">Bank-Level Security</h3>
                    <p style="color: #6B7280; line-height: 1.6; font-size: 0.95rem;">Military-grade encryption and multi-signature wallets protect your assets with enterprise-level security protocols.</p>
                </div>
            </div>

            <!-- Analytics Feature -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); border: 1px solid #E2E8F0; transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0, 0, 0, 0.12)'; this.style.borderColor='#3B82F6';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#E2E8F0';">
                    <div style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                            <defs>
                                <linearGradient id="analyticGrad1" x1="0%" y1="100%" x2="100%" y2="0%">
                                    <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#06B6D4;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <rect x="10" y="42" width="8" height="16" rx="2" fill="url(#analyticGrad1)"/>
                            <rect x="24" y="28" width="8" height="30" rx="2" fill="url(#analyticGrad1)"/>
                            <rect x="38" y="10" width="8" height="48" rx="2" fill="url(#analyticGrad1)"/>
                            <rect x="52" y="18" width="8" height="40" rx="2" fill="url(#analyticGrad1)"/>
                            <line x1="8" y1="58" x2="56" y2="58" stroke="url(#analyticGrad1)" stroke-width="2"/>
                        </svg>
                    </div>
                    <div style="width: 4px; height: 40px; background: linear-gradient(135deg, #3B82F6, #A855F7); border-radius: 2px; margin-bottom: 15px;"></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">Advanced Analytics</h3>
                    <p style="color: #6B7280; line-height: 1.6; font-size: 0.95rem;">Real-time insights and predictive analysis powered by AI to optimize your portfolio performance.</p>
                </div>
            </div>

            <!-- Speed Feature -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); border: 1px solid #E2E8F0; transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0, 0, 0, 0.12)'; this.style.borderColor='#3B82F6';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#E2E8F0';">
                    <div style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                            <defs>
                                <linearGradient id="speedGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#F59E0B;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#D97706;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="32" cy="32" r="26" fill="none" stroke="url(#speedGrad1)" stroke-width="3"/>
                            <circle cx="32" cy="32" r="20" fill="none" stroke="url(#speedGrad1)" stroke-width="2" opacity="0.6"/>
                            <line x1="32" y1="32" x2="32" y2="10" stroke="url(#speedGrad1)" stroke-width="3" stroke-linecap="round"/>
                            <circle cx="32" cy="32" r="4" fill="url(#speedGrad1)"/>
                        </svg>
                    </div>
                    <div style="width: 4px; height: 40px; background: linear-gradient(135deg, #3B82F6, #A855F7); border-radius: 2px; margin-bottom: 15px;"></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">Lightning Fast</h3>
                    <p style="color: #6B7280; line-height: 1.6; font-size: 0.95rem;">Transactions execute in milliseconds with optimized blockchain infrastructure for seamless trading.</p>
                </div>
            </div>

            <!-- Multi-Chain Feature -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); border: 1px solid #E2E8F0; transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0, 0, 0, 0.12)'; this.style.borderColor='#3B82F6';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#E2E8F0';">
                    <div style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                            <defs>
                                <linearGradient id="chainGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#A855F7;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#7C3AED;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="16" cy="32" r="10" fill="url(#chainGrad1)"/>
                            <circle cx="32" cy="32" r="10" fill="url(#chainGrad1)"/>
                            <circle cx="48" cy="32" r="10" fill="url(#chainGrad1)"/>
                            <line x1="26" y1="32" x2="38" y2="32" stroke="white" stroke-width="2"/>
                            <line x1="42" y1="32" x2="54" y2="32" stroke="white" stroke-width="2"/>
                        </svg>
                    </div>
                    <div style="width: 4px; height: 40px; background: linear-gradient(135deg, #3B82F6, #A855F7); border-radius: 2px; margin-bottom: 15px;"></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">Multi-Chain Support</h3>
                    <p style="color: #6B7280; line-height: 1.6; font-size: 0.95rem;">Seamlessly manage assets across Ethereum, Polygon, Solana, and 10+ major blockchain networks.</p>
                </div>
            </div>

            <!-- Wallet Feature -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); border: 1px solid #E2E8F0; transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0, 0, 0, 0.12)'; this.style.borderColor='#3B82F6';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#E2E8F0';">
                    <div style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                            <defs>
                                <linearGradient id="walletGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#EC4899;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#DB2777;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <rect x="8" y="18" width="48" height="32" rx="4" fill="url(#walletGrad1)" opacity="0.9"/>
                            <rect x="12" y="22" width="40" height="24" rx="3" fill="white" opacity="0.15"/>
                            <circle cx="48" cy="40" r="5" fill="white" opacity="0.7"/>
                            <rect x="8" y="14" width="32" height="6" rx="2" fill="url(#walletGrad1)"/>
                        </svg>
                    </div>
                    <div style="width: 4px; height: 40px; background: linear-gradient(135deg, #3B82F6, #A855F7); border-radius: 2px; margin-bottom: 15px;"></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">Wallet Integration</h3>
                    <p style="color: #6B7280; line-height: 1.6; font-size: 0.95rem;">Connect your favorite wallets including MetaMask, WalletConnect, and hardware wallets in seconds.</p>
                </div>
            </div>

            <!-- Support Feature -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div style="background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); border: 1px solid #E2E8F0; transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 15px 40px rgba(0, 0, 0, 0.12)'; this.style.borderColor='#3B82F6';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0, 0, 0, 0.08)'; this.style.borderColor='#E2E8F0';">
                    <div style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" style="width: 100%; height: 100%; filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));">
                            <defs>
                                <linearGradient id="supportGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#06B6D4;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#0891B2;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <circle cx="32" cy="28" r="14" fill="url(#supportGrad1)" opacity="0.2"/>
                            <path d="M20 32h4m-4-8h8m-8 16h8" stroke="url(#supportGrad1)" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="44" cy="40" r="12" fill="url(#supportGrad1)"/>
                            <path d="M40 40h8M44 36v8" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div style="width: 4px; height: 40px; background: linear-gradient(135deg, #3B82F6, #A855F7); border-radius: 2px; margin-bottom: 15px;"></div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0F172A; margin-bottom: 12px;">24/7 Support</h3>
                    <p style="color: #6B7280; line-height: 1.6; font-size: 0.95rem;">Expert support team available around the clock to help with any questions or technical issues.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="transactions-section" id="transactions">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 style="font-size: 2.5rem; font-weight: 800; color: #0F172A; margin-bottom: 20px;">Live Activity</h2>
                <p style="font-size: 1.1rem; color: #475569;">Real-time transaction updates from our platform</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-lg" style="border: 1px solid #E2E8F0; border-radius: 12px;">
                    <div class="card-header text-white d-flex align-items-center" style="padding: 18px 24px;">
                        <i class="fas fa-circle-check me-2"></i>
                        <h5 class="mb-0" style="font-weight: 700;">Transaction History</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Wallet Address</th>
                                        <th>Transactions</th>
                                        <th>Volume</th>
                                        <th>Hash</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionTableBody">
                                    <!-- Transactions will be inserted here by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
  const wallets = ["MetaMask", "Ledger Nano", "Trust Wallet", "Coinbase Wallet", "Argent"];

  function getRandomWallet() {
    return wallets[Math.floor(Math.random() * wallets.length)];
  }

  function getRandomTxCount() {
    return Math.floor(Math.random() * 200) + 10;
  }

  function getRandomVolume() {
    return `$${(Math.random() * 500000).toFixed(2)}`;
  }

  function getRandomHash() {
    const chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    return Array.from({ length: 10 }, () => chars[Math.floor(Math.random() * chars.length)]).join('');
  }

  function getRandomTimeAgo() {
    const mins = Math.floor(Math.random() * 60);
    const hours = Math.floor(Math.random() * 24);
    return Math.random() > 0.5 ? `${mins}m ago` : `${hours}h ago`;
  }

  function generateRow() {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td style="font-weight: 600; color: #0F172A;">${getRandomWallet()}</td>
      <td>${getRandomTxCount()}</td>
      <td style="color: #10B981; font-weight: 600;">${getRandomVolume()}</td>
      <td><code style="font-size: 0.85rem;">${getRandomHash().slice(0, 3)}...${getRandomHash().slice(-3)}</code></td>
      <td style="color: #6B7280; font-size: 0.9rem;">${getRandomTimeAgo()}</td>
    `;

    const tableBody = document.getElementById("transactionTableBody");
    if (tableBody.children.length >= 10) {
      tableBody.removeChild(tableBody.lastChild);
    }
    tableBody.prepend(row);
  }

  // Generate a row every 5 seconds
  setInterval(generateRow, 5000);

  // Generate some initial rows
  for (let i = 0; i < 4; i++) generateRow();
</script>
@endsection
