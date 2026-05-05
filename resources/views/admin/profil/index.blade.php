@extends('layouts.admin')

@section('title', 'Profil BEM')
@section('page_title', 'Kelola Profil BEM')

@section('content')

@if(session('success'))
    <div class="alert-success mb-6">
        <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-error mb-6">
        <strong class="block mb-1">Upload gagal:</strong>
        <ul class="list-disc list-inside text-sm space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- ===== LOGO & BRANDING ===== --}}
        <div class="card-glass rounded-2xl p-8">
            <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-lime-500/20 flex items-center justify-center">
                    <i data-lucide="image" class="w-4 h-4 text-lime-400"></i>
                </div>
                Logo & Branding
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Logo BEM -->
                <div>
                    <label class="form-label">Logo BEM</label>
                    @if(!empty($profil['logo_bem']))
                        <div class="mb-3 p-3 rounded-lg bg-white/03 border border-white/08 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/'.$profil['logo_bem']) }}" class="h-12 w-12 object-contain rounded" alt="Logo BEM">
                                <span class="text-blue-400 text-xs">Logo saat ini</span>
                            </div>
                            <button type="submit" form="form-delete-logo_bem" onclick="return confirm('Hapus logo BEM?')" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                                Hapus
                            </button>
                        </div>
                    @endif
                    <div class="dropzone" id="dropzone-logo-bem" onclick="document.getElementById('logo_bem').click()">
                        <div class="dropzone-content" id="dz-logo-bem-content">
                            <svg class="w-8 h-8 text-blue-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-blue-400 text-sm">Drop logo BEM atau klik</p>
                            <p class="text-blue-600 text-xs mt-1">PNG, SVG, JPG — max 2MB</p>
                        </div>
                        <img id="preview-logo-bem" class="hidden w-20 h-20 object-contain mx-auto">
                    </div>
                    <input type="file" id="logo_bem" name="logo_bem" accept="image/*" class="hidden"
                           onchange="previewImage(this, 'preview-logo-bem', 'dz-logo-bem-content')">
                </div>

                <!-- Logo Kampus -->
                <div>
                    <label class="form-label">Logo Kampus</label>
                    @if(!empty($profil['logo_kampus']))
                        <div class="mb-3 p-3 rounded-lg bg-white/03 border border-white/08 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/'.$profil['logo_kampus']) }}" class="h-12 w-12 object-contain rounded" alt="Logo Kampus">
                                <span class="text-blue-400 text-xs">Logo saat ini</span>
                            </div>
                            <button type="submit" form="form-delete-logo_kampus" onclick="return confirm('Hapus logo kampus?')" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        </div>
                    @endif
                    <div class="dropzone" id="dropzone-logo-kampus" onclick="document.getElementById('logo_kampus').click()">
                        <div class="dropzone-content" id="dz-logo-kampus-content">
                            <i data-lucide="cloud-upload" class="w-8 h-8 text-blue-500 mx-auto mb-2"></i>
                            <p class="text-blue-400 text-sm">Drop logo kampus atau klik</p>
                            <p class="text-blue-600 text-xs mt-1">PNG, SVG, JPG — max 2MB</p>
                        </div>
                        <img id="preview-logo-kampus" class="hidden w-20 h-20 object-contain mx-auto">
                    </div>
                    <input type="file" id="logo_kampus" name="logo_kampus" accept="image/*" class="hidden"
                           onchange="previewImage(this, 'preview-logo-kampus', 'dz-logo-kampus-content')">
                </div>
            </div>
        </div>

        {{-- ===== INFO DASAR ===== --}}
        <div class="card-glass rounded-2xl p-8">
            <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                    <i data-lucide="info" class="w-4 h-4 text-blue-400"></i>
                </div>
                Informasi Dasar BEM
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Nama BEM</label>
                    <input type="text" name="nama_bem" value="{{ $profil['nama_bem'] ?? '' }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Nama Kampus</label>
                    <input type="text" name="nama_kampus" value="{{ $profil['nama_kampus'] ?? '' }}" class="form-input">
                </div>
                <div>
                    <label class="form-label">Periode</label>
                    <input type="text" name="periode" value="{{ $profil['periode'] ?? '' }}" class="form-input" placeholder="2025/2026">
                </div>
                <div>
                    <label class="form-label">Nama Ketua BEM</label>
                    <input type="text" name="ketua_bem" value="{{ $profil['ketua_bem'] ?? '' }}" class="form-input">
                </div>
            </div>

            <!-- Foto Ketua -->
            <div class="mt-5">
                <label class="form-label">Foto Ketua BEM</label>
                @if(!empty($profil['foto_ketua']))
                    <div class="mb-3 p-3 rounded-lg bg-white/03 border border-white/08 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/'.$profil['foto_ketua']) }}" class="h-14 w-14 rounded-full object-cover border-2 border-lime-500/30" alt="Foto Ketua">
                            <span class="text-blue-400 text-xs">Foto ketua saat ini</span>
                        </div>
                        <button type="submit" form="form-delete-foto_ketua" onclick="return confirm('Hapus foto ketua?')" class="px-3 py-1.5 rounded-lg bg-red-500/20 text-red-400 text-xs font-semibold hover:bg-red-500/30 transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </div>
                @endif
                <div class="dropzone" id="dropzone-foto-ketua" onclick="document.getElementById('foto_ketua').click()">
                    <div class="dropzone-content" id="dz-foto-ketua-content">
                        <i data-lucide="user-round" class="w-8 h-8 text-blue-500 mx-auto mb-2"></i>
                        <p class="text-blue-400 text-sm">Drop foto ketua atau klik</p>
                        <p class="text-blue-600 text-xs mt-1">JPG, PNG — max 2MB</p>
                    </div>
                    <img id="preview-foto-ketua" class="hidden w-16 h-16 rounded-full object-cover mx-auto">
                </div>
                <input type="file" id="foto_ketua" name="foto_ketua" accept="image/*" class="hidden"
                       onchange="previewImage(this, 'preview-foto-ketua', 'dz-foto-ketua-content')">
            </div>
        </div>

        {{-- ===== SAMBUTAN ===== --}}
        <div class="card-glass rounded-2xl p-8">
            <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                    <i data-lucide="message-square-quote" class="w-4 h-4 text-purple-400"></i>
                </div>
                Sambutan Ketua
            </h3>
            <div>
                <label class="form-label">Teks Sambutan</label>
                <textarea name="sambutan_ketua" rows="5" class="form-textarea" placeholder="Kata sambutan dari ketua BEM...">{{ $profil['sambutan_ketua'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- ===== VISI MISI ===== --}}
        <div class="card-glass rounded-2xl p-8">
            <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                    <i data-lucide="target" class="w-4 h-4 text-amber-400"></i>
                </div>
                Visi & Misi
            </h3>
            <div class="space-y-5">
                {{-- Visi (tetap 1) --}}
                <div>
                    <label class="form-label">Visi</label>
                    <textarea name="visi" rows="4" class="form-textarea">{{ $profil['visi'] ?? '' }}</textarea>
                </div>

                {{-- Misi Dinamis --}}
                <div>
                    <label class="form-label mb-3 block">Misi <span class="text-blue-500 font-normal text-xs">(bisa tambah / hapus)</span></label>

                    @if(isset($misi) && $misi->isNotEmpty())
                        <div class="space-y-2 mb-4" id="misi-list">
                            @foreach($misi as $i => $item)
                                <div class="flex items-start gap-3 p-3 rounded-xl bg-white/03 border border-white/08">
                                    <div class="w-7 h-7 rounded-lg bg-lime-500/15 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-lime-500 font-black text-xs">{{ $i+1 }}</span>
                                    </div>
                                    <p class="text-blue-300 text-sm leading-relaxed flex-1">{{ $item->isi }}</p>
                                    {{-- Tombol hapus pakai form= (di luar main form) --}}
                                    <button type="submit" form="form-del-misi-{{ $item->id }}"
                                            onclick="return confirm('Hapus misi ini?')"
                                            class="text-blue-600 hover:text-red-400 transition-colors mt-0.5 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 rounded-xl bg-white/03 border border-dashed border-white/10 text-blue-500 text-sm text-center mb-4">
                            Belum ada misi. Tambahkan di bawah.
                        </div>
                    @endif

                    {{-- Area tambah misi — form sebenarnya ada di bawah (di luar main form) --}}
                    <div class="flex gap-2 items-end">
                        <div class="flex-1">
                            <label class="form-label text-xs">Tambah Misi Baru</label>
                            <textarea id="input-misi-baru" rows="2" class="form-textarea text-sm"
                                      placeholder="Tuliskan butir misi baru..."></textarea>
                        </div>
                        <button type="button" onclick="submitMisi()"
                                class="btn-primary py-2 px-4 flex-shrink-0" style="height:fit-content">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                            Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== SEJARAH ===== --}}
        <div class="card-glass rounded-2xl p-8">
            <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-orange-500/20 flex items-center justify-center">
                    <i data-lucide="scroll-text" class="w-4 h-4 text-orange-400"></i>
                </div>
                Sejarah BEM
            </h3>
            <div>
                <label class="form-label">Teks Sejarah</label>
                <textarea name="sejarah" rows="6" class="form-textarea">{{ $profil['sejarah'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- ===== KONTAK ===== --}}
        <div class="card-glass rounded-2xl p-8">
            <h3 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-teal-500/20 flex items-center justify-center">
                    <i data-lucide="phone" class="w-4 h-4 text-teal-400"></i>
                </div>
                Informasi Kontak & Sosial Media
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ $profil['email'] ?? '' }}" class="form-input" placeholder="bem@polbis.ac.id">
                </div>
                <div>
                    <label class="form-label">Telepon / WhatsApp</label>
                    <input type="text" name="telepon" value="{{ $profil['telepon'] ?? '' }}" class="form-input" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="form-label">Instagram (URL)</label>
                    <input type="url" name="instagram" value="{{ $profil['instagram'] ?? '' }}" class="form-input" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label class="form-label">YouTube (URL)</label>
                    <input type="url" name="youtube" value="{{ $profil['youtube'] ?? '' }}" class="form-input" placeholder="https://youtube.com/...">
                </div>
                <div>
                    <label class="form-label">TikTok (URL)</label>
                    <input type="url" name="tiktok" value="{{ $profil['tiktok'] ?? '' }}" class="form-input" placeholder="https://tiktok.com/...">
                </div>
                <div>
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" value="{{ $profil['alamat'] ?? '' }}" class="form-input">
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Delete Forms — logo & foto (outside main form) -->
<form id="form-delete-logo_bem" method="POST" action="{{ route('admin.profil.hapus-foto', 'logo_bem') }}" class="hidden">
    @csrf @method('DELETE')
