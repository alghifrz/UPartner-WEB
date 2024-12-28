@props(['tim'])
<div class="flex relative h-[500px] w-[350px] rounded-2xl bg-primary my-20">
    {{-- <div class="inset-0 bg-blue-900"> --}}
    
    <img src="{{ $tim['foto'] }}" alt="" class="absolute left-1/2 transform -translate-x-1/2 bottom-[40%] z-20">
    <div class="absolute bottom-[40%] left-1/2 transform -translate-x-1/2 w-5/6 h-[270px] rounded-t-2xl bg-background z-10">
    </div>
      <div class="absolute mt-80 left-0 right-0 text-center text-white space-y-2">
            <h2 class="text-2xl font-bold">{{ $tim['nama'] }}</h2>
            <p class="text-lg font-semibold">{{ $tim['nim'] }}</p>
            <p class="text-md">{{ $tim['email'] }}</p>
            <x-sosmedtim :sosmed="$tim['sosmed']" />
        </div>
        {{-- </div> --}}
    </div>
