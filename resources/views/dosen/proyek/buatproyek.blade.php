<x-dosen-app-layout :title="'Buat Proyek'" :footer="$footer">
    <x-popupproyek></x-popupproyek>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Buat Proyek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 space-y-10">
            <a href="{{ route('dosen.iklan') }}" class="text-xl data-animate justify-end text-white inline rounded-full cursor-pointer text-right bg-secondary hover:bg-primary font-medium py-2 px-6" data-animation="slide-up">
                + Posting Iklan
            </a>
        
            <div class="bg-white border-gray-300 text-primary p-8 rounded-md shadow-md">
                <form method="post" action="{{ route('dosen.proyek.store') }}" class="" enctype="multipart/form-data">
                    @csrf

                    {{-- Main --}}
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate " data-animation="slide-up">

                        {{-- <div class="space-y-8"> --}}
                            <!-- Judul Proyek -->
                            <div class="data-animate mb-8" data-animation="slide-up">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-book text-xl mb-2 text-primary"></i>
                                    <x-input-label for="judul_proyek" :value="__('Judul Proyek')" />
                                </div>
                                <x-text-input id="judul_proyek" value="{{ old('judul_proyek') }}" name="judul_proyek" type="text" class="mt-1 block w-full"  autofocus autocomplete="judul_proyek"  />
                                <x-input-error class="mt-2" :messages="$errors->get('judul_proyek')" />
                            </div>

                            <!-- Deskripsi Proyek -->
                            <div class="data-animate mb-8" data-animation="slide-up">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-file-alt text-xl mb-2 text-primary"></i>
                                    <x-input-label for="deskripsi_proyek" :value="__('Deskripsi Proyek')" />
                                </div>
                                <textarea id="deskripsi_proyek" value="{{ old('deskripsi_proyek') }}" name="deskripsi_proyek" class="block w-full h-48 bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none"  autofocus autocomplete="deskripsi_proyek" placeholder="Masukkan Deskripsi Proyek Anda"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('deskripsi_proyek')" />
                            </div>

                            <div class="flex justify-between space-x-8">
                                <!-- Tanggal Mulai -->
                                <div class="data-animate flex-1" data-animation="slide-up">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-calendar-alt text-xl mb-2 text-primary"></i>
                                        <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
                                    </div>
                                    <x-text-input id="tanggal_mulai" value="{{ old('tanggal_mulai') }}" name="tanggal_mulai" type="date" class="mt-1 block w-full"  autofocus autocomplete="tanggal_mulai" />
                                    <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
                                </div>
                                <!-- Tanggal Selesai -->
                                <div class="data-animate flex-1" data-animation="slide-up">
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-calendar-alt text-xl mb-2 text-primary"></i>
                                        <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                                    </div>
                                    <x-text-input id="tanggal_selesai" value="{{ old('tanggal_selesai') }}" name="tanggal_selesai" type="date" class="mt-1 block w-full"  autofocus autocomplete="tanggal_selesai" />
                                    <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>

                    {{-- Kegiatan --}}
                    <div class="data-animate flex justify-between items-end" data-animation="slide-up">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tasks text-xl mb-2 text-primary"></i>
                            <x-input-label for="kegiatan" :value="__('Agenda Kegiatan')" />
                        </div>
                        <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
                            <!-- Tombol "+" untuk menambahkan kegiatan -->
                            <button type="button" onclick="tambahKegiatan()" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6 items-center flex justify-center">
                                +
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                        <div id="kegiatan-container" class="space-y-4">
                            <!-- Kegiatan akan ditambahkan di sini -->
                        </div>
                    </div>

                    {{-- Persyaratan Kemampuan --}}
                    <div class="data-animate flex justify-between items-end" data-animation="slide-up">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-lightbulb text-xl mb-2 text-primary"></i>
                            <x-input-label for="persyaratan" :value="__('Persyaratan Kemampuan')" />
                        </div>
                        <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
                            <!-- Tombol "+" untuk menambahkan persyaratan -->
                            <button type="button" onclick="tambahPersyaratan()" class="cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6 items-center flex justify-center">
                                +
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                        <div id="persyaratan-container" class="space-y-4">
                            <!-- Persyaratan akan ditambahkan di sini -->
                        </div>           
                    </div>

                    {{-- Perangkat --}}
                    <div class="data-animate flex justify-between items-end" data-animation="slide-up">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-tag text-xl mb-2 text-primary"></i>
                            <x-input-label for="role" :value="__('Role yang dibutuhkan')" />
                        </div>
                        <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
                            <!-- Tombol "+" untuk menambahkan role -->
                            <button type="button" onclick="tambahrole()" class="cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6 items-center flex justify-center">
                                + 
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                        <div id="role-container" class="space-y-4">
                            <!-- role akan ditambahkan di sini -->
                        </div>
                    </div>

                    {{-- Sampul --}}
                    <div id="sampul-container" class="mb-16 space-y-4 flex flex-col">
                        <!-- Field Upload Sampul -->
                        <div id="sampul-field" class="data-animate" data-animation="slide-up">
                        <div id="sampul-field" class="" data-animation="slide-up">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-image text-xl mb-2 text-primary"></i>
                                <x-input-label for="sampul" :value="__('Unggah Sampul Proyek')" />
                            </div>
                                    
                            <!-- Input File -->
                            <input 
                            id="sampul" 
                            type="file" 
                            name="sampul" 
                            accept=".png, .jpg, .jpeg" 
                            onchange="previewImage(this)" 
                            class="hidden"
                            value="{{ old('sampul') }}"
                            >
                        </div>
                            
                        <div class="p-4 sm:py-12 sm:px-10 w-full bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                            <!-- Label untuk Input -->
                            <div class="flex justify-center">
                                <label for="sampul" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-4 w-48 items-center flex justify-center">
                                    <img src="{{ asset('img/upload.png') }}" class="w-10 h-10" alt="">
                                </label>
                            </div>
                            <!-- Container untuk Preview Gambar -->
                            <div id="preview-container" class="mt-4 hidden">
                                <img 
                                    id="preview-image" 
                                    class="w-full h-auto object-cover rounded-lg shadow-md" 
                                    src="" 
                                    alt="Preview Sampul">
                            </div>
                        </div>
                    </div>
                                
                    
                    <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
                        <x-primary-button>{{ __('Buat Proyek') }}</x-primary-button>
                    </div>
                </form>
            </div>
               
        </div>
    </div>
    <!-- Javascript untuk menambahkan dan menghapus kegiatan -->
    <script>
        let kegiatanCount = 0; // Untuk melacak jumlah kegiatan yang ditambahkan

        function tambahKegiatan() {
            kegiatanCount++;
            
            const kegiatanDiv = document.createElement('div');
            kegiatanDiv.setAttribute('id', 'kegiatan-' + kegiatanCount);
            
            kegiatanDiv.innerHTML = `
                <div class="flex justify-between space-x-8">
                    <div class="flex-1 data-animate" data-animation="slide-up">
                        <x-input-label for="kegiatan[${kegiatanCount}][kegiatan]" :value="__('Kegiatan-${kegiatanCount}')" />
                        <x-text-input type="text" value="{{ old('kegiatan[${kegiatanCount}][nama]') }}" name="kegiatan[${kegiatanCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Nama Kegiatan" />
                    </div>
                    <div class="flex justify-between space-x-8">
                        <div class="data-animate" data-animation="slide-up">
                            <x-input-label for="kegiatan[${kegiatanCount}][tanggal_mulai]" :value="__('Mulai')" />
                            <x-text-input type="date" value="{{ old('kegiatan[${kegiatanCount}][tanggal_mulai]') }}" name="kegiatan[${kegiatanCount}][tanggal_mulai]" class="kegiatan-tanggal mt-1 block w-full" />
                            @error('kegiatan.*.tanggal_mulai')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="data-animate" data-animation="slide-up">
                            <x-input-label for="kegiatan[${kegiatanCount}][tanggal_selesai]" :value="__('Selesai')" />
                            <x-text-input type="date" value="{{ old('kegiatan[${kegiatanCount}][tanggal_selesai]') }}" name="kegiatan[${kegiatanCount}][tanggal_selesai]" class="kegiatan-tanggal mt-1 block w-full" />
                            @error('kegiatan.*.tanggal_selesai')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="data-animate" data-animation="slide-up">    
                            <button type="button" onclick="hapusKegiatan(${kegiatanCount})" class="cursor-pointer mt-10 text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                                X
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.getElementById('kegiatan-container').appendChild(kegiatanDiv);
        }

        function hapusKegiatan(id) {
            const kegiatanElement = document.getElementById('kegiatan-' + id);
            kegiatanElement.remove();
            kegiatanCount--;
        }

        let persyaratanCount = 0;

        function tambahPersyaratan() {
            persyaratanCount++;
            const container = document.getElementById('persyaratan-container');
            
            // Membuat field input untuk persyaratan
            const persyaratanDiv = document.createElement('div');
            persyaratanDiv.classList.add('flex', 'justify-between', 'space-x-8');
            persyaratanDiv.id = `persyaratan-${persyaratanCount}`; // Menambahkan ID unik untuk div

            // Menambahkan HTML ke dalam div
            persyaratanDiv.innerHTML = `
                <div class="flex-1 data-animate" data-animation="slide-up">
                    <x-text-input type="text" value="{{ old('persyaratan[${persyaratanCount}][nama]') }}" name="persyaratan[${persyaratanCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Persyaratan Kemampuan-${persyaratanCount}" />
                </div>
                <div class="data-animate" data-animation="slide-up">    
                    <button type="button" onclick="hapusPersyaratan(${persyaratanCount})" class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                        X
                    </button>
                </div>
            `;
            
            // Menambahkan div persyaratan ke container
            container.appendChild(persyaratanDiv);
        }

        function hapusPersyaratan(id) {
            const persyaratanDiv = document.getElementById(`persyaratan-${id}`); // Menemukan elemen berdasarkan ID
            if (persyaratanDiv) {
                persyaratanDiv.remove(); // Menghapus div tersebut
                persyaratanCount--;
            }
        }

        let roleCount = 0;

        function tambahrole() {
            roleCount++;
            const container = document.getElementById('role-container');
            
            // Membuat field input untuk role
            const roleDiv = document.createElement('div');
            roleDiv.classList.add('flex', 'justify-between', 'space-x-8');
            roleDiv.id = `role-${roleCount}`; // Menambahkan ID unik untuk div

            // Menambahkan HTML ke dalam div
            roleDiv.innerHTML = `
                <div class="flex-1 data-animate" data-animation="slide-up">
                    <x-text-input type="text" value="{{ old('role[${roleCount}][nama]') }}" name="role[${roleCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Role-${roleCount}" />
                </div>
                <div class="data-animate" data-animation="slide-up">    
                    <button type="button" onclick="hapusrole(${roleCount})" class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                        X
                    </button>
                </div>
            `;
            
            // Menambahkan div role ke container
            container.appendChild(roleDiv);
            }

            function hapusrole(id) {
                const roleDiv = document.getElementById(`role-${id}`); // Menemukan elemen berdasarkan ID
                if (roleDiv) {
                    roleDiv.remove(); // Menghapus div tersebut
                    roleCount--;
                }
            }

            // Fungsi untuk Menampilkan Preview Gambar
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
