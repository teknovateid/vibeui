@blaze(fold: true)

@props([
    'title' => 'RECENTLY VISITED',
    'open' => true,
    'persist' => true,
])

@php
    $historyId = 'vibe-nav-history-' . Str::random(6);
    $gridId = 'nav-history-grid-' . Str::random(6);
    $chevronId = 'nav-history-chevron-' . Str::random(6);
    $itemsId = 'nav-history-items-' . Str::random(6);
@endphp

<div id="{{ $historyId }}" data-history-container style="display: none;" {{ $attributes->twMerge(['class' => 'w-full flex flex-col gap-1 group-data-[state=minified]/sheet:border-none']) }} x-data="(function() {
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
                     if (navItem && navItem.labels && navItem.labels['_history'] !== undefined) {
                         defaultOpen = navItem.labels['_history'];
                     }
                 }
             }
         } catch(e) {} @endif
    return {
        open: defaultOpen,
        ready: false,
        itemCount: 0,
        maxHistory: 10,
        init() {
            try {
                this.maxHistory = (window.VIBE_HISTORY_CONFIG || {}).display_limit ?? 10;
            } catch(e) {}

            var container = document.getElementById('{{ $historyId }}');
            var foucPopulated = container ? parseInt(container.dataset.foucPopulated ?? '-1') : -1;

            // If anti-FOUC script already rendered the items, do NOT re-render on init → zero flicker!
            if (foucPopulated >= 0) {
                this.itemCount = foucPopulated;
            } else {
                this.renderHistory();
            }

            this.$nextTick(() => { this.ready = true; });

            @if ($persist)
            let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
            this.$watch('open', val => {
                let stored = localStorage.getItem(key);
                let data = [];
                if (stored) { try { let p = JSON.parse(stored); if (Array.isArray(p)) data = p; } catch(e) {} }
                let navEl = this.$el.closest('nav');
                let navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                let index = data.findIndex(i => i.id === navId);
                let existing = index !== -1 ? data[index] : { id: navId, pinned: [], groups: {}, labels: {} };
                if (!existing.labels) existing.labels = {};
                existing.labels['_history'] = val;
                if (index !== -1) { data[index] = existing; } else { data.push(existing); }
                localStorage.setItem(key, JSON.stringify(data));
            });
            @endif

            window.addEventListener('vibeHistory:updated', () => { this.renderHistory(); });
            this.$watch(() => {
                try { return window.Alpine.store('vibeHistory')?.items?.length; } catch(e) { return 0; }
            }, () => { this.renderHistory(); });
        },
        renderHistory() {
            try {
                var prefix = window.VIBE_PREFIX || 'vibe';
                var raw = localStorage.getItem(prefix + '-page-history');
                var items = [];
                if (raw) { var p = JSON.parse(raw); if (Array.isArray(p)) items = p; }
                items = items.slice(0, this.maxHistory);
                var wrapper = document.getElementById('{{ $itemsId }}');
                var container = document.getElementById('{{ $historyId }}');
                var currentUrl = window.location.pathname + window.location.search;
                if (window.VibeHistoryBuilder && wrapper) {
                    window.VibeHistoryBuilder.render(wrapper, items, currentUrl);
                }
                this.itemCount = items.length;
                if (container) {
                    container.style.display = items.length > 0 ? '' : 'none';
                    container.dataset.foucPopulated = String(items.length);
                }
            } catch(e) {
                this.itemCount = 0;
            }
        }
    };
})()">
    {{-- Label / Toggle Header --}}
    <button type="button" @click="open = !open" class="minified:hidden! flex items-center gap-2 w-full py-1.5 text-[11px] font-semibold text-vibe-700 uppercase tracking-wider hover:text-vibe-950 dark:text-vibe-300 dark:hover:text-vibe-100 transition-colors group/nav-label cursor-pointer select-none">
        <svg id="{{ $chevronId }}" class="size-3" :class="ready ? 'transition-transform duration-300' : ''" style="transform: {{ $open ? 'none' : 'rotate(-90deg)' }};" x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5695 8.51192C19.839 8.82641 19.8026 9.29989 19.4881 9.56946L12.4881 15.5695C12.2072 15.8102 11.7928 15.8102 11.5119 15.5695L4.51192 9.56946C4.19743 9.29989 4.161 8.82641 4.43057 8.51192C4.70014 8.19743 5.17361 8.161 5.48811 8.43057L12 14.0122L18.5119 8.43057C18.8264 8.161 19.2999 8.19743 19.5695 8.51192Z" fill="currentColor" />
        </svg>
        <div class="flex items-center gap-1 justify-between w-full">
            <span class="whitespace-nowrap">{{ $title }}</span>
            <span data-history-counter x-show="maxHistory > 0" x-text="itemCount + ' / ' + maxHistory" class="font-normal normal-case tracking-normal text-vibe-400 mr-2"></span>
        </div>
    </button>

    {{-- Animated Grid Container --}}
    <div id="{{ $gridId }}" class="grid group-data-[state=minified]/sheet:grid-rows-[1fr]!" :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" style="grid-template-rows: {{ $open ? '1fr' : '0fr' }};" x-bind:style="`grid-template-rows: ${open ? '1fr' : '0fr'}`">
        <div class="overflow-hidden group-data-[state=minified]/sheet:overflow-visible min-h-0">
            <div id="{{ $itemsId }}" class="flex flex-col gap-1 pb-1"></div>
        </div>
    </div>
