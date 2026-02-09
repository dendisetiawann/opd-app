<x-admin-layout>
    <x-slot name="header">Activity Log</x-slot>

    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Riwayat Aktivitas</h3>
            <p class="text-xs text-gray-500 mt-1">Log semua aktivitas pengguna dalam sistem</p>
        </div>

        @if($logs->count() > 0)
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">Waktu</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">User</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">Aksi</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">Deskripsi</th>
                    <th class="text-left py-3 px-4 text-xs text-gray-500 font-medium">IP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr class="border-b border-gray-50">
                    <td class="py-3 px-4">
                        <div class="text-gray-800">{{ $log->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs font-medium">
                                {{ strtoupper(substr($log->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <span class="text-gray-800">{{ $log->user->name ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4">
                        @php
                            $colors = ['login' => 'bg-green-50 text-green-700', 'logout' => 'bg-gray-100 text-gray-600', 'create' => 'bg-blue-50 text-blue-700', 'update' => 'bg-yellow-50 text-yellow-700', 'delete' => 'bg-red-50 text-red-700'];
                        @endphp
                        <span class="px-2 py-1 rounded text-xs font-medium {{ $colors[$log->action] ?? 'bg-gray-100 text-gray-600' }}">{{ ucfirst($log->action) }}</span>
                    </td>
                    <td class="py-3 px-4 text-gray-600 max-w-xs truncate">{{ $log->description }}</td>
                    <td class="py-3 px-4"><span class="text-xs font-mono text-gray-500">{{ $log->ip_address ?? '-' }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4 border-t border-gray-100">{{ $logs->links() }}</div>
        @else
        <div class="p-12 text-center">
            <p class="text-gray-500">Belum ada log aktivitas</p>
        </div>
        @endif
    </div>
</x-admin-layout>
