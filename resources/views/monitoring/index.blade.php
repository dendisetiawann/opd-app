<x-app-layout>

    <style>
        @keyframes pulse-ring {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.15); opacity: 0.2; }
            100% { transform: scale(1); opacity: 0.5; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        @keyframes sparkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.5); }
        }
    </style>

    <!-- Tab Buttons -->
    <div class="flex items-center gap-2 mb-6 bg-gray-100 dark:bg-zinc-800 p-1 rounded-xl w-fit">
        <button id="tabRingkasan" onclick="switchTab('ringkasan')" class="px-5 py-2.5 text-sm font-semibold rounded-lg transition-all bg-white dark:bg-zinc-900 text-slate-800 dark:text-white shadow-sm">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                {{ $opd->nama_opd }}
            </span>
        </button>
        <button id="tabSemuaOpd" onclick="switchTab('semuaOpd')" class="px-5 py-2.5 text-sm font-semibold rounded-lg transition-all text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-building w-4 h-4 flex items-center justify-center"></i>
                Semua OPD

            </span>
        </button>
    </div>

    <!-- Panel: Ringkasan -->
    <div id="panelRingkasan">

    <!-- Header -->
    <div class="relative bg-white dark:bg-black rounded-2xl p-6 mb-6 overflow-hidden shadow-sm border border-gray-100 dark:border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-cyan-50/30 dark:hidden"></div>
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan-500/10 via-blue-500/5 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
        </div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 dark:bg-cyan-900/50 dark:border dark:border-cyan-700/50 text-white dark:text-cyan-100 text-[10px] font-bold uppercase tracking-wider shadow-sm mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Monitoring OPD
                </div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-white">{{ $opd->nama_opd ?? 'OPD Anda' }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Ringkasan data aplikasi milik OPD Anda</p>
            </div>
            <a href="{{ route('monitoring.export-opd') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                <i class="fa-solid fa-file-excel w-4 h-4 flex items-center justify-center"></i>
                Export Excel
            </a>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <!-- Total Aplikasi -->
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-800 rounded-xl p-5 shadow-lg shadow-blue-500/20 dark:shadow-blue-900/40 cursor-pointer hover:shadow-xl hover:scale-[1.02] transition-all" onclick="showJenisAppModal()">
            <!-- Light Mode Bubbles -->
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full dark:hidden"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full dark:hidden"></div>
            <!-- Dark Mode Animated Decorations -->
            <div class="hidden dark:block absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/5 rounded-full" style="animation: pulse-ring 4s ease-out infinite;"></div>
            <div class="hidden dark:block absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full animate-pulse" style="animation-duration: 3s;"></div>
            <div class="hidden dark:block absolute top-4 right-16 w-2 h-2 bg-white/30 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="hidden dark:block absolute top-1/3 right-1/4 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-xs font-medium uppercase tracking-wider mb-1">Total Aplikasi</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_apps'] }}</p>
                        <p class="text-blue-200/70 text-xs mt-1">Klik untuk lihat detail</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-desktop w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total User OPD -->
        <div class="relative overflow-hidden bg-gradient-to-br from-violet-500 to-violet-600 dark:from-violet-600 dark:to-violet-800 rounded-xl p-5 shadow-lg shadow-violet-500/20 dark:shadow-violet-900/40">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-violet-100 text-xs font-medium uppercase tracking-wider mb-1">User OPD</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-users w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Punya Repository -->
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-500 dark:from-amber-600 dark:to-orange-700 rounded-xl p-5 shadow-lg shadow-amber-500/20 dark:shadow-amber-900/40">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-xs font-medium uppercase tracking-wider mb-1">Punya Repository</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['apps_with_repo'] }}</p>
                        <p class="text-amber-100 text-xs mt-1">{{ round(($stats['apps_with_repo'] / max($stats['total_apps'], 1)) * 100) }}% dari total</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-folder-open w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Teknologi -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <i class="fa-solid fa-code w-4.5 h-4.5 text-white flex items-center justify-center"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-gray-800 dark:text-zinc-100">Teknologi</h2>
                <p class="text-xs text-gray-500 dark:text-zinc-500">Framework, bahasa, DBMS & arsitektur sistem</p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <!-- Framework -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/20 border-b border-blue-100/60 dark:border-blue-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-500/10 dark:bg-blue-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-globe w-3.5 h-3.5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Framework</h3>
                        <span class="ml-auto text-[10px] font-semibold text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/40 px-2 py-0.5 rounded-full">{{ $topFrameworks->count() }} framework</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-5 items-start">
                        <div class="w-36 h-36 flex-shrink-0"><canvas id="frameworkChart"></canvas></div>
                        <div class="flex-1 space-y-1.5 min-w-0">
                            @foreach($topFrameworks->take(7) as $fw)
                            @php $fwPct = round(($fw->total / max($stats['total_apps'], 1)) * 100); @endphp
                            <div class="group flex items-center gap-2 text-sm hover:bg-blue-50/70 dark:hover:bg-blue-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showVersionBreakdown('framework', '{{ $fw->framework }}', 'opd')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $fw->framework ?: '-' }}</span>
                                <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all" style="width: {{ min($fwPct, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $fw->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                            </div>
                            @endforeach
                            @if($topFrameworks->count() > 7)
                            <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 rounded-lg transition-all font-semibold" onclick="showFrameworkAllModal()">
                                <span>Lihat semua ({{ $topFrameworks->count() - 7 }} lainnya)</span>
                                <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        <!-- Bahasa -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-purple-50 to-fuchsia-50 dark:from-purple-950/30 dark:to-fuchsia-950/20 border-b border-purple-100/60 dark:border-purple-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-fire w-3.5 h-3.5 text-purple-600 dark:text-purple-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Bahasa Pemrograman</h3>
                        <span class="ml-auto text-[10px] font-semibold text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900/40 px-2 py-0.5 rounded-full">{{ $bahasaStats->count() }} bahasa</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-5 items-start">
                        <div class="w-36 h-36 flex-shrink-0"><canvas id="bahasaChart"></canvas></div>
                        <div class="flex-1 space-y-1.5 min-w-0">
                            @foreach($bahasaStats->take(7) as $bs)
                            @php $bsPct = round(($bs->total / max($stats['total_apps'], 1)) * 100); @endphp
                            <div class="group flex items-center gap-2 text-sm hover:bg-purple-50/70 dark:hover:bg-purple-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showVersionBreakdown('bahasa_pemrograman', '{{ $bs->bahasa_pemrograman }}', 'opd')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $bs->bahasa_pemrograman ?: '-' }}</span>
                                <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="h-full bg-gradient-to-r from-purple-400 to-fuchsia-500 rounded-full transition-all" style="width: {{ min($bsPct, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $bs->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                            </div>
                            @endforeach
                            @if($bahasaStats->count() > 7)
                            <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50/50 dark:hover:bg-purple-900/10 rounded-lg transition-all font-semibold" onclick="showBahasaAllModal()">
                                <span>Lihat semua ({{ $bahasaStats->count() - 7 }} lainnya)</span>
                                <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        <!-- DBMS -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/30 dark:to-teal-950/20 border-b border-emerald-100/60 dark:border-emerald-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-cube w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">DBMS</h3>
                        <span class="ml-auto text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/40 px-2 py-0.5 rounded-full">{{ $dbmsStats->count() }} DBMS</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-5 items-start">
                        <div class="w-36 h-36 flex-shrink-0"><canvas id="dbmsChart"></canvas></div>
                        <div class="flex-1 space-y-1.5 min-w-0">
                            @foreach($dbmsStats->take(5) as $db)
                            @php $dbPct = round(($db->total / max($stats['total_apps'], 1)) * 100); @endphp
                            <div class="group flex items-center gap-2 text-sm hover:bg-emerald-50/70 dark:hover:bg-emerald-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showDbmsVersionBreakdown('{{ $db->dbms }}', 'opd')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $db->dbms ?: '-' }}</span>
                                <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all" style="width: {{ min($dbPct, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $db->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                            </div>
                            @endforeach
                            @if($dbmsStats->count() > 5)
                            <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 rounded-lg transition-all font-semibold" onclick="showDbmsModal()">
                                <span>Lihat semua ({{ $dbmsStats->count() - 5 }} lainnya)</span>
                                <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        <!-- Arsitektur -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/20 border-b border-amber-100/60 dark:border-amber-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-amber-500/10 dark:bg-amber-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-boxes-stacked w-3.5 h-3.5 text-amber-600 dark:text-amber-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Arsitektur Sistem</h3>
                        <span class="ml-auto text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/40 px-2 py-0.5 rounded-full">{{ $arsitekturStats->count() }} arsitektur</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-5 items-start">
                        <div class="w-36 h-36 flex-shrink-0"><canvas id="arsitekturChart"></canvas></div>
                        <div class="flex-1 space-y-1.5 min-w-0">
                            @foreach($arsitekturStats as $ar)
                            @php $arPct = round(($ar->total / max($stats['total_apps'], 1)) * 100); @endphp
                            <div class="group flex items-center gap-2 text-sm hover:bg-amber-50/70 dark:hover:bg-amber-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showApps('arsitektur_sistem', '{{ $ar->arsitektur_sistem }}')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $ar->arsitektur_sistem ?: '-' }}</span>
                                <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="h-full bg-gradient-to-r from-amber-400 to-orange-500 rounded-full transition-all" style="width: {{ min($arPct, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $ar->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Library / Package -->
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-rose-50 to-pink-50 dark:from-rose-950/30 dark:to-pink-950/20 border-b border-rose-100/60 dark:border-rose-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-rose-500/10 dark:bg-rose-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-trash w-3.5 h-3.5 text-rose-600 dark:text-rose-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Library / Package</h3>
                        <span class="ml-auto text-[10px] font-semibold text-rose-600 dark:text-rose-400 bg-rose-100 dark:bg-rose-900/40 px-2 py-0.5 rounded-full">{{ $libraryStats->count() }} library</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-5 items-start">
                        <div class="w-36 h-36 flex-shrink-0"><canvas id="libraryChart"></canvas></div>
                        <div class="flex-1 space-y-1.5 min-w-0">
                            @foreach($libraryStats->take(7) as $lib)
                            @php $libPct = round(($lib->total / max($stats['total_apps'], 1)) * 100); @endphp
                            <div class="group flex items-center gap-2 text-sm hover:bg-rose-50/70 dark:hover:bg-rose-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showLibraryVersionBreakdown('{{ $lib->library }}', 'opd')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $lib->library ?: '-' }}</span>
                                <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="h-full bg-gradient-to-r from-rose-400 to-pink-500 rounded-full transition-all" style="width: {{ min($libPct, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $lib->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                            </div>
                            @endforeach
                            @if($libraryStats->count() > 7)
                            <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 hover:bg-rose-50/50 dark:hover:bg-rose-900/10 rounded-lg transition-all font-semibold" onclick="showLibraryAllModal()">
                                <span>Lihat semua ({{ $libraryStats->count() - 7 }} lainnya)</span>
                                <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Repository -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <i class="fa-solid fa-folder-open w-4.5 h-4.5 text-white flex items-center justify-center"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-gray-800 dark:text-zinc-100">Repository</h2>
                <p class="text-xs text-gray-500 dark:text-zinc-500">Kepemilikan, tipe & penyedia repository</p>
            </div>
        </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/30 dark:to-green-950/20 border-b border-emerald-100/60 dark:border-emerald-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-pen-to-square w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Kepemilikan</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-4 items-start">
                        <div class="w-28 h-28 flex-shrink-0"><canvas id="hasRepoChart"></canvas></div>
                        <div class="flex-1 space-y-2 min-w-0">
                            @foreach($hasRepoStats as $item)
                            <div class="flex items-center justify-between text-sm hover:bg-emerald-50/70 dark:hover:bg-emerald-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('has_repository', '{{ $item->has_repository }}')">
                                <span class="inline-flex items-center gap-1.5 font-medium {{ $item->has_repository == 'ya' ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                                    <i class="fa-solid {{ $item->has_repository == 'ya' ? 'fa-circle-check' : 'fa-circle-xmark' }} w-3.5 h-3.5 flex items-center justify-center"></i>
                                    {{ $item->has_repository == 'ya' ? 'Punya' : 'Tidak Punya' }}
                                </span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $item->has_repository == 'ya' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400' }}">{{ $item->total }} aplikasi</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-blue-50 to-sky-50 dark:from-blue-950/30 dark:to-sky-950/20 border-b border-blue-100/60 dark:border-blue-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-500/10 dark:bg-blue-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-chart-line w-3.5 h-3.5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Tipe Repository</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-4 items-start">
                        <div class="w-28 h-28 flex-shrink-0"><canvas id="gitTypeChart"></canvas></div>
                        <div class="flex-1 space-y-2 min-w-0">
                            @foreach($gitTypeStats as $item)
                            @if($item->git_repository)
                            <div class="flex items-center justify-between text-sm hover:bg-blue-50/70 dark:hover:bg-blue-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('git_repository', '{{ $item->git_repository }}')">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $item->git_repository }}</span>
                                <span class="text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-950/30 dark:to-amber-950/20 border-b border-orange-100/60 dark:border-orange-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-orange-500/10 dark:bg-orange-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-building w-3.5 h-3.5 text-orange-600 dark:text-orange-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Penyedia</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-4 items-start">
                        <div class="w-28 h-28 flex-shrink-0"><canvas id="providerChart"></canvas></div>
                        <div class="flex-1 space-y-2 min-w-0">
                            @foreach($providerStats->filter(fn($item) => $item->penyedia_repository)->take(3) as $item)
                            <div class="flex items-center justify-between text-sm hover:bg-orange-50/70 dark:hover:bg-orange-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('penyedia_repository', '{{ $item->penyedia_repository }}')">
                                <span class="text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->penyedia_repository }}</span>
                                <span class="text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </div>
                            @endforeach
                            @if($providerStats->filter(fn($item) => $item->penyedia_repository)->count() > 3)
                            <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 rounded-lg transition-all font-semibold" onclick="showProviderModal()">
                                <span>Lihat semua ({{ $providerStats->filter(fn($item) => $item->penyedia_repository)->count() - 3 }} lainnya)</span>
                                <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>

    <!-- Section: Database -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                <i class="fa-solid fa-cube w-4.5 h-4.5 text-white flex items-center justify-center"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-gray-800 dark:text-zinc-100">Database</h2>
                <p class="text-xs text-gray-500 dark:text-zinc-500">Lokasi & akses database</p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-cyan-50 to-sky-50 dark:from-cyan-950/30 dark:to-sky-950/20 border-b border-cyan-100/60 dark:border-cyan-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-cyan-500/10 dark:bg-cyan-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-bullseye w-3.5 h-3.5 text-cyan-600 dark:text-cyan-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Lokasi Database</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-4 items-start">
                        <div class="w-32 h-32 flex-shrink-0"><canvas id="lokasiChart"></canvas></div>
                        <div class="flex-1 space-y-2 min-w-0">
                            @foreach($lokasiStats as $item)
                            <div class="group flex items-center gap-2 text-sm hover:bg-cyan-50/70 dark:hover:bg-cyan-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('lokasi_database', '{{ $item->lokasi_database }}')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->lokasi_database == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : ($item->lokasi_database ?: '-') }}</span>
                                <span class="text-xs font-bold bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                <div class="px-5 py-3.5 bg-gradient-to-r from-teal-50 to-emerald-50 dark:from-teal-950/30 dark:to-emerald-950/20 border-b border-teal-100/60 dark:border-teal-900/30">
                    <div class="flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-teal-500/10 dark:bg-teal-500/20 flex items-center justify-center">
                            <i class="fa-solid fa-building-lock w-3.5 h-3.5 text-teal-600 dark:text-teal-400 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Akses Database</h3>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex gap-4 items-start">
                        <div class="w-32 h-32 flex-shrink-0"><canvas id="aksesChart"></canvas></div>
                        <div class="flex-1 space-y-2 min-w-0">
                            @foreach($aksesStats as $item)
                            <div class="group flex items-center gap-2 text-sm hover:bg-teal-50/70 dark:hover:bg-teal-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('akses_database', '{{ $item->akses_database }}')">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->akses_database ?: '-' }}</span>
                                <span class="text-xs font-bold bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- end panelRingkasan -->

    <!-- Panel: Semua OPD -->
    <div id="panelSemuaOpd" class="hidden">

    <!-- Header -->
    <div class="relative bg-white dark:bg-black rounded-2xl p-6 mb-6 overflow-hidden shadow-sm border border-gray-100 dark:border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-indigo-50/30 dark:hidden"></div>
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-500/10 via-purple-500/5 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
        </div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 dark:bg-indigo-900/50 dark:border dark:border-indigo-700/50 text-white dark:text-indigo-100 text-[10px] font-bold uppercase tracking-wider shadow-sm mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                    OPD Analytics

                </div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-white">Statistik Seluruh OPD</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Data kontribusi dan partisipasi semua OPD dalam pengembangan aplikasi</p>
            </div>
        </div>
    </div>

    <!-- Sub Tab Navigation -->
    <div class="sticky top-0 z-20 -mx-1 px-1 pt-3 pb-4 bg-white/95 dark:bg-zinc-950/95 backdrop-blur-lg border-b border-gray-200 dark:border-zinc-800 shadow-sm">
    <div class="flex items-center gap-2">
        <button id="subTabDaftar" onclick="switchSubTab('daftar')" class="sub-tab-btn group relative px-5 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-md shadow-indigo-500/25 ring-1 ring-indigo-500/50">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-bars w-4 h-4 flex items-center justify-center"></i>
                Daftar OPD
            </span>
        </button>
        <button id="subTabTeknologi" onclick="switchSubTab('teknologi')" class="sub-tab-btn group relative px-5 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 bg-white dark:bg-zinc-800 text-gray-500 dark:text-gray-400 ring-1 ring-gray-200 dark:ring-zinc-700 hover:text-indigo-600 dark:hover:text-indigo-400 hover:ring-indigo-300 dark:hover:ring-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-950/30">
            <span class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                Teknologi
            </span>
        </button>
    </div>
    </div>

    <!-- Panel: Daftar OPD -->
    <div id="subPanelDaftar">

    <!-- OPD KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <!-- Total OPD -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20 flex-shrink-0">
                    <i class="fa-solid fa-circle-check w-6 h-6 text-white flex items-center justify-center"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total OPD</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $opdStats->count() }}</h3>
                    <div class="flex items-center gap-1 mt-1">
                        <span class="flex items-center gap-1 text-[10px] font-semibold text-emerald-600 dark:text-emerald-400"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>{{ $opdStats->where('web_apps_count', '>', 0)->count() }} Aktif</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rata-rata -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center shadow-lg shadow-emerald-500/20 flex-shrink-0">
                    <i class="fa-solid fa-network-wired w-6 h-6 text-white flex items-center justify-center"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Rata-rata App/OPD</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $avgAppsPerOpd }}</h3>
                    <div class="w-24 bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 mt-1.5">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-1.5 rounded-full" style="width: {{ min($avgAppsPerOpd * 10, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Aplikasi (clickable popup) -->
        <div onclick="document.getElementById('jenisAppModalAll').classList.remove('hidden')" class="group bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800 hover:border-purple-200 dark:hover:border-purple-800 hover:shadow-md transition-all cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-violet-600 flex items-center justify-center shadow-lg shadow-purple-500/20 flex-shrink-0">
                    <i class="fa-solid fa-circle-check w-6 h-6 text-white flex items-center justify-center"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Aplikasi</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white">{{ $opdStats->sum('web_apps_count') }}</h3>
                    <p class="text-[10px] text-purple-500 dark:text-purple-400 mt-0.5 font-medium">Klik untuk lihat detail →</p>
                </div>
                <i class="fa-solid fa-circle-check w-5 h-5 text-slate-300 dark:text-zinc-600 group-hover:text-purple-500 transition-colors flex-shrink-0"></i>
            </div>
        </div>
    </div>


    <!-- Jenis Aplikasi Popup Modal (Semua OPD) -->
    <div id="jenisAppModalAll" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4" onclick="if(event.target===this) this.classList.add('hidden')">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-violet-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-circle-check w-5 h-5 text-white flex items-center justify-center"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Detail Aplikasi</h3>
                            <p class="text-xs text-purple-200">Berdasarkan jenis aplikasi</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('jenisAppModalAll').classList.add('hidden')" class="w-8 h-8 rounded-lg bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-xmark w-4 h-4 text-white flex items-center justify-center"></i>
                    </button>
                </div>
            </div>
            <div class="px-6 py-4">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100 dark:border-zinc-800">
                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Total Semua Jenis</span>
                    <span class="text-xl font-black text-purple-600 dark:text-purple-400">{{ $opdStats->sum('web_apps_count') }}</span>
                </div>
                <div class="space-y-2.5 max-h-72 overflow-y-auto pr-1">
                    @php
                        $jenisColors = ['bg-blue-500', 'bg-purple-500', 'bg-emerald-500', 'bg-amber-500', 'bg-pink-500', 'bg-cyan-500', 'bg-indigo-500', 'bg-rose-500', 'bg-teal-500', 'bg-orange-500'];
                        $totalAll = $allJenisAppStats->sum('total');
                    @endphp
                    @forelse($allJenisAppStats as $idx => $jenis)
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 dark:bg-zinc-800/50">
                        <div class="w-3 h-3 rounded-full {{ $jenisColors[$idx % count($jenisColors)] }} flex-shrink-0"></div>
                        <span class="flex-1 text-sm font-medium text-slate-700 dark:text-slate-300">{{ $jenis->jenis_aplikasi ?: 'Tidak Diketahui' }}</span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-slate-800 dark:text-white">{{ $jenis->total }}</span>
                            <span class="text-[10px] text-slate-400 font-medium">({{ $totalAll > 0 ? round($jenis->total / $totalAll * 100) : 0 }}%)</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-sm text-slate-400">Belum ada data aplikasi</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="px-6 py-3 border-t border-gray-100 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800/50">
                <button onclick="document.getElementById('jenisAppModalAll').classList.add('hidden')" class="w-full py-2 rounded-xl bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold transition-colors">Tutup</button>
            </div>
        </div>
    </div>

    <!-- OPD Monitoring Chart -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden mb-4">
        <div class="px-5 py-4 border-b border-gray-100 dark:border-zinc-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <i class="fa-solid fa-network-wired w-4.5 h-4.5 text-white flex items-center justify-center"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800 dark:text-white">Jumlah Aplikasi per OPD</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $opdStats->count() }} organisasi — klik bar untuk lihat detail</p>
                </div>
            </div>
        </div>
        <div class="p-5">
            <div style="height: {{ max($opdStats->count() * 32, 300) }}px;">
                <canvas id="opdAllBarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- OPD Detail Modal -->
    <div id="opdDetailModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm" onclick="closeOpdModal()"></div>
            <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-xl max-w-2xl w-full overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white" id="opdModalName">Detail OPD</h3>
                    <button onclick="closeOpdModal()" class="text-white/80 hover:text-white"><i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i></button>
                </div>
                <div class="p-6" id="opdModalContent">
                    <div class="animate-pulse space-y-3"><div class="h-4 bg-slate-200 rounded w-3/4"></div><div class="h-4 bg-slate-200 rounded"></div></div>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- end subPanelDaftar -->

    <div id="subPanelTeknologi" class="hidden space-y-8">

        <!-- Section: Teknologi -->
        <div>
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <i class="fa-solid fa-code w-4.5 h-4.5 text-white flex items-center justify-center"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800 dark:text-zinc-100">Teknologi</h2>
                    <p class="text-xs text-gray-500 dark:text-zinc-500">Framework, bahasa, DBMS & arsitektur sistem</p>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <!-- Framework -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-950/30 dark:to-indigo-950/20 border-b border-blue-100/60 dark:border-blue-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 dark:bg-blue-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-globe w-3.5 h-3.5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Framework</h3>
                            <span class="ml-auto text-[10px] font-semibold text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/40 px-2 py-0.5 rounded-full">{{ $allTopFrameworks->count() }} framework</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-5 items-start">
                            <div class="w-36 h-36 flex-shrink-0"><canvas id="frameworkChart_all"></canvas></div>
                            <div class="flex-1 space-y-1.5 min-w-0">
                                @foreach($allTopFrameworks->take(7) as $fw)
                                @php $fwPct = round(($fw->total / max($allTotalApps, 1)) * 100); @endphp
                                <div class="group flex items-center gap-2 text-sm hover:bg-blue-50/70 dark:hover:bg-blue-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showVersionBreakdown('framework', '{{ $fw->framework }}')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $fw->framework ?: '-' }}</span>
                                    <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                        <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all" style="width: {{ min($fwPct, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $fw->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                                </div>
                                @endforeach
                                @if($allTopFrameworks->count() > 7)
                                <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 hover:bg-blue-50/50 dark:hover:bg-blue-900/10 rounded-lg transition-all font-semibold" onclick="showAllFwModal()">
                                    <span>Lihat semua ({{ $allTopFrameworks->count() - 7 }} lainnya)</span>
                                    <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bahasa -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-purple-50 to-fuchsia-50 dark:from-purple-950/30 dark:to-fuchsia-950/20 border-b border-purple-100/60 dark:border-purple-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-purple-500/10 dark:bg-purple-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-fire w-3.5 h-3.5 text-purple-600 dark:text-purple-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Bahasa Pemrograman</h3>
                            <span class="ml-auto text-[10px] font-semibold text-purple-600 dark:text-purple-400 bg-purple-100 dark:bg-purple-900/40 px-2 py-0.5 rounded-full">{{ $allBahasaStats->count() }} bahasa</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-5 items-start">
                            <div class="w-36 h-36 flex-shrink-0"><canvas id="bahasaChart_all"></canvas></div>
                            <div class="flex-1 space-y-1.5 min-w-0">
                                @foreach($allBahasaStats->take(7) as $bs)
                                @php $bsPct = round(($bs->total / max($allTotalApps, 1)) * 100); @endphp
                                <div class="group flex items-center gap-2 text-sm hover:bg-purple-50/70 dark:hover:bg-purple-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showVersionBreakdown('bahasa_pemrograman', '{{ $bs->bahasa_pemrograman }}')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $bs->bahasa_pemrograman ?: '-' }}</span>
                                    <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                        <div class="h-full bg-gradient-to-r from-purple-400 to-fuchsia-500 rounded-full transition-all" style="width: {{ min($bsPct, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $bs->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                                </div>
                                @endforeach
                                @if($allBahasaStats->count() > 7)
                                <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 hover:bg-purple-50/50 dark:hover:bg-purple-900/10 rounded-lg transition-all font-semibold" onclick="showAllBsModal()">
                                    <span>Lihat semua ({{ $allBahasaStats->count() - 7 }} lainnya)</span>
                                    <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DBMS -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/30 dark:to-teal-950/20 border-b border-emerald-100/60 dark:border-emerald-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-cube w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">DBMS</h3>
                            <span class="ml-auto text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-900/40 px-2 py-0.5 rounded-full">{{ $allDbmsStats->count() }} DBMS</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-5 items-start">
                            <div class="w-36 h-36 flex-shrink-0"><canvas id="dbmsChart_all"></canvas></div>
                            <div class="flex-1 space-y-1.5 min-w-0">
                                @foreach($allDbmsStats->take(5) as $db)
                                @php $dbPct = round(($db->total / max($allTotalApps, 1)) * 100); @endphp
                                <div class="group flex items-center gap-2 text-sm hover:bg-emerald-50/70 dark:hover:bg-emerald-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showDbmsVersionBreakdown('{{ $db->dbms }}')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $db->dbms ?: '-' }}</span>
                                    <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                        <div class="h-full bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transition-all" style="width: {{ min($dbPct, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $db->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                                </div>
                                @endforeach
                                @if($allDbmsStats->count() > 5)
                                <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 hover:bg-emerald-50/50 dark:hover:bg-emerald-900/10 rounded-lg transition-all font-semibold" onclick="showAllDbModal()">
                                    <span>Lihat semua ({{ $allDbmsStats->count() - 5 }} lainnya)</span>
                                    <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Arsitektur -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/20 border-b border-amber-100/60 dark:border-amber-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 dark:bg-amber-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-boxes-stacked w-3.5 h-3.5 text-amber-600 dark:text-amber-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Arsitektur Sistem</h3>
                            <span class="ml-auto text-[10px] font-semibold text-amber-600 dark:text-amber-400 bg-amber-100 dark:bg-amber-900/40 px-2 py-0.5 rounded-full">{{ $allArsitekturStats->count() }} arsitektur</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-5 items-start">
                            <div class="w-36 h-36 flex-shrink-0"><canvas id="arsitekturChart_all"></canvas></div>
                            <div class="flex-1 space-y-1.5 min-w-0">
                                @foreach($allArsitekturStats as $ar)
                                @php $arPct = round(($ar->total / max($allTotalApps, 1)) * 100); @endphp
                                <div class="group flex items-center gap-2 text-sm hover:bg-amber-50/70 dark:hover:bg-amber-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showApps('arsitektur_sistem', '{{ $ar->arsitektur_sistem }}', 'all')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $ar->arsitektur_sistem ?: '-' }}</span>
                                    <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                        <div class="h-full bg-gradient-to-r from-amber-400 to-orange-500 rounded-full transition-all" style="width: {{ min($arPct, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $ar->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Library / Package (All) -->
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-rose-50 to-pink-50 dark:from-rose-950/30 dark:to-pink-950/20 border-b border-rose-100/60 dark:border-rose-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-rose-500/10 dark:bg-rose-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-trash w-3.5 h-3.5 text-rose-600 dark:text-rose-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Library / Package</h3>
                            <span class="ml-auto text-[10px] font-semibold text-rose-600 dark:text-rose-400 bg-rose-100 dark:bg-rose-900/40 px-2 py-0.5 rounded-full">{{ $allLibraryStats->count() }} library</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-5 items-start">
                            <div class="w-36 h-36 flex-shrink-0"><canvas id="libraryChart_all"></canvas></div>
                            <div class="flex-1 space-y-1.5 min-w-0">
                                @foreach($allLibraryStats->take(7) as $lib)
                                @php $libPct = round(($lib->total / max($allTotalApps, 1)) * 100); @endphp
                                <div class="group flex items-center gap-2 text-sm hover:bg-rose-50/70 dark:hover:bg-rose-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showLibraryVersionBreakdown('{{ $lib->library }}', 'all')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $lib->library ?: '-' }}</span>
                                    <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                        <div class="h-full bg-gradient-to-r from-rose-400 to-pink-500 rounded-full transition-all" style="width: {{ min($libPct, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $lib->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                                </div>
                                @endforeach
                                @if($allLibraryStats->count() > 7)
                                <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 hover:bg-rose-50/50 dark:hover:bg-rose-900/10 rounded-lg transition-all font-semibold" onclick="showAllLibModal()">
                                    <span>Lihat semua ({{ $allLibraryStats->count() - 7 }} lainnya)</span>
                                    <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Repository -->
        <div>
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <i class="fa-solid fa-folder-open w-4.5 h-4.5 text-white flex items-center justify-center"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800 dark:text-zinc-100">Repository</h2>
                    <p class="text-xs text-gray-500 dark:text-zinc-500">Kepemilikan, tipe & penyedia repository</p>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/30 dark:to-green-950/20 border-b border-emerald-100/60 dark:border-emerald-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-emerald-500/10 dark:bg-emerald-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-pen-to-square w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Kepemilikan</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-28 h-28 flex-shrink-0"><canvas id="hasRepoChart_all"></canvas></div>
                            <div class="flex-1 space-y-2 min-w-0">
                                @foreach($allHasRepoStats as $item)
                                <div class="flex items-center justify-between text-sm hover:bg-emerald-50/70 dark:hover:bg-emerald-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('has_repository', '{{ $item->has_repository }}', 'all')">
                                    <span class="inline-flex items-center gap-1.5 font-medium {{ $item->has_repository == 'ya' ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                                        <i class="fa-solid {{ $item->has_repository == 'ya' ? 'fa-circle-check' : 'fa-circle-xmark' }} w-3.5 h-3.5 flex items-center justify-center"></i>
                                        {{ $item->has_repository == 'ya' ? 'Punya' : 'Tidak Punya' }}
                                    </span>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $item->has_repository == 'ya' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400' }}">{{ $item->total }} aplikasi</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-blue-50 to-sky-50 dark:from-blue-950/30 dark:to-sky-950/20 border-b border-blue-100/60 dark:border-blue-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 dark:bg-blue-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-chart-line w-3.5 h-3.5 text-blue-600 dark:text-blue-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Tipe Repository</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-28 h-28 flex-shrink-0"><canvas id="gitTypeChart_all"></canvas></div>
                            <div class="flex-1 space-y-2 min-w-0">
                                @foreach($allGitTypeStats as $item)
                                @if($item->git_repository)
                                <div class="flex items-center justify-between text-sm hover:bg-blue-50/70 dark:hover:bg-blue-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('git_repository', '{{ $item->git_repository }}', 'all')">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $item->git_repository }}</span>
                                    <span class="text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-950/30 dark:to-amber-950/20 border-b border-orange-100/60 dark:border-orange-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-orange-500/10 dark:bg-orange-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-building w-3.5 h-3.5 text-orange-600 dark:text-orange-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Penyedia</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-28 h-28 flex-shrink-0"><canvas id="providerChart_all"></canvas></div>
                            <div class="flex-1 space-y-2 min-w-0">
                                @foreach($allProviderStats->filter(fn($item) => $item->penyedia_repository)->take(3) as $item)
                                <div class="flex items-center justify-between text-sm hover:bg-orange-50/70 dark:hover:bg-orange-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('penyedia_repository', '{{ $item->penyedia_repository }}', 'all')">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->penyedia_repository }}</span>
                                    <span class="text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                                </div>
                                @endforeach
                                @if($allProviderStats->filter(fn($item) => $item->penyedia_repository)->count() > 3)
                                <div class="flex items-center justify-between text-xs px-2.5 py-2 cursor-pointer text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 hover:bg-orange-50/50 dark:hover:bg-orange-900/10 rounded-lg transition-all font-semibold" onclick="showAllPvModal()">
                                    <span>Lihat semua ({{ $allProviderStats->filter(fn($item) => $item->penyedia_repository)->count() - 3 }} lainnya)</span>
                                    <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Database -->
        <div>
            <div class="flex items-center gap-3 mb-5">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                    <i class="fa-solid fa-cube w-4.5 h-4.5 text-white flex items-center justify-center"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-gray-800 dark:text-zinc-100">Database</h2>
                    <p class="text-xs text-gray-500 dark:text-zinc-500">Lokasi & akses database</p>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-cyan-50 to-sky-50 dark:from-cyan-950/30 dark:to-sky-950/20 border-b border-cyan-100/60 dark:border-cyan-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-cyan-500/10 dark:bg-cyan-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-bullseye w-3.5 h-3.5 text-cyan-600 dark:text-cyan-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Lokasi Database</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-32 h-32 flex-shrink-0"><canvas id="lokasiChart_all"></canvas></div>
                            <div class="flex-1 space-y-2 min-w-0">
                                @foreach($allLokasiStats as $item)
                                @php $lkPct = $allTotalApps > 0 ? round(($item->total / $allTotalApps) * 100) : 0; @endphp
                                <div class="group flex items-center gap-2 text-sm hover:bg-cyan-50/70 dark:hover:bg-cyan-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('lokasi_database', '{{ $item->lokasi_database }}', 'all')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->lokasi_database == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : ($item->lokasi_database ?: '-') }}</span>
                                    <span class="text-xs font-bold bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm hover:shadow-md border border-gray-100 dark:border-zinc-800 overflow-hidden transition-shadow duration-300">
                    <div class="px-5 py-3.5 bg-gradient-to-r from-teal-50 to-emerald-50 dark:from-teal-950/30 dark:to-emerald-950/20 border-b border-teal-100/60 dark:border-teal-900/30">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-teal-500/10 dark:bg-teal-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-building-lock w-3.5 h-3.5 text-teal-600 dark:text-teal-400 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-sm font-bold text-gray-700 dark:text-zinc-200">Akses Database</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-32 h-32 flex-shrink-0"><canvas id="aksesChart_all"></canvas></div>
                            <div class="flex-1 space-y-2 min-w-0">
                                @foreach($allAksesStats as $item)
                                <div class="group flex items-center gap-2 text-sm hover:bg-teal-50/70 dark:hover:bg-teal-900/15 px-2.5 py-2 rounded-lg transition-all cursor-pointer" onclick="showApps('akses_database', '{{ $item->akses_database }}', 'all')">
                                    <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->akses_database ?: '-' }}</span>
                                    <span class="text-xs font-bold bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div> <!-- end panelSemuaOpd -->

    <style>
        /* Custom scrollbar for table container */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: transparent;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 20px;
        }
        .dark .overflow-x-auto::-webkit-scrollbar-thumb {
            background-color: rgba(75, 85, 99, 0.5);
        }
        /* Sub panels use natural page scroll */
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const blueGradient = ['#0ea5e9', '#38bdf8', '#7dd3fc', '#bae6fd', '#e0f2fe', '#f0f9ff'];
        const purpleGradient = ['#8b5cf6', '#a78bfa', '#c4b5fd', '#ddd6fe', '#ede9fe', '#f5f3ff'];
        const greenGradient = ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#d1fae5', '#ecfdf5'];
        const warmGradient = ['#f59e0b', '#fbbf24', '#fcd34d', '#fde68a', '#fef3c7', '#fffbeb'];
        const roseGradient = ['#f43f5e', '#fb7185', '#fda4af', '#fecdd3', '#ffe4e6', '#fff1f2'];

        const isDark = document.documentElement.classList.contains('dark');
        const chartBorder = isDark ? '#111111' : '#ffffff';

        const chartOpts = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: isDark ? 'rgba(24, 24, 27, 0.95)' : 'rgba(15, 23, 42, 0.9)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    boxPadding: 6,
                    titleColor: '#f5f5f5',
                    bodyColor: '#d4d4d4'
                }
            },
            animation: { animateRotate: true, animateScale: true },
            hover: { mode: 'nearest', intersect: true }
        };

        // Technology Charts
        new Chart(document.getElementById('frameworkChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topFrameworks->pluck('framework')) !!},
                datasets: [{ data: {!! json_encode($topFrameworks->pluck('total')) !!}, backgroundColor: blueGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('bahasaChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($bahasaStats->pluck('bahasa_pemrograman')) !!},
                datasets: [{ data: {!! json_encode($bahasaStats->pluck('total')) !!}, backgroundColor: purpleGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('dbmsChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($dbmsStats->pluck('dbms')) !!},
                datasets: [{ data: {!! json_encode($dbmsStats->pluck('total')) !!}, backgroundColor: greenGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('arsitekturChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($arsitekturStats->pluck('arsitektur_sistem')) !!},
                datasets: [{ data: {!! json_encode($arsitekturStats->pluck('total')) !!}, backgroundColor: ['#0ea5e9', '#10b981', '#f59e0b'], borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        // Library Chart
        new Chart(document.getElementById('libraryChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($libraryStats->take(7)->pluck('library')->values()) !!},
                datasets: [{ data: {!! json_encode($libraryStats->take(7)->pluck('total')->values()) !!}, backgroundColor: roseGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        // Repository Charts
        new Chart(document.getElementById('hasRepoChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($hasRepoStats->pluck('has_repository')->map(fn($v) => $v == 'ya' ? 'Punya' : 'Tidak')) !!},
                datasets: [{ data: {!! json_encode($hasRepoStats->pluck('total')) !!}, backgroundColor: ['#10b981', '#ef4444'], borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('gitTypeChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($gitTypeStats->pluck('git_repository')) !!},
                datasets: [{ data: {!! json_encode($gitTypeStats->pluck('total')) !!}, backgroundColor: ['#3b82f6', '#8b5cf6', '#f59e0b'], borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('providerChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($providerStats->pluck('penyedia_repository')) !!},
                datasets: [{ data: {!! json_encode($providerStats->pluck('total')) !!}, backgroundColor: warmGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        // Database Charts
        new Chart(document.getElementById('lokasiChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($lokasiStats->pluck('lokasi_database')->map(fn($v) => $v == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : $v)) !!},
                datasets: [{ data: {!! json_encode($lokasiStats->pluck('total')) !!}, backgroundColor: blueGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('aksesChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($aksesStats->pluck('akses_database')) !!},
                datasets: [{ data: {!! json_encode($aksesStats->pluck('total')) !!}, backgroundColor: ['#10b981', '#f59e0b', '#ef4444'], borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('versiChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($versiStats->pluck('versi_dbms')) !!},
                datasets: [{ data: {!! json_encode($versiStats->pluck('total')) !!}, backgroundColor: roseGradient, borderWidth: 2, borderColor: chartBorder, hoverOffset: 8 }]
            },
            options: chartOpts
        });

        // OPD All Bar Chart (horizontal)
        const opdBarData = {!! json_encode($opdStats->map(fn($o) => ['id' => $o->id, 'name' => $o->nama_opd, 'count' => $o->web_apps_count])->values()) !!};
        const opdBarLabels = opdBarData.map(d => d.name);
        const opdBarValues = opdBarData.map(d => d.count);
        const opdBarColors = opdBarData.map((d, i) => {
            const palette = [
                'rgba(99, 102, 241, 0.8)',  // indigo
                'rgba(139, 92, 246, 0.8)',  // violet
                'rgba(16, 185, 129, 0.8)',  // emerald
                'rgba(245, 158, 11, 0.8)',  // amber
                'rgba(236, 72, 153, 0.8)',  // pink
                'rgba(6, 182, 212, 0.8)',   // cyan
                'rgba(59, 130, 246, 0.8)',  // blue
                'rgba(168, 85, 247, 0.8)',  // purple
            ];
            return d.count > 0 ? palette[i % palette.length] : 'rgba(203, 213, 225, 0.4)';
        });
        const opdBarBorders = opdBarColors.map(c => c.replace('0.8', '1'));
        const myOpdIndex = opdBarData.findIndex(d => d.id === {{ $myOpdId ?? 'null' }});

        new Chart(document.getElementById('opdAllBarChart'), {
            type: 'bar',
            data: {
                labels: opdBarLabels,
                datasets: [{
                    label: 'Jumlah Aplikasi',
                    data: opdBarValues,
                    backgroundColor: opdBarColors.map((c, i) => i === myOpdIndex ? 'rgba(99, 102, 241, 1)' : c),
                    borderColor: opdBarBorders.map((c, i) => i === myOpdIndex ? 'rgba(79, 70, 229, 1)' : c),
                    borderWidth: 1,
                    borderRadius: 4,
                    barThickness: 22,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                layout: { padding: { right: 20 } },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: isDark ? 'rgba(24, 24, 27, 0.95)' : 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 13, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: ctx => ctx.raw + ' aplikasi'
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: isDark ? 'rgba(63,63,70,0.3)' : 'rgba(226,232,240,0.5)', drawBorder: false },
                        ticks: { font: { size: 11 }, color: isDark ? '#a1a1aa' : '#94a3b8', stepSize: 1 }
                    },
                    y: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 11, weight: '500' },
                            color: (ctx) => ctx.index === myOpdIndex ? (isDark ? '#818cf8' : '#4f46e5') : (isDark ? '#d4d4d8' : '#475569'),
                            callback: function(value) {
                                const label = this.getLabelForValue(value);
                                return label.length > 30 ? label.substring(0, 28) + '…' : label;
                            }
                        }
                    }
                },
                onClick: (evt, elements) => {
                    if (elements.length > 0) {
                        const idx = elements[0].index;
                        const opd = opdBarData[idx];
                        showOpdDetail(opd.id, opd.name);
                    }
                },
                onHover: (evt, elements) => {
                    evt.native.target.style.cursor = elements.length > 0 ? 'pointer' : 'default';
                }
            }
        });

        // Modal closeModal defined later in unified showApps script

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { closeModal(); closeOpdModal(); }
        });

        // All OPD Charts (lazy init)
        let opdChartInitialized = false;
        function initOpdChart() {
            if (opdChartInitialized) return;
            opdChartInitialized = true;

            const chartOpts = { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } };
            const doughnutOpts = { responsive: true, maintainAspectRatio: false, cutout: '60%', plugins: { legend: { display: false } } };

            // Framework (All)
            new Chart(document.getElementById('frameworkChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allTopFrameworks->pluck('framework')->values()) !!},
                    datasets: [{ data: {!! json_encode($allTopFrameworks->pluck('total')->values()) !!}, backgroundColor: blueGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Bahasa (All)
            new Chart(document.getElementById('bahasaChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allBahasaStats->pluck('bahasa_pemrograman')->values()) !!},
                    datasets: [{ data: {!! json_encode($allBahasaStats->pluck('total')->values()) !!}, backgroundColor: purpleGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // DBMS (All)
            new Chart(document.getElementById('dbmsChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allDbmsStats->pluck('dbms')->values()) !!},
                    datasets: [{ data: {!! json_encode($allDbmsStats->pluck('total')->values()) !!}, backgroundColor: greenGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Arsitektur (All)
            new Chart(document.getElementById('arsitekturChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allArsitekturStats->pluck('arsitektur_sistem')->values()) !!},
                    datasets: [{ data: {!! json_encode($allArsitekturStats->pluck('total')->values()) !!}, backgroundColor: warmGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Library (All)
            new Chart(document.getElementById('libraryChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allLibraryStats->take(7)->pluck('library')->values()) !!},
                    datasets: [{ data: {!! json_encode($allLibraryStats->take(7)->pluck('total')->values()) !!}, backgroundColor: roseGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Has Repo (All)
            new Chart(document.getElementById('hasRepoChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allHasRepoStats->map(fn($i) => $i->has_repository == 'ya' ? 'Punya' : 'Tidak')->values()) !!},
                    datasets: [{ data: {!! json_encode($allHasRepoStats->pluck('total')->values()) !!}, backgroundColor: ['#10b981', '#e2e8f0'], borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Git Type (All)
            new Chart(document.getElementById('gitTypeChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allGitTypeStats->pluck('git_repository')->values()) !!},
                    datasets: [{ data: {!! json_encode($allGitTypeStats->pluck('total')->values()) !!}, backgroundColor: blueGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Provider (All)
            new Chart(document.getElementById('providerChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allProviderStats->pluck('penyedia_repository')->values()) !!},
                    datasets: [{ data: {!! json_encode($allProviderStats->pluck('total')->values()) !!}, backgroundColor: warmGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Lokasi DB (All)
            new Chart(document.getElementById('lokasiChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allLokasiStats->pluck('lokasi_database')->map(fn($v) => $v == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : $v)->values()) !!},
                    datasets: [{ data: {!! json_encode($allLokasiStats->pluck('total')->values()) !!}, backgroundColor: greenGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });

            // Akses DB (All)
            new Chart(document.getElementById('aksesChart_all').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($allAksesStats->pluck('akses_database')->values()) !!},
                    datasets: [{ data: {!! json_encode($allAksesStats->pluck('total')->values()) !!}, backgroundColor: roseGradient, borderWidth: 0 }]
                }, options: doughnutOpts
            });


        }

        // showApps defined in unified script below

        // Sub Tab Switching
        function switchSubTab(tab) {
            // Hide all panels
            document.getElementById('subPanelDaftar').classList.add('hidden');
            document.getElementById('subPanelTeknologi').classList.add('hidden');
            
            // Show selected panel
            document.getElementById('subPanel' + tab.charAt(0).toUpperCase() + tab.slice(1)).classList.remove('hidden');
            
            // Active classes
            const activeClasses = ['bg-gradient-to-r', 'from-indigo-600', 'to-blue-600', 'text-white', 'shadow-md', 'shadow-indigo-500/25', 'ring-1', 'ring-indigo-500/50'];
            const inactiveClasses = ['bg-white', 'dark:bg-zinc-800', 'text-gray-500', 'dark:text-gray-400', 'ring-1', 'ring-gray-200', 'dark:ring-zinc-700', 'hover:text-indigo-600', 'dark:hover:text-indigo-400', 'hover:ring-indigo-300', 'dark:hover:ring-indigo-700', 'hover:bg-indigo-50', 'dark:hover:bg-indigo-950/30'];
            
            // Reset all tab buttons to inactive
            const tabs = ['daftar', 'teknologi'];
            tabs.forEach(t => {
                const btn = document.getElementById('subTab' + t.charAt(0).toUpperCase() + t.slice(1));
                activeClasses.forEach(c => btn.classList.remove(c));
                inactiveClasses.forEach(c => btn.classList.add(c));
            });
            
            // Activate selected tab button
            const activeBtn = document.getElementById('subTab' + tab.charAt(0).toUpperCase() + tab.slice(1));
            inactiveClasses.forEach(c => activeBtn.classList.remove(c));
            activeClasses.forEach(c => activeBtn.classList.add(c));
        }



        // OPD Detail Modal - Hanya menampilkan nama aplikasi (tanpa link untuk keamanan)
        function showOpdDetail(id, name) {
            document.getElementById('opdModalName').textContent = name;
            document.getElementById('opdDetailModal').classList.remove('hidden');
            document.getElementById('opdModalContent').innerHTML = '<div class="animate-pulse space-y-3"><div class="h-4 bg-slate-200 rounded w-3/4"></div><div class="h-4 bg-slate-200 rounded"></div></div>';
            fetch(`/monitoring/opd/${id}/apps`).then(r => r.json()).then(data => {
                const c = document.getElementById('opdModalContent');
                if (!data.apps || data.apps.length === 0) {
                    c.innerHTML = '<div class="text-center py-8"><p class="text-slate-500">Belum ada aplikasi terdaftar</p></div>';
                } else {
                    c.innerHTML = `<p class="text-sm text-slate-500 mb-3">${data.apps.length} aplikasi terdaftar:</p><div class="space-y-2 max-h-80 overflow-y-auto">${data.apps.map(a => `<div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-800 rounded-lg"><div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-desktop w-4 h-4 text-white flex items-center justify-center"></i></div><div class="flex-1 min-w-0"><p class="text-sm font-medium text-slate-800 dark:text-slate-200 truncate">${a.nama_web_app}</p></div></div>`).join('')}</div>`;
                }
            }).catch(() => {
                document.getElementById('opdModalContent').innerHTML = '<p class="text-center text-red-500 py-8">Gagal memuat data</p>';
            });
        }
        function closeOpdModal() { document.getElementById('opdDetailModal').classList.add('hidden'); }

        // Tab Switching
        function switchTab(tab) {
            const panelR = document.getElementById('panelRingkasan');
            const panelS = document.getElementById('panelSemuaOpd');
            const tabR = document.getElementById('tabRingkasan');
            const tabS = document.getElementById('tabSemuaOpd');
            const activeBtn = 'bg-white dark:bg-zinc-900 text-slate-800 dark:text-white shadow-sm';
            const inactiveBtn = 'text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300';
            if (tab === 'ringkasan') {
                panelR.classList.remove('hidden');
                panelS.classList.add('hidden');
                tabR.className = 'px-5 py-2.5 text-sm font-semibold rounded-lg transition-all ' + activeBtn;
                tabS.className = 'px-5 py-2.5 text-sm font-semibold rounded-lg transition-all ' + inactiveBtn;
            } else {
                panelR.classList.add('hidden');
                panelS.classList.remove('hidden');
                tabS.className = 'px-5 py-2.5 text-sm font-semibold rounded-lg transition-all ' + activeBtn;
                tabR.className = 'px-5 py-2.5 text-sm font-semibold rounded-lg transition-all ' + inactiveBtn;
                initOpdChart();
            }
        }
    </script>

    <script>
        function showApps(field, value, scope) {
            scope = scope || 'opd';
            const modal = document.getElementById('appsModal');
            const content = document.getElementById('modalContent');
            const title = document.getElementById('modalTitle');
            const subtitle = document.getElementById('modalSubtitle');
            
            const fieldLabels = {
                'jenis_aplikasi': 'Jenis Aplikasi',
                'framework': 'Framework',
                'bahasa_pemrograman': 'Bahasa Pemrograman',
                'dbms': 'DBMS',
                'arsitektur_sistem': 'Arsitektur Sistem',
                'has_repository': 'Repository',
                'git_repository': 'Tipe Repository',
                'penyedia_repository': 'Penyedia Repository',
                'lokasi_database': 'Lokasi Server DBMS',
                'akses_database': 'Akses Database',
                'versi_dbms': 'Versi DBMS',
                'daftar_library_package': 'Library / Package'
            };

            title.textContent = (value || '-');
            subtitle.textContent = fieldLabels[field] || field;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            content.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';
            
            fetch(`{{ route('monitoring.apps-by-filter') }}?field=${encodeURIComponent(field)}&value=${encodeURIComponent(value)}&scope=${scope}`, {
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(r => {
                    if (!r.ok) throw new Error('Server error: ' + r.status);
                    return r.json();
                })
                .then(data => {
                    if (data.apps && data.apps.length > 0) {
                        let html = `<p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Total ${data.total} aplikasi</p>`;

                        if (scope === 'opd') {
                            // OPD sendiri: tampilkan nama + link detail
                            html += '<div class="space-y-2">';
                            data.apps.forEach(app => {
                                html += `
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-zinc-800 rounded-lg border border-gray-100 dark:border-zinc-700/50 hover:bg-gray-100 dark:hover:bg-zinc-700/50 transition">
                                        <div class="flex items-center gap-3 min-w-0 flex-1">
                                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid fa-desktop w-4 h-4 text-white flex items-center justify-center"></i>
                                            </div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-200 truncate">${app.nama_aplikasi}</p>
                                        </div>
                                        <a href="/aplikasi-opd/${app.id}" class="inline-flex items-center gap-1 text-blue-500 hover:text-blue-700 text-sm font-medium flex-shrink-0 ml-3">
                                            <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                                            Detail
                                        </a>
                                    </div>
                                `;
                            });
                            html += '</div>';
                        } else {
                            // Semua OPD: tampilkan nama + nama OPD saja
                            html += '<div class="space-y-2">';
                            data.apps.forEach(app => {
                                html += `
                                    <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-zinc-800 rounded-lg border border-gray-100 dark:border-zinc-700/50">
                                        <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0 mt-1.5"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-200">${app.nama_aplikasi}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">${app.opd?.nama_opd || '-'}</p>
                                        </div>
                                    </div>
                                `;
                            });
                            html += '</div>';
                        }
                        content.innerHTML = html;
                    } else {
                        content.innerHTML = '<p class="text-center text-gray-500 dark:text-gray-400 py-8">Tidak ada aplikasi ditemukan</p>';
                    }
                })
                .catch(err => {
                    content.innerHTML = '<p class="text-center text-red-500 py-8">Gagal memuat data: ' + err.message + '</p>';
                });
        }

        function closeModal(e) {
            if (e && e.target !== e.currentTarget) return;
            const modal = document.getElementById('appsModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    <!-- Modal -->
    <div id="appsModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" onclick="closeModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-2xl w-full max-w-3xl max-h-[80vh] overflow-hidden" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-zinc-800">
                <div>
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Aplikasi</h3>
                    <p id="modalSubtitle" class="text-sm text-gray-500 dark:text-gray-400"></p>
                </div>
                <button onclick="closeModal()" class="p-2 hover:bg-gray-100 dark:hover:bg-zinc-800 rounded-lg transition">
                    <i class="fa-solid fa-xmark w-5 h-5 text-gray-400 flex items-center justify-center"></i>
                </button>
            </div>
            <div id="modalContent" class="p-4 overflow-y-auto max-h-[60vh]">
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jenis Aplikasi Modal -->
    <div id="jenisAppModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeJenisAppModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Jenis Aplikasi</h3>
                    <p class="text-blue-100 text-xs">Total: {{ $stats['total_apps'] }} aplikasi</p>
                </div>
                <button onclick="closeJenisAppModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($jenisAppStats as $jenis)
                <div class="flex items-center justify-between px-4 py-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg cursor-pointer" onclick="closeJenisAppModal(); showApps('jenis_aplikasi', '{{ $jenis->jenis_aplikasi }}')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200">{{ $loop->iteration }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $jenis->jenis_aplikasi ?: 'Tidak ditentukan' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $jenis->total }} <span class="text-gray-400 text-xs">({{ round(($jenis->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Framework All Modal -->
    @if($topFrameworks->count() > 7)
    <div id="frameworkAllModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeFrameworkAllModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Framework Lainnya</h3>
                    <p class="text-blue-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeFrameworkAllModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($topFrameworks->skip(7) as $fw)
                <div class="flex items-center justify-between px-4 py-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:ring-2 hover:ring-blue-300 dark:hover:ring-blue-700 transition cursor-pointer" onclick="closeFrameworkAllModal(); showVersionBreakdown('framework', '{{ $fw->framework }}', 'opd')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200">{{ $loop->iteration + 7 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $fw->framework ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $fw->total }} <span class="text-gray-400 text-xs">({{ round(($fw->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Bahasa All Modal -->
    @if($bahasaStats->count() > 7)
    <div id="bahasaAllModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeBahasaAllModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-purple-600 to-fuchsia-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Bahasa Pemrograman Lainnya</h3>
                    <p class="text-purple-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeBahasaAllModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($bahasaStats->skip(7) as $bs)
                <div class="flex items-center justify-between px-4 py-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:ring-2 hover:ring-purple-300 dark:hover:ring-purple-700 transition cursor-pointer" onclick="closeBahasaAllModal(); showVersionBreakdown('bahasa_pemrograman', '{{ $bs->bahasa_pemrograman }}', 'opd')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-purple-100 text-purple-700 dark:bg-purple-800 dark:text-purple-200">{{ $loop->iteration + 7 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $bs->bahasa_pemrograman ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $bs->total }} <span class="text-gray-400 text-xs">({{ round(($bs->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Library All Modal (Scoped) -->
    @if($libraryStats->count() > 7)
    <div id="libraryAllModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeLibraryAllModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-rose-500 to-pink-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Library / Package Lainnya</h3>
                    <p class="text-rose-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeLibraryAllModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($libraryStats->skip(7) as $lib)
                <div class="flex items-center justify-between px-4 py-3 bg-rose-50 dark:bg-rose-900/20 rounded-lg hover:ring-2 hover:ring-rose-300 dark:hover:ring-rose-700 transition cursor-pointer" onclick="closeLibraryAllModal(); showLibraryVersionBreakdown('{{ $lib->library }}', 'opd')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-800 dark:text-rose-200">{{ $loop->iteration + 7 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $lib->library ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $lib->total }} <span class="text-gray-400 text-xs">({{ round(($lib->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- DBMS Modal -->
    @if($dbmsStats->count() > 3)
    <div id="dbmsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeDbmsModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">DBMS Lainnya</h3>
                    <p class="text-green-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeDbmsModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($dbmsStats->skip(3) as $db)
                <div class="flex items-center justify-between px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg hover:ring-2 hover:ring-green-300 dark:hover:ring-green-700 transition cursor-pointer" onclick="closeDbmsModal(); showDbmsVersionBreakdown('{{ $db->dbms }}', 'opd')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200">{{ $loop->iteration + 3 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $db->dbms ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $db->total }} app <span class="text-gray-400 text-xs">({{ round(($db->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Provider Modal -->
    @if($providerStats->filter(fn($item) => $item->penyedia_repository)->count() > 3)
    <div id="providerModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeProviderModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Penyedia Repository Lainnya</h3>
                    <p class="text-orange-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeProviderModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($providerStats->filter(fn($item) => $item->penyedia_repository)->skip(3) as $item)
                <div class="flex items-center justify-between px-4 py-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:ring-2 hover:ring-orange-300 dark:hover:ring-orange-700 transition cursor-pointer" onclick="closeProviderModal(); showApps('penyedia_repository', '{{ $item->penyedia_repository }}')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-800 dark:text-orange-200">{{ $loop->iteration + 3 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $item->penyedia_repository }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->total }} <span class="text-gray-400 text-xs">({{ round(($item->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- ===================== GLOBAL (Semua OPD) Lainnya Modals ===================== -->

    <!-- All Framework Modal (Global) -->
    @if($allTopFrameworks->count() > 7)
    <div id="allFwModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeAllFwModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Framework Lainnya</h3>
                    <p class="text-blue-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeAllFwModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($allTopFrameworks->skip(7) as $fw)
                <div class="flex items-center justify-between px-4 py-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:ring-2 hover:ring-blue-300 dark:hover:ring-blue-700 transition cursor-pointer" onclick="closeAllFwModal(); showVersionBreakdown('framework', '{{ $fw->framework }}')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200">{{ $loop->iteration + 7 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $fw->framework ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $fw->total }} <span class="text-gray-400 text-xs">({{ round(($fw->total / max($allTotalApps, 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Bahasa Modal (Global) -->
    @if($allBahasaStats->count() > 7)
    <div id="allBsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeAllBsModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-purple-600 to-fuchsia-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Bahasa Pemrograman Lainnya</h3>
                    <p class="text-purple-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeAllBsModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($allBahasaStats->skip(7) as $bs)
                <div class="flex items-center justify-between px-4 py-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:ring-2 hover:ring-purple-300 dark:hover:ring-purple-700 transition cursor-pointer" onclick="closeAllBsModal(); showVersionBreakdown('bahasa_pemrograman', '{{ $bs->bahasa_pemrograman }}')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-purple-100 text-purple-700 dark:bg-purple-800 dark:text-purple-200">{{ $loop->iteration + 7 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $bs->bahasa_pemrograman ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $bs->total }} <span class="text-gray-400 text-xs">({{ round(($bs->total / max($allTotalApps, 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All DBMS Modal (Global) -->
    @if($allDbmsStats->count() > 3)
    <div id="allDbModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeAllDbModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">DBMS Lainnya</h3>
                    <p class="text-green-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeAllDbModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($allDbmsStats->skip(3) as $db)
                <div class="flex items-center justify-between px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg hover:ring-2 hover:ring-green-300 dark:hover:ring-green-700 transition cursor-pointer" onclick="closeAllDbModal(); showDbmsVersionBreakdown('{{ $db->dbms }}')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200">{{ $loop->iteration + 3 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $db->dbms ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $db->total }} app <span class="text-gray-400 text-xs">({{ round(($db->total / max($allTotalApps, 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Provider Modal (Global) -->
    @if($allProviderStats->filter(fn($item) => $item->penyedia_repository)->count() > 3)
    <div id="allPvModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeAllPvModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-orange-500 to-amber-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Penyedia Repository Lainnya</h3>
                    <p class="text-orange-100 text-xs">Klik untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeAllPvModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($allProviderStats->filter(fn($item) => $item->penyedia_repository)->skip(3) as $item)
                <div class="flex items-center justify-between px-4 py-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:ring-2 hover:ring-orange-300 dark:hover:ring-orange-700 transition cursor-pointer" onclick="closeAllPvModal(); showApps('penyedia_repository', '{{ $item->penyedia_repository }}', 'all')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-800 dark:text-orange-200">{{ $loop->iteration + 3 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $item->penyedia_repository }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->total }} <span class="text-gray-400 text-xs">({{ round(($item->total / max($allTotalApps, 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Library Modal (Global) -->
    @if($allLibraryStats->count() > 7)
    <div id="allLibModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeAllLibModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-rose-500 to-pink-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Library / Package Lainnya</h3>
                    <p class="text-rose-100 text-xs">Klik untuk melihat versi detail</p>
                </div>
                <button onclick="closeAllLibModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($allLibraryStats->skip(7) as $lib)
                <div class="flex items-center justify-between px-4 py-3 bg-rose-50 dark:bg-rose-900/20 rounded-lg hover:ring-2 hover:ring-rose-300 dark:hover:ring-rose-700 transition cursor-pointer" onclick="closeAllLibModal(); showLibraryVersionBreakdown('{{ $lib->library }}', 'all')">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-800 dark:text-rose-200">{{ $loop->iteration + 7 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $lib->library ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $lib->total }} <span class="text-gray-400 text-xs">({{ round(($lib->total / max($allTotalApps, 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Version Breakdown Modal -->
    <div id="versionModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeVersionModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white" id="versionModalTitle">Versi</h3>
                    <p class="text-blue-100 text-xs">Klik versi untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeVersionModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto" id="versionModalBody">
                <div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>
            </div>
        </div>
    </div>

    <script>
        // Modal open/close functions
        function showJenisAppModal() {
            const m = document.getElementById('jenisAppModal');
            m.classList.remove('hidden'); m.classList.add('flex');
        }
        function closeJenisAppModal(e) {
            if (e && e.target !== e.currentTarget) return;
            const m = document.getElementById('jenisAppModal');
            m.classList.add('hidden'); m.classList.remove('flex');
        }
        function closeJenisAppModalAll(e) {
            if (e && e.target !== e.currentTarget) return;
            const m = document.getElementById('jenisAppModalAll');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }
        function showFrameworkAllModal() {
            const m = document.getElementById('frameworkAllModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeFrameworkAllModal(e) {
            if (e && e.target !== e.currentTarget) return;
            const m = document.getElementById('frameworkAllModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }
        function showBahasaAllModal() {
            const m = document.getElementById('bahasaAllModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeBahasaAllModal(e) {
            if (e && e.target !== e.currentTarget) return;
            const m = document.getElementById('bahasaAllModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }
        function showDbmsModal() {
            const m = document.getElementById('dbmsModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeDbmsModal(e) {
            if (e && e.target !== e.currentTarget) return;
            const m = document.getElementById('dbmsModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }
        function showProviderModal() {
            const m = document.getElementById('providerModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeProviderModal(e) {
            if (e && e.target !== e.currentTarget) return;
            const m = document.getElementById('providerModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }
        // Global Lainnya modal functions (Semua OPD tab)
        function showAllFwModal() { const m = document.getElementById('allFwModal'); if (m) { m.classList.remove('hidden'); m.classList.add('flex'); } }
        function closeAllFwModal(e) { if (e && e.target !== e.currentTarget) return; const m = document.getElementById('allFwModal'); if (m) { m.classList.add('hidden'); m.classList.remove('flex'); } }
        function showAllBsModal() { const m = document.getElementById('allBsModal'); if (m) { m.classList.remove('hidden'); m.classList.add('flex'); } }
        function closeAllBsModal(e) { if (e && e.target !== e.currentTarget) return; const m = document.getElementById('allBsModal'); if (m) { m.classList.add('hidden'); m.classList.remove('flex'); } }
        function showAllDbModal() { const m = document.getElementById('allDbModal'); if (m) { m.classList.remove('hidden'); m.classList.add('flex'); } }
        function closeAllDbModal(e) { if (e && e.target !== e.currentTarget) return; const m = document.getElementById('allDbModal'); if (m) { m.classList.add('hidden'); m.classList.remove('flex'); } }
        function showAllPvModal() { const m = document.getElementById('allPvModal'); if (m) { m.classList.remove('hidden'); m.classList.add('flex'); } }
        function closeAllPvModal(e) { if (e && e.target !== e.currentTarget) return; const m = document.getElementById('allPvModal'); if (m) { m.classList.add('hidden'); m.classList.remove('flex'); } }
        function showLibraryAllModal() { const m = document.getElementById('libraryAllModal'); if (m) { m.classList.remove('hidden'); m.classList.add('flex'); } }
        function closeLibraryAllModal(e) { if (e && e.target !== e.currentTarget) return; const m = document.getElementById('libraryAllModal'); if (m) { m.classList.add('hidden'); m.classList.remove('flex'); } }
        function showAllLibModal() { const m = document.getElementById('allLibModal'); if (m) { m.classList.remove('hidden'); m.classList.add('flex'); } }
        function closeAllLibModal(e) { if (e && e.target !== e.currentTarget) return; const m = document.getElementById('allLibModal'); if (m) { m.classList.add('hidden'); m.classList.remove('flex'); } }

        // Version Breakdown Modal (user monitoring - read-only)
        function showVersionBreakdown(field, baseName, scope) {
            scope = scope || 'all';
            const modal = document.getElementById('versionModal');
            const body = document.getElementById('versionModalBody');
            const title = document.getElementById('versionModalTitle');

            title.textContent = baseName;
            body.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`{{ route('monitoring.version-breakdown') }}?field=${field}&value=${encodeURIComponent(baseName)}&scope=${scope}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.versions || data.versions.length === 0) {
                        body.innerHTML = '<p class="text-gray-500 text-center py-4">Tidak ada data</p>';
                        return;
                    }

                    const colorClass = field === 'framework' ? {
                        bg: 'bg-blue-50 dark:bg-blue-900/20',
                        badge: 'bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200',
                        ring: 'hover:ring-blue-300 dark:hover:ring-blue-700'
                    } : {
                        bg: 'bg-purple-50 dark:bg-purple-900/20',
                        badge: 'bg-purple-100 text-purple-700 dark:bg-purple-800 dark:text-purple-200',
                        ring: 'hover:ring-purple-300 dark:hover:ring-purple-700'
                    };

                    let html = '';
                    data.versions.forEach((v, i) => {
                        html += `
                            <div class="flex items-center justify-between px-4 py-3 ${colorClass.bg} rounded-lg ${colorClass.ring} hover:ring-2 transition cursor-pointer" onclick="closeVersionModal(); showApps('${field}', '${v.value.replace(/'/g, "\\\\'")}', '${scope}')">
                                <div class="flex items-center gap-3">
                                    <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold ${colorClass.badge}">${i + 1}</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">${v.value}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">${v.total} app</span>
                                    <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                                </div>
                            </div>`;
                    });
                    body.innerHTML = html;
                })
                .catch(() => {
                    body.innerHTML = '<p class="text-red-500 text-center py-4">Gagal memuat data</p>';
                });
        }

        function closeVersionModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('versionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // DBMS Version Breakdown (reuses versionModal)
        function showDbmsVersionBreakdown(dbmsName, scope) {
            scope = scope || 'all';
            const modal = document.getElementById('versionModal');
            const title = document.getElementById('versionModalTitle');
            const body = document.getElementById('versionModalBody');

            title.textContent = 'Versi ' + dbmsName;
            body.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`{{ route('monitoring.dbms-version-breakdown') }}?value=${encodeURIComponent(dbmsName)}&scope=${scope}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.versions || data.versions.length === 0) {
                        body.innerHTML = '<p class="text-gray-500 text-center py-4">Tidak ada data versi</p>';
                        return;
                    }

                    let html = '';
                    data.versions.forEach((v, i) => {
                        html += `
                            <div class="flex items-center justify-between px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg hover:ring-2 hover:ring-green-300 dark:hover:ring-green-700 transition cursor-pointer" onclick="closeVersionModal(); showApps('dbms', '${v.value.replace(/'/g, "\\\\'")}', '${scope}')">
                                <div class="flex items-center gap-3">
                                    <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200">${i + 1}</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">${v.value}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">${v.total} app</span>
                                    <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                                </div>
                            </div>`;
                    });
                    body.innerHTML = html;
                })
                .catch(() => {
                    body.innerHTML = '<p class="text-red-500 text-center py-4">Gagal memuat data</p>';
                });
        }

        // Library Version Breakdown
        function showLibraryVersionBreakdown(libName, scope) {
            scope = scope || 'opd';
            const modal = document.getElementById('versionModal');
            const body = document.getElementById('versionModalBody');
            const title = document.getElementById('versionModalTitle');

            title.textContent = libName;
            body.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-rose-500"></div></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`{{ route('monitoring.library-version-breakdown') }}?value=${encodeURIComponent(libName)}&scope=${scope}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.versions || data.versions.length === 0) {
                        body.innerHTML = '<p class="text-gray-500 text-center py-4">Tidak ada data versi</p>';
                        return;
                    }
                    let html = '';
                    data.versions.forEach((v, i) => {
                        html += `
                            <div class="flex items-center justify-between px-4 py-3 bg-rose-50 dark:bg-rose-900/20 rounded-lg hover:ring-2 hover:ring-rose-300 dark:hover:ring-rose-700 transition cursor-pointer" onclick="closeVersionModal(); showApps('daftar_library_package', '${v.value.replace(/'/g, "\\\\'")}', '${scope}')">  
                                <div class="flex items-center gap-3">
                                    <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-800 dark:text-rose-200">${i + 1}</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">${v.value}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">${v.total} app</span>
                                    <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                                </div>
                            </div>`;
                    });
                    body.innerHTML = html;
                })
                .catch(() => {
                    body.innerHTML = '<p class="text-red-500 text-center py-4">Gagal memuat data</p>';
                });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeJenisAppModal(); closeJenisAppModalAll(); closeFrameworkAllModal(); closeBahasaAllModal();
                closeDbmsModal(); closeProviderModal(); closeModal(); closeVersionModal();
                closeAllFwModal(); closeAllBsModal(); closeAllDbModal(); closeAllPvModal();
                closeLibraryAllModal(); closeAllLibModal();
            }
        });
    </script>

</x-app-layout>
