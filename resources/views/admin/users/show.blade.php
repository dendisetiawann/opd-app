<x-admin-layout>
    <x-slot name="header">
        Detail User
    </x-slot>

    <!-- Main Container -->
    <!-- Main Container -->
    <div class="space-y-8">
        
        <!-- Breadcrumb & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.users.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-blue-600 md:ml-2">Manajemen User</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-sm font-medium text-gray-800 md:ml-2">{{ Str::limit($user->name, 20) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        <p class="text-xs text-green-600 mt-1">Salin password ini dan berikan kepada user. Password hanya ditampilkan sekali.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Hero Card -->
        <div class="relative bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-700 opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            
            <div class="relative p-8 md:p-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-5 flex-1">
                        <!-- Avatar -->
                        <div class="h-20 w-20 flex-shrink-0 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white font-black text-3xl border-2 border-white/30 shadow-xl">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        
                        <!-- User Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm border border-white/10">
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ ucfirst($user->role->name) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm border border-white/10">
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $user->created_at->format('d M Y') }}
                                </span>
                            </div>
                            
                            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 tracking-tight">{{ $user->name }}</h1>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 text-white/90 text-sm md:text-base">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="font-medium">{{ $user->email }}</span>
                                </div>
                                <span class="hidden sm:inline text-white/50">•</span>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1.5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    <span class="font-medium">{{ $user->opd->nama_opd ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Badge -->
                    <div class="flex-shrink-0">
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-6 py-4 text-center shadow-xl">
                            <div class="text-4xl font-black text-white mb-1">{{ $totalApps }}</div>
                            <div class="text-xs font-semibold text-white/80 uppercase tracking-wider">Total Aplikasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Info Cards Grid -->

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
