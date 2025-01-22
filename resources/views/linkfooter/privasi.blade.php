<img class="absolute h-full top-0 w-full z-0" src="/img/bg.png" alt="Your Company">
<div class="min-h-full z-20">
<x-app-layout :title="$header" :footer="$footer">
        
        <div class="relative">
            <div class="p-12 flex justify-center text-centre flex-col items-center space-y-2 bg-muda">
                <p class="font-bold xl:text-5xl lg:text-4xl md:text-4xl text-4xl leading-snug text-primary data-animate" data-animation="slide-up">{{ $privasi['header'] }}</p>
                <p class="font-bold xl:text-lg lg:text-lg md:text-2xl text-lg leading-snug text-primary data-animate" data-animation="slide-up">Terakhir diperbarui pada {{ $privasi['waktu'] }}</p>
            </div>

            <div class="my-6 mx-40 text-justify leading-relaxed items-center">
                <p class="font-medium mb-24 xl:text-2xl lg:text-lg md:text-2xl text-lg text-primary leading-relaxed data-animate" data-animation="slide-up">
                    {!! $privasi['content'][0] !!}
                </p>
            </div>
            
            <div class="my-6 mx-40 text-justify leading-relaxed items-center">
                @foreach($privasi['content']['isi']['judul'] as $index => $judul)
                    <p class="font-bold text-center mb-4 xl:text-3xl lg:text-lg md:text-2xl text-lg text-primary leading-relaxed data-animate" data-animation="slide-up">
                        {!! $judul !!}
                    </p>
                    <p class="mb-24 flex space-y-12 font-medium xl:text-xl lg:text-lg md:text-2xl text-lg text-primary leading-relaxed data-animate" data-animation="slide-up">
                        {!! $privasi['content']['isi']['detail'][$index] !!}
                    </p>
                @endforeach
            </div>

        </div>
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