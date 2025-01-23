<x-app-layout :title="'Daftar Pengguna'" :footer="$footer">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center text-white mb-6">
            <i class="fas fa-users"></i> Explore Daftar Pengguna
        </h2>
    </x-slot>

    <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 mt-12">
        <div class="bg-white shadow-lg p-8 rounded-lg mb-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fas fa-filter text-primary"></i> Filter dan Pencarian
            </h3>

            <form action="{{ route('pengguna') }}" method="GET" class="justify-end">
                <!-- Search Bar -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label for="search" class="block text-lg font-semibold text-primary mb-2">
                            <i class="fas fa-search text-tertiary"></i> Cari Nama
                        </label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               placeholder="Cari berdasarkan nama..." 
                               class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                    </div>
    
                    <!-- Filter Program Studi -->
                    <div>
                        <label for="prodi" class="block text-lg font-semibold text-primary mb-2">
                            <i class="fas fa-graduation-cap text-tertiary"></i> Program Studi
                        </label>
                        <select name="prodi" id="prodi" class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                            <option value="">Pilih Program Studi</option>
                            @foreach($programStudi as $prodi)
                                <option value="{{ $prodi->prodi_name }}" @if(request('prodi') == $prodi->prodi_name) selected @endif>{{ $prodi->prodi_name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <!-- Filter Role -->
                    <div>
                        <label for="role" class="block text-lg font-semibold text-primary mb-2">
                            <i class="fas fa-user-tag text-tertiary"></i> Role
                        </label>
                        <select name="role" id="role" class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                            <option value="" disabled>Pilih Role</option>
                            <option value="semua"  @if(request('role') == 'semua') selected @endif>Semua Role</option>
                            <option value="mahasiswa" @if(request('role') == 'mahasiswa') selected @endif>Mahasiswa</option>
                            <option value="dosen" @if(request('role') == 'dosen') selected @endif>Dosen</option>
                        </select>                    
                    </div>
    
                    <!-- Sorting -->
                    <div>
                        <label for="sort" class="block text-lg font-semibold text-primary mb-2">
                            <i class="fas fa-sort text-tertiary"></i> Urutkan
                        </label>
                        <select name="sort" id="sort" class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                            <option value="">Urutkan Berdasarkan</option>
                            <option value="upoint" @if(request('sort') == 'upoint') selected @endif>UPoint Tertinggi</option>
                            <option value="name" @if(request('sort') == 'name') selected @endif>Nama A-Z</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 w-full justify-end items-end">
                    <!-- Tombol Terapkan Filter -->
                    <button type="submit" class="bg-secondary text-white px-6 py-3 rounded-lg shadow-lg hover:bg-primary transition flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> Terapkan Filter
                    </button>
                </div>

            </form>

        </div>

        <!-- User Cards -->
        <div class="flex flex-col space-y-4">
            @foreach ($users as $user)
                <div class="w-full p-6 border bg-white border-gray-200 rounded-3xl flex flex-col items-start">
                    <div class="flex items-center px-4 justify-between w-full">
                        <div class="flex items-center space-x-4">
                            <div class="rounded-full mx-auto w-[50px] sm:w-[100px] lg:w-[150px] xl:w-[200px] h-[50px] sm:h-[100px] lg:h-[150px] xl:h-[200px] bg-white shadow data-animate"
                                 data-animation="slide-up"
                                 style="background-image: url('{{ asset($user->photo) }}'); background-size: cover;">
                             </div>
                             <div class="flex flex-col space-y-1">
                                 <h3 class="text-3xl font-bold text-primary">{{ $user->name }}</h3>
                                 <p class="text-xl text-secondary font-semibold">{{ $user->prodi->prodi_name }}</p>
                            </div>
                        </div>
                        <div class="text-lg font-semibold bg- p-6 rounded-3xl border border-gray-200 text-secondary">
                            @php
                                if ($user->nip) {
                                    $UPoint = $user->proyekDikelola->count() + $user->pendaftaran->where('status', 'Diterima')->count();
                                } else {
                                    $UPoint = $user->pendaftaran->where('status', 'Diterima')->count();
                                }
                            @endphp
                            <div class="flex flex-col justify-center items-center text-center">
                                <span class="text-6xl font-bold text-tertiary">{{ $UPoint }}</span> 
                                <p>Proyek Kontribusi</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="flex justify-center mt-12">
            {{ $users->appends(request()->query())->links('vendor.pagination.default') }}
        </div>
    </div>
</x-app-layout>
