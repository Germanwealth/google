@section('styles')
<style>
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        padding: 40px 0;
    }

    .feature-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #E2E8F0;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        border-color: #3B82F6;
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-icon svg {
        width: 100%;
        height: 100%;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .feature-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 12px;
    }

    .feature-description {
        color: #6B7280;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .accent-line {
        width: 4px;
        height: 40px;
        background: linear-gradient(135deg, #3B82F6, #A855F7);
        border-radius: 2px;
        margin-bottom: 15px;
    }
</style>
@endsection

<section class="features-grid">
    <!-- Security Feature -->
    <div class="feature-card">
        <div class="accent-line"></div>
        <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                <defs>
                    <linearGradient id="secGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <rect x="12" y="16" width="40" height="48" rx="4" fill="url(#secGrad)"/>
                <path d="M32 16V8l-16 6v12c0 12 16 16 16 16s16-4 16-16V14l-16-6v8z" fill="white" opacity="0.9"/>
            </svg>
        </div>
        <h3 class="feature-title">Bank-Level Security</h3>
        <p class="feature-description">Military-grade encryption and multi-signature wallets protect your assets with enterprise-level security protocols.</p>
    </div>

    <!-- Analytics Feature -->
    <div class="feature-card">
        <div class="accent-line"></div>
        <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                <defs>
                    <linearGradient id="analyticGrad" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#06B6D4;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <rect x="10" y="42" width="8" height="16" rx="2" fill="url(#analyticGrad)"/>
                <rect x="24" y="28" width="8" height="30" rx="2" fill="url(#analyticGrad)"/>
                <rect x="38" y="10" width="8" height="48" rx="2" fill="url(#analyticGrad)"/>
                <rect x="52" y="18" width="8" height="40" rx="2" fill="url(#analyticGrad)"/>
                <line x1="8" y1="58" x2="56" y2="58" stroke="url(#analyticGrad)" stroke-width="2"/>
            </svg>
        </div>
        <h3 class="feature-title">Advanced Analytics</h3>
        <p class="feature-description">Real-time insights and predictive analysis powered by AI to optimize your portfolio performance.</p>
    </div>

    <!-- Speed Feature -->
    <div class="feature-card">
        <div class="accent-line"></div>
        <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                <defs>
                    <linearGradient id="speedGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#F59E0B;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#D97706;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <circle cx="32" cy="32" r="26" fill="none" stroke="url(#speedGrad)" stroke-width="3"/>
                <circle cx="32" cy="32" r="20" fill="none" stroke="url(#speedGrad)" stroke-width="2" opacity="0.6"/>
                <line x1="32" y1="32" x2="32" y2="10" stroke="url(#speedGrad)" stroke-width="3" stroke-linecap="round"/>
                <circle cx="32" cy="32" r="4" fill="url(#speedGrad)"/>
            </svg>
        </div>
        <h3 class="feature-title">Lightning Fast</h3>
        <p class="feature-description">Transactions execute in milliseconds with optimized blockchain infrastructure for seamless trading.</p>
    </div>

    <!-- Multi-Chain Feature -->
    <div class="feature-card">
        <div class="accent-line"></div>
        <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                <defs>
                    <linearGradient id="chainGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#A855F7;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#7C3AED;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <circle cx="16" cy="32" r="10" fill="url(#chainGrad)"/>
                <circle cx="32" cy="32" r="10" fill="url(#chainGrad)"/>
                <circle cx="48" cy="32" r="10" fill="url(#chainGrad)"/>
                <line x1="26" y1="32" x2="38" y2="32" stroke="white" stroke-width="2"/>
                <line x1="42" y1="32" x2="54" y2="32" stroke="white" stroke-width="2"/>
            </svg>
        </div>
        <h3 class="feature-title">Multi-Chain Support</h3>
        <p class="feature-description">Seamlessly manage assets across Ethereum, Polygon, Solana, and 10+ major blockchain networks.</p>
    </div>

    <!-- Wallet Management Feature -->
    <div class="feature-card">
        <div class="accent-line"></div>
        <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                <defs>
                    <linearGradient id="walletGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#EC4899;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#DB2777;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <rect x="8" y="18" width="48" height="32" rx="4" fill="url(#walletGrad)" opacity="0.9"/>
                <rect x="12" y="22" width="40" height="24" rx="3" fill="white" opacity="0.15"/>
                <circle cx="48" cy="40" r="5" fill="white" opacity="0.7"/>
                <rect x="8" y="14" width="32" height="6" rx="2" fill="url(#walletGrad)"/>
            </svg>
        </div>
        <h3 class="feature-title">Wallet Integration</h3>
        <p class="feature-description">Connect your favorite wallets including MetaMask, WalletConnect, and hardware wallets in seconds.</p>
    </div>

    <!-- 24/7 Support Feature -->
    <div class="feature-card">
        <div class="accent-line"></div>
        <div class="feature-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                <defs>
                    <linearGradient id="supportGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#06B6D4;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0891B2;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <circle cx="32" cy="28" r="14" fill="url(#supportGrad)" opacity="0.2"/>
                <path d="M20 32h4m-4-8h8m-8 16h8" stroke="url(#supportGrad)" stroke-width="2" stroke-linecap="round"/>
                <circle cx="44" cy="40" r="12" fill="url(#supportGrad)"/>
                <path d="M40 40h8M44 36v8" stroke="white" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
        <h3 class="feature-title">24/7 Support</h3>
        <p class="feature-description">Expert support team available around the clock to help with any questions or technical issues.</p>
    </div>
</section>
