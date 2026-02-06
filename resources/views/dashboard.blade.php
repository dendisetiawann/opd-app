<x-app-layout>

    <!-- Header (Modern Abstract) -->
    <div class="relative bg-gradient-to-br from-[#1a237e] via-[#283593] to-[#3949ab] rounded-2xl p-6 shadow-xl mb-8 overflow-hidden">
        <!-- Modern Abstract Pattern Background -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Soft Gradient Orbs -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-white/10 to-transparent rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-gradient-to-tr from-blue-300/10 to-transparent rounded-full blur-3xl -ml-20 -mb-20"></div>
            
            <!-- Geometric Mesh Pattern -->
            <svg class="absolute inset-0 w-full h-full opacity-20" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="meshGrid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.3" stroke-opacity="0.3"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#meshGrid)"/>
            </svg>
            
            <!-- Modern Diagonal Lines -->
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 100" preserveAspectRatio="none">
                <line x1="0" y1="100" x2="150" y2="0" stroke="white" stroke-width="0.5" stroke-opacity="0.1"/>
                <line x1="50" y1="100" x2="200" y2="0" stroke="white" stroke-width="0.5" stroke-opacity="0.08"/>
                <line x1="100" y1="100" x2="250" y2="0" stroke="white" stroke-width="0.5" stroke-opacity="0.06"/>
                <line x1="250" y1="100" x2="400" y2="0" stroke="white" stroke-width="0.5" stroke-opacity="0.1"/>
                <line x1="300" y1="100" x2="400" y2="30" stroke="white" stroke-width="0.5" stroke-opacity="0.08"/>
            </svg>
            
            <!-- Floating Circles -->
            <div class="absolute top-4 right-16 w-3 h-3 border border-white/20 rounded-full"></div>
            <div class="absolute top-8 right-32 w-2 h-2 bg-white/15 rounded-full"></div>
            <div class="absolute bottom-6 left-20 w-4 h-4 border border-white/15 rounded-full"></div>
            <div class="absolute bottom-4 left-1/3 w-2 h-2 bg-white/10 rounded-full"></div>
            <div class="absolute top-1/2 right-1/4 w-2.5 h-2.5 border border-white/10 rounded-full"></div>
        </div>
        
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
            <!-- Left Content -->
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="h-1 w-8 bg-white/60 rounded-full"></div>
                    <span class="text-xs font-bold uppercase tracking-widest text-white/70">Dashboard</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight leading-tight">
                    Sistem Manajemen Aplikasi OPD
                </h1>
                <p class="text-sm text-blue-100/70 max-w-md leading-relaxed">
                    Kelola dan pantau data aplikasi 
                    <span class="font-medium text-white/90">{{ Auth::user()->opd->nama_opd ?? 'Instansi Anda' }}</span> 
                    secara terintegrasi.
                </p>
            </div>

            <!-- Right Status -->
            <div class="flex items-center">
                <!-- Status Box -->
                <div class="flex items-center gap-6 bg-white/10 backdrop-blur-sm rounded-xl px-5 py-4 border border-white/20 flex-shrink-0">
                    <div class="text-center">
                        <p class="text-[10px] text-white/50 font-bold uppercase tracking-wider mb-1">Status</p>
                        <div class="flex items-center justify-center gap-1.5">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span class="text-xs font-bold text-emerald-400">Online</span>
                        </div>
                    </div>
                    <div class="w-px h-8 bg-white/20"></div>
                    <div class="text-center">
                         <p class="text-[10px] text-white/50 font-bold uppercase tracking-wider mb-1">Tanggal</p>
                         <p class="text-xs font-bold text-white">{{ now()->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats & Actions Card (Glassmorphism - UCD Theme) -->
    <div class="relative mb-8 rounded-3xl p-0.5 bg-gradient-to-br from-white/60 to-white/30 border border-white/50 shadow-xl shadow-blue-900/5 backdrop-blur-xl overflow-hidden">
        
        <!-- Floating Abstract Shapes -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute -top-6 -right-6 w-32 h-32 bg-blue-200/40 rounded-full mix-blend-multiply filter blur-2xl animate-blob"></div>
            <div class="absolute top-20 -left-8 w-24 h-24 bg-indigo-200/40 rounded-full mix-blend-multiply filter blur-2xl animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-4 right-1/4 w-28 h-28 bg-cyan-200/40 rounded-full mix-blend-multiply filter blur-2xl animate-blob animation-delay-4000"></div>
        </div>

        <div class="rounded-[22px] bg-white/70 p-6 sm:p-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                
                <!-- Stats Section -->
                <div class="flex items-center gap-5">
                    <!-- Icon -->
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <!-- Text -->
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Aplikasi Terdaftar</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600">{{ Auth::user()->webApps()->count() }}</span>
                            <span class="text-base font-semibold text-slate-600">Aplikasi</span>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="hidden lg:block w-px h-16 bg-gradient-to-b from-transparent via-slate-200 to-transparent"></div>

                <!-- Actions -->
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('web-apps.index') }}" class="px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-semibold hover:bg-slate-50 hover:border-slate-300 hover:shadow-sm transition-all duration-200 flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                        Daftar Aplikasi
                    </a>
                    
                    <a href="{{ route('web-apps.create') }}" class="group relative px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center gap-2.5 overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        <span class="relative z-10">Tambah Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Aplikasi Terbaru (Full Width - Premium Design) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-8">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-white to-slate-50/50">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/25">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Daftar Aplikasi Terbaru</h3>
                    <p class="text-sm text-slate-500">Data inventarisasi terakhir yang masuk sistem</p>
                </div>
            </div>
            <a href="{{ route('web-apps.index') }}" class="px-4 py-2 rounded-lg bg-blue-50 text-blue-600 font-semibold text-sm hover:bg-blue-100 transition-colors flex items-center gap-2">
                <span>Lihat Semua</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <!-- Table Header -->
        <div class="bg-gradient-to-r from-slate-100 to-slate-50 px-6 py-4 hidden md:block border-b border-slate-200">
            <div class="grid grid-cols-12 gap-4 items-center text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                <div class="col-span-1 text-center">No</div>
                <div class="col-span-4">Nama Aplikasi</div>
                <div class="col-span-5">Tautan Aplikasi</div>
                <div class="col-span-2">Tanggal Input</div>
            </div>
        </div>

        <!-- Table Body -->
        <div class="divide-y divide-slate-100">
            @forelse(Auth::user()->webApps()->latest()->take(5)->get() as $index => $app)
            <div class="group hover:bg-blue-50/50 transition-all duration-200 cursor-pointer" onclick="window.location='{{ route('web-apps.show', $app) }}'">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center px-6 py-4">
                    
                    <!-- No -->
                    <div class="hidden md:flex col-span-1 justify-center">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-blue-500/20">
                            {{ $index + 1 }}
                        </span>
                    </div>

                    <!-- Nama Aplikasi -->
                    <div class="col-span-1 md:col-span-4">
                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Aplikasi</span>
                        <span class="text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors block truncate">{{ $app->nama_web_app }}</span>
                    </div>

                    <!-- Tautan Aplikasi -->
                    <div class="col-span-1 md:col-span-5">
                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tautan Aplikasi</span>
                        @if($app->domain)
                            <a href="{{ str_starts_with($app->domain, 'http') ? $app->domain : 'https://' . $app->domain }}" target="_blank" onclick="event.stopPropagation()" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline truncate max-w-full">
                                <svg class="w-4 h-4 flex-shrink-0 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                <span class="truncate">{{ $app->domain }}</span>
                            </a>
                        @else
                            <span class="text-sm text-slate-400 italic">Tidak ada tautan</span>
                        @endif
                    </div>

                    <!-- Tanggal Input -->
                    <div class="col-span-1 md:col-span-2">
                        <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Input</span>
                        <div class="flex items-center gap-1.5 text-sm text-slate-600 font-medium">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $app->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada data aplikasi</p>
                <p class="text-sm text-slate-400 mt-1">Mulai dengan menambahkan aplikasi pertama Anda</p>
            </div>
            @endforelse
        </div>
    </div>

</x-app-layout>
