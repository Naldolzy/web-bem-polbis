@extends('layouts.admin')

@section('title', 'Ormawa')
@section('page_title', 'Kelola Ormawa')

@section('content')

<div class="flex justify-between items-center mb-6">
    <p class="text-blue-400 text-sm">Daftar Himpunan Mahasiswa dan Organisasi Mahasiswa terdaftar.</p>
    <a href="{{ route('admin.ormawa.create') }}" class="btn-primary">
        <i data-lucide="plus" class="w-5 h-5"></i>
        Tambah Ormawa
    </a>
</div>

@if($ormawas->isEmpty())
    <div class="card-glass rounded-2xl p-16 text-center">
        <div class="w-16 h-16 rounded-2xl bg-lime-500/10 flex items-center justify-center mx-auto mb-4">
            <i data-lucide="boxes" class="w-8 h-8 text-lime-500/50"></i>
        </div>
        <p class="text-blue-400 text-sm">Belum ada Ormawa. Klik tombol di atas untuk menambahkan.</p>
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
                    <div class="w-14 h-14 rounded-xl bg-lime-500/15 flex items-center justify-center flex-shrink-0">
                        <span class="text-lime-500 font-black text-sm">{{ Str::upper(Str::limit($o->singkatan ?? $o->nama, 4, '')) }}</span>
                    </div>
                @endif

                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <div class="text-white font-semibold text-sm truncate">{{ $o->nama }}</div>
                    @if($o->singkatan)
                        <div class="text-lime-500/80 text-xs">{{ $o->singkatan }}</div>
                    @endif
                    @if($o->prodi)
                        <div class="text-blue-500 text-xs mt-0.5 truncate">{{ $o->prodi }}</div>
                    @endif
                    @if($o->link_website)
                        <a href="{{ $o->link_website }}" target="_blank"
                           class="inline-flex items-center gap-1 text-xs text-blue-400 hover:text-blue-300 mt-1.5 transition-colors">
                            <i data-lucide="external-link" class="w-3 h-3"></i>
                            Lihat Website
                        </a>
                    @endif
                </div>

                <!-- Hapus -->
                <form method="POST" action="{{ route('admin.ormawa.destroy', $o) }}"
                      onsubmit="return confirm('Hapus {{ addslashes($o->nama) }}?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="text-blue-600 hover:text-red-400 transition-colors flex-shrink-0 mt-0.5">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif

@endsection
