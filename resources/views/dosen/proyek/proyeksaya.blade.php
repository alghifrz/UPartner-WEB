<x-dosen-app-layout :title="'Proyek Saya'" :footer="$footer">
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebardosen />

        <!-- Main Content -->
        <div class="mx-6 flex-1 p-6">
            <!-- Tabs -->
            <div class="mb-16 mt-6">
                <ul class="flex space-x-12 text-lg">
                    <li>
                        <a href="/proyek/proyek-saya" 
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == null ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Semua Proyek
                        </a>
                    </li>
                    <li>
                        <a href="/proyek/proyek-saya?tab=BELUM_MULAI" 
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == 'BELUM_MULAI' ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Proyek Belum Mulai
                        </a>
                    </li>
                    <li>
                        <a href="/proyek/proyek-saya?tab=SEDANG_BERLANGSUNG" 
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == 'SEDANG_BERLANGSUNG' ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Proyek Sedang Berlangsung
                        </a>
                    </li>
                    <li>
                        <a href="/proyek/proyek-saya?tab=SELESAI" 
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == 'SELESAI' ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Proyek Selesai
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div>
                @php
                    $tab = Request::get('tab');
                @endphp

                @if ($tab == null)
                    @php
                        $semuaproyek = $proyek->where('status', 'Diterima')
                    @endphp
                    @if($semuaproyek->isEmpty())
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki proyek</span>
                            <p class="text-lg mt-2">Belum ada proyek yang terdaftar.</p>
                        </div>            
                    @else
                        <x-listproyek :proyek="$semuaproyek"/>
                    @endif

                @elseif ($tab == 'BELUM_MULAI')
                    @php
                        $proyekBelumMulai = $proyek
                            ->where('status', 'Diterima') 
                            ->filter(function ($pendaftaran) {
                                return isset($pendaftaran->proyek) && $pendaftaran->proyek->status_proyek === 'belum mulai';
                            })
                            ->values(); 
                    @endphp
                    @if($proyekBelumMulai->isEmpty())                    
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki proyek yang belum mulai</span>
                            <p class="text-lg mt-2">Belum ada proyek yang belum mulai</p>
                        </div>            
                    @else
                        <x-listproyek :proyek="$proyekBelumMulai"/>
                    @endif

                @elseif ($tab == 'SEDANG_BERLANGSUNG')
                    @php
                        $proyekberlangsung = $proyek
                            ->where('status', 'Diterima') 
                            ->filter(function ($pendaftaran) {
                                return isset($pendaftaran->proyek) && $pendaftaran->proyek->status_proyek === 'sedang berlangsung';
                            })
                            ->values(); 
                    @endphp
                    @if($proyekberlangsung->isEmpty())                    
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki proyek yang sedang berlangsung</span>
                            <p class="text-lg mt-2">Belum ada proyek yang sedang berlangsung.</p>
                        </div>            
                    @else
                        <x-listproyek :proyek="$proyekberlangsung"/>
                    @endif

                @elseif ($tab == 'SELESAI')
                    @php
                        $proyekselesai = $proyek
                            ->where('status', 'Diterima') 
                            ->filter(function ($pendaftaran) {
                                return isset($pendaftaran->proyek) && $pendaftaran->proyek->status_proyek === 'selesai';
                            })
                            ->values(); 
                    @endphp
                    @if($proyekselesai->isEmpty())                 
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki proyek yang selesai</span>
                            <p class="text-lg mt-2">Belum ada proyek yang selesai.</p>
                        </div>            
                    @else
                        <x-listproyek :proyek="$proyekselesai"/>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-dosen-app-layout>


