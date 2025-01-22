@props(['title', 'footer'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
        <title>{{ $title }}</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net"> -->
        <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ asset('img/iconUPartner.png') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/main.min.css' rel='stylesheet' />
        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/daygrid/main.min.css' rel='stylesheet' />
        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/timegrid/main.min.css' rel='stylesheet' />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-background">

        <div id="splash-screen" class="fixed inset-0 flex items-center justify-center bg-secondary z-50">
            <div class="text-center animate-fadeIn">
                <img src="/img/logoUpartner.png" alt="Logo" class="drop-shadow-[0_4px_1px_rgba(0,0,0,0.3)] w-24 h-auto animate-spin-slow">
                <p class="text-white font-semibold mt-4 text-lg">Memuat...</p>
            </div>
        </div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($beranda)
                <header 
                    class="relative bg-cover bg-top" 
                    style="background-image: url('https://awsimages.detik.net.id/community/media/visual/2023/01/17/gedung-universitas-pertamina.jpeg?w=1200'); background-position: center;">
                    <!-- Overlay hitam transparan -->
                    <div 
                        class="absolute inset-0 z-10" 
                        style="background: linear-gradient(to bottom, rgba(255, 255, 255, 2), rgba(0, 0, 0, 0));">
                    </div>
                    <!-- Konten -->
                    <div class="relative z-20">
                        {{ $beranda }}
                    </div>
                </header>

            @endisset

            @isset($header)
                <header class="bg-white">
                    <div class="max-w-7xl xl:mx-48 py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            @isset($headerdetail)
                <header class="bg-background">
                    <div class="max-w-7xl xl:mx-48 py-6 px-4 sm:px-6 lg:px-8">
                        {{ $headerdetail }}
                    </div>
                </header>
            @endisset
            
            @isset($detail)
                <header class="bg-white shadow">
                    <div>
                        {{ $detail }}
                    </div>
                </header>
            @endisset

            @isset($katalog)
                <header class="bg-secondary">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $katalog }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
                <div class="">
                    <x-footer :footer="$footer" />
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const observerOptions = {
                            root: null,
                            rootMargin: '0px',
                            threshold: 0.1
                        };

                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    const animation = entry.target.getAttribute('data-animation');
                                    entry.target.classList.add(animation);
                                    entry.target.style.opacity = '1';
                                    observer.unobserve(entry.target);
                                }
                            });
                        }, observerOptions);

                        document.querySelectorAll('.data-animate').forEach((element) => {
                            observer.observe(element);
                        });
                    });
                    window.addEventListener('load', () => {
                        const splashScreen = document.getElementById('splash-screen');
                        splashScreen.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                        setTimeout(() => {
                            splashScreen.classList.add('hidden');
                            document.getElementById('main-content').classList.remove('hidden');
                        }, 200); // Tunggu 500ms agar transisi selesai
                    });
                    function openFilterModal() {
                        document.getElementById('filterModal').classList.remove('hidden');
                    }

                    function closeFilterModal() {
                        document.getElementById('filterModal').classList.add('hidden');
                    }
                    function toggleSelectAll(selectAllCheckbox) {
                        const checkboxes = document.querySelectorAll('.program-checkbox');
                        checkboxes.forEach(function(checkbox) {
                            checkbox.checked = selectAllCheckbox.checked;
                        });
                    }
                     // Fungsi untuk memilih atau membatalkan centang semua checkbox
                    function toggleSelectAll(selectAllCheckbox) {
                        const checkboxes = document.querySelectorAll('.program-checkbox');
                        checkboxes.forEach(function(checkbox) {
                            checkbox.checked = selectAllCheckbox.checked;
                        });
                    }

                    // Menambahkan logika untuk mengubah status checkbox "Pilih Semua" berdasarkan pilihan yang ada
                    const programCheckboxes = document.querySelectorAll('.program-checkbox');
                    const selectAllCheckbox = document.getElementById('select-all');

                    programCheckboxes.forEach(function(checkbox) {
                        checkbox.addEventListener('change', function() {
                            // Jika ada checkbox yang tidak dicentang, "Pilih Semua" harus di-uncheck
                            if (Array.from(programCheckboxes).some(function(cb) { return !cb.checked })) {
                                selectAllCheckbox.checked = false; // Uncheck "Pilih Semua"
                            } else {
                                selectAllCheckbox.checked = true; // Check "Pilih Semua" jika semua dicentang
                            }
                        });
                    });

                </script>
            </main>
        </div>
        <style>
            .showPhoto > div { 
                background-size: cover; 
                background-repeat: no-repeat; 
                background-position: center;
            }
        </style>
    </body>
</html>
