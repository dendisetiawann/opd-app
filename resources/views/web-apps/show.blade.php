<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Aplikasi
            </h2>
            <div class="space-x-2">
                <a href="{{ route('web-apps.edit', $webApp) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                    Edit
                </a>
                <a href="{{ route('web-apps.index') }}" class="text-indigo-600 hover:text-indigo-900">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Header Info -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold">{{ $webApp->nama_web_app }}</h3>
                    <p class="mt-2 opacity-80">{{ $webApp->opd->nama_opd }}</p>
                    <p class="text-sm opacity-60">Dibuat pada {{ $webApp->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <!-- Informasi Umum -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Umum</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Aplikasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->nama_web_app }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Domain</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->domain ?? '-' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Deskripsi Singkat</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->deskripsi_singkat ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Tim & Kontak -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Tim & Kontak</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Data Tim Programmer</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->data_tim_programmer ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email Narahubung</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->email_narahubung ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Teknologi -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Teknologi</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Bahasa Backend</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->bahasa_backend ?? '-' }} {{ $webApp->versi_backend ? '('.$webApp->versi_backend.')' : '' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Bahasa Frontend</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->bahasa_frontend ?? '-' }} {{ $webApp->versi_frontend ? '('.$webApp->versi_frontend.')' : '' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Arsitektur Sistem</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->arsitektur_sistem ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Framework</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->framework ?? '-' }} {{ $webApp->versi_framework ? '('.$webApp->versi_framework.')' : '' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Library / Package</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->daftar_library_package ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Repository & Backup -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Repository & Backup</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status Repository</dt>
                            <dd class="mt-1">
                                @if($webApp->git_repository == 'private')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                        Private
                                    </span>
                                @elseif($webApp->git_repository == 'public')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                                        Public
                                    </span>
                                @else
                                    <span class="text-sm text-gray-900">-</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Link GitHub Repository</dt>
                            <dd class="mt-1 text-sm">
                                @if($webApp->link_github)
                                    <a href="{{ $webApp->link_github }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                        {{ $webApp->link_github }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Tidak ada link</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Metode Backup Source Code</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_backup_source_code ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Metode Backup Asset</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_backup_asset ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Database -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Database</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Database</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->nama_database ?? '-' }} {{ $webApp->versi_database ? '('.$webApp->versi_database.')' : '' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">DBMS</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->dbms ?? '-' }} {{ $webApp->versi_dbms ? '('.$webApp->versi_dbms.')' : '' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->lokasi_database ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Akses</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $webApp->akses_database ?? '-' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Metode Backup</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_backup_database ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Integrasi & Monev -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Integrasi & Monitoring</h4>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Integrasi Sistem Keluar</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->integrasi_sistem_keluar ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Metode Monitoring & Evaluasi</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $webApp->metode_monitoring_evaluasi ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
