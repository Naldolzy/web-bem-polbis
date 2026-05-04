@extends('layouts.admin')

@section('title', 'Tambah Anggota')
@section('page_title', 'Tambah Anggota Struktur')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.struktur.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-lime-500 text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6">Form Tambah Anggota</h2>

        <form method="POST" action="{{ route('admin.struktur.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="form-input" placeholder="Nama anggota..." required>
                    @error('nama') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" class="form-input" placeholder="Nomor Induk Mahasiswa">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Jabatan <span class="text-red-400">*</span></label>
                    <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="form-input" placeholder="Ketua, Wakil, Sekretaris..." required>
                </div>
                <div>
                    <label class="form-label">Divisi <span class="text-red-400">*</span></label>
                    <input type="text" name="divisi" value="{{ old('divisi') }}" class="form-input" placeholder="Inti / Komunikasi / Akademik..." required>
                </div>
            </div>

            <div>
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', 0) }}" min="0" class="form-input" placeholder="0">
                <p class="text-blue-600 text-xs mt-1">Angka lebih kecil = tampil lebih awal</p>
            </div>

            <!-- Foto Anggota - Drag & Drop -->
            <div>
                <label class="form-label">Foto Anggota</label>
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <svg class="w-8 h-8 text-blue-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <p class="text-blue-400 text-sm">Drag & drop foto atau <span class="text-lime-500">klik untuk pilih</span></p>
                        <p class="text-blue-600 text-xs mt-1">JPG, PNG — max 2MB</p>
                    </div>
                    <img id="foto-preview" class="hidden w-20 h-20 rounded-full object-cover mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewFoto(this)">
            </div>

            <!-- Status -->
            <div class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08">
                <input type="checkbox" id="is_active" name="is_active" value="1" checked class="w-5 h-5 rounded">
                <label for="is_active" class="cursor-pointer">
                    <div class="text-white font-medium text-sm">Aktif</div>
                    <div class="text-blue-500 text-xs">Tampilkan di halaman struktur</div>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Anggota
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@include('admin._partials.dropzone-script')

@endsection
