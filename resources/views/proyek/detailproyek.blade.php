<x-app-layout :title="'Detail Proyek'" :footer="$footer">
    <x-popupdaftar></x-popupdaftar>
    <x-slot name="headerdetail">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Detail Proyek') }}
        </h2>
    </x-slot>

    <x-slot name="detail">
        <div class="py-12 bg-white">
            <div class="mx-56 flex justify-between space-x-12 items-start">
                <div class="showPhoto w-[800px] h-[500px] overflow-hidden rounded-3xl">
                    <div class="w-full hover:scale-105 duration-500 h-full text-center cursor-pointer" 
                        style="background-image:url('{{ Storage::url($proyek->sampul) }}');">
                    </div>
                </div>
                <div class="w-[800px] h-[500px] flex flex-col justify-between">
                    <div>
                        <h1 class="text-2xl mb-4 leading-snug font-bold text-secondary">Judul Proyek</h1>
                        <h1 class="text-5xl leading-snug font-bold text-primary">{{ $proyek->judul_proyek }}</h1>
                    </div>
                    <?php
                        $now = date('Y-m-d H:i:s');
                        $Mendaftar = DB::table('pendaftarans')
                                        ->where('id_mahasiswa', $user->id)
                                        ->where('id_proyek', $proyek->id);
                        $sudahMendaftar = $Mendaftar->exists();
                        $terima = $Mendaftar->clone()->where('status', 'Diterima')->exists();
                        $tolak = $Mendaftar->clone()->where('status', 'Ditolak')->exists();
                        if ($proyek->tanggal_selesai < $now) {
                            echo '<div>
                            <p class="text-xl mb-3 italic leading-relaxed font-medium text-gray-500 text-justify">Yah, pendaftaran sudah tutup. Nantikan kesempatan selanjutnya!</p>
                            <div href="" class=" text-white text-2xl mb-3 rounded-full bg-gray-300 font-semibold py-6 w-80 items-center flex justify-center">Pendaftaran Ditutup</div>
                            </div>';
                        } elseif ($sudahMendaftar) {
                            if ($terima) {
                                echo '<div>
                                    <p class="text-xl mb-3 italic leading-relaxed font-medium text-secondary text-justify"> Anda diterima di proyek ini. Silahkan lihat proyek Anda!</p>
                                    <a href="' . route('proyekdetail', $proyek) . '" class="cursor-pointer text-white text-2xl mb-3 rounded-full bg-secondary hover:bg-primary font-semibold py-6 w-64 items-center flex justify-center">Lihat Proyek</a>
                                </div>';
                            } elseif ($tolak) {
                                echo '<div>
                                    <p class="text-xl mb-3 italic leading-relaxed font-medium text-red-500 text-justify">Anda ditolak untuk bergabung proyek ini. Jangan putus asa, cari proyek lain!</p>
                                    <div class="text-red-600 text-2xl mb-3 rounded-full bg-red-300 font-semibold py-6 w-80 items-center flex justify-center">Ditolak</div>
                                </div>';
                            } else {
                                echo '<div>
                                    <p class="text-xl mb-3 italic leading-relaxed font-medium text-gray-500 text-justify">Kamu sudah mendaftar untuk proyek ini. Silahkan menunggu informasi selanjutnya. Terima kasih!</p>
                                    <div class="text-white text-2xl mb-3 rounded-full bg-gray-300 font-semibold py-6 w-80 items-center flex justify-center">Sudah Daftar</div>
                                </div>';
                            }
                        } else {
                            echo '<div>
                            <p class="text-xl mb-3 italic leading-relaxed font-medium text-gray-500 text-justify">Yuk, buruan daftar sekarang sebelum terlambat!</p>
                            <div id="openModalBtn" class="cursor-pointer text-white text-2xl mb-3 rounded-full bg-secondary hover:bg-primary font-semibold py-6 w-64 items-center flex justify-center">
                                Daftar Proyek
                            </div>
                            </div>';
                        }
                    ?>
                <x-daftarproyek :proyek="$proyek" :user="$user" />
            </div>
        </div>
    </x-slot>
    
    <div class="flex mt-12 space-x-6 justify-between px-8 mx-48 bg-background">
        <div class="w-3/4 p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
            <h1 class="text-4xl mb-4 font-bold text-secondary">Deskripsi Proyek</h1>
            <h1 class="text-xl leading-relaxed font-medium text-primary text-justify">{{ $proyek->deskripsi_proyek }}</h1>
        </div>
        <div class="w-1/4 flex flex-col space-y-6">
            <div class="p-12 bg-secondary rounded-3xl flex flex-col border border-secondary items-center justify-center"\>
                <h1 class="text-2xl mb-4 font-bold text-white">Manajer Proyek</h1>
                <div class="mb-4 showPhoto w-[200px] bg-secondary h-[200px] overflow-hidden rounded-full"
                    style="background-image:url('{{ asset($proyek->proyekManajer->photo) }}'); background-size: cover;">
                </div>
                <h1 class="text-xl font-semibold text-white">{{ $proyek->proyekManajer->name }}</h1>
                <h1 class="text-lg font-bold text-muda">{{ $proyek->proyekManajer->prodi->prodi_name }}</h1>
            </div>
            <?php
                $start_date = new DateTime($proyek->tanggal_mulai);
                $end_date = new DateTime($proyek->tanggal_selesai);

                if ($end_date) {
                    $interval = $start_date->diff($end_date);
                    $duration = $interval->days . ' hari';
                } else {
                    $duration = 'Durasi tidak tersedia';
                }
            ?>
            <div class="p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
                <h1 class="text-2xl mb-4 font-bold text-secondary text-center">Jadwal Proyek</h1>
                
                <div class="flex space-x-3 py-3 items-center border-b border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M3 10h18M4 6h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
                    </svg>
                    <div class="flex flex-col items-start">
                        <h1 class="text-lg font-semibold pl-0 text-primary">Tanggal Mulai</h1>
                        <h1 class="text-xl font-medium pl-0 mx-0 text-black">{{ $proyek->tanggal_mulai->format("d-m-Y") }}</h1>
                    </div>
                </div>
                <div class="flex space-x-3 py-3 items-center border-b border-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-tertiary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M3 10h18M4 6h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
                    </svg>
                    <div class="flex flex-col items-start">
                        <h1 class="text-lg font-semibold pl-0 text-primary">Tanggal Selesai</h1>
                        <h1 class="text-xl font-medium pl-0 mx-0 text-black">{{ $proyek->tanggal_selesai->format("d-m-Y") }}</h1>
                    </div>
                </div>
                  
                <h1 class="text-xl text-center font-semibold text-primary">Durasi: <span class="text-tertiary text-3xl">{{ $duration }}</span></h1>
                
            </div>
        </div>
    </div>

    <div class="mt-6 px-12 mx-56 p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
        <h1 class="text-2xl mb-4 font-bold text-secondary">Linimasa Proyek</h1>
        <div id="calendar" class="mt-6 min-h-[600px]"></div>
        <div class="mt-8 flex flex-col space-y-4">
            <h2 class="text-lg font-semibold text-secondary">Keterangan:</h2>
            <div class="flex items-center space-x-4">
                <div class="w-4 h-4 rounded bg-linimasa opacity-50"></div>
                <span class="text-gray-700">Durasi Proyek</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-4 h-4 bg-green-500 rounded"></div>
                <span class="text-gray-700">Kegiatan yang sudah selesai</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-4 h-4 bg-blue-500 rounded"></div>
                <span class="text-gray-700">Kegiatan yang sedang berjalan</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-4 h-4 bg-yellow-500 rounded"></div>
                <span class="text-gray-700">Kegiatan yang belum dimulai</span>
            </div>
        </div>
    </div>

    <div class="flex mt-0 space-x-6 justify-around px-8 mx-48">
        <div class="w-1/2 mt-6 px-12 p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
            <h1 class="text-2xl mb-4 font-bold text-secondary">Persyaratan Kemampuan</h1>
            <ul class="list-disc pl-5">
                @foreach ($proyek->persyaratan_kemampuan as $key => $item)
                    <li class="text-xl mb-4 font-medium text-primary">
                        {{ htmlspecialchars($item['nama']) }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-1/2 mt-6 px-12 p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
            <h1 class="text-2xl mb-4 font-bold text-secondary">Role yang tersedia</h1>
            <ul class="list-disc pl-5">
                @foreach ($proyek->role as $key => $item)
                    <li class="text-xl mb-4 font-medium text-primary">
                        {{ htmlspecialchars($item['nama']) }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-6 px-12 mx-56 p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
        <h1 class="text-2xl mb-4 font-bold text-secondary">Tim Proyek</h1>
        <div class="flex flex-wrap gap-8 justify-center">
            @php
                $anggota = $proyek->pendaftaran->where('status', 'Diterima');
                $pm = $proyek->proyekManajer;
            @endphp
            
            <div class="w-60 rounded-lg flex flex-col items-center justify-center">
                <a href="{{ route('lihatprofildosen', $pm) }}" class="mb-4 rounded-full mx-auto w-[50px] sm:w-[100px] lg:w-[150px] xl:w-[200px] h-[50px] sm:h-[100px] lg:h-[150px] xl:h-[200px] bg-white shadow data-animate relative group"
                data-animation="slide-up"
                style="background-image: url('{{ asset($proyek->proyekManajer->photo) }}'); background-size: cover;">
                    <div class="absolute inset-0 bg-gray-100 bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center rounded-full transition-opacity duration-300">
                        <span class="text-primary font-semibold text-lg">Lihat Profil</span>
                    </div>
                </a>
                <h3 class="text-lg font-semibold text-primary">{{ $proyek->proyekManajer->name }}</h3>
                <p class="text-sm text-tertiary font-semibold">Manajer Proyek</p>
            </div>
            @foreach($anggota as $pendaftar)
                <div class="w-60 rounded-lg flex flex-col items-center justify-center">
                    @if($pendaftar->mahasiswa)
                        @php
                            $mahasiswa = $pendaftar->mahasiswa;
                        @endphp
                        @if ($mahasiswa && $mahasiswa->id == $user->id)
                            <a href="{{ route('profile.edit') }}" class="mb-4 rounded-full mx-auto w-[50px] sm:w-[100px] lg:w-[150px] xl:w-[200px] h-[50px] sm:h-[100px] lg:h-[150px] xl:h-[200px] bg-white shadow data-animate relative group"
                            data-animation="slide-up"
                            style="background-image: url('{{ asset($pendaftar->mahasiswa->photo ?? 'path-to-default-image.jpg') }}'); background-size: cover;">
                                <div class="absolute inset-0 bg-gray-100 bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center rounded-full transition-opacity duration-300">
                                    <span class="text-primary font-semibold text-lg">Lihat Profil</span>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('lihatprofil', $mahasiswa) }}" class="mb-4 rounded-full mx-auto w-[50px] sm:w-[100px] lg:w-[150px] xl:w-[200px] h-[50px] sm:h-[100px] lg:h-[150px] xl:h-[200px] bg-white shadow data-animate relative group"
                            data-animation="slide-up"
                            style="background-image: url('{{ asset($pendaftar->mahasiswa->photo ?? 'path-to-default-image.jpg') }}'); background-size: cover;">
                                <div class="absolute inset-0 bg-gray-100 bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center rounded-full transition-opacity duration-300">
                                    <span class="text-primary font-semibold text-lg">Lihat Profil</span>
                                </div>
                            </a>
                        @endif
                        <h3 class="text-lg font-semibold text-primary">{{ $pendaftar->mahasiswa->name }}</h3>
                        <p class="text-sm text-tertiary font-semibold">{{ $pendaftar->role }}</p>
                    @elseif($pendaftar->dosen) 
                        @php
                            $dosen = $pendaftar->dosen;
                        @endphp
                        <a href="{{ route('lihatprofildosen', $dosen) }}" class="mb-4 rounded-full mx-auto w-[50px] sm:w-[100px] lg:w-[150px] xl:w-[200px] h-[50px] sm:h-[100px] lg:h-[150px] xl:h-[200px] bg-white shadow data-animate relative group"
                        data-animation="slide-up"
                        style="background-image: url('{{ asset($pendaftar->dosen->photo ?? 'path-to-default-image.jpg') }}'); background-size: cover;">
                            <div class="absolute inset-0 bg-gray-100 bg-opacity-50 opacity-0 group-hover:opacity-100 flex justify-center items-center rounded-full transition-opacity duration-300">
                                <span class="text-primary font-semibold text-lg">Lihat Profil</span>
                            </div>
                        </a>
                        <h3 class="text-lg font-semibold text-primary">{{ $pendaftar->dosen->name }}</h3>
                        <p class="text-sm text-tertiary font-semibold">{{ $pendaftar->role }}</p>
                    @endif
                </div>
            @endforeach
        
        </div>
    </div>
    <div class="flex flex-col justify-center items-center text-center h-full mt-12">
        <?php
            if ($terima) {
                echo '<div>
                    <a href="' . route('proyekdetail', $proyek) . '" class="cursor-pointer text-white text-2xl mb-3 rounded-full bg-secondary hover:bg-primary font-semibold py-6 px-12 ">Buka Proyek</a>
                    </div>';
            } elseif ($tolak) {
                echo '<div class="justify-center text-center">
                    <div class=" text-red-600 text-2xl mb-3 rounded-full bg-red-300 font-semibold py-6 w-80 items-center flex justify-center">Ditolak</div>
                    </div>';
            } else {
                echo '<div>
                    <div class="cursor-pointer text-white text-2xl mb-3 rounded-full bg-gray-300 font-semibold py-6 w-80 items-center flex justify-center">Sudah Mendaftar</div>
                    </div>';
            }
        ?>
    </div>

    <div class="max-w-[1500px] mx-auto px-12 sm:px-6 lg:px-12 mt-32">
        <div class="flex flex-row justify-between items-start mb-6">
            <h2 class="text-3xl sm:text-3xl text-primary font-bold mb-4 sm:mb-0 text-center sm:text-left">Rekomendasi Proyek Untukmu</h2>
            <a href="{{ route('katalog') }}" class="text-md font-semibold sm:text-lg text-primary cursor-pointer hover:text-secondary flex items-center sm:justify-end mt-1">
                Tampilkan Semuanya
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-24"> 
            @forelse ($rekomendasi as $index => $proyek)
                <x-cardproyek :proyek="$proyek" :detail="route('detailproyek', $proyek)"/>
            @empty
            <div class="w-full col-span-full flex justify-center">
                <div class="flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 22h20L12 2zm0 10v2m0 4h.01" />
                    </svg>
                    <div class="text-lg sm:text-xl font-semibold mb-4">Belum ada Proyek yang Tersedia</div>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <div id="eventModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold text-primary mb-4" id="eventTitle">Judul Kegiatan</h2>
            <p class="text-secondary mb-2"><strong>Status:</strong> <span id="eventStatus"></span></p>
            <p class="text-secondary mb-2"><strong>Tanggal Mulai:</strong> <span id="eventStart"></span></p>
            <p class="text-secondary mb-2"><strong>Tanggal Selesai:</strong> <span id="eventEnd"></span></p>
            <p class="text-secondary"><strong>Durasi:</strong> <span id="eventDuration"></span></p>
            <div class="flex justify-center">
                <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    

    <style> 
        .showPhoto > div { 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center;
        } 
    </style>

    <!-- Load all required scripts in correct order -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/daygrid/main.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/timegrid/main.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var modal = document.getElementById('eventModal');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                events: [
                    // Event untuk proyek secara keseluruhan
                    {
                        start: '{{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->format("Y-m-d") }}',
                        end: '{{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->format("Y-m-d") }}',
                        display: 'background',
                        backgroundColor: '#1976D2',
                    },
                    // Iterasi setiap kegiatan
                    @foreach($proyek->kegiatan as $kegiatan)
                    {
                        title: '{{ $kegiatan->nama }}',
                        start: '{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format("Y-m-d") }}',
                        end: '{{ \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format("Y-m-d") }}',
                        backgroundColor: 
                            @php
                                $now = \Carbon\Carbon::now();
                                $start = \Carbon\Carbon::parse($kegiatan->tanggal_mulai);
                                $end = \Carbon\Carbon::parse($kegiatan->tanggal_selesai);
                            @endphp
                            @if($now < $start)
                                '#FFA000'  // Orange untuk kegiatan yang belum mulai
                            @elseif($now >= $start && $now <= $end)
                                '#1976D2'  // Blue untuk kegiatan yang sedang berjalan
                            @else
                                '#4CAF50'  // Green untuk kegiatan yang sudah selesai
                            @endif,
                        borderColor: '#1565C0',
                        extendedProps: {
                            status: @if($now < $start)
                                        'Belum dimulai'
                                    @elseif($now >= $start && $now <= $end)
                                        'Sedang berjalan'
                                    @else
                                        'Selesai'
                                    @endif,
                        }
                    },
                    @endforeach
                ],
                eventClick: function(info) {
                    // Isi modal dengan informasi event
                    eventTitle.innerText = info.event.title;
                    eventStatus.innerText = info.event.extendedProps.status;

                    // Format tanggal
                    var startDate = info.event.start.toLocaleDateString();
                    var endDate = info.event.end
                        ? info.event.end.toLocaleDateString()
                        : 'Belum ditentukan';

                    eventStart.innerText = startDate;
                    eventEnd.innerText = endDate;

                    // Hitung durasi
                    if (info.event.end) {
                        var durationInMs =
                            info.event.end - info.event.start; // Durasi dalam milidetik
                        var durationInDays =
                            durationInMs / (1000 * 60 * 60 * 24); // Konversi ke hari
                        eventDuration.innerText = durationInDays + ' hari';
                    } else {
                        eventDuration.innerText = 'Durasi tidak tersedia';
                    }
                    modal.classList.remove('hidden');
                },
                initialDate: '{{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->format("Y-m-d") }}',
                editable: true,
                businessHours: true,
                dayMaxEvents: true
            });
            
            calendar.render();
            closeModal.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        });
    </script>
    
</x-app-layout>
