<x-app-layout :title="'Profil'" :footer="$footer">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="mt-24">
        <div class="max-w-[1500px] mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-center space-x-24">
                <div class="">
                    {{-- <img src="{{ $user['photo'] }}" alt="" class="w-[650px] mb-8"> --}}
                    <div class="size-[450px] text-center rounded-full mx-auto mb-8 bg-secondary shadow data-animate" data-animation="slide-up"
                        style="background-image: url('{{  $user['photo'] }}'); background-size: cover;">
                    </div>
                    <div class="mb-24 text-center">
                        <p class="mt-3 text-primary font-regular text-xl data-animate" data-animation="slide-up">{{ $user['email'] }}</p>
                        <p class="mt-3 text-primary font-bold text-4xl data-animate" data-animation="slide-up">{{ $user['name'] }}</p>
                        <p class="mt-3 text-primary font-medium text-3xl data-animate" data-animation="slide-up">{{ $user['nim'] }}</p>
                        <p class="mt-3 text-primary font-bold text-2xl data-animate" data-animation="slide-up">{{ $user->prodi->prodi_name }}</p>
                    </div>
                    <div class="text-center data-animate" data-animation="slide-up">
                        <a href="{{ route('profile.editprofile') }}" class="bg-primary mt-12 rounded-full text-2xl md:text-3xl lg:text-4xl px-8 md:px-24 py-3 md:py-4 font-semibold text-white hover:bg-secondary hover:text-white rotate-3 data-animate" data-animation="slide-up">Ganti Profil</a>
                    </div>
                </div>
                <div class="p-12 sm:p-12 bg-white w-full h-fit items-start rounded-3xl shadow sm:rounded-3xl data-animate" data-animation="slide-up">
                    <h2 class="text-xl mb-8 font-bold text-secondary data-animate" data-animation="slide-up">
                        {{ __('Tentang Saya') }}
                    </h2>
                    <!-- Div dengan bio yang mengikuti tinggi kontennya -->
                    <div class="text-2xl font-medium text-gray-900 whitespace-normal data-animate" data-animation="slide-up">
                        <p class="leading-relaxed data-animate" data-animation="slide-up">{{ $user['bio'] }}</p>
                    </div>
                </div>                
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
</x-app-layout>
