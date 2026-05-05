@extends('layouts.public')

@section('title', 'Beranda')
@section('meta_description', 'Selamat datang di website resmi BEM Politeknik Bisnis Digital Indonesia.')

@section('content')

{{-- ======================== HERO SECTION ======================== --}}
<section class="hero-section pt-16">
    <!-- Animated particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        @for($i = 0; $i < 15; $i++)
        <div class="particle"
             style="
                left: {{ rand(0,100) }}%;
                top: {{ rand(0,100) }}%;
                width: {{ rand(3,8) }}px;
                height: {{ rand(3,8) }}px;
                background: rgba(245,158,11,{{ rand(1,4)/10 }});
                animation-duration: {{ rand(6,14) }}s;
                animation-delay: {{ rand(0,6) }}s;
             "></div>
        @endfor
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-20">
            <!-- Left Content -->
            <div class="fade-in-up">
                <div class="section-badge mb-4">
                    <span>✦</span> Periode {{ $profil['periode'] ?? '2025/2026' }}
                </div>
                <h1 class="font-display font-black text-5xl lg:text-6xl text-white leading-tight mb-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    Selamat Datang di<br>
                    <span class="gradient-text">BEM Polbis</span>
                </h1>
                <p class="text-blue-400 text-lg leading-relaxed mb-8 max-w-lg">
                    Badan Eksekutif Mahasiswa Politeknik Bisnis Digital Indonesia — bersama membangun kampus yang aktif, kreatif, dan berdampak nyata.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('kegiatan') }}" class="btn-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Lihat Kegiatan
                    </a>
                    <a href="{{ route('tentang') }}" class="btn-secondary">
                        Tentang BEM
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 mt-12">
                    <div class="stat-card">
                        <div class="text-2xl font-black text-lime-500 font-display" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ \App\Models\Kegiatan::published()->count() }}+</div>
                        <div class="text-blue-400 text-xs mt-1">Kegiatan</div>
                    </div>
                    <div class="stat-card">
                        <div class="text-2xl font-black text-lime-500 font-display" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ \App\Models\Struktur::active()->count() }}+</div>
                        <div class="text-blue-400 text-xs mt-1">Anggota</div>
                    </div>
                    <div class="stat-card">
                        <div class="text-2xl font-black text-lime-500 font-display" style="font-family: 'Plus Jakarta Sans', sans-serif;">1</div>
                        <div class="text-blue-400 text-xs mt-1">Periode</div>
                    </div>
                </div>
            </div>

            <!-- Right Visual — Logo BEM -->
            <div class="hidden lg:flex justify-center items-center">
                <div class="relative">
                    <div class="w-80 h-80 rounded-full bg-gradient-to-br from-lime-500/20 to-indigo-500/20 blur-3xl absolute inset-0"></div>
                    <div class="relative card-glass p-10 rounded-3xl text-center">
                        @if(!empty($profil['logo_bem']))
                            <img src="{{ asset('storage/'.$profil['logo_bem']) }}"
                                 alt="Logo BEM Polbis"
                                 class="w-40 h-40 object-contain mx-auto mb-4">
                        @else
                            <div class="text-8xl font-black gradient-text mb-4" style="font-family: 'Plus Jakarta Sans', sans-serif;">BEM</div>
                        @endif
                        <div class="text-white font-semibold text-lg">{{ $profil['nama_bem'] ?? 'BEM Polbis' }}</div>
                        <div class="text-lime-500 font-semibold text-sm">{{ $profil['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}</div>
                        <div class="mt-6 flex justify-center gap-3">
                            @if(!empty($profil['instagram']))
                                <a href="{{ $profil['instagram'] }}" target="_blank"
                                   class="w-10 h-10 rounded-full bg-white/10 hover:bg-lime-500/20 flex items-center justify-center transition-all hover:scale-110">
                                    <svg class="w-5 h-5 text-lime-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Wave divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="#F0F6FF"/>
        </svg>
    </div>
</section>

{{-- ======================== KEGIATAN TERBARU ======================== --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <div class="section-badge mx-auto" style="width:fit-content">✦ Aktivitas Terkini</div>
            <h2 class="section-title mt-4">Kegiatan <span>Terbaru</span></h2>
            <p class="text-blue-400 mt-3 max-w-xl mx-auto">Berbagai program dan kegiatan yang telah dan sedang dijalankan oleh BEM Polbis.</p>
        </div>

        @if($kegiatan_terbaru->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($kegiatan_terbaru as $item)
                    <article class="card-kegiatan reveal">
                        <div class="relative overflow-hidden" style="height: 200px;">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul }}"
                                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-700 to-blue-800 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="badge-kategori">{{ $item->kategori }}</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-blue-500 text-xs mb-2">
                                {{ $item->tanggal_kegiatan->format('d F Y') }}
                            </div>
                            <h3 class="text-white font-bold text-base leading-snug mb-2 line-clamp-2">{{ $item->judul }}</h3>
                            <p class="text-blue-400 text-sm leading-relaxed line-clamp-3 mb-4">{{ $item->deskripsi }}</p>
                            <a href="{{ route('kegiatan.show', $item->slug) }}" class="text-lime-500 text-sm font-semibold hover:text-lime-400 transition-colors inline-flex items-center gap-1">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center reveal">
                <a href="{{ route('kegiatan') }}" class="btn-primary">
                    Lihat Semua Kegiatan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📅</div>
                <p class="text-blue-400">Belum ada kegiatan yang dipublish.</p>
            </div>
        @endif
    </div>
</section>

{{-- ======================== VISI MISI PREVIEW ======================== --}}
<section class="py-20" style="background: linear-gradient(135deg, #1e293b 0%, #1a3a5c 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <div class="section-badge border-white/20 text-white bg-white/10" style="outline-color: rgba(255,255,255,0.3)">✦ Tentang Kami</div>
                <h2 class="section-title text-white mt-4" style="color: #ffffff;">Visi & <span class="text-lime-400" style="background: none; -webkit-text-fill-color: #AEE070;">Misi</span><br>BEM Polbis</h2>
                <div class="divider-green"></div>
                <p class="text-slate-300 text-base leading-relaxed mt-4">
                    {{ $profil['visi'] ?? '' }}
                </p>
                <a href="{{ route('tentang') }}" class="btn-secondary mt-6 inline-flex">
                    Pelajari Lebih Lanjut
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 reveal">
                @foreach($misi as $i => $item)
                    <div class="card-glass p-5">
                        <div class="w-8 h-8 rounded-lg bg-lime-500/20 flex items-center justify-center mb-3">
                            <span class="text-lime-500 font-black text-sm">{{ $i+1 }}</span>
                        </div>
                        <p class="text-blue-300 text-sm leading-relaxed">{{ $item->isi }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ======================== CTA KONTAK ======================== --}}
<section class="py-20">
    <div class="max-w-3xl mx-auto px-4 text-center reveal">
        <div class="bg-white shadow-xl shadow-blue-900/5 p-12 rounded-3xl border border-slate-200">
            <div class="flex justify-center mb-5">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-100 to-lime-100 flex items-center justify-center shadow-md">
                    <i data-lucide="message-circle-heart" class="w-8 h-8 text-blue-600"></i>
                </div>
            </div>
            <h2 class="section-title mb-4">Ada Pertanyaan<br>atau <span>Aspirasi?</span></h2>
            <p class="text-blue-400 mb-8">Hubungi kami dan sampaikan aspirasi kamu. BEM Polbis siap mendengar dan merespons setiap masukan dari mahasiswa.</p>
            <a href="{{ route('kontak') }}" class="btn-primary text-lg px-8 py-4">
                Hubungi Kami Sekarang
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

@endsection
