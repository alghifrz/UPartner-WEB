<x-dosen-app-layout :title="'Posting Iklan'" :footer="$footer">
    <x-popupiklan></x-popupiklan>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Posting Iklan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 space-y-10">
            <form method="post" action="{{ route('dosen.iklan.store') }}" class="" enctype="multipart/form-data">
                @csrf

                <div id="gambar-container" class="mb-16 space-y-4 flex flex-col">
                    <!-- Field Upload Sampul -->
                    <div id="gambar-field" class="data-animate" data-animation="slide-up">
                        <x-input-label for="gambar" :value="__('Unggah Iklan')" />
                                
                        <!-- Input File -->
                        <input 
                        id="gambar" 
                        type="file" 
                        name="gambar" 
                        accept=".png, .jpg, .jpeg" 
                        onchange="previewImage(this)" 
                        class="hidden"
                        >
                    </div>
                        
                    <div class="p-4 sm:py-12 sm:px-10 w-full bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                        <!-- Label untuk Input -->
                        <div class="flex justify-center">
                            <label for="gambar" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-4 w-48 items-center flex justify-center">
                                <img src="{{ asset('img/upload.png') }}" class="w-10 h-10" alt="">
                            </label>
                        </div>
                        <!-- Container untuk Preview Gambar -->
                        <div id="preview-container" class="mt-4 hidden">
                            <img 
                                id="preview-image" 
                                class="w-full h-80 object-cover" 
                                src="" 
                                alt="Preview Iklan">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
                    <x-primary-button>{{ __('Posting Iklan') }}</x-primary-button>
                </div>

            </form>
        
        </div>
    </div>
    <script>
        function previewImage(input) {
            const file = input.files[0]; // Mendapatkan file yang diunggah
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Menampilkan gambar ke elemen img
                    const previewImage = document.getElementById('preview-image');
                    const previewContainer = document.getElementById('preview-container');
                    previewImage.src = e.target.result; // Mengatur sumber gambar
                    previewContainer.classList.remove('hidden'); // Menampilkan container
                };
                reader.readAsDataURL(file); // Membaca file sebagai data URL
            }
        }
    </script>
</x-dosen-app-layout>