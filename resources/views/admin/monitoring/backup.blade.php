<x-admin-layout>
    <x-slot name="header">Statistik Backup</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.monitoring.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Overview
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Backup Source Code -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white">💻</span>
                Backup Source Code
            </h3>
            <canvas id="codeChart" height="200"></canvas>
            <div class="mt-4 space-y-2">
                @foreach($backupCodeStats as $item)
                <div class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50">
                    <span class="font-medium text-slate-700 text-sm truncate max-w-[150px]">{{ $item->metode_backup_source_code }}</span>
                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Backup Database -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center text-white">💾</span>
                Backup Database
            </h3>
            <canvas id="dbChart" height="200"></canvas>
            <div class="mt-4 space-y-2">
                @foreach($backupDbStats as $item)
                <div class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50">
                    <span class="font-medium text-slate-700 text-sm truncate max-w-[150px]">{{ $item->metode_backup_database }}</span>
                    <span class="px-2 py-0.5 bg-cyan-100 text-cyan-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Backup Asset -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center text-white">📦</span>
                Backup Asset
            </h3>
            <canvas id="assetChart" height="200"></canvas>
            <div class="mt-4 space-y-2">
                @foreach($backupAssetStats as $item)
                <div class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50">
                    <span class="font-medium text-slate-700 text-sm truncate max-w-[150px]">{{ $item->metode_backup_asset }}</span>
                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const colors = ['#0ea5e9', '#06b6d4', '#14b8a6', '#8b5cf6', '#f59e0b', '#ef4444', '#10b981'];
        new Chart(document.getElementById('codeChart'), { type: 'doughnut', data: { labels: {!! json_encode($backupCodeStats->pluck('metode_backup_source_code')) !!}, datasets: [{ data: {!! json_encode($backupCodeStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: { plugins: { legend: { display: false } } } });
        new Chart(document.getElementById('dbChart'), { type: 'doughnut', data: { labels: {!! json_encode($backupDbStats->pluck('metode_backup_database')) !!}, datasets: [{ data: {!! json_encode($backupDbStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: { plugins: { legend: { display: false } } } });
        new Chart(document.getElementById('assetChart'), { type: 'doughnut', data: { labels: {!! json_encode($backupAssetStats->pluck('metode_backup_asset')) !!}, datasets: [{ data: {!! json_encode($backupAssetStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: { plugins: { legend: { display: false } } } });
    </script>
</x-admin-layout>
