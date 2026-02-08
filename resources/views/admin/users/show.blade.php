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
            
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        @if(str_contains(session('success'), 'password') || str_contains(session('success'), 'Password') || str_contains(session('success'), 'direset'))
                            <p class="text-xs text-green-600 mt-1">Salin password ini dan berikan kepada user. Password hanya ditampilkan sekali.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Section Title -->
        <div class="mb-4">
            <h2 class="text-xl font-bold text-gray-900">Informasi Lengkap User</h2>
        </div>

        <!-- User Header Card -->
        <!-- User Header Card -->
        <div class="relative bg-white rounded-2xl shadow-sm border border-sky-100/50 p-5 hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <!-- Subtle Wave Background -->
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
            </div>
            
            <div class="relative flex flex-col md:flex-row items-center gap-5 z-10">
                <!-- Avatar Section -->
                <div class="flex-shrink-0 relative group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-sky-400 rounded-2xl blur-xl opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="relative h-20 w-20 rounded-xl object-cover ring-4 ring-white shadow-lg">
                    @else
                        <div class="relative h-20 w-20 rounded-xl bg-gradient-to-br from-sky-400 via-sky-500 to-blue-500 flex items-center justify-center text-white font-black text-3xl ring-4 ring-white shadow-lg">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                
                <!-- Vertical Separator -->
                <div class="hidden md:block w-px h-24 bg-gradient-to-b from-transparent via-slate-200 to-transparent"></div>

                <!-- User Info -->
                <div class="flex-1 min-w-0 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        
                        <!-- Nama Lengkap (Match Total Aplikasi Style) -->
                        <div class="flex items-center gap-5 group/item">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</p>
                                <h3 class="text-xl font-black text-slate-800 tracking-tight leading-tight">{{ $user->name }}</h3>
                                <p class="text-sm text-slate-500 font-medium mt-1 transition-colors group-hover/item:text-blue-500">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- OPD (Match Total OPD Style) -->
                        <div class="flex items-center gap-5 group/item">
                            <div class="relative flex-shrink-0">
                                <div class="absolute inset-0 bg-cyan-400 rounded-2xl blur-xl opacity-0 group-hover/item:opacity-30 transition-opacity"></div>
                                <div class="relative w-14 h-14 bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-cyan-50 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Organisasi Perangkat Daerah</p>
                                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-tight">{{ $user->opd->nama_opd ?? 'Belum ada OPD' }}</h3>
                            </div>
                        </div>

                        <!-- Action Buttons (Aligned with OPD, stacked vertically) -->
                        <div class="flex flex-col items-center gap-2">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1 text-center">Aksi</p>
                            <div class="flex flex-col gap-2 w-auto">
                                <button type="button" onclick="document.getElementById('updateEmailModal').classList.remove('hidden')" class="inline-flex items-center justify-center w-full px-3 py-1.5 bg-blue-500 border border-transparent shadow-sm text-xs font-medium rounded-lg text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    Ubah Email
                                </button>
                                <button type="button" onclick="document.getElementById('resetPasswordModal').classList.remove('hidden')" class="inline-flex items-center justify-center w-full px-3 py-1.5 bg-amber-500 border border-transparent shadow-sm text-xs font-medium rounded-lg text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                    Reset Password
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Bergabung Sejak -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Bergabung Sejak</p>
                        <p class="text-lg font-bold text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
                        <p class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Terakhir Input Aplikasi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-emerald-50 rounded-xl">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Terakhir Input Aplikasi</p>
                        @if($lastAppInput)
                            <p class="text-lg font-bold text-gray-900">{{ $lastAppInput->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $lastAppInput->created_at->diffForHumans() }}</p>
                        @else
                            <p class="text-lg font-bold text-gray-400">Belum ada</p>
                            <p class="text-xs text-gray-400">-</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Total Aplikasi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-indigo-50 rounded-xl">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total Aplikasi</p>
                        <p class="text-lg font-bold text-gray-900">{{ $totalApps }} Aplikasi</p>
                        <p class="text-xs text-gray-400">Terdaftar di sistem</p>
                    </div>
                </div>
            </div>

            <!-- Status Akun -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-green-50 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Terakhir Login</p>
                        @if($user->last_login_at)
                            <p class="text-sm font-bold text-gray-900">{{ $user->last_login_at->format('d M Y, H:i') }}</p>
                            <p class="text-xs text-gray-400">{{ $user->last_login_device ?? 'Unknown device' }}</p>
                        @else
                            <p class="text-sm font-bold text-gray-400">Belum pernah login</p>
                            <p class="text-xs text-gray-400">-</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Informasi Akun -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Informasi Akun
                    </h3>
                </div>
                <div class="p-6">
                    <dl class="space-y-4">
                        <div class="flex justify-between items-start">
                            <dt class="text-sm text-gray-500">ID User</dt>
                            <dd class="text-sm font-mono text-gray-900 bg-gray-100 px-2 py-1 rounded">#{{ $user->id }}</dd>
                        </div>
                        <div class="flex justify-between items-start">
                            <dt class="text-sm text-gray-500">Nama Lengkap</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $user->name }}</dd>
                        </div>
                        <div class="flex justify-between items-start">
                            <dt class="text-sm text-gray-500">Email</dt>
                            <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                        </div>
                        <div class="flex justify-between items-start">
                            <dt class="text-sm text-gray-500">Role</dt>
                            <dd>
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $user->role->name === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </dd>
                        </div>

                        <div class="pt-3 mt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-3">Aktivitas Login Terakhir</p>
                            <div class="space-y-2">
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm text-gray-500">Waktu Login</dt>
                                    <dd class="text-sm text-gray-900">
                                        @if($user->last_login_at)
                                            {{ $user->last_login_at->format('d M Y, H:i:s') }}
                                        @else
                                            <span class="text-gray-400">Belum pernah login</span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm text-gray-500">IP Address</dt>
                                    <dd class="text-sm font-mono text-gray-900 bg-gray-100 px-2 py-0.5 rounded text-xs">
                                        {{ $user->last_login_ip ?? '-' }}
                                    </dd>
                                </div>
                                <div class="flex justify-between items-start">
                                    <dt class="text-sm text-gray-500">Device / Browser</dt>
                                    <dd class="text-sm text-gray-900 text-right max-w-[180px]">
                                        {{ $user->last_login_device ?? '-' }}
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Informasi OPD -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Informasi OPD
                    </h3>
                </div>
                <div class="p-6">
                    @if($user->opd)
                        <dl class="space-y-4">
                            <div class="flex justify-between items-start">
                                <dt class="text-sm text-gray-500">ID OPD</dt>
                                <dd class="text-sm font-mono text-gray-900 bg-gray-100 px-2 py-1 rounded">#{{ $user->opd->id }}</dd>
                            </div>
                            <div class="flex justify-between items-start">
                                <dt class="text-sm text-gray-500">Nama OPD</dt>
                                <dd class="text-sm font-semibold text-gray-900 text-right max-w-[200px]">{{ $user->opd->nama_opd }}</dd>
                            </div>

                            <div class="flex justify-between items-start">
                                <dt class="text-sm text-gray-500">Total Seluruh Aplikasi (Pada OPD Ini)</dt>
                                <dd class="text-sm font-bold text-indigo-600">{{ $totalApps }} Aplikasi</dd>
                            </div>
                        </dl>
                    @else
                        <p class="text-sm text-gray-500 text-center py-4">Tidak ada data OPD</p>
                    @endif
                </div>
            </div>
        </div>

    <!-- Reset Password Modal -->
    <div id="resetPasswordModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('resetPasswordModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-amber-100 rounded-xl">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Reset Password</h3>
                                <p class="text-sm text-gray-500">{{ $user->name }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('resetPasswordModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('admin.users.reset-password', $user) }}" method="POST">
                        @csrf
                        
                        <div class="space-y-3 mb-4">
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="password_type" value="random" class="h-4 w-4 text-amber-600 focus:ring-amber-500" checked onchange="toggleCustomPassword()">
                                <div class="ml-3">
                                    <span class="block text-sm font-medium text-gray-900">Generate Random</span>
                                    <span class="block text-xs text-gray-500">Password acak 8 karakter</span>
                                </div>
                            </label>
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="password_type" value="custom" class="h-4 w-4 text-amber-600 focus:ring-amber-500" onchange="toggleCustomPassword()">
                                <div class="ml-3">
                                    <span class="block text-sm font-medium text-gray-900">Custom Password</span>
                                    <span class="block text-xs text-gray-500">Tentukan password manual</span>
                                </div>
                            </label>
                        </div>

                        <div id="customPasswordSection" class="mb-4 hidden">
                            <input type="text" name="custom_password" id="custom_password" 
                                class="w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-lg shadow-sm"
                                placeholder="Minimal 8 karakter">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="document.getElementById('resetPasswordModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <button type="button" onclick="document.getElementById('confirmResetPasswordPopup').classList.remove('hidden')" class="flex-1 px-4 py-2.5 bg-amber-500 rounded-lg text-sm font-semibold text-white hover:bg-amber-600 transition-colors">
                                Reset Password
                            </button>
                        </div>

                        <!-- Confirmation Popup -->
                        <div id="confirmResetPasswordPopup" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">
                            <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('confirmResetPasswordPopup').classList.add('hidden')"></div>
                            <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 transform transition-all">
                                <div class="text-center">
                                    <div class="mx-auto w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Reset Password</h3>
                                    <p class="text-sm text-gray-600 mb-6">Yakin reset password untuk <strong class="text-gray-900">{{ $user->name }}</strong>?</p>
                                    <div class="flex gap-3">
                                        <button type="button" onclick="document.getElementById('confirmResetPasswordPopup').classList.add('hidden')" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 rounded-lg text-sm font-semibold text-white hover:bg-red-600 transition-colors">
                                            Ya, Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Update Email Modal -->
    <div id="updateEmailModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('updateEmailModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Ubah Email</h3>
                                <p class="text-sm text-gray-500">{{ $user->name }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('updateEmailModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <!-- Security Warning -->
                    <div class="mb-4 p-3 bg-amber-50 border border-amber-200 rounded-lg flex items-start gap-2">
                        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                        <div>
                            <p class="text-xs font-bold text-amber-800">Perhatian</p>
                            <p class="text-xs text-amber-700">Perubahan email akan dicatat dalam log aktivitas untuk keamanan.</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.users.update-email', $user) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Saat Ini</label>
                            <div class="w-full px-3 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm text-gray-600">
                                {{ $user->email }}
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_email" class="block text-sm font-medium text-gray-700 mb-1">Email Baru</label>
                            <input type="email" name="new_email" id="new_email" required
                                class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm"
                                placeholder="Masukkan email baru">
                            @error('new_email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" onclick="document.getElementById('updateEmailModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <button type="button" onclick="showUpdateEmailConfirm()" class="flex-1 px-4 py-2.5 bg-blue-500 rounded-lg text-sm font-semibold text-white hover:bg-blue-600 transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>

                        <!-- Confirmation Popup -->
                        <div id="confirmUpdateEmailPopup" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">
                            <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('confirmUpdateEmailPopup').classList.add('hidden')"></div>
                            <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 transform transition-all">
                                <div class="text-center">
                                    <div class="mx-auto w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Ubah Email</h3>
                                    <p class="text-sm text-gray-600 mb-6">Yakin ubah email untuk <strong class="text-gray-900">{{ $user->name }}</strong>?</p>
                                    <div class="flex gap-3">
                                        <button type="button" onclick="document.getElementById('confirmUpdateEmailPopup').classList.add('hidden')" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                            Batal
                                        </button>
                                        <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors">
                                            Ya, Ubah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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

        // Update Email Confirmation - validates email first then shows popup
        function showUpdateEmailConfirm() {
            const emailInput = document.getElementById('new_email');
            if (!emailInput.value || !emailInput.checkValidity()) {
                emailInput.reportValidity();
                return;
            }
            document.getElementById('confirmUpdateEmailPopup').classList.remove('hidden');
        }

        // Auto-open modal if there's validation error
        @if($errors->has('new_email'))
            document.getElementById('updateEmailModal').classList.remove('hidden');
        @endif
    </script>
</x-admin-layout>
