<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Data Aplikasi
            </h2>
            <a href="{{ route('web-apps.index') }}" class="text-indigo-600 hover:text-indigo-900">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- OPD Info -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                <p class="text-sm text-blue-700">OPD: <strong>{{ auth()->user()->opd->nama_opd }}</strong> (tidak dapat diubah)</p>
            </div>

            <form method="POST" action="{{ route('web-apps.update', $webApp) }}">
                @csrf
                @method('PUT')

                <!-- Section 1: Informasi Umum -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-indigo-200">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded text-sm mr-2">1</span>
                            Informasi Umum
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="nama_web_app" :value="__('Nama Aplikasi / Website *')" />
                                <x-text-input id="nama_web_app" class="block mt-1 w-full" type="text" name="nama_web_app" :value="old('nama_web_app', $webApp->nama_web_app)" required />
                                <x-input-error :messages="$errors->get('nama_web_app')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="domain" :value="__('Alamat Website / Link Aplikasi *')" />
                                <x-text-input id="domain" class="block mt-1 w-full" type="url" name="domain" :value="old('domain', $webApp->domain)" placeholder="https://simpeg.pekanbaru.go.id" />
                                <p class="mt-1 text-xs text-gray-500">Masukkan URL lengkap aplikasi (web, Play Store, App Store, dll). Contoh: https://play.google.com/store/apps/details?id=com.app</p>
                                <x-input-error :messages="$errors->get('domain')" class="mt-2" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="deskripsi_singkat" :value="__('Deskripsi Singkat')" />
                                <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi_singkat', $webApp->deskripsi_singkat) }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_singkat')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Tim & Kontak -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-indigo-200">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded text-sm mr-2">2</span>
                            Tim & Kontak
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="data_tim_programmer" :value="__('Data Tim Programmer')" />
                                <textarea id="data_tim_programmer" name="data_tim_programmer" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('data_tim_programmer', $webApp->data_tim_programmer) }}</textarea>
                                <x-input-error :messages="$errors->get('data_tim_programmer')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email_narahubung" :value="__('Email Narahubung')" />
                                <x-text-input id="email_narahubung" class="block mt-1 w-full" type="email" name="email_narahubung" :value="old('email_narahubung', $webApp->email_narahubung)" />
                                <x-input-error :messages="$errors->get('email_narahubung')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Stack Teknologi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-indigo-200">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded text-sm mr-2">3</span>
                            Stack Teknologi
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="bahasa_pemrograman" :value="__('Bahasa Pemrograman *')" />
                                <textarea id="bahasa_pemrograman" name="bahasa_pemrograman" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh:&#10;Backend: PHP 8.2, Python 3.11&#10;Frontend: JavaScript ES6, TypeScript 5.0&#10;Mobile: Kotlin, Swift, Dart (Flutter)">{{ old('bahasa_pemrograman', $webApp->bahasa_pemrograman) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Sebutkan semua bahasa pemrograman yang digunakan beserta versinya (backend, frontend, mobile, dll)</p>
                                <x-input-error :messages="$errors->get('bahasa_pemrograman')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="arsitektur_sistem" :value="__('Arsitektur Sistem *')" />
                                <select id="arsitektur_sistem" name="arsitektur_sistem" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Pilih Arsitektur --</option>
                                    <option value="monolith" {{ old('arsitektur_sistem', $webApp->arsitektur_sistem) == 'monolith' ? 'selected' : '' }}>Monolith (Satu Aplikasi)</option>
                                    <option value="be-fe" {{ old('arsitektur_sistem', $webApp->arsitektur_sistem) == 'be-fe' ? 'selected' : '' }}>Backend-Frontend Terpisah (API + Client)</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Pilih arsitektur sesuai struktur aplikasi Anda</p>
                                <x-input-error :messages="$errors->get('arsitektur_sistem')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="framework" :value="__('Framework *')" />
                                <x-text-input id="framework" class="block mt-1 w-full" type="text" name="framework" :value="old('framework', $webApp->framework)" placeholder="Laravel, React, Vue, Flutter, dll" />
                                <p class="mt-1 text-xs text-gray-500">Framework utama yang digunakan</p>
                                <x-input-error :messages="$errors->get('framework')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="versi_framework" :value="__('Versi Framework *')" />
                                <x-text-input id="versi_framework" class="block mt-1 w-full" type="text" name="versi_framework" :value="old('versi_framework', $webApp->versi_framework)" placeholder="11.x, 18.2, 3.4, dll" />
                                <x-input-error :messages="$errors->get('versi_framework')" class="mt-2" />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="daftar_library_package" :value="__('Daftar Library / Package *')" />
                                <textarea id="daftar_library_package" name="daftar_library_package" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh:&#10;- Laravel Breeze v2.0&#10;- Tailwind CSS v3.4&#10;- Axios v1.6&#10;- Inertia.js v1.0">{{ old('daftar_library_package', $webApp->daftar_library_package) }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Sebutkan library, package, atau dependencies penting yang digunakan</p>
                                <x-input-error :messages="$errors->get('daftar_library_package')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Repository & Backup -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-indigo-200">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded text-sm mr-2">4</span>
                            Repository & Backup
                        </h3>
                        
                        <!-- Educational Note -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700 font-semibold">Penting: Keamanan Repository</p>
                                    <p class="text-sm text-yellow-600 mt-1">
                                        Untuk keamanan, <strong>sangat disarankan</strong> menggunakan repository <strong>Private</strong> di GitHub.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="git_repository" :value="__('Status Repository')" />
                                <select id="git_repository" name="git_repository" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="public" {{ old('git_repository', $webApp->git_repository) == 'public' ? 'selected' : '' }}>Public</option>
                                    <option value="private" {{ old('git_repository', $webApp->git_repository) == 'private' ? 'selected' : '' }}>Private (Rekomendasi)</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="link_github" :value="__('Link GitHub Repository')" />
                                <x-text-input id="link_github" class="block mt-1 w-full" type="url" name="link_github" :value="old('link_github', $webApp->link_github)" placeholder="https://github.com/username/repo" />
                                <p class="text-xs text-gray-500 mt-1">Masukkan URL lengkap repository GitHub Anda.</p>
                            </div>
                            <div>
                                <x-input-label for="metode_backup_source_code" :value="__('Metode Backup Source Code')" />
                                <textarea id="metode_backup_source_code" name="metode_backup_source_code" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('metode_backup_source_code', $webApp->metode_backup_source_code) }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="metode_backup_asset" :value="__('Metode Backup Asset')" />
                                <textarea id="metode_backup_asset" name="metode_backup_asset" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('metode_backup_asset', $webApp->metode_backup_asset) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Database -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-indigo-200">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded text-sm mr-2">5</span>
                            Database
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="nama_database" :value="__('Nama Database')" />
                                <x-text-input id="nama_database" class="block mt-1 w-full" type="text" name="nama_database" :value="old('nama_database', $webApp->nama_database)" />
                            </div>
                            <div>
                                <x-input-label for="versi_database" :value="__('Versi Database')" />
                                <x-text-input id="versi_database" class="block mt-1 w-full" type="text" name="versi_database" :value="old('versi_database', $webApp->versi_database)" />
                            </div>
                            <div>
                                <x-input-label for="dbms" :value="__('DBMS')" />
                                <x-text-input id="dbms" class="block mt-1 w-full" type="text" name="dbms" :value="old('dbms', $webApp->dbms)" />
                            </div>
                            <div>
                                <x-input-label for="versi_dbms" :value="__('Versi DBMS')" />
                                <x-text-input id="versi_dbms" class="block mt-1 w-full" type="text" name="versi_dbms" :value="old('versi_dbms', $webApp->versi_dbms)" />
                            </div>
                            <div>
                                <x-input-label for="lokasi_database" :value="__('Lokasi Database')" />
                                <select id="lokasi_database" name="lokasi_database" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="local" {{ old('lokasi_database', $webApp->lokasi_database) == 'local' ? 'selected' : '' }}>Local</option>
                                    <option value="server" {{ old('lokasi_database', $webApp->lokasi_database) == 'server' ? 'selected' : '' }}>Server</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="akses_database" :value="__('Akses Database')" />
                                <select id="akses_database" name="akses_database" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="public" {{ old('akses_database', $webApp->akses_database) == 'public' ? 'selected' : '' }}>Public</option>
                                    <option value="private" {{ old('akses_database', $webApp->akses_database) == 'private' ? 'selected' : '' }}>Private</option>
                                </select>
                            </div>
                            <div class="md:col-span-3">
                                <x-input-label for="metode_backup_database" :value="__('Metode Backup Database')" />
                                <textarea id="metode_backup_database" name="metode_backup_database" rows="2" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('metode_backup_database', $webApp->metode_backup_database) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 6: Integrasi & Monev -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-indigo-200">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded text-sm mr-2">6</span>
                            Integrasi & Monitoring
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="integrasi_sistem_keluar" :value="__('Integrasi Sistem Keluar')" />
                                <textarea id="integrasi_sistem_keluar" name="integrasi_sistem_keluar" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('integrasi_sistem_keluar', $webApp->integrasi_sistem_keluar) }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="metode_monitoring_evaluasi" :value="__('Metode Monitoring & Evaluasi')" />
                                <textarea id="metode_monitoring_evaluasi" name="metode_monitoring_evaluasi" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('metode_monitoring_evaluasi', $webApp->metode_monitoring_evaluasi) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <a href="{{ route('web-apps.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 mr-3">Batal</a>
                    <x-primary-button>Simpan Perubahan</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
