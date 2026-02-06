<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            <aside class="flex flex-col flex-shrink-0 w-64 bg-slate-900 border-r border-slate-800 transition-all duration-300 transform md:translate-x-0 fixed z-30 h-full"
                   :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
                
                <!-- Logo -->
                <div class="flex items-center justify-center h-20 bg-slate-950 border-b border-slate-800 px-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-simda.png') }}" alt="Logo" class="h-10 w-auto object-contain drop-shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-white text-lg font-bold tracking-wider uppercase leading-none font-sans">SIMDA-OPD</span>
                            <span class="text-slate-400 text-[10px] uppercase tracking-wide font-medium">Diskominfo Pekanbaru</span>
                        </div>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="space-y-1 px-2">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Dashboard
                        </a>

                        <!-- Data Aplikasi -->
                        <a href="{{ route('admin.web-apps.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.web-apps.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.web-apps.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Data Aplikasi
                        </a>

                        <!-- Manajemen User -->
                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manajemen User
                        </a>
                    </nav>
                </div>

                <!-- User Profile & Logout (Sidebar Footer) -->
                <div class="border-t border-slate-800 p-3 bg-slate-950">
                    <!-- Admin Profile Card (Non-clickable) -->
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-gradient-to-r from-emerald-500/10 to-cyan-600/5 border border-emerald-500/20 mb-2">
                        <!-- Avatar with Photo or Gradient -->
                        <div class="relative flex-shrink-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="h-11 w-11 rounded-xl object-cover ring-2 ring-emerald-500/30 shadow-lg">
                            @else
                                <img src="{{ asset('images/admin-avatar.png') }}" alt="Admin" class="h-11 w-11 rounded-xl object-cover ring-2 ring-emerald-500/30 shadow-lg bg-emerald-900/20">
                            @endif
                            <!-- Admin Crown Badge -->
                            <div class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-full flex items-center justify-center shadow-lg ring-2 ring-slate-950">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 16L3 5l5.5 5L12 4l3.5 6L21 5l-2 11H5zm14 3c0 .6-.4 1-1 1H6c-.6 0-1-.4-1-1v-1h14v1z"></path>
                                </svg>
                            </div>
                        </div>
                        <!-- User Info -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <div class="flex items-center gap-1.5">
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wide bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">Admin</span>
                            </div>
                        </div>
                    </div>
                    
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
            <div class="flex-1 flex flex-col min-w-0 bg-gray-100 transition-all duration-300 md:ml-64">
                
                <!-- Top Navbar -->
                <header class="bg-white shadow">
                    <div class="flex items-center justify-between px-4 py-3 sm:px-6 lg:px-8 h-16">
                        <!-- Mobile Hamburger -->
                        <div class="flex items-center md:hidden">
                            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 rounded-md p-1">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Header Title (Dynamic) -->
                        <div class="flex-1 flex justify-start ml-4 md:ml-0">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $header ?? '' }}
                            </h2>
                        </div>

                        <!-- Right Actions -->
                        <div class="flex items-center gap-4">
                            <!-- Go to Home -->
                            <a href="/" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="hidden sm:inline">Halaman Utama</span>
                            </a>
                            
                            <!-- Logout -->
                             <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span class="hidden sm:inline">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    {{ $slot }}
                </main>
            </div>
            
            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"></div>
        </div>
    </body>
</html>
