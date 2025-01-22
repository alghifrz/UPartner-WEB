<x-dosen-app-layout :title="'Proyek Saya'" :footer="$footer">
    <x-popupdaftar></x-popupdaftar>
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebardosen />
        
        <!-- Main Content -->
        <div class="flex-1 p-6">
            @php
                $tab = Request::get('tab');
            @endphp

            @if ($tab==null)
                <div class="flex space-x-4 mb-2">
                    <i class="fas fa-project-diagram text-3xl text-center text-tertiary"></i>
                    <h3 class="text-3xl font-bold mb-6 text-primary">Kelola Proyek</h3>
                </div>
                @php
                    $proyekmanajer = $user->proyekDikelola
                @endphp
                @if($proyekmanajer->isEmpty())                 
                    <div class="flex flex-col mt-64 items-center text-gray-500">
                        <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                        <span class="text-xl font-medium">Proyek Kamu Belum Ada</span>
                    </div>            
                @else
                    <x-listproyekmanajerdosen :proyek="$proyekmanajer" />
                @endif

            @else 
                <div class="flex space-x-4 mb-2">
                    <i class="fas fa-project-diagram text-3xl text-center text-tertiary"></i>
                    <h3 class="text-3xl font-bold mb-6 text-primary">Kelola Proyek</h3>
                </div>
                @php
                    $proyekmanajer = $user->proyekDikelola
                @endphp
                @if($proyekmanajer->isEmpty())                 
                    <div class="flex flex-col mt-64 items-center text-gray-500">
                        <i class="fas fa-file-alt text-6xl mb-4 text-red-500"></i>
                        <span class="text-xl font-medium">Proyek Kamu Belum Ada</span>
                    </div>            
                @else
                    <x-listproyekmanajerdosenpendaftaran :proyek="$proyekmanajer" />
                @endif
            @endif

        </div>
                
    </div>
</x-dosen-app-layout>
