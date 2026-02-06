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
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Yakin ingin menghapus akun?
                    </h2>
                    <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
            </div>

            <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                Setelah akun dihapus, seluruh data dan informasi yang terkait akan <span class="font-semibold text-red-600">terhapus secara permanen</span>. 
                Masukkan password Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-800 placeholder-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 focus:bg-white transition-all"
                    placeholder="Masukkan password Anda"
                >
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition-colors"
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
