<x-app-layout>

    <!-- Main Container -->
    <div class="py-6 sm:py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Section -->
            <div class="relative bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 overflow-hidden shadow-xl sm:rounded-2xl mb-8">
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-blue-500 rounded-full opacity-10 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-48 h-48 bg-cyan-500 rounded-full opacity-10 blur-2xl"></div>
                
                <div class="relative p-8 sm:p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                        <div>
                            <div class="inline-flex items-center space-x-2 bg-blue-500/20 px-3 py-1 rounded-full text-xs font-semibold text-blue-300 mb-3 border border-blue-500/30">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                <span>Administrator Panel</span>
                            </div>
                            <h1 class="text-3xl font-bold text-white tracking-tight">
                                Selamat Datang, {{ Auth::user()->name }}
                            </h1>
                            <p class="mt-2 text-gray-300 max-w-2xl">
                                Anda memiliki akses penuh untuk mengelola dan memonitoring seluruh data aplikasi dari semua OPD di Kota Pekanbaru.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stat Card: Total Apps -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all p-6 border border-gray-100 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Aplikasi</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $totalApps }}</h3>
                            <p class="text-xs text-blue-600 mt-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                Dari semua OPD
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card: Total OPD -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all p-6 border border-gray-100 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total OPD</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $totalOpds }}</h3>
                            <p class="text-xs text-green-600 mt-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Terdaftar di sistem
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card: This Month -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all p-6 border border-gray-100 group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Input Bulan Ini</p>
                            <h3 class="text-3xl font-bold text-gray-800">{{ $appsThisMonth ?? 0 }}</h3>
                            <p class="text-xs text-purple-600 mt-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ now()->format('F Y') }}
                            </p>
                        </div>
                        <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Quick Action: View All -->

            </div>

            <!-- Recent Apps Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Aplikasi Terbaru dari Semua OPD</h3>
                        <p class="text-sm text-gray-500">Data aplikasi yang baru diinput oleh seluruh OPD.</p>
                    </div>
                    <a href="{{ route('admin.web-apps.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline flex items-center gap-1">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                
                <div class="p-0">
                    @if($recentApps->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead class="bg-gray-50/50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aplikasi</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">OPD</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Penginput</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach($recentApps as $app)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 bg-slate-100 rounded-lg flex items-center justify-center text-slate-600 font-bold text-lg">
                                                        {{ substr($app->nama_web_app, 0, 1) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-bold text-gray-900">{{ $app->nama_web_app }}</div>
                                                        <div class="text-xs text-gray-500">{{ $app->framework ?? 'N/A' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-green-50 text-green-700 border border-green-100">
                                                    {{ Str::limit($app->opd->nama_opd, 25) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $app->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $app->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.web-apps.show', $app) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-xs font-semibold">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Data</h3>
                            <p class="text-gray-500 text-sm">Belum ada data aplikasi yang diinput oleh OPD.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-8 text-center sm:text-left text-xs text-gray-400">
                &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru | Admin Panel
            </div>
        </div>
    </div>
</x-app-layout>
