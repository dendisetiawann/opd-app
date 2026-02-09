<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Manajemen Data Aplikasi OPD</title>
    <link rel="icon" href="{{ asset('images/logo-favicon-192.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; transition: background-color 0.4s ease, color 0.4s ease; }
        
        /* Dark Mode Styles - Premium Dark Theme */
        .dark body { background-color: #0a0f1a; color: #e2e8f0; }
        .dark .bg-white { background-color: #0a0f1a; }
        .dark .text-gray-900 { color: #f8fafc; }
        .dark .text-gray-500 { color: #94a3b8; }
        .dark .text-gray-400 { color: #64748b; }
        .dark .text-gray-700 { color: #cbd5e1; }
        .dark .text-\[\#1a237e\] { color: #60a5fa !important; }
        
        /* Form elements in dark mode */
        .dark input[type="email"],
        .dark input[type="password"],
        .dark input[type="text"],
        .dark input[type="number"] {
            background-color: #1a2332;
            border-color: #2d3748;
            color: #f1f5f9;
        }
        .dark input::placeholder { color: #64748b; }
        .dark input:focus { border-color: #60a5fa; ring-color: #60a5fa; }
        
        /* Toggle Button */
        .theme-toggle { transition: all 0.3s ease; }
        .theme-toggle:hover { transform: rotate(15deg) scale(1.1); }
        
        /* Captcha & Math */
        .dark .bg-gray-50 { background-color: #1a2332; border-color: #2d3748; }
        .dark .text-gray-600 { color: #94a3b8; }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="h-full">
    <div class="flex min-h-full">
        <!-- Left Side: Login Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white dark:bg-[#0a0f1a] z-10 relative">
            <!-- Theme Toggle -->
            <button id="themeToggle" class="absolute top-6 right-6 theme-toggle p-2 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors" title="Toggle Dark Mode">
                <svg id="sunIcon" class="w-6 h-6 text-amber-500 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                </svg>
                <svg id="moonIcon" class="w-6 h-6 text-blue-400 hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </button>
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex items-center gap-4 mb-6">
                        <!-- Logo Shield -->
                        <div class="relative w-12 h-12 flex items-center justify-center">
                            <img src="{{ asset('images/logo-pekanbaru.png') }}" alt="Logo Pekanbaru" class="w-full h-full object-contain filter drop-shadow-sm">
                        </div>
        
                        <!-- Separator Line -->
                        <div class="h-10 w-[2px] bg-slate-300 dark:bg-slate-600 rounded-full hidden sm:block"></div>
        
                        <!-- Text Content -->
                        <div class="flex flex-col justify-center">
                            <div class="flex items-baseline gap-1.5 leading-none">
                                <span class="text-2xl font-extrabold text-[#1a237e] dark:text-blue-400 tracking-tight drop-shadow-sm">SIDATA</span>
                                <span class="text-2xl font-bold text-slate-600 dark:text-slate-200">PKU</span>
                            </div>
                            <span class="text-[0.65rem] font-bold text-slate-500 dark:text-slate-400 tracking-[0.15em] uppercase mt-0.5 leading-tight">
                                Sistem Informasi Data Terpadu
                            </span>
                            <span class="text-[0.6rem] font-serif italic text-slate-400 dark:text-slate-500 mt-0.5">
                                Pemerintah Kota Pekanbaru
                            </span>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Silahkan masuk ke akun Anda untuk mengakses dashboard manajemen aplikasi.
                    </p>
                </div>

                <!-- Form -->
                <div class="mt-8">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Email
                                </span>
                            </label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Password
                                </span>
                            </label>
                            <div class="mt-2 relative">
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                    placeholder="Masukkan password Anda">
                                <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <script>
                            function togglePassword(inputId, iconId) {
                                const input = document.getElementById(inputId);
                                const icon = document.getElementById(iconId);
                                
                                if (input.type === 'password') {
                                    input.type = 'text';
                                    icon.innerHTML = `
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                    `;
                                } else {
                                    input.type = 'password';
                                    icon.innerHTML = `
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    `;
                                }
                            }
                        </script>

                        <!-- Simple Math CAPTCHA Card -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                            <p class="text-xs text-gray-600 mb-2">Berapa Jumlah</p>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-bold text-red-600 select-none" id="captcha-question">
                                    {{ $num1 ?? session('captcha_num1', rand(1,9)) }} + {{ $num2 ?? session('captcha_num2', rand(1,9)) }}
                                </span>
                                <span class="text-sm text-gray-500">=</span>
                                <input id="captcha" name="captcha" type="number" required
                                    class="flex-1 rounded border border-gray-300 py-1 px-2 text-xs text-gray-900 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Jawaban Anda">
                                <button type="button" onclick="refreshCaptcha()" class="text-gray-400 hover:text-blue-600" title="Ganti soal">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('captcha')" class="mt-1 text-xs" />
                        </div>

                        <script>
                            function refreshCaptcha() {
                                fetch('{{ route("captcha.refresh") }}')
                                    .then(response => response.json())
                                    .then(data => {
                                        document.getElementById('captcha-question').textContent = data.num1 + ' + ' + data.num2;
                                        document.getElementById('captcha').value = '';
                                    });
                            }
                        </script>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-700">Ingat Saya</label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm leading-6">
                                    <a href="{{ route('password.request') }}" class="font-semibold text-blue-600 hover:text-blue-500">Lupa password?</a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-md bg-blue-700 px-3 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">
                                Masuk ke Sistem
                            </button>
                        </div>
                    </form>
                    
                    <!-- Register Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">Daftar di sini</a>
                        </p>
                    </div>
                    
                    <div class="mt-8 text-center text-xs text-gray-400">
                        &copy; {{ date('Y') }} DISKOMINFO Kota Pekanbaru.
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Decorative Image -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <!-- Background Image with Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-800">
                <!-- Pattern Overlay -->
                <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <!-- Floating Content on Image -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-12 text-center pointer-events-none">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/10 shadow-2xl max-w-lg">
                    <h3 class="text-2xl font-bold mb-4">Sistem Manajemen Data Aplikasi</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">
                        Platform untuk pengelolaan aset digital dan inventarisasi aplikasi di lingkungan Pemerintah Kota Pekanbaru. Mendukung tata kelola SPBE yang lebih baik.
                    </p>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');
            const html = document.documentElement;

            function updateIcons() {
                if (html.classList.contains('dark')) {
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                } else {
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            }

            updateIcons();

            themeToggle.addEventListener('click', function() {
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateIcons();
            });
        });
    </script>
    </div>
</body>
</html>
