<x-app-layout>

    <!-- Welcome Section (Matching Admin Design) -->
    <div class="relative bg-white dark:bg-black rounded-3xl p-8 mb-8 overflow-hidden shadow-sm border border-gray-100 dark:border-zinc-800 group">
        <!-- Decoration Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50/30 dark:hidden"></div>
        
        <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Mesh Background -->
            <div class="absolute inset-0 opacity-30">
                <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan-500/20 via-blue-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-indigo-500/15 via-purple-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
            </div>
            
            <!-- Floating Orbs -->
            <div class="absolute top-10 right-20 w-3 h-3 bg-cyan-400/60 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute bottom-20 left-10 w-2 h-2 bg-blue-400/60 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 1s;"></div>
            <div class="absolute top-1/2 right-40 w-1.5 h-1.5 bg-indigo-400/60 rounded-full blur-sm" style="animation: float 2.5s ease-in-out infinite; animation-delay: 0.5s;"></div>
            
            <!-- Wave Lines (Animated) -->
            <svg class="absolute -right-10 top-0 w-[700px] h-[400px] text-cyan-400/25" viewBox="0 0 700 400" fill="none" style="animation: sway 8s ease-in-out infinite;">
                <path d="M700 0 C 525 75, 350 200, 175 400" stroke="currentColor" stroke-width="1.5" fill="none"/>
                <path d="M700 50 C 525 125, 350 250, 175 450" stroke="currentColor" stroke-width="1" fill="none" opacity="0.5"/>
            </svg>
            
            <!-- Concentric Circles (Pulsing) -->
            <svg class="absolute right-10 top-5 w-[350px] h-[350px] text-blue-400/15" viewBox="0 0 350 350" fill="none">
                <circle cx="300" cy="50" r="60" stroke="currentColor" stroke-width="1" fill="none" style="animation: pulse-ring 3s ease-out infinite;"/>
                <circle cx="300" cy="50" r="100" stroke="currentColor" stroke-width="1" fill="none" style="animation: pulse-ring 3s ease-out infinite; animation-delay: 0.5s;"/>
                <circle cx="300" cy="50" r="140" stroke="currentColor" stroke-width="1" fill="none" style="animation: pulse-ring 3s ease-out infinite; animation-delay: 1s;"/>
            </svg>
            
            <!-- Sparkle Dots -->
            <div class="absolute top-1/4 right-1/4 w-1 h-1 bg-white/60 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="absolute bottom-1/3 left-1/3 w-1 h-1 bg-white/40 rounded-full" style="animation: sparkle 3s ease-in-out infinite; animation-delay: 1s;"></div>
        </div>
        
        <!-- Wave Illustration (Light Mode Only) -->
        <div class="absolute top-0 right-0 h-full w-full md:w-3/4 pointer-events-none overflow-hidden dark:hidden">
            <img src="{{ asset('images/dashboard-wave.png') }}" alt="Wave Background" 
                class="absolute right-0 top-0 h-full w-full object-cover object-right opacity-50 mix-blend-multiply"
                style="-webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%); mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%);">
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-white/60 to-white"></div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between gap-8 z-10">
            <!-- Left Text -->
            <div class="flex-1 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 dark:bg-blue-900/50 dark:border dark:border-blue-700/50 text-white dark:text-blue-100 text-[10px] font-bold uppercase tracking-wider shadow-md shadow-slate-200 dark:shadow-none">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    User Dashboard
                </div>
                
                <p class="text-slate-600 dark:text-slate-300 text-base max-w-xl leading-relaxed font-medium mt-2">
                    Lihat dan tambahkan data inventarisasi aplikasi <span class="font-bold text-slate-800 dark:text-white">{{ Auth::user()->opd->nama_opd ?? 'Instansi Anda' }}</span> dalam satu dashboard yang modern dan efisien.
                </p>

                <div class="pt-2 flex flex-wrap gap-3">
                    <span class="inline-flex items-center text-xs font-semibold text-slate-500 dark:text-slate-400 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-slate-200 dark:border-zinc-700 shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-2 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Card (Matching Admin Blue-Cyan Theme) -->
    <div class="relative bg-white dark:bg-black rounded-2xl shadow-sm border border-sky-100/50 dark:border-zinc-800 p-8 mb-8 hover:shadow-xl transition-all duration-300 overflow-hidden group">
        <!-- Subtle Wave Background -->
        <div class="absolute inset-0 opacity-5 dark:opacity-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent dark:from-blue-900 dark:via-cyan-900"></div>
        </div>
        
        <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
             <!-- Gradient Glow -->
             <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-gradient-to-tl from-blue-500/15 via-cyan-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 3s;"></div>
             <!-- Floating Orbs -->
             <div class="absolute top-8 left-1/4 w-2 h-2 bg-blue-400/50 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite;"></div>
             <!-- Sparkles -->
             <div class="absolute bottom-1/4 right-20 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
        </div>
        
        <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 divide-y md:divide-y-0 md:divide-x divide-sky-100 dark:divide-zinc-800">
            
            <!-- Total Aplikasi -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-0 md:pr-8 group">
                <div class="relative flex-shrink-0">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-sky-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <!-- Icon Container -->
                    <div class="relative w-16 h-16 bg-gradient-to-br from-sky-400 via-sky-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-sky-50 dark:ring-sky-900/30 group-hover:scale-105 transition-transform">
                        <!-- Icon: Cube Stack (Apps) -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Total Aplikasi</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $totalApps ?? Auth::user()->webApps()->count() }}</h3>
                    <p class="text-xs text-sky-600 dark:text-sky-400 mt-2 flex items-center font-medium">
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
                    <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50 dark:ring-blue-900/30 group-hover:scale-105 transition-transform">
                        <!-- Icon: Rocket -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Aksi Cepat</p>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Tambah Aplikasi
                        </a>
                        <a href="{{ route('web-apps.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-700 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl hover:bg-slate-50 dark:hover:bg-zinc-800 hover:border-slate-300 transition-all">
                            <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Lihat Data Aplikasi
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Recent Apps (Card-based Design like /web-apps) -->
    <div class="bg-white dark:bg-black rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 overflow-hidden">
        <div class="border-b border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-zinc-900/50 px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Aplikasi Terbaru</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Aplikasi terbaru yang terdata dari OPD Anda.</p>
            </div>
            <a href="{{ route('web-apps.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium hover:underline flex items-center gap-1">
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
                <div class="bg-gradient-to-r from-slate-100 to-slate-50 dark:from-zinc-900 dark:to-zinc-950 rounded-t-2xl border border-slate-200 dark:border-zinc-800 border-b-0 px-5 py-4 hidden md:block">
                    <div class="grid grid-cols-12 gap-2 items-center text-[11px] font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                        <div class="col-span-1 text-center flex items-center justify-center gap-1">
                            <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            No
                        </div>
                        <div class="col-span-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
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
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Aksi
                        </div>
                    </div>
                </div>

                <!-- Cards Container -->
                <div class="bg-white dark:bg-black rounded-b-2xl md:rounded-t-none rounded-t-2xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
                    <ul class="divide-y divide-slate-100 dark:divide-zinc-800">
                        @foreach($recentApps as $app)
                            <li class="group hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-all duration-200">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center p-4 sm:p-5">
                                    
                                    <!-- No -->
                                    <div class="hidden md:flex col-span-1 justify-center">
                                        <span class="w-7 h-7 rounded-full bg-slate-100 dark:bg-zinc-800 flex items-center justify-center text-slate-600 dark:text-slate-400 font-bold text-xs">
                                            {{ $loop->iteration }}
                                        </span>
                                    </div>

                                    <!-- Nama Aplikasi -->
                                    <div class="col-span-1 md:col-span-4">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Aplikasi</span>
                                        <a href="{{ route('web-apps.show', $app) }}" class="text-base font-bold text-slate-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition-colors truncate block">
                                            {{ $app->nama_web_app }}
                                        </a>
                                        @if($app->alamat_tautan)
                                        <a href="{{ str_starts_with($app->alamat_tautan, 'http') ? $app->alamat_tautan : 'https://' . $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors mt-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            Kunjungi
                                        </a>
                                        @endif
                                    </div>

                                    <!-- Penginput -->
                                    <div class="col-span-1 md:col-span-3">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Penginput</span>
                                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $app->user->name ?? '-' }}</span>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="col-span-1 md:col-span-2">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal</span>
                                        <div class="flex items-center gap-1.5 text-sm text-slate-600 dark:text-slate-400 font-medium">
                                            <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $app->created_at->format('d M Y') }}
                                        </div>
                                    </div>

                                    <!-- Aksi -->
                                    <div class="col-span-1 md:col-span-2 flex items-center justify-start md:justify-center gap-1.5">
                                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-2">Aksi</span>
                                        <a href="{{ route('web-apps.show', $app) }}" class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/40 hover:scale-110 transition-all shadow-sm" title="Lihat">
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
                    <div class="bg-gray-50 dark:bg-zinc-800 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 dark:text-zinc-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Belum Ada Data</h3>
                    <p class="text-gray-500 dark:text-zinc-400 text-sm mb-4">Mulai dengan menambahkan aplikasi pertama Anda.</p>
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
