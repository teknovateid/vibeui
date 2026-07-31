@blaze(fold: true)

@php
    $classes = 'text-lg font-semibold tracking-tight text-vibe-900 dark:text-white';
@endphp

<h2 {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</h2>