</form>
<form id="form-delete-logo_kampus" method="POST" action="{{ route('admin.profil.hapus-foto', 'logo_kampus') }}" class="hidden">
    @csrf @method('DELETE')
</form>
<form id="form-delete-foto_ketua" method="POST" action="{{ route('admin.profil.hapus-foto', 'foto_ketua') }}" class="hidden">
    @csrf @method('DELETE')
</form>

{{-- Misi delete forms (outside main form) --}}
@if(isset($misi))
    @foreach($misi as $item)
        <form id="form-del-misi-{{ $item->id }}" method="POST"
              action="{{ route('admin.misi.destroy', $item) }}" class="hidden">
            @csrf @method('DELETE')
        </form>
    @endforeach
@endif

{{-- Add misi form (outside main form) --}}
<form id="form-add-misi" method="POST" action="{{ route('admin.misi.store') }}" class="hidden">
    @csrf
    <input type="hidden" name="isi" id="hidden-misi-isi">
</form>

<script>
function submitMisi() {
    const val = document.getElementById('input-misi-baru').value.trim();
    if (!val) { alert('Isi misi tidak boleh kosong.'); return; }
    document.getElementById('hidden-misi-isi').value = val;
    document.getElementById('form-add-misi').submit();
}
</script>

<style>
.dropzone {
    border: 2px dashed rgba(255,255,255,0.15);
    border-radius: 0.75rem;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.25s ease;
    min-height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.dropzone:hover, .dropzone.dragover {
    border-color: rgba(245,158,11,0.5);
    background: rgba(245,158,11,0.05);
}
.dropzone.dragover {
    transform: scale(1.01);
}
</style>

<script>
function previewImage(input, previewId, contentId) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        // Warn if file exceeds 10MB
        if (file.size > 10 * 1024 * 1024) {
            alert('File terlalu besar (maks 10MB). Silakan kompres gambar terlebih dahulu.');
            input.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById(previewId);
            const content = document.getElementById(contentId);
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (content) content.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Drag & Drop setup
document.querySelectorAll('.dropzone').forEach(zone => {
    zone.addEventListener('dragover', e => {
        e.preventDefault();
        zone.classList.add('dragover');
    });
    zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
    zone.addEventListener('drop', e => {
        e.preventDefault();
        zone.classList.remove('dragover');
        const input = zone.nextElementSibling; // the hidden input
        if (input && e.dataTransfer.files.length) {
            // Transfer files to the input
            const dt = new DataTransfer();
            dt.items.add(e.dataTransfer.files[0]);
            input.files = dt.files;
            input.dispatchEvent(new Event('change'));
        }
    });
});
</script>

@endsection
