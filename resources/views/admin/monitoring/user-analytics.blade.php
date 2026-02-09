<x-admin-layout>
    <x-slot name="header">User Analytics</x-slot>

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">User Aktif (30 hari)</p>
            <p class="text-2xl font-bold text-green-600">{{ $activeUsers }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">User Tidak Aktif</p>
            <p class="text-2xl font-bold text-red-600">{{ $inactiveUsers }}</p>
        </div>
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total User</p>
            <p class="text-2xl font-bold text-gray-900">{{ $users->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6 mb-6">
        <!-- Activity Chart -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">Status Aktivitas User</h3>
            <div class="h-48"><canvas id="activityChart"></canvas></div>
        </div>

        <!-- Users per OPD -->
        <div class="bg-white rounded-lg p-5 border border-gray-200">
            <h3 class="text-sm font-semibold text-gray-800 mb-4">User per OPD</h3>
            <div class="space-y-2 max-h-48 overflow-y-auto">
                @foreach($usersPerOpd->take(10) as $opd)
                <div class="flex items-center justify-between text-sm py-1">
                    <span class="text-gray-600 truncate">{{ $opd->nama_opd }}</span>
                    <span class="font-medium text-gray-900">{{ $opd->users_count }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- User List -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Daftar User & Last Login</h3>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">User</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">OPD</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">Last Login</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users->take(20) as $user)
                <tr class="border-b border-gray-50">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div>
                                <div class="text-gray-800">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->opd->nama_opd ?? '-' }}</td>
                    <td class="py-3 px-4">
                        @if($user->last_login_at)
                            <div class="text-gray-800">{{ $user->last_login_at->diffForHumans() }}</div>
                            <div class="text-xs text-gray-400">{{ $user->last_login_at->format('d M Y H:i') }}</div>
                        @else
                            <span class="text-gray-400 italic">Belum login</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if($user->last_login_at && $user->last_login_at->gte(now()->subDays(30)))
                            <span class="px-2 py-1 rounded text-xs font-medium bg-green-50 text-green-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 rounded text-xs font-medium bg-red-50 text-red-700">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('activityChart'), {
            type: 'doughnut',
            data: { labels: ['Aktif', 'Tidak Aktif'], datasets: [{ data: [{{ $activeUsers }}, {{ $inactiveUsers }}], backgroundColor: ['#10b981', '#ef4444'], borderWidth: 0 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });
    </script>
</x-admin-layout>
