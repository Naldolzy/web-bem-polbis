@extends('layouts.admin')

@section('title', 'Edit Akun Admin')
@section('page_title', 'Edit Akun Admin')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Admin
    </a>

    <div class="admin-card p-6">
        <h2 class="text-white font-bold text-lg mb-1">Edit Akun</h2>
        <p class="text-slate-400 text-sm mb-6">Kosongkan password jika tidak ingin mengubah password.</p>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="admin-input w-full">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="admin-input w-full">
                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Role</label>
                <select name="role" class="admin-input w-full">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                @error('role')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="border-t border-white/08 pt-5">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-4">Reset Password (Opsional)</p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Password Baru</label>
                        <input type="password" name="password"
                            class="admin-input w-full" placeholder="Kosongkan jika tidak diubah">
                        @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="admin-input w-full" placeholder="Ulangi password baru">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-admin-primary w-full">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
