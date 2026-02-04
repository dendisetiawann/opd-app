<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistem Manajemen Data Aplikasi OPD Kota Pekanbaru">
        <title>Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .hero-bg {
                background-color: #f8fafc;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.1) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(37, 99, 235, 0.1) 0px, transparent 50%);
            }
        </style>
    </head>
    <body class="antialiased bg-gray-50 text-gray-800">
        
        <!-- Header / Navigation -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Brand -->
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-diskominfo.png') }}" alt="Logo DISKOMINFO Pekanbaru" class="h-12 w-auto">
                        <div class="hidden md:block">
                            <h1 class="text-sm font-bold text-gray-900 leading-tight">DISKOMINFO</h1>
                            <p class="text-xs text-gray-500 font-medium tracking-wide">KOTA PEKANBARU</p>
                        </div>
                    </div>

                    <!-- Auth Actions -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                                    Dashboard &rarr;
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600 transition">
                                    Login
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 transition-all">
                                        Registrasi
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="hero-bg py-20 lg:py-28">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col items-center text-center">
                        <!-- Text Content -->
                        <div class="max-w-4xl mx-auto">
                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-800 text-xs font-semibold mb-6">
                                <span class="w-2 h-2 rounded-full bg-blue-600 mr-2 animate-pulse"></span>
                                Portal Resmi Pendataan Aplikasi
                            </div>
                            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight leading-[1.15] mb-6">
                                Sistem Manajemen <span class="text-blue-700">Data Aplikasi</span> Pemerintahan.
                            </h1>
                            <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-2xl mx-auto">
                                Platform terpadu untuk inventarisasi, pengelolaan, dan standarisasi data aplikasi di seluruh Organisasi Perangkat Daerah (OPD) Kota Pekanbaru. Mewujudkan tata kelola SPBE yang terintegrasi dan akuntabel.
                            </p>
                            
                            <div class="flex items-center justify-center gap-6 text-sm text-gray-500 font-medium">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Terintegrasi
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Real-time
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Aman
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Info Section -->
            <section class="py-20 bg-white border-t border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Informasi Sistem</h2>
                        <p class="text-gray-600">
                            Sistem ini berfungsi sebagai pusat kendali data (Control Center) untuk monitoring perkembangan digitalisasi pemerintahan di lingkungan Kota Pekanbaru.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Card 1 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Inventarisasi Aset Digital</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Pendataan lengkap seluruh aplikasi, meliputi aspek teknis, stack teknologi, basis data, hingga status keamanan informasi.
                            </p>
                        </div>

                        <!-- Card 2 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Standarisasi & Kepatuhan</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Memastikan pengembangan aplikasi sesuai dengan standar arsitektur SPBE dan interoperabilitas data pemerintah daerah.
                            </p>
                        </div>

                        <!-- Card 3 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Monitoring Eksekutif</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Dashboard eksekutif untuk pimpinan daerah memantau kinerja dan efektivitas implementasi teknologi di setiap perangkat daerah.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 border-t border-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="mb-6">
                            <h3 class="font-bold text-xl text-white tracking-tight">DISKOMINFO</h3>
                            <p class="text-sm text-blue-500 font-semibold tracking-wide mt-1">KOTA PEKANBARU</p>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                            Dinas Komunikasi, Informatika, Statistik dan Persandian Kota Pekanbaru.
                            Bencah Lesung, Kec. Tenayan Raya, Kota Pekanbaru, Riau.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4 text-gray-200">Kontak Kami</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                (0761) 123456
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                diskominfo@pekanbaru.go.id
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4 text-gray-200">Pranala Luar</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-blue-400 transition">Portal Pekanbaru</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">PPID Kota Pekanbaru</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Layanan Pengaduan</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500 text-center md:text-left">
                        &copy; {{ date('Y') }} Pemerintah Kota Pekanbaru. All rights reserved.
                    </p>
                    <div class="text-xs text-gray-600">
                        Versi 1.0.0
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>
