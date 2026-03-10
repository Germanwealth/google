@extends('layouts.app')

@section('title', 'Flare Spark Global - EVM Hub for Web3.0')

@section('styles')
<style>
    .hero {
      background: linear-gradient(135deg, #7C3AED 0%, #A78BFA 100%);
      color: white;
      padding: 120px 0 80px;
      position: relative;
      overflow: hidden;
      margin-top: 20px;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 20% 50%, rgba(252, 211, 77, 0.1) 0%, transparent 50%);
    }

    .hero-content { position: relative; z-index: 1; }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      line-height: 1.2;
    }

    .hero p {
      font-size: 1.1rem;
      margin-bottom: 30px;
      opacity: 0.95;
      line-height: 1.8;
    }

    .btn-primary-hero {
      background: #FCD34D;
      color: #7C3AED;
      border: none;
      border-radius: 50px;
      padding: 15px 40px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      margin-right: 15px;
      text-decoration: none;
    }

    .btn-primary-hero:hover {
      background: white;
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(252, 211, 77, 0.4);
    }

    .btn-secondary-hero {
      background: transparent;
      color: white;
      border: 2px solid white;
      border-radius: 50px;
      padding: 13px 38px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
      text-decoration: none;
    }

    .btn-secondary-hero:hover {
      background: white;
      color: #7C3AED;
    }

    .basic-1 {
      padding: 80px 0;
      background: #F9FAFB;
    }

    .basic-1 h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: #7C3AED;
    }

    .basic-1 p {
      font-size: 1.1rem;
      color: #6B7280;
      line-height: 1.8;
      margin-bottom: 20px;
    }

    .transactions-section {
      background: white;
      padding: 60px 0;
    }

    .card-header {
      background-color: #E42058 !important;
    }

    .table th {
      background-color: #F3F4F6;
      font-weight: 600;
      color: #1F2937;
    }

    .table td {
      vertical-align: middle;
      border-color: #E5E7EB;
    }

    @media (max-width: 768px) {
      .hero h1 { font-size: 2.5rem; }
      .hero { padding: 60px 0; }
      .btn-primary-hero { margin-bottom: 10px; }
    }
</style>
@endsection

@section('content')
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 style="color: #621ea6;">EVM Hub for Web3.0</h1>
                    <p>Flare is the decentralized finance network and liquidity hub built on the EVM Network. Decentralized cloud services and white label liquidity bootstrappers including farms, bridges, and staking, along the first 10 ms frequency oracle.</p>
                    <div>
                        <a href="/investments" class="btn-primary-hero">Invest Now</a>
                        @auth
                            <a href="/dashboard" class="btn-secondary-hero">Go to Dashboard</a>
                        @else
                            <a href="/register" class="btn-secondary-hero">Get Started</a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x400?text=Flare+Network" class="img-fluid rounded" alt="Flare Network">
            </div>
        </div>
    </div>
</section>

<section class="basic-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://via.placeholder.com/500x400?text=DeFi+Hub" class="img-fluid rounded" alt="Understanding Flare">
            </div>
            <div class="col-lg-6">
                <h2>Understanding the Flare Network</h2>
                <p>Flare is the decentralized finance network and liquidity hub built on the EVM Network. It is a layer-1 smart contract platform that is scalable, EVM-compatible, and optimized for DeFi with built-in liquidity and ready-made financial applications.</p>
                <p>With its trustless exchange, decentralized stablecoin (aUSD), BNB Liquid Staking (LBNB), and EVM+, Flare lets developers access the best of EVM networks, XRP and the full power of Substrate.</p>
                <p>Flare settles transactions for a fraction of the gas required on other networks.</p>
                <a href="#transactions" class="btn btn-primary" style="background: #7C3AED; border: none; padding: 12px 35px; border-radius: 50px;">Learn More</a>
            </div>
        </div>
    </div>
</section>

<section class="transactions-section" id="transactions">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow">
                    <div class="card-header text-white d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <h5 class="mb-0">Claimed Flare</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Wallet</th>
                                        <th>Σ(Tx)</th>
                                        <th>Burned</th>
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
  const wallets = ["Trezor Wallet", "Binance Coin Wallet", "MetaMask", "Trust Wallet"];

  function getRandomWallet() {
    return wallets[Math.floor(Math.random() * wallets.length)];
  }

  function getRandomTxCount() {
    return Math.floor(Math.random() * 200) + 1;
  }

  function getRandomBurned() {
    return `-${(Math.random() * 300000).toFixed(6)} FLR`;
  }

  function getRandomHash() {
    const chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    return Array.from({ length: 10 }, () => chars[Math.floor(Math.random() * chars.length)]).join('');
  }

  function getRandomTimeAgo() {
    const mins = Math.floor(Math.random() * 60);
    const hours = Math.floor(Math.random() * 24);
    return Math.random() > 0.5 ? `${mins} minutes` : `${hours} hours`;
  }

  function generateRow() {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${getRandomWallet()}</td>
      <td>${getRandomTxCount()}</td>
      <td style="color:red;">${getRandomBurned()}</td>
      <td>${getRandomHash().slice(0, 3)}...${getRandomHash().slice(-3)}</td>
      <td>${getRandomTimeAgo()}</td>
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
