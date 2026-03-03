<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi - Sistem Manajemen Data Aplikasi OPD</title>
    <link rel="icon" href="{{ asset(App\Models\SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; transition: background-color 0.4s ease, color 0.4s ease; }
        
        /* Dark Mode Styles - Premium Dark Theme */
        .dark body { background-color: #0a0f1a; color: #e2e8f0; }
        .dark .bg-white { background-color: #0a0f1a; }
        .dark .text-gray-900 { color: #f8fafc; }
        .dark .text-gray-500 { color: #94a3b8; }
        .dark .text-gray-400 { color: #64748b; }
        .dark .text-gray-700 { color: #cbd5e1; }
        .dark .text-gray-600 { color: #cbd5e1; }
        .dark .text-\[\#1a237e\] { color: #60a5fa !important; }
        
        /* Form elements in dark mode */
        .dark input[type="email"],
        .dark input[type="password"],
        .dark input[type="text"],
        .dark input[type="number"],
        .dark select {
            background-color: #1a2332;
            border-color: #2d3748;
            color: #f1f5f9;
        }
        .dark input::placeholder { color: #64748b; }
        .dark input:focus, .dark select:focus { border-color: #60a5fa; ring-color: #60a5fa; }
        
        /* Dropdown options */
        .dark option { background-color: #1a2332; color: #f1f5f9; }
        
        /* Toggle Button */
        .theme-toggle { transition: all 0.3s ease; }
        .theme-toggle:hover { transform: rotate(15deg) scale(1.1); }
        
        /* OTP Section */
        .dark .bg-blue-50 { background-color: #1e3a8a30; border-color: #1e40af; }
        .dark .bg-green-50 { background-color: #064e3b30; border-color: #065f46; }
        .dark .text-green-700 { color: #34d399; }
        .dark .bg-gradient-to-br.from-blue-50 { background-image: linear-gradient(to bottom right, #1e293b, #0f172a); border-color: #334155; }
        .dark .bg-blue-100 { background-color: #1e3a8a; }
        .dark #otp { background-color: #0f172a; border-color: #3b82f6; color: #e2e8f0; }
        .dark disabled\:bg-gray-100:disabled { background-color: #334155; color: #94a3b8; }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="h-full">
    <div class="flex min-h-full">
        <!-- Left Side: Registration Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white dark:bg-[#0a0f1a] z-10 relative">
            <!-- Theme Toggle -->
            <button id="themeToggle" class="absolute top-6 right-6 theme-toggle p-2 rounded-full hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors" title="Toggle Dark Mode">
                <i id="sunIcon" class="fa-solid fa-sun w-6 h-6 text-amber-500 flex items-center justify-center"></i>
                <i id="moonIcon" class="fa-solid fa-moon w-6 h-6 text-blue-400 hidden flex items-center justify-center"></i>
            </button>
            <div class="mx-auto w-full max-w-md lg:w-[28rem]">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center gap-4 mb-6">
                        <!-- Logo Shield -->
                        <div class="relative w-12 h-12 flex items-center justify-center">
                            <img src="{{ asset(App\Models\SiteSetting::get('global_logo', 'images/logo-pekanbaru.png')) }}" alt="Logo Pekanbaru" class="w-full h-full object-contain filter drop-shadow-sm">
                        </div>
        
                        <!-- Separator Line -->
                        <div class="h-10 w-[2px] bg-slate-300 dark:bg-slate-600 rounded-full hidden sm:block"></div>
        
                        <!-- Text Content -->
                        <div class="flex flex-col justify-center">
                            <div class="flex items-baseline gap-1.5 leading-none">
                                <span class="text-2xl font-extrabold text-[#1a237e] dark:text-blue-400 tracking-tight drop-shadow-sm">{{ App\Models\SiteSetting::get('global_app_name', 'SIDATA') }}</span>
                            </div>
                            <span class="text-[0.65rem] font-bold text-slate-500 dark:text-slate-400 tracking-[0.15em] uppercase mt-0.5 leading-tight">
                                {{ App\Models\SiteSetting::get('global_app_description', 'Sistem Informasi Data Terpadu') }}
                            </span>
                            <span class="text-[0.6rem] font-serif italic text-slate-400 dark:text-slate-500 mt-0.5">
                                {{ App\Models\SiteSetting::get('global_org_name', 'Pemerintah Kota Pekanbaru') }}
                            </span>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ App\Models\SiteSetting::get('register_title', 'Daftar Akun Baru') }}</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ App\Models\SiteSetting::get('register_description', 'Buat akun untuk mengakses sistem manajemen data aplikasi OPD.') }}
                    </p>
                </div>

                <!-- OTP Verification Section (shown after registration) -->
                @if(session('otp_pending'))
                <div id="otpSection" class="mt-6">
                    <!-- Success Alert -->
                    @if(session('otp_resent'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-eye w-5 h-5 flex items-center justify-center"></i>
                            Kode OTP baru telah dikirim ke email Anda.
                        </div>
                    </div>
                    @endif

                    <!-- OTP Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 shadow-sm">
                        <div class="text-center mb-4">
                            <div class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                <i class="fa-regular fa-envelope w-7 h-7 text-blue-600 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Verifikasi Email</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Kode OTP telah dikirim ke<br>
                                <span class="font-semibold text-blue-700">{{ session('otp_email') }}</span>
                            </p>
                        </div>

                        <!-- OTP Form -->
                        <form method="POST" action="{{ route('register.verify-otp') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('otp_email') }}">
                            
                            <!-- OTP Input -->
                            <div>
                                <label for="otp" class="block text-sm font-medium text-gray-700 mb-2 text-center">Masukkan Kode OTP (4 digit)</label>
                                <div class="flex justify-center gap-2">
                                    <input type="text" id="otp" name="otp" maxlength="4" required
                                        class="w-32 text-center text-2xl font-bold tracking-[0.5em] rounded-xl border-2 border-blue-300 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                        placeholder="••••"
                                        autocomplete="off">
                                </div>
                                @error('otp')
                                    <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Countdown Timer -->
                            <div class="text-center">
                                <p class="text-sm text-gray-600">
                                    Kode berlaku: <span id="countdown" class="font-bold text-blue-700">02:00</span>
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:from-blue-700 hover:to-indigo-700 transition-all">
                                <i class="fa-solid fa-check w-5 h-5 flex items-center justify-center"></i>
                                Verifikasi
                            </button>
                        </form>

                        <!-- Resend OTP Form -->
                        <form method="POST" action="{{ route('register.resend-otp') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="email" value="{{ session('otp_email') }}">
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-2">Tidak menerima kode?</p>
                                <button type="submit" id="resendBtn" disabled
                                    class="text-sm font-semibold text-blue-600 hover:text-blue-800 disabled:text-gray-400 disabled:cursor-not-allowed transition-colors">
                                    <span id="resendText">Kirim Ulang (<span id="resendCountdown">30</span>s)</span>
                                </button>
                            </div>
                        </form>

                        <!-- Back Button -->
                        <div class="mt-4 text-center">
                            <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-gray-700">
                                ← Kembali ke form pendaftaran
                            </a>
                        </div>
                    </div>

                    <script>
                        // OTP Expiry Countdown (2 minutes)
                        const expiresAt = {{ session('otp_expires_at') }};
                        const countdownEl = document.getElementById('countdown');
                        
                        function updateCountdown() {
                            const now = Math.floor(Date.now() / 1000);
                            let remaining = expiresAt - now;
                            
                            if (remaining <= 0) {
                                countdownEl.textContent = 'Kedaluwarsa';
                                countdownEl.classList.remove('text-blue-700');
                                countdownEl.classList.add('text-red-600');
                                return;
                            }
                            
                            const minutes = Math.floor(remaining / 60);
                            const seconds = remaining % 60;
                            countdownEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                            
                            if (remaining <= 30) {
                                countdownEl.classList.remove('text-blue-700');
                                countdownEl.classList.add('text-red-600');
                            }
                            
                            setTimeout(updateCountdown, 1000);
                        }
                        updateCountdown();

                        // Resend Countdown (30 seconds)
                        let resendRemaining = 30;
                        const resendBtn = document.getElementById('resendBtn');
                        const resendText = document.getElementById('resendText');
                        const resendCountdownEl = document.getElementById('resendCountdown');
                        
                        function updateResendCountdown() {
                            if (resendRemaining <= 0) {
                                resendBtn.disabled = false;
                                resendText.textContent = 'Kirim Ulang Kode';
                                return;
                            }
                            
                            resendCountdownEl.textContent = resendRemaining;
                            resendRemaining--;
                            setTimeout(updateResendCountdown, 1000);
                        }
                        updateResendCountdown();

                        // Auto-focus OTP input
                        document.getElementById('otp').focus();
                    </script>
                </div>
                @else
                <!-- Registration Form -->
                <div class="mt-6">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-user w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                    Nama Lengkap
                                </span>
                            </label>
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                                </div>
                                <input id="name" name="name" type="text" required autofocus autocomplete="name"
                                    class="block w-full rounded-xl border-0 py-3 pl-10 pr-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap Anda">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                <span class="flex items-center gap-2">
                                    <i class="fa-regular fa-envelope w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                    Email
                                </span>
                            </label>
                            <div class="mt-2 relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <i class="fa-regular fa-envelope text-gray-400 text-sm"></i>
                                </div>
                                <input id="email" name="email" type="email" required autocomplete="username"
                                    class="block w-full rounded-xl border-0 py-3 pl-10 pr-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- OPD Autocomplete -->
                        <div x-data="opdAutocomplete()" x-init="init()" class="relative">
                            <label for="opd_search" class="block text-sm font-medium leading-6 text-gray-900">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-building w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                    Organisasi Perangkat Daerah (OPD)
                                </span>
                            </label>
                            <div class="mt-2 relative">
                                <!-- Search Input -->
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        id="opd_search" 
                                        x-model="search"
                                        @input="onSearch()"
                                        @focus="open = true"
                                        @keydown.escape="open = false"
                                        @keydown.arrow-down.prevent="highlightNext()"
                                        @keydown.arrow-up.prevent="highlightPrev()"
                                        @keydown.enter.prevent="selectHighlighted()"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        :class="{ 'ring-red-300': error }"
                                        placeholder="Ketik untuk mencari OPD..."
                                        autocomplete="off"
                                    >
                                    <!-- Search Icon -->
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <i class="fa-solid fa-magnifying-glass w-5 h-5 text-gray-400 flex items-center justify-center" x-show="!loading"></i>
                                        <i class="fa-solid fa-circle-notch fa-spin w-5 h-5 text-blue-600 animate-spin flex items-center justify-center" x-show="loading"></i>
                                    </div>
                                </div>

                                <!-- Selected Badge -->
                                <div x-show="selectedOpd" class="mt-2 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fa-solid fa-check w-4 h-4 flex items-center justify-center"></i>
                                        <span x-text="selectedOpd"></span>
                                        <button type="button" @click="clearSelection()" class="ml-1 text-blue-600 hover:text-blue-800">
                                            <i class="fa-solid fa-xmark w-4 h-4 flex items-center justify-center"></i>
                                        </button>
                                    </span>
                                    <span class="text-xs text-gray-500">OPD terpilih</span>
                                </div>

                                <!-- New OPD Indicator -->
                                <div x-show="isNewOpd && search" class="mt-2 flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                        <i class="fa-solid fa-minus w-4 h-4 flex items-center justify-center"></i>
                                        <span>OPD Baru</span>
                                    </span>
                                    <span class="text-xs text-gray-500" x-text="'Akan ditambahkan: ' + search"></span>
                                </div>

                                <!-- Hidden Input for Form Submission -->
                                <input type="hidden" name="opd" x-model="opdValue">

                                <!-- Dropdown Results -->
                                <div 
                                    x-show="open && (results.length > 0 || (search && !selectedId))"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1"
                                    @click.outside="open = false"
                                    class="absolute z-50 mt-1 w-full bg-white dark:bg-[#1a2332] rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto"
                                >
                                    <!-- Existing OPD Results -->
                                    <template x-for="(opd, index) in results" :key="opd.id">
                                        <div 
                                            @click="selectOpd(opd)"
                                            @mouseenter="highlightedIndex = index"
                                            :class="{ 
                                                'bg-blue-50 dark:bg-blue-900/30': highlightedIndex === index,
                                                'border-l-4 border-blue-500': selectedId === opd.id
                                            }"
                                            class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 border-b border-gray-100 dark:border-gray-700 last:border-b-0 transition-colors"
                                        >
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center flex-shrink-0">
                                                    <i class="fa-solid fa-minus w-4 h-4 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="opd.nama_opd"></div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">OPD Terdaftar</div>
                                                </div>
                                                <i class="fa-solid fa-pen-to-square w-5 h-5 text-blue-600 flex items-center justify-center" x-show="selectedId === opd.id"></i>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Add New Option -->
                                    <div 
                                        x-show="search && !exactMatch"
                                        @click="selectNewOpd()"
                                        @mouseenter="highlightedIndex = results.length"
                                        :class="{ 'bg-emerald-50 dark:bg-emerald-900/30': highlightedIndex === results.length }"
                                        class="px-4 py-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 border-t border-gray-200 dark:border-gray-600 transition-colors"
                                    >
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid fa-minus w-4 h-4 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                            </div>
                                            <div class="flex-1">
                                                <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400">
                                                    Tambah: "<span x-text="search"></span>"
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">OPD baru akan dibuat</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Petunjuk OPD -->
                            <div class="mt-3 space-y-3">
                                <!-- Judul Petunjuk -->
                                <div class="flex items-center gap-2 pb-2 border-b border-gray-200 dark:border-gray-700">
                                    <i class="fa-solid fa-exclamation w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                    <span class="text-sm font-semibold text-gray-800 dark:text-gray-200">Petunjuk Pengisian</span>
                                </div>

                                <!-- OPD Sudah Ada -->
                                <div class="bg-blue-50/50 dark:bg-blue-900/10 rounded-lg p-3 border border-blue-100 dark:border-blue-900/20">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-6 h-6 rounded-full bg-blue-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-xs">1</span>
                                        </div>
                                        <span class="font-semibold text-sm text-blue-900 dark:text-blue-300">OPD Sudah Terdaftar</span>
                                    </div>
                                    <p class="text-xs text-blue-800 dark:text-blue-300/80 leading-relaxed ml-8">
                                        Ketik nama OPD → klik hasil pencarian → muncul 
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-blue-200 text-blue-800 dark:bg-blue-800 dark:text-blue-200 font-medium mx-1">
                                            <i class="fa-solid fa-circle-check w-3 h-3 flex items-center justify-center"></i>
                                            OPD Terpilih
                                        </span>
                                    </p>
                                </div>

                                <!-- OPD Baru -->
                                <div class="bg-emerald-50/50 dark:bg-emerald-900/10 rounded-lg p-3 border border-emerald-100 dark:border-emerald-900/20">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-xs">2</span>
                                        </div>
                                        <span class="font-semibold text-sm text-emerald-900 dark:text-emerald-300">OPD Baru (Belum Terdaftar)</span>
                                    </div>
                                    <ul class="space-y-2 ml-8">
                                        <li class="flex items-start gap-2 text-xs text-emerald-800 dark:text-emerald-300/80">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Ketik nama lengkap OPD sesuai format resmi<br><em class="text-emerald-600 dark:text-emerald-400 not-italic">Contoh: "Dinas Komunikasi dan Informatika Kota Pekanbaru"</em></span>
                                        </li>
                                        <li class="flex items-start gap-2 text-xs text-emerald-800 dark:text-emerald-300/80">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Pastikan muncul 
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-200 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-200 font-medium">
                                                    <i class="fa-solid fa-minus w-3 h-3 flex items-center justify-center"></i>
                                                    Tambah: "Nama OPD"
                                                </span>
                                            </span>
                                        </li>
                                        <li class="flex items-start gap-2 text-xs text-emerald-800 dark:text-emerald-300/80">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Klik "Tambah" atau tekan <kbd class="px-1.5 py-0.5 bg-emerald-200 dark:bg-emerald-800 rounded text-[10px] font-mono">Enter</kbd></span>
                                        </li>
                                        <li class="flex items-start gap-2 text-xs text-emerald-800 dark:text-emerald-300/80">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Muncul 
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-200 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-200 font-medium">
                                                    <i class="fa-solid fa-minus w-3 h-3 flex items-center justify-center"></i>
                                                    OPD Baru
                                                </span> 
                                                → OPD otomatis dibuat saat daftar
                                            </span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tips Penting -->
                                <div class="flex items-start gap-2 text-xs bg-amber-50 dark:bg-amber-900/10 p-3 rounded-lg border border-amber-200 dark:border-amber-900/30">
                                    <i class="fa-solid fa-triangle-exclamation w-4 h-4 flex-shrink-0 text-amber-600 mt-0.5"></i>
                                    <div class="text-amber-900 dark:text-amber-300">
                                        <span class="font-bold">Tips:</span> 
                                        <span class="text-amber-800 dark:text-amber-400">Gunakan nama OPD <strong>lengkap dan resmi</strong>. Sistem akan otomatis mengubah menjadi format standar (Contoh: <em>"diskominfo"</em> → <em>"Diskominfo"</em>).</span>
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('opd')" class="mt-2" />
                        </div>

                        <!-- Alpine.js Component Script - Optimized -->
                        <script>
                            function opdAutocomplete() {
                                return {
                                    search: '',
                                    results: [],
                                    selectedId: null,
                                    selectedOpd: null,
                                    isNewOpd: false,
                                    opdValue: '',
                                    loading: false,
                                    open: false,
                                    highlightedIndex: -1,
                                    error: false,
                                    exactMatch: false,
                                    searchTimeout: null,
                                    abortController: null,
                                    // Client-side cache: { 'query': [results] }
                                    cache: {},
                                    // Preloaded all OPD data
                                    allOpds: [],
                                    isPreloaded: false,

                                    async init() {
                                        // Preload semua OPD saat init (background)
                                        this.preloadOpds();
                                        
                                        this.$watch('search', value => {
                                            if (!value) {
                                                this.open = false;
                                            }
                                        });
                                    },

                                    // Preload data OPD di background
                                    async preloadOpds() {
                                        try {
                                            const res = await fetch('{{ route('opd.search') }}?q=');
                                            const data = await res.json();
                                            this.allOpds = data;
                                            this.isPreloaded = true;
                                        } catch (e) {
                                            console.log('Preload failed, will use search');
                                        }
                                    },

                                    onSearch() {
                                        this.selectedId = null;
                                        this.isNewOpd = false;
                                        this.opdValue = this.search;
                                        this.highlightedIndex = -1;
                                        
                                        clearTimeout(this.searchTimeout);
                                        
                                        if (this.search.length < 1) {
                                            this.results = [];
                                            this.open = false;
                                            return;
                                        }

                                        // Check cache first
                                        const cacheKey = this.search.toLowerCase();
                                        if (this.cache[cacheKey]) {
                                            this.results = this.cache[cacheKey];
                                            this.checkExactMatch();
                                            this.open = true;
                                            return;
                                        }

                                        // Debounce 150ms (lebih cepat dari 300ms)
                                        this.searchTimeout = setTimeout(() => {
                                            this.performSearch(cacheKey);
                                        }, 150);
                                    },

                                    async performSearch(cacheKey) {
                                        this.loading = true;
                                        
                                        // Cancel previous request
                                        if (this.abortController) {
                                            this.abortController.abort();
                                        }
                                        this.abortController = new AbortController();

                                        try {
                                            // Jika data sudah preloaded, filter client-side (INSTANT!)
                                            if (this.isPreloaded && this.allOpds.length > 0) {
                                                const query = this.search.toLowerCase();
                                                this.results = this.allOpds
                                                    .filter(opd => opd.nama_opd.toLowerCase().includes(query))
                                                    .slice(0, 10);
                                                this.loading = false;
                                                this.open = true;
                                                this.checkExactMatch();
                                                return;
                                            }

                                            // Fallback: Fetch from server
                                            const res = await fetch(
                                                `{{ route('opd.search') }}?q=${encodeURIComponent(this.search)}`,
                                                { signal: this.abortController.signal }
                                            );
                                            
                                            if (!res.ok) throw new Error('Search failed');
                                            
                                            const data = await res.json();
                                            this.results = data;
                                            
                                            // Save to cache
                                            this.cache[cacheKey] = data;
                                            
                                            this.open = true;
                                            this.checkExactMatch();
                                        } catch (err) {
                                            if (err.name !== 'AbortError') {
                                                console.error('Search error:', err);
                                            }
                                        } finally {
                                            this.loading = false;
                                        }
                                    },

                                    checkExactMatch() {
                                        this.exactMatch = this.results.some(opd => 
                                            opd.nama_opd.toLowerCase() === this.search.toLowerCase()
                                        );
                                    },

                                    selectOpd(opd) {
                                        this.selectedId = opd.id;
                                        this.selectedOpd = opd.nama_opd;
                                        this.search = opd.nama_opd;
                                        this.opdValue = opd.id;
                                        this.isNewOpd = false;
                                        this.open = false;
                                        this.highlightedIndex = -1;
                                    },

                                    selectNewOpd() {
                                        this.selectedId = null;
                                        this.selectedOpd = null;
                                        this.isNewOpd = true;
                                        this.opdValue = this.search;
                                        this.open = false;
                                        this.highlightedIndex = -1;
                                    },

                                    clearSelection() {
                                        this.selectedId = null;
                                        this.selectedOpd = null;
                                        this.isNewOpd = false;
                                        this.search = '';
                                        this.opdValue = '';
                                        this.results = [];
                                        this.open = false;
                                    },

                                    highlightNext() {
                                        const maxIndex = this.results.length + (this.search && !this.exactMatch ? 0 : -1);
                                        if (this.highlightedIndex < maxIndex) {
                                            this.highlightedIndex++;
                                        }
                                    },

                                    highlightPrev() {
                                        if (this.highlightedIndex > 0) {
                                            this.highlightedIndex--;
                                        }
                                    },

                                    selectHighlighted() {
                                        if (this.highlightedIndex >= 0 && this.highlightedIndex < this.results.length) {
                                            this.selectOpd(this.results[this.highlightedIndex]);
                                        } else if (this.highlightedIndex === this.results.length && this.search && !this.exactMatch) {
                                            this.selectNewOpd();
                                        }
                                    }
                                }
                            }
                        </script>

                        <!-- Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-lock w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                        Password
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                        <i class="fa-solid fa-lock text-gray-400 text-sm"></i>
                                    </div>
                                    <input id="password" name="password" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 pl-10 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Min. 8 karakter">
                                    <button type="button" onclick="togglePasswordReg('password', 'eyeIconPwd')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <i class="fa-solid fa-eye w-5 h-5 flex items-center justify-center"></i>
                                    </button>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-shield-halved w-4 h-4 text-blue-600 flex items-center justify-center"></i>
                                        Konfirmasi
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                        <i class="fa-solid fa-shield-halved text-gray-400 text-sm"></i>
                                    </div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 pl-10 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Ulangi password">
                                    <button type="button" onclick="togglePasswordReg('password_confirmation', 'eyeIconConfirm')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <i class="fa-solid fa-eye w-5 h-5 flex items-center justify-center"></i>
                                    </button>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <script>
                            function togglePasswordReg(inputId, iconId) {
                                const input = document.getElementById(inputId);
                                const icon = document.getElementById(iconId);
                                
                                if (input.type === 'password') {
                                    input.type = 'text';
                                    icon.innerHTML = `
                                        <path d="m3 3 18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 10a3 3 0 1 0 4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.5 4.6c.4-.1.8-.2 1.3-.2 4.8 0 8.9 3.5 9.9 8.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.7 17.6C16.1 19.5 14.1 20.8 12 21c-4.8 0-8.9-3.5-9.9-8.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 12.7a3 3 0 0 0 2.3 2.3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    `;
                                } else {
                                    input.type = 'password';
                                    icon.innerHTML = `
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    `;
                                }
                            }
                        </script>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:from-blue-700 hover:to-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">
                                <i class="fa-solid fa-circle-check w-5 h-5 flex items-center justify-center"></i>
                                Daftar Sekarang
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center pt-2">
                            <p class="text-sm text-gray-600">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">Masuk di sini</a>
                            </p>
                        </div>
                    </form>
                    
                    <div class="mt-8 text-center text-xs text-gray-400">
                        &copy; {{ date('Y') }} {{ App\Models\SiteSetting::get('register_copyright', 'DISKOMINFO Kota Pekanbaru') }}.
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Right Side: Decorative Panel -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <!-- Background with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-blue-800 to-blue-900">
                <!-- Pattern Overlay -->
                <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                
                <!-- Floating Circles -->
                <div class="absolute top-20 left-20 w-32 h-32 bg-blue-400/20 rounded-full blur-xl"></div>
                <div class="absolute bottom-40 right-20 w-40 h-40 bg-indigo-400/20 rounded-full blur-xl"></div>
                <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-cyan-400/20 rounded-full blur-xl"></div>
            </div>
            
            <!-- Floating Content -->
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-12 text-center pointer-events-none">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/10 shadow-2xl max-w-lg">
                    <!-- Icon -->
                    <div class="mx-auto w-20 h-20 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                        <i class="fa-solid fa-circle-check w-10 h-10 text-white flex items-center justify-center"></i>
                    </div>
                    
                    <h3 class="text-2xl font-bold mb-4">{{ App\Models\SiteSetting::get('register_panel_title', 'Sistem Manajemen Data Aplikasi') }}</h3>
                    <p class="text-blue-100 text-sm leading-relaxed mb-6">
                        {{ App\Models\SiteSetting::get('register_panel_description', 'Platform terintegrasi untuk pengelolaan aset digital dan inventarisasi aplikasi di lingkungan Pemerintah Kota Pekanbaru.') }}
                    </p>
                    
                    <!-- Features -->
                    <div class="space-y-3 text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-pen-to-square w-4 h-4 text-emerald-400 flex items-center justify-center"></i>
                            </div>
                            <span class="text-sm text-blue-100">{{ App\Models\SiteSetting::get('register_feature_1', 'Kelola data aplikasi OPD Anda') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check w-4 h-4 text-emerald-400 flex items-center justify-center"></i>
                            </div>
                            <span class="text-sm text-blue-100">{{ App\Models\SiteSetting::get('register_feature_2', 'Pantau status dan integrasi sistem') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check w-4 h-4 text-emerald-400 flex items-center justify-center"></i>
                            </div>
                            <span class="text-sm text-blue-100">{{ App\Models\SiteSetting::get('register_feature_3', 'Dokumentasi lengkap & terstruktur') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');
            const html = document.documentElement;

            function updateIcons() {
                if (html.classList.contains('dark')) {
                    sunIcon.classList.add('hidden');
                    moonIcon.classList.remove('hidden');
                } else {
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            }

            updateIcons();

            themeToggle.addEventListener('click', function() {
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateIcons();
            });
        });
    </script>
    </div>
</body>
</html>
