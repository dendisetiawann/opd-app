<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Welcome Section -->
    <!-- Welcome Section (Premium Redesign) -->
    <div class="relative bg-white rounded-3xl p-8 mb-8 overflow-hidden shadow-sm border border-gray-100 group">
        <!-- Decoration Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50/50 opacity-100"></div>
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-gradient-to-bl from-blue-100/40 via-blue-50/20 to-transparent rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
        
        <div class="relative flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- Left Text -->
            <div class="flex-1 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-[10px] font-bold uppercase tracking-wider shadow-md shadow-slate-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                    Admin Control Center
                </div>
                
                <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Selamat Datang, <br class="hidden sm:block" />
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-600">{{ Auth::user()->name }}</span>
                </h1>
                
                <p class="text-slate-600 text-base max-w-xl leading-relaxed font-medium">
                    Pantau dan kelola seluruh inventaris aplikasi Pemerintah Kota Pekanbaru dalam satu dashboard terintegrasi yang modern dan efisien.
                </p>

                 <div class="pt-2 flex flex-wrap gap-3">
                    <span class="inline-flex items-center text-xs font-semibold text-slate-500 bg-white px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ now()->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
            </div>

            <!-- Right Abstract Lines Decoration -->
            <div class="hidden lg:flex items-center justify-center mr-4">
                <div class="relative w-32 h-32">
                    <!-- Abstract Lines Pattern -->
                    <svg class="w-full h-full text-blue-600 opacity-80" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Horizontal lines -->
                        <line x1="10" y1="20" x2="110" y2="20" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                        <line x1="20" y1="35" x2="100" y2="35" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <line x1="15" y1="50" x2="105" y2="50" stroke="currentColor" stroke-width="3" stroke-linecap="round" opacity="0.7"/>
                        <line x1="25" y1="65" x2="95" y2="65" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <line x1="10" y1="80" x2="110" y2="80" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                        <line x1="30" y1="95" x2="90" y2="95" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                        
                        <!-- Vertical accent lines -->
                        <line x1="40" y1="10" x2="40" y2="110" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" opacity="0.2"/>
                        <line x1="80" y1="15" x2="80" y2="105" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" opacity="0.2"/>
                        
                        <!-- Accent dots -->
                        <circle cx="60" cy="50" r="4" fill="currentColor" opacity="0.6"/>
                        <circle cx="40" cy="35" r="2" fill="currentColor" opacity="0.4"/>
                        <circle cx="80" cy="65" r="2" fill="currentColor" opacity="0.4"/>
                    </svg>
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
    <div class="mt-8 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
    </div>
</x-admin-layout>
