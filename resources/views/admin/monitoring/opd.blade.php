<x-admin-layout>
    <x-slot name="header">Statistik OPD</x-slot>

    <!-- Stats Row - Matching admin monitoring main page style -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Total OPD -->
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-800 rounded-xl p-5 shadow-lg shadow-blue-500/20 dark:shadow-blue-900/40 hover:shadow-xl hover:scale-[1.02] transition-all">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full dark:hidden"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full dark:hidden"></div>
            <div class="hidden dark:block absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/5 rounded-full" style="animation: pulse-ring 4s ease-out infinite;"></div>
            <div class="hidden dark:block absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full animate-pulse" style="animation-duration: 3s;"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-xs font-medium uppercase tracking-wider mb-1">Total OPD</p>
                        <p class="text-3xl font-bold text-white">{{ $opdStats->count() }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-white/20 text-white">
                                {{ $opdStats->where('web_apps_count', '>', 0)->count() }} Aktif
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-building w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-rata App/OPD -->
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 dark:from-emerald-600 dark:to-emerald-800 rounded-xl p-5 shadow-lg shadow-emerald-500/20 dark:shadow-emerald-900/40 hover:shadow-xl hover:scale-[1.02] transition-all">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full dark:hidden"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full dark:hidden"></div>
            <div class="hidden dark:block absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/5 rounded-full" style="animation: pulse-ring 4s ease-out infinite;"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-xs font-medium uppercase tracking-wider mb-1">Rata-rata App/OPD</p>
                        <p class="text-3xl font-bold text-white">{{ $avgAppsPerOpd }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-network-wired w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Aplikasi -->
        <div onclick="showJenisAplikasi()" class="relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-800 rounded-xl p-5 shadow-lg shadow-purple-500/20 dark:shadow-purple-900/40 hover:shadow-xl hover:scale-[1.02] transition-all cursor-pointer">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full dark:hidden"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full dark:hidden"></div>
            <div class="hidden dark:block absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/5 rounded-full" style="animation: pulse-ring 4s ease-out infinite;"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-xs font-medium uppercase tracking-wider mb-1">Total Aplikasi</p>
                        <p class="text-3xl font-bold text-white">{{ $opdStats->sum('web_apps_count') }}</p>
                        <p class="text-purple-200/70 text-[10px] mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-location-arrow w-3 h-3 flex items-center justify-center"></i>
                            Klik untuk lihat detail
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-cube w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Perlu Perhatian -->
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-500 dark:from-amber-600 dark:to-orange-700 rounded-xl p-5 shadow-lg shadow-amber-500/20 dark:shadow-amber-900/40 hover:shadow-xl hover:scale-[1.02] transition-all">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full dark:hidden"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full dark:hidden"></div>
            <div class="hidden dark:block absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/5 rounded-full" style="animation: pulse-ring 4s ease-out infinite;"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-xs font-medium uppercase tracking-wider mb-1">Perlu Perhatian</p>
                        <p class="text-3xl font-bold text-white">{{ $emptyOpds->count() }}</p>
                        <p class="text-[10px] text-amber-100/80 mt-2">OPD belum menginput aplikasi</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-triangle-exclamation w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Analysis Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Distribution Chart -->
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
            <div class="px-5 py-4 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-950/30 dark:to-blue-950/20 border-b border-indigo-100/60 dark:border-indigo-900/30">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 dark:bg-indigo-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-chart-pie w-4 h-4 text-indigo-600 dark:text-indigo-400 flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Distribusi OPD</h3>
                        <p class="text-[10px] text-gray-500 dark:text-zinc-500">Status input data aplikasi</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="relative h-52 mb-4">
                    <canvas id="distributionChart"></canvas>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="text-center p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl border border-emerald-100 dark:border-emerald-800/30">
                        <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $opdStats->where('web_apps_count', '>', 0)->count() }}</p>
                        <p class="text-[10px] font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider">Sudah Input</p>
                    </div>
                    <div class="text-center p-3 bg-slate-50 dark:bg-zinc-800 rounded-xl border border-slate-200 dark:border-zinc-700">
                        <p class="text-2xl font-bold text-slate-600 dark:text-slate-300">{{ $emptyOpds->count() }}</p>
                        <p class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Belum Input</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 10 OPD Teraktif -->
        <div class="lg:col-span-2 bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
            <div class="px-5 py-4 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/20 border-b border-amber-100/60 dark:border-amber-900/30">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-print w-4 h-4 text-white flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Top 10 OPD Teraktif</h3>
                        <p class="text-[10px] text-gray-500 dark:text-zinc-500">Berdasarkan jumlah aplikasi terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="space-y-2.5">
                    @foreach($topOpds as $index => $opd)
                    <div class="flex items-center gap-3 group cursor-pointer hover:bg-slate-50 dark:hover:bg-zinc-800/50 p-2.5 rounded-xl transition-all" onclick="showOpdDetail({{ $opd->id }}, '{{ $opd->nama_opd }}')">
                        <!-- Rank Medal -->
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg font-bold text-xs flex-shrink-0
                            {{ $index === 0 ? 'bg-gradient-to-br from-yellow-300 to-amber-500 text-white shadow-sm shadow-amber-300/50' : '' }}
                            {{ $index === 1 ? 'bg-gradient-to-br from-gray-300 to-gray-400 text-white shadow-sm' : '' }}
                            {{ $index === 2 ? 'bg-gradient-to-br from-orange-300 to-orange-500 text-white shadow-sm' : '' }}
                            {{ $index > 2 ? 'bg-slate-100 dark:bg-zinc-800 text-slate-600 dark:text-slate-400' : '' }}">
                            {{ $index + 1 }}
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300 truncate">{{ $opd->nama_opd }}</span>
                                <span class="text-xs font-bold text-slate-900 dark:text-white bg-slate-100 dark:bg-zinc-800 px-2 py-0.5 rounded-full ml-2 flex-shrink-0">{{ $opd->web_apps_count }} app</span>
                            </div>
                            <div class="h-1.5 bg-slate-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-700
                                    {{ $index === 0 ? 'bg-gradient-to-r from-yellow-400 to-amber-500' : '' }}
                                    {{ $index === 1 ? 'bg-gradient-to-r from-gray-300 to-gray-400' : '' }}
                                    {{ $index === 2 ? 'bg-gradient-to-r from-orange-400 to-orange-500' : '' }}
                                    {{ $index > 2 ? 'bg-gradient-to-r from-blue-400 to-indigo-500' : '' }}"
                                    style="width: {{ ($opd->web_apps_count / max($topOpds->first()->web_apps_count, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <!-- View Icon -->
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0"></i>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Trend Chart Section -->
    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden mb-8">
        <div class="px-5 py-4 bg-gradient-to-r from-cyan-50 to-teal-50 dark:from-cyan-950/30 dark:to-teal-950/20 border-b border-cyan-100/60 dark:border-cyan-900/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/10 dark:bg-cyan-500/20 flex items-center justify-center">
                        <i class="fa-solid fa-bolt w-4 h-4 text-cyan-600 dark:text-cyan-400 flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Perkembangan Input Data</h3>
                        <p class="text-[10px] text-gray-500 dark:text-zinc-500">Tren penambahan aplikasi 12 bulan terakhir</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-[10px]">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-2 rounded-sm bg-cyan-500"></span>
                        <span class="text-slate-600 dark:text-slate-400">App Baru/Bulan</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-0.5 bg-indigo-500 rounded"></span>
                        <span class="text-slate-600 dark:text-slate-400">Total Kumulatif</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div class="relative h-72">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Daftar OPD Table Section -->
    <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
        <!-- Filter Bar -->
        <div class="border-b border-gray-100 dark:border-zinc-800 px-6 py-4 bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-900 dark:to-zinc-900">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-table-cells-large w-4.5 h-4.5 text-white flex items-center justify-center"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white">Daftar OPD</h3>
                        <p class="text-[10px] text-slate-500">{{ $opdStats->count() }} organisasi terdaftar</p>
                    </div>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <!-- Filter -->
                    <select id="filterStatus" onchange="applyFilters()" class="pl-3 pr-8 py-2 text-xs font-medium border border-gray-200 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-800 text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="all">Semua Status</option>
                        <option value="has_data">● Sudah Ada Data</option>
                        <option value="no_data">○ Belum Ada Data</option>
                    </select>
                    
                    <!-- Sort -->
                    <select id="sortBy" onchange="applyFilters()" class="pl-3 pr-8 py-2 text-xs font-medium border border-gray-200 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-800 text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="apps_desc">App Terbanyak</option>
                        <option value="apps_asc">App Tersedikit</option>
                        <option value="name_asc">Nama A-Z</option>
                        <option value="name_desc">Nama Z-A</option>
                    </select>
                    
                    <!-- Search -->
                    <div class="relative flex-1 lg:flex-none">
                        <input type="text" id="searchOpd" placeholder="Cari OPD..." onkeyup="applyFilters()" 
                            class="w-full lg:w-56 pl-9 pr-4 py-2 text-xs border border-gray-200 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-800 text-slate-700 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition placeholder:text-slate-400">
                        <i class="fa-solid fa-magnifying-glass w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 flex items-center justify-center"></i>
                    </div>
                    
                    <a href="{{ route('admin.monitoring.opd.export-all') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-lg transition-all shadow-sm">
                        <i class="fa-solid fa-file-excel w-3.5 h-3.5 flex items-center justify-center"></i>
                        Export Semua
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full" id="opdTable">
                <thead class="bg-slate-50/80 dark:bg-zinc-800/50">
                    <tr>
                        <th class="text-left px-6 py-3.5 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16 cursor-pointer hover:text-indigo-600 transition-colors" onclick="sortTable('rank')">#</th>
                        <th class="text-left px-6 py-3.5 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider cursor-pointer hover:text-indigo-600 transition-colors" onclick="sortTable('name')">
                            <span class="inline-flex items-center gap-1">Nama OPD <i class="fa-solid fa-sort w-3 h-3 flex items-center justify-center"></i></span>
                        </th>
                        <th class="text-center px-6 py-3.5 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider cursor-pointer hover:text-indigo-600 transition-colors" onclick="sortTable('apps')">
                            <span class="inline-flex items-center gap-1">Jumlah App <i class="fa-solid fa-sort w-3 h-3 flex items-center justify-center"></i></span>
                        </th>
                        <th class="text-center px-6 py-3.5 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="text-center px-6 py-3.5 text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-zinc-800" id="opdTableBody">
                    @foreach($opdStats as $index => $opd)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-zinc-800/30 transition-colors opd-row" 
                        data-name="{{ strtolower($opd->nama_opd) }}" 
                        data-apps="{{ $opd->web_apps_count }}" 
                        data-status="{{ $opd->web_apps_count > 0 ? 'has_data' : 'no_data' }}">
                        <td class="px-6 py-3.5">
                            <span class="inline-flex items-center justify-center w-7 h-7 text-xs font-bold rounded-lg
                                {{ $index < 3 ? 'bg-gradient-to-br from-yellow-300 to-amber-500 text-white shadow-sm' : 'bg-slate-100 dark:bg-zinc-800 text-slate-500 dark:text-slate-400' }}">
                                {{ $index + 1 }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5">
                            <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $opd->nama_opd }}</span>
                        </td>
                        <td class="px-6 py-3.5 text-center">
                            <span class="inline-flex items-center justify-center min-w-[40px] px-2.5 py-1 rounded-full text-xs font-bold
                                {{ $opd->web_apps_count >= 5 ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400 ring-1 ring-emerald-200 dark:ring-emerald-800' : '' }}
                                {{ $opd->web_apps_count > 0 && $opd->web_apps_count < 5 ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 ring-1 ring-blue-200 dark:ring-blue-800' : '' }}
                                {{ $opd->web_apps_count == 0 ? 'bg-slate-100 text-slate-400 dark:bg-zinc-800 dark:text-slate-500' : '' }}">
                                {{ $opd->web_apps_count }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-center">
                            @if($opd->web_apps_count > 0)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-500 dark:bg-zinc-800 dark:text-slate-400">
                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                    Belum Input
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 text-center">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ route('admin.monitoring.opd.export', $opd->id) }}" 
                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400 hover:text-white hover:bg-emerald-600 dark:hover:bg-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg transition-all ring-1 ring-emerald-200 dark:ring-emerald-800 hover:ring-emerald-600"
                                    title="Export Excel">
                                    <i class="fa-solid fa-file-excel w-3.5 h-3.5 flex items-center justify-center"></i>
                                </a>
                                <button onclick="showOpdDetail({{ $opd->id }}, '{{ $opd->nama_opd }}')" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-white hover:bg-indigo-600 dark:hover:bg-indigo-600 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg transition-all ring-1 ring-indigo-200 dark:ring-indigo-800 hover:ring-indigo-600">
                                    <i class="fa-solid fa-eye w-3.5 h-3.5 flex items-center justify-center"></i>
                                    Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" class="hidden py-16 text-center">
            <div class="w-16 h-16 bg-slate-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-magnifying-glass w-8 h-8 text-slate-400 flex items-center justify-center"></i>
            </div>
            <p class="text-slate-600 dark:text-slate-400 font-semibold">Tidak ada OPD yang sesuai</p>
            <p class="text-slate-500 text-sm mt-1">Coba ubah kata kunci pencarian atau filter</p>
        </div>
    </div>

    <!-- OPD Detail Modal -->
    <div id="opdDetailModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>
            
            <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden transform transition-all ring-1 ring-gray-200 dark:ring-zinc-700">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-building w-5 h-5 text-white flex items-center justify-center"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white" id="modalOpdName">Detail OPD</h3>
                                <p class="text-indigo-200 text-xs">Daftar aplikasi terdaftar</p>
                            </div>
                        </div>
                        <button onclick="closeModal()" class="text-white/80 hover:text-white transition-colors hover:bg-white/10 rounded-lg p-1.5">
                            <i class="fa-solid fa-xmark w-5 h-5 flex items-center justify-center"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="p-6" id="modalContent">
                    <div class="animate-pulse space-y-3">
                        <div class="h-4 bg-slate-200 dark:bg-zinc-700 rounded w-3/4"></div>
                        <div class="h-4 bg-slate-200 dark:bg-zinc-700 rounded"></div>
                        <div class="h-4 bg-slate-200 dark:bg-zinc-700 rounded w-5/6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jenis Aplikasi Modal -->
    <div id="jenisAplikasiModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeAllModals()"></div>
            <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all ring-1 ring-gray-200 dark:ring-zinc-700">
                <div class="bg-gradient-to-r from-purple-600 to-violet-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-cube w-5 h-5 text-white flex items-center justify-center"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white">Total Aplikasi</h3>
                                <p class="text-purple-200 text-xs">Berdasarkan jenis aplikasi</p>
                            </div>
                        </div>
                        <button onclick="closeAllModals()" class="text-white/80 hover:text-white transition-colors hover:bg-white/10 rounded-lg p-1.5">
                            <i class="fa-solid fa-xmark w-5 h-5 flex items-center justify-center"></i>
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-2.5">
                        @php $jenisColors = ['bg-blue-500', 'bg-emerald-500', 'bg-amber-500', 'bg-rose-500', 'bg-purple-500', 'bg-cyan-500', 'bg-orange-500', 'bg-indigo-500']; @endphp
                        @foreach($jenisAplikasiStats as $i => $jenis)
                        <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-zinc-800 rounded-xl border border-slate-100 dark:border-zinc-700/50">
                            <div class="w-3 h-3 rounded-full {{ $jenisColors[$i % count($jenisColors)] }} flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $jenis->jenis }}</span>
                                    <span class="text-xs font-bold text-slate-900 dark:text-white bg-slate-200 dark:bg-zinc-700 px-2 py-0.5 rounded-full">{{ $jenis->total }}</span>
                                </div>
                                <div class="h-1.5 bg-slate-200 dark:bg-zinc-700 rounded-full overflow-hidden">
                                    <div class="h-full {{ $jenisColors[$i % count($jenisColors)] }} rounded-full transition-all" style="width: {{ round(($jenis->total / max($opdStats->sum('web_apps_count'), 1)) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-5 pt-4 border-t border-slate-100 dark:border-zinc-800 flex items-center justify-between">
                        <span class="text-sm text-slate-500 dark:text-slate-400">Total: <span class="font-bold text-slate-800 dark:text-white">{{ $opdStats->sum('web_apps_count') }}</span> aplikasi</span>
                        <a href="/admin/web-apps" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-semibold text-white bg-gradient-to-r from-purple-600 to-violet-600 rounded-lg hover:from-purple-700 hover:to-violet-700 transition shadow-sm">
                            Lihat Semua
                            <i class="fa-solid fa-arrow-right w-3.5 h-3.5 flex items-center justify-center"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Distribution Chart
        const isDark = document.documentElement.classList.contains('dark');
        const ctx = document.getElementById('distributionChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Sudah Input', 'Belum Input'],
                datasets: [{
                    data: [{{ $opdStats->where('web_apps_count', '>', 0)->count() }}, {{ $emptyOpds->count() }}],
                    backgroundColor: ['#10b981', isDark ? '#3f3f46' : '#e2e8f0'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(24, 24, 27, 0.95)' : 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 13, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: ctx => ctx.label + ': ' + ctx.raw + ' OPD'
                        }
                    }
                }
            }
        });

        // Trend Chart (Bar + Line combo)
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        new Chart(trendCtx, {
            type: 'bar',
            data: {
                labels: @json($trendLabels),
                datasets: [
                    {
                        label: 'App Baru',
                        data: @json($trendData),
                        backgroundColor: isDark ? 'rgba(6, 182, 212, 0.4)' : 'rgba(6, 182, 212, 0.6)',
                        borderColor: 'rgb(6, 182, 212)',
                        borderWidth: 1,
                        borderRadius: 6,
                        order: 2
                    },
                    {
                        label: 'Total Kumulatif',
                        data: @json($trendCumulative),
                        type: 'line',
                        borderColor: 'rgb(99, 102, 241)',
                        backgroundColor: isDark ? 'rgba(99, 102, 241, 0.1)' : 'rgba(99, 102, 241, 0.08)',
                        borderWidth: 2.5,
                        pointBackgroundColor: 'rgb(99, 102, 241)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4,
                        order: 1,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(24, 24, 27, 0.95)' : 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 13, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: ctx => ctx.dataset.label + ': ' + ctx.raw + ' aplikasi'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 10 },
                            color: isDark ? '#71717a' : '#94a3b8',
                            maxRotation: 45
                        }
                    },
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        title: { display: true, text: 'App Baru', font: { size: 10 }, color: isDark ? '#71717a' : '#94a3b8' },
                        grid: { color: isDark ? 'rgba(63, 63, 70, 0.3)' : 'rgba(226, 232, 240, 0.6)' },
                        ticks: {
                            font: { size: 10 },
                            color: isDark ? '#71717a' : '#94a3b8',
                            stepSize: Math.max(1, Math.ceil(Math.max(...@json($trendData)) / 5))
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: { display: true, text: 'Total', font: { size: 10 }, color: isDark ? '#71717a' : '#94a3b8' },
                        grid: { drawOnChartArea: false },
                        ticks: {
                            font: { size: 10 },
                            color: isDark ? '#71717a' : '#94a3b8'
                        }
                    }
                }
            }
        });

        // Filter & Sort
        function applyFilters() {
            const search = document.getElementById('searchOpd').value.toLowerCase();
            const status = document.getElementById('filterStatus').value;
            const sort = document.getElementById('sortBy').value;
            const tbody = document.getElementById('opdTableBody');
            let rows = Array.from(tbody.querySelectorAll('.opd-row'));
            
            rows.sort((a, b) => {
                const appsA = parseInt(a.getAttribute('data-apps'), 10) || 0;
                const appsB = parseInt(b.getAttribute('data-apps'), 10) || 0;
                const nameA = (a.getAttribute('data-name') || '').trim();
                const nameB = (b.getAttribute('data-name') || '').trim();
                
                switch(sort) {
                    case 'apps_desc': return appsB - appsA;
                    case 'apps_asc': return appsA - appsB;
                    case 'name_asc': return nameA.localeCompare(nameB, 'id');
                    case 'name_desc': return nameB.localeCompare(nameA, 'id');
                    default: return 0;
                }
            });
            
            rows.forEach(row => tbody.appendChild(row));
            
            let visibleCount = 0;
            let rankNumber = 0;
            rows.forEach(row => {
                const name = row.getAttribute('data-name') || '';
                const rowStatus = row.getAttribute('data-status') || '';
                
                const matchesSearch = name.includes(search);
                const matchesStatus = status === 'all' || rowStatus === status;
                const isVisible = matchesSearch && matchesStatus;
                
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) {
                    visibleCount++;
                    rankNumber++;
                    const rankBadge = row.querySelector('td:first-child span');
                    if (rankBadge) {
                        rankBadge.textContent = rankNumber;
                        rankBadge.className = 'inline-flex items-center justify-center w-7 h-7 text-xs font-bold rounded-lg ' +
                            (rankNumber <= 3 ? 'bg-gradient-to-br from-yellow-300 to-amber-500 text-white shadow-sm' : 'bg-slate-100 dark:bg-zinc-800 text-slate-500 dark:text-slate-400');
                    }
                }
            });
            
            document.getElementById('emptyState').classList.toggle('hidden', visibleCount > 0);
        }

        function sortTable(column) {
            const sortBy = document.getElementById('sortBy');
            switch(column) {
                case 'apps':
                    sortBy.value = sortBy.value === 'apps_desc' ? 'apps_asc' : 'apps_desc';
                    break;
                case 'name':
                    sortBy.value = sortBy.value === 'name_asc' ? 'name_desc' : 'name_asc';
                    break;
                case 'rank':
                    sortBy.value = sortBy.value === 'apps_desc' ? 'apps_asc' : 'apps_desc';
                    break;
            }
            applyFilters();
        }

        // Show OPD Detail Modal
        function showOpdDetail(opdId, opdName) {
            document.getElementById('modalOpdName').textContent = opdName;
            document.getElementById('opdDetailModal').classList.remove('hidden');
            
            fetch(`/admin/opd/${opdId}/apps`)
                .then(res => res.json())
                .then(data => {
                    const content = document.getElementById('modalContent');
                    if (data.apps.length === 0) {
                        content.innerHTML = `
                            <div class="text-center py-10">
                                <div class="w-16 h-16 bg-slate-100 dark:bg-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-box-open w-8 h-8 text-slate-400 flex items-center justify-center"></i>
                                </div>
                                <p class="text-slate-600 dark:text-slate-400 font-medium">Belum ada aplikasi terdaftar</p>
                                <p class="text-slate-500 text-sm mt-1">OPD ini belum menginput data aplikasi</p>
                            </div>
                        `;
                    } else {
                        content.innerHTML = `
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">${data.apps.length} aplikasi terdaftar</p>
                            <div class="space-y-2 max-h-80 overflow-y-auto pr-1">
                                ${data.apps.map((app, i) => `
                                    <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-zinc-800 rounded-xl border border-slate-100 dark:border-zinc-700/50 hover:border-indigo-200 dark:hover:border-indigo-800 transition-colors group">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <span class="text-[10px] font-bold text-white">${i + 1}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-slate-800 dark:text-slate-200 truncate">${app.nama_web_app}</p>
                                            ${app.alamat_tautan ? `<a href="${app.alamat_tautan}" target="_blank" class="text-[10px] text-blue-600 dark:text-blue-400 hover:underline truncate block">${app.alamat_tautan}</a>` : ''}
                                        </div>
                                        <a href="/admin/web-apps/${app.id}" class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition ring-1 ring-indigo-200 dark:ring-indigo-800 opacity-0 group-hover:opacity-100 flex-shrink-0">
                                            Lihat →
                                        </a>
                                    </div>
                                `).join('')}
                            </div>
                        `;
                    }
                });
        }

        function showJenisAplikasi() {
            document.getElementById('jenisAplikasiModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('opdDetailModal').classList.add('hidden');
        }

        function closeAllModals() {
            document.getElementById('opdDetailModal').classList.add('hidden');
            document.getElementById('jenisAplikasiModal').classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAllModals();
        });

        document.addEventListener('DOMContentLoaded', function() {
            applyFilters();
        });
    </script>

    <style>
        @keyframes pulse-ring { 0% { transform: scale(0.95); opacity: 0.7; } 50% { transform: scale(1.05); opacity: 0.3; } 100% { transform: scale(0.95); opacity: 0.7; } }
    </style>
</x-admin-layout>
