<x-dosen-app-layout :title="'Proyek Saya'" :footer="$footer">
    <x-popupiklan></x-popupiklan>
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebardosen />

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex space-x-4 mb-2">
                <i class="fas fa-ad text-3xl text-center text-tertiary"></i>
                <h3 class="text-3xl font-bold mb-6 text-primary">Kelola Iklan</h3>
            </div>
            <div class="bg-white border-gray-300 text-primary p-8 rounded-md shadow-md">
                <!-- Tabel -->
                <table class="table-auto w-full border-collapse border items-center justify-center text-center border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 text-center items-center">
                            <th class="border border-gray-300 px-4 py-2 w-12">No</th>
                            <th class="border border-gray-300 px-4 py-2">Iklan</th>
                            <th class="border border-gray-300 px-4 py-2 w-60">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Data -->
                        @forelse($user->iklanDikelola as $index => $iklan)
                            <tr class="items-center justify-center text-center">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-4">
                                    <div class="w-full">
                                        <img src="{{ Storage::url($iklan->gambar) }}" alt="Gambar Iklan" class="w-full h-auto object-cover mr-4 rounded">
                                    </div>
                                </td>                                
                                <td class="border border-gray-300 px-4 py-2 text-center space-y-4">
                                    <button 
                                    class="bg-secondary text-whitetext-md text-center items-center text-white py-4 w-40 rounded-2xl font-semibold hover:bg-primary editButton"
                                    data-id="{{ $iklan->id }}"
                                    data-gambar="{{ Storage::url($iklan->gambar) }}">
                                    <i class="fas fa-edit mr-1"></i>Edit Iklan
                                    </button>
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-md text-center items-center text-white py-4 w-40 rounded-2xl font-semibold" onclick="openModalHapus()"><i class="fas fa-trash mr-1"></i>Hapus Iklan</button>
                                    <!-- Modal Hapus -->
                                    <div id="hapusModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden opacity-0 transition-opacity duration-300">
                                        <div id="hapusModalContent" class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative transform scale-95 transition-transform duration-300">
                                            <!-- Ikon di bagian atas -->
                                            <div class="flex justify-center mb-4">
                                                <i class="fas fa-exclamation-circle text-red-500 text-4xl"></i>
                                            </div>
                                            <!-- Judul dan Pertanyaan -->
                                            <h3 class="text-lg font-medium mb-4 text-center">Apakah Anda yakin ingin menghapus Iklan ini?</h3>
                                            <!-- Tombol Aksi -->
                                            <div class="flex justify-center space-x-2">
                                                <!-- Tombol Tidak -->
                                                <button type="button" class="bg-red-500 hover:bg-red-600 text-white w-20 py-2 rounded-lg flex items-center justify-center space-x-1" onclick="closeModalHapus()">
                                                    <i class="fas fa-times"></i>
                                                    <span>Tidak</span>
                                                </button>
                                                <!-- Tombol Ya -->
                                                <form action="{{ route('dosen.iklan.delete', ['id' => $iklan->id]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white w-20 py-2 rounded-lg flex items-center justify-center space-x-1">
                                                        <i class="fas fa-check"></i>
                                                        <span>Ya</span>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- Close Icon -->
                                            <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" onclick="closeModalHapus()">
                                                <i class="fas fa-times-circle text-2xl"></i>
                                            </button>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                    Tidak ada iklan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Modal Edit -->
                <div id="editModalContainer" 
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    
                    <!-- Kontainer Modal (hanya modal yang dianimasikan) -->
                    <div id="editModal" 
                        class="bg-white w-160 text-center rounded-lg shadow-lg p-6 relative"
                        style="opacity: 0; transform: translateY(-50px); transition: all 0.3s ease-in-out;">
                        
                        <!-- Close Button -->
                        <button id="closeModal" class="absolute top-4 right-6 text-2xl text-gray-400 hover:text-gray-600">
                            &times;
                        </button>

                        <!-- Form Update -->
                        <form method="post" action="{{ route('dosen.iklan.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <!-- Hidden Field for Iklan ID -->
                            <input type="hidden" id="modalIklanId" name="id">
                        
                            <!-- Input File -->
                            <label for="gambarUpload" class="block text-primary font-semibold text-2xl mb-2">Edit Iklan</label>
                            <input type="file" id="gambarUpload" name="gambar" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(this)">
                        
                            <!-- Preview Gambar -->
                            <div id="previewContainer" class="mt-4 hidden">
                                <img id="previewImage" class="w-full h-80 object-cover" src="" alt="Preview Iklan">
                            </div>
                        
                            <div class="flex mt-6 justify-center space-x-6">
                                <label for="gambarUpload" class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-center flex items-center justify-center">
                                    <i class="fas fa-upload mr-2"></i> Upload
                                </label>
                        
                                <!-- Tombol Simpan -->
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white w-20 py-2 rounded-lg flex items-center justify-center space-x-1">
                                    <i class="fas fa-check"></i>
                                    <span>Ya</span>
                                </button>
                            </div>
                        </form>
                        
                        <script>
                            function previewImage(input) {
                                const file = input.files[0]; // Mendapatkan file yang dipilih
                                if (file) {
                                    const reader = new FileReader();
                                    
                                    // Ketika file selesai dibaca
                                    reader.onload = function(e) {
                                        const previewImage = document.getElementById('previewImage');
                                        const previewContainer = document.getElementById('previewContainer');
                                        
                                        // Set src gambar preview dengan gambar yang dipilih
                                        previewImage.src = e.target.result;
                                        
                                        // Menampilkan preview
                                        previewContainer.classList.remove('hidden');
                                    };
                                    
                                    // Membaca file sebagai URL
                                    reader.readAsDataURL(file);
                                }
                            }
                        </script>
                        
                    </div>
                </div>






            </div>
        </div>

    </div>

    <style>
        #editModal {
            transition: opacity 0.3s ease, transform 0.3s ease; /* Durasi dan efek animasi */
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.editButton'); // Tombol Edit
        const modalContainer = document.getElementById('editModalContainer');
        const modal = document.getElementById('editModal');
        const closeModal = document.getElementById('closeModal');
        const modalIklanId = document.getElementById('modalIklanId');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const gambarUpload = document.getElementById('gambarUpload'); // Input file untuk upload gambar

        // Buka Modal
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const iklanId = this.getAttribute('data-id'); // Ambil ID dari tombol
                const gambarUrl = this.getAttribute('data-gambar'); // Ambil URL gambar

                modalIklanId.value = iklanId; // Set ID ke hidden field
                previewImage.src = gambarUrl; // Set preview gambar awal
                previewContainer.classList.remove('hidden'); // Tampilkan preview

                modalContainer.classList.remove('hidden'); // Tampilkan container background
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modal.style.transform = 'translateY(0)';
                }, 10);
            });
        });

        // Tutup Modal
        closeModal.addEventListener('click', function () {
            modal.style.opacity = '0';
            modal.style.transform = 'translateY(-50px)';
            setTimeout(() => {
                modalContainer.classList.add('hidden');
            }, 300); // Sesuaikan durasi dengan CSS transition
        });

        // Preview Gambar Baru
        gambarUpload.addEventListener('change', function (event) {
            const file = event.target.files[0]; // Ambil file yang dipilih
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result; // Update gambar preview
                    previewContainer.classList.remove('hidden'); // Tampilkan preview
                };
                reader.readAsDataURL(file); // Membaca file sebagai data URL
            }
        });
    });

    function openModalHapus() {
        const modal = document.getElementById('hapusModal');
        const content = document.getElementById('hapusModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
        }, 10); // Delay untuk memastikan transisi berjalan
    }
    function closeModalHapus() {
        const modal = document.getElementById('hapusModal');
        const content = document.getElementById('hapusModalContent');
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Durasi sesuai dengan transition-opacity/transform
    }
</script>


</x-dosen-app-layout>
