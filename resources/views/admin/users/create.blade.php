@extends('layouts.admin')

@section('title', 'Tambah Akun Admin')
@section('page_title', 'Tambah Akun Admin')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-blue-400 hover:text-white text-sm mb-6 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Daftar Admin
    </a>

    <div style="background: rgba(21, 101, 192, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; padding: 1.5rem;">
        <h2 class="text-white font-bold text-lg mb-6">Data Akun Baru</h2>

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="form-input" placeholder="Nama Admin">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="form-input" placeholder="admin@bem-polbis.ac.id">
                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Role</label>
                <select name="role" class="form-input">
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }} style="background:#0F4AA8;">Admin</option>
                    <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }} style="background:#0F4AA8;">Super Admin</option>
                </select>
                @error('role')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Password</label>
                <input type="password" name="password" required
                    class="form-input" placeholder="Minimal 8 karakter">
                @error('password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="form-input" placeholder="Ulangi password">
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-primary w-full justify-center">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Buat Akun Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
