@blaze(fold: true)

@props([
    'collapsed' => false,
    'pinnable' => false,
    'maxpin' => null, // optional max number of pinned items
    'id' => null,
])

@php
    $navId = $id ?? $attributes->get('id') ?? 'sidebar-menu';
    $pinnedContainerId = 'vibe-nav-pinned-' . Str::random(6);
@endphp

<nav id="{{ $navId }}" data-nav-id="{{ $navId }}" x-data="(function() {
    var key = (window.VIBE_PREFIX || 'vibe') + '-nav';
    var navId = '{{ $navId }}';
    var pinned = [];
    try { 
        var stored = localStorage.getItem(key);
        if (stored) {
            var data = JSON.parse(stored);
            if (Array.isArray(data)) {
                var item = data.find(i => i.id === navId);
                if (item) pinned = item.pinned || [];
            }
        }
    } catch (e) {}
    return {
        id: navId,
        pinnable: {{ $pinnable ? 'true' : 'false' }},
        maxpin: {{ $maxpin ?? 'null' }},
        pinned: pinned,
        init() {
            this.$nextTick(() => {
                // syncValidPinned may prune stale IDs — run it first
                let prevCount = this.pinned.length;
                this.syncValidPinned();
                let wasPruned = this.pinned.length !== prevCount;

                let nav = document.getElementById('{{ $navId }}');
                let container = nav?.querySelector('[data-pinned-container]');

                // If anti-FOUC script already populated items correctly AND no IDs were pruned,
                // skip _movePinnedItems() to avoid the remove+re-add FOUC flash.
                // The anti-FOUC script sets data-fouc-populated with the count it inserted.
                let foucCount = container ? parseInt(container.dataset.foucPopulated ?? '-1') : -1;
                let alreadyCorrect = !wasPruned && foucCount === this.pinned.length;

                if (alreadyCorrect) {
                    // Items already correct — just ensure visibility
                    if (container) container.style.display = this.pinned.length > 0 ? '' : 'none';
                } else {
                    this._movePinnedItems();
                }
            });
        },

        syncValidPinned() {
            let nav = document.getElementById('{{ $navId }}');
            if (!nav) return;
            let allPinnable = Array.from(nav.querySelectorAll('[data-nav-pin-id]:not([data-pinned-shortcut-for])'));
            let validIds = allPinnable.map(e => e.dataset.navPinId);
            let filtered = this.pinned.filter(id => validIds.includes(id));
            if (filtered.length !== this.pinned.length) {
                this.pinned = filtered;
                this.saveToStorage();
            }
        },
        saveToStorage() {
            let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
            let stored = localStorage.getItem(key);
            let data = [];
            if (stored) {
                try {
                    let parsed = JSON.parse(stored);
                    if (Array.isArray(parsed)) data = parsed;
                } catch (e) {}
            }
            let index = data.findIndex(i => i.id === this.id);
            let existing = index !== -1 ? data[index] : { id: this.id, pinned: [], groups: {}, labels: {} };
            existing.id = this.id;
            existing.pinned = this.pinned;
            if (!existing.groups) existing.groups = {};
            if (!existing.labels) existing.labels = {};

            if (index !== -1) {
                data[index] = existing;
            } else {
                data.push(existing);
            }
            localStorage.setItem(key, JSON.stringify(data));
        },
        togglePin(id) {
            this.syncValidPinned();
            if (this.pinned.includes(id)) {
                this.pinned = this.pinned.filter(p => p !== id);
                this._movePinnedItems();
            } else {
                if (this.maxpin !== null && this.pinned.length >= this.maxpin) return;
                this.pinned.push(id);
                this._movePinnedItems();
            }
            this.saveToStorage();
        },
        isPinned(id) {
            return this.pinned.includes(id);
        },
        _movePinnedItems() {
            let nav = document.getElementById('{{ $navId }}');
            if (!nav) return;
            
            let container = nav.querySelector('[data-pinned-container]');
            if (!container) return;

            let pinnedWrapper = container.querySelector('[data-pinned-items]');
            if (!pinnedWrapper) return;

            // Remove all existing shortcuts
            pinnedWrapper.querySelectorAll('[data-pinned-shortcut-for]').forEach(el => el.remove());

            // Build shortcuts for currently pinned items that exist in DOM
            let allPinnable = nav.querySelectorAll('[data-nav-pin-id]:not([data-pinned-shortcut-for])');
            let actualCount = 0;
            this.pinned.forEach(id => {
                let el = Array.from(allPinnable).find(e => e.dataset.navPinId === id);
                if (el && window.VibeNavBuilder) {
                    pinnedWrapper.appendChild(window.VibeNavBuilder.buildShortcut(el));
                    actualCount++;
                }
            });

            container.style.display = actualCount > 0 ? '' : 'none';
        }
    };
})()" {{ $attributes->twMerge(['class' => 'flex flex-col gap-1 w-full']) }} @if ($collapsed)
    data-collapsed="true"
    @endif>

    {{ $slot }}

    <script>
        if (!window.VibeNavBuilder) {
            window.VibeNavBuilder = {
                buildShortcut: function(el) {
                    let clone = el.cloneNode(true);
                    clone.dataset.pinnedShortcutFor = el.dataset.navPinId;

                    // Reset active state on shortcut clones
                    let targets = [clone, ...clone.querySelectorAll('a, button')];
                    targets.forEach(t => {
                        t.classList.remove('bg-vibe-200', 'dark:bg-vibe-800', 'text-vibe-950', 'dark:text-vibe-50');
                        t.classList.add('text-vibe-600', 'dark:text-vibe-400');
                    });

                    let icons = clone.querySelectorAll('[data-pin-icon]');
                    icons.forEach(icon => {
                        icon.classList.remove('text-vibe-900', 'dark:text-vibe-100');
                        icon.classList.add('text-vibe-500', 'group-hover/nav-item:text-vibe-900', 'dark:text-vibe-400', 'dark:group-hover/nav-item:text-vibe-200');
                    });

                    // Pre-set pin button state on clone — item in pinned section is ALWAYS pinned.
                    // Uses data-pinned attribute for 100% pure CSS icon and opacity management.
                    let pinBtn = clone.querySelector('[data-nav-pin-btn]');
                    if (pinBtn) {
                        pinBtn.setAttribute('data-pinned', 'true');
                        pinBtn.style.display = '';
                    }

                    return clone;
                }
            };
        }

        (function() {
            try {
                let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                let stored = localStorage.getItem(key);
                let pinned = [];
                if (stored) {
                    let data = JSON.parse(stored);
                    if (Array.isArray(data)) {
                        let item = data.find(i => i.id === '{{ $navId }}');
                        if (item) pinned = item.pinned || [];
                    }
                }
                let nav = document.getElementById('{{ $navId }}');
                if (!nav) return;
                
                let container = nav.querySelector('[data-pinned-container]');
                let allPinnables = nav.querySelectorAll('[data-nav-pin-id]:not([data-pinned-shortcut-for])');
                let validIds = Array.from(allPinnables).map(e => e.dataset.navPinId);
                let validPinned = pinned.filter(id => validIds.includes(id));
                
                // 1. Fix FOUC for pinned count
                if (container) {
                    let maxpin = {{ $maxpin ?? 'null' }};
                    if (maxpin) {
                        let countEl = container.querySelector('[x-text*="pinned.length"]');
                        if (countEl) countEl.textContent = validPinned.length + ' / ' + maxpin;
                    }
                }

                // 2. Pre-set pin button state using data-pinned attribute
                let pinnableNav = {{ $pinnable ? 'true' : 'false' }};
                allPinnables.forEach(el => {
                    let btn = el.querySelector('[data-nav-pin-btn]');
                    if (btn) {
                        let isPinned = validPinned.includes(el.dataset.navPinId);
                        btn.setAttribute('data-pinned', isPinned ? 'true' : 'false');
                        if (pinnableNav) {
                            btn.style.display = '';
                        }
                    }
                });

                if (!container) return;

                // Mark with count=0 so Alpine init() knows script ran with 0 items
                container.dataset.foucPopulated = '0';

                if (!validPinned.length) return;

                let pinnedWrapper = container.querySelector('[data-pinned-items]');
                if (!pinnedWrapper) return;

                let insertedCount = 0;
                validPinned.forEach(id => {
                    let el = Array.from(allPinnables).find(e => e.dataset.navPinId === id);
                    if (el && window.VibeNavBuilder) {
                        pinnedWrapper.appendChild(window.VibeNavBuilder.buildShortcut(el));
                        insertedCount++;
                    }
                });

                // Tell Alpine how many items were inserted — used to skip _movePinnedItems() on init
                container.dataset.foucPopulated = String(insertedCount);
                container.style.display = insertedCount > 0 ? '' : 'none';

            } catch (e) {}
        })();
    </script>
</nav>
