@blaze(fold: true)

@props([
    'collapsed' => false,
    'pinnable' => false,
    'maxpin' => null, // optional max number of pinned items
])

@php
    $navId = 'vibe-nav-' . Str::random(8);
    $pinnedContainerId = 'vibe-nav-pinned-' . Str::random(6);
@endphp

<nav id="{{ $navId }}" x-data="(function() {
    var prefix = window.VIBE_PREFIX || 'vibe';
    var navKey = prefix + '-nav';
    var pinned = [];
    try { 
        var state = JSON.parse(localStorage.getItem(navKey) || '{}');
        pinned = state.pinned || [];
    } catch (e) {}
    return {
        pinnable: {{ $pinnable ? 'true' : 'false' }},
        maxpin: {{ $maxpin ?? 'null' }},
        pinned: pinned,
        init() {},
        togglePin(id) {
            if (this.pinned.includes(id)) {
                this.pinned = this.pinned.filter(p => p !== id);
                this._movePinnedItems();
            } else {
                if (this.maxpin !== null && this.pinned.length >= this.maxpin) return;
                this.pinned.push(id);
                this._movePinnedItems();
            }
            let prefix = window.VIBE_PREFIX || 'vibe';
            let navKey = prefix + '-nav';
            let state = { pinned: [], groups: {}, labels: {} };
            try { state = Object.assign(state, JSON.parse(localStorage.getItem(navKey) || '{}')); } catch(e) {}
            state.pinned = this.pinned;
            localStorage.setItem(navKey, JSON.stringify(state));
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

            // Build shortcuts for currently pinned items
            this.pinned.forEach(id => {
                let allPinnable = nav.querySelectorAll('[data-nav-pin-id]');
                let el = Array.from(allPinnable).find(e => e.dataset.navPinId === id);
                if (el && window.VibeNavBuilder) {
                    pinnedWrapper.appendChild(window.VibeNavBuilder.buildShortcut(el));
                }
            });

            container.style.display = this.pinned.length > 0 ? '' : 'none';
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
                    return clone;
                }
            };
        }

        (function() {
            try {
                let prefix = window.VIBE_PREFIX || 'vibe';
                let navKey = prefix + '-nav';
                let state = JSON.parse(localStorage.getItem(navKey) || '{}');
                let pinned = state.pinned || [];
                let nav = document.getElementById('{{ $navId }}');
                if (!nav) return;
                
                let container = nav.querySelector('[data-pinned-container]');
                
                // 1. Fix FOUC for pinned count
                if (container) {
                    let maxpin = {{ $maxpin ?? 'null' }};
                    if (maxpin) {
                        let countEl = container.querySelector('[x-text*="pinned.length"]');
                        if (countEl) countEl.textContent = pinned.length + ' / ' + maxpin;
                    }
                }

                // 2. Fix FOUC for pin buttons
                let pinnableNav = {{ $pinnable ? 'true' : 'false' }};
                let allPinnables = nav.querySelectorAll('[data-nav-pin-id]');
                allPinnables.forEach(el => {
                    let isGroup = el.dataset.pinType === 'group';
                    let parentGroup = el.parentElement.closest('[data-pin-type="group"]');
                    let isChildOfGroup = !isGroup && parentGroup !== null;
                    
                    let btn = el.querySelector('[title="Pin"]');
                    if (btn) {
                        let isPinnableItem = btn.getAttribute('x-show').includes('true'); // from $pinnable prop if explicitly set
                        let pinnable = pinnableNav || isPinnableItem;
                        if (isChildOfGroup || !pinnable) {
                            btn.style.display = 'none';
                        } else {
                            btn.style.display = '';
                            let isPinned = pinned.includes(el.dataset.navPinId);
                            let svgs = btn.querySelectorAll('svg');
                            if (isPinned) {
                                btn.className = "p-1 rounded hover:bg-black/10 dark:hover:bg-white/10 transition-all duration-150 text-vibe-900 dark:text-vibe-100 opacity-100";
                                if(svgs[0]) svgs[0].style.display = '';
                                if(svgs[1]) svgs[1].style.display = 'none';
                            } else {
                                btn.className = "p-1 rounded hover:bg-black/10 dark:hover:bg-white/10 transition-all duration-150 text-vibe-400 opacity-0 group-hover/nav-item:opacity-100 group-hover/nav-item:text-vibe-600 dark:group-hover/nav-item:text-vibe-400";
                                if(svgs[0]) svgs[0].style.display = 'none';
                                if(svgs[1]) svgs[1].style.display = '';
                            }
                        }
                    }
                });

                if (!container || !pinned.length) return;

                let pinnedWrapper = container.querySelector('[data-pinned-items]');
                if (!pinnedWrapper) return;

                pinned.forEach(id => {
                    let allPinnable = nav.querySelectorAll('[data-nav-pin-id]');
                    let el = Array.from(allPinnable).find(e => e.dataset.navPinId === id);
                    if (el && window.VibeNavBuilder) {
                        pinnedWrapper.appendChild(window.VibeNavBuilder.buildShortcut(el));
                    }
                });

                container.style.display = '';
            } catch (e) {}
        })();
    </script>
</nav>
