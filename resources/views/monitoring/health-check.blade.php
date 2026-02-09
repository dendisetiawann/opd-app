<x-app-layout>

    <!-- Header Section -->
    <div class="relative bg-white dark:bg-black rounded-2xl p-6 mb-6 overflow-hidden shadow-sm border border-gray-100 dark:border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-emerald-50/30 dark:hidden"></div>
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-emerald-500/10 via-green-500/5 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
        </div>
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 dark:bg-emerald-900/50 dark:border dark:border-emerald-700/50 text-white dark:text-emerald-100 text-[10px] font-bold uppercase tracking-wider shadow-sm mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Health Monitor
                </div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-white">{{ $opd->nama_opd ?? 'OPD Anda' }}</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Pantau status aktif website milik OPD Anda secara real-time</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-400 uppercase tracking-wider mb-1">Total Website</p>
                <p class="text-3xl font-black text-slate-800 dark:text-white">{{ $totalCount }}</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Website -->
        <div class="bg-white dark:bg-black rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-sky-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-sky-400 to-blue-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-sky-100 dark:ring-sky-900/30 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Total Website</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-white">{{ $totalCount }}</p>
                </div>
            </div>
        </div>

        <!-- Website Aktif -->
        <div class="bg-white dark:bg-black rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-emerald-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-emerald-400 to-green-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-emerald-100 dark:ring-emerald-900/30 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Aktif</p>
                    <p class="text-2xl font-black text-emerald-600" id="activeCount">-</p>
                </div>
            </div>
        </div>

        <!-- Website Tidak Aktif -->
        <div class="bg-white dark:bg-black rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-red-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-red-400 to-rose-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-red-100 dark:ring-red-900/30 group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Tidak Aktif</p>
                    <p class="text-2xl font-black text-red-600" id="inactiveCount">-</p>
                </div>
            </div>
        </div>
    </div>

    @if($webApps->count() == 0)
    <!-- Empty State -->
    <div class="bg-white dark:bg-black rounded-xl p-12 border border-gray-100 dark:border-zinc-800 text-center shadow-sm">
        <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-200 dark:from-amber-900/30 dark:to-orange-900/30 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Tidak Ada Website</h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm">OPD Anda tidak memiliki website dengan URL yang bisa dicek</p>
    </div>
    @else
    <!-- Action Button & Progress -->
    <div class="bg-white dark:bg-black rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden mb-6">
        <div class="p-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Ditemukan <strong class="text-slate-800 dark:text-white">{{ $webApps->count() }}</strong> website yang siap dicek statusnya.
            </p>
            <button type="button" onclick="startCheck()" id="checkBtn" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all shadow-lg shadow-blue-200 dark:shadow-blue-900/30 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Cek Status ({{ $webApps->count() }} website)
            </button>
        </div>
        <div class="px-6 pb-4 flex items-center gap-4">
            <div id="progressBar" class="flex-1 h-2.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden hidden">
                <div id="progressFill" class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 transition-all duration-300 rounded-full" style="width: 0%"></div>
            </div>
            <span id="progressText" class="text-sm font-medium text-slate-600 dark:text-slate-400"></span>
        </div>
    </div>

    <!-- Results Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Aktif Section -->
        <div class="bg-white dark:bg-black rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden">
            <div class="border-b border-gray-100 dark:border-zinc-800 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/10 px-5 py-4 flex items-center justify-between">
                <h3 class="text-sm font-bold text-emerald-800 dark:text-emerald-400 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    Website Aktif
                </h3>
                <span id="activeLabel" class="text-xs font-semibold text-emerald-600 bg-emerald-100 dark:bg-emerald-900/30 px-2 py-1 rounded-full">0</span>
            </div>
            <div id="activeList" class="divide-y divide-gray-100 dark:divide-zinc-800 max-h-[400px] overflow-y-auto">
                <div class="p-8 text-center">
                    <svg class="w-10 h-10 text-gray-200 dark:text-zinc-700 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Klik "Cek Status" untuk mulai</p>
                </div>
            </div>
        </div>

        <!-- Tidak Aktif Section -->
        <div class="bg-white dark:bg-black rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden">
            <div class="border-b border-gray-100 dark:border-zinc-800 bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/10 px-5 py-4 flex items-center justify-between">
                <h3 class="text-sm font-bold text-red-800 dark:text-red-400 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                    Website Tidak Aktif
                </h3>
                <span id="inactiveLabel" class="text-xs font-semibold text-red-600 bg-red-100 dark:bg-red-900/30 px-2 py-1 rounded-full">0</span>
            </div>
            <div id="inactiveList" class="divide-y divide-gray-100 dark:divide-zinc-800 max-h-[400px] overflow-y-auto">
                <div class="p-8 text-center">
                    <svg class="w-10 h-10 text-gray-200 dark:text-zinc-700 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Klik "Cek Status" untuk mulai</p>
                </div>
            </div>
        </div>
    </div>

    @php
        $websitesData = $webApps->map(function($app) {
            return [
                'id' => $app->id,
                'name' => $app->nama_web_app,
                'opd' => $app->opd->nama_opd ?? '-',
                'url' => $app->alamat_tautan
            ];
        })->values();
    @endphp

    <script>
        const websites = @json($websitesData);
        let active = 0, inactive = 0;
        let activeHtml = '', inactiveHtml = '';

        async function checkSite(site) {
            try {
                const response = await fetch('{{ route("monitoring.health-check.check-url") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ url: site.url })
                });
                const data = await response.json();
                return { site, data, error: false };
            } catch (e) {
                return { site, data: null, error: true };
            }
        }

        function updateUI(result) {
            const { site, data, error } = result;

            const statusBadge = error
                ? '<span class="text-xs font-medium text-red-600 bg-red-50 dark:bg-red-900/20 px-2 py-0.5 rounded">Error</span>'
                : (data?.response_time ? `<span class="text-xs font-medium text-slate-500 dark:text-slate-400">${data.response_time}ms</span>` : '');

            const row = `
                <div class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-zinc-900 transition-colors">
                    <div class="flex-1 min-w-0 mr-4">
                        <p class="text-sm font-semibold text-slate-800 dark:text-slate-200 truncate">${site.name}</p>
                        <a href="${site.url}" target="_blank" class="text-xs text-blue-600 dark:text-blue-400 hover:underline truncate block mt-0.5">${site.url}</a>
                    </div>
                    <div class="flex-shrink-0">
                        ${statusBadge}
                    </div>
                </div>
            `;

            if (!error && (data?.status === 'online' || data?.status === 'slow')) {
                active++;
                activeHtml += row;
            } else {
                inactive++;
                inactiveHtml += row;
            }

            document.getElementById('activeCount').textContent = active;
            document.getElementById('inactiveCount').textContent = inactive;
            document.getElementById('activeLabel').textContent = active;
            document.getElementById('inactiveLabel').textContent = inactive;
            document.getElementById('activeList').innerHTML = activeHtml || '<div class="p-8 text-center"><p class="text-sm text-gray-400">Tidak ada website aktif</p></div>';
            document.getElementById('inactiveList').innerHTML = inactiveHtml || '<div class="p-8 text-center"><p class="text-sm text-gray-400">Tidak ada website tidak aktif</p></div>';
        }

        async function checkAllUrls() {
            const total = websites.length;
            const batchSize = 5;
            let completed = 0;

            for (let i = 0; i < websites.length; i += batchSize) {
                const batch = websites.slice(i, i + batchSize);
                const promises = batch.map(site => checkSite(site));
                const results = await Promise.all(promises);

                results.forEach(result => {
                    completed++;
                    updateUI(result);
                    const progress = Math.round((completed / total) * 100);
                    document.getElementById('progressFill').style.width = progress + '%';
                    document.getElementById('progressText').textContent = `${completed} / ${total}`;
                });
            }

            document.getElementById('progressText').innerHTML = '<span class="text-emerald-600">&#10003; Selesai</span>';
            document.getElementById('checkBtn').disabled = false;
            document.getElementById('checkBtn').innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Cek Ulang
            `;
        }

        function startCheck() {
            active = 0;
            inactive = 0;
            activeHtml = '';
            inactiveHtml = '';
            document.getElementById('activeCount').textContent = '-';
            document.getElementById('inactiveCount').textContent = '-';
            document.getElementById('activeLabel').textContent = '0';
            document.getElementById('inactiveLabel').textContent = '0';
            document.getElementById('activeList').innerHTML = '<div class="p-8 text-center"><div class="inline-block w-6 h-6 border-2 border-emerald-500 border-t-transparent rounded-full animate-spin"></div><p class="text-sm text-gray-400 mt-3">Sedang mengecek...</p></div>';
            document.getElementById('inactiveList').innerHTML = '<div class="p-8 text-center"><div class="inline-block w-6 h-6 border-2 border-red-500 border-t-transparent rounded-full animate-spin"></div><p class="text-sm text-gray-400 mt-3">Sedang mengecek...</p></div>';
            document.getElementById('progressBar').classList.remove('hidden');
            document.getElementById('checkBtn').disabled = true;
            document.getElementById('checkBtn').innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Mengecek...
            `;
            checkAllUrls();
        }
    </script>
    @endif

</x-app-layout>
