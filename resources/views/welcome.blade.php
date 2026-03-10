@extends('layouts.app')

@section('title', 'PRISM - Advanced Crypto Asset Management Platform')

@section('styles')
<style>
    .hero {
      background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%);
      color: white;
      padding: 140px 0 100px;
      position: relative;
      overflow: hidden;
      margin-top: 0;
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

    .hero-content { position: relative; z-index: 1; }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 20px;
      line-height: 1.2;
      background: linear-gradient(135deg, #F8FAFC 0%, #CBD5E1 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero p {
      font-size: 1.15rem;
      margin-bottom: 35px;
      opacity: 0.9;
      line-height: 1.8;
      color: #CBD5E1;
    }

    .btn-primary-hero {
      background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 16px 42px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      margin-right: 15px;
      text-decoration: none;
      box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
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
      padding: 14px 40px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      text-decoration: none;
    }

    .btn-secondary-hero:hover {
      background: #1E293B;
      color: #F8FAFC;
      border-color: #CBD5E1;
    }

    .basic-1 {
      padding: 100px 0;
      background: #F8FAFC;
    }

    .basic-1 h2 {
      font-size: 2.8rem;
      font-weight: 800;
      margin-bottom: 25px;
      color: #0F172A;
    }

    .basic-1 p {
      font-size: 1.05rem;
      color: #475569;
      line-height: 1.9;
      margin-bottom: 20px;
    }

    .transactions-section {
      background: white;
      padding: 80px 0;
    }

    .card-header {
      background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important;
      color: white !important;
    }

    .table th {
      background-color: #F1F5F9;
      font-weight: 700;
      color: #0F172A;
      border-bottom: 2px solid #E2E8F0;
    }

    .table td {
      vertical-align: middle;
      border-color: #E2E8F0;
      color: #334155;
    }

    @media (max-width: 768px) {
      .hero h1 { font-size: 2.2rem; }
      .hero { padding: 80px 0 60px; }
      .btn-primary-hero { margin-bottom: 15px; }
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
                <img src="https://via.placeholder.com/520x420?text=Crypto+Analytics" class="img-fluid rounded-3" alt="Advanced Analytics" style="box-shadow: 0 20px 60px rgba(0,0,0,0.2);">
            </div>
        </div>
    </div>
</section>

<section class="basic-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://via.placeholder.com/520x420?text=Portfolio+Management" class="img-fluid rounded-3" alt="Portfolio Management">
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
