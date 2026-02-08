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
            
            <!-- Header Section - Admin Style -->
            <div class="relative bg-white rounded-2xl p-6 mb-6 overflow-hidden shadow-sm border border-gray-100">
                <!-- Background Decoration -->
                <div class="absolute inset-0 opacity-[0.03]">
                    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-500 via-cyan-400 to-transparent"></div>
                </div>
                
                <div class="relative flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">Daftar Aplikasi</h2>
                            <p class="text-sm text-slate-500 mt-1">
                                <span class="font-semibold text-slate-600">OPD :</span> {{ auth()->user()->opd->nama_opd ?? '-' }} 
                                <span class="mx-1 text-slate-300">|</span> 
                                <span class="font-bold text-blue-600">{{ $totalOpdAppsCount }}</span> aplikasi
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all shadow-md shadow-blue-500/30 text-sm self-start">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Baru
                    </a>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6 overflow-hidden">
                <div class="flex">
                    <a href="{{ route('web-apps.index', ['filter' => 'mine']) }}" 
                       class="flex-1 px-6 py-4 text-center font-semibold text-sm transition-all {{ $filter === 'mine' ? 'bg-blue-50 text-blue-600 border-b-2 border-blue-500' : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700' }}">
                        <div class="flex items-center justify-center gap-2">
                            Aplikasi Anda
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $filter === 'mine' ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-500' }}">{{ $myAppsCount }}</span>
                        </div>
                    </a>
                    <a href="{{ route('web-apps.index', ['filter' => 'opd']) }}" 
                       class="flex-1 px-6 py-4 text-center font-semibold text-sm transition-all {{ $filter === 'opd' ? 'bg-blue-50 text-blue-600 border-b-2 border-blue-500' : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700' }}">
                        <div class="flex items-center justify-center gap-2">
                            Aplikasi OPD Anda
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $filter === 'opd' ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-500' }}">{{ $opdAppsCount }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Search Card - Admin Style -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-50 to-gray-50 border-b border-gray-100 px-6 py-4">
                    <h3 class="text-sm font-bold text-slate-700 flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Pencarian
                    </h3>
                </div>
                <div class="p-6">
                    <div x-data="{ 
                        query: '{{ request('search') }}',
                        search() {
                            fetch('{{ route('web-apps.index') }}?filter={{ $filter }}&search=' + this.query, {
                                headers: { 'X-Requested-With': 'XMLHttpRequest' }
                            })
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const content = doc.getElementById('app-list').innerHTML;
                                document.getElementById('app-list').innerHTML = content;
                                const url = new URL(window.location);
                                url.searchParams.set('search', this.query);
                                window.history.replaceState({}, '', url);
                            });
                        }
                    }" class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            x-model="query"
                            placeholder="Ketik nama aplikasi..." 
                            class="w-full pl-10 pr-4 py-2.5 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-sm bg-gray-50 hover:bg-white transition-colors"
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
                        <div class="grid grid-cols-12 gap-2 items-center text-[11px] font-bold text-slate-600 uppercase tracking-wider">
                            <div class="col-span-1 text-center flex items-center justify-center gap-1">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                No
                            </div>
                            @if($filter === 'opd')
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
                            @else
                            <div class="col-span-5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                Nama Aplikasi
                            </div>
                            <div class="col-span-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Tanggal Pendataan
                            </div>
                            <div class="col-span-2 text-center flex items-center justify-center gap-1">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                                Aksi
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- List Container -->
                    <div class="bg-white rounded-b-2xl md:rounded-t-none rounded-t-2xl border border-slate-200 overflow-hidden shadow-sm">
                        <ul class="divide-y divide-slate-100">
                            @foreach($webApps as $app)
                                <li class="group hover:bg-blue-50/50 transition-all duration-200">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center p-4 sm:p-5">
                                        
                                        <!-- No (Col 1) -->
                                        <div class="hidden md:flex col-span-1 justify-center">
                                            <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-xs">
                                                {{ $webApps->firstItem() + $loop->index }}
                                            </span>
                                        </div>

                                        <!-- Nama Aplikasi -->
                                        @if($filter === 'opd')
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
                                        @else
                                        <!-- Nama Aplikasi for mine -->
                                        <div class="col-span-1 md:col-span-5">
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

                                        <!-- Tanggal -->
                                        <div class="col-span-1 md:col-span-4">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Pendataan</span>
                                            <div class="flex items-center gap-1.5 text-sm text-slate-600 font-medium">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                {{ $app->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Aksi -->
                                        <div class="col-span-1 md:col-span-2 flex items-center justify-start md:justify-center gap-1.5">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-2">Aksi</span>
                                            <a href="{{ route('web-apps.show', $app) }}" class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 hover:scale-110 transition-all shadow-sm" title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>
                                            @if($filter === 'mine')
                                            <a href="{{ route('web-apps.edit', $app) }}" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 hover:scale-110 transition-all shadow-sm" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('web-apps.destroy', $app) }}" method="POST" onsubmit="return confirm('Hapus aplikasi ini?')" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 hover:scale-110 transition-all shadow-sm" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                            @endif
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
                        @if($filter === 'opd')
                        <p class="text-sm text-gray-500">Belum ada aplikasi dari user lain di OPD Anda.</p>
                        @else
                        <p class="text-sm text-gray-500 mb-4">Belum ada aplikasi yang terdaftar.</p>
                        <a href="{{ route('web-apps.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Aplikasi
                        </a>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
