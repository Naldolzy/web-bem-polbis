@extends('layouts.admin')

@section('title', 'Edit Kegiatan')
@section('page_title', 'Edit Kegiatan')

@section('content')

<div class="max-w-3xl">
    <a href="{{ route('admin.kegiatan.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-lime-500 text-sm mb-6 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar
    </a>

    <div class="card-glass rounded-2xl p-8">
        <h2 class="text-white font-bold text-xl mb-6 flex items-center gap-2">
            <i data-lucide="pencil" class="w-5 h-5 text-lime-400"></i>
            Edit Kegiatan
        </h2>

        <form method="POST" action="{{ route('admin.kegiatan.update', $kegiatan) }}" enctype="multipart/form-data" class="space-y-5" id="form-kegiatan">
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

            {{-- Konten Lengkap - Quill Rich Text Editor --}}
            <div>
                <label class="form-label flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-blue-400"></i>
                    Konten Lengkap
                    <span class="text-blue-600 text-xs font-normal">(mendukung teks tebal, miring, link, dll)</span>
                </label>
                <div id="quill-konten-container" style="border-radius: 0.75rem; overflow: hidden; border: 1px solid rgba(255,255,255,0.15);">
                    <div id="quill-konten" style="min-height: 220px; color: #e2e8f0; font-size: 0.9rem; background: rgba(21,101,192,0.15);">
                        {!! old('konten', $kegiatan->konten) !!}
                    </div>
                </div>
                <input type="hidden" name="konten" id="konten-hidden" value="{{ old('konten', $kegiatan->konten) }}">
            </div>

            <!-- Foto Kegiatan -->
            <div>
                <label class="form-label">Foto Kegiatan</label>
                @if($kegiatan->foto)
                    <div class="mb-3 flex items-center justify-between gap-3 p-3 rounded-lg bg-white/03 border border-white/08">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/'.$kegiatan->foto) }}" class="w-16 h-16 rounded-lg object-cover" alt="">
                            <div>
                                <p class="text-white text-sm font-medium">Foto saat ini</p>
                                <p class="text-blue-500 text-xs">Drop atau klik di bawah untuk mengganti</p>
                            </div>
                        </div>
                        <button type="submit" form="form-delete-foto" onclick="return confirm('Hapus foto kegiatan?')"
                            class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                            Hapus
                        </button>
                    </div>
                @endif
                <div class="dropzone" id="dropzone-foto" onclick="document.getElementById('foto').click()">
                    <div id="dz-content">
                        <i data-lucide="cloud-upload" class="w-8 h-8 text-blue-500 mx-auto mb-2"></i>
                        <p class="text-blue-400 text-sm">Drag & drop foto baru atau <span class="text-lime-500">klik untuk pilih</span></p>
                        <p class="text-blue-600 text-xs mt-1">JPG, PNG, WebP — max 10MB</p>
                    </div>
                    <img id="foto-preview" class="hidden max-h-40 rounded-lg mx-auto">
                </div>
                <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewFoto(this)">
            </div>

            <!-- Status - Custom Checkbox -->
            <label for="is_published" class="flex items-center gap-3 p-4 rounded-xl bg-white/03 border border-white/08 cursor-pointer hover:bg-white/05 transition-colors">
                <input type="checkbox" id="is_published" name="is_published" value="1"
                       {{ old('is_published', $kegiatan->is_published) ? 'checked' : '' }}
                       class="custom-check">
                <div>
                    <div class="text-white font-medium text-sm flex items-center gap-2">
                        <i data-lucide="globe" class="w-4 h-4 text-lime-400"></i>
                        Publish
                    </div>
                    <div class="text-blue-500 text-xs mt-0.5">Tampilkan di website publik</div>
                </div>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-5 h-5"></i>
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

@push('scripts')
<script>
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
                ['link', 'image', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    // Fix: reposition tooltip so it never overflows outside the editor
    quill.on('selection-change', function() {
        setTimeout(() => {
            const tooltip = document.querySelector('.ql-tooltip');
            if (!tooltip) return;
            const rect = tooltip.getBoundingClientRect();
            const container = document.getElementById('quill-konten-container').getBoundingClientRect();
            if (rect.bottom > window.innerHeight) {
                tooltip.style.top = (parseFloat(tooltip.style.top) - rect.height - 30) + 'px';
            }
            if (rect.right > container.right) {
                tooltip.style.left = (container.width - rect.width - 8) + 'px';
            }
            if (rect.left < container.left) {
                tooltip.style.left = '0px';
            }
        }, 50);
    });

    document.getElementById('form-kegiatan').addEventListener('submit', function() {
        document.getElementById('konten-hidden').value = quill.root.innerHTML;
    });

    lucide.createIcons();
</script>
@endpush

@endsection
