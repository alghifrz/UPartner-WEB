<x-app-layout :title="'Detail Proyek'" :footer="$footer">
    <x-slot name="detail">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Detail Proyek') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="mx-48 px-8 flex justify-between gap-12 items-start">
            <div class="showPhoto w-[600px] h-[400px] overflow-hidden rounded-3xl">
                <div class="w-full hover:scale-105 duration-500 h-full text-center cursor-pointer" 
                    style="background-image:url('{{ Storage::url($proyek->sampul) }}');">
                </div>
            </div>
            <div class="w-[800px]">
                <h1 class="text-2xl mb-4 leading-snug font-bold text-secondary">Judul Proyek</h1>
                <h1 class="text-5xl leading-snug font-bold text-primary">{{ $proyek->judul_proyek }}</h1>
            </div>
        </div>
    </div>
    
    <div class="flex mt-12 space-x-12 justify-between px-8 mx-48">
        <div class="w-3/4 p-12 bg-white rounded-3xl flex flex-col shadow-lg">
            <h1 class="text-2xl mb-4 font-bold text-secondary">Deskripsi Proyek</h1>
            <h1 class="text-2xl leading-normal font-semibold text-primary">{{ $proyek->deskripsi_proyek }}</h1>
        </div>
        <div class="w-1/4 p-12 bg-white rounded-3xl flex flex-col shadow-lg items-center justify-center">
            <h1 class="text-2xl mb-4 font-bold text-secondary">Manajer Proyek</h1>
            <div class="mb-4 showPhoto w-[200px] bg-secondary h-[200px] overflow-hidden rounded-full"
                style="background-image:url('{{ asset($proyek->proyekManajer->photo) }}'); background-size: cover;">
            </div>
            <h1 class="text-xl font-semibold text-primary">{{ $proyek->proyekManajer->name }}</h1>
            <h1 class="text-lg font-medium text-tertiary">{{ $proyek->proyekManajer->prodi->prodi_name }}</h1>
        </div>
    </div>
    

    <style> 
        .showPhoto > div { 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center;
        } 
    </style>
    
</x-app-layout>
