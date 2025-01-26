<x-layoutguest :title="'Daftar Pengguna'" :footer="$footer">
    <x-slot name="detail">
        <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 flex flex-col items-center py-12">
            <h2 class="font-bold text-4xl text-center text-primary mb-6">
                <i class="fas fa-users mr-2"></i> Explore Daftar Pengguna
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl mb-12">
                <!-- Total Pengguna -->
                <div class="bg-white shadow-lg rounded-xl p-6 text-center flex flex-col items-center space-y-4 data-animate" data-animation="slide-up">
                    <div class="text-5xl font-bold text-primary">
                        <i class="fas fa-users fa-fw"></i> {{ $mahasiswa->count() + $dosen->count() }}
                    </div>
                    <div class="text-lg text-secondary">Total Pengguna</div>
                </div>
                
                <!-- Dosen -->
                <div class="bg-white shadow-lg rounded-xl p-6 text-center flex flex-col items-center space-y-4 data-animate" data-animation="slide-up">
                    <div class="text-5xl font-bold text-green-600">
                        <i class="fas fa-chalkboard-teacher fa-fw"></i> {{ $dosen->count() }}
                    </div>
                    <div class="text-lg text-secondary">Dosen</div>
                </div>

                <!-- Mahasiswa -->
                <div class="bg-white shadow-lg rounded-xl p-6 text-center flex flex-col items-center space-y-4 data-animate" data-animation="slide-up">
                    <div class="text-5xl font-bold text-blue-600">
                        <i class="fas fa-graduation-cap fa-fw"></i> {{ $mahasiswa->count() }}
                    </div>
                    <div class="text-lg text-secondary">Mahasiswa</div>
                </div>

            </div>
            
            <div class="bg-secondary shadow-lg p-8 rounded-2xl transform transition-all">
                <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                    <i class="fas fa-filter text-muda"></i> Filter dan Pencarian Lanjutan
                </h3>

                <form action="{{ route('penggunaguest') }}" method="GET" id="user-filter-form">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Instant Search -->
                        <div>
                            <label class="block text-lg font-semibold text-white mb-2">
                                <i class="fas fa-search text-muda"></i> Cari Cepat
                            </label>
                            <input type="text" id="instant-search" placeholder="Cari nama atau prodi..." 
                                   class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                        </div>

                        <!-- Existing filter dropdowns remain the same -->
                        <div>
                            <label for="prodi" class="block text-lg font-semibold text-white mb-2">
                                <i class="fas fa-graduation-cap text-muda"></i> Program Studi
                            </label>
                            <select name="prodi" id="prodi" class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                                <option value="">Pilih Program Studi</option>
                                @foreach($programStudi as $prodi)
                                    <option value="{{ $prodi->id }}" @if(request('prodi') == $prodi->id) selected @endif>
                                        {{ $prodi->prodi_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="role" class="block text-lg font-semibold text-white mb-2">
                                <i class="fas fa-user-tag text-muda"></i> Role
                            </label>
                            <select name="role" id="role" class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                                <option value="" disabled>Pilih Role</option>
                                <option value="semua" @if(request('role') == 'semua') selected @endif>Semua Role</option>
                                <option value="mahasiswa" @if(request('role') == 'mahasiswa') selected @endif>Mahasiswa</option>
                                <option value="dosen" @if(request('role') == 'dosen') selected @endif>Dosen</option>
                            </select>                    
                        </div>

                        <div>
                            <label for="sort" class="block text-lg font-semibold text-white mb-2">
                                <i class="fas fa-sort text-muda"></i> Urutkan
                            </label>
                            <select name="sort" id="sort" class="w-full px-6 py-3 border border-gray-300 rounded-lg text-gray-800 text-lg">
                                <option value="" @if(!request('sort')) selected @endif>Tidak diurutkan</option>
                                <option value="upoint" @if(request('sort') == 'upoint') selected @endif>UPoint Tertinggi</option>
                                <option value="nameasc" @if(request('sort') == 'nameasc') selected @endif>Nama A-Z</option>
                                <option value="namedsc" @if(request('sort') == 'namedsc') selected @endif>Nama Z-A</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="reset" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-undo"></i> Reset Filter
                        </button>
                        <button type="submit" class="bg-white text-secondary px-6 py-3 rounded-lg shadow-lg hover:bg-gray-300 transition flex items-center gap-2">
                            <i class="fas fa-check-circle"></i> Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </x-slot>
    

    <div class="bg-background min-h-screen py-12">
        <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8">
            <!-- Advanced Filter Section -->


            <!-- User Cards Section -->
            <div class="grid md:grid-cols-1 lg:grid-cols-1 gap-6">
                @foreach ($users as $user)
                    <div class="user-card bg-white border border-gray-200 rounded-3xl p-6 shadow-md 
                                hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] data-animate" data-animation="slide-up">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="user-avatar rounded-full w-[150px] h-[150px] 
                                            bg-cover shadow-lg border-4 border-blue-100"
                                     style="background-image: url('{{ asset($user->photo) }}')">
                                </div>

                                <div class="flex flex-col space-y-2">
                                    @php
                                        $role = (isset($user->nip) && strlen($user->nip) === 6) ? 'Dosen' : 'Mahasiswa';
                                        
                                        $pendaftaranMahasiswa = $user->pendaftaran->whereNotNull('id_mahasiswa');

                                        $UPoint = ($role === 'Dosen')
                                            ? $user->proyekDikelola->count() + $user->pendaftaran->where('status', 'Diterima')->count()
                                            : $pendaftaranMahasiswa->where('status', 'Diterima')->count();
                                    @endphp


                                    <div class="flex items-center space-x-2">
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                            {{ $role }}
                                        </span>
                                    </div>

                                    <h3 class="text-3xl font-bold text-primary user-name">{{ $user->name }}</h3>
                                    
                                    <p class="text-xl text-secondary flex items-center">
                                        <i class="fas fa-graduation-cap mr-2"></i>
                                        {{ $user->prodi->prodi_name }}
                                    </p>
                                    
                                    <h3 class="text-lg font-medium text-tertiary user-name">{{ $user->email }}</h3>
                                  
                                </div>
                            </div>

                            <div class="flex flex-col items-center space-y-4">
                                @if(request('role') == 'mahasiswa' || request('role') == 'dosen')
                                    <div class="text-center bg-blue-50 p-6 rounded-3xl border border-blue-200">
                                        <span class="text-6xl font-bold text-tertiary">{{ $UPoint }}</span>
                                        <p class="text-lg text-secondary">Proyek Kontribusi</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        @php
                                            $mhs = null;
                                            $dsn = null;
                                            if($role == 'Mahasiswa') {
                                                $mhs = $mahasiswa->where('nim', $user->nim)->first();
                                            } else {
                                                $dsn = $dosen->where('nip', $user->nip)->first();
                                            }
                                        @endphp
                                        
                                        @if($mhs)
                                            <a href="{{ route('lihatprofilguest', $mhs) }}" class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-primary transition">
                                                <i class="fas fa-user mr-2"></i>Lihat Profil
                                            </a>
                                        @elseif($dsn)
                                            <a href="{{ route('lihatprofildosenguest', $dsn) }}" class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-primary transition">
                                                <i class="fas fa-user mr-2"></i>Lihat Profil
                                            </a>
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                {{ $users->appends(request()->query())->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>

    <!-- Instant Search JavaScript -->
    <script>
        document.getElementById('instant-search').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const cards = document.querySelectorAll('.user-card');
            
            cards.forEach(card => {
                const name = card.querySelector('.user-name').textContent.toLowerCase();
                const prodi = card.querySelector('.user-name + p').textContent.toLowerCase();
                
                card.style.display = (name.includes(query) || prodi.includes(query)) 
                    ? 'block' 
                    : 'none';
            });
        });
    </script>
</x-layoutguest>
