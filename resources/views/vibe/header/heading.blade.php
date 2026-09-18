@blaze(fold: true)

@php
    $classes = 'text-lg font-semibold tracking-tight text-inherit group-data-[variant=header]/header:text-header-foreground';
@endphp

<h2 {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</h2>
