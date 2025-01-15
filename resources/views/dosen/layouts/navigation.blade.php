<nav x-data="{ open: false }" class="bg-secondary sticky w-full py-3 top-0 z-40 mt-0">
    <!-- Primary Navigation Menu -->
    <div class="lg:mx-24 mx-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dosen.dashboard') }}">
                    <x-logo-navbar></x-logo-navbar>
                </a>
            </div>
            
            <div class="flex">
                <div class="flex mx-12">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dosen.dashboard')" :active="request()->routeIs('dosen.dashboard')">
                            {{ __('Beranda') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dosen.buatproyek')" :active="request()->routeIs('dosen.buatproyek')">
                            {{ __('Buat Proyek') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dosen.proyek')" :active="request()->routeIs('dosen.proyek')">
                            {{ __('Proyek Saya') }}
                        </x-nav-link>
                    </div>
                </div>
                
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center text-sm leading-4 font-medium transition ease-in-out duration-150">
                                {{-- <div>{{ Auth::user()->name }}</div> --}}
                                <div class="size-12 text-center rounded-full bg-secondary" 
                                    style="background-image: url('{{  Auth::user()->photo }}'); background-size: cover;">
                                </div>
                                <div class="ms-1">
                                    <svg class="h-0 w-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Profile Link with Icon -->
                            <x-dropdown-link :href="route('dosen.profile.edit')">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-5 text-3xl text-tertiary"></i>
                                    <div>
                                        <span class="text-primary">{{ __('Profil') }}</span>
                                        <small class="text-primary"><span class="mt-1 block font-light">Edit profil Anda</span></small>
                                    </div>
                                </div>
                            </x-dropdown-link>
                            <!-- Keterangan Profil -->
                        
                            <!-- Garis Pemisah -->
                            <hr class="my-2 mx-4">
                        
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('dosen.logout') }}">
                                @csrf
                        
                                <!-- Log Out Link with Icon -->
                                <x-dropdown-link :href="route('dosen.logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <div class="flex items-center">
                                        <i class="fas fa-sign-out-alt mr-4 text-3xl text-red-500"></i>
                                        <div>
                                            <span class="text-red-700">{{ __('Keluar') }}</span>
                                            <small class="text-red-900"><span class="mt-1 block font-light">Keluar dari akun Anda</span></small>
                                        </div>
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-secondary hover:bg-white focus:outline-none focus:bg-white focus:text-secondary transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dosen.dashboard')" :active="request()->routeIs('dosen.dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dosen.buatproyek')" :active="request()->routeIs('dosen.buatproyek')">
                {{ __('Buat Proyek') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dosen.proyek')" :active="request()->routeIs('dosen.proyek')">
                {{ __('Proyek Saya') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex px-4 space-x-3">
                <div class="size-12 text-center rounded-full bg-gray-100" 
                    style="background-image: url('{{  Auth::user()->photo }}'); background-size: cover;">
                </div>
                <div class="">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-muda">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('dosen.profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('dosen.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('dosen.logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
