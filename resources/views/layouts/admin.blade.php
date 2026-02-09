<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>
        <link rel="icon" href="{{ asset('images/logo-favicon-192.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Dark Mode Script (before body to prevent flash) -->
        <script>
            if (localStorage.getItem('adminTheme') === 'dark' || (!localStorage.getItem('adminTheme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
            }
        </script>
        
        <style>
            /* Smooth transition for dark mode */
            body { transition: background-color 0.3s ease, color 0.3s ease; }
            
            /* =========================================
               PREMIUM AMOLED DARK MODE - Admin Panel
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

            /* Accent borders → subtle glow */
            .dark .border-blue-100 { border-color: rgba(59, 130, 246, 0.25); }
            .dark .border-blue-200 { border-color: rgba(59, 130, 246, 0.2); }
            .dark .border-blue-200\/50 { border-color: rgba(59, 130, 246, 0.15); }
            .dark .border-green-100 { border-color: rgba(16, 185, 129, 0.25); }
            .dark .border-green-200 { border-color: rgba(16, 185, 129, 0.2); }
            .dark .border-emerald-100 { border-color: rgba(16, 185, 129, 0.25); }
            .dark .border-emerald-200 { border-color: rgba(16, 185, 129, 0.2); }
            .dark .border-emerald-200\/50 { border-color: rgba(16, 185, 129, 0.15); }
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
            .dark .divide-indigo-100 > :not([hidden]) ~ :not([hidden]) { border-color: #1e1e1e; }

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

            /* --- Accent Backgrounds (light tints → translucent on dark) --- */
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
            .dark .bg-slate-50 { background-color: #0a0a0a; }

            /* Compound accent backgrounds */
            .dark .bg-blue-50\/50 { background-color: rgba(59, 130, 246, 0.08); }
            .dark .bg-purple-50\/50 { background-color: rgba(168, 85, 247, 0.08); }
            .dark .bg-emerald-50\/50 { background-color: rgba(16, 185, 129, 0.08); }
            .dark .bg-teal-50\/50 { background-color: rgba(20, 184, 166, 0.08); }
            .dark .bg-amber-50\/50 { background-color: rgba(245, 158, 11, 0.08); }

            /* --- Accent Text on dark (light tint text → brighter) --- */
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
            .dark .text-indigo-800 { color: #c7d2fe; }
            .dark .text-purple-600 { color: #c4b5fd; }
            .dark .text-purple-700 { color: #c4b5fd; }
            .dark .text-violet-600 { color: #c4b5fd; }
            .dark .text-pink-700 { color: #f9a8d4; }
            .dark .text-pink-600 { color: #f472b6; }
            .dark .text-amber-600 { color: #fbbf24; }
            .dark .text-amber-700 { color: #fcd34d; }
            .dark .text-amber-900 { color: #fbbf24; }
            .dark .text-orange-600 { color: #fb923c; }
            .dark .text-red-600 { color: #fca5a5; }
            .dark .text-red-700 { color: #fca5a5; }
            .dark .text-red-800 { color: #fca5a5; }
            .dark .text-cyan-600 { color: #22d3ee; }

            /* --- Gradient Backgrounds used in filter headers --- */
            .dark .bg-gradient-to-r.from-slate-50.to-gray-50 { background: #0a0a0a; }
            .dark .from-slate-50 { --tw-gradient-from: #0a0a0a; }
            .dark .to-gray-50 { --tw-gradient-to: #111111; }
            .dark .from-emerald-50 { --tw-gradient-from: rgba(16, 185, 129, 0.08); }
            .dark .to-teal-50 { --tw-gradient-to: rgba(20, 184, 166, 0.05); }

            /* --- Rings --- */
            .dark .ring-sky-50 { --tw-ring-color: rgba(56, 189, 248, 0.15); }
            .dark .ring-blue-50 { --tw-ring-color: rgba(59, 130, 246, 0.15); }
            .dark .ring-blue-100 { --tw-ring-color: rgba(59, 130, 246, 0.2); }
            .dark .ring-cyan-50 { --tw-ring-color: rgba(34, 211, 238, 0.15); }
            .dark .ring-emerald-50 { --tw-ring-color: rgba(16, 185, 129, 0.15); }
            .dark .ring-amber-50 { --tw-ring-color: rgba(245, 158, 11, 0.15); }
            .dark .ring-sky-100 { --tw-ring-color: rgba(56, 189, 248, 0.2); }

            /* --- Hover Interactions --- */
            .dark .hover\:bg-blue-100:hover { background-color: rgba(59, 130, 246, 0.22); }
            .dark .hover\:bg-gray-200:hover { background-color: rgba(255, 255, 255, 0.1); }
            .dark .hover\:bg-gray-50:hover { background-color: rgba(255, 255, 255, 0.04); }
            .dark .hover\:bg-gray-300:hover { background-color: rgba(255, 255, 255, 0.12); }
            .dark .hover\:text-blue-700:hover { color: #93bbfd; }
            .dark .hover\:text-gray-700:hover { color: #d4d4d4; }

            /* --- Specific Component Fixes --- */
            /* Backdrop glassmorphism */
            .dark .bg-white\/60 { background-color: rgba(17, 17, 17, 0.6); }
            .dark .bg-white\/80 { background-color: rgba(17, 17, 17, 0.8); }
            .dark .from-white\/60 { --tw-gradient-from: rgba(17, 17, 17, 0.6); }
            .dark .to-white\/30 { --tw-gradient-to: rgba(17, 17, 17, 0.3); }

            /* Pagination */
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

            /* Modals */
            .dark .bg-gray-500.bg-opacity-75 { background-color: rgba(0, 0, 0, 0.8); }
            .dark .bg-gray-900.bg-opacity-75 { background-color: rgba(0, 0, 0, 0.85); }

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
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div x-data="{ 
            sidebarOpen: false, 
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') !== 'false',
            toggleCollapse() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
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
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-pekanbaru.png') }}" alt="Logo Pekanbaru" class="h-10 w-10 object-contain drop-shadow-sm flex-shrink-0">
                        <div class="flex flex-col transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                            <div class="flex items-baseline gap-1 leading-none">
                                <span class="text-blue-400 text-lg font-extrabold tracking-tight uppercase whitespace-nowrap">SIDATA</span>
                                <span class="text-slate-300 text-lg font-bold tracking-tight uppercase whitespace-nowrap">PKU</span>
                            </div>
                            <span class="text-slate-500 text-[9px] uppercase tracking-wide font-medium whitespace-nowrap mt-0.5">Pemerintah Kota Pekanbaru</span>
                        </div>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="space-y-1 px-2">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Dashboard">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Dashboard</span>
                        </a>

                        <!-- Data Aplikasi -->
                        <a href="{{ route('admin.web-apps.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.web-apps.*') ? 'bg-gradient-to-r from-blue-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Data Aplikasi">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.web-apps.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Data Aplikasi</span>
                        </a>

                        <!-- Manajemen User -->
                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-blue-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Manajemen User">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Manajemen User</span>
                        </a>

                        <!-- Monitoring (Dropdown) -->
                        <div x-data="{ open: {{ request()->routeIs('admin.monitoring.*') ? 'true' : 'false' }} }">
                            <button @click="open = !open" 
                                    class="w-full group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.monitoring.*') ? 'bg-gradient-to-r from-cyan-800 to-slate-700 dark:to-zinc-800 text-white' : 'text-slate-300 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}"
                                    :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                                <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.monitoring.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span class="flex-1 text-left transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Monitoring</span>
                                <svg x-show="!sidebarCollapsed" class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <!-- Sub-menu -->
                            <div x-show="open && !sidebarCollapsed" x-collapse class="ml-4 mt-1 space-y-1 border-l border-slate-700/50 dark:border-zinc-800/50 pl-3">
                                <a href="{{ route('admin.monitoring.index') }}" 
                                   class="block px-3 py-2 text-xs font-medium rounded-md transition-colors {{ request()->routeIs('admin.monitoring.index') || request()->routeIs('admin.monitoring.teknologi') ? 'bg-cyan-600/20 text-cyan-400' : 'text-slate-400 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}">
                                    Ringkasan
                                </a>
                                <a href="{{ route('admin.monitoring.opd') }}" 
                                   class="block px-3 py-2 text-xs font-medium rounded-md transition-colors {{ request()->routeIs('admin.monitoring.opd') ? 'bg-cyan-600/20 text-cyan-400' : 'text-slate-400 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}">
                                    Statistik OPD
                                </a>
                                <a href="{{ route('admin.monitoring.health-check') }}" 
                                   class="block px-3 py-2 text-xs font-medium rounded-md transition-colors {{ request()->routeIs('admin.monitoring.health-check') ? 'bg-cyan-600/20 text-cyan-400' : 'text-slate-400 hover:bg-slate-800 dark:hover:bg-zinc-900 hover:text-white' }}">
                                    Cek Status
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Collapse Toggle Button -->
                <div class="px-2 py-2 border-t border-slate-800 dark:border-zinc-900 hidden md:block">
                    <button @click="toggleCollapse()" 
                            class="w-full flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 dark:hover:bg-zinc-900 transition-all duration-200"
                            :title="sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
                        <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </button>
                </div>

                <!-- User Profile & Logout (Sidebar Footer) -->
                <div class="border-t border-slate-800 dark:border-zinc-900 bg-slate-950 dark:bg-black transition-all duration-300" :class="sidebarCollapsed ? 'p-1.5' : 'p-3'">
                     <!-- Dark Mode Toggle (Sidebar) -->
                    <button id="adminThemeToggle" type="button" class="w-full flex items-center py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 dark:hover:bg-zinc-900 border border-transparent hover:border-slate-700 dark:hover:border-zinc-800 transition-all duration-200 mb-2" :class="sidebarCollapsed ? 'justify-center px-2' : 'gap-2 px-4'">
                        <svg id="adminDarkIcon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="adminLightIcon" class="hidden w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                        <span id="adminThemeText" class="text-sm font-medium transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Mode Gelap</span>
                    </button>

                    <!-- Admin Profile Card (Non-clickable) -->
                    <div class="flex items-center rounded-xl bg-gradient-to-r from-blue-500/10 to-sky-600/5 border border-blue-500/20 mb-2 overflow-hidden" :class="sidebarCollapsed ? 'justify-center p-1.5' : 'gap-3 p-2.5'">
                        <!-- Avatar with Photo or Gradient -->
                        <div class="relative flex-shrink-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="rounded-xl object-cover ring-2 ring-blue-500/30 shadow-lg" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
                            @else
                                <div class="rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 ring-2 ring-blue-500/30 shadow-lg flex items-center justify-center" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
                                    <svg class="text-white" :class="sidebarCollapsed ? 'w-4 h-4' : 'w-6 h-6'" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <!-- User Info -->
                        <div class="flex-1 min-w-0 transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                            <p class="text-sm font-bold text-white truncate">Administrator</p>
                            <div class="flex items-center gap-1.5">
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wide bg-blue-500/20 text-blue-400 border border-blue-500/30">Admin</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-red-500/20 border border-transparent hover:border-red-500/30 dark:hover:bg-zinc-900 transition-all duration-200" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-center gap-2 px-4'">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
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
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <span class="ml-3 text-sm font-medium text-gray-600">Menu</span>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    {{ $slot }}
                </main>
            </div>
            
            <!-- Floating Dark Mode Toggle Removed -->
            
            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"></div>
        </div>

        <!-- Session Timeout Modal -->
        <div id="sessionTimeoutModal" class="fixed inset-0 z-[100] hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>
            
            <!-- Modal Content -->
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative">
                    <!-- Icon -->
                    <div class="mx-auto w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <!-- Text -->
                    <h3 id="sessionModalTitle" class="text-xl font-bold text-gray-900 text-center mb-2">Sesi Akan Berakhir</h3>
                    <p id="sessionModalMessage" class="text-gray-600 text-center mb-6">Sesi Anda akan berakhir dalam <span id="countdownTimer" class="font-bold text-amber-600">30</span> detik karena tidak ada aktivitas.</p>
                    
                    <!-- Buttons -->
                    <div id="sessionModalButtons" class="flex gap-3">
                        <button onclick="extendSession()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all">
                            Perpanjang Sesi
                        </button>
                        <button onclick="logoutNow()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-all">
                            Logout
                        </button>
                    </div>
                    
                    <!-- Single button for expired state -->
                    <div id="sessionExpiredButton" class="hidden">
                        <button onclick="window.location.href='{{ route('login') }}'" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all">
                            Login Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Session timeout configuration (in milliseconds)
            const SESSION_TIMEOUT = 5 * 60 * 1000; // 5 minutes
            const WARNING_TIME = 30 * 1000; // Show warning 30 seconds before timeout
            
            let inactivityTimer;
            let warningTimer;
            let countdownInterval;
            let countdown = 30;
            
            // Reset timers on user activity
            function resetTimers() {
                clearTimeout(inactivityTimer);
                clearTimeout(warningTimer);
                clearInterval(countdownInterval);
                
                // Hide modal if showing
                document.getElementById('sessionTimeoutModal').classList.add('hidden');
                
                // Set timer to show warning
                warningTimer = setTimeout(showWarning, SESSION_TIMEOUT - WARNING_TIME);
                
                // Set timer for actual timeout
                inactivityTimer = setTimeout(sessionExpired, SESSION_TIMEOUT);
            }
            
            // Show warning modal
            function showWarning() {
                countdown = 30;
                document.getElementById('countdownTimer').textContent = countdown;
                document.getElementById('sessionModalTitle').textContent = 'Sesi Akan Berakhir';
                document.getElementById('sessionModalMessage').innerHTML = 'Sesi Anda akan berakhir dalam <span id="countdownTimer" class="font-bold text-amber-600">' + countdown + '</span> detik karena tidak ada aktivitas.';
                document.getElementById('sessionModalButtons').classList.remove('hidden');
                document.getElementById('sessionExpiredButton').classList.add('hidden');
                document.getElementById('sessionTimeoutModal').classList.remove('hidden');
                
                // Start countdown
                countdownInterval = setInterval(function() {
                    countdown--;
                    const timerEl = document.getElementById('countdownTimer');
                    if (timerEl) timerEl.textContent = countdown;
                    
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }
            
            // Session has expired
            function sessionExpired() {
                clearInterval(countdownInterval);
                
                document.getElementById('sessionModalTitle').textContent = 'Sesi Berakhir';
                document.getElementById('sessionModalMessage').textContent = 'Sesi Anda telah berakhir karena tidak ada aktivitas. Harap login kembali untuk melanjutkan.';
                document.getElementById('sessionModalButtons').classList.add('hidden');
                document.getElementById('sessionExpiredButton').classList.remove('hidden');
                document.getElementById('sessionTimeoutModal').classList.remove('hidden');
                
                // Change icon to red
                const iconContainer = document.querySelector('#sessionTimeoutModal .bg-amber-100');
                if (iconContainer) {
                    iconContainer.classList.remove('bg-amber-100');
                    iconContainer.classList.add('bg-red-100');
                }
                const icon = document.querySelector('#sessionTimeoutModal .text-amber-600');
                if (icon) {
                    icon.classList.remove('text-amber-600');
                    icon.classList.add('text-red-600');
                }
                
                // Logout from server
                fetch('{{ route('logout') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
            }
            
            // Extend session - just reset timers
            function extendSession() {
                // Ping server to keep session alive
                fetch('{{ url('/') }}', { method: 'GET', credentials: 'same-origin' });
                resetTimers();
            }
            
            // Logout now
            function logoutNow() {
                document.getElementById('logout-form').submit();
            }
            
            // Listen for user activity
            const activityEvents = ['mousedown', 'mousemove', 'keydown', 'scroll', 'touchstart', 'click'];
            activityEvents.forEach(function(event) {
                document.addEventListener(event, resetTimers, { passive: true });
            });
            
            // Start timers on page load
            resetTimers();
        </script>
        
        <!-- Dark Mode Toggle Script -->
        <script>
            (function() {
                const themeToggle = document.getElementById('adminThemeToggle');
                const darkIcon = document.getElementById('adminDarkIcon');
                const lightIcon = document.getElementById('adminLightIcon');
                const html = document.documentElement;
                
                function updateIcons() {
                    const textEl = document.getElementById('adminThemeText');
                    if (html.classList.contains('dark')) {
                        if(lightIcon) lightIcon.classList.remove('hidden');
                        if(darkIcon) darkIcon.classList.add('hidden');
                        if(textEl) textEl.textContent = 'Mode Terang';
                    } else {
                        if(lightIcon) lightIcon.classList.add('hidden');
                        if(darkIcon) darkIcon.classList.remove('hidden');
                        if(textEl) textEl.textContent = 'Mode Gelap';
                    }
                }
                
                updateIcons();
                
                if (themeToggle) {
                    themeToggle.addEventListener('click', function() {
                        if (html.classList.contains('dark')) {
                            html.classList.remove('dark');
                            html.classList.add('light');
                            localStorage.setItem('adminTheme', 'light');
                        } else {
                            html.classList.add('dark');
                            html.classList.remove('light');
                            localStorage.setItem('adminTheme', 'dark');
                        }
                        updateIcons();
                    });
                }
            })();
        </script>
    </body>
</html>
