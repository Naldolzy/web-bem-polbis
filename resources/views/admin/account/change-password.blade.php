@extends('layouts.admin')

@section('title', 'Ganti Password')
@section('page_title', 'Ganti Password')

@section('content')
<div class="max-w-lg">
    <div style="background: rgba(21, 101, 192, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <div class="flex items-center gap-3 mb-6">
            <div style="width:48px;height:48px;border-radius:12px;background:rgba(107,175,42,0.15);border:1px solid rgba(107,175,42,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i data-lucide="key-round" style="width:24px;height:24px;color:#6BAF2A;"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">Ganti Password</h2>
                <p class="text-blue-400 text-sm">Akun: <span style="color:#6BAF2A;">{{ auth()->user()->email }}</span></p>
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
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
