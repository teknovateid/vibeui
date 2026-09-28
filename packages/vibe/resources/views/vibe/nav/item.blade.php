@blaze(fold: true)

@props([
    'href' => '#',
    'active' => false,
    'badge' => null,
    'badgeColor' => 'vibe',
    'collapsed' => false,
    'pinnable' => false,
    'id' => null,
    'variant' => null,
    'density' => null,
    'indicator' => null,
])

@php
    $itemId = $id ?? Str::slug(strip_tags($slot));
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:px-0 data-[collapsed=true]:justify-center data-[collapsed=true]:mx-auto group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto group-data-[state=minified]/sheet:overflow-visible';
    
    $itemDensity = match($density) {
        'compact', 'sm' => 'compact',
        'relaxed', 'lg' => 'relaxed',
        default => $density,
    };
    $densityClasses = match($itemDensity) {
        'compact' => 'min-h-8 px-2.5 py-1 text-xs',
        'relaxed' => 'min-h-10 px-3.5 py-2.5 text-sm',
        default => 'min-h-9 px-3 py-2 text-sm',
    };

    $baseClasses = "flex items-center rounded-lg font-medium w-full relative group/nav-item $densityClasses $minifiedClasses";

    $hasIndicator = $indicator || $variant === 'line';
    $indicatorClasses = ($active && $hasIndicator) 
        ? 'before:absolute before:left-0 before:top-1.5 before:bottom-1.5 before:w-1 before:rounded-r before:bg-[var(--nav-indicator)]' 
        : '';

    $variantClasses = match ($variant) {
        'primary' => $active ? 'bg-primary text-primary-foreground font-semibold shadow-xs' : 'text-muted-foreground hover:bg-primary/10 hover:text-primary',
        'subtle' => $active ? 'bg-muted text-foreground font-semibold' : 'text-muted-foreground hover:bg-muted/80 hover:text-foreground',
        'line' => $active ? 'bg-transparent text-foreground font-semibold' : 'text-muted-foreground hover:bg-[var(--nav-hover-bg)] hover:text-[var(--nav-hover-fg)]',
        default => $active ? 'bg-[var(--nav-active-bg)] text-[var(--nav-active-fg)] font-semibold' : 'text-muted-foreground hover:bg-[var(--nav-hover-bg)] hover:text-[var(--nav-hover-fg)]',
    };

    $activeMarker = $active ? 'nav-item-active' : '';
    $compiledClasses = "$baseClasses $variantClasses $indicatorClasses $activeMarker";

    $badgeClasses = match ($badgeColor) {
        'green', 'success' => 'bg-success/15 text-success border border-success/20',
        'blue', 'info' => 'bg-info/15 text-info border border-info/20',
        'red', 'danger', 'destructive' => 'bg-destructive/15 text-destructive border border-destructive/20',
        'yellow', 'warning' => 'bg-warning/15 text-warning border border-warning/20',
        default => 'bg-secondary text-secondary-foreground',
    };
@endphp

<a wire:navigate href="{{ $href }}" @click="if ($event.target.closest('[data-nav-pin-btn]')) { $event.preventDefault(); $event.stopPropagation(); return false; }" @if ($collapsed) data-collapsed="true" @endif data-nav-pin-id="{{ $itemId }}" data-pin-type="item" data-pin-title="{{ strip_tags($slot) }}" data-pin-href="{{ $href }}" @if ($variant) data-variant="{{ $variant }}" @endif @if ($itemDensity) data-density="{{ $itemDensity }}" @endif @if ($hasIndicator) data-indicator="true" @endif x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[width,height,padding,margin] duration-300'" {{ $attributes->twMerge(['class' => $compiledClasses]) }}>

    <!-- Icon -->
    @if (isset($icon))
        <span data-pin-icon class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-current' : 'text-muted-foreground group-hover/nav-item:text-foreground' }}">
            {{ $icon }}
        </span>
    @endif

    <!-- Animated Wrapper for Label & Badge -->
    <div :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[max-width,opacity,margin] duration-300 ease-in-out'" class="flex flex-1 min-w-0 w-full items-center justify-between overflow-hidden {{ $collapsed ? 'max-w-0 opacity-0 ml-0 hidden' : 'max-w-[100vw] opacity-100 ml-3' }} group-data-[collapsed=true]/nav-item:hidden group-data-[state=minified]/sheet:hidden">
        <!-- Label -->
        <span class="whitespace-nowrap truncate">
            {{ $slot }}
        </span>

        <div class="flex items-center gap-2 shrink-0 ml-auto">
            <!-- Badge -->
            @if ($badge)
                <span class="inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-semibold rounded {{ $badgeClasses }}">
                    {{ $badge }}
                </span>
            @endif

            {{-- Pin button: visible when parent nav has pinnable OR this item has pinnable prop, but NEVER when inside a group --}}
            <div 
                data-nav-pin-btn
                data-pinned="false"
                :data-pinned="typeof isPinned !== 'undefined' && isPinned('{{ $itemId }}') ? 'true' : 'false'"
                x-show="(! (typeof isGroupChild !== 'undefined' && isGroupChild)) && ((typeof pinnable !== 'undefined' && pinnable) || {{ $pinnable ? 'true' : 'false' }})" 
                @click.stop.prevent="if(typeof togglePin !== 'undefined') togglePin('{{ $itemId }}')" 
                class="inline-flex items-center justify-center size-6 rounded hover:bg-accent hover:text-accent-foreground transition-colors cursor-pointer text-muted-foreground opacity-100 lg:opacity-0 lg:group-hover/nav-item:opacity-100 group-hover/nav-item:text-foreground data-[pinned=true]:text-foreground data-[pinned=true]:opacity-100" 
                style="display:none" 
                :title="typeof isPinned !== 'undefined' && isPinned('{{ $itemId }}') ? '{{ __('vibe/nav.unpin') }}' : '{{ __('vibe/nav.pin') }}'"
                title="{{ __('vibe/nav.pin') }}"
                aria-label="{{ __('vibe/nav.pin') }}"
            >
                <!-- Pinned Icon (Solid Fill) -->
                <svg class="size-3 pin-icon-pinned pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 13.5V11c0-1.657-1.343-3-3-3h-1V4c0-1.105-.895-2-2-2h-2c-1.105 0-2 .895-2 2v4H8c-1.657 0-3 1.343-3 3v2.5c0 .828.672 1.5 1.5 1.5H11v6l1 1 1-1v-6h4.5c.828 0 1.5-.672 1.5-1.5z" />
                </svg>

                <!-- Unpinned Icon (Outline) -->
                <svg class="size-3 pin-icon-unpinned pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 13.5V11c0-1.657-1.343-3-3-3h-1V4c0-1.105-.895-2-2-2h-2c-1.105 0-2 .895-2 2v4H8c-1.657 0-3 1.343-3 3v2.5c0 .828.672 1.5 1.5 1.5H11v6l1 1 1-1v-6h4.5c.828 0 1.5-.672 1.5-1.5z" />
                </svg>
            </div>
        </div>
    </div>
</a>
