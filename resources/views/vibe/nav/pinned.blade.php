@blaze(fold: true)

@props([
    'title' => 'PINNED',
    'open' => true,
    'persist' => true,
    'id' => null,
])

@php
    $labelId = $id ?? '_pinned';
    $pinnedContainerId = 'vibe-nav-pinned-' . Str::random(6);
    $gridId = 'nav-pinned-grid-' . Str::random(6);
    $chevronId = 'nav-pinned-chevron-' . Str::random(6);
@endphp

{{--
    Komponen dedicated untuk pinned container.
    Anti-FOUC dilakukan oleh script di index.blade.php (nav parent) yang me-clone
    DOM item yang sudah ada dan memasukkannya ke [data-pinned-items].
    Komponen ini hanya mendeklarasikan struktur container + persist open/closed state.
--}}
<div
    id="{{ $pinnedContainerId }}"
    data-pinned-container
    style="display: none;"
    {{ $attributes->twMerge(['class' => 'w-full flex flex-col gap-1 group-data-[state=minified]/sheet:border-none']) }}
    x-data="(function() {
        var defaultOpen = {{ $open ? 'true' : 'false' }};
        @if ($persist) try {
                 var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                 var stored = localStorage.getItem(key);
                 if (stored) {
                     var data = JSON.parse(stored);
                     if (Array.isArray(data)) {
                         var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                         var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                         var navItem = data.find(i => i.id === navId);
                         if (navItem && navItem.labels && navItem.labels['{{ $labelId }}'] !== undefined) {
                             defaultOpen = navItem.labels['{{ $labelId }}'];
                         }
                     }
                 }
             } catch(e) {} @endif
        return {
            open: defaultOpen,
            ready: false,
            init() {
                @if ($persist)
                let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                this.$watch('open', val => {
                    let stored = localStorage.getItem(key);
                    let data = [];
                    if (stored) {
                        try {
                            let parsed = JSON.parse(stored);
                            if (Array.isArray(parsed)) data = parsed;
                        } catch(e) {}
                    }
                    let navEl = this.$el.closest('nav');
                    let navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
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
                });
                @endif
                this.$nextTick(() => { this.ready = true; });
            }
        };
    })()"
>
    {{-- Label / Toggle Header --}}
    <button
        type="button"
        @click="open = !open"
        class="minified:hidden! flex items-center gap-2 w-full py-1.5 text-[11px] font-semibold text-vibe-700 uppercase tracking-wider hover:text-vibe-950 dark:text-vibe-300 dark:hover:text-vibe-100 transition-colors group/nav-label cursor-pointer select-none"
    >
        
        {{-- Chevron --}}
        <svg
            id="{{ $chevronId }}"
            class="size-3"
            :class="ready ? 'transition-transform duration-300' : ''"
            style="transform: {{ $open ? 'none' : 'rotate(-90deg)' }};"
            x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        >
            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5695 8.51192C19.839 8.82641 19.8026 9.29989 19.4881 9.56946L12.4881 15.5695C12.2072 15.8102 11.7928 15.8102 11.5119 15.5695L4.51192 9.56946C4.19743 9.29989 4.161 8.82641 4.43057 8.51192C4.70014 8.19743 5.17361 8.161 5.48811 8.43057L12 14.0122L18.5119 8.43057C18.8264 8.161 19.2999 8.19743 19.5695 8.51192Z" fill="currentColor" />
        </svg>

        <div class="flex items-center gap-1 justify-between w-full">
            <span class="whitespace-nowrap">{{ $title }}</span>
            {{-- Counter pinned count / maxpin — diisi oleh anti-FOUC script di index.blade.php --}}
            <span
                x-show="typeof maxpin !== 'undefined' && maxpin"
                x-text="(typeof pinned !== 'undefined' ? pinned.length : 0) + ' / ' + maxpin"
                class="font-normal normal-case tracking-normal text-vibe-400 mr-2"
            ></span>
        </div>
    </button>

    {{-- Animated Container --}}
    <div
        id="{{ $gridId }}"
        class="grid group-data-[state=minified]/sheet:grid-rows-[1fr]!"
        :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''"
        style="grid-template-rows: {{ $open ? '1fr' : '0fr' }};"
        x-bind:style="`grid-template-rows: ${open ? '1fr' : '0fr'}`"
    >
        <div class="overflow-hidden group-data-[state=minified]/sheet:overflow-visible min-h-0">
            {{-- data-pinned-items: digunakan oleh index.blade.php anti-FOUC script
                 untuk meng-inject clone pinned item sebelum Alpine aktif --}}
            <div data-pinned-items class="flex flex-col gap-1 pb-1"></div>
        </div>
    </div>
</div>

@if ($persist)
<script>
    (function() {
        try {
            var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
            var stored = localStorage.getItem(key);
            var defaultOpen = {{ $open ? 'true' : 'false' }};
            var savedOpen = defaultOpen;

            if (stored) {
                var data = JSON.parse(stored);
                if (Array.isArray(data)) {
                    var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                    var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                    var navItem = data.find(i => i.id === navId);
                    if (navItem && navItem.labels && navItem.labels['{{ $labelId }}'] !== undefined) {
                        savedOpen = navItem.labels['{{ $labelId }}'];
                    }
                }
            }

            // Apply correct state immediately — BEFORE container becomes visible
            // This ensures Alpine finds DOM already in correct state → no FOUC on expand
            var grid = document.getElementById('{{ $gridId }}');
            var chevron = document.getElementById('{{ $chevronId }}');
            if (grid) grid.style.gridTemplateRows = savedOpen ? '1fr' : '0fr';
            if (chevron) chevron.style.transform = savedOpen ? 'none' : 'rotate(-90deg)';
        } catch(e) {}
    })();
</script>
@else
<script>
    (function() {
        // No persist: apply default open state immediately to prevent FOUC
        var grid = document.getElementById('{{ $gridId }}');
        var chevron = document.getElementById('{{ $chevronId }}');
        var open = {{ $open ? 'true' : 'false' }};
        if (grid) grid.style.gridTemplateRows = open ? '1fr' : '0fr';
        if (chevron) chevron.style.transform = open ? 'none' : 'rotate(-90deg)';
    })();
</script>
@endif

