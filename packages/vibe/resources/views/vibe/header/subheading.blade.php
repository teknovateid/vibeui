@blaze(fold: true)

@php
    $classes = 'text-sm text-muted-foreground mt-1';
@endphp

<p {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</p>
