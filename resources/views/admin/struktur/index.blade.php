@extends('layouts.admin')

@section('title', 'Struktur Organisasi')
@section('page_title', 'Struktur Organisasi')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-blue-400 text-sm">{{ \App\Models\Struktur::count() }} anggota terdaftar</p>
    <a href="{{ route('admin.struktur.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Anggota
    </a>
</div>

@if($struktur->count() > 0)
    @foreach($struktur as $divisi => $anggota_list)
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <h3 class="text-lime-500 font-bold text-sm uppercase tracking-wider">{{ $divisi }}</h3>
                <span class="text-blue-600 text-xs">({{ $anggota_list->count() }} orang)</span>
            </div>
            <div class="card-glass rounded-xl overflow-hidden">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Anggota</th>
                            <th>Jabatan</th>
                            <th>NIM</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggota_list as $org)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                            @if($org->foto)
                                                <img src="{{ asset('storage/'.$org->foto) }}" class="w-full h-full object-cover" alt="">
                                            @else
                                                <div class="w-full h-full bg-blue-700 flex items-center justify-center">
                                                    <span class="text-lime-500 font-bold text-sm">{{ strtoupper(substr($org->nama, 0, 1)) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="text-white font-medium text-sm">{{ $org->nama }}</span>
                                    </div>
                                </td>
                                <td class="text-blue-300 text-sm">{{ $org->jabatan }}</td>
                                <td class="text-blue-400 text-sm">{{ $org->nim ?? '-' }}</td>
                                <td class="text-blue-400 text-sm">{{ $org->urutan }}</td>
                                <td>
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $org->is_active ? 'bg-green-500/20 text-green-400' : 'bg-blue-500/20 text-blue-400' }}">
                                        {{ $org->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.struktur.edit', $org) }}"
                                           class="px-3 py-1.5 rounded-lg bg-lime-500/20 text-lime-400 text-xs font-semibold hover:bg-lime-500/30 transition-colors">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.struktur.destroy', $org) }}"
                                              onsubmit="return confirm('Hapus anggota ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
@else
    <div class="card-glass rounded-xl p-16 text-center">
        <div class="text-5xl mb-4">👥</div>
        <p class="text-blue-400">Belum ada anggota. <a href="{{ route('admin.struktur.create') }}" class="text-lime-500 hover:underline">Tambah sekarang</a></p>
    </div>
@endif

@endsection
