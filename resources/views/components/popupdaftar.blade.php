@if(session()->has('success'))
    <div class="fixed inset-0 flex items-center justify-center z-50" id="successPopup">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>
        
        <!-- Popup Content -->
        <div class="relative bg-white bg-opacity-90 backdrop-blur-md rounded-[20px] shadow-xl p-8 max-w-sm w-full mx-4">
            <div class="text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-green-100 mb-4">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <!-- Text Content -->
                <h3 class="text-2xl font-bold text-primary mb-2">Pendaftaran Proyek Berhasil!</h3>
                <p class="text-gray-600 mb-6">{{ session('success') }}</p>
                
                <!-- Close Button -->
                <button type="button" 
                    onclick="document.getElementById('successPopup').style.display='none'" 
                    class="w-full h-12 bg-primary rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-secondary transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('successPopup');
        if (popup) {
            popup.classList.add('animate-fade-in');
            
            // Close when clicking outside
            popup.addEventListener('click', function(e) {
                if (e.target === this) {
                    popup.style.display = 'none';
                }
            });
        }
    });
    </script>

    <style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    </style>
@endif

<!-- Menampilkan Pesan Error -->
@if($errors->any())
    <div class="fixed inset-0 flex items-center justify-center z-50" id="errorPopup">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>
        
        <!-- Popup Content -->
        <div class="relative bg-white bg-opacity-90 backdrop-blur-md rounded-[20px] shadow-xl p-8 max-w-sm w-full mx-4">
            <div class="text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                
                <!-- Text Content -->
                <h3 class="text-2xl font-bold text-primary mb-2">Proyek Gagal Dibuat</h3>
                <ul class="text-gray-600 mb-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                
                <!-- Close Button -->
                <button type="button" 
                    onclick="document.getElementById('errorPopup').style.display='none'" 
                    class="w-full h-12 bg-red-600 rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-red-700 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('errorPopup');
        if (popup) {
            popup.classList.add('animate-fade-in');
            
            // Close when clicking outside
            popup.addEventListener('click', function(e) {
                if (e.target === this) {
                    popup.style.display = 'none';
                }
            });
        }
    });
    </script>

    <style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    </style>
@endif
