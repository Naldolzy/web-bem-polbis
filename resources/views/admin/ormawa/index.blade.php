@extends('layouts.admin')

@section('title', 'Ormawa')
@section('page_title', 'Kelola Ormawa')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-slate-400 text-sm">Daftar Himpunan Mahasiswa dan Organisasi Mahasiswa terdaftar.</p>
    <a href="{{ route('admin.ormawa.create') }}" class="btn-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Ormawa
    </a>
</div>

@if($ormawas->isEmpty())
    <div class="card-glass rounded-2xl p-16 text-center">
        <div class="w-16 h-16 rounded-2xl bg-amber-500/10 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-amber-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <p class="text-slate-400 text-sm">Belum ada Ormawa. Klik tombol di atas untuk menambahkan.</p>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($ormawas as $o)
            <div class="card-glass rounded-2xl p-5 flex items-start gap-4 group">
                <!-- Logo -->
                @if($o->logo)
                    <img src="{{ asset('storage/'.$o->logo) }}" alt="{{ $o->nama }}"
                         class="w-14 h-14 rounded-xl object-contain bg-white/05 p-1 flex-shrink-0">
                @else
                    <div class="w-14 h-14 rounded-xl bg-amber-500/15 flex items-center justify-center flex-shrink-0">
                        <span class="text-amber-500 font-black text-sm">{{ Str::upper(Str::limit($o->singkatan ?? $o->nama, 4, '')) }}</span>
                    </div>
                @endif

                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <div class="text-white font-semibold text-sm truncate">{{ $o->nama }}</div>
                    @if($o->singkatan)
                        <div class="text-amber-500/80 text-xs">{{ $o->singkatan }}</div>
                    @endif
                    @if($o->prodi)
                        <div class="text-slate-500 text-xs mt-0.5 truncate">{{ $o->prodi }}</div>
                    @endif
                    @if($o->link_website)
                        <a href="{{ $o->link_website }}" target="_blank"
                           class="inline-flex items-center gap-1 text-xs text-blue-400 hover:text-blue-300 mt-1.5 transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Lihat Website
                        </a>
                    @endif
                </div>

                <!-- Hapus -->
                <form method="POST" action="{{ route('admin.ormawa.destroy', $o) }}"
                      onsubmit="return confirm('Hapus {{ addslashes($o->nama) }}?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="text-slate-600 hover:text-red-400 transition-colors flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif

@endsection
