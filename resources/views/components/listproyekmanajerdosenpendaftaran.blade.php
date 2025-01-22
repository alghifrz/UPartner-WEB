@props(['proyek'])
@php
    $item = $proyek->first()
@endphp
<div class="bg-white shadow-md rounded-3xl justify-between p-6 mb-6">
    <div class="flex gap-7">
        <!-- Icon/Logo for the project -->
        <div class="showPhoto w-[200px] h-[200px] overflow-hidden rounded-3xl">
            <div class="w-full hover:scale-105 duration-500 h-full text-center cursor-pointer" 
                style="background-image:url('{{ Storage::url($item->sampul) }}');">
            </div>
        </div>
        
        <!-- Project Title & Details -->
        <div class="w-[825px] mr-36">
            <div class="flex items-baseline flex-col h-full">
                <div>
                    <?php
                        if ($item->status_proyek == 'belum dimulai') {
                            $color = 'bg-green-200';
                            $font = 'text-green-600';
                            $text = 'Belum Dimulai';
                        } else if ($item->status_proyek == 'selesai') {
                            $color = 'bg-red-200';
                            $font = 'text-red-600';
                        } else {
                            $color = 'bg-yellow-200';
                            $font = 'text-yellow-600';
                        }
                        // Calculate project progress
                        $start_date = new DateTime($item->tanggal_mulai);
                        $end_date = new DateTime($item->tanggal_selesai);
                        $current_date = new DateTime(); // Today's date

                        $total_duration = $start_date->diff($end_date)->days;
                        $elapsed_duration = $start_date->diff($current_date)->days;
                        $progress_percentage = 0;

                        if ($current_date >= $start_date) {
                            $progress_percentage = min(100, ($elapsed_duration / $total_duration) * 100);
                        }
                        ?>
                    {{-- <p class="inline text-xs rounded-full px-2 py-1 font-semibold {{ $font  }} {{ $color }}">{{ $item->proyek->status_proyek }}</p> --}}
                    <h3 class="text-2xl mt-2 font-semibold text-gray-800">{{ $item->judul_proyek }}</h3>
                </div>
                <div class="w-full h-full flex justify-between items-start mt-4">
                    <p class="text-md text-gray-600">Manajer Proyek: <span class="font-semibold text-lg text-secondary">{{ $item->proyekManajer->name }}</span></p>
                    <p class="text-lg text-gray-600 mt-auto text-right">Role: </br><span class="text-2xl font-semibold text-tertiary">Manajer Proyek</span></p>
                </div>

                <!-- Progres Proyek -->
                <div class="w-2/3">
                    <p class="text-md text-gray-600">Progres Proyek: <span class="text-lg font-bold text-tertiary">{{ round($progress_percentage, 1) }}%</span></p>
                    <div class="flex items-center w-full bg-gray-200 rounded-full h-3 mt-2">
                        <div class="bg-tertiary h-3 rounded-full" style="width: {{ $progress_percentage }}%"></div>
                        <!-- Teks persentase di sebelah kanan -->
                    </div>
                </div>
                

            </div>
        </div>
        <div class="flex flex-col space-y-4">
            <a href="" class="text-md bg-secondary hover:bg-primary text-center items-center text-white py-4 w-40 rounded-2xl font-semibold"><i class="fas fa-edit"></i> Edit Proyek</a>

            <button type="submit" class="bg-red-500 hover:bg-red-600 text-md text-center items-center text-white py-4 w-40 rounded-2xl font-semibold" onclick="openModalHapus()">Hapus Proyek</button>
            <!-- Modal Hapus -->
            <div id="hapusModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden opacity-0 transition-opacity duration-300">
                <div id="hapusModalContent" class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative transform scale-95 transition-transform duration-300">
                    <!-- Ikon di bagian atas -->
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-exclamation-circle text-red-500 text-4xl"></i>
                    </div>
                    <!-- Judul dan Pertanyaan -->
                    <h3 class="text-lg font-medium mb-4 text-center">Apakah Anda yakin ingin menghapus proyek ini?</h3>
                    <!-- Tombol Aksi -->
                    <div class="flex justify-center space-x-2">
                        <!-- Tombol Tidak -->
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white w-20 py-2 rounded-lg flex items-center justify-center space-x-1" onclick="closeModalHapus()">
                            <i class="fas fa-times"></i>
                            <span>Tidak</span>
                        </button>
                        <!-- Tombol Ya -->
                        <form action="{{ route('dosen.hapusproyek', ['proyek' => $item->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white w-20 py-2 rounded-lg flex items-center justify-center space-x-1">
                                <i class="fas fa-check"></i>
                                <span>Ya</span>
                            </button>
                        </form>
                    </div>
                    <!-- Close Icon -->
                    <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" onclick="closeModalHapus()">
                        <i class="fas fa-times-circle text-2xl"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-12">
        <h3 class="text-2xl mt-0 font-semibold text-gray-800">Kelola Anggota Tim Proyek</h3>
        <div class="mt-4">
            <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-primary text-center">
                        <th class="border border-gray-300 px-4 py-2 text-center w-8">No</th>
                        <th class="border border-gray-300 px-4 py-2 w-60">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 w-60">Role</th>
                        <th class="border border-gray-300 px-4 py-2 text-center w-52">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($item->pendaftaran->where('status', 'Diterima')->isEmpty())
                        <tr class="border border-gray-300 px-4 py-2 text-center italic">
                            <td colspan="6" class="py-6">Belum ada anggota tim proyek ini</td>
                        </tr>
                    @else
                        @foreach ($item->pendaftaran->where('status', 'Diterima') as $index => $pendaftar)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-4 text-center">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-4">
                                    @if (!empty($pendaftar->id_mahasiswa) && $pendaftar->mahasiswa)
                                        {{ $pendaftar->mahasiswa->name }}
                                    @elseif (!empty($pendaftar->id_dosen) && $pendaftar->dosen)
                                        {{ $pendaftar->dosen->name }}
                                    @else
                                        <span class="text-primary italic">Data tidak tersedia</span>
                                    @endif
                                </td>  
                                <td class="border border-gray-300 px-4 py-4 items-center text-center justify-center">{{ $pendaftar->role }}</td>
                                <td class="border border-gray-300 px-4 py-4 text-center">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm w-52 py-2 rounded-lg" onclick="openModalKeluarkan({{ $pendaftar->id }})">Keluarkan dari Proyek</button>
                                    <div id="keluarkanModal{{ $pendaftar->id }}" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                                            <h3 class="text-lg font-medium mb-4">Apakah Anda yakin ingin mengeluarkan  
                                                @if (!empty($pendaftar->id_mahasiswa) && $pendaftar->mahasiswa)
                                                    {{ $pendaftar->mahasiswa->name }}
                                                @elseif (!empty($pendaftar->id_dosen) && $pendaftar->dosen)
                                                    {{ $pendaftar->dosen->name }}
                                                @endif
                                            dari proyek ini?</h3>
                                            <div class="flex justify-center space-x-2">
                                                <button type="button" class="bg-red-500 text-white w-20 py-2 rounded-lg" onclick="closeModalKeluarkan({{ $pendaftar->id }})">
                                                    Tidak
                                                </button>
                                                <form action="{{ route('dosen.pendaftar.keluarkan', ['proyek' => $item->id, 'pendaftar' => $pendaftar->id]) }}"method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white w-20 py-2 rounded-lg">
                                                        Ya
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>      
    </div>
