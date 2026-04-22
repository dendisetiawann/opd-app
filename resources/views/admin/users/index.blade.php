<x-admin-layout>
    <x-slot name="header">
        Manajemen User
    </x-slot>

    <!-- Premium Header Card (Light Glassmorphism) -->
    <div class="relative mb-8 rounded-3xl p-0.5 bg-gradient-to-br from-white/60 to-white/30 dark:from-black dark:to-black border border-white/50 dark:border-zinc-800 shadow-xl shadow-blue-900/5 dark:shadow-2xl backdrop-blur-xl overflow-hidden">
        <!-- Floating Abstract Shapes (Light Mode) -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden dark:hidden">
            <div class="absolute -top-6 -right-6 w-32 h-32 bg-blue-200/40 rounded-full mix-blend-multiply filter blur-2xl"></div>
            <div class="absolute top-20 -left-8 w-24 h-24 bg-indigo-200/40 rounded-full mix-blend-multiply filter blur-2xl"></div>
            <div class="absolute -bottom-4 right-1/4 w-28 h-28 bg-cyan-200/40 rounded-full mix-blend-multiply filter blur-2xl"></div>
        </div>
        
        <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Glow -->
            <div class="absolute -top-10 -right-10 w-80 h-80 bg-gradient-to-bl from-blue-500/15 via-indigo-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-gradient-to-tr from-indigo-500/10 via-purple-500/5 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
            
            <!-- Wave Lines -->
            <svg class="absolute right-0 top-0 w-[500px] h-[300px] text-blue-400/15" viewBox="0 0 500 300" fill="none" style="animation: sway 12s ease-in-out infinite;">
                <path d="M500 0 C 375 75, 250 150, 125 300" stroke="currentColor" stroke-width="1" fill="none"/>
                <path d="M500 40 C 375 115, 250 190, 125 300" stroke="currentColor" stroke-width="1" fill="none" opacity="0.7"/>
                <path d="M500 80 C 375 155, 250 230, 125 300" stroke="currentColor" stroke-width="1" fill="none" opacity="0.5"/>
                <path d="M500 120 C 375 195, 250 270, 125 300" stroke="currentColor" stroke-width="1" fill="none" opacity="0.3"/>
            </svg>
            
            <!-- Pulsing Circles -->
            <i class="fa-solid fa-pen-to-square absolute left-10 bottom-10 w-[200px] h-[200px] text-indigo-400/10 flex items-center justify-center" style="animation: pulse-ring 4s ease-out infinite;"></i>
            
            <!-- Floating Orbs -->
            <div class="absolute top-10 right-1/4 w-3 h-3 bg-blue-400/50 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute top-1/3 right-20 w-2 h-2 bg-indigo-400/40 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 right-1/3 w-3 h-3 bg-purple-400/40 rounded-full blur-sm" style="animation: float 3.5s ease-in-out infinite; animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-20 w-2 h-2 bg-cyan-400/40 rounded-full blur-sm" style="animation: float 4.5s ease-in-out infinite; animation-delay: 0.3s;"></div>
            
            <!-- Sparkles -->
            <div class="absolute top-1/4 right-1/4 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="absolute top-1/2 right-1/3 w-1.5 h-1.5 bg-white/40 rounded-full" style="animation: sparkle 2.5s ease-in-out infinite; animation-delay: 0.3s;"></div>
            <div class="absolute bottom-1/4 right-20 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 1.8s ease-in-out infinite; animation-delay: 0.6s;"></div>
        </div>

        <div class="rounded-[22px] bg-white/60 dark:bg-transparent p-6 sm:p-8 relative z-10">
            <!-- Top Row: Title & Add Button -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg shadow-blue-500/25">
                        <i class="fa-solid fa-users w-8 h-8 text-white flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600 dark:from-white dark:to-blue-400">Manajemen User</h1>
                        <p class="text-slate-500 dark:text-zinc-400 text-sm mt-0.5">Kelola akun pengguna OPD</p>
                    </div>
                </div>
                <button type="button" onclick="document.getElementById('addUserModal').classList.remove('hidden')" 
                    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-500/30 text-sm">
                    <i class="fa-solid fa-user-plus w-5 h-5 mr-2 flex items-center justify-center"></i>
                    Tambah User Baru
                </button>
            </div>
            
            <!-- Stats Row (Premium Pill Design) -->
            <div class="flex flex-wrap gap-4 mb-8">
                <!-- Total User Stats Pill -->
                <div class="group relative px-6 py-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white dark:from-black dark:to-black border border-slate-200/50 dark:border-zinc-800 flex items-center gap-4 min-w-[180px] backdrop-blur-sm shadow-sm hover:shadow-md hover:border-blue-200/50 dark:hover:border-blue-700/50 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/25">
                        <i class="fa-solid fa-circle-check w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600 dark:from-blue-400 dark:to-indigo-400">{{ $users->total() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 dark:text-zinc-500 uppercase tracking-wider">Total User Aktif</span>
                    </div>
                </div>
                
                <!-- Total OPD Stats Pill -->
                <div class="group relative px-6 py-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white dark:from-black dark:to-black border border-slate-200/50 dark:border-zinc-800 flex items-center gap-4 min-w-[180px] backdrop-blur-sm shadow-sm hover:shadow-md hover:border-cyan-200/50 dark:hover:border-cyan-700/50 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-sky-600 flex items-center justify-center shadow-lg shadow-cyan-500/25">
                        <i class="fa-solid fa-building w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-sky-600 dark:from-cyan-400 dark:to-sky-400">{{ $opds->count() }}</span>
                        <span class="text-[10px] font-bold text-slate-400 dark:text-zinc-500 uppercase tracking-wider">Total OPD</span>
                    </div>
                </div>
            </div>
            
            <!-- Search & Filter Row -->
            <form id="userFilterForm" method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-4 sm:items-end">
                <div class="flex flex-col gap-1">
                    <label class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pilih OPD</label>
                    <select name="opd_id" onchange="document.getElementById('userFilterForm').submit()" class="px-4 py-3 bg-white/80 dark:bg-black/80 backdrop-blur-sm border border-slate-200 dark:border-zinc-700 rounded-xl text-slate-700 dark:text-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm min-w-[200px]">
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
                            class="w-full pl-12 pr-4 py-3 bg-white/80 dark:bg-black/80 backdrop-blur-sm border border-slate-200 dark:border-zinc-700 rounded-xl text-slate-700 dark:text-zinc-200 placeholder-slate-400 dark:placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass h-5 w-5 text-slate-400 flex items-center justify-center"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-blue-500/25 text-sm">
                    <i class="fa-solid fa-magnifying-glass w-4 h-4 mr-2 flex items-center justify-center"></i>
                    Cari
                </button>
                <a id="resetBtn" href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-3 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 text-slate-700 dark:text-zinc-300 font-medium rounded-xl transition-colors text-sm border border-slate-200 dark:border-zinc-700 {{ (request('search') || request('opd_id')) ? '' : 'hidden' }}">
                    <i class="fa-solid fa-xmark w-4 h-4 mr-2 flex items-center justify-center"></i>
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
        <div class="mb-6 p-4 bg-green-50 dark:bg-emerald-500/10 border border-green-200 dark:border-emerald-500/25 rounded-xl">
            <div class="flex items-start">
                <i class="fa-solid fa-check w-5 h-5 text-green-500 mr-3 mt-0.5 flex items-center justify-center"></i>
                <div>
                    <p class="text-sm font-medium text-green-800 dark:text-emerald-300">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/25 rounded-xl">
            <div class="flex items-start">
                <i class="fa-solid fa-xmark w-5 h-5 text-red-500 mr-3 mt-0.5 flex items-center justify-center"></i>
                <div>
                    <p class="text-sm font-medium text-red-800 dark:text-red-300">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
        <div class="p-0">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-zinc-800">
                        <thead class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-900 dark:to-black border-b border-gray-200 dark:border-zinc-700">
                            <tr>
                                <th scope="col" class="px-4 py-4 text-center w-16">
                                    <span class="flex items-center justify-center gap-1 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <i class="fa-solid fa-bars w-4 h-4 text-slate-400 flex items-center justify-center"></i>
                                        No
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <i class="fa-solid fa-user w-4 h-4 text-blue-500 flex items-center justify-center"></i>
                                        User
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <i class="fa-solid fa-building w-4 h-4 text-cyan-500 flex items-center justify-center"></i>
                                        OPD
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <i class="fa-regular fa-calendar w-4 h-4 text-amber-500 flex items-center justify-center"></i>
                                        Bergabung
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-center">
                                    <span class="flex items-center justify-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <i class="fa-solid fa-pen-to-square w-4 h-4 text-indigo-500 flex items-center justify-center"></i>
                                        Aksi
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-transparent divide-y divide-gray-100 dark:divide-zinc-800">
                            @foreach($users as $index => $user)
                                <tr class="hover:bg-blue-50/50 dark:hover:bg-blue-500/[0.04] transition-all duration-200 group">
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-400 text-sm font-bold group-hover:bg-blue-100 dark:group-hover:bg-blue-500/20 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
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
                                                <div class="text-sm font-bold text-slate-800 dark:text-zinc-200">{{ $user->name }}</div>
                                                <div class="text-xs text-slate-500 dark:text-zinc-500 flex items-center gap-1 mt-0.5">
                                                    <i class="fa-regular fa-envelope w-3 h-3 flex items-center justify-center"></i>
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-zinc-400 font-medium">
                                            {{ $user->opd->nama_opd ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-zinc-400">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-500/15 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/25 transition-colors text-xs font-semibold border border-blue-200 dark:border-blue-500/25">
                                                <i class="fa-solid fa-eye w-4 h-4 mr-1 flex items-center justify-center"></i>
                                                Detail
                                            </a>
                                            <button type="button" 
                                                data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email }}"
                                                onclick="openDeleteModal(this)" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 dark:bg-red-500/15 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-500/25 transition-colors text-xs font-semibold border border-red-200 dark:border-red-500/25">
                                                <i class="fa-solid fa-trash-can w-4 h-4 mr-1 flex items-center justify-center"></i>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/30">
                    {{ $users->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="bg-gray-50 dark:bg-white/5 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 dark:text-zinc-600">
                        <i class="fa-solid fa-users w-10 h-10 flex items-center justify-center"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Tidak Ada User</h3>
                    <p class="text-gray-500 dark:text-zinc-500 text-sm max-w-sm mx-auto">Tidak ditemukan user dengan filter yang dipilih.</p>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700 text-sm font-medium">
                        <i class="fa-solid fa-rotate w-4 h-4 mr-1 flex items-center justify-center"></i>
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-8 text-center text-xs text-gray-400 dark:text-zinc-600">
        &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - Dinas Komunikasi Informatika Statistik dan Persandian Kota Pekanbaru. All rights reserved.
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('addUserModal').classList.add('hidden')"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white dark:bg-zinc-900 rounded-2xl text-left overflow-hidden shadow-xl dark:shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-zinc-900 px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-100 dark:bg-blue-500/15 rounded-xl">
                                <i class="fa-solid fa-user-plus w-6 h-6 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tambah User Baru</h3>
                                <p class="text-sm text-gray-500 dark:text-zinc-400">Buat akun user OPD baru</p>
                            </div>
                        </div>
                        <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                            <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                        </button>
                    </div>
                    
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-4">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" required 
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" 
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Email</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm @error('email') border-red-500 @enderror" 
                                    placeholder="contoh@email.com">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- OPD Autocomplete -->
                            <div x-data="opdAutocompleteAdmin()" x-init="init()" class="relative">
                                <label for="admin_opd_search" class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-minus w-4 h-4 text-blue-500 flex items-center justify-center"></i>
                                        Organisasi Perangkat Daerah (OPD)
                                    </span>
                                </label>
                                <div class="relative">
                                    <!-- Search Input -->
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            id="admin_opd_search" 
                                            x-model="search"
                                            @input="onSearch()"
                                            @focus="open = true"
                                            @keydown.escape="open = false"
                                            @keydown.arrow-down.prevent="highlightNext()"
                                            @keydown.arrow-up.prevent="highlightPrev()"
                                            @keydown.enter.prevent="selectHighlighted()"
                                            class="w-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm pr-10"
                                            :class="{ 'border-red-500': error }"
                                            placeholder="Ketik untuk mencari OPD..."
                                            autocomplete="off"
                                        >
                                        <!-- Search Icon -->
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fa-solid fa-magnifying-glass w-4 h-4 text-gray-400 flex items-center justify-center" x-show="!loading"></i>
                                            <i class="fa-solid fa-circle-notch fa-spin w-4 h-4 text-blue-600 animate-spin flex items-center justify-center" x-show="loading"></i>
                                        </div>
                                    </div>

                                    <!-- Selected Badge -->
                                    <div x-show="selectedOpd" class="mt-2 flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            <i class="fa-solid fa-circle-check w-3 h-3 flex items-center justify-center"></i>
                                            <span x-text="selectedOpd"></span>
                                            <button type="button" @click="clearSelection()" class="ml-1 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                <i class="fa-solid fa-xmark w-3 h-3 flex items-center justify-center"></i>
                                            </button>
                                        </span>
                                        <span class="text-xs text-gray-500">OPD terpilih</span>
                                    </div>

                                    <!-- New OPD Indicator -->
                                    <div x-show="isNewOpd && search" class="mt-2 flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">
                                            <i class="fa-solid fa-minus w-3 h-3 flex items-center justify-center"></i>
                                            <span>OPD Baru</span>
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-zinc-400" x-text="'Akan ditambahkan: ' + search"></span>
                                    </div>

                                    <!-- Hidden Input for Form Submission -->
                                    <input type="hidden" name="opd" x-model="opdValue">

                                    <!-- Dropdown Results -->
                                    <div 
                                        x-show="open && (results.length > 0 || (search && !selectedId))"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-1"
                                        @click.outside="open = false"
                                        class="absolute z-50 mt-1 w-full bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-gray-200 dark:border-zinc-700 max-h-52 overflow-auto"
                                    >
                                        <!-- Existing OPD Results -->
                                        <template x-for="(opd, index) in results" :key="opd.id">
                                            <div 
                                                @click="selectOpd(opd)"
                                                @mouseenter="highlightedIndex = index"
                                                :class="{ 
                                                    'bg-blue-50 dark:bg-blue-900/30': highlightedIndex === index,
                                                    'border-l-4 border-blue-500': selectedId === opd.id
                                                }"
                                                class="px-3 py-2.5 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-700 border-b border-gray-100 dark:border-zinc-700 last:border-b-0 transition-colors"
                                            >
                                                <div class="flex items-center gap-2">
                                                    <div class="w-7 h-7 rounded-md bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center flex-shrink-0">
                                                        <i class="fa-solid fa-minus w-3.5 h-3.5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-zinc-200 truncate" x-text="opd.nama_opd"></div>
                                                        <div class="text-[10px] text-gray-500 dark:text-zinc-500">OPD Terdaftar</div>
                                                    </div>
                                                    <i class="fa-solid fa-pen-to-square w-4 h-4 text-blue-600 flex-shrink-0" x-show="selectedId === opd.id"></i>
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Add New Option -->
                                        <div 
                                            x-show="search && !exactMatch"
                                            @click="selectNewOpd()"
                                            @mouseenter="highlightedIndex = results.length"
                                            :class="{ 'bg-emerald-50 dark:bg-emerald-900/30': highlightedIndex === results.length }"
                                            class="px-3 py-2.5 cursor-pointer hover:bg-gray-50 dark:hover:bg-zinc-700 border-t border-gray-200 dark:border-zinc-600 transition-colors"
                                        >
                                            <div class="flex items-center gap-2">
                                                <div class="w-7 h-7 rounded-md bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center flex-shrink-0">
                                                    <i class="fa-solid fa-minus w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-sm font-medium text-emerald-700 dark:text-emerald-400 truncate">
                                                        Tambah: "<span x-text="search"></span>"
                                                    </div>
                                                    <div class="text-[10px] text-gray-500 dark:text-zinc-500">OPD baru akan dibuat</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error('opd')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Petunjuk Lengkap -->
                            <div class="space-y-2">
                                <!-- Judul -->
                                <div class="flex items-center gap-1.5 text-xs font-semibold text-gray-700 dark:text-zinc-300">
                                    <i class="fa-solid fa-exclamation w-3.5 h-3.5 text-blue-500 flex items-center justify-center"></i>
                                    Petunjuk Pengisian OPD
                                </div>
                                
                                <!-- OPD Sudah Ada -->
                                <div class="bg-blue-50/70 dark:bg-blue-900/10 rounded-md p-2 border border-blue-100 dark:border-blue-900/20">
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <div class="w-4 h-4 rounded-full bg-blue-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-[8px]">1</span>
                                        </div>
                                        <span class="text-xs font-semibold text-blue-900 dark:text-blue-300">OPD Sudah Terdaftar</span>
                                    </div>
                                    <p class="text-[11px] text-blue-800 dark:text-blue-300/80 leading-relaxed ml-5">
                                        Ketik nama OPD → klik hasil pencarian → muncul 
                                        <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full bg-blue-200 text-blue-800 dark:bg-blue-800 dark:text-blue-200 text-[10px] font-medium">
                                            <i class="fa-solid fa-circle-check w-3 h-3 flex items-center justify-center"></i>
                                            OPD Terpilih
                                        </span>
                                    </p>
                                </div>

                                <!-- OPD Baru -->
                                <div class="bg-emerald-50/70 dark:bg-emerald-900/10 rounded-md p-2 border border-emerald-100 dark:border-emerald-900/20">
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <div class="w-4 h-4 rounded-full bg-emerald-500 flex items-center justify-center">
                                            <span class="text-white font-bold text-[8px]">2</span>
                                        </div>
                                        <span class="text-xs font-semibold text-emerald-900 dark:text-emerald-300">OPD Baru (Belum Terdaftar)</span>
                                    </div>
                                    <ul class="space-y-1 ml-5 text-[11px] text-emerald-800 dark:text-emerald-300/80">
                                        <li class="flex items-start gap-1">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Ketik nama lengkap OPD sesuai format resmi<br><em class="text-emerald-600 dark:text-emerald-400 not-italic">Contoh: "Dinas Komunikasi dan Informatika Kota Pekanbaru"</em></span>
                                        </li>
                                        <li class="flex items-start gap-1">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Pastikan muncul 
                                                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full bg-emerald-200 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-200 text-[10px] font-medium">
                                                    <i class="fa-solid fa-minus w-3 h-3 flex items-center justify-center"></i>
                                                    Tambah
                                                </span>
                                            </span>
                                        </li>
                                        <li class="flex items-start gap-1">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Klik "Tambah" atau tekan <kbd class="px-1 py-0 bg-emerald-200 dark:bg-emerald-800 rounded text-[10px] font-mono">Enter</kbd></span>
                                        </li>
                                        <li class="flex items-start gap-1">
                                            <span class="text-emerald-500 mt-0.5">•</span>
                                            <span>Muncul 
                                                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full bg-emerald-200 text-emerald-800 dark:bg-emerald-800 dark:text-emerald-200 text-[10px] font-medium">
                                                    <i class="fa-solid fa-minus w-3 h-3 flex items-center justify-center"></i>
                                                    OPD Baru
                                                </span> 
                                                → OPD otomatis dibuat
                                            </span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tips Penting -->
                                <div class="flex items-start gap-1.5 text-[11px] bg-amber-50 dark:bg-amber-900/10 p-2 rounded-md border border-amber-200 dark:border-amber-900/30">
                                    <i class="fa-solid fa-triangle-exclamation w-3.5 h-3.5 flex-shrink-0 text-amber-600 mt-0.5"></i>
                                    <div class="text-amber-900 dark:text-amber-300">
                                        <span class="font-bold">Tips:</span> 
                                        <span class="text-amber-800 dark:text-amber-400">Gunakan nama OPD <strong>lengkap dan resmi</strong>. Sistem akan otomatis mengubah menjadi format standar (Contoh: <em>"diskominfo"</em> → <em>"Diskominfo"</em>).</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Alpine.js Component Script for Admin -->
                            <script>
                                function opdAutocompleteAdmin() {
                                    return {
                                        search: '',
                                        results: [],
                                        selectedId: null,
                                        selectedOpd: null,
                                        isNewOpd: false,
                                        opdValue: '',
                                        loading: false,
                                        open: false,
                                        highlightedIndex: -1,
                                        error: false,
                                        exactMatch: false,
                                        searchTimeout: null,
                                        abortController: null,
                                        cache: {},
                                        allOpds: [],
                                        isPreloaded: false,

                                        async init() {
                                            this.preloadOpds();
                                            this.$watch('search', value => {
                                                if (!value) {
                                                    this.open = false;
                                                }
                                            });
                                        },

                                        async preloadOpds() {
                                            try {
                                                const res = await fetch('{{ route('admin.opd.search') }}?q=');
                                                const data = await res.json();
                                                this.allOpds = data;
                                                this.isPreloaded = true;
                                            } catch (e) {
                                                console.log('Preload failed');
                                            }
                                        },

                                        onSearch() {
                                            this.selectedId = null;
                                            this.isNewOpd = false;
                                            this.opdValue = this.search;
                                            this.highlightedIndex = -1;
                                            
                                            clearTimeout(this.searchTimeout);
                                            
                                            if (this.search.length < 1) {
                                                this.results = [];
                                                this.open = false;
                                                return;
                                            }

                                            const cacheKey = this.search.toLowerCase();
                                            if (this.cache[cacheKey]) {
                                                this.results = this.cache[cacheKey];
                                                this.checkExactMatch();
                                                this.open = true;
                                                return;
                                            }

                                            this.searchTimeout = setTimeout(() => {
                                                this.performSearch(cacheKey);
                                            }, 150);
                                        },

                                        async performSearch(cacheKey) {
                                            this.loading = true;
                                            
                                            if (this.abortController) {
                                                this.abortController.abort();
                                            }
                                            this.abortController = new AbortController();

                                            try {
                                                if (this.isPreloaded && this.allOpds.length > 0) {
                                                    const query = this.search.toLowerCase();
                                                    this.results = this.allOpds
                                                        .filter(opd => opd.nama_opd.toLowerCase().includes(query))
                                                        .slice(0, 10);
                                                    this.loading = false;
                                                    this.open = true;
                                                    this.checkExactMatch();
                                                    return;
                                                }

                                                const res = await fetch(
                                                    `{{ route('admin.opd.search') }}?q=${encodeURIComponent(this.search)}`,
                                                    { signal: this.abortController.signal }
                                                );
                                                
                                                if (!res.ok) throw new Error('Search failed');
                                                
                                                const data = await res.json();
                                                this.results = data;
                                                this.cache[cacheKey] = data;
                                                
                                                this.open = true;
                                                this.checkExactMatch();
                                            } catch (err) {
                                                if (err.name !== 'AbortError') {
                                                    console.error('Search error:', err);
                                                }
                                            } finally {
                                                this.loading = false;
                                            }
                                        },

                                        checkExactMatch() {
                                            this.exactMatch = this.results.some(opd => 
                                                opd.nama_opd.toLowerCase() === this.search.toLowerCase()
                                            );
                                        },

                                        selectOpd(opd) {
                                            this.selectedId = opd.id;
                                            this.selectedOpd = opd.nama_opd;
                                            this.search = opd.nama_opd;
                                            this.opdValue = opd.id;
                                            this.isNewOpd = false;
                                            this.open = false;
                                            this.highlightedIndex = -1;
                                        },

                                        selectNewOpd() {
                                            this.selectedId = null;
                                            this.selectedOpd = null;
                                            this.isNewOpd = true;
                                            this.opdValue = this.search;
                                            this.open = false;
                                            this.highlightedIndex = -1;
                                        },

                                        clearSelection() {
                                            this.selectedId = null;
                                            this.selectedOpd = null;
                                            this.isNewOpd = false;
                                            this.search = '';
                                            this.opdValue = '';
                                            this.results = [];
                                            this.open = false;
                                        },

                                        highlightNext() {
                                            const maxIndex = this.results.length + (this.search && !this.exactMatch ? 0 : -1);
                                            if (this.highlightedIndex < maxIndex) {
                                                this.highlightedIndex++;
                                            }
                                        },

                                        highlightPrev() {
                                            if (this.highlightedIndex > 0) {
                                                this.highlightedIndex--;
                                            }
                                        },

                                        selectHighlighted() {
                                            if (this.highlightedIndex >= 0 && this.highlightedIndex < this.results.length) {
                                                this.selectOpd(this.results[this.highlightedIndex]);
                                            } else if (this.highlightedIndex === this.results.length && this.search && !this.exactMatch) {
                                                this.selectNewOpd();
                                            }
                                        }
                                    }
                                }
                            </script>
                            
                            <!-- Password Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-2">Password</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="password_type" value="random" checked 
                                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                            onchange="document.getElementById('customPasswordField').classList.add('hidden')">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-zinc-300">Random (Otomatis)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="password_type" value="custom" 
                                            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                            onchange="document.getElementById('customPasswordField').classList.remove('hidden')">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-zinc-300">Custom</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Custom Password Field -->
                            <div id="customPasswordField" class="hidden">
                                <label for="custom_password" class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">Password Custom</label>
                                <input type="password" name="custom_password" id="custom_password" minlength="8"
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm text-sm" 
                                    placeholder="Minimal 8 karakter">
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-zinc-300 bg-gray-100 dark:bg-zinc-800 rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-700 transition-colors">
                                Batal
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-sm">
                                <i class="fa-solid fa-check w-4 h-4 inline mr-1 flex items-center justify-center"></i>
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
            <div class="fixed inset-0 bg-gray-900/80 dark:bg-black/80 backdrop-blur-sm transition-opacity"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white dark:bg-zinc-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full ring-1 ring-black/5 dark:ring-white/10">
                <!-- Success Header -->
                <div class="bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-500 px-6 py-8 text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-3 ring-4 ring-white/30">
                            <i class="fa-solid fa-circle-check w-8 h-8 text-white flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">User Berhasil Dibuat!</h3>
                        <p class="text-white/80 text-sm mt-1">Akun baru telah terdaftar dalam sistem</p>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="px-6 py-6">
                    <!-- Avatar & Name -->
                    <div class="flex items-center gap-4 pb-4 mb-5 border-b border-gray-100 dark:border-zinc-800">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg shadow-blue-500/25">
                            {{ strtoupper(substr(session('created_user_name'), 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ session('created_user_name') }}</p>
                            <p class="text-sm text-gray-500 dark:text-zinc-400 flex items-center gap-1">
                                <i class="fa-regular fa-envelope w-3.5 h-3.5 flex items-center justify-center"></i>
                                {{ session('created_user_email') }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- OPD Info -->
                    <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-xl p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-zinc-500 uppercase tracking-wide font-semibold mb-1">OPD</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ session('created_user_opd') }}</p>
                            </div>
                            <div class="p-2 bg-cyan-100 dark:bg-cyan-500/15 rounded-lg">
                                <i class="fa-solid fa-building w-5 h-5 text-cyan-600 dark:text-cyan-400 flex items-center justify-center"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Box -->
                    <div class="bg-amber-50 dark:bg-amber-500/10 border-2 border-amber-300 dark:border-amber-500/30 rounded-xl p-4 mb-5">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-xs text-amber-700 dark:text-amber-400 font-bold uppercase tracking-wide mb-2">Password</p>
                                <p class="text-2xl font-mono font-bold text-amber-900 dark:text-amber-300 tracking-widest">{{ session('generated_password') }}</p>
                            </div>
                            <div class="p-2 bg-amber-100 dark:bg-amber-500/20 rounded-lg">
                                <i class="fa-solid fa-lock w-5 h-5 text-amber-600 dark:text-amber-400 flex items-center justify-center"></i>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 mt-3 pt-3 border-t border-amber-200 dark:border-amber-500/20">
                            <i class="fa-solid fa-circle-exclamation w-4 h-4 text-amber-500 flex-shrink-0"></i>
                            <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">Simpan password ini! Hanya ditampilkan sekali.</p>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex gap-3">
                        <a href="{{ route('admin.users.export-pdf', session('created_user_id')) }}" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold rounded-xl hover:from-red-600 hover:to-pink-600 transition-all shadow-lg shadow-red-500/25">
                            <i class="fa-solid fa-file-arrow-down w-5 h-5 mr-2 flex items-center justify-center"></i>
                            Download PDF
                        </a>
                        <button type="button" onclick="document.getElementById('successModal').remove()" 
                            class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-zinc-300 font-semibold rounded-xl hover:bg-gray-200 dark:hover:bg-zinc-700 transition-all">
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

    <!-- Delete User Modal -->
    <div id="deleteUserModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDeleteModal()"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white dark:bg-zinc-900 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-zinc-900 px-6 pt-6 pb-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-red-100 dark:bg-red-500/15 rounded-xl">
                                <i class="fa-solid fa-triangle-exclamation w-6 h-6 text-red-600 dark:text-red-400 flex items-center justify-center"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Hapus User</h3>
                                <p class="text-sm text-gray-500 dark:text-zinc-400">Penghapusan bersifat soft delete</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
                            <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                        </button>
                    </div>
                    
                    <form id="deleteUserForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        
                        <!-- User Info -->
                        <div class="bg-gray-50 dark:bg-zinc-800/50 rounded-lg p-4 mb-4 border border-gray-200 dark:border-zinc-700">
                            <p class="text-sm text-gray-600 dark:text-zinc-400 mb-1">User yang akan dihapus:</p>
                            <p id="deleteUserName" class="text-lg font-bold text-gray-900 dark:text-white"></p>
                            <p id="deleteUserEmail" class="text-sm text-gray-500 dark:text-zinc-500"></p>
                        </div>

                        <!-- Reason -->
                        <div>
                            <label for="deleted_reason" class="block text-sm font-medium text-gray-700 dark:text-zinc-300 mb-1">
                                Alasan Penghapusan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="deleted_reason" id="deleted_reason" rows="3" required
                                class="w-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm text-sm"
                                placeholder="Contoh: User resign, duplikat akun, permintaan user, dll."></textarea>
                            <p class="text-xs text-gray-500 dark:text-zinc-500 mt-1">Audit log akan mencatat alasan penghapusan ini.</p>
                        </div>
                        
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" onclick="closeDeleteModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-zinc-300 bg-gray-100 dark:bg-zinc-800 rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-700 transition-colors">
                                Batal
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors shadow-sm">
                                <i class="fa-solid fa-minus w-4 h-4 inline mr-1 flex items-center justify-center"></i>
                                Ya, Hapus User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(button) {
            const userId = button.getAttribute('data-user-id');
            const userName = button.getAttribute('data-user-name');
            const userEmail = button.getAttribute('data-user-email');
            
            // Build action URL
            const actionUrl = '/admin/users/' + userId;
            document.getElementById('deleteUserForm').action = actionUrl;
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteUserEmail').textContent = userEmail;
            document.getElementById('deleteUserModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteUserModal').classList.add('hidden');
            document.getElementById('deleted_reason').value = '';
        }
    </script>
</x-admin-layout>

