@blaze(fold: true)

@props([
    'text' => null,
    'orientation' => 'horizontal', // horizontal, vertical
])

@php
    $hasText = !empty($text) || ($slot->isNotEmpty() && trim($slot) !== '');
@endphp

@if ($orientation === 'vertical')
    <div 
        role="separator" 
        aria-orientation="vertical" 
        {{ $attributes->twMerge(['class' => 'inline-block self-stretch w-px bg-border my-1 shrink-0']) }}
    ></div>
@else
    @if ($hasText)
        <div 
            role="separator" 
            aria-orientation="horizontal" 
            {{ $attributes->twMerge(['class' => 'relative flex items-center w-full my-4 text-xs select-none']) }}
        >
            <div class="grow border-t border-border" aria-hidden="true"></div>
            <span class="shrink-0 px-3 text-muted-foreground font-medium uppercase tracking-wider text-[11px]">
                {{ $text ?? $slot }}
            </span>
            <div class="grow border-t border-border" aria-hidden="true"></div>
        </div>
    @else
        <div 
            role="separator" 
            aria-orientation="horizontal" 
            {{ $attributes->twMerge(['class' => 'w-full border-t border-border my-4 shrink-0']) }}
        ></div>
    @endif
@endif
