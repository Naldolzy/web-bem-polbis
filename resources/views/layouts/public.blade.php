<!DOCTYPE html>
<html lang="id" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $seo_profil = \App\Models\ProfilBem::getAllAsArray();
        $seo_url = url()->current();
        $seo_site_name = ($seo_profil['nama_bem'] ?? 'BEM Polbis') . ' ' . ($seo_profil['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia');
        $seo_logo = !empty($seo_profil['logo_bem']) ? Storage::url($seo_profil['logo_bem']) : asset('favicon.ico');
        $seo_og_image = !empty($seo_profil['logo_bem']) ? Storage::url($seo_profil['logo_bem']) : $seo_logo;
    @endphp

    {{-- Primary Meta --}}
    <title>@yield('title', 'BEM Polbis') | BEM Politeknik Bisnis Digital Indonesia</title>
    <meta name="description"
        content="@yield('meta_description', 'Website resmi Badan Eksekutif Mahasiswa Politeknik Bisnis Digital Indonesia. Informasi kegiatan, struktur organisasi, dan berita terkini mahasiswa.')">
    <meta name="keywords"
        content="BEM Polbis, Badan Eksekutif Mahasiswa, Politeknik Bisnis Digital Indonesia, organisasi mahasiswa, HIMA, kegiatan mahasiswa">
    <meta name="author" content="BEM Politeknik Bisnis Digital Indonesia">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <link rel="canonical" href="{{ $seo_url }}">

    {{-- PWA / Mobile Browser --}}
    <meta name="theme-color" content="#1565C0">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="BEM Polbis">


    {{-- Favicon & App Icons --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo-bem.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $seo_url }}">
    <meta property="og:title" content="@yield('title', 'BEM Polbis') | BEM Polbis">
    <meta property="og:description"
        content="@yield('meta_description', 'Website resmi Badan Eksekutif Mahasiswa Politeknik Bisnis Digital Indonesia. Informasi kegiatan, struktur organisasi, dan berita terkini mahasiswa.')">
    <meta property="og:image" content="@yield('og_image', $seo_og_image)">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="{{ $seo_site_name }}">
    <meta property="og:locale" content="id_ID">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'BEM Polbis') | BEM Polbis">
    <meta name="twitter:description"
        content="@yield('meta_description', 'Website resmi Badan Eksekutif Mahasiswa Politeknik Bisnis Digital Indonesia. Informasi kegiatan, struktur organisasi, dan berita terkini mahasiswa.')">
    <meta name="twitter:image" content="@yield('og_image', $seo_og_image)">

    {{-- Structured Data: Organization (hanya di beranda) --}}
    @if(request()->routeIs('beranda'))
        <script type="application/ld+json">
                                                                                                                                                                                    {
                                                                                                                                                                                        "@@context": "https://schema.org",
                                                                                                                                                                                        "@type": "Organization",

                                                                                                                                                                                        "name": "{{ $seo_profil['nama_bem'] ?? 'BEM Polbis' }}",
                                                                                                                                                                                        "alternateName": "BEM Polbis",
                                                                                                                                                                                        "url": "{{ url('/') }}",
                                                                                                                                                                                        "logo": "{{ $seo_logo }}",
                                                                                                                                                                                        "description": "Badan Eksekutif Mahasiswa {{ $seo_profil['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}",
                                                                                                                                                                                        "parentOrganization": {
                                                                                                                                                                                            "@type": "CollegeOrUniversity",
                                                                                                                                                                                            "name": "{{ $seo_profil['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}"
                                                                                                                                                                                        },
                                                                                                                                                                                        "address": {
                                                                                                                                                                                            "@type": "PostalAddress",
                                                                                                                                                                                            "streetAddress": "{{ $seo_profil['alamat'] ?? '' }}",
                                                                                                                                                                                            "addressCountry": "ID"
                                                                                                                                                                                        },
                                                                                                                                                                                        "email": "{{ $seo_profil['email'] ?? '' }}",
                                                                                                                                                                                        "telephone": "{{ $seo_profil['telepon'] ?? '' }}",
                                                                                                                                                                                        "sameAs": [
                                                                                                                                                                                            "{{ $seo_profil['instagram'] ?? '' }}",
                                                                                                                                                                                            "{{ $seo_profil['youtube'] ?? '' }}",
                                                                                                                                                                                            "{{ $seo_profil['tiktok'] ?? '' }}"
                                                                                                                                                                                        ]
                                                                                                                                                                                    }
                                                                                                                                                                                    </script>
    @endif

    {{-- Structured Data: Breadcrumb --}}
    @hasSection('breadcrumb_json')
        <script type="application/ld+json">@yield('breadcrumb_json')</script>
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Preconnect untuk CDN (speed optimization) --}}
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://unpkg.com">
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@0.511.0/dist/umd/lucide.min.js"></script>

    <style>
        #preloader {
            position: fixed;
            inset: 0;
            background: #1565C0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(107, 175, 42, 0.2);
            border-top-color: #6BAF2A;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
    {{-- Slot untuk structured data tambahan dari child views (Article, Event, dll) --}}
    @stack('head_scripts')
