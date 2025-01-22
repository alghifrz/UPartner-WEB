<x-dosen-app-layout :title="'Edit Proyek'" :footer="$footer">
    <x-popupproyek></x-popupproyek>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            {{ __('Edit Proyek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-[1500px] mx-auto sm:px-6 md:px-6 lg:px-8 space-y-10">
            <form method="POST" action="{{ route('dosen.proyek.update', $project->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Main --}}
                <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate" data-animation="slide-up">
                    <!-- Judul Proyek -->
                    <div class="data-animate mb-8" data-animation="slide-up">
                        <x-input-label for="judul_proyek" :value="__('Judul Proyek')" />
                        <x-text-input id="judul_proyek" name="judul_proyek" type="text" class="mt-1 block w-full" 
                            value="{{ old('judul_proyek', $project->judul_proyek) }}" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('judul_proyek')" />
                    </div>

                    <!-- Deskripsi Proyek -->
                    <div class="data-animate mb-8" data-animation="slide-up">
                        <x-input-label for="deskripsi_proyek" :value="__('Deskripsi Proyek')" />
                        <textarea id="deskripsi_proyek" name="deskripsi_proyek" 
                            class="block w-full h-48 bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none">{{ old('deskripsi_proyek', $project->deskripsi_proyek) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('deskripsi_proyek')" />
                    </div>

                    <div class="flex justify-between space-x-8">
                        <!-- Tanggal Mulai -->
                        <div class="data-animate flex-1" data-animation="slide-up">
                            <x-input-label for="tanggal_mulai" :value="__('Tanggal Mulai')" />
                            <x-text-input id="tanggal_mulai" name="tanggal_mulai" type="date" 
                                value="{{ old('tanggal_mulai', $project->tanggal_mulai) }}" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_mulai')" />
                        </div>
                        <!-- Tanggal Selesai -->
                        <div class="data-animate flex-1" data-animation="slide-up">
                            <x-input-label for="tanggal_selesai" :value="__('Tanggal Selesai')" />
                            <x-text-input id="tanggal_selesai" name="tanggal_selesai" type="date" 
                                value="{{ old('tanggal_selesai', $project->tanggal_selesai) }}" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_selesai')" />
                        </div>
                    </div>
                </div>

                {{-- Kegiatan --}}
                <div class="data-animate flex justify-between items-end" data-animation="slide-up">
                    <x-input-label for="kegiatan" :value="__('Agenda Kegiatan')" />
                    <button type="button" onclick="tambahKegiatan()" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6">
                        +
                    </button>
                </div>
                <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                    <div id="kegiatan-container" class="space-y-4">
                        @foreach($project->kegiatan as $index => $kegiatan)
                            <div id="kegiatan-{{ $index }}" class="flex justify-between space-x-8">
                                <div class="flex-1 data-animate" data-animation="slide-up">
                                    <x-input-label for="kegiatan[{{ $index }}][kegiatan]" :value="__('Kegiatan-' . ($index + 1))" />
                                    <x-text-input type="text" name="kegiatan[{{ $index }}][nama]" 
                                        value="{{ old('kegiatan.' . $index . '.nama', $kegiatan->nama) }}" 
                                        class="kegiatan-nama mt-1 block w-full" placeholder="Nama Kegiatan" />
                                </div>
                                <div class="flex justify-between space-x-8">
                                    <div class="data-animate" data-animation="slide-up">
                                        <x-input-label for="kegiatan[{{ $index }}][tanggal_mulai]" :value="__('Mulai')" />
                                        <x-text-input type="date" name="kegiatan[{{ $index }}][tanggal_mulai]" 
                                            value="{{ old('kegiatan.' . $index . '.tanggal_mulai', $kegiatan->tanggal_mulai) }}" 
                                            class="kegiatan-tanggal mt-1 block w-full" />
                                    </div>
                                    <div class="data-animate" data-animation="slide-up">
                                        <x-input-label for="kegiatan[{{ $index }}][tanggal_selesai]" :value="__('Selesai')" />
                                        <x-text-input type="date" name="kegiatan[{{ $index }}][tanggal_selesai]" 
                                            value="{{ old('kegiatan.' . $index . '.tanggal_selesai', $kegiatan->tanggal_selesai) }}" 
                                            class="kegiatan-tanggal mt-1 block w-full" />
                                    </div>
                                    <div class="data-animate" data-animation="slide-up">    
                                        <button type="button" onclick="hapusKegiatan({{ $index }})" 
                                            class="cursor-pointer mt-10 text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6">
                                            X
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Persyaratan Kemampuan --}}
                <div class="data-animate flex justify-between items-end" data-animation="slide-up">
                    <x-input-label for="persyaratan" :value="__('Persyaratan Kemampuan')" />
                    <button type="button" onclick="tambahPersyaratan()" 
                        class="cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6">
                        +
                    </button>
                </div>
                <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                    <div id="persyaratan-container" class="space-y-4">
                        @foreach($project->persyaratan as $index => $persyaratan)
                            <div id="persyaratan-{{ $index }}" class="flex justify-between space-x-8">
                                <div class="flex-1 data-animate" data-animation="slide-up">
                                    <x-text-input type="text" name="persyaratan[{{ $index }}][nama]" 
                                        value="{{ old('persyaratan.' . $index . '.nama', $persyaratan->nama) }}" 
                                        class="kegiatan-nama mt-1 block w-full" placeholder="Persyaratan Kemampuan-{{ $index + 1 }}" />
                                </div>
                                <div class="data-animate" data-animation="slide-up">    
                                    <button type="button" onclick="hapusPersyaratan({{ $index }})" 
                                        class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6">
                                        X
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Role --}}
                <div class="data-animate flex justify-between items-end" data-animation="slide-up">
                    <x-input-label for="role" :value="__('Role yang dibutuhkan')" />
                    <button type="button" onclick="tambahrole()" 
                        class="cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-2 px-6">
                        +
                    </button>
                </div>
                <div class="p-4 sm:py-12 sm:px-10 mb-16 bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                    <div id="role-container" class="space-y-4">
                        @foreach($project->role as $index => $role)
                            <div id="role-{{ $index }}" class="flex justify-between space-x-8">
                                <div class="flex-1 data-animate" data-animation="slide-up">
                                    <x-text-input type="text" name="role[{{ $index }}][nama]" 
                                        value="{{ old('role.' . $index . '.nama', $role->nama) }}" 
                                        class="kegiatan-nama mt-1 block w-full" placeholder="Role-{{ $index + 1 }}" />
                                </div>
                                <div class="data-animate" data-animation="slide-up">    
                                    <button type="button" onclick="hapusrole({{ $index }})" 
                                        class="cursor-pointer text-white text-xl rounded-full bg-red-600 hover:bg-red-700 font-medium p-4 px-6">
                                        X
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Sampul --}}
                <div id="sampul-container" class="mb-16 space-y-4 flex flex-col">
                    <div id="sampul-field" class="data-animate" data-animation="slide-up">
                        <x-input-label for="sampul" :value="__('Unggah Sampul Proyek')" />
                        <input id="sampul" type="file" name="sampul" accept=".png, .jpg, .jpeg" 
                            onchange="previewImage(this)" class="hidden">
                    </div>
                    
                    <div class="p-4 sm:py-12 sm:px-10 w-full bg-muda border border-secondary shadow sm:rounded-3xl data-animate mt-6 space-y-10" data-animation="slide-up">
                        <div class="flex justify-center">
                            <label for="sampul" class="cursor-pointer text-white text-xl rounded-full bg-secondary hover:bg-primary font-medium py-4 w-48 items-center flex justify-center">
                                <img src="{{ asset('img/upload.png') }}" class="w-10 h-10" alt="">
                            </label>
                        </div>
                        <div id="preview-container" class="mt-4 {{ $project->sampul ? '' : 'hidden' }}">
                            <img id="preview-image" class="w-full h-auto object-cover rounded-lg shadow-md" 
                                src="{{ $project->sampul ? asset('storage/' . $project->sampul) : '' }}" 
                                alt="Preview Sampul">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-4 data-animate" data-animation="slide-up">
                    <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Initialize counters based on existing data
        let kegiatanCount = {{ count($project->kegiatan) }};
        let persyaratanCount = {{ count($project->persyaratan) }};
        let roleCount = {{ count($project->role) }};

        function tambahKegiatan() {
            kegiatanCount++;
            
            const kegiatanDiv = document.createElement('div');
            kegiatanDiv.setAttribute('id', 'kegiatan-' + kegiatanCount);
            
            kegiatanDiv.innerHTML = `
                <div class="flex justify-between space-x-8">
                    <div class="flex-1 data-animate" data-animation="slide-up">
                        <x-input-label for="kegiatan[${kegiatanCount}][kegiatan]" :value="__('Kegiatan-${kegiatanCount}')" />
                        <x-text-input type="text" name="kegiatan[${kegiatanCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Nama Kegiatan" />
                    </div>
                    <div class="flex justify-between space-x-8">
                        <div class="data-animate" data-animation="slide-up">
                            <x-input-label for="kegiatan[${kegiatanCount}][tanggal_mulai]" :value="__('Mulai')" />
                            <x-text-input type="date" name="kegiatan[${kegiatanCount}][tanggal_mulai]" class="kegiatan-tanggal mt-1 block w-full" />
                            @error('kegiatan.*.tanggal_mulai')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="data-animate" data-animation="slide-up">
                            <x-input-label for="kegiatan[${kegiatanCount}][tanggal_selesai]" :value="__('Selesai')" />
                            <x-text-input type="date" name="kegiatan[${kegiatanCount}][tanggal_selesai]" class="kegiatan-tanggal mt-1 block w-full" />
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
            if (kegiatanElement) {
                kegiatanElement.remove();
            }
        }

        function tambahPersyaratan() {
            persyaratanCount++;
            const container = document.getElementById('persyaratan-container');
            
            const persyaratanDiv = document.createElement('div');
            persyaratanDiv.classList.add('flex', 'justify-between', 'space-x-8');
            persyaratanDiv.id = `persyaratan-${persyaratanCount}`;

            persyaratanDiv.innerHTML = `
                <div class="flex-1 data-animate" data-animation="slide-up">
                    <x-text-input type="text" name="persyaratan[${persyaratanCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Persyaratan Kemampuan-${persyaratanCount}" />
                </div>
                <div class="data-animate" data-animation="slide-up">    
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
                <div class="flex-1 data-animate" data-animation="slide-up">
                    <x-text-input type="text" name="role[${roleCount}][nama]" class="kegiatan-nama mt-1 block w-full" placeholder="Role-${roleCount}" />
                </div>
                <div class="data-animate" data-animation="slide-up">    
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

        // Add event listeners when document is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Add validation for date fields if needed
            const tanggalMulaiField = document.getElementById('tanggal_mulai');
            const tanggalSelesaiField = document.getElementById('tanggal_selesai');
            
            if (tanggalMulaiField && tanggalSelesaiField) {
                tanggalMulaiField.addEventListener('change', function() {
                    tanggalSelesaiField.min = this.value;
                });

                tanggalSelesaiField.addEventListener('change', function() {
                    tanggalMulaiField.max = this.value;
                });
            }
        });
    </script>
</x-dosen-app-layout>