@blaze(fold: true)

@props([
    'variant' => 'default',
    'padding' => null,
])

@php
    $variantClasses = match ($variant) {
        'outline' => 'bg-transparent border border-border shadow-none',
        'ghost' => 'bg-transparent border-transparent shadow-none',
        'flat', 'muted' => 'bg-muted/50 border-transparent shadow-none',
        'elevated' => 'bg-card border border-border/80 shadow-md',
        default => 'bg-card border border-border shadow-2xs',
    };

    $paddingClasses = match ($padding) {
        'none', '0' => 'p-0',
        'sm' => 'p-4',
        'lg' => 'p-8',
        'xl' => 'p-10',
        default => ($padding ? (is_numeric($padding) ? "p-{$padding}" : $padding) : 'p-6'),
    };

    $classes = "text-card-foreground rounded-xl {$variantClasses} {$paddingClasses}";
@endphp

<div {{ $attributes->twMerge(['class' => $classes]) }}>
    {{ $slot }}
</div>