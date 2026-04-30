@extends('layouts.admin')

@section('title', 'Edit Kegiatan')
@section('page_title', 'Edit Kegiatan')

@section('content')

<div class="max-w-3xl">
    <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-amber-500 text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6">Edit Kegiatan</h2>

        <form method="POST" action="{{ route('admin.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Judul Kegiatan <span class="text-red-400">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $kegiatan->judul) }}"
                       class="form-input" required>
                @error('judul') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $kegiatan->kategori) }}"
                           class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan->format('Y-m-d')) }}"
                           class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" class="form-textarea" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="form-label">Konten Lengkap</label>
                <textarea name="konten" rows="8" class="form-textarea">{{ old('konten', $kegiatan->konten) }}</textarea>
            </div>

            <!-- Foto Kegiatan - Drag & Drop -->
            <div>
                <label class="form-label">Foto Kegiatan</label>
                @if($kegiatan->foto)
                    <div class="mb-3 flex items-center justify-between gap-3 p-3 rounded-lg bg-white/03 border border-white/08">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/'.$kegiatan->foto) }}" class="w-16 h-16 rounded-lg object-cover" alt="">
                            <div>
                                <p class="text-white text-sm font-medium">Foto saat ini</p>
                                <p class="text-slate-500 text-xs">Drop atau klik di bawah untuk mengganti</p>
                            </div>
                        </div>
                        <button type="submit" form="form-delete-foto" onclick="return confirm('Hapus foto kegiatan?')" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </div>
                @endif
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <svg class="w-8 h-8 text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-slate-400 text-sm">Drag & drop foto baru atau <span class="text-amber-500">klik untuk pilih</span></p>
                        <p class="text-slate-600 text-xs mt-1">JPG, PNG, WebP — max 2MB</p>
                    </div>
                    <img id="foto-preview" class="hidden max-h-40 rounded-lg mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewFoto(this)">
            </div>

            <!-- Status -->
            <div class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08">
                <input type="checkbox" id="is_published" name="is_published" value="1"
                       {{ old('is_published', $kegiatan->is_published) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-white/20 text-amber-500">
                <label for="is_published" class="cursor-pointer">
                    <div class="text-white font-medium text-sm">Publish</div>
                    <div class="text-slate-500 text-xs">Tampilkan di website publik</div>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Delete Form (outside main form) -->
<form id="form-delete-foto" method="POST" action="{{ route('admin.kegiatan.hapus-foto', $kegiatan) }}" class="hidden">
    @csrf @method('DELETE')
</form>

@include('admin._partials.dropzone-script')

@endsection
