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
    var pinned = [];
    try { pinned = JSON.parse(localStorage.getItem(prefix + '_nav_pinned') || '[]'); } catch (e) {}
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
            localStorage.setItem(prefix + '_nav_pinned', JSON.stringify(this.pinned));
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
                    let type = el.dataset.pinType || 'item';
                    return type === 'group' ? this.buildGroupShortcut(el) : this.buildItemShortcut(el);
                },
                buildItemShortcut: function(el) {
                    let title = el.dataset.pinTitle || '?';
                    let href = el.dataset.pinHref || '#';

                    let wrap = document.createElement('a');
                    wrap.href = href;
                    wrap.dataset.pinnedShortcutFor = el.dataset.navPinId;
                    wrap.className = 'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium w-full cursor-pointer text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-black dark:hover:text-white transition-colors';

                    let iconSrc = el.querySelector('[data-pin-icon]');
                    if (iconSrc) {
                        let iconWrap = document.createElement('span');
                        iconWrap.className = 'shrink-0 flex items-center justify-center w-5 h-5 text-vibe-500';
                        iconWrap.innerHTML = iconSrc.innerHTML;
                        wrap.appendChild(iconWrap);
                    }

                    let titleEl = document.createElement('span');
                    titleEl.className = 'whitespace-nowrap';
                    titleEl.textContent = title;
                    wrap.appendChild(titleEl);

                    return wrap;
                },
                buildGroupShortcut: function(el) {
                    let title = el.dataset.pinTitle || '?';
                    let isOpen = false;

                    let wrapper = document.createElement('div');
                    wrapper.dataset.pinnedShortcutFor = el.dataset.navPinId;
                    wrapper.className = 'w-full flex flex-col gap-1';

                    let btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'flex items-center px-3 py-2 rounded-lg text-sm font-medium w-full relative overflow-hidden cursor-pointer select-none text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-black dark:hover:text-white transition-colors group/nav-item';

                    let iconSrc = el.querySelector('[data-pin-icon]');
                    if (iconSrc) {
                        let iconWrap = document.createElement('span');
                        iconWrap.className = 'shrink-0 flex items-center justify-center w-5 h-5 text-vibe-500';
                        iconWrap.innerHTML = iconSrc.innerHTML;
                        btn.appendChild(iconWrap);
                    }

                    let mid = document.createElement('div');
                    mid.className = 'flex flex-1 gap-2 w-full items-center justify-between ml-3';

                    let titleEl = document.createElement('span');
                    titleEl.className = 'whitespace-nowrap';
                    titleEl.textContent = title;
                    mid.appendChild(titleEl);

                    let chevron = document.createElement('span');
                    chevron.style.transform = 'none';
                    chevron.style.transition = 'transform 0.3s';
                    // Using original chevron if available, fallback to a clean SVG string
                    let origChevron = el.querySelector('span[id^="nav-group-chevron"]');
                    if (origChevron) {
                        chevron.innerHTML = origChevron.innerHTML;
                    } else {
                        chevron.innerHTML = '<svg class="size-4 text-vibe-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.51192 4.43057C8.82641 4.161 9.29989 4.19743 9.56946 4.51192L15.5695 11.5119C15.8102 11.7928 15.8102 12.2072 15.5695 12.4881L9.56946 19.4881C9.29989 19.8026 8.82641 19.839 8.51192 19.5695C8.19743 19.2999 8.161 18.8264 8.43057 18.5119L14.0122 12L8.43057 5.48811C8.161 5.17361 8.19743 4.70014 8.51192 4.43057Z" fill="currentColor"/></svg>';
                    }
                    mid.appendChild(chevron);
                    btn.appendChild(mid);
                    wrapper.appendChild(btn);

                    let grid = document.createElement('div');
                    grid.style.display = 'grid';
                    grid.style.gridTemplateRows = '0fr';
                    grid.style.transition = 'grid-template-rows 0.3s ease-in-out';

                    let overflow = document.createElement('div');
                    overflow.style.overflow = 'hidden';
                    overflow.style.minHeight = '0';

                    let innerList = document.createElement('div');
                    innerList.className = 'flex flex-col gap-1 mt-1';

                    let childItems = el.querySelectorAll('a[href]');
                    childItems.forEach(item => {
                        let childHref = item.getAttribute('href') || '#';
                        let childTitle = item.querySelector('span.whitespace-nowrap')?.textContent?.trim() || item.textContent?.trim() || '?';
                        let childIconSrc = item.querySelector('[data-pin-icon]');

                        let childLink = document.createElement('a');
                        childLink.href = childHref;
                        childLink.className = 'flex items-center px-3 py-2 rounded-lg text-sm w-full cursor-pointer text-vibe-600 dark:text-vibe-400 hover:bg-vibe-200 dark:hover:bg-vibe-800 hover:text-black dark:hover:text-white transition-colors';

                        if (childIconSrc) {
                            let ci = document.createElement('span');
                            ci.className = 'shrink-0 flex items-center justify-center w-5 h-5 text-vibe-500';
                            ci.innerHTML = childIconSrc.innerHTML;
                            childLink.appendChild(ci);
                        }

                        let ct = document.createElement('span');
                        ct.className = (childIconSrc ? 'ml-3 ' : '') + 'whitespace-nowrap';
                        ct.textContent = childTitle;
                        childLink.appendChild(ct);
                        innerList.appendChild(childLink);
                    });

                    overflow.appendChild(innerList);
                    grid.appendChild(overflow);
                    wrapper.appendChild(grid);

                    btn.addEventListener('click', () => {
                        isOpen = !isOpen;
                        grid.style.gridTemplateRows = isOpen ? '1fr' : '0fr';
                        chevron.style.transform = isOpen ? 'rotate(90deg)' : 'none';
                    });

                    return wrapper;
                }
            };
        }

        (function() {
            try {
                let prefix = window.VIBE_PREFIX || 'vibe';
                let pinned = JSON.parse(localStorage.getItem(prefix + '_nav_pinned') || '[]');
                let nav = document.getElementById('{{ $navId }}');
                if (!nav) return;
                
                let container = nav.querySelector('[data-pinned-container]');
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
