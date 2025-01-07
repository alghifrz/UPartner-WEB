<x-dosen-app-layout :title="'Beranda Dosen'" :footer="$footer">
    <x-slot name="beranda">
        <div class="py-12 flex justify-between items-center max-w-[1500px] mx-auto mb-24 sm:px-6 md:px-6 lg:px-8">
            <div class="max-w-[800px]">
                <h1 class="leading-snug text-5xl text-secondary mb-8 font-bold">{{ $dashboard['quotes'][0] }}</h1>
                <h2 class="leading-snug text-2xl text-tertiary mb-16 font-normal">{{ $dashboard['quotes'][1] }}</h2>
                <a href="" class="text-white text-2xl font-semibold rounded-full bg-secondary hover:bg-primary py-4 px-10">{!! $dashboard['quotes']['button'] !!}</a>
            </div>
            <div class="z-1000">
                <img src="{{ asset('img/beranda.png') }}" alt="" class="z-1000 w-[600px]">
            </div>
        </div>
        <div class="pb-12">
            <x-iklan :iklan="$iklan" /> 
        </div>
        <div class="pb-12 max-w-[1200px] mx-auto flex flex-col text-center justify-center">
            <h1 class="justify-center text-center text-5xl text-primary leading-normal font-reguler mb-8 italic">"Kolaborasi bukan hanya tentang bekerja bersama, tetapi tentang menciptakan sesuatu yang tidak dapat dicapai sendirian."</h1>
            <h1 class="justify-center text-center text-2xl text-primary leading-normal font-medium mb-8 italic">- Sobat UPartner -</h1>
        </div>    
    </x-slot>

    
    <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 mt-12">
        <h2 class="text-2xl text-primary font-bold mb-8">{{ $dashboard['content']['judul'] }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6"> 
            @forelse ($proyek as $index => $proyek)
                <x-cardproyek :proyek="$proyek"/>
            @empty
                <div class="flex justify-center">
                    <div class="bg-yellow-100 text-yellow-800 border border-yellow-400 rounded-3xl p-4 text-center text-3xl">
                        Belum ada Proyek yang Tersedia
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
