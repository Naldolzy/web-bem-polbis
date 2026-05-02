@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('page_title', 'Pengaturan Website')

@section('content')
<div class="max-w-2xl space-y-6">

    {{-- Status Card --}}
    <div style="background: rgba(26, 45, 90, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <h2 class="text-white font-bold text-lg mb-1">Status Website</h2>
                <p class="text-slate-400 text-sm">Kunci website untuk menampilkan halaman maintenance kepada pengunjung.</p>
            </div>
            <div class="flex-shrink-0">
                @if($isLocked)
                    <span style="display:inline-flex; align-items:center; gap:0.5rem; background:rgba(239,68,68,0.15); color:#f87171; border:1px solid rgba(239,68,68,0.3); padding:0.5rem 1rem; border-radius:9999px; font-weight:bold; font-size:0.875rem;">
                        <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                        TERKUNCI
                    </span>
                @else
                    <span style="display:inline-flex; align-items:center; gap:0.5rem; background:rgba(34,197,94,0.15); color:#4ade80; border:1px solid rgba(34,197,94,0.3); padding:0.5rem 1rem; border-radius:9999px; font-weight:bold; font-size:0.875rem;">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        ONLINE
                    </span>
                @endif
            </div>
        </div>

        @if($isLocked && $lockReason)
        <div style="margin-top:1.5rem; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); border-radius:0.75rem; padding:1rem;">
            <p style="font-size:0.75rem; font-weight:600; color:#f87171; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.25rem;">Alasan Penguncian:</p>
            <p class="text-slate-300 text-sm">{{ $lockReason }}</p>
        </div>
        @endif
    </div>

    @if(!$isLocked)
    {{-- Lock Form --}}
    <div style="background: rgba(26, 45, 90, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <h3 class="text-white font-bold mb-1">🔒 Kunci Website</h3>
        <p class="text-slate-400 text-sm mb-5">Pengunjung umum akan diarahkan ke halaman maintenance. Admin tetap bisa akses panel.</p>

        <form method="POST" action="{{ route('admin.site-settings.lock') }}">
            @csrf
            <div class="mb-4">
                <label class="form-label">Alasan Penguncian <span class="text-red-400">*</span></label>
                <textarea name="reason" rows="3" required
                    class="form-textarea"
                    placeholder="Contoh: Website sedang dalam pemeliharaan terjadwal. Akan kembali normal dalam 2 jam.">{{ old('reason') }}</textarea>
                @error('reason')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit"
                style="width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:rgba(239,68,68,0.15); color:#f87171; border:1px solid rgba(239,68,68,0.3); font-weight:bold; padding:0.75rem 1.5rem; border-radius:0.75rem; transition:all 0.3s; cursor:pointer;"
                onmouseover="this.style.background='rgba(239,68,68,0.25)'" onmouseout="this.style.background='rgba(239,68,68,0.15)'"
                onclick="return confirm('Yakin ingin mengunci website? Pengunjung tidak bisa mengakses halaman publik.')">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Kunci Website Sekarang
            </button>
        </form>
    </div>

    @else
    {{-- Unlock Form --}}
    <div style="background: rgba(26, 45, 90, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <h3 class="text-white font-bold mb-1">🔓 Buka Kunci Website</h3>
        <p class="text-slate-400 text-sm mb-5">Pengunjung kembali bisa mengakses semua halaman publik secara normal.</p>

        <form method="POST" action="{{ route('admin.site-settings.unlock') }}">
            @csrf
            <button type="submit"
                style="width:100%; display:flex; align-items:center; justify-content:center; gap:0.5rem; background:rgba(34,197,94,0.15); color:#4ade80; border:1px solid rgba(34,197,94,0.3); font-weight:bold; padding:0.75rem 1.5rem; border-radius:0.75rem; transition:all 0.3s; cursor:pointer;"
                onmouseover="this.style.background='rgba(34,197,94,0.25)'" onmouseout="this.style.background='rgba(34,197,94,0.15)'">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                </svg>
                Buka Kunci Website
            </button>
        </form>
    </div>
    @endif

    {{-- Info Box --}}
    <div style="background:rgba(201,162,39,0.08); border:1px solid rgba(201,162,39,0.2); border-radius:0.75rem; padding:1rem;">
        <div class="flex gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:#C9A227;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p style="color:#C9A227; font-weight:600; font-size:0.875rem; margin-bottom:0.25rem;">Catatan Penting</p>
                <ul class="text-slate-400 text-sm space-y-1">
                    <li>• Saat website dikunci, <strong class="text-slate-300">admin tetap bisa login</strong> dan mengakses panel.</li>
                    <li>• Hanya <strong class="text-slate-300">Super Admin</strong> yang bisa membuka/mengunci website.</li>
                    <li>• Sitemap & robots.txt tetap dapat diakses meski website dikunci.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
