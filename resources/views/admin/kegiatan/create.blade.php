@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')
@section('page_title', 'Tambah Kegiatan')

@section('content')

<div class="max-w-3xl">
    <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-lime-500 text-sm mb-6 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6 flex items-center gap-2">
            <i data-lucide="calendar-plus" class="w-5 h-5 text-lime-400"></i>
            Form Tambah Kegiatan
        </h2>

        <form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data" class="space-y-5" id="form-kegiatan">
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

            {{-- Konten Lengkap - Quill Rich Text Editor --}}
            <div>
                <label class="form-label flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-blue-400"></i>
                    Konten Lengkap
                    <span class="text-blue-600 text-xs font-normal">(mendukung teks tebal, miring, link, dll)</span>
                </label>

                {{-- Quill toolbar + editor container --}}
                <div id="quill-konten-container" style="border-radius: 0.75rem; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);">
                    <div id="quill-konten" style="min-height: 220px; color: #e2e8f0; font-size: 0.9rem; background: rgba(21,101,192,0.15);">
                        {!! old('konten') !!}
                    </div>
                </div>
                {{-- Hidden input to submit HTML content --}}
                <input type="hidden" name="konten" id="konten-hidden" value="{{ old('konten') }}">
            </div>

            <!-- Foto Upload -->
            <div>
                <label class="form-label">Foto Kegiatan</label>
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <i data-lucide="cloud-upload" class="w-10 h-10 text-blue-500 mx-auto mb-2"></i>
                        <p class="text-blue-400 text-sm font-medium">Drag & drop foto atau <span class="text-lime-500">klik untuk pilih</span></p>
                        <p class="text-blue-600 text-xs mt-1">JPG, PNG, WebP — max 10MB</p>
                    </div>
                    <img id="foto-preview" class="hidden max-h-48 rounded-lg mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden"
                       onchange="previewFoto(this)">
                @error('foto') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Status Publish - Custom Checkbox -->
            <label for="is_published" class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08 cursor-pointer hover:bg-white/05 transition-colors">
                <input type="checkbox" id="is_published" name="is_published" value="1"
                       {{ old('is_published', true) ? 'checked' : '' }}
                       class="custom-check">
                <div>
                    <div class="text-white font-medium text-sm flex items-center gap-2">
                        <i data-lucide="globe" class="w-4 h-4 text-lime-400"></i>
                        Publish Sekarang
                    </div>
                    <div class="text-blue-500 text-xs mt-0.5">Kegiatan akan langsung tampil di website publik</div>
                </div>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    Simpan Kegiatan
                </button>
                <a href="{{ route('admin.kegiatan.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@include('admin._partials.dropzone-script')

@push('scripts')
<script>
    // Init Quill editor
    const quill = new Quill('#quill-konten', {
        theme: 'snow',
        placeholder: 'Tulis konten lengkap kegiatan di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    // Style the Quill toolbar for dark theme
    document.querySelector('.ql-toolbar').style.cssText = 'background: rgba(8,50,114,0.6); border: none; border-bottom: 1px solid rgba(255,255,255,0.12); padding: 8px;';
    document.querySelector('.ql-container').style.cssText = 'border: none;';
    document.querySelectorAll('.ql-toolbar button, .ql-toolbar .ql-picker').forEach(el => {
        el.style.color = '#93c5fd';
    });
    document.querySelectorAll('.ql-toolbar .ql-stroke').forEach(el => {
        el.style.stroke = '#93c5fd';
    });

    // Before submit, copy Quill HTML to hidden input
    document.getElementById('form-kegiatan').addEventListener('submit', function() {
        document.getElementById('konten-hidden').value = quill.root.innerHTML;
    });

    lucide.createIcons();
</script>
@endpush

@endsection
