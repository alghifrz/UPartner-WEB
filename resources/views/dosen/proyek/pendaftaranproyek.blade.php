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
                        <a href="pendaftaran-proyek" 
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == null ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Semua Pendaftaran Proyek
                        </a>
                    </li>
                    <li>
                        <a href="pendaftaran-proyek?tab=DITERIMA"
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == 'DITERIMA' ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Pendaftaran Proyek Diterima
                        </a>
                    </li>
                    <li>
                        <a href="pendaftaran-proyek?tab=MENUNGGU"
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == 'MENUNGGU' ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Pendaftaran Proyek Menunggu
                        </a>
                    </li>
                    <li>
                        <a href="pendaftaran-proyek?tab=DITOLAK" 
                           class="py-4 px-4 font-semibold 
                           {{ Request::get('tab') == 'DITOLAK' ? 'text-secondary border-b-4 border-secondary' : 'text-gray-400 hover:text-secondary' }}">
                            Pendaftaran Proyek Ditolak
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
                    @if($proyek->isEmpty())
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki proyek</span>
                            <p class="text-lg mt-2">Belum ada proyek yang terdaftar.</p>
                        </div>            
                    @else
                        <x-listproyekdaftardosen :proyek="$proyek"/>
                    @endif

                @elseif ($tab == 'DITERIMA')
                    @php
                        $proyekDiterima = $proyek->where('status', 'Diterima');
                    @endphp
                    @if($proyekDiterima->isEmpty())                  
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki pendaftaran proyek yang diterima</span>
                            <p class="text-lg mt-2">Belum ada pendaftaran proyek yang diterima</p>
                        </div>            
                    @else
                        <x-listproyekdaftardosen :proyek="$proyekDiterima"/>
                    @endif

                @elseif ($tab == 'MENUNGGU')
                    @php
                        $proyekMenunggu = $proyek->where('status', 'Menunggu');
                    @endphp
                    @if($proyekMenunggu->isEmpty())                
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki pendaftaran proyek yang menunggu</span>
                            <p class="text-lg mt-2">Belum ada pendaftaran proyek yang menunggu.</p>
                        </div>            
                    @else
                        <x-listproyekdaftardosen :proyek="$proyekMenunggu"/>
                    @endif

                @elseif ($tab == 'DITOLAK')
                    @php
                        $proyekDitolak = $proyek->where('status', 'Ditolak');
                    @endphp
                    @if($proyekDitolak->isEmpty())               
                        <div class="flex flex-col mt-64 items-center text-gray-500">
                            <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                            <span class="text-xl font-medium">Kamu belum memiliki pendaftaran proyek yang ditolak</span>
                            <p class="text-lg mt-2">Belum ada pendaftaran proyek yang ditolak.</p>
                        </div>            
                    @else
                        <x-listproyekdaftardosen :proyek="$proyekDitolak"/>
                    @endif

                @endif
            </div>
        </div>
    </div>
</x-dosen-app-layout>

<style> 
    .showPhoto > div { 
        background-size: cover; 
        background-repeat: no-repeat; 
        background-position: center;
    } 
</style>



