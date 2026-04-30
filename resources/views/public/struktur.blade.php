@extends('layouts.public')

@section('title', 'Struktur Organisasi')
@section('meta_description', 'Kenali pengurus BEM Politeknik Bisnis Digital Indonesia. Struktur organisasi lengkap per divisi periode aktif.')
@section('breadcrumb_json')
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Struktur Organisasi","item":"{{ url('/struktur') }}"}
    ]
}
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="section-badge">✦ Kepengurusan</div>
        <h1 class="section-title mt-3">Struktur <span>Organisasi</span></h1>
        <p class="text-slate-400 mt-3 max-w-xl">Kenali para pengurus BEM Polbis yang berkomitmen melayani seluruh mahasiswa.</p>
    </div>
</div>

<section class="py-20 bg-navy-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($struktur->count() > 0)
            @foreach($struktur as $divisi => $anggota)
                <div class="mb-16 reveal">
                    <!-- Divisi Header -->
                    <div class="flex items-center gap-4 mb-8">
                        <div class="h-px flex-1 bg-gradient-to-r from-amber-500/50 to-transparent"></div>
                        <div class="flex items-center gap-2 px-5 py-2 rounded-full border border-amber-500/30 bg-amber-500/10">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                            <span class="text-amber-500 font-bold text-sm">{{ strtoupper($divisi) }}</span>
                        </div>
                        <div class="h-px flex-1 bg-gradient-to-l from-amber-500/50 to-transparent"></div>
                    </div>

                    <!-- Anggota — flex wrap centered -->
                    <div class="flex flex-wrap justify-center gap-5">
                        @foreach($anggota as $org)
                            <div class="struktur-card" style="width: 170px; flex-shrink: 0;">
                                @if($org->foto)
                                    <img src="{{ asset('storage/'.$org->foto) }}" alt="{{ $org->nama }}" class="avatar">
                                @else
                                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-slate-600 to-slate-700 flex items-center justify-center mx-auto mb-3"
                                         style="border: 3px solid rgba(245,158,11,0.35);">
                                        <span class="text-amber-500 font-bold text-2xl">{{ strtoupper(substr($org->nama, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <div class="text-white font-semibold text-sm leading-tight">{{ $org->nama }}</div>
                                @if($org->nim)
                                    <div class="text-slate-500 text-xs mt-0.5">{{ $org->nim }}</div>
                                @endif
                                <div class="mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 inline-block">
                                    {{ $org->jabatan }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-20">
                <div class="text-7xl mb-4">👥</div>
                <h3 class="text-white font-semibold text-xl mb-2">Belum Ada Data Struktur</h3>
                <p class="text-slate-400">Data struktur organisasi akan segera ditambahkan.</p>
            </div>
        @endif
    </div>
</section>

@endsection
