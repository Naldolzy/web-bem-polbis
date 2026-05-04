<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sedang Maintenance | BEM Polbis</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0a192f 0%, #1e293b 50%, #0a192f 100%);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }
        .bg-particles {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
        }
        .particle {
            position: absolute; border-radius: 50%;
            animation: float linear infinite;
        }
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-20vh) rotate(720deg); opacity: 0; }
        }
        .container {
            position: relative; z-index: 10;
            text-align: center;
            padding: 2rem;
            max-width: 600px;
        }
        .icon-wrap {
            width: 120px; height: 120px; border-radius: 2rem;
            background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(245,158,11,0.05));
            border: 1px solid rgba(245,158,11,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 2rem;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(245,158,11,0.3); transform: scale(1); }
            50% { box-shadow: 0 0 0 20px rgba(245,158,11,0); transform: scale(1.03); }
        }
        .icon-wrap svg { width: 60px; height: 60px; color: #f59e0b; }
        h1 {
            font-size: 2.5rem; font-weight: 900; color: white;
            margin-bottom: 0.75rem; line-height: 1.1;
        }
        h1 span { color: #f59e0b; }
        .subtitle {
            font-size: 1.1rem; color: #94a3b8;
            margin-bottom: 2rem; line-height: 1.6;
        }
        .reason-box {
            background: rgba(245,158,11,0.08);
            border: 1px solid rgba(245,158,11,0.25);
            border-radius: 1rem;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }
        .reason-label {
            font-size: 0.75rem; font-weight: 700; color: #f59e0b;
            text-transform: uppercase; letter-spacing: 0.1em;
            margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;
        }
        .reason-text {
            color: #cbd5e1; font-size: 0.95rem; line-height: 1.6;
        }
        .divider {
            width: 60px; height: 3px;
            background: linear-gradient(90deg, transparent, #f59e0b, transparent);
            margin: 0 auto 2rem;
            border-radius: 999px;
        }
        .footer-text {
            color: #475569; font-size: 0.8rem;
        }
        .logo-text {
            font-size: 0.9rem; color: #64748b; margin-bottom: 2rem;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        }
        .badge {
            background: rgba(245,158,11,0.15);
            color: #f59e0b; border: 1px solid rgba(245,158,11,0.3);
            font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
            padding: 0.2rem 0.6rem; border-radius: 999px; letter-spacing: 0.08em;
        }
    </style>
</head>
<body>

<div class="bg-particles" id="particles"></div>

<div class="container">
    <div class="logo-text">
        <span>BEM Polbis</span>
        <span class="badge">Maintenance</span>
    </div>

    <div class="icon-wrap">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </div>

    <h1>Website Sedang<br><span>Maintenance</span></h1>
    <div class="divider"></div>
    <p class="subtitle">
        Website BEM Polbis untuk sementara tidak dapat diakses.<br>
        Kami sedang melakukan pemeliharaan untuk meningkatkan layanan.
    </p>

    @if(!empty($reason))
    <div class="reason-box">
        <div class="reason-label">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Keterangan
        </div>
        <p class="reason-text">{{ $reason }}</p>
    </div>
    @endif

    <p class="footer-text">Terima kasih atas kesabaran Anda. &mdash; BEM Politeknik Bisnis Digital Indonesia</p>
</div>

<script>
    const container = document.getElementById('particles');
    for (let i = 0; i < 20; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        const size = Math.random() * 5 + 2;
        p.style.cssText = `
            left: ${Math.random() * 100}%;
            width: ${size}px; height: ${size}px;
            background: rgba(245,158,11,${Math.random() * 0.3 + 0.1});
            animation-duration: ${Math.random() * 15 + 10}s;
            animation-delay: ${Math.random() * 10}s;
        `;
        container.appendChild(p);
    }
</script>
</body>
</html>
