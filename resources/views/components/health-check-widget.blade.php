{{-- Floating Health Check Widget - Persists across page navigation --}}
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
    const LS_BATCH   = 'hcBatchId';
    const LS_ROLE    = 'hcRole';
    const LS_STATE   = 'hcWidgetState'; // 'min' | 'max'
    const LS_STATUS  = 'hcBatchStatus';
    const LS_TOTAL   = 'hcBatchTotal';

    let pollingInterval = null;
    let isVisible = false;

    function getEls() {
        return {
            widget:       document.getElementById('hcWidget'),
            widgetMin:    document.getElementById('hcWidgetMin'),
            widgetMax:    document.getElementById('hcWidgetMax'),
            minIcon:      document.getElementById('hcMinIcon'),
            minDot:       document.getElementById('hcMinDot'),
            minText:      document.getElementById('hcMinText'),
            minPct:       document.getElementById('hcMinPct'),
            headerIcon:   document.getElementById('hcHeaderIcon'),
            headerDot:    document.getElementById('hcHeaderDot'),
            headerSub:    document.getElementById('hcHeaderSub'),
            statusText:   document.getElementById('hcStatusText'),
            pctText:      document.getElementById('hcPctText'),
            progressBar:  document.getElementById('hcProgressBar'),
            detailText:   document.getElementById('hcDetailText'),
            countText:    document.getElementById('hcCountText'),
            bodyProgress: document.getElementById('hcBodyProgress'),
            bodyDone:     document.getElementById('hcBodyDone'),
            bodyFailed:   document.getElementById('hcBodyFailed'),
            doneSummary:  document.getElementById('hcDoneSummary'),
            failedMsg:    document.getElementById('hcFailedMsg'),
            footer:       document.getElementById('hcFooter'),
            viewLink:     document.getElementById('hcViewLink'),
        };
    }

    function getProgressUrl(batchId) {
        const role = localStorage.getItem(LS_ROLE) || 'admin';
        if (role === 'admin') {
            return `/admin/monitoring/health-check/bulk-progress/${batchId}`;
        }
        return `/monitoring/health-check/bulk-progress/${batchId}`;
    }

    function getResultsPageUrl() {
        const role = localStorage.getItem(LS_ROLE) || 'admin';
        if (role === 'admin') return '/admin/monitoring/health-check';
        return '/monitoring/health-check';
    }

    function show() {
        const el = getEls();
        if (!el.widget) return;
        el.widget.style.display = '';
        isVisible = true;

        const state = localStorage.getItem(LS_STATE) || 'max';
        if (state === 'min') {
            el.widgetMin.style.display = '';
            el.widgetMax.style.display = 'none';
        } else {
            el.widgetMin.style.display = 'none';
            el.widgetMax.style.display = '';
        }
    }

    function hide() {
        const el = getEls();
        if (!el.widget) return;
        el.widget.style.display = 'none';
        isVisible = false;
    }

    function minimize() {
        const el = getEls();
        if (!el.widget) return;
        localStorage.setItem(LS_STATE, 'min');
        el.widgetMax.style.display = 'none';
        el.widgetMin.style.display = '';
    }

    function maximize() {
        const el = getEls();
        if (!el.widget) return;
        localStorage.setItem(LS_STATE, 'max');
        el.widgetMin.style.display = 'none';
        el.widgetMax.style.display = '';
    }

    function close() {
        stopPolling();
        localStorage.removeItem(LS_BATCH);
        localStorage.removeItem(LS_ROLE);
        localStorage.removeItem(LS_STATE);
        localStorage.removeItem(LS_STATUS);
        localStorage.removeItem(LS_TOTAL);
        hide();
    }

    function updateProgress(data) {
        const el = getEls();
        if (!el.widget) return;

        const pct = data.percent || 0;
        const completed = data.completed || 0;
        const total = data.total || 0;

        // Progress bar
        el.progressBar.style.width = pct + '%';
        el.pctText.textContent = pct + '%';
        el.minPct.textContent = pct + '%';
        el.countText.textContent = `${completed} / ${total}`;

        // Status text
        let statusText = `Mengecek ${completed} dari ${total} website...`;
        if (data.status === 'pending') {
            statusText = 'Menunggu queue...';
        } else if (total === 0) {
            statusText = 'Menghitung total website...';
        }
        el.statusText.textContent = statusText;
        el.headerSub.textContent = statusText;
        el.minText.textContent = `Health Check ${pct}%`;
    }

    function showCompleted(data, fromStorage) {
        const el = getEls();
        if (!el.widget) return;

        localStorage.setItem(LS_STATUS, 'completed');

        // Save total for restoring later
        const total = data.total || data.completed || 0;
        localStorage.setItem(LS_TOTAL, total);

        // Switch body
        el.bodyProgress.style.display = 'none';
        el.bodyDone.style.display = '';
        el.bodyFailed.style.display = 'none';

        // Update summary
        el.doneSummary.textContent = `${total} website telah dicek`;

        // Update header
        el.headerSub.textContent = 'Pengecekan selesai!';
        el.headerIcon.className = 'fa-solid fa-circle-check text-white text-sm';
        el.headerDot.style.display = 'none';

        // Update minimized
        el.minIcon.className = 'fa-solid fa-circle-check text-sm';
        el.minDot.style.display = '';
        el.minText.textContent = 'Selesai!';
        el.minPct.textContent = '✓';

        // Show footer
        el.footer.style.display = '';
        el.viewLink.href = getResultsPageUrl();

        // Only notify on fresh completion (not when restoring from localStorage)
        // This prevents infinite reload loops on the health check page
        if (!fromStorage) {
            window.dispatchEvent(new CustomEvent('healthcheck:completed'));
        }
    }

    function showFailed(msg, fromStorage) {
        const el = getEls();
        if (!el.widget) return;

        localStorage.setItem(LS_STATUS, 'failed');

        el.bodyProgress.style.display = 'none';
        el.bodyDone.style.display = 'none';
        el.bodyFailed.style.display = '';
        el.failedMsg.textContent = msg || 'Terjadi kesalahan';

        el.headerSub.textContent = 'Gagal';
        el.headerIcon.className = 'fa-solid fa-circle-xmark text-white text-sm';
        el.headerDot.style.display = 'none';

        el.minIcon.className = 'fa-solid fa-circle-xmark text-sm';
        el.minText.textContent = 'Gagal';
        el.minPct.textContent = '✗';

        el.footer.style.display = '';
        el.viewLink.href = getResultsPageUrl();
    }

    function startPolling(batchId) {
        stopPolling();

        const status = localStorage.getItem(LS_STATUS);
        if (status === 'completed') {
            show();
            showCompleted({ total: parseInt(localStorage.getItem(LS_TOTAL)) || 0 }, true);
            return;
        }
        if (status === 'failed') {
            show();
            showFailed(null, true);
            return;
        }

        resetUI();
        show();

        pollingInterval = setInterval(async () => {
            try {
                const res = await fetch(getProgressUrl(batchId));
                if (!res.ok) {
                    const errData = await res.json().catch(() => ({}));
                    if (errData.status === 'failed' || res.status >= 500) {
                        stopPolling();
                        showFailed(errData.error || 'Server error');
                    }
                    return;
                }

                const data = await res.json();

                if (data.error) {
                    stopPolling();
                    showFailed(data.error);
                    return;
                }

                updateProgress(data);

                if (data.status === 'completed') {
                    stopPolling();
                    showCompleted(data);
                } else if (data.status === 'failed') {
                    stopPolling();
                    showFailed('Pengecekan gagal');
                }
            } catch (e) {
                console.error('HC Widget polling error:', e);
            }
        }, 5000);
    }

    function stopPolling() {
        if (pollingInterval) {
            clearInterval(pollingInterval);
            pollingInterval = null;
        }
    }

    function resetUI() {
        const el = getEls();
        if (!el.widget) return;

        el.bodyProgress.style.display = '';
        el.bodyDone.style.display = 'none';
        el.bodyFailed.style.display = 'none';
        el.footer.style.display = 'none';

        el.progressBar.style.width = '0%';
        el.pctText.textContent = '0%';
        el.countText.textContent = '0 / 0';
        el.statusText.textContent = 'Memulai pengecekan...';
        el.headerSub.textContent = 'Mengecek website...';
        el.headerIcon.className = 'fa-solid fa-satellite-dish text-white text-sm';
        el.headerDot.style.display = '';

        el.minIcon.className = 'fa-solid fa-spinner fa-spin text-sm';
        el.minDot.style.display = 'none';
        el.minText.textContent = 'Health Check';
        el.minPct.textContent = '0%';
    }

    function start(batchId, role) {
        localStorage.setItem(LS_BATCH, batchId);
        localStorage.setItem(LS_ROLE, role);
        localStorage.removeItem(LS_STATUS);
        localStorage.setItem(LS_STATE, 'max');
        startPolling(batchId);
    }

    // Auto-init on page load
    document.addEventListener('DOMContentLoaded', () => {
        const batchId = localStorage.getItem(LS_BATCH);
        if (batchId) {
            startPolling(batchId);
        }
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
