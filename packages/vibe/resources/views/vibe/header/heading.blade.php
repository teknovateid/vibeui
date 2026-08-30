@blaze(fold: true)

@php
    $classes = 'text-lg font-semibold tracking-tight text-foreground';
@endphp

<h2 {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</h2>
