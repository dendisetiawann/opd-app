{{-- Admin Dashboard Preview (no sidebar layout) --}}

<!-- Welcome Section (Premium Redesign) -->
<div class="relative bg-white rounded-3xl p-8 mb-8 overflow-hidden shadow-sm border border-gray-100 group">
    <!-- Decoration Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50/30"></div>
    
    <!-- Wave Illustration (Light Mode) -->
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
                {{ App\Models\SiteSetting::get('dashboard_admin_description', 'Pantau dan kelola seluruh inventaris aplikasi Pemerintah Kota Pekanbaru dalam satu dashboard terintegrasi yang modern dan efisien.') }}
            </p>

             <div class="pt-2 flex flex-wrap gap-3">
                <span class="inline-flex items-center text-xs font-semibold text-slate-500 bg-white/80 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-slate-200 shadow-sm">
                    <i class="fa-regular fa-calendar w-3.5 h-3.5 mr-2 text-slate-400 flex items-center justify-center"></i>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Stats Card (Combined) - Unified Blue-Cyan Theme -->
<div class="relative bg-white rounded-2xl shadow-sm border border-sky-100/50 p-8 mb-8 overflow-hidden">
    <!-- Subtle Wave Background -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
    </div>
    
    <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-sky-100">
        
        <!-- Total Aplikasi -->
        <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-0 md:pr-8 group">
            <div class="relative flex-shrink-0">
                <div class="absolute inset-0 bg-sky-400 rounded-2xl blur-xl opacity-30"></div>
                <div class="relative w-16 h-16 bg-gradient-to-br from-sky-400 via-sky-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-sky-50">
                    <i class="fa-solid fa-server w-8 h-8 text-white flex items-center justify-center"></i>
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
                <div class="absolute inset-0 bg-cyan-400 rounded-2xl blur-xl opacity-30"></div>
                <div class="relative w-16 h-16 bg-gradient-to-br from-cyan-400 via-teal-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-cyan-50">
                    <i class="fa-solid fa-building w-8 h-8 text-white flex items-center justify-center"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total OPD</p>
                <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $totalOpds }}</h3>
                <p class="text-xs text-teal-600 mt-2 flex items-center font-medium">
                    <i class="fa-solid fa-eye w-3.5 h-3.5 mr-1.5 flex items-center justify-center"></i>
                    Terdaftar di sistem
                </p>
            </div>
        </div>

        <!-- Input Bulan Ini -->
        <div class="flex items-center gap-5 pt-6 md:pt-0 md:pl-8 md:pr-0 group">
            <div class="relative flex-shrink-0">
                <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-xl opacity-30"></div>
                <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50">
                    <i class="fa-solid fa-circle-check w-8 h-8 text-white flex items-center justify-center"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Input Bulan Ini</p>
                <h3 class="text-4xl font-black text-slate-800 tracking-tight">{{ $appsThisMonth ?? 0 }}</h3>
                <p class="text-xs text-indigo-600 mt-2 flex items-center font-medium">
                    <i class="fa-solid fa-circle-check w-3.5 h-3.5 mr-1.5 flex items-center justify-center"></i>
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('MMMM Y') }}
                </p>
            </div>
        </div>

    </div>
</div>

<!-- Recent Apps Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
        <h3 class="text-lg font-bold text-gray-900">Aplikasi Terbaru dari Semua OPD</h3>
        <p class="text-sm text-gray-500">Data aplikasi yang baru diinput oleh seluruh OPD.</p>
    </div>
    
    <div class="p-0">
        @if($recentApps->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-4 py-4 text-center w-16">
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">No</span>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left">
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Aplikasi</span>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left">
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">OPD</span>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left">
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Penginput</span>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left">
                                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Tanggal</span>
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
                                    <div class="text-sm font-bold text-gray-900">{{ $app->nama_web_app }}</div>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fa-regular fa-file-alt w-10 h-10 flex items-center justify-center"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Data</h3>
                <p class="text-gray-500 text-sm">Belum ada data aplikasi yang diinput oleh OPD.</p>
            </div>
        @endif
    </div>
</div>

<!-- Footer Note -->
<div class="mt-8 text-center text-xs text-gray-400">
    &copy; {{ date('Y') }} {{ App\Models\SiteSetting::get('dashboard_admin_copyright', 'Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru') }}
</div>
