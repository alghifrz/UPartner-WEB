<x-layoutregislogin :title="'Reset Password'">
    <div class="relative w-[600px] bg-white bg-opacity-30 backdrop-blur-md rounded-[30px] shadow-xl overflow-hidden m-3 p-8">
        <div class="mb-4 text-white font-medium text-2xl">
            {{ __('Lupa password? Tenang masukkan emailmu dan kami akan mengirmkan link reset password ke email tersebut') }}
        </div>
    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
    
            <!-- Email Address -->
            <div class="flex justify-center flex-col items-start">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full justify-center" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layoutregislogin>
