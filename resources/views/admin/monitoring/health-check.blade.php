<x-admin-layout>
    <x-slot name="header">Cek Status Website</x-slot>

    <!-- Header Section - Matching Dashboard Theme -->
    <div class="relative bg-white dark:bg-zinc-900 rounded-2xl p-6 mb-6 overflow-hidden shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-emerald-50/30 dark:from-zinc-900 dark:to-emerald-900/10"></div>
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-[10px] font-bold uppercase tracking-wider shadow-sm mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Health Monitor
            </div>
            <p class="text-slate-600 dark:text-zinc-400 text-sm max-w-lg">
                Pantau status aktif website OPD secara real-time. Hanya menampilkan aplikasi bertipe website.
            </p>
        </div>
    </div>

    <!-- ========== TAB NAVIGATION + STATS ========== -->
    <div x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || 'semua' }" class="mb-6">

    <!-- Stats Cards - Premium Style -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Total Website -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-indigo-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-indigo-400 to-violet-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-indigo-100 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-globe w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Website</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-white">{{ $totalCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total OPD -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-sky-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-sky-400 to-blue-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-sky-100 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-building w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jumlah OPD</p>
                    <p class="text-2xl font-black text-slate-800 dark:text-white">{{ $opds->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Website Aktif -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-emerald-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-emerald-400 to-green-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-emerald-100 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-circle-check w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="min-w-0 overflow-hidden">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Website Aktif</p>
                    {{-- Tab Cek Semua --}}
                    <template x-if="activeTab === 'semua'">
                        <p class="text-2xl font-black text-emerald-600" id="activeCountBulk"><span class="text-sm font-medium text-slate-300 dark:text-zinc-600">Klik Cek Semua</span></p>
                    </template>
                    {{-- Tab Per OPD --}}
                    <template x-if="activeTab === 'opd'">
                        <div>
                            @if($selectedOpd)<p class="text-[10px] text-slate-400 dark:text-zinc-500 break-words">{{ $opds->firstWhere('id', $selectedOpd)?->nama_opd }}</p>@endif
                            <p class="text-2xl font-black text-emerald-600" id="activeCount"><span class="text-sm font-medium text-slate-300 dark:text-zinc-600">@if($selectedOpd) Klik Cek Status @else Pilih OPD dahulu @endif</span></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Website Tidak Aktif -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-red-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-red-400 to-rose-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-red-100 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-circle-xmark w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="min-w-0 overflow-hidden">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tidak Aktif</p>
                    {{-- Tab Cek Semua --}}
                    <template x-if="activeTab === 'semua'">
                        <p class="text-2xl font-black text-red-600" id="inactiveCountBulk"><span class="text-sm font-medium text-slate-300 dark:text-zinc-600">Klik Cek Semua</span></p>
                    </template>
                    {{-- Tab Per OPD --}}
                    <template x-if="activeTab === 'opd'">
                        <div>
                            @if($selectedOpd)<p class="text-[10px] text-slate-400 dark:text-zinc-500 break-words">{{ $opds->firstWhere('id', $selectedOpd)?->nama_opd }}</p>@endif
                            <p class="text-2xl font-black text-red-600" id="inactiveCount"><span class="text-sm font-medium text-slate-300 dark:text-zinc-600">@if($selectedOpd) Klik Cek Status @else Pilih OPD dahulu @endif</span></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

        <!-- Tab Buttons -->
        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 p-1.5 mb-6">
            <div class="grid grid-cols-2 gap-1.5">
                <button @click="activeTab = 'semua'" 
                    :class="activeTab === 'semua' ? 'bg-gradient-to-r from-indigo-500 to-blue-600 text-white shadow-lg shadow-indigo-200 dark:shadow-indigo-900/30' : 'text-slate-500 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800 hover:text-slate-700 dark:hover:text-zinc-200'"
                    class="flex items-center justify-center gap-2.5 px-5 py-3 rounded-xl text-sm font-bold transition-all duration-200">
                    <i class="fa-solid fa-globe" :class="activeTab === 'semua' ? 'text-white' : 'text-indigo-400'"></i>
                    <span>Cek Semua Website</span>
                    <span :class="activeTab === 'semua' ? 'bg-white/20 text-white' : 'bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400'" class="text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $totalCount }}</span>
                </button>
                <button @click="activeTab = 'opd'" 
                    :class="activeTab === 'opd' ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg shadow-blue-200 dark:shadow-blue-900/30' : 'text-slate-500 dark:text-zinc-400 hover:bg-gray-50 dark:hover:bg-zinc-800 hover:text-slate-700 dark:hover:text-zinc-200'"
                    class="flex items-center justify-center gap-2.5 px-5 py-3 rounded-xl text-sm font-bold transition-all duration-200">
                    <i class="fa-solid fa-building" :class="activeTab === 'opd' ? 'text-white' : 'text-blue-400'"></i>
                    <span>Cek Per OPD</span>
                    <span :class="activeTab === 'opd' ? 'bg-white/20 text-white' : 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400'" class="text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $opds->count() }}</span>
                </button>
            </div>
        </div>

    <!-- ========== TAB: CEK SEMUA ========== -->
    <div x-show="activeTab === 'semua'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden mb-6">
        <div class="border-b border-gray-100 dark:border-zinc-800 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/10 px-6 py-4 flex items-center justify-between">
            <h3 class="text-sm font-bold text-indigo-800 dark:text-indigo-300 flex items-center gap-2">
                <i class="fa-solid fa-globe w-4 h-4 text-indigo-500 flex items-center justify-center"></i>
                Cek Semua Website
            </h3>
            <div class="flex items-center gap-3">
                @if($latestBatch && $latestBatch->status === 'completed')
                <a href="{{ route('admin.monitoring.health-check.export', $latestBatch->batch_id) }}" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-lg transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-file-excel w-3.5 h-3.5 flex items-center justify-center"></i>
                    Export Excel
                </a>
                @endif
                <button type="button" onclick="startBulkCheck()" id="bulkCheckBtn" class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white text-xs font-semibold rounded-lg transition-all shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                    <i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i>
                    Cek Semua Website ({{ $totalCount }})
                </button>
            </div>
        </div>

        <!-- Progress Banner (shown when check is running) -->
        <div id="bulkProgressBanner" class="hidden border-b border-amber-200 dark:border-amber-700 bg-amber-50 dark:bg-amber-900/20 px-6 py-3">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <i class="fa-solid fa-spinner fa-spin text-amber-600 dark:text-amber-400"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-amber-800 dark:text-amber-300" id="bulkProgressText">Memulai pengecekan...</p>
                    <div class="mt-2 h-2 bg-amber-200 dark:bg-amber-800 rounded-full overflow-hidden">
                        <div id="bulkProgressFill" class="h-full bg-gradient-to-r from-amber-400 to-orange-500 transition-all duration-500 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
                <span id="bulkProgressPercent" class="text-xs font-bold text-amber-700 dark:text-amber-400">0%</span>
            </div>
            <p class="text-xs text-amber-600 dark:text-amber-400 mt-1.5 ml-8">
                <i class="fa-solid fa-info-circle mr-1"></i>
                Proses berjalan di background — Anda bisa pindah halaman, progress akan tetap berjalan.
            </p>
        </div>

        <!-- Bulk Results Table -->
        <div id="bulkResultsSection" class="{{ ($latestBatch && $latestBatch->status === 'completed' && $bulkResults->count() > 0) ? '' : 'hidden' }}">
            <div class="px-6 py-3 border-b border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/20 flex items-center justify-between">
                <p class="text-xs font-semibold text-slate-500 dark:text-zinc-400">
                    @if($latestBatch && $latestBatch->status === 'completed')
                    Terakhir dicek: {{ $latestBatch->created_at?->format('d M Y H:i') }} — <span id="bulkResultCount">{{ $bulkResults->count() }}</span> website
                    @else
                    <span id="bulkResultInfo"></span>
                    @endif
                </p>
                @if($latestBatch && $latestBatch->status === 'completed' && $bulkResults->count() > 0)
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/15 px-2 py-0.5 rounded-full"><i class="fa-solid fa-circle-check mr-1"></i>{{ $bulkResults->where('status', 'online')->count() + $bulkResults->where('status', 'slow')->count() }} Aktif</span>
                    <span class="text-[10px] font-bold text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-500/15 px-2 py-0.5 rounded-full"><i class="fa-solid fa-circle-xmark mr-1"></i>{{ $bulkResults->whereNotIn('status', ['online', 'slow'])->count() }} Tidak Aktif</span>
                </div>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="bulkResultsTable">
                    <thead class="bg-gray-50 dark:bg-zinc-800/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Aplikasi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">OPD</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">HTTP</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Response</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800" id="bulkResultsBody">
                        @if($latestBatch && $latestBatch->status === 'completed')
                        @foreach($bulkResults as $i => $r)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors {{ $r->status === 'online' ? 'bg-emerald-50/30 dark:bg-emerald-900/5' : ($r->status === 'offline' || $r->status === 'error' ? 'bg-red-50/30 dark:bg-red-900/5' : '') }}">
                            <td class="px-4 py-3 text-slate-400 text-xs">{{ $i + 1 }}</td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-slate-800 dark:text-zinc-200 text-xs">{{ $r->nama_web_app }}</p>
                                <a href="{{ $r->alamat_tautan }}" target="_blank" class="text-[10px] text-blue-500 hover:underline break-all">{{ $r->alamat_tautan }}</a>
                            </td>
                            <td class="px-4 py-3 text-xs text-slate-600 dark:text-zinc-400">{{ $r->opd_nama }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $codeColor = $r->http_code >= 200 && $r->http_code < 300 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                                        : ($r->http_code >= 300 && $r->http_code < 400 ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                                        : ($r->http_code >= 400 ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                                        : 'bg-gray-100 text-gray-600 dark:bg-zinc-800 dark:text-zinc-400'));
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $codeColor }}">{{ $r->http_code ?: 0 }}</span>
                            </td>
                            <td class="px-4 py-3 text-[10px] text-slate-500 dark:text-zinc-400" title="{{ \App\Models\HealthCheckResult::httpCodeDescription($r->http_code) }}">
                                {{ \App\Models\HealthCheckResult::httpCodeDescription($r->http_code) }}
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusBadge = match($r->status) {
                                        'online' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                        'slow' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                        default => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $statusBadge }}">{{ ucfirst($r->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-right text-xs font-mono text-slate-500">{{ $r->response_time_ms }}ms</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div id="bulkPagination" class="px-6 py-3 border-t border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/20 flex items-center justify-between {{ ($bulkResults->count() > 0) ? '' : 'hidden' }}">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-500 dark:text-zinc-400">Per halaman:</span>
                    <select id="bulkPerPage" onchange="bulkPager.setPerPage(this.value)" class="text-xs border border-gray-200 dark:border-zinc-700 rounded-lg px-2 py-1 bg-white dark:bg-zinc-900 dark:text-zinc-300 focus:ring-1 focus:ring-indigo-400">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="flex items-center gap-3">
                    <span id="bulkPageInfo" class="text-xs text-slate-500 dark:text-zinc-400"></span>
                    <div class="flex gap-1">
                        <button onclick="bulkPager.prev()" id="bulkPrevBtn" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-gray-200 dark:border-zinc-700 text-slate-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-all" disabled>
                            <i class="fa-solid fa-chevron-left mr-1"></i>Prev
                        </button>
                        <button onclick="bulkPager.next()" id="bulkNextBtn" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-gray-200 dark:border-zinc-700 text-slate-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-all">
                            Next<i class="fa-solid fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty state when no results -->
        <div id="bulkEmptyState" class="{{ ($latestBatch && $latestBatch->status === 'completed' && $bulkResults->count() > 0) ? 'hidden' : '' }}">
            @if(!$latestBatch || $latestBatch->status === 'completed')
            <div class="p-10 text-center">
                <i class="fa-solid fa-globe text-4xl text-gray-200 dark:text-zinc-700 mb-3"></i>
                <p class="text-sm text-gray-400 dark:text-zinc-500">Klik "Cek Semua Website" untuk memulai pengecekan massal</p>
            </div>
            @endif
        </div>
    </div>
    </div>{{-- End Tab: Cek Semua --}}

    <!-- ========== TAB: CEK PER OPD ========== -->
    <div x-show="activeTab === 'opd'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden mb-6">
        <div class="border-b border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/30 px-6 py-4">
            <h3 class="text-sm font-bold text-slate-800 dark:text-zinc-200 flex items-center gap-2">
                <i class="fa-solid fa-circle-check w-4 h-4 text-slate-500 flex items-center justify-center"></i>
                Cek Per OPD
            </h3>
        </div>
        <div class="p-6">
            <form method="GET" action="{{ route('admin.monitoring.health-check') }}" class="flex flex-col md:flex-row items-stretch md:items-end gap-4">
                <input type="hidden" name="tab" value="opd">
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Organisasi Perangkat Daerah</label>
                    <select name="opd_id" onchange="this.form.submit()" class="w-full border border-gray-200 dark:border-zinc-700 rounded-lg px-4 py-3 text-sm bg-gray-50 dark:bg-black dark:text-zinc-200 focus:bg-white dark:focus:bg-zinc-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="">-- Pilih OPD --</option>
                        @foreach($opds as $opd)
                            <option value="{{ $opd->id }}" {{ $selectedOpd == $opd->id ? 'selected' : '' }}>
                                {{ $opd->nama_opd }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if($selectedOpd && $webApps->count() > 0)
                <div class="flex items-center gap-2">
                    <button type="button" onclick="exportOpdResults()" id="opdExportBtn" class="hidden w-full md:w-auto px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-lg transition-all shadow-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-file-excel w-4 h-4 flex items-center justify-center"></i>
                        Export Excel
                    </button>
                    <button type="button" onclick="startCheck()" id="checkBtn" class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-semibold rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                        Cek Status ({{ $webApps->count() }} website)
                    </button>
                </div>
                @endif
            </form>
            
            @if($selectedOpd)
            <div class="mt-4 flex items-center gap-4">
                <div id="progressBar" class="flex-1 h-2.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden hidden">
                    <div id="progressFill" class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 transition-all duration-300 rounded-full" style="width: 0%"></div>
                </div>
                <span id="progressText" class="text-sm font-medium text-slate-600 dark:text-zinc-400"></span>
            </div>
            @endif
        </div>
    </div>

    @if(!$selectedOpd)
    <!-- Empty State -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl p-12 border border-gray-100 dark:border-zinc-800 text-center shadow-sm dark:shadow-xl">
        <div class="w-20 h-20 bg-gradient-to-br from-slate-100 to-gray-200 dark:from-zinc-800 dark:to-zinc-700 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <i class="fa-solid fa-building w-10 h-10 text-slate-400 dark:text-zinc-500 flex items-center justify-center"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Pilih OPD</h3>
        <p class="text-slate-500 dark:text-zinc-500 text-sm max-w-sm mx-auto">Pilih OPD dari dropdown di atas untuk melihat dan mengecek status website per OPD</p>
    </div>
    @else
        @if($webApps->count() == 0)
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-12 border border-gray-100 dark:border-zinc-800 text-center shadow-sm dark:shadow-xl">
            <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-200 dark:from-amber-900/30 dark:to-orange-900/20 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
                <i class="fa-solid fa-triangle-exclamation w-10 h-10 text-amber-500 flex items-center justify-center"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Tidak Ada Website</h3>
            <p class="text-slate-500 dark:text-zinc-500 text-sm">OPD ini tidak memiliki website yang bisa dicek</p>
        </div>
        @else
        <!-- Results Table -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
            <div class="px-6 py-3 border-b border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/20 flex items-center justify-between">
                <p class="text-xs font-semibold text-slate-500 dark:text-zinc-400">
                    <span id="opdResultInfo">Klik "Cek Status" untuk mulai pengecekan</span>
                </p>
                <div class="flex items-center gap-2">
                    <span id="activeLabel" class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-100 dark:bg-emerald-500/15 px-2 py-0.5 rounded-full hidden"><i class="fa-solid fa-circle-check mr-1"></i><span>0</span> Aktif</span>
                    <span id="inactiveLabel" class="text-[10px] font-bold text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-500/15 px-2 py-0.5 rounded-full hidden"><i class="fa-solid fa-circle-xmark mr-1"></i><span>0</span> Tidak Aktif</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm" id="opdResultsTable">
                    <thead class="bg-gray-50 dark:bg-zinc-800/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Aplikasi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">OPD</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">HTTP</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Response</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-zinc-800" id="opdResultsBody">
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center">
                                <i class="fa-solid fa-circle-check text-3xl text-gray-200 dark:text-zinc-700 mb-3"></i>
                                <p class="text-sm text-gray-400 dark:text-zinc-500">Klik "Cek Status" untuk mulai</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Per-OPD Pagination -->
            <div id="opdPagination" class="px-6 py-3 border-t border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/20 flex items-center justify-between hidden">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-500 dark:text-zinc-400">Per halaman:</span>
                    <select id="opdPerPage" onchange="opdPager.setPerPage(this.value)" class="text-xs border border-gray-200 dark:border-zinc-700 rounded-lg px-2 py-1 bg-white dark:bg-zinc-900 dark:text-zinc-300 focus:ring-1 focus:ring-indigo-400">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="flex items-center gap-3">
                    <span id="opdPageInfo" class="text-xs text-slate-500 dark:text-zinc-400"></span>
                    <div class="flex gap-1">
                        <button onclick="opdPager.prev()" id="opdPrevBtn" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-gray-200 dark:border-zinc-700 text-slate-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-all" disabled>
                            <i class="fa-solid fa-chevron-left mr-1"></i>Prev
                        </button>
                        <button onclick="opdPager.next()" id="opdNextBtn" class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-gray-200 dark:border-zinc-700 text-slate-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-all">
                            Next<i class="fa-solid fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    </div>{{-- End Tab: Cek Per OPD --}}
    </div>{{-- End Tab Container --}}

    {{-- ========== PER-OPD JAVASCRIPT ========== --}}
    @if($selectedOpd && $webApps->count() > 0)
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
        let rowNumber = 0;
        let tableHtml = '';

        function httpCodeDescription(code) {
            const descriptions = {
                0: 'Connection Error', 200: 'OK', 201: 'Created', 301: 'Moved Permanently',
                302: 'Found (Redirect)', 400: 'Bad Request', 401: 'Unauthorized',
                403: 'Forbidden', 404: 'Not Found', 408: 'Request Timeout',
                500: 'Internal Server Error', 502: 'Bad Gateway', 503: 'Service Unavailable'
            };
            return descriptions[code] || (code >= 200 && code < 300 ? 'Success' : code >= 300 && code < 400 ? 'Redirect' : code >= 400 ? 'Error' : 'Unknown');
        }

        async function checkSite(site) {
            try {
                const response = await fetch('{{ route("admin.monitoring.health-check.check-url") }}', {
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
            rowNumber++;

            const httpCode = error ? 0 : (data?.http_code || 0);
            const status = error ? 'error' : (data?.status || 'error');
            const responseTime = error ? 0 : (data?.response_time || 0);
            const httpDesc = httpCodeDescription(httpCode);

            const codeClass = httpCode >= 200 && httpCode < 300 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                : (httpCode >= 300 && httpCode < 400 ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400');

            const statusLabel = status === 'online' ? 'Online' : (status === 'slow' ? 'Slow' : (status === 'redirect' ? 'Redirect' : 'Error'));
            const statusClass = (status === 'online') ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                : (status === 'slow' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400');

            const rowBg = (status === 'online' || status === 'slow') ? 'bg-emerald-50/30 dark:bg-emerald-900/5'
                : 'bg-red-50/30 dark:bg-red-900/5';

            if (status === 'online' || status === 'slow') {
                active++;
            } else {
                inactive++;
            }

            tableHtml += `<tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors ${rowBg}">
                <td class="px-4 py-3 text-slate-400 text-xs">${rowNumber}</td>
                <td class="px-4 py-3">
                    <p class="font-semibold text-slate-800 dark:text-zinc-200 text-xs">${site.name}</p>
                    <a href="${site.url}" target="_blank" class="text-[10px] text-blue-500 hover:underline break-all">${site.url}</a>
                </td>
                <td class="px-4 py-3 text-xs text-slate-600 dark:text-zinc-400">${site.opd}</td>
                <td class="px-4 py-3"><span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold ${codeClass}">${httpCode || 0}</span></td>
                <td class="px-4 py-3 text-[10px] text-slate-500 dark:text-zinc-400 max-w-[250px]">${httpDesc}</td>
                <td class="px-4 py-3"><span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold ${statusClass}">${statusLabel}</span></td>
                <td class="px-4 py-3 text-right text-xs font-mono text-slate-500">${responseTime}ms</td>
            </tr>`;

            document.getElementById('opdResultsBody').innerHTML = tableHtml;

            // Update stats cards
            const activeCountEl = document.getElementById('activeCount');
            const inactiveCountEl = document.getElementById('inactiveCount');
            if (activeCountEl) activeCountEl.textContent = active;
            if (inactiveCountEl) inactiveCountEl.textContent = inactive;

            // Update labels
            const activeLbl = document.getElementById('activeLabel');
            const inactiveLbl = document.getElementById('inactiveLabel');
            if (activeLbl) { activeLbl.querySelector('span').textContent = active; activeLbl.classList.remove('hidden'); }
            if (inactiveLbl) { inactiveLbl.querySelector('span').textContent = inactive; inactiveLbl.classList.remove('hidden'); }
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
            
            document.getElementById('progressText').innerHTML = '<span class="text-emerald-600">✓ Selesai</span>';
            document.getElementById('opdResultInfo').textContent = `${total} website dicek — ${active} aktif, ${inactive} tidak aktif`;
            document.getElementById('checkBtn').disabled = false;
            document.getElementById('checkBtn').innerHTML = `
                <i class="fa-solid fa-rotate w-4 h-4 flex items-center justify-center"></i>
                Cek Ulang
            `;
            // Activate pagination
            if (typeof opdPager !== 'undefined') {
                opdPager.reset();
            }
            // Show export button
            document.getElementById('opdExportBtn')?.classList.remove('hidden');
        }

        function startCheck() {
            active = 0;
            inactive = 0;
            rowNumber = 0;
            tableHtml = '';
            opdCheckResults = [];
            const activeCountEl = document.getElementById('activeCount');
            const inactiveCountEl = document.getElementById('inactiveCount');
            if (activeCountEl) activeCountEl.innerHTML = '<span class="inline-flex items-center gap-1.5 text-sm font-medium text-emerald-400"><i class="fa-solid fa-spinner fa-spin"></i>Mengecek...</span>';
            if (inactiveCountEl) inactiveCountEl.innerHTML = '<span class="inline-flex items-center gap-1.5 text-sm font-medium text-red-400"><i class="fa-solid fa-spinner fa-spin"></i>Mengecek...</span>';
            document.getElementById('opdExportBtn')?.classList.add('hidden');
            document.getElementById('opdResultsBody').innerHTML = '<tr><td colspan="7" class="px-4 py-10 text-center"><div class="inline-block w-6 h-6 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div><p class="text-sm text-gray-400 mt-3">Sedang mengecek...</p></td></tr>';
            document.getElementById('opdResultInfo').textContent = 'Sedang mengecek...';
            document.getElementById('progressBar').classList.remove('hidden');
            document.getElementById('checkBtn').disabled = true;
            document.getElementById('checkBtn').innerHTML = `
                <i class="fa-solid fa-rotate w-4 h-4 animate-spin flex items-center justify-center"></i>
                Mengecek...
            `;
            checkAllUrls();
        }

        // Store results for export
        let opdCheckResults = [];

        // Override updateUI to also store results
        const _origUpdateUI = updateUI;
        updateUI = function(result) {
            const { site, data, error } = result;
            opdCheckResults.push({
                name: site.name,
                opd: site.opd,
                url: site.url,
                http_code: error ? 0 : (data?.http_code || 0),
                status: error ? 'error' : (data?.status || 'error'),
                response_time: error ? 0 : (data?.response_time || 0),
                http_desc: httpCodeDescription(error ? 0 : (data?.http_code || 0)),
            });
            _origUpdateUI(result);
        };

        function exportOpdResults() {
            if (opdCheckResults.length === 0) { alert('Belum ada hasil.'); return; }

            const opdSelect = document.querySelector('select[name="opd_id"]');
            const opdName = opdSelect?.selectedOptions[0]?.textContent?.trim() || 'OPD';

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.monitoring.health-check.export-opd") }}';
            form.style.display = 'none';

            const csrf = document.createElement('input');
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            const opdInput = document.createElement('input');
            opdInput.name = 'opd_name';
            opdInput.value = opdName;
            form.appendChild(opdInput);

            opdCheckResults.forEach((r, i) => {
                ['name', 'opd', 'url', 'http_code', 'http_desc', 'status', 'response_time'].forEach(key => {
                    const input = document.createElement('input');
                    input.name = `results[${i}][${key}]`;
                    input.value = r[key] ?? '';
                    form.appendChild(input);
                });
            });

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>
    @endif

    {{-- ========== BULK CHECK JAVASCRIPT ========== --}}
    <script>
        let bulkPollingInterval = null;
        let currentBatchId = @json($latestBatch?->batch_id);
        const csrfToken = '{{ csrf_token() }}';

        // Check on page load if there's a running batch → trigger widget
        @if($latestBatch && in_array($latestBatch->status, ['pending', 'running']))
        document.addEventListener('DOMContentLoaded', () => {
            showProgressBanner();
            // Let the widget handle cross-page polling
            if (window.HCWidget) {
                window.HCWidget.start('{{ $latestBatch->batch_id }}', 'admin');
            }
            startPolling('{{ $latestBatch->batch_id }}');
        });
        @endif

        // Listen for widget completion to reload this page
        window.addEventListener('healthcheck:completed', () => {
            window.location.reload();
        });

        function showProgressBanner() {
            document.getElementById('bulkProgressBanner').classList.remove('hidden');
            document.getElementById('bulkEmptyState')?.classList.add('hidden');
            document.getElementById('bulkCheckBtn').disabled = true;
            document.getElementById('bulkCheckBtn').innerHTML = '<i class="fa-solid fa-spinner fa-spin w-3.5 h-3.5 flex items-center justify-center"></i> Sedang berjalan...';
        }

        async function startBulkCheck() {
            const btn = document.getElementById('bulkCheckBtn');
            const originalText = btn.innerHTML;
            
            try {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin w-3.5 h-3.5 flex items-center justify-center"></i> Memulai...';
                
                const response = await fetch('{{ route("admin.monitoring.health-check.bulk-start") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                });
                const data = await response.json();

                if (response.status === 409) {
                    currentBatchId = data.batch_id;
                    showProgressBanner();
                    // Trigger floating widget
                    window.dispatchEvent(new CustomEvent('healthcheck:start', { detail: { batchId: data.batch_id, role: 'admin' } }));
                    startPolling(data.batch_id);
                    return;
                }

                if (data.batch_id) {
                    currentBatchId = data.batch_id;
                    showProgressBanner();
                    // Trigger floating widget for cross-page persistence
                    window.dispatchEvent(new CustomEvent('healthcheck:start', { detail: { batchId: data.batch_id, role: 'admin' } }));
                    setTimeout(() => startPolling(data.batch_id), 2000);
                } else if (data.error) {
                    alert(data.error);
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            } catch (e) {
                alert('Gagal memulai pengecekan: ' + e.message);
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i> Coba Lagi';
            }
        }

        function startPolling(batchId) {
            if (bulkPollingInterval) clearInterval(bulkPollingInterval);
            
            bulkPollingInterval = setInterval(async () => {
                try {
                    const res = await fetch(`{{ url('/admin/monitoring/health-check/bulk-progress') }}/${batchId}`);
                    
                    if (!res.ok) {
                        const errData = await res.json().catch(() => ({}));
                        console.error('Polling error:', res.status, errData);
                        if (errData.status === 'failed' || res.status >= 500) {
                            clearInterval(bulkPollingInterval);
                            bulkPollingInterval = null;
                            document.getElementById('bulkProgressText').textContent = 'Pengecekan gagal: ' + (errData.error || 'Server error');
                            document.getElementById('bulkCheckBtn').disabled = false;
                            document.getElementById('bulkCheckBtn').innerHTML = '<i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i> Coba Lagi';
                        }
                        return;
                    }

                    const data = await res.json();

                    if (data.error) {
                        clearInterval(bulkPollingInterval);
                        bulkPollingInterval = null;
                        document.getElementById('bulkProgressText').textContent = 'Error: ' + data.error;
                        document.getElementById('bulkCheckBtn').disabled = false;
                        document.getElementById('bulkCheckBtn').innerHTML = '<i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i> Coba Lagi';
                        return;
                    }

                    const pct = data.percent || 0;
                    document.getElementById('bulkProgressFill').style.width = pct + '%';
                    document.getElementById('bulkProgressPercent').textContent = pct + '%';
                    
                    let statusText = `Mengecek ${data.completed || 0} dari ${data.total || '...'} website...`;
                    if (data.status === 'pending') {
                        statusText = 'Menunggu queue... (Job akan diproses segera)';
                    } else if (data.total === 0) {
                        statusText = 'Menghitung total website...';
                    }
                    document.getElementById('bulkProgressText').textContent = statusText;

                    if (data.status === 'completed' || data.status === 'failed') {
                        clearInterval(bulkPollingInterval);
                        bulkPollingInterval = null;

                        if (data.status === 'completed') {
                            document.getElementById('bulkProgressBanner').classList.add('hidden');
                            document.getElementById('bulkCheckBtn').disabled = false;
                            document.getElementById('bulkCheckBtn').innerHTML = '<i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i> Cek Ulang Semua';
                            loadBulkResults(batchId);
                        } else {
                            document.getElementById('bulkProgressText').textContent = 'Pengecekan gagal.';
                            document.getElementById('bulkCheckBtn').disabled = false;
                            document.getElementById('bulkCheckBtn').innerHTML = '<i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i> Coba Lagi';
                        }
                    }
                } catch (e) {
                    console.error('Polling exception:', e);
                }
            }, 5000);
        }

        async function loadBulkResults(batchId) {
            try {
                const res = await fetch(`{{ url('/admin/monitoring/health-check/bulk-results') }}/${batchId}`);
                const data = await res.json();

                const tbody = document.getElementById('bulkResultsBody');
                let html = '';

                data.results.forEach((r, i) => {
                    const codeClass = r.http_code >= 200 && r.http_code < 300 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                        : (r.http_code >= 300 && r.http_code < 400 ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                        : (r.http_code >= 400 || r.http_code === 0 ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                        : 'bg-gray-100 text-gray-600'));
                    
                    const statusClass = r.status === 'online' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400'
                        : (r.status === 'slow' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400'
                        : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400');

                    const rowBg = r.status === 'online' ? 'bg-emerald-50/30 dark:bg-emerald-900/5'
                        : (r.status === 'offline' || r.status === 'error' ? 'bg-red-50/30 dark:bg-red-900/5' : '');

                    html += `<tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors ${rowBg}">
                        <td class="px-4 py-3 text-slate-400 text-xs">${i + 1}</td>
                        <td class="px-4 py-3"><p class="font-semibold text-slate-800 dark:text-zinc-200 text-xs">${r.nama_web_app}</p><a href="${r.alamat_tautan}" target="_blank" class="text-[10px] text-blue-500 hover:underline break-all">${r.alamat_tautan}</a></td>
                        <td class="px-4 py-3 text-xs text-slate-600 dark:text-zinc-400">${r.opd_nama || r.nama_opd || '-'}</td>
                        <td class="px-4 py-3"><span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold ${codeClass}">${r.http_code || 0}</span></td>
                        <td class="px-4 py-3 text-[10px] text-slate-500 dark:text-zinc-400">${r.http_desc}</td>
                        <td class="px-4 py-3"><span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold ${statusClass}">${r.status.charAt(0).toUpperCase() + r.status.slice(1)}</span></td>
                        <td class="px-4 py-3 text-right text-xs font-mono text-slate-500">${r.response_time_ms}ms</td>
                    </tr>`;
                });

                tbody.innerHTML = html;
                document.getElementById('bulkResultsSection').classList.remove('hidden');
                document.getElementById('bulkEmptyState')?.classList.add('hidden');
                
                const infoEl = document.getElementById('bulkResultInfo');
                if (infoEl) infoEl.textContent = `${data.total} website dicek`;

                window.location.reload();
            } catch (e) {
                console.error('Error loading results:', e);
            }
        }
    </script>

    {{-- ========== PAGINATION JAVASCRIPT ========== --}}
    <script>
        class TablePager {
            constructor(tbodyId, paginationId, pageInfoId, prevBtnId, nextBtnId) {
                this.tbodyId = tbodyId;
                this.paginationId = paginationId;
                this.pageInfoId = pageInfoId;
                this.prevBtnId = prevBtnId;
                this.nextBtnId = nextBtnId;
                this.page = 1;
                this.perPage = 10;
            }

            getRows() {
                const tbody = document.getElementById(this.tbodyId);
                return tbody ? Array.from(tbody.querySelectorAll('tr')) : [];
            }

            totalPages() {
                return Math.ceil(this.getRows().length / this.perPage) || 1;
            }

            render() {
                const rows = this.getRows();
                const total = rows.length;
                if (total === 0) {
                    document.getElementById(this.paginationId)?.classList.add('hidden');
                    return;
                }

                document.getElementById(this.paginationId)?.classList.remove('hidden');
                const start = (this.page - 1) * this.perPage;
                const end = start + this.perPage;

                rows.forEach((row, i) => {
                    row.style.display = (i >= start && i < end) ? '' : 'none';
                });

                const showing = Math.min(end, total);
                document.getElementById(this.pageInfoId).textContent = `${start + 1}\u2013${showing} dari ${total}`;

                document.getElementById(this.prevBtnId).disabled = this.page <= 1;
                document.getElementById(this.nextBtnId).disabled = this.page >= this.totalPages();
            }

            next() { if (this.page < this.totalPages()) { this.page++; this.render(); } }
            prev() { if (this.page > 1) { this.page--; this.render(); } }
            setPerPage(val) { this.perPage = parseInt(val); this.page = 1; this.render(); }
            reset() { this.page = 1; this.render(); }
        }

        const bulkPager = new TablePager('bulkResultsBody', 'bulkPagination', 'bulkPageInfo', 'bulkPrevBtn', 'bulkNextBtn');
        const opdPager = new TablePager('opdResultsBody', 'opdPagination', 'opdPageInfo', 'opdPrevBtn', 'opdNextBtn');

        document.addEventListener('DOMContentLoaded', () => {
            const bulkRows = document.getElementById('bulkResultsBody')?.querySelectorAll('tr');
            if (bulkRows && bulkRows.length > 0) {
                bulkPager.render();
            }
        });
    </script>

</x-admin-layout>
