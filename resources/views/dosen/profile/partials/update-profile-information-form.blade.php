<section>
    <form method="post" action="{{ route('dosen.profile.update') }}" class="mt-6 space-y-10" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Foto Profil -->
        <div class="bg-white shadow sm:rounded-3xl p-8 px-16 data-animate" data-animation="slide-up">
                <div class="flex justify-between avatar-upload items-center">
                    <div class="flex space-x-8 items-center">
                        <div class="size-52 text-center rounded-full bg-white" id="imagePreview" 
                            style="background-image: url('{{ isset($user->photo) && $user->photo ? asset($user->photo) : asset('img/avatar.png') }}'); background-size: cover;">
                        </div>
                        <div class="text-left items-center">
                            <p class="mb-3 text-primary font-bold text-3xl">{{ $user['name'] }}</p>
                            <p class="mb-2 text-primary font-medium text-2xl">{{ $user['nip'] }}</p>
                            <p class="mb-3 text-primary font-medium text-2xl">{{ $user->prodi->prodi_name }}</p>
                        </div>
                    </div>
                    <input type="file" id="imageUpload" name="photo" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" class="hidden">
                    <label for="imageUpload" class="cursor-pointer text-white text-xl mb-3 rounded-full bg-primary hover:bg-secondary font-medium py-4 w-48 items-center flex justify-center">Ganti Foto</label>
                </div>
            @error('photo')
            <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>        

        <!-- Nama -->
        <div class="data-animate" data-animation="slide-up">
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- NIM -->
        <div class="data-animate" data-animation="slide-up">
            <x-input-label for="nip" :value="__('NIP')" />
            <x-text-input id="nip" name="nip" type="text" class="mt-1 block w-full" :value="old('nip', $user->nip)" required autofocus autocomplete="nip" />
            <x-input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>

        {{-- Email --}}
        <div class="data-animate" data-animation="slide-up">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Jurusan --}}
        <div class="data-animate" data-animation="slide-up">
            <x-input-label for="prodi_id" value="{{ __('Jurusan ') }}"/>
            <select name="prodi_id" id="prodi_id" class="w-full bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none" required>
                @foreach($prodi as $prodi)
                    <option value="{{ $prodi->id }}" @if(old('prodi_id') == $user->prodi_id) selected @endif class="bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none">{{ $user->prodi->prodi_name }}</option>
                @endforeach
            </select>        
        </div>

        {{-- Bio --}}
        <div class="data-animate" data-animation="slide-up">
            <x-input-label for="bio" :value="__('Deskripsi')" />
            <textarea id="bio" name="bio" class="block w-full h-48 bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none" required autofocus autocomplete="bio" placeholder="Masukkan bio Anda">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>
        

        <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
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
    <script type="text/javascript">
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Mengubah background-image untuk preview
                    var imagePreview = document.getElementById("imagePreview");
                    imagePreview.style.backgroundImage = 'url(' + e.target.result + ')';
                    imagePreview.style.display = 'none';  // Menyembunyikan gambar lama
                    imagePreview.style.display = 'block'; // Menampilkan gambar baru
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
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
</section>
