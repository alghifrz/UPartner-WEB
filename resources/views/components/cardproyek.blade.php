@props(['proyek'])
<div class="bg-white shadow-sm rounded-3xl pb-6 relative hover:scale-105 hover:duration-500 hover:shadow-lg cursor-pointer">
    <?php
        $aliasprodi = [
            1 => 'CS',
            2 => 'CH',
            3 => 'EE',
            4 => 'CV',
            5 => 'EV',
            6 => 'CE',
            7 => 'ME',
            8 => 'LE',
            9 => 'PE',
            10 => 'GL',
            11 => 'GP',
            12 => 'CO',
            13 => 'MN',
            14 => 'EC',
            15 => 'IR',
        ]
    ?>
    <div class="absolute z-20 right-4 mt-4 bg-background inline justify-center rounded-full px-6 py-1 text-xl font-bold text-primary ml-auto">
        {{ $aliasprodi[$proyek->proyekManajer->prodi_id] }}
    </div>
    <div class="showPhoto overflow-hidden">
        <div id="imagePreview" class="w-full h-72 text-center rounded-3xl" 
            style="background-image:url(
                @if ($proyek->sampul != '') 
                    {{ asset('storage/' . $proyek->sampul) }}
                @else 
                    {{ url('/img/beranda.png') }} 
                @endif
            );">
        </div>
    </div>
    <div class="mx-6 mt-4">
        <?php
            if ($proyek->status_proyek == 'belum dimulai') {
                $color = 'bg-green-200';
                $font = 'text-green-600';
                $text = 'Belum Dimulai';
            } else if ($proyek->status_proyek == 'selesai') {
                $color = 'bg-red-200';
                $font = 'text-red-600';
            } else {
                $color = 'text-gray-200';
                $font = 'text-gray-600';
            }
        ?>
        <p class="inline mb-3 text-xs rounded-full px-2 py-1 font-semibold {{ $font  }} {{ $color }}">{{ $proyek->status_proyek }}</p>
        <h5 class="mb-3 mt-4 text-2xl font-semibold text-black text-left truncate-lines">
            {{ \Illuminate\Support\Str::limit($proyek->judul_proyek, 40) }}
        </h5>        
        <div class="mb-3">
            <p class="text-sm font-semibold text-secondary">Manajer Proyek:</p>
            <p class="text-md font-semibold text-bold">{{ $proyek->proyekManajer->name ?? 'NotProvided' }}</p>
        </div>
        <a href="" class="block w-full text-white items-center text-center justify-center text-xl font-semibold rounded-full bg-secondary hover:bg-primary py-2">Gabung Proyek</a>  
    </div>
</div>
<style>
    .truncate-lines {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Membatasi teks menjadi 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis; /* Menambahkan elipsis (...) jika teks terpotong */
    }
</style>