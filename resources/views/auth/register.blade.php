<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- OPD Selection -->
        <div class="mt-4">
            <x-input-label for="opd_id" :value="__('Stakeholder (OPD)')" />
            <select id="opd_id" name="opd_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- Pilih OPD --</option>
                @foreach($opds as $opd)
                    <option value="{{ $opd->id }}" {{ old('opd_id') == $opd->id ? 'selected' : '' }}>
                        {{ $opd->nama_opd }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('opd_id')" class="mt-2" />
        </div>

        <!-- New OPD Input -->
        <div class="mt-4">
            <x-input-label for="new_opd" :value="__('Atau Tambahkan OPD Baru')" />
            <x-text-input id="new_opd" class="block mt-1 w-full" type="text" name="new_opd" :value="old('new_opd')" placeholder="Ketik nama OPD baru jika tidak ada di daftar" />
            <x-input-error :messages="$errors->get('new_opd')" class="mt-2" />
            <p class="text-sm text-gray-500 mt-1">Kosongkan jika memilih dari daftar di atas.</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
