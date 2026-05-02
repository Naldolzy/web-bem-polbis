@extends('layouts.admin')

@section('title', 'Ganti Password')
@section('page_title', 'Ganti Password')

@section('content')
<div class="max-w-lg">
    <div class="admin-card p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-xl bg-amber-500/15 border border-amber-500/30 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">Ganti Password</h2>
                <p class="text-slate-400 text-sm">Akun: <span class="text-amber-400">{{ auth()->user()->email }}</span></p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.account.update-password') }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Password Saat Ini</label>
                <input type="password" name="current_password" required
                    class="admin-input w-full" placeholder="Masukkan password saat ini">
                @error('current_password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Password Baru</label>
                <input type="password" name="password" required
                    class="admin-input w-full" placeholder="Minimal 8 karakter">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required
                    class="admin-input w-full" placeholder="Ulangi password baru">
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-admin-primary w-full">
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
