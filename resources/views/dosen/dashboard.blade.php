<x-dosen-app-layout :title="'Beranda Dosen'" :footer="$footer">
    <x-slot name="beranda">
        <div class="py-8 sm:py-10 lg:py-12 flex flex-col-reverse lg:flex-row justify-between items-center max-w-[1500px] mx-auto mb-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-[800px] mb-8 lg:mb-0 text-center lg:text-left">
                <h1 class="leading-snug text-3xl sm:text-5xl text-secondary mb-6 font-bold">{{ $dashboard['quotes'][0] }}</h1>
                <h2 class="leading-snug text-xl sm:text-2xl text-tertiary mb-12 font-normal">{{ $dashboard['quotes'][1] }}</h2>
                <div class="flex justify-center lg:justify-start">
                    <a href="{{ route('dosen.katalog') }}" class="text-white text-lg sm:text-2xl font-semibold rounded-full bg-secondary hover:bg-primary py-3 px-8">{!! $dashboard['quotes']['button'] !!}</a>
                </div>
            </div>
            <div class="z-1000 max-w-full flex justify-center lg:w-[600px] mb-8 lg:mb-0">
                <img src="{{ asset('img/beranda.png') }}" alt="Beranda" class="w-full max-w-[400px] sm:max-w-[500px] lg:max-w-full">
            </div>
        </div>

        <div class="pb-10">
            <x-iklan :iklan="$iklan" /> 
        </div>

        <div class="pb-10 max-w-[1200px] mx-auto flex flex-col text-center justify-center px-4">
            <h1 class="text-2xl sm:text-5xl text-primary leading-normal font-reguler mb-6 italic">"Kolaborasi bukan hanya tentang bekerja bersama, tetapi tentang menciptakan sesuatu yang tidak dapat dicapai sendirian."</h1>
            <h2 class="text-lg sm:text-2xl text-primary leading-normal font-medium mb-6 italic">- Sobat UPartner -</h2>
        </div>
    </x-slot>

    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex flex-row justify-between items-start mb-6">
            <h2 class="text-3xl sm:text-4xl text-primary font-bold mb-4 sm:mb-0 text-center sm:text-left">{{ $dashboard['content']['judul'] }}</h2>
            <a href="{{ route('dosen.katalog') }}" class="text-md sm:text-lg text-primary cursor-pointer hover:text-secondary flex items-center sm:justify-end mt-1">
                {!! $dashboard['content']['show'] !!}
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"> 
            @forelse ($proyek as $index => $proyek)
                <x-cardproyek :proyek="$proyek" :detail="route('dosen.detailproyek', $proyek)"/>
            @empty
            <div class="w-full col-span-full flex justify-center">
                <div class="flex flex-col items-center text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 22h20L12 2zm0 10v2m0 4h.01" />
                    </svg>
                    <div class="text-lg sm:text-xl font-semibold mb-4">Belum ada Proyek yang Tersedia</div>
                    <p class="mb-6 text-md sm:text-lg text-gray-700">Anda bisa membuat proyek baru dengan mengklik tombol di bawah ini</p>
                    <a href="{{ route('dosen.buatproyek') }}" class="bg-secondary text-white py-2 px-6 rounded-lg font-semibold hover:bg-primary transition">Buat Proyek</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <style> 
        .showPhoto > div { 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center;
        } 
    </style>
</x-dosen-app-layout>
