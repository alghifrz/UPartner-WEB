<img class="absolute h-full top-0 w-full z-0" src="/img/bg.png" alt="Your Company">
<div class="min-h-full z-20">
<x-dosen-app-layout :title="$header" :footer="$footer">
        

        <div class="relative">
            <div class="mt-20 flex justify-center text-centre flex-col items-center space-y-2">
                <p class="font-bold xl:text-lg lg:text-lg md:text-2xl text-lg leading-snug text-primary data-animate" data-animation="slide-up">{{ $kontak['judul'][0] }}</p>
                <p class="font-bold xl:text-4xl lg:text-4xl md:text-4xl text-4xl leading-snug text-primary data-animate" data-animation="slide-up">{{ $kontak['judul'][1] }}</p>
            </div>

            <!-- Modal Success -->
            <x-popupkontak></x-popupkontak>
            


            <form action="{{ route('contact.send') }}" method="POST" class="max-w-lg mx-auto mt-8 space-y-6 px-4">
                @csrf
                <div class="space-y-2 data-animate" data-animation="slide-up">
                    <label for="name" class="block text-lg font-medium text-gray-700">Nama:</label>
                    <input type="text" name="name" id="name" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm xl:text-lg">
                </div>

                <div class="space-y-2 data-animate" data-animation="slide-up">
                    <label for="email" class="block text-lg font-medium text-gray-700">Email:</label>
                    <input type="email" name="email" id="email" required 
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm xl:text-lg">
                </div>

                <div class="space-y-2 data-animate" data-animation="slide-up">
                    <label for="message" class="block text-lg font-medium text-gray-700">Pesan:</label>
                    <textarea name="message" id="message" rows="5" required 
                              class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm xl:text-lg"></textarea>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-xl shadow-sm text-lg font-medium text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary data-animate" data-animation="slide-up">
                        Kirim
                    </button>
                </div>
            </form>

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
</x-app-layout>