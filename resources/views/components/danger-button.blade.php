<button {{ $attributes->merge(['type' => 'submit', 'class' => 'cursor-pointer text-white text-xl mb-3 rounded-full bg-red-600 hover:bg-red-700 font-medium py-4 w-48 items-center flex justify-center']) }}>
    {{ $slot }}
</button>
