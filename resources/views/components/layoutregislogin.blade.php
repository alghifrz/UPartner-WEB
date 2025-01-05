@props(['title'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/iconUPartner.png">

</head>
<body class="flex justify-center items-center min-h-screen" style="background-image: url('/img/bgauth.png'); background-size: cover; background-position: center;">
    <div id="splash-screen" class="fixed inset-0 flex items-center justify-center bg-secondary z-50">
        <div class="text-center animate-fadeIn">
            <img src="/img/logoUpartner.png" alt="Logo" class="drop-shadow-[0_4px_1px_rgba(0,0,0,0.3)] w-24 h-auto animate-spin-slow">
            <p class="text-white font-semibold mt-4 text-lg">Memuat...</p>
        </div>
    </div>
    {{ $slot }}
    <script>
        window.addEventListener('load', () => {
            const splashScreen = document.getElementById('splash-screen');
            splashScreen.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => {
                splashScreen.classList.add('hidden');
                document.getElementById('main-content').classList.remove('hidden');
            }, 200); // Tunggu 500ms agar transisi selesai
        });
    </script>
</body>
</html>