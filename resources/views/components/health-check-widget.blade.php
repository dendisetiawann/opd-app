{{-- Floating Health Check Widget v2 - Robust & Smooth --}}
<div id="hcWidget" class="fixed bottom-5 right-5 z-[90] transition-all duration-300 ease-in-out" style="display:none;">

    {{-- Minimized State --}}
    <div id="hcWidgetMin" style="display:none;" class="cursor-pointer group" onclick="HCWidget.maximize()">
        <div class="flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-xl shadow-indigo-500/30 hover:shadow-2xl hover:shadow-indigo-500/40 hover:scale-105 transition-all duration-200">
            <div class="relative">
                <i id="hcMinIcon" class="fa-solid fa-spinner fa-spin text-sm"></i>
                <span id="hcMinDot" class="absolute -top-1 -right-1.5 w-2.5 h-2.5 bg-emerald-400 rounded-full border-2 border-indigo-600 animate-pulse" style="display:none;"></span>
            </div>
            <span id="hcMinText" class="text-xs font-bold whitespace-nowrap">Health Check</span>
            <span id="hcMinPct" class="text-[10px] font-bold bg-white/20 px-1.5 py-0.5 rounded-full">0%</span>
        </div>
    </div>

    {{-- Expanded State --}}
    <div id="hcWidgetMax" class="w-[360px] rounded-2xl overflow-hidden shadow-2xl shadow-black/20 dark:shadow-black/50 border border-gray-200/80 dark:border-zinc-700/80 backdrop-blur-xl">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 px-4 py-3 flex items-center justify-between cursor-move select-none">
            <div class="flex items-center gap-2.5">
                <div class="relative">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <i id="hcHeaderIcon" class="fa-solid fa-satellite-dish text-white text-sm"></i>
                    </div>
                    <span id="hcHeaderDot" class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-amber-400 rounded-full border-2 border-indigo-600 animate-pulse"></span>
                </div>
                <div>
                    <p class="text-white text-xs font-bold tracking-wide">Health Check</p>
                    <p id="hcHeaderSub" class="text-blue-200 text-[10px] font-medium">Mengecek website...</p>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button onclick="HCWidget.minimize()" class="w-7 h-7 rounded-lg bg-white/10 hover:bg-white/25 text-white flex items-center justify-center transition-all" title="Minimize">
                    <i class="fa-solid fa-minus text-[10px]"></i>
                </button>
                <button onclick="HCWidget.close()" class="w-7 h-7 rounded-lg bg-white/10 hover:bg-red-500/80 text-white flex items-center justify-center transition-all" title="Tutup">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <div class="bg-white dark:bg-zinc-900 px-4 py-4">
            {{-- Progress section (shown during check) --}}
            <div id="hcBodyProgress">
                <div class="flex items-center justify-between mb-2">
                    <p id="hcStatusText" class="text-xs font-semibold text-slate-600 dark:text-zinc-300">Memulai pengecekan...</p>
                    <span id="hcPctText" class="text-xs font-bold text-indigo-600 dark:text-indigo-400">0%</span>
                </div>
                <div class="h-2.5 bg-gray-100 dark:bg-zinc-800 rounded-full overflow-hidden">
                    <div id="hcProgressBar" class="h-full bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 rounded-full transition-all duration-700 ease-out relative" style="width: 0%">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-pulse"></div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <p id="hcDetailText" class="text-[10px] text-slate-400 dark:text-zinc-500">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        <span>Proses berjalan di background</span>
                    </p>
                    <p id="hcCountText" class="text-[10px] font-semibold text-slate-500 dark:text-zinc-400">0 / 0</p>
                </div>
            </div>

            {{-- Completed section (shown when done) --}}
            <div id="hcBodyDone" style="display:none;">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-500/15 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 dark:text-white">Pengecekan Selesai!</p>
                        <p id="hcDoneSummary" class="text-[10px] text-slate-500 dark:text-zinc-400">0 website telah dicek</p>
                    </div>
                </div>
            </div>

            {{-- Failed section --}}
            <div id="hcBodyFailed" style="display:none;">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 dark:bg-red-500/15 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-circle-xmark text-red-500 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-600 dark:text-red-400">Pengecekan Gagal</p>
                        <p id="hcFailedMsg" class="text-[10px] text-slate-500 dark:text-zinc-400">Terjadi kesalahan</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div id="hcFooter" class="bg-gray-50 dark:bg-zinc-950 border-t border-gray-100 dark:border-zinc-800 px-4 py-2.5 flex items-center justify-between" style="display:none;">
            <a id="hcViewLink" href="#" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                Lihat Hasil
            </a>
            <button onclick="HCWidget.close()" class="text-[10px] font-medium text-slate-400 hover:text-slate-600 dark:hover:text-zinc-300 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
