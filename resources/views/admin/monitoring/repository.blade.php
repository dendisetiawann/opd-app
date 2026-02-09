<x-admin-layout>
    <x-slot name="header">Statistik Repository</x-slot>

    <div class="grid grid-cols-3 gap-6 mb-6">
        <!-- Has Repository -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Kepemilikan Repository</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="hasRepoChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($hasRepoStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $item->has_repository == 'ya' ? 'Punya' : 'Tidak Punya' }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Git Type -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Tipe Repository</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="gitTypeChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($gitTypeStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $item->git_repository }}</span>
                        <span class="font-medium text-gray-900">{{ $item->total }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Provider -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Penyedia Repository</h3>
            <div class="flex gap-4">
                <div class="w-32 h-32"><canvas id="providerChart"></canvas></div>
                <div class="flex-1 space-y-2">
                    @foreach($providerStats as $item)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">{{ $item->penyedia_repository }}</span>
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
        new Chart(document.getElementById('hasRepoChart'), {
            type: 'doughnut',
            data: { labels: {!! json_encode($hasRepoStats->pluck('has_repository')->map(fn($v) => $v == 'ya' ? 'Punya' : 'Tidak')) !!}, datasets: [{ data: {!! json_encode($hasRepoStats->pluck('total')) !!}, backgroundColor: ['#10b981', '#ef4444'], borderWidth: 0 }] },
            options: opts
        });
        new Chart(document.getElementById('gitTypeChart'), {
            type: 'doughnut',
            data: { labels: {!! json_encode($gitTypeStats->pluck('git_repository')) !!}, datasets: [{ data: {!! json_encode($gitTypeStats->pluck('total')) !!}, backgroundColor: ['#3b82f6', '#8b5cf6'], borderWidth: 0 }] },
            options: opts
        });
        new Chart(document.getElementById('providerChart'), {
            type: 'doughnut',
            data: { labels: {!! json_encode($providerStats->pluck('penyedia_repository')) !!}, datasets: [{ data: {!! json_encode($providerStats->pluck('total')) !!}, backgroundColor: ['#3b82f6', '#60a5fa', '#93c5fd', '#bfdbfe'], borderWidth: 0 }] },
            options: opts
        });
    </script>
</x-admin-layout>
