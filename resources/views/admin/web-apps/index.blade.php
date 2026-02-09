<x-admin-layout>
    <x-slot name="header">
        Data Aplikasi
    </x-slot>

    <!-- Header Section - Premium Design -->
    <div class="relative bg-white dark:bg-zinc-900 rounded-2xl p-6 mb-6 overflow-hidden shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800">
        <!-- Background Decoration (Light Mode) -->
        <div class="absolute inset-0 opacity-[0.03] dark:hidden">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-500 via-cyan-400 to-transparent"></div>
        </div>
        
        <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Glow -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-cyan-500/15 via-blue-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-blue-500/10 via-indigo-500/5 to-transparent rounded-full blur-2xl animate-pulse" style="animation-duration: 5s; animation-delay: 0.5s;"></div>
            
            <!-- Wave Lines -->
            <svg class="absolute -right-10 top-0 w-[400px] h-[200px] text-cyan-400/20" viewBox="0 0 400 200" fill="none" style="animation: sway 10s ease-in-out infinite;">
                <path d="M400 0 C 300 50, 200 100, 100 200" stroke="currentColor" stroke-width="1" fill="none"/>
                <path d="M400 30 C 300 80, 200 130, 100 200" stroke="currentColor" stroke-width="1" fill="none" opacity="0.7"/>
                <path d="M400 60 C 300 110, 200 160, 100 200" stroke="currentColor" stroke-width="1" fill="none" opacity="0.5"/>
            </svg>
            
            <!-- Floating Orbs -->
            <div class="absolute top-4 right-20 w-2 h-2 bg-cyan-400/50 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute top-8 right-40 w-3 h-3 bg-blue-400/40 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 0.5s;"></div>
            <div class="absolute bottom-6 right-32 w-2 h-2 bg-indigo-400/40 rounded-full blur-sm" style="animation: float 3.5s ease-in-out infinite; animation-delay: 1s;"></div>
            
            <!-- Sparkles -->
            <div class="absolute top-1/3 right-1/4 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="absolute bottom-1/4 right-1/3 w-1 h-1 bg-white/40 rounded-full" style="animation: sparkle 2.5s ease-in-out infinite; animation-delay: 0.5s;"></div>
        </div>
        
        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4 z-10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-white">Data Aplikasi Semua OPD</h2>
                    <p class="text-sm text-slate-500 dark:text-zinc-400">Daftar lengkap data aplikasi yang dikelola oleh seluruh OPD.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/30 dark:to-cyan-900/20 px-4 py-2 rounded-xl border border-blue-100 dark:border-blue-800/50">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="text-sm text-slate-600 dark:text-zinc-300">Total <span class="font-bold text-blue-600 dark:text-blue-400">{{ $webApps->total() }}</span> aplikasi terdaftar dari seluruh OPD</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card - Modern Design -->
    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 mb-6 overflow-hidden">
        <div class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-900 dark:to-black border-b border-gray-100 dark:border-zinc-800 px-6 py-4">
            <h3 class="text-sm font-bold text-slate-700 dark:text-zinc-300 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filter & Pencarian
            </h3>
        </div>
        <div class="p-6">
            <form id="webAppFilterForm" method="GET" action="{{ route('admin.web-apps.index') }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[180px]">
                    <label for="opd_id" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pilih OPD</label>
                    <div class="relative">
                        <select name="opd_id" id="opd_id" onchange="document.getElementById('webAppFilterForm').submit()" class="w-full border-gray-200 dark:border-zinc-700 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-sm pl-10 py-2.5 bg-gray-50 dark:bg-black dark:text-zinc-200 hover:bg-white dark:hover:bg-zinc-900 transition-colors">
                            <option value="">Semua OPD</option>
                            @foreach($opds as $opd)
                                <option value="{{ $opd->id }}" {{ request('opd_id') == $opd->id ? 'selected' : '' }}>
                                    {{ $opd->nama_opd }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    </div>
                </div>
                <!-- Sorting Dropdown -->
                <div class="w-full sm:w-auto">
                    <label for="sort" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Urutkan</label>
                    <div class="relative">
                        <select name="sort" id="sort" onchange="this.form.submit()"
                            class="w-full pl-10 pr-10 py-2.5 border-gray-200 dark:border-zinc-700 focus:border-purple-500 focus:ring-purple-500 rounded-xl shadow-sm text-sm appearance-none bg-gray-50 dark:bg-black dark:text-zinc-200 hover:bg-white dark:hover:bg-zinc-900 transition-colors cursor-pointer">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="name_asc" {{ request('sort', 'name_asc') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        </div>
                    </div>
                </div>
                <div class="flex-1 min-w-[250px]">
                    <label for="search" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pencarian</label>
                    <div class="relative">
                        <input type="text" name="search" id="adminWebAppSearch" value="{{ request('search') }}" placeholder="Ketik nama aplikasi / OPD..." 
                            class="w-full pl-10 pr-4 py-2.5 border-gray-200 dark:border-zinc-700 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-sm bg-gray-50 dark:bg-black dark:text-zinc-200 hover:bg-white dark:hover:bg-zinc-900 transition-colors">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-xl font-semibold text-sm text-white hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-md shadow-blue-500/30">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Cari
                    </button>
                    <a id="adminWebAppResetBtn" href="{{ route('admin.web-apps.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-xl font-semibold text-sm text-gray-600 dark:text-zinc-300 hover:bg-gray-200 dark:hover:bg-zinc-700 hover:text-gray-700 transition-all {{ (request('search') || request('opd_id')) ? '' : 'hidden' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('adminWebAppSearch');
            const opdSelect = document.getElementById('opd_id');
            const resetBtn = document.getElementById('adminWebAppResetBtn');
            
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

    <!-- Data Table -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
        <div class="p-0">
            @if($webApps->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-zinc-800">
                        <thead class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-900 dark:to-black border-b border-gray-200 dark:border-zinc-700">
                            <tr>
                                <th scope="col" class="px-4 py-4 text-center w-16">
                                    <span class="flex items-center justify-center gap-1 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                        No
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        Aplikasi
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
                                        <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Penginput
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Tanggal Pendataan
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-center">
                                    <span class="flex items-center justify-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Aksi
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-transparent divide-y divide-gray-100 dark:divide-zinc-800">
                            @foreach($webApps as $index => $app)
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors">
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-400 text-xs font-bold rounded-full">{{ $webApps->firstItem() + $index }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $app->nama_web_app }}</div>
                                            @if($app->alamat_tautan)
                                                <a href="{{ str_starts_with($app->alamat_tautan, 'http') ? $app->alamat_tautan : 'http://' . $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium bg-blue-50 dark:bg-blue-500/15 px-2 py-0.5 rounded-md hover:bg-blue-100 dark:hover:bg-blue-500/25 transition-colors mt-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                    Kunjungi
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-zinc-600 italic">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-green-50 dark:bg-emerald-500/15 text-green-700 dark:text-emerald-400 border border-green-100 dark:border-emerald-500/25">
                                            {{ $app->opd->nama_opd }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $app->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $app->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.web-apps.show', $app) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-500/15 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/25 transition-colors text-xs font-semibold">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/30">
                    {{ $webApps->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="bg-gray-50 dark:bg-white/5 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 dark:text-zinc-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Tidak Ada Data</h3>
                    <p class="text-gray-500 dark:text-zinc-500 text-sm max-w-sm mx-auto">Tidak ditemukan data aplikasi dengan filter yang dipilih.</p>
                    <a href="{{ route('admin.web-apps.index') }}" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700 text-sm font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-8 text-center text-xs text-gray-400 dark:text-zinc-600">
        &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
    </div>
</x-admin-layout>
