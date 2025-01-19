{{-- resources/views/components/image-carousel.blade.php --}}
@props(['iklan'])

<div class="relative">
    {{-- Carousel Container --}}
    <div class="carousel-container relative overflow-hidden px-16 py-16 bg-background">
        <div class="carousel-track flex gap-8 transition-transform duration-500">
            @forelse ($iklan as $ad)
                <div class="carousel-item min-w-[90%] px-2 flex-shrink-0 sm:block hidden"> {{-- Hide on small screens --}}
                    <div class="relative w-full h-[400px]">
                        @if ($ad->gambar)
                            <img 
                                src="{{ Storage::url($ad->gambar) }}" 
                                alt="{{ $ad->judul ?? 'Advertisement Image' }}"
                                class="w-full h-full object-cover rounded-lg"
                                style="box-shadow: 5px 15px 15px rgba(0, 0, 0, 0.4);"
                            >
                        @else
                            <img 
                                src="{{ asset('img/beranda.png') }}" 
                                alt="Default Image"
                                class="w-full h-full object-cover rounded-lg"
                            >
                        @endif
                    </div>
                </div>
            @empty
                <div class="carousel-item min-w-[90%] px-2 flex-shrink-0 sm:block hidden">
                    <div class="flex items-center justify-center h-[400px] bg-gray-100 rounded-lg">
                        <p class="text-gray-500 text-lg">Tidak ada iklan tersedia.</p>
                    </div>
                </div>
            @endforelse

            {{-- Clone first items for infinite scroll effect --}}
            @foreach ($iklan as $ad)
                <div class="carousel-item min-w-[90%] px-2 flex-shrink-0 sm:block hidden"> {{-- Hide on small screens --}}
                    <div class="relative w-full h-[400px]">
                        @if ($ad->gambar)
                            <img 
                                src="{{ Storage::url($ad->gambar) }}" 
                                alt="{{ $ad->judul ?? 'Advertisement Image' }}"
                                class="w-full h-full object-cover rounded-lg"
                            >
                        @else
                            <img 
                                src="{{ asset('img/beranda.png') }}" 
                                alt="Default Image"
                                class="w-full h-full object-cover rounded-lg"
                            >
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Navigation Buttons --}}
        @if (count($iklan) > 1)
            <button 
                type="button"
                class="ml-8 carousel-prev absolute left-4 top-1/2 -translate-y-1/2 bg-primary/70 hover:bg-secondary/70 border-2 border-white text-white w-12 h-12 rounded-full flex items-center justify-center focus:outline-none transition-colors duration-200 z-10"
                aria-label="Previous slide"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button 
                type="button"
                class="mr-8 carousel-next absolute right-4 top-1/2 -translate-y-1/2 bg-primary/70 hover:bg-secondary/70 border-2 border-white text-white w-12 h-12 rounded-full flex items-center justify-center focus:outline-none transition-colors duration-200 z-10"
                aria-label="Next slide"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Dots Navigation --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                @foreach ($iklan as $index => $ad)
                    <button 
                        type="button"
                        class="carousel-dot w-3 h-3 rounded-full bg-white hover:bg-white transition-colors duration-200"
                        data-index="{{ $index }}"
                        aria-label="Go to slide {{ $index + 1 }}"
                    ></button>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .carousel-container {
        position: relative;
        width: 100vw;
        overflow: hidden;
    }

    .carousel-track {
        display: flex;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .carousel-item {
        flex: 0 0 100%; /* Each slide is 100% width */
        box-sizing: border-box;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .carousel-dot.active {
        background-color: rgba(9, 66, 95, 0.6);
    }

    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    @media (max-width: 640px) {
        .carousel-container {
            display: none; /* Hide the carousel entirely on small screens */
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.carousel-container');
    if (!container) return;

    const track = container.querySelector('.carousel-track');
    const items = container.querySelectorAll('.carousel-item');
    const prevButton = container.querySelector('.carousel-prev');
    const nextButton = container.querySelector('.carousel-next');
    const dots = container.querySelectorAll('.carousel-dot');

    let currentIndex = 0;
    let intervalId = null;
    const originalSlidesCount = dots.length;
    const totalSlides = items.length;

    if (totalSlides <= 1) return;

    function getOffset() {
        const screenWidth = window.innerWidth;
        if (screenWidth >= 1024) {
            return 101.85; // Default for large screens
        } else if (screenWidth >= 768) {
            return 105.05; // For tablets
        } else {
            return 103.65; // For small screens
        }
    }

    function updateCarousel(index, smooth = true) {
        const offset = getOffset();
        if (smooth) {
            track.style.transition = 'transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        } else {
            track.style.transition = 'none';
        }
        track.style.transform = `translateX(-${index * offset}%)`;

        const activeDotIndex = index % originalSlidesCount;
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === activeDotIndex);
        });

        currentIndex = index;
    }

    function nextSlide() {
        const nextIndex = currentIndex + 1;
        updateCarousel(nextIndex);

        if (nextIndex >= totalSlides - 1) {
            setTimeout(() => {
                updateCarousel(0, false);
            }, 500);
            currentIndex = 0;
        }
    }

    function prevSlide() {
        const prevIndex = currentIndex - 1;
        updateCarousel(prevIndex);

        if (prevIndex <= 0) {
            setTimeout(() => {
                updateCarousel(totalSlides - 1, false);
            }, 500);
            currentIndex = totalSlides - 1;
        }
    }

    if (nextButton) {
        nextButton.addEventListener('click', () => {
            nextSlide();
            resetInterval();
        });
    }

    if (prevButton) {
        prevButton.addEventListener('click', () => {
            prevSlide();
            resetInterval();
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            updateCarousel(index);
            resetInterval();
        });
    });

    function startInterval() {
        intervalId = setInterval(nextSlide, 5000);
    }

    function resetInterval() {
        if (intervalId) {
            clearInterval(intervalId);
            startInterval();
        }
    }

    function handleResize() {
        updateCarousel(currentIndex, false);
    }

    window.addEventListener('resize', handleResize);
    updateCarousel(0);
    startInterval();

    container.addEventListener('mouseenter', () => {
        if (intervalId) clearInterval(intervalId);
    });

    container.addEventListener('mouseleave', () => {
        startInterval();
    });
});
</script>
