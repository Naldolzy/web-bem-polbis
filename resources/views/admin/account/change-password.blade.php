@extends('layouts.admin')

@section('title', 'Ganti Password')
@section('page_title', 'Ganti Password')

@section('content')
<div class="max-w-lg">
    <div style="background: rgba(26, 45, 90, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <div class="flex items-center gap-3 mb-6">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(201,162,39,0.15);border:1px solid rgba(201,162,39,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg style="width:24px;height:24px;color:#C9A227;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">Ganti Password</h2>
                <p class="text-slate-400 text-sm">Akun: <span style="color:#C9A227;">{{ auth()->user()->email }}</span></p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.account.update-password') }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="form-label">Password Saat Ini</label>
                <input type="password" name="current_password" required
                    class="form-input" placeholder="Masukkan password saat ini">
                @error('current_password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" required
                    class="form-input" placeholder="Minimal 8 karakter">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required
                    class="form-input" placeholder="Ulangi password baru">
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-primary w-full justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
