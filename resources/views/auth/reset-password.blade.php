<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Reset Password - {{ config('app.name', 'SIMDA-OPD') }}</title>
        <link rel="icon" href="{{ asset('images/logo-icon.png') }}" type="image/png">

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
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-6">
                            <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="h-12 w-auto">
                            <div class="text-left">
                                <span class="block text-xl font-bold text-slate-800">DISKOMINFO</span>
                                <span class="block text-xs text-slate-500 uppercase tracking-wider">Kota Pekanbaru</span>
                            </div>
                        </a>
                        <h2 class="text-2xl font-bold text-gray-900">Reset Password</h2>
                        <p class="mt-2 text-sm text-gray-600">Buat password baru untuk akun Anda</p>
                    </div>

                    <!-- Form Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/50">
                        
                        <!-- IP Mismatch Warning -->
                        @if(isset($ipMismatch) && $ipMismatch)
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-red-800">⚠️ Peringatan Keamanan: IP Berbeda</h4>
                                    <p class="text-sm text-red-700 mt-1">
                                        Link reset password ini diminta dari alamat IP yang berbeda dengan perangkat saat ini.
                                    </p>
                                    <div class="mt-3 text-xs space-y-1">
                                        <p class="text-red-600"><strong>IP saat request:</strong> {{ $storedIp ?? '-' }}</p>
                                        <p class="text-red-600"><strong>IP saat ini:</strong> {{ $currentIp ?? '-' }}</p>
                                    </div>
                                    <p class="text-sm text-red-700 mt-3">
                                        Demi keamanan, Anda tidak dapat menggunakan link ini. Silakan <a href="{{ route('password.request') }}" class="font-bold underline">minta link baru</a> dari perangkat ini.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Security Error -->
                        @if($errors->has('security'))
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-bold text-red-800">Permintaan Ditolak</h4>
                                    <p class="text-sm text-red-700 mt-1">{{ $errors->first('security') }}</p>
                                    <a href="{{ route('password.request') }}" class="inline-flex items-center gap-2 mt-3 text-sm font-medium text-red-700 hover:text-red-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Minta Link Reset Baru
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
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
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        Password Baru
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input id="password" name="password" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Min. 8 karakter"
                                        @if(isset($ipMismatch) && $ipMismatch) disabled @endif>
                                    <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <svg id="eyeIcon1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        Konfirmasi Password
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Ulangi password baru"
                                        @if(isset($ipMismatch) && $ipMismatch) disabled @endif>
                                    <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <svg id="eyeIcon2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-2">
                                <button type="submit" 
                                    class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:from-blue-700 hover:to-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if(isset($ipMismatch) && $ipMismatch) disabled @endif>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                    </svg>
                                    Reset Password
                                </button>
                            </div>
                        </form>
                        
                        <!-- Back to Login Link -->
                        <div class="mt-6 text-center">
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-500 font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
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
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#grid)" />
                    </svg>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col items-center justify-center w-full p-12 text-center">
                    <!-- Shield Icon -->
                    <div class="w-32 h-32 bg-white/10 rounded-3xl flex items-center justify-center mb-8 backdrop-blur-sm border border-white/20">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-white mb-4">Keamanan Terjamin</h3>
                    <p class="text-blue-100 text-lg max-w-md mb-8">
                        Sistem kami memverifikasi identitas perangkat untuk melindungi akun Anda
                    </p>
                    
                    <!-- Security Features -->
                    <div class="space-y-4 text-left max-w-sm">
                        <div class="flex items-center gap-4 text-white/90">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Validasi alamat IP</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Token berlaku terbatas</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Enkripsi end-to-end</span>
                        </div>
                        <div class="flex items-center gap-4 text-white/90">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
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
