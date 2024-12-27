<div class="mb-20 md:mb-36 overflow-hidden opacity-0 data-animate" data-animation="slide-up">
    <div class="bg-muda -rotate-3 p-8 md:p-20 shadow-lg flex flex-col justify-center items-center text-center">
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-semibold mb-8 md:mb-12 text-primary rotate-3 max-w-3xl lg:leading-normal">{{ $slot }}</h1>
        <a href="{{ route('register') }}" class="bg-primary rounded-full text-2xl md:text-3xl lg:text-4xl px-8 md:px-16 py-3 md:py-4 font-semibold text-white hover:bg-secondary hover:text-white rotate-3">Daftar</a>
    </div>
</div>