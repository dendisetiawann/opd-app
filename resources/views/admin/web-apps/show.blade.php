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
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.web-apps.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2">Data Aplikasi</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-800 md:ml-2">{{ Str::limit($webApp->nama_web_app, 20) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <a href="{{ route('admin.web-apps.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Hero Card -->
        <div class="relative bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-700 opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            
            <div class="relative p-8 md:p-10">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm border border-white/10">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                {{ $webApp->opd->nama_opd }}
                            </span>
                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm border border-white/10">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $webApp->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 tracking-tight">{{ $webApp->nama_web_app }}</h1>
                        <div class="flex items-center text-blue-100 text-sm md:text-base">
                            <span class="opacity-80">Dikelola oleh:</span>
                            <span class="font-semibold ml-1.5">{{ $webApp->user->name }}</span>
                        </div>
                    </div>
                    
                    @if($webApp->domain)
                    <div class="flex-shrink-0">
                         <a href="{{ str_starts_with($webApp->domain, 'http') ? $webApp->domain : 'http://' . $webApp->domain }}" target="_blank" class="inline-flex items-center px-5 py-2.5 bg-white text-blue-700 rounded-xl font-semibold shadow-lg hover:bg-blue-50 transition-all transform hover:-translate-y-0.5">
                            Buka Link
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Content Layout -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- Main Column (Left) -->
            <div class="xl:col-span-2 space-y-8">
                
                <!-- General Information -->
                <section class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Informasi Dasar</h2>
                            <p class="text-xs text-gray-500">Gambaran umum aplikasi</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                             <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                                <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed border border-gray-100">
                                    {{ $webApp->deskripsi_singkat ?? 'Belum ada deskripsi yang ditambahkan untuk aplikasi ini.' }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">URL / Domain</h3>
                                    <div class="flex items-center text-sm font-medium text-gray-900">
                                        @if($webApp->domain)
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                            <a href="{{ str_starts_with($webApp->domain, 'http') ? $webApp->domain : 'http://' . $webApp->domain }}" target="_blank" class="text-blue-600 hover:underline">{{ $webApp->domain }}</a>
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
                                            {{ ucfirst($webApp->arsitektur_sistem) ?? 'Monolith' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tech Stack -->
                <section class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center">
                             <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Stack Teknologi</h2>
                            <p class="text-xs text-gray-500">Framework dan bahasa yang digunakan</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Framework -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></span> Framework Utama
                                </h4>
                                @if($webApp->framework)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                        <div class="flex-1">
                                            <div class="font-bold text-gray-900">{{ $webApp->framework }}</div>
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
                                <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500 mr-2"></span> Bahasa Pemrograman
                                </h4>
                                @if($webApp->bahasa_pemrograman)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $webApp->bahasa_pemrograman) as $lang)
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-pink-50 text-pink-700 border border-pink-100">
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
                                <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 mr-2"></span> Libraries / Packages
                                </h4>
                                @if($webApp->daftar_library_package)
                                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-100 font-mono text-sm text-slate-700 whitespace-pre-line leading-relaxed">
                                        {{ $webApp->daftar_library_package }}
                                    </div>
                                @else
                                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-center">
                                        <span class="text-gray-400 italic text-sm">Tidak ada daftar library</span>
                                    </div>
                                @endif
                           </div>
                        </div>
                    </div>
                </section>

                <!-- Integration & Security -->
                <section class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                         <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                             <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Integrasi & Keamanan</h2>
                            <p class="text-xs text-gray-500">Konektivitas dan protokol backup</p>
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
                                        <h4 class="text-base font-bold text-gray-900">Integrasi Sistem Eksternal</h4>
                                    </div>
                                    <div class="bg-blue-50/50 rounded-xl p-5 text-sm text-gray-700 leading-relaxed border border-blue-100 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow">
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
                                        <h4 class="text-base font-bold text-gray-900">Metode Monitoring & Evaluasi</h4>
                                    </div>
                                    <div class="bg-purple-50/50 rounded-xl p-5 text-sm text-gray-700 leading-relaxed border border-purple-100 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow">
                                        {{ $webApp->metode_monitoring_evaluasi ?? 'Tidak ada data.' }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 3 & 4. Backup Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- 3. Backup Source Code -->
                                <div class="relative group">
                                     <div class="absolute -left-3 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-500 to-emerald-300 rounded-l-full"></div>
                                     <div class="pl-2 h-full flex flex-col">
                                        <div class="flex items-center mb-3">
                                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 font-bold text-sm mr-3 shadow-sm border border-emerald-200">3</div>
                                            <h4 class="text-base font-bold text-gray-900">Backup Source Code</h4>
                                        </div>
                                        <div class="bg-emerald-50/50 rounded-xl p-5 text-sm text-gray-700 leading-relaxed border border-emerald-100 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
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
                                            <h4 class="text-base font-bold text-gray-900">Backup Database</h4>
                                        </div>
                                        <div class="bg-teal-50/50 rounded-xl p-5 text-sm text-gray-700 leading-relaxed border border-teal-100 whitespace-pre-line shadow-sm hover:shadow-md transition-shadow flex-grow">
                                            {{ $webApp->metode_backup_database ?? 'Tidak ada data.' }}
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
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-5 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Tim Pengembang
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">
                         <div>
                            <span class="block text-xs font-semibold text-gray-500 uppercase mb-2">Data Tim Pengembang</span>
                            <div class="flex items-start gap-3">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                </div>
                                <div class="text-sm font-medium text-gray-900 pt-1 whitespace-pre-line">
                                    {{ $webApp->data_tim_programmer ?? 'Internal Diskominfo' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-100 pt-4">
                            <span class="block text-xs font-semibold text-gray-500 uppercase mb-2">Kontak Narahubung</span>
                            @if($webApp->email_narahubung)
                                <a href="mailto:{{ $webApp->email_narahubung }}" class="flex items-center p-3 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
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
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-5 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Repository
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Has Repository -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Memiliki Repository</span>
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
                            <span class="text-sm text-gray-600">Akses Repository</span>
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
                            <span class="text-sm text-gray-600">Penyedia</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                {{ $webApp->penyedia_repository }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Infrastructure -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-5 bg-gray-50 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900 flex items-center">
                             <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                            Database & Server
                        </h3>
                    </div>
                    <div class="px-6 py-2">
                        <div class="divide-y divide-gray-100">
                            <!-- DB Type -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500">DBMS</span>
                                <span class="font-medium text-gray-900">{{ $webApp->dbms ?? '-' }}</span>
                            </div>
                             <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500">Nama DB</span>
                                <span class="font-medium text-gray-900">{{ $webApp->nama_database ?? '-' }}</span>
                            </div>
                            <!-- Location -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500">Lokasi</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $webApp->lokasi_database == 'server' ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($webApp->lokasi_database) ?? '-' }}
                                </span>
                            </div>
                             <!-- Access -->
                            <div class="py-3 flex justify-between items-center text-sm">
                                <span class="text-gray-500">Akses</span>
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
