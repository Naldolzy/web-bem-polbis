@extends('layouts.admin')

@section('title', 'Tambah Ormawa')
@section('page_title', 'Tambah Ormawa')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.ormawa.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-lime-500 text-sm mb-6 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6">Form Tambah Ormawa</h2>

        <form method="POST" action="{{ route('admin.ormawa.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-input"
                           placeholder="Himpunan Mahasiswa Teknik..." required>
                    @error('nama') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Singkatan</label>
                    <input type="text" name="singkatan" value="{{ old('singkatan') }}" class="form-input"
                           placeholder="HIMA-TI">
                </div>
            </div>

            <div>
                <label class="form-label">Program Studi</label>
                <input type="text" name="prodi" value="{{ old('prodi') }}" class="form-input"
                       placeholder="Teknik Informatika, Manajemen Bisnis...">
            </div>

            <div>
                <label class="form-label">Link Website HIMA <span class="text-red-400">*</span></label>
                <input type="url" name="link_website" value="{{ old('link_website') }}" class="form-input"
                       placeholder="https://hima-prodi.example.com" required>
                <p class="text-blue-600 text-xs mt-1">URL website / Instagram / link apapun milik HIMA ini</p>
                @error('link_website') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" class="form-textarea"
                          placeholder="Himpunan mahasiswa yang bergerak di bidang...">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Logo Upload - Drag & Drop -->
            <div>
                <label class="form-label">Logo HIMA</label>
                <div class="dropzone" id="dropzone-logo" onclick="document.getElementById('logo').click()">
                    <div id="dz-content">
                        <i data-lucide="upload-cloud" class="w-8 h-8 text-blue-600 mx-auto mb-2"></i>
                        <p class="text-blue-400 text-sm">Drag & drop logo atau <span class="text-lime-500">klik untuk pilih</span></p>
                        <p class="text-blue-600 text-xs mt-1">PNG, SVG, JPG — max 2MB</p>
                    </div>
                    <img id="foto-preview" class="hidden max-h-24 object-contain mx-auto">
                </div>
                <input type="file" id="logo" name="logo" accept="image/*" class="hidden" onchange="previewFoto(this)">
            </div>

            <div>
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0" class="form-input" placeholder="0">
                <p class="text-blue-600 text-xs mt-1">Angka lebih kecil = tampil lebih awal</p>
            </div>

            <label for="is_active" class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08 cursor-pointer hover:bg-white/05 transition-colors">
                <input type="checkbox" id="is_active" name="is_active" value="1" checked class="custom-check">
                <div>
                    <div class="text-white font-medium text-sm flex items-center gap-2">
                        <i data-lucide="eye" class="w-4 h-4 text-lime-400"></i>
                        Aktif
                    </div>
                    <div class="text-blue-500 text-xs mt-0.5">Tampilkan di halaman Ormawa publik</div>
                </div>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Ormawa
                </button>
                <a href="{{ route('admin.ormawa.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@include('admin._partials.dropzone-script')

@endsection
