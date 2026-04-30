@extends('layouts.public')

@section('title', 'Tentang BEM')
@section('meta_description', 'Mengenal BEM Politeknik Bisnis Digital Indonesia — visi, misi, sejarah, sambutan ketua, dan profil lengkap Badan Eksekutif Mahasiswa Polbis.')
@section('breadcrumb_json')
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Tentang BEM","item":"{{ url('/tentang') }}"}
    ]
}
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="section-badge">✦ Profil Organisasi</div>
        <h1 class="section-title mt-3 max-w-2xl">Tentang <span>BEM Polbis</span></h1>
        <p class="text-slate-400 mt-3 max-w-xl">Mengenal lebih dekat Badan Eksekutif Mahasiswa Politeknik Bisnis Digital Indonesia.</p>
    </div>
</div>

<!-- Sambutan Ketua -->
<section class="py-20 bg-navy-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center reveal">
            <!-- Visual Ketua -->
            <div class="flex justify-center">
                <div class="relative">
                    <div class="w-64 h-64 rounded-full bg-gradient-to-br from-amber-500/20 to-indigo-500/20 blur-2xl absolute inset-0 m-auto"></div>
                    <div class="relative card-glass p-10 rounded-3xl text-center w-72">
                        @if(!empty($profil['foto_ketua']))
                            <img src="{{ asset('storage/'.$profil['foto_ketua']) }}"
                                 alt="{{ $profil['ketua_bem'] ?? 'Ketua BEM' }}"
                                 class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-4 border-amber-500/50">
                        @else
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center mx-auto mb-4 text-3xl font-black text-gray-900">
                                {{ strtoupper(substr($profil['ketua_bem'] ?? 'K', 0, 1)) }}
                            </div>
                        @endif
                        <div class="text-white font-bold">{{ $profil['ketua_bem'] ?? 'Ketua BEM' }}</div>
                        <div class="text-amber-500 text-sm">Ketua BEM Polbis</div>
                        <div class="text-slate-500 text-xs mt-1">Periode {{ $profil['periode'] ?? '2025/2026' }}</div>
                    </div>
                </div>
            </div>

            <!-- Text -->
            <div>
                <div class="section-badge">✦ Sambutan Ketua</div>
                <h2 class="section-title mt-3 mb-4">Kata Sambutan<br><span>Ketua BEM</span></h2>
                <div class="divider-gold"></div>
                <blockquote class="mt-6 text-slate-300 text-base leading-relaxed italic border-l-4 border-amber-500 pl-5">
                    "{{ $profil['sambutan_ketua'] ?? '' }}"
                </blockquote>
                <div class="mt-4 text-slate-500 font-medium">— {{ $profil['ketua_bem'] ?? 'Ketua BEM Polbis' }}, Ketua BEM Polbis {{ $profil['periode'] ?? '' }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="py-20" style="background: linear-gradient(135deg, #1e293b 0%, #1a3a5c 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <div class="section-badge mx-auto" style="width:fit-content">✦ Arah Gerak</div>
            <h2 class="section-title mt-4">Visi & <span>Misi</span></h2>
        </div>

        <!-- Visi -->
        <div class="card-glass p-8 rounded-2xl mb-8 reveal">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-amber-500 font-bold text-lg mb-2">Visi</h3>
                    <p class="text-slate-300 text-base leading-relaxed">{{ $profil['visi'] ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- Misi -->
        @if($misi->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 reveal">
            @foreach($misi as $i => $item)
                <div class="card-glass p-6 rounded-xl flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-amber-500/15 flex items-center justify-center flex-shrink-0">
                        <span class="text-amber-500 font-black">{{ $i+1 }}</span>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-1">Misi {{ $i+1 }}</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $item->isi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Sejarah -->
@if(!empty($profil['sejarah']))
<section class="py-20 bg-navy-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal">
            <div class="section-badge mx-auto" style="width:fit-content">✦ Perjalanan Kami</div>
            <h2 class="section-title mt-4">Sejarah <span>BEM Polbis</span></h2>
        </div>
        <div class="card-glass p-8 rounded-2xl reveal">
            <p class="text-slate-300 text-base leading-relaxed">{{ $profil['sejarah'] }}</p>
        </div>
    </div>
</section>
@endif

@endsection
