@extends('layouts.admin-simple')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 flex items-center justify-center py-12 px-4">
    <div class="max-w-lg w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header with celebration -->
            <div class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 px-8 py-10 text-center relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                
                <!-- Success icon -->
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4 ring-4 ring-white/30">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white mb-2">User Berhasil Dibuat!</h1>
                    <p class="text-white/80 text-sm">Akun baru telah terdaftar dalam sistem</p>
                </div>
            </div>
            
            <!-- User Info Card -->
            <div class="px-8 py-8">
                <!-- Avatar & Name -->
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                
                <!-- Credentials -->
                <div class="space-y-4 mb-6">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">Email</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    @if(session('generated_password'))
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs text-amber-600 uppercase tracking-wide font-medium mb-1">Password</p>
                                <p class="text-lg font-mono font-bold text-amber-800 tracking-wider">{{ session('generated_password') }}</p>
                                <p class="text-xs text-amber-600 mt-1">⚠️ Simpan password ini! Hanya ditampilkan sekali.</p>
                            </div>
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium mb-1">OPD</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $user->opd->nama_opd ?? 'N/A' }}</p>
                            </div>
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.users.export-pdf', $user) }}" 
                        class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold rounded-xl hover:from-red-600 hover:to-pink-600 transition-all shadow-lg shadow-red-500/25">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download PDF
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                        class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru
        </p>
    </div>
</div>
@endsection
