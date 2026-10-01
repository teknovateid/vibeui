@blaze(fold: true)

@props([
    'title', 
    'active' => false, 
    'open' => false, 
    'persist' => false, 
    'id' => null, 
    'pinnable' => false,
    'variant' => null,
    'density' => null,
    'indicator' => null,
])

@php
    $groupId = $id ?? Str::slug($title);
    $gridId = 'nav-group-grid-' . Str::random(6);
    $chevronId = 'nav-group-chevron-' . Str::random(6);
    $defaultOpenState = ($active || $open) ? true : false;
    $minifiedClasses = 'data-[collapsed=true]:w-11 data-[collapsed=true]:h-11 data-[collapsed=true]:mx-auto data-[collapsed=true]:justify-center data-[collapsed=true]:px-0 group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto group-data-[state=minified]/sheet:overflow-visible';
    
    $itemDensity = match($density) {
        'compact', 'sm' => 'compact',
        'relaxed', 'lg' => 'relaxed',
        default => $density,
    };
    $densityClasses = match($itemDensity) {
        'compact' => 'min-h-8 px-2.5 py-1 text-xs',
        'relaxed' => 'min-h-11 sm:min-h-10 px-4 sm:px-3.5 py-2.5 text-sm',
        default => 'min-h-10 sm:min-h-9 px-3.5 sm:px-3 py-2 text-sm',
    };

    $baseClasses = "flex items-center rounded-lg font-medium w-full relative overflow-hidden group/nav-item cursor-pointer select-none outline-none focus-visible:ring-2 focus-visible:ring-ring $densityClasses $minifiedClasses";

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
@endphp

<div 
    x-data="{
        open: $el.dataset.pinnedShortcutFor ? false : {{ $defaultOpenState ? 'true' : 'false' }},
        ready: false,
        isGroupChild: true,
        init() {
            if (this.$el.dataset.pinnedShortcutFor) {
                this.open = false;
                this.$nextTick(() => { this.ready = true; });
                return;
            }
            @if ($persist)
                let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                let navEl = this.$el.closest('nav');
                let navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                
                try {
                    let stored = localStorage.getItem(key);
                    if (stored) {
                        let data = JSON.parse(stored);
                        if (Array.isArray(data)) {
                            let item = data.find(i => i.id === navId);
                            if (item && item.groups && item.groups['{{ $groupId }}'] !== undefined && !{{ $active ? 'true' : 'false' }}) {
                                this.open = Boolean(item.groups['{{ $groupId }}']);
                            }
                        }
                    }
                } catch(e) {}

                let saveGroup = (val) => {
                    try {
                        let stored = localStorage.getItem(key);
                        let data = stored ? JSON.parse(stored) : [];
                        if (!Array.isArray(data)) data = [];
                        let index = data.findIndex(i => i.id === navId);
                        let existing = index !== -1 ? data[index] : { id: navId, pinned: [], groups: {}, labels: {} };
                        if (!existing.groups) existing.groups = {};
                        existing.groups['{{ $groupId }}'] = val;
                        if (index !== -1) {
                            data[index] = existing;
                        } else {
                            data.push(existing);
                        }
                        localStorage.setItem(key, JSON.stringify(data));
                    } catch(e) {}
                };

                if ({{ $active ? 'true' : 'false' }}) {
                    saveGroup(true);
                }

                this.$watch('open', val => {
                    saveGroup(val);
                });
            @endif

            this.$nextTick(() => { this.ready = true; });
        }
    }" 
    data-nav-pin-id="{{ $groupId }}" 
    data-pin-type="group" 
    data-pin-title="{{ $title }}" 
    class="w-full flex flex-col gap-1 relative group/group-wrapper"
