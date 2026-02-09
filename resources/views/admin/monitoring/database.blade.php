<x-admin-layout>
    <x-slot name="header">Statistik Database</x-slot>

    <div class="grid grid-cols-2 gap-6 mb-6">
        <!-- Lokasi Database -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Lokasi Database</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="lokasiChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($lokasiStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $item->lokasi_database }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Akses Database -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Akses Database</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="aksesChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($aksesStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $item->akses_database }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- DBMS -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">DBMS</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="dbmsChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($dbmsStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $item->dbms }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Versi DBMS -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Versi DBMS</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="versiChart"></canvas></div>
                <div class="flex-1 space-y-2 max-h-32 overflow-y-auto">
                    @foreach($versiStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 truncate">{{ $item->versi_dbms }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const opts = { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } };
        const colors = ['#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe', '#dbeafe', '#e0e7ff'];
        new Chart(document.getElementById('lokasiChart'), { type: 'doughnut', data: { labels: {!! json_encode($lokasiStats->pluck('lokasi_database')) !!}, datasets: [{ data: {!! json_encode($lokasiStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: opts });
        new Chart(document.getElementById('aksesChart'), { type: 'doughnut', data: { labels: {!! json_encode($aksesStats->pluck('akses_database')) !!}, datasets: [{ data: {!! json_encode($aksesStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: opts });
        new Chart(document.getElementById('dbmsChart'), { type: 'doughnut', data: { labels: {!! json_encode($dbmsStats->pluck('dbms')) !!}, datasets: [{ data: {!! json_encode($dbmsStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: opts });
        new Chart(document.getElementById('versiChart'), { type: 'doughnut', data: { labels: {!! json_encode($versiStats->pluck('versi_dbms')) !!}, datasets: [{ data: {!! json_encode($versiStats->pluck('total')) !!}, backgroundColor: colors, borderWidth: 0 }] }, options: opts });
    </script>
</x-admin-layout>
