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
                        <path d="M19 13.5V11c0-1.657-1.343-3-3-3h-1V4c0-1.105-.895-2-2-2h-2c-1.105 0-2 .895-2 2v4H8c-1.657 0-3 1.343-3 3v2.5c0 .828.672 1.5 1.5 1.5H11v6l1 1 1-1v-6h4.5c.828 0 1.5-.672 1.5-1.5z" />
                    </svg>
                    <!-- Unpinned Icon -->
                    <svg x-show="!(typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}'))" class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 13.5V11c0-1.657-1.343-3-3-3h-1V4c0-1.105-.895-2-2-2h-2c-1.105 0-2 .895-2 2v4H8c-1.657 0-3 1.343-3 3v2.5c0 .828.672 1.5 1.5 1.5H11v6l1 1 1-1v-6h4.5c.828 0 1.5-.672 1.5-1.5z" />
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
