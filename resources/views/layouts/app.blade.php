<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset(App\Models\SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- SweetAlert2 for Error Handling UI -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Dark Mode Init -->
        <script>
            if (localStorage.getItem('theme') === 'light') {
                document.documentElement.classList.remove('dark');
            } else {
                document.documentElement.classList.add('dark');
            }
        </script>

        <style>
            /* Custom Scrollbar for Sidebar */
            aside::-webkit-scrollbar { width: 4px; }
            aside::-webkit-scrollbar-track { background: transparent; }
            aside::-webkit-scrollbar-thumb { background: #334155; border-radius: 2px; }
            aside:hover::-webkit-scrollbar-thumb { background: #475569; }

            body { transition: background-color 0.3s ease, color 0.3s ease; }

            /* =========================================
               PREMIUM AMOLED DARK MODE - User Panel
               ========================================= */

            /* --- Page & Surface Backgrounds --- */
            .dark .bg-gray-100 { background-color: #000000; }
            .dark .bg-gray-50 { background-color: #0a0a0a; }
            .dark .bg-white { background-color: #111111; }
            .dark .bg-slate-50 { background-color: #0a0a0a; }
            .dark .bg-gray-50\/50 { background-color: rgba(10, 10, 10, 0.8); }

            /* --- Text: High contrast hierarchy --- */
            .dark .text-gray-900 { color: #f5f5f5; }
            .dark .text-gray-800 { color: #e5e5e5; }
            .dark .text-gray-700 { color: #d4d4d4; }
            .dark .text-gray-600 { color: #a3a3a3; }
            .dark .text-gray-500 { color: #858585; }
            .dark .text-gray-400 { color: #6b6b6b; }
            .dark .text-gray-300 { color: #525252; }
            .dark .text-slate-800 { color: #f5f5f5; }
            .dark .text-slate-700 { color: #e5e5e5; }
            .dark .text-slate-600 { color: #a3a3a3; }
            .dark .text-slate-500 { color: #858585; }
            .dark .text-slate-400 { color: #737373; }

            /* --- Borders --- */
            .dark .border-gray-300 { border-color: #2a2a2a; }
            .dark .border-gray-200 { border-color: #1e1e1e; }
            .dark .border-gray-100 { border-color: #1a1a1a; }
            .dark .border-slate-200 { border-color: #1e1e1e; }
            .dark .border-slate-200\/50 { border-color: rgba(30, 30, 30, 0.5); }
            .dark .border-slate-100 { border-color: #1a1a1a; }
            .dark .border-sky-100\/50 { border-color: #1a1a1a; }
            .dark .border-white\/50 { border-color: rgba(40, 40, 40, 0.5); }

            /* Accent borders */
            .dark .border-blue-100 { border-color: rgba(59, 130, 246, 0.25); }
            .dark .border-blue-200 { border-color: rgba(59, 130, 246, 0.2); }
            .dark .border-green-100 { border-color: rgba(16, 185, 129, 0.25); }
            .dark .border-green-200 { border-color: rgba(16, 185, 129, 0.2); }
            .dark .border-emerald-100 { border-color: rgba(16, 185, 129, 0.25); }
            .dark .border-emerald-200 { border-color: rgba(16, 185, 129, 0.2); }
            .dark .border-teal-100 { border-color: rgba(20, 184, 166, 0.25); }
            .dark .border-indigo-100 { border-color: rgba(99, 102, 241, 0.25); }
            .dark .border-purple-100 { border-color: rgba(168, 85, 247, 0.25); }
            .dark .border-purple-200 { border-color: rgba(168, 85, 247, 0.2); }
            .dark .border-amber-100 { border-color: rgba(245, 158, 11, 0.25); }
            .dark .border-amber-200 { border-color: rgba(245, 158, 11, 0.2); }
            .dark .border-amber-300 { border-color: rgba(245, 158, 11, 0.35); }
            .dark .border-orange-100 { border-color: rgba(249, 115, 22, 0.25); }
            .dark .border-red-100 { border-color: rgba(239, 68, 68, 0.25); }
            .dark .border-pink-100 { border-color: rgba(236, 72, 153, 0.25); }

            /* Dividers */
            .dark .divide-gray-100 > :not([hidden]) ~ :not([hidden]) { border-color: #1e1e1e; }
            .dark .divide-gray-200 > :not([hidden]) ~ :not([hidden]) { border-color: #1e1e1e; }
            .dark .divide-sky-100 > :not([hidden]) ~ :not([hidden]) { border-color: #1e1e1e; }
            .dark .divide-slate-100 > :not([hidden]) ~ :not([hidden]) { border-color: #1e1e1e; }

            /* --- Shadows --- */
            .dark .shadow-sm { box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.5); }
            .dark .shadow { box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.6); }
            .dark .shadow-md { box-shadow: 0 6px 16px -2px rgba(0, 0, 0, 0.7); }
            .dark .shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.8); }
            .dark .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.9); }
            .dark .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.7); }

            /* --- Inputs --- */
            .dark input, .dark select, .dark textarea {
                background-color: #0a0a0a;
                border-color: #2a2a2a;
                color: #f5f5f5;
            }
            .dark input:focus, .dark select:focus, .dark textarea:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            }
            .dark input::placeholder, .dark textarea::placeholder {
                color: #525252;
            }

            /* --- Tables --- */
            .dark table thead { background-color: #0a0a0a; }
            .dark table tbody { background-color: #111111; }
            .dark table tbody tr { border-color: #1e1e1e; }
            .dark table tbody tr:hover { background-color: rgba(59, 130, 246, 0.06); }
            .dark .hover\:bg-gray-50:hover { background-color: rgba(59, 130, 246, 0.06); }
            .dark .hover\:bg-blue-50\/50:hover { background-color: rgba(59, 130, 246, 0.08); }

            /* --- Accent Backgrounds --- */
            .dark .bg-blue-50 { background-color: rgba(59, 130, 246, 0.12); }
            .dark .bg-blue-100 { background-color: rgba(59, 130, 246, 0.18); }
            .dark .bg-sky-50 { background-color: rgba(14, 165, 233, 0.12); }
            .dark .bg-cyan-50 { background-color: rgba(6, 182, 212, 0.12); }
            .dark .bg-green-50 { background-color: rgba(16, 185, 129, 0.12); }
            .dark .bg-green-100 { background-color: rgba(16, 185, 129, 0.18); }
            .dark .bg-emerald-50 { background-color: rgba(16, 185, 129, 0.12); }
            .dark .bg-emerald-100 { background-color: rgba(16, 185, 129, 0.18); }
            .dark .bg-teal-50 { background-color: rgba(20, 184, 166, 0.12); }
            .dark .bg-indigo-50 { background-color: rgba(99, 102, 241, 0.12); }
            .dark .bg-indigo-100 { background-color: rgba(99, 102, 241, 0.18); }
            .dark .bg-purple-50 { background-color: rgba(168, 85, 247, 0.12); }
            .dark .bg-purple-100 { background-color: rgba(168, 85, 247, 0.18); }
            .dark .bg-violet-50 { background-color: rgba(139, 92, 246, 0.12); }
            .dark .bg-amber-50 { background-color: rgba(245, 158, 11, 0.12); }
            .dark .bg-amber-100 { background-color: rgba(245, 158, 11, 0.18); }
            .dark .bg-orange-50 { background-color: rgba(249, 115, 22, 0.12); }
            .dark .bg-red-50 { background-color: rgba(239, 68, 68, 0.12); }
            .dark .bg-red-100 { background-color: rgba(239, 68, 68, 0.18); }
            .dark .bg-pink-50 { background-color: rgba(236, 72, 153, 0.12); }
            .dark .bg-rose-50 { background-color: rgba(244, 63, 94, 0.12); }
            .dark .bg-slate-100 { background-color: rgba(255, 255, 255, 0.08); }

            /* Compound accent backgrounds */
            .dark .bg-blue-50\/50 { background-color: rgba(59, 130, 246, 0.08); }
            .dark .bg-purple-50\/50 { background-color: rgba(168, 85, 247, 0.08); }
            .dark .bg-emerald-50\/50 { background-color: rgba(16, 185, 129, 0.08); }
            .dark .bg-teal-50\/50 { background-color: rgba(20, 184, 166, 0.08); }
            .dark .bg-amber-50\/50 { background-color: rgba(245, 158, 11, 0.08); }

            /* --- Accent Text (brighter on dark) --- */
            .dark .text-green-700 { color: #6ee7b7; }
            .dark .text-green-800 { color: #6ee7b7; }
            .dark .text-green-600 { color: #34d399; }
            .dark .text-emerald-700 { color: #6ee7b7; }
            .dark .text-emerald-800 { color: #6ee7b7; }
            .dark .text-emerald-600 { color: #34d399; }
            .dark .text-teal-600 { color: #2dd4bf; }
            .dark .text-blue-600 { color: #60a5fa; }
            .dark .text-blue-700 { color: #93bbfd; }
            .dark .text-indigo-600 { color: #a5b4fc; }
            .dark .text-indigo-700 { color: #a5b4fc; }
            .dark .text-purple-600 { color: #c4b5fd; }
            .dark .text-purple-700 { color: #c4b5fd; }
            .dark .text-pink-700 { color: #f9a8d4; }
            .dark .text-pink-600 { color: #f472b6; }
            .dark .text-amber-600 { color: #fbbf24; }
            .dark .text-amber-700 { color: #fcd34d; }
            .dark .text-amber-900 { color: #fbbf24; }
            .dark .text-orange-600 { color: #fb923c; }
            .dark .text-red-600 { color: #fca5a5; }
            .dark .text-red-700 { color: #fca5a5; }
            .dark .text-cyan-600 { color: #22d3ee; }

            /* --- Gradient overrides --- */
            .dark .from-slate-50 { --tw-gradient-from: #0a0a0a; }
            .dark .to-gray-50 { --tw-gradient-to: #111111; }
            .dark .from-slate-100 { --tw-gradient-from: #0f0f0f; }
            .dark .to-slate-50 { --tw-gradient-to: #0a0a0a; }

            /* --- Rings --- */
            .dark .ring-sky-50 { --tw-ring-color: rgba(56, 189, 248, 0.15); }
            .dark .ring-blue-50 { --tw-ring-color: rgba(59, 130, 246, 0.15); }
            .dark .ring-blue-100 { --tw-ring-color: rgba(59, 130, 246, 0.2); }
            .dark .ring-cyan-50 { --tw-ring-color: rgba(34, 211, 238, 0.15); }
            .dark .ring-emerald-50 { --tw-ring-color: rgba(16, 185, 129, 0.15); }
            .dark .ring-amber-50 { --tw-ring-color: rgba(245, 158, 11, 0.15); }
            .dark .ring-sky-100 { --tw-ring-color: rgba(56, 189, 248, 0.2); }
            .dark .ring-white { --tw-ring-color: rgba(40, 40, 40, 0.5); }

            /* --- Hover Interactions --- */
            .dark .hover\:bg-blue-100:hover { background-color: rgba(59, 130, 246, 0.22); }
            .dark .hover\:bg-gray-200:hover { background-color: rgba(255, 255, 255, 0.1); }
            .dark .hover\:bg-gray-50:hover { background-color: rgba(255, 255, 255, 0.04); }
            .dark .hover\:bg-gray-300:hover { background-color: rgba(255, 255, 255, 0.12); }
            .dark .hover\:text-blue-700:hover { color: #93bbfd; }

            /* --- Glassmorphism --- */
            .dark .bg-white\/60 { background-color: rgba(17, 17, 17, 0.6); }
            .dark .bg-white\/80 { background-color: rgba(17, 17, 17, 0.8); }

            /* --- Pagination --- */
            .dark nav[role="navigation"] span, 
            .dark nav[role="navigation"] a {
                color: #a3a3a3;
                border-color: #2a2a2a;
            }
            .dark nav[role="navigation"] span[aria-current="page"] > span {
                background-color: rgba(59, 130, 246, 0.2);
                color: #60a5fa;
                border-color: rgba(59, 130, 246, 0.3);
            }
            .dark nav[role="navigation"] a:hover {
                background-color: rgba(255, 255, 255, 0.06);
                color: #f5f5f5;
            }

            /* --- Modals --- */
            .dark .bg-gray-500.bg-opacity-75 { background-color: rgba(0, 0, 0, 0.8); }
            .dark .bg-gray-900.bg-opacity-75 { background-color: rgba(0, 0, 0, 0.85); }

            /* --- Mobile header --- */
            .dark header.bg-white { background-color: #111111; }

            /* ✨ Premium Dark Mode Animations ✨ */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-15px); }
            }
            @keyframes sway {
                0%, 100% { transform: translateX(0px) rotate(0deg); }
                50% { transform: translateX(10px) rotate(1deg); }
            }
            @keyframes pulse-ring {
                0% { opacity: 0.6; transform: scale(1); }
                50% { opacity: 0.3; transform: scale(1.05); }
                100% { opacity: 0.6; transform: scale(1); }
            }
            @keyframes sparkle {
                0%, 100% { opacity: 0.3; transform: scale(0.8); }
                50% { opacity: 1; transform: scale(1.2); }
            }
            @keyframes glow-pulse {
                0%, 100% { opacity: 0.15; filter: blur(40px); }
                50% { opacity: 0.3; filter: blur(50px); }
            }

            /* ✨ Error Handling Animations ✨ */
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
                20%, 40%, 60%, 80% { transform: translateX(4px); }
            }
            .animate-shake {
                animation: shake 0.5s ease-in-out;
            }
            @keyframes error-pulse {
                0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4); }
                50% { box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15); }
            }
            .field-has-error {
                border-color: #ef4444 !important;
                background-color: rgba(239, 68, 68, 0.04) !important;
                animation: error-pulse 2s ease-in-out 1;
            }
            .dark .field-has-error {
                border-color: #f87171 !important;
                background-color: rgba(239, 68, 68, 0.08) !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-black transition-colors duration-300">
        <div x-data="{ 
            sidebarOpen: false, 
            sidebarCollapsed: localStorage.getItem('userSidebarCollapsed') !== 'false',
            toggleCollapse() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('userSidebarCollapsed', this.sidebarCollapsed);
            }
        }" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            <aside class="flex flex-col flex-shrink-0 bg-slate-900 dark:bg-zinc-950 border-r border-slate-800 dark:border-zinc-900 transition-all duration-300 ease-in-out transform md:translate-x-0 fixed z-30 h-full"
                   :class="{
                       'translate-x-0': sidebarOpen, 
                       '-translate-x-full': !sidebarOpen,
                       'w-64': !sidebarCollapsed,
                       'w-16': sidebarCollapsed
                   }">
                
                <!-- Logo -->
                <div class="flex items-center h-20 bg-slate-950 dark:bg-black border-b border-slate-800 dark:border-zinc-900 px-4 overflow-hidden">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset(App\Models\SiteSetting::get('global_logo', 'images/logo-pekanbaru.png')) }}" alt="Logo" class="h-11 w-11 object-contain drop-shadow-lg flex-shrink-0">
                        <div class="flex flex-col transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                            <span class="text-lg font-black tracking-wide uppercase whitespace-nowrap leading-tight bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent">{{ App\Models\SiteSetting::get('global_app_name', 'SIDATA') }}</span>
                            <div class="w-12 h-px bg-gradient-to-r from-blue-500/60 to-transparent mt-1 mb-1"></div>
                            <span class="text-slate-400 text-[8.5px] uppercase tracking-[0.12em] font-semibold whitespace-nowrap leading-tight">{{ App\Models\SiteSetting::get('global_app_description', 'Sistem Informasi Data Terpadu') }}</span>
                            <span class="text-slate-500/80 text-[8px] uppercase tracking-[0.1em] font-medium whitespace-nowrap mt-0.5 leading-tight">{{ App\Models\SiteSetting::get('global_org_name', 'Pemerintah Kota Pekanbaru') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="space-y-1 px-2">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Dashboard">
                            <i class="fa-solid fa-chart-pie text-lg flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3 w-5 text-center'"></i>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Dashboard</span>
                        </a>

                        <!-- Daftar Aplikasi -->
                        <a href="{{ route('web-apps.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('web-apps.*') ? 'bg-gradient-to-r from-blue-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Daftar Aplikasi">
                            <i class="fa-solid fa-layer-group text-lg flex-shrink-0 {{ request()->routeIs('web-apps.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3 w-5 text-center'"></i>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Daftar Aplikasi</span>
                        </a>

                        <!-- Monitoring (Dropdown) -->
                        <div x-data="{ open: {{ request()->routeIs('monitoring.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" 
                                    class="w-full group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('monitoring.*') ? 'bg-gradient-to-r from-cyan-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                                    :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                                <i class="fa-solid fa-chart-line text-lg flex-shrink-0 {{ request()->routeIs('monitoring.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3 w-5 text-center'"></i>
                                <span class="flex-1 text-left transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Monitoring</span>
                                <i x-show="!sidebarCollapsed" class="fa-solid fa-chevron-down text-sm transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Sub-menu -->
                            <div x-show="open && !sidebarCollapsed" x-collapse class="ml-4 mt-1 space-y-1 border-l border-slate-700/50 dark:border-zinc-800/50 pl-3">
                                <a href="{{ route('monitoring.index') }}" 
                                   class="block px-3 py-2 text-xs font-medium rounded-md transition-colors {{ request()->routeIs('monitoring.index') ? 'bg-cyan-600/20 text-cyan-400' : 'text-slate-400 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}">
                                    Ringkasan
                                </a>
                                <a href="{{ route('monitoring.health-check') }}" 
                                   class="block px-3 py-2 text-xs font-medium rounded-md transition-colors {{ request()->routeIs('monitoring.health-check') ? 'bg-cyan-600/20 text-cyan-400' : 'text-slate-400 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}">
                                    Cek Status
                                </a>
                            </div>
                        </div>

                        <!-- Profil Saya -->
                        <a href="{{ route('profile.edit') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-blue-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Profil Saya">
                            <i class="fa-solid fa-user-pen text-lg flex-shrink-0 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3 w-5 text-center'"></i>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Profil Saya</span>
                        </a>
                    </nav>
                </div>

                <!-- Collapse Toggle Button -->
                <div class="px-2 py-2 border-t border-slate-800 dark:border-zinc-900 hidden md:block">
                    <button @click="toggleCollapse()" 
                            class="w-full flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 dark:hover:bg-zinc-900 transition-all duration-200"
                            :title="sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
                        <i class="fa-solid fa-angles-left text-lg transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''"></i>
                    </button>
                </div>

                <!-- User Profile & Logout (Sidebar Footer) -->
                <div class="border-t border-slate-800 dark:border-zinc-900 bg-slate-950 dark:bg-black transition-all duration-300" :class="sidebarCollapsed ? 'p-1.5' : 'p-3'">
                    <!-- Dark Mode Toggle (Sidebar) -->
                    <button id="theme-toggle" type="button" class="w-full flex items-center py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 dark:hover:bg-zinc-900 border border-transparent hover:border-slate-700 dark:hover:border-zinc-800 transition-all duration-200 mb-2" :class="sidebarCollapsed ? 'justify-center px-2' : 'gap-2 px-4'">
                        <i id="theme-toggle-dark-icon" class="hidden fa-solid fa-moon text-base"></i>
                        <i id="theme-toggle-light-icon" class="hidden fa-solid fa-sun text-base text-amber-400"></i>
                        <span id="theme-toggle-text" class="text-sm font-medium transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Mode Gelap</span>
                    </button>

                    <!-- User Profile Card (Clickable to Profile) -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center rounded-xl bg-gradient-to-r from-blue-500/10 to-blue-600/5 border border-blue-500/20 mb-2 hover:bg-blue-500/20 transition-all overflow-hidden" :class="sidebarCollapsed ? 'justify-center p-1.5' : 'gap-3 p-2.5'">
                        <!-- Avatar with Photo or Gradient -->
                        <div class="relative flex-shrink-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="rounded-xl object-cover ring-2 ring-blue-500/30 shadow-lg" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
                            @else
                                <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 ring-2 ring-blue-500/30 shadow-lg flex items-center justify-center" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
                                    <i class="fa-solid fa-user text-white" :class="sidebarCollapsed ? 'text-xs' : 'text-lg'"></i>
                                </div>
                            @endif
                        </div>
                        <!-- User Info -->
                        <div class="flex-1 min-w-0 transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                            <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] text-slate-400 leading-tight">{{ Auth::user()->opd->nama_opd ?? 'OPD' }}</p>
                        </div>
                    </a>
                    
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-red-500/20 border border-transparent hover:border-red-500/30 transition-all duration-200" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-center gap-2 px-4'">
                            <i class="fa-solid fa-right-from-bracket text-base" :class="sidebarCollapsed ? '' : 'mr-2'"></i>
                            <span class="text-sm font-medium transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Wrapper -->
            <div class="flex-1 flex flex-col min-w-0 bg-gray-100 transition-all duration-300 ease-in-out" :class="sidebarCollapsed ? 'md:ml-16' : 'md:ml-64'">
                
                <!-- Mobile Header (Hamburger Only) -->
                <header class="bg-white shadow md:hidden">
                    <div class="flex items-center px-4 py-3 h-14">
                        <!-- Mobile Hamburger -->
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 rounded-md p-1">
                            <i class="fa-solid fa-bars text-xl"></i>
                        </button>
                        <span class="ml-3 text-sm font-medium text-gray-600">Menu</span>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-auto relative">
                    <div class="p-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>

            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"></div>
        </div>

        <!-- Health Check Floating Widget -->
        <x-health-check-widget />

        <script>
            // Dark Mode Toggle Logic
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            const themeToggleText = document.getElementById('theme-toggle-text');

            function updateThemeUI() {
                if (document.documentElement.classList.contains('dark')) {
                    if(themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
                    if(themeToggleDarkIcon) themeToggleDarkIcon.classList.add('hidden');
                    if(themeToggleText) themeToggleText.textContent = 'Mode Terang';
                } else {
                    if(themeToggleLightIcon) themeToggleLightIcon.classList.add('hidden');
                    if(themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
                    if(themeToggleText) themeToggleText.textContent = 'Mode Gelap';
                }
            }

            updateThemeUI();

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function() {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                    updateThemeUI();
                });
            }
        </script>

        {{-- ✨ Global Validation Error & Flash Message Handler ✨ --}}
        @if($errors->any())
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Build error list HTML with icons
            const errorMessages = @json($errors->all());
            const errorKeys = @json($errors->keys());
            
            let errorListHtml = '<div style="text-align:left; max-height: 300px; overflow-y: auto; padding: 0 8px;">';
            errorMessages.forEach(function(msg, i) {
                errorListHtml += `
                    <div style="display:flex; align-items:flex-start; gap:10px; padding:10px 12px; margin-bottom:8px; background: rgba(239,68,68,0.06); border-left: 3px solid #ef4444; border-radius: 0 8px 8px 0;">
                        <span style="color:#ef4444; font-size:16px; flex-shrink:0; margin-top:1px;">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                        <span style="color:#64748b; font-size:14px; line-height:1.5;">${msg}</span>
                    </div>
                `;
            });
            errorListHtml += '</div>';

            // Show centered SweetAlert2 popup
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                icon: 'error',
                title: '<span style="font-size:20px; font-weight:700;">Data Belum Lengkap!</span>',
                html: `
                    <p style="color:#94a3b8; font-size:14px; margin-bottom:16px;">
                        Mohon lengkapi <strong style="color:#ef4444;">${errorMessages.length} isian</strong> berikut sebelum menyimpan:
                    </p>
                    ${errorListHtml}
                `,
                confirmButtonText: '<i class="fa-solid fa-arrow-down mr-2"></i> Perbaiki Sekarang',
                confirmButtonColor: '#3b82f6',
                background: isDark ? '#18181b' : '#ffffff',
                color: isDark ? '#f5f5f5' : '#1e293b',
                backdrop: 'rgba(0,0,0,0.6)',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp animate__faster'
                },
                customClass: {
                    popup: 'rounded-2xl shadow-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-semibold text-sm',
                },
                width: '520px',
                padding: '2em 1.5em',
            }).then(function() {
                // After closing popup, scroll to first error field
                scrollToFirstError();
            });

            // Highlight all error fields with red border + pulse
            errorKeys.forEach(function(fieldName) {
                // Try to find by name attribute
                let field = document.querySelector(`[name="${fieldName}"]`);
                // Try by ID as fallback
                if (!field) {
                    field = document.getElementById(fieldName);
                }
                // Try common variations (e.g. search input that maps to hidden field)
                if (!field) {
                    field = document.querySelector(`[name="${fieldName}_search"]`) ||
                            document.getElementById(`${fieldName}_search`);
                }
                if (field) {
                    field.classList.add('field-has-error');
                    // Also highlight parent wrapper if it's a custom component
                    const wrapper = field.closest('.relative');
                    if (wrapper) {
                        const customInput = wrapper.querySelector('input, select, textarea');
                        if (customInput && customInput !== field) {
                            customInput.classList.add('field-has-error');
                        }
                    }
                }
            });

            function scrollToFirstError() {
                // Find the first visible error message element
                const firstError = document.querySelector('.field-has-error');
                if (firstError) {
                    const scrollContainer = document.querySelector('main.overflow-auto') || window;
                    const rect = firstError.getBoundingClientRect();
                    
                    if (scrollContainer !== window && scrollContainer) {
                        const containerRect = scrollContainer.getBoundingClientRect();
                        const scrollTop = scrollContainer.scrollTop + (rect.top - containerRect.top) - 120;
                        scrollContainer.scrollTo({ top: scrollTop, behavior: 'smooth' });
                    } else {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    
                    // Focus the field
                    setTimeout(function() {
                        firstError.focus();
                    }, 600);
                }
            }

            // Remove error highlight when user starts typing/interacting
            document.querySelectorAll('.field-has-error').forEach(function(field) {
                const events = ['input', 'change', 'focus'];
                events.forEach(function(evt) {
                    field.addEventListener(evt, function() {
                        this.classList.remove('field-has-error');
                    }, { once: true });
                });
            });
        });
        </script>
        @endif

        {{-- Flash Success Message --}}
        @if(session('success'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                icon: 'success',
                title: '<span style="font-size:20px; font-weight:700;">Berhasil!</span>',
                html: '<p style="color:#94a3b8; font-size:14px;">{{ session("success") }}</p>',
                confirmButtonText: 'Oke, Mengerti',
                confirmButtonColor: '#10b981',
                background: isDark ? '#18181b' : '#ffffff',
                color: isDark ? '#f5f5f5' : '#1e293b',
                backdrop: 'rgba(0,0,0,0.4)',
                timer: 4000,
                timerProgressBar: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown animate__faster'
                },
                customClass: {
                    popup: 'rounded-2xl shadow-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-semibold text-sm',
                },
                width: '420px',
            });
        });
        </script>
        @endif

        {{-- Flash Error Message --}}
        @if(session('error'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                icon: 'error',
                title: '<span style="font-size:20px; font-weight:700;">Terjadi Kesalahan</span>',
                html: '<p style="color:#94a3b8; font-size:14px;">{{ session("error") }}</p>',
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#ef4444',
                background: isDark ? '#18181b' : '#ffffff',
                color: isDark ? '#f5f5f5' : '#1e293b',
                backdrop: 'rgba(0,0,0,0.5)',
                customClass: {
                    popup: 'rounded-2xl shadow-2xl',
                    confirmButton: 'rounded-xl px-6 py-2.5 font-semibold text-sm',
                },
                width: '420px',
            });
        });
        </script>
        @endif
    </body>
</html>
