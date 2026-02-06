<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('images/logo-diskominfo.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        /* Prevent sidebar transition on initial load */
        .no-transition {
            transition: none !important;
        }
    </style>
    <body class="font-sans antialiased bg-slate-50">
        <div x-data="{ 
                sidebarOpen: false, 
                sidebarExpanded: localStorage.getItem('sidebarExpanded') === null ? true : localStorage.getItem('sidebarExpanded') === 'true',
                init() {
                    this.$watch('sidebarExpanded', value => localStorage.setItem('sidebarExpanded', value));
                    // Remove no-transition class after load to enable animations
                    setTimeout(() => document.getElementById('sidebar').classList.remove('no-transition'), 100);
                }
            }" 
            class="flex h-screen overflow-hidden">
            
            <!-- Sidebar (Desktop: collapsible, Mobile: overlay) -->
            <aside id="sidebar" class="flex flex-col flex-shrink-0 bg-slate-900 border-r border-slate-800 transition-[width,transform] duration-500 ease-in-out fixed z-30 h-full overflow-hidden no-transition"
                   :class="{
                       'w-64': sidebarExpanded,
                       'w-0 -translate-x-full md:w-0 md:translate-x-0': !sidebarExpanded,
                       'translate-x-0 w-64': sidebarOpen && !sidebarExpanded,
                       '-translate-x-full w-0': !sidebarOpen && !sidebarExpanded
                   }">
                
                <!-- Sidebar Header -->
                <div class="flex items-center justify-between h-20 bg-slate-950 border-b border-slate-800 pl-6 pr-4 shrink-0 whitespace-nowrap">
                    <!-- Logo + Text (Left Side) -->
                    <div class="flex items-center gap-3 transition-opacity duration-500 delay-200" :class="{'opacity-100': sidebarExpanded, 'opacity-0': !sidebarExpanded}">
                        <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="h-10 w-auto object-contain drop-shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-white text-lg font-bold tracking-wider uppercase leading-none font-sans">SIMDA-OPD</span>
                            <span class="text-slate-400 text-[10px] uppercase tracking-wide font-medium">Diskominfo Pekanbaru</span>
                        </div>
                    </div>

                    <!-- Toggle Button (Right Side) -->
                    <button @click="sidebarExpanded = !sidebarExpanded" class="text-slate-400 hover:text-white focus:outline-none p-1.5 rounded-lg hover:bg-slate-800 transition-colors">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" x-show="sidebarExpanded" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" x-show="!sidebarExpanded" />
                        </svg>
                    </button>
                </div>

                <!-- Nav Links -->
                <div class="flex-1 overflow-y-auto overflow-x-hidden py-4 whitespace-nowrap">
                    <nav class="space-y-1 px-2 transition-opacity duration-500 delay-100" :class="{'opacity-100': sidebarExpanded, 'opacity-0': !sidebarExpanded}">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </a>

                        <!-- Daftar Aplikasi -->
                        <a href="{{ route('web-apps.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('web-apps.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('web-apps.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Daftar Aplikasi
                        </a>

                         <!-- Profil Saya -->
                         <a href="{{ route('profile.edit') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('profile.edit') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 shrink-0 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil Saya
                        </a>
                    </nav>
                </div>

                <!-- User Profile & Logout (Sidebar Footer) -->
                <div class="border-t border-slate-800 p-3 bg-slate-950 shrink-0 whitespace-nowrap transition-opacity duration-500 delay-100" :class="{'opacity-100': sidebarExpanded, 'opacity-0': !sidebarExpanded}">
                    <!-- Profile Card -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-900/50 hover:bg-slate-800 transition-all duration-200 group cursor-pointer mb-2">
                        <!-- Avatar with Photo or Gradient -->
                        <div class="relative flex-shrink-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="h-10 w-10 rounded-xl object-cover shadow-lg">
                            @else
                                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-indigo-500/30">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                            @endif
                            <!-- Online Indicator -->
                            <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 rounded-full border-2 border-slate-950"></div>
                        </div>
                        <!-- User Info -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white truncate group-hover:text-indigo-300 transition-colors">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <!-- Arrow Icon -->
                        <svg class="w-4 h-4 text-slate-500 group-hover:text-indigo-400 transition-colors flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-red-500/20 border border-transparent hover:border-red-500/30 transition-all duration-200">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-sm font-medium">Keluar</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Wrapper -->
            <div class="flex-1 flex flex-col min-w-0 bg-gray-100 transition-[margin] duration-500 ease-in-out"
                 :class="{ 'md:ml-64': sidebarExpanded, 'md:ml-0': !sidebarExpanded }">
                
                <!-- Top Navbar -->
                <header class="bg-white shadow-sm border-b border-gray-100 transition-all duration-500 ease-in-out transform"
                        :class="{ '-mt-16 opacity-0 pointer-events-none': sidebarExpanded, 'mt-0 opacity-100': !sidebarExpanded }">
                    <div class="flex items-center justify-between px-4 py-3 h-16">
                        <!-- Left Side: Toggle Button + Logo (when sidebar hidden) -->
                        <div class="flex items-center gap-4">
                            <!-- Helper: Toggle button only works when header is visible, logic handled by css pointer-events -->
                            <button @click="sidebarExpanded = true" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 rounded-md p-2 transition-opacity duration-500">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <!-- Logo in Main Content (only when sidebar is collapsed) -->
                            <div class="flex items-center gap-2 transition-opacity duration-500" x-show="!sidebarExpanded" x-transition:enter="delay-500">
                                <img src="{{ asset('images/logo-icon.png') }}" alt="Logo" class="h-8 w-auto">
                                <div class="flex flex-col">
                                    <span class="text-[#1a237e] font-bold text-sm tracking-tight leading-none">DISKOMINFO</span>
                                    <span class="text-gray-400 text-[8px] uppercase tracking-wide font-medium">Kota Pekanbaru</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side: User Profile & Actions -->
                        <div class="flex items-center gap-4" x-show="!sidebarExpanded" x-transition>
                            <!-- Profile Info -->
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-100 transition-colors group">
                                <!-- Circular Profile Photo -->
                                <div class="relative">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="h-9 w-9 rounded-full object-cover ring-2 ring-white shadow">
                                    @else
                                        <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white shadow">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <!-- Online Indicator -->
                                    <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full ring-2 ring-white"></div>
                                </div>
                                <!-- Name -->
                                <div class="hidden sm:block">
                                    <p class="text-sm font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors">{{ Auth::user()->name }}</p>
                                    <p class="text-[8px] text-slate-400 truncate max-w-[180px]">{{ Auth::user()->opd->nama_opd ?? 'Belum Terdaftar' }}</p>
                                </div>
                            </a>
                            
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-2.5 rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Keluar">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-4 sm:p-6 lg:p-8 animate-fade-in">
                    {{ $slot }}
                </main>
            </div>
            
            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen && !sidebarExpanded" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"></div>
        </div>
    </body>
</html>
