@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-2xl mb-2 text-primary']) }}>
    {{ $value ?? $slot }}
</label>
