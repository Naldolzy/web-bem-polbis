@extends('layouts.public')

@section('title', 'Kegiatan BEM')
@section('meta_description', 'Lihat berbagai kegiatan, program kerja, dan agenda terbaru BEM Politeknik Bisnis Digital Indonesia. Update rutin setiap periode.')
@section('breadcrumb_json')
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Kegiatan","item":"{{ url('/kegiatan') }}"}
    ]
}
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- <div class="section-badge">✦ Program Kerja</div> -->
        <h1 class="section-title mt-3">Kegiatan <span>BEM Polbis</span></h1>
        <p class="text-blue-400 mt-3 max-w-xl">Berbagai kegiatan dan program yang telah, sedang, dan akan dilaksanakan oleh BEM Polbis.</p>
    </div>
</div>

<!-- Kegiatan Grid -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Filter Kategori -->
        @if($kategori_list->count() > 0)
            <div class="flex flex-wrap gap-3 mb-10 reveal">
                <a href="{{ route('kegiatan') }}"
                   class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-sm
                          {{ !request('kategori') ? 'bg-gradient-to-r from-blue-700 to-green-600 text-white border-transparent' : 'bg-white text-slate-600 hover:text-blue-700 hover:bg-slate-50 border border-slate-200' }}">
                    Semua
                </a>
                @foreach($kategori_list as $kat)
                    <a href="{{ route('kegiatan', ['kategori' => $kat]) }}"
                       class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all capitalize shadow-sm
                              {{ request('kategori') === $kat ? 'bg-gradient-to-r from-blue-700 to-green-600 text-white border-transparent' : 'bg-white text-slate-600 hover:text-blue-700 hover:bg-slate-50 border border-slate-200' }}">
                        {{ $kat }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($kegiatan->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kegiatan as $item)
                    <article class="card-kegiatan reveal">
                        <div class="relative overflow-hidden" style="height: 210px;">
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
                            <div class="text-blue-500 text-xs mb-2 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $item->tanggal_kegiatan->format('d F Y') }}
                            </div>
                            <h2 class="text-white font-bold text-base leading-snug mb-2 line-clamp-2">{{ $item->judul }}</h2>
                            <p class="text-blue-400 text-sm leading-relaxed line-clamp-3 mb-4">{{ $item->deskripsi }}</p>
                            <a href="{{ route('kegiatan.show', $item->slug) }}"
                               class="text-lime-500 text-sm font-semibold hover:text-lime-400 transition-colors inline-flex items-center gap-1">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $kegiatan->links() }}
            </div>

        @else
            <div class="text-center py-20">
                <div class="text-7xl mb-4">📭</div>
                <h3 class="text-white font-semibold text-xl mb-2">Belum Ada Kegiatan</h3>
                <p class="text-blue-400">Kegiatan akan segera ditambahkan. Pantau terus ya!</p>
            </div>
        @endif
    </div>
</section>

@endsection
