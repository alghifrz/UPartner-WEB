<button {{ $attributes->merge(['type' => 'button', 'class' => 'cursor-pointer text-xl mb-3 rounded-full font-medium py-4 w-48 items-center flex justify-center border border-gray-300 text-gray-700 hover:bg-gray-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
