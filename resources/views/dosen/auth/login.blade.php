<x-layoutregislogin :title="'Login Dosen'">
    <div class="relative w-[1200px] flex flex-col md:flex-row bg-white bg-opacity-30 backdrop-blur-md rounded-[30px] shadow-xl overflow-hidden m-3">
        <!-- Blue Panel -->
        <div class="w-full md:w-1/2 bg-primary flex items-center justify-center py-20 md:py-40 md:rounded-tr-[200px] md:rounded-bl-none md:rounded-br-[200px] rounded-bl-[200px] rounded-br-[200px]">
            <div class="text-center text-white p-5 md:p-0">
                <img src="/img/logoUPartner.png" alt="logoUPartner" class="lg:h-80 w-auto mx-auto h-32 mb-2 md:mb-2">
                <h1 class="text-4xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-8">UPartner</h1>
                <p class="text-md md:text-lg">Anda seorang Mahasiswa? <span class="font-semibold hover:underline cursor-pointer hover:text-tertiary"><a href="{{ route('login') }}">Masuk Disini</a></span></p>
            </div>
        </div>

        <!-- Register Form Container -->
        <div class="w-full md:w-1/2 flex items-center justify-center py-20">
            <div class="w-full max-w-md px-8">
                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('dosen.login') }}" class="w-full">
                    @csrf

                    <h1 class="text-2xl md:text-4xl font-extrabold text-primary mb-12 text-center">Masuk Dosen</h1>
                
                    <div class="relative mb-6 text-start">
                        <x-label for="email" value="{{ __('Email') }}" class="text-primary text-xl mb-1"/>
                        <input id="email" name="email" :value="old('email')" type="email" required autofocus autocomplete="email" placeholder="Masukkan Email Anda" 
                            class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                        <i class="bx bxs-id-card absolute right-5 top-2/3 -translate-y-1/2"></i>
                    </div>

                    <div class="relative mb-6 text-start">
                        <x-label for="password" value="{{ __('Kata Sandi') }}" class="text-primary text-xl mb-1"/>
                        <input id="password" name="password" type="password" placeholder="Masukkan Kata Sandi Anda" required autocomplete="new-password" 
                            class="w-full py-3 px-5 pr-12 bg-gray-100 rounded-lg border-none outline-none text-sm md:text-base text-gray-700 font-medium">
                        <i class="bx bxs-lock-alt absolute right-5 top-2/3 -translate-y-1/2"></i>
                    </div>

                    <div class="flex justify-between mb-8">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900 underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full h-12 bg-primary rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-secondary transition-colors mb-6">
                        Masuk
                    </button>
                    
                    <p class="text-md md:text-lg text-white text-center">Belum punya akun? <span class="font-semibold hover:underline cursor-pointer hover:text-primary"><a href="{{ route('dosen.register') }}">Daftar</a></span></p>
                </form>
            </div>
        </div>
    </div>
</x-layoutregislogin>