</div>

<div class="bg-white shadow-md rounded-3xl justify-between p-6 mb-6">
    <div class="mt-0">
        <h3 class="text-2xl mt-2 font-semibold text-gray-800">List Pendaftar Proyek Ini</h3>
        <div class="mt-4">
            <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-primary text-center">
                        <th class="border border-gray-300 px-4 py-2 text-center w-8">No</th>
                        <th class="border border-gray-300 px-4 py-2 w-60">Nama</th>
                        <th class="border border-gray-300 px-4 py-2 w-160">Kemampuan</th>
                        <th class="border border-gray-300 px-4 py-2 w-60">Role</th>
                        <th class="border border-gray-300 px-4 py-2 w-80">Alasan Mendaftar</th>
                        <th class="border border-gray-300 px-4 py-2 text-center w-52">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($item->pendaftaran->where('status', 'Menunggu')->isEmpty())
                        <tr class="border border-gray-300 px-4 py-2 text-center italic">
                            <td colspan="6" class="py-6">Belum ada pendaftar untuk proyek ini</td>
                        </tr>
                    @else
                        @foreach ($item->pendaftaran->where('status', 'Menunggu') as $index => $pendaftar)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-4 text-center">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-4">
                                    @if (!empty($pendaftar->id_mahasiswa) && $pendaftar->mahasiswa)
                                        {{ $pendaftar->mahasiswa->name }}
                                    @elseif (!empty($pendaftar->id_dosen) && $pendaftar->dosen)
                                        {{ $pendaftar->dosen->name }}
                                    @else
                                        <span class="text-primary italic">Data tidak tersedia</span>
                                    @endif
                                </td>                            
                                <td class="border border-gray-300 px-4 py-4">
                                    @php
                                        $kemampuan = json_decode($pendaftar->persyaratan_kemampuan, true);
                                    @endphp
                                
                                    @if (!empty($kemampuan))
                                        <ul>
                                            @foreach ($kemampuan as $kemampuan)
                                                <li>{{ $kemampuan }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-primary italic">Tidak ada persyaratan kemampuan</span>
                                    @endif
                                </td>                            
                                <td class="border border-gray-300 px-4 py-4 items-center text-center justify-center">{{ $pendaftar->role }}</td>
                                <td class="border border-gray-300 px-4 py-4">{{ $pendaftar->alasan_mendaftar }}</td>
                                <td class="border border-gray-300 px-4 py-4 text-center">
                                
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm w-20 py-2 rounded-lg" onclick="openModalTerima({{ $pendaftar->id }})">Terima</button>
                                    <div id="terimaModal{{ $pendaftar->id }}" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                                            <h3 class="text-lg font-medium mb-4">Apakah Anda yakin ingin <span class="font-bold text-green-400">menerima</span> 
                                                @if (!empty($pendaftar->id_mahasiswa) && $pendaftar->mahasiswa)
                                                    {{ $pendaftar->mahasiswa->name }}
                                                @elseif (!empty($pendaftar->id_dosen) && $pendaftar->dosen)
                                                    {{ $pendaftar->dosen->name }}
                                                @endif
                                            gabung ke proyek ini?</h3>
                                            <div class="flex justify-center space-x-2">
                                                <button type="button" class="bg-red-500 text-white w-20 py-2 rounded-lg" onclick="closeModalTerima({{ $pendaftar->id }})">
                                                    Tidak
                                                </button>
                                                <form action="{{ route('dosen.pendaftar.terima', ['proyek' => $item->id, 'pendaftar' => $pendaftar->id]) }}"method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white w-20 py-2 rounded-lg">
                                                        Ya
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm w-20 py-2 rounded-lg" onclick="openModalTolak({{ $pendaftar->id }})">
                                        Tolak
                                    </button>
                                    <div id="tolakModal{{ $pendaftar->id }}" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                                        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                                            <h3 class="text-lg font-medium mb-4">Apakah Anda yakin ingin <span class="font-bold text-red-400">menolak</span> 
                                                @if (!empty($pendaftar->id_mahasiswa) && $pendaftar->mahasiswa)
                                                    {{ $pendaftar->mahasiswa->name }}
                                                @elseif (!empty($pendaftar->id_dosen) && $pendaftar->dosen)
                                                    {{ $pendaftar->dosen->name }}
                                                @endif
                                            gabung ke proyek ini?</h3>
                                            <div class="flex justify-center space-x-2">
                                                <button type="button" class="bg-red-500 text-white w-20 py-2 rounded-lg" onclick="closeModalTolak({{ $pendaftar->id }})">
                                                    Tidak
                                                </button>
                                                <form action="{{ route('dosen.pendaftar.tolak', ['proyek' => $item->id, 'pendaftar' => $pendaftar->id]) }}"method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white w-20 py-2 rounded-lg">
                                                        Ya
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>  
    </div>                                         
</div>


<script>
    // Fungsi untuk membuka modal
    function openModalTerima(pendaftarId) {
        document.getElementById('terimaModal' + pendaftarId).classList.remove('hidden');
    }
    function closeModalTerima(pendaftarId) {
        document.getElementById('terimaModal' + pendaftarId).classList.add('hidden');
    }

    
    function openModalTolak(pendaftarId) {
        document.getElementById('tolakModal' + pendaftarId).classList.remove('hidden');
    }
    function closeModalTolak(pendaftarId) {
        document.getElementById('tolakModal' + pendaftarId).classList.add('hidden');
    }

    function openModalKeluarkan(pendaftarId) {
        document.getElementById('keluarkanModal' + pendaftarId).classList.remove('hidden');
    }
    function closeModalKeluarkan(pendaftarId) {
        document.getElementById('keluarkanModal' + pendaftarId).classList.add('hidden');
    }

    function openModalHapus() {
        const modal = document.getElementById('hapusModal');
        const content = document.getElementById('hapusModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
        }, 10); // Delay untuk memastikan transisi berjalan
    }
    function closeModalHapus() {
        const modal = document.getElementById('hapusModal');
        const content = document.getElementById('hapusModalContent');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Durasi sesuai dengan transition-opacity/transform
    }


</script>
