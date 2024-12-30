<x-app-layout :title="'Profil'" :footer="$footer">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="mt-16 sm:mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col lg:flex-row items-center lg:items-start lg:justify-center lg:space-x-24 space-y-12 lg:space-y-0">
                <div class="text-center lg:w-1/3">
                    <div class="rounded-full mx-auto w-[200px] sm:w-[300px] lg:w-[350px] xl:w-[400px] h-[200px] sm:h-[300px] lg:h-[350px] xl:h-[400px] bg-secondary shadow data-animate"
                        data-animation="slide-up"
                        style="background-image: url('{{ $user['photo'] }}'); background-size: cover; background-position: center;">
                    </div>
                    <div class="mt-8 space-y-4">
                        <p class="text-primary font-regular text-lg sm:text-xl data-animate" data-animation="slide-up">{{ $user['email'] }}</p>
                        <p class="text-primary font-bold text-2xl sm:text-3xl lg:text-4xl data-animate" data-animation="slide-up">{{ $user['name'] }}</p>
                        <p class="text-primary font-medium text-xl sm:text-2xl lg:text-3xl data-animate" data-animation="slide-up">{{ $user['nim'] }}</p>
                        <p class="text-primary font-bold text-lg sm:text-xl lg:text-2xl data-animate" data-animation="slide-up">{{ $user->prodi->prodi_name }}</p>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('profile.editprofile') }}"
                            class="bg-primary rounded-full text-lg sm:text-2xl lg:text-3xl px-8 sm:px-16 py-3 font-semibold text-white hover:bg-secondary hover:text-white data-animate"
                            data-animation="slide-up">Ganti Profil</a>
                    </div>
                </div>

                <div class="p-6 sm:p-12 bg-white w-full lg:w-2/3 h-fit items-start rounded-3xl shadow data-animate"
                    data-animation="slide-up">
                    <h2 class="mb-12 text-lg sm:text-xl font-bold text-secondary data-animate" data-animation="slide-up">
                        {{ __('Tentang Saya') }}
                    </h2>
                    <div class="text-base sm:text-lg lg:text-2xl font-medium text-gray-900 whitespace-normal mt-4 data-animate"
                        data-animation="slide-up">
                        <p class="leading-relaxed">{{ $user['bio'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
