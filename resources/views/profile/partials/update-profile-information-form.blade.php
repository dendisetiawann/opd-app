<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-zinc-300 mb-1.5">Nama Lengkap</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $user->name) }}"
                class="block w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/50 text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white dark:focus:bg-zinc-800 transition-all"
                required 
                autofocus 
                autocomplete="name"
            >
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-zinc-300 mb-1.5">Alamat Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email', $user->email) }}"
                class="block w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/50 text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white dark:focus:bg-zinc-800 transition-all"
                required 
                autocomplete="username"
            >
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-lg bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800/30">
                    <p class="text-sm text-amber-700 dark:text-amber-400">
                        <span class="font-semibold">Email belum diverifikasi.</span>
                        <button form="send-verification" class="underline text-amber-600 hover:text-amber-800 font-medium ml-1">
                            Kirim ulang email verifikasi
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if (!session('email_update_pending'))
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                    Simpan Perubahan
                </button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-emerald-600 font-medium flex items-center gap-1"
                    >
                        <i class="fa-solid fa-check w-4 h-4 flex items-center justify-center"></i>
                        Tersimpan!
                    </p>
                @endif

                @if (session('status') === 'email-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 4000)"
                        class="text-sm text-emerald-600 font-medium flex items-center gap-1"
                    >
                        <i class="fa-solid fa-envelope-circle-check w-4 h-4 flex items-center justify-center"></i>
                        Email Berhasil Diperbarui!
                    </p>
                @endif
            </div>
        @endif
    </form>

    <!-- OTP Verification Section -->
    @if (session('email_update_pending'))
        <div class="mt-8 border-t border-slate-200 dark:border-zinc-700 pt-8">
            <div class="bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 border border-indigo-200 dark:border-indigo-800/50 rounded-2xl p-6 shadow-sm">
                <div class="text-center mb-5">
                    <div class="mx-auto w-12 h-12 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center mb-3">
                        <i class="fa-regular fa-envelope w-6 h-6 text-indigo-600 dark:text-indigo-400 flex items-center justify-center"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-zinc-100">Verifikasi Email Baru</h3>
                    <p class="text-sm text-slate-600 dark:text-zinc-400 mt-1">
                        Kode OTP telah dikirim ke<br>
                        <span class="font-semibold text-indigo-700 dark:text-indigo-400">{{ session('email_update_new_email') }}</span>
                    </p>
                </div>

                <form method="POST" action="{{ route('profile.email.verify') }}" class="space-y-4 max-w-sm mx-auto">
                    @csrf
                    <div>
                        <label for="otp" class="block text-sm font-medium text-slate-700 dark:text-zinc-300 mb-2 text-center">Masukkan Kode OTP (4 digit)</label>
                        <div class="flex justify-center">
                            <input type="text" id="otp" name="otp" maxlength="4" required
                                class="w-32 text-center text-2xl font-bold tracking-[0.5em] rounded-xl border-2 border-indigo-300 dark:border-indigo-700 bg-white dark:bg-zinc-800 py-3 text-slate-800 dark:text-zinc-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                placeholder="••••"
                                autocomplete="off">
                        </div>
                        @error('otp')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400 text-center font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-slate-600 dark:text-zinc-400">
                            Kode berlaku: <span id="countdown_email" class="font-bold text-indigo-700 dark:text-indigo-400">02:00</span>
                        </p>
                    </div>

                    <button type="submit" 
                        class="flex w-full justify-center items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:from-indigo-700 hover:to-blue-700 transition-all">
                        <i class="fa-solid fa-check w-5 h-5 flex items-center justify-center"></i>
                        Verifikasi & Simpan Email
                    </button>
                </form>

                <div class="mt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <form method="POST" action="{{ route('profile.email.resend') }}" class="text-center">
                        @csrf
                        <p class="text-[11px] text-slate-500 dark:text-zinc-500 mb-1">Tidak menerima kode?</p>
                        <button type="submit" id="resendBtnEmail" disabled
                            class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 disabled:text-slate-400 disabled:dark:text-zinc-600 disabled:cursor-not-allowed transition-colors">
                            <span id="resendTextEmail">Kirim Ulang (<span id="resendCountdownEmail">30</span>s)</span>
                        </button>
                    </form>

                    <div class="hidden sm:block w-px h-8 bg-slate-200 dark:bg-zinc-700"></div>

                    <form method="POST" action="{{ route('profile.email.cancel') }}" class="text-center">
                        @csrf
                        @method('DELETE')
                        <p class="text-[11px] text-slate-500 dark:text-zinc-500 mb-1">Salah email?</p>
                        <button type="submit" 
                            class="text-xs font-semibold text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                            Batalkan Perubahan
                        </button>
                    </form>
                </div>

                <script>
                    // OTP Expiry Countdown (2 minutes)
                    const expiresAtEmail = {{ session('email_update_expires_at') ?? 0 }};
                    const countdownElEmail = document.getElementById('countdown_email');
                    
                    function updateCountdownEmail() {
                        const now = Math.floor(Date.now() / 1000);
                        let remaining = expiresAtEmail - now;
                        
                        if (remaining <= 0) {
                            if(countdownElEmail) {
                                countdownElEmail.textContent = 'Kedaluwarsa';
                                countdownElEmail.classList.remove('text-indigo-700', 'dark:text-indigo-400');
                                countdownElEmail.classList.add('text-red-600', 'dark:text-red-400');
                            }
                            return;
                        }
                        
                        const minutes = Math.floor(remaining / 60);
                        const seconds = remaining % 60;
                        if(countdownElEmail) {
                            countdownElEmail.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                            if (remaining <= 30) {
                                countdownElEmail.classList.remove('text-indigo-700', 'dark:text-indigo-400');
                                countdownElEmail.classList.add('text-red-600', 'dark:text-red-400');
                            }
                        }
                        
                        setTimeout(updateCountdownEmail, 1000);
                    }
                    if(expiresAtEmail > 0) updateCountdownEmail();

                    // Resend Countdown (30 seconds)
                    const lastSentEmail = {{ session('email_update_last_sent') ?? 0 }};
                    const resendBtnEmail = document.getElementById('resendBtnEmail');
                    const resendTextEmail = document.getElementById('resendTextEmail');
                    const resendCountdownElEmail = document.getElementById('resendCountdownEmail');
                    
                    function updateResendCountdownEmail() {
                        const now = Math.floor(Date.now() / 1000);
                        const elapsed = now - lastSentEmail;
                        let resendRemaining = 30 - elapsed;

                        if (resendRemaining <= 0) {
                            if(resendBtnEmail) {
                                resendBtnEmail.disabled = false;
                                resendTextEmail.textContent = 'Kirim Ulang Kode';
                            }
                            return;
                        }
                        
                        if(resendCountdownElEmail) {
                            resendCountdownElEmail.textContent = resendRemaining;
                        }
                        setTimeout(updateResendCountdownEmail, 1000);
                    }
                    if(lastSentEmail > 0) updateResendCountdownEmail();
                </script>
            </div>
        </div>
    @endif
</section>
