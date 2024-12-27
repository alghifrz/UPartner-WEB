@props(['navbarlanding'])
<navbar class="bg-white py-16 sticky w-full top-0 z-40 mt-0" x-data="{ isOpen: false }">
    {{-- <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"> --}}
    <div class="mx-8 lg:mx-24">
      <div class="flex h-16 items-center justify-between">
        
          <x-logo-u-partner></x-logo-u-partner>
       
        <div class="flex items-center">
          <div class="hidden xl:block">
            <div class="ml-10 flex items-baseline space-x-40 justify-end">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <div class="space-x-4">
                @foreach ($navbarlanding['menu'] as $menu)
                  <a href="{{ $menu['link'] }}" 
                    class="mx-8 py-2 text-lg font-semibold {{ request()->is(ltrim($menu['link'], '/')) ? 'text-secondary border-b-2 border-secondary' : 'text-primary hover:text-secondary' }}" 
                    aria-current="page">
                    {{ $menu['judul'] }}
                  </a>
                @endforeach        
              </div>
              <div class="space-x-4">
                  <a href="{{ route('login') }}" class="rounded-full border-2 border-secondary px-6 py-2 text-lg font-semibold text-secondary hover:bg-gradient-to-t from-primary via-secondary to-secondary hover:text-white">{{ $navbarlanding['button'][0]['judul'] }}</a>
                  <a href="{{ route('register') }}" class="rounded-full border-2 border-secondary bg-gradient-to-t from-primary via-secondary to-secondary px-6 py-2 text-lg font-semibold text-white hover:bg-gradient-to-t hover:from-primary hover:via-primary hover:to-secondary hover:text-white">{{ $navbarlanding['button'][1]['judul'] }}</a>
              </div>

            </div>
          </div>
        </div>               
        
        <div class="flex xl:hidden items-start">
          <!-- Tombol menu mobile -->
          <button @click="isOpen = !isOpen" type="button" class="relative inline-flex items-center justify-center rounded-md bg-gradient-to-t from-primary via-secondary to-secondary p-2 text-white hover:bg-gradient-to-t hover:from-primary hover:via-primary hover:to-secondary hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 m-0" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Ikon Menu Hamburger (ditampilkan ketika menu tertutup) -->
            <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Ikon Tutup Menu (ditampilkan ketika menu terbuka) -->
            <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
        
        
    </div>


    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="xl:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <!-- Link items with conditional active class -->
        @foreach ($navbarlanding['menu'] as $menu)
            <a href="{{ $menu['link'] }}" 
              class="block rounded-md px-3 py-2 text-primary text-base font-semibold {{ request()->is(ltrim($menu['link'], '/')) ? 'text-secondary' : 'text-primary hover:text-secondary' }}" 
              aria-current="page">
              {{ $menu['judul'] }}
            </a>
        @endforeach
    
        <a href="{{ route('login') }}" class="rounded-full border-2 border-secondary block text-center px-3 py-2 text-base font-bold text-secondary hover:bg-gradient-to-t hover:from-primary hover:via-primary hover:to-secondary hover:text-white">{{ $navbarlanding['button'][0]['judul'] }}</a>
        <a href="{{ route('register') }}" class="rounded-full border-2 border-secondary block text-center bg-gradient-to-t from-primary via-secondary to-secondary px-3 py-2 text-base font-bold text-white hover:bg-gradient-to-t hover:from-primary hover:to-secondary hover:text-white">{{ $navbarlanding['button'][1]['judul'] }}</a>
      </div>
    </div>


  </nav>

    