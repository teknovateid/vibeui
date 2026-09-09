@blaze(fold: true)

@props([
    'sticky' => false,
])

@php
    $baseClasses = 'border-b border-border bg-muted text-muted-foreground font-medium text-xs';
    $stickyClasses = $sticky ? 'sticky top-0 bg-background/95 backdrop-blur-xs z-10 shadow-2xs' : '';
    $compiledClasses = trim("{$baseClasses} {$stickyClasses}");
@endphp

<thead {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
    <tr>
        {{ $slot }}
    </tr>
</thead>
