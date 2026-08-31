@blaze(fold: true)

@props([
    'title' => __('vibe/nav.history'),
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
        clearAllHistory() {
            try {
                var prefix = window.VIBE_PREFIX || 'vibe';
                localStorage.removeItem(prefix + '-page-history');
                if (window.Alpine && window.Alpine.store('vibeHistory')) {
                    window.Alpine.store('vibeHistory').items = [];
                }
                this.renderHistory();
            } catch(e) {}
        },
        renderHistory() {
            try {
                var prefix = window.VIBE_PREFIX || 'vibe';
                var raw = localStorage.getItem(prefix + '-page-history');
                var items = [];
                if (raw) { var p = JSON.parse(raw); if (Array.isArray(p)) items = p; }

                // Deduplicate items by URL
                var seen = new Set();
                items = items.filter(function(item) {
                    if (!item || !item.url) return false;
                    if (seen.has(item.url)) return false;
                    seen.add(item.url);
                    return true;
                });

                items = items.slice(0, this.maxHistory);
                var wrapper = document.getElementById('{{ $itemsId }}');
                var container = document.getElementById('{{ $historyId }}');
                var currentUrl = window.location.pathname + window.location.search;
                var self = this;
                if (window.VibeHistoryBuilder && wrapper) {
                    window.VibeHistoryBuilder.render(wrapper, items, currentUrl, function() {
                        self.renderHistory();
                    });
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
    <div class="minified:hidden! flex items-center justify-between w-full py-1 text-[11px] font-semibold text-muted-foreground uppercase tracking-wider group/nav-label select-none">
        <button type="button" @click="open = !open" class="flex items-center gap-2 hover:text-foreground cursor-pointer flex-1 min-w-0">
            <svg id="{{ $chevronId }}" class="size-3 shrink-0" :class="ready ? 'transition-transform duration-300' : ''" style="transform: {{ $open ? 'none' : 'rotate(-90deg)' }};" x-bind:style="`transform: ${open ? 'none' : 'rotate(-90deg)'}`" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
            <span class="whitespace-nowrap truncate">{{ $title }}</span>
        </button>

        <div class="flex items-center justify-end shrink-0 pr-2">
            <!-- Trash icon (shown on hover) -->
            <button type="button" @click.stop="clearAllHistory()" title="{{ __('vibe/nav.clear_history') }}" class="hidden group-hover/nav-label:inline-flex items-center justify-center size-6 hover:text-red-500 rounded cursor-pointer">
                <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18m-2 0v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
            </button>
            <!-- Counter (hidden on hover) -->
            <span data-history-counter x-show="maxHistory > 0" x-text="itemCount + ' / ' + maxHistory" class="group-hover/nav-label:hidden font-normal normal-case tracking-normal text-muted-foreground text-[10px]"></span>
        </div>
    </div>

    {{-- Animated Grid Container --}}
    <div id="{{ $gridId }}" class="grid group-data-[state=minified]/sheet:grid-rows-[1fr]!" :class="ready ? 'transition-[grid-template-rows] duration-300 ease-in-out' : ''" style="grid-template-rows: {{ $open ? '1fr' : '0fr' }};" x-bind:style="`grid-template-rows: ${open ? '1fr' : '0fr'}`">
        <div class="overflow-hidden group-data-[state=minified]/sheet:overflow-visible min-h-0">
            <div id="{{ $itemsId }}" class="flex flex-col gap-0.5 pb-1"></div>
        </div>
    </div>
</div>

<script>
    if (!window.VibeHistoryBuilder) {
        window.VibeHistoryBuilder = {
            clockSvg: '<svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
            render: function(wrapper, items, currentUrl, onDeleted) {
                if (!wrapper) return;
                wrapper.innerHTML = '';
                var minCls = 'group-data-[state=minified]/sheet:w-11 group-data-[state=minified]/sheet:h-11 group-data-[state=minified]/sheet:rounded-lg group-data-[state=minified]/sheet:px-0 group-data-[state=minified]/sheet:justify-center group-data-[state=minified]/sheet:mx-auto';
                items.forEach(function(item) {
                    var isActive = currentUrl === item.url;
                    var a = document.createElement('a');
                    a.href = item.url;
                    a.dataset.pinTitle = item.title || item.url;
                    a.dataset.navTooltip = item.title || item.url;
                    a.className = 'flex items-center px-2.5 py-1.5 rounded-md text-xs font-medium w-full relative group/nav-item cursor-pointer ' + minCls + ' ' +
                        (isActive ? 'bg-accent text-accent-foreground font-semibold'
                                  : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground');

                    a.addEventListener('click', function(e) {
                        if (e.target.closest('[data-history-delete]')) {
                            return;
                        }
                        e.preventDefault();
                        if (window.Livewire && window.Livewire.navigate) {
                            window.Livewire.navigate(item.url);
                        } else {
                            window.location.href = item.url;
                        }
                    });

                    var iconSpan = document.createElement('span');
                    iconSpan.className = 'shrink-0 flex items-center justify-center size-4 text-muted-foreground group-hover/nav-item:text-foreground';
                    iconSpan.innerHTML = item.icon || window.VibeHistoryBuilder.clockSvg;
                    a.appendChild(iconSpan);

                    var labelDiv = document.createElement('div');
                    labelDiv.className = 'flex flex-1 min-w-0 w-full items-center overflow-hidden max-w-[100vw] opacity-100 ml-2.5 group-data-[state=minified]/sheet:hidden';
                    var labelSpan = document.createElement('span');
                    labelSpan.className = 'whitespace-nowrap truncate text-xs';
                    labelSpan.textContent = item.title || item.url;
                    labelDiv.appendChild(labelSpan);
                    a.appendChild(labelDiv);

                    // Delete single item button (visible on hover)
                    var delBtn = document.createElement('button');
                    delBtn.type = 'button';
                    delBtn.setAttribute('data-history-delete', 'true');
                    delBtn.title = 'Remove from history';
                    delBtn.className = 'opacity-0 group-hover/nav-item:inline-flex items-center justify-center size-6 rounded hover:bg-accent text-muted-foreground hover:text-foreground shrink-0 ml-1 group-data-[state=minified]/sheet:hidden cursor-pointer';
                    delBtn.innerHTML = '<svg class="size-3 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>';
                    
                    var handleDelete = function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                        try {
                            var prefix = window.VIBE_PREFIX || 'vibe';
                            var raw = localStorage.getItem(prefix + '-page-history');
                            if (raw) {
                                var all = JSON.parse(raw);
                                if (Array.isArray(all)) {
                                    all = all.filter(function(h) { return h.url !== item.url; });
                                    localStorage.setItem(prefix + '-page-history', JSON.stringify(all));
                                    if (window.Alpine && window.Alpine.store('vibeHistory')) {
                                        window.Alpine.store('vibeHistory').items = all;
                                    }
                                }
                            }
                            if (typeof onDeleted === 'function') onDeleted();
                        } catch(err) {}
                    };

                    delBtn.addEventListener('click', handleDelete, true);
                    delBtn.addEventListener('mousedown', function(e) { e.stopPropagation(); }, true);
                    a.appendChild(delBtn);

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

            // Deduplicate items by URL
            var seen = new Set();
            items = items.filter(function(item) {
                if (!item || !item.url) return false;
                if (seen.has(item.url)) return false;
                seen.add(item.url);
                return true;
            });

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
