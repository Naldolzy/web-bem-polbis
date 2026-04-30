@extends('layouts.public')

@section('title', $kegiatan->judul)
@section('meta_description', Str::limit(strip_tags($kegiatan->deskripsi), 155))
@if($kegiatan->foto)
@section('og_image', asset('storage/'.$kegiatan->foto))
@endif
@section('breadcrumb_json')
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Kegiatan","item":"{{ url('/kegiatan') }}"},
        {"@type":"ListItem","position":3,"name":"{{ addslashes($kegiatan->judul) }}","item":"{{ url('/kegiatan/'.$kegiatan->slug) }}"}
    ]
}
@endsection

@section('content')

<div class="pt-20" style="background: #0f172a;">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8">
            <a href="{{ route('beranda') }}" class="hover:text-amber-500 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('kegiatan') }}" class="hover:text-amber-500 transition-colors">Kegiatan</a>
            <span>/</span>
            <span class="text-slate-300 truncate max-w-xs">{{ $kegiatan->judul }}</span>
        </nav>

        <!-- Badge -->
        <div class="flex items-center gap-3 mb-4">
            <span class="badge-kategori">{{ $kegiatan->kategori }}</span>
            <span class="text-slate-500 text-sm">{{ $kegiatan->tanggal_kegiatan->format('d F Y') }}</span>
        </div>

        <!-- Title -->
        <h1 class="section-title mb-6">{{ $kegiatan->judul }}</h1>

        <!-- Featured Image -->
        @if($kegiatan->foto)
            <div class="rounded-2xl overflow-hidden mb-8" style="max-height: 450px;">
                <img src="{{ asset('storage/'.$kegiatan->foto) }}" alt="{{ $kegiatan->judul }}"
                     class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Description -->
        <div class="card-glass p-6 rounded-2xl mb-6">
            <p class="text-slate-300 text-lg leading-relaxed font-medium">{{ $kegiatan->deskripsi }}</p>
        </div>

        <!-- Content -->
        @if($kegiatan->konten)
            <div class="prose-custom text-slate-300 text-base leading-relaxed mb-10" style="line-height: 1.8;">
                {!! nl2br(e($kegiatan->konten)) !!}
            </div>
        @endif

        <!-- Back Button -->
        <div class="flex items-center justify-between py-6 border-t border-white/08">
            <a href="{{ route('kegiatan') }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Kegiatan
            </a>
        </div>
    </div>

    <!-- Related -->
    @if($related->count() > 0)
    <div class="border-t border-white/06 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-white font-bold text-xl mb-8">Kegiatan Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                    <article class="card-kegiatan">
                        <div class="relative overflow-hidden" style="height: 160px;">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <div class="text-slate-500 text-xs mb-1">{{ $item->tanggal_kegiatan->format('d F Y') }}</div>
                            <h4 class="text-white font-semibold text-sm line-clamp-2 mb-3">{{ $item->judul }}</h4>
                            <a href="{{ route('kegiatan.show', $item->slug) }}" class="text-amber-500 text-xs font-semibold hover:text-amber-400 transition-colors">
                                Baca →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
