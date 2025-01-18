<x-app-layout :title="'Katalog'" :footer="$footer">
    <x-slot name="katalog">
        <h2 class="font-semibold text-2xl flex justify-center items-center text-center text-white mb-6">
            {{$katalog['judul']}}
        </h2>
        <h2 class="font-semibold text-4xl flex justify-center items-center text-center text-white mb-6">
            {{$katalog['quotes'][0]}}
        </h2>
        <h2 class="font-medium text-2xl flex justify-center items-center text-center text-muda mb-6 max-w-5xl break-words mx-auto">
            {{$katalog['quotes'][1]}}
        </h2>
        <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row justify-center items-center gap-0 mb-8 mt-12">
            <!-- Input Pencarian -->
            <input 
                type="text" 
                name="keyword" 
                value="{{ request('keyword') }}"
                placeholder="Cari proyek sesuai judul, deskripsi, atau nama dosen..." 
                class="w-full sm:w-1/3 px-6 py-3 border border-white rounded-l-2xl text-gray-800 text-lg"
            />
            <!-- Tombol Cari -->
            <button 
                type="submit" 
                class="bg-white text-white px-6 py-3 border border-white rounded-r-2xl hover:bg-primary transition text-lg flex items-center justify-center">
                <!-- Ikon Pencarian -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" stroke="gray" stroke-width="2">
                    <path d="M21 21l-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" />
                </svg>
            </button>
        </form>
    </x-slot>

    <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 mt-12">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-3xl text-primary font-bold mb-8">Semua Proyek</h2>
            <a href="javascript:void(0)" onclick="openFilterModal()" class="text-xl text-primary font-bold cursor-pointer hover:text-secondary mb-8 flex">
                Filter
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </a>  
            <!-- Filter Modal -->
            <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
                <div class="bg-white rounded-lg w-1/3 p-6">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Filter Program Studi</h2>
                        <button onclick="closeFilterModal()" class="text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Checkbox List -->
                    <form action="{{ route('katalog') }}" method="GET">
                        <div class="flex flex-col space-y-4">
                            <label class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="select-all" 
                                    class="mr-2"
                                    onchange="toggleSelectAll(this)"
                                    @if(empty(request('program_studi'))) checked @endif> <!-- Pilih Semua secara default jika tidak ada filter -->
                                Pilih Semua
                            </label>
                            @foreach($programStudi as $prodi)
                                <label class="flex items-center">
                                    <input type="checkbox" name="program_studi[]" value="{{ $prodi->prodi_name }}" class="mr-2"
                                    @if(in_array($prodi->prodi_name, request('program_studi', []))) checked @endif>
                                    {{ $prodi->prodi_name }}
                                </label>
                            @endforeach
                        </div>
                    
                        <div class="flex justify-end mt-6">
                            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6">
            @forelse ($proyek as $proyekItem)
                <x-cardproyek :proyek="$proyekItem" :detail="route('detailproyek', $proyekItem)" />
            @empty
                <div class="w-full col-span-full flex justify-center">
                    <div class="w-full col-span-full flex justify-center flex-col items-center text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 22h20L12 2zm0 10v2m0 4h.01" />
                        </svg>
                        @if(request('keyword'))
                            <div class="text-xl font-semibold mb-4">
                                Tidak ada proyek yang ditemukan dengan kata kunci "{{ request('keyword') }}"
                            </div>
                        @elseif(request('program_studi'))
                            <div class="text-xl font-semibold mb-4">
                                Tidak ada proyek yang ditemukan untuk program studi yang dipilih.
                            </div>
                        @else
                            <div class="text-xl font-semibold mb-4">
                                Tidak ada proyek yang ditemukan.
                            </div>
                        @endif

                        <p class="mb-6 text-lg text-gray-700">
                            Tapi tenang saja, kamu bisa melihat proyek lainnya kok.
                        </p>
                        <a href="{{ route('katalog') }}" class="bg-secondary text-white py-2 px-6 rounded-lg font-semibold hover:bg-primary transition">
                            Lihat Semua Proyek
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="flex justify-center mt-24">
            {{ $proyek->appends(request()->query())->links('vendor.pagination.default') }}
        </div>
    </div>
</x-app-layout>
