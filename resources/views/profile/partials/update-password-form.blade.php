<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 dark:text-zinc-300 mb-1.5">Password Saat Ini</label>
            <input 
                type="password" 
                id="update_password_current_password" 
                name="current_password"
                class="block w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/50 text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white dark:focus:bg-zinc-800 transition-all"
                autocomplete="current-password"
                placeholder="Masukkan password saat ini"
            >
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 dark:text-zinc-300 mb-1.5">Password Baru</label>
            <div class="relative">
                <input 
                    type="password" 
                    id="update_password_password" 
                    name="password"
                    class="block w-full px-4 py-3 pr-10 rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/50 text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white dark:focus:bg-zinc-800 transition-all"
                    autocomplete="new-password"
                    placeholder="Min. 8 karakter, Aa + @#$"
                >
                <button type="button" onclick="togglePasswordProf('update_password_password', 'eyeIconNew')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-zinc-300">
                    <i id="eyeIconNew" class="fa-solid fa-eye w-5 h-5 flex items-center justify-center"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-zinc-300 mb-1.5">Konfirmasi Password Baru</label>
            <div class="relative">
                <input 
                    type="password" 
                    id="update_password_password_confirmation" 
                    name="password_confirmation"
                    class="block w-full px-4 py-3 pr-10 rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/50 text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:bg-white dark:focus:bg-zinc-800 transition-all"
                    autocomplete="new-password"
                    placeholder="Ulangi password baru"
                >
                <button type="button" onclick="togglePasswordProf('update_password_password_confirmation', 'eyeIconConfirm')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-zinc-300">
                    <i id="eyeIconConfirm" class="fa-solid fa-eye w-5 h-5 flex items-center justify-center"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Password Requirements Tips -->
        <div class="flex items-start gap-2 text-[10px] text-slate-500 dark:text-zinc-400 pt-1">
            <i class="fa-solid fa-circle-info text-[9px] mt-0.5 flex-shrink-0"></i>
            <span>Minimal 8 karakter, 1 huruf besar (A-Z), dan 1 karakter spesial (@$!%*?&#). Contoh: <em class="text-slate-600 dark:text-zinc-300">Sidata@2026</em></span>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium flex items-center gap-1"
                >
                    <i class="fa-solid fa-check w-4 h-4 flex items-center justify-center"></i>
                    Password Diperbarui!
                </p>
            @endif
        </div>
    </form>
</section>

<script>
    function togglePasswordProf(inputId, iconId) {
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
