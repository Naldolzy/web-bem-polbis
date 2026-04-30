@extends('layouts.admin')

@section('title', 'Edit Anggota')
@section('page_title', 'Edit Anggota Struktur')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.struktur.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-amber-500 text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6">Edit Anggota: {{ $struktur->nama }}</h2>

        <form method="POST" action="{{ route('admin.struktur.update', $struktur) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $struktur->nama) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim', $struktur->nim) }}" class="form-input">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $struktur->jabatan) }}" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Divisi</label>
                    <input type="text" name="divisi" value="{{ old('divisi', $struktur->divisi) }}" class="form-input" required>
                </div>
            </div>

            <div>
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', $struktur->urutan) }}" min="0" class="form-input">
            </div>

            <!-- Foto Anggota - Drag & Drop -->
            <div>
                <label class="form-label">Foto Anggota</label>
                @if($struktur->foto)
                    <div class="mb-3 flex items-center justify-between gap-3 p-3 rounded-lg bg-white/03 border border-white/08">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/'.$struktur->foto) }}" class="w-14 h-14 rounded-full object-cover" alt="">
                            <div>
                                <p class="text-white text-sm font-medium">Foto saat ini</p>
                                <p class="text-slate-500 text-xs">Drop atau klik di bawah untuk mengganti</p>
                            </div>
                        </div>
                        <button type="submit" form="form-delete-foto" onclick="return confirm('Hapus foto anggota?')" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </div>
                @endif
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <svg class="w-8 h-8 text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <p class="text-slate-400 text-sm">Drag & drop foto atau <span class="text-amber-500">klik untuk pilih</span></p>
                        <p class="text-slate-600 text-xs mt-1">JPG, PNG — max 2MB</p>
                    </div>
                    <img id="foto-preview" class="hidden w-20 h-20 rounded-full object-cover mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewFoto(this)">
            </div>

            <div class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', $struktur->is_active) ? 'checked' : '' }}
                       class="w-5 h-5 rounded">
                <label for="is_active" class="cursor-pointer">
                    <div class="text-white font-medium text-sm">Aktif</div>
                    <div class="text-slate-500 text-xs">Tampilkan di halaman struktur</div>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Delete Form (outside main form) -->
<form id="form-delete-foto" method="POST" action="{{ route('admin.struktur.hapus-foto', $struktur) }}" class="hidden">
    @csrf @method('DELETE')
</form>

@include('admin._partials.dropzone-script')

@endsection
