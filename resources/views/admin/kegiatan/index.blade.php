@extends('layouts.admin')

@section('title', 'Kelola Kegiatan')
@section('page_title', 'Kelola Kegiatan')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-blue-400 text-sm">Total {{ $kegiatan->total() }} kegiatan ditemukan</p>
    </div>
    <a href="{{ route('admin.kegiatan.create') }}" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah Kegiatan
    </a>
</div>

<div class="card-glass rounded-xl overflow-hidden">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Kegiatan</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatan as $item)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item->foto)
                                    <img src="{{ asset('storage/'.$item->foto) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full bg-blue-700 flex items-center justify-center">
                                        <i data-lucide="image" class="w-5 h-5 text-blue-500"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="text-white font-medium text-sm">{{ Str::limit($item->judul, 45) }}</div>
                                <div class="text-blue-500 text-xs mt-0.5">{{ Str::limit($item->deskripsi, 60) }}</div>
                            </div>
                        </div>
                    </td>
                    <td><x-badge-kategori :kategori="$item->kategori ?? 'umum'" /></td>
                    <td class="text-blue-400 text-sm">{{ $item->tanggal_kegiatan->format('d M Y') }}</td>
                    <td>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->is_published ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-blue-500/20 text-blue-400 border border-blue-500/30' }}">
                            {{ $item->is_published ? '● Published' : '● Draft' }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.kegiatan.edit', $item) }}"
                               class="px-3 py-1.5 rounded-lg bg-lime-500/20 text-lime-400 text-xs font-semibold hover:bg-lime-500/30 transition-colors">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.kegiatan.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus kegiatan ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-12 text-blue-500">
                        <div class="text-4xl mb-2">📭</div>
                        Belum ada kegiatan. <a href="{{ route('admin.kegiatan.create') }}" class="text-lime-500 hover:underline">Tambah sekarang</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($kegiatan->hasPages())
        <div class="p-4 border-t border-white/06">
            {{ $kegiatan->links() }}
        </div>
    @endif
</div>

@endsection
