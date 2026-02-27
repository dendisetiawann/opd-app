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
    <div class="min-h-screen bg-white dark:bg-black relative overflow-hidden transition-colors duration-300">
        
        <!-- Aurora / Mesh Gradient Background (Soft White/Bluish) -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 dark:bg-blue-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-50 dark:bg-indigo-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-slate-100 dark:bg-slate-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
            <div class="absolute -bottom-8 right-20 w-96 h-96 bg-sky-50 dark:bg-sky-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header Section - Admin Style -->
            <div class="relative bg-white dark:bg-black rounded-2xl p-6 mb-6 overflow-hidden shadow-sm border border-gray-100 dark:border-zinc-800">
                <!-- Background Decoration -->
                <div class="absolute inset-0 opacity-[0.03] dark:opacity-10 pointer-events-none">
                    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-500 via-cyan-400 to-transparent dark:from-blue-900 dark:via-cyan-900"></div>
                </div>

                <!-- ✨ ANIMATED DARK MODE DECORATIONS ✨ -->
                <div class="hidden dark:block absolute inset-0 pointer-events-none overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-0 left-10 w-48 h-48 bg-cyan-500/10 rounded-full blur-3xl" style="animation: pulse-ring 4s infinite"></div>
                    <!-- Sparkles -->
                    <div class="absolute top-4 right-10 w-1 h-1 bg-white/40 rounded-full" style="animation: sparkle 3s infinite"></div>
                    <div class="absolute bottom-4 left-1/4 w-1.5 h-1.5 bg-blue-400/40 rounded-full" style="animation: float 5s infinite"></div>
                </div>
                
                <div class="relative flex flex-col md:flex-row md:items-start md:justify-between gap-4 z-10">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 flex-shrink-0">
                            <i class="fa-solid fa-desktop w-6 h-6 text-white flex items-center justify-center"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">Daftar Aplikasi</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                                <span class="font-semibold text-slate-600 dark:text-slate-300">OPD :</span> {{ auth()->user()->opd->nama_opd ?? '-' }} 
                                <span class="mx-1 text-slate-300 dark:text-slate-600">|</span> 
                                <span class="font-bold text-blue-600 dark:text-blue-400">{{ $totalOpdAppsCount }}</span> aplikasi
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('web-apps.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all shadow-md shadow-blue-500/30 text-sm self-start hover:scale-[1.02] active:scale-[0.98]">
                        <i class="fa-solid fa-plus w-5 h-5 mr-2 flex items-center justify-center"></i>
                        Tambah Baru
                    </a>
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="bg-white dark:bg-black rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 mb-6 overflow-hidden">
                <div class="flex divide-x divide-gray-100 dark:divide-zinc-800">
                    <a href="{{ route('web-apps.index', ['filter' => 'mine']) }}" 
                       class="flex-1 px-6 py-4 text-center font-semibold text-sm transition-all {{ $filter === 'mine' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-b-2 border-blue-500' : 'text-slate-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-zinc-900 hover:text-slate-700 dark:hover:text-slate-200' }}">
                        <div class="flex items-center justify-center gap-2">
                            Aplikasi Anda
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $filter === 'mine' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300' : 'bg-gray-100 dark:bg-zinc-800 text-gray-500 dark:text-gray-400' }}">{{ $myAppsCount }}</span>
                        </div>
                    </a>
                    <a href="{{ route('web-apps.index', ['filter' => 'opd']) }}" 
                       class="flex-1 px-6 py-4 text-center font-semibold text-sm transition-all {{ $filter === 'opd' ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border-b-2 border-blue-500' : 'text-slate-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-zinc-900 hover:text-slate-700 dark:hover:text-slate-200' }}">
                        <div class="flex items-center justify-center gap-2">
                            Aplikasi OPD Anda
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $filter === 'opd' ? 'bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300' : 'bg-gray-100 dark:bg-zinc-800 text-gray-500 dark:text-gray-400' }}">{{ $opdAppsCount }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Search Card - Admin Style -->
            <div class="bg-white dark:bg-black rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800 mb-6 overflow-hidden">
                <div class="bg-gradient-to-r from-slate-50 to-gray-50 dark:from-zinc-900 dark:to-zinc-950 border-b border-gray-100 dark:border-zinc-800 px-6 py-4">
                    <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass w-4 h-4 text-slate-500 dark:text-slate-400 flex items-center justify-center"></i>
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
                            <i class="fa-solid fa-magnifying-glass h-4 w-4 text-blue-500 flex items-center justify-center"></i>
                        </div>
                        <input 
                            type="text" 
                            x-model="query"
                            placeholder="Ketik nama aplikasi..." 
                            class="w-full pl-10 pr-4 py-2.5 border-gray-200 dark:border-zinc-700 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm text-sm bg-gray-50 dark:bg-zinc-900 hover:bg-white dark:hover:bg-black text-slate-800 dark:text-slate-200 transition-colors placeholder-gray-400 dark:placeholder-zinc-500"
                            @input.debounce.300ms="search()"
                            autocomplete="off"
                        >
                    </div>
                </div>
            </div>

            <!-- Content List -->
            <div id="app-list">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-lg flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-check w-5 h-5 text-green-600 dark:text-green-400 flex items-center justify-center"></i>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-200">
                            <i class="fa-solid fa-xmark w-4 h-4 flex items-center justify-center"></i>
                        </button>
                    </div>
                @endif

                @if($webApps->count() > 0)
                    <!-- Table Header Card -->
                    <div class="bg-gradient-to-r from-slate-100 to-slate-50 dark:from-zinc-900 dark:to-zinc-950 rounded-t-2xl border border-slate-200 dark:border-zinc-800 border-b-0 px-5 py-4 hidden md:block">
                        <div class="grid grid-cols-12 gap-2 items-center text-[11px] font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                            <div class="col-span-1 text-center flex items-center justify-center gap-1">
                                <i class="fa-solid fa-hashtag w-4 h-4 text-slate-400 dark:text-slate-500 flex items-center justify-center"></i>
                                No
                            </div>
                            @if($filter === 'opd')
                            <div class="col-span-4 flex items-center gap-2">
                                <i class="fa-solid fa-desktop w-4 h-4 text-blue-500 flex items-center justify-center"></i>
                                Nama Aplikasi
                            </div>
                            <div class="col-span-3 flex items-center gap-2">
                                <i class="fa-solid fa-user w-4 h-4 text-violet-500 flex items-center justify-center"></i>
                                Penginput
                            </div>
                            <div class="col-span-2 flex items-center gap-2">
                                <i class="fa-solid fa-calendar-days w-4 h-4 text-amber-500 flex items-center justify-center"></i>
                                Tanggal
                            </div>
                            <div class="col-span-2 text-center flex items-center justify-center gap-1">
                                <i class="fa-solid fa-gear w-4 h-4 text-indigo-500 flex items-center justify-center"></i>
                                Aksi
                            </div>
                            @else
                            <div class="col-span-5 flex items-center gap-2">
                                <i class="fa-solid fa-desktop w-4 h-4 text-blue-500 flex items-center justify-center"></i>
                                Nama Aplikasi
                            </div>
                            <div class="col-span-4 flex items-center gap-2">
                                <i class="fa-solid fa-calendar-days w-4 h-4 text-amber-500 flex items-center justify-center"></i>
                                Tanggal Pendataan
                            </div>
                            <div class="col-span-2 text-center flex items-center justify-center gap-1">
                                <i class="fa-solid fa-gear w-4 h-4 text-indigo-500 flex items-center justify-center"></i>
                                Aksi
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- List Container -->
                    <div class="bg-white dark:bg-black rounded-b-2xl md:rounded-t-none rounded-t-2xl border border-slate-200 dark:border-zinc-800 overflow-hidden shadow-sm">
                        <ul class="divide-y divide-slate-100 dark:divide-zinc-800">
                            @foreach($webApps as $app)
                                <li class="group hover:bg-blue-50/50 dark:hover:bg-blue-900/10 transition-all duration-200">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-2 items-center p-4 sm:p-5">
                                        
                                        <!-- No (Col 1) -->
                                        <div class="hidden md:flex col-span-1 justify-center">
                                            <span class="w-7 h-7 rounded-full bg-slate-100 dark:bg-zinc-800 flex items-center justify-center text-slate-600 dark:text-slate-400 font-bold text-xs">
                                                {{ $webApps->firstItem() + $loop->index }}
                                            </span>
                                        </div>

                                        <!-- Nama Aplikasi -->
                                        @if($filter === 'opd')
                                        <div class="col-span-1 md:col-span-4">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Aplikasi</span>
                                            <a href="{{ route('web-apps.show', $app) }}" class="text-base font-bold text-slate-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition-colors truncate block">
                                                {{ $app->nama_web_app }}
                                            </a>
                                            @if($app->alamat_tautan)
                                            <a href="{{ str_starts_with($app->alamat_tautan, 'http') ? $app->alamat_tautan : 'https://' . $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors mt-1">
                                                <i class="fa-solid fa-arrow-up-right-from-square w-3 h-3 flex items-center justify-center"></i>
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
                                                <i class="fa-regular fa-calendar-days w-4 h-4 text-slate-400 dark:text-slate-500 flex items-center justify-center"></i>
                                                {{ $app->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                        @else
                                        <!-- Nama Aplikasi for mine -->
                                        <div class="col-span-1 md:col-span-5">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Aplikasi</span>
                                            <a href="{{ route('web-apps.show', $app) }}" class="text-base font-bold text-slate-800 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition-colors truncate block">
                                                {{ $app->nama_web_app }}
                                            </a>
                                            @if($app->alamat_tautan)
                                            <a href="{{ str_starts_with($app->alamat_tautan, 'http') ? $app->alamat_tautan : 'https://' . $app->alamat_tautan }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors mt-1">
                                                <i class="fa-solid fa-arrow-up-right-from-square w-3 h-3 flex items-center justify-center"></i>
                                                Kunjungi
                                            </a>
                                            @endif
                                        </div>

                                        <!-- Tanggal -->
                                        <div class="col-span-1 md:col-span-4">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Pendataan</span>
                                            <div class="flex items-center gap-1.5 text-sm text-slate-600 dark:text-slate-400 font-medium">
                                                <i class="fa-regular fa-calendar-days w-4 h-4 text-slate-400 dark:text-slate-500 flex items-center justify-center"></i>
                                                {{ $app->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Aksi -->
                                        <div class="col-span-1 md:col-span-2 flex items-center justify-start md:justify-center gap-1.5">
                                            <span class="md:hidden text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-2">Aksi</span>
                                            <a href="{{ route('web-apps.show', $app) }}" class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/40 hover:scale-110 transition-all shadow-sm" title="Lihat">
                                                <i class="fa-solid fa-eye w-4 h-4 flex items-center justify-center"></i>
                                            </a>
                                            @if($filter === 'mine')
                                            <a href="{{ route('web-apps.edit', $app) }}" class="p-2 rounded-lg bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-900/40 hover:scale-110 transition-all shadow-sm" title="Edit">
                                                <i class="fa-solid fa-pen-to-square w-4 h-4 flex items-center justify-center"></i>
                                            </a>
                                            <form id="delete-form-{{ $app->id }}" action="{{ route('web-apps.destroy', $app) }}" method="POST" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="showDeleteConfirm({{ $app->id }}, '{{ addslashes($app->nama_web_app) }}')" class="p-2 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/40 hover:scale-110 transition-all shadow-sm" title="Hapus">
                                                    <i class="fa-solid fa-trash-can w-4 h-4 flex items-center justify-center"></i>
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
                            <div class="px-5 py-4 border-t border-gray-100 dark:border-zinc-800 bg-gray-50 dark:bg-zinc-900 flex items-center justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">
                                    {{ $webApps->firstItem() }}-{{ $webApps->lastItem() }} dari {{ $webApps->total() }}
                                </span>
                                <div class="flex gap-1">
                                    @if (!$webApps->onFirstPage())
                                        <a href="{{ $webApps->previousPageUrl() }}" class="px-3 py-1.5 text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-black rounded border border-gray-200 dark:border-zinc-700 transition-colors">Sebelumnya</a>
                                    @endif
                                    @if ($webApps->hasMorePages())
                                        <a href="{{ $webApps->nextPageUrl() }}" class="px-3 py-1.5 text-gray-600 dark:text-gray-300 hover:bg-white dark:hover:bg-black rounded border border-gray-200 dark:border-zinc-700 transition-colors">Berikutnya</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white dark:bg-black rounded-xl border border-gray-200 dark:border-zinc-800 p-12 text-center">
                        <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-zinc-900 flex items-center justify-center">
                            <i class="fa-solid fa-folder-open w-6 h-6 text-gray-400 dark:text-gray-500 flex items-center justify-center"></i>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Tidak ada data</h3>
                        @if($filter === 'opd')
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada aplikasi dari user lain di OPD Anda.</p>
                        @else
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Belum ada aplikasi yang terdaftar.</p>
                        <a href="{{ route('web-apps.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            <i class="fa-solid fa-plus w-4 h-4 flex items-center justify-center"></i>
                            Tambah Aplikasi
                        </a>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-gray-900/80 dark:bg-black/80 backdrop-blur-sm" onclick="closeDeleteConfirm()"></div>
        <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-sm w-full p-6 transform transition-all ring-1 ring-black/5 dark:ring-white/10">
            <div class="text-center">
                <div class="mx-auto w-14 h-14 bg-red-100 dark:bg-red-500/15 rounded-full flex items-center justify-center mb-4">
                    <i class="fa-solid fa-triangle-exclamation w-8 h-8 text-red-500 dark:text-red-400 flex items-center justify-center"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Hapus Aplikasi?</h3>
                <p class="text-sm text-gray-600 dark:text-zinc-400 mb-6">Apakah Anda yakin ingin menghapus <strong id="deleteAppName" class="text-gray-900 dark:text-white"></strong>? Data yang dihapus tidak dapat dikembalikan.</p>
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteConfirm()" class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-zinc-700 rounded-xl text-sm font-medium text-gray-700 dark:text-zinc-300 hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                        Batal
                    </button>
                    <button type="button" onclick="confirmDelete()" class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 rounded-xl text-sm font-semibold text-white transition-colors shadow-lg shadow-red-500/25">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteAppId = null;

        function showDeleteConfirm(id, name) {
            deleteAppId = id;
            document.getElementById('deleteAppName').textContent = name;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteConfirm() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
            deleteAppId = null;
        }

        function confirmDelete() {
            if (deleteAppId) {
                document.getElementById('delete-form-' + deleteAppId).submit();
            }
        }
    </script>
</x-app-layout>
