@blaze(fold: true)

@props([
    'variant' => 'primary', // primary, secondary, outline, ghost, accent, destructive/danger, success, warning, info
    'size' => 'md',        // sm, md, lg
    'pill' => false,       // true: rounded-full, false: rounded-md
    'dot' => false,        // boolean
    'dotPulse' => false,   // animated ping
    'dismissible' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center select-none whitespace-nowrap transition-colors';

    $variantClasses = match ($variant) {
        'primary', 'default' => 'bg-primary text-primary-foreground shadow-2xs',
        'secondary' => 'bg-secondary text-secondary-foreground',
        'outline' => 'border border-border text-foreground bg-transparent',
        'ghost' => 'bg-muted text-muted-foreground',
        'accent' => 'bg-accent text-accent-foreground border border-accent-foreground/20 font-semibold shadow-2xs',
        'destructive', 'danger' => 'bg-red-500/15 text-red-700 dark:text-red-400 border border-red-500/20',
        'success' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/20',
        'warning' => 'bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/20',
        'info' => 'bg-sky-500/15 text-sky-700 dark:text-sky-400 border border-sky-500/20',
        default => 'bg-primary text-primary-foreground shadow-2xs',
    };

    $sizeClasses = match ($size) {
        'sm' => 'px-1.5 py-0.25 text-[10px] font-medium gap-1 ' . ($pill ? 'rounded-full' : 'rounded-sm'),
        'md' => 'px-2.5 py-0.5 text-xs font-semibold gap-1.5 ' . ($pill ? 'rounded-full' : 'rounded-md'),
        'lg' => 'px-3 py-1 text-xs font-semibold gap-1.5 ' . ($pill ? 'rounded-full' : 'rounded-lg'),
        default => 'px-2.5 py-0.5 text-xs font-semibold gap-1.5 ' . ($pill ? 'rounded-full' : 'rounded-md'),
    };

    $dotColorClass = match ($variant) {
        'primary', 'default' => 'bg-primary-foreground',
        'destructive', 'danger' => 'bg-red-500',
        'success' => 'bg-emerald-500',
        'warning' => 'bg-amber-500',
        'info' => 'bg-sky-500',
        'accent' => 'bg-accent-foreground',
        default => 'bg-current',
    };

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses}");
@endphp

<span {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
    @if ($dot)
        <span class="relative flex size-1.5 shrink-0">
            @if ($dotPulse)
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full {{ $dotColorClass }} opacity-75"></span>
            @endif
            <span class="relative inline-flex size-1.5 rounded-full {{ $dotColorClass }}"></span>
        </span>
    @endif

    @if (isset($icon))
        <span class="size-3.5 shrink-0 flex items-center justify-center">{{ $icon }}</span>
    @endif

    <span>{{ $slot }}</span>

    @if ($dismissible)
        <button 
            type="button" 
            @click.stop="$el.closest('span').remove()" 
            class="-mr-1 size-3.5 rounded-full inline-flex items-center justify-center opacity-70 hover:opacity-100 hover:bg-black/10 dark:hover:bg-white/10 transition-opacity cursor-pointer focus:outline-none"
            aria-label="Hapus badge"
        >
            <svg class="size-2.5 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    @endif
</span>
