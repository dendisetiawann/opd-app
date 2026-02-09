<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Welcome Section -->
    <!-- Welcome Section (Premium Redesign) -->
    <div class="relative bg-white dark:bg-zinc-900 rounded-3xl p-8 mb-8 overflow-hidden shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 group">
        <!-- Decoration Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50/30 dark:from-transparent dark:to-transparent"></div>
        
        <!-- Wave Illustration (Light Mode) -->
        <div class="absolute top-0 right-0 h-full w-full md:w-3/4 pointer-events-none overflow-hidden dark:hidden">
            <img src="{{ asset('images/dashboard-wave.png') }}" alt="Wave Background" 
                class="absolute right-0 top-0 h-full w-full object-cover object-right opacity-50 mix-blend-multiply"
                style="-webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%); mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%);">
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-white/60 to-white"></div>
        </div>
        
        <!-- ✨ PREMIUM ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Mesh Background -->
            <div class="absolute inset-0 opacity-30">
                <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-cyan-500/20 via-blue-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-indigo-500/15 via-purple-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 5s; animation-delay: 1s;"></div>
            </div>
            
            <!-- Floating Orbs -->
            <div class="absolute top-10 right-20 w-3 h-3 bg-cyan-400/60 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute top-20 right-40 w-2 h-2 bg-blue-400/50 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 0.5s;"></div>
            <div class="absolute top-5 right-60 w-4 h-4 bg-indigo-400/40 rounded-full blur-sm" style="animation: float 3.5s ease-in-out infinite; animation-delay: 1s;"></div>
            <div class="absolute bottom-10 right-32 w-2 h-2 bg-sky-400/50 rounded-full blur-sm" style="animation: float 4.5s ease-in-out infinite; animation-delay: 0.3s;"></div>
            <div class="absolute bottom-20 left-20 w-3 h-3 bg-purple-400/40 rounded-full blur-sm" style="animation: float 3.8s ease-in-out infinite; animation-delay: 0.7s;"></div>
            
            <!-- Wave Lines (Animated) -->
            <svg class="absolute -right-10 top-0 w-[700px] h-[400px] text-cyan-400/25" viewBox="0 0 700 400" fill="none" style="animation: sway 8s ease-in-out infinite;">
                <path d="M700 0 C 525 75, 350 200, 175 400" stroke="currentColor" stroke-width="1.5" fill="none"/>
                <path d="M700 40 C 525 115, 350 240, 175 400" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.8"/>
                <path d="M700 80 C 525 155, 350 280, 175 400" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.6"/>
                <path d="M700 120 C 525 195, 350 320, 175 400" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.4"/>
                <path d="M700 160 C 525 235, 350 360, 175 400" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
            </svg>
            
            <!-- Concentric Circles (Pulsing) -->
            <svg class="absolute right-10 top-5 w-[350px] h-[350px] text-blue-400/15" viewBox="0 0 350 350" fill="none">
                <circle cx="300" cy="50" r="60" stroke="currentColor" stroke-width="1" fill="none" style="animation: pulse-ring 3s ease-out infinite;"/>
                <circle cx="300" cy="50" r="100" stroke="currentColor" stroke-width="0.8" fill="none" style="animation: pulse-ring 3s ease-out infinite; animation-delay: 0.5s;"/>
                <circle cx="300" cy="50" r="140" stroke="currentColor" stroke-width="0.6" fill="none" style="animation: pulse-ring 3s ease-out infinite; animation-delay: 1s;"/>
                <circle cx="300" cy="50" r="180" stroke="currentColor" stroke-width="0.4" fill="none" style="animation: pulse-ring 3s ease-out infinite; animation-delay: 1.5s;"/>
            </svg>
            
            <!-- Diagonal Lines -->
            <svg class="absolute left-0 bottom-0 w-[300px] h-[200px] text-indigo-400/20" viewBox="0 0 300 200" fill="none" style="animation: sway 10s ease-in-out infinite reverse;">
                <line x1="0" y1="200" x2="100" y2="0" stroke="currentColor" stroke-width="0.5"/>
                <line x1="50" y1="200" x2="150" y2="0" stroke="currentColor" stroke-width="0.5"/>
                <line x1="100" y1="200" x2="200" y2="0" stroke="currentColor" stroke-width="0.5"/>
                <line x1="150" y1="200" x2="250" y2="0" stroke="currentColor" stroke-width="0.5"/>
            </svg>
            
            <!-- Sparkle Dots -->
            <div class="absolute top-1/4 right-1/4 w-1 h-1 bg-white/60 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="absolute top-1/3 right-1/3 w-1.5 h-1.5 bg-white/40 rounded-full" style="animation: sparkle 2.5s ease-in-out infinite; animation-delay: 0.3s;"></div>
            <div class="absolute top-1/2 right-1/5 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 1.8s ease-in-out infinite; animation-delay: 0.6s;"></div>
        </div>

        <div class="relative flex flex-col md:flex-row items-center justify-between gap-8 z-10">
            <!-- Left Text -->
            <div class="flex-1 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 dark:bg-gradient-to-r dark:from-blue-600 dark:to-indigo-600 text-white text-[10px] font-bold uppercase tracking-wider shadow-md shadow-slate-200 dark:shadow-blue-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Admin Control Center
                </div>
                
                <p class="text-slate-600 dark:text-slate-300 text-base max-w-xl leading-relaxed font-medium mt-2">
                    Pantau dan kelola seluruh inventaris aplikasi Pemerintah Kota Pekanbaru dalam satu dashboard terintegrasi yang modern dan efisien.
                </p>

                 <div class="pt-2 flex flex-wrap gap-3">
                    <span class="inline-flex items-center text-xs font-semibold text-slate-500 dark:text-slate-400 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-600 shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Card (Combined) - Unified Blue-Cyan Theme -->
    <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-sky-100/50 dark:border-zinc-800 p-8 mb-8 hover:shadow-xl transition-all duration-300 overflow-hidden">
        <!-- Subtle Wave Background (Light Mode) -->
        <div class="absolute inset-0 opacity-5 dark:hidden">
            <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
        </div>
        
        <!-- ✨ PREMIUM ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Glow -->
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-gradient-to-tl from-sky-500/15 via-blue-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 3s;"></div>
            <div class="absolute -left-10 -top-10 w-48 h-48 bg-gradient-to-br from-indigo-500/10 via-purple-500/5 to-transparent rounded-full blur-2xl animate-pulse" style="animation-duration: 4s; animation-delay: 0.5s;"></div>
            
            <!-- Wave Lines (Animated) -->
            <svg class="absolute right-0 bottom-0 w-[600px] h-[250px] text-sky-400/15" viewBox="0 0 600 250" fill="none" style="animation: sway 12s ease-in-out infinite;">
                <path d="M600 250 C 450 200, 300 100, 150 0" stroke="currentColor" stroke-width="1" fill="none"/>
                <path d="M600 220 C 450 170, 300 70, 150 0" stroke="currentColor" stroke-width="1" fill="none" opacity="0.8"/>
                <path d="M600 190 C 450 140, 300 40, 150 0" stroke="currentColor" stroke-width="1" fill="none" opacity="0.6"/>
                <path d="M600 160 C 450 110, 300 10, 150 0" stroke="currentColor" stroke-width="1" fill="none" opacity="0.4"/>
            </svg>
            
            <!-- Pulsing Circles -->
            <svg class="absolute left-0 top-0 w-[200px] h-[200px] text-indigo-400/10" viewBox="0 0 200 200" fill="none">
                <circle cx="0" cy="0" r="50" stroke="currentColor" stroke-width="0.5" fill="none" style="animation: pulse-ring 4s ease-out infinite;"/>
                <circle cx="0" cy="0" r="80" stroke="currentColor" stroke-width="0.5" fill="none" style="animation: pulse-ring 4s ease-out infinite; animation-delay: 0.6s;"/>
                <circle cx="0" cy="0" r="110" stroke="currentColor" stroke-width="0.5" fill="none" style="animation: pulse-ring 4s ease-out infinite; animation-delay: 1.2s;"/>
            </svg>
            
            <!-- Floating Orbs -->
            <div class="absolute top-8 right-1/4 w-2 h-2 bg-cyan-400/50 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute bottom-8 right-1/3 w-3 h-3 bg-blue-400/40 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 0.5s;"></div>
            <div class="absolute top-1/2 left-1/4 w-2 h-2 bg-indigo-400/40 rounded-full blur-sm" style="animation: float 3.5s ease-in-out infinite; animation-delay: 1s;"></div>
            
            <!-- Sparkles -->
            <div class="absolute top-1/4 right-20 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="absolute bottom-1/3 right-40 w-1 h-1 bg-white/40 rounded-full" style="animation: sparkle 2.5s ease-in-out infinite; animation-delay: 0.5s;"></div>
        </div>
        
        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-sky-100 dark:divide-zinc-800">
            
            <!-- Total Aplikasi -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-0 md:pr-8 group">
                <div class="relative flex-shrink-0">
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 bg-sky-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <!-- Icon Container -->
                    <div class="relative w-16 h-16 bg-gradient-to-br from-sky-400 via-sky-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-sky-50 dark:ring-sky-500/20 group-hover:scale-105 transition-transform">
                        <!-- Icon: Cube Stack (Apps) -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total Aplikasi</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $totalApps }}</h3>
                    <p class="text-xs text-sky-600 dark:text-sky-400 mt-2 flex items-center font-medium">
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
                    <div class="relative w-16 h-16 bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-cyan-50 dark:ring-teal-500/20 group-hover:scale-105 transition-transform">
                        <!-- Icon: Building Office 2 -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total OPD</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $totalOpds }}</h3>
                    <p class="text-xs text-teal-600 dark:text-teal-400 mt-2 flex items-center font-medium">
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
                    <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50 dark:ring-indigo-500/20 group-hover:scale-105 transition-transform">
                        <!-- Icon: Document Chart Bar -->
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Input Bulan Ini</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $appsThisMonth ?? 0 }}</h3>
                    <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-2 flex items-center font-medium">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM Y') }}
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Recent Apps Table -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden">
        <div class="border-b border-gray-100 dark:border-zinc-800 bg-gray-50/50 dark:bg-black/30 px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Aplikasi Terbaru dari Semua OPD</h3>
                <p class="text-sm text-gray-500 dark:text-zinc-400">Data aplikasi yang baru diinput oleh seluruh OPD.</p>
            </div>
            <a href="{{ route('admin.web-apps.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium hover:underline flex items-center gap-1">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        
        <div class="p-0">
            @if($recentApps->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-zinc-800">
                        <thead class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-900 dark:to-black border-b border-gray-200 dark:border-zinc-700">
                            <tr>
                                <th scope="col" class="px-4 py-4 text-center w-16">
                                    <span class="flex items-center justify-center gap-1 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                        No
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">
                                    <span class="flex items-center gap-2 text-xs font-bold text-slate-600 uppercase tracking-wider">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
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
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Aksi
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-transparent divide-y divide-gray-100 dark:divide-zinc-800">
                            @foreach($recentApps as $app)
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors">
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-400 text-xs font-bold rounded-full">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $app->nama_web_app }}</div>
                                            @if($app->alamat_tautan)
                                                <a href="{{ $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 font-medium bg-blue-50 dark:bg-blue-500/15 px-2 py-0.5 rounded-md hover:bg-blue-100 dark:hover:bg-blue-500/25 transition-colors">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                                    Kunjungi
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-zinc-600 italic">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-medium rounded-full bg-green-50 dark:bg-emerald-500/15 text-green-700 dark:text-emerald-400 border border-green-100 dark:border-emerald-500/25">
                                            {{ $app->opd->nama_opd }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $app->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $app->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.web-apps.show', $app) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-500/15 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/25 transition-colors text-xs font-semibold">
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
                    <div class="bg-gray-50 dark:bg-white/5 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300 dark:text-zinc-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Belum Ada Data</h3>
                    <p class="text-gray-500 dark:text-zinc-500 text-sm">Belum ada data aplikasi yang diinput oleh OPD.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-8 text-center text-xs text-gray-400 dark:text-zinc-600">
        &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
    </div>
</x-admin-layout>
