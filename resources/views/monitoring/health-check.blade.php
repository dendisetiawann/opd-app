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
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Pantau status aktif website milik OPD Anda secara real-time. Hanya menampilkan aplikasi bertipe website.</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Website -->
        <div class="bg-white dark:bg-black rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-indigo-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-indigo-400 to-violet-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-indigo-100 dark:ring-indigo-900/30 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-globe w-6 h-6 text-white flex items-center justify-center"></i>
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
                        <i class="fa-solid fa-circle-check w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="min-w-0 overflow-hidden">
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Website Aktif</p>
                    <p class="text-2xl font-black text-emerald-600" id="activeCount"><span class="text-sm font-medium text-slate-300 dark:text-zinc-600">@if($webApps->count() > 0) Klik Cek Semua @else Tidak ada website @endif</span></p>
                </div>
            </div>
        </div>

        <!-- Website Tidak Aktif -->
        <div class="bg-white dark:bg-black rounded-xl p-5 shadow-sm border border-gray-100 dark:border-zinc-800 hover:shadow-md transition-all cursor-pointer group">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="absolute inset-0 bg-red-400 rounded-xl blur-lg opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <div class="relative w-12 h-12 bg-gradient-to-br from-red-400 to-rose-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-red-100 dark:ring-red-900/30 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-circle-xmark w-6 h-6 text-white flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="min-w-0 overflow-hidden">
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Tidak Aktif</p>
                    <p class="text-2xl font-black text-red-600" id="inactiveCount"><span class="text-sm font-medium text-slate-300 dark:text-zinc-600">@if($webApps->count() > 0) Klik Cek Semua @else Tidak ada website @endif</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== CEK SEMUA SECTION ========== -->
    <div class="bg-white dark:bg-black rounded-xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden mb-6">
        <div class="border-b border-gray-100 dark:border-zinc-800 bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/10 px-6 py-4 flex items-center justify-between">
            <h3 class="text-sm font-bold text-indigo-800 dark:text-indigo-300 flex items-center gap-2">
                <i class="fa-solid fa-globe w-4 h-4 text-indigo-500 flex items-center justify-center"></i>
                Cek Semua Website OPD
            </h3>
            <div class="flex items-center gap-3">
                @if($latestBatch && $latestBatch->status === 'completed')
                <a href="{{ route('monitoring.health-check.export', $latestBatch->batch_id) }}" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold rounded-lg transition-all shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-file-excel w-3.5 h-3.5 flex items-center justify-center"></i>
                    Export Excel
                </a>
                @endif
                <button type="button" onclick="startBulkCheck()" id="bulkCheckBtn" class="px-5 py-2 bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white text-xs font-semibold rounded-lg transition-all shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                    <i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i>
                    Cek Semua ({{ $totalCount }} website)
                </button>
            </div>
        </div>

        <!-- Progress Banner -->
        <div id="bulkProgressBanner" class="hidden border-b border-amber-200 dark:border-amber-700 bg-amber-50 dark:bg-amber-900/20 px-6 py-3">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0"><i class="fa-solid fa-spinner fa-spin text-amber-600 dark:text-amber-400"></i></div>
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
                            <td class="px-4 py-3">
                                @php $codeColor = $r->http_code >= 200 && $r->http_code < 300 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : ($r->http_code >= 300 && $r->http_code < 400 ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : ($r->http_code >= 400 ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 'bg-gray-100 text-gray-600 dark:bg-zinc-800 dark:text-zinc-400')); @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $codeColor }}">{{ $r->http_code ?: 0 }}</span>
                            </td>
                            <td class="px-4 py-3 text-[10px] text-slate-500 dark:text-zinc-400">{{ \App\Models\HealthCheckResult::httpCodeDescription($r->http_code) }}</td>
                            <td class="px-4 py-3">
                                @php $statusBadge = match($r->status) { 'online' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'slow' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400', default => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }; @endphp
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

        <div id="bulkEmptyState" class="{{ ($latestBatch && $latestBatch->status === 'completed' && $bulkResults->count() > 0) ? 'hidden' : '' }}">
            @if(!$latestBatch || $latestBatch->status === 'completed')
            <div class="p-10 text-center">
                <i class="fa-solid fa-globe text-4xl text-gray-200 dark:text-zinc-700 mb-3"></i>
                <p class="text-sm text-gray-400 dark:text-zinc-500">Klik "Cek Semua" untuk memulai pengecekan massal</p>
            </div>
            @endif
        </div>
    </div>

    @if($webApps->count() == 0)
    <!-- Empty State -->
    <div class="bg-white dark:bg-black rounded-xl p-12 border border-gray-100 dark:border-zinc-800 text-center shadow-sm">
        <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-orange-200 dark:from-amber-900/30 dark:to-orange-900/30 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <i class="fa-solid fa-triangle-exclamation w-10 h-10 text-amber-500 flex items-center justify-center"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-2">Tidak Ada Website</h3>
        <p class="text-slate-500 dark:text-slate-400 text-sm">OPD Anda tidak memiliki website bertipe web dengan URL yang bisa dicek</p>
    </div>
    @endif

    {{-- ========== BULK CHECK JAVASCRIPT ========== --}}
    <script>
        let bulkPollingInterval = null;
        let currentBatchId = @json($latestBatch?->batch_id);
        const csrfToken = '{{ csrf_token() }}';

        @if($latestBatch && in_array($latestBatch->status, ['pending', 'running', 'done']))
        document.addEventListener('DOMContentLoaded', () => {
            showProgressBanner();
            if (window.HCWidget) {
                window.HCWidget.start('{{ $latestBatch->batch_id }}', 'user');
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
                
                const response = await fetch('{{ route("monitoring.health-check.bulk-start") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                });
                const data = await response.json();
                
                if (response.status === 409) {
                    currentBatchId = data.batch_id;
                    showProgressBanner();
                    window.dispatchEvent(new CustomEvent('healthcheck:start', { detail: { batchId: data.batch_id, role: 'user' } }));
                    startPolling(data.batch_id);
                    return;
                }
                
                if (data.batch_id) {
                    currentBatchId = data.batch_id;
                    showProgressBanner();
                    window.dispatchEvent(new CustomEvent('healthcheck:start', { detail: { batchId: data.batch_id, role: 'user' } }));
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
                    const res = await fetch(`{{ url(route('monitoring.health-check.bulk-progress', ['batchId' => '__BATCH__'], false)) }}`.replace('__BATCH__', batchId));
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
                            window.location.reload();
                        } else {
                            document.getElementById('bulkProgressText').textContent = 'Pengecekan gagal.';
                            document.getElementById('bulkCheckBtn').disabled = false;
                            document.getElementById('bulkCheckBtn').innerHTML = '<i class="fa-solid fa-bolt w-3.5 h-3.5 flex items-center justify-center"></i> Coba Lagi';
                        }
                    }
                } catch (e) {
                    console.error('Polling error:', e);
                }
            }, 5000);
        }

        // Pagination
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
            totalPages() { return Math.ceil(this.getRows().length / this.perPage) || 1; }
            render() {
                const rows = this.getRows();
                const total = rows.length;
                if (total === 0) { document.getElementById(this.paginationId)?.classList.add('hidden'); return; }
                document.getElementById(this.paginationId)?.classList.remove('hidden');
                const start = (this.page - 1) * this.perPage;
                const end = start + this.perPage;
                rows.forEach((row, i) => { row.style.display = (i >= start && i < end) ? '' : 'none'; });
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

        document.addEventListener('DOMContentLoaded', () => {
            const bulkRows = document.getElementById('bulkResultsBody')?.querySelectorAll('tr');
            if (bulkRows && bulkRows.length > 0) {
                bulkPager.render();
            }
        });
    </script>

</x-app-layout>