</head>

<body class="antialiased">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    @php
        $profil_layout = \App\Models\ProfilBem::getAllAsArray();
    @endphp

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('beranda') }}" class="flex items-center gap-3">
                    @if(!empty($profil_layout['logo_bem']))
                        <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center overflow-hidden rounded-xl">
                            <img src="{{ Storage::url($profil_layout['logo_bem']) }}" alt="Logo BEM"
                                class="h-full w-full object-contain scale-[1.35]">
                        </div>
                    @else
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-lime-600 to-lime-700 flex items-center justify-center shadow-lg">
                            <span class="text-gray-900 font-black text-sm">BEM</span>
                        </div>
                    @endif
                    <div>
                        <div class="text-white font-bold text-sm leading-tight">
                            {{ $profil_layout['nama_bem'] ?? 'BEM Polbis' }}
                        </div>
                        <div class="text-lime-400 font-medium text-xs leading-tight">
                            {{ $profil_layout['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}
                        </div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('beranda') }}"
                        class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('tentang') }}"
                        class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
                    <a href="{{ route('kegiatan') }}"
                        class="nav-link {{ request()->routeIs('kegiatan*') ? 'active' : '' }}">Kegiatan</a>

                    <!-- Struktur Dropdown -->
                    <div class="relative group">
                        <button
                            class="nav-link flex items-center gap-1 {{ request()->routeIs('struktur') || request()->routeIs('ormawa') ? 'active' : '' }}">
                            Organisasi
                            <svg class="w-3.5 h-3.5 opacity-60 group-hover:rotate-180 transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <!-- Dropdown Panel -->
                        <div
                            class="absolute top-full left-0 mt-1 w-48 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50">
                            <div
                                class="bg-blue-900/95 backdrop-blur-md border border-white/10 rounded-xl shadow-2xl overflow-hidden p-1">
                                <a href="{{ route('struktur') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-blue-300 hover:text-lime-500 hover:bg-white/05 transition-colors {{ request()->routeIs('struktur') ? 'text-lime-500 bg-white/05' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Struktur BEM
                                </a>
                                <a href="{{ route('ormawa') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-blue-300 hover:text-lime-500 hover:bg-white/05 transition-colors {{ request()->routeIs('ormawa') ? 'text-lime-500 bg-white/05' : '' }}">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    Ormawa
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('kontak') }}"
                        class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                </div>

                <!-- Mobile Toggle -->
                <button id="menu-toggle" class="md:hidden text-gray-400 hover:text-lime-500 transition-colors p-2">
                    <svg id="icon-menu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10">
            <div class="px-4 py-3 flex flex-col gap-1">
                <a href="{{ route('beranda') }}"
                    class="nav-link block {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
                <a href="{{ route('tentang') }}"
                    class="nav-link block {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang</a>
                <a href="{{ route('kegiatan') }}"
                    class="nav-link block {{ request()->routeIs('kegiatan*') ? 'active' : '' }}">Kegiatan</a>
                <div class="pl-0">
                    <div class="text-blue-500 text-xs px-3 pt-2 pb-1 uppercase tracking-wider">Organisasi</div>
                    <a href="{{ route('struktur') }}"
                        class="nav-link block pl-5 {{ request()->routeIs('struktur') ? 'active' : '' }}">↳ Struktur
                        BEM</a>
                    <a href="{{ route('ormawa') }}"
                        class="nav-link block pl-5 {{ request()->routeIs('ormawa') ? 'active' : '' }}">↳ Ormawa</a>
                </div>
                <a href="{{ route('kontak') }}"
                    class="nav-link block {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer — Minimalis dengan Deskripsi -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 py-8">

                <!-- Kiri: BEM -->
                <div class="flex items-center gap-4">
                    @if(!empty($profil_layout['logo_bem']))
                        <div class="h-12 w-12 rounded-full bg-white flex items-center justify-center overflow-hidden flex-shrink-0 shadow-lg">
                            <img src="{{ Storage::url($profil_layout['logo_bem']) }}" alt="Logo BEM"
                                class="h-full w-full object-contain scale-[1.35]">
                        </div>
                    @else
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-lime-600 to-lime-700 flex items-center justify-center flex-shrink-0 shadow-lg">
                            <span class="text-gray-900 font-black text-sm">BEM</span>
                        </div>
                    @endif
                    <div>
                        <div class="text-white font-bold text-base leading-tight">
                            {{ $profil_layout['nama_bem'] ?? 'BEM Polbis' }}
                        </div>
                        <div class="text-blue-400 text-xs mt-0.5 max-w-xs leading-relaxed">
                            Badan Eksekutif Mahasiswa
                            {{ $profil_layout['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}
                        </div>
                        <div class="text-lime-500/70 text-xs mt-1">Periode
                            {{ $profil_layout['periode'] ?? '2024/2028' }}
                        </div>
                    </div>
                </div>

                <!-- Divider (mobile: horizontal, desktop: vertical) -->
                <div class="hidden sm:block w-px h-12 bg-white/10 flex-shrink-0"></div>
                <div class="sm:hidden w-full h-px bg-white/10"></div>

                <!-- Kanan: Kampus -->
                <a href="https://share.google/IyB4fSntEhQkRyFmQ" target="_blank" rel="noopener">
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <div class="text-white font-bold text-base leading-tight">
                                {{ $profil_layout['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}
                            </div>
                            <div class="text-blue-400 text-xs mt-0.5">Perguruan Tinggi Vokasi</div>
                            @if(!empty($profil_layout['alamat']))
                                <div class="text-blue-500 text-xs mt-1 truncate max-w-xs">
                                    {{ Str::limit($profil_layout['alamat'], 50) }}
                                </div>
                            @endif
                        </div>
                        @if(!empty($profil_layout['logo_kampus']))
                            <div class="h-12 w-12 rounded-full bg-white flex items-center justify-center overflow-hidden flex-shrink-0 shadow-lg">
                                <img src="{{ Storage::url($profil_layout['logo_kampus']) }}" alt="Logo Kampus"
                                    class="h-full w-full object-contain scale-[1.35]">
                            </div>
                        @else
                            <div
                                class="w-12 h-12 rounded-full bg-white flex items-center justify-center flex-shrink-0 shadow-lg">
                                <span class="text-blue-800 font-black text-[10px] text-center leading-tight">POLBIS</span>
                            </div>
                        @endif
                    </div>
                </a>
            </div>
            <div
                class="text-white text-xs border-t border-border/40 py-5 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p class="text-text-tertiary text-center sm:text-left">
                    &copy; 2026 Badan Eksekutif Mahasiswa - Politeknik Bisnis Digital
                    Indonesia
                </p>
                <p class="text-text-tertiary flex items-center gap-1">
                    Built with <i data-lucide="heart" class="w-4 h-4"></i> by HIMA TRPL
                </p>
            </div>
        </div>
    </footer>


    <script>
        // Preloader
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 500);
        });

        // Navbar scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Mobile menu
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconMenu.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });

        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Init Lucide Icons
        lucide.createIcons();
    </script>
</body>

</html>