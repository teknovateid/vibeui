@blaze(fold: true)

@php
    $classes = 'flex items-center gap-3 shrink-0';
@endphp

<div {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</div>
