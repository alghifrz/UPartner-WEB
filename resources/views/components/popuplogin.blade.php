@if (session()->has('loginError'))
                    <div class="fixed inset-0 flex items-center justify-center z-50" id="errorPopup">
                        <!-- Overlay -->
                        <div class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>
                        
                        <!-- Popup Content -->
                        <div class="relative bg-white bg-opacity-90 backdrop-blur-md rounded-[20px] shadow-xl p-8 max-w-sm w-full mx-4">
                            <div class="text-center">
                                <!-- Icon -->
                                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
                                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                
                                <!-- Text Content -->
                                <h3 class="text-2xl font-bold text-primary mb-2">Login Gagal</h3>
                                <p class="text-gray-600 mb-6">{{ session('loginError') }}</p>
                                
                                <!-- Close Button -->
                                <button type="button" 
                                    onclick="document.getElementById('errorPopup').style.display='none'" 
                                    class="w-full h-12 bg-primary rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-secondary transition-colors">
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