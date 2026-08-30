@props(['title', 'persist' => false, 'id' => null, 'active' => false, 'open' => true, 'pinnable' => false, 'pinnedContainer' => false])

@php
    $labelId = $id ?? Str::slug($title);
    $gridId = 'nav-label-grid-' . Str::random(6);
    $chevronId = 'nav-label-chevron-' . Str::random(6);
    $defaultOpenState = ($active || $open) ? true : false;
@endphp

<div 
    {{ $attributes->twMerge(['class' => 'w-full flex flex-col gap-1 group-data-[state=minified]/sheet:border-none']) }} 
    @if ($pinnedContainer) data-pinned-container style="display: none;" @endif 
    x-data="{
        open: {{ $defaultOpenState ? 'true' : 'false' }},
        ready: false,
        init() {
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
                });
            @endif

            this.$nextTick(() => { this.ready = true; });
        }
    }"
>
    <button 
        type="button" 
        @click="open = !open" 
        class="minified:hidden! flex items-center gap-2 w-full py-1.5 text-[11px] font-semibold text-vibe-700 uppercase tracking-wider hover:text-vibe-950 dark:text-vibe-300 dark:hover:text-vibe-100 transition-colors group/nav-label cursor-pointer select-none"
    >
        <div class="flex items-center">
            @if ($pinnable ?? false)
                <div @click.stop="if(typeof togglePin !== 'undefined') togglePin('{{ $labelId }}')" class="p-1 rounded hover:bg-vibe-200 dark:hover:bg-vibe-800 transition-colors" :class="typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}') ? 'text-vibe-900 dark:text-vibe-100' : 'text-vibe-400 group-hover/nav-label:text-vibe-600 dark:group-hover/nav-label:text-vibe-400'" title="Pin">
                    <!-- Pinned Icon -->
                    <svg x-show="typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}')" class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 4h-4v2h4v-2zm2 2h2c1.1 0 2 .9 2 2v2h-8v-2h4v-2zm-6 4v5h3v7l1 2 1-2v-7h3v-5h-8z" />
                    </svg>
                    <!-- Unpinned Icon -->
                    <svg x-show="!(typeof isPinned !== 'undefined' && isPinned('{{ $labelId }}'))" class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="17" x2="12" y2="22"></line>
                        <path d="M5 17h14v-1.76a2 2 0 0 0-1.11-1.79l-1.78-.9A2 2 0 0 1 15 10.76V6h1a2 2 0 0 0 0-4H8a2 2 0 0 0 0 4h1v4.76a2 2 0 0 1-1.11 1.79l-1.78.9A2 2 0 0 0 5 15.24Z"></path>
                    </svg>
                </div>
            @endif

            <svg 
                id="{{ $chevronId }}" 
                class="size-3 shrink-0" 
                :class="ready ? 'transition-transform duration-300' : ''" 
                style="transform: {{ $defaultOpenState ? 'none' : 'rotate(-90deg)' }};"
                x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`"
                xmlns="http://www.w3.org/2000/svg" 
                viewBox="0 0 24 24" 
                fill="none" 
                stroke="currentColor" 
                stroke-width="2.5" 
                stroke-linecap="round" 
                stroke-linejoin="round"
            >
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
        <div class="flex items-center gap-1 justify-between w-full">
            <span class="whitespace-nowrap">{{ $title }}</span>
            @if ($pinnedContainer)
                <span x-show="typeof maxpin !== 'undefined' && maxpin" x-text="(typeof pinned !== 'undefined' ? pinned.length : 0) + ' / ' + maxpin" class="font-normal normal-case tracking-normal text-vibe-600 dark:text-vibe-400 mr-2"></span>
            @endif
        </div>
    </button>

    <!-- Animated Container -->
    <div 
        id="{{ $gridId }}" 
        class="grid group-data-[state=minified]/sheet:grid-rows-[1fr]!" 
        :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" 
        :style="{ gridTemplateRows: open ? '1fr' : '0fr' }"
        style="{{ $defaultOpenState ? 'grid-template-rows: 1fr;' : 'grid-template-rows: 0fr;' }}"
    >
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
        } catch(e) {}
    })();
</script>
@endif
