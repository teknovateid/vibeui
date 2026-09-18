@blaze(fold: true)

@php
    $classes = 'text-sm text-muted-foreground group-data-[variant=header]/header:text-header-foreground/70 mt-1';
@endphp

<p {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</p>
