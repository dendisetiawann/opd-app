<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Welcome Section -->
    <!-- Welcome Section (Premium Redesign) -->
    <div class="relative bg-white rounded-3xl p-8 mb-8 overflow-hidden shadow-sm border border-gray-100 group">
        <!-- Decoration Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50/30"></div>
        
        <!-- Wave Illustration -->
        <div class="absolute top-0 right-0 h-full w-full md:w-3/4 pointer-events-none overflow-hidden">
            <img src="{{ asset('images/dashboard-wave.png') }}" alt="Wave Background" 
                class="absolute right-0 top-0 h-full w-full object-cover object-right opacity-50 mix-blend-multiply"
                style="-webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%); mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%);">
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-white/60 to-white"></div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between gap-8 z-10">
            <!-- Left Text -->
            <div class="flex-1 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-[10px] font-bold uppercase tracking-wider shadow-md shadow-slate-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Admin Control Center
                </div>
                
                <p class="text-slate-600 text-base max-w-xl leading-relaxed font-medium mt-2">
                    Pantau dan kelola seluruh inventaris aplikasi Pemerintah Kota Pekanbaru dalam satu dashboard terintegrasi yang modern dan efisien.
                </p>

                 <div class="pt-2 flex flex-wrap gap-3">
                    <span class="inline-flex items-center text-xs font-semibold text-slate-500 bg-white/80 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Card (Combined) - Unified Blue-Cyan Theme -->
    <div class="relative bg-white rounded-2xl shadow-sm border border-sky-100/50 p-8 mb-8 hover:shadow-xl transition-all duration-300 overflow-hidden">
        <!-- Subtle Wave Background -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
        </div>
        
        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-sky-100">
            
            <!-- Total Aplikasi -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-0 md:pr-8 group">
                <div class="relative flex-shrink-0">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-sky-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <!-- Icon Container -->
                    <div class="relative w-16 h-16 bg-gradient-to-br from-sky-400 via-sky-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-sky-50 group-hover:scale-105 transition-transform">
                        <!-- Icon: Cube Stack (Apps) -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Aplikasi</p>
                    <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $totalApps }}</h3>
                    <p class="text-xs text-sky-600 mt-2 flex items-center font-medium">
                        <span class="w-2 h-2 bg-sky-500 rounded-full mr-2 animate-pulse"></span>
                        Dari semua OPD
                    </p>
                </div>
            </div>

            <!-- Total OPD -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:px-8 group">
                <div class="relative flex-shrink-0">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-cyan-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <!-- Icon Container -->
                    <div class="relative w-16 h-16 bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-cyan-50 group-hover:scale-105 transition-transform">
                        <!-- Icon: Building Office 2 -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total OPD</p>
                    <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $totalOpds }}</h3>
                    <p class="text-xs text-teal-600 mt-2 flex items-center font-medium">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Terdaftar di sistem
                    </p>
                </div>
            </div>

            <!-- Input Bulan Ini -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-8 md:pr-0 group">
                <div class="relative flex-shrink-0">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <!-- Icon Container -->
                    <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50 group-hover:scale-105 transition-transform">
                        <!-- Icon: Document Chart Bar -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Input Bulan Ini</p>
                    <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $appsThisMonth ?? 0 }}</h3>
                    <p class="text-xs text-indigo-600 mt-2 flex items-center font-medium">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM Y') }}
                    </p>
                </div>
            </div>

        </div>
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
                        <thead class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-4 text-center w-16">
                                    <span class="flex items-center justify-center gap-1 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                        No
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                        Aplikasi
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        OPD
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Penginput
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Tanggal Pendataan
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-center">
                                    <span class="flex items-center justify-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                                        Aksi
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($recentApps as $app)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="text-sm font-bold text-gray-900">{{ $app->nama_web_app }}</div>
                                            @if($app->alamat_tautan)
                                                <a href="{{ $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-700 font-medium bg-blue-50 px-2 py-0.5 rounded-md hover:bg-blue-100 transition-colors">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                    Kunjungi
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400 italic">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-green-50 text-green-700 border border-green-100">
                                            {{ $app->opd->nama_opd }}
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
