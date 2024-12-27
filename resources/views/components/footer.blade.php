@props(['footer'])
<div class="mt-32 bg-gelap z-40 py-0 pt-16 border-t-2 border-gray-300">
    
  <div class="mx-24 flex flex-col xl:flex-row justify-between mb-16">
      
      <div class="flex flex-col items-start max-w-sm justify-center mb-8">
        <a href="{{ $footer['logo']['link'] }}">
          <div class="mt-8 shrink-0 flex align-middle justify-center items-center gap-6 mb-8 hover:cursor-pointer hover:scale-105 hover:duration-500">
              <img class="h-14 w-auto" src="{{ $footer['logo']['img'] }}" alt="Your Company">
              <h1 class="text-4xl font-bold text-primary">{{ $footer['logo']['judul'] }}</h1>
          </div>
      </a>
        <div class="flex items-center">
          <img src="{{ $footer['address']['icon'] }}" width="25px" alt="">
          <a href="{{ $footer['address']['link'] }}" class="text-primary font-bold text-xl ml-2 hover:underline" target="_blank">{{ $footer['address']['judul'] }}</a>
        </div>
        <p class="text-abubiru mt-2 text-lg leading-relaxed font-regular mb-8">{{ $footer['address']['alamat'] }}</p>
        <div class="flex items-center">
          <img src="{{ $footer['address']['contact']['email']['icon'] }}" class="h-[15px] w-auto" alt="">
          <p class="text-primary ml-2 text-lg leading-relaxed font-regular"><a href="{{ $footer['address']['contact']['email']['link'] }}" class="hover:underline">{{ $footer['address']['contact']['email']['mail'] }}</a></p>
        </div>
        <div class="flex items-center">
          <img src="{{ $footer['address']['contact']['phone']['icon'] }}" class="h-[20px] w-auto" alt="">
          <p class="text-primary ml-2 text-lg leading-relaxed font-regular"><a href="{{ $footer['address']['contact']['phone']['link'] }}" class="hover:underline">{{ $footer['address']['contact']['phone']['wa'] }}</a></p>
        </div>
      </div>

      <div class="flex flex-col items-start max-w-sm justify-center mb-8">
        <div class="flex items-center">
          <p class="text-primary font-bold text-xl mb-2">{{ $footer['menu']['judul'] }}</p>
        </div>
        <ul>
          @foreach ($footer['menu']['link'] as $menu )
            <li class="mb-1"></li>
              <a href="{{ $menu['link'] }}" class="text-abubiru mt-2 text-lg leading-relaxed font-regular mb-8 hover:underline">{{ $menu['judul'] }}</a>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="flex flex-col items-start max-w-sm justify-center mb-8">
        <div class="flex items-center">
          <p class="text-primary font-bold text-xl mb-6">{{ $footer['partner']['judul'] }}</p>
        </div>
        <a href="{{ $footer['partner']['link']['link'] }}" target="_blank">
          <img src="{{ $footer['partner']['link']['img'] }}" alt="" class="h-[150px] w-auto hover:scale-105 hover:duration-500 ">
        </a>
      </div>

      <div class="flex flex-col items-start max-w-sm justify-center mb-8">
        <div class="flex items-center">
          <p class="text-primary font-bold text-xl mb-4">{{ $footer['sosmed']['judul'] }}</p>
        </div>
        <x-sosmed></x-sosmed>
      </div>
      
    </div>

    
    <div class="justify-end mx-0 bg-primary py-6">
      <div class="flex justify-center">     
          <p class="text-white">{{ $footer['copyright']['judul'] }}</p>                 
        <div>
          {{-- <x-socmedfoot></x-socmedfoot> --}}
        </div>
      </div>
    </div>

  </div>