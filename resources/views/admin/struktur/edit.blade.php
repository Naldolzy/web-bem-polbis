@extends('layouts.admin')

@section('title', 'Edit Anggota')
@section('page_title', 'Edit Anggota Struktur')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.struktur.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-lime-500 text-sm mb-6 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6 flex items-center gap-2">
            <i data-lucide="user-pen" class="w-5 h-5 text-lime-400"></i>
            Edit Anggota: {{ $struktur->nama }}
        </h2>

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

            <!-- Foto Anggota -->
            <div>
                <label class="form-label">Foto Anggota</label>
                @if($struktur->foto)
                    <div class="mb-3 flex items-center justify-between gap-3 p-3 rounded-lg bg-white/03 border border-white/08">
                        <div class="flex items-center gap-3">
                            <img src="{{ Storage::url($struktur->foto) }}" class="w-14 h-14 rounded-full object-cover" alt="">
                            <div>
                                <p class="text-white text-sm font-medium">Foto saat ini</p>
                                <p class="text-blue-500 text-xs">Drop atau klik di bawah untuk mengganti</p>
                            </div>
                        </div>
                        <button type="submit" form="form-delete-foto" onclick="return confirm('Hapus foto anggota?')"
                            class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                            Hapus
                        </button>
                    </div>
                @endif
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <i data-lucide="user-round" class="w-8 h-8 text-blue-500 mx-auto mb-2"></i>
                        <p class="text-blue-400 text-sm">Drag & drop foto atau <span class="text-lime-500">klik untuk pilih</span></p>
                        <p class="text-blue-600 text-xs mt-1">JPG, PNG — max 2MB</p>
                    </div>
                    <img id="foto-preview" class="hidden w-20 h-20 rounded-full object-cover mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewFoto(this)">
            </div>

            <!-- Status Aktif - Custom Checkbox -->
            <label for="is_active" class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08 cursor-pointer hover:bg-white/05 transition-colors">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', $struktur->is_active) ? 'checked' : '' }}
                       class="custom-check">
                <div>
                    <div class="text-white font-medium text-sm flex items-center gap-2">
                        <i data-lucide="eye" class="w-4 h-4 text-lime-400"></i>
                        Aktif
                    </div>
                    <div class="text-blue-500 text-xs mt-0.5">Tampilkan di halaman struktur</div>
                </div>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.struktur.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<!-- Delete Form -->
<form id="form-delete-foto" method="POST" action="{{ route('admin.struktur.hapus-foto', $struktur) }}" class="hidden">
    @csrf @method('DELETE')
</form>

@include('admin._partials.dropzone-script')

@endsection
