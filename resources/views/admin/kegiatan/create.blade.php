@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')
@section('page_title', 'Tambah Kegiatan')

@section('content')

<div class="max-w-3xl">
    <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-amber-500 text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6">Form Tambah Kegiatan</h2>

        <form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">Judul Kegiatan <span class="text-red-400">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="form-input @error('judul') border-red-500 @enderror"
                       placeholder="Nama kegiatan..." required>
                @error('judul') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Kategori <span class="text-red-400">*</span></label>
                    <input type="text" name="kategori" value="{{ old('kategori', 'umum') }}" class="form-input"
                           placeholder="umum / seni / akademik / sosial..." required>
                </div>
                <div>
                    <label class="form-label">Tanggal Kegiatan <span class="text-red-400">*</span></label>
                    <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', date('Y-m-d')) }}" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Deskripsi Singkat <span class="text-red-400">*</span></label>
                <textarea name="deskripsi" rows="3" class="form-textarea @error('deskripsi') border-red-500 @enderror"
                          placeholder="Deskripsi singkat kegiatan..." required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Konten Lengkap</label>
                <textarea name="konten" rows="8" class="form-textarea"
                          placeholder="Tulis konten lengkap kegiatan di sini...">{{ old('konten') }}</textarea>
            </div>

            <!-- Foto Upload dengan Drag & Drop -->
            <div>
                <label class="form-label">Foto Kegiatan</label>
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <svg class="w-10 h-10 text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="text-slate-400 text-sm font-medium">Drag & drop foto atau <span class="text-amber-500">klik untuk pilih</span></p>
                        <p class="text-slate-600 text-xs mt-1">JPG, PNG, WebP — max 2MB</p>
                    </div>
                    <img id="foto-preview" class="hidden max-h-48 rounded-lg mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                       onchange="previewFoto(this)">
                @error('foto') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status -->
            <div class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08">
                <input type="checkbox" id="is_published" name="is_published" value="1"
                       {{ old('is_published', true) ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-white/20 text-amber-500">
                <label for="is_published" class="cursor-pointer">
                    <div class="text-white font-medium text-sm">Publish Sekarang</div>
                    <div class="text-slate-500 text-xs">Kegiatan akan langsung tampil di website publik</div>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Kegiatan
                </button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@include('admin._partials.dropzone-script')

@endsection
