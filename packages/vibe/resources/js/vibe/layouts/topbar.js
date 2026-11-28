/**
 * Vibe UI - Horizontal Responsive Topbar Layout (topbar)
 * Single-tree responsive navbar with ResizeObserver overflow measurement,
 * declarative native popover="auto" sync (with light class fallback),
 * hover-preview submenus, and anchor positioning fallback.
 */
import { registerLayoutHook } from './core';

const supportsNativePopover = () =>
    typeof HTMLElement !== 'undefined' && Object.hasOwn(HTMLElement.prototype, 'popover');

const supportsPositionArea = () =>
    typeof CSS !== 'undefined' && typeof CSS.supports === 'function' && CSS.supports('position-area', 'block-end');

function positionFallbackSubmenu(trigger, submenu) {
    if (!trigger || !submenu) return;
    const tr = trigger.getBoundingClientRect();
    const sm = submenu.getBoundingClientRect();
    const gap = 8;

    let top = tr.bottom + gap;
    if (top + sm.height > window.innerHeight - 12 && tr.top - gap - sm.height >= 12) {
        top = tr.top - gap - sm.height;
    }

    let left = tr.left;
    if (left + sm.width > window.innerWidth - 12) {
        left = window.innerWidth - 12 - sm.width;
    }
    left = Math.max(12, left);

    submenu.style.top = `${Math.round(top)}px`;
    submenu.style.left = `${Math.round(left)}px`;
}

function positionFallbackMobileMenu(trigger, menu) {
    if (!trigger || !menu) return;
    const rect = trigger.getBoundingClientRect();
    menu.style.insetBlockStart = `${Math.round(rect.bottom + 8)}px`;
}

