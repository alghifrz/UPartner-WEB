<x-layoutregislogin :title="'Register Dosen'">
    <div class="relative w-[1300px] h-auto flex flex-col md:flex-row bg-white bg-opacity-30 backdrop-blur-md rounded-[30px] shadow-xl overflow-hidden m-3">
        <!-- Register Form Container -->
        <div class="w-full md:w-1/2 h-auto md:h-full flex items-center text-gray-700 text-center p-20 z-10 py-16">

            <x-validation-errors class="mb-4" />
            
            

            <form method="POST" action="{{ route('dosen.register') }}" class="w-full">
                @csrf

                <h1 class="text-2xl md:text-4xl font-extrabold text-primary -mt-3 md:mb-12">Daftar Dosen</h1>
            
                <div class="relative my-6 md:my-4 text-start">
                    <x-label for="name" value="{{ __('Nama Lengkap') }}" class="text-primary text-xl mb-1"/>
                    <input id="name" name="name" :value="old('name')" type="text" required autofocus autocomplete="name" placeholder="Masukkan Nama Anda" 
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-user absolute right-5 top-2/3 -translate-y-1/2"></i>
                </div>
            
                <div class="relative my-6 md:my-4 text-start">
                    <x-label for="nip" value="{{ __('NIP') }}" class="text-primary text-xl mb-1"/>
                    <input id="nip" name="nip" :value="old('nip')" type="text" required autofocus autocomplete="nip" placeholder="Masukkan NIP Anda" 
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-id-card absolute right-5 top-2/3 -translate-y-1/2"></i>
                </div>
            
                <div class="relative my-6 md:my-4 text-start">
                    <x-label for="email" value="{{ __('Email') }}" class="text-primary text-xl mb-1"/>
                    <input id="email" name="email" :value="old('email')" type="email" placeholder="Masukkan Email Anda" required autocomplete="email"
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-envelope absolute right-5 top-2/3 -translate-y-1/2"></i>
                </div>

                <div class="relative my-6 md:my-4 text-start">
                    <x-label for="prodi_id" value="{{ __('Program Studi') }}" class="text-primary text-xl mb-1"/>
                    <select name="prodi_id" id="prodi_id" class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium" required>
                        <option value="" disabled selected>-- Pilih Program Studi --</option>
                        @foreach($prodi as $prodi)
                            <option value="{{ $prodi->id }}" @if(old('prodi_id') == $prodi->id) selected @endif>{{ $prodi->prodi_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="relative my-6 md:my-4 text-start">
                    <x-label for="password" value="{{ __('Kata Sandi') }}" class="text-primary text-xl mb-1"/>
                    <input id="password" name="password" type="password" placeholder="Masukkan Kata Sandi Anda" required autocomplete="new-password" 
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-lock-alt absolute right-5 top-2/3 -translate-y-1/2"></i>
                </div>

                <div class="relative my-6 md:my-4 text-start">
                    <x-label for="password_confirmation" value="{{ __('Konfirmasi Kata Sandi') }}" class="text-primary text-xl mb-1"/>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Masukkan Kata Sandi Anda" required autocomplete="new-password" 
                        class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                    <i class="bx bxs-lock-alt absolute right-5 top-2/3 -translate-y-1/2"></i>
                </div>

                <button type="submit" class="lg:mb-6 w-full h-12 mt-8 md:mt-12 bg-primary rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-secondary transition-colors">
                    Daftar
                </button>
                <p class="text-md md:text-lg text-white">Sudah punya akun? <span class="font-semibold hover:underline cursor-pointer hover:text-primary"><a href="{{ route('dosen.login') }}">Masuk</a></span></p>
                
            </form>
        </div>

        <!-- Blue Panel -->
        <div class="w-full md:w-1/2 bg-primary flex items-center justify-center py-12 md:rounded-tl-[200px] md:rounded-tr-none md:rounded-bl-[200px] rounded-tl-[200px] rounded-tr-[200px]">
            <div class="text-center text-white p-5 md:p-0">
                <img src="/img/logoUPartner.png" alt="logoUPartner" class="lg:h-80 w-auto mx-auto h-32 mb-2 md:mb-2">
                <h1 class="text-4xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-8">UPartner</h1>
                <p class="text-md md:text-lg">Anda seorang Mahasiswa? <span class="font-semibold hover:underline cursor-pointer hover:text-tertiary"><a href="{{ route('register') }}">Daftar Disini</a></span></p>
                {{-- <a href="{{ route('login') }}" 
                    class="inline-block w-32 md:w-40 h-10 md:h-12 leading-[38px] md:leading-[46px] border-2 border-white rounded-lg text-white font-semibold hover:bg-white hover:text-[#7494ec] transition-colors">
                    Login
                </a> --}}
            </div>
        </div>
    </div>
</x-layoutregislogin>
