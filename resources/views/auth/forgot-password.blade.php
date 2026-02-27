<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Lupa Password - {{ config('app.name', 'SIDATA PKU') }}</title>
        <link rel="icon" href="{{ asset(App\Models\SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; transition: background-color 0.4s ease, color 0.4s ease; }
        
        /* Dark Mode Styles - Premium Dark Theme */
        .dark body { background-color: #0a0f1a; color: #e2e8f0; }
        .dark .bg-white\/80 { background-color: rgba(30, 41, 59, 0.8); }
        
        /* Text Colors */
        .dark .text-gray-900 { color: #f8fafc; }
        .dark .text-slate-800 { color: #f8fafc; }
        .dark .text-slate-500 { color: #94a3b8; }
        .dark .text-gray-600 { color: #94a3b8; }
        
        /* Form elements */
        .dark input[type="email"] {
            background-color: #0f172a;
            border-color: #334155;
            color: #f1f5f9;
        }
        .dark input::placeholder { color: #64748b; }
        .dark input:focus { border-color: #60a5fa; ring-color: #60a5fa; }
        
        /* Info Box */
        .dark .bg-blue-50 { background-color: rgba(30, 58, 138, 0.3); border-color: #1e40af; }
        .dark .text-blue-700 { color: #60a5fa; }
        
        /* Gradient Background */
        .dark .bg-gradient-to-br.from-slate-50 { 
            background-image: linear-gradient(to bottom right, #020617, #0f172a, #1e1b4b); 
        }
        
        /* Toggle Button */
        .theme-toggle { transition: all 0.3s ease; }
        .theme-toggle:hover { transform: rotate(15deg) scale(1.1); }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-950 dark:via-slate-900 dark:to-indigo-950 transition-colors duration-500 relative">
            
            <!-- Left Side - Form -->
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24 relative">
                <!-- Theme Toggle (moved to panel) -->
                <button id="themeToggle" class="absolute top-6 right-6 z-50 theme-toggle p-2 rounded-full bg-white/50 dark:bg-slate-800/50 backdrop-blur shadow-sm hover:bg-white dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 transition-all" title="Toggle Dark Mode">
                    <i class="fa-solid fa-triangle-exclamation w-6 h-6 text-amber-500 hidden flex items-center justify-center"></i>
                    <i class="fa-solid fa-pen-to-square w-6 h-6 text-blue-400 hidden flex items-center justify-center"></i>
                </button>
                <div class="mx-auto w-full max-w-md">
                    <!-- Logo & Header -->
                    <div class="text-center mb-8">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-4 mb-6">
                            <!-- Logo Shield -->
                            <div class="relative w-12 h-12 flex items-center justify-center">
                                <img src="{{ asset(App\Models\SiteSetting::get('global_logo', 'images/logo-pekanbaru.png')) }}" alt="Logo Pekanbaru" class="w-full h-full object-contain filter drop-shadow-sm">
                            </div>
            
                            <!-- Separator Line -->
                            <div class="h-10 w-[2px] bg-slate-300 dark:bg-slate-600 rounded-full hidden sm:block"></div>
            
                            <!-- Text Content -->
                            <div class="flex flex-col justify-center text-left">
                                <div class="flex items-baseline gap-1.5 leading-none">
                                    <span class="text-2xl font-extrabold text-[#1a237e] dark:text-blue-400 tracking-tight drop-shadow-sm">{{ App\Models\SiteSetting::get('global_app_name', 'SIDATA') }}</span>
                                </div>
                                <span class="text-[0.65rem] font-bold text-slate-500 dark:text-slate-400 tracking-[0.15em] uppercase mt-0.5 leading-tight">
                                    {{ App\Models\SiteSetting::get('global_app_description', 'Sistem Informasi Data Terpadu') }}
                                </span>
                                <span class="text-[0.6rem] font-serif italic text-slate-400 dark:text-slate-500 mt-0.5">
                                    {{ App\Models\SiteSetting::get('global_org_name', 'Pemerintah Kota Pekanbaru') }}
                                </span>
                            </div>
                        </a>
                        <h2 class="text-2xl font-bold text-gray-900">Lupa Password?</h2>
                        <p class="mt-2 text-sm text-gray-600">Masukkan email Anda untuk menerima link reset password</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Form Card -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/50 dark:border-slate-700/50 transition-colors duration-300">
                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                            @csrf

                            <!-- Info Text -->
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-info w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0"></i>
                                    <p class="text-sm text-blue-700">
                                        Kami akan mengirimkan link ke email Anda untuk mengatur ulang password. Pastikan email yang dimasukkan sesuai dengan akun yang terdaftar.
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-regular fa-envelope w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                        Alamat Email
                                    </span>
                                </label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" required autofocus
                                        class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        value="{{ old('email') }}"
                                        placeholder="contoh@email.com">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit" class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:from-blue-700 hover:to-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">
                                    <i class="fa-regular fa-envelope w-5 h-5 flex items-center justify-center"></i>
                                    Kirim Link Reset Password
                                </button>
                            </div>
                        </form>
                        
                        <!-- Back to Login Link -->
                        <div class="mt-6 text-center">
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-500 font-medium transition-colors">
                                <i class="fa-solid fa-arrow-left w-4 h-4 flex items-center justify-center"></i>
                                Kembali ke halaman Login
                            </a>
                        </div>
                        
                        <div class="mt-8 text-center text-xs text-gray-400">
                            &copy; {{ date('Y') }} DISKOMINFO Kota Pekanbaru.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Decorative (Hidden on mobile) -->
            <div class="hidden lg:flex lg:flex-1 bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-800 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <i class="fa-solid fa-circle-check w-full h-full flex items-center justify-center"></i>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col items-center justify-center w-full p-12 text-center">
                    <!-- Lock Icon -->
                    <div class="w-32 h-32 bg-white/10 rounded-3xl flex items-center justify-center mb-8 backdrop-blur-sm border border-white/20">
                        <i class="fa-solid fa-key w-16 h-16 text-white flex items-center justify-center"></i>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-white mb-4">Reset Password Aman</h3>
                    <p class="text-blue-100 text-lg max-w-md mb-8">
                        Kami akan mengirimkan link aman ke email Anda untuk mengatur ulang password
                    </p>
                    
                    <!-- Steps -->
                    <div class="space-y-4 text-left max-w-sm">
                        <div class="flex items-center gap-4 text-white/90">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold">1</div>
                            <span>Masukkan email terdaftar</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold">2</div>
                            <span>Cek inbox email Anda</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold">3</div>
                            <span>Klik link reset password</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold">4</div>
                            <span>Buat password baru</span>
                        </div>
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
