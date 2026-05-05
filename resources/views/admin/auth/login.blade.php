<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | BEM Polbis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
</head>

<body class="antialiased" style="background: #0a192f;">

    <div class="min-h-screen flex items-center justify-center px-4 relative overflow-hidden">
        <!-- Background particles -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-lime-500/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl"></div>
        </div>

        <div class="w-full max-w-md relative z-10">
            <!-- Logo -->
            @php $logo_bem = \App\Models\ProfilBem::getValue('logo_bem'); @endphp
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 flex justify-center">
                    @if(!empty($logo_bem))
                        <img src="{{ asset('storage/' . $logo_bem) }}" alt="Logo BEM"
                            class="w-20 h-20 object-contain drop-shadow-xl">
                    @else
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-lime-600 to-lime-700 flex items-center justify-center shadow-xl">
                            <span class="text-gray-900 font-black text-xl">BEM</span>
                        </div>
                    @endif
                </div>
                <h1 class="text-white font-bold text-2xl" style="font-family: 'Plus Jakarta Sans', sans-serif;">Admin
                    BEM Polbis</h1>
                <p class="text-blue-400 text-sm mt-1">Masuk untuk mengelola website</p>
            </div>

            <!-- Login Card -->
            <div class="card-glass p-8 rounded-2xl">
                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">Email Admin</label>
                        <div class="input-icon-wrap">
                            <span class="input-icon">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-input @error('email') border-red-500 @enderror"
                                placeholder="admin@bem-polbis.ac.id">
                        </div>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <div class="input-icon-wrap">
                            <span class="input-icon">
                                <i data-lucide="lock-keyhole" class="w-4 h-4"></i>
                            </span>
                            <input id="password" type="password" name="password" required class="form-input"
                                style="padding-right: 3rem;" placeholder="••••••••">
                            <button type="button" onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-400 hover:text-lime-400 transition-colors"
                                id="eye-toggle">
                                <i data-lucide="eye" class="w-4 h-4" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center gap-3">
                        <input id="remember" type="checkbox" name="remember" class="custom-check">
                        <label for="remember" class="text-blue-400 text-sm cursor-pointer select-none">Ingat
                            saya</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="login-btn" class="btn-primary w-full justify-center">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        Masuk ke Panel Admin
                    </button>
                </form>
            </div>

            <p class="text-center text-blue-600 text-xs mt-6">
                Halaman ini hanya untuk anggota BEM Polbis yang berwenang.
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>

</body>

</html>