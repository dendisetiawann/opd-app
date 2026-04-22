<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Reset Password - {{ config('app.name', 'SIDATA PKU') }}</title>
        <link rel="icon" href="{{ asset(App\Models\SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
            
            <!-- Left Side - Form -->
            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
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
                        <h2 class="text-2xl font-bold text-gray-900">Reset Password</h2>
                        <p class="mt-2 text-sm text-gray-600">Buat password baru untuk akun Anda</p>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/50">
                        
                        <!-- Expiry Info -->
                        <div class="mb-6 bg-amber-50 border border-amber-200 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-triangle-exclamation w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5"></i>
                                <p class="text-sm text-amber-800">Link ini hanya aktif selama <strong>5 menit</strong>. Jika sudah expired, silakan <a href="{{ route('password.request') }}" class="font-bold underline">minta link baru</a>.</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-regular fa-envelope w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                        Email
                                    </span>
                                </label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" required readonly
                                        class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 bg-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                                        value="{{ old('email', $request->email) }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-lock w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                        Password Baru
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input id="password" name="password" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Min. 8 karakter"
                                        >
                                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <i class="fa-solid fa-circle-check w-5 h-5 flex items-center justify-center"></i>
                                    </button>
                                </div>
                                <p class="mt-1.5 text-[11px] text-gray-500 flex items-start gap-1">
                                    <i class="fa-solid fa-circle-info mt-0.5"></i>
                                    <span>Minimal 8 karakter, wajib mengandung <strong>huruf besar</strong> dan <strong>simbol</strong> (@$!%*?&#)</span>
                                </p>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-pen-to-square w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                        Konfirmasi Password
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Ulangi password baru"
                                        >
                                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <i class="fa-solid fa-circle-check w-5 h-5 flex items-center justify-center"></i>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" 
                                    class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:from-blue-700 hover:to-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fa-solid fa-key w-5 h-5 flex items-center justify-center"></i>
                                    Reset Password
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
                            &copy; {{ date('Y') }} Dinas Komunikasi Informatika Statistik dan Persandian Kota Pekanbaru. All rights reserved.
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
                    <!-- Shield Icon -->
                    <div class="w-32 h-32 bg-white/10 rounded-3xl flex items-center justify-center mb-8 backdrop-blur-sm border border-white/20">
                        <i class="fa-solid fa-circle-check w-16 h-16 text-white flex items-center justify-center"></i>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-white mb-4">Keamanan Terjamin</h3>
                    <p class="text-blue-100 text-lg max-w-md mb-8">
                        Link reset password dilindungi dengan batas waktu untuk menjaga keamanan akun Anda
                    </p>
                    
                    <!-- Security Features -->
                    <div class="space-y-4 text-left max-w-sm">
                        <div class="flex items-center gap-4 text-white/90">
                            <i class="fa-solid fa-check w-6 h-6 text-emerald-400 flex items-center justify-center"></i>
                            <span>Link aktif selama 5 menit</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <i class="fa-solid fa-check w-6 h-6 text-emerald-400 flex items-center justify-center"></i>
                            <span>Token sekali pakai</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <i class="fa-solid fa-check w-6 h-6 text-emerald-400 flex items-center justify-center"></i>
                            <span>Enkripsi end-to-end</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <i class="fa-solid fa-check w-6 h-6 text-emerald-400 flex items-center justify-center"></i>
                            <span>Notifikasi aktivitas mencurigakan</span>
                        </div>
                    </div>
                </div>
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
    </body>
</html>
