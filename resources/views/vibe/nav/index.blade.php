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
            // Intercept pin clicks in CAPTURE phase so wire:navigate / anchor navigation NEVER triggers
            this.$el.addEventListener('click', (e) => {
                let pinBtn = e.target.closest('[data-nav-pin-btn]');
                if (pinBtn) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();
                    let target = pinBtn.closest('[data-nav-pin-id]');
                    if (target && target.dataset.navPinId) {
                        this.togglePin(target.dataset.navPinId);
                    }
                }
            }, true);

            this.$nextTick(() => {
                let container = this.$el.querySelector('[data-pinned-container]');
                if (!container && !this.pinnable) return;

                // syncValidPinned may prune stale IDs — run it first
                let prevCount = this.pinned.length;
                this.syncValidPinned();
                let wasPruned = this.pinned.length !== prevCount;

                // If anti-FOUC script already populated items correctly AND no IDs were pruned,
                // skip _movePinnedItems() to avoid the remove+re-add FOUC flash.
                let foucCount = container ? parseInt(container.dataset.foucPopulated ?? '-1') : -1;
                let alreadyCorrect = !wasPruned && foucCount === this.pinned.length;

                if (alreadyCorrect) {
                    if (container) container.style.display = this.pinned.length > 0 ? '' : 'none';
                } else {
                    this._movePinnedItems();
                }
            });
        },

        syncValidPinned() {
            let allPinnable = Array.from(this.$el.querySelectorAll('[data-nav-pin-id]:not([data-pinned-shortcut-for]):not([data-nav-group-flyout-content] *)'));
            let validIds = allPinnable.filter(e => !(e.closest('[data-pin-type=group]') && e.dataset.pinType !== 'group')).map(e => e.dataset.navPinId);
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
            } else {
                if (this.maxpin !== null && this.pinned.length >= this.maxpin) return;
                this.pinned = [...this.pinned, id];
            }
            this._movePinnedItems();
            this.saveToStorage();
        },
        isPinned(id) {
            return this.pinned.includes(id);
        },
        _movePinnedItems() {
            let container = this.$el.querySelector('[data-pinned-container]');
            if (!container) return;

            let pinnedWrapper = container.querySelector('[data-pinned-items]');
            if (!pinnedWrapper) return;

            // Remove all existing shortcuts
            pinnedWrapper.querySelectorAll('[data-pinned-shortcut-for]').forEach(el => el.remove());

            // Update data-pinned attribute on all source pinnable items immediately
            let allPinnable = this.$el.querySelectorAll('[data-nav-pin-id]:not([data-pinned-shortcut-for]):not([data-nav-group-flyout-content] *)');
            allPinnable.forEach(el => {
                if (el.closest('[data-pin-type=group]') && el.dataset.pinType !== 'group') return;
                let btn = el.querySelector('[data-nav-pin-btn]');
                if (btn) {
                    let isPinned = this.pinned.includes(el.dataset.navPinId);
                    btn.setAttribute('data-pinned', isPinned ? 'true' : 'false');
                }
            });

            // Build shortcuts for currently pinned items that exist in DOM
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
                        t.classList.remove('bg-accent', 'text-accent-foreground', 'font-semibold');
                        t.classList.add('text-muted-foreground');
                    });

                    let icons = clone.querySelectorAll('[data-pin-icon]');
                    icons.forEach(icon => {
                        icon.classList.remove('text-foreground');
                        icon.classList.add('text-muted-foreground', 'group-hover/nav-item:text-foreground');
                    });

                    // If cloned item is a group, ensure it starts collapsed
                    if (clone.dataset.pinType === 'group') {
                        let grid = clone.querySelector('[id^="nav-group-grid"]');
                        let chevron = clone.querySelector('[id^="nav-group-chevron"]');
                        if (grid) grid.style.gridTemplateRows = '0fr';
                        if (chevron) chevron.style.transform = 'rotate(-90deg)';
                    }

                    // Pre-set pin button state on clone — item in pinned section is ALWAYS pinned.
                    // Uses data-pinned attribute for 100% pure CSS icon and opacity management.
                    let pinBtn = clone.querySelector('[data-nav-pin-btn]');
                    if (pinBtn) {
                        pinBtn.setAttribute('data-pinned', 'true');
                        pinBtn.style.display = '';
                        pinBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            let nav = clone.closest('nav');
                            if (nav && nav._x_dataStack && nav._x_dataStack[0]) {
                                nav._x_dataStack[0].togglePin(el.dataset.navPinId);
                            }
                        }, true);
                    }

                    return clone;
                }
            };
        }

        (function() {
            try {
                let scriptEl = document.currentScript;
                let nav = scriptEl ? scriptEl.closest('nav') : document.getElementById('{{ $navId }}');
                if (!nav) return;

                let container = nav.querySelector('[data-pinned-container]');
                let pinnableNav = {{ $pinnable ? 'true' : 'false' }};
                if (!container && !pinnableNav) return;

                let key = (window.VIBE_PREFIX || 'vibe') + '-nav';
                let stored = localStorage.getItem(key);
                let pinned = [];
                let navId = nav.dataset.navId || nav.id || '{{ $navId }}';
                if (stored) {
                    let data = JSON.parse(stored);
                    if (Array.isArray(data)) {
                        let item = data.find(i => i.id === navId);
                        if (item) pinned = item.pinned || [];
                    }
                }
                
                let allPinnables = nav.querySelectorAll('[data-nav-pin-id]:not([data-pinned-shortcut-for]):not([data-nav-group-flyout-content] *)');
                let validPinnables = Array.from(allPinnables).filter(e => !(e.closest('[data-pin-type=group]') && e.dataset.pinType !== 'group'));
                let validIds = validPinnables.map(e => e.dataset.navPinId);
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
                validPinnables.forEach(el => {
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

                // Clear any existing shortcuts first to guarantee no duplicate
                pinnedWrapper.querySelectorAll('[data-pinned-shortcut-for]').forEach(el => el.remove());

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

        if (!window.__vibeNavFloatingTooltipInit) {
            window.__vibeNavFloatingTooltipInit = true;

            function getFloatingTooltip() {
                let el = document.getElementById('vibe-nav-floating-tooltip');
                if (!el || !document.body.contains(el)) {
                    if (el) el.remove();
                    el = document.createElement('div');
                    el.id = 'vibe-nav-floating-tooltip';
                    el.className = 'fixed pointer-events-none z-[99999] px-2.5 py-1.5 rounded-lg bg-popover text-popover-foreground border border-border text-xs font-medium shadow-xl whitespace-nowrap flex items-center gap-1.5 transition-opacity duration-150 opacity-0';
                    el.style.display = 'none';
                    el.style.top = '0px';
                    el.style.left = '0px';
                    document.body.appendChild(el);
                }
                return el;
            }

            function getFloatingFlyout() {
                let el = document.getElementById('vibe-nav-floating-flyout');
                if (!el || !document.body.contains(el)) {
                    if (el) el.remove();
                    el = document.createElement('div');
                    el.id = 'vibe-nav-floating-flyout';
                    el.className = 'fixed z-[99999] min-w-[120px] w-max max-w-[180px] p-1 rounded-lg bg-popover text-popover-foreground border border-border shadow-xl transition-all duration-150 opacity-0 pointer-events-auto flex flex-col [&_a]:w-full! [&_a]:h-auto! [&_a]:px-2.5! [&_a]:py-1.5! [&_a]:text-xs! [&_a]:font-medium! [&_a]:rounded-md! [&_a]:justify-start! [&_a]:mx-0! [&_a>div]:max-w-[100vw]! [&_a>div]:opacity-100! [&_a>div]:ml-0! [&_a>div]:flex! [&_a>div]:block!';
                    el.style.display = 'none';
                    el.style.top = '0px';
                    el.style.left = '0px';
                    document.body.appendChild(el);

                    el.addEventListener('mouseenter', function() {
                        clearTimeout(flyoutHideTimeout);
                    });

                    el.addEventListener('mouseleave', function() {
                        hideFlyout();
                    });
                }
                return el;
            }

            let currentHovered = null;
            let currentFlyoutTarget = null;
            let flyoutHideTimeout = null;

            function hideTooltip() {
                currentHovered = null;
                let tooltip = getFloatingTooltip();
                tooltip.style.opacity = '0';
                tooltip.style.display = 'none';
            }

            function hideFlyout() {
                clearTimeout(flyoutHideTimeout);
                flyoutHideTimeout = setTimeout(() => {
                    currentFlyoutTarget = null;
                    let flyout = getFloatingFlyout();
                    flyout.style.opacity = '0';
                    setTimeout(() => {
                        if (!currentFlyoutTarget) flyout.style.display = 'none';
                    }, 150);
                }, 150);
            }

            document.addEventListener('mouseover', function(e) {
                let flyoutPanel = e.target.closest('#vibe-nav-floating-flyout');
                if (flyoutPanel) {
                    clearTimeout(flyoutHideTimeout);
                    hideTooltip();
                    return;
                }

                let sheet = e.target.closest('[data-state="minified"]');
                if (!sheet) {
                    hideTooltip();
                    hideFlyout();
                    return;
                }

                // 1. Check if hovering a group trigger in minified mode
                let groupWrapper = e.target.closest('.group\\/group-wrapper, [data-pin-type="group"]');
                let groupTrigger = e.target.closest('[data-nav-group-trigger]');

                if (groupWrapper && (groupTrigger || groupWrapper.contains(e.target))) {
                    let groupContent = groupWrapper.querySelector('[data-nav-group-flyout-content]');
                    if (groupContent) {
                        hideTooltip();
                        clearTimeout(flyoutHideTimeout);

                        let targetBtn = groupTrigger || groupWrapper.querySelector('button') || groupWrapper;
                        if (currentFlyoutTarget !== targetBtn) {
                            currentFlyoutTarget = targetBtn;
                            let flyout = getFloatingFlyout();
                            flyout.innerHTML = groupContent.innerHTML;

                            let rect = targetBtn.getBoundingClientRect();
                            flyout.style.display = 'flex';
                            let topPos = Math.max(8, Math.min(rect.top, window.innerHeight - 300));
                            flyout.style.top = topPos + 'px';
                            flyout.style.left = (rect.right + 10) + 'px';

                            requestAnimationFrame(() => {
                                if (currentFlyoutTarget === targetBtn) {
                                    flyout.style.opacity = '1';
                                }
                            });
                        }
                        return;
                    }
                }

                // 2. Normal Item Tooltip
                let target = e.target.closest('[data-pin-title], [data-nav-tooltip]');
                if (!target || target.closest('[data-nav-group-trigger]') || target.closest('[data-pin-type="group"]')) {
                    return;
                }

                if (target.closest('[data-nav-pin-btn]')) {
                    hideTooltip();
                    return;
                }

                let title = target.dataset.navTooltip || target.dataset.pinTitle;
                if (!title || !title.trim()) return;

                hideFlyout();
                currentHovered = target;
                let tooltip = getFloatingTooltip();
                tooltip.textContent = title.trim();
                let rect = target.getBoundingClientRect();
                tooltip.style.display = 'flex';
                tooltip.style.top = (rect.top + rect.height / 2) + 'px';
                tooltip.style.left = (rect.right + 10) + 'px';
                tooltip.style.transform = 'translateY(-50%)';

                requestAnimationFrame(() => {
                    if (currentHovered === target) {
                        tooltip.style.opacity = '1';
                    }
                });
            });

            document.addEventListener('mouseout', function(e) {
                let target = e.target.closest('[data-pin-title], [data-nav-tooltip]');
                if (target && target === currentHovered) {
                    hideTooltip();
                }

                let groupTrigger = e.target.closest('[data-nav-group-trigger], .group\\/group-wrapper');
                if (groupTrigger && groupTrigger.contains(currentFlyoutTarget)) {
                    hideFlyout();
                }
            });

            window.addEventListener('scroll', function() {
                hideTooltip();
                hideFlyout();
            }, true);

            document.addEventListener('livewire:navigated', function() {
                hideTooltip();
                hideFlyout();
            });
        }
    </script>
</nav>
