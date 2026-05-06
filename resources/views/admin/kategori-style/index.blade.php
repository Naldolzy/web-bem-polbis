@extends('layouts.admin')

@section('title', 'Gaya Kategori')
@section('page_title', 'Gaya Kategori Kegiatan')

@section('content')


<div class="max-w-4xl">
    {{-- Header card --}}
    <div class="card-glass rounded-2xl p-6 mb-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-lime-500/15 flex items-center justify-center flex-shrink-0">
                <i data-lucide="palette" class="w-6 h-6 text-lime-400"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">Kustomisasi Badge Kategori</h2>
                <p class="text-blue-400 text-sm mt-1">
                    Atur warna background (gradient), warna teks, dan ikon untuk setiap kategori kegiatan.
                    Badge akan otomatis tampil di halaman publik dan panel admin.
                </p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.kategori-style.update') }}" id="form-styles">
        @csrf

        {{-- Category rows --}}
        <div class="space-y-4" id="kategori-list">

            @php
                $icons = ['tag','star','zap','alert-circle','info','calendar','award','heart','flag','flame','shield','bookmark','bell','check-circle','clock','gift','globe','hash','layers','map-pin','megaphone','music','radio','rss','send','trending-up','tv','users','vote'];
            @endphp

            @foreach($allKategori as $nama)
                @php
                    $st = $savedStyles[$nama] ?? [];
                    $bgFrom  = $st['bg_from'] ?? '#1565C0';
                    $bgTo    = $st['bg_to']   ?? '#6BAF2A';
                    $text    = $st['text']    ?? '#ffffff';
                    $icon    = $st['icon']    ?? '';
                @endphp
                <div class="kategori-row card-glass rounded-2xl p-5" data-index="{{ $loop->index }}">
                    <div class="flex items-center gap-3 mb-5 flex-wrap">
                        {{-- Badge live preview --}}
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="live-preview px-3 py-1 rounded-full text-sm font-bold flex items-center gap-1 flex-shrink-0"
                                 style="background:linear-gradient(135deg,{{ $bgFrom }},{{ $bgTo }});color:{{ $text }};">
                                @if($icon)<i data-lucide="{{ $icon }}" class="preview-icon w-3 h-3" style="display:inline-block;"></i>@endif
                                <span class="preview-label">{{ $nama }}</span>
                            </div>
                            <input type="text" name="kategori[]"
                                   value="{{ $nama }}"
                                   placeholder="Nama kategori..."
                                   class="form-input flex-1 min-w-0 kategori-name-input"
                                   style="padding:0.45rem 0.75rem; font-size:0.875rem;">
                        </div>
                        {{-- Delete row --}}
                        <button type="button" onclick="removeRow(this)"
                            class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors flex-shrink-0"
                            title="Hapus baris">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        {{-- BG Color 1 --}}
                        <div>
                            <label class="form-label text-xs">Warna BG Awal</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="bg_from[]" value="{{ $bgFrom }}"
                                       class="color-input bg-from-input"
                                       style="width:40px;height:36px;border:none;background:transparent;cursor:pointer;padding:0;">
                                <code class="text-blue-400 text-xs font-mono color-hex-from">{{ $bgFrom }}</code>
                            </div>
                        </div>

                        {{-- BG Color 2 --}}
                        <div>
                            <label class="form-label text-xs">Warna BG Akhir <span class="text-blue-600">(gradient)</span></label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="bg_to[]" value="{{ $bgTo }}"
                                       class="color-input bg-to-input"
                                       style="width:40px;height:36px;border:none;background:transparent;cursor:pointer;padding:0;">
                                <code class="text-blue-400 text-xs font-mono color-hex-to">{{ $bgTo }}</code>
                            </div>
                        </div>

                        {{-- Text Color --}}
                        <div>
                            <label class="form-label text-xs">Warna Teks</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="text_color[]" value="{{ $text }}"
                                       class="color-input text-color-input"
                                       style="width:40px;height:36px;border:none;background:transparent;cursor:pointer;padding:0;">
                                <code class="text-blue-400 text-xs font-mono color-hex-text">{{ $text }}</code>
                            </div>
                        </div>

                        {{-- Icon --}}
                        <div>
                            <label class="form-label text-xs">Ikon Lucide</label>
                            <select name="icon[]" class="form-input icon-select" style="padding:0.45rem 0.6rem;font-size:0.8rem;">
                                <option value="">— Tanpa ikon —</option>
                                @foreach($icons as $ic)
                                    <option value="{{ $ic }}" {{ $icon === $ic ? 'selected' : '' }}>{{ $ic }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Preset palette quick-picks --}}
        <div class="card-glass rounded-2xl p-5 mt-5">
            <p class="text-blue-400 text-xs font-semibold uppercase tracking-widest mb-3">
                <i data-lucide="sparkles" class="w-3 h-3 inline-block mr-1"></i>
                Preset Warna Cepat
            </p>
            <div class="flex flex-wrap gap-2" id="presets">
                @php
                    $presets = [
                        ['label'=>'Biru-Hijau (Default)', 'from'=>'#1565C0','to'=>'#6BAF2A','text'=>'#ffffff'],
                        ['label'=>'Merah (Penting)',       'from'=>'#dc2626','to'=>'#b91c1c','text'=>'#ffffff'],
                        ['label'=>'Ungu (Spesial)',        'from'=>'#7c3aed','to'=>'#4f46e5','text'=>'#ffffff'],
                        ['label'=>'Oranye (Hangat)',       'from'=>'#ea580c','to'=>'#d97706','text'=>'#ffffff'],
                        ['label'=>'Hijau Daun',            'from'=>'#16a34a','to'=>'#15803d','text'=>'#ffffff'],
                        ['label'=>'Pink',                  'from'=>'#db2777','to'=>'#be185d','text'=>'#ffffff'],
                        ['label'=>'Cyan',                  'from'=>'#0891b2','to'=>'#0e7490','text'=>'#ffffff'],
                        ['label'=>'Emas',                  'from'=>'#ca8a04','to'=>'#a16207','text'=>'#ffffff'],
                    ];
                @endphp
                @foreach($presets as $p)
                    <button type="button"
                            class="preset-btn px-3 py-1.5 rounded-full text-xs font-bold transition-all hover:scale-105"
                            style="background:linear-gradient(135deg,{{ $p['from'] }},{{ $p['to'] }});color:{{ $p['text'] }};"
                            data-from="{{ $p['from'] }}" data-to="{{ $p['to'] }}" data-text="{{ $p['text'] }}">
                        {{ $p['label'] }}
                    </button>
                @endforeach
            </div>
            <p class="text-blue-600 text-xs mt-2">Klik preset → pilih baris kategori yang aktif → warna otomatis teraplikasi.</p>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 mt-6">
            <button type="button" id="btn-add-row"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-500/20 text-blue-300 text-sm font-semibold hover:bg-blue-500/30 transition-colors">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kategori Baru
            </button>

            <button type="submit" class="btn-primary ml-auto">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Semua Gaya
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // ======================================
    // Live preview: update badge when color/name changes
    // ======================================
    function updatePreview(row) {
        const preview    = row.querySelector('.live-preview');
        const label      = row.querySelector('.preview-label');
        const nameInput  = row.querySelector('.kategori-name-input');
        const bgFrom     = row.querySelector('.bg-from-input')?.value  || '#1565C0';
        const bgTo       = row.querySelector('.bg-to-input')?.value    || bgFrom;
        const textColor  = row.querySelector('.text-color-input')?.value || '#ffffff';
        const iconSelect = row.querySelector('.icon-select')?.value    || '';

        preview.style.background = `linear-gradient(135deg,${bgFrom},${bgTo})`;
        preview.style.color      = textColor;

        if (label && nameInput) {
            label.textContent = nameInput.value || 'preview';
        }

        // Update hex labels
        const hexFrom = row.querySelector('.color-hex-from');
        const hexTo   = row.querySelector('.color-hex-to');
        const hexText = row.querySelector('.color-hex-text');
        if (hexFrom) hexFrom.textContent = bgFrom;
        if (hexTo)   hexTo.textContent   = bgTo;
        if (hexText) hexText.textContent = textColor;

        // Update icon in preview
        let iconEl = preview.querySelector('.preview-icon');
        if (iconSelect) {
            if (!iconEl) {
                iconEl = document.createElement('i');
                iconEl.className = 'preview-icon w-3 h-3';
                iconEl.style.display = 'inline-block';
                preview.prepend(iconEl);
            }
            iconEl.setAttribute('data-lucide', iconSelect);
            lucide.createIcons({ nodes: [iconEl] });
        } else if (iconEl) {
            iconEl.remove();
        }
    }

    // Delegate all color/select/input changes
    document.getElementById('kategori-list').addEventListener('input', function(e) {
        const row = e.target.closest('.kategori-row');
        if (row) updatePreview(row);
    });
    document.getElementById('kategori-list').addEventListener('change', function(e) {
        const row = e.target.closest('.kategori-row');
        if (row) updatePreview(row);
    });

    // ======================================
    // Remove row
    // ======================================
    function removeRow(btn) {
        btn.closest('.kategori-row').remove();
    }

    // ======================================
    // Add new row
    // ======================================
    let rowCount = {{ count($allKategori) }};

    document.getElementById('btn-add-row').addEventListener('click', function () {
        const icons = @json($icons);
        let optionsHtml = '<option value="">— Tanpa ikon —</option>';
        icons.forEach(ic => { optionsHtml += `<option value="${ic}">${ic}</option>`; });

        const tpl = `
        <div class="kategori-row card-glass rounded-2xl p-5" data-index="${rowCount}">
            <div class="flex items-center gap-3 mb-5 flex-wrap">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="live-preview px-3 py-1 rounded-full text-sm font-bold flex items-center gap-1 flex-shrink-0"
                         style="background:linear-gradient(135deg,#1565C0,#6BAF2A);color:#ffffff;">
                        <span class="preview-label">kategori baru</span>
                    </div>
                    <input type="text" name="kategori[]" placeholder="Nama kategori..."
                           class="form-input flex-1 min-w-0 kategori-name-input"
                           style="padding:0.45rem 0.75rem; font-size:0.875rem;">
                </div>
                <button type="button" onclick="removeRow(this)"
                    class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors flex-shrink-0">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="form-label text-xs">Warna BG Awal</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="bg_from[]" value="#1565C0"
                               class="color-input bg-from-input"
                               style="width:40px;height:36px;border:none;background:transparent;cursor:pointer;padding:0;">
                        <code class="text-blue-400 text-xs font-mono color-hex-from">#1565C0</code>
                    </div>
                </div>
                <div>
                    <label class="form-label text-xs">Warna BG Akhir <span class="text-blue-600">(gradient)</span></label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="bg_to[]" value="#6BAF2A"
                               class="color-input bg-to-input"
                               style="width:40px;height:36px;border:none;background:transparent;cursor:pointer;padding:0;">
                        <code class="text-blue-400 text-xs font-mono color-hex-to">#6BAF2A</code>
                    </div>
                </div>
                <div>
                    <label class="form-label text-xs">Warna Teks</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="text_color[]" value="#ffffff"
                               class="color-input text-color-input"
                               style="width:40px;height:36px;border:none;background:transparent;cursor:pointer;padding:0;">
                        <code class="text-blue-400 text-xs font-mono color-hex-text">#ffffff</code>
                    </div>
                </div>
                <div>
                    <label class="form-label text-xs">Ikon Lucide</label>
                    <select name="icon[]" class="form-input icon-select" style="padding:0.45rem 0.6rem;font-size:0.8rem;">
                        ${optionsHtml}
                    </select>
                </div>
            </div>
        </div>`;

        document.getElementById('kategori-list').insertAdjacentHTML('beforeend', tpl);
        lucide.createIcons();
        rowCount++;
    });

    // ======================================
    // Preset color picker
    // ======================================
    let activeRow = null;

    document.getElementById('kategori-list').addEventListener('click', function(e) {
        const row = e.target.closest('.kategori-row');
        if (!row) return;
        // Deselect previous
        document.querySelectorAll('.kategori-row').forEach(r => r.style.outline = '');
        // Highlight selected
        row.style.outline = '2px solid rgba(107,175,42,0.7)';
        activeRow = row;
    });

    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!activeRow) {
                alert('Pilih dulu baris kategori yang ingin diubah warnanya, kemudian klik preset.');
                return;
            }
            const from = this.dataset.from;
            const to   = this.dataset.to;
            const text = this.dataset.text;

            activeRow.querySelector('.bg-from-input').value    = from;
            activeRow.querySelector('.bg-to-input').value      = to;
            activeRow.querySelector('.text-color-input').value = text;
            updatePreview(activeRow);
        });
    });

    lucide.createIcons();
</script>
@endpush

@endsection
