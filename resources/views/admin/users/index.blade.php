@extends('layouts.admin')

@section('title', 'Kelola Akun Admin')
@section('page_title', 'Kelola Akun Admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-blue-400 text-sm mt-1">Manajemen akun admin panel BEM Polbis</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:inline; margin-right:4px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
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
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            Super Admin
                        </span>
                    @else
                        <span style="display:inline-flex; align-items:center; gap:0.375rem; background:rgba(59,130,246,0.15); color:#60a5fa; border:1px solid rgba(59,130,246,0.3); font-size:0.75rem; font-weight:bold; padding:0.25rem 0.625rem; border-radius:9999px;">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
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
                            <svg class="w-4 h-4" id="eye-icon-{{ $user->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </td>
                <td>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            style="font-size:0.75rem; background:rgba(255,255,255,0.08); color:#cbd5e1; padding:0.375rem 0.75rem; border-radius:0.5rem; display:flex; align-items:center; gap:0.25rem; text-decoration:none;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                              onsubmit="return confirm('Yakin hapus akun {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                style="font-size:0.75rem; background:rgba(239,68,68,0.1); color:#f87171; padding:0.375rem 0.75rem; border-radius:0.5rem; display:flex; align-items:center; gap:0.25rem; border:none; cursor:pointer;">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
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
