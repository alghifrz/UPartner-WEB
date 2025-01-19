@props(['proyek', 'user'])
<div id="projectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-500 z-50">
    <div id="modalContent" class="bg-white p-8 rounded-lg w-3/4 md:w-1/2 transform -translate-y-full opacity-0 transition-all duration-500 ease-out relative shadow-2xl z-50">
        <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-4xl font-semibold">&times;</button>
        <h2 class="text-3xl font-bold mb-6 text-center text-primary">Daftar Proyek</h2>
        @if($user->nim)
            <form action="{{ route('pendaftaran', ['proyek' => $proyek->id]) }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="id_proyek" value="{{ $proyek->id }}">
                <div>
                    <label class="block text-xl font-semibold text-gray-700">Kemampuan yang Dimiliki:</label>
                    <div class="mt-3 space-y-4">
                        @foreach($proyek->persyaratan_kemampuan as $item)
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="persyaratan_kemampuan[]" value="{{ $item['nama'] }}" id="kemampuan_{{ $loop->index }}"
                                    class="h-6 w-6 text-primary focus:ring-2 focus:ring-primary transition-all duration-200">
                                <label for="kemampuan_{{ $loop->index }}" class="text-lg text-gray-700">{{ htmlspecialchars($item['nama']) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block text-xl font-semibold text-gray-700">Pilih Role:</label>
                    <div class="mt-3 space-y-4">
                        @foreach($proyek->role as $role)
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="role" value="{{ $role['nama'] }}" id="role_{{ $loop->index }}"
                                    class="h-6 w-6 text-primary focus:ring-2 focus:ring-primary transition-all duration-200">
                                <label for="role_{{ $loop->index }}" class="text-lg text-gray-700">{{ htmlspecialchars($role['nama']) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label for="alasan_mendaftar" class="block text-xl font-semibold text-gray-700">Alasan Mendaftar:</label>
                    <textarea name="alasan_mendaftar" required
                            class="mt-2 p-4 w-full border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                            rows="4" placeholder="Tulis alasan Anda mendaftar proyek ini..."></textarea>
                    @error('alasan_mendaftar')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="text-2xl font-semibold py-3 px-12 mt-4 bg-secondary hover:bg-primary text-white rounded-full shadow-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300">
                        Daftar
                    </button>
                </div>
            </form>
        @else
            <form action="{{ route('dosen.pendaftaran', ['proyek' => $proyek->id]) }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="id_proyek" value="{{ $proyek->id }}">
                <div>
                    <label class="block text-xl font-semibold text-gray-700">Kemampuan yang Dimiliki:</label>
                    <div class="mt-3 space-y-4">
                        @foreach($proyek->persyaratan_kemampuan as $item)
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" name="persyaratan_kemampuan[]" value="{{ $item['nama'] }}" id="kemampuan_{{ $loop->index }}"
                                    class="h-6 w-6 text-primary focus:ring-2 focus:ring-primary transition-all duration-200">
                                <label for="kemampuan_{{ $loop->index }}" class="text-lg text-gray-700">{{ htmlspecialchars($item['nama']) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block text-xl font-semibold text-gray-700">Pilih Role:</label>
                    <div class="mt-3 space-y-4">
                        @foreach($proyek->role as $role)
                            <div class="flex items-center space-x-3">
                                <input type="radio" name="role" value="{{ $role['nama'] }}" id="role_{{ $loop->index }}"
                                    class="h-6 w-6 text-primary focus:ring-2 focus:ring-primary transition-all duration-200">
                                <label for="role_{{ $loop->index }}" class="text-lg text-gray-700">{{ htmlspecialchars($role['nama']) }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label for="alasan_mendaftar" class="block text-xl font-semibold text-gray-700">Alasan Mendaftar:</label>
                    <textarea name="alasan_mendaftar" required
                            class="mt-2 p-4 w-full border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                            rows="4" placeholder="Tulis alasan Anda mendaftar proyek ini..."></textarea>
                    @error('alasan_mendaftar')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="text-2xl font-semibold py-3 px-12 mt-4 bg-secondary hover:bg-primary text-white rounded-full shadow-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-all duration-300">
                        Daftar
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>


<script>
// Ambil elemen modal dan tombol
const modal = document.getElementById("projectModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const modalContent = document.getElementById("modalContent");

// Ketika tombol "Daftar Proyek" diklik, tampilkan modal dengan transisi
openModalBtn.addEventListener("click", () => {
    modal.classList.remove("hidden"); // Menampilkan modal (hilangkan kelas hidden)
    setTimeout(() => {
        modal.classList.add("opacity-100"); // Modal latar belakang muncul (opacity 0 -> 1)
        modal.classList.remove("opacity-0"); // Menghapus kelas opacity-0
        modalContent.classList.add("opacity-100", "translate-y-0"); // Modal konten muncul dari atas
        modalContent.classList.remove("-translate-y-full", "opacity-0");
    }, 50); // Delay sedikit untuk memulai transisi
});

// Ketika tombol "X" diklik, sembunyikan modal dengan transisi
closeModalBtn.addEventListener("click", () => {
    modalContent.classList.add("-translate-y-full", "opacity-0"); // Modal konten bergerak ke atas dan hilang
    modalContent.classList.remove("translate-y-0", "opacity-100");
    modal.classList.add("opacity-0"); // Modal latar belakang menghilang (opacity 1 -> 0)
    modal.classList.remove("opacity-100");
    setTimeout(() => {
        modal.classList.add("hidden"); // Modal sepenuhnya disembunyikan setelah animasi selesai
    }, 500); // Delay sesuai durasi transisi
});

// Optional: Menutup modal jika klik di luar modal
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modalContent.classList.add("-translate-y-full", "opacity-0"); // Modal konten bergerak ke atas dan hilang
        modalContent.classList.remove("translate-y-0", "opacity-100");
        modal.classList.add("opacity-0"); // Modal latar belakang menghilang (opacity 1 -> 0)
        modal.classList.remove("opacity-100");
        setTimeout(() => {
            modal.classList.add("hidden"); // Modal sepenuhnya disembunyikan setelah animasi selesai
        }, 500); // Delay sesuai durasi transisi
    }
});

</script>