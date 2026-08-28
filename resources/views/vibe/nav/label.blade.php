@blaze(fold: true)

@props(['title', 'persist' => false, 'id' => null, 'active' => false, 'open' => true, 'pinnable' => false, 'pinnedContainer' => false])

@php
    $labelId = $id ?? Str::slug($title);
    $gridId = 'nav-label-grid-' . Str::random(6);
    $chevronId = 'nav-label-chevron-' . Str::random(6);
@endphp

<div {{ $attributes->twMerge(['class' => 'w-full flex flex-col gap-1 group-data-[state=minified]/sheet:border-none']) }} @if ($pinnedContainer) data-pinned-container style="display: none;" @endif x-data="(function() {
    var defaultOpen = {{ $active || $open ? 'true' : 'false' }};
    @if ($persist) try {
             var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
             var stored = localStorage.getItem(key);
             if (stored) {
                 var data = JSON.parse(stored);
                 if (Array.isArray(data)) {
                     var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                     var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                     var navItem = data.find(i => i.id === navId);
                     if (navItem && navItem.labels && navItem.labels['{{ $labelId }}'] !== undefined && !{{ $active ? 'true' : 'false' }}) {
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
                         } catch (e) {}
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
})()">
    <button type="button" @click="open = !open" class="minified:hidden! flex items-center gap-2 w-full py-1.5 text-[11px] font-semibold text-vibe-700 uppercase tracking-wider hover:text-vibe-950 dark:text-vibe-300 dark:hover:text-vibe-100 transition-colors group/nav-label cursor-pointer select-none">
        <div>
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

            <svg id="{{ $chevronId }}" class="size-3" :class="ready ? 'transition-transform duration-300' : ''" style="transform: {{ $active || $open ? 'none' : 'rotate(-90deg)' }};" x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5695 8.51192C19.839 8.82641 19.8026 9.29989 19.4881 9.56946L12.4881 15.5695C12.2072 15.8102 11.7928 15.8102 11.5119 15.5695L4.51192 9.56946C4.19743 9.29989 4.161 8.82641 4.43057 8.51192C4.70014 8.19743 5.17361 8.161 5.48811 8.43057L12 14.0122L18.5119 8.43057C18.8264 8.161 19.2999 8.19743 19.5695 8.51192Z" fill="currentColor" />
            </svg>
        </div>
        <div class="flex items-center gap-1 justify-between w-full">
            <span class="whitespace-nowrap">{{ $title }}</span>
             @if ($pinnedContainer)
                <span x-show="typeof maxpin !== 'undefined' && maxpin" x-text="(typeof pinned !== 'undefined' ? pinned.length : 0) + ' / ' + maxpin" class="font-normal normal-case tracking-normal text-vibe-400 mr-2"></span>
            @endif
        </div>
    </button>

    <!-- Animated Container -->
    <div id="{{ $gridId }}" class="grid group-data-[state=minified]/sheet:grid-rows-[1fr]!" :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" style="grid-template-rows: {{ $active || $open ? '1fr' : '0fr' }};" x-bind:style="`grid-template-rows: ${open ? '1fr' : '0fr'}`">
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
            if (stored) {
                var data = JSON.parse(stored);
                if (Array.isArray(data)) {
                    var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                    var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                    var navItem = data.find(i => i.id === navId);
                    if (navItem && navItem.labels && navItem.labels['{{ $labelId }}'] !== undefined) {
                        var saved = navItem.labels['{{ $labelId }}'];
                        if (saved === false && !{{ $active ? 'true' : 'false' }}) {
                            document.getElementById('{{ $gridId }}').style.gridTemplateRows = '0fr';
                            var chevron = document.getElementById('{{ $chevronId }}');
                            if (chevron) chevron.style.transform = 'rotate(-90deg)';
                        } else if (saved === true) {
                            document.getElementById('{{ $gridId }}').style.gridTemplateRows = '1fr';
                            var chevron = document.getElementById('{{ $chevronId }}');
                            if (chevron) chevron.style.transform = 'none';
                        }
                    }
                }
            }
        } catch(e) {}
    })();
</script>
@endif