function setupTopbarInstance(header) {
    if (!header || header.dataset.vibeTopbarBound === 'true') return;
    header.dataset.vibeTopbarBound = 'true';

    const inner = header.querySelector('[data-vibe-topbar-inner]');
    const trigger = header.querySelector('[data-vibe-topbar-trigger]');
    const menu = header.querySelector('[data-vibe-topbar-menu]');
    if (!inner || !trigger || !menu) return;

    const collapseMode = header.dataset.collapseMode || 'auto';
    const hoverPreviewEnabled = header.dataset.hoverPreview !== 'false';
    const nativePopover = supportsNativePopover();

    const submenuControllers = [];
    const submenuItems = Array.from(menu.querySelectorAll('[data-vibe-topbar-dropdown]'));

    const openPopoverSafely = (el, source = null) => {
        if (nativePopover) {
            try {
                if (source && typeof el.showPopover === 'function') {
                    el.showPopover({ source });
                } else {
                    el.showPopover?.();
                }
            } catch {
                try {
                    el.showPopover?.();
                } catch {}
            }
        } else {
            el.classList.add(':popover-open');
            el.dispatchEvent(new CustomEvent('toggle', { detail: { newState: 'open' } }));
        }
    };

    const closePopoverSafely = (el) => {
        if (nativePopover) {
            try {
                if (el.matches(':popover-open')) {
                    el.hidePopover?.();
                }
            } catch {}
        } else if (el.classList.contains(':popover-open')) {
            el.classList.remove(':popover-open');
            el.dispatchEvent(new CustomEvent('toggle', { detail: { newState: 'closed' } }));
        }
    };

    const isPopoverOpen = (el) => (nativePopover ? el.matches(':popover-open') : el.classList.contains(':popover-open'));

    const syncMainMenuAria = () => {
        trigger.setAttribute('aria-expanded', isPopoverOpen(menu) ? 'true' : 'false');
    };

    if (nativePopover) {
        menu.addEventListener('toggle', (event) => {
            const isOpen = event.newState === 'open';
            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (isOpen && (!supportsPositionArea() || (typeof CSS !== 'undefined' && !CSS.supports('inset-block-start: anchor(bottom)')))) {
                positionFallbackMobileMenu(trigger, menu);
            }
        });
    } else {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            if (isPopoverOpen(menu)) closePopoverSafely(menu);
            else {
                openPopoverSafely(menu, trigger);
                positionFallbackMobileMenu(trigger, menu);
            }
            syncMainMenuAria();
        });
    }

    submenuItems.forEach((item) => {
        const subTrigger = item.querySelector('[data-vibe-topbar-submenu-trigger]');
        const submenu = item.querySelector('[data-vibe-topbar-submenu]');
        if (!subTrigger || !submenu) return;

        let isHoverPreview = false;

        const syncSub = (wide) => {
            if (wide) {
                submenu.setAttribute('popover', 'auto');
                submenu.hidden = false;
                closePopoverSafely(submenu);
            } else {
                closePopoverSafely(submenu);
                submenu.removeAttribute('popover');
                submenu.hidden = true;
            }
            subTrigger.setAttribute('aria-expanded', 'false');
            isHoverPreview = false;
        };

        subTrigger.addEventListener('click', (e) => {
            if (header.classList.contains('is-wide')) {
                if (!nativePopover) {
                    e.preventDefault();
                    if (isPopoverOpen(submenu)) {
                        closePopoverSafely(submenu);
                        subTrigger.setAttribute('aria-expanded', 'false');
                    } else {
                        openPopoverSafely(submenu, subTrigger);
                        subTrigger.setAttribute('aria-expanded', 'true');
                        if (!supportsPositionArea()) positionFallbackSubmenu(subTrigger, submenu);
                    }
                    isHoverPreview = false;
                    return;
                }
                if (isHoverPreview && isPopoverOpen(submenu)) {
                    e.preventDefault();
                    isHoverPreview = false;
                    subTrigger.setAttribute('aria-expanded', 'true');
                }
                return;
            }

            e.preventDefault();
            const willOpen = submenu.hidden;
            submenu.hidden = !willOpen;
            subTrigger.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
        });

        submenu.addEventListener('toggle', (event) => {
            if (!header.classList.contains('is-wide')) return;
            const open = event.newState === 'open' || (!nativePopover && isPopoverOpen(submenu));
            subTrigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (!open) {
                isHoverPreview = false;
            } else if (!supportsPositionArea()) {
                positionFallbackSubmenu(subTrigger, submenu);
            }
        });

        if (hoverPreviewEnabled) {
            item.addEventListener('pointerenter', (event) => {
                if (!header.classList.contains('is-wide')) return;
                if (event.pointerType === 'touch') return;
                if (!window.matchMedia('(hover: hover)').matches) return;
                if (isPopoverOpen(submenu)) return;

                isHoverPreview = true;
                openPopoverSafely(submenu, subTrigger);
                subTrigger.setAttribute('aria-expanded', 'true');
                if (!supportsPositionArea()) positionFallbackSubmenu(subTrigger, submenu);
            });

            item.addEventListener('pointerleave', () => {
                if (!header.classList.contains('is-wide') || !isHoverPreview) return;
                closePopoverSafely(submenu);
                isHoverPreview = false;
                subTrigger.setAttribute('aria-expanded', 'false');
            });
        }

        item.addEventListener('focusout', (event) => {
            if (!header.classList.contains('is-wide')) return;
            if (event.relatedTarget && !item.contains(event.relatedTarget)) {
                closePopoverSafely(submenu);
                isHoverPreview = false;
                subTrigger.setAttribute('aria-expanded', 'false');
            }
        });

        submenuControllers.push(syncSub);
    });

    if (!nativePopover) {
        const onDocClick = (e) => {
            if (!menu.contains(e.target) && !trigger.contains(e.target)) {
                closePopoverSafely(menu);
                syncMainMenuAria();
            }
            submenuItems.forEach((item) => {
                const sub = item.querySelector('[data-vibe-topbar-submenu]');
                if (sub && !item.contains(e.target)) closePopoverSafely(sub);
            });
        };
        const onDocEsc = (e) => {
            if (e.key !== 'Escape') return;
            closePopoverSafely(menu);
            syncMainMenuAria();
            submenuItems.forEach((item) => {
                const sub = item.querySelector('[data-vibe-topbar-submenu]');
                const btn = item.querySelector('[data-vibe-topbar-submenu-trigger]');
                if (sub) closePopoverSafely(sub);
                btn?.setAttribute('aria-expanded', 'false');
            });
        };
        document.addEventListener('click', onDocClick);
        document.addEventListener('keydown', onDocEsc);
        header._vibeTopbarDocCleanup = () => {
            document.removeEventListener('click', onDocClick);
            document.removeEventListener('keydown', onDocEsc);
        };
    }

    let lastHeaderWidth = header.clientWidth;
    let rafMeasure = null;

    const applyMode = (wide) => {
        const wasOpen = isPopoverOpen(menu);
        header.classList.toggle('is-wide', wide);

        if (wide) {
            closePopoverSafely(menu);
            menu.removeAttribute('popover');
            trigger.setAttribute('aria-expanded', 'false');
        } else {
            menu.setAttribute('popover', 'auto');
            if (wasOpen) {
                openPopoverSafely(menu, trigger);
            }
            syncMainMenuAria();
        }

        submenuControllers.forEach((syncSub) => syncSub(wide));
    };

    const measure = () => {
        if (collapseMode !== 'auto') {
            const minBp = collapseMode === 'lg' ? 1024 : 768;
            applyMode(window.innerWidth >= minBp);
            return;
        }

        const wasWide = header.classList.contains('is-wide');
        const wasMenuOpen = isPopoverOpen(menu);
        header.classList.add('is-measuring', 'is-wide');
        menu.removeAttribute('popover');
        submenuControllers.forEach((syncSub) => syncSub(true));

        const fits = inner.scrollWidth <= inner.clientWidth + 1;

        if (fits) {
            applyMode(true);
        } else {
            applyMode(false);
            if (!wasWide && wasMenuOpen) {
                openPopoverSafely(menu, trigger);
                syncMainMenuAria();
            }
        }

        cancelAnimationFrame(rafMeasure);
        rafMeasure = requestAnimationFrame(() => {
            header.classList.remove('is-measuring');
        });
    };

    measure();

    if (typeof ResizeObserver !== 'undefined') {
        const ro = new ResizeObserver(() => {
            const width = header.clientWidth;
            const isWideNow = header.classList.contains('is-wide');
            if (collapseMode === 'auto' && !isWideNow && width <= lastHeaderWidth) {
                return;
            }
            lastHeaderWidth = width;
            measure();
        });
        ro.observe(header);
        ro.observe(menu);

        header._vibeTopbarCleanup = () => {
            ro.disconnect();
            cancelAnimationFrame(rafMeasure);
            header._vibeTopbarDocCleanup?.();
            delete header.dataset.vibeTopbarBound;
        };
    }
}

function initTopbarLayout() {
    document.querySelectorAll('[data-vibe-layout="topbar"] [data-vibe-topbar-header]').forEach(setupTopbarInstance);
}

registerLayoutHook('__vibeTopbarHook', initTopbarLayout);

if (typeof document !== 'undefined' && !window.__vibeTopbarNavCleanup) {
    window.__vibeTopbarNavCleanup = true;
    document.addEventListener('livewire:navigating', () => {
        document.querySelectorAll('[data-vibe-topbar-header]').forEach((header) => {
            header._vibeTopbarCleanup?.();
        });
    });
}
