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
                    <div>
                        <h1 class="text-4xl mb-4 font-bold text-tertiary"><span class="text-primary font-semibold text-lg ">Role Anda di Proyek ini:</span> </br> {{ $pendaftaran->where('id_proyek', $proyek->id)->first()->role }}</h1>
                    </div>
            </div>
        </div>
    </x-slot>
    <?php
        $start_date = new DateTime($proyek->tanggal_mulai);
        $end_date = new DateTime($proyek->tanggal_selesai);
        $current_date = new DateTime(); // Today's date

        $total_duration = $start_date->diff($end_date)->days;
        $elapsed_duration = $start_date->diff($current_date)->days;
        $progress_percentage = 0;

        if ($current_date >= $start_date) {
            $progress_percentage = min(100, ($elapsed_duration / $total_duration) * 100);
        }
    ?>

    <div class="mt-6 px-12 mx-56 p-12 bg-white rounded-3xl flex flex-col border border-gray-300">
        <div class="w-full">
            <p class="text-3xl mb-8 font-bold text-secondary">Progres Proyek : <span class="font-black">{{ round($progress_percentage, 1) }}%</span></p>
            <p class="text-xl mb-3 font-semibold text-tertiary">Rangkaian Kegiatan : <span class="ml-4 font-black">{{ $proyek->kegiatan->where('is_selesai', 1)->count() }}</span> / {{ $proyek->kegiatan->count() }} Selesai</p>
            <div class="relative w-full h-3 mt-2 bg-gray-200 rounded-full">
                <!-- Garis progres keseluruhan -->
                <div class="absolute top-0 left-0 h-full bg-tertiary rounded-full" style="width: {{ $progress_percentage }}%"></div>
            </div>
            
            <div class="flex justify-between mt-4 items-center">
                <!-- Timeline Kegiatan -->
                @foreach ($proyek->kegiatan as $kegiatan)
                    <div class="relative text-center">
                        <!-- Icon atau centang -->
                        <div class="w-8 h-8 rounded-full {{ $kegiatan->is_selesai ? 'bg-green-500' : 'bg-gray-500' }} flex justify-center items-center text-white border {{ $kegiatan->is_selesai ? ' border-green-500' : 'border-0' }}">
                            @if($kegiatan->is_selesai)
                                <i class="fas fa-check"></i> <!-- Centang jika selesai -->
                            @else
                                <span class="text-xs">{{ $loop->iteration }}</span> <!-- Nomor kegiatan jika belum selesai -->
                            @endif
                        </div>
                        <p class="text-xs mt-2">{{ $kegiatan->nama }}</p>
                    </div>
                @endforeach
            </div>
        
            <!-- Menambahkan keterangan progres dengan tanggal -->
            <div class="flex justify-between mt-4 text-xs text-gray-500">
                <span>{{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->format('d M Y') }}</span>
                <span>{{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->format('d M Y') }}</span>
            </div>

            <div class="flex justify-between mt-8 text-xs text-gray-500">
                <p class="text-lg italic font-normal text-primary">Semua progres proyek ini dikelola oleh manajer proyek. </br> Pastikan untuk menghubungi manajer proyek saat menyelesaikan suatu kegiatan atau tugas dengan mengirim email ke alamat berikut.</p>
            </div>
            <div class="space-x-2 flex justify-start mt-8 text-xs text-gray-500">
                <p class="text-lg font-semibold text-primary">Email Manajer Proyek: </p>
                <a class="text-lg font-semibold text-secondary" target="_blank" href="mailto:{{ $proyek->proyekManajer->email }}">{{ $proyek->proyekManajer->email }}</a>
            </div>
        </div>
        
    </div>
    

    <div class="flex mt-6 space-x-6 justify-between px-8 mx-48 bg-background">
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
