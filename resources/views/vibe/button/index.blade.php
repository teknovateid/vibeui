@blaze(fold: true)

@props([
    'variant' => 'default', // primary, secondary, outline, ghost, surface, accent, destructive/danger, success, warning, info, link, default
    'size' => 'md',        // xs, sm, md, lg, xl, icon-xs, icon-sm, icon-md, icon-lg
    'type' => 'button',
    'href' => null,
    'pill' => false,
    'loading' => false,
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium select-none whitespace-nowrap cursor-pointer transition-all duration-150 active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:pointer-events-none disabled:opacity-50';

    $variantClasses = match ($variant) {
        'primary' => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        'secondary' => 'bg-secondary text-secondary-foreground shadow-2xs hover:bg-secondary/80',
        'outline' => 'border border-input bg-background text-foreground shadow-2xs hover:bg-accent hover:text-accent-foreground',
        'ghost' => 'text-foreground hover:bg-accent hover:text-accent-foreground active:bg-accent/80',
        'surface' => 'bg-card border border-border/80 text-card-foreground shadow-2xs hover:bg-accent/60',
        'accent' => 'bg-accent text-accent-foreground border border-accent hover:bg-accent/80 shadow-2xs focus-visible:ring-accent',
        'destructive', 'danger' => 'bg-destructive text-destructive-foreground shadow-xs hover:bg-destructive/90 focus-visible:ring-destructive',
        'success' => 'bg-emerald-600 text-white dark:bg-emerald-500 shadow-xs hover:bg-emerald-700 dark:hover:bg-emerald-600 focus-visible:ring-emerald-500',
        'warning' => 'bg-amber-500 text-white dark:bg-amber-600 shadow-xs hover:bg-amber-600 dark:hover:bg-amber-700 focus-visible:ring-amber-500',
        'info' => 'bg-sky-500 text-white dark:bg-sky-600 shadow-xs hover:bg-sky-600 dark:hover:bg-sky-700 focus-visible:ring-sky-500',
        'link' => 'text-primary underline-offset-4 hover:underline p-0 h-auto font-medium shadow-none active:scale-100',
        default => 'border border-border bg-card text-card-foreground shadow-2xs hover:bg-accent hover:text-accent-foreground',
    };

    $sizeClasses = match ($size) {
        'xs' => 'h-7 px-2.5 text-xs gap-1 ' . ($pill ? 'rounded-full' : 'rounded-sm'),
        'sm' => 'h-8 px-3 text-xs gap-1.5 ' . ($pill ? 'rounded-full' : 'rounded-md'),
        'md' => 'h-9 px-3.5 text-sm gap-2 ' . ($pill ? 'rounded-full' : 'rounded-lg'),
        'lg' => 'h-10 px-4 text-sm gap-2.5 ' . ($pill ? 'rounded-full' : 'rounded-lg'),
        'xl' => 'h-11 px-5 text-base gap-3 ' . ($pill ? 'rounded-full' : 'rounded-xl'),
        'icon-xs' => 'size-7 p-0 ' . ($pill ? 'rounded-full' : 'rounded-sm'),
        'icon-sm' => 'size-8 p-0 ' . ($pill ? 'rounded-full' : 'rounded-md'),
        'icon-md' => 'size-9 p-0 ' . ($pill ? 'rounded-full' : 'rounded-lg'),
        'icon-lg' => 'size-10 p-0 ' . ($pill ? 'rounded-full' : 'rounded-lg'),
        default => 'h-9 px-3.5 text-sm gap-2 ' . ($pill ? 'rounded-full' : 'rounded-lg'),
    };

    if ($variant === 'link') {
        $sizeClasses = 'text-sm p-0';
    }

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");
    $hasCustomXData = $attributes->has('x-data');
    $isDisabled = $disabled || $loading;
@endphp

@if($href)
    <a 
        wire:navigate 
        href="{{ $isDisabled ? '#' : $href }}" 
        @if(!$hasCustomXData) x-data @endif 
        @if($isDisabled) aria-disabled="true" tabindex="-1" @endif
        {{ $attributes->twMerge(['class' => $compiledClasses]) }}
    >
        @if($loading)
            <svg class="animate-spin -ml-0.5 mr-2 size-3.5 shrink-0 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}" 
        @if($isDisabled) disabled @endif
        @if(!$hasCustomXData) x-data @endif 
        {{ $attributes->twMerge(['class' => $compiledClasses]) }}
    >
        @if($loading)
            <svg class="animate-spin -ml-0.5 mr-2 size-3.5 shrink-0 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
