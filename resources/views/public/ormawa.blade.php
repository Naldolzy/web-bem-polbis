@extends('layouts.public')

@section('title', 'Ormawa')
@section('meta_description', 'Daftar Himpunan Mahasiswa (HIMA) dan Organisasi Mahasiswa di Politeknik Bisnis Digital Indonesia. Kunjungi website masing-masing HIMA.')
@section('breadcrumb_json')
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Ormawa","item":"{{ url('/ormawa') }}"}
    ]
}
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- <div class="section-badge">✦ Organisasi Mahasiswa</div> -->
        <h1 class="section-title mt-3">Organisasi Mahasiswa</h1>
        <p class="text-slate-400 mt-3 max-w-xl">Himpunan Mahasiswa aktif di Politeknik Bisnis Digital Indonesia. Klik kartu untuk mengunjungi halaman masing-masing organisasi.</p>
    </div>
</div>

<section class="py-20 bg-navy-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($ormawas->isEmpty())
            <div class="text-center py-24">
                <div class="w-20 h-20 rounded-3xl bg-amber-500/10 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-amber-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-xl mb-2">Sedang Dipersiapkan</h3>
                <p class="text-slate-500 text-sm max-w-sm mx-auto">Data Ormawa dan HIMA sedang dalam proses pendataan. Pantau terus halaman ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($ormawas as $o)
                    <a href="{{ $o->link_website ?? '#' }}"
                       @if($o->link_website) target="_blank" rel="noopener" @endif
                       class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-4 group hover:border-amber-500/30 transition-all duration-300 hover:-translate-y-1">

                        <!-- Logo -->
                        @if($o->logo)
                            <img src="{{ asset('storage/'.$o->logo) }}" alt="{{ $o->nama }}"
                                 class="w-20 h-20 rounded-2xl object-contain bg-white/05 p-2 group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500/20 to-amber-600/10 border border-amber-500/20 flex items-center justify-center group-hover:from-amber-500/30 transition-all duration-300">
                                <span class="text-amber-400 font-black text-lg">
                                    {{ Str::upper(Str::limit($o->singkatan ?? $o->nama, 4, '')) }}
                                </span>
                            </div>
                        @endif

                        <!-- Info -->
                        <div class="flex-1">
                            @if($o->singkatan)
                                <div class="text-amber-500 font-bold text-base leading-tight">{{ $o->singkatan }}</div>
                            @endif
                            <div class="text-white font-semibold text-sm mt-1 leading-snug">{{ $o->nama }}</div>
                            @if($o->prodi)
                                <div class="text-slate-500 text-xs mt-1">{{ $o->prodi }}</div>
                            @endif
                            @if($o->deskripsi)
                                <div class="text-slate-400 text-xs mt-2 leading-relaxed line-clamp-2">{{ $o->deskripsi }}</div>
                            @endif
                        </div>

                        <!-- CTA -->
                        @if($o->link_website)
                            <div class="flex items-center gap-1.5 text-xs text-amber-500/70 group-hover:text-amber-500 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Kunjungi Website
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</section>

@endsection
