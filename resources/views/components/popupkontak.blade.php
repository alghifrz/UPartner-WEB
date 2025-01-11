<div x-data="{ showModal: {{ session('success') ? 'true' : 'false' }} }" 
x-show="showModal" 
class="fixed inset-0 flex items-center justify-center z-50"
style="display: none;">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-30 backdrop-blur-sm"></div>

    <!-- Modal Content -->
    <div class="relative bg-white bg-opacity-90 backdrop-blur-md rounded-[20px] shadow-xl p-8 max-w-sm w-full">
        <!-- Icon Success -->
        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-green-100">
            <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <!-- Message Content -->
        <div class="mt-3 text-center sm:mt-5">
            <h3 class="text-2xl font-bold text-primary mb-2">
                Pesan Terkirim!
            </h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    {{ session('success') }}
                </p>
            </div>
        </div>
        <!-- Close Button -->
        <div class="mt-5 sm:mt-6">
            <button @click="showModal = false" type="button" class="w-full h-12 bg-primary rounded-lg shadow-md border-none cursor-pointer text-sm md:text-base text-white font-semibold hover:bg-secondary transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>