</div>

<script>
    if (!window.VibeHistoryBuilder) {
        window.VibeHistoryBuilder = {
            clockSvg: '<svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
            render: function(wrapper, items, currentUrl) {
                if (!wrapper) return;
                wrapper.innerHTML = '';
                var minCls = 'group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto group-data-[state=minified]/sheet:overflow-visible';
                items.forEach(function(item) {
                    var isActive = currentUrl === item.url;
                    var a = document.createElement('a');
                    a.href = item.url;
                    a.setAttribute('wire:navigate', '');
                    a.className = 'flex items-center px-3 py-2 rounded-lg text-sm font-medium w-full relative group/nav-item cursor-pointer ' + minCls + ' ' +
                        (isActive ? 'bg-vibe-200 dark:bg-vibe-800 text-vibe-950 dark:text-vibe-50'
                                  : 'text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-vibe-950 dark:hover:text-vibe-50');

                    a.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (window.Livewire && window.Livewire.navigate) {
                            window.Livewire.navigate(item.url);
                        } else {
                            window.location.href = item.url;
                        }
                    });

                    var iconSpan = document.createElement('span');
                    iconSpan.className = 'shrink-0 flex items-center justify-center size-5 text-vibe-500 group-hover/nav-item:text-vibe-900 dark:text-vibe-400 dark:group-hover/nav-item:text-vibe-200';
                    iconSpan.innerHTML = item.icon || window.VibeHistoryBuilder.clockSvg;
                    a.appendChild(iconSpan);

                    var labelDiv = document.createElement('div');
                    labelDiv.className = 'flex flex-1 min-w-0 w-full items-center overflow-hidden max-w-[100vw] opacity-100 ml-3 group-data-[state=minified]/sheet:hidden';
                    var labelSpan = document.createElement('span');
                    labelSpan.className = 'whitespace-nowrap truncate text-sm';
                    labelSpan.textContent = item.title || item.url;
                    labelDiv.appendChild(labelSpan);
                    a.appendChild(labelDiv);

                    var tooltip = document.createElement('div');
                    tooltip.className = 'hidden group-data-[state=minified]/sheet:flex opacity-0 group-hover/nav-item:opacity-100 pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 px-2.5 py-1.5 rounded-lg bg-vibe-50 dark:bg-vibe-900 text-vibe-900 dark:text-vibe-100 border border-vibe-200 dark:border-vibe-800 text-xs font-medium shadow-xl whitespace-nowrap items-center gap-1.5 transition-opacity duration-150';
                    var tooltipSpan = document.createElement('span');
                    tooltipSpan.textContent = item.title || item.url;
                    tooltip.appendChild(tooltipSpan);
                    a.appendChild(tooltip);

                    wrapper.appendChild(a);
                });
            }
        };
    }

    (function() {
        try {
            var prefix = window.VIBE_PREFIX || 'vibe';
            var cfg = window.VIBE_HISTORY_CONFIG || {};
            var maxHistory = cfg.display_limit ?? 10;

            var raw = localStorage.getItem(prefix + '-page-history');
            if (!raw) return;
            var items = JSON.parse(raw);
            if (!Array.isArray(items) || items.length === 0) return;
            items = items.slice(0, maxHistory);

            var container = document.getElementById('{{ $historyId }}');
            var wrapper = document.getElementById('{{ $itemsId }}');
            if (!container || !wrapper) return;

            var currentUrl = window.location.pathname + window.location.search;
            if (window.VibeHistoryBuilder) {
                window.VibeHistoryBuilder.render(wrapper, items, currentUrl);
            }

            // Counter (anti-FOUC untuk teks "X / max")
            var counter = container.querySelector('[data-history-counter]');
            if (counter) counter.textContent = items.length + ' / ' + maxHistory;

            // Tampilkan container — items sudah ada, zero flash
            container.dataset.foucPopulated = String(items.length);
            container.style.display = '';

            // Restore open/closed state
            @if ($persist)
            try {
                var navKey = prefix + '-nav';
                var navStored = localStorage.getItem(navKey);
                if (navStored) {
                    var navData = JSON.parse(navStored);
                    if (Array.isArray(navData)) {
                        var navEl = document.getElementById('{{ $gridId }}')?.closest('nav');
                        var navId = navEl ? (navEl.dataset.navId || navEl.id) : 'sidebar-menu';
                        var navItem = navData.find(function(i) { return i.id === navId; });
                        if (navItem && navItem.labels && navItem.labels['_history'] !== undefined) {
                            var saved = navItem.labels['_history'];
                            var grid = document.getElementById('{{ $gridId }}');
                            var chevron = document.getElementById('{{ $chevronId }}');
                            if (saved === false && grid) {
                                grid.style.gridTemplateRows = '0fr';
                                if (chevron) chevron.style.transform = 'rotate(-90deg)';
                            } else if (saved === true && grid) {
                                grid.style.gridTemplateRows = '1fr';
                                if (chevron) chevron.style.transform = 'none';
                            }
                        }
                    }
                }
            } catch(e2) {}
            @endif

        } catch(e) {}
    })();
</script>
