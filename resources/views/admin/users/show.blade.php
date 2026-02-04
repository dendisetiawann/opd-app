<x-admin-layout>
    <x-slot name="header">
        Detail User
    </x-slot>

    <!-- Main Container -->
    <div class="space-y-6">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar User
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        <p class="text-xs text-green-600 mt-1">Salin password ini dan berikan kepada user. Password hanya ditampilkan sekali.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- User Info Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-900">Detail User</h2>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="h-16 w-16 flex-shrink-0 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-2xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ml-5">
                        <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">OPD</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->opd->nama_opd ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</dt>
                        <dd class="mt-1">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Aplikasi</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $totalApps }} aplikasi</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Bergabung</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Reset Password Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-900">Reset Password</h2>
                <p class="text-sm text-gray-500 mt-1">Pilih metode reset password untuk user ini.</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" id="resetPasswordForm">
                    @csrf
                    
                    <!-- Password Type Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Metode Reset</label>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="password_type" value="random" class="h-4 w-4 text-blue-600 focus:ring-blue-500" checked onchange="toggleCustomPassword()">
                                <div class="ml-3">
                                    <span class="block text-sm font-medium text-gray-900">Generate Random Password</span>
                                    <span class="block text-xs text-gray-500">Sistem akan membuat password acak 8 karakter</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="password_type" value="custom" class="h-4 w-4 text-blue-600 focus:ring-blue-500" onchange="toggleCustomPassword()">
                                <div class="ml-3">
                                    <span class="block text-sm font-medium text-gray-900">Set Custom Password</span>
                                    <span class="block text-xs text-gray-500">Tentukan password baru secara manual</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Custom Password Input -->
                    <div id="customPasswordSection" class="mb-6 hidden">
                        <label for="custom_password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                        <input type="text" name="custom_password" id="custom_password" 
                            class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                            placeholder="Minimal 8 karakter">
                        @error('custom_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-yellow-500 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-yellow-600 focus:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm"
                            onclick="return confirm('Apakah Anda yakin ingin mereset password untuk {{ $user->name }}?')">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            Reset Password
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleCustomPassword() {
            const customSection = document.getElementById('customPasswordSection');
            const customRadio = document.querySelector('input[name="password_type"][value="custom"]');
            
            if (customRadio.checked) {
                customSection.classList.remove('hidden');
            } else {
                customSection.classList.add('hidden');
            }
        }
    </script>
</x-admin-layout>
