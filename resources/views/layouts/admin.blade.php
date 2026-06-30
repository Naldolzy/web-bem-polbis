<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Admin BEM Polbis</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    {{-- Quill Rich Text Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.snow.css" rel="stylesheet">
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
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-lime-600 to-lime-700 flex items-center justify-center shadow-lg">
                            <span class="text-gray-900 font-black text-sm">BEM</span>
                        </div>
                    @endif
                    <div>
                        <div class="text-white font-bold text-sm">Admin Panel</div>
                        <div class="text-lime-500 text-xs">BEM Polbis</div>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="space-y-1">
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest px-3 mb-2">Menu Utama</p>

                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.kegiatan.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.kegiatan*') ? 'active' : '' }}">
                        <i data-lucide="calendar-days" class="w-5 h-5"></i>
                        Kegiatan
                    </a>

                    <a href="{{ route('admin.struktur.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.struktur*') ? 'active' : '' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        Struktur Organisasi
                    </a>

                    <a href="{{ route('admin.profil.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                        Profil BEM
                    </a>

                    <a href="{{ route('admin.ormawa.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.ormawa*') ? 'active' : '' }}">
                        <i data-lucide="landmark" class="w-5 h-5"></i>
                        Ormawa
                    </a>

                    <a href="{{ route('admin.kategori-style.index') }}"
                        class="sidebar-link {{ request()->routeIs('admin.kategori-style*') ? 'active' : '' }}">
                        <i data-lucide="palette" class="w-5 h-5"></i>
                        Gaya Kategori
                    </a>

                    {{-- Super Admin Only Menu --}}
                    @if(auth()->user()->isSuperAdmin())
                        <div class="my-4 border-t border-white/06"></div>
                        <p class="text-xs font-semibold text-lime-600/80 uppercase tracking-widest px-3 mb-2">⚡ Super Admin
                        </p>

                        <a href="{{ route('admin.users.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                            Kelola Akun Admin
                        </a>

                        <a href="{{ route('admin.site-settings.index') }}"
                            class="sidebar-link {{ request()->routeIs('admin.site-settings*') ? 'active' : '' }}">
                            <i data-lucide="settings-2" class="w-5 h-5"></i>
                            Pengaturan Website
                            @if(\App\Models\SiteSetting::isLocked())
                                <span class="ml-auto w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                            @endif
                        </a>
                    @endif

                    <div class="my-4 border-t border-white/06"></div>
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest px-3 mb-2">Aksi</p>

                    <a href="{{ route('admin.account.change-password') }}"
                        class="sidebar-link {{ request()->routeIs('admin.account*') ? 'active' : '' }}">
                        <i data-lucide="key-round" class="w-5 h-5"></i>
                        Ganti Password
                    </a>

                    <a href="{{ route('beranda') }}" target="_blank" class="sidebar-link">
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                        Lihat Website
                    </a>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link w-full text-left hover:text-red-400">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
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
                    <button id="sidebar-toggle" class="md:hidden text-blue-400 hover:text-lime-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-white font-semibold text-lg">@yield('page_title', 'Dashboard')</h1>
                </div>
                {{-- User info + role badge di topbar --}}
                <div class="flex items-center gap-3">
                    @if(auth()->user()->isSuperAdmin())
                        <span
                            class="hidden sm:inline-flex items-center gap-1 bg-lime-500/15 text-lime-400 border border-lime-500/30 text-xs font-bold px-2.5 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Super Admin
                        </span>
                    @else
                        <span
                            class="hidden sm:inline-flex items-center gap-1 bg-blue-500/15 text-blue-400 border border-blue-500/30 text-xs font-bold px-2.5 py-1 rounded-full">
                            Admin
                        </span>
                    @endif
                    <div class="flex items-center gap-2">
                        <!-- <div
                            class="w-8 h-8 rounded-full bg-gradient-to-br from-lime-600 to-lime-700 flex items-center justify-center">
                            <span
                                class="text-gray-900 font-bold text-xs">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                        </div> -->
                        <span class="text-blue-100 text-sm hidden sm:inline">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="alert-success mb-6">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-400 flex-shrink-0"></i>
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

    <script src="https://cdn.jsdelivr.net/npm/quill@2/dist/quill.js"></script>
    <script>
        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }
        // Init Lucide Icons
        lucide.createIcons();

        // Global File Size Validation (Vercel 4.5MB Payload Limit)
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const fileInputs = form.querySelectorAll('input[type="file"]');
                let totalSize = 0;
                
                fileInputs.forEach(input => {
                    if (input.files && input.files.length > 0) {
                        for (let i = 0; i < input.files.length; i++) {
                            totalSize += input.files[i].size;
                        }
                    }
                });

                // 4.3 MB limit untuk ngasih ruang ke text/form data lain
                if (totalSize > 4300000) {
                    e.preventDefault();
                    alert('⚠️ GAGAL UPLOAD: Ukuran gambar terlalu besar!\n\nBatas maksimal total ukuran gambar adalah 4.3 MB (karena limit Vercel). Silakan kompres gambar Anda terlebih dahulu menggunakan web seperti tinypng.com atau iloveimg.com.');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>