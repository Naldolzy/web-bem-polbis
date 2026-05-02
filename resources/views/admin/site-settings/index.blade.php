@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('page_title', 'Pengaturan Website')

@section('content')
<div class="max-w-2xl space-y-6">

    {{-- Status Card --}}
    <div class="admin-card p-6">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <h2 class="text-white font-bold text-lg mb-1">Status Website</h2>
                <p class="text-slate-400 text-sm">Kunci website untuk menampilkan halaman maintenance kepada pengunjung.</p>
            </div>
            <div class="flex-shrink-0">
                @if($isLocked)
                    <span class="inline-flex items-center gap-2 bg-red-500/15 text-red-400 border border-red-500/30 px-4 py-2 rounded-full font-bold text-sm">
                        <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                        TERKUNCI
                    </span>
                @else
                    <span class="inline-flex items-center gap-2 bg-green-500/15 text-green-400 border border-green-500/30 px-4 py-2 rounded-full font-bold text-sm">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        ONLINE
                    </span>
                @endif
            </div>
        </div>

        @if($isLocked && $lockReason)
        <div class="mt-4 bg-red-500/08 border border-red-500/20 rounded-xl p-4">
            <p class="text-xs font-semibold text-red-400 uppercase tracking-wider mb-1">Alasan Penguncian:</p>
            <p class="text-slate-300 text-sm">{{ $lockReason }}</p>
        </div>
        @endif
    </div>

    @if(!$isLocked)
    {{-- Lock Form --}}
    <div class="admin-card p-6">
        <h3 class="text-white font-bold mb-1">🔒 Kunci Website</h3>
        <p class="text-slate-400 text-sm mb-5">Pengunjung umum akan diarahkan ke halaman maintenance. Admin tetap bisa akses panel.</p>

        <form method="POST" action="{{ route('admin.site-settings.lock') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Alasan Penguncian <span class="text-red-400">*</span></label>
                <textarea name="reason" rows="3" required
                    class="admin-input w-full resize-none"
                    placeholder="Contoh: Website sedang dalam pemeliharaan terjadwal. Akan kembali normal dalam 2 jam.">{{ old('reason') }}</textarea>
                @error('reason')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-red-500/15 hover:bg-red-500/25 text-red-400 border border-red-500/30 hover:border-red-500/50 font-bold py-3 px-6 rounded-xl transition-all"
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
    <div class="admin-card p-6">
        <h3 class="text-white font-bold mb-1">🔓 Buka Kunci Website</h3>
        <p class="text-slate-400 text-sm mb-5">Pengunjung kembali bisa mengakses semua halaman publik secara normal.</p>

        <form method="POST" action="{{ route('admin.site-settings.unlock') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-green-500/15 hover:bg-green-500/25 text-green-400 border border-green-500/30 hover:border-green-500/50 font-bold py-3 px-6 rounded-xl transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                </svg>
                Buka Kunci Website
            </button>
        </form>
    </div>
    @endif

    {{-- Info Box --}}
    <div class="bg-amber-500/08 border border-amber-500/20 rounded-xl p-4">
        <div class="flex gap-3">
            <svg class="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-amber-400 font-semibold text-sm mb-1">Catatan Penting</p>
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
