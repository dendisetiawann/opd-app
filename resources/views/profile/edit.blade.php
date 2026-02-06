<x-app-layout>
    <!-- Background Abstract shapes -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-[20%] -right-[10%] w-[700px] h-[700px] bg-gradient-to-br from-indigo-100/40 to-indigo-50/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-[40%] -left-[10%] w-[500px] h-[500px] bg-gradient-to-tr from-blue-100/30 to-indigo-100/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-10 text-center animate-fade-in-up">
                <span class="inline-block p-3 rounded-2xl bg-white shadow-sm border border-indigo-50 mb-4 animate-bounce-slow">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </span>
                <h2 class="text-4xl font-black text-slate-800 tracking-tight leading-tight">
                    Pengaturan Profil
                </h2>
                <p class="mt-3 text-slate-500 text-lg max-w-2xl mx-auto">
                    Kelola informasi akun Anda, perbarui password, dan atur keamanan privasi di satu tempat yang terintegrasi.
                </p>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Navigation / Summary -->
                <div class="lg:col-span-4 space-y-6 animate-fade-in-left">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-xl shadow-indigo-100/50 border border-slate-50 relative overflow-hidden group">
                        <!-- Pure Indigo Gradient matching Sidebar Active State -->
                        <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-indigo-600 to-indigo-800"></div>
                        <div class="relative pt-12 text-center">
                            <!-- Profile Photo with Upload -->
                            <div class="relative inline-block">
                                <div class="h-24 w-24 mx-auto rounded-full border-4 border-white shadow-lg bg-white p-1 overflow-hidden">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo" class="h-full w-full rounded-full object-cover">
                                    @else
                                        <div class="h-full w-full rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-2xl font-bold text-white uppercase">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Upload Button Overlay -->
                                <label for="photo-upload" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </label>
                            </div>
                            
                            <!-- Hidden Form for Photo Upload -->
                            <form id="photo-form" action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" class="hidden">
                                @csrf
                                <input type="file" id="photo-upload" name="photo" accept="image/*" onchange="document.getElementById('photo-form').submit()">
                            </form>
                            
                            <!-- Photo Action Buttons -->
                            <div class="mt-3 flex items-center justify-center gap-2">
                                <label for="photo-upload" class="px-3 py-1.5 rounded-lg bg-indigo-100 text-indigo-700 text-xs font-semibold cursor-pointer hover:bg-indigo-200 transition-colors">
                                    {{ Auth::user()->profile_photo ? 'Ganti Foto' : 'Unggah Foto' }}
                                </label>
                                @if(Auth::user()->profile_photo)
                                    <form action="{{ route('profile.photo.remove') }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                            
                            <!-- Status Messages -->
                            @if(session('status') === 'photo-updated')
                                <p class="mt-2 text-sm text-emerald-600 font-medium">Foto berhasil diperbarui!</p>
                            @endif
                            @if(session('status') === 'photo-removed')
                                <p class="mt-2 text-sm text-slate-500 font-medium">Foto berhasil dihapus.</p>
                            @endif
                            @error('photo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <h3 class="mt-4 text-xl font-bold text-slate-800">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-slate-500 font-medium">{{ Auth::user()->email }}</p>
                            
                            <div class="mt-8 space-y-4 border-t border-slate-100 pt-6">
                                <div class="flex flex-col items-center">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 opacity-80">Status Akun</span>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-100 shadow-sm">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                        Akun Aktif
                                    </span>
                                </div>
                                
                                <div class="flex flex-col items-center">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 opacity-80">Organisasi Perangkat Daerah (OPD)</span>
                                    <div class="px-4 py-2 bg-slate-50 rounded-xl text-center border border-slate-100 w-full">
                                        <p class="text-sm font-bold text-slate-700 leading-snug">
                                            {{ Auth::user()->opd ? Auth::user()->opd->nama_opd : 'Belum Terdaftar' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Delete Account Card -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-red-50 relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                        
                        <h4 class="text-base font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus Akun
                        </h4>
                        <p class="text-sm text-slate-500 mb-4 leading-relaxed">
                            Tindakan ini permanen. Seluruh data aplikasi yang terkait dengan akun ini akan ikut terhapus.
                        </p>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

                <!-- Right Column: Forms -->
                <div class="lg:col-span-8 space-y-8 animate-fade-in-up delay-100">
                    
                    <!-- Update Info Form -->
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-50/50 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold text-slate-800 mb-1 flex items-center gap-2">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884-.956 2.016-1.5 2.016a5.5 5.5 0 010-11.033A5.5 5.5 0 005.25 4.5"></path></svg>
                                Informasi Profil
                            </h3>
                            <p class="text-sm text-slate-500 mb-8">Perbarui nama tampilan dan alamat email akun Anda.</p>
                            
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Form -->
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-500/10 rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold text-slate-800 mb-1 flex items-center gap-2">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Perbarui Password
                            </h3>
                            <p class="text-sm text-slate-500 mb-8">Pastikan akun Anda aman dengan password yang kuat (minimal 8 karakter).</p>
                            
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-fade-in-left {
            animation: fadeInLeft 0.6s ease-out forwards;
        }
        .animate-bounce-slow {
            animation: bounceSlow 3s infinite ease-in-out;
        }
        .delay-100 {
            animation-delay: 0.1s;
        }
    </style>
</x-app-layout>
