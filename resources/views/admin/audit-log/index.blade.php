<x-admin-layout>
{{-- Flatpickr CSS & JS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
<style>
    .flatpickr-calendar { font-family: inherit !important; border-radius: 12px !important; box-shadow: 0 10px 40px rgba(0,0,0,.15) !important; }
    .dark .flatpickr-calendar { background: #18181b !important; border-color: #3f3f46 !important; }
    .dark .flatpickr-months, .dark .flatpickr-weekdays, .dark .flatpickr-day { color: #d4d4d8 !important; }
    .dark .flatpickr-day:hover { background: #3f3f46 !important; }
    .dark .flatpickr-day.selected { background: #6366f1 !important; border-color: #6366f1 !important; }
    .flatpickr-day.selected { background: #6366f1 !important; border-color: #6366f1 !important; }
</style>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25">
                <i class="fa-solid fa-circle-check w-6 h-6 text-white flex items-center justify-center"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Audit Log</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Riwayat semua aktivitas sistem</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 ring-1 ring-indigo-200 dark:ring-indigo-800">
                <i class="fa-solid fa-circle-check w-3.5 h-3.5 flex items-center justify-center"></i>
                {{ number_format($totalLogs) }} total log
            </span>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-5"
         x-data="{
            showCustom: {{ request('date_from') || request('date_to') ? 'true' : 'false' }},
            activePreset: '{{ request('preset', '') }}',
            submitForm() {
                this.$refs.filterForm.submit();
            },
            applyPreset(preset) {
                this.activePreset = preset;
                this.showCustom = false;
                this.$refs.presetInput.value = preset;
                this.$refs.dateFromInput.value = '';
                this.$refs.dateToInput.value = '';
                this.submitForm();
            },
            openCustom() {
                this.showCustom = true;
                this.activePreset = '';
                this.$refs.presetInput.value = '';
            }
         }">
        <form method="GET" action="{{ route('admin.audit-log.index') }}" x-ref="filterForm" class="space-y-4">
            <input type="hidden" name="preset" x-ref="presetInput" value="{{ request('preset', '') }}">

            <!-- Row 1: Search + Action -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Search -->
                <div class="relative flex-1 flex gap-2">
                    <div class="relative flex-1">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 flex items-center justify-center"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama user atau admin..."
                               class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-300 dark:border-zinc-700 rounded-lg bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                    </div>
                    <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition shadow-sm flex-shrink-0">
                        <i class="fa-solid fa-magnifying-glass w-4 h-4 flex items-center justify-center"></i>
                        Cari
                    </button>
                </div>

                <!-- Action Filter -->
                <select name="action" @change="submitForm()" class="px-3 py-2.5 text-sm border border-gray-300 dark:border-zinc-700 rounded-lg bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition sm:w-52">
                    <option value="">Semua Aksi</option>
                    @foreach($actionTypes as $actionKey => $actionLabel)
                        <option value="{{ $actionKey }}" {{ request('action') === $actionKey ? 'selected' : '' }}>
                            {{ $actionLabel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Row 2: Date Preset Chips -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <div class="flex items-center gap-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 flex-shrink-0">
                    <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                    Periode
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" @click="applyPreset('today')"
                            class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all duration-150"
                            :class="activePreset === 'today' ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 hover:border-gray-400 dark:hover:border-zinc-500'">
                        Hari Ini
                    </button>
                    <button type="button" @click="applyPreset('yesterday')"
                            class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all duration-150"
                            :class="activePreset === 'yesterday' ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 hover:border-gray-400 dark:hover:border-zinc-500'">
                        Kemarin
                    </button>
                    <button type="button" @click="applyPreset('7d')"
                            class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all duration-150"
                            :class="activePreset === '7d' ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 hover:border-gray-400 dark:hover:border-zinc-500'">
                        7 Hari
                    </button>
                    <button type="button" @click="applyPreset('30d')"
                            class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all duration-150"
                            :class="activePreset === '30d' ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 hover:border-gray-400 dark:hover:border-zinc-500'">
                        30 Hari
                    </button>
                    <button type="button" @click="applyPreset('1y')"
                            class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all duration-150"
                            :class="activePreset === '1y' ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 hover:border-gray-400 dark:hover:border-zinc-500'">
                        1 Tahun
                    </button>

                    <!-- Divider -->
                    <div class="hidden sm:block w-px h-7 bg-gray-200 dark:bg-zinc-700 mx-0.5"></div>

                    <button type="button" @click="openCustom()"
                            class="px-3 py-1.5 text-xs font-medium rounded-lg border transition-all duration-150"
                            :class="showCustom && !activePreset ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-500/25' : 'bg-white dark:bg-zinc-800 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-700 hover:border-gray-400 dark:hover:border-zinc-500'">
                        <span class="inline-flex items-center gap-1">
                            <i class="fa-solid fa-circle-check w-3.5 h-3.5 flex items-center justify-center"></i>
                            Kustom
                        </span>
                    </button>
                </div>

                <!-- Spacer -->
                <div class="flex-1"></div>

                <!-- Reset -->
                @if(request()->hasAny(['search', 'action', 'date_from', 'date_to', 'preset']))
                    <a href="{{ route('admin.audit-log.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 rounded-lg transition flex-shrink-0">
                        <i class="fa-solid fa-xmark w-3.5 h-3.5 flex items-center justify-center"></i>
                        Reset
                    </a>
                @endif
            </div>

            <!-- Row 3: Custom Date Range (collapsible) -->
            <div x-show="showCustom" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="flex flex-col sm:flex-row sm:items-end gap-3 pt-3 border-t border-gray-100 dark:border-zinc-800">
                <div class="flex-1 sm:max-w-[220px]">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Dari Tanggal</label>
                    <input type="text" name="date_from" x-ref="dateFromInput" value="{{ request('date_from') }}" placeholder="Pilih tanggal..." readonly
                           id="flatpickr-from"
                           class="w-full px-3 py-2.5 text-sm border border-gray-300 dark:border-zinc-700 rounded-lg bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition cursor-pointer">
                </div>
                <div class="hidden sm:flex items-center pb-2.5">
                    <span class="text-gray-400 dark:text-gray-500 text-sm font-medium">s/d</span>
                </div>
                <div class="flex-1 sm:max-w-[220px]">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1.5">Sampai Tanggal</label>
                    <input type="text" name="date_to" x-ref="dateToInput" value="{{ request('date_to') }}" placeholder="Pilih tanggal..." readonly
                           id="flatpickr-to"
                           class="w-full px-3 py-2.5 text-sm border border-gray-300 dark:border-zinc-700 rounded-lg bg-gray-50 dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition cursor-pointer">
                </div>
                <button type="submit" @click="$refs.presetInput.value = ''"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition shadow-sm flex-shrink-0">
                    <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                    Terapkan
                </button>
            </div>
        </form>
    </div>

    <!-- Timeline Grouped by Date -->
    @if($groupedLogs->count() > 0)
        <div class="space-y-8">
            @foreach($groupedLogs as $date => $dailyLogs)
                @php
                    $dateFormatted = \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y');
                    $dailyCount = $dailyLogs->count();
                    $perPage = 7;
                    $totalPages = (int) ceil($dailyCount / $perPage);
                @endphp

                <div x-data="{ page: 0, expanded: null }" class="space-y-3">
                    <!-- Date Header -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 px-4 py-2 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800/40 rounded-lg">
                            <i class="fa-solid fa-pen-to-square w-4 h-4 text-indigo-500 flex items-center justify-center"></i>
                            <span class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">{{ $dateFormatted }}</span>
                        </div>
                        <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">{{ $dailyCount }} aktivitas</span>
                        <div class="flex-1 border-t border-gray-200 dark:border-zinc-800"></div>
                    </div>

                    <!-- Log Items -->
                    @foreach($dailyLogs->values() as $index => $log)
                        @php
                            $color = $log->action_color;
                            $colorClasses = match($color) {
                                'emerald' => [
                                    'badge' => 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400 ring-emerald-300 dark:ring-emerald-800',
                                    'icon_bg' => 'bg-emerald-500',
                                    'dot' => 'bg-emerald-500',
                                ],
                                'amber' => [
                                    'badge' => 'bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400 ring-amber-300 dark:ring-amber-800',
                                    'icon_bg' => 'bg-amber-500',
                                    'dot' => 'bg-amber-500',
                                ],
                                'red' => [
                                    'badge' => 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400 ring-red-300 dark:ring-red-800',
                                    'icon_bg' => 'bg-red-500',
                                    'dot' => 'bg-red-500',
                                ],
                                'blue' => [
                                    'badge' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400 ring-blue-300 dark:ring-blue-800',
                                    'icon_bg' => 'bg-blue-500',
                                    'dot' => 'bg-blue-500',
                                ],
                                default => [
                                    'badge' => 'bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-400 ring-indigo-300 dark:ring-indigo-800',
                                    'icon_bg' => 'bg-indigo-500',
                                    'dot' => 'bg-indigo-500',
                                ],
                            };
                        @endphp

                        <div x-show="{{ $index }} >= page * {{ $perPage }} && {{ $index }} < (page + 1) * {{ $perPage }}"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="group relative bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 hover:shadow-md hover:border-gray-300 dark:hover:border-zinc-700 transition-all duration-200 overflow-hidden"
                             @click="expanded === {{ $log->id }} ? expanded = null : expanded = {{ $log->id }}">
                            
                            <!-- Color accent bar -->
                            <div class="absolute left-0 top-0 bottom-0 w-1 {{ $colorClasses['dot'] }} rounded-l-xl"></div>

                            <div class="pl-5 pr-4 py-4 cursor-pointer">
                                <div class="flex items-start gap-4">
                                    <!-- Icon -->
                                    <div class="flex-shrink-0 mt-0.5">
                                        <div class="w-10 h-10 rounded-lg {{ $colorClasses['icon_bg'] }} flex items-center justify-center shadow-sm">
                                            <i class="fa-solid fa-circle-check w-5 h-5 text-white flex items-center justify-center"></i>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold ring-1 {{ $colorClasses['badge'] }} w-fit">
                                                {{ $log->action_label }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $log->created_at->format('H:i:s') }}
                                                <span class="text-gray-400 dark:text-gray-500">({{ $log->created_at->diffForHumans() }})</span>
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            @if($log->admin)
                                                <span class="font-semibold text-gray-900 dark:text-white">{{ $log->admin->name }}</span>
                                            @else
                                                <span class="font-semibold text-gray-500">Sistem</span>
                                            @endif
                                            <span class="text-gray-500 dark:text-gray-400">→</span>
                                            @if($log->user)
                                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $log->user->name }}</span>
                                                <span class="text-xs text-gray-400 dark:text-gray-500">({{ $log->user->email }})</span>
                                            @else
                                                <span class="text-gray-400 italic">user dihapus</span>
                                            @endif
                                        </p>

                                        <div class="flex items-center gap-3 mt-2 text-xs text-gray-400 dark:text-gray-500">
                                            @if($log->ip_address)
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="fa-solid fa-circle-check w-3.5 h-3.5 flex items-center justify-center"></i>
                                                    {{ $log->ip_address }}
                                                </span>
                                            @endif
                                            @if($log->old_value || $log->new_value)
                                                <span class="inline-flex items-center gap-1 text-indigo-500 dark:text-indigo-400">
                                                    <i class="fa-solid fa-circle-check w-3.5 h-3.5 flex items-center justify-center"></i>
                                                    Klik untuk detail
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Expand arrow -->
                                    @if($log->old_value || $log->new_value)
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fa-solid fa-chevron-down w-5 h-5 text-gray-400 transition-transform duration-200 flex items-center justify-center"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Expanded Details -->
                                @if($log->old_value || $log->new_value)
                                    <div x-show="expanded === {{ $log->id }}" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 -translate-y-2"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         x-cloak
                                         @click.stop
                                         class="mt-4 pt-4 border-t border-gray-100 dark:border-zinc-800">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @if($log->old_value)
                                                <div class="rounded-lg bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-900/30 p-3">
                                                    <div class="flex items-center gap-1.5 mb-2">
                                                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                                        <span class="text-xs font-semibold text-red-600 dark:text-red-400 uppercase tracking-wide">Sebelum</span>
                                                    </div>
                                                    <pre class="text-xs text-red-800 dark:text-red-300 whitespace-pre-wrap break-all font-mono leading-relaxed">{{ is_string($log->old_value) && json_decode($log->old_value) ? json_encode(json_decode($log->old_value), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $log->old_value }}</pre>
                                                </div>
                                            @endif
                                            @if($log->new_value)
                                                <div class="rounded-lg bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200 dark:border-emerald-900/30 p-3">
                                                    <div class="flex items-center gap-1.5 mb-2">
                                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                                        <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wide">Sesudah</span>
                                                    </div>
                                                    <pre class="text-xs text-emerald-800 dark:text-emerald-300 whitespace-pre-wrap break-all font-mono leading-relaxed">{{ is_string($log->new_value) && json_decode($log->new_value) ? json_encode(json_decode($log->new_value), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $log->new_value }}</pre>
                                                </div>
                                            @endif
                                        </div>

                                        @if($log->user_agent)
                                            <div class="mt-3 px-3 py-2 rounded-lg bg-gray-50 dark:bg-zinc-800 text-xs text-gray-500 dark:text-gray-400">
                                                <span class="font-medium text-gray-600 dark:text-gray-300">User Agent:</span> {{ Str::limit($log->user_agent, 120) }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Previous/Next per day -->
                    @if($dailyCount > $perPage)
                        <div class="flex items-center justify-between px-1 pt-2">
                            <button @click="page = Math.max(0, page - 1)" :disabled="page === 0"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition"
                                    :class="page === 0 ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700'">
                                <i class="fa-solid fa-chevron-left w-3.5 h-3.5 flex items-center justify-center"></i>
                                Previous
                            </button>
                            <span class="text-xs text-gray-400 dark:text-gray-500">
                                Halaman <span x-text="page + 1"></span> dari {{ $totalPages }}
                            </span>
                            <button @click="page = Math.min({{ $totalPages - 1 }}, page + 1)" :disabled="page >= {{ $totalPages - 1 }}"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg transition"
                                    :class="page >= {{ $totalPages - 1 }} ? 'text-gray-300 dark:text-gray-600 cursor-not-allowed' : 'text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700'">
                                Next
                                <i class="fa-solid fa-chevron-right w-3.5 h-3.5 flex items-center justify-center"></i>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-800 p-12 text-center">
            <div class="mx-auto w-16 h-16 rounded-full bg-gray-100 dark:bg-zinc-800 flex items-center justify-center mb-4">
                <i class="fa-solid fa-circle-check w-8 h-8 text-gray-400 flex items-center justify-center"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Belum ada aktivitas</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                @if(request()->hasAny(['search', 'action', 'date_from', 'date_to', 'preset']))
                    Tidak ditemukan log yang sesuai dengan filter. 
                    <a href="{{ route('admin.audit-log.index') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Reset filter</a>
                @else
                    Aktivitas sistem akan tercatat otomatis di sini.
                @endif
            </p>
        </div>
    @endif
</div>

{{-- Flatpickr JS --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDark = document.documentElement.classList.contains('dark');
        const config = {
            locale: 'id',
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'j F Y',
            maxDate: 'today',
            disableMobile: true,
            theme: isDark ? 'dark' : 'light',
        };

        const fromEl = document.getElementById('flatpickr-from');
        const toEl = document.getElementById('flatpickr-to');

        if (fromEl) flatpickr(fromEl, config);
        if (toEl) flatpickr(toEl, config);
    });
</script>
</x-admin-layout>
