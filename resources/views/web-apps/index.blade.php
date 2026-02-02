<x-app-layout>

    <!-- Main Container -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Daftar Aplikasi OPD</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola data aplikasi dan sistem informasi yang terdaftar.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Aplikasi
                    </a>
                </div>
            </div>

            <!-- Alert Notification -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-start shadow-sm" role="alert">
                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <span class="font-bold block">Berhasil!</span>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Data Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                
                <!-- Search & Filters (Optional Placeholder) -->
                <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex flex-col sm:flex-row gap-4 justify-between items-center hidden">
                   <div class="relative w-full sm:w-64">
                       <input type="text" placeholder="Cari aplikasi..." class="w-full pl-10 pr-4 py-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">
                       <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                           <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                       </div>
                   </div>
                </div>

                <div class="p-0">
                    @if($webApps->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-16">No</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Info Aplikasi</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Teknologi</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Input</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach($webApps as $index => $app)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $webApps->firstItem() + $index }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-lg">
                                                        {{ substr($app->nama_web_app, 0, 1) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-bold text-gray-900">{{ $app->nama_web_app }}</div>
                                                        <div class="text-xs text-gray-500 mt-0.5">
                                                            @if($app->domain)
                                                                <a href="{{ str_starts_with($app->domain, 'http') ? $app->domain : 'http://' . $app->domain }}" target="_blank" class="hover:text-blue-600 flex items-center gap-1">
                                                                    {{ $app->domain }}
                                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                                                </a>
                                                            @else
                                                                <span class="italic text-gray-400">Tidak ada domain</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                                    {{ $app->framework ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $app->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('web-apps.show', $app) }}" class="p-2 bg-gray-50 rounded-lg text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Lihat Detail">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    </a>
                                                    <a href="{{ route('web-apps.edit', $app) }}" class="p-2 bg-gray-50 rounded-lg text-gray-600 hover:bg-yellow-50 hover:text-yellow-600 transition-colors" title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>
                                                    <form action="{{ route('web-apps.destroy', $app) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2 bg-gray-50 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-600 transition-colors" title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                            {{ $webApps->links() }}
                        </div>
                    @else
                        <div class="text-center py-20">
                            <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Aplikasi</h3>
                            <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Anda belum menambahkan data aplikasi apapun. Mulai inventarisasi aset digital OPD Anda sekarang.</p>
                            <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Input Aplikasi Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
