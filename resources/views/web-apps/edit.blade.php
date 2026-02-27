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
                    <i class="fa-solid fa-chevron-left w-4 h-4 text-blue-400 dark:text-blue-500 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors flex items-center justify-center"></i>
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
                                <x-input-label for="nama_web_app" :value="__('Nama Aplikasi *')" />
                                <x-text-input id="nama_web_app" class="block mt-1 w-full text-sm" type="text" name="nama_web_app" :value="old('nama_web_app', $webApp->nama_web_app)" required placeholder="Misal: Sistem Informasi Kepegawaian" />
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Nama resmi aplikasi sesuai SK atau penggunaan umum di instansi.</p>
                                <x-input-error :messages="$errors->get('nama_web_app')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="alamat_tautan" :value="__('Alamat Tautan *')" />
                                <div class="relative mt-1">
                                    <x-text-input id="alamat_tautan" class="block w-full text-sm" type="url" name="alamat_tautan" :value="old('alamat_tautan', $webApp->alamat_tautan)" required placeholder="https://example.id atau tautan akses lainnya" />
                                </div>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">URL atau tautan untuk mengakses aplikasi ini.</p>
                                <x-input-error :messages="$errors->get('alamat_tautan')" class="mt-2" />
                            </div>
                            
                            <!-- Jenis Aplikasi -->
                            <div>
                                <x-input-label for="jenis_aplikasi" :value="__('Jenis Aplikasi')" />
                                <select id="jenis_aplikasi" name="jenis_aplikasi" required class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm">
                                    <option value="">— Pilih jenis aplikasi —</option>
                                    <option value="Web Application" {{ old('jenis_aplikasi', $webApp->jenis_aplikasi) == 'Web Application' ? 'selected' : '' }}>Web Application</option>
                                    <option value="Mobile Application" {{ old('jenis_aplikasi', $webApp->jenis_aplikasi) == 'Mobile Application' ? 'selected' : '' }}>Mobile Application</option>
                                    <option value="Desktop Application" {{ old('jenis_aplikasi', $webApp->jenis_aplikasi) == 'Desktop Application' ? 'selected' : '' }}>Desktop Application</option>
                                </select>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Pilih jenis aplikasi yang sesuai.</p>
                                <x-input-error :messages="$errors->get('jenis_aplikasi')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="deskripsi_singkat" :value="__('Deskripsi Singkat Kegunaan *')" />
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
                            
                            <!-- Email Narahubung -->
                            <div>
                                <x-input-label for="email_narahubung" :value="__('Email Narahubung *')" />
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-regular fa-envelope h-4 w-4 text-gray-400 flex items-center justify-center"></i>
                                    </div>
                                    <x-text-input id="email_narahubung" class="block w-full text-sm pl-9" type="email" name="email_narahubung" :value="old('email_narahubung', $webApp->email_narahubung)" required placeholder="contoh@pekanbaru.go.id" />
                                </div>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Email aktif untuk komunikasi resmi.</p>
                                <x-input-error :messages="$errors->get('email_narahubung')" class="mt-2" />
                            </div>
                            
                            <!-- WhatsApp Narahubung -->
                            <div>
                                <x-input-label for="whatsapp_narahubung" :value="__('Nomor WhatsApp *')" />
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fa-brands fa-whatsapp h-4 w-4 text-green-500 flex items-center justify-center"></i>
                                    </div>
                                    <x-text-input id="whatsapp_narahubung" class="block w-full text-sm pl-9" type="text" name="whatsapp_narahubung" :value="old('whatsapp_narahubung', $webApp->whatsapp_narahubung)" required placeholder="081234567890" />
                                </div>
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Nomor WA aktif tanpa spasi atau tanda baca.</p>
                                <x-input-error :messages="$errors->get('whatsapp_narahubung')" class="mt-2" />
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
                            <div class="md:col-span-2" x-data="languageSelectorEdit()" x-init="init()">
                                <x-input-label for="bahasa_pemrograman" :value="__('Bahasa Pemrograman beserta versinya *')" />
                                <style>
                                    @keyframes langBadgeEnter {
                                        0% { opacity: 0; transform: scale(0.5) translateY(8px); }
                                        50% { transform: scale(1.08) translateY(-2px); }
                                        100% { opacity: 1; transform: scale(1) translateY(0); }
                                    }
                                    @keyframes langSuccessFlash {
                                        0% { box-shadow: inset 0 0 0 0 rgba(16, 185, 129, 0); border-color: rgba(6, 182, 212, 0.1); }
                                        40% { box-shadow: inset 0 0 0 2px rgba(16, 185, 129, 0.3); border-color: rgba(16, 185, 129, 0.5); }
                                        100% { box-shadow: inset 0 0 0 0 rgba(16, 185, 129, 0); border-color: rgba(6, 182, 212, 0.1); }
                                    }
                                    .lang-badge-enter { animation: langBadgeEnter 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
                                    .lang-success-flash { animation: langSuccessFlash 0.6s ease-out; }
                                </style>
                                <div class="bg-cyan-50/50 dark:bg-cyan-900/20 p-4 rounded-xl border border-cyan-100 dark:border-cyan-800/30 mt-1 transition-all duration-300"
                                    :class="{ 'lang-success-flash': isTransitioning }">

                                    <!-- Guide Toggle -->
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-semibold text-cyan-500 dark:text-cyan-400 uppercase tracking-wider">Pilih Bahasa Pemrograman</span>
                                        <button type="button" @click="showGuide = !showGuide"
                                            class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-lg transition-all"
                                            :class="showGuide ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-white/60 dark:bg-zinc-800/60 text-gray-500 dark:text-gray-400 hover:text-cyan-600 dark:hover:text-cyan-400 hover:bg-white dark:hover:bg-zinc-800'">
                                            <i class="fa-solid fa-circle-question w-3.5 h-3.5 flex items-center justify-center"></i>
                                            <span x-text="showGuide ? 'Tutup Panduan' : 'Cara Pengisian'"></span>
                                        </button>
                                    </div>

                                    <!-- Collapsible Guide -->
                                    <div x-show="showGuide" x-collapse
                                        class="mb-4 p-3 rounded-lg bg-amber-50/80 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30">
                                        <div class="space-y-3 text-xs text-gray-700 dark:text-gray-300">
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-cyan-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">1</span>
                                                <div>
                                                    <span>Ketik nama bahasa pemrograman di kolom pencarian. Contoh:</span>
                                                    <div class="mt-1.5 flex items-center gap-1.5">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 text-[11px] text-gray-400 italic">PHP...</span>
                                                        <span class="text-gray-400">→</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-300 text-[11px] font-medium">PHP</span>
                                                    </div>
                                                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Jika tidak ada di daftar, klik tombol hijau <strong class="text-emerald-600 dark:text-emerald-400">"Tambah: [nama]"</strong> yang muncul di bawah dropdown</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-cyan-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">2</span>
                                                <div>
                                                    <span>Ketik atau pilih versi di kolom <strong>"Versi"</strong>. Contoh:</span>
                                                    <div class="mt-1.5 flex items-center gap-1.5">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 text-[11px] text-gray-400 italic">8.2...</span>
                                                        <span class="text-gray-400">→</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-300 text-[11px] font-medium">8.2</span>
                                                    </div>
                                                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Pilih dari daftar atau ketik manual lalu klik <strong class="text-emerald-600 dark:text-emerald-400">"Tambah Versi"</strong>. Bahasa otomatis masuk ke daftar setelah versi dipilih.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">3</span>
                                                <span>Untuk menambah bahasa lain, klik tombol <strong>"➕ Tambah Bahasa Lain"</strong></span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-red-400 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">✕</span>
                                                <span>Untuk menghapus, klik tombol <strong>✕</strong> pada badge bahasa</span>
                                            </div>
                                            <div class="mt-2 pt-2 border-t border-amber-200/60 dark:border-amber-800/30 text-[11px] text-amber-700 dark:text-amber-400 flex items-center gap-1.5">
                                                <i class="fa-solid fa-circle-info w-3.5 h-3.5 flex-shrink-0"></i>
                                                <span>Setiap bahasa hanya bisa ditambahkan <strong>satu kali</strong>.</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="showPicker"
                                        x-transition:enter="transition ease-out duration-400"
                                        x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave="transition ease-in-out duration-300"
                                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                                    >
                                        <!-- Language Search -->
                                        <div class="relative">
                                            <label class="block text-xs font-semibold text-cyan-700 dark:text-cyan-400 mb-1.5 flex items-center gap-1">
                                                <i class="fa-solid fa-triangle-exclamation w-3.5 h-3.5 flex items-center justify-center"></i>
                                                Bahasa Pemrograman
                                            </label>
                                            <div class="relative">
                                                <input type="text"
                                                    x-model="langSearch"
                                                    @input="onLangSearch()"
                                                    @focus="if(langSearch.length >= 1) { onLangSearch(); langOpen = true; }"
                                                    @click.away="langOpen = false"
                                                    @keydown.arrow-down.prevent="langHighlightedIndex = Math.min(langHighlightedIndex + 1, langResults.length + (langSearch && !langExactMatch ? 0 : -1))"
                                                    @keydown.arrow-up.prevent="langHighlightedIndex = Math.max(langHighlightedIndex - 1, 0)"
                                                    @keydown.enter.prevent="selectHighlightedLang()"
                                                    class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 shadow-sm text-sm py-2.5 px-3"
                                                    :class="{ 'bg-gray-50 dark:bg-zinc-800': selectedLang }"
                                                    :placeholder="selectedLang ? selectedLang : 'Cari atau tambah bahasa...'"
                                                    autocomplete="off"
                                                >
                                                <button type="button" x-show="selectedLang" @click="clearLang()"
                                                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 p-1 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                </button>
                                            </div>

                                            <!-- Dropdown Results -->
                                            <div x-show="langOpen && (langResults.length > 0 || (langSearch && !langExactMatch))"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 -translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                class="absolute z-30 w-full mt-1 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-56 overflow-y-auto">
                                                <template x-for="(lang, index) in langResults" :key="lang.name">
                                                    <div @click="selectLang(lang)"
                                                        class="px-4 py-2.5 cursor-pointer transition-all duration-150 flex items-center gap-3 group"
                                                        :class="{ 'bg-cyan-50 dark:bg-cyan-900/30': langHighlightedIndex === index, 'hover:bg-gray-50 dark:hover:bg-zinc-700/50': langHighlightedIndex !== index }">
                                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-100 to-teal-100 dark:from-cyan-900/40 dark:to-teal-900/40 flex items-center justify-center">
                                                            <span class="text-cyan-700 dark:text-cyan-400 text-xs font-bold" x-text="lang.name.substring(0,2).toUpperCase()"></span>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="lang.name"></div>

                                                        </div>
                                                    </div>
                                                </template>

                                                <div 
                                                    x-show="langSearch && !langExactMatch && !addedLangs.some(l => l.name.toLowerCase() === langSearch.toLowerCase())"
                                                    @click="selectNewLang()"
                                                    class="px-4 py-3 cursor-pointer border-t border-gray-200 dark:border-zinc-600 transition-all duration-150"
                                                    :class="{ 'bg-emerald-50 dark:bg-emerald-900/20': langHighlightedIndex === langResults.length }">
                                                    <div class="flex items-center gap-2">
                                                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-100 to-green-100 dark:from-emerald-900/40 dark:to-green-900/40 flex items-center justify-center">
                                                            <i class="fa-solid fa-plus w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                        </span>
                                                        <div>
                                                            <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                                Tambah: "<span x-text="langSearch"></span>"
                                                            </div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Bahasa belum terdaftar di sistem, klik untuk menambahkan</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div 
                                                    x-show="langSearch && addedLangs.some(l => l.name.toLowerCase() === langSearch.toLowerCase())"
                                                    class="px-4 py-3 border-t border-gray-200 dark:border-zinc-600">
                                                    <div class="flex items-center gap-2 text-red-500 dark:text-red-400">
                                                        <i class="fa-solid fa-circle-exclamation w-4 h-4 flex-shrink-0"></i>
                                                        <span class="text-xs font-medium"><span x-text="langSearch"></span> sudah ditambahkan — Pilih bahasa lain</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Version Search -->
                                        <div class="relative"
                                            x-show="selectedLang || isNewLang"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 translate-x-4"
                                            x-transition:enter-end="opacity-100 translate-x-0"
                                            x-transition:leave="transition ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-x-0"
                                            x-transition:leave-end="opacity-0 translate-x-4"
                                        >
                                            <label class="block text-xs font-semibold text-cyan-700 dark:text-cyan-400 mb-1.5 flex items-center gap-1">
                                                <i class="fa-regular fa-clipboard w-3.5 h-3.5 flex items-center justify-center"></i>
                                                Versi Bahasa
                                            </label>
                                            <div class="relative">
                                                <input type="text"
                                                    x-model="versiLangSearch"
                                                    @input="onVersiLangSearch()"
                                                    @focus=""
                                                    @click.away="versiLangOpen = false"
                                                    @keydown.arrow-down.prevent="versiLangHighlightedIndex = Math.min(versiLangHighlightedIndex + 1, versiLangResults.length + (versiLangSearch && !versiLangExactMatch ? 0 : -1))"
                                                    @keydown.arrow-up.prevent="versiLangHighlightedIndex = Math.max(versiLangHighlightedIndex - 1, 0)"
                                                    @keydown.enter.prevent="selectHighlightedVersiLang()"
                                                    class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 shadow-sm text-sm py-2.5 px-3"
                                                    :class="{ 'bg-gray-50 dark:bg-zinc-800': selectedVersiLang }"
                                                    :placeholder="selectedVersiLang ? selectedVersiLang : (selectedLang ? 'Cari atau tambah versi ' + selectedLang + '...' : 'Cari atau tambah versi...')"
                                                    autocomplete="off"
                                                    :disabled="!selectedLang && !isNewLang"
                                                >
                                                <button type="button" x-show="selectedVersiLang" @click="clearVersiLang()"
                                                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 p-1 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                </button>
                                            </div>

                                            <div x-show="versiLangOpen && (versiLangResults.length > 0 || (versiLangSearch && !versiLangExactMatch))"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 -translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                class="absolute z-30 w-full mt-1 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-56 overflow-y-auto">
                                                <template x-for="(versi, index) in versiLangResults" :key="versi">
                                                    <div @click="selectVersiLang(versi)"
                                                        class="px-4 py-2.5 cursor-pointer transition-all duration-150 flex items-center gap-3"
                                                        :class="{ 'bg-cyan-50 dark:bg-cyan-900/30': versiLangHighlightedIndex === index }">
                                                        <span class="flex-shrink-0 w-7 h-7 rounded-md bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center">
                                                            <span class="text-cyan-700 dark:text-cyan-400 text-xs font-semibold" x-text="versi"></span>
                                                        </span>
                                                        <span class="text-sm text-slate-700 dark:text-slate-300" x-text="versi"></span>
                                                    </div>
                                                </template>

                                                <div x-show="versiLangSearch && !versiLangExactMatch"
                                                    @click="selectNewVersiLang()"
                                                    class="px-4 py-3 cursor-pointer border-t border-gray-200 dark:border-zinc-600 transition-all duration-150"
                                                    :class="{ 'bg-emerald-50 dark:bg-emerald-900/20': versiLangHighlightedIndex === versiLangResults.length }">
                                                    <div class="flex items-center gap-2">
                                                        <span class="flex-shrink-0 w-7 h-7 rounded-md bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center">
                                                            <i class="fa-solid fa-plus w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                        </span>
                                                        <div>
                                                            <span class="text-sm font-medium text-emerald-700 dark:text-emerald-400">Tambah Versi: "<span x-text="versiLangSearch"></span>"</span>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Versi belum terdaftar, klik untuk menambahkan</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Added Languages Badges -->
                                    <div class="flex flex-wrap gap-2 mt-3" x-show="addedLangs.length > 0">
                                        <template x-for="(lang, index) in addedLangs" :key="index">
                                            <span class="lang-badge-enter inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-gradient-to-r from-cyan-100 to-teal-100 dark:from-cyan-900/40 dark:to-teal-900/40 text-cyan-800 dark:text-cyan-300 border border-cyan-200 dark:border-cyan-800/30 shadow-sm">
                                                <span x-text="lang.name + ' ' + lang.version"></span>
                                                <button type="button" @click="removeLang(index)"
                                                    class="ml-0.5 text-cyan-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-full p-0.5 transition-colors">
                                                    <i class="fa-solid fa-star w-3.5 h-3.5 flex items-center justify-center"></i>
                                                </button>
                                            </span>
                                        </template>
                                    </div>

                                    <!-- Duplicate Error -->
                                    <div x-show="duplicateError" x-transition
                                        class="mt-2 px-3 py-2 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-600 dark:text-red-400 text-xs font-medium flex items-center gap-2">
                                        <i class="fa-solid fa-circle-exclamation w-4 h-4 flex-shrink-0"></i>
                                        <span x-text="duplicateError"></span>
                                    </div>

                                    <!-- Add More Button -->
                                    <div x-show="!showPicker && addedLangs.length > 0" class="mt-3"
                                        x-transition:enter="transition ease-out duration-300 delay-150"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0">
                                        <button type="button" @click="showPicker = true"
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 text-emerald-700 dark:text-emerald-400 text-sm font-bold rounded-xl border border-emerald-200 dark:border-emerald-800/30 hover:from-emerald-100 hover:to-teal-100 dark:hover:from-emerald-900/40 dark:hover:to-teal-900/40 hover:border-emerald-300 dark:hover:border-emerald-700 hover:shadow-md transition-all shadow-sm">
                                            <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                            Tambah Bahasa Lain
                                        </button>
                                    </div>

                                    <input type="hidden" name="bahasa_pemrograman" x-model="langValue">
                                    
                                    <p class="mt-3 text-xs text-cyan-600 dark:text-cyan-400 flex items-start gap-1">
                                        <i class="fa-solid fa-circle-info w-4 h-4 flex-shrink-0 mt-0.5"></i>
                                        <span><strong>Hasil:</strong> <span x-text="langValue || 'Belum dipilih'"></span></span>
                                    </p>
                                </div>
                                <x-input-error :messages="$errors->get('bahasa_pemrograman')" class="mt-2" />

                                <!-- Alpine.js Component Script for Language (Edit) -->
                                <script>
                                    function languageSelectorEdit() {
                                        return {
                                            langData: @json($langOptions),
                                            
                                            langSearch: '', langResults: [], selectedLangId: null, selectedLang: null,
                                            isNewLang: false, langOpen: false, langHighlightedIndex: -1, langExactMatch: false,
                                            
                                            versiLangSearch: '', versiLangResults: [], selectedVersiLang: null,
                                            isNewVersiLang: false, versiLangOpen: false, versiLangHighlightedIndex: -1, versiLangExactMatch: false,
                                            
                                            langValue: '', addedLangs: [], showPicker: true, isTransitioning: false,
                                            duplicateError: '', showGuide: false,
                                            
                                            init() {
                                                // Parse existing data
                                                const existing = @json(old('bahasa_pemrograman', $webApp->bahasa_pemrograman ?? ''));
                                                if (existing) {
                                                    const parts = existing.split(',').map(p => p.trim()).filter(p => p);
                                                    parts.forEach(part => {
                                                        const match = part.match(/^(.+?)\s+([\d\w\.\+\-x]+)$/);
                                                        if (match) {
                                                            this.addedLangs.push({ name: match[1].trim(), version: match[2].trim() });
                                                        } else {
                                                            this.addedLangs.push({ name: part.trim(), version: '-' });
                                                        }
                                                    });
                                                    if (this.addedLangs.length > 0) this.showPicker = false;
                                                    this.updateLangValue();
                                                }

                                                this.$watch('selectedLang', (value) => {
                                                    if (value) { this.clearVersiLang(); this.updateVersiLangOptions(); this.updateLangValue(); }
                                                });
                                                this.$watch('selectedVersiLang', (value) => {
                                                    this.updateLangValue();
                                                    if (value && this.selectedLang) {
                                                        this.isTransitioning = true;
                                                        setTimeout(() => {
                                                            this.addCurrentLang();
                                                            setTimeout(() => { this.isTransitioning = false; }, 400);
                                                        }, 600);
                                                    }
                                                });
                                            },

                                            updateLangValue() {
                                                let parts = this.addedLangs.map(l => l.name + ' ' + l.version);
                                                if (this.selectedLang && this.selectedVersiLang) {
                                                    parts.push(this.selectedLang + ' ' + this.selectedVersiLang);
                                                } else if (this.selectedLang) {
                                                    parts.push(this.selectedLang);
                                                }
                                                this.langValue = parts.join(', ');
                                            },

                                            addCurrentLang() {
                                                if (this.selectedLang && this.selectedVersiLang) {
                                                    const isDuplicate = this.addedLangs.some(l => l.name.toLowerCase() === this.selectedLang.toLowerCase());
                                                    if (isDuplicate) {
                                                        this.duplicateError = this.selectedLang + ' sudah ditambahkan!';
                                                        this.isTransitioning = false;
                                                        setTimeout(() => { this.duplicateError = ''; }, 3000);
                                                        return;
                                                    }
                                                    this.duplicateError = '';
                                                    this.addedLangs.push({ name: this.selectedLang, version: this.selectedVersiLang });
                                                    this.selectedLangId = null; this.selectedLang = null; this.isNewLang = false;
                                                    this.langSearch = ''; this.langResults = []; this.langOpen = false; this.langHighlightedIndex = -1;
                                                    this.selectedVersiLang = null; this.isNewVersiLang = false;
                                                    this.versiLangSearch = ''; this.versiLangResults = []; this.versiLangOpen = false; this.versiLangHighlightedIndex = -1;
                                                    this.showPicker = false; this.updateLangValue();
                                                }
                                            },

                                            removeLang(index) {
                                                this.addedLangs.splice(index, 1);
                                                this.updateLangValue();
                                                if (this.addedLangs.length === 0) this.showPicker = true;
                                            },

                                            onLangSearch() {
                                                this.selectedLangId = null; this.isNewLang = false; this.langHighlightedIndex = -1;
                                                if (this.langSearch.length < 1) { this.langResults = []; this.langOpen = false; this.updateLangValue(); return; }
                                                const query = this.langSearch.toLowerCase();
                                                const addedNames = this.addedLangs.map(l => l.name.toLowerCase());
                                                this.langResults = this.langData
                                                    .filter(l => l.name.toLowerCase().includes(query))
                                                    .filter(l => !addedNames.includes(l.name.toLowerCase()))
                                                    .slice(0, 10);
                                                this.langExactMatch = this.langResults.some(l => l.name.toLowerCase() === query);
                                                this.langOpen = true; this.updateLangValue();
                                            },

                                            selectLang(lang) {
                                                this.selectedLangId = lang.name; this.selectedLang = lang.name; this.langSearch = lang.name;
                                                this.isNewLang = false; this.langOpen = false; this.langHighlightedIndex = -1;
                                                this.updateVersiLangOptions(); this.updateLangValue();
                                            },

                                            selectNewLang() {
                                                const normalized = this.langSearch.trim().split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
                                                this.selectedLangId = null; this.selectedLang = normalized; this.isNewLang = true;
                                                this.langSearch = normalized; this.langOpen = false; this.langHighlightedIndex = -1;
                                                this.versiLangResults = []; this.updateLangValue();
                                            },

                                            clearLang() {
                                                this.selectedLangId = null; this.selectedLang = null; this.isNewLang = false;
                                                this.langSearch = ''; this.langResults = []; this.langOpen = false; this.langHighlightedIndex = -1;
                                                this.clearVersiLang(); this.updateLangValue();
                                            },

                                            selectHighlightedLang() {
                                                if (this.langHighlightedIndex >= 0 && this.langHighlightedIndex < this.langResults.length) {
                                                    this.selectLang(this.langResults[this.langHighlightedIndex]);
                                                } else if (this.langHighlightedIndex === this.langResults.length && this.langSearch && !this.langExactMatch) {
                                                    this.selectNewLang();
                                                }
                                            },

                                            updateVersiLangOptions() {
                                                if (!this.selectedLang) { this.versiLangResults = []; return; }
                                                const found = this.langData.find(l => l.name.toLowerCase() === this.selectedLang.toLowerCase());
                                                this.versiLangResults = found ? found.versions : [];
                                                this.versiLangOpen = false;
                                            },

                                            onVersiLangSearch() {
                                                this.versiLangHighlightedIndex = -1;
                                                if (!this.selectedLang && !this.isNewLang) return;
                                                const found = this.langData.find(l => l.name.toLowerCase() === (this.selectedLang || '').toLowerCase());
                                                const allVersions = found ? found.versions : [];
                                                if (this.versiLangSearch.length < 1) {
                                                    this.versiLangResults = allVersions;
                                                } else {
                                                    const query = this.versiLangSearch.toLowerCase();
                                                    this.versiLangResults = allVersions.filter(v => v.toLowerCase().includes(query));
                                                }
                                                this.versiLangExactMatch = this.versiLangResults.some(v => v.toLowerCase() === this.versiLangSearch.toLowerCase());
                                                this.versiLangOpen = true;
                                            },

                                            selectVersiLang(versi) {
                                                this.selectedVersiLang = versi; this.versiLangSearch = versi;
                                                this.isNewVersiLang = false; this.versiLangOpen = false; this.versiLangHighlightedIndex = -1;
                                            },

                                            selectNewVersiLang() {
                                                this.selectedVersiLang = this.versiLangSearch.trim(); this.isNewVersiLang = true;
                                                this.versiLangOpen = false; this.versiLangHighlightedIndex = -1;
                                            },

                                            clearVersiLang() {
                                                this.selectedVersiLang = null; this.isNewVersiLang = false;
                                                this.versiLangSearch = ''; this.versiLangResults = []; this.versiLangOpen = false; this.versiLangHighlightedIndex = -1;
                                            },

                                            selectHighlightedVersiLang() {
                                                if (this.versiLangHighlightedIndex >= 0 && this.versiLangHighlightedIndex < this.versiLangResults.length) {
                                                    this.selectVersiLang(this.versiLangResults[this.versiLangHighlightedIndex]);
                                                } else if (this.versiLangHighlightedIndex === this.versiLangResults.length && this.versiLangSearch && !this.versiLangExactMatch) {
                                                    this.selectNewVersiLang();
                                                }
                                            }
                                        }
                                    }
                                </script>
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
                            
                            <!-- Framework Autocomplete -->
                            <div class="md:col-span-3" x-data="frameworkSelectorEdit()" x-init="init()">
                                <style>
                                    @keyframes fwBadgeEnter {
                                        0% { opacity: 0; transform: scale(0.5) translateY(8px); }
                                        50% { transform: scale(1.08) translateY(-2px); }
                                        100% { opacity: 1; transform: scale(1) translateY(0); }
                                    }
                                    @keyframes fwSuccessFlash {
                                        0% { box-shadow: inset 0 0 0 0 rgba(16, 185, 129, 0); border-color: rgba(99, 102, 241, 0.1); }
                                        40% { box-shadow: inset 0 0 0 2px rgba(16, 185, 129, 0.3); border-color: rgba(16, 185, 129, 0.5); }
                                        100% { box-shadow: inset 0 0 0 0 rgba(16, 185, 129, 0); border-color: rgba(99, 102, 241, 0.1); }
                                    }
                                    .fw-badge-enter { animation: fwBadgeEnter 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
                                    .fw-success-flash { animation: fwSuccessFlash 0.6s ease-out; }
                                </style>
                                <div class="bg-indigo-50/50 dark:bg-indigo-900/20 p-4 rounded-xl border border-indigo-100 dark:border-indigo-800/30 mt-1 transition-all duration-300"
                                    :class="{ 'fw-success-flash': isTransitioning }">

                                    <!-- Guide Toggle Button -->
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-semibold text-indigo-500 dark:text-indigo-400 uppercase tracking-wider">Pilih Framework</span>
                                        <button type="button" @click="showGuide = !showGuide"
                                            class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-lg transition-all"
                                            :class="showGuide ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-white/60 dark:bg-zinc-800/60 text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-white dark:hover:bg-zinc-800'">
                                            <i class="fa-solid fa-circle-question w-3.5 h-3.5 flex items-center justify-center"></i>
                                            <span x-text="showGuide ? 'Tutup Panduan' : 'Cara Pengisian'"></span>
                                        </button>
                                    </div>

                                    <!-- Collapsible Guide Panel -->
                                    <div x-show="showGuide" x-collapse
                                        class="mb-4 p-3 rounded-lg bg-amber-50/80 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30">
                                        <div class="space-y-3 text-xs text-gray-700 dark:text-gray-300">
                                            <!-- Step 1: Framework -->
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-indigo-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">1</span>
                                                <div>
                                                    <span>Ketik nama framework di kolom pencarian. Contoh:</span>
                                                    <div class="mt-1.5 flex items-center gap-1.5">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 text-[11px] text-gray-400 dark:text-gray-500 italic">Lara...</span>
                                                        <span class="text-gray-400">→</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-[11px] font-medium">Laravel</span>
                                                    </div>
                                                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Jika framework tidak ada di daftar, klik tombol hijau <strong class="text-emerald-600 dark:text-emerald-400">"Tambah: [nama]"</strong> yang muncul di bawah dropdown</p>
                                                </div>
                                            </div>
                                            <!-- Step 2: Version -->
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-indigo-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">2</span>
                                                <div>
                                                    <span>Ketik atau pilih versi di kolom <strong>"Versi"</strong>. Contoh:</span>
                                                    <div class="mt-1.5 flex items-center gap-1.5">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 text-[11px] text-gray-400 dark:text-gray-500 italic">11...</span>
                                                        <span class="text-gray-400">→</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-[11px] font-medium">11.x</span>
                                                    </div>
                                                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Pilih dari daftar atau ketik manual lalu klik <strong class="text-emerald-600 dark:text-emerald-400">"Tambah Versi"</strong>. Framework otomatis masuk ke daftar setelah versi dipilih.</p>
                                                </div>
                                            </div>
                                            <!-- Step 3: Add more -->
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">3</span>
                                                <span>Untuk menambah framework lain, klik tombol <strong>"➕ Tambah Framework Lain"</strong></span>
                                            </div>
                                            <!-- Step 4: Remove -->
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-red-400 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">✕</span>
                                                <span>Untuk menghapus, klik tombol <strong>✕</strong> pada badge framework</span>
                                            </div>
                                            <!-- Info -->
                                            <div class="mt-2 pt-2 border-t border-amber-200/60 dark:border-amber-800/30 text-[11px] text-amber-700 dark:text-amber-400 flex items-center gap-1.5">
                                                <i class="fa-solid fa-circle-info w-3.5 h-3.5 flex-shrink-0"></i>
                                                <span>Setiap framework hanya bisa ditambahkan <strong>satu kali</strong>.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-show="showPicker"
                                        x-transition:enter="transition ease-out duration-400"
                                        x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave="transition ease-in-out duration-300"
                                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                    >
                                        <!-- Jenis Framework Autocomplete -->
                                        <div class="relative">
                                            <x-input-label for="framework_search" :value="__('Framework Utama Dan versinya *')" />
                                            <div class="relative mt-1">
                                                <input 
                                                    type="text" 
                                                    id="framework_search" 
                                                    x-model="fwSearch"
                                                    @input="onFwSearch()"
                                                    @focus="fwOpen = true"
                                                    @keydown.escape="fwOpen = false"
                                                    @keydown.arrow-down.prevent="highlightNextFw()"
                                                    @keydown.arrow-up.prevent="highlightPrevFw()"
                                                    @keydown.enter.prevent="selectHighlightedFw()"
                                                    class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm py-2.5 px-3"
                                                    :class="{ 'bg-gray-50 dark:bg-zinc-800': selectedFw }"
                                                    :placeholder="selectedFw ? selectedFw : 'Cari atau tambah framework...'"
                                                    autocomplete="off"
                                                >
                                                <!-- Clear Button -->
                                                <button 
                                                    type="button"
                                                    x-show="selectedFw"
                                                    @click="clearFw()"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition-colors"
                                                >
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                </button>
                                            </div>

                                            <!-- Dropdown Framework -->
                                            <div 
                                                x-show="fwOpen && (fwResults.length > 0 || (fwSearch && !selectedFwId))"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 translate-y-1"
                                                @click.outside="fwOpen = false"
                                                class="absolute z-50 mt-1 w-full bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 max-h-60 overflow-auto"
                                            >
                                                <!-- Existing Framework Results -->
                                                <template x-for="(fw, index) in fwResults" :key="fw.name">
                                                    <div 
                                                        @click="selectFw(fw)"
                                                        @mouseenter="fwHighlightedIndex = index"
                                                        :class="{ 
                                                            'bg-blue-50 dark:bg-blue-900/30': fwHighlightedIndex === index,
                                                            'border-l-4 border-blue-500': selectedFwId === fw.name
                                                        }"
                                                        class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700 last:border-b-0 transition-colors"
                                                    >
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center flex-shrink-0">
                                                                <i class="fa-solid fa-layer-group w-4 h-4 text-indigo-600 dark:text-indigo-400 flex items-center justify-center"></i>
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="fw.name"></div>

                                                            </div>
                                                            <i class="fa-solid fa-star w-5 h-5 text-blue-600 flex items-center justify-center" x-show="selectedFwId === fw.name"></i>
                                                        </div>
                                                    </div>
                                                </template>

                                                <!-- Add New Framework Option -->
                                                <div 
                                                    x-show="fwSearch && !fwExactMatch && !addedFrameworks.some(f => f.name.toLowerCase() === fwSearch.toLowerCase())"
                                                    @click="selectNewFw()"
                                                    @mouseenter="fwHighlightedIndex = fwResults.length"
                                                    :class="{ 'bg-emerald-50 dark:bg-emerald-900/30': fwHighlightedIndex === fwResults.length }"
                                                    class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-t border-gray-200 dark:border-zinc-600 transition-colors"
                                                >
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                                                            <i class="fa-solid fa-star w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                                Tambah: "<span x-text="fwSearch"></span>"
                                                            </div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Framework belum terdaftar di sistem, klik untuk menambahkan</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Already Added Framework Warning -->
                                                <div 
                                                    x-show="fwSearch && addedFrameworks.some(f => f.name.toLowerCase() === fwSearch.toLowerCase())"
                                                    class="px-4 py-3 border-t border-gray-200 dark:border-zinc-600"
                                                >
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/50 flex items-center justify-center flex-shrink-0">
                                                            <i class="fa-solid fa-star w-4 h-4 text-red-500 dark:text-red-400 flex items-center justify-center"></i>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="text-sm font-medium text-red-600 dark:text-red-400">
                                                                "<span x-text="fwSearch"></span>" sudah ditambahkan
                                                            </div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Pilih framework lain</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Selected Framework Badge -->
                                            <div x-show="selectedFw && !isNewFw" class="mt-2 flex items-center gap-2">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                    <span x-text="selectedFw"></span>
                                                </span>
                                                <span class="text-xs text-gray-500">terpilih</span>
                                            </div>

                                            <!-- New Framework Indicator -->
                                            <div x-show="isNewFw && fwSearch" class="mt-2 flex items-center gap-2">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                    <span x-text="fwSearch"></span>
                                                </span>
                                                <span class="text-xs text-emerald-600">(Framework Baru)</span>
                                            </div>
                                        </div>

                                        <!-- Versi Framework Autocomplete -->
                                        <div class="relative" x-show="selectedFw || isNewFw" x-transition>
                                            <x-input-label for="versi_fw_search" :value="__('Versi Framework *')" />
                                            <div class="relative mt-1">
                                                <input 
                                                    type="text" 
                                                    id="versi_fw_search" 
                                                    x-model="versiFwSearch"
                                                    @input="onVersiFwSearch()"
                                                    @focus=""
                                                    @keydown.escape="versiFwOpen = false"
                                                    @keydown.arrow-down.prevent="highlightNextVersiFw()"
                                                    @keydown.arrow-up.prevent="highlightPrevVersiFw()"
                                                    @keydown.enter.prevent="selectHighlightedVersiFw()"
                                                    class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm py-2.5 px-3"
                                                    :class="{ 'bg-gray-50 dark:bg-zinc-800': selectedVersiFw }"
                                                    :placeholder="selectedVersiFw ? selectedVersiFw : (selectedFw ? 'Cari atau tambah versi ' + selectedFw + '...' : 'Cari atau tambah versi...')"
                                                    autocomplete="off"
                                                    :disabled="!selectedFw && !isNewFw"
                                                >
                                                <!-- Clear Button -->
                                                <button 
                                                    type="button"
                                                    x-show="selectedVersiFw"
                                                    @click="clearVersiFw()"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition-colors"
                                                >
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                </button>
                                            </div>

                                            <!-- Dropdown Versi Framework -->
                                            <div 
                                                x-show="versiFwOpen && (versiFwResults.length > 0 || (versiFwSearch && !selectedVersiFw && (selectedFw || isNewFw)))"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 translate-y-1"
                                                @click.outside="versiFwOpen = false"
                                                class="absolute z-50 mt-1 w-full bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 max-h-60 overflow-auto"
                                            >
                                                <!-- Existing Versi Results -->
                                                <template x-for="(versi, index) in versiFwResults" :key="versi">
                                                    <div 
                                                        @click="selectVersiFw(versi)"
                                                        @mouseenter="versiFwHighlightedIndex = index"
                                                        :class="{ 
                                                            'bg-blue-50 dark:bg-blue-900/30': versiFwHighlightedIndex === index,
                                                            'border-l-4 border-blue-500': selectedVersiFw === versi
                                                        }"
                                                        class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700 last:border-b-0 transition-colors"
                                                    >
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center flex-shrink-0">
                                                                <i class="fa-solid fa-star w-4 h-4 text-purple-600 dark:text-purple-400 flex items-center justify-center"></i>
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="versi"></div>
                                                                <div class="text-xs text-gray-500 dark:text-gray-400">Versi tersedia</div>
                                                            </div>
                                                            <i class="fa-solid fa-star w-5 h-5 text-blue-600 flex items-center justify-center" x-show="selectedVersiFw === versi"></i>
                                                        </div>
                                                    </div>
                                                </template>

                                                <!-- Add New Versi Option -->
                                                <div 
                                                    x-show="versiFwSearch && !versiFwExactMatch"
                                                    @click="selectNewVersiFw()"
                                                    @mouseenter="versiFwHighlightedIndex = versiFwResults.length"
                                                    :class="{ 'bg-emerald-50 dark:bg-emerald-900/30': versiFwHighlightedIndex === versiFwResults.length }"
                                                    class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-t border-gray-200 dark:border-zinc-600 transition-colors"
                                                >
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                                                            <i class="fa-solid fa-star w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                                Tambah Versi: "<span x-text="versiFwSearch"></span>"
                                                            </div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Versi baru akan digunakan</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Selected Versi Badge -->
                                            <div x-show="selectedVersiFw" class="mt-2 flex items-center gap-2">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                    <span x-text="selectedVersiFw"></span>
                                                </span>
                                                <span x-show="!isNewVersiFw" class="text-xs text-gray-500">terpilih</span>
                                                <span x-show="isNewVersiFw" class="text-xs text-purple-600">(versi baru)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Added Frameworks List -->
                                    <div x-show="addedFrameworks.length > 0" class="mt-4"
                                        x-transition:enter="transition ease-out duration-300 delay-100"
                                        x-transition:enter-start="opacity-0 translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-2"
                                    >
                                        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-2">Framework Terpilih:</p>
                                        <div class="flex flex-wrap gap-2">
                                            <template x-for="(fw, index) in addedFrameworks" :key="index">
                                                <span class="fw-badge-enter inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-700/50 shadow-sm">
                                                    <i class="fa-solid fa-layer-group w-3.5 h-3.5 text-indigo-500 flex items-center justify-center"></i>
                                                    <span x-text="fw.name + ' ' + fw.version"></span>
                                                    <button type="button" @click="removeFramework(index)" class="ml-0.5 text-indigo-400 hover:text-red-500 dark:text-indigo-500 dark:hover:text-red-400 transition-colors" title="Hapus framework">
                                                        <i class="fa-solid fa-star w-3.5 h-3.5 flex items-center justify-center"></i>
                                                    </button>
                                                </span>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Duplicate Error Message -->
                                    <div x-show="duplicateError" class="mt-3"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                    >
                                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30">
                                            <i class="fa-solid fa-star w-4 h-4 text-red-500 flex-shrink-0"></i>
                                            <span class="text-sm font-medium text-red-600 dark:text-red-400" x-text="duplicateError"></span>
                                        </div>
                                    </div>

                                    <!-- Tambah Framework Lain Button (visible when picker is hidden) -->
                                    <div x-show="!showPicker && addedFrameworks.length > 0" class="mt-3"
                                        x-transition:enter="transition ease-out duration-300 delay-150"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                    >
                                        <button type="button" @click="showPicker = true"
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 text-emerald-700 dark:text-emerald-400 text-sm font-bold rounded-xl border border-emerald-200 dark:border-emerald-800/30 hover:from-emerald-100 hover:to-teal-100 dark:hover:from-emerald-900/40 dark:hover:to-teal-900/40 hover:border-emerald-300 dark:hover:border-emerald-700 hover:shadow-md transition-all shadow-sm">
                                            <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                            Tambah Framework Lain
                                        </button>
                                    </div>

                                    <input type="hidden" name="framework" x-model="frameworkValue">
                                    
                                    <p class="mt-3 text-xs text-indigo-600 dark:text-indigo-400 flex items-start gap-1">
                                        <i class="fa-solid fa-circle-info w-4 h-4 flex-shrink-0 mt-0.5"></i>
                                        <span><strong>Hasil:</strong> <span x-text="frameworkValue || 'Belum dipilih'"></span></span>
                                    </p>
                                </div>
                                <x-input-error :messages="$errors->get('framework')" class="mt-2" />

                                <!-- Alpine.js Component Script for Framework Edit -->
                                <script>
                                    function frameworkSelectorEdit() {
                                        return {
                                            fwData: @json($fwOptions),
                                            
                                            // State Framework
                                            fwSearch: '',
                                            fwResults: [],
                                            selectedFwId: null,
                                            selectedFw: null,
                                            isNewFw: false,
                                            fwOpen: false,
                                            fwHighlightedIndex: -1,
                                            fwExactMatch: false,
                                            
                                            // State Versi Framework
                                            versiFwSearch: '',
                                            versiFwResults: [],
                                            selectedVersiFw: null,
                                            isNewVersiFw: false,
                                            versiFwOpen: false,
                                            versiFwHighlightedIndex: -1,
                                            versiFwExactMatch: false,
                                            
                                            // Output Value
                                            frameworkValue: '',
                                            addedFrameworks: [],
                                            showPicker: true,
                                            isTransitioning: false,
                                            duplicateError: '',
                                            showGuide: false,
                                            
                                            init() {
                                                // Parse existing framework value (supports comma-separated multiple frameworks)
                                                const existingFramework = '{{ old('framework', $webApp->framework) }}';
                                                
                                                if (existingFramework) {
                                                    // Split by comma for multiple frameworks
                                                    const entries = existingFramework.split(',').map(s => s.trim()).filter(s => s);
                                                    
                                                    // ALL entries go to addedFrameworks badges
                                                    for (const entry of entries) {
                                                        const parsed = this.parseFrameworkEntry(entry);
                                                        this.addedFrameworks.push(parsed);
                                                    }
                                                    this.updateFrameworkValue();
                                                    this.showPicker = false;
                                                }
                                                
                                                // Watch for framework change
                                                this.$watch('selectedFw', (value) => {
                                                    if (value) {
                                                        this.clearVersiFw();
                                                        this.updateVersiFwOptions();
                                                        this.updateFrameworkValue();
                                                    }
                                                });
                                                
                                                // Auto-add to list when version is selected
                                                this.$watch('selectedVersiFw', (value) => {
                                                    this.updateFrameworkValue();
                                                    if (value && this.selectedFw) {
                                                        // Brief success flash
                                                        this.isTransitioning = true;
                                                        setTimeout(() => {
                                                            this.addCurrentFramework();
                                                            setTimeout(() => { this.isTransitioning = false; }, 400);
                                                        }, 600);
                                                    }
                                                });
                                            },
                                            
                                            parseFrameworkEntry(entry) {
                                                const parts = entry.trim().split(' ');
                                                let fwName = parts[0];
                                                let fwVersi = parts.slice(1).join(' ');
                                                
                                                // Check for multi-word framework names
                                                for (let i = 2; i <= parts.length; i++) {
                                                    const testName = parts.slice(0, i).join(' ');
                                                    const foundFw = this.fwData.find(f => f.name.toLowerCase() === testName.toLowerCase());
                                                    if (foundFw) {
                                                        fwName = testName;
                                                        fwVersi = parts.slice(i).join(' ');
                                                        break;
                                                    }
                                                }
                                                
                                                const foundFw = this.fwData.find(f => f.name.toLowerCase() === fwName.toLowerCase());
                                                return {
                                                    name: foundFw ? foundFw.name : this.normalizeFwName(fwName),
                                                    version: fwVersi || ''
                                                };
                                            },
                                            
                                            loadFrameworkToPicker(entry) {
                                                const parts = entry.trim().split(' ');
                                                let fwName = parts[0];
                                                let fwVersi = parts.slice(1).join(' ');
                                                
                                                for (let i = 2; i <= parts.length; i++) {
                                                    const testName = parts.slice(0, i).join(' ');
                                                    const foundFw = this.fwData.find(f => f.name.toLowerCase() === testName.toLowerCase());
                                                    if (foundFw) {
                                                        fwName = testName;
                                                        fwVersi = parts.slice(i).join(' ');
                                                        break;
                                                    }
                                                }
                                                
                                                const foundFw = this.fwData.find(f => f.name.toLowerCase() === fwName.toLowerCase());
                                                if (foundFw) {
                                                    this.selectFw(foundFw);
                                                } else {
                                                    this.fwSearch = this.normalizeFwName(fwName);
                                                    this.selectNewFw();
                                                }
                                                
                                                this.$nextTick(() => {
                                                    if (fwVersi) {
                                                        const versiExists = this.versiFwResults.some(v => v.toLowerCase() === fwVersi.toLowerCase());
                                                        if (versiExists) {
                                                            this.selectVersiFw(fwVersi);
                                                        } else {
                                                            this.versiFwSearch = fwVersi.trim();
                                                            this.selectNewVersiFw();
                                                        }
                                                    }
                                                });
                                            },
                                            
                                            updateFrameworkValue() {
                                                let parts = this.addedFrameworks.map(f => f.name + ' ' + f.version);
                                                if (this.selectedFw && this.selectedVersiFw) {
                                                    parts.push(this.selectedFw + ' ' + this.selectedVersiFw);
                                                } else if (this.selectedFw) {
                                                    parts.push(this.selectedFw);
                                                }
                                                this.frameworkValue = parts.join(', ');
                                            },
                                            
                                            addCurrentFramework() {
                                                if (this.selectedFw && this.selectedVersiFw) {
                                                    // Check for duplicate (by framework name only)
                                                    const isDuplicate = this.addedFrameworks.some(f => 
                                                        f.name.toLowerCase() === this.selectedFw.toLowerCase()
                                                    );
                                                    if (isDuplicate) {
                                                        this.duplicateError = 'Framework ' + this.selectedFw + ' sudah ditambahkan!';
                                                        this.isTransitioning = false;
                                                        setTimeout(() => { this.duplicateError = ''; }, 3000);
                                                        return;
                                                    }
                                                    this.duplicateError = '';
                                                    this.addedFrameworks.push({
                                                        name: this.selectedFw,
                                                        version: this.selectedVersiFw
                                                    });
                                                    this.selectedFwId = null;
                                                    this.selectedFw = null;
                                                    this.isNewFw = false;
                                                    this.fwSearch = '';
                                                    this.fwResults = [];
                                                    this.fwOpen = false;
                                                    this.fwHighlightedIndex = -1;
                                                    this.selectedVersiFw = null;
                                                    this.isNewVersiFw = false;
                                                    this.versiFwSearch = '';
                                                    this.versiFwResults = [];
                                                    this.versiFwOpen = false;
                                                    this.versiFwHighlightedIndex = -1;
                                                    this.showPicker = false;
                                                    this.updateFrameworkValue();
                                                }
                                            },
                                            
                                            removeFramework(index) {
                                                this.addedFrameworks.splice(index, 1);
                                                this.updateFrameworkValue();
                                                if (this.addedFrameworks.length === 0) {
                                                    this.showPicker = true;
                                                }
                                            },
                                            
                                            // ===== Framework Methods =====
                                            onFwSearch() {
                                                this.selectedFwId = null;
                                                this.isNewFw = false;
                                                this.fwHighlightedIndex = -1;
                                                
                                                if (this.fwSearch.length < 1) {
                                                    this.fwResults = [];
                                                    this.fwOpen = false;
                                                    this.updateFrameworkValue();
                                                    return;
                                                }
                                                
                                                const query = this.fwSearch.toLowerCase();
                                                const addedNames = this.addedFrameworks.map(f => f.name.toLowerCase());
                                                this.fwResults = this.fwData
                                                    .filter(fw => fw.name.toLowerCase().includes(query))
                                                    .filter(fw => !addedNames.includes(fw.name.toLowerCase()))
                                                    .slice(0, 10);
                                                
                                                this.checkFwExactMatch();
                                                this.fwOpen = true;
                                                this.updateFrameworkValue();
                                            },
                                            
                                            checkFwExactMatch() {
                                                this.fwExactMatch = this.fwResults.some(fw => 
                                                    fw.name.toLowerCase() === this.fwSearch.toLowerCase()
                                                );
                                            },
                                            
                                            selectFw(fw) {
                                                this.selectedFwId = fw.name;
                                                this.selectedFw = fw.name;
                                                this.fwSearch = fw.name;
                                                this.isNewFw = false;
                                                this.fwOpen = false;
                                                this.fwHighlightedIndex = -1;
                                                this.updateVersiFwOptions();
                                                this.updateFrameworkValue();
                                            },
                                            
                                            selectNewFw() {
                                                const normalized = this.normalizeFwName(this.fwSearch);
                                                this.selectedFwId = null;
                                                this.selectedFw = normalized;
                                                this.isNewFw = true;
                                                this.fwSearch = normalized;
                                                this.fwOpen = false;
                                                this.fwHighlightedIndex = -1;
                                                this.versiFwResults = [];
                                                this.updateFrameworkValue();
                                            },
                                            
                                            clearFw() {
                                                this.selectedFwId = null;
                                                this.selectedFw = null;
                                                this.isNewFw = false;
                                                this.fwSearch = '';
                                                this.fwResults = [];
                                                this.fwOpen = false;
                                                this.clearVersiFw();
                                            },
                                            
                                            highlightNextFw() {
                                                const maxIndex = this.fwResults.length + (this.fwSearch && !this.fwExactMatch ? 0 : -1);
                                                if (this.fwHighlightedIndex < maxIndex) {
                                                    this.fwHighlightedIndex++;
                                                }
                                            },
                                            
                                            highlightPrevFw() {
                                                if (this.fwHighlightedIndex > 0) {
                                                    this.fwHighlightedIndex--;
                                                }
                                            },
                                            
                                            selectHighlightedFw() {
                                                if (this.fwHighlightedIndex >= 0 && this.fwHighlightedIndex < this.fwResults.length) {
                                                    this.selectFw(this.fwResults[this.fwHighlightedIndex]);
                                                } else if (this.fwHighlightedIndex === this.fwResults.length && this.fwSearch && !this.fwExactMatch) {
                                                    this.selectNewFw();
                                                }
                                            },
                                            
                                            normalizeFwName(name) {
                                                const trimmed = name.trim();
                                                if (!trimmed) return '';
                                                
                                                const specialCases = {
                                                    'laravel': 'Laravel',
                                                    'codeigniter': 'CodeIgniter',
                                                    'ci': 'CodeIgniter',
                                                    'symfony': 'Symfony',
                                                    'django': 'Django',
                                                    'flask': 'Flask',
                                                    'express': 'Express.js',
                                                    'expressjs': 'Express.js',
                                                    'next': 'Next.js',
                                                    'nextjs': 'Next.js',
                                                    'nuxt': 'Nuxt.js',
                                                    'nuxtjs': 'Nuxt.js',
                                                    'react': 'React',
                                                    'reactjs': 'React',
                                                    'vue': 'Vue.js',
                                                    'vuejs': 'Vue.js',
                                                    'angular': 'Angular',
                                                    'svelte': 'Svelte',
                                                    'spring': 'Spring Boot',
                                                    'springboot': 'Spring Boot',
                                                    'rails': 'Ruby on Rails',
                                                    'rubyonrails': 'Ruby on Rails',
                                                    'aspnet': 'ASP.NET Core',
                                                    'dotnet': 'ASP.NET Core',
                                                    'fastapi': 'FastAPI',
                                                    'nestjs': 'NestJS',
                                                    'gin': 'Go Gin',
                                                    'flutter': 'Flutter',
                                                    'reactnative': 'React Native',
                                                    'bootstrap': 'Bootstrap',
                                                    'tailwind': 'Tailwind CSS',
                                                    'tailwindcss': 'Tailwind CSS',
                                                };
                                                
                                                const lower = trimmed.toLowerCase();
                                                if (specialCases[lower]) {
                                                    return specialCases[lower];
                                                }
                                                
                                                return trimmed
                                                    .toLowerCase()
                                                    .split(/[\s\-_]+/)
                                                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                                                    .join(' ');
                                            },
                                            
                                            // ===== Versi Framework Methods =====
                                            updateVersiFwOptions() {
                                                const fw = this.fwData.find(f => f.name === this.selectedFw);
                                                if (fw) {
                                                    this.versiFwResults = fw.versions;
                                                } else {
                                                    this.versiFwResults = [];
                                                }
                                            },
                                            
                                            onVersiFwSearch() {
                                                this.selectedVersiFw = null;
                                                this.isNewVersiFw = false;
                                                this.versiFwHighlightedIndex = -1;
                                                
                                                if (this.versiFwSearch.length < 1) {
                                                    this.versiFwResults = this.getCurrentFwVersions();
                                                    this.versiFwOpen = false;
                                                    this.updateFrameworkValue();
                                                    return;
                                                }
                                                
                                                const query = this.versiFwSearch.toLowerCase();
                                                const allVersions = this.getCurrentFwVersions();
                                                
                                                this.versiFwResults = allVersions.filter(v => 
                                                    v.toLowerCase().includes(query)
                                                );
                                                
                                                this.checkVersiFwExactMatch();
                                                this.versiFwOpen = true;
                                                this.updateFrameworkValue();
                                            },
                                            
                                            getCurrentFwVersions() {
                                                if (this.isNewFw) return [];
                                                const fw = this.fwData.find(f => f.name === this.selectedFw);
                                                return fw ? fw.versions : [];
                                            },
                                            
                                            checkVersiFwExactMatch() {
                                                this.versiFwExactMatch = this.versiFwResults.some(versi => 
                                                    versi.toLowerCase() === this.versiFwSearch.toLowerCase()
                                                );
                                            },
                                            
                                            selectVersiFw(versi) {
                                                this.selectedVersiFw = versi;
                                                this.versiFwSearch = versi;
                                                this.isNewVersiFw = false;
                                                this.versiFwOpen = false;
                                                this.versiFwHighlightedIndex = -1;
                                                this.updateFrameworkValue();
                                            },
                                            
                                            selectNewVersiFw() {
                                                this.selectedVersiFw = this.versiFwSearch;
                                                this.isNewVersiFw = true;
                                                this.versiFwOpen = false;
                                                this.versiFwHighlightedIndex = -1;
                                                this.updateFrameworkValue();
                                            },
                                            
                                            clearVersiFw() {
                                                this.selectedVersiFw = null;
                                                this.isNewVersiFw = false;
                                                this.versiFwSearch = '';
                                                this.versiFwResults = this.getCurrentFwVersions();
                                                this.versiFwOpen = false;
                                                this.updateFrameworkValue();
                                            },
                                            
                                            highlightNextVersiFw() {
                                                const maxIndex = this.versiFwResults.length + (this.versiFwSearch && !this.versiFwExactMatch ? 0 : -1);
                                                if (this.versiFwHighlightedIndex < maxIndex) {
                                                    this.versiFwHighlightedIndex++;
                                                }
                                            },
                                            
                                            highlightPrevVersiFw() {
                                                if (this.versiFwHighlightedIndex > 0) {
                                                    this.versiFwHighlightedIndex--;
                                                }
                                            },
                                            
                                            selectHighlightedVersiFw() {
                                                if (this.versiFwHighlightedIndex >= 0 && this.versiFwHighlightedIndex < this.versiFwResults.length) {
                                                    this.selectVersiFw(this.versiFwResults[this.versiFwHighlightedIndex]);
                                                } else if (this.versiFwHighlightedIndex === this.versiFwResults.length && this.versiFwSearch && !this.versiFwExactMatch) {
                                                    this.selectNewVersiFw();
                                                }
                                            }
                                        }
                                    }
                                </script>
                            </div>
                            
                            <div class="md:col-span-2" x-data="librarySelectorEdit()" x-init="init()">
                                <x-input-label for="daftar_library_package" :value="__('Filelist libraly / Package yang terinstall pada sistem *')" />
                                <style>
                                    @keyframes libBadgeEnter {
                                        0% { opacity: 0; transform: scale(0.5) translateY(8px); }
                                        50% { transform: scale(1.08) translateY(-2px); }
                                        100% { opacity: 1; transform: scale(1) translateY(0); }
                                    }
                                    .lib-badge-enter { animation: libBadgeEnter 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
                                </style>
                                <div class="bg-violet-50/50 dark:bg-violet-900/20 p-4 rounded-xl border border-violet-100 dark:border-violet-800/30 mt-1 transition-all duration-300">

                                    <!-- Guide Toggle -->
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-semibold text-violet-500 dark:text-violet-400 uppercase tracking-wider">Pilih Library / Package</span>
                                        <button type="button" @click="showGuide = !showGuide"
                                            class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-lg transition-all"
                                            :class="showGuide ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-white/60 dark:bg-zinc-800/60 text-gray-500 dark:text-gray-400 hover:text-violet-600 dark:hover:text-violet-400 hover:bg-white dark:hover:bg-zinc-800'">
                                            <i class="fa-solid fa-circle-question w-3.5 h-3.5 flex items-center justify-center"></i>
                                            <span x-text="showGuide ? 'Tutup Panduan' : 'Cara Pengisian'"></span>
                                        </button>
                                    </div>

                                    <!-- Collapsible Guide -->
                                    <div x-show="showGuide" x-collapse
                                        class="mb-4 p-3 rounded-lg bg-amber-50/80 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30">
                                        <div class="space-y-3 text-xs text-gray-700 dark:text-gray-300">
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-violet-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">1</span>
                                                <div>
                                                    <span>Ketik nama library/package di kolom pencarian. Contoh:</span>
                                                    <div class="mt-1.5 flex items-center gap-1.5">
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white dark:bg-zinc-800 border border-gray-300 dark:border-zinc-600 text-[11px] text-gray-400 italic">Spatie...</span>
                                                        <span class="text-gray-400">→</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-300 text-[11px] font-medium">Spatie Permission</span>
                                                    </div>
                                                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Pilih dari daftar, atau klik tombol hijau <strong class="text-emerald-600 dark:text-emerald-400">"Tambah: [nama]"</strong> jika tidak ada.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-blue-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">2</span>
                                                <div>
                                                    <span>Pilih <strong>versi</strong> library di kolom sebelah kanan:</span>
                                                    <div class="mt-1.5 flex items-center gap-1.5">
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-violet-100 dark:bg-violet-900/40 text-violet-700 dark:text-violet-300 text-[11px] font-medium">Spatie Permission</span>
                                                        <span class="text-gray-400">→</span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 text-[11px] font-medium">6.x</span>
                                                    </div>
                                                    <p class="mt-1 text-[11px] text-gray-500 dark:text-gray-400">Setelah memilih versi, library otomatis masuk ke daftar.</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">3</span>
                                                <span>Untuk menambah library lain, klik tombol <strong>"➕ Tambah Library Lain"</strong></span>
                                            </div>
                                            <div class="flex items-start gap-2">
                                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-red-400 text-white flex items-center justify-center text-[10px] font-bold mt-0.5">✕</span>
                                                <span>Untuk menghapus, klik tombol <strong>✕</strong> pada badge library</span>
                                            </div>
                                            <div class="mt-2 pt-2 border-t border-amber-200/60 dark:border-amber-800/30 text-[11px] text-amber-700 dark:text-amber-400 flex items-center gap-1.5">
                                                <i class="fa-solid fa-circle-info w-3.5 h-3.5 flex-shrink-0"></i>
                                                <span>Setiap library hanya bisa ditambahkan <strong>satu kali</strong>.</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Search Input Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3" x-show="showPicker"
                                        x-transition:enter="transition ease-out duration-400"
                                        x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave="transition ease-in-out duration-300"
                                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                                    >
                                        <!-- Library Search (Left) -->
                                        <div class="relative">
                                            <label class="block text-xs font-semibold text-violet-700 dark:text-violet-400 mb-1.5 flex items-center gap-1">
                                                <i class="fa-solid fa-layer-group w-3.5 h-3.5 flex items-center justify-center"></i>
                                                Library / Package
                                            </label>
                                            <div class="relative">
                                                <input type="text"
                                                    x-model="libSearch"
                                                    @input="onLibSearch()"
                                                    @focus="if(libSearch.length >= 1) { onLibSearch(); libOpen = true; }"
                                                    @click.away="libOpen = false"
                                                    @keydown.arrow-down.prevent="libHighlightedIndex = Math.min(libHighlightedIndex + 1, libResults.length + (libSearch && !libExactMatch ? 0 : -1))"
                                                    @keydown.arrow-up.prevent="libHighlightedIndex = Math.max(libHighlightedIndex - 1, 0)"
                                                    @keydown.enter.prevent="selectHighlightedLib()"
                                                    class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-violet-500 dark:focus:border-violet-600 focus:ring-violet-500 dark:focus:ring-violet-600 shadow-sm text-sm py-2.5 px-3"
                                                    :class="{ 'bg-gray-50 dark:bg-zinc-800': selectedLib }"
                                                    placeholder="Cari atau tambah library..."
                                                    autocomplete="off"
                                                    :readonly="selectedLib !== null"
                                                >
                                                <!-- Clear Button -->
                                                <button type="button" x-show="selectedLib" @click="clearLib()"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                </button>
                                            </div>

                                            <!-- Dropdown Results -->
                                            <div x-show="libOpen && (libResults.length > 0 || (libSearch && !libExactMatch))"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 -translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                class="absolute z-30 w-full mt-1 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-56 overflow-y-auto">
                                                <template x-for="(lib, index) in libResults" :key="lib.name">
                                                    <div @click="selectLib(lib)"
                                                        class="px-4 py-2.5 cursor-pointer transition-all duration-150 flex items-center gap-3"
                                                        :class="{ 'bg-violet-50 dark:bg-violet-900/30': libHighlightedIndex === index, 'hover:bg-gray-50 dark:hover:bg-zinc-700/50': libHighlightedIndex !== index }">
                                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-violet-100 to-purple-100 dark:from-violet-900/40 dark:to-purple-900/40 flex items-center justify-center">
                                                            <i class="fa-solid fa-layer-group w-4 h-4 text-violet-600 dark:text-violet-400 flex items-center justify-center"></i>
                                                        </div>
                                                        <div>
                                                            <span class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="lib.name"></span>

                                                        </div>
                                                    </div>
                                                </template>

                                                <!-- Add New Library Option -->
                                                <div 
                                                    x-show="libSearch && !libExactMatch && !addedLibs.some(l => l.name.toLowerCase() === libSearch.toLowerCase())"
                                                    @click="selectNewLib()"
                                                    class="px-4 py-3 cursor-pointer border-t border-gray-200 dark:border-zinc-600 transition-all duration-150"
                                                    :class="{ 'bg-emerald-50 dark:bg-emerald-900/20': libHighlightedIndex === libResults.length }">
                                                    <div class="flex items-center gap-2">
                                                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-100 to-green-100 dark:from-emerald-900/40 dark:to-green-900/40 flex items-center justify-center">
                                                            <i class="fa-solid fa-plus w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                        </span>
                                                        <div>
                                                            <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                                Tambah: "<span x-text="libSearch"></span>"
                                                            </div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Library belum terdaftar di sistem, klik untuk menambahkan</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Version Search (Right) -->
                                        <div class="relative" x-show="selectedLib" x-transition>
                                            <label class="block text-xs font-semibold text-blue-700 dark:text-blue-400 mb-1.5 flex items-center gap-1">
                                                <i class="fa-solid fa-star w-3.5 h-3.5 flex items-center justify-center"></i>
                                                Versi Library
                                            </label>
                                            <div class="relative">
                                                <input type="text"
                                                    x-model="versiLibSearch"
                                                    @input="onVersiLibSearch()"
                                                    @focus=""
                                                    @click.away="versiLibOpen = false"
                                                    @keydown.arrow-down.prevent="versiLibHighlightedIndex = Math.min(versiLibHighlightedIndex + 1, versiLibResults.length + (versiLibSearch && !versiLibExactMatch ? 0 : -1))"
                                                    @keydown.arrow-up.prevent="versiLibHighlightedIndex = Math.max(versiLibHighlightedIndex - 1, 0)"
                                                    @keydown.enter.prevent="selectHighlightedVersiLib()"
                                                    class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 shadow-sm text-sm py-2.5 px-3"
                                                    placeholder="Pilih atau ketik versi..."
                                                    autocomplete="off"
                                                >
                                                <!-- Clear Button -->
                                                <button type="button" x-show="versiLibSearch" @click="clearVersiLib()"
                                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                                </button>
                                            </div>

                                            <!-- Version Dropdown -->
                                            <div x-show="versiLibOpen && (versiLibResults.length > 0 || (versiLibSearch && !versiLibExactMatch))"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 -translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                class="absolute z-30 w-full mt-1 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-48 overflow-y-auto">
                                                <template x-for="(versi, index) in versiLibResults" :key="versi">
                                                    <div @click="selectVersiLib(versi)"
                                                        class="px-4 py-2.5 cursor-pointer transition-all duration-150 flex items-center gap-3"
                                                        :class="{ 'bg-blue-50 dark:bg-blue-900/30': versiLibHighlightedIndex === index, 'hover:bg-gray-50 dark:hover:bg-zinc-700/50': versiLibHighlightedIndex !== index }">
                                                        <span class="flex-shrink-0 w-6 h-6 rounded-md bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                                            <i class="fa-solid fa-star w-3.5 h-3.5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                                                        </span>
                                                        <span class="text-sm font-medium text-slate-800 dark:text-slate-200" x-text="versi"></span>
                                                    </div>
                                                </template>

                                                <!-- Add New Version -->
                                                <div x-show="versiLibSearch && !versiLibExactMatch"
                                                    @click="selectNewVersiLib()"
                                                    class="px-4 py-3 cursor-pointer border-t border-gray-200 dark:border-zinc-600 transition-all duration-150"
                                                    :class="{ 'bg-emerald-50 dark:bg-emerald-900/20': versiLibHighlightedIndex === versiLibResults.length }">
                                                    <div class="flex items-center gap-2">
                                                        <span class="flex-shrink-0 w-6 h-6 rounded-md bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center">
                                                            <i class="fa-solid fa-plus w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                        </span>
                                                        <div>
                                                            <span class="text-sm font-medium text-emerald-700 dark:text-emerald-400">Tambah Versi: "<span x-text="versiLibSearch"></span>"</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Added Libraries Badges -->
                                    <div class="flex flex-wrap gap-2 mt-3" x-show="addedLibs.length > 0">
                                        <template x-for="(lib, index) in addedLibs" :key="index">
                                            <span class="lib-badge-enter inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-gradient-to-r from-violet-100 to-purple-100 dark:from-violet-900/40 dark:to-purple-900/40 text-violet-800 dark:text-violet-300 border border-violet-200 dark:border-violet-800/30 shadow-sm">
                                                <span x-text="lib.name + ' ' + lib.version"></span>
                                                <button type="button" @click="removeLib(index)"
                                                    class="ml-0.5 text-violet-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-full p-0.5 transition-colors">
                                                    <i class="fa-solid fa-star w-3.5 h-3.5 flex items-center justify-center"></i>
                                                </button>
                                            </span>
                                        </template>
                                    </div>

                                    <!-- Duplicate Error -->
                                    <div x-show="duplicateError" x-transition
                                        class="mt-2 px-3 py-2 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-600 dark:text-red-400 text-xs font-medium flex items-center gap-2">
                                        <i class="fa-solid fa-circle-exclamation w-4 h-4 flex-shrink-0"></i>
                                        <span x-text="duplicateError"></span>
                                    </div>

                                    <!-- Add More Button -->
                                    <div x-show="!showPicker && addedLibs.length > 0" class="mt-3"
                                        x-transition:enter="transition ease-out duration-300 delay-150"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0">
                                        <button type="button" @click="showPicker = true"
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 text-emerald-700 dark:text-emerald-400 text-sm font-bold rounded-xl border border-emerald-200 dark:border-emerald-800/30 hover:from-emerald-100 hover:to-teal-100 dark:hover:from-emerald-900/40 dark:hover:to-teal-900/40 hover:border-emerald-300 dark:hover:border-emerald-700 hover:shadow-md transition-all shadow-sm">
                                            <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                            Tambah Library Lain
                                        </button>
                                    </div>

                                    <input type="hidden" name="daftar_library_package" x-model="libValue">
                                    
                                    <p class="mt-3 text-xs text-violet-600 dark:text-violet-400 flex items-start gap-1">
                                        <i class="fa-solid fa-circle-info w-4 h-4 flex-shrink-0 mt-0.5"></i>
                                        <span><strong>Hasil:</strong> <span x-text="libValue || 'Belum dipilih'"></span></span>
                                    </p>
                                </div>
                                <x-input-error :messages="$errors->get('daftar_library_package')" class="mt-2" />

                                <!-- Alpine.js Component Script for Library (Edit) -->
                                <script>
                                    function librarySelectorEdit() {
                                        return {
                                            libData: @json($libOptions),
                                            
                                            libSearch: '', libResults: [], libOpen: false,
                                            libHighlightedIndex: -1, libExactMatch: false,
                                            selectedLib: null, isNewLib: false,
                                            
                                            versiLibSearch: '', versiLibResults: [], versiLibOpen: false,
                                            versiLibHighlightedIndex: -1, versiLibExactMatch: false,
                                            selectedVersiLib: null, isNewVersiLib: false,
                                            
                                            libValue: '', addedLibs: [], showPicker: true,
                                            duplicateError: '', showGuide: false,
                                            
                                            init() {
                                                this.$watch('selectedLib', (value) => {
                                                    if (value) {
                                                        this.clearVersiLib();
                                                        this.updateVersiLibOptions();
                                                        this.updateLibValue();
                                                    }
                                                });
                                                this.$watch('selectedVersiLib', (value) => {
                                                    if (value) { this.updateLibValue(); this.addCurrentLib(); }
                                                });

                                                // Parse existing data
                                                const existing = @json(old('daftar_library_package', $webApp->daftar_library_package ?? ''));
                                                if (existing) {
                                                    const parts = existing.split(',').map(p => p.trim()).filter(p => p);
                                                    parts.forEach(part => {
                                                        const parsed = this.parseLibraryEntry(part);
                                                        this.addedLibs.push(parsed);
                                                    });
                                                    if (this.addedLibs.length > 0) this.showPicker = false;
                                                    this.updateLibValue();
                                                }
                                            },

                                            parseLibraryEntry(entry) {
                                                const parts = entry.trim().split(' ');
                                                let libName = parts[0];
                                                let libVersi = parts.slice(1).join(' ');
                                                
                                                // Check for multi-word library names
                                                for (let i = 2; i <= parts.length; i++) {
                                                    const testName = parts.slice(0, i).join(' ');
                                                    const foundLib = this.libData.find(l => l.name.toLowerCase() === testName.toLowerCase());
                                                    if (foundLib) {
                                                        libName = testName;
                                                        libVersi = parts.slice(i).join(' ');
                                                        break;
                                                    }
                                                }
                                                
                                                const foundLib = this.libData.find(l => l.name.toLowerCase() === libName.toLowerCase());
                                                return {
                                                    name: foundLib ? foundLib.name : libName.trim().split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' '),
                                                    version: libVersi || ''
                                                };
                                            },

                                            updateLibValue() {
                                                this.libValue = this.addedLibs.map(l => l.name + (l.version ? ' ' + l.version : '')).join(', ');
                                            },

                                            addCurrentLib() {
                                                if (this.selectedLib && this.selectedVersiLib) {
                                                    const isDuplicate = this.addedLibs.some(l => l.name.toLowerCase() === this.selectedLib.toLowerCase());
                                                    if (isDuplicate) {
                                                        this.duplicateError = this.selectedLib + ' sudah ditambahkan!';
                                                        setTimeout(() => { this.duplicateError = ''; }, 3000);
                                                        this.clearLib();
                                                        return;
                                                    }
                                                    this.duplicateError = '';
                                                    this.addedLibs.push({ name: this.selectedLib, version: this.selectedVersiLib });
                                                    this.clearLib();
                                                    this.showPicker = false;
                                                    this.updateLibValue();
                                                }
                                            },

                                            selectLib(lib) {
                                                this.selectedLib = lib.name;
                                                this.libSearch = lib.name;
                                                this.isNewLib = false;
                                                this.libOpen = false;
                                                this.libHighlightedIndex = -1;
                                                this.updateVersiLibOptions();
                                            },

                                            selectNewLib() {
                                                const normalized = this.libSearch.trim().split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
                                                this.selectedLib = normalized;
                                                this.libSearch = normalized;
                                                this.isNewLib = true;
                                                this.libOpen = false;
                                                this.libHighlightedIndex = -1;
                                            },

                                            clearLib() {
                                                this.selectedLib = null;
                                                this.libSearch = '';
                                                this.isNewLib = false;
                                                this.libResults = [];
                                                this.libOpen = false;
                                                this.libHighlightedIndex = -1;
                                                this.clearVersiLib();
                                            },

                                            removeLib(index) {
                                                this.addedLibs.splice(index, 1);
                                                this.updateLibValue();
                                                if (this.addedLibs.length === 0) this.showPicker = true;
                                            },

                                            onLibSearch() {
                                                this.libHighlightedIndex = -1;
                                                this.selectedLib = null;
                                                this.isNewLib = false;
                                                this.clearVersiLib();
                                                if (this.libSearch.length < 1) { this.libResults = []; this.libOpen = false; return; }
                                                const query = this.libSearch.toLowerCase();
                                                const addedNames = this.addedLibs.map(l => l.name.toLowerCase());
                                                this.libResults = this.libData
                                                    .filter(l => l.name.toLowerCase().includes(query))
                                                    .filter(l => !addedNames.includes(l.name.toLowerCase()))
                                                    .slice(0, 10);
                                                this.libExactMatch = this.libResults.some(l => l.name.toLowerCase() === query);
                                                this.libOpen = true;
                                            },

                                            selectHighlightedLib() {
                                                if (this.libHighlightedIndex >= 0 && this.libHighlightedIndex < this.libResults.length) {
                                                    this.selectLib(this.libResults[this.libHighlightedIndex]);
                                                } else if (this.libHighlightedIndex === this.libResults.length && this.libSearch && !this.libExactMatch) {
                                                    this.selectNewLib();
                                                }
                                            },

                                            // Version methods
                                            updateVersiLibOptions() {
                                                const found = this.libData.find(l => l.name.toLowerCase() === (this.selectedLib || '').toLowerCase());
                                                if (found) {
                                                    this.versiLibResults = [...found.versions];
                                                } else {
                                                    this.versiLibResults = [];
                                                }
                                                this.versiLibOpen = this.versiLibResults.length > 0 && this.versiLibSearch.length > 0;
                                                this.versiLibHighlightedIndex = -1;
                                                this.versiLibExactMatch = false;
                                            },

                                            onVersiLibSearch() {
                                                this.versiLibHighlightedIndex = -1;
                                                this.selectedVersiLib = null;
                                                this.isNewVersiLib = false;
                                                const found = this.libData.find(l => l.name.toLowerCase() === (this.selectedLib || '').toLowerCase());
                                                const versions = found ? found.versions : [];
                                                if (this.versiLibSearch.length < 1) {
                                                    this.versiLibResults = [...versions];
                                                } else {
                                                    const q = this.versiLibSearch.toLowerCase();
                                                    this.versiLibResults = versions.filter(v => v.toLowerCase().includes(q));
                                                    this.versiLibExactMatch = this.versiLibResults.some(v => v.toLowerCase() === q);
                                                }
                                                this.versiLibOpen = true;
                                            },

                                            selectVersiLib(versi) {
                                                this.selectedVersiLib = versi;
                                                this.versiLibSearch = versi;
                                                this.isNewVersiLib = false;
                                                this.versiLibOpen = false;
                                                this.versiLibHighlightedIndex = -1;
                                            },

                                            selectNewVersiLib() {
                                                this.selectedVersiLib = this.versiLibSearch.trim();
                                                this.versiLibSearch = this.selectedVersiLib;
                                                this.isNewVersiLib = true;
                                                this.versiLibOpen = false;
                                                this.versiLibHighlightedIndex = -1;
                                            },

                                            clearVersiLib() {
                                                this.selectedVersiLib = null;
                                                this.versiLibSearch = '';
                                                this.isNewVersiLib = false;
                                                this.versiLibResults = [];
                                                this.versiLibOpen = false;
                                                this.versiLibHighlightedIndex = -1;
                                                this.versiLibExactMatch = false;
                                            },

                                            selectHighlightedVersiLib() {
                                                if (this.versiLibHighlightedIndex >= 0 && this.versiLibHighlightedIndex < this.versiLibResults.length) {
                                                    this.selectVersiLib(this.versiLibResults[this.versiLibHighlightedIndex]);
                                                } else if (this.versiLibHighlightedIndex === this.versiLibResults.length && this.versiLibSearch && !this.versiLibExactMatch) {
                                                    this.selectNewVersiLib();
                                                }
                                            }
                                        }
                                    }
                                </script>
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
                            <i class="fa-solid fa-star h-5 w-5 text-amber-500 dark:text-amber-400 mt-0.5 flex-shrink-0"></i>
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
                <div class="bg-white dark:bg-zinc-900/50 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-zinc-800 backdrop-blur-sm" x-data="dbmsSelectorEdit()" x-init="init()">
                    <div class="relative">
                        <div class="flex items-center gap-3 mb-6 border-b border-slate-100 dark:border-zinc-800 pb-4">
                            <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-800 text-white flex items-center justify-center font-bold text-sm shadow-md">5</span>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Database</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Spesifikasi penyimpanan data.</p>
                            </div>
                        </div>

                        <!-- Panduan Penggunaan DBMS -->
                        <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/30 rounded-xl p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-star w-5 h-5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                                <span class="font-semibold text-sm text-gray-800 dark:text-gray-200">Panduan Pengisian DBMS</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                                <!-- Langkah 1 -->
                                <div class="flex items-start gap-2 bg-white dark:bg-zinc-800/50 p-2.5 rounded-lg">
                                    <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-white font-bold text-[10px]">1</span>
                                    </div>
                                    <div class="text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Pilih Jenis DBMS</span>
                                        <p class="mt-0.5">Ketik nama DBMS → pilih dari daftar atau tambah baru jika tidak ada</p>
                                    </div>
                                </div>
                                <!-- Langkah 2 -->
                                <div class="flex items-start gap-2 bg-white dark:bg-zinc-800/50 p-2.5 rounded-lg">
                                    <div class="w-5 h-5 rounded-full bg-purple-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <span class="text-white font-bold text-[10px]">2</span>
                                    </div>
                                    <div class="text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">Pilih Versi</span>
                                        <p class="mt-0.5">Setelah DBMS terpilih, pilih versi yang tersedia atau tambah versi custom</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Jenis DBMS Autocomplete -->
                            <div class="relative">
                                <x-input-label for="dbms_search" :value="__('Jenis DBMS *')" />
                                <div class="relative mt-1">
                                    <input 
                                        type="text" 
                                        id="dbms_search" 
                                        x-model="dbmsSearch"
                                        @input="onDbmsSearch()"
                                        @focus=""
                                        @keydown.escape="dbmsOpen = false"
                                        @keydown.arrow-down.prevent="highlightNextDbms()"
                                        @keydown.arrow-up.prevent="highlightPrevDbms()"
                                        @keydown.enter.prevent="selectHighlightedDbms()"
                                        class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm py-2.5 px-3"
                                        :class="{ 'ring-red-300': dbmsError, 'bg-gray-50 dark:bg-zinc-800': selectedDbms }"
                                        :placeholder="selectedDbms ? selectedDbms : 'Ketik untuk mencari DBMS...'"
                                        autocomplete="off"
                                    >
                                    <!-- Clear Button -->
                                    <button 
                                        type="button"
                                        x-show="selectedDbms"
                                        @click="clearDbms()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition-colors"
                                    >
                                        <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                    </button>
                                </div>

                                <!-- Dropdown DBMS -->
                                <div 
                                    x-show="dbmsOpen && (dbmsResults.length > 0 || (dbmsSearch && !selectedDbmsId))"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1"
                                    @click.outside="dbmsOpen = false"
                                    class="absolute z-50 mt-1 w-full bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 max-h-60 overflow-auto"
                                >
                                    <!-- Existing DBMS Results -->
                                    <template x-for="(dbms, index) in dbmsResults" :key="dbms.name">
                                        <div 
                                            @click="selectDbms(dbms)"
                                            @mouseenter="dbmsHighlightedIndex = index"
                                            :class="{ 
                                                'bg-blue-50 dark:bg-blue-900/30': dbmsHighlightedIndex === index,
                                                'border-l-4 border-blue-500': selectedDbmsId === dbms.name
                                            }"
                                            class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700 last:border-b-0 transition-colors"
                                        >
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center flex-shrink-0">
                                                    <i class="fa-solid fa-star w-4 h-4 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="dbms.name"></div>

                                                </div>
                                                <i class="fa-solid fa-star w-5 h-5 text-blue-600 flex items-center justify-center" x-show="selectedDbmsId === dbms.name"></i>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Add New DBMS Option -->
                                    <div 
                                        x-show="dbmsSearch && !dbmsExactMatch"
                                        @click="selectNewDbms()"
                                        @mouseenter="dbmsHighlightedIndex = dbmsResults.length"
                                        :class="{ 'bg-emerald-50 dark:bg-emerald-900/30': dbmsHighlightedIndex === dbmsResults.length }"
                                        class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-t border-gray-200 dark:border-zinc-600 transition-colors"
                                    >
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid fa-star w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                    Tambah: "<span x-text="dbmsSearch"></span>"
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">DBMS baru akan dibuat</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected DBMS Badge -->
                                <div x-show="selectedDbms && !isNewDbms" class="mt-2 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                        <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                        <span x-text="selectedDbms"></span>
                                    </span>
                                    <span class="text-xs text-gray-500">terpilih</span>
                                </div>

                                <!-- New DBMS Indicator -->
                                <div x-show="isNewDbms && dbmsSearch" class="mt-2 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-300">
                                        <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                        <span x-text="dbmsSearch"></span>
                                    </span>
                                    <span class="text-xs text-emerald-600">(DBMS Baru)</span>
                                </div>

                                <input type="hidden" name="dbms" x-model="dbmsValue" value="{{ old('dbms', $webApp->dbms) }}">
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Software database yang digunakan.</p>
                            </div>

                            <!-- Versi DBMS Autocomplete -->
                            <div class="relative" x-show="selectedDbms || isNewDbms" x-transition>
                                <x-input-label for="versi_dbms_search" :value="__('Versi DBMS *')" />
                                <div class="relative mt-1">
                                    <input 
                                        type="text" 
                                        id="versi_dbms_search" 
                                        x-model="versiSearch"
                                        @input="onVersiSearch()"
                                        @focus=""
                                        @keydown.escape="versiOpen = false"
                                        @keydown.arrow-down.prevent="highlightNextVersi()"
                                        @keydown.arrow-up.prevent="highlightPrevVersi()"
                                        @keydown.enter.prevent="selectHighlightedVersi()"
                                        class="block w-full rounded-xl border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm py-2.5 px-3"
                                        :class="{ 'bg-gray-50 dark:bg-zinc-800': selectedVersi }"
                                        :placeholder="selectedVersi ? selectedVersi : (selectedDbms ? 'Pilih versi ' + selectedDbms + '...' : 'Ketik versi DBMS...')"
                                        autocomplete="off"
                                        :disabled="!selectedDbms && !isNewDbms"
                                    >
                                    <!-- Clear Button -->
                                    <button 
                                        type="button"
                                        x-show="selectedVersi"
                                        @click="clearVersi()"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-red-500 transition-colors"
                                    >
                                        <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                    </button>
                                </div>

                                <!-- Dropdown Versi -->
                                <div 
                                    x-show="versiOpen && (versiResults.length > 0 || (versiSearch && !selectedVersi && (selectedDbms || isNewDbms)))"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration 150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1"
                                    @click.outside="versiOpen = false"
                                    class="absolute z-50 mt-1 w-full bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-gray-200 dark:border-zinc-700 max-h-60 overflow-auto"
                                >
                                    <!-- Existing Versi Results -->
                                    <template x-for="(versi, index) in versiResults" :key="versi">
                                        <div 
                                            @click="selectVersi(versi)"
                                            @mouseenter="versiHighlightedIndex = index"
                                            :class="{ 
                                                'bg-blue-50 dark:bg-blue-900/30': versiHighlightedIndex === index,
                                                'border-l-4 border-blue-500': selectedVersi === versi
                                            }"
                                            class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-b border-gray-100 dark:border-zinc-700 last:border-b-0 transition-colors"
                                        >
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center flex-shrink-0">
                                                    <i class="fa-solid fa-star w-4 h-4 text-purple-600 dark:text-purple-400 flex items-center justify-center"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="versi"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">Versi tersedia</div>
                                                </div>
                                                <i class="fa-solid fa-star w-5 h-5 text-blue-600 flex items-center justify-center" x-show="selectedVersi === versi"></i>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Add New Versi Option -->
                                    <div 
                                        x-show="versiSearch && !versiExactMatch"
                                        @click="selectNewVersi()"
                                        @mouseenter="versiHighlightedIndex = versiResults.length"
                                        :class="{ 'bg-emerald-50 dark:bg-emerald-900/30': versiHighlightedIndex === versiResults.length }"
                                        class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-800 border-t border-gray-200 dark:border-zinc-600 transition-colors"
                                    >
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid fa-star w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                    Tambah Versi: "<span x-text="versiSearch"></span>"
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">Versi baru akan digunakan</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected Versi Badge -->
                                <div x-show="selectedVersi" class="mt-2 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/50 dark:text-purple-300">
                                        <i class="fa-solid fa-star w-4 h-4 flex items-center justify-center"></i>
                                        <span x-text="selectedVersi"></span>
                                    </span>
                                    <span x-show="!isNewVersi" class="text-xs text-gray-500">terpilih</span>
                                    <span x-show="isNewVersi" class="text-xs text-purple-600">(versi baru)</span>
                                </div>

                                <input type="hidden" name="versi_dbms" x-model="versiValue" value="{{ old('versi_dbms', $webApp->versi_dbms) }}">
                                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Versi perangkat lunak database.</p>
                            </div>

                            <div>
                                <x-input-label for="lokasi_database" :value="__('Lokasi Server DBMS *')" />
                                <select id="lokasi_database" name="lokasi_database" required class="block mt-1 w-full border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-slate-900 dark:text-slate-100 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm text-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="Server Kominfo" {{ old('lokasi_database', $webApp->lokasi_database) == 'Server Kominfo' ? 'selected' : '' }}>Server Kominfo</option>
                                    <option value="Lainnya" {{ old('lokasi_database', $webApp->lokasi_database) == 'Lainnya' ? 'selected' : '' }}>Lainnya (di luar Server Kominfo)</option>
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

                    <!-- Alpine.js Component Script -->
                    <script>
                        function dbmsSelectorEdit() {
                            return {
                                dbmsData: @json($dbmsOptions),
                                
                                // State DBMS
                                dbmsSearch: '',
                                dbmsResults: [],
                                selectedDbmsId: null,
                                selectedDbms: null,
                                isNewDbms: false,
                                dbmsValue: '',
                                dbmsOpen: false,
                                dbmsHighlightedIndex: -1,
                                dbmsError: false,
                                dbmsExactMatch: false,
                                
                                // State Versi
                                versiSearch: '',
                                versiResults: [],
                                selectedVersi: null,
                                isNewVersi: false,
                                versiValue: '',
                                versiOpen: false,
                                versiHighlightedIndex: -1,
                                versiExactMatch: false,
                                
                                init() {
                                    // Load existing values
                                    const existingDbms = '{{ old('dbms', $webApp->dbms) }}';
                                    const existingVersi = '{{ old('versi_dbms', $webApp->versi_dbms) }}';
                                    
                                    if (existingDbms) {
                                        const foundDbms = this.dbmsData.find(d => d.name.toLowerCase() === existingDbms.toLowerCase());
                                        if (foundDbms) {
                                            this.selectDbms(foundDbms);
                                        } else {
                                            // DBMS baru yang tidak ada di daftar - normalize dulu
                                            this.dbmsSearch = this.normalizeDbmsName(existingDbms);
                                            this.selectNewDbms();
                                        }
                                        
                                        // Set versi setelah DBMS terpilih
                                        this.$nextTick(() => {
                                            if (existingVersi) {
                                                const versiExists = this.versiResults.some(v => v === existingVersi);
                                                if (versiExists) {
                                                    this.selectVersi(existingVersi);
                                                } else {
                                                    this.versiSearch = existingVersi.trim();
                                                    this.selectNewVersi();
                                                }
                                            }
                                        });
                                    }
                                },
                                
                                // ===== Helper Methods =====
                                normalizeDbmsName(name) {
                                    const trimmed = name.trim();
                                    if (!trimmed) return '';
                                    
                                    const specialCases = {
                                        'mysql': 'MySQL',
                                        'mariadb': 'MariaDB',
                                        'postgresql': 'PostgreSQL',
                                        'postgres': 'PostgreSQL',
                                        'sqlserver': 'SQL Server',
                                        'sql server': 'SQL Server',
                                        'mongodb': 'MongoDB',
                                        'mongo': 'MongoDB',
                                        'sqlite': 'SQLite',
                                        'oracle': 'Oracle',
                                        'redis': 'Redis',
                                        'elasticsearch': 'Elasticsearch',
                                        'firebase': 'Firebase',
                                        'supabase': 'Supabase',
                                        'cockroachdb': 'CockroachDB',
                                        'cockroach': 'CockroachDB',
                                        'dynamodb': 'DynamoDB',
                                        'cassandra': 'Cassandra',
                                        'neo4j': 'Neo4j',
                                        'influxdb': 'InfluxDB',
                                    };
                                    
                                    const lower = trimmed.toLowerCase();
                                    if (specialCases[lower]) {
                                        return specialCases[lower];
                                    }
                                    
                                    return trimmed
                                        .toLowerCase()
                                        .split(/[\s\-_]+/)
                                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                                        .join(' ');
                                },
                                
                                // ===== DBMS Methods =====
                                onDbmsSearch() {
                                    this.selectedDbmsId = null;
                                    this.isNewDbms = false;
                                    this.dbmsValue = this.dbmsSearch;
                                    this.dbmsHighlightedIndex = -1;
                                    
                                    if (this.dbmsSearch.length < 1) {
                                        this.dbmsResults = [];
                                        this.dbmsOpen = false;
                                        return;
                                    }
                                    
                                    const query = this.dbmsSearch.toLowerCase();
                                    this.dbmsResults = this.dbmsData
                                        .filter(dbms => dbms.name.toLowerCase().includes(query))
                                        .slice(0, 10);
                                    
                                    this.checkDbmsExactMatch();
                                    this.dbmsOpen = true;
                                },
                                
                                checkDbmsExactMatch() {
                                    this.dbmsExactMatch = this.dbmsResults.some(dbms => 
                                        dbms.name.toLowerCase() === this.dbmsSearch.toLowerCase()
                                    );
                                },
                                
                                selectDbms(dbms) {
                                    this.selectedDbmsId = dbms.name;
                                    this.selectedDbms = dbms.name;
                                    this.dbmsSearch = dbms.name;
                                    this.dbmsValue = dbms.name;
                                    this.isNewDbms = false;
                                    this.dbmsOpen = false;
                                    this.dbmsHighlightedIndex = -1;
                                    this.updateVersiOptions();
                                },
                                
                                selectNewDbms() {
                                    const normalized = this.normalizeDbmsName(this.dbmsSearch);
                                    this.selectedDbmsId = null;
                                    this.selectedDbms = normalized;
                                    this.isNewDbms = true;
                                    this.dbmsValue = normalized;
                                    this.dbmsSearch = normalized;
                                    this.dbmsOpen = false;
                                    this.dbmsHighlightedIndex = -1;
                                    this.versiResults = [];
                                },
                                
                                clearDbms() {
                                    this.selectedDbmsId = null;
                                    this.selectedDbms = null;
                                    this.isNewDbms = false;
                                    this.dbmsSearch = '';
                                    this.dbmsValue = '';
                                    this.dbmsResults = [];
                                    this.clearVersi();
                                },
                                
                                highlightNextDbms() {
                                    const maxIndex = this.dbmsResults.length + (this.dbmsSearch && !this.dbmsExactMatch ? 0 : -1);
                                    if (this.dbmsHighlightedIndex < maxIndex) {
                                        this.dbmsHighlightedIndex++;
                                    }
                                },
                                
                                highlightPrevDbms() {
                                    if (this.dbmsHighlightedIndex > 0) {
                                        this.dbmsHighlightedIndex--;
                                    }
                                },
                                
                                selectHighlightedDbms() {
                                    if (this.dbmsHighlightedIndex >= 0 && this.dbmsHighlightedIndex < this.dbmsResults.length) {
                                        this.selectDbms(this.dbmsResults[this.dbmsHighlightedIndex]);
                                    } else if (this.dbmsHighlightedIndex === this.dbmsResults.length && this.dbmsSearch && !this.dbmsExactMatch) {
                                        this.selectNewDbms();
                                    }
                                },
                                
                                // ===== Versi Methods =====
                                updateVersiOptions() {
                                    const dbms = this.dbmsData.find(d => d.name === this.selectedDbms);
                                    if (dbms) {
                                        this.versiResults = dbms.versions;
                                    } else {
                                        this.versiResults = [];
                                    }
                                },
                                
                                onVersiSearch() {
                                    this.selectedVersi = null;
                                    this.isNewVersi = false;
                                    this.versiValue = this.versiSearch;
                                    this.versiHighlightedIndex = -1;
                                    
                                    if (this.versiSearch.length < 1) {
                                        this.versiResults = this.getCurrentDbmsVersions();
                                        this.versiOpen = false;
                                        return;
                                    }
                                    
                                    // Normalisasi query untuk search (v8.0 = 8.0 = V8.0)
                                    const normalizedQuery = this.normalizeVersion(this.versiSearch).toLowerCase();
                                    const allVersions = this.getCurrentDbmsVersions();
                                    
                                    // Filter dengan normalisasi
                                    this.versiResults = allVersions.filter(v => {
                                        const normalizedV = this.normalizeVersion(v).toLowerCase();
                                        return normalizedV.includes(normalizedQuery) || 
                                               v.toLowerCase().includes(this.versiSearch.toLowerCase());
                                    });
                                    
                                    this.checkVersiExactMatch();
                                    this.versiOpen = true;
                                },
                                
                                getCurrentDbmsVersions() {
                                    if (this.isNewDbms) return [];
                                    const dbms = this.dbmsData.find(d => d.name === this.selectedDbms);
                                    return dbms ? dbms.versions : [];
                                },
                                
                                checkVersiExactMatch() {
                                    const normalizedSearch = this.normalizeVersion(this.versiSearch).toLowerCase();
                                    this.versiExactMatch = this.versiResults.some(versi => {
                                        const normalizedVersi = this.normalizeVersion(versi).toLowerCase();
                                        return normalizedVersi === normalizedSearch;
                                    });
                                },
                                
                                selectVersi(versi) {
                                    this.selectedVersi = versi;
                                    this.versiSearch = versi;
                                    this.versiValue = versi;
                                    this.isNewVersi = false;
                                    this.versiOpen = false;
                                    this.versiHighlightedIndex = -1;
                                },
                                
                                normalizeVersion(version) {
                                    // SMART VERSION NORMALIZATION
                                    let normalized = version.trim();
                                    
                                    // STEP 1: Hapus prefix v, V, version, VERSION
                                    normalized = normalized.replace(/^(v|version)\s*/i, '');
                                    normalized = normalized.trim();
                                    
                                    // STEP 2: Khusus untuk "latest" → capitalize
                                    if (normalized.toLowerCase() === 'latest') {
                                        return 'Latest';
                                    }
                                    
                                    // STEP 3: Deteksi tipe versi
                                    const isYearVersion = /^\d{4}$/.test(normalized);
                                    const isOracleVersion = /^\d+c$/i.test(normalized);
                                    const isSemver = /^\d+(\.\d+)*$/.test(normalized);
                                    
                                    // STEP 4: Normalisasi berdasarkan tipe
                                    if (isYearVersion) {
                                        return normalized;
                                    }
                                    
                                    if (isOracleVersion) {
                                        return normalized.toLowerCase();
                                    }
                                    
                                    if (isSemver) {
                                        // Hapus leading zeros
                                        normalized = normalized.replace(/\b0+(\d)/g, '$1');
                                        
                                        // "8" → "8.0"
                                        if (/^\d+$/.test(normalized)) {
                                            normalized = normalized + '.0';
                                        }
                                        
                                        // "8.0.0" → "8.0"
                                        while (/\.0$/.test(normalized) && normalized.split('.').length > 2) {
                                            normalized = normalized.replace(/\.0$/, '');
                                        }
                                        
                                        return normalized;
                                    }
                                    
                                    return normalized.toLowerCase();
                                },
                                
                                selectNewVersi() {
                                    const normalized = this.normalizeVersion(this.versiSearch);
                                    this.selectedVersi = normalized;
                                    this.isNewVersi = true;
                                    this.versiValue = normalized;
                                    this.versiSearch = normalized;
                                    this.versiOpen = false;
                                    this.versiHighlightedIndex = -1;
                                },
                                
                                highlightNextVersi() {
                                    const maxIndex = this.versiResults.length + (this.versiSearch && !this.versiExactMatch ? 0 : -1);
                                    if (this.versiHighlightedIndex < maxIndex) {
                                        this.versiHighlightedIndex++;
                                    }
                                },
                                
                                highlightPrevVersi() {
                                    if (this.versiHighlightedIndex > 0) {
                                        this.versiHighlightedIndex--;
                                    }
                                },
                                
                                selectHighlightedVersi() {
                                    if (this.versiHighlightedIndex >= 0 && this.versiHighlightedIndex < this.versiResults.length) {
                                        this.selectVersi(this.versiResults[this.versiHighlightedIndex]);
                                    } else if (this.versiHighlightedIndex === this.versiResults.length && this.versiSearch && !this.versiExactMatch) {
                                        this.selectNewVersi();
                                    }
                                },
                                
                                clearVersi() {
                                    this.selectedVersi = null;
                                    this.isNewVersi = false;
                                    this.versiSearch = '';
                                    this.versiValue = '';
                                    this.versiResults = this.getCurrentDbmsVersions();
                                    this.versiOpen = false;
                                }
                            }
                        }
                    </script>
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
                        <i class="fa-solid fa-check w-5 h-5 mr-2 flex items-center justify-center"></i>
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
