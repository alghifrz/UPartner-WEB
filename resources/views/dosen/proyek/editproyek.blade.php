<x-dosen-app-layout :title="'Proyek Saya'" :footer="$footer">
    <x-popupdaftar></x-popupdaftar>
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebardosen />

        <div class="flex-1 p-6">
            <div class="flex space-x-4 mb-2">
                <i class="fas fa-project-diagram text-3xl text-center text-tertiary"></i>
                <h3 class="text-3xl font-bold mb-6 text-primary">Edit Proyek</h3>
            </div>
            <div class="bg-white border-gray-300 text-primary p-8 rounded-md shadow-md">

                <form method="post" action="{{ route('dosen.updateproyek', $proyek->id) }}" class="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Main --}}
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl " data-animation="slide-up">
                        <!-- Judul Proyek -->
                        <div class=" mb-8" data-animation="slide-up">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-book text-xl mb-2 text-primary"></i>
                                <x-input-label for="judul_proyek" :value="__('Judul Proyek')" />
                            </div>
                            <x-text-input id="judul_proyek" value="{{ old('judul_proyek', $proyek->judul_proyek) }}" name="judul_proyek" type="text" class="mt-1 block w-full" autofocus autocomplete="judul_proyek" />
                            <x-input-error class="mt-2" :messages="$errors->get('judul_proyek')" />
                        </div>

                        <!-- Deskripsi Proyek -->
                        <div class=" mb-8" data-animation="slide-up">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-file-alt text-xl mb-2 text-primary"></i>
                                <x-input-label for="deskripsi_proyek" :value="__('Deskripsi Proyek')" />
                            </div>
                            <textarea id="deskripsi_proyek" name="deskripsi_proyek" class="block w-full h-48 bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none" autofocus autocomplete="deskripsi_proyek" placeholder="Masukkan Deskripsi Proyek Anda">{{ old('deskripsi_proyek', $proyek->deskripsi_proyek) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi_proyek')" />
                        </div>

                        <div class="flex justify-between space-x-8">
                            <!-- Tanggal Mulai -->
                            <div class=" flex-1" data-animation="slide-up">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-alt text-xl mb-2 text-primary"></i>
                                    <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
                                </div>
                                <x-text-input id="tanggal_mulai" 
                                    value="{{ old('tanggal_mulai') ?? \Carbon\Carbon::parse($proyek->tanggal_mulai)->format('Y-m-d') }}" 
                                    name="tanggal_mulai" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    autofocus autocomplete="tanggal_mulai" />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
                            </div>
                            <!-- Tanggal Selesai -->
                            <div class=" flex-1" data-animation="slide-up">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-alt text-xl mb-2 text-primary"></i>
                                    <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                                </div>
                                <x-text-input id="tanggal_selesai" value="{{ old('tanggal_selesai') ?? \Carbon\Carbon::parse($proyek->tanggal_selesai)->format('Y-m-d') }}" name="tanggal_selesai" type="date" class="mt-1 block w-full" autofocus autocomplete="tanggal_selesai" />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
                            </div>
                        </div>
                    </div>

                    {{-- Kegiatan --}}
                    <div class=" flex justify-between items-end" data-animation="slide-up">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tasks text-xl mb-2 text-primary"></i>
                            <x-input-label for="kegiatan" :value="__('Agenda Kegiatan')" />
                        </div>
                        <div class="flex items-center justify-center gap-4 " data-animation="slide-up">
                            <button type="button" onclick="tambahKegiatan()" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6 items-center flex justify-center">
                                +
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl  mt-6 space-y-10" data-animation="slide-up">
                        <div id="kegiatan-container" class="space-y-4">
                            @foreach($proyek->kegiatan as $index => $kegiatan)
                            <div id="kegiatan-{{ $index }}" class="flex justify-between space-x-8">
                                <div class="flex-1 " data-animation="slide-up">
                                    <x-input-label for="kegiatan[{{ $index }}][kegiatan]" :value="__('Kegiatan-' . ($index + 1))" />
                                    <x-text-input type="text" value="{{ old('kegiatan.'.$index.'.nama', $kegiatan->nama) }}" name="kegiatan[{{ $index }}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Nama Kegiatan" />
                                </div>
                                <div class="flex justify-between space-x-8">
                                    <div class="" data-animation="slide-up">
                                        <x-input-label for="kegiatan[{{ $index }}][tanggal_mulai]" :value="__('Mulai')" />
                                        <x-text-input type="date" value="{{ old('kegiatan.'.$index.'.tanggal_mulai') ?? \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('Y-m-d') }}" name="kegiatan[{{ $index }}][tanggal_mulai]" class="kegiatan-tanggal mt-1 block w-full" />
                                    </div>
                                    <div class="" data-animation="slide-up">
                                        <x-input-label for="kegiatan[{{ $index }}][tanggal_selesai]" :value="__('Selesai')" />
                                        <x-text-input type="date" value="{{ old('kegiatan.'.$index.'.tanggal_selesai') ?? \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('Y-m-d') }}" name="kegiatan[{{ $index }}][tanggal_selesai]" class="kegiatan-tanggal mt-1 block w-full" />
                                    </div>
                                    <div class="" data-animation="slide-up">    
                                        <button type="button" onclick="hapusKegiatan({{ $index }})" class="cursor-pointer mt-10 text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                                            X
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Persyaratan Kemampuan --}}
                    <div class=" flex justify-between items-end" data-animation="slide-up">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-lightbulb text-xl mb-2 text-primary"></i>
                            <x-input-label for="persyaratan" :value="__('Persyaratan Kemampuan')" />
                        </div>
                        <div class="flex items-center justify-center gap-4 " data-animation="slide-up">
                            <button type="button" onclick="tambahPersyaratan()" class="cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6 items-center flex justify-center">
                                +
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl  mt-6 space-y-10" data-animation="slide-up">
                        <div id="persyaratan-container" class="space-y-4">
                            @foreach($proyek->persyaratan_kemampuan as $index => $persyaratan)
                            <div id="persyaratan-{{ $index }}" class="flex justify-between space-x-8">
                                <div class="flex-1 " data-animation="slide-up">
                                    <x-text-input type="text" value="{{ old('persyaratan.'.$index.'.nama', $persyaratan['nama']) }}" name="persyaratan[{{ $index }}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Persyaratan Kemampuan-{{ $index + 1 }}" />
                                </div>
                                <div class="" data-animation="slide-up">    
                                    <button type="button" onclick="hapusPersyaratan({{ $index }})" class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                                        X
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>           
                    </div>

                    {{-- Role --}}
                    <div class=" flex justify-between items-end" data-animation="slide-up">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-tag text-xl mb-2 text-primary"></i>
                            <x-input-label for="role" :value="__('Role yang dibutuhkan')" />
                        </div>
                        <div class="flex items-center justify-center gap-4 " data-animation="slide-up">
                            <button type="button" onclick="tambahrole()" class="cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6 items-center flex justify-center">
                                + 
                            </button>
                        </div>
                    </div>
                    <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl  mt-6 space-y-10" data-animation="slide-up">
                        <div id="role-container" class="space-y-4">
                            @foreach($proyek->role as $index => $role)
                            <div id="role-{{ $index }}" class="flex justify-between space-x-8">
                                <div class="flex-1 " data-animation="slide-up">
                                    <x-text-input type="text" value="{{ old('role.'.$index.'.nama', $role['nama']) }}" name="role[{{ $index }}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Role-{{ $index + 1 }}" />
                                </div>
                                <div class="" data-animation="slide-up">    
                                    <button type="button" onclick="hapusrole({{ $index }})" class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                                        X
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sampul --}}
                    <div id="sampul-container" class="mb-16 space-y-4 flex flex-col">
                        <div id="sampul-field" class="" data-animation="slide-up">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-image text-xl mb-2 text-primary"></i>
                                <x-input-label for="sampul" :value="__('Unggah Sampul Proyek')" />
                            </div>
                            <input 
                                id="sampul" 
                                type="file" 
                                name="sampul" 
                                accept=".png, .jpg, .jpeg" 
                                onchange="previewImage(this)" 
                                class="hidden"
                            >
                        </div>
                            
                        <div class="p-4 sm:py-12 sm:px-10 w-full bg-muda border border-secondary shadow sm:rounded-3xl  mt-6 space-y-10" data-animation="slide-up">
                            <div class="flex justify-center">
                                <label for="sampul" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-4 w-48 items-center flex justify-center">
                                    <img src="{{ asset('img/upload.png') }}" class="w-10 h-10" alt="">
                                </label>
                            </div>
                            <div id="preview-container" class="mt-4 {{ $proyek->sampul ? '' : 'hidden' }}">
                                <img 
                                    id="preview-image" 
                                    class="w-full h-auto object-cover rounded-lg shadow-md" 
                                    src="{{ $proyek->sampul ? Storage::url($proyek->sampul) : '' }}" 
                                    alt="Preview Sampul">
                            </div>
                        </div>
                    </div>
                                
                    <div class="flex items-center justify-center gap-4 " data-animation="slide-up">
                        <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let kegiatanCount = {{ count($proyek->kegiatan) - 1 }};
        let persyaratanCount = {{ count($proyek->persyaratan_kemampuan) - 1 }};
        let roleCount = {{ count($proyek->role) - 1 }};

        function tambahKegiatan() {
            kegiatanCount++;
            const kegiatanDiv = document.createElement('div');
            kegiatanDiv.setAttribute('id', 'kegiatan-' + kegiatanCount);
            
            kegiatanDiv.innerHTML = `
                <div class="flex justify-between space-x-8">
                    <div class="flex-1 " data-animation="slide-up">
                        <x-input-label for="kegiatan[${kegiatanCount}][kegiatan]" :value="__('Kegiatan-${kegiatanCount + 1}')" />
                        <x-text-input type="text" name="kegiatan[${kegiatanCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Nama Kegiatan" />
                    </div>
                    <div class="flex justify-between space-x-8">
                        <div class="" data-animation="slide-up">
                            <x-input-label for="kegiatan[${kegiatanCount}][tanggal_mulai]" :value="__('Mulai')" />
                            <x-text-input type="date" name="kegiatan[${kegiatanCount}][tanggal_mulai]" class="kegiatan-tanggal mt-1 block w-full" />
                        </div>
                        <div class="" data-animation="slide-up">
                            <x-input-label for="kegiatan[${kegiatanCount}][tanggal_selesai]" :value="__('Selesai')" />
                            <x-text-input type="date" name="kegiatan[${kegiatanCount}][tanggal_selesai]" class="kegiatan-tanggal mt-1 block w-full" />
                        </div>
                        <div class="" data-animation="slide-up">    
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
        }

        function tambahPersyaratan() {
            persyaratanCount++;
            const container = document.getElementById('persyaratan-container');
            
            const persyaratanDiv = document.createElement('div');
            persyaratanDiv.classList.add('flex', 'justify-between', 'space-x-8');
            persyaratanDiv.id = `persyaratan-${persyaratanCount}`;

            persyaratanDiv.innerHTML = `
                <div class="flex-1 " data-animation="slide-up">
                    <x-text-input type="text" name="persyaratan[${persyaratanCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Persyaratan Kemampuan-${persyaratanCount + 1}" />
                </div>
                <div class="" data-animation="slide-up">    
                    <button type="button" onclick="hapusPersyaratan(${persyaratanCount})" class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                        X
                    </button>
                </div>
            `;
            
            container.appendChild(persyaratanDiv);
        }

        function hapusPersyaratan(id) {
            const persyaratanDiv = document.getElementById(`persyaratan-${id}`);
            if (persyaratanDiv) {
                persyaratanDiv.remove();
            }
        }

        function tambahrole() {
            roleCount++;
            const container = document.getElementById('role-container');
            
            const roleDiv = document.createElement('div');
            roleDiv.classList.add('flex', 'justify-between', 'space-x-8');
            roleDiv.id = `role-${roleCount}`;

            roleDiv.innerHTML = `
                <div class="flex-1 " data-animation="slide-up">
                    <x-text-input type="text" name="role[${roleCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Role-${roleCount + 1}" />
                </div>
                <div class="" data-animation="slide-up">    
                    <button type="button" onclick="hapusrole(${roleCount})" class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6 items-center flex justify-center">
                        X
                    </button>
                </div>
            `;
            
            container.appendChild(roleDiv);
        }

        function hapusrole(id) {
            const roleDiv = document.getElementById(`role-${id}`);
            if (roleDiv) {
                roleDiv.remove();
            }
        }

        function previewImage(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('preview-image');
                    const previewContainer = document.getElementById('preview-container');
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

</x-dosen-app-layout>
