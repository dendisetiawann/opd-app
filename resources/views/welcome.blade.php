<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistem Manajemen Data Aplikasi OPD Kota Pekanbaru">
        <title>Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru</title>
        <link rel="icon" href="{{ asset(App\Models\SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) }}" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
        <header id="mainHeader" class="fixed top-3 left-0 right-0 z-50">
            <div id="headerInner" class="mx-auto header-default">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center" id="headerContent" style="height: 80px;">
                        <!-- Brand -->
                        <a href="/" class="flex items-center gap-4 group">
                            <!-- Logo Shield -->
                            <div class="relative w-12 h-12 flex items-center justify-center transition-transform duration-300 group-hover:scale-110">
                                <img src="{{ asset(App\Models\SiteSetting::get('global_logo', 'images/logo-pekanbaru.png')) }}" alt="Logo Pekanbaru" class="w-full h-full object-contain filter drop-shadow-sm">
                            </div>
            
                            <!-- Separator Line -->
                            <div class="hidden sm:block h-10 w-[2px] bg-slate-300 dark:bg-slate-600 rounded-full"></div>
            
                            <!-- Text Content -->
                            <div class="flex flex-col justify-center">
                                <div class="flex items-baseline gap-1.5 leading-none">
                                    <span class="text-2xl font-extrabold text-[#1a237e] dark:text-blue-400 tracking-tight drop-shadow-sm">{{ App\Models\SiteSetting::get('global_app_name', 'SIDATA') }}</span>
                                </div>
                                <span class="text-[0.65rem] font-bold text-slate-500 dark:text-slate-400 tracking-[0.15em] uppercase mt-0.5 leading-tight">
                                    {{ App\Models\SiteSetting::get('global_app_description', 'Sistem Informasi Data Terpadu') }}
                                </span>
                                <span class="text-[0.6rem] font-serif italic text-slate-400 dark:text-slate-500 mt-0.5">
                                    {{ App\Models\SiteSetting::get('global_org_name', 'Pemerintah Kota Pekanbaru') }}
                                </span>
                            </div>
                        </a>

                        <!-- Auth Actions -->
                        <div class="flex items-center gap-4">
                            <!-- Dark Mode Toggle -->
                            <button id="themeToggle" class="theme-toggle p-2 rounded-full hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors" title="Toggle Dark Mode">
                                <!-- Sun Icon (shown in light mode - indicates current state) -->
                                <i id="sunIcon" class="fa-solid fa-sun w-5 h-5 text-amber-500 flex items-center justify-center"></i>
                                <!-- Moon Icon (shown in dark mode - indicates current state) -->
                                <i id="moonIcon" class="fa-solid fa-moon w-5 h-5 text-blue-400 hidden flex items-center justify-center"></i>
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
        <main class="pt-20">
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
                                {{ App\Models\SiteSetting::get('hero_title_1', 'Sistem Manajemen') }} <br/>
                                <span class="text-blue-600">{{ App\Models\SiteSetting::get('hero_title_2', 'Data Aplikasi') }}</span> <br/>
                                {{ App\Models\SiteSetting::get('hero_title_3', 'Pemerintahan.') }}
                            </h1>
                            
                            <!-- Description -->
                            <p class="text-lg text-gray-600 leading-relaxed mb-10 max-w-2xl">
                                {{ App\Models\SiteSetting::get('hero_description', 'Platform terpadu untuk inventarisasi, pengelolaan, dan standardisasi data aplikasi di seluruh Organisasi Perangkat Daerah (OPD) Kota Pekanbaru. Mewujudkan tata kelola SPBE yang terintegrasi dan akuntabel.') }}
                            </p>
                            
                            <!-- Feature Icons -->
                            <div class="flex flex-wrap items-center gap-8 text-base font-semibold text-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <i class="fa-solid fa-link w-6 h-6 flex items-center justify-center"></i>
                                    </div>
                                    {{ App\Models\SiteSetting::get('hero_feature_1', 'Terintegrasi') }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <i class="fa-solid fa-clock w-6 h-6 flex items-center justify-center"></i>
                                    </div>
                                    {{ App\Models\SiteSetting::get('hero_feature_2', 'Real-time') }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <i class="fa-solid fa-shield-halved w-6 h-6 flex items-center justify-center"></i>
                                    </div>
                                    {{ App\Models\SiteSetting::get('hero_feature_3', 'Aman') }}
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
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ App\Models\SiteSetting::get('info_section_title', 'Informasi Sistem') }}</h2>
                        <p class="text-gray-600">
                            {{ App\Models\SiteSetting::get('info_section_description', 'Sistem ini berfungsi sebagai pusat kendali data (Control Center) untuk monitoring perkembangan digitalisasi pemerintahan di lingkungan Kota Pekanbaru.') }}
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Card 1 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                                <i class="fa-solid fa-boxes-stacked w-6 h-6 text-blue-700 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ App\Models\SiteSetting::get('card_1_title', 'Inventarisasi Aset Digital') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ App\Models\SiteSetting::get('card_1_description', 'Pendataan lengkap seluruh aplikasi, meliputi aspek teknis, stack teknologi, basis data, hingga status keamanan informasi.') }}
                            </p>
                        </div>

                        <!-- Card 2 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center mb-6">
                                <i class="fa-solid fa-clipboard-check w-6 h-6 text-cyan-700 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ App\Models\SiteSetting::get('card_2_title', 'Standarisasi & Kepatuhan') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ App\Models\SiteSetting::get('card_2_description', 'Memastikan pengembangan aplikasi sesuai dengan standar arsitektur SPBE dan interoperabilitas data pemerintah daerah.') }}
                            </p>
                        </div>

                        <!-- Card 3 -->
                        <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6">
                                <i class="fa-solid fa-chart-pie w-6 h-6 text-indigo-700 flex items-center justify-center"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ App\Models\SiteSetting::get('card_3_title', 'Monitoring Eksekutif') }}</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ App\Models\SiteSetting::get('card_3_description', 'Dashboard eksekutif untuk pimpinan daerah memantau kinerja dan efektivitas implementasi teknologi di setiap perangkat daerah.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-[#0a101f] border-t border-slate-800/60 text-white py-16 mt-20 relative overflow-hidden">
            <!-- Subtle background glows -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-[10%] -right-[5%] w-96 h-96 bg-blue-600/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-[-10%] -left-[5%] w-96 h-96 bg-cyan-600/5 rounded-full blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8">
                    <!-- Left Column: Branding & Desc -->
                    <div class="md:col-span-5 lg:col-span-4">
                        <div class="flex items-center gap-3.5 mb-6">
                            <!-- Logo -->
                            <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-xl p-2 flex items-center justify-center border border-white/20 shadow-lg relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-indigo-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <img src="{{ asset(App\Models\SiteSetting::get('global_logo', 'images/logo-pekanbaru.png')) }}" alt="Logo Pekanbaru" class="w-full h-full object-contain filter drop-shadow-lg relative z-10">
                            </div>
                            <div>
                                <h3 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300 tracking-tight leading-none mb-1">{{ App\Models\SiteSetting::get('global_app_name', 'SIDATA') }}</h3>
                                <p class="text-[10px] text-blue-300/80 font-bold tracking-[0.2em] uppercase">{{ App\Models\SiteSetting::get('global_app_description', 'Sistem Informasi Data') }}</p>
                            </div>
                        </div>
                        
                        <p class="text-[13px] text-slate-300/90 leading-relaxed max-w-sm font-medium mb-5">
                            {{ App\Models\SiteSetting::get('footer_description', 'Platform terpadu untuk inventarisasi, pengelolaan data aplikasi di seluruh Organisasi Perangkat Daerah (OPD) Kota Pekanbaru. Mewujudkan ekosistem SPBE yang cerdas dan terintegrasi.') }}
                        </p>
                    </div>
                    
                    <!-- Middle Column: Contact & Links -->
                    <div class="md:col-span-3 lg:col-span-4 lg:pl-10">
                        <div class="mb-10">
                            <h4 class="font-bold mb-5 text-white text-base tracking-wide">
                                Kontak
                            </h4>
                            <div class="text-[13px] text-slate-300 mb-6 leading-relaxed pr-4">
                                {{ App\Models\SiteSetting::get('footer_address', 'Komplek Perkantoran Walikota Pekanbaru Lt. III Jalan Abdul Rahman Hamid, Kelurahan Tuah Negeri Kecamatan Tenayan Raya, Pekanbaru, Riau') }}
                            </div>
                            <ul class="space-y-4 text-[13px] text-slate-300">
                                <li class="flex items-center group cursor-pointer">
                                    <i class="fa-solid fa-phone text-blue-500 mr-3 w-4 text-center"></i>
                                    <span class="group-hover:text-blue-300 transition-colors">{{ App\Models\SiteSetting::get('footer_phone', '081367116222') }}</span>
                                </li>
                                <li class="flex items-center group cursor-pointer">
                                    <i class="fa-regular fa-envelope text-blue-500 mr-3 w-4 text-center"></i>
                                    <span class="group-hover:text-blue-300 transition-colors">{{ App\Models\SiteSetting::get('footer_email', 'helpdesk@pekanbaru.go.id') }}</span>
                                </li>
                                <li class="pt-2">
                                    <span class="font-medium text-emerald-400 hover:text-emerald-300 transition-colors cursor-pointer">Hubungi via WhatsApp</span>
                                </li>
                                <li class="flex items-center text-slate-300">
                                    <i class="fa-regular fa-clock text-blue-500 mr-3 w-4 text-center"></i>
                                    <span>Senin - Jumat 08:00 - 16:00</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Column: Location Map -->
                    <div class="md:col-span-4 lg:col-span-4">
                        <h4 class="font-bold mb-5 text-white text-base tracking-wide">Lokasi</h4>
                        <div class="bg-white/5 backdrop-blur-md p-1.5 rounded-2xl shadow-xl border border-white/10 relative overflow-hidden group hover:border-white/20 transition-colors">
                            <!-- Google Maps Iframe -->
                            <div class="w-full h-56 bg-slate-800 rounded-xl overflow-hidden relative">
                                <iframe 
                                    src="https://maps.google.com/maps?q=Komplek%20Perkantoran%20Walikota%20Pekanbaru%20Tenayan%20Raya&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="opacity-90 hover:opacity-100 transition-opacity duration-300">
                                </iframe>
                                <!-- Open in Maps Badge -->
                                <a href="https://maps.google.com/?q=Komplek+Perkantoran+Walikota+Pekanbaru+Tenayan+Raya" target="_blank" class="absolute top-3 left-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-lg text-[11px] font-bold text-blue-600 shadow-lg hover:bg-blue-600 hover:text-white transition-all flex items-center gap-1.5 border border-white/50">
                                    Open in Maps <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border-t border-slate-800/80 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-slate-500 text-center md:text-left">
                        &copy; {{ date('Y') }} {{ App\Models\SiteSetting::get('footer_copyright', 'Dinas Komunikasi Informatika Statistik dan Persandian Kota Pekanbaru. All rights reserved.') }}
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="text-xs text-slate-600 font-medium px-3 py-1 bg-slate-800/50 rounded-full border border-slate-700/50">
                            {{ App\Models\SiteSetting::get('footer_version', 'Versi 1.0.0') }}
                        </div>
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
