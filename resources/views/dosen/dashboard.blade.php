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

        <div>
            <x-iklan :iklan="$iklan" /> 
        </div>

        <div class="py-16 xl:px-64 px-4 flex flex-col text-center bg-white justify-center">
            <h1 class="text-2xl sm:text-5xl text-primary leading-normal font-reguler mb-6 italic">"Kolaborasi bukan hanya tentang bekerja bersama, tetapi tentang menciptakan sesuatu yang tidak dapat dicapai sendirian."</h1>
            <h2 class="text-lg sm:text-2xl text-primary leading-normal font-medium mb-6 italic">- Sobat UPartner -</h2>
        </div>
    </x-slot>

    <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="flex flex-row justify-between items-start mb-6">
            <h2 class="text-3xl sm:text-4xl text-primary font-bold mb-4 sm:mb-0 text-center sm:text-left">{{ $dashboard['content']['judul'] }}</h2>
            <a href="{{ route('dosen.katalog') }}" class="text-md font-semibold sm:text-lg text-primary cursor-pointer hover:text-secondary flex items-center sm:justify-end mt-1">
                {!! $dashboard['content']['show'] !!}
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-24"> 

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

    <div class="bg-white w-full py-4 lg:py-0">
        <div class="max-w-screen-lg mx-auto px-4 sm:px-6 lg:px-24 justify-center space-y-4 sm:space-y-0 sm:space-x-4 lg:space-x-20 text-primary flex flex-col lg:flex-row">
            <div class="flex-shrink-0 hidden lg:block mb-4 lg:mb-0">
                <img src="{{ asset('img/ray.png') }}" alt="" class="max-w-full h-auto">
            </div>
            <div class="flex flex-col justify-center w-full">
                <div class="flex justify-left items-center mb-8 space-x-4">
                    <img src="{{ asset('img/stat.png') }}" alt="" class="w-8 h-auto">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold items-center text-left">Statistik UPartner</h1>
                </div>
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4 lg:space-x-12 data-animate" data-animation="slide-up">
                    @foreach ($dashboard['exposedosen'] as $insight)
                    <a href="{{ $insight['link'] }}" class="text-center rounded-3xl border border-gray-200 shadow-lg w-full sm:w-1/2 lg:w-80 py-8 data-animate cursor-pointer  hover:scale-[1.02] hover:bg-gray-100 hover:duration-500 duration-500">
                        <div class="flex items-center justify-center text-center space-x-3">
                            <p class="flex items-center font-black xl:text-8xl lg:text-4xl text-3xl mb-4 text-primary">
                                <i class="{{ $insight['icon'] }} xl:text-6xl"></i>
                            </p>
                            <p class="flex items-center font-black xl:text-8xl lg:text-4xl text-3xl mb-4 text-primary">
                                {{ $insight['value'] }}
                            </p>
                        </div>                        
                        <p class="font-medium text-sm md:text-2xl text-tertiary whitespace-nowrap">{{ $insight['label']}}</p>
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="w-full py-4 lg:py-0 relative">
        <div class="mb-20 md:mb-36 opacity-0 data-animate" data-animation="slide-up">
            <img src="/img/icon1.png" alt="" class="hidden xl:block absolute w-45 h-auto left-20 z-20 top-90 mt-0 float-animation">
            <img src="/img/icon2.png" alt="" class="hidden xl:block absolute w-45 h-auto right-20 top-100 z-20 mt-0 float-animation">
            <img src="/img/icon3.png" alt="" class="hidden xl:block absolute w-45 h-auto left-20 top-110 z-0 float-animation">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8 md:mb-12 text-center mt-24 text-secondary">Top 3 Mahasiswa Teraktif</h1>
            <div class="mx-8 md:mx-12 lg:mx-24 flex flex-wrap justify-center gap-8 md:gap-16 z-50 relative">
                @foreach($topStudents as $index => $student)
                    <a href="{{ route('dosen.lihatprofil', $student) }}" class="w-full sm:w-[45%] md:w-[30%] lg:w-[25%] cursor-pointer bg-white bg-opacity-70 backdrop-blur-md rounded-2xl p-6 text-center shadow-lg hover:scale-105 hover:duration-500 transition-transform">
                        <div class="relative mb-4">
                            @if($index == 0)
                                <span class="absolute top-0 left-0 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">1st</span>
                            @elseif($index == 1)
                                <span class="absolute top-0 left-0 bg-gray-400 text-white px-3 py-1 rounded-full text-sm font-bold">2nd</span>
                            @elseif($index == 2)
                                <span class="absolute top-0 left-0 bg-amber-700 text-white px-3 py-1 rounded-full text-sm font-bold">3rd</span>
                            @endif
                            <div class="mb-4 rounded-full mx-auto w-[50px] sm:w-[100px] lg:w-[150px] xl:w-[200px] h-[50px] sm:h-[100px] lg:h-[150px] xl:h-[200px] bg-white shadow data-animate relative group"
                            data-animation="slide-up"
                            style="background-image: url('{{ asset($student->photo ?? 'path-to-default-image.jpg') }}'); background-size: cover;">
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-secondary mb-2">{{ $student->name }}</h3>
                        <p class="text-lg font-semibold text-gray-600 mb-2">{{ $student->prodi->prodi_name }}</p>
                        <div class="bg-tertiary text-white text-xl mt-2 px-4 py-2 rounded-full inline-block">
                            {{ $student->pendaftaran->where('status', 'Diterima')->count() }} Proyek Diikuti
                        </div>
                    </a>
                @endforeach
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
</x-dosen-app-layout>