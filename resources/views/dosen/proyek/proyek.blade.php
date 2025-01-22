<x-dosen-app-layout :title="'Proyek Saya'" :footer="$footer">
    
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebardosen />

        <!-- Main Content -->
        <div class="flex-1 p-6">

            <div class="bg-muda border-gray-300 text-primary items-center justify-center text-center p-8 mb-8 rounded-md shadow-md">
                <h3 class="text-4xl font-bold mb-6">Halo, <span class="text-tertiary">{{ $user->name }}</span></h3>
                <p class="mb-8 text-2xl font-medium">Lihat statistik proyek dan iklan yang anda kelola!</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 justify-center items-center">

                    <!-- Total Proyek Dikelola -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-book text-4xl text-secondary mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">
                            {{ $user->proyekDikelola->count() }}
                        </p>
                        <p class="text-lg font-medium text-gray-500">Total Proyek Dikelola</p>
                    </div>

                    <!-- Total Iklan Dikelola -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-ad text-4xl text-blue-600 mb-4"></i>

                        <p class="text-6xl font-bold text-primary mb-2">
                            {{ $user->iklanDikelola->count() }}
                        </p>
                        <p class="text-lg font-medium text-gray-500">Total Iklan Dikelola</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border-gray-300 text-primary p-8 rounded-md shadow-md">
                <p class="mb-8 text-2xl font-medium">Lihat statistik lengkapmu dan terus tingkatkan performa bersama UPartner!</p>
                
                <!-- Statistik Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Total Proyek Diikuti -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-users text-4xl text-blue-500 mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">{{ $proyek->where('status', 'Diterima')->count() + $user->proyekDikelola->count() }}</p>
                        <p class="text-lg font-medium text-gray-500">Total Proyek Diikuti</p>
                    </div>
        
                    {{-- {{ $proyek->load('proyek'); }} --}}

                    <!-- Total Proyek Selesai -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-trophy text-4xl text-yellow-400 mb-4"></i>

                        <p class="text-6xl font-bold text-primary mb-2">
                            {{ $user->pendaftaran->map(function ($pendaftaran) {
                                return $pendaftaran->proyek->where('status_proyek', 'selesai')->count();
                            })->sum() }}
                        </p>
                        <p class="text-lg font-medium text-gray-500">Total Proyek Selesai</p>
                    </div>
                    
                    <!-- Total Proyek Sedang Berlangsung -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-tasks text-4xl text-green-600 mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">
                            {{ $user->pendaftaran->map(function ($pendaftaran) {
                                return $pendaftaran->proyek->where('status_proyek', 'selesai')->count();
                            })->sum() }}
                        </p>
                        <p class="text-lg font-medium text-gray-500">Total Proyek Sedang Berlangsung</p>
                    </div>
                    
                    <!-- Total Proyek Belum Dimulai -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-hourglass text-4xl text-red-700 mb-4"></i>
                        
                        <p class="text-6xl font-bold text-primary mb-2">
                            {{ $user->pendaftaran->map(function ($pendaftaran) {
                                return $pendaftaran->proyek->where('status_proyek', 'selesai')->count();
                            })->sum() }}
                        </p>
                        <p class="text-lg font-medium text-gray-500">Total Proyek Belum Dimulai</p>
                    </div>

                    <!-- Total Pendaftaran Proyek -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-folder-open text-4xl text-yellow-500 mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">{{ $proyek->count() }}</p>
                        <p class="text-lg font-medium text-gray-500">Total Pendaftaran Proyek</p>
                    </div>
        
                    <!-- Total Pendaftaran Diterima -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-check-circle text-4xl text-green-500 mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">{{ $proyek->where('status', 'Diterima')->count() }}</p>
                        <p class="text-lg font-medium text-gray-500">Total Pendaftaran Diterima</p>
                    </div>
        
                    <!-- Total Pendaftaran Menunggu -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-clock text-4xl text-yellow-500 mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">{{ $proyek->where('status', 'Menunggu')->count() }}</p>
                        <p class="text-lg font-medium text-gray-500">Total Pendaftaran Menunggu</p>
                    </div>
        
                    <!-- Total Pendaftaran Ditolak -->
                    <div class="bg-white text-center p-6 rounded-lg border border-gray-200 data-animate" data-animation="slide-up">
                        <i class="fas fa-times-circle text-4xl text-red-500 mb-4"></i>
                        <p class="text-6xl font-bold text-primary mb-2">{{ $proyek->where('status', 'Ditolak')->count() }}</p>
                        <p class="text-lg font-medium text-gray-500">Total Pendaftaran Ditolak</p>
                    </div>
                </div>
            </div>

        </div>
                
    </div>
</x-dosen-app-layout>
