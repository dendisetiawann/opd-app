<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('images/logo-icon.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div x-data="{ 
            sidebarOpen: false, 
            sidebarCollapsed: localStorage.getItem('userSidebarCollapsed') !== 'false',
            toggleCollapse() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('userSidebarCollapsed', this.sidebarCollapsed);
            }
        }" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar -->
            <aside class="flex flex-col flex-shrink-0 bg-slate-900 border-r border-slate-800 transition-all duration-300 ease-in-out transform md:translate-x-0 fixed z-30 h-full"
                   :class="{
                       'translate-x-0': sidebarOpen, 
                       '-translate-x-full': !sidebarOpen,
                       'w-64': !sidebarCollapsed,
                       'w-16': sidebarCollapsed
                   }">
                
                <!-- Logo -->
                <div class="flex items-center h-20 bg-slate-950 border-b border-slate-800 px-4 overflow-hidden">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-simda.png') }}" alt="Logo" class="h-10 w-10 object-contain drop-shadow-sm flex-shrink-0">
                        <div class="flex flex-col transition-all duration-300 overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">
                            <span class="text-white text-lg font-bold tracking-wider uppercase leading-none font-sans whitespace-nowrap">SIMDA-OPD</span>
                            <span class="text-slate-400 text-[10px] uppercase tracking-wide font-medium whitespace-nowrap">Diskominfo Pekanbaru</span>
                        </div>
                    </div>
                </div>

                <!-- Nav Links -->
                <div class="flex-1 overflow-y-auto py-4">
                    <nav class="space-y-1 px-2">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-800 to-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Dashboard">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Dashboard</span>
                        </a>

                        <!-- Daftar Aplikasi -->
                        <a href="{{ route('web-apps.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('web-apps.*') ? 'bg-gradient-to-r from-blue-800 to-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Daftar Aplikasi">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('web-apps.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Daftar Aplikasi</span>
                        </a>

                        <!-- Profil Saya -->
                        <a href="{{ route('profile.edit') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-blue-800 to-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Profil Saya">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Profil Saya</span>
                        </a>
                    </nav>
                </div>

                <!-- Collapse Toggle Button -->
                <div class="px-2 py-2 border-t border-slate-800 hidden md:block">
                    <button @click="toggleCollapse()" 
                            class="w-full flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all duration-200"
                            :title="sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
                        <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </button>
                </div>

                <!-- User Profile & Logout (Sidebar Footer) -->
                <div class="border-t border-slate-800 p-3 bg-slate-950">
                    <!-- User Profile Card (Clickable to Profile) -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-2.5 rounded-xl bg-gradient-to-r from-blue-500/10 to-blue-600/5 border border-blue-500/20 mb-2 hover:bg-blue-500/20 transition-all" :class="sidebarCollapsed ? 'justify-center p-2' : ''">
                        <!-- Avatar with Photo or Gradient -->
                        <div class="relative flex-shrink-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="rounded-xl object-cover ring-2 ring-blue-500/30 shadow-lg" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
                            @else
                                <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 ring-2 ring-blue-500/30 shadow-lg flex items-center justify-center" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
                                    <svg class="text-white" :class="sidebarCollapsed ? 'w-4 h-4' : 'w-6 h-6'" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
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
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-red-500/20 border border-transparent hover:border-red-500/30 transition-all duration-200" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-center'">
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
                <main class="flex-1 overflow-auto relative">
                    <div class="p-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>

            <!-- Mobile Overlay -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"></div>
        </div>

        <!-- Session Timeout Modal -->
        <div id="sessionTimeoutModal" class="fixed inset-0 z-[100] hidden">
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative">
                    <div class="mx-auto w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 id="sessionModalTitle" class="text-xl font-bold text-gray-900 text-center mb-2">Sesi Akan Berakhir</h3>
                    <p id="sessionModalMessage" class="text-gray-600 text-center mb-6">Sesi Anda akan berakhir dalam <span id="countdownTimer" class="font-bold text-amber-600">30</span> detik.</p>
                    <div id="sessionModalButtons" class="flex gap-3">
                        <button onclick="extendSession()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all">Perpanjang Sesi</button>
                        <button onclick="logoutNow()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-xl transition-all">Logout</button>
                    </div>
                    <div id="sessionExpiredButton" class="hidden">
                        <button onclick="window.location.href='{{ route('login') }}'" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all">Login Kembali</button>
                    </div>
                </div>
            </div>
        </div>

        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>

        <script>
            const SESSION_TIMEOUT = 5 * 60 * 1000;
            const WARNING_TIME = 30 * 1000;
            let inactivityTimer, warningTimer, countdownInterval, countdown = 30;
            
            function resetTimers() {
                clearTimeout(inactivityTimer);
                clearTimeout(warningTimer);
                clearInterval(countdownInterval);
                document.getElementById('sessionTimeoutModal').classList.add('hidden');
                warningTimer = setTimeout(showWarning, SESSION_TIMEOUT - WARNING_TIME);
                inactivityTimer = setTimeout(sessionExpired, SESSION_TIMEOUT);
            }
            
            function showWarning() {
                countdown = 30;
                document.getElementById('countdownTimer').textContent = countdown;
                document.getElementById('sessionModalButtons').classList.remove('hidden');
                document.getElementById('sessionExpiredButton').classList.add('hidden');
                document.getElementById('sessionTimeoutModal').classList.remove('hidden');
                countdownInterval = setInterval(() => {
                    countdown--;
                    document.getElementById('countdownTimer').textContent = countdown;
                    if (countdown <= 0) clearInterval(countdownInterval);
                }, 1000);
            }
            
            function sessionExpired() {
                clearInterval(countdownInterval);
                document.getElementById('sessionModalTitle').textContent = 'Sesi Berakhir';
                document.getElementById('sessionModalMessage').textContent = 'Sesi Anda telah berakhir. Harap login kembali.';
                document.getElementById('sessionModalButtons').classList.add('hidden');
                document.getElementById('sessionExpiredButton').classList.remove('hidden');
                fetch('{{ route('logout') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, 'Accept': 'application/json' }});
            }
            
            function extendSession() { fetch('{{ url('/') }}', { method: 'GET', credentials: 'same-origin' }); resetTimers(); }
            function logoutNow() { document.getElementById('logout-form').submit(); }
            
            ['mousedown', 'mousemove', 'keydown', 'scroll', 'touchstart', 'click'].forEach(e => document.addEventListener(e, resetTimers, { passive: true }));
            resetTimers();
        </script>
    </body>
</html>
