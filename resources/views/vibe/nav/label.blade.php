@blaze(fold: true)

@props(['title', 'persist' => false, 'id' => null, 'active' => false, 'open' => true, 'pinnable' => false, 'pinnedContainer' => false])

@php
    $labelId = $id ?? Str::slug($title);
    $gridId = 'nav-label-grid-' . Str::random(6);
    $chevronId = 'nav-label-chevron-' . Str::random(6);
    $defaultOpenState = $active || $open ? true : false;
@endphp

<div {{ $attributes->twMerge(['class' => 'w-full flex flex-col gap-1 group-data-[state=minified]/sheet:border-none']) }} @if ($pinnedContainer) data-pinned-container style="display: none;" @endif x-data="{
    open: {{ $defaultOpenState ? 'true' : 'false' }},
    ready: false,
    init() {
        @if ($persist) let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                let navEl = this.$el.closest('nav');
                let navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                
                try {
                    let stored = localStorage.getItem(key);
                    if (stored) {
                        let data = JSON.parse(stored);
                        if (Array.isArray(data)) {
                            let item = data.find(i => i.id === navId);
                            if (item && item.labels && item.labels['{{ $labelId }}'] !== undefined && !{{ $active ? 'true' : 'false' }}) {
                                this.open = Boolean(item.labels['{{ $labelId }}']);
                            }
                        }
                    }
                } catch(e) {}

                this.$watch('open', val => {
                    try {
                        let stored = localStorage.getItem(key);
                        let data = stored ? JSON.parse(stored) : [];
                        if (!Array.isArray(data)) data = [];
                        let index = data.findIndex(i => i.id === navId);
                        let existing = index !== -1 ? data[index] : { id: navId, pinned: [], groups: {}, labels: {} };
                        if (!existing.labels) existing.labels = {};
                        existing.labels['{{ $labelId }}'] = val;
                        if (index !== -1) {
                            data[index] = existing;
                        } else {
                            data.push(existing);
                        }
                        localStorage.setItem(key, JSON.stringify(data));
                    } catch(e) {}
                }); @endif

        this.$nextTick(() => { this.ready = true; });
    }
}">
    <button type="button" @click="open = !open" class="minified:hidden! flex items-center gap-2 w-full py-1.5 text-[11px] font-semibold text-muted-foreground uppercase tracking-wider hover:text-foreground transition-colors group/nav-label cursor-pointer select-none">
        <div class="flex items-center">
            @if ($pinnable)
                <div @click.stop="if(typeof togglePin !== 'undefined') togglePin('{{ $labelId }}')" class="inline-flex items-center justify-center size-6 rounded hover:bg-accent hover:text-accent-foreground transition-colors" :class="typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}') ? 'text-foreground' : 'text-muted-foreground group-hover/nav-label:text-foreground'" :title="typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}') ? '{{ __('vibe/nav.unpin') }}' : '{{ __('vibe/nav.pin') }}'" title="{{ __('vibe/nav.pin') }}" aria-label="{{ __('vibe/nav.pin') }}">
                    <!-- Pinned Icon -->
                    <svg x-show="typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}')" class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.184 7.805l-2.965-2.967C14.192 2.809 13.18 1.795 12.09 2.035c-1.088.24-1.581 1.586-2.568 4.28L8.854 8.138c-.263.718-.395 1.077-.632 1.355a2.5 2.5 0 0 1-.36.331c-.296.213-.664.315-1.4.518-1.661.458-2.492.687-2.804 1.23-.136.235-.206.502-.204.773.004.627.613 1.236 1.83 2.455l1.415 1.416-4.476 4.48a.75.75 0 1 0 1.079 1.08l4.476-4.48 1.466 1.467c1.225 1.227 1.838 1.84 2.469 1.841.266 0 .527-.069.758-.201.548-.312.778-1.149 1.238-2.821.202-.735.304-1.103.516-1.399.093-.13.201-.248.322-.352.275-.239.632-.373 1.345-.641l1.844-.693c2.664-1.001 3.996-1.501 4.23-2.587.235-1.085-.77-2.092-2.783-4.106Z"/>
                    </svg>
                    <!-- Unpinned Icon -->
                    <svg x-show="!(typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}'))" class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 22l4.653-4.658M19.072 8.036L15.99 4.95C13.882 2.84 12.829 1.786 11.697 2.036c-1.131.25-1.644 1.65-2.67 4.45L8.332 8.382c-.273.746-.41 1.12-.656 1.408a2.5 2.5 0 0 1-.374.345c-.308.222-.69.327-1.457.538-1.726.476-2.589.714-2.914 1.279a1.5 1.5 0 0 0-.212.803c.004.652.637 1.286 1.903 2.553l4.117 4.12c1.274 1.276 1.911 1.914 2.567 1.915a1.5 1.5 0 0 0 .788-.208c.57-.325.809-1.195 1.288-2.934.21-.764.315-1.147.536-1.455.097-.134.209-.257.334-.366.286-.248.657-.387 1.399-.666l1.917-.72c2.77-1.04 4.154-1.56 4.398-2.69.244-1.128-.802-2.175-2.894-4.269Z"/>
                    </svg>
                </div>
            @endif

            <svg id="{{ $chevronId }}" class="size-3 shrink-0" :class="ready ? 'transition-transform duration-300' : ''" style="transform: {{ $defaultOpenState ? 'none' : 'rotate(-90deg)' }};" x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 9l-7 6-7-6" />
            </svg>
        </div>
        <div class="flex items-center gap-1 justify-between w-full">
            <span class="whitespace-nowrap">{{ $title }}</span>
            @if ($pinnedContainer)
                <span x-show="$data.maxpin" x-text="($data.maxpin ? (($data.pinned ? $data.pinned.length : 0) + ' / ' + $data.maxpin) : '')" class="font-normal normal-case tracking-normal text-muted-foreground mr-2"></span>
            @endif
        </div>
    </button>

    <!-- Animated Container -->
    <div id="{{ $gridId }}" class="grid group-data-[state=minified]/sheet:grid-rows-[1fr]!" :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" :style="{ gridTemplateRows: open ? '1fr' : '0fr' }" style="{{ $defaultOpenState ? 'grid-template-rows: 1fr;' : 'grid-template-rows: 0fr;' }}">
        <div class="overflow-hidden group-data-[state=minified]/sheet:overflow-visible min-h-0">
            <div @if ($pinnedContainer) data-pinned-items @endif class="flex flex-col gap-1 pb-1">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

@if ($persist)
    <script>
        (function() {
            try {
                var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                var stored = localStorage.getItem(key);
                var isActive = {{ $active ? 'true' : 'false' }};
                var defaultOpen = {{ $defaultOpenState ? 'true' : 'false' }};
                var savedOpen = defaultOpen;

                if (stored && !isActive) {
                    var data = JSON.parse(stored);
                    if (Array.isArray(data)) {
                        var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                        var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                        var navItem = data.find(i => i.id === navId);
                        if (navItem && navItem.labels && navItem.labels['{{ $labelId }}'] !== undefined) {
                            savedOpen = Boolean(navItem.labels['{{ $labelId }}']);
                        }
                    }
                }

                var grid = document.getElementById('{{ $gridId }}');
                var chevron = document.getElementById('{{ $chevronId }}');
                if (grid) grid.style.gridTemplateRows = savedOpen ? '1fr' : '0fr';
                if (chevron) {
                    chevron.style.transform = savedOpen ? 'none' : 'rotate(-90deg)';
                }
            } catch (e) {}
        })();
    </script>
@endif
