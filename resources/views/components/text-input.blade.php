@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white p-4 px-8 focus:ring-secondary shadow text-xl rounded-3xl border-none']) }}>
