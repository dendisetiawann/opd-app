<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>
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
            sidebarCollapsed: localStorage.getItem('sidebarCollapsed') !== 'false',
            toggleCollapse() {
                this.sidebarCollapsed = !this.sidebarCollapsed;
                localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
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
                        <a href="{{ route('admin.dashboard') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-800 to-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Dashboard">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Dashboard</span>
                        </a>

                        <!-- Data Aplikasi -->
                        <a href="{{ route('admin.web-apps.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.web-apps.*') ? 'bg-gradient-to-r from-blue-800 to-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Data Aplikasi">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.web-apps.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Data Aplikasi</span>
                        </a>

                        <!-- Manajemen User -->
                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-blue-800 to-slate-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                           :class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           x-tooltip.raw="Manajemen User">
                            <svg class="h-5 w-5 flex-shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" :class="sidebarCollapsed ? '' : 'mr-3'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="transition-all duration-300 whitespace-nowrap overflow-hidden" :class="sidebarCollapsed ? 'w-0 opacity-0' : 'w-auto opacity-100'">Manajemen User</span>
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
                    <!-- Admin Profile Card (Non-clickable) -->
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-gradient-to-r from-blue-500/10 to-sky-600/5 border border-blue-500/20 mb-2" :class="sidebarCollapsed ? 'justify-center p-2' : ''">
                        <!-- Avatar with Photo or Gradient -->
                        <div class="relative flex-shrink-0">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="h-11 w-11 rounded-xl object-cover ring-2 ring-blue-500/30 shadow-lg" :class="sidebarCollapsed ? 'h-8 w-8' : 'h-11 w-11'">
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
                            <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                            <div class="flex items-center gap-1.5">
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wide bg-blue-500/20 text-blue-400 border border-blue-500/30">Admin</span>
                            </div>
                        </div>
                    </div>
                    
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
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    {{ $slot }}
                </main>
            </div>
            
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
    </body>
</html>
