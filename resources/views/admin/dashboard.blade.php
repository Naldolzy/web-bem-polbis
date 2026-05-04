@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="card-glass p-5 rounded-xl">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-lime-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="text-green-400 text-xs font-semibold">Total</span>
        </div>
        <div class="text-3xl font-black text-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $total_kegiatan }}</div>
        <div class="text-blue-400 text-sm mt-1">Total Kegiatan</div>
    </div>

    <div class="card-glass p-5 rounded-xl">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-green-400 text-xs font-semibold">Published</span>
        </div>
        <div class="text-3xl font-black text-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $kegiatan_published }}</div>
        <div class="text-blue-400 text-sm mt-1">Kegiatan Dipublish</div>
    </div>

    <div class="card-glass p-5 rounded-xl">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="text-indigo-400 text-xs font-semibold">Total</span>
        </div>
        <div class="text-3xl font-black text-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $total_anggota }}</div>
        <div class="text-blue-400 text-sm mt-1">Total Anggota</div>
    </div>

    <div class="card-glass p-5 rounded-xl">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="text-blue-400 text-xs font-semibold">Aktif</span>
        </div>
        <div class="text-3xl font-black text-white" style="font-family: 'Plus Jakarta Sans', sans-serif;">{{ $anggota_aktif }}</div>
        <div class="text-blue-400 text-sm mt-1">Anggota Aktif</div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Kegiatan -->
    <div class="card-glass rounded-xl overflow-hidden">
        <div class="p-5 border-b border-white/06 flex items-center justify-between">
            <h3 class="text-white font-semibold">Kegiatan Terbaru</h3>
            <a href="{{ route('admin.kegiatan.index') }}" class="text-lime-500 text-sm hover:text-lime-400 transition-colors">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-white/05">
            @forelse($kegiatan_terbaru as $item)
                <div class="p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0">
                        @if($item->foto)
                            <img src="{{ asset('storage/'.$item->foto) }}" class="w-full h-full object-cover" alt="">
                        @else
                            <div class="w-full h-full bg-blue-700 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-white text-sm font-medium truncate">{{ $item->judul }}</div>
                        <div class="text-blue-500 text-xs">{{ $item->tanggal_kegiatan->format('d M Y') }}</div>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $item->is_published ? 'bg-green-500/20 text-green-400' : 'bg-blue-500/20 text-blue-400' }}">
                        {{ $item->is_published ? 'Published' : 'Draft' }}
                    </span>
                </div>
            @empty
                <div class="p-8 text-center text-blue-500 text-sm">Belum ada kegiatan.</div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card-glass rounded-xl p-6">
        <h3 class="text-white font-semibold mb-5">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.kegiatan.create') }}"
               class="flex flex-col items-center gap-2 p-5 rounded-xl bg-lime-500/10 border border-lime-500/20 hover:bg-lime-500/20 transition-all hover:scale-105 text-center">
                <svg class="w-6 h-6 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-lime-400 text-sm font-semibold">Tambah Kegiatan</span>
            </a>

            <a href="{{ route('admin.struktur.create') }}"
               class="flex flex-col items-center gap-2 p-5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 hover:bg-indigo-500/20 transition-all hover:scale-105 text-center">
                <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                <span class="text-indigo-400 text-sm font-semibold">Tambah Anggota</span>
            </a>

            <a href="{{ route('admin.profil.index') }}"
               class="flex flex-col items-center gap-2 p-5 rounded-xl bg-blue-500/10 border border-blue-500/20 hover:bg-blue-500/20 transition-all hover:scale-105 text-center">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span class="text-blue-400 text-sm font-semibold">Edit Profil BEM</span>
            </a>

            <a href="{{ route('beranda') }}" target="_blank"
               class="flex flex-col items-center gap-2 p-5 rounded-xl bg-green-500/10 border border-green-500/20 hover:bg-green-500/20 transition-all hover:scale-105 text-center">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span class="text-green-400 text-sm font-semibold">Lihat Website</span>
            </a>
        </div>
    </div>
</div>

@endsection
