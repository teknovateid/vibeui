@blaze(fold: true)

@props([
    'size' => 'md', // sm, md, lg
])

@php
    $sizeClass = match ($size) {
        'sm' => 'size-3.5',
        'lg' => 'size-5',
        default => 'size-4',
    };
@endphp

<div 
    {{ $attributes->twMerge(['class' => 'flex items-center justify-center cursor-grab active:cursor-grabbing text-muted-foreground/40 hover:text-muted-foreground transition-colors p-0.5 rounded touch-none']) }}
    aria-label="Drag to reorder"
    title="Drag to reorder"
>
    <svg class="{{ $sizeClass }} pointer-events-none select-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="9" cy="5" r="1" fill="currentColor"/>
        <circle cx="9" cy="12" r="1" fill="currentColor"/>
        <circle cx="9" cy="19" r="1" fill="currentColor"/>
        <circle cx="15" cy="5" r="1" fill="currentColor"/>
        <circle cx="15" cy="12" r="1" fill="currentColor"/>
        <circle cx="15" cy="19" r="1" fill="currentColor"/>
    </svg>
</div>
