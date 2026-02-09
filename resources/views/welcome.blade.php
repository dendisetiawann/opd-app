<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistem Manajemen Data Aplikasi OPD Kota Pekanbaru">
        <title>Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru</title>
        <link rel="icon" href="{{ asset('images/logo-favicon-192.png') }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Dark Mode Script (before body to prevent flash) -->
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
            }
        </script>
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                transition: background-color 0.4s ease, color 0.4s ease;
            }
            
            /* Dark Mode Styles - Premium Dark Theme */
            .dark body { background-color: #0a0f1a; color: #e2e8f0; }
            .dark .bg-gray-50 { background-color: #0a0f1a; }
            .dark .bg-slate-50 { background-color: #111827; }
            .dark .bg-white { background-color: #1a2332; }
            .dark .text-gray-900 { color: #f8fafc; }
            .dark .text-gray-800 { color: #f1f5f9; }
            .dark .text-gray-700 { color: #e2e8f0; }
            .dark .text-gray-600 { color: #cbd5e1; }
            .dark .text-gray-500 { color: #94a3b8; }
            .dark .text-gray-400 { color: #64748b; }
            .dark .text-black { color: #f1f5f9; }
            .dark .border-gray-200 { border-color: #2d3748; }
            .dark .border-gray-100 { border-color: #1f2937; }
            .dark .border-slate-200 { border-color: #2d3748; }
            .dark .bg-gray-900 { background-color: #030712; }
            .dark .text-\[\#1a237e\] { color: #60a5fa !important; }
            
            /* Dark mode header - elegant glassmorphism */
            .dark .header-default {
                background: rgba(10, 15, 26, 0.85) !important;
                backdrop-filter: blur(20px) !important;
            }
            .dark .header-scrolled {
                background: rgba(26, 35, 50, 0.95) !important;
                border-color: rgba(45, 55, 72, 0.6) !important;
                box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.3), 0 8px 10px -6px rgb(0 0 0 / 0.2) !important;
            }
            
            /* Dark mode cards - with subtle glow */
            .dark .bg-blue-100 { background-color: #1e3a5f; }
            .dark .bg-cyan-100 { background-color: #134e4a; }
            .dark .bg-indigo-100 { background-color: #312e81; }
            .dark .bg-blue-50 { background-color: #172554; }
            
            /* Dark mode info cards */
            .dark .shadow-sm { box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.3); }
            .dark .hover\:shadow-md:hover { box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.3), 0 2px 4px -2px rgb(0 0 0 / 0.2); }
            

            
            /* Dark mode toggle button */
            .theme-toggle {
                transition: all 0.3s ease;
            }
            .theme-toggle:hover {
                transform: rotate(15deg) scale(1.1);
            }
            
            /* Dark mode text colors */
            .dark .text-blue-600 { color: #60a5fa; }
            .dark .text-blue-700 { color: #3b82f6; }
            .dark .hover\:text-blue-800:hover { color: #60a5fa; }
        </style>
    </head>
    <body class="antialiased bg-gray-50 text-gray-800">
        
        <!-- Header / Navigation -->
        <style>
            #headerInner {
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #headerContent {
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #headerLogo {
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .header-scrolled {
                max-width: 900px !important;
                margin-top: 1rem !important;
                border-radius: 9999px !important;
                box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
                border: 1px solid rgba(229, 231, 235, 0.5) !important;
                background: rgba(255, 255, 255, 0.95) !important;
                backdrop-filter: blur(20px) !important;
            }
            .header-default {
                max-width: 100% !important;
                margin-top: 0 !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                border: none !important;
                background: rgba(248, 250, 252, 0.8) !important;
                backdrop-filter: blur(12px) !important;
            }
            
            /* Custom smooth animations */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            @keyframes sway {
                0%, 100% { transform: translateX(-10px) rotate(-1deg); }
                50% { transform: translateX(10px) rotate(1deg); }
            }
            @keyframes pulse-glow {
                0%, 100% { opacity: 0.5; transform: scale(1); }
                50% { opacity: 0.8; transform: scale(1.1); }
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            .animate-sway {
                animation: sway 4s ease-in-out infinite;
            }
            .animate-pulse-glow {
                animation: pulse-glow 4s ease-in-out infinite;
            }
        </style>
        <header id="mainHeader" class="fixed top-0 left-0 right-0 z-50">
            <div id="headerInner" class="mx-auto header-default">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center" id="headerContent" style="height: 80px;">
                        <!-- Brand -->
                        <a href="/" class="flex items-center gap-4 group">
                            <!-- Logo Shield -->
                            <div class="relative w-12 h-12 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                                <img src="{{ asset('images/logo-pekanbaru.png') }}" alt="Logo Pekanbaru" class="w-full h-full object-contain filter drop-shadow-sm">
                            </div>
            
                            <!-- Separator Line -->
                            <div class="hidden sm:block h-10 w-[2px] bg-slate-300 dark:bg-slate-600 rounded-full"></div>
            
                            <!-- Text Content -->
                            <div class="flex flex-col justify-center">
                                <div class="flex items-baseline gap-1.5 leading-none">
                                    <span class="text-2xl font-extrabold text-[#1a237e] dark:text-blue-400 tracking-tight drop-shadow-sm">SIDATA</span>
                                    <span class="text-2xl font-bold text-slate-600 dark:text-slate-200">PKU</span>
                                </div>
                                <span class="text-[0.65rem] font-bold text-slate-500 dark:text-slate-400 tracking-[0.15em] uppercase mt-0.5 leading-tight">
                                    Sistem Informasi Data Terpadu
                                </span>
                                <span class="text-[0.6rem] font-serif italic text-slate-400 dark:text-slate-500 mt-0.5">
                                    Pemerintah Kota Pekanbaru
                                </span>
                            </div>
                        </a>

                        <!-- Auth Actions -->
                        <div class="flex items-center gap-4">
                            <!-- Dark Mode Toggle -->
                            <button id="themeToggle" class="theme-toggle p-2 rounded-full hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors" title="Toggle Dark Mode">
                                <!-- Sun Icon (shown in light mode - indicates current state) -->
                                <svg id="sunIcon" class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                </svg>
                                <!-- Moon Icon (shown in dark mode - indicates current state) -->
                                <svg id="moonIcon" class="w-5 h-5 text-blue-400 hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                            </button>
                            
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-800 transition">
                                        Dashboard &rarr;
                                    </a>
                                @else
                                    <div class="flex items-center gap-6">
                                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition tracking-wide">
                                            Login
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-full shadow-sm transition-all tracking-wide">
                                                Registrasi
                                            </a>
                                        @endif
                                    </div>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Header scroll animation
                const headerInner = document.getElementById('headerInner');
                const headerContent = document.getElementById('headerContent');
                const headerLogo = document.getElementById('headerLogo');
                
                let isScrolled = false;
                
                function updateHeader() {
                    const scrollY = window.scrollY;
                    
                    if (scrollY > 50 && !isScrolled) {
                        isScrolled = true;
                        headerInner.classList.remove('header-default');
                        headerInner.classList.add('header-scrolled');
                        headerContent.style.height = '64px';
                        headerLogo.style.height = '32px';
                    } else if (scrollY <= 50 && isScrolled) {
                        isScrolled = false;
                        headerInner.classList.remove('header-scrolled');
                        headerInner.classList.add('header-default');
                        headerContent.style.height = '80px';
                        headerLogo.style.height = '40px';
                    }
                }
                
                // Use requestAnimationFrame for smoother performance
                let ticking = false;
                window.addEventListener('scroll', function() {
                    if (!ticking) {
                        window.requestAnimationFrame(function() {
                            updateHeader();
                            ticking = false;
                        });
                        ticking = true;
                    }
                });
                
                // Dark Mode Toggle
                const themeToggle = document.getElementById('themeToggle');
                const sunIcon = document.getElementById('sunIcon');
                const moonIcon = document.getElementById('moonIcon');
                const html = document.documentElement;
                
                // Update icons based on current theme
                // Sun = light mode (current), Moon = dark mode (current)
                function updateIcons() {
                    if (html.classList.contains('dark')) {
                        // Dark mode active - show moon
                        sunIcon.classList.add('hidden');
                        moonIcon.classList.remove('hidden');
                    } else {
                        // Light mode active - show sun
                        sunIcon.classList.remove('hidden');
                        moonIcon.classList.add('hidden');
                    }
                }
                
                // Initial icon state
                updateIcons();
                
                // Toggle theme on button click
                themeToggle.addEventListener('click', function() {
                    if (html.classList.contains('dark')) {
                        html.classList.remove('dark');
                        html.classList.add('light');
                        localStorage.setItem('theme', 'light');
                    } else {
                        html.classList.add('dark');
                        html.classList.remove('light');
                        localStorage.setItem('theme', 'dark');
                    }
                    updateIcons();
                });
            });
        </script>

        <!-- Main Content -->
        <main>
            <!-- Hero Section -->
            <section class="relative bg-slate-50 overflow-hidden">
                <!-- Wave Pattern (Right Side) -->
                <div class="wave-pattern absolute top-0 right-0 -z-10 translate-x-1/3 -translate-y-[10%] opacity-50 text-blue-500/40 dark:text-slate-700/30">
                    <svg width="1200" height="1200" viewBox="0 0 1200 1200" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[50rem] lg:w-[90rem] h-auto">
                        <path d="M1200 0 C 900 100, 600 400, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 40 C 900 140, 600 440, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 80 C 900 180, 600 480, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 120 C 900 220, 600 520, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 160 C 900 260, 600 560, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 200 C 900 300, 600 600, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 240 C 900 340, 600 640, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 280 C 900 380, 600 680, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 320 C 900 420, 600 720, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 360 C 900 460, 600 760, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 400 C 900 500, 600 800, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 440 C 900 540, 600 840, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 480 C 900 580, 600 880, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                        <path d="M1200 520 C 900 620, 600 920, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.25"/>
                        <path d="M1200 560 C 900 660, 600 960, 300 1200" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.3"/>
                    </svg>
                </div>
                
                 <!-- Wave Pattern (Bottom Left - Fainter) -->
                <div class="wave-pattern-secondary absolute bottom-0 left-0 -z-10 -translate-x-1/2 translate-y-[20%] opacity-40 text-blue-400/40 dark:text-slate-700/30">
                    <svg width="1000" height="1000" viewBox="0 0 1000 1000" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[40rem] lg:w-[70rem] h-auto">
                        <path d="M-200 1000 C 100 800, 300 500, 1000 1200" stroke="currentColor" stroke-width="2" fill="none" opacity="0.3"/>
                        <path d="M-200 1040 C 100 840, 300 540, 1000 1240" stroke="currentColor" stroke-width="2" fill="none" opacity="0.25"/>
                        <path d="M-200 1080 C 100 880, 300 580, 1000 1280" stroke="currentColor" stroke-width="2" fill="none" opacity="0.3"/>
                        <path d="M-200 1120 C 100 920, 300 620, 1000 1320" stroke="currentColor" stroke-width="2" fill="none" opacity="0.25"/>
                    </svg>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24 lg:pt-40 lg:pb-40">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <!-- Left Content -->
                        <div class="max-w-3xl">
                            <!-- Headline -->
                            <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 tracking-tight leading-[1.1] mb-8">
                                Sistem Manajemen <br/>
                                <span class="text-blue-600">Data Aplikasi</span> <br/>
                                Pemerintahan.
                            </h1>
                            
                            <!-- Description -->
                            <p class="text-lg text-gray-600 leading-relaxed mb-10 max-w-2xl">
                                Platform terpadu untuk inventarisasi, pengelolaan, dan standardisasi data aplikasi di seluruh Organisasi Perangkat Daerah (OPD) Kota Pekanbaru. Mewujudkan tata kelola SPBE yang terintegrasi dan akuntabel.
                            </p>
                            
                            <!-- Feature Icons -->
                            <div class="flex flex-wrap items-center gap-8 text-base font-semibold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                    </div>
                                    Terintegrasi
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    Real-time
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    Aman
                                </div>
                            </div>
                        </div>

                        <!-- Right Decoration: Dense Topographic Data Wave -->
                        <div class="hidden lg:block relative h-full min-h-[500px] w-full perspective-1000">
                            <!-- Background Glow Pulse -->
                            <!-- Background Glow - Subtle Floating Animation -->
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-blue-100/40 dark:bg-blue-900/10 rounded-full blur-[100px] animate-pulse-glow"></div>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg width="100%" height="100%" viewBox="0 0 1000 800" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto overflow-visible">
                                    <defs>
                                        <linearGradient id="waveGradientBlue" x1="0" y1="0" x2="1" y2="1">
                                            <stop offset="0%" stop-color="#2563eb" stop-opacity="0.2"/>
                                            <stop offset="50%" stop-color="#2563eb" stop-opacity="1"/>
                                            <stop offset="100%" stop-color="#2563eb" stop-opacity="0.2"/>
                                        </linearGradient>
                                        <linearGradient id="waveGradientCyan" x1="0" y1="0" x2="1" y2="1">
                                            <stop offset="0%" stop-color="#06b6d4" stop-opacity="0.2"/>
                                            <stop offset="50%" stop-color="#06b6d4" stop-opacity="1"/>
                                            <stop offset="100%" stop-color="#06b6d4" stop-opacity="0.2"/>
                                        </linearGradient>
                                    </defs>

                                    <!-- Deep Background Layer (Sparse, Thick) -->
                                    <path d="M-100 200 Q 250 50 500 200 T 1100 200" stroke="url(#waveGradientBlue)" stroke-width="3" fill="none" opacity="0.3" />
                                    <path d="M-100 250 Q 250 100 500 250 T 1100 250" stroke="url(#waveGradientBlue)" stroke-width="3" fill="none" opacity="0.3" />
                                    <path d="M-100 300 Q 250 150 500 300 T 1100 300" stroke="url(#waveGradientBlue)" stroke-width="3" fill="none" opacity="0.3" />
                                    <path d="M-100 350 Q 250 200 500 350 T 1100 350" stroke="url(#waveGradientBlue)" stroke-width="3" fill="none" opacity="0.3" />

                                    <!-- Mid Layer (Medium Density) -->
                                    <g class="animate-sway">
                                        <path d="M-100 400 C 200 100, 400 600, 700 300 S 1100 500, 1100 500" stroke="url(#waveGradientCyan)" stroke-width="2.5" fill="none" opacity="0.5" />
                                        <path d="M-100 415 C 200 115, 400 615, 700 315 S 1100 515, 1100 515" stroke="url(#waveGradientCyan)" stroke-width="2.5" fill="none" opacity="0.5" />
                                        <path d="M-100 430 C 200 130, 400 630, 700 330 S 1100 530, 1100 530" stroke="url(#waveGradientCyan)" stroke-width="2.5" fill="none" opacity="0.6" />
                                        <path d="M-100 445 C 200 145, 400 645, 700 345 S 1100 545, 1100 545" stroke="url(#waveGradientCyan)" stroke-width="2.5" fill="none" opacity="0.6" />
                                        <path d="M-100 460 C 200 160, 400 660, 700 360 S 1100 560, 1100 560" stroke="url(#waveGradientCyan)" stroke-width="2.5" fill="none" opacity="0.7" />
                                    </g>

                                    <!-- Front High-Density "Interference" Pattern -->
                                    <path d="M-100 300 C 100 500, 300 100, 600 400 S 1100 200, 1100 200" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.4" />
                                    <path d="M-100 310 C 100 510, 300 110, 600 410 S 1100 210, 1100 210" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.5" />
                                    <path d="M-100 320 C 100 520, 300 120, 600 420 S 1100 220, 1100 220" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.6" />
                                    <path d="M-100 330 C 100 530, 300 130, 600 430 S 1100 230, 1100 230" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.7" />
                                    <path d="M-100 340 C 100 540, 300 140, 600 440 S 1100 240, 1100 240" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.8" />
                                    <path d="M-100 350 C 100 550, 300 150, 600 450 S 1100 250, 1100 250" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.7" />
                                    <path d="M-100 360 C 100 560, 300 160, 600 460 S 1100 260, 1100 260" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.6" />
                                    <path d="M-100 370 C 100 570, 300 170, 600 470 S 1100 270, 1100 270" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.5" />
                                    <path d="M-100 380 C 100 580, 300 180, 600 480 S 1100 280, 1100 280" stroke="url(#waveGradientBlue)" stroke-width="2" fill="none" opacity="0.4" />

                                    <!-- Digital Particles (Floating dots for 'Data' feel) -->
                                    <circle cx="200" cy="300" r="3" fill="#2563eb" opacity="0.8" class="animate-float dark:opacity-60" style="animation-duration: 2s; animation-delay: 0s;" />
                                    <circle cx="450" cy="450" r="4" fill="#06b6d4" opacity="0.7" class="animate-float dark:opacity-50" style="animation-duration: 2.5s; animation-delay: 1s;" />
                                    <circle cx="700" cy="200" r="3" fill="#2563eb" opacity="0.6" class="animate-float dark:opacity-50" style="animation-duration: 3s; animation-delay: 2s;" />
                                    <circle cx="850" cy="400" r="3.5" fill="#06b6d4" opacity="0.9" class="animate-float dark:opacity-60" style="animation-duration: 2.2s; animation-delay: 0.5s;" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Info Section -->
            <section class="py-20 bg-slate-50 border-t border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Informasi Sistem</h2>
                        <p class="text-gray-600">
                            Sistem ini berfungsi sebagai pusat kendali data (Control Center) untuk monitoring perkembangan digitalisasi pemerintahan di lingkungan Kota Pekanbaru.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Card 1 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Inventarisasi Aset Digital</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Pendataan lengkap seluruh aplikasi, meliputi aspek teknis, stack teknologi, basis data, hingga status keamanan informasi.
                            </p>
                        </div>

                        <!-- Card 2 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Standarisasi & Kepatuhan</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Memastikan pengembangan aplikasi sesuai dengan standar arsitektur SPBE dan interoperabilitas data pemerintah daerah.
                            </p>
                        </div>

                        <!-- Card 3 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-6 h-6 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Monitoring Eksekutif</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Dashboard eksekutif untuk pimpinan daerah memantau kinerja dan efektivitas implementasi teknologi di setiap perangkat daerah.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 border-t border-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="mb-6">
                            <h3 class="font-bold text-xl text-white tracking-tight">DISKOMINFO</h3>
                            <p class="text-sm text-blue-500 font-semibold tracking-wide mt-1">KOTA PEKANBARU</p>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                            Dinas Komunikasi, Informatika, Statistik dan Persandian Kota Pekanbaru.
                            Bencah Lesung, Kec. Tenayan Raya, Kota Pekanbaru, Riau.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4 text-gray-200">Kontak Kami</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                (0761) 123456
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                diskominfo@pekanbaru.go.id
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4 text-gray-200">Pranala Luar</h4>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-blue-400 transition">Portal Pekanbaru</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">PPID Kota Pekanbaru</a></li>
                            <li><a href="#" class="hover:text-blue-400 transition">Layanan Pengaduan</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500 text-center md:text-left">
                        &copy; {{ date('Y') }} Pemerintah Kota Pekanbaru. All rights reserved.
                    </p>
                    <div class="text-xs text-gray-600">
                        Versi 1.0.0
                    </div>
                </div>
            </div>
        </footer>

        <!-- Header Scroll Animation Script -->
        <script>
            (function() {
                const headerInner = document.getElementById('headerInner');
                const scrollThreshold = 100;
                let lastScrollY = window.scrollY;
                let ticking = false;

                function updateHeader() {
                    if (window.scrollY > scrollThreshold) {
                        headerInner.classList.remove('header-default');
                        headerInner.classList.add('header-scrolled');
                    } else {
                        headerInner.classList.remove('header-scrolled');
                        headerInner.classList.add('header-default');
                    }
                    ticking = false;
                }

                window.addEventListener('scroll', function() {
                    if (!ticking) {
                        window.requestAnimationFrame(updateHeader);
                        ticking = true;
                    }
                });

                // Initial check on page load
                updateHeader();
            })();
        </script>

    </body>
</html>
