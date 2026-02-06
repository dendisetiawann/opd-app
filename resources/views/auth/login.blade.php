<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Manajemen Data Aplikasi OPD</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div class="flex min-h-full">
        <!-- Left Side: Login Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white z-10 relative">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo-icon.png') }}" alt="Logo DISKOMINFO Pekanbaru" class="h-10 w-auto">
                        <div>
                            <h1 class="text-2xl font-bold text-[#1a237e] leading-none tracking-tight">DISKOMINFO</h1>
                            <p class="text-[10px] text-black font-semibold tracking-[0.1em] mt-0.5">KOTA PEKANBARU</p>
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

                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                    value="{{ old('email') }}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-2">
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

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
                        Platform terintegrasi untuk pengelolaan aset digital dan inventarisasi aplikasi di lingkungan Pemerintah Kota Pekanbaru. Mendukung tata kelola SPBE yang lebih baik.
                    </p>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
