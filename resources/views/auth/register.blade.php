<x-layoutregislogin :title="'Register Mahasiswa'">
    <div class="relative w-[1300px] h-auto flex flex-col md:flex-row bg-white bg-opacity-30 backdrop-blur-md rounded-[30px] shadow-xl overflow-hidden m-3">
        <!-- Register Form Container -->
        <div class="w-full md:w-1/2 h-auto md:h-full flex items-center text-gray-700 text-center p-20 z-10 py-16">
            {{-- <x-validation-errors class="mb-4" /> --}}
            <x-popupregis></x-popupregis>

            <form method="POST" action="{{ route('register') }}" class="w-full">
                @csrf

                <h1 class="text-2xl md:text-4xl font-extrabold text-primary -mt-3 md:mb-12">Daftar Mahasiswa</h1>
            
                <!-- Nama Lengkap -->
                <div class="error-container mb-6 text-start">
                    <x-label for="name" value="{{ __('Nama Lengkap') }}" class="text-primary text-xl mb-1"/>
                    <input id="name" name="name" :value="old('name')" type="text" autofocus autocomplete="name" placeholder="Masukkan Nama Anda" 
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-user absolute right-5 top-2/3 -translate-y-1/2"></i>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- NIM -->
                <div class="error-container mb-6 text-start">
                    <x-label for="nim" value="{{ __('NIM') }}" class="text-primary text-xl mb-1"/>
                    <input id="nim" name="nim" :value="old('nim')" type="text" placeholder="Masukkan NIM Anda" 
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-id-card absolute right-5 top-2/3 -translate-y-1/2"></i>
                    @error('nim')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Email -->
                <div class="error-container mb-6 text-start">
                    <x-label for="email" value="{{ __('Email') }}" class="text-primary text-xl mb-1"/>
                    <input id="email" name="email" :value="old('email')" type="email" placeholder="Masukkan Email Anda" autocomplete="email"
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-envelope absolute right-5 top-2/3 -translate-y-1/2"></i>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div class="error-container mb-6 text-start">
                    <x-label for="prodi_id" value="{{ __('Program Studi') }}" class="text-primary text-xl mb-1"/>
                    <select name="prodi_id" id="prodi_id" class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                        <option value="" disabled selected>-- Pilih Program Studi --</option>
                        @foreach($prodi as $prodi)
                            <option value="{{ $prodi->id }}" @if(old('prodi_id') == $prodi->id) selected @endif>{{ $prodi->prodi_name }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kata Sandi -->
                <div class="error-container mb-6 text-start">
                    <x-label for="password" value="{{ __('Kata Sandi') }}" class="text-primary text-xl mb-1"/>
                    <input id="password" name="password" type="password" placeholder="Masukkan Kata Sandi Anda" autocomplete="new-password"
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-lock-alt absolute right-5 top-2/3 -translate-y-1/2"></i>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Kata Sandi -->
                <div class="error-container mb-6 text-start">
                    <x-label for="password_confirmation" value="{{ __('Konfirmasi Kata Sandi') }}" class="text-primary text-xl mb-1"/>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Masukkan Kata Sandi Anda" autocomplete="new-password"
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-lock-alt absolute right-5 top-2/3 -translate-y-1/2"></i>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="lg:mb-6 w-full h-12 mt-8 md:mt-12 bg-primary rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-secondary transition-colors">
                    Daftar
                </button>
                <p class="text-md md:text-lg text-white">Sudah punya akun? <span class="font-semibold hover:underline cursor-pointer hover:text-primary"><a href="{{ route('login') }}">Masuk</a></span></p>
                <x-alertregis></x-alertregis>
            </form>
        </div>

        <!-- Blue Panel -->
        <div class="w-full md:w-1/2 bg-primary flex items-center justify-center py-12 md:rounded-tl-[200px] md:rounded-tr-none md:rounded-bl-[200px] rounded-tl-[200px] rounded-tr-[200px]">
            <div class="text-center text-white p-5 md:p-0">
                <img src="/img/logoUPartner.png" alt="logoUPartner" class="lg:h-80 w-auto mx-auto h-32 mb-2 md:mb-2">
                <h1 class="text-4xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-8">UPartner</h1>
                <p class="text-md md:text-lg">Anda seorang Dosen? <span class="font-semibold hover:underline cursor-pointer hover:text-tertiary"><a href="{{ route('dosen.register') }}">Daftar Disini</a></span></p>
            </div>
        </div>
    </div>
</x-layoutregislogin>
