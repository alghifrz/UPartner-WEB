<x-layout :header="$header">
    <img class="absolute h-full top-0 w-full z-0" src="img/bg.png" alt="Your Company">
    <div class="min-h-full z-20"> 
        <div class="pt-12">
            <x-navbarlanding :navbarlanding="$navbarlanding" />
        </div>
        <main class="relative"> 
            <div class="mx-4 md:mx-12 lg:mx-24 pt-12 lg:pt-32 items-start flex min-h-screen sm:pt-8">
                <div class="flex flex-col lg:flex-row items-start justify-between gap-8 lg:gap-0">
                    <div class="order-2 lg:order-1 text-center lg:text-left">
                        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-6 md:mb-10 text-transparent bg-clip-text bg-gradient-to-r from-primary to-tertiary lg:mr-32 opacity-0 data-animate" data-animation="slide-up">{{ $landingpage['title'] }}</h1>
                        <h1 class="text-xl md:text-2xl lg:text-3xl font-semibold text-secondary mb-8 md:mb-16 opacity-0 data-animate" data-animation="slide-up">{{ $landingpage['description'] }}</h1>
                        <a href="#" class="inline-block text-xl md:text-2xl lg:text-3xl border-2 border-secondary bg-gradient-to-t from-primary via-secondary to-secondary px-6 md:px-8 py-3 md:py-4 font-semibold text-white hover:bg-gradient-to-t hover:from-primary hover:via-primary hover:to-secondary hover:text-white rounded-full">{{ $landingpage['button'] }}</a>
                        <div class="mt-12 md:mt-12 md:mb-12 justify-center flex mx-auto lg:mx-0 lg:justify-start">
                            <x-sosmed></x-sosmed>
                        </div>
                    </div>
                    <img src="{{ $landingpage['image'] }}" alt="" class="order-1 lg:order-2 w-[80%] sm:w-[350px] md:w-[500px] lg:w-[600px] xl:w-[800px] duration-300 opacity-0 data-animate float-animation hover:cursor-pointer hover:scale-105 lg:-mt-12 mx-auto lg:mx-0" data-animation="slide-up">
                </div>
            </div>

            <div class="mx-8 md:mx-32 lg:mx-64 xl:ml-80 pt-8 md:pt-16 items-start mb-20 md:mb-36">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12">
                    <img src="img/icon1.png" alt="" class="hidden xl:block absolute w-45 h-auto left-20 z-20 top-90 mt-0 float-animation">
                    <div class="text-center w-full lg:w-1/2 opacity-0 data-animate" data-animation="slide-up">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-secondary">{{ $landingpage['content']['judul'][0] }}</h1>
                        <p class="bg-white p-6 md:p-10 py-6 md:py-8 rounded-2xl text-center text-lg md:text-xl z-10 lg:text-2xl text-secondary leading-relaxed">{!! $landingpage['content']['description'][0] !!}</p>
                    </div>
                    <img src="{{ $landingpage['content']['gambar'][0] }}" alt="" class="w-full md:w-[400px] lg:w-[600px] opacity-0 data-animate float-animation hover:cursor-pointer hover:scale-105" data-animation="slide-up">
                </div>
            </div>

            <div class="mx-8 md:mx-32 lg:mx-64 xl:mr-80 pt-8 md:pt-16 items-start mb-20 md:mb-36">
                <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-8 lg:gap-12">
                    <img src="{{ $landingpage['content']['gambar'][1] }}" alt="" class="w-full md:w-[400px] lg:w-[600px] opacity-0 data-animate float-animation hover:cursor-pointer hover:scale-105" data-animation="slide-up">
                    <img src="img/icon2.png" alt="" class="hidden xl:block absolute w-45 h-auto right-20 top-100 z-20 mt-0 float-animation">
                    <div class="text-center w-full lg:w-1/2 opacity-0 data-animate" data-animation="slide-up">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 text-secondary">{{ $landingpage['content']['judul'][1] }}</h1>
                        <p class="bg-white p-6 md:p-10 py-6 md:py-8 z-10 rounded-2xl text-center text-lg md:text-xl lg:text-2xl text-secondary leading-relaxed">{!! $landingpage['content']['description'][1] !!}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-secondary p-8 md:p-16 mb-20 md:mb-36">
                <img src="img/icon3.png" alt="" class="hidden xl:block absolute w-45 h-auto left-20 top-110 z-0 float-animation">
                <img src="img/icon5.png" alt="" class="hidden xl:block absolute w-45 h-auto right-0 top-100 z-0 float-animation">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8 md:mb-12 text-center text-white">{{ $landingpage['judulFitur']}}</h1>
                <div class="mx-0 md:mx-0 lg:mx-24 flex flex-wrap justify-center gap-8 md:gap-16">
                    @foreach($landingpage['fitur'] as $fitur)
                        <div class="fitur-item w-full sm:w-[45%] md:w-[30%] lg:w-[25%] h-64 bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-4 justify-center text-center flex flex-col items-center shadow-lg hover:cursor-pointer hover:scale-105 hover:duration-500 z-10 opacity-0 data-animate" data-animation="slide-up">
                            <img src="{{ $fitur['gambar'] }}" alt="Fitur Gambar" class="h-[100px] md:h-[150px] w-auto mx-auto">
                            <p class="text-lg md:text-xl font-semibold text-white">{{ $fitur['isi'] }}</p>
                        </div>
                    @endforeach
                </div>                
            </div> 

            <div class="mb-20 md:mb-36 data-animate" data-animation="slide-up">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8 md:mb-12 text-center text-secondary opacity-0 data-animate" data-animation="slide-up">{{ $landingpage['judulAlasan']}}</h1>
                <div class="mx-8 md:mx-12 lg:mx-24 flex flex-wrap justify-center gap-8 md:gap-16">
                    @foreach($landingpage['alasan'] as $fitur)
                        <div class="fitur-item w-full sm:w-[45%] md:w-[30%] lg:w-[20%] h-auto bg-muda rounded-2xl p-4 justify-center text-center flex flex-col items-center shadow-lg hover:cursor-pointer hover:scale-105 hover:duration-500 z-10 py-12 md:py-20">
                            <img src="{{ $fitur['gambar'] }}" alt="Fitur Gambar" class="h-[100px] md:h-[150px] w-auto mx-auto mb-6 md:mb-8">
                            <p class="text-lg md:text-xl font-semibold text-primary">{{ $fitur['isi'] }}</p>
                        </div>
                    @endforeach
                </div> 
            </div>

            <div class="overflow-hidden opacity-0 data-animate" data-animation="slide-up">
                <div class="bg-gradient-to-l from-secondary to-primary py-8 px-6 sm:px-8 md:px-12 lg:px-16 xl:px-20 shadow-lg flex flex-col lg:flex-row items-center">
                    <!-- Bagian Statistik -->
                    <div class="text-left mb-8 lg:mb-0 lg:w-1/3">
                        <div class="flex items-center mb-4 space-x-4">
                            <p class="font-bold text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-5xl text-tertiary">
                                {{ $landingpage['statistik'][0] }}
                            </p>
                            <img src="{{ asset('img/statland.png') }}" alt="Statistik Icon" class="w-8 h-8 md:w-10 md:h-10 lg:w-10 lg:h-10 xl:w-12 xl:h-12 2xl:w-16 2xl:h-16 mx-4">
                        </div>
                        <p class="font-medium text-sm sm:text-base md:text-lg lg:text-xl text-white">
                            {{ $landingpage['statistik'][1] }}
                        </p>
                    </div>

                    <!-- Bagian Expose -->
                    <div class="flex flex-wrap w-full justify-center lg:justify-center max-w-6xl">
                        @foreach ($landingpage['expose'] as $insight)
                        <div class="flex flex-col items-center text-center border-l-0 lg:border-l-2 px-4 sm:px-6 md:px-8 lg:px-8 xl:px-12 2xl:px-24 border-white">
                            <p class="font-black text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl text-white">
                                {{ $insight['value'] }}
                            </p>
                            <p class="font-medium text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl text-tertiary mt-2">
                                {{ $insight['label'] }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>







            <x-ajakan>{{ $landingpage['ajak'] }}</x-ajakan>

            <div>
                <x-footer :footer="$footer"/>
            </div>
        </main>
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
    </script>
</x-layout>