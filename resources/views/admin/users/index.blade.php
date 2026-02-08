<x-admin-layout>
    <x-slot name="header">
        Manajemen User
    </x-slot>

    <!-- Premium Header Card (Light Glassmorphism) -->
    <div class="relative mb-8 rounded-3xl p-0.5 bg-gradient-to-br from-white/60 to-white/30 border border-white/50 shadow-xl shadow-blue-900/5 backdrop-blur-xl overflow-hidden">
        <!-- Floating Abstract Shapes -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-6 -right-6 w-32 h-32 bg-blue-200/40 rounded-full mix-blend-multiply filter blur-2xl"></div>
            <div class="absolute top-20 -left-8 w-24 h-24 bg-indigo-200/40 rounded-full mix-blend-multiply filter blur-2xl"></div>
            <div class="absolute -bottom-4 right-1/4 w-28 h-28 bg-cyan-200/40 rounded-full mix-blend-multiply filter blur-2xl"></div>
        </div>

        <div class="rounded-[22px] bg-white/60 p-6 sm:p-8 relative z-10">
            <!-- Top Row: Title & Add Button -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg shadow-blue-500/25">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600">Manajemen User</h1>
                        <p class="text-slate-500 text-sm mt-0.5">Kelola akun pengguna OPD</p>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('addUserModal').classList.remove('hidden')" 
                    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-500/30 text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Tambah User Baru
                </button>
            </div>
            
            <!-- Stats Row (Premium Pill Design) -->
            <div class="flex flex-wrap gap-4 mb-8">
                <!-- Total User Stats Pill -->
                <div class="group relative px-6 py-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white border border-slate-200/50 flex items-center gap-4 min-w-[180px] backdrop-blur-sm shadow-sm hover:shadow-md hover:border-blue-200/50 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600">{{ $users->total() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total User Aktif</span>
                    </div>
                </div>
                
                <!-- Total OPD Stats Pill -->
                <div class="group relative px-6 py-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white border border-slate-200/50 flex items-center gap-4 min-w-[180px] backdrop-blur-sm shadow-sm hover:shadow-md hover:border-emerald-200/50 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">{{ $opds->count() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total OPD</span>
                    </div>
                </div>
            </div>
            
            <!-- Search & Filter Row -->
            <form id="userFilterForm" method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-4 sm:items-end">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pilih OPD</label>
                    <select name="opd_id" onchange="document.getElementById('userFilterForm').submit()" class="px-4 py-3 bg-white/80 backdrop-blur-sm border border-slate-200 rounded-xl text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm min-w-[200px]">
                        <option value="">Semua OPD</option>
                        @foreach($opds as $opd)
                            <option value="{{ $opd->id }}" {{ request('opd_id') == $opd->id ? 'selected' : '' }}>
                                {{ $opd->nama_opd }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pencarian</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau OPD..." 
                            class="w-full pl-12 pr-4 py-3 bg-white/80 backdrop-blur-sm border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-blue-500/25 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari
                </button>
                <a id="resetBtn" href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition-colors text-sm border border-slate-200 {{ (request('search') || request('opd_id')) ? '' : 'hidden' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Reset
                </a>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.querySelector('input[name="search"]');
                    const opdSelect = document.querySelector('select[name="opd_id"]');
                    const resetBtn = document.getElementById('resetBtn');
                    
                    function toggleResetBtn() {
                        if (searchInput.value.trim() !== '' || opdSelect.value !== '') {
                            resetBtn.classList.remove('hidden');
                        } else {
                            resetBtn.classList.add('hidden');
                        }
                    }
                    
                    searchInput.addEventListener('input', toggleResetBtn);
                    opdSelect.addEventListener('change', toggleResetBtn);
                });
            </script>
        </div>
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

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-0">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-4 text-center w-16">
                                    <span class="flex items-center justify-center gap-1 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                        No
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        User
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        OPD
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Bergabung
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-center">
                                    <span class="flex items-center justify-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                                        Aksi
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($users as $index => $user)
                                <tr class="hover:bg-blue-50/50 transition-all duration-200 group">
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600 text-sm font-bold group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                            {{ $users->firstItem() + $index }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($user->profile_photo)
                                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="h-11 w-11 flex-shrink-0 rounded-xl object-cover ring-2 ring-blue-100 shadow-sm">
                                            @else
                                                <div class="h-11 w-11 flex-shrink-0 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-blue-500/25">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-slate-800">{{ $user->name }}</div>
                                                <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-gradient-to-r from-emerald-50 to-teal-50 text-emerald-700 border border-emerald-200/50">
                                            {{ $user->opd->nama_opd ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-xs font-semibold border border-blue-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $users->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak Ada User</h3>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto">Tidak ditemukan user dengan filter yang dipilih.</p>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700 text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-8 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('addUserModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Tambah User Baru</h3>
                                <p class="text-sm text-gray-500">Buat akun user OPD baru</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-4">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" required 
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" 
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm @error('email') border-red-500 @enderror" 
                                    placeholder="contoh@email.com">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- OPD -->
                            <div>
                                <label for="modal_opd_id" class="block text-sm font-medium text-gray-700 mb-1">OPD</label>
                                <select name="opd_id" id="modal_opd_id" 
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm">
                                    <option value="">-- Pilih OPD --</option>
                                    @foreach($opds as $opd)
                                        <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- New OPD -->
                            <div>
                                <label for="new_opd" class="block text-sm font-medium text-gray-700 mb-1">Atau Tambahkan OPD Baru</label>
                                <input type="text" name="new_opd" id="new_opd" 
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" 
                                    placeholder="Ketik nama OPD baru jika tidak ada di daftar">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika memilih dari daftar di atas.</p>
                            </div>
                            
                            <!-- Password Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="password_type" value="random" checked 
                                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                            onchange="document.getElementById('customPasswordField').classList.add('hidden')">
                                        <span class="ml-2 text-sm text-gray-700">Random (Otomatis)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="password_type" value="custom" 
                                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                            onchange="document.getElementById('customPasswordField').classList.remove('hidden')">
                                        <span class="ml-2 text-sm text-gray-700">Custom</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Custom Password Field -->
                            <div id="customPasswordField" class="hidden">
                                <label for="custom_password" class="block text-sm font-medium text-gray-700 mb-1">Password Custom</label>
                                <input type="password" name="custom_password" id="custom_password" minlength="8"
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" 
                                    placeholder="Minimal 8 karakter">
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                Batal
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal (User Created) -->
    @if(session('user_created'))
    <div id="successModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-6 py-8 text-center">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-3 ring-4 ring-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white">User Berhasil Dibuat!</h3>
                    <p class="text-white/80 text-sm mt-1">Akun baru telah terdaftar</p>
                </div>
                
                <!-- User Info -->
                <div class="px-6 py-6">
                    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-gray-100">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white text-lg font-bold">
                            {{ strtoupper(substr(session('created_user_name'), 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ session('created_user_name') }}</p>
                            <p class="text-sm text-gray-500">{{ session('created_user_email') }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">OPD</span>
                            <span class="text-sm font-semibold text-gray-900">{{ session('created_user_opd') }}</span>
                        </div>
                    </div>
                    
                    <!-- Password Box -->
                    <div class="bg-amber-50 border-2 border-amber-300 rounded-xl p-4 text-center mb-4">
                        <p class="text-xs text-amber-700 font-semibold uppercase tracking-wide mb-2">Password</p>
                        <p class="text-2xl font-mono font-bold text-amber-900 tracking-widest">{{ session('generated_password') }}</p>
                        <p class="text-xs text-amber-600 mt-2">⚠️ Simpan password ini! Hanya ditampilkan sekali.</p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('admin.users.export-pdf', session('created_user_id')) }}" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-all shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </a>
                        <button type="button" onclick="document.getElementById('successModal').remove()" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($errors->has('email'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addUserModal').classList.remove('hidden');
        });
    </script>
    @endif
</x-admin-layout>