>
    <button 
        @click="open = !open" 
        data-nav-group-trigger
        data-pin-title="{{ $title }}" 
        x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" 
        type="button" 
        @if ($variant) data-variant="{{ $variant }}" @endif 
        @if ($itemDensity) data-density="{{ $itemDensity }}" @endif 
        @if ($hasIndicator) data-indicator="true" @endif 
        :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[width,height,padding,margin] duration-300'" 
        {{ $attributes->twMerge(['class' => $compiledClasses]) }}
    >
        <!-- Icon -->
        @if (isset($icon))
            <span data-pin-icon class="shrink-0 flex items-center justify-center w-5 h-5 {{ $active ? 'text-current' : 'text-muted-foreground group-hover/nav-item:text-foreground' }}">
                {{ $icon }}
            </span>
        @endif

        <div :class="(typeof isInitialized !== 'undefined' && !isInitialized) ? '' : 'transition-[max-width,opacity,margin] duration-300 ease-in-out'" class="flex flex-1 min-w-0 gap-2 w-full items-center justify-between overflow-hidden max-w-[100vw] opacity-100 ml-3 group-data-[collapsed=true]/nav-item:hidden group-data-[state=minified]/sheet:hidden">
            <span class="whitespace-nowrap">
                {{ $title }}
            </span>

            <div class="flex items-center gap-1 shrink-0 ml-auto">
                {{-- Pin button: visible when parent nav has pinnable OR this group has pinnable prop --}}
                <div 
                    data-nav-pin-btn
                    data-pinned="false"
                    :data-pinned="typeof isPinned !== 'undefined' && isPinned('{{ $groupId }}') ? 'true' : 'false'"
                    x-show="(typeof pinnable !== 'undefined' && pinnable) || {{ $pinnable ? 'true' : 'false' }}" 
                    @click.stop.prevent="if(typeof togglePin !== 'undefined') togglePin('{{ $groupId }}')" 
                    class="inline-flex items-center justify-center size-6 rounded hover:bg-muted hover:text-foreground transition-colors cursor-pointer text-muted-foreground opacity-100 lg:opacity-0 lg:group-hover/nav-item:opacity-100 group-hover/nav-item:text-foreground data-[pinned=true]:text-foreground data-[pinned=true]:opacity-100" 
                    style="display:none" 
                    title="Pin"
                >
                    <!-- Pinned Icon (Solid Fill) -->
                    <svg class="size-3 pin-icon-pinned pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.184 7.805l-2.965-2.967C14.192 2.809 13.18 1.795 12.09 2.035c-1.088.24-1.581 1.586-2.568 4.28L8.854 8.138c-.263.718-.395 1.077-.632 1.355a2.5 2.5 0 0 1-.36.331c-.296.213-.664.315-1.4.518-1.661.458-2.492.687-2.804 1.23-.136.235-.206.502-.204.773.004.627.613 1.236 1.83 2.455l1.415 1.416-4.476 4.48a.75.75 0 1 0 1.079 1.08l4.476-4.48 1.466 1.467c1.225 1.227 1.838 1.84 2.469 1.841.266 0 .527-.069.758-.201.548-.312.778-1.149 1.238-2.821.202-.735.304-1.103.516-1.399.093-.13.201-.248.322-.352.275-.239.632-.373 1.345-.641l1.844-.693c2.664-1.001 3.996-1.501 4.23-2.587.235-1.085-.77-2.092-2.783-4.106Z"/>
                    </svg>

                    <!-- Unpinned Icon (Outline) -->
                    <svg class="size-3 pin-icon-unpinned pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 22l4.653-4.658M19.072 8.036L15.99 4.95C13.882 2.84 12.829 1.786 11.697 2.036c-1.131.25-1.644 1.65-2.67 4.45L8.332 8.382c-.273.746-.41 1.12-.656 1.408a2.5 2.5 0 0 1-.374.345c-.308.222-.69.327-1.457.538-1.726.476-2.589.714-2.914 1.279a1.5 1.5 0 0 0-.212.803c.004.652.637 1.286 1.903 2.553l4.117 4.12c1.274 1.276 1.911 1.914 2.567 1.915a1.5 1.5 0 0 0 .788-.208c.57-.325.809-1.195 1.288-2.934.21-.764.315-1.147.536-1.455.097-.134.209-.257.334-.366.286-.248.657-.387 1.399-.666l1.917-.72c2.77-1.04 4.154-1.56 4.398-2.69.244-1.128-.802-2.175-2.894-4.269Z"/>
                    </svg>
                </div>

                <!-- Chevron -->
                <svg 
                    id="{{ $chevronId }}" 
                    class="size-3.5 shrink-0 {{ $active ? 'text-current' : 'text-muted-foreground group-hover/nav-item:text-foreground' }}" 
                    :class="ready ? 'transition-transform duration-300' : ''" 
                    style="transform: {{ $defaultOpenState ? 'none' : 'rotate(-90deg)' }};" 
                    x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`"
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" 
                    fill="none" 
                    stroke="currentColor" 
                    stroke-width="1.5" 
                    stroke-linecap="round" 
                    stroke-linejoin="round"
                >
                    <path d="M19 9l-7 6-7-6" />
                </svg>
            </div>
        </div>
    </button>

    <div 
        id="{{ $gridId }}" 
        class="grid data-[collapsed=true]:hidden! group-data-[state=minified]/sheet:hidden!" 
        :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" 
        x-bind:data-collapsed="typeof state !== 'undefined' && state === 'minified'" 
        :style="{ gridTemplateRows: open ? '1fr' : '0fr' }"
        style="{{ $defaultOpenState ? 'grid-template-rows: 1fr;' : 'grid-template-rows: 0fr;' }}"
    >
        <div class="overflow-hidden min-h-0">
            <div class="flex flex-col gap-1 mt-1">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Hidden Template for Flyout Dropdown Panel when Minified on Hover -->
    <div data-nav-group-flyout-content class="hidden">
        <div class="flex flex-col gap-0.5">
            {{ $slot }}
        </div>
    </div>
</div>

@if ($persist)
<script>
    (function() {
        try {
            var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
            var stored = localStorage.getItem(key);
            if (stored) {
                var data = JSON.parse(stored);
                if (Array.isArray(data)) {
                    var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                    var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                    var navItem = data.find(i => i.id === navId);
                    if (navItem && navItem.groups && navItem.groups['{{ $groupId }}'] !== undefined) {
                        var saved = navItem.groups['{{ $groupId }}'];
                        var grid = document.getElementById('{{ $gridId }}');
                        var chevron = document.getElementById('{{ $chevronId }}');
                        if (saved === false && !{{ $active ? 'true' : 'false' }}) {
                            if (grid) grid.style.gridTemplateRows = '0fr';
                            if (chevron) chevron.style.transform = 'rotate(-90deg)';
                        } else if (saved === true) {
                            if (grid) grid.style.gridTemplateRows = '1fr';
                            if (chevron) chevron.style.transform = 'none';
                        }
                    }
                }
            }
        } catch(e) {}
    })();
</script>
@endif
