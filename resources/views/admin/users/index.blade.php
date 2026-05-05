@extends('layouts.admin')

@section('title', 'Kelola Akun Admin')
@section('page_title', 'Kelola Akun Admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-blue-400 text-sm mt-1">Manajemen akun admin panel BEM Polbis</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
        <i data-lucide="plus" class="w-4 h-4" style="display:inline; margin-right:4px;"></i>
        Tambah Admin
    </a>
</div>

<div style="background: rgba(21, 101, 192, 0.35); border: 1px solid rgba(255,255,255,0.07); border-radius: 1rem; overflow: hidden;">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-lime-600 to-lime-700 flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-900 font-bold text-xs">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        </div>
                        <div>
                            <div class="text-white font-semibold text-sm">{{ $user->name }}</div>
                            @if($user->id === auth()->id())
                                <span class="text-xs text-lime-500">(Anda)</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role === 'superadmin')
                        <span style="display:inline-flex; align-items:center; gap:0.375rem; background:rgba(107,175,42,0.15); color:#6BAF2A; border:1px solid rgba(107,175,42,0.3); font-size:0.75rem; font-weight:bold; padding:0.25rem 0.625rem; border-radius:9999px;">
                            <i data-lucide="crown" class="w-3 h-3"></i>
                            Super Admin
                        </span>
                    @else
                        <span style="display:inline-flex; align-items:center; gap:0.375rem; background:rgba(59,130,246,0.15); color:#60a5fa; border:1px solid rgba(59,130,246,0.3); font-size:0.75rem; font-weight:bold; padding:0.25rem 0.625rem; border-radius:9999px;">
                            <i data-lucide="user" class="w-3 h-3"></i>
                            Admin
                        </span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center gap-2">
                        <code style="color:#64748b; font-size:0.75rem; font-family:monospace; background:rgba(255,255,255,0.05); padding:0.25rem 0.5rem; border-radius:0.25rem;" id="pass-text-{{ $user->id }}">••••••••</code>
                        <button onclick="togglePassword({{ $user->id }})"
                            class="text-blue-500 hover:text-lime-400 transition-colors"
                            title="Tampilkan Password">
                            <i data-lucide="eye" class="w-4 h-4" id="eye-icon-{{ $user->id }}"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            style="font-size:0.75rem; background:rgba(255,255,255,0.08); color:#cbd5e1; padding:0.375rem 0.75rem; border-radius:0.5rem; display:flex; align-items:center; gap:0.25rem; text-decoration:none;">
                            <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                            Edit
                        </a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                              onsubmit="return confirm('Yakin hapus akun {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                style="font-size:0.75rem; background:rgba(239,68,68,0.1); color:#f87171; padding:0.375rem 0.75rem; border-radius:0.5rem; display:flex; align-items:center; gap:0.25rem; border:none; cursor:pointer;">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
const passwordCache = {};

async function togglePassword(userId) {
    const el = document.getElementById(`pass-text-${userId}`);
    if (el.textContent !== '••••••••') {
        el.textContent = '••••••••';
        el.style.color = '#64748b';
        return;
    }

    if (passwordCache[userId]) {
        el.textContent = passwordCache[userId];
        el.style.color = '#6BAF2A';
        return;
    }

    el.textContent = 'loading...';
    try {
        const res = await fetch(`/bem-admin/users/${userId}/password`);
        const data = await res.json();
        if (data.password) {
            passwordCache[userId] = data.password;
            el.textContent = data.password;
            el.style.color = '#6BAF2A';
        } else {
            el.textContent = data.message || 'Tidak tersedia';
            el.style.color = '#64748b';
        }
    } catch {
        el.textContent = 'Error';
    }
}
</script>
@endsection
