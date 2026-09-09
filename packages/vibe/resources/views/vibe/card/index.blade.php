@blaze(fold: true)

@props([
    'variant' => 'default',
])

@php
    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border border-border shadow-none',
        'ghost' => 'bg-transparent border-transparent shadow-none',
        'flat', 'muted' => 'bg-muted/50 border-transparent shadow-none',
        'elevated' => 'bg-card border border-border/80 shadow-md',
        'container' => 'bg-container text-container-foreground border border-container-border shadow-xs',
        default => 'bg-card border border-border shadow-2xs',
    };

    $classes = "text-card-foreground rounded-xl p-4 {$variantClasses}";
@endphp

<div {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</div>