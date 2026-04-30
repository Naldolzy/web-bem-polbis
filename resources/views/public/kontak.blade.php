@extends('layouts.public')

@section('title', 'Kontak')
@section('meta_description', 'Hubungi BEM Politeknik Bisnis Digital Indonesia. Temukan email, nomor WhatsApp, Instagram, dan lokasi kampus kami.')
@section('breadcrumb_json')
{
    "@@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {"@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
        {"@type":"ListItem","position":2,"name":"Kontak","item":"{{ url('/kontak') }}"}
    ]
}
@endsection

@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="section-badge">✦ Hubungi Kami</div>
            <h1 class="section-title mt-3">Kontak <span>BEM Polbis</span></h1>
            <p class="text-slate-400 mt-3 max-w-xl">Temukan kami di berbagai platform dan saluran komunikasi berikut.</p>
        </div>
    </div>

    <section class="py-20 bg-navy-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Info Kontak Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-12">

                @if(!empty($profil['email']))
                    <a href="mailto:{{ $profil['email'] }}"
                        class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-3 group">
                        <div
                            class="w-14 h-14 rounded-2xl bg-amber-500/15 border border-amber-500/25 flex items-center justify-center group-hover:bg-amber-500/25 transition-all">
                            <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-amber-500 font-semibold text-sm mb-1">Email</div>
                            <div class="text-slate-300 text-sm break-all">{{ $profil['email'] }}</div>
                        </div>
                    </a>
                @endif

                @if(!empty($profil['telepon']))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil['telepon']) }}" target="_blank"
                        class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-3 group">
                        <div
                            class="w-14 h-14 rounded-2xl bg-green-500/15 border border-green-500/25 flex items-center justify-center group-hover:bg-green-500/25 transition-all">
                            <svg class="w-7 h-7 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-green-400 font-semibold text-sm mb-1">WhatsApp</div>
                            <div class="text-slate-300 text-sm">{{ $profil['telepon'] }}</div>
                        </div>
                    </a>
                @endif

                @if(!empty($profil['instagram']))
                    <a href="{{ $profil['instagram'] }}" target="_blank"
                        class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-3 group">
                        <div
                            class="w-14 h-14 rounded-2xl bg-pink-500/15 border border-pink-500/25 flex items-center justify-center group-hover:bg-pink-500/25 transition-all">
                            <svg class="w-7 h-7 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-pink-400 font-semibold text-sm mb-1">Instagram</div>
                            <div class="text-slate-300 text-sm">@bem_polbis</div>
                        </div>
                    </a>
                @endif

                @if(!empty($profil['youtube']))
                    <a href="{{ $profil['youtube'] }}" target="_blank"
                        class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-3 group">
                        <div
                            class="w-14 h-14 rounded-2xl bg-red-500/15 border border-red-500/25 flex items-center justify-center group-hover:bg-red-500/25 transition-all">
                            <svg class="w-7 h-7 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-red-400 font-semibold text-sm mb-1">YouTube</div>
                            <div class="text-slate-300 text-sm">BEM Polbis</div>
                        </div>
                    </a>
                @endif

                @if(!empty($profil['tiktok']))
                    <a href="{{ $profil['tiktok'] }}" target="_blank"
                        class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-3 group">
                        <div
                            class="w-14 h-14 rounded-2xl bg-slate-400/15 border border-slate-400/25 flex items-center justify-center group-hover:bg-slate-400/25 transition-all">
                            <svg class="w-7 h-7 text-slate-300" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.22 8.22 0 004.83 1.56V6.82a4.85 4.85 0 01-1.06-.13z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-slate-300 font-semibold text-sm mb-1">TikTok</div>
                            <div class="text-slate-400 text-sm">BEM Polbis</div>
                        </div>
                    </a>
                @endif

                {{-- Alamat — selalu tampil, bisa diklik ke Google Maps --}}
                <a href="https://share.google/IyB4fSntEhQkRyFmQ" target="_blank" rel="noopener"
                    class="card-glass p-6 rounded-2xl flex flex-col items-center text-center gap-3 group">
                    <div
                        class="w-14 h-14 rounded-2xl bg-blue-500/15 border border-blue-500/25 flex items-center justify-center group-hover:bg-blue-500/30 transition-all">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-blue-400 font-semibold text-sm mb-1 flex items-center justify-center gap-1">
                            Alamat
                            <svg class="w-3 h-3 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </div>
                        <div class="text-slate-300 text-sm leading-relaxed">
                            {{ $profil['nama_kampus'] ?? 'Politeknik Bisnis Digital Indonesia' }}
                        </div>
                        <div class="text-blue-400/60 text-xs mt-1">Buka di Google Maps →</div>
                    </div>
                </a>

            </div>

            <!-- Note bottom
            <div class="text-center">
                <p class="text-slate-500 text-sm">Informasi kontak dapat diperbarui melalui panel admin BEM.</p>
            </div> -->

        </div>
    </section>

@endsection