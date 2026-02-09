<x-admin-layout>
    <x-slot name="header">Statistik OPD</x-slot>

    <!-- Header Section - Matching Dashboard Theme -->
    <div class="relative bg-white dark:bg-zinc-900 rounded-2xl p-6 mb-6 overflow-hidden shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-indigo-50/30 dark:from-transparent dark:to-transparent"></div>
        
        <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Glow -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-indigo-500/15 via-purple-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 4s;"></div>
            <!-- Wave Lines -->
            <svg class="absolute -right-10 top-0 w-[400px] h-[200px] text-indigo-400/20" viewBox="0 0 400 200" fill="none" style="animation: sway 10s ease-in-out infinite;">
                <path d="M400 0 C 300 50, 200 100, 100 200" stroke="currentColor" stroke-width="1" fill="none"/>
                <path d="M400 30 C 300 80, 200 130, 100 200" stroke="currentColor" stroke-width="1" fill="none" opacity="0.7"/>
                <path d="M400 60 C 300 110, 200 160, 100 200" stroke="currentColor" stroke-width="1" fill="none" opacity="0.5"/>
            </svg>
            <!-- Floating Orbs -->
            <div class="absolute top-4 right-20 w-2 h-2 bg-indigo-400/50 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute top-8 right-40 w-3 h-3 bg-purple-400/40 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 0.5s;"></div>
            <!-- Sparkles -->
            <div class="absolute top-1/3 right-1/4 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 dark:bg-gradient-to-r dark:from-indigo-600 dark:to-purple-600 text-white text-[10px] font-bold uppercase tracking-wider shadow-sm dark:shadow-indigo-500/30 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                    OPD Analytics
                </div>
                <p class="text-slate-600 dark:text-zinc-400 text-sm max-w-lg">
                    Analisis data aplikasi per Organisasi Perangkat Daerah
                </p>
            </div>
        </div>
    </div>

    <!-- Stats Cards - Premium Glass Style -->
    <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-sm dark:shadow-xl border border-sky-100/50 dark:border-zinc-800 p-8 mb-6 hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 opacity-5 dark:hidden">
            <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-indigo-400 via-purple-300 to-transparent"></div>
        </div>
        
        <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
        <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
            <!-- Gradient Glow -->
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-gradient-to-tl from-blue-500/15 via-indigo-500/10 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 3s;"></div>
            <div class="absolute -left-10 -top-10 w-48 h-48 bg-gradient-to-br from-purple-500/10 via-fuchsia-500/5 to-transparent rounded-full blur-2xl animate-pulse" style="animation-duration: 4s; animation-delay: 0.5s;"></div>
            
            <!-- Wave Lines -->
            <svg class="absolute right-0 bottom-0 w-[500px] h-[200px] text-indigo-400/15" viewBox="0 0 500 200" fill="none" style="animation: sway 12s ease-in-out infinite;">
                <path d="M500 200 C 375 150, 250 75, 125 0" stroke="currentColor" stroke-width="1" fill="none"/>
                <path d="M500 170 C 375 120, 250 45, 125 0" stroke="currentColor" stroke-width="1" fill="none" opacity="0.7"/>
                <path d="M500 140 C 375 90, 250 15, 125 0" stroke="currentColor" stroke-width="1" fill="none" opacity="0.5"/>
            </svg>
            
            <!-- Pulsing Circles -->
            <svg class="absolute left-0 top-0 w-[200px] h-[200px] text-purple-400/10" viewBox="0 0 200 200" fill="none">
                <circle cx="0" cy="0" r="50" stroke="currentColor" stroke-width="0.5" fill="none" style="animation: pulse-ring 4s ease-out infinite;"/>
                <circle cx="0" cy="0" r="80" stroke="currentColor" stroke-width="0.5" fill="none" style="animation: pulse-ring 4s ease-out infinite; animation-delay: 0.6s;"/>
                <circle cx="0" cy="0" r="110" stroke="currentColor" stroke-width="0.5" fill="none" style="animation: pulse-ring 4s ease-out infinite; animation-delay: 1.2s;"/>
            </svg>
            
            <!-- Floating Orbs -->
            <div class="absolute top-8 right-1/4 w-2 h-2 bg-blue-400/50 rounded-full blur-sm" style="animation: float 3s ease-in-out infinite;"></div>
            <div class="absolute bottom-8 right-1/3 w-3 h-3 bg-indigo-400/40 rounded-full blur-sm" style="animation: float 4s ease-in-out infinite; animation-delay: 0.5s;"></div>
            <div class="absolute top-1/2 left-1/4 w-2 h-2 bg-purple-400/40 rounded-full blur-sm" style="animation: float 3.5s ease-in-out infinite; animation-delay: 1s;"></div>
            
            <!-- Sparkles -->
            <div class="absolute top-1/4 right-20 w-1 h-1 bg-white/50 rounded-full" style="animation: sparkle 2s ease-in-out infinite;"></div>
            <div class="absolute bottom-1/3 right-40 w-1 h-1 bg-white/40 rounded-full" style="animation: sparkle 2.5s ease-in-out infinite; animation-delay: 0.5s;"></div>
        </div>
        
        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-indigo-100 dark:divide-zinc-800">
            <!-- Total OPD -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-0 md:pr-8 group">
                <div class="relative flex-shrink-0">
                    <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50 dark:ring-blue-500/20 group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total OPD</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $opdStats->count() }}</h3>
                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-2 flex items-center font-medium">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></span>
                        Organisasi terdaftar
                    </p>
                </div>
            </div>

            <!-- Rata-rata App/OPD -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:px-8 group">
                <div class="relative flex-shrink-0">
                    <div class="absolute inset-0 bg-emerald-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <div class="relative w-16 h-16 bg-gradient-to-br from-emerald-400 via-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-emerald-50 dark:ring-emerald-500/20 group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Rata-rata</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $avgAppsPerOpd }}</h3>
                    <p class="text-xs text-teal-600 dark:text-teal-400 mt-2 flex items-center font-medium">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        Aplikasi per OPD
                    </p>
                </div>
            </div>

            <!-- OPD Tanpa App -->
            <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-8 md:pr-0 group">
                <div class="relative flex-shrink-0">
                    <div class="absolute inset-0 bg-amber-400 rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    <div class="relative w-16 h-16 bg-gradient-to-br from-amber-400 via-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-amber-50 dark:ring-amber-500/20 group-hover:scale-105 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Tanpa Aplikasi</p>
                    <h3 class="text-4xl font-black text-slate-800 dark:text-white tracking-tight">{{ $emptyOpds->count() }}</h3>
                    <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 flex items-center font-medium">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        OPD belum memiliki app
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top 10 OPD - Simple Design -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm dark:shadow-xl border border-gray-100 dark:border-zinc-800 overflow-hidden mb-6">
        <div class="border-b border-gray-100 px-6 py-4 flex items-center justify-between bg-gray-50/50">
            <div>
                <h3 class="text-sm font-bold text-slate-800">Top 10 OPD Terbaik</h3>
                <p class="text-xs text-slate-500">Peringkat berdasarkan jumlah aplikasi terdaftar</p>
            </div>
            <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
            <!-- Chart Side -->
            <div>
                <canvas id="opdChart" height="280"></canvas>
            </div>
            
            <!-- Ranking List Side -->
            <div class="space-y-3">
                @foreach($topOpds as $index => $opd)
                <div class="flex items-center gap-3 group">
                    <!-- Rank Badge -->
                    <div class="w-6 h-6 rounded flex items-center justify-center text-xs font-bold
                        {{ $index < 3 ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $index + 1 }}
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-slate-700 truncate">{{ $opd->nama_opd }}</span>
                            <span class="text-xs font-bold text-slate-900">{{ $opd->web_apps_count }} <span class="text-slate-400 font-normal">app</span></span>
                        </div>
                        <!-- Progress Bar -->
                        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500
                                {{ $index < 3 ? 'bg-blue-500' : 'bg-slate-400' }}"
                                style="width: {{ ($opd->web_apps_count / $topOpds->first()->web_apps_count) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Full OPD Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Daftar Lengkap OPD</h3>
                    <p class="text-xs text-slate-500">{{ $opdStats->count() }} organisasi terdaftar</p>
                </div>
            </div>
            <!-- Search -->
            <div class="relative w-full sm:w-auto">
                <input type="text" id="searchOpd" placeholder="Cari OPD..." class="w-full sm:w-64 pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full" id="opdTable">
                <thead class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider w-16">No</th>
                        <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Nama OPD</th>
                        <th class="text-center px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider w-32">Aplikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($opdStats as $index => $opd)
                    <tr class="hover:bg-gray-50 transition-colors opd-row">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center justify-center w-7 h-7 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">{{ $index + 1 }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-slate-800 opd-name">{{ $opd->nama_opd }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center min-w-[40px] px-3 py-1 rounded-full text-sm font-bold
                                {{ $opd->web_apps_count > 0 ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400' }}">
                                {{ $opd->web_apps_count }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart with simple blue theme
        const ctx = document.getElementById('opdChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 400, 0);
        gradient.addColorStop(0, '#3b82f6'); // blue-500
        gradient.addColorStop(1, '#2563eb'); // blue-600

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topOpds->pluck('nama_opd')->map(fn($n) => strlen($n) > 20 ? substr($n, 0, 20) . '...' : $n)) !!},
                datasets: [{
                    data: {!! json_encode($topOpds->pluck('web_apps_count')) !!},
                    backgroundColor: gradient,
                    borderRadius: 4,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 12, weight: '600' },
                        bodyFont: { size: 14, weight: '500' },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { font: { size: 11 }, color: '#94a3b8' }
                    },
                    y: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { font: { size: 11, weight: '500' }, color: '#475569' }
                    }
                }
            }
        });

        // Search functionality
        document.getElementById('searchOpd').addEventListener('input', function(e) {
            const search = e.target.value.toLowerCase();
            document.querySelectorAll('.opd-row').forEach(row => {
                const name = row.querySelector('.opd-name').textContent.toLowerCase();
                row.style.display = name.includes(search) ? '' : 'none';
            });
        });
    </script>
</x-admin-layout>
