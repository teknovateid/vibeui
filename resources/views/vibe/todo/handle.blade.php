@blaze(fold: true)

@props([
    'size' => 'md', // sm, md, lg
    'mode' => 'hover', // hover (default), visible, hidden
    'dragHandle' => null,
    'dragIndicator' => null,
    'handle' => null,
])

@php
    $rawMode = $dragHandle ?? $dragIndicator ?? $handle ?? $mode;
    if ($rawMode === false || $rawMode === 'false' || $rawMode === 'hidden' || $rawMode === 'none' || $rawMode === 'hide') {
        $displayMode = 'hidden';
    } elseif ($rawMode === true || $rawMode === 'true' || $rawMode === 'visible' || $rawMode === 'show' || $rawMode === 'always' || $rawMode === '') {
        $displayMode = 'visible';
    } else {
        $displayMode = 'hover';
    }

    $sizeClass = match ($size) {
        'sm' => 'size-3.5',
        'lg' => 'size-5',
        default => 'size-4',
    };

    $modeClass = match ($displayMode) {
        'hidden' => 'hidden',
        'hover' => 'flex md:hidden md:group-hover:flex md:group-hover/header:flex md:group-hover/item:flex',
        default => 'flex',
    };
@endphp

@if ($displayMode !== 'hidden')
    <div 
        data-todo-handle="true"
        {{ $attributes->twMerge(['class' => "flex items-center justify-center cursor-grab active:cursor-grabbing text-muted-foreground/40 hover:text-muted-foreground transition-colors p-0.5 rounded touch-none {$modeClass}"]) }}
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
@endif
