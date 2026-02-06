<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Detail Aplikasi
                </h2>
                <p class="text-sm text-slate-500 mt-1">Informasi lengkap tentang aplikasi yang terdaftar.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('web-apps.edit', $webApp) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 rounded-lg font-semibold text-sm text-white transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </a>
                <a href="{{ route('web-apps.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-slate-600 text-sm font-bold rounded-lg border border-slate-200 shadow-sm hover:bg-slate-50 hover:text-slate-900 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl" role="alert">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Hero Header (Super Luxurious) -->
            <div class="relative rounded-2xl p-1 overflow-hidden shadow-2xl">
                <!-- Rich Animated Gradient Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-[#1a237e] to-slate-900"></div>
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-soft-light"></div>
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 rounded-full bg-indigo-500 opacity-30 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 rounded-full bg-blue-600 opacity-20 blur-3xl"></div>
                
                <!-- Glass Content Container -->
                <div class="relative bg-slate-900/40 backdrop-blur-xl rounded-xl p-8 border border-white/10 overflow-hidden">
                     <!-- Glossy Reflection -->
                    <div class="absolute inset-0 bg-gradient-to-b from-white/5 to-transparent pointer-events-none"></div>

                    <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div class="space-y-6 flex-1">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="h-px w-8 bg-amber-500/50"></div>
                                    <p class="text-xs font-bold text-amber-400 uppercase tracking-[0.2em] shadow-sm">Nama Aplikasi</p>
                                </div>
                                <h3 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-100 to-blue-200 tracking-tight leading-tight filter drop-shadow-lg">
                                    {{ $webApp->nama_web_app }}
                                </h3>
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <div class="p-3 rounded-xl bg-white/5 border border-white/10 backdrop-blur-md shadow-inner">
                                    <p class="text-[10px] font-bold text-blue-300 uppercase tracking-wider mb-1">OPD</p>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"></path></svg>
                                        <span class="text-sm font-semibold text-white tracking-wide">
                                            {{ $webApp->opd->nama_opd }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="hidden md:block h-12 w-px bg-white/10"></div>

                                <div class="flex items-center gap-2">
                                     <div class="p-2 rounded-lg bg-blue-500/20 text-blue-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                     </div>
                                     <div>
                                        <p class="text-[10px] text-blue-300 font-medium uppercase tracking-wide">Terdaftar Sejak</p>
                                        <p class="text-sm text-white font-mono font-medium">{{ $webApp->created_at->format('d M Y, H:i') }}</p>
                                     </div>
                                </div>
                            </div>
                        </div>

                        @if($webApp->domain)
                        <div class="flex-shrink-0 z-10">
                            <a href="{{ str_starts_with($webApp->domain, 'http') ? $webApp->domain : 'https://' . $webApp->domain }}" target="_blank" class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-slate-900 text-sm font-bold rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-[0_0_40px_-10px_rgba(255,255,255,0.3)]">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <span class="relative">Kunjungi Aplikasi</span>
                                <svg class="relative w-4 h-4 text-indigo-600 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="xl:col-span-2 space-y-8">
                    
                    <!-- Informasi Umum -->
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
                        <div class="p-6 space-y-6">
                            <div>
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                                <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed border border-gray-100">
                                    {{ $webApp->deskripsi_singkat ?? '-' }}
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">URL / Tautan Aplikasi</h3>
                                    <div class="flex items-center">
                                        @if($webApp->domain)
                                            <a href="{{ str_starts_with($webApp->domain, 'http') ? $webApp->domain : 'https://' . $webApp->domain }}" target="_blank" class="text-blue-600 hover:underline font-medium flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                                                {{ $webApp->domain }}
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic">Tidak tersedia</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Stack Teknologi -->
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
                                
                                <div class="md:col-span-2">
                                    <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500 mr-2"></span> Arsitektur Sistem
                                    </h4>
                                    <div class="flex items-center gap-2">
                                        @if($webApp->arsitektur_sistem)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-50 text-purple-700 border border-purple-100">
                                                {{ $webApp->arsitektur_sistem == 'be-fe' ? 'Terpisah (Backend & Frontend)' : ucfirst($webApp->arsitektur_sistem) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada data</span>
                                        @endif
                                    </div>
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
                    
                    <!-- Integrasi & Monev (Digabung) -->
                    <section class="bg-white rounded-2xl shadow-sm border border-gray-200">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Integrasi & Monitoring</h2>
                                <p class="text-xs text-gray-500">Konektivitas sistem dan metode pemantauan</p>
                            </div>
                        </div>
                        <div class="p-6 grid grid-cols-1 gap-6">
                            <!-- Integrasi Eksternal -->
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 mb-2">Integrasi Eksternal</h4>
                                <div class="bg-blue-50/50 rounded-xl p-4 text-sm text-gray-700 border border-blue-100 whitespace-pre-line">
                                    {{ $webApp->integrasi_sistem_keluar ?? 'Tidak ada integrasi.' }}
                                </div>
                            </div>
                            <!-- Metode Monitoring -->
                             <div>
                                <h4 class="text-sm font-semibold text-gray-900 mb-2">Metode Monitoring</h4>
                                <div class="bg-orange-50/50 rounded-xl p-4 text-sm text-gray-700 border border-orange-100 whitespace-pre-line">
                                    {{ $webApp->metode_monitoring_evaluasi ?? 'Tidak ada data monitoring.' }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Tim Pengembang -->
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
                                    <span class="text-sm text-gray-400 italic">Tidak ada kontak</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Repository -->
                     <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-5 bg-gray-50 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Repository (Source Code)
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            @if($webApp->penyedia_repository)
                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase">Platform</h4>
                                    <p class="text-sm font-medium text-gray-900">{{ $webApp->penyedia_repository }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase">Visibilitas</h4>
                                    <div class="mt-1">
                                        @if($webApp->git_repository == 'private')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Private</span>
                                        @elseif($webApp->git_repository == 'public')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Public</span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="border-t border-gray-100 pt-3">
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Backup Source Code</h4>
                                    <div class="text-sm text-gray-700 bg-gray-50 p-2 rounded border border-gray-100">
                                         {{ $webApp->metode_backup_source_code ?? '-' }}
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Backup Assets</h4>
                                    <div class="text-sm text-gray-700 bg-gray-50 p-2 rounded border border-gray-100">
                                         {{ $webApp->metode_backup_asset ?? '-' }}
                                    </div>
                                </div>

                            @else
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-400 italic">Tidak Memiliki Repository</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Database -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-5 bg-gray-50 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                                Database
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                             <!-- Jenis DBMS & Versi -->
                            <div class="flex items-center justify-between border-b border-gray-50 pb-2">
                                <div>
                                     <span class="text-xs font-semibold text-gray-500 uppercase block">Jenis DBMS</span>
                                     <span class="text-sm font-bold text-gray-900">{{ $webApp->dbms ?? '-' }}</span>
                                </div>
                                <div class="text-right">
                                     <span class="text-xs font-semibold text-gray-500 uppercase block">Versi</span>
                                     <span class="text-sm font-mono text-gray-900">{{ $webApp->versi_dbms ?? '-' }}</span>
                                </div>
                            </div>
                            
                             <!-- Nama DB & Versi DB -->
                             <div class="flex items-center justify-between border-b border-gray-50 pb-2">
                                <div>
                                     <span class="text-xs font-semibold text-gray-500 uppercase block">Nama Database</span>
                                     <span class="text-sm font-mono text-gray-900">{{ $webApp->nama_database ?? '-' }}</span>
                                </div>
                                <div class="text-right">
                                     <span class="text-xs font-semibold text-gray-500 uppercase block">Versi Struktur</span>
                                     <span class="text-sm font-mono text-gray-900">{{ $webApp->versi_database ?? '-' }}</span>
                                </div>
                            </div>

                             <!-- Lokasi Server -->
                             <div>
                                 <span class="text-xs font-semibold text-gray-500 uppercase block mb-1">Lokasi Server DB</span>
                                 @if($webApp->lokasi_database == 'server')
                                     <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        Dedicated Server
                                     </span>
                                 @elseif($webApp->lokasi_database == 'local')
                                     <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200">
                                        Localhost / Shared
                                     </span>
                                 @else
                                     <span class="text-sm text-gray-900">-</span>
                                 @endif
                             </div>

                             <!-- Akses Database -->
                             <div>
                                 <span class="text-xs font-semibold text-gray-500 uppercase block mb-1">Akses Database</span>
                                 @if($webApp->akses_database == 'public')
                                     <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                        Public (Terbuka)
                                     </span>
                                 @elseif($webApp->akses_database == 'private')
                                     <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                        Private (Tertutup)
                                     </span>
                                 @else
                                     <span class="text-sm text-gray-900">-</span>
                                 @endif
                             </div>

                            <!-- Strategi Backup -->
                            <div class="pt-2 border-t border-gray-100">
                                <span class="text-xs font-semibold text-gray-500 uppercase block mb-1">Strategi Backup DB</span>
                                <div class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    {{ $webApp->metode_backup_database ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
