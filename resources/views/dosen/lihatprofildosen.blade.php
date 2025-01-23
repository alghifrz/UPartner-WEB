<x-dosen-app-layout :title="'Profil'" :footer="$footer">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="mt-8 sm:mt-12">
        <div class="xl:mx-48 lg:mx-48 mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col lg:flex-row items-center lg:items-start lg:justify-center lg:space-x-24 space-y-12 lg:space-y-0">
                <div class="text-center lg:w-1/3">
                    <div class="rounded-full mx-auto w-[200px] sm:w-[300px] lg:w-[350px] xl:w-[400px] h-[200px] sm:h-[300px] lg:h-[350px] xl:h-[400px] bg-white shadow data-animate"
                        data-animation="slide-up"
                        style="background-image: url('{{ asset($user['photo']) }}'); background-size: cover;">
                    </div>
                    <div class="mt-8 space-y-1">                    
                        <!-- Nama -->
                        <div class="data-animate" data-animation="slide-up">
                            <p class="text-primary font-bold text-2xl sm:text-3xl lg:text-4xl">
                                {{ $user['name'] ?? 'Nama tidak tersedia' }}
                            </p>
                        </div>
                    
                        <!-- NIP -->
                        <div class="data-animate" data-animation="slide-up">
                            <p class="text-secondary mb-2 font-bold text-lg sm:text-xl">
                                NIP: {{ $user['nip'] ?? 'NIP tidak tersedia' }}
                            </p>
                        </div>
                    
                        <!-- Program Studi -->
                        <div class="data-animate" data-animation="slide-up">
                            <p class="text-primary font-bold text-lg sm:text-xl lg:text-2xl mb-4">
                                {{ $user->prodi->prodi_name ?? 'Program Studi tidak tersedia' }}
                            </p>
                        </div>
                        
                        <!-- Email -->
                        <div class="data-animate" data-animation="slide-up">
                            <p class="text-secondary mb-2 text-md sm:text-md font-medium">
                                <i class="fas fa-envelope text-md mr-2"></i>{{ $user['email'] ?? 'Email tidak tersedia' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class=" p-6 sm:p-12 bg-white h-fit items-start rounded-3xl shadow data-animate mb-12"
                        data-animation="slide-up">
                        <h2 class="mb-4 text-lg sm:text-xl font-bold items-center text-secondary data-animate" data-animation="slide-up">
                            <i class="fas fa-info-circle text-xl mr-2"></i>{{ __('Tentang Saya') }}
                        </h2>
                        <div class="text-base sm:text-lg lg:text-2xl font-medium text-gray-900 whitespace-normal data-animate"
                            data-animation="slide-up">
                            <p class="leading-snug">{{ $user['bio'] }}</p>
                        </div>
                    </div>
                    <div class="p-6 sm:p-12 bg-white h-fit items-start rounded-3xl shadow data-animate"
                        data-animation="slide-up">
                        <h2 class="mb-6 text-lg sm:text-xl font-bold text-secondary data-animate" data-animation="slide-up">
                            <i class="fas fa-users mr-2"></i>{{ __('Kontribusi Proyek') }} ({{ $user->pendaftaran->where('status', 'Diterima')->count() + $user->proyekDikelola->count() }})
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-12">
                            @foreach ($user->proyekDikelola as $proyek)
                                <a href="{{ route('dosen.proyekdetail', $proyek) }}" class="bg-white rounded-[90px] shadow-lg justify-center hover:scale-105 hover:duration-500 hover:ease-in-out cursor-pointer">
                                    <div class="w-full h-52 rounded-t-[90px] mb-4" 
                                        style="background: url('{{ asset('storage/' . $proyek->sampul ?? 'path-to-default-image.jpg') }}') no-repeat center center / cover;">
                                    </div>                                   
                                    <h3 class="px-6 text-lg font-bold text-primary mb-2">
                                        {{ Str::limit($proyek->judul_proyek ?? 'Nama Proyek Tidak Ditemukan', 50, '...') }}
                                    </h3>
                                    <p class="px-6 text-sm text-gray-500 mb-4">
                                        {{ $proyek->tanggal_mulai->format('F Y') ?? 'Tanggal Tidak Ditemukan' }} - {{ $proyek->tanggal_selesai->format('F Y') ?? 'Tanggal Tidak Ditemukan' }}
                                    </p>
                                    <p class="mx-6 text-sm text-tertiary font-semibold mt-2 pt-4 text-center border-t-2 border-gray-200 mb-6">
                                        Sebagai </br><span class="text-secondary text-xl font-bold">Manajer Proyek</span>
                                    </p>        
                                </a>
                            @endforeach
                            @foreach ($user->pendaftaran as $pendaftaran)
                                @if ($pendaftaran->status == 'Diterima')
                                    <a href="{{ route('dosen.detailproyek', $pendaftaran->proyek) }}" class="bg-white rounded-[90px] shadow-lg justify-center hover:scale-105 hover:duration-500 hover:ease-in-out cursor-pointer">
                                        <div class="w-full h-52 rounded-t-[90px] mb-4" 
                                            style="background: url('{{ asset('storage/' . $pendaftaran->proyek->sampul ?? 'path-to-default-image.jpg') }}') no-repeat center center / cover;">
                                        </div>                                   
                                        <h3 class="px-6 text-lg font-bold text-primary mb-2">
                                            {{ Str::limit($pendaftaran->proyek->judul_proyek ?? 'Nama Proyek Tidak Ditemukan', 50, '...') }}
                                        </h3>
                                        <p class="px-6 text-sm text-gray-500 mb-4">
                                            {{ $pendaftaran->proyek->tanggal_mulai->format('F Y') ?? 'Tanggal Tidak Ditemukan' }} - {{ $pendaftaran->proyek->tanggal_selesai->format('F Y') ?? 'Tanggal Tidak Ditemukan' }}
                                        </p>
                                        <p class="mx-6 text-sm text-tertiary font-semibold mt-2 pt-4 text-center border-t-2 border-gray-200 mb-6">
                                            Sebagai </br><span class="text-secondary text-xl font-bold">{{ $pendaftaran->role ?? 'Peran Tidak Diketahui' }}</span>
                                        </p>        
                                    </a>
                                @endif
                            @endforeach
                        </div>
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
</x-dosen-app-layout>
