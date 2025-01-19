<section>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-10" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Foto Profil -->
        <div class="bg-white shadow sm:rounded-3xl p-8 sm:px-16 data-animate" data-animation="slide-up">
            <div class="flex flex-col sm:flex-row md:flex-row justify-between items-center space-y-4 sm:space-y-0 md:space-y-0 sm:space-x-8 md:space-x-8 avatar-upload">
                <div class="flex flex-col sm:flex-row md:flex-row sm:space-x-8 md:space-x-8 items-center space-y-4 sm:space-y-0 md:space-y-0">
                    <div class="size-52 text-center rounded-full bg-secondary" id="imagePreview" 
                        style="background-image: url('{{ isset($user->photo) && $user->photo ? asset($user->photo) : asset('img/avatar.png') }}'); background-size: cover;">
                    </div>
                    <div class="text-center sm:text-left md:text-left">
                        <p class="text-primary font-bold text-xl sm:text-3xl md:text-3xl">{{ $user['name'] }}</p>
                        <p class="text-primary font-medium text-lg sm:text-2xl md:text-2xl">{{ $user['nim'] }}</p>
                        <p class="text-primary font-medium text-lg sm:text-2xl md:text-2xl">{{ $user->prodi->prodi_name }}</p>
                    </div>
                </div>
                <input type="file" id="imageUpload" name="photo" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" class="hidden">
                <label for="imageUpload" class="cursor-pointer text-white text-sm sm:text-xl md:text-xl rounded-full bg-primary hover:bg-secondary font-medium py-2 sm:py-4 md:py-4 w-32 sm:w-48 md:w-48 flex justify-center items-center">
                    Ganti Foto
                </label>
            </div>
            @error('photo')
            <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>        

        <!-- Nama -->
        <div class="data-animate mx-4 px-4 sm:mx-6" data-animation="slide-up">
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- NIM -->
        <div class="data-animate mx-4 px-4 sm:mx-6" data-animation="slide-up">
            <x-input-label for="nim" :value="__('NIM')" />
            <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" :value="old('nim', $user->nim)" required autofocus autocomplete="nim" />
            <x-input-error class="mt-2" :messages="$errors->get('nim')" />
        </div>

        <!-- Email -->
        <div class="data-animate mx-4 px-4 sm:mx-6" data-animation="slide-up">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Jurusan -->
        <div class="data-animate mx-4 px-4 sm:mx-6" data-animation="slide-up">
            <x-input-label for="prodi_id" value="{{ __('Jurusan ') }}"/>
            <select name="prodi_id" id="prodi_id" class="w-full bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none" required>
                @foreach($prodi as $prodi)
                    <option value="{{ $prodi->id }}" @if(old('prodi_id') == $user->prodi_id) selected @endif class="bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none">{{ $user->prodi->prodi_name }}</option>
                @endforeach
            </select>        
        </div>

        <!-- Bio -->
        <div class="data-animate mx-4 px-4 sm:mx-6" data-animation="slide-up">
            <x-input-label for="bio" :value="__('Deskripsi')" />
            <textarea id="bio" name="bio" class="block w-full h-32 sm:h-48 md:h-48 bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none" required autofocus autocomplete="bio" placeholder="Masukkan bio Anda">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>
        
        <!-- Simpan -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 data-animate" data-animation="slide-up">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
