@extends('layouts.admin')

@section('title', 'Tambah Akun Admin')
@section('page_title', 'Tambah Akun Admin')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-sm mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Admin
    </a>

    <div class="admin-card p-6">
        <h2 class="text-white font-bold text-lg mb-6">Data Akun Baru</h2>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="admin-input w-full" placeholder="Nama Admin">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="admin-input w-full" placeholder="admin@bem-polbis.ac.id">
                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Role</label>
                <select name="role" class="admin-input w-full">
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                @error('role')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                <input type="password" name="password" required
                    class="admin-input w-full" placeholder="Minimal 8 karakter">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="admin-input w-full" placeholder="Ulangi password">
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-admin-primary w-full">
                    Buat Akun Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
