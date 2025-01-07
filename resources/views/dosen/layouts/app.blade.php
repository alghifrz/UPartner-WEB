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
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" href="/img/iconUPartner.png">
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
            @include('dosen.layouts.navigation')

            <!-- Page Heading -->
            @isset($beranda)
                <header class="bg-white">
                    <div class="">
                        {{ $beranda }}
                    </div>
                </header>
            @endisset

            @isset($header)
                <header class="bg-white">
                    <div class="max-w-7xl xl:mx-48 mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
                <div class="opacity-0 data-animate" data-animation="slide-up">
                    <x-footer :footer="$footer"/>
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
                </script>
            </main>
        </div>
    </body>
</html>
