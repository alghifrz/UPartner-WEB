<x-layoutguest :title="'Beranda'" :footer="$footer">
    <x-slot name="beranda">
        <div class="py-12 flex justify-between items-center max-w-[1500px] mx-auto mb-24 sm:px-6 md:px-6 lg:px-8">
            <div class="max-w-[800px]">
                <h1 class="leading-snug text-5xl text-secondary mb-8 font-bold">{{ $dashboard['quotes'][0] }}</h1>
                <h2 class="leading-snug text-2xl text-tertiary mb-16 font-normal">{{ $dashboard['quotes'][1] }}</h2>
                <a href="{{ route('katalogguest') }}" class="text-white text-2xl font-semibold rounded-full bg-secondary hover:bg-primary py-4 px-10">{!! $dashboard['quotes']['button'] !!}</a>
            </div>
            <div class="z-1000">
                <img src="{{ asset('img/beranda.png') }}" alt="" class="z-1000 w-[600px]">
            </div>
        </div>
        <div>
            <x-iklan :iklan="$iklan" /> 
        </div>
        <div class="py-16 px-64 flex flex-col text-center bg-white justify-center">
            <h1 class="justify-center text-center text-5xl text-primary leading-normal font-reguler mb-8 italic">"Kolaborasi bukan hanya tentang bekerja bersama, tetapi tentang menciptakan sesuatu yang tidak dapat dicapai sendirian."</h1>
            <h1 class="justify-center text-center text-2xl text-primary leading-normal font-medium mb-8 italic">- Sobat UPartner -</h1>
        </div>    
    </x-slot>

    <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 mt-12">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl text-primary font-bold mb-8">{{ $dashboard['content']['judul'] }}</h2>
            <a href="{{ route('katalogguest') }}" class="text-lg text-primary font-semibold cursor-pointer hover:text-secondary mb-8 flex">
                {!! $dashboard['content']['show'] !!}
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6 mb-24"> 
            @forelse ($proyek as $index => $proyek)
                <x-cardproyekguest :proyek="$proyek" :detail="route('detailproyekguest', $proyek)"/>
            @empty
                <div class="flex justify-center">
                    <div class="bg-yellow-100 text-yellow-800 border border-yellow-400 rounded-3xl p-4 text-center text-3xl">
                        Belum ada Proyek yang Tersedia
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    
    <div class="bg-white w-full px-24 justify-center space-x-20 text-primary flex">
        <img src="{{ asset('img/ray.png') }}" alt="" class="items-end">
        <div class="flex flex-col justify-center">
            <div class="flex justify-left items-center mb-8 space-x-4">
                <img src="{{ asset('img/stat.png') }}" alt="" class="w-8 h-auto">
                <h1 class="text-4xl font-bold items-center text-left">Statistik UPartner</h1>
            </div>
            <div class="flex justify-between space-x-12 data-animate" data-animation="slide-up">
                @foreach ($dashboard['expose'] as $insight)
                    <div class="text-center rounded-3xl border border-gray-200 shadow-lg w-80 py-8 data-animate cursor-pointer" data-animation="slide-up">
                        <p class="font-black xl:text-8xl lg:text-4xl text-3xl mb-4 text-primary">{{ $insight['value'] }}</p>
                        <p class="font-medium text-sm md:text-2xl text-tertiary whitespace-nowrap">{{ $insight['label']}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>





    
</x-layoutguest>
