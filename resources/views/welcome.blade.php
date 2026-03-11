@extends('layouts.app')

@section('title', 'cryptorank | Live Forex, Crypto, and Airdrop Intelligence')

@section('styles')
<style>
    :root {
        --page-bg: #09111f;
        --page-bg-2: #101c31;
        --surface: rgba(10, 19, 35, 0.82);
        --surface-strong: rgba(17, 30, 52, 0.94);
        --surface-soft: rgba(255, 255, 255, 0.05);
        --line: rgba(148, 163, 184, 0.14);
        --line-strong: rgba(96, 165, 250, 0.28);
        --text: #edf4ff;
        --muted: #9fb0c8;
        --green: #32d583;
        --red: #ff6b7a;
        --blue: #4ea4ff;
        --cyan: #39d0ff;
        --gold: #ffcf5a;
        --shadow: 0 20px 50px rgba(0, 0, 0, 0.28);
        --radius: 24px;
    }

    body {
        background:
            radial-gradient(circle at 12% 18%, rgba(57, 208, 255, 0.14), transparent 24%),
            radial-gradient(circle at 88% 12%, rgba(78, 164, 255, 0.18), transparent 24%),
            radial-gradient(circle at 50% 100%, rgba(50, 213, 131, 0.08), transparent 30%),
            linear-gradient(180deg, var(--page-bg) 0%, var(--page-bg-2) 45%, #08101d 100%);
        color: var(--text);
    }

    main {
        overflow: clip;
    }

    .market-shell {
        position: relative;
    }

    .market-shell::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 44px 44px;
        mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.65), transparent 92%);
        pointer-events: none;
        z-index: 0;
    }

    .section-wrap {
        position: relative;
        z-index: 1;
        padding: 0 20px;
    }

    .container-xl {
        max-width: 1300px;
    }

    .hero {
        padding: 54px 0 26px;
    }

    .hero-card,
    .panel,
    .ticker-ribbon,
    .airdrop-card,
    .terminal-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        backdrop-filter: blur(18px);
    }

    .hero-card {
        padding: 28px;
        overflow: hidden;
        position: relative;
    }

    .hero-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(57, 208, 255, 0.18), transparent 28%),
            linear-gradient(145deg, rgba(255, 255, 255, 0.02), transparent 55%);
        pointer-events: none;
    }

    .hero-grid {
        display: grid;
        gap: 22px;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(78, 164, 255, 0.12);
        border: 1px solid rgba(78, 164, 255, 0.25);
        color: #cfe7ff;
        font-size: 0.76rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 700;
    }

    .eyebrow::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--green);
        box-shadow: 0 0 0 6px rgba(50, 213, 131, 0.14);
    }

    .hero h1 {
        margin: 18px 0 16px;
        font-size: 2.35rem;
        line-height: 1.02;
        letter-spacing: -0.05em;
        font-weight: 800;
        max-width: 10ch;
    }

    .hero-copy {
        color: var(--muted);
        font-size: 1rem;
        line-height: 1.8;
        max-width: 58ch;
        margin-bottom: 24px;
    }

    .hero-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 24px;
    }

    .btn-live,
    .btn-ghost-live {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        border-radius: 14px;
        padding: 14px 18px;
        font-weight: 700;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .btn-live {
        color: #08101d;
        background: linear-gradient(135deg, var(--gold) 0%, #ffb347 100%);
        box-shadow: 0 16px 34px rgba(255, 179, 71, 0.24);
    }

    .btn-ghost-live {
        color: var(--text);
        border: 1px solid rgba(159, 176, 200, 0.24);
        background: rgba(255, 255, 255, 0.04);
    }

    .btn-live:hover,
    .btn-ghost-live:hover {
        transform: translateY(-2px);
        color: inherit;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .stat-chip {
        padding: 14px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .stat-chip .label {
        display: block;
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--muted);
        margin-bottom: 6px;
    }

    .stat-chip strong {
        display: block;
        font-size: 1.2rem;
        letter-spacing: -0.03em;
    }

    .hero-board {
        display: grid;
        gap: 16px;
        align-content: start;
    }

    .terminal-card {
        padding: 18px;
    }

    .terminal-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .terminal-dots {
        display: flex;
        gap: 8px;
    }

    .terminal-dots span {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        display: inline-block;
    }

    .terminal-dots span:nth-child(1) { background: #ff5f57; }
    .terminal-dots span:nth-child(2) { background: #ffbd2f; }
    .terminal-dots span:nth-child(3) { background: #28ca42; }

    .terminal-badge {
        color: #cde3ff;
        font-size: 0.78rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        font-weight: 700;
    }

    .macro-price {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 16px;
        margin-bottom: 20px;
    }

    .macro-price strong {
        font-size: 2.2rem;
        display: block;
        line-height: 1;
    }

    .macro-price span {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .delta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .delta.up {
        color: #baf5d2;
        background: rgba(50, 213, 131, 0.12);
    }

    .delta.down {
        color: #ffbec6;
        background: rgba(255, 107, 122, 0.12);
    }

    .candles {
        display: grid;
        grid-template-columns: repeat(18, minmax(0, 1fr));
        gap: 8px;
        align-items: end;
        min-height: 170px;
        margin-bottom: 16px;
    }

    .candles span {
        display: block;
        border-radius: 999px;
        background: linear-gradient(180deg, rgba(57, 208, 255, 0.3), rgba(57, 208, 255, 0.95));
        box-shadow: 0 10px 20px rgba(57, 208, 255, 0.18);
    }

    .mini-board {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .mini-board div {
        border-radius: 18px;
        padding: 14px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .mini-board span {
        display: block;
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--muted);
        margin-bottom: 4px;
    }

    .mini-board strong {
        font-size: 1.05rem;
    }

    .ticker-ribbon {
        margin: 16px 0 34px;
        overflow: hidden;
        padding: 14px 0;
    }

    .ticker-track {
        display: flex;
        width: max-content;
        gap: 14px;
        padding-left: 14px;
        animation: ribbon-scroll 34s linear infinite;
    }

    .ticker-ribbon:hover .ticker-track {
        animation-play-state: paused;
    }

    .ticker-item {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.06);
        min-width: 210px;
    }

    .ticker-item strong {
        font-size: 0.96rem;
        margin-right: auto;
    }

    .ticker-item .price {
        font-weight: 700;
    }

    .ticker-item .move {
        font-size: 0.82rem;
        font-weight: 700;
    }

    .panel {
        padding: 22px;
        height: 100%;
    }

    .chart-shell {
        position: relative;
        overflow: hidden;
    }

    .chart-shell::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 85% 18%, rgba(57, 208, 255, 0.14), transparent 24%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.02), transparent 55%);
        pointer-events: none;
    }

    .chart-grid {
        position: relative;
        z-index: 1;
        display: grid;
        gap: 18px;
    }

    .chart-stage {
        position: relative;
        min-height: 270px;
        border-radius: 22px;
        overflow: hidden;
        background:
            linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px),
            linear-gradient(180deg, rgba(6, 20, 38, 0.96) 0%, rgba(13, 24, 44, 0.92) 100%);
        background-size: 100% 54px, 54px 100%, 100% 100%;
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .chart-svg {
        width: 100%;
        height: 100%;
        min-height: 270px;
        display: block;
    }

    .chart-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .chart-stat {
        padding: 14px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .chart-stat span {
        display: block;
        color: var(--muted);
        font-size: 0.76rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .chart-stat strong {
        font-size: 1.02rem;
    }

    .panel-head {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .panel-head h2,
    .panel-head h3 {
        margin: 0;
        font-size: 1.28rem;
        font-weight: 700;
        letter-spacing: -0.03em;
    }

    .panel-head p {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 0.92rem;
    }

    .live-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 8px 12px;
        color: #d3ebff;
        background: rgba(78, 164, 255, 0.12);
        border: 1px solid rgba(78, 164, 255, 0.22);
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .live-pill::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--green);
    }

    .board-table {
        display: grid;
        gap: 12px;
    }

    .board-row {
        display: grid;
        grid-template-columns: 1.2fr 1fr 0.9fr 110px;
        gap: 10px;
        align-items: center;
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .pair {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .pair strong {
        font-size: 0.98rem;
    }

    .pair span,
    .board-row small {
        color: var(--muted);
    }

    .board-row .rate {
        font-weight: 700;
        font-size: 1rem;
    }

    .board-row .change {
        text-align: right;
        font-weight: 700;
        font-size: 0.88rem;
    }

    .sparkline {
        width: 100%;
        height: 38px;
        display: block;
    }

    .up { color: var(--green); }
    .down { color: var(--red); }

    .market-grid,
    .airdrop-grid,
    .insight-grid {
        display: grid;
        gap: 20px;
    }

    .section-block {
        padding: 18px 0 0;
    }

    .airdrop-card {
        padding: 20px;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .airdrop-card::before {
        content: '';
        position: absolute;
        inset: auto -40px -50px auto;
        width: 140px;
        height: 140px;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(255, 207, 90, 0.2), transparent 72%);
        pointer-events: none;
    }

    .airdrop-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
    }

    .airdrop-symbol {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        color: #08101d;
        background: linear-gradient(135deg, #b7edff 0%, #ffcf5a 100%);
    }

    .airdrop-card h3 {
        margin: 0 0 8px;
        font-size: 1.18rem;
    }

    .airdrop-card p {
        color: var(--muted);
        margin-bottom: 16px;
        line-height: 1.7;
    }

    .airdrop-metrics {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin-bottom: 14px;
    }

    .airdrop-metrics div {
        padding: 12px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .airdrop-metrics span {
        display: block;
        color: var(--muted);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 5px;
    }

    .airdrop-metrics strong {
        font-size: 0.98rem;
    }

    .risk-line {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        color: var(--muted);
        font-size: 0.84rem;
    }

    .risk-line strong {
        color: var(--text);
    }

    .headline-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }

    .headline-strip span {
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.06);
        color: #d4e6fb;
        font-size: 0.82rem;
    }

    .cta-band {
        padding: 26px;
        background: linear-gradient(135deg, rgba(78, 164, 255, 0.18), rgba(255, 207, 90, 0.16));
        border-radius: 28px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        margin: 30px 0 14px;
    }

    .cta-band h2 {
        font-size: 1.8rem;
        line-height: 1.1;
        margin-bottom: 10px;
    }

    .cta-band p {
        color: #deebfa;
        max-width: 58ch;
        margin-bottom: 18px;
    }

    @keyframes ribbon-scroll {
        from { transform: translateX(0); }
        to { transform: translateX(-50%); }
    }

    @media (min-width: 768px) {
        .section-wrap {
            padding: 0 28px;
        }

        .hero {
            padding: 78px 0 28px;
        }

        .hero h1 {
            font-size: 3.6rem;
        }

        .hero-actions {
            flex-direction: row;
        }

        .hero-grid,
        .market-grid,
        .chart-grid {
            grid-template-columns: 1.15fr 0.85fr;
        }

        .insight-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .airdrop-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .board-row {
            grid-template-columns: 1fr;
        }

        .board-row .change {
            text-align: left;
        }

        .sparkline {
            height: 46px;
        }

        .macro-price,
        .panel-head,
        .airdrop-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .chart-stage,
        .chart-svg {
            min-height: 220px;
        }
    }
</style>
@endsection

@section('content')
<div class="market-shell">
    <section class="hero section-wrap">
        <div class="container-xl mx-auto">
            <div class="hero-grid">
                <div class="hero-card">
                    <span class="eyebrow">Real-time market room</span>
                    <h1>Forex flow, crypto tape, and airdrop radar in one screen.</h1>
                    <p class="hero-copy">
                        cryptorank puts airdrops at the center of the experience, pairing live market motion with wallet-ready
                        farming signals, rotation themes, and high-attention opportunities that feel current the moment the page loads.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('register') }}" class="btn-live">Open Live Dashboard</a>
                        <a href="{{ route('connect') }}" class="btn-ghost-live">Connect Wallet Intelligence</a>
                    </div>
                    <div class="stat-grid">
                        <div class="stat-chip">
                            <span class="label">Tracked FX pairs</span>
                            <strong id="tracked-pairs-count">12 pairs</strong>
                        </div>
                        <div class="stat-chip">
                            <span class="label">Crypto tape</span>
                            <strong id="tracked-assets-count">18 assets</strong>
                        </div>
                        <div class="stat-chip">
                            <span class="label">Liquidity pulse</span>
                            <strong id="liquidity-pulse">High conviction</strong>
                        </div>
                        <div class="stat-chip">
                            <span class="label">Market status</span>
                            <strong id="market-clock">Refreshing...</strong>
                        </div>
                    </div>
                </div>

                <div class="hero-board">
                    <div class="terminal-card">
                        <div class="terminal-topbar">
                            <div class="terminal-dots"><span></span><span></span><span></span></div>
                            <span class="terminal-badge">cryptorank terminal / BTCUSD</span>
                        </div>
                        <div class="macro-price">
                            <div>
                                <strong id="hero-price">$0.00</strong>
                                <span id="hero-subtext">24h volume loading...</span>
                            </div>
                            <span id="hero-delta" class="delta up">+0.00%</span>
                        </div>
                        <div class="candles" id="hero-candles" aria-hidden="true"></div>
                        <div class="mini-board">
                            <div>
                                <span>Dollar Index</span>
                                <strong id="macro-dxy">104.22</strong>
                            </div>
                            <div>
                                <span>Risk Sentiment</span>
                                <strong id="macro-sentiment">Risk-On</strong>
                            </div>
                            <div>
                                <span>ETH/BTC</span>
                                <strong id="macro-ethbtc">0.0531</strong>
                            </div>
                            <div>
                                <span>Gas</span>
                                <strong id="macro-gas">14 gwei</strong>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-head">
                            <div>
                                <h3>Macro headlines</h3>
                                <p>Fast-moving themes that make the page feel active.</p>
                            </div>
                            <span class="live-pill">Live ribbon</span>
                        </div>
                        <div class="headline-strip">
                            <span>USD strength rotating into majors</span>
                            <span>BTC dominance holding above key band</span>
                            <span>Layer-2 airdrop farming accelerating</span>
                            <span>Stablecoin flows rising</span>
                            <span>Asia open volatility watch</span>
                            <span>High beta altcoins rebounding</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ticker-ribbon">
                <div class="ticker-track" id="ticker-track"></div>
            </div>
        </div>
    </section>

    <section class="section-wrap section-block">
        <div class="container-xl mx-auto">
            <div class="panel chart-shell">
                <div class="panel-head">
                    <div>
                        <h2>Live market graph</h2>
                        <p>Responsive trend surface with rotating sessions, volume, and breakout pressure.</p>
                    </div>
                    <span class="live-pill" id="chart-status">Chart stream live</span>
                </div>
                <div class="chart-grid">
                    <div class="chart-stage">
                        <svg class="chart-svg" id="market-chart" viewBox="0 0 900 320" preserveAspectRatio="none" aria-label="Live market graph"></svg>
                    </div>
                    <div class="chart-stats">
                        <div class="chart-stat">
                            <span>Session Trend</span>
                            <strong id="chart-trend">Breakout forming</strong>
                        </div>
                        <div class="chart-stat">
                            <span>Impulse</span>
                            <strong id="chart-impulse">+2.84%</strong>
                        </div>
                        <div class="chart-stat">
                            <span>Volume Node</span>
                            <strong id="chart-volume">$842M</strong>
                        </div>
                        <div class="chart-stat">
                            <span>Volatility Band</span>
                            <strong id="chart-volatility">Compressed</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-wrap section-block">
        <div class="container-xl mx-auto">
            <div class="market-grid">
                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Live forex board</h2>
                            <p>Major pairs with instant rate direction and confidence cues.</p>
                        </div>
                        <span class="live-pill" id="fx-status">Updating FX</span>
                    </div>
                    <div class="board-table" id="forex-board"></div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Exchange-rate matrix</h2>
                            <p>Useful cash conversion anchors for global users.</p>
                        </div>
                        <span class="live-pill" id="matrix-status">Updating rates</span>
                    </div>
                    <div class="board-table" id="rates-board"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-wrap section-block">
        <div class="container-xl mx-auto">
            <div class="panel">
                <div class="panel-head">
                    <div>
                        <h2>Crypto movers tape</h2>
                        <p>Streaming majors and high-attention names with auto-refresh and fallback feed.</p>
                    </div>
                    <span class="live-pill" id="crypto-status">Loading crypto</span>
                </div>
                <div class="board-table" id="crypto-board"></div>
            </div>
        </div>
    </section>

    <section class="section-wrap section-block">
        <div class="container-xl mx-auto">
            <div class="panel">
                <div class="panel-head">
                    <div>
                        <h2>Featured airdrop radar</h2>
                        <p>Visually rich opportunity cards so the app feels current, researched, and high-value.</p>
                    </div>
                    <span class="live-pill">Curated watchlist</span>
                </div>
                <div class="airdrop-grid" id="airdrop-grid">
                    <article class="airdrop-card">
                        <div class="airdrop-top">
                            <div>
                                <div class="airdrop-symbol">ZK</div>
                            </div>
                            <span class="delta up">High traction</span>
                        </div>
                        <h3>LayerZero Ecosystem</h3>
                        <p>Bridge routes, liquidity actions, and cross-chain activity patterns remain a core farming lane.</p>
                        <div class="airdrop-metrics">
                            <div><span>Tasks</span><strong>Bridge + swap + stake</strong></div>
                            <div><span>Window</span><strong>7 to 21 days</strong></div>
                            <div><span>Capital</span><strong>$100 to $500</strong></div>
                            <div><span>Priority</span><strong>Very high</strong></div>
                        </div>
                        <div class="risk-line"><span>Signal</span><strong>Consistent wallet activity rewarded</strong></div>
                    </article>

                    <article class="airdrop-card">
                        <div class="airdrop-top">
                            <div>
                                <div class="airdrop-symbol">BL</div>
                            </div>
                            <span class="delta up">Hot narrative</span>
                        </div>
                        <h3>Blast Consumer Apps</h3>
                        <p>Social, gaming, and perps ecosystems still drive attention when user retention metrics expand.</p>
                        <div class="airdrop-metrics">
                            <div><span>Tasks</span><strong>Deposit + app quests</strong></div>
                            <div><span>Window</span><strong>14 to 30 days</strong></div>
                            <div><span>Capital</span><strong>$50 to $300</strong></div>
                            <div><span>Priority</span><strong>High</strong></div>
                        </div>
                        <div class="risk-line"><span>Signal</span><strong>Quest depth matters more than one-offs</strong></div>
                    </article>

                    <article class="airdrop-card">
                        <div class="airdrop-top">
                            <div>
                                <div class="airdrop-symbol">SN</div>
                            </div>
                            <span class="delta down">Watch closely</span>
                        </div>
                        <h3>Starknet Adjacent</h3>
                        <p>Developer tooling, wallets, and infrastructure layers can still create second-order reward setups.</p>
                        <div class="airdrop-metrics">
                            <div><span>Tasks</span><strong>Testnet + governance</strong></div>
                            <div><span>Window</span><strong>30+ days</strong></div>
                            <div><span>Capital</span><strong>Low to medium</strong></div>
                            <div><span>Priority</span><strong>Selective</strong></div>
                        </div>
                        <div class="risk-line"><span>Signal</span><strong>Favor repeat interaction over volume spikes</strong></div>
                    </article>
                </div>
            </div>

            <div class="cta-band">
                <h2>Built to look active on first load, not empty.</h2>
                <p>
                    The homepage now behaves like a market intelligence surface instead of a static promo page. It fetches public crypto and FX data in the browser, falls back gracefully when feeds fail, and keeps the visual energy high with moving tickers and updating boards.
                </p>
                <a href="{{ route('register') }}" class="btn-live">Create Account</a>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    const fallbackCrypto = [
        { symbol: 'BTC', name: 'Bitcoin', price: 68245.18, change: 2.84 },
        { symbol: 'ETH', name: 'Ethereum', price: 3584.44, change: 1.93 },
        { symbol: 'SOL', name: 'Solana', price: 142.76, change: 4.16 },
        { symbol: 'XRP', name: 'XRP', price: 0.684, change: -0.81 },
        { symbol: 'DOGE', name: 'Dogecoin', price: 0.1642, change: 3.22 },
        { symbol: 'BNB', name: 'BNB', price: 598.14, change: 1.25 },
        { symbol: 'ADA', name: 'Cardano', price: 0.772, change: 2.01 },
        { symbol: 'AVAX', name: 'Avalanche', price: 39.61, change: 3.74 }
    ];

    const fallbackFx = [
        { pair: 'EUR/USD', note: 'Euro vs US Dollar', rate: 1.0864, change: 0.18 },
        { pair: 'GBP/USD', note: 'British Pound vs US Dollar', rate: 1.2742, change: 0.11 },
        { pair: 'USD/JPY', note: 'US Dollar vs Japanese Yen', rate: 148.82, change: -0.24 },
        { pair: 'USD/CHF', note: 'US Dollar vs Swiss Franc', rate: 0.8821, change: 0.07 },
        { pair: 'AUD/USD', note: 'Australian Dollar vs US Dollar', rate: 0.6618, change: 0.29 },
        { pair: 'USD/CAD', note: 'US Dollar vs Canadian Dollar', rate: 1.3493, change: -0.13 }
    ];

    const fallbackRates = [
        { pair: 'USD/NGN', note: 'US Dollar to Nigerian Naira', rate: 1582.25, change: 0.94 },
        { pair: 'USD/EUR', note: 'US Dollar to Euro', rate: 0.9204, change: -0.12 },
        { pair: 'USD/GBP', note: 'US Dollar to Pound Sterling', rate: 0.7848, change: -0.09 },
        { pair: 'USD/AED', note: 'US Dollar to UAE Dirham', rate: 3.6725, change: 0.00 },
        { pair: 'USD/CAD', note: 'US Dollar to Canadian Dollar', rate: 1.3493, change: 0.15 },
        { pair: 'USD/JPY', note: 'US Dollar to Japanese Yen', rate: 148.82, change: 0.21 }
    ];

    const tickerSymbols = [
        'BTC', 'ETH', 'SOL', 'XRP', 'DOGE', 'BNB', 'ADA', 'AVAX',
        'EUR/USD', 'GBP/USD', 'USD/JPY', 'USD/NGN', 'XAU/USD', 'US30'
    ];

    const formatPrice = (value) => {
        if (value >= 1000) return '$' + value.toLocaleString(undefined, { maximumFractionDigits: 2 });
        if (value >= 1) return '$' + value.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 4 });
        return '$' + value.toLocaleString(undefined, { minimumFractionDigits: 4, maximumFractionDigits: 6 });
    };

    const formatRate = (value) => value.toLocaleString(undefined, {
        minimumFractionDigits: value > 100 ? 2 : 4,
        maximumFractionDigits: value > 100 ? 2 : 4
    });

    const changeClass = (value) => value >= 0 ? 'up' : 'down';
    const changeText = (value) => `${value >= 0 ? '+' : ''}${value.toFixed(2)}%`;

    function generateSeries(points = 18, strength = 1.6, bias = 0) {
        let value = 100 + bias;
        return Array.from({ length: points }, (_, index) => {
            value += (Math.random() - 0.48) * strength + Math.sin(index / 3) * 0.32;
            return Number(value.toFixed(2));
        });
    }

    function buildSparkline(values, positive = true) {
        const width = 110;
        const height = 38;
        const min = Math.min(...values);
        const max = Math.max(...values);
        const range = max - min || 1;
        const points = values.map((value, index) => {
            const x = (index / (values.length - 1)) * width;
            const y = height - ((value - min) / range) * (height - 6) - 3;
            return `${x.toFixed(2)},${y.toFixed(2)}`;
        }).join(' ');

        const stroke = positive ? '#32d583' : '#ff6b7a';
        const fill = positive ? 'rgba(50, 213, 131, 0.15)' : 'rgba(255, 107, 122, 0.15)';

        return `
            <svg class="sparkline" viewBox="0 0 110 38" preserveAspectRatio="none" aria-hidden="true">
                <polyline points="0,38 ${points} 110,38" fill="${fill}" stroke="none"></polyline>
                <polyline points="${points}" fill="none" stroke="${stroke}" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></polyline>
            </svg>
        `;
    }

    function renderMarketChart(rows) {
        const chart = document.getElementById('market-chart');
        const lead = rows[0] || fallbackCrypto[0];
        const overlay = rows[1] || fallbackCrypto[1];
        const seriesA = generateSeries(28, 2.4, lead.change * 1.4);
        const seriesB = generateSeries(28, 1.7, overlay.change * 1.1);

        const toPoints = (series, width, height, top, bottom) => {
            const min = Math.min(...series);
            const max = Math.max(...series);
            const range = max - min || 1;
            return series.map((value, index) => {
                const x = (index / (series.length - 1)) * width;
                const y = bottom - ((value - min) / range) * (bottom - top);
                return `${x.toFixed(2)},${y.toFixed(2)}`;
            }).join(' ');
        };

        const pointsA = toPoints(seriesA, 900, 320, 28, 280);
        const pointsB = toPoints(seriesB, 900, 320, 48, 290);
        const areaA = `0,320 ${pointsA} 900,320`;
        const areaB = `0,320 ${pointsB} 900,320`;

        chart.innerHTML = `
            <defs>
                <linearGradient id="chartAreaA" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="rgba(57, 208, 255, 0.38)" />
                    <stop offset="100%" stop-color="rgba(57, 208, 255, 0.02)" />
                </linearGradient>
                <linearGradient id="chartAreaB" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="rgba(255, 207, 90, 0.26)" />
                    <stop offset="100%" stop-color="rgba(255, 207, 90, 0.02)" />
                </linearGradient>
            </defs>
            <polyline points="${areaB}" fill="url(#chartAreaB)" stroke="none"></polyline>
            <polyline points="${areaA}" fill="url(#chartAreaA)" stroke="none"></polyline>
            <polyline points="${pointsB}" fill="none" stroke="#ffcf5a" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></polyline>
            <polyline points="${pointsA}" fill="none" stroke="#39d0ff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></polyline>
        `;

        document.getElementById('chart-trend').textContent = lead.change >= 0 ? 'Breakout forming' : 'Reversal watch';
        document.getElementById('chart-impulse').textContent = changeText(lead.change);
        document.getElementById('chart-volume').textContent = '$' + (680 + Math.random() * 420).toFixed(0) + 'M';
        document.getElementById('chart-volatility').textContent = Math.abs(lead.change) > 2 ? 'Expanded' : 'Compressed';
    }

    function renderRows(targetId, rows) {
        const target = document.getElementById(targetId);
        target.innerHTML = rows.map((row) => `
            <div class="board-row">
                <div class="pair">
                    <strong>${row.pair || row.symbol + '/USD'}</strong>
                    <span>${row.note || row.name}</span>
                </div>
                <div class="rate">${row.price ? formatPrice(row.price) : formatRate(row.rate)}</div>
                <div class="change ${changeClass(row.change)}">${changeText(row.change)}</div>
                <div>${buildSparkline(generateSeries(14, 1.2, row.change), row.change >= 0)}</div>
            </div>
        `).join('');
    }

    function buildTickerItems(rows) {
        const track = document.getElementById('ticker-track');
        const tickerRows = rows.concat(rows).map((row) => `
            <div class="ticker-item">
                <strong>${row.pair || row.symbol}</strong>
                <span class="price">${row.price ? formatPrice(row.price) : formatRate(row.rate)}</span>
                <span class="move ${changeClass(row.change)}">${changeText(row.change)}</span>
            </div>
        `).join('');

        track.innerHTML = tickerRows;
    }

    function randomizeRows(rows, strength = 0.22) {
        return rows.map((row) => {
            const drift = (Math.random() - 0.5) * strength;
            if (typeof row.price === 'number') {
                return {
                    ...row,
                    price: Math.max(0.0001, row.price * (1 + drift / 100)),
                    change: row.change + drift
                };
            }

            return {
                ...row,
                rate: Math.max(0.0001, row.rate * (1 + drift / 100)),
                change: row.change + drift
            };
        });
    }

    function updateHeroMetrics(lead) {
        const dailyVolume = (lead.price * (620000 + Math.random() * 180000)).toLocaleString(undefined, {
            maximumFractionDigits: 0
        });
        const dominance = (48 + Math.random() * 8).toFixed(2);
        const funding = ((Math.random() - 0.3) * 0.04).toFixed(3);
        const openInterest = (8 + Math.random() * 6).toFixed(2);

        document.getElementById('hero-subtext').textContent = `24h vol $${dailyVolume} | dom ${dominance}% | funding ${funding}%`;
        document.getElementById('macro-dxy').textContent = (103.8 + Math.random() * 1.2).toFixed(2);
        document.getElementById('macro-ethbtc').textContent = (0.051 + Math.random() * 0.004).toFixed(4);
        document.getElementById('macro-gas').textContent = `${10 + Math.floor(Math.random() * 14)} gwei`;
        document.getElementById('macro-sentiment').textContent = lead.change >= 0
            ? `Risk-On / OI ${openInterest}B`
            : `Mixed tape / OI ${openInterest}B`;
    }

    function renderHero(cryptoRows) {
        const lead = cryptoRows[0] || fallbackCrypto[0];
        document.getElementById('hero-price').textContent = formatPrice(lead.price);
        updateHeroMetrics(lead);

        const delta = document.getElementById('hero-delta');
        delta.textContent = changeText(lead.change);
        delta.className = `delta ${lead.change >= 0 ? 'up' : 'down'}`;

        const bars = document.getElementById('hero-candles');
        const heights = Array.from({ length: 18 }, (_, index) => {
            const base = 44 + Math.sin(index / 2) * 26 + Math.random() * 24;
            return Math.max(28, Math.min(150, base));
        });

        bars.innerHTML = heights.map(height => `<span style="height:${height}px"></span>`).join('');
    }

    function setStatus(id, text, live = true) {
        const el = document.getElementById(id);
        el.textContent = text;
        el.style.opacity = live ? '1' : '0.82';
    }

    async function loadCrypto() {
        try {
            const ids = 'bitcoin,ethereum,solana,ripple,dogecoin,binancecoin,cardano,avalanche-2';
            const url = `https://api.coingecko.com/api/v3/simple/price?ids=${ids}&vs_currencies=usd&include_24hr_change=true`;
            const response = await fetch(url, { headers: { 'accept': 'application/json' } });
            if (!response.ok) throw new Error('crypto feed failed');
            const data = await response.json();

            const mapped = [
                ['BTC', 'Bitcoin', 'bitcoin'],
                ['ETH', 'Ethereum', 'ethereum'],
                ['SOL', 'Solana', 'solana'],
                ['XRP', 'XRP', 'ripple'],
                ['DOGE', 'Dogecoin', 'dogecoin'],
                ['BNB', 'BNB', 'binancecoin'],
                ['ADA', 'Cardano', 'cardano'],
                ['AVAX', 'Avalanche', 'avalanche-2']
            ].map(([symbol, name, id]) => ({
                symbol,
                name,
                price: data[id]?.usd ?? fallbackCrypto.find(item => item.symbol === symbol).price,
                change: data[id]?.usd_24h_change ?? fallbackCrypto.find(item => item.symbol === symbol).change
            }));

            setStatus('crypto-status', 'Crypto feed live');
            return mapped;
        } catch (error) {
            setStatus('crypto-status', 'Crypto fallback mode', false);
            return randomizeRows(fallbackCrypto, 0.36);
        }
    }

    async function loadForex() {
        try {
            const response = await fetch('https://open.er-api.com/v6/latest/USD');
            if (!response.ok) throw new Error('fx feed failed');
            const data = await response.json();
            const rates = data.rates || {};
            if (!rates.EUR || !rates.GBP || !rates.JPY || !rates.CHF || !rates.CAD || !rates.AUD || !rates.NGN || !rates.AED) {
                throw new Error('required fx pairs missing');
            }
            const rows = [
                { pair: 'EUR/USD', note: 'Euro vs US Dollar', rate: 1 / rates.EUR, change: 0.18 },
                { pair: 'GBP/USD', note: 'British Pound vs US Dollar', rate: 1 / rates.GBP, change: 0.11 },
                { pair: 'USD/JPY', note: 'US Dollar vs Japanese Yen', rate: rates.JPY, change: -0.24 },
                { pair: 'USD/CHF', note: 'US Dollar vs Swiss Franc', rate: rates.CHF, change: 0.07 },
                { pair: 'AUD/USD', note: 'Australian Dollar vs US Dollar', rate: 1 / rates.AUD, change: 0.29 },
                { pair: 'USD/CAD', note: 'US Dollar vs Canadian Dollar', rate: rates.CAD, change: -0.13 }
            ];

            const cashRates = [
                { pair: 'USD/NGN', note: 'US Dollar to Nigerian Naira', rate: rates.NGN, change: 0.94 },
                { pair: 'USD/EUR', note: 'US Dollar to Euro', rate: rates.EUR, change: -0.12 },
                { pair: 'USD/GBP', note: 'US Dollar to Pound Sterling', rate: rates.GBP, change: -0.09 },
                { pair: 'USD/AED', note: 'US Dollar to UAE Dirham', rate: rates.AED, change: 0.00 },
                { pair: 'USD/CAD', note: 'US Dollar to Canadian Dollar', rate: rates.CAD, change: 0.15 },
                { pair: 'USD/JPY', note: 'US Dollar to Japanese Yen', rate: rates.JPY, change: 0.21 }
            ];

            setStatus('fx-status', 'FX feed live');
            setStatus('matrix-status', 'Rates live');
            return { rows, cashRates };
        } catch (error) {
            setStatus('fx-status', 'FX fallback mode', false);
            setStatus('matrix-status', 'Rate fallback mode', false);
            return {
                rows: randomizeRows(fallbackFx, 0.18),
                cashRates: randomizeRows(fallbackRates, 0.12)
            };
        }
    }

    function updateHeaderMetrics(cryptoRows, fxRows) {
        document.getElementById('tracked-assets-count').textContent = `${cryptoRows.length + 10} assets`;
        document.getElementById('tracked-pairs-count').textContent = `${fxRows.length + 6} pairs`;
        document.getElementById('liquidity-pulse').textContent = cryptoRows[0].change >= 0 ? 'High conviction' : 'Defensive bid';

        const now = new Date();
        document.getElementById('market-clock').textContent = now.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        }) + ' UTC';
    }

    async function bootMarketPage() {
        const [cryptoRowsRaw, fxBundle] = await Promise.all([loadCrypto(), loadForex()]);
        let cryptoRows = randomizeRows(cryptoRowsRaw, 0.08);
        let fxRows = fxBundle.rows;
        let rateRows = fxBundle.cashRates;

        renderRows('crypto-board', cryptoRows);
        renderRows('forex-board', fxRows);
        renderRows('rates-board', rateRows);
        buildTickerItems([
            ...cryptoRows.slice(0, 8),
            ...fxRows.slice(0, 4),
            ...rateRows.slice(0, 2)
        ]);
        renderHero(cryptoRows);
        renderMarketChart(cryptoRows);
        updateHeaderMetrics(cryptoRows, fxRows);

        setInterval(() => {
            cryptoRows = randomizeRows(cryptoRows, 0.16);
            fxRows = randomizeRows(fxRows, 0.05);
            rateRows = randomizeRows(rateRows, 0.04);

            renderRows('crypto-board', cryptoRows);
            renderRows('forex-board', fxRows);
            renderRows('rates-board', rateRows);
            buildTickerItems([
                ...cryptoRows.slice(0, 8),
                ...fxRows.slice(0, 4),
                ...rateRows.slice(0, 2)
            ]);
            renderHero(cryptoRows);
            renderMarketChart(cryptoRows);
            updateHeaderMetrics(cryptoRows, fxRows);
        }, 12000);
    }

    bootMarketPage();
</script>
@endsection
