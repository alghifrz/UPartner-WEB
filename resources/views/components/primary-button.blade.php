<button {{ $attributes->merge(['type' => 'submit', 'class' => 'cursor-pointer text-white text-xl mb-3 rounded-full bg-secondary hover:bg-primary font-medium py-4 w-48 items-center flex justify-center']) }}>
    {{ $slot }}
</button>
