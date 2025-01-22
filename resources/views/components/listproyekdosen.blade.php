@props(['proyek'])
@foreach ($proyek as $item)
<div class="bg-white shadow-md rounded-3xl justify-between p-6 mb-6">
    <div class="flex gap-7">
        <!-- Icon/Logo for the project -->
        <div class="showPhoto w-[200px] h-[200px] overflow-hidden rounded-3xl">
            <div class="w-full hover:scale-105 duration-500 h-full text-center cursor-pointer" 
                style="background-image:url('{{ Storage::url($item->proyek->sampul) }}');">
            </div>
        </div>
        
        <!-- Project Title & Details -->
        <div class="w-[825px] mr-20">
            <div class="flex items-baseline flex-col h-full">
                <div>
                    <?php
                        if ($item->proyek->status_proyek == 'belum dimulai') {
                            $color = 'bg-green-200';
                            $font = 'text-green-600';
                            $text = 'Belum Dimulai';
                        } else if ($item->proyek->status_proyek == 'selesai') {
                            $color = 'bg-red-200';
                            $font = 'text-red-600';
                        } else {
                            $color = 'bg-yellow-200';
                            $font = 'text-yellow-600';
                        }
                        // Calculate project progress
                        $start_date = new DateTime($item->proyek->tanggal_mulai);
                        $end_date = new DateTime($item->proyek->tanggal_selesai);
                        $current_date = new DateTime(); // Today's date

                        $total_duration = $start_date->diff($end_date)->days;
                        $elapsed_duration = $start_date->diff($current_date)->days;
                        $progress_percentage = 0;

                        if ($current_date >= $start_date) {
                            $progress_percentage = min(100, ($elapsed_duration / $total_duration) * 100);
                        }
                        ?>
                    {{-- <p class="inline text-xs rounded-full px-2 py-1 font-semibold {{ $font  }} {{ $color }}">{{ $item->proyek->status_proyek }}</p> --}}
                    <h3 class="text-2xl mt-2 font-semibold text-gray-800">{{ $item->proyek->judul_proyek }}</h3>
                </div>
                <div class="w-full h-full flex justify-between items-start mt-4">
                    <p class="text-md text-gray-600">Manajer Proyek: <span class="font-semibold text-lg text-secondary">{{ $item->proyek->proyekManajer->name }}</span></p>
                    <p class="text-lg text-gray-600 mt-auto text-right">Role: </br><span class="text-2xl font-semibold text-tertiary">{{ $item->role }}</span></p>
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
        <div class="mt-20 pb-2">
            <a href="{{ route('dosen.proyekdetail', $item->proyek) }}" class="text-xl bg-secondary hover:bg-primary text-center items-center text-white py-4 px-6 rounded-2xl font-semibold">Buka Proyek</a>
        </div>
    </div>
</div>
@endforeach
