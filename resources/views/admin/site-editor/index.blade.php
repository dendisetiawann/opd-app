<x-admin-layout>
    <div x-data="siteEditor()" class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <div class="p-2.5 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fa-solid fa-pen-to-square w-6 h-6 text-white flex items-center justify-center"></i>
                        </div>
                        Editor Situs
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">Kelola dan edit konten semua halaman situs dari satu tempat.</p>
                </div>
            </div>
        </div>

        {{-- Success Toast --}}
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
             x-transition:enter="transform ease-out duration-300 transition" x-transition:enter-start="translate-y-2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed top-6 right-6 z-50 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-xl shadow-lg">
            <div class="p-1 bg-emerald-100 rounded-full">
                <i class="fa-solid fa-check w-5 h-5 text-emerald-600 flex items-center justify-center"></i>
            </div>
            <span class="font-semibold text-sm">{{ session('success') }}</span>
        </div>
        @endif

        {{-- Page Tabs --}}
        <div class="mb-6">
            <div class="flex flex-wrap gap-2">
                @foreach($pages as $pageKey => $page)
                <button type="button" @click="activePage = '{{ $pageKey }}'"
                        :class="activePage === '{{ $pageKey }}' ? '{{ $page['activeClass'] }} shadow-md scale-[1.02]' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:border-gray-300'"
                        class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl text-sm font-semibold border transition-all duration-200">
                    <i class="fa-solid fa-circle-check w-4.5 h-4.5 flex items-center justify-center"></i>
                    {{ $page['title'] }}
                </button>
                @endforeach
            </div>
        </div>

        {{-- Main Editor Layout --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            
            {{-- LEFT: Editor Form --}}
            <div class="xl:col-span-2">
                <form action="{{ route('admin.site-editor.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    @foreach($pages as $pageKey => $page)
                    <div x-show="activePage === '{{ $pageKey }}'" x-cloak>
                        {{-- Page Info Banner --}}
                        <div class="flex items-center gap-3 mb-5 px-1">
                            <div class="p-2 rounded-lg {{ $page['bannerClass'] }}">
                                <i class="fa-solid fa-circle-check w-5 h-5 flex items-center justify-center"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">{{ $page['title'] }}</h2>
                                <p class="text-xs text-gray-500">{{ $page['description'] }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach($page['sections'] as $sectionKey => $section)
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                                {{-- Section Header (Collapsible) --}}
                                <button type="button" @click="toggleSection('{{ $sectionKey }}')" 
                                        class="w-full flex items-center justify-between px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 rounded-lg {{ $section['colorClass'] }}">
                                            <i class="fa-solid fa-circle-check w-4 h-4 flex items-center justify-center"></i>
                                        </div>
                                        <div class="text-left">
                                            <h3 class="text-sm font-bold text-gray-900">{{ $section['title'] }}</h3>
                                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $section['description'] }}</p>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-chevron-down w-4 h-4 text-gray-400 transition-transform duration-300 flex items-center justify-center"></i>
                                </button>

                                {{-- Section Content --}}
                                <div x-show="openSections.includes('{{ $sectionKey }}')" x-collapse>
                                    <div class="px-6 pb-6 border-t border-gray-100">
                                        <div class="space-y-4 pt-5">
                                            @foreach($section['settings'] as $setting)
                                            <div>
                                                <label for="setting_{{ $setting->key }}" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                                    {{ $setting->label }}
                                                    <span class="text-[10px] font-mono text-gray-400 ml-2">{{ $setting->key }}</span>
                                                </label>
                                                
                                                @if($setting->type === 'textarea')
                                                    <textarea id="setting_{{ $setting->key }}" 
                                                              name="settings[{{ $setting->key }}]" 
                                                              rows="3"
                                                              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none bg-gray-50/50 hover:bg-white">{{ $setting->value }}</textarea>
                                                @elseif($setting->type === 'image')
                                                    <div class="flex items-center gap-4">
                                                        @if($setting->value)
                                                            <img src="{{ asset($setting->value) }}" alt="{{ $setting->label }}" class="h-16 w-16 object-cover rounded-xl border border-gray-200">
                                                        @else
                                                            <div class="h-16 w-16 bg-gray-100 rounded-xl border border-gray-200 flex items-center justify-center">
                                                                <i class="fa-regular fa-image w-6 h-6 text-gray-400 flex items-center justify-center"></i>
                                                            </div>
                                                        @endif
                                                        <button type="button" @click="openImageUpload('{{ $setting->key }}')" 
                                                                class="px-4 py-2 text-sm font-medium bg-white border border-gray-200 rounded-xl text-gray-700 hover:bg-gray-50 transition-all">
                                                            Upload Gambar
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                                                @else
                                                    <input type="text" 
                                                           id="setting_{{ $setting->key }}" 
                                                           name="settings[{{ $setting->key }}]" 
                                                           value="{{ $setting->value }}"
                                                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-gray-50/50 hover:bg-white">
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    {{-- Save Button --}}
                    <div class="mt-6 flex items-center gap-4">
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-8 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/25 transition-all hover:shadow-xl hover:shadow-blue-500/30 hover:-translate-y-0.5 active:translate-y-0">
                            <i class="fa-solid fa-circle-check w-5 h-5 flex items-center justify-center"></i>
                            Simpan Semua Perubahan
                        </button>
                        <span class="text-xs text-gray-400">Perubahan akan langsung terlihat di halaman terkait</span>
                    </div>
                </form>
            </div>

            {{-- RIGHT: Page Preview Panel --}}
            <div class="hidden xl:block">
                <div class="sticky top-6 space-y-4">
                    {{-- Live Preview Card --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        {{-- Browser Chrome --}}
                        <div class="flex items-center gap-2 px-4 py-3 bg-gray-50 border-b border-gray-100">
                            <div class="flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <span class="text-xs text-gray-400 ml-2">Preview</span>
                        </div>

                        {{-- Preview Content --}}
                        <div class="relative" style="height: calc(100vh - 220px); min-height: 480px;">
                            
                            {{-- Global tab: Logo & Favicon info --}}
                            <div x-show="activePage === 'global'" class="absolute inset-0 flex items-center justify-center p-6">
                                <div class="space-y-5 w-full max-w-xs">
                                    <div class="text-center space-y-3">
                                        <div class="mx-auto w-20 h-20 bg-indigo-50 rounded-2xl flex items-center justify-center">
                                            <i class="fa-regular fa-image w-10 h-10 text-indigo-400 flex items-center justify-center"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-800">Logo & Favicon</h3>
                                        <p class="text-xs text-gray-400">Gambar ini muncul di semua halaman — header, sidebar, dan tab browser.</p>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                            <div class="w-10 h-10 bg-white rounded-lg border border-gray-200 flex items-center justify-center"><img src="{{ asset(App\Models\SiteSetting::get('global_logo', 'images/logo-pekanbaru.png')) }}" class="w-7 h-7 object-contain"></div>
                                            <div><p class="text-sm font-semibold text-gray-700">Logo</p><p class="text-xs text-gray-400">Header & Sidebar</p></div>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                            <div class="w-10 h-10 bg-white rounded-lg border border-gray-200 flex items-center justify-center"><img src="{{ asset(App\Models\SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) }}" class="w-7 h-7 object-contain"></div>
                                            <div><p class="text-sm font-semibold text-gray-700">Favicon</p><p class="text-xs text-gray-400">Browser Tab</p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Real iframe preview for other pages --}}
                            <div x-show="activePage !== 'global'" class="absolute inset-0">
                                {{-- Non-clickable overlay: blocks clicks, forwards scroll to iframe --}}
                                <div class="absolute inset-0 z-10" style="cursor: default;"
                                     @wheel.prevent="if($refs.previewFrame && $refs.previewFrame.contentWindow) { try { $refs.previewFrame.contentWindow.scrollBy(0, $event.deltaY) } catch(e){} }"></div>
                                {{-- Scaled iframe --}}
                                <iframe x-ref="previewFrame" 
                                        x-effect="if(activePage !== 'global') $refs.previewFrame.src = '{{ url('/admin/site-editor/preview') }}/' + activePage"
                                        class="w-full h-full border-0" 
                                        style="transform: scale(0.35); transform-origin: top left; width: 285.71%; height: 285.71%;"
                                        sandbox="allow-same-origin allow-scripts"></iframe>
                            </div>
                        </div>
                    </div>

                    {{-- Page Info --}}
                    <p class="text-center text-xs text-gray-400">Preview hanya-baca — Simpan untuk memperbarui</p>


                </div>
            </div>
        </div>

        {{-- Image Upload Modal --}}
        <div x-show="showImageModal" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showImageModal = false"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6" @click.stop>
                <h3 class="text-lg font-bold text-gray-900 mb-4">Upload Gambar</h3>
                <form action="{{ route('admin.site-editor.upload-image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="key" x-model="imageUploadKey">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Gambar</label>
                        <input type="file" name="image" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP atau SVG. Max 2MB.</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all text-sm">Upload</button>
                        <button type="button" @click="showImageModal = false" class="py-2.5 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function siteEditor() {
            return {
                activePage: 'global',
                openSections: @json($defaultOpenSections),
                showImageModal: false,
                imageUploadKey: '',
                
                toggleSection(key) {
                    const idx = this.openSections.indexOf(key);
                    if (idx > -1) {
                        this.openSections.splice(idx, 1);
                    } else {
                        this.openSections.push(key);
                    }
                },
                
                openImageUpload(key) {
                    this.imageUploadKey = key;
                    this.showImageModal = true;
                },
            }
        }
    </script>
</x-admin-layout>
