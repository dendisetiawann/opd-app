<x-admin-layout>
    <x-slot name="header">
        Statistik Teknologi
    </x-slot>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.monitoring.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Overview
        </a>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Framework Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white text-sm">🔧</span>
                Framework
            </h3>
            <canvas id="frameworkChart" height="250"></canvas>
            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach($frameworkStats as $item)
                <a href="{{ route('admin.monitoring.teknologi', ['filter' => 'framework', 'value' => $item->framework]) }}" 
                   class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition-colors text-sm {{ $selectedValue == $item->framework ? 'bg-blue-50 border border-blue-200' : '' }}">
                    <span class="font-medium text-slate-700">{{ $item->framework }}</span>
                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Bahasa Pemrograman Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white text-sm">💻</span>
                Bahasa Pemrograman
            </h3>
            <canvas id="bahasaChart" height="250"></canvas>
            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach($bahasaStats as $item)
                <a href="{{ route('admin.monitoring.teknologi', ['filter' => 'bahasa_pemrograman', 'value' => $item->bahasa_pemrograman]) }}" 
                   class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition-colors text-sm {{ $selectedValue == $item->bahasa_pemrograman ? 'bg-purple-50 border border-purple-200' : '' }}">
                    <span class="font-medium text-slate-700">{{ $item->bahasa_pemrograman }}</span>
                    <span class="px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- DBMS Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-lg flex items-center justify-center text-white text-sm">💾</span>
                Database Management System
            </h3>
            <canvas id="dbmsChart" height="250"></canvas>
            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach($dbmsStats as $item)
                <a href="{{ route('admin.monitoring.teknologi', ['filter' => 'dbms', 'value' => $item->dbms]) }}" 
                   class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition-colors text-sm {{ $selectedValue == $item->dbms ? 'bg-cyan-50 border border-cyan-200' : '' }}">
                    <span class="font-medium text-slate-700">{{ $item->dbms }}</span>
                    <span class="px-2 py-0.5 bg-cyan-100 text-cyan-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Arsitektur Chart -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <span class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center text-white text-sm">🏗️</span>
                Arsitektur Sistem
            </h3>
            <canvas id="arsitekturChart" height="250"></canvas>
            <div class="mt-4 grid grid-cols-2 gap-2">
                @foreach($arsitekturStats as $item)
                <a href="{{ route('admin.monitoring.teknologi', ['filter' => 'arsitektur_sistem', 'value' => $item->arsitektur_sistem]) }}" 
                   class="flex items-center justify-between p-2 rounded-lg hover:bg-slate-50 transition-colors text-sm {{ $selectedValue == $item->arsitektur_sistem ? 'bg-emerald-50 border border-emerald-200' : '' }}">
                    <span class="font-medium text-slate-700">{{ $item->arsitektur_sistem }}</span>
                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full font-bold text-xs">{{ $item->total }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Drill-down Table -->
    @if($drilldownData && $drilldownData->count() > 0)
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <span class="text-xl">📋</span>
                Aplikasi dengan {{ ucfirst(str_replace('_', ' ', $filter)) }}: <span class="text-cyan-600">{{ $selectedValue }}</span>
            </h3>
            <a href="{{ route('admin.monitoring.teknologi') }}" class="text-sm text-slate-500 hover:text-slate-700">
                × Tutup filter
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-3 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Aplikasi</th>
                        <th class="text-left py-3 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">OPD</th>
                        <th class="text-left py-3 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Framework</th>
                        <th class="text-left py-3 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Bahasa</th>
                        <th class="text-left py-3 px-4 text-xs font-bold text-slate-500 uppercase tracking-wider">DBMS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($drilldownData as $app)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.web-apps.show', $app) }}" class="font-semibold text-slate-800 hover:text-cyan-600 transition-colors">
                                {{ $app->nama_web_app }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-sm text-slate-600">{{ $app->opd->nama_opd ?? '-' }}</td>
                        <td class="py-3 px-4"><span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-medium">{{ $app->framework }}</span></td>
                        <td class="py-3 px-4"><span class="px-2 py-1 bg-purple-50 text-purple-700 rounded text-xs font-medium">{{ $app->bahasa_pemrograman }}</span></td>
                        <td class="py-3 px-4"><span class="px-2 py-1 bg-cyan-50 text-cyan-700 rounded text-xs font-medium">{{ $app->dbms }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $drilldownData->links() }}
        </div>
    </div>
    @endif

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const colors = ['#0ea5e9', '#06b6d4', '#14b8a6', '#8b5cf6', '#f59e0b', '#ef4444', '#10b981', '#6366f1', '#ec4899', '#84cc16'];
        
        new Chart(document.getElementById('frameworkChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($frameworkStats->pluck('framework')) !!},
                datasets: [{ data: {!! json_encode($frameworkStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        new Chart(document.getElementById('bahasaChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($bahasaStats->pluck('bahasa_pemrograman')) !!},
                datasets: [{ data: {!! json_encode($bahasaStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        new Chart(document.getElementById('dbmsChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($dbmsStats->pluck('dbms')) !!},
                datasets: [{ data: {!! json_encode($dbmsStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        new Chart(document.getElementById('arsitekturChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($arsitekturStats->pluck('arsitektur_sistem')) !!},
                datasets: [{ data: {!! json_encode($arsitekturStats->pluck('total')) !!}, backgroundColor: ['#3b82f6', '#10b981'], borderWidth: 0 }]
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });
    </script>
</x-admin-layout>
