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
                        <i class="fa-solid fa-circle-check w-10 h-10 text-white flex items-center justify-center"></i>
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
                                <i class="fa-regular fa-envelope w-5 h-5 text-blue-600 flex items-center justify-center"></i>
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
                                <i class="fa-solid fa-lock w-5 h-5 text-amber-600 flex items-center justify-center"></i>
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
                                <i class="fa-solid fa-building w-5 h-5 text-emerald-600 flex items-center justify-center"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.users.export-pdf', $user) }}" 
                        class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold rounded-xl hover:from-red-600 hover:to-pink-600 transition-all shadow-lg shadow-red-500/25">
                        <i class="fa-solid fa-file-arrow-down w-5 h-5 mr-2 flex items-center justify-center"></i>
                        Download PDF
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                        class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all">
                        <i class="fa-solid fa-arrow-right-to-bracket w-5 h-5 mr-2 flex items-center justify-center"></i>
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
