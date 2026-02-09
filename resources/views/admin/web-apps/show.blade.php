<x-admin-layout>
    <x-slot name="header">
        Detail Aplikasi
    </x-slot>

    <!-- Main Container -->
    <div class="space-y-8">
        
        <!-- Breadcrumb & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.web-apps.index') }}" class="ml-1 text-sm font-medium text-gray-500 dark:text-zinc-400 hover:text-blue-600 dark:hover:text-blue-400 md:ml-2">Data Aplikasi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-800 dark:text-zinc-200 md:ml-2">{{ Str::limit($webApp->nama_web_app, 20) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <a href="{{ route('admin.web-apps.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-zinc-700 shadow-sm text-sm font-medium rounded-lg text-gray-700 dark:text-zinc-300 bg-white dark:bg-zinc-900 hover:bg-gray-50 dark:hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Hero Card (Blue-Cyan Theme - Compact) -->
        <div class="relative bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-sky-100/50 dark:border-zinc-800 p-5 hover:shadow-lg transition-all duration-300 overflow-hidden">
            <!-- Subtle Wave Background -->
            <div class="absolute inset-0 opacity-5 dark:opacity-[0.03]">
                <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
            </div>

            <div class="relative z-10">
                <!-- Top Badge (Date only) -->
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
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
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Nama Aplikasi</p>
                            <h1 class="text-lg font-bold text-slate-800 dark:text-white tracking-tight leading-tight truncate">{{ $webApp->nama_web_app }}</h1>
                        </div>
                    </div>

                    <!-- OPD -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-cyan-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-md ring-2 ring-cyan-50 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">OPD</p>
                            <h3 class="text-base font-bold text-slate-800 dark:text-white tracking-tight truncate">{{ $webApp->opd->nama_opd }}</h3>
                        </div>
                    </div>

                    <!-- Pengelola -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-emerald-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-emerald-400 via-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-md ring-2 ring-emerald-50 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Dikelola Oleh</p>
                            <h3 class="text-base font-bold text-slate-800 dark:text-white tracking-tight truncate">{{ $webApp->user->name }}</h3>
                        </div>
                    </div>

                    <!-- Link Akses -->
                    <div class="flex items-center gap-4 group">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-blue-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md ring-2 ring-blue-50 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Link Akses</p>
                            @if($webApp->alamat_tautan)
                                <a href="{{ str_starts_with($webApp->alamat_tautan, 'http') ? $webApp->alamat_tautan : 'http://' . $webApp->alamat_tautan }}" target="_blank" class="text-base font-bold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1.5 group-hover:underline">
                                    Buka
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
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
                <section class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-200 dark:border-zinc-800">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-500/15 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Informasi Dasar</h2>
                            <p class="text-xs text-gray-500 dark:text-zinc-500">Gambaran umum aplikasi</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                             <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                                <div class="bg-gray-50 dark:bg-black/30 rounded-xl p-5 text-gray-700 dark:text-zinc-300 leading-relaxed border border-gray-100 dark:border-zinc-800">
                                    {{ $webApp->deskripsi_singkat ?? 'Belum ada deskripsi yang ditambahkan untuk aplikasi ini.' }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Tautan</h3>
                                    <div class="flex items-center text-sm font-medium text-gray-900">
                                        @if($webApp->alamat_tautan)
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                            <a href="{{ str_starts_with($webApp->alamat_tautan, 'http') ? $webApp->alamat_tautan : 'http://' . $webApp->alamat_tautan }}" target="_blank" class="text-blue-600 hover:underline">{{ $webApp->alamat_tautan }}</a>
                                        @else
                                            <span class="text-gray-400 italic">Tidak tersedia</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Arsitektur</h3>
                                     <div class="flex items-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-50 text-purple-700 border border-purple-100">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
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
                <section class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-200 dark:border-zinc-800">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 dark:bg-indigo-500/15 flex items-center justify-center">
                             <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Stack Teknologi</h2>
                            <p class="text-xs text-gray-500 dark:text-zinc-500">Framework dan bahasa yang digunakan</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Framework -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-zinc-200 mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></span> Framework Utama
                                </h4>
                                @if($webApp->framework)
                                    <div class="flex items-center p-3 bg-gray-50 dark:bg-black/30 rounded-lg border border-gray-100 dark:border-zinc-800">
                                        <div class="flex-1">
                                            <div class="font-bold text-gray-900 dark:text-zinc-200">{{ $webApp->framework }}</div>
                                            @if($webApp->versi_framework)
                                                <div class="text-xs text-gray-500">Versi {{ $webApp->versi_framework }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">Tidak ada data</span>
                                @endif
                            </div>

                            <!-- Programming Language -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-zinc-200 mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500 mr-2"></span> Bahasa Pemrograman
                                </h4>
                                @if($webApp->bahasa_pemrograman)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $webApp->bahasa_pemrograman) as $lang)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-pink-50 dark:bg-pink-500/12 text-pink-700 dark:text-pink-400 border border-pink-100 dark:border-pink-500/25">
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
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-zinc-200 mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 mr-2"></span> Libraries / Packages
                                </h4>
                                @if($webApp->daftar_library_package)
                                    <div class="bg-slate-50 dark:bg-black/30 rounded-lg p-4 border border-slate-100 dark:border-zinc-800 font-mono text-sm text-slate-700 dark:text-zinc-300 whitespace-pre-line leading-relaxed">
                                        {{ $webApp->daftar_library_package }}
                                    </div>
                                @else
                                    <div class="p-4 bg-gray-50 dark:bg-black/30 rounded-lg border border-gray-100 dark:border-zinc-800 text-center">
                                        <span class="text-gray-400 dark:text-zinc-600 italic text-sm">Tidak ada daftar library</span>
                                    </div>
                                @endif
                           </div>
                        </div>
                    </div>
                </section>

                <!-- Integration & Security -->
                <section class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-200 dark:border-zinc-800">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-zinc-800 flex items-center gap-3">
                         <div class="w-10 h-10 rounded-full bg-orange-50 dark:bg-orange-500/15 flex items-center justify-center">
                             <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Integrasi & Keamanan</h2>
                            <p class="text-xs text-gray-500 dark:text-zinc-500">Konektivitas dan protokol backup</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-8">
                            
                            <!-- 1. Integrasi Sistem Eksternal -->
                            <div class="relative group">
                                <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 to-blue-300 rounded-l-full"></div>
                                <div class="pl-2">
                                    <div class="flex items-center mb-3">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-sm mr-3 shadow-sm border border-blue-200">1</div>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-zinc-200">Integrasi Sistem Eksternal</h4>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-500/8 rounded-xl p-5 text-sm text-gray-700 dark:text-zinc-300 leading-relaxed border border-blue-100 dark:border-blue-500/20 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow">
                                        {{ $webApp->integrasi_sistem_keluar ?? 'Tidak ada integrasi dengan sistem luar.' }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 2. Metode Monitoring & Evaluasi -->
                            <div class="relative group">
                                <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-purple-500 to-purple-300 rounded-l-full"></div>
                                <div class="pl-2">
                                    <div class="flex items-center mb-3">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-100 text-purple-600 font-bold text-sm mr-3 shadow-sm border border-purple-200">2</div>
                                        <h4 class="text-base font-bold text-gray-900 dark:text-zinc-200">Metode Monitoring & Evaluasi</h4>
                                    </div>
                                    <div class="bg-purple-50/50 dark:bg-purple-500/8 rounded-xl p-5 text-sm text-gray-700 dark:text-zinc-300 leading-relaxed border border-purple-100 dark:border-purple-500/20 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow">
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
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 font-bold text-sm mr-3 shadow-sm border border-emerald-200">3</div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-zinc-200">Backup Source Code</h4>
                                        </div>
                                        <div class="bg-emerald-50/50 dark:bg-emerald-500/8 rounded-xl p-4 text-sm text-gray-700 dark:text-zinc-300 leading-relaxed border border-emerald-100 dark:border-emerald-500/20 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
                                            {{ $webApp->metode_backup_source_code ?? 'Tidak ada data.' }}
                                        </div>
                                     </div>
                                </div>
                                
                                <!-- 4. Backup Database -->
                                <div class="relative group">
                                    <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-teal-500 to-teal-300 rounded-l-full"></div>
                                    <div class="pl-2 h-full flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-teal-100 text-teal-600 font-bold text-sm mr-3 shadow-sm border border-teal-200">4</div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-zinc-200">Backup Database</h4>
                                        </div>
                                        <div class="bg-teal-50/50 dark:bg-teal-500/8 rounded-xl p-4 text-sm text-gray-700 dark:text-zinc-300 leading-relaxed border border-teal-100 dark:border-teal-500/20 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
                                            {{ $webApp->metode_backup_database ?? 'Tidak ada data.' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- 5. Backup Assets (File/Gambar) -->
                                <div class="relative group">
                                    <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-amber-500 to-amber-300 rounded-l-full"></div>
                                    <div class="pl-2 h-full flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-600 font-bold text-sm mr-3 shadow-sm border border-amber-200">5</div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-zinc-200">Backup Assets</h4>
                                        </div>
                                        <div class="bg-amber-50/50 dark:bg-amber-500/8 rounded-xl p-4 text-sm text-gray-700 dark:text-zinc-300 leading-relaxed border border-amber-100 dark:border-amber-500/20 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
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
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-5 bg-gray-50 dark:bg-black/30 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Tim Pengembang
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                         <div>
                            <span class="block text-xs font-semibold text-gray-500 dark:text-zinc-500 uppercase mb-2">Data Tim Pengembang</span>
                            <div class="flex items-start gap-3">
                                <div class="bg-blue-100 dark:bg-blue-500/15 p-2 rounded-lg text-blue-600 dark:text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900 dark:text-zinc-200 pt-1 whitespace-pre-line">
                                    {{ $webApp->data_tim_programmer ?? 'Internal Diskominfo' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 dark:border-zinc-800 pt-4">
                            <span class="block text-xs font-semibold text-gray-500 dark:text-zinc-500 uppercase mb-2">Kontak Narahubung</span>
                            @if($webApp->email_narahubung)
                                <a href="mailto:{{ $webApp->email_narahubung }}" class="flex items-center p-3 rounded-lg bg-blue-50 dark:bg-blue-500/12 text-blue-700 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-500/20 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm font-medium truncate">{{ $webApp->email_narahubung }}</span>
                                </a>
                            @else
                                <span class="text-sm text-gray-400 italic">Tidak ada email kontak</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Repository -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-5 bg-gray-50 dark:bg-black/30 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Repository
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Has Repository -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-zinc-400">Memiliki Repository</span>
                            @if($webApp->has_repository == 'ya')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Ya
                                </span>
                            @elseif($webApp->has_repository == 'tidak')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Tidak
                                </span>
                            @else
                                <span class="text-sm text-gray-400">-</span>
                            @endif
                        </div>

                        <!-- Access Type (Only show if has_repository = ya) -->
                        @if($webApp->has_repository == 'ya' && $webApp->git_repository)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-zinc-400">Akses Repository</span>
                            @if($webApp->git_repository == 'private')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-red-50 text-red-700 border border-red-100">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Private
                                </span>
                            @elseif($webApp->git_repository == 'public')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Public
                                </span>
                            @endif
                        </div>
                        @endif

                        <!-- Penyedia Repository (Only show if has provider) -->
                        @if($webApp->has_repository == 'ya' && $webApp->penyedia_repository)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-zinc-400">Penyedia</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                {{ $webApp->penyedia_repository }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Infrastructure -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-200 dark:border-zinc-800 overflow-hidden">
                    <div class="p-5 bg-gray-50 dark:bg-black/30 border-b border-gray-100 dark:border-zinc-800">
                        <h3 class="font-bold text-gray-900 dark:text-white flex items-center">
                             <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                            Database & Server
                        </h3>
                    </div>
                    <div class="px-6 py-2">
                        <div class="divide-y divide-gray-100 dark:divide-zinc-800">
                            <!-- DBMS -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-zinc-400">DBMS</span>
                                <span class="font-medium text-gray-900 dark:text-zinc-200">{{ $webApp->dbms ?? '-' }}</span>
                            </div>
                            <!-- Versi DBMS -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-zinc-400">Versi DBMS</span>
                                <span class="font-medium text-gray-900 dark:text-zinc-200">{{ $webApp->versi_dbms ?? '-' }}</span>
                            </div>
                            <!-- Nama Database -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-zinc-400">Nama Database</span>
                                <span class="font-medium text-gray-900 dark:text-zinc-200">{{ $webApp->nama_database ?? '-' }}</span>
                            </div>
                            <!-- Versi Database -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-zinc-400">Versi Database</span>
                                <span class="font-medium text-gray-900 dark:text-zinc-200">{{ $webApp->versi_database ?? '-' }}</span>
                            </div>
                            <!-- Location -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-zinc-400">Lokasi</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $webApp->lokasi_database == 'server' ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($webApp->lokasi_database) ?? '-' }}
                                </span>
                            </div>
                             <!-- Access -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500 dark:text-zinc-400">Akses</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $webApp->akses_database == 'private' ? 'bg-orange-50 text-orange-700' : 'bg-teal-50 text-teal-700' }}">
                                    {{ ucfirst($webApp->akses_database) ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
