<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Admin BEM Polbis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="sidebar">
            <div class="p-6">
                <!-- Logo -->
                @php $logo_bem_admin = \App\Models\ProfilBem::getValue('logo_bem'); @endphp
                <div class="flex items-center gap-3 mb-8">
                    @if($logo_bem_admin)
                        <img src="{{ asset('storage/' . $logo_bem_admin) }}" alt="Logo BEM"
                            class="w-10 h-10 rounded-xl object-contain bg-white/05 p-0.5">
                    @else
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg">
                            <span class="text-gray-900 font-black text-sm">BEM</span>
                        </div>
                    @endif
                    <div>
                        <div class="text-white font-bold text-sm">Admin Panel</div>
                        <div class="text-amber-500 text-xs">BEM Polbis</div>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="space-y-1">
                    <p class="text-xs font-semibold text-slate-600 uppercase tracking-widest px-3 mb-2">Menu Utama</p>

                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.kegiatan*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Kegiatan
                    </a>

                    <a href="{{ route('admin.struktur.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.struktur*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Struktur Organisasi
                    </a>

                    <a href="{{ route('admin.profil.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Profil BEM
                    </a>

                    <a href="{{ route('admin.ormawa.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.ormawa*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Ormawa
                    </a>

                    <div class="my-4 border-t border-white/06"></div>
                    <p class="text-xs font-semibold text-slate-600 uppercase tracking-widest px-3 mb-2">Aksi</p>

                    <a href="{{ route('beranda') }}" target="_blank" class="sidebar-link">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Lihat Website
                    </a>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link w-full text-left hover:text-red-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="admin-content flex-1">
            <!-- Topbar -->
            <div class="admin-topbar">
                <div class="flex items-center gap-4">
                    <button id="sidebar-toggle" class="md:hidden text-slate-400 hover:text-amber-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-white font-semibold text-lg">@yield('page_title', 'Dashboard')</h1>
                </div>
                <!-- <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center">
                            <span class="text-gray-900 font-bold text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                        </div>
                        <span class="text-slate-300 text-sm hidden sm:inline">{{ auth()->user()->name }}</span>
                    </div>
                </div> -->
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="alert-success mb-6">
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-error mb-6">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }
    </script>
</body>

</html>