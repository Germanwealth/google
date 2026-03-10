<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="prism-logo">
    <defs>
        <linearGradient id="prismGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
            <stop offset="50%" style="stop-color:#A855F7;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#EC4899;stop-opacity:1" />
        </linearGradient>
    </defs>
    
    <!-- Prism crystal -->
    <polygon points="100,20 160,80 160,160 100,200 40,160 40,80" fill="url(#prismGradient)" opacity="0.9"/>
    
    <!-- Inner light -->
    <polygon points="100,40 140,80 140,150 100,180 60,150 60,80" fill="white" opacity="0.15"/>
    
    <!-- Center point -->
    <circle cx="100" cy="100" r="8" fill="white" opacity="0.8"/>
    
    <!-- Light rays -->
    <line x1="100" y1="20" x2="100" y2="0" stroke="url(#prismGradient)" stroke-width="3" stroke-linecap="round"/>
    <line x1="160" y1="80" x2="180" y2="60" stroke="url(#prismGradient)" stroke-width="3" stroke-linecap="round"/>
    <line x1="160" y1="160" x2="180" y2="180" stroke="url(#prismGradient)" stroke-width="3" stroke-linecap="round"/>
    <line x1="40" y1="160" x2="20" y2="180" stroke="url(#prismGradient)" stroke-width="3" stroke-linecap="round"/>
    <line x1="40" y1="80" x2="20" y2="60" stroke="url(#prismGradient)" stroke-width="3" stroke-linecap="round"/>
</svg>

<style>
    .prism-logo {
        width: 100%;
        height: 100%;
        max-width: 60px;
        filter: drop-shadow(0 2px 8px rgba(59, 130, 246, 0.3));
    }
</style>
