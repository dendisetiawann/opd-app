<section class="space-y-4">
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="!bg-red-600 hover:!bg-red-700 !rounded-xl !px-5 !py-2.5 !font-semibold !text-sm"
    >
        Hapus Akun
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                    <i class="fa-solid fa-circle-exclamation w-6 h-6 text-red-600 flex items-center justify-center"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800 dark:text-white">
                        Yakin ingin menghapus akun?
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>

            <p class="text-sm text-slate-600 dark:text-zinc-400 mb-6 leading-relaxed">
                Setelah akun dihapus, seluruh data dan informasi yang terkait akan <span class="font-semibold text-red-600">terhapus secara permanen</span>. 
                Masukkan password Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-zinc-300 mb-1.5">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/50 text-slate-800 dark:text-zinc-100 placeholder-slate-400 dark:placeholder-zinc-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:bg-white dark:focus:bg-zinc-800 transition-all"
                    placeholder="Masukkan password Anda"
                >
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-zinc-800 text-slate-700 dark:text-zinc-300 font-semibold hover:bg-slate-200 dark:hover:bg-zinc-700 transition-colors"
                >
                    Batal
                </button>

                <button 
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 shadow-lg shadow-red-500/30 transition-all"
                >
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
