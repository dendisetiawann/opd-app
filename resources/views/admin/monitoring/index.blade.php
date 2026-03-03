<x-admin-layout>
    <x-slot name="header">Overview</x-slot>

    <!-- Stats Row -->
    <div class="grid grid-cols-4 gap-5 mb-8">
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

        <!-- Total OPD -->
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-5 shadow-lg shadow-emerald-500/20">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-xs font-medium uppercase tracking-wider mb-1">Total OPD</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_opds'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-building w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total User -->
        <div class="relative overflow-hidden bg-gradient-to-br from-violet-500 to-violet-600 rounded-xl p-5 shadow-lg shadow-violet-500/20">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="relative">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-violet-100 text-xs font-medium uppercase tracking-wider mb-1">Total User</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-users w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Punya Repository -->
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl p-5 shadow-lg shadow-amber-500/20 hover:shadow-xl transition-shadow">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 right-0 -mb-8 -mr-8 w-32 h-32 bg-white/5 rounded-full"></div>
            <div class="relative">
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
                            <div class="group flex items-center gap-2 text-sm hover:bg-blue-50/70 dark:hover:bg-blue-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showVersionBreakdown('framework', '{{ $fw->framework }}')">
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
                            <div class="group flex items-center gap-2 text-sm hover:bg-purple-50/70 dark:hover:bg-purple-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showVersionBreakdown('bahasa_pemrograman', '{{ $bs->bahasa_pemrograman }}')">
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
                            <div class="group flex items-center gap-2 text-sm hover:bg-emerald-50/70 dark:hover:bg-emerald-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showDbmsVersionBreakdown('{{ $db->dbms }}')">
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
                            <a href="{{ route('admin.web-apps.index', ['arsitektur_sistem' => $ar->arsitektur_sistem]) }}" class="group flex items-center gap-2 text-sm hover:bg-amber-50/70 dark:hover:bg-amber-900/15 px-2.5 py-1.5 rounded-lg transition-all">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $ar->arsitektur_sistem ?: '-' }}</span>
                                <div class="w-20 h-1.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden flex-shrink-0">
                                    <div class="h-full bg-gradient-to-r from-amber-400 to-orange-500 rounded-full transition-all" style="width: {{ min($arPct, 100) }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 text-right flex-shrink-0 whitespace-nowrap">{{ $ar->total }} <span class="text-gray-400 dark:text-gray-500 font-normal">aplikasi</span></span>
                            </a>
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
                            <div class="group flex items-center gap-2 text-sm hover:bg-rose-50/70 dark:hover:bg-rose-900/15 px-2.5 py-1.5 rounded-lg transition-all cursor-pointer" onclick="showLibraryVersionBreakdown('{{ $lib->library }}')">
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
            <!-- Kepemilikan -->
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
                            <a href="{{ route('admin.web-apps.index', ['has_repository' => $item->has_repository]) }}" class="flex items-center justify-between text-sm hover:bg-emerald-50/70 dark:hover:bg-emerald-900/15 px-2.5 py-2 rounded-lg transition-all">
                                <span class="inline-flex items-center gap-1.5 font-medium {{ $item->has_repository == 'ya' ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500 dark:text-red-400' }}">
                                    <i class="fa-solid {{ $item->has_repository == 'ya' ? 'fa-circle-check' : 'fa-circle-xmark' }} w-3.5 h-3.5 flex items-center justify-center"></i>
                                    {{ $item->has_repository == 'ya' ? 'Punya' : 'Tidak Punya' }}
                                </span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $item->has_repository == 'ya' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400' }}">{{ $item->total }} aplikasi</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tipe -->
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
                            <a href="{{ route('admin.web-apps.index', ['git_repository' => $item->git_repository]) }}" class="flex items-center justify-between text-sm hover:bg-blue-50/70 dark:hover:bg-blue-900/15 px-2.5 py-2 rounded-lg transition-all">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $item->git_repository }}</span>
                                <span class="text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Penyedia -->
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
                            <a href="{{ route('admin.web-apps.index', ['penyedia_repository' => $item->penyedia_repository]) }}" class="flex items-center justify-between text-sm hover:bg-orange-50/70 dark:hover:bg-orange-900/15 px-2.5 py-2 rounded-lg transition-all">
                                <span class="text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->penyedia_repository }}</span>
                                <span class="text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </a>
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
    <div class="mb-8">
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
            <!-- Lokasi -->
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
                            <a href="{{ route('admin.web-apps.index', ['lokasi_database' => $item->lokasi_database]) }}" class="group flex items-center gap-2 text-sm hover:bg-cyan-50/70 dark:hover:bg-cyan-900/15 px-2.5 py-2 rounded-lg transition-all">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->lokasi_database == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : ($item->lokasi_database ?: '-') }}</span>
                                <span class="text-xs font-bold bg-cyan-100 text-cyan-700 dark:bg-cyan-900/40 dark:text-cyan-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akses -->
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
                            <a href="{{ route('admin.web-apps.index', ['akses_database' => $item->akses_database]) }}" class="group flex items-center gap-2 text-sm hover:bg-teal-50/70 dark:hover:bg-teal-900/15 px-2.5 py-2 rounded-lg transition-all">
                                <span class="flex-1 text-gray-700 dark:text-gray-300 font-medium truncate">{{ $item->akses_database ?: '-' }}</span>
                                <span class="text-xs font-bold bg-teal-100 text-teal-700 dark:bg-teal-900/40 dark:text-teal-400 px-2 py-0.5 rounded-full">{{ $item->total }} aplikasi</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtered Apps Section (shown when filter is applied) -->
    @if($filteredApps && $filteredApps->count() > 0)
    <div id="filtered" class="mb-6 scroll-mt-4">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-gray-600 dark:text-zinc-400 uppercase tracking-wide">
                Detail: {{ ucfirst(str_replace('_', ' ', $filterField)) }} - "{{ $filterValue ?: '-' }}"
                <span class="text-xs font-normal text-gray-400 dark:text-zinc-500">({{ $filteredApps->count() }} aplikasi)</span>
            </h2>
            <a href="{{ route('admin.monitoring.index') }}" class="text-xs text-blue-500 hover:text-blue-700">× Tutup Filter</a>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-gray-200 dark:border-zinc-800 divide-y divide-gray-100 dark:divide-zinc-800 max-h-96 overflow-y-auto">
            @foreach($filteredApps as $app)
            <div class="p-4 hover:bg-gray-50 dark:hover:bg-white/[0.03] transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-gray-900 dark:text-zinc-200">{{ $app->nama_web_app }}</p>
                        <p class="text-sm text-gray-500 dark:text-zinc-400">{{ $app->opd->nama_opd ?? '-' }}</p>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 mt-1">
                            Framework: {{ $app->framework ?: '-' }} | 
                            Bahasa: {{ $app->bahasa_pemrograman ?: '-' }} | 
                            DBMS: {{ $app->dbms ?: '-' }}
                        </p>
                    </div>
                    @if($app->alamat_tautan)
                    <a href="{{ $app->alamat_tautan }}" target="_blank" class="text-blue-500 hover:text-blue-700 text-sm">Buka →</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Premium color palettes
        const blueGradient = ['#0ea5e9', '#38bdf8', '#7dd3fc', '#bae6fd', '#e0f2fe', '#f0f9ff'];
        const purpleGradient = ['#8b5cf6', '#a78bfa', '#c4b5fd', '#ddd6fe', '#ede9fe', '#f5f3ff'];
        const greenGradient = ['#10b981', '#34d399', '#6ee7b7', '#a7f3d0', '#d1fae5', '#ecfdf5'];
        const warmGradient = ['#f59e0b', '#fbbf24', '#fcd34d', '#fde68a', '#fef3c7', '#fffbeb'];
        const roseGradient = ['#f43f5e', '#fb7185', '#fda4af', '#fecdd3', '#ffe4e6', '#fff1f2'];
        
        // Chart options with animations
        const chartOpts = {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { size: 13, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: true,
                    boxPadding: 6
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }
        };

        // Technology Charts
        new Chart(document.getElementById('frameworkChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topFrameworks->pluck('framework')) !!},
                datasets: [{
                    data: {!! json_encode($topFrameworks->pluck('total')) !!},
                    backgroundColor: blueGradient,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('bahasaChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($bahasaStats->pluck('bahasa_pemrograman')) !!},
                datasets: [{
                    data: {!! json_encode($bahasaStats->pluck('total')) !!},
                    backgroundColor: purpleGradient,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('dbmsChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($dbmsStats->pluck('dbms')) !!},
                datasets: [{
                    data: {!! json_encode($dbmsStats->pluck('total')) !!},
                    backgroundColor: greenGradient,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('arsitekturChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($arsitekturStats->pluck('arsitektur_sistem')) !!},
                datasets: [{
                    data: {!! json_encode($arsitekturStats->pluck('total')) !!},
                    backgroundColor: ['#0ea5e9', '#10b981', '#f59e0b'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        // Library Chart
        new Chart(document.getElementById('libraryChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($libraryStats->take(7)->pluck('library')->values()) !!},
                datasets: [{
                    data: {!! json_encode($libraryStats->take(7)->pluck('total')->values()) !!},
                    backgroundColor: roseGradient,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        // Repository Charts
        new Chart(document.getElementById('hasRepoChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($hasRepoStats->pluck('has_repository')->map(fn($v) => $v == 'ya' ? 'Punya' : 'Tidak')) !!},
                datasets: [{
                    data: {!! json_encode($hasRepoStats->pluck('total')) !!},
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('gitTypeChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($gitTypeStats->pluck('git_repository')) !!},
                datasets: [{
                    data: {!! json_encode($gitTypeStats->pluck('total')) !!},
                    backgroundColor: ['#3b82f6', '#8b5cf6', '#f59e0b'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('providerChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($providerStats->pluck('penyedia_repository')) !!},
                datasets: [{
                    data: {!! json_encode($providerStats->pluck('total')) !!},
                    backgroundColor: warmGradient,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        // Database Charts
        new Chart(document.getElementById('lokasiChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($lokasiStats->pluck('lokasi_database')->map(fn($v) => $v == 'Lainnya' ? 'Lainnya (di luar Server Kominfo)' : $v)) !!},
                datasets: [{
                    data: {!! json_encode($lokasiStats->pluck('total')) !!},
                    backgroundColor: blueGradient,
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        new Chart(document.getElementById('aksesChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($aksesStats->pluck('akses_database')) !!},
                datasets: [{
                    data: {!! json_encode($aksesStats->pluck('total')) !!},
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: chartOpts
        });

        // Modal functions
        function showApps(field, value) {
            const modal = document.getElementById('appsModal');
            const content = document.getElementById('modalContent');
            const title = document.getElementById('modalTitle');
            const subtitle = document.getElementById('modalSubtitle');
            
            const fieldLabels = {
                'framework': 'Framework',
                'bahasa_pemrograman': 'Bahasa Pemrograman',
                'dbms': 'DBMS',
                'arsitektur_sistem': 'Arsitektur Sistem',
                'has_repository': 'Repository',
                'git_repository': 'Tipe Repository',
                'penyedia_repository': 'Penyedia Repository',
                'lokasi_database': 'Lokasi Server DBMS',
                'akses_database': 'Akses Database',
                'versi_dbms': 'Versi DBMS'
            };

            title.textContent = 'Aplikasi: ' + (value || '-');
            subtitle.textContent = fieldLabels[field] || field;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            content.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';
            
            fetch(`{{ route('admin.monitoring.apps-by-filter') }}?field=${encodeURIComponent(field)}&value=${encodeURIComponent(value)}`, {
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
                        let html = `<p class="text-sm text-gray-500 mb-4">Menampilkan ${data.apps.length} dari ${data.total} aplikasi</p>`;
                        html += '<div class="space-y-2">';
                        data.apps.forEach(app => {
                            html += `
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <div>
                                        <p class="font-medium text-gray-900">${app.nama_aplikasi}</p>
                                        <p class="text-sm text-gray-500">${app.opd?.nama_opd || '-'}</p>
                                    </div>
                                    ${app.url_aplikasi ? `<a href="${app.url_aplikasi}" target="_blank" class="text-blue-500 hover:text-blue-700 text-sm">Buka</a>` : ''}
                                </div>
                            `;
                        });
                        html += '</div>';
                        content.innerHTML = html;
                    } else {
                        content.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada aplikasi ditemukan</p>';
                    }
                })
                .catch(err => {
                    content.innerHTML = '<p class="text-center text-red-500 py-8">Gagal memuat data: ' + err.message + '</p>';
                });
        }

        function closeModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('appsModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Version Breakdown Modal
        function showVersionBreakdown(field, baseName) {
            const modal = document.getElementById('versionModal');
            const body = document.getElementById('versionModalBody');
            const title = document.getElementById('versionModalTitle');

            title.textContent = baseName;
            body.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`{{ route('admin.monitoring.version-breakdown') }}?field=${field}&value=${encodeURIComponent(baseName)}`)
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
                        const filterParam = field === 'framework' ? 'framework' : 'bahasa_pemrograman';
                        const url = `{{ route('admin.web-apps.index') }}?${filterParam}=${encodeURIComponent(v.value)}`;
                        html += `
                            <a href="${url}" class="flex items-center justify-between px-4 py-3 ${colorClass.bg} rounded-lg ${colorClass.ring} hover:ring-2 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold ${colorClass.badge}">${i + 1}</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">${v.value}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">${v.total} app</span>
                                    <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                                </div>
                            </a>`;
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

        // DBMS Version Breakdown (uses versionModal)
        function showDbmsVersionBreakdown(dbmsName) {
            const modal = document.getElementById('versionModal');
            const title = document.getElementById('versionModalTitle');
            const body = document.getElementById('versionModalBody');

            title.textContent = 'Versi ' + dbmsName;
            body.innerHTML = '<div class="flex items-center justify-center py-8"><i class="fa-solid fa-chart-pie animate-spin h-8 w-8 text-green-500 flex items-center justify-center"></i></div>';

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`{{ route('admin.monitoring.dbms-version-breakdown') }}?value=${encodeURIComponent(dbmsName)}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.versions.length) {
                        body.innerHTML = '<p class="text-gray-500 text-center py-4">Tidak ada data versi</p>';
                        return;
                    }

                    let html = '';
                    data.versions.forEach((v, i) => {
                        const url = `{{ route('admin.web-apps.index') }}?dbms=${encodeURIComponent(dbmsName)}&versi_dbms=${encodeURIComponent(v.value.replace(dbmsName + ' ', ''))}`;
                        html += `
                            <a href="${url}" class="flex items-center justify-between px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg hover:ring-2 hover:ring-green-300 dark:hover:ring-green-700 transition">
                                <div class="flex items-center gap-3">
                                    <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200">${i + 1}</span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">${v.value}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">${v.total} app</span>
                                    <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                                </div>
                            </a>`;
                    });
                    body.innerHTML = html;
                })
                .catch(() => {
                    body.innerHTML = '<p class="text-red-500 text-center py-4">Gagal memuat data</p>';
                });
        }

        // Library Version Breakdown
        function showLibraryVersionBreakdown(libName) {
            const modal = document.getElementById('versionModal');
            const body = document.getElementById('versionModalBody');
            const title = document.getElementById('versionModalTitle');

            title.textContent = libName;
            body.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-rose-500"></div></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`{{ route('admin.monitoring.library-version-breakdown') }}?value=${encodeURIComponent(libName)}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.versions || data.versions.length === 0) {
                        body.innerHTML = '<p class="text-gray-500 text-center py-4">Tidak ada data versi</p>';
                        return;
                    }
                    let html = '';
                    data.versions.forEach((v, i) => {
                        html += `
                            <div class="flex items-center justify-between px-4 py-3 bg-rose-50 dark:bg-rose-900/20 rounded-lg hover:ring-2 hover:ring-rose-300 dark:hover:ring-rose-700 transition cursor-pointer" onclick="closeVersionModal(); showApps('daftar_library_package', '${v.value.replace(/'/g, "\\'")}')">  
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

        // Framework All Modal
        function showFrameworkAllModal() {
            const modal = document.getElementById('frameworkAllModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeFrameworkAllModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('frameworkAllModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Library All Modal
        function showLibraryAllModal() {
            const modal = document.getElementById('libraryAllModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeLibraryAllModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('libraryAllModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Bahasa All Modal
        function showBahasaAllModal() {
            const modal = document.getElementById('bahasaAllModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeBahasaAllModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('bahasaAllModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // DBMS Modal
        function showDbmsModal() {
            const modal = document.getElementById('dbmsModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDbmsModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('dbmsModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Jenis Aplikasi Modal
        function showJenisAppModal() {
            const modal = document.getElementById('jenisAppModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeJenisAppModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('jenisAppModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Provider Modal
        function showProviderModal() {
            const modal = document.getElementById('providerModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeProviderModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('providerModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Show Apps Modal (for clickable stats cards)
        function showApps(field, value) {
            const modal = document.getElementById('appsModal');
            const content = document.getElementById('modalContent');
            const title = document.getElementById('modalTitle');
            const subtitle = document.getElementById('modalSubtitle');

            // Set title based on field
             const titles = {
                'has_repository': 'Aplikasi Punya Repository',
                'framework': 'Framework: ' + value,
                'bahasa_pemrograman': 'Bahasa: ' + value,
                'dbms': 'DBMS: ' + value,
                'arsitektur_sistem': 'Arsitektur: ' + value,
                'penyedia_repository': 'Provider: ' + value,
                'daftar_library_package': 'Library: ' + value,
            };
            title.textContent = titles[field] || 'Daftar Aplikasi';
            subtitle.textContent = 'Memuat data...';

            // Show loading
            content.innerHTML = '<div class="flex items-center justify-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            fetch(`/admin/monitoring/apps-by-filter?field=${encodeURIComponent(field)}&value=${encodeURIComponent(value)}`)
                .then(res => res.json())
                .then(data => {
                    subtitle.textContent = data.total + ' aplikasi ditemukan';
                    if (data.apps.length === 0) {
                        content.innerHTML = '<div class="text-center py-8 text-gray-500">Tidak ada aplikasi</div>';
                        return;
                    }
                    content.innerHTML = '<div class="space-y-2">' + data.apps.map((app, i) => `
                        <a href="/admin/web-apps/${app.id}" class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-zinc-800 rounded-xl border border-gray-100 dark:border-zinc-700/50 hover:border-blue-300 dark:hover:border-blue-700 transition group">
                            <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 flex-shrink-0">${i + 1}</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">${app.nama_aplikasi}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">${app.opd?.nama_opd || '-'}</p>
                            </div>
                            <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition flex-shrink-0"></i>
                        </a>
                    `).join('') + '</div>';
                })
                .catch(err => {
                    content.innerHTML = '<div class="text-center py-8 text-red-500">Gagal memuat data</div>';
                });
        }

        function closeModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('appsModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { closeModal(); closeDbmsModal(); closeVersionModal(); closeFrameworkAllModal(); closeBahasaAllModal(); closeJenisAppModal(); closeProviderModal(); closeLibraryAllModal(); }
        });
    </script>

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
                <a href="{{ route('admin.web-apps.index', ['jenis_aplikasi' => $jenis->jenis_aplikasi]) }}" class="flex items-center justify-between px-4 py-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:ring-2 hover:ring-blue-300 dark:hover:ring-blue-700 transition">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-800 dark:text-blue-200">{{ $loop->iteration }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $jenis->jenis_aplikasi ?: 'Tidak ditentukan' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $jenis->total }} <span class="text-gray-400 text-xs">({{ round(($jenis->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Provider Modal -->
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
                <a href="{{ route('admin.web-apps.index', ['penyedia_repository' => $item->penyedia_repository]) }}" class="flex items-center justify-between px-4 py-3 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:ring-2 hover:ring-orange-300 dark:hover:ring-orange-700 transition">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 flex items-center justify-center rounded-lg text-xs font-bold bg-orange-100 text-orange-700 dark:bg-orange-800 dark:text-orange-200">{{ $loop->iteration + 3 }}</span>
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $item->penyedia_repository }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->total }} <span class="text-gray-400 text-xs">({{ round(($item->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                        <i class="fa-solid fa-chevron-right w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- DBMS Modal -->
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
                <div class="flex items-center justify-between px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg hover:ring-2 hover:ring-green-300 dark:hover:ring-green-700 transition cursor-pointer" onclick="closeDbmsModal(); showDbmsVersionBreakdown('{{ $db->dbms }}')">
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

    <!-- Framework All Modal -->
    <div id="frameworkAllModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeFrameworkAllModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Framework Lainnya</h3>
                    <p class="text-blue-100 text-xs">Klik untuk melihat versi detail</p>
                </div>
                <button onclick="closeFrameworkAllModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($topFrameworks->skip(7) as $fw)
                <div class="flex items-center justify-between px-4 py-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:ring-2 hover:ring-blue-300 dark:hover:ring-blue-700 transition cursor-pointer" onclick="closeFrameworkAllModal(); showVersionBreakdown('framework', '{{ $fw->framework }}')">
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

    <!-- Bahasa All Modal -->
    <div id="bahasaAllModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeBahasaAllModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-purple-600 to-fuchsia-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Bahasa Pemrograman Lainnya</h3>
                    <p class="text-purple-100 text-xs">Klik untuk melihat versi detail</p>
                </div>
                <button onclick="closeBahasaAllModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($bahasaStats->skip(7) as $bs)
                <div class="flex items-center justify-between px-4 py-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:ring-2 hover:ring-purple-300 dark:hover:ring-purple-700 transition cursor-pointer" onclick="closeBahasaAllModal(); showVersionBreakdown('bahasa_pemrograman', '{{ $bs->bahasa_pemrograman }}')">
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

    <!-- Library All Modal -->
    <div id="libraryAllModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeLibraryAllModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-rose-500 to-pink-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Library / Package Lainnya</h3>
                    <p class="text-rose-100 text-xs">Klik untuk melihat versi detail</p>
                </div>
                <button onclick="closeLibraryAllModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div class="p-4 space-y-2 max-h-[60vh] overflow-y-auto">
                @foreach($libraryStats->skip(7) as $lib)
                <div class="flex items-center justify-between px-4 py-3 bg-rose-50 dark:bg-rose-900/20 rounded-lg hover:ring-2 hover:ring-rose-300 dark:hover:ring-rose-700 transition cursor-pointer" onclick="closeLibraryAllModal(); showLibraryVersionBreakdown('{{ $lib->library }}')">
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

    <!-- Version Breakdown Modal -->
    <div id="versionModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeVersionModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 id="versionModalTitle" class="text-lg font-bold text-white">Versi</h3>
                    <p class="text-blue-100 text-xs">Klik versi untuk melihat daftar aplikasi</p>
                </div>
                <button onclick="closeVersionModal()" class="text-white/80 hover:text-white transition">
                    <i class="fa-solid fa-xmark w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
            <div id="versionModalBody" class="p-4 space-y-2 max-h-[60vh] overflow-y-auto"></div>
        </div>
    </div>

    <!-- Modal -->
    <div id="appsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeModal(event)">
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-hidden" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 id="modalTitle" class="text-lg font-bold text-white">Daftar Aplikasi</h3>
                    <p id="modalSubtitle" class="text-amber-100 text-xs"></p>
                </div>
                <button onclick="closeModal()" class="text-white/80 hover:text-white transition hover:bg-white/10 rounded-lg p-1.5">
                    <i class="fa-solid fa-xmark w-5 h-5 flex items-center justify-center"></i>
                </button>
            </div>
            <div id="modalContent" class="p-4 overflow-y-auto max-h-[60vh]">
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