window.HCWidget = (function() {
    const LS_KEY = 'hcWidgetData'; // Single key for all state
    const POLL_FAST = 2000;  // 2s when actively checking
    const POLL_SLOW = 5000;  // 5s fallback
    const STALE_MS  = 30 * 60 * 1000; // 30 min = stale, auto-cleanup

    let pollingTimer = null;
    let pollCount = 0;
    let isVisible = false;

    // ──── LocalStorage helpers ────
    function saveState(obj) {
        const current = loadState();
        const merged = { ...current, ...obj, updatedAt: Date.now() };
        try { localStorage.setItem(LS_KEY, JSON.stringify(merged)); } catch(e) {}
    }

    function loadState() {
        try {
            const raw = localStorage.getItem(LS_KEY);
            return raw ? JSON.parse(raw) : null;
        } catch(e) { return null; }
    }

    function clearState() {
        try { localStorage.removeItem(LS_KEY); } catch(e) {}
    }

    function isStale(state) {
        if (!state || !state.updatedAt) return true;
        return (Date.now() - state.updatedAt) > STALE_MS;
    }

    // ──── URL builders ────
    function getProgressUrl(batchId, role) {
        const prefix = (role === 'admin') ? '/admin/monitoring/status-website' : '/monitoring/status-website';
        return `${prefix}/bulk-progress/${batchId}`;
    }

    function getResultsPageUrl(role) {
        return (role === 'admin') ? '/admin/monitoring/status-website' : '/monitoring/status-website';
    }

    // ──── DOM helpers ────
    function el(id) { return document.getElementById(id); }

    function show() {
        const w = el('hcWidget');
        if (!w) return;
        w.style.display = '';
        isVisible = true;
        const state = loadState();
        if (state && state.viewState === 'min') {
            el('hcWidgetMin').style.display = '';
            el('hcWidgetMax').style.display = 'none';
        } else {
            el('hcWidgetMin').style.display = 'none';
            el('hcWidgetMax').style.display = '';
        }
    }

    function hide() {
        const w = el('hcWidget');
        if (w) w.style.display = 'none';
        isVisible = false;
    }

    function minimize() {
        saveState({ viewState: 'min' });
        el('hcWidgetMax').style.display = 'none';
        el('hcWidgetMin').style.display = '';
    }

    function maximize() {
        saveState({ viewState: 'max' });
        el('hcWidgetMin').style.display = 'none';
        el('hcWidgetMax').style.display = '';
    }

    function close() {
        stopPolling();
        clearState();
        hide();
    }

    // ──── UI updates ────
    function resetUI() {
        el('hcBodyProgress').style.display = '';
        el('hcBodyDone').style.display = 'none';
        el('hcBodyFailed').style.display = 'none';
        el('hcFooter').style.display = 'none';

        el('hcProgressBar').style.width = '0%';
        el('hcPctText').textContent = '0%';
        el('hcCountText').textContent = '0 / 0';
        el('hcStatusText').textContent = 'Memulai pengecekan...';
        el('hcHeaderSub').textContent = 'Mengecek website...';
        el('hcHeaderIcon').className = 'fa-solid fa-satellite-dish text-white text-sm';
        el('hcHeaderDot').style.display = '';

        el('hcMinIcon').className = 'fa-solid fa-spinner fa-spin text-sm';
        el('hcMinDot').style.display = 'none';
        el('hcMinText').textContent = 'Health Check';
        el('hcMinPct').textContent = '0%';
    }

    function updateProgress(data) {
        const pct = data.percent || 0;
        const completed = data.completed || 0;
        const total = data.total || 0;

        el('hcProgressBar').style.width = pct + '%';
        el('hcPctText').textContent = pct + '%';
        el('hcMinPct').textContent = pct + '%';
        el('hcCountText').textContent = `${completed} / ${total}`;

        let statusText = `Mengecek ${completed} dari ${total} website...`;
        if (data.status === 'pending') {
            statusText = 'Menunggu queue...';
        } else if (total === 0) {
            statusText = 'Menghitung total website...';
        }
        el('hcStatusText').textContent = statusText;
        el('hcHeaderSub').textContent = statusText;
        el('hcMinText').textContent = `Health Check ${pct}%`;
    }

    function showCompleted(total, fireEvent) {
        stopPolling();
        saveState({ status: 'completed', total: total });

        el('hcBodyProgress').style.display = 'none';
        el('hcBodyDone').style.display = '';
        el('hcBodyFailed').style.display = 'none';

        el('hcDoneSummary').textContent = `${total} website telah dicek`;
        el('hcHeaderSub').textContent = 'Pengecekan selesai!';
        el('hcHeaderIcon').className = 'fa-solid fa-circle-check text-white text-sm';
        el('hcHeaderDot').style.display = 'none';

        el('hcMinIcon').className = 'fa-solid fa-circle-check text-sm';
        el('hcMinDot').style.display = '';
        el('hcMinText').textContent = 'Selesai!';
        el('hcMinPct').textContent = '✓';

        const state = loadState();
        el('hcFooter').style.display = '';
        el('hcViewLink').href = getResultsPageUrl(state?.role || 'admin');

        if (fireEvent) {
            window.dispatchEvent(new CustomEvent('healthcheck:completed'));
        }
    }

    function showFailed(msg) {
        stopPolling();
        saveState({ status: 'failed' });

        el('hcBodyProgress').style.display = 'none';
        el('hcBodyDone').style.display = 'none';
        el('hcBodyFailed').style.display = '';
        el('hcFailedMsg').textContent = msg || 'Terjadi kesalahan';

        el('hcHeaderSub').textContent = 'Gagal';
        el('hcHeaderIcon').className = 'fa-solid fa-circle-xmark text-white text-sm';
        el('hcHeaderDot').style.display = 'none';

        el('hcMinIcon').className = 'fa-solid fa-circle-xmark text-sm';
        el('hcMinText').textContent = 'Gagal';
        el('hcMinPct').textContent = '✗';

        const state = loadState();
        el('hcFooter').style.display = '';
        el('hcViewLink').href = getResultsPageUrl(state?.role || 'admin');
    }

    // ──── Polling ────
    function stopPolling() {
        if (pollingTimer) {
            clearTimeout(pollingTimer);
            pollingTimer = null;
        }
        pollCount = 0;
    }

    async function poll() {
        const state = loadState();
        if (!state || !state.batchId) { stopPolling(); hide(); return; }
        if (state.status === 'completed' || state.status === 'failed') return;

        pollCount++;
        const url = getProgressUrl(state.batchId, state.role);

        try {
            const res = await fetch(url);

            if (!res.ok) {
                // On 404/500 retry a few times then fail
                if (pollCount > 5) {
                    showFailed('Server tidak merespons');
                    return;
                }
                scheduleNext(POLL_SLOW);
                return;
            }

            const data = await res.json();

            if (data.error) {
                showFailed(data.error);
                return;
            }

            updateProgress(data);

            if (data.status === 'completed') {
                showCompleted(data.total || data.completed || 0, true);
                return;
            }

            if (data.status === 'failed') {
                showFailed('Pengecekan gagal');
                return;
            }

            // Still running — schedule next poll
            // Use fast polling for first 30 polls (~1 min), then slow
            scheduleNext(pollCount < 30 ? POLL_FAST : POLL_SLOW);

        } catch (e) {
            console.error('HC Widget poll error:', e);
            // Retry on network errors
            if (pollCount > 10) {
                showFailed('Koneksi terputus');
                return;
            }
            scheduleNext(POLL_SLOW);
        }
    }

    function scheduleNext(delay) {
        pollingTimer = setTimeout(poll, delay);
    }

    function startPolling(batchId, role) {
        stopPolling();

        const state = loadState();

        // If state says already completed/failed, show that directly
        if (state && state.batchId === batchId) {
            if (state.status === 'completed') {
                show();
                showCompleted(state.total || 0, false);
                return;
            }
            if (state.status === 'failed') {
                show();
                showFailed(null);
                return;
            }
        }

        resetUI();
        show();

        // First poll immediately
        poll();
    }

    // ──── Public API ────
    function start(batchId, role) {
        clearState();
        saveState({ batchId, role, status: 'running', viewState: 'max' });
        startPolling(batchId, role);
    }

    // ──── Auto-init on page load ────
    document.addEventListener('DOMContentLoaded', () => {
        const state = loadState();
        if (!state || !state.batchId) return;

        // Cleanup stale data (older than 30 min)
        if (isStale(state)) {
            clearState();
            return;
        }

        // Restore widget from saved state
        startPolling(state.batchId, state.role);
    });

    // Listen for start events from health check pages
    window.addEventListener('healthcheck:start', (e) => {
        if (e.detail && e.detail.batchId) {
            start(e.detail.batchId, e.detail.role || 'admin');
        }
    });

    return { show, hide, minimize, maximize, close, start, startPolling, stopPolling };
})();
</script>
