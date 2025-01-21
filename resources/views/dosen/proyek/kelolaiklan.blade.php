<x-dosen-app-layout :title="'Proyek Saya'" :footer="$footer">
    <x-popupiklan></x-popupiklan>
    <div class="flex">
        <!-- Sidebar -->
        <x-sidebardosen />

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h3 class="text-3xl font-bold mb-6 text-primary">Iklan Saya</h3>
            <div class="bg-white border-gray-300 text-primary p-8 rounded-md shadow-md">
                <!-- Tabel -->
                <table class="table-auto w-full border-collapse border border-gray-300">
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
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                                <td class="border border-gray-300 px-4 py-4">
                                    <div class="w-full">
                                        <img src="{{ Storage::url($iklan->gambar) }}" alt="Gambar Iklan" class="w-full h-auto object-cover mr-4 rounded">
                                    </div>
                                </td>                                
                                <td class="border border-gray-300 px-4 py-2 justify-center text-center">
                                    <button 
                                    class="bg-blue-500 text-white w-20 py-1 rounded-md hover:bg-blue-600 editButton"
                                    data-id="{{ $iklan->id }}"
                                    data-gambar="{{ Storage::url($iklan->gambar) }}">
                                        Edit
                                    </button>
                                    <button class="bg-red-500 text-white w-20 py-1 rounded-md hover:bg-red-600 ml-2" onclick="openDeleteModal()">Hapus</button>

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

                <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center flex z-50">
                    <div class="bg-white p-6 rounded-md w-1/3">
                        <h3 class="text-xl font-semibold mb-4">Konfirmasi Penghapusan</h3>
                        <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menghapus iklan ini?</p>
                        <div class="flex justify-end space-x-4">
                            <button class="bg-gray-500 text-white py-2 px-4 rounded-md" onclick="closeDeleteModal()">Batal</button>
                            <form action="{{ route('dosen.iklan.delete', ['id' => $iklan->id]) }}" method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                

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
                            <label for="gambarUpload" class="block text-primary font-semibold text-2xl mb-2">Ganti Iklan</label>
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
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md">
                                    Simpan
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

    // Buka Modal Konfirmasi Hapus
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    // Tutup Modal Konfirmasi Hapus
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Buka Modal Sukses Hapus setelah form di-submit
    document.getElementById('deleteForm').addEventListener('submit', function(event) {
        event.preventDefault();
        this.submit();  // Submit form ke server
        closeDeleteModal();  // Tutup modal konfirmasi
        setTimeout(function() {
            document.getElementById('successModal').classList.remove('hidden');  // Tampilkan modal sukses
        }, 500);  // Tunggu sebentar agar proses penghapusan selesai
    });

    // Tutup Modal Sukses Hapus
    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
        location.reload();  // Reload halaman untuk memperbarui daftar iklan
    }
</script>


</x-dosen-app-layout>
