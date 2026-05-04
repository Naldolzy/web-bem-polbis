@extends('layouts.admin')

@section('title', 'Edit Akun Admin')
@section('page_title', 'Edit Akun Admin')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-white text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Admin
    </a>

    <div style="background: rgba(21, 101, 192, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <h2 class="text-white font-bold text-lg mb-1">Edit Akun</h2>
        <p class="text-blue-400 text-sm mb-6">Kosongkan password jika tidak ingin mengubah password.</p>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="form-input">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="form-input">
                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Role</label>
                <select name="role" class="form-input">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} style="background:#0F4AA8;">Admin</option>
                    <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }} style="background:#0F4AA8;">Super Admin</option>
                </select>
                @error('role')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="border-t border-white/08 pt-5 mt-5">
                <p class="text-xs font-semibold text-blue-500 uppercase tracking-widest mb-4">Reset Password (Opsional)</p>

                <div class="space-y-4">
                    <div>
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password"
                            class="form-input" placeholder="Kosongkan jika tidak diubah">
                        @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="form-input" placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            <div class="pt-2 mt-4">
                <button type="submit" class="btn-primary w-full justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
