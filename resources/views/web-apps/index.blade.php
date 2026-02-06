<x-app-layout>
    <!-- Custom Style for Blob Animation -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 10s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <!-- UCD: Minimal, calm background with Aurora Animation -->
    <div class="min-h-screen bg-white relative overflow-hidden">
        
        <!-- Aurora / Mesh Gradient Background (Soft White/Bluish) -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-50 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-slate-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
            <div class="absolute -bottom-8 right-20 w-96 h-96 bg-sky-50 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Unified Dashboard Card (Glassmorphism & Premium Design) -->
            <div class="relative mb-8 rounded-3xl p-1 p-0.5 bg-gradient-to-br from-white/60 to-white/30 border border-white/50 shadow-xl shadow-blue-900/5 backdrop-blur-xl overflow-hidden">
                
                <!-- Floating Abstract Shapes Inside Card -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-32 h-32 bg-blue-200/40 rounded-full mix-blend-multiply filter blur-2xl animate-blob"></div>
                    <div class="absolute top-20 -left-8 w-24 h-24 bg-indigo-200/40 rounded-full mix-blend-multiply filter blur-2xl animate-blob animation-delay-2000"></div>
                    <div class="absolute -bottom-4 right-1/4 w-28 h-28 bg-cyan-200/40 rounded-full mix-blend-multiply filter blur-2xl animate-blob animation-delay-4000"></div>
                </div>

                <div class="rounded-[22px] bg-white/60 p-6 sm:p-8 relative z-10">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        
                        <!-- Title & Branding -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2.5 py-1 rounded-full bg-blue-50/80 border border-blue-100 text-[10px] font-bold tracking-widest text-[#1a237e] uppercase backdrop-blur-sm">
                                    Inventarisasi Digital
                                </span>
                            </div>
                            <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600 drop-shadow-sm">
                                Daftar Aplikasi
                            </h1>
                            <p class="mt-2 text-sm text-slate-500 font-medium max-w-lg leading-relaxed">
                                Kelola sistem informasi dan aplikasi terdaftar dengan mudah, cepat, dan terintegrasi.
                            </p>
                        </div>

                        <!-- Stats & Action -->
                        <div class="w-full lg:w-auto flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                            <!-- Stats Pill (Premium Design) -->
                            <div class="group relative px-6 py-4 rounded-2xl bg-gradient-to-br from-slate-50 to-white border border-slate-200/50 flex items-center gap-4 min-w-[140px] backdrop-blur-sm shadow-sm hover:shadow-md hover:border-blue-200/50 transition-all duration-300">
                                <!-- Icon -->
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/25">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                </div>
                                <!-- Text -->
                                <div class="flex flex-col">
                                    <span class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#1a237e] to-blue-600">{{ $webApps->total() }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Aplikasi Terdaftar</span>
                                </div>
                            </div>

                            <!-- Add Button (Premium Gradient) -->
                            <a href="{{ route('web-apps.create') }}" class="group relative px-6 py-3.5 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 rounded-2xl"></div>
                                <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                <span class="relative z-10">Tambah Baru</span>
                            </a>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent my-6"></div>

                    <!-- Search Bar (Glassmorphism Integrated) -->
                    <div x-data="{ 
                        query: '{{ request('search') }}',
                        search() {
                            fetch('{{ route('web-apps.index') }}?search=' + this.query, {
                                headers: { 'X-Requested-With': 'XMLHttpRequest' }
                            })
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const content = doc.getElementById('app-list').innerHTML; // Changed from app-list-container to app-list
                                document.getElementById('app-list').innerHTML = content; // Changed from app-list-container to app-list
                                const url = new URL(window.location);
                                url.searchParams.set('search', this.query);
                                window.history.replaceState({}, '', url);
                            });
                        }
                    }" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            x-model="query"
                            placeholder="Cari nama aplikasi..." 
                            class="block w-full pl-11 pr-4 py-3.5 bg-white/50 border-0 ring-1 ring-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:ring-2 focus:ring-blue-500/20 focus:bg-white transition-all shadow-sm"
                            @input.debounce.300ms="search()"
                            autocomplete="off"
                        >
                    </div>
                </div>
            </div>

            <!-- Content List -->
            <div id="app-list">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-green-600 hover:text-green-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if($webApps->count() > 0)
                    <!-- Table Header Card -->
                    <div class="bg-gradient-to-r from-slate-100 to-slate-50 rounded-t-2xl border border-slate-200 border-b-0 px-5 py-4 hidden md:block">
                        <div class="grid grid-cols-12 gap-4 items-center text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <div class="col-span-1 text-center">No</div>
                            <div class="col-span-3">Nama Aplikasi</div>
                            <div class="col-span-3">URL / Alamat</div>
                            <div class="col-span-2">DBMS</div>
                            <div class="col-span-2">Tanggal Input</div>
                            <div class="col-span-1 text-center">Aksi</div>
                        </div>
                    </div>

                    <!-- List Container -->
                    <div class="bg-white rounded-b-2xl md:rounded-t-none rounded-t-2xl border border-slate-200 overflow-hidden shadow-sm">
                        <ul class="divide-y divide-slate-100">
                            @foreach($webApps as $app)
                                <li class="group hover:bg-blue-50/50 transition-all duration-200">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center p-4 sm:p-5">
                                        
                                        <!-- No (Col 1) -->
                                        <div class="hidden md:flex col-span-1 justify-center">
                                            <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-blue-500/20">
                                                {{ str_pad(($webApps->currentPage() - 1) * $webApps->perPage() + $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>

                                        <!-- Nama Aplikasi (Col 3) -->
                                        <div class="col-span-1 md:col-span-3">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Aplikasi</span>
                                            <a href="{{ route('web-apps.show', $app) }}" class="text-base font-bold text-slate-800 hover:text-blue-600 transition-colors truncate block">
                                                {{ $app->nama_web_app }}
                                            </a>
                                        </div>

                                        <!-- URL (Col 3) -->
                                        <div class="col-span-1 md:col-span-3">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">URL / Alamat</span>
                                            @if($app->domain)
                                                <a href="{{ str_starts_with($app->domain, 'http') ? $app->domain : 'https://' . $app->domain }}" target="_blank" class="inline-flex items-center gap-1.5 text-sm font-medium text-blue-600 hover:underline truncate max-w-full">
                                                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                                    <span class="truncate">{{ $app->domain }}</span>
                                                </a>
                                            @else
                                                <span class="text-sm text-slate-400 italic">Tidak ada URL</span>
                                            @endif
                                        </div>

                                        <!-- DBMS (Col 2) -->
                                        <div class="col-span-1 md:col-span-2">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">DBMS</span>
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-semibold text-xs border border-slate-200">
                                                {{ $app->dbms ?? '-' }}
                                            </span>
                                        </div>

                                        <!-- Tanggal (Col 2) -->
                                        <div class="col-span-1 md:col-span-2">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Input</span>
                                            <div class="flex items-center gap-1.5 text-sm text-slate-600 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                {{ $app->created_at->format('d M Y') }}
                                            </div>
                                        </div>

                                        <!-- Aksi (Col 1) -->
                                        <div class="col-span-1 md:col-span-1 flex items-center justify-start md:justify-center gap-1.5">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-2">Aksi</span>
                                            <a href="{{ route('web-apps.show', $app) }}" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:scale-110 transition-all shadow-sm" title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            <a href="{{ route('web-apps.edit', $app) }}" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:scale-110 transition-all shadow-sm" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('web-apps.destroy', $app) }}" method="POST" onsubmit="return confirm('Hapus aplikasi ini?')" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:scale-110 transition-all shadow-sm" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Pagination -->
                        @if($webApps->hasPages())
                            <div class="px-5 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    {{ $webApps->firstItem() }}-{{ $webApps->lastItem() }} dari {{ $webApps->total() }}
                                </span>
                                <div class="flex gap-1">
                                    @if (!$webApps->onFirstPage())
                                        <a href="{{ $webApps->previousPageUrl() }}" class="px-3 py-1.5 text-gray-600 hover:bg-white rounded border border-gray-200 transition-colors">Sebelumnya</a>
                                    @endif
                                    @if ($webApps->hasMorePages())
                                        <a href="{{ $webApps->nextPageUrl() }}" class="px-3 py-1.5 text-gray-600 hover:bg-white rounded border border-gray-200 transition-colors">Berikutnya</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path></svg>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">Tidak ada data</h3>
                        <p class="text-sm text-gray-500 mb-4">Belum ada aplikasi yang terdaftar.</p>
                        <a href="{{ route('web-apps.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Aplikasi
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
