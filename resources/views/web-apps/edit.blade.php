<x-app-layout>
    <!-- Custom Style for Blob Animation (Reuse from dashboard/index) -->
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

    <div class="relative z-10 py-8 min-h-screen bg-gray-50 dark:bg-black transition-colors duration-300 overflow-hidden">
        
        <!-- ✨ ANIMATED DARK MODE BACKGROUND DECORATIONS ✨ -->
        <div class="fixed inset-0 z-0 pointer-events-none hidden dark:block">
            <!-- Gradient Mesh -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-900/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-900/20 rounded-full blur-[100px]" style="animation: pulse-ring 6s infinite"></div>
            <!-- Floating Orbs -->
            <div class="absolute top-20 left-20 w-32 h-32 bg-cyan-900/10 rounded-full blur-2xl" style="animation: float 4s ease-in-out infinite"></div>
            <div class="absolute bottom-40 right-20 w-40 h-40 bg-violet-900/10 rounded-full blur-2xl" style="animation: float 5s ease-in-out infinite reverse"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Back Button (Top Left) -->
            <div class="mb-6">
                <a href="{{ route('web-apps.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-zinc-900 text-blue-600 dark:text-blue-400 text-sm font-bold rounded-full border border-blue-200 dark:border-blue-900/30 shadow-sm hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-700 dark:hover:text-blue-300 hover:border-blue-300 dark:hover:border-blue-800 transition-all group">
                    <svg class="w-4 h-4 text-blue-400 dark:text-blue-500 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            <!-- Header Title & OPD Badge -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 dark:text-white tracking-tight leading-none">
                        Edit Data Aplikasi
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-base mt-2 font-medium">
                        Perbarui informasi sistem informasi yang terdaftar.
                    </p>
                </div>
                
                <!-- OPD Badge (Simple) -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/30 rounded-xl px-5 py-3 shadow-sm flex-shrink-0">
                    <p class="text-[10px] font-bold text-blue-500 dark:text-blue-400 uppercase tracking-widest mb-0.5">OPD :</p>
                    <p class="text-sm font-bold text-slate-800 dark:text-white">{{ auth()->user()->opd->nama_opd }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('web-apps.update', $webApp) }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Step 1: Informasi Umum -->
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">1</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Informasi Umum</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Identitas dasar aplikasi atau website.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="nama_web_app" :value="__('Nama Aplikasi / Website *')" />
                                <x-text-input id="nama_web_app" class="block mt-1 w-full text-sm" type="text" name="nama_web_app" :value="old('nama_web_app', $webApp->nama_web_app)" required placeholder="Misal: Sistem Informasi Kepegawaian" />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Nama resmi aplikasi sesuai SK atau penggunaan umum di instansi.</p>
                                <x-input-error :messages="$errors->get('nama_web_app')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="alamat_tautan" :value="__('Alamat Tautan *')" />
                                <div class="relative mt-1">
                                    <x-text-input id="alamat_tautan" class="block w-full text-sm" type="url" name="alamat_tautan" :value="old('alamat_tautan', $webApp->alamat_tautan)" required placeholder="https://example.id atau tautan akses lainnya" />
                                </div>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Alamat lengkap akses aplikasi yang bisa dibuka publik.</p>
                                <x-input-error :messages="$errors->get('alamat_tautan')" class="mt-2" />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="deskripsi_singkat" :value="__('Deskripsi Singkat *')" />
                                <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3" class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm transition-all text-sm" required placeholder="Jelaskan fungsi utama aplikasi ini...">{{ old('deskripsi_singkat', $webApp->deskripsi_singkat) }}</textarea>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Jelaskan secara singkat tujuan dan fungsi utama dari aplikasi ini.</p>
                                <x-input-error :messages="$errors->get('deskripsi_singkat')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Tim & Kontak -->
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">2</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Tim & Kontak</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Informasi pengelola teknis dan narahubung sistem.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="data_tim_programmer" :value="__('Data Tim Pengembang *')" />
                                <textarea id="data_tim_programmer" name="data_tim_programmer" rows="3" class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm transition-all text-sm" required placeholder="Sebutkan nama programmer...">{{ old('data_tim_programmer', $webApp->data_tim_programmer) }}</textarea>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Daftar nama programmer.</p>
                                <x-input-error :messages="$errors->get('data_tim_programmer')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="email_narahubung" :value="__('Kontak Narahubung *')" />
                                <x-text-input id="email_narahubung" class="block mt-1 w-full text-sm" type="text" name="email_narahubung" :value="old('email_narahubung', $webApp->email_narahubung)" required placeholder="Email atau Nomor WhatsApp" />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Kontak person yang dapat dihubungi.</p>
                                <x-input-error :messages="$errors->get('email_narahubung')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Stack Teknologi -->
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">3</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Stack Teknologi</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Stack teknis yang digunakan aplikasi.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="bahasa_pemrograman" :value="__('Bahasa Pemrograman beserta versinya *')" />
                                <div class="bg-slate-50 dark:bg-zinc-900 border border-slate-200 dark:border-zinc-700 p-4 rounded-xl mt-1">
                                    <textarea id="bahasa_pemrograman" name="bahasa_pemrograman" rows="3" class="block w-full bg-transparent border-0 focus:ring-0 p-0 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-zinc-500" required placeholder="Contoh: PHP versi 8.2 dan TypeScript versi 5">{{ old('bahasa_pemrograman', $webApp->bahasa_pemrograman) }}</textarea>
                                </div>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Sebutkan bahasa pemrograman utama yang digunakan secara lengkap.</p>
                                <x-input-error :messages="$errors->get('bahasa_pemrograman')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="arsitektur_sistem" :value="__('Arsitektur Sistem *')" />
                                <select id="arsitektur_sistem" name="arsitektur_sistem" required class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="monolith" {{ old('arsitektur_sistem', $webApp->arsitektur_sistem) == 'monolith' ? 'selected' : '' }}>Monolith (Satu codebase)</option>
                                    <option value="be-fe" {{ old('arsitektur_sistem', $webApp->arsitektur_sistem) == 'be-fe' ? 'selected' : '' }}>Terpisah (Backend & Frontend)</option>
                                </select>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Struktur rancangan aplikasi Anda.</p>
                                <x-input-error :messages="$errors->get('arsitektur_sistem')" class="mt-2" />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="framework" :value="__('Framework Utama & Versi *')" />
                                <div class="bg-indigo-50/50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800/30 mt-1">
                                    <x-text-input id="framework" class="block w-full text-sm font-medium" type="text" name="framework" 
                                        :value="old('framework', $webApp->framework . ($webApp->versi_framework ? ' ' . $webApp->versi_framework : ''))" 
                                        required placeholder="Format: NamaFramework Versi (Contoh: Laravel 10.x, CodeIgniter 4, Vue.js 3)" />
                                    <p class="mt-2 text-xs text-indigo-600 dark:text-indigo-400 flex items-start gap-1">
                                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span><strong>Panduan Pengisian:</strong> Gabungkan nama framework dan versinya dalam satu baris.</span>
                                    </p>
                                </div>
                                <x-input-error :messages="$errors->get('framework')" class="mt-2" />
                            </div>
                            
                            <div class="md:col-span-2">
                                <x-input-label for="daftar_library_package" :value="__('Libraries / Packages *')" />
                                <textarea id="daftar_library_package" name="daftar_library_package" rows="2" class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm transition-all text-sm" required placeholder="Contoh: Spatie Permission, Guzzle, LeafletJS">{{ old('daftar_library_package', $webApp->daftar_library_package) }}</textarea>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Daftar library utama yang digunakan dalam pengembangan.</p>
                                <x-input-error :messages="$errors->get('daftar_library_package')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Repository -->
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">4</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Source Code</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Manajemen kode sumber dan backup.</p>
                            </div>
                        </div>

                         <!-- Educational Note -->
                         <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/30 rounded-xl p-4 mb-6 flex items-start gap-3">
                            <svg class="h-5 w-5 text-amber-500 dark:text-amber-400 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-xs font-bold text-amber-800 dark:text-amber-300 uppercase tracking-wide mb-1">Rekomendasi Keamanan</p>
                                <p class="text-sm text-amber-700 dark:text-amber-400">
                                    Gunakan repository <strong>Private</strong> untuk melindungi source code instansi.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Toggle Repo -->
                            @php
                                $hasRepo = old('has_repository', ($webApp->penyedia_repository || $webApp->git_repository || $webApp->link_github) ? 'ya' : 'tidak');
                            @endphp
                            <div>
                                <x-input-label :value="__('Memiliki Repository Git? *')" class="mb-2" />
                                <div class="flex items-center gap-4">
                                    <label class="group relative flex items-center gap-3 p-3 rounded-xl border border-slate-200 dark:border-zinc-700 cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                                        <input type="radio" name="has_repository" value="ya" required class="w-4 h-4 text-indigo-600 border-slate-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 focus:ring-indigo-500" {{ $hasRepo == 'ya' ? 'checked' : '' }} onchange="toggleRepositoryStatus()">
                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Ya, Ada</span>
                                    </label>
                                    <label class="group relative flex items-center gap-3 p-3 rounded-xl border border-slate-200 dark:border-zinc-700 cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all">
                                        <input type="radio" name="has_repository" value="tidak" required class="w-4 h-4 text-indigo-600 border-slate-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 focus:ring-indigo-500" {{ $hasRepo == 'tidak' ? 'checked' : '' }} onchange="toggleRepositoryStatus()">
                                        <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Tidak Ada</span>
                                    </label>
                                </div>
                                <p class="mt-2 text-xs text-slate-400 dark:text-slate-500">Apakah source code aplikasi ini disimpan dalam version control system?</p>
                                <x-input-error :messages="$errors->get('has_repository')" class="mt-2" />
                            </div>

                            <!-- Repo Details -->
                            <div id="repository_status_wrapper" class="{{ $hasRepo == 'ya' ? '' : 'hidden' }} pl-4 border-l-2 border-indigo-100 dark:border-indigo-900 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="penyedia_repository" :value="__('Platform Repository *')" />
                                        <x-text-input id="penyedia_repository" name="penyedia_repository" type="text" class="block mt-1 w-full text-sm" :value="old('penyedia_repository', $webApp->penyedia_repository)" placeholder="GitHub, GitLab, dll" />
                                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Layanan hosing repository yang digunakan.</p>
                                    </div>
                                    <div>
                                        <x-input-label for="git_repository" :value="__('Visibilitas *')" />
                                        <select id="git_repository" name="git_repository" class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm">
                                            <option value="">-- Pilih --</option>
                                            <option value="private" {{ old('git_repository', $webApp->git_repository) == 'private' ? 'selected' : '' }}>Private (Tertutup)</option>
                                            <option value="public" {{ old('git_repository', $webApp->git_repository) == 'public' ? 'selected' : '' }}>Public (Terbuka)</option>
                                        </select>
                                        <p class="mt-1 text-xs text-slate-400 dark:text-slate-500">Siapa yang dapat melihat kode sumber ini.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Backup Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="metode_backup_source_code" :value="__('Backup Source Code *')" />
                                    <x-text-input id="metode_backup_source_code" class="block mt-1 w-full text-sm" type="text" name="metode_backup_source_code" :value="old('metode_backup_source_code', $webApp->metode_backup_source_code)" required placeholder="Misal: Git Push Harian" />
                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Strategi pengamanan kode sumber.</p>
                                </div>
                                <div>
                                    <x-input-label for="metode_backup_asset" :value="__('Backup Assets (File/Gambar) *')" />
                                    <x-text-input id="metode_backup_asset" class="block mt-1 w-full text-sm" type="text" name="metode_backup_asset" :value="old('metode_backup_asset', $webApp->metode_backup_asset)" required placeholder="Contoh: Sinkronisasi ke Object Storage, Backup Harian ke Server Lain, atau Copy Manual ke HDD Eksternal" />
                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Jelaskan metode pengamanan file upload (foto/dokumen) agar data tetap aman jika terjadi gangguan server.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Database -->
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">5</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Database</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Spesifikasi penyimpanan data.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="dbms" :value="__('Jenis DBMS *')" />
                                <x-text-input id="dbms" class="block mt-1 w-full text-sm" type="text" name="dbms" :value="old('dbms', $webApp->dbms)" required placeholder="MySQL, PostgreSQL" />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Software database yang digunakan.</p>
                            </div>
                            <div>
                                <x-input-label for="versi_dbms" :value="__('Versi DBMS *')" />
                                <x-text-input id="versi_dbms" class="block mt-1 w-full text-sm" type="text" name="versi_dbms" :value="old('versi_dbms', $webApp->versi_dbms)" required placeholder="8.0, 14, dll" />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Versi perangkat lunak database.</p>
                            </div>
                            <div>
                                <x-input-label for="nama_database" :value="__('Nama Database *')" />
                                <x-text-input id="nama_database" class="block mt-1 w-full text-sm" type="text" name="nama_database" :value="old('nama_database', $webApp->nama_database)" required />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Nama schema database di system.</p>
                            </div>

                            <div>
                                <x-input-label for="versi_database" :value="__('Versi Database *')" />
                                <x-text-input id="versi_database" class="block mt-1 w-full text-sm" type="text" name="versi_database" :value="old('versi_database', $webApp->versi_database)" required />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Versi struktur tabel/migrasi.</p>
                            </div>
                            
                            <div>
                                <x-input-label for="lokasi_database" :value="__('Lokasi Server DB *')" />
                                <select id="lokasi_database" name="lokasi_database" required class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="server" {{ old('lokasi_database', $webApp->lokasi_database) == 'server' ? 'selected' : '' }}>Dedicated Server</option>
                                    <option value="local" {{ old('lokasi_database', $webApp->lokasi_database) == 'local' ? 'selected' : '' }}>Localhost / Shared</option>
                                </select>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Dimana database ini disimpan.</p>
                            </div>

                            <div>
                                <x-input-label for="akses_database" :value="__('Akses Database *')" />
                                <select id="akses_database" name="akses_database" required class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="public" {{ old('akses_database', $webApp->akses_database) == 'public' ? 'selected' : '' }}>Public (Terbuka)</option>
                                    <option value="private" {{ old('akses_database', $webApp->akses_database) == 'private' ? 'selected' : '' }}>Private (Tertutup)</option>
                                </select>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Apakah database bisa diakses jaringan luar?</p>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="metode_backup_database" :value="__('Strategi Backup DB *')" />
                                <x-text-input id="metode_backup_database" class="block mt-1 w-full text-sm" type="text" name="metode_backup_database" :value="old('metode_backup_database', $webApp->metode_backup_database)" required placeholder="Misal: Auto-dump setiap jam 00:00" />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Prosedur penyelamatan data jika terjadi kerusakan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Integrasi & Monev -->
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">6</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Integrasi & Monitoring</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Konektivitas dan pemantauan sistem. (Kosongkan jika tidak ada)</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-input-label for="integrasi_sistem_keluar" :value="__('Integrasi Eksternal')" />
                                <textarea id="integrasi_sistem_keluar" name="integrasi_sistem_keluar" rows="3" class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm transition-all text-sm" placeholder="Contoh: API Dukcapil, SSO Kemendagri, Sistem Keuangan Daerah...">{{ old('integrasi_sistem_keluar', $webApp->integrasi_sistem_keluar) }}</textarea>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Sebutkan sistem pihak ketiga yang terhubung (Opsional).</p>
                                <x-input-error :messages="$errors->get('integrasi_sistem_keluar')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="metode_monitoring_evaluasi" :value="__('Metode Monitoring')" />
                                <div class="bg-slate-50 dark:bg-zinc-900 border border-slate-200 dark:border-zinc-700 p-4 rounded-xl mt-1">
                                    <textarea id="metode_monitoring_evaluasi" name="metode_monitoring_evaluasi" rows="3" class="block w-full bg-transparent border-0 focus:ring-0 p-0 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 dark:placeholder-zinc-500" placeholder="Contoh: Google Analytics, Uptime Robot, Feedback Pengguna...">{{ old('metode_monitoring_evaluasi', $webApp->metode_monitoring_evaluasi) }}</textarea>
                                </div>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Jelaskan cara Anda memantau kesehatan aplikasi (Opsional).</p>
                                <x-input-error :messages="$errors->get('metode_monitoring_evaluasi')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Action -->
                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('web-apps.index') }}" class="px-5 py-2.5 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-zinc-800 font-semibold transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 rounded-xl font-semibold text-white transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleRepositoryStatus() {
            const wrapper = document.getElementById('repository_status_wrapper');
            const yesRadio = document.querySelector('input[name="has_repository"][value="ya"]');
            if (yesRadio && yesRadio.checked) {
                wrapper.classList.remove('hidden');
            } else {
                wrapper.classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', toggleRepositoryStatus);
    </script>
    
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-fade-in-left {
            animation: fadeInLeft 0.6s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</x-app-layout>
