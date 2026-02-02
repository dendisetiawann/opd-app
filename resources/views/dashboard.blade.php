<x-app-layout>

    <!-- Main Container -->
    <div class="py-6 sm:py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Section -->
            <div class="relative bg-white overflow-hidden shadow-lg sm:rounded-2xl mb-8 border border-gray-100">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-blue-600 rounded-full opacity-10 blur-xl"></div>
                
                <div class="relative p-8 sm:p-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                        <div>
                            <div class="inline-flex items-center space-x-2 bg-blue-50 px-3 py-1 rounded-full text-xs font-semibold text-blue-700 mb-3 border border-blue-100">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                <span>Panel OPD</span>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                                Halo, {{ Auth::user()->name }}
                            </h1>
                            <p class="mt-2 text-gray-500 max-w-2xl">
                                Selamat datang di Sistem Manajemen Data Aplikasi. Anda login sebagai pengelola untuk 
                                <span class="font-semibold text-gray-700">{{ Auth::user()->opd->nama_opd }}</span>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats & Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Stat Card: Total Apps -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-600 flex items-center justify-between group">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Aplikasi</p>
                        <h3 class="text-3xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $totalApps }}</h3>
                        <p class="text-xs text-green-600 mt-1 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Terdata sistem
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>

                <!-- Action Card: Add New -->
                <a href="{{ route('web-apps.create') }}" class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-lg shadow-blue-200 hover:shadow-blue-300 transition-all p-6 flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div>
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center text-white mb-4 backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">Input Aplikasi Baru</h3>
                        <p class="text-blue-100 text-sm">Tambahkan data aplikasi OPD Anda ke dalam sistem.</p>
                    </div>
                    <div class="mt-4 flex items-center text-white text-sm font-medium">
                        Mulai Input 
                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </a>
            </div>

            <!-- Footer Note -->
            <div class="mt-8 text-center sm:text-left text-xs text-gray-400">
                &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
            </div>
        </div>
    </div>
</x-app-layout>
