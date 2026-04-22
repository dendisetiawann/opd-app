{{-- Dashboard User Preview (no sidebar layout) --}}

<!-- Welcome Section -->
<div class="relative bg-white rounded-3xl p-8 mb-8 overflow-hidden shadow-sm border border-gray-100">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 to-blue-50/30"></div>
    <div class="absolute top-0 right-0 h-full w-full md:w-3/4 pointer-events-none overflow-hidden">
        <img src="{{ asset('images/dashboard-wave.png') }}" alt="Wave Background" 
            class="absolute right-0 top-0 h-full w-full object-cover object-right opacity-50 mix-blend-multiply"
            style="-webkit-mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%); mask-image: linear-gradient(to left, rgba(0,0,0,1) 10%, rgba(0,0,0,0) 90%);">
        <div class="absolute inset-0 bg-gradient-to-l from-transparent via-white/60 to-white"></div>
    </div>

    <div class="relative flex flex-col md:flex-row items-center justify-between gap-8 z-10">
        <div class="flex-1 space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-[10px] font-bold uppercase tracking-wider shadow-md shadow-slate-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                User Dashboard
            </div>
            
            <p class="text-slate-600 text-base max-w-xl leading-relaxed font-medium mt-2">
                {{ App\Models\SiteSetting::get('dashboard_user_description', 'Lihat dan tambahkan data inventarisasi aplikasi') }} <span class="font-bold text-slate-800">Instansi Anda</span> dalam satu dashboard yang modern dan efisien.
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

<!-- Stats Card -->
<div class="relative bg-white rounded-2xl shadow-sm border border-sky-100/50 p-8 mb-8 overflow-hidden group">
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-bl from-cyan-400 via-sky-300 to-transparent"></div>
    </div>
    
    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 divide-y md:divide-y-0 md:divide-x divide-sky-100">
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
                    Aplikasi Anda
                </p>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="flex items-center gap-5 pt-6 md:pt-0 md:px-8 group">
            <div class="relative flex-shrink-0">
                <div class="absolute inset-0 bg-blue-400 rounded-2xl blur-xl opacity-30"></div>
                <div class="relative w-16 h-16 bg-gradient-to-br from-blue-400 via-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-blue-50">
                    <i class="fa-solid fa-circle-check w-8 h-8 text-white flex items-center justify-center"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Aksi Cepat</p>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-circle-check w-4 h-4 mr-1.5 flex items-center justify-center"></i>
                        Tambah Aplikasi
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-5">
        <h3 class="text-lg font-bold text-gray-900">Daftar Aplikasi Terbaru</h3>
        <p class="text-sm text-gray-500">Aplikasi terbaru yang terdata dari OPD Anda.</p>
    </div>
    <div class="p-4">
        <div class="text-center py-16">
            <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                <i class="fa-regular fa-file-alt w-10 h-10 flex items-center justify-center"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Data</h3>
            <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan aplikasi pertama Anda.</p>
        </div>
    </div>
</div>

<!-- Footer Note -->
<div class="mt-8 text-center text-xs text-gray-400">
    &copy; {{ date('Y') }} {{ App\Models\SiteSetting::get('dashboard_user_copyright', 'Sistem Manajemen Data Aplikasi - Dinas Komunikasi Informatika Statistik dan Persandian Kota Pekanbaru. All rights reserved.') }}
</div>
