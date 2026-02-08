<x-app-layout>

    <!-- Welcome Section (Matching Admin Design) -->
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
                    User Dashboard
                </div>
                
                <p class="text-slate-600 text-base max-w-xl leading-relaxed font-medium mt-2">
                    Lihat dan tambahkan data inventarisasi aplikasi <span class="font-bold text-slate-800">{{ Auth::user()->opd->nama_opd ?? 'Instansi Anda' }}</span> dalam satu dashboard yang modern dan efisien.
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

    <!-- Stats Card (Matching Admin Blue-Cyan Theme) -->
    <div class="relative bg-white rounded-2xl shadow-sm border border-sky-100/50 p-8 mb-8 hover:shadow-xl transition-all duration-300 overflow-hidden">
        <!-- Subtle Wave Background -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
        </div>
        
        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 divide-y md:divide-y-0 md:divide-x divide-sky-100">
            
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
                    <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $totalApps ?? Auth::user()->webApps()->count() }}</h3>
                    <p class="text-xs text-sky-600 mt-2 flex items-center font-medium">
                        <span class="w-2 h-2 bg-sky-500 rounded-full mr-2 animate-pulse"></span>
                        Aplikasi Anda
                    </p>
                </div>
            </div>

            <!-- Aksi Cepat -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:px-8 group">
                <div class="relative flex-shrink-0">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <!-- Icon Container -->
                    <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50 group-hover:scale-105 transition-transform">
                        <!-- Icon: Rocket -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.63 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Aksi Cepat</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Aplikasi
                        </a>
                        <a href="{{ route('web-apps.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all">
                            <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            Lihat Data Aplikasi
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Recent Apps (Card-based Design like /web-apps) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Daftar Aplikasi Terbaru</h3>
                <p class="text-sm text-gray-500">Aplikasi terbaru yang terdata dari OPD Anda.</p>
            </div>
            <a href="{{ route('web-apps.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="p-4">
            @php
                $recentApps = \App\Models\WebApp::where('opd_id', Auth::user()->opd_id)
                    ->with(['opd', 'user'])
                    ->latest()
                    ->take(5)
                    ->get();
            @endphp
            
            @if($recentApps->count() > 0)
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-slate-100 to-slate-50 rounded-t-2xl border border-slate-200 border-b-0 px-5 py-4 hidden md:block">
                    <div class="grid grid-cols-12 gap-2 items-center text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                        <div class="col-span-1 text-center flex items-center justify-center gap-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            No
                        </div>
                        <div class="col-span-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                            Nama Aplikasi
                        </div>
                        <div class="col-span-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Penginput
                        </div>
                        <div class="col-span-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Tanggal
                        </div>
                        <div class="col-span-2 text-center flex items-center justify-center gap-1">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            Aksi
                        </div>
                    </div>
                </div>

                <!-- Cards Container -->
                <div class="bg-white rounded-b-2xl md:rounded-t-none rounded-t-2xl border border-slate-200 overflow-hidden">
                    <ul class="divide-y divide-slate-100">
                        @foreach($recentApps as $app)
                            <li class="group hover:bg-blue-50/50 transition-all duration-200">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center p-4 sm:p-5">
                                    
                                    <!-- No -->
                                    <div class="hidden md:flex col-span-1 justify-center">
                                        <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-xs">
                                            {{ $loop->iteration }}
                                        </span>
                                    </div>

                                    <!-- Nama Aplikasi -->
                                    <div class="col-span-1 md:col-span-4">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Aplikasi</span>
                                        <a href="{{ route('web-apps.show', $app) }}" class="text-base font-bold text-slate-800 hover:text-blue-600 transition-colors truncate block">
                                            {{ $app->nama_web_app }}
                                        </a>
                                        @if($app->alamat_tautan)
                                        <a href="{{ str_starts_with($app->alamat_tautan, 'http') ? $app->alamat_tautan : 'https://' . $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 hover:text-blue-700 font-medium bg-blue-50 px-2 py-0.5 rounded-md hover:bg-blue-100 transition-colors mt-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            Kunjungi
                                        </a>
                                        @endif
                                    </div>

                                    <!-- Penginput -->
                                    <div class="col-span-1 md:col-span-3">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Penginput</span>
                                        <span class="text-sm font-medium text-slate-700">{{ $app->user->name ?? '-' }}</span>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="col-span-1 md:col-span-2">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal</span>
                                        <div class="flex items-center gap-1.5 text-sm text-slate-600 font-medium">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $app->created_at->format('d M Y') }}
                                        </div>
                                    </div>

                                    <!-- Aksi -->
                                    <div class="col-span-1 md:col-span-2 flex items-center justify-start md:justify-center gap-1.5">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-2">Aksi</span>
                                        <a href="{{ route('web-apps.show', $app) }}" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:scale-110 transition-all shadow-sm" title="Lihat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Data</h3>
                    <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan aplikasi pertama Anda.</p>
                    <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Tambah Aplikasi
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-8 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
    </div>

</x-app-layout>
