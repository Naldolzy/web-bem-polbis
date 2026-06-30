@extends('layouts.public')

@section('title', $kegiatan->judul)
@section('meta_description', Str::limit(strip_tags($kegiatan->deskripsi), 155))
@if($kegiatan->foto)
@section('og_image', asset('storage/'.$kegiatan->foto))
@endif

@section('breadcrumb_json')
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Kegiatan","item":"{{ url('/kegiatan') }}"},
        {"@type":"ListItem","position":3,"name":"{{ addslashes($kegiatan->judul) }}","item":"{{ url('/kegiatan/'.$kegiatan->slug) }}"}
    ]
}
@endsection

{{-- Article Structured Data: membantu Google menampilkan rich snippet --}}
@push('head_scripts')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ addslashes($kegiatan->judul) }}",
    "description": "{{ addslashes(Str::limit(strip_tags($kegiatan->deskripsi), 155)) }}",
    @if($kegiatan->foto)
    "image": ["{{ asset('storage/'.$kegiatan->foto) }}"],
    @endif
    "datePublished": "{{ $kegiatan->tanggal_kegiatan->toIso8601String() }}",
    "dateModified": "{{ $kegiatan->updated_at->toIso8601String() }}",
    "author": {
        "@type": "Organization",
        "name": "BEM Politeknik Bisnis Digital Indonesia",
        "url": "{{ url('/') }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "BEM Politeknik Bisnis Digital Indonesia",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('favicon.png') }}"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url('/kegiatan/'.$kegiatan->slug) }}"
    }
}
</script>
@endpush


@section('content')

<div class="pt-24 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <article class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 sm:p-12 mb-12">
            <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8">
            <a href="{{ route('beranda') }}" class="hover:text-blue-600 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('kegiatan') }}" class="hover:text-blue-600 transition-colors">Kegiatan</a>
            <span>/</span>
            <span class="text-slate-800 font-medium truncate max-w-xs">{{ $kegiatan->judul }}</span>
        </nav>

        <!-- Badge -->
        <div class="flex items-center gap-3 mb-4">
            <x-badge-kategori :kategori="$kegiatan->kategori ?? 'umum'" />
            <span class="text-blue-500 text-sm">{{ $kegiatan->tanggal_kegiatan->format('d F Y') }}</span>
        </div>

        <!-- Title -->
        <h1 class="font-display font-black text-4xl sm:text-5xl text-slate-900 leading-tight mb-6">{{ $kegiatan->judul }}</h1>

        {{-- Featured Image --}}
        @if($kegiatan->foto)
            <div class="rounded-3xl overflow-hidden mb-10 shadow-xl shadow-blue-900/5 ring-1 ring-slate-100" style="max-height: 500px;">
                <img src="{{ asset('storage/'.$kegiatan->foto) }}"
                     alt="Foto kegiatan {{ $kegiatan->judul }} - BEM Polbis"
                     class="w-full h-full object-cover"
                     loading="lazy">
            </div>
        @endif

        <!-- Description -->
        <div class="bg-blue-50/50 border border-blue-100 p-8 rounded-3xl mb-10 shadow-sm">
            <p class="text-slate-700 text-lg leading-relaxed font-medium">{{ $kegiatan->deskripsi }}</p>
        </div>

        <!-- Content -->
        @if($kegiatan->konten)
            <div class="prose prose-lg prose-slate max-w-none mb-12"
                 style="line-height:1.9; color:#475569;"
            >
                {!! $kegiatan->konten !!}
            </div>
        @endif

        <!-- Back Button -->
        <div class="flex items-center justify-between mt-12 pt-8 border-t border-slate-200">
            <a href="{{ route('kegiatan') }}" class="btn-secondary inline-flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Kegiatan
            </a>
        </div>
        </article>
    </div>

    <!-- Related -->
    @if($related->count() > 0)
    <div class="border-t border-slate-100 bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-slate-900 font-bold text-2xl mb-8">Kegiatan Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $item)
                    <article class="card-kegiatan">
                        <div class="relative overflow-hidden" style="height: 160px;">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <div class="text-slate-500 text-xs font-medium mb-2">{{ $item->tanggal_kegiatan->format('d F Y') }}</div>
                            <h4 class="text-slate-800 font-bold text-base line-clamp-2 mb-3">{{ $item->judul }}</h4>
                            <a href="{{ route('kegiatan.show', $item->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-700 transition-colors flex items-center gap-1">
                                Baca <span aria-hidden="true">&rarr;</span>
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
