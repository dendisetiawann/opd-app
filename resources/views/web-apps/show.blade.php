<x-app-layout>
    <x-slot name="header">
        Detail Aplikasi
    </x-slot>

    <!-- Custom Style for Blob Animation -->
    <style>
        .animate-blob { animation: blob 10s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>

    <!-- Success Notification Toast -->
    @if(session('success'))
    <div id="success-toast" class="fixed top-6 right-6 z-50 flex items-center gap-3 px-5 py-4 bg-white dark:bg-zinc-900 border border-emerald-200 dark:border-emerald-800/40 rounded-xl shadow-lg shadow-emerald-500/10 animate-slide-in-right">
        <div class="flex-shrink-0 w-9 h-9 bg-emerald-100 dark:bg-emerald-900/40 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-check w-5 h-5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
        </div>
        <div>
            <p class="text-sm font-bold text-slate-800 dark:text-white">Berhasil!</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">{{ session('success') }}</p>
        </div>
        <button onclick="document.getElementById('success-toast').remove()" class="ml-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition">
            <i class="fa-solid fa-xmark w-4 h-4 flex items-center justify-center"></i>
        </button>
    </div>
    <style>
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(80px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeOut {
            from { opacity: 1; transform: translateX(0); }
            to { opacity: 0; transform: translateX(80px); }
        }
        .animate-slide-in-right { animation: slideInRight 0.4s ease-out forwards; }
        .animate-fade-out-right { animation: fadeOut 0.4s ease-in forwards; }
    </style>
    <script>
        setTimeout(() => {
            const toast = document.getElementById('success-toast');
            if (toast) {
                toast.classList.remove('animate-slide-in-right');
                toast.classList.add('animate-fade-out-right');
                setTimeout(() => toast.remove(), 400);
            }
        }, 4000);
    </script>
    @endif

    <!-- Main Container -->
    <div class="space-y-8 relative">
        <!-- ✨ ANIMATED DARK MODE BACKGROUND DECORATIONS ✨ -->
        <div class="fixed inset-0 z-0 pointer-events-none hidden dark:block">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-900/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-purple-900/20 rounded-full blur-[100px]" style="animation: pulse-ring 6s infinite"></div>
        </div>
        
        <div class="relative z-10">
        
        <!-- Breadcrumb & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                            <i class="fa-solid fa-house w-4 h-4 mr-2 flex items-center justify-center"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right w-3 h-3 text-gray-400 dark:text-gray-600 flex items-center justify-center"></i>
                            <a href="{{ route('web-apps.index') }}" class="ml-1 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 md:ml-2">Data Aplikasi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fa-solid fa-chevron-right w-3 h-3 text-gray-400 dark:text-gray-600 flex items-center justify-center"></i>
                            <span class="ml-1 text-sm font-medium text-gray-800 dark:text-gray-200 md:ml-2">{{ Str::limit($webApp->nama_web_app, 20) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <div class="flex items-center gap-2">
                @if(Auth::id() === $webApp->user_id)
                <a href="{{ route('web-apps.edit', $webApp) }}" class="inline-flex items-center justify-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                    <i class="fa-solid fa-pen-to-square w-4 h-4 mr-2 flex items-center justify-center"></i>
                    Edit
                </a>
                @endif
                <a href="{{ route('web-apps.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-zinc-700 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fa-solid fa-arrow-left w-4 h-4 mr-2 text-gray-500 dark:text-gray-400 flex items-center justify-center"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Hero Card (Blue-Cyan Theme - Compact) -->
        <!-- Hero Card (Blue-Cyan Theme - Compact) -->
        <div class="relative bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-sky-100/50 dark:border-sky-900/30 p-5 hover:shadow-lg transition-all duration-300 overflow-hidden group">
            <!-- Subtle Wave Background -->
            <div class="absolute inset-0 opacity-5 dark:opacity-10">
                <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
            </div>

            <div class="relative z-10">
                <!-- Top Badge (Date only) -->
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                        <i class="fa-solid fa-calendar-days w-3 h-3 mr-1 flex items-center justify-center"></i>
                        {{ $webApp->created_at->format('d M Y') }}
                    </span>
                </div>

                <!-- Main Content Grid (2x2 Compact) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- App Name -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-sky-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-sky-400 via-sky-500 to-blue-500 rounded-xl flex items-center justify-center shadow-md ring-2 ring-sky-50 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-globe w-6 h-6 text-white flex items-center justify-center"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 uppercase tracking-wider">Nama Aplikasi</p>
                            <h1 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight leading-tight truncate">{{ $webApp->nama_web_app }}</h1>
                        </div>
                    </div>

                    <!-- OPD -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-cyan-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-md ring-2 ring-cyan-50 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-building w-6 h-6 text-white flex items-center justify-center"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 uppercase tracking-wider">OPD</p>
                            <h3 class="text-base font-bold text-slate-800 dark:text-white tracking-tight truncate">{{ $webApp->opd->nama_opd }}</h3>
                        </div>
                    </div>

                    <!-- Pengelola -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-emerald-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-emerald-400 via-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-md ring-2 ring-emerald-50 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-user-group w-6 h-6 text-white flex items-center justify-center"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 uppercase tracking-wider">Dikelola Oleh</p>
                            <h3 class="text-base font-bold text-slate-800 dark:text-white tracking-tight truncate">{{ $webApp->user->name }}</h3>
                        </div>
                    </div>

                    <!-- Link Akses -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-blue-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md ring-2 ring-blue-50 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-arrow-up-right-from-square w-6 h-6 text-white flex items-center justify-center"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 dark:text-slate-500 uppercase tracking-wider">Link Akses</p>
                            @if($webApp->alamat_tautan)
                                <a href="{{ str_starts_with($webApp->alamat_tautan, 'http') ? $webApp->alamat_tautan : 'http://' . $webApp->alamat_tautan }}" target="_blank" class="text-base font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors flex items-center gap-1.5 group-hover:underline">
                                    Buka
                                    <i class="fa-solid fa-arrow-up-right-from-square w-3.5 h-3.5 flex items-center justify-center"></i>
                                </a>
                            @else
                                <span class="text-base font-medium text-slate-400 italic">-</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Content Layout -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- Main Column (Left) -->
            <div class="xl:col-span-2 space-y-8">
                
                <!-- General Information -->
                <section class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center">
                            <i class="fa-solid fa-circle-info w-5 h-5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Informasi Dasar</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Gambaran umum aplikasi</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                             <div>
                                <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Deskripsi</h3>
                                <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-xl p-5 text-gray-700 dark:text-gray-300 leading-relaxed border border-gray-100 dark:border-zinc-700/50">
                                    {{ $webApp->deskripsi_singkat ?? 'Belum ada deskripsi yang ditambahkan untuk aplikasi ini.' }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Jenis Aplikasi</h3>
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-sky-50 dark:bg-sky-900/30 text-sky-700 dark:text-sky-300 border border-sky-100 dark:border-sky-800/50">
                                            <i class="fa-solid fa-desktop w-3.5 h-3.5 mr-1.5 flex items-center justify-center"></i>
                                            {{ $webApp->jenis_aplikasi ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Alamat Tautan</h3>
                                    <div class="flex items-center text-sm font-medium text-gray-900 dark:text-white">
                                        @if($webApp->alamat_tautan)
                                            <i class="fa-solid fa-globe w-4 h-4 mr-2 text-gray-400 flex items-center justify-center"></i>
                                            <a href="{{ str_starts_with($webApp->alamat_tautan, 'http') ? $webApp->alamat_tautan : 'http://' . $webApp->alamat_tautan }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $webApp->alamat_tautan }}</a>
                                        @else
                                            <span class="text-gray-400 italic">Tidak tersedia</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">Arsitektur</h3>
                                     <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 border border-purple-100 dark:border-purple-800/50">
                                            <i class="fa-solid fa-server w-3.5 h-3.5 mr-1.5 flex items-center justify-center"></i>
                                            @if($webApp->arsitektur_sistem == 'monolith')
                                                Monolith (Satu codebase)
                                            @elseif($webApp->arsitektur_sistem == 'be-fe')
                                                Terpisah (Backend & Frontend)
                                            @else
                                                {{ $webApp->arsitektur_sistem ?? '-' }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tech Stack -->
                <section class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center">
                             <i class="fa-solid fa-code w-5 h-5 text-indigo-600 dark:text-indigo-400 flex items-center justify-center"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Stack Teknologi</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Framework dan bahasa yang digunakan</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Framework -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></span> Framework Utama
                                </h4>
                                @if($webApp->framework)
                                    <div class="flex items-center p-3 bg-gray-50 dark:bg-zinc-800/50 rounded-lg border border-gray-100 dark:border-zinc-700/50">
                                        <div class="flex-1">
                                            <div class="font-bold text-gray-900 dark:text-white">{{ $webApp->framework }}</div>
                                            @if($webApp->versi_framework)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Versi {{ $webApp->versi_framework }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">Tidak ada data</span>
                                @endif
                            </div>

                            <!-- Programming Language -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500 mr-2"></span> Bahasa Pemrograman
                                </h4>
                                @if($webApp->bahasa_pemrograman)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $webApp->bahasa_pemrograman) as $lang)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-pink-50 dark:bg-pink-900/20 text-pink-700 dark:text-pink-300 border border-pink-100 dark:border-pink-800/30">
                                                {{ trim($lang) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">Tidak ada data</span>
                                @endif
                            </div>

                           <!-- Libraries -->
                           <div class="md:col-span-2">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 mr-2"></span> Libraries / Packages
                                </h4>
                                @if($webApp->daftar_library_package)
                                    <div class="bg-slate-50 dark:bg-zinc-800/50 rounded-lg p-4 border border-slate-100 dark:border-zinc-700/50 font-mono text-sm text-slate-700 dark:text-slate-300 whitespace-pre-line leading-relaxed">
                                        {{ $webApp->daftar_library_package }}
                                    </div>
                                @else
                                    <div class="p-4 bg-gray-50 dark:bg-zinc-800/50 rounded-lg border border-gray-100 dark:border-zinc-700/50 text-center">
                                        <span class="text-gray-400 italic text-sm">Tidak ada daftar library</span>
                                    </div>
                                @endif
                           </div>
                        </div>
                    </div>
                </section>

                <!-- Integration & Security -->
                <section class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-3">
                         <div class="w-10 h-10 rounded-full bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center">
                              <i class="fa-solid fa-shield-halved w-5 h-5 text-orange-600 dark:text-orange-400 flex items-center justify-center"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Integrasi & Keamanan</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Konektivitas dan protokol backup</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-8">
                            
                            <!-- 1. Integrasi Sistem Eksternal -->
                            <div class="relative group">
                                <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 to-blue-300 rounded-l-full"></div>
                                <div class="pl-2">
                                    <div class="flex items-center mb-3">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 font-bold text-sm mr-3 shadow-sm border border-blue-200 dark:border-blue-800">1</div>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">Integrasi Sistem Eksternal</h4>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-900/10 rounded-xl p-5 text-sm text-gray-700 dark:text-gray-300 leading-relaxed border border-blue-100 dark:border-blue-800/30 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow">
                                        {{ $webApp->integrasi_sistem_keluar ?? 'Tidak ada integrasi dengan sistem luar.' }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 2. Metode Monitoring & Evaluasi -->
                            <div class="relative group">
                                <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-purple-500 to-purple-300 rounded-l-full"></div>
                                <div class="pl-2">
                                    <div class="flex items-center mb-3">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 font-bold text-sm mr-3 shadow-sm border border-purple-200 dark:border-purple-800">2</div>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-white">Metode Monitoring & Evaluasi</h4>
                                    </div>
                                    <div class="bg-purple-50/50 dark:bg-purple-900/10 rounded-xl p-5 text-sm text-gray-700 dark:text-gray-300 leading-relaxed border border-purple-100 dark:border-purple-800/30 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow">
                                        {{ $webApp->metode_monitoring_evaluasi ?? 'Tidak ada data.' }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 3, 4 & 5. Backup Section -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- 3. Backup Source Code -->
                                <div class="relative group">
                                     <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-emerald-300 rounded-l-full"></div>
                                     <div class="pl-2 h-full flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold text-sm mr-3 shadow-sm border border-emerald-200 dark:border-emerald-800">3</div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Backup Source Code</h4>
                                        </div>
                                        <div class="bg-emerald-50/50 dark:bg-emerald-900/10 rounded-xl p-4 text-sm text-gray-700 dark:text-gray-300 leading-relaxed border border-emerald-100 dark:border-emerald-800/30 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
                                            {{ $webApp->metode_backup_source_code ?? 'Tidak ada data.' }}
                                        </div>
                                     </div>
                                </div>
                                
                                <!-- 4. Backup Database -->
                                <div class="relative group">
                                    <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-teal-500 to-teal-300 rounded-l-full"></div>
                                    <div class="pl-2 h-full flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-teal-100 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 font-bold text-sm mr-3 shadow-sm border border-teal-200 dark:border-teal-800">4</div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Backup Database</h4>
                                        </div>
                                        <div class="bg-teal-50/50 dark:bg-teal-900/10 rounded-xl p-4 text-sm text-gray-700 dark:text-gray-300 leading-relaxed border border-teal-100 dark:border-teal-800/30 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
                                            {{ $webApp->metode_backup_database ?? 'Tidak ada data.' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 5. Backup Assets (File/Gambar) -->
                                <div class="relative group">
                                    <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-amber-500 to-amber-300 rounded-l-full"></div>
                                    <div class="pl-2 h-full flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 font-bold text-sm mr-3 shadow-sm border border-amber-200 dark:border-amber-800">5</div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-white">Backup Assets</h4>
                                        </div>
                                        <div class="bg-amber-50/50 dark:bg-amber-900/10 rounded-xl p-4 text-sm text-gray-700 dark:text-gray-300 leading-relaxed border border-amber-100 dark:border-amber-800/30 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
                                            {{ $webApp->metode_backup_asset ?? 'Tidak ada data.' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>

            <!-- Sidebar (Right) -->
            <div class="space-y-8">
                
                <!-- Team Card -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-5 bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fa-solid fa-users w-5 h-5 mr-2 text-gray-500 dark:text-gray-400 flex items-center justify-center"></i>
                            Tim Pengembang
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                         <div>
                            <span class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">Data Tim Pengembang</span>
                            <div class="flex items-start gap-3">
                                <div class="bg-blue-100 dark:bg-blue-900/50 p-2 rounded-lg text-blue-600 dark:text-blue-400">
                                    <i class="fa-solid fa-code w-5 h-5 flex items-center justify-center"></i>
                                </div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-200 pt-1 whitespace-pre-line">
                                    {{ $webApp->data_tim_programmer ?? 'Internal Diskominfo' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 dark:border-zinc-800 pt-4 space-y-3">
                            <span class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">Kontak Narahubung</span>
                            
                            <!-- Email -->
                            @if($webApp->email_narahubung)
                                <a href="mailto:{{ $webApp->email_narahubung }}" class="flex items-center p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                                    <i class="fa-regular fa-envelope w-4 h-4 mr-2 flex items-center justify-center"></i>
                                    <span class="text-sm font-medium truncate">{{ $webApp->email_narahubung }}</span>
                                </a>
                            @else
                                <span class="text-sm text-gray-400 italic">Tidak ada email kontak</span>
                            @endif
                            
                            <!-- WhatsApp -->
                            @if($webApp->whatsapp_narahubung)
                                @php
                                    $waNumber = preg_replace('/[^0-9]/', '', $webApp->whatsapp_narahubung);
                                    $waNumber = ltrim($waNumber, '0');
                                    $waNumber = '62' . $waNumber;
                                @endphp
                                <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="flex items-center p-3 rounded-lg bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 hover:bg-green-100 dark:hover:bg-green-900/40 transition-colors">
                                    <i class="fa-brands fa-whatsapp w-4 h-4 mr-2 flex items-center justify-center"></i>
                                    <span class="text-sm font-medium">{{ $webApp->whatsapp_narahubung }}</span>
                                    <span class="ml-auto text-[10px] bg-green-200 dark:bg-green-800 px-1.5 py-0.5 rounded">Klik untuk chat</span>
                                </a>
                            @else
                                <span class="text-sm text-gray-400 italic">Tidak ada nomor WhatsApp</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Repository -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-5 bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center">
                            <i class="fa-solid fa-folder-open w-5 h-5 mr-2 text-gray-500 dark:text-gray-400 flex items-center justify-center"></i>
                            Repository
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Has Repository -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Memiliki Repository</span>
                            @if($webApp->has_repository == 'ya')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border border-green-100 dark:border-green-800/30">
                                    <i class="fa-solid fa-check w-3 h-3 mr-1 flex items-center justify-center"></i>
                                    Ya
                                </span>
                            @elseif($webApp->has_repository == 'tidak')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-100 dark:bg-zinc-800 text-gray-600 dark:text-zinc-400 border border-gray-200 dark:border-zinc-700">
                                    <i class="fa-solid fa-xmark w-3 h-3 mr-1 flex items-center justify-center"></i>
                                    Tidak
                                </span>
                            @else
                                <span class="text-sm text-gray-400">-</span>
                            @endif
                        </div>

                        <!-- Access Type (Only show if has_repository = ya) -->
                        @if($webApp->has_repository == 'ya' && $webApp->git_repository)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Akses Repository</span>
                            @if($webApp->git_repository == 'private')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-100 dark:border-red-800/30">
                                    <i class="fa-solid fa-lock w-3 h-3 mr-1 flex items-center justify-center"></i>
                                    Private
                                </span>
                            @elseif($webApp->git_repository == 'public')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 border border-green-100 dark:border-green-800/30">
                                    <i class="fa-solid fa-globe w-3 h-3 mr-1 flex items-center justify-center"></i>
                                    Public
                                </span>
                            @endif
                        </div>
                        @endif

                        <!-- Penyedia Repository (Only show if has provider) -->
                        @if($webApp->has_repository == 'ya' && $webApp->penyedia_repository)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Penyedia</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-800/50">
                                <i class="fa-brands fa-github w-3 h-3 mr-1 flex items-center justify-center"></i>
                                {{ $webApp->penyedia_repository }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Infrastructure -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-5 bg-gray-50 dark:bg-zinc-800/50 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center">
                             <i class="fa-solid fa-database w-5 h-5 mr-2 text-gray-500 dark:text-gray-400 flex items-center justify-center"></i>
                            Database & Server
                        </h3>
                    </div>
                    <div class="px-6 py-2">
                        <div class="divide-y divide-gray-100 dark:divide-zinc-800">
                            <!-- DBMS -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-gray-400">DBMS</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $webApp->dbms ?? '-' }}</span>
                            </div>
                            <!-- Versi DBMS -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Versi DBMS</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $webApp->versi_dbms ?? '-' }}</span>
                            </div>
                            <!-- Location -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Lokasi Server DBMS</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $webApp->lokasi_database == 'Server Kominfo' ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300' : 'bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300' }}">
                                    {{ $webApp->lokasi_database == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : ($webApp->lokasi_database ?? '-') }}
                                </span>
                            </div>
                             <!-- Access -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Akses</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $webApp->akses_database == 'private' ? 'bg-orange-50 dark:bg-orange-900/30 text-orange-700 dark:text-orange-300' : 'bg-teal-50 dark:bg-teal-900/30 text-teal-700 dark:text-teal-300' }}">
                                    {{ ucfirst($webApp->akses_database) ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
