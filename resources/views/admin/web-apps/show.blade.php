<x-app-layout>

    <!-- Main Container -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Back Button -->
            <div>
                <a href="{{ route('admin.web-apps.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <!-- Header Info -->
            <div class="relative bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-48 h-48 bg-blue-500 rounded-full opacity-10 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-cyan-500 rounded-full opacity-10 blur-2xl"></div>
                
                <div class="relative p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        <div>
                            <div class="inline-flex items-center space-x-2 bg-blue-500/20 px-3 py-1 rounded-full text-xs font-semibold text-blue-300 mb-3 border border-blue-500/30">
                                <span>Detail Aplikasi</span>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-white">{{ $webApp->nama_web_app }}</h3>
                            <div class="mt-3 flex flex-wrap items-center gap-4 text-sm">
                                <span class="inline-flex items-center text-green-300">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    {{ $webApp->opd->nama_opd }}
                                </span>
                                <span class="inline-flex items-center text-gray-400">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $webApp->user->name }}
                                </span>
                                <span class="inline-flex items-center text-gray-400">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $webApp->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>
                        @if($webApp->framework)
                            <div class="flex-shrink-0">
                                <span class="px-4 py-2 bg-white/10 text-white rounded-lg text-sm font-semibold backdrop-blur-sm">
                                    {{ $webApp->framework }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Umum -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h4 class="text-lg font-bold text-gray-900">Informasi Umum</h4>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Aplikasi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $webApp->nama_web_app }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Domain</dt>
                                    <dd class="mt-1 text-sm">
                                        @if($webApp->domain)
                                            <a href="{{ str_starts_with($webApp->domain, 'http') ? $webApp->domain : 'http://' . $webApp->domain }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                {{ $webApp->domain }}
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Deskripsi Singkat</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $webApp->deskripsi_singkat ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Teknologi -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h4 class="text-lg font-bold text-gray-900">Teknologi</h4>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Backend</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $webApp->bahasa_backend ?? '-' }} {{ $webApp->versi_backend ? '('.$webApp->versi_backend.')' : '' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Frontend</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $webApp->bahasa_frontend ?? '-' }} {{ $webApp->versi_frontend ? '('.$webApp->versi_frontend.')' : '' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Arsitektur</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $webApp->arsitektur_sistem ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Framework</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $webApp->framework ?? '-' }} {{ $webApp->versi_framework ? '('.$webApp->versi_framework.')' : '' }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Library / Package</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->daftar_library_package ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Repository & Backup -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h4 class="text-lg font-bold text-gray-900">Repository & Backup</h4>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status Repository</dt>
                                    <dd class="mt-1">
                                        @if($webApp->git_repository == 'private')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                                Private
                                            </span>
                                        @elseif($webApp->git_repository == 'public')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Public
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Link GitHub</dt>
                                    <dd class="mt-1 text-sm">
                                        @if($webApp->link_github)
                                            <a href="{{ $webApp->link_github }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                                Lihat Repository
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Metode Backup Source</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_backup_source_code ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Metode Backup Asset</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_backup_asset ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Integrasi & Monev -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h4 class="text-lg font-bold text-gray-900">Integrasi & Monitoring</h4>
                        </div>
                        <div class="p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Integrasi Sistem Keluar</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->integrasi_sistem_keluar ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Metode Monitoring & Evaluasi</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_monitoring_evaluasi ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Tim & Kontak -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h4 class="text-lg font-bold text-gray-900">Tim & Kontak</h4>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tim Programmer</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->data_tim_programmer ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email Narahubung</dt>
                                <dd class="mt-1 text-sm">
                                    @if($webApp->email_narahubung)
                                        <a href="mailto:{{ $webApp->email_narahubung }}" class="text-blue-600 hover:underline">{{ $webApp->email_narahubung }}</a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </dd>
                            </div>
                        </div>
                    </div>

                    <!-- Database -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h4 class="text-lg font-bold text-gray-900">Database</h4>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Database</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $webApp->nama_database ?? '-' }} {{ $webApp->versi_database ? '('.$webApp->versi_database.')' : '' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">DBMS</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $webApp->dbms ?? '-' }} {{ $webApp->versi_dbms ? '('.$webApp->versi_dbms.')' : '' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Lokasi</dt>
                                <dd class="mt-1">
                                    @if($webApp->lokasi_database)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $webApp->lokasi_database == 'server' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($webApp->lokasi_database) }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Akses</dt>
                                <dd class="mt-1">
                                    @if($webApp->akses_database)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $webApp->akses_database == 'private' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($webApp->akses_database) }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Metode Backup</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_backup_database ?? '-' }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
