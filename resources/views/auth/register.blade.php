<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi - Sistem Manajemen Data Aplikasi OPD</title>
    <link rel="icon" href="{{ asset('images/logo-icon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div class="flex min-h-full">
        <!-- Left Side: Registration Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white z-10 relative">
            <div class="mx-auto w-full max-w-md lg:w-[28rem]">
                <!-- Header -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo-icon.png') }}" alt="Logo DISKOMINFO Pekanbaru" class="h-10 w-auto">
                        <div>
                            <h1 class="text-2xl font-bold text-[#1a237e] leading-none tracking-tight">DISKOMINFO</h1>
                            <p class="text-[10px] text-black font-semibold tracking-[0.1em] mt-0.5">KOTA PEKANBARU</p>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Daftar Akun Baru</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Buat akun untuk mengakses sistem manajemen data aplikasi OPD.
                    </p>
                </div>

                <!-- OTP Verification Section (shown after registration) -->
                @if(session('otp_pending'))
                <div id="otpSection" class="mt-6">
                    <!-- Success Alert -->
                    @if(session('otp_resent'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Kode OTP baru telah dikirim ke email Anda.
                        </div>
                    </div>
                    @endif

                    <!-- OTP Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6 shadow-sm">
                        <div class="text-center mb-4">
                            <div class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
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
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
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
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Nama Lengkap
                                </span>
                            </label>
                            <div class="mt-2">
                                <input id="name" name="name" type="text" required autofocus autocomplete="name"
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap Anda">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Email
                                </span>
                            </label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" required autocomplete="username"
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- OPD Selection -->
                        <div id="opdSelectSection">
                            <label for="opd_id" class="block text-sm font-medium leading-6 text-gray-900">
                                <span id="opdLabel" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    Organisasi Perangkat Daerah (OPD)
                                </span>
                            </label>
                            <div class="mt-2">
                                <select id="opd_id" name="opd_id" onchange="handleOpdSelect()"
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all disabled:bg-gray-100 disabled:cursor-not-allowed">
                                    <option value="">-- Pilih OPD --</option>
                                    @foreach($opds as $opd)
                                        <option value="{{ $opd->id }}" {{ old('opd_id') == $opd->id ? 'selected' : '' }}>
                                            {{ $opd->nama_opd }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('opd_id')" class="mt-2" />
                            </div>
                        </div>

                        <!-- New OPD Input -->
                        <div id="newOpdSection">
                            <label for="new_opd" class="block text-sm font-medium leading-6 text-gray-900">
                                <span id="newOpdLabel" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Atau Tambahkan OPD Baru
                                </span>
                            </label>
                            <div class="mt-2">
                                <input id="new_opd" name="new_opd" type="text" oninput="handleNewOpdInput()"
                                    class="block w-full rounded-xl border-0 py-3 px-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 transition-all"
                                    value="{{ old('new_opd') }}"
                                    placeholder="Contoh: Dinas Kesehatan">
                                <p id="newOpdHint" class="text-xs text-gray-500 mt-1.5">⚠️ Biarkan kosong jika memilih OPD dari daftar di atas.</p>
                                <x-input-error :messages="$errors->get('new_opd')" class="mt-2" />
                            </div>
                        </div>

                        <script>
                            function handleNewOpdInput() {
                                const newOpd = document.getElementById('new_opd');
                                const opdSelect = document.getElementById('opd_id');
                                const opdLabel = document.getElementById('opdLabel');
                                const opdSection = document.getElementById('opdSelectSection');
                                
                                if (newOpd.value.trim() !== '') {
                                    opdSelect.value = '';
                                    opdSelect.disabled = true;
                                    opdSection.classList.add('opacity-50');
                                    opdLabel.innerHTML = `
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        <span class="text-gray-400">OPD (nonaktif) — Kosongkan form OPD baru untuk memilih dari daftar</span>
                                    `;
                                } else {
                                    opdSelect.disabled = false;
                                    opdSection.classList.remove('opacity-50');
                                    opdLabel.innerHTML = `
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        Organisasi Perangkat Daerah (OPD)
                                    `;
                                }
                            }
                            
                            function handleOpdSelect() {
                                const opdSelect = document.getElementById('opd_id');
                                const newOpd = document.getElementById('new_opd');
                                const newOpdSection = document.getElementById('newOpdSection');
                                const newOpdLabel = document.getElementById('newOpdLabel');
                                const newOpdHint = document.getElementById('newOpdHint');
                                
                                if (opdSelect.value !== '') {
                                    newOpd.value = '';
                                    newOpd.disabled = true;
                                    newOpdSection.classList.add('opacity-50');
                                    newOpdLabel.innerHTML = `
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        <span class="text-gray-400">Tambah OPD Baru (nonaktif)</span>
                                    `;
                                    newOpdHint.textContent = '✓ OPD sudah dipilih dari daftar.';
                                } else {
                                    newOpd.disabled = false;
                                    newOpdSection.classList.remove('opacity-50');
                                    newOpdLabel.innerHTML = `
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        Atau Tambahkan OPD Baru
                                    `;
                                    newOpdHint.textContent = '⚠️ Biarkan kosong jika memilih OPD dari daftar di atas.';
                                }
                            }
                            
                            document.addEventListener('DOMContentLoaded', function() {
                                handleNewOpdInput();
                                handleOpdSelect();
                            });
                        </script>

                        <!-- Password -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        Password
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input id="password" name="password" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Min. 8 karakter">
                                    <button type="button" onclick="togglePasswordReg('password', 'eyeIconPwd')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <svg id="eyeIconPwd" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        Konfirmasi
                                    </span>
                                </label>
                                <div class="mt-2 relative">
                                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                                        class="block w-full rounded-xl border-0 py-3 px-4 pr-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-all"
                                        placeholder="Ulangi password">
                                    <button type="button" onclick="togglePasswordReg('password_confirmation', 'eyeIconConfirm')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                        <svg id="eyeIconConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
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
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
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
                        &copy; {{ date('Y') }} DISKOMINFO Kota Pekanbaru.
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
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold mb-4">Sistem Manajemen Data Aplikasi</h3>
                    <p class="text-blue-100 text-sm leading-relaxed mb-6">
                        Platform terintegrasi untuk pengelolaan aset digital dan inventarisasi aplikasi di lingkungan Pemerintah Kota Pekanbaru.
                    </p>
                    
                    <!-- Features -->
                    <div class="space-y-3 text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-blue-100">Kelola data aplikasi OPD Anda</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-blue-100">Pantau status dan integrasi sistem</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm text-blue-100">Dokumentasi lengkap & terstruktur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
