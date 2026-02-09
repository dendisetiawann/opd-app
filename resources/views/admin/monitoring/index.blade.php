<x-admin-layout>
    <x-slot name="header">Overview</x-slot>

    <!-- Stats Row -->
    <div class="grid grid-cols-4 gap-5 mb-8">
        <!-- Total Aplikasi -->
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-800 rounded-xl p-5 shadow-lg shadow-blue-500/20 dark:shadow-blue-900/40">
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
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
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
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
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
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Punya Repository -->
        <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl p-5 shadow-lg shadow-amber-500/20 cursor-pointer hover:shadow-xl transition-shadow" onclick="showApps('has_repository', 'ya')">
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
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Teknologi -->
    <h2 class="text-sm font-semibold text-gray-600 dark:text-zinc-400 uppercase tracking-wide mb-3">Teknologi</h2>
    <div class="grid grid-cols-2 gap-6 mb-6">
        <!-- Framework -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Framework</h3>
            <div class="flex gap-6">
                <div class="w-40 h-40"><canvas id="frameworkChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($topFrameworks as $fw)
                    <a href="{{ route('admin.web-apps.index', ['framework' => $fw->framework]) }}" class="flex items-center justify-between text-sm hover:bg-blue-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $fw->framework ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $fw->total }} <span class="text-gray-400 text-xs">({{ round(($fw->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Bahasa -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Bahasa Pemrograman</h3>
            <div class="flex gap-6">
                <div class="w-40 h-40"><canvas id="bahasaChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($bahasaStats as $bs)
                    <a href="{{ route('admin.web-apps.index', ['bahasa_pemrograman' => $bs->bahasa_pemrograman]) }}" class="flex items-center justify-between text-sm hover:bg-purple-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $bs->bahasa_pemrograman ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $bs->total }} <span class="text-gray-400 text-xs">({{ round(($bs->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- DBMS -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">DBMS</h3>
            <div class="flex gap-6">
                <div class="w-40 h-40"><canvas id="dbmsChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($dbmsStats as $db)
                    <a href="{{ route('admin.web-apps.index', ['dbms' => $db->dbms]) }}" class="flex items-center justify-between text-sm hover:bg-green-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $db->dbms ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $db->total }} <span class="text-gray-400 text-xs">({{ round(($db->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Arsitektur -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Arsitektur Sistem</h3>
            <div class="flex gap-6">
                <div class="w-40 h-40"><canvas id="arsitekturChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($arsitekturStats as $ar)
                    <a href="{{ route('admin.web-apps.index', ['arsitektur_sistem' => $ar->arsitektur_sistem]) }}" class="flex items-center justify-between text-sm hover:bg-amber-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $ar->arsitektur_sistem ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $ar->total }} <span class="text-gray-400 text-xs">({{ round(($ar->total / max($stats['total_apps'], 1)) * 100) }}%)</span></span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Repository -->
    <h2 class="text-sm font-semibold text-gray-600 dark:text-zinc-400 uppercase tracking-wide mb-3">Repository</h2>
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Kepemilikan Repository</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="hasRepoChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($hasRepoStats as $item)
                    <a href="{{ route('admin.web-apps.index', ['has_repository' => $item->has_repository]) }}" class="flex items-center justify-between text-sm hover:bg-emerald-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $item->has_repository == 'ya' ? 'Punya' : 'Tidak' }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Tipe Repository</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="gitTypeChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($gitTypeStats as $item)
                    @if($item->git_repository)
                    <a href="{{ route('admin.web-apps.index', ['git_repository' => $item->git_repository]) }}" class="flex items-center justify-between text-sm hover:bg-blue-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $item->git_repository }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Penyedia Repository</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="providerChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($providerStats as $item)
                    @if($item->penyedia_repository)
                    <a href="{{ route('admin.web-apps.index', ['penyedia_repository' => $item->penyedia_repository]) }}" class="flex items-center justify-between text-sm hover:bg-orange-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $item->penyedia_repository }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Database -->
    <h2 class="text-sm font-semibold text-gray-600 dark:text-zinc-400 uppercase tracking-wide mb-3">Database</h2>
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Lokasi Database</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="lokasiChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($lokasiStats as $item)
                    <a href="{{ route('admin.web-apps.index', ['lokasi_database' => $item->lokasi_database]) }}" class="flex items-center justify-between text-sm hover:bg-cyan-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $item->lokasi_database ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Akses Database</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="aksesChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($aksesStats as $item)
                    <a href="{{ route('admin.web-apps.index', ['akses_database' => $item->akses_database]) }}" class="flex items-center justify-between text-sm hover:bg-teal-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600">{{ $item->akses_database ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-zinc-200 mb-4">Versi DBMS</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="versiChart"></canvas></div>
                <div class="flex-1 space-y-2 max-h-32 overflow-y-auto">
                    @foreach($versiStats as $item)
                    <a href="{{ route('admin.web-apps.index', ['versi_dbms' => $item->versi_dbms]) }}" class="flex items-center justify-between text-sm hover:bg-rose-50 px-2 py-1 rounded transition">
                        <span class="text-gray-600 truncate">{{ $item->versi_dbms ?: '-' }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </a>
                    @endforeach
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
                        <p class="font-medium text-gray-900 dark:text-zinc-200">{{ $app->nama_aplikasi }}</p>
                        <p class="text-sm text-gray-500 dark:text-zinc-400">{{ $app->opd->nama_opd ?? '-' }}</p>
                        <p class="text-xs text-gray-400 dark:text-zinc-500 mt-1">
                            Framework: {{ $app->framework ?: '-' }} | 
                            Bahasa: {{ $app->bahasa_pemrograman ?: '-' }} | 
                            DBMS: {{ $app->dbms ?: '-' }}
                        </p>
                    </div>
                    @if($app->url_aplikasi)
                    <a href="{{ $app->url_aplikasi }}" target="_blank" class="text-blue-500 hover:text-blue-700 text-sm">Buka →</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Top OPD -->
    <h2 class="text-sm font-semibold text-gray-600 dark:text-zinc-400 uppercase tracking-wide mb-3">Top OPD</h2>
    <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 border border-gray-200 dark:border-zinc-800">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100 dark:border-zinc-800">
                    <th class="text-left py-2 text-xs text-gray-500 dark:text-zinc-500 font-medium">No</th>
                    <th class="text-left py-2 text-xs text-gray-500 dark:text-zinc-500 font-medium">Nama OPD</th>
                    <th class="text-right py-2 text-xs text-gray-500 dark:text-zinc-500 font-medium">Aplikasi</th>
                    <th class="text-right py-2 text-xs text-gray-500 dark:text-zinc-500 font-medium">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topOpds as $i => $opd)
                <tr class="border-b border-gray-50 dark:border-zinc-800/50">
                    <td class="py-2 text-gray-600 dark:text-zinc-400">{{ $i + 1 }}</td>
                    <td class="py-2 text-gray-800 dark:text-zinc-200">{{ $opd->nama_opd }}</td>
                    <td class="py-2 text-right font-medium text-gray-900 dark:text-zinc-200">{{ $opd->web_apps_count }}</td>
                    <td class="py-2 text-right text-gray-500 dark:text-zinc-400">{{ round(($opd->web_apps_count / max($stats['total_apps'], 1)) * 100, 1) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
                labels: {!! json_encode($lokasiStats->pluck('lokasi_database')) !!},
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

        new Chart(document.getElementById('versiChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($versiStats->pluck('versi_dbms')) !!},
                datasets: [{
                    data: {!! json_encode($versiStats->pluck('total')) !!},
                    backgroundColor: roseGradient,
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
                'lokasi_database': 'Lokasi Database',
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

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>

    <!-- Modal -->
    <div id="appsModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" onclick="closeModal(event)">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[80vh] overflow-hidden" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between p-4 border-b border-gray-100">
                <div>
                    <h3 id="modalTitle" class="text-lg font-semibold text-gray-900">Daftar Aplikasi</h3>
                    <p id="modalSubtitle" class="text-sm text-gray-500"></p>
                </div>
                <button onclick="closeModal()" class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
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
