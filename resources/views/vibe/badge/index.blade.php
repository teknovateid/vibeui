@blaze

@props([
    'variant' => 'default', // default/primary, secondary, outline, ghost, accent, destructive/danger, success, warning, info
    'size' => 'md',         // sm, md, lg, xl
    'icon' => null,
    'trailingIcon' => null,
    'prefix' => null,
    'suffix' => null,
    'dot' => false,
    'dotPulse' => false,
    'dismissible' => false,
    'href' => null,
])

@php
    $hasLeading = isset($icon) || !empty($prefix);
    $hasTrailing = isset($trailingIcon) || !empty($suffix);
    $hasSlotContent = $slot->isNotEmpty() && trim($slot) !== '';

    $baseClasses = 'inline-flex items-center justify-center font-medium select-none whitespace-nowrap transition-colors duration-150';

    $sizeClasses = match ($size) {
        'sm' => 'h-5 px-2 text-[11px] gap-1 rounded-sm',
        'md' => 'h-6 px-2.5 text-xs font-semibold gap-1.5 rounded-md',
        'lg' => 'h-7 px-3 text-xs font-semibold gap-1.5 rounded-lg',
        'xl' => 'h-8 px-3.5 text-sm font-semibold gap-2 rounded-lg',
        default => 'h-6 px-2.5 text-xs font-semibold gap-1.5 rounded-md',
    };

    $variantClasses = match ($variant) {
        'primary', 'default' => 'bg-primary text-primary-foreground shadow-2xs',
        'secondary' => 'bg-secondary text-secondary-foreground',
        'outline' => 'border border-border text-foreground bg-transparent',
        'ghost' => 'text-muted-foreground hover:bg-muted hover:text-foreground',
        'accent' => 'bg-accent text-accent-foreground border border-border font-semibold shadow-2xs',
        'destructive', 'danger' => 'bg-destructive/15 text-destructive border border-destructive/20',
        'success' => 'bg-success/15 text-success border border-success/20',
        'warning' => 'bg-warning/15 text-warning border border-warning/20',
        'info' => 'bg-info/15 text-info border border-info/20',
        default => 'bg-primary text-primary-foreground shadow-2xs',
    };

    $dotColorClass = match ($variant) {
        'primary', 'default' => 'bg-primary-foreground',
        'secondary' => 'bg-secondary-foreground',
        'outline', 'ghost' => 'bg-foreground',
        'accent' => 'bg-accent-foreground',
        'destructive', 'danger' => 'bg-destructive',
        'success' => 'bg-success',
        'warning' => 'bg-warning',
        'info' => 'bg-info',
        default => 'bg-current',
    };

    $dotSizeClass = match ($size) {
        'sm' => 'size-1.5',
        'md' => 'size-1.5',
        'lg' => 'size-2',
        'xl' => 'size-2',
        default => 'size-1.5',
    };

    $iconSizeClass = match ($size) {
        'sm' => 'size-3 [&>svg]:size-3',
        'md' => 'size-3.5 [&>svg]:size-3.5',
        'lg' => 'size-3.5 [&>svg]:size-3.5',
        'xl' => 'size-4 [&>svg]:size-4',
        default => 'size-3.5 [&>svg]:size-3.5',
    };

    $dismissSizeClass = match ($size) {
        'sm' => 'size-3 [&>svg]:size-2',
        'md' => 'size-3.5 [&>svg]:size-2.5',
        'lg' => 'size-4 [&>svg]:size-3',
        'xl' => 'size-4.5 [&>svg]:size-3',
        default => 'size-3.5 [&>svg]:size-2.5',
    };

    $interactiveClasses = $href ? 'cursor-pointer hover:opacity-90 active:scale-[0.98]' : '';

    $compiledClasses = trim("{$baseClasses} {$sizeClasses} {$variantClasses} {$interactiveClasses}");
@endphp

@if ($href)
    <a wire:navigate href="{{ $href }}" {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
        @if ($dot)
            <span class="relative flex {{ $dotSizeClass }} shrink-0">
                @if ($dotPulse)
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full {{ $dotColorClass }} opacity-75"></span>
                @endif
                <span class="relative inline-flex {{ $dotSizeClass }} rounded-full {{ $dotColorClass }}"></span>
            </span>
        @endif

        @if ($hasLeading)
            @if (isset($icon))
                <span class="{{ $iconSizeClass }} flex items-center justify-center shrink-0 [&>svg]:shrink-0">{{ $icon }}</span>
            @elseif (!empty($prefix))
                <span class="font-medium opacity-80 select-none">{{ $prefix }}</span>
            @endif
        @endif

        @if ($hasSlotContent)
            <span>{{ $slot }}</span>
        @endif

        @if ($hasTrailing)
            @if (isset($trailingIcon))
                <span class="{{ $iconSizeClass }} flex items-center justify-center shrink-0 [&>svg]:shrink-0">{{ $trailingIcon }}</span>
            @elseif (!empty($suffix))
                <span class="font-medium opacity-80 select-none">{{ $suffix }}</span>
            @endif
        @endif

        @if ($dismissible)
            <button 
                type="button" 
                @click.stop="$el.closest('a').remove()" 
                class="shrink-0 -mr-0.5 {{ $dismissSizeClass }} rounded-full inline-flex items-center justify-center opacity-70 hover:opacity-100 hover:bg-foreground/10 transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                aria-label="Hapus badge"
            >
                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        @endif
    </a>
@else
    <span {{ $attributes->twMerge(['class' => $compiledClasses]) }}>
        @if ($dot)
            <span class="relative flex {{ $dotSizeClass }} shrink-0">
                @if ($dotPulse)
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full {{ $dotColorClass }} opacity-75"></span>
                @endif
                <span class="relative inline-flex {{ $dotSizeClass }} rounded-full {{ $dotColorClass }}"></span>
            </span>
        @endif

        @if ($hasLeading)
            @if (isset($icon))
                <span class="{{ $iconSizeClass }} flex items-center justify-center shrink-0 [&>svg]:shrink-0">{{ $icon }}</span>
            @elseif (!empty($prefix))
                <span class="font-medium opacity-80 select-none">{{ $prefix }}</span>
            @endif
        @endif

        @if ($hasSlotContent)
            <span>{{ $slot }}</span>
        @endif

        @if ($hasTrailing)
            @if (isset($trailingIcon))
                <span class="{{ $iconSizeClass }} flex items-center justify-center shrink-0 [&>svg]:shrink-0">{{ $trailingIcon }}</span>
            @elseif (!empty($suffix))
                <span class="font-medium opacity-80 select-none">{{ $suffix }}</span>
            @endif
        @endif

        @if ($dismissible)
            <button 
                type="button" 
                @click.stop="$el.closest('span').remove()" 
                class="shrink-0 -mr-0.5 {{ $dismissSizeClass }} rounded-full inline-flex items-center justify-center opacity-70 hover:opacity-100 hover:bg-foreground/10 transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring"
                aria-label="Hapus badge"
            >
                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        @endif
    </span>
@endif
