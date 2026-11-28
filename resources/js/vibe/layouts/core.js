/**
 * Vibe UI - Shared Layout Runtime & Alpine Shell Controller
 * Centralizes layout root attribute syncing, fullscreen/theme toggles,
 * mobile backdrop tracking, keyboard shortcuts, and sticky scroll-state observers.
 */

const getRootShell = () => document.querySelector('[data-vibe-layout]');

export function syncRootAttributes() {
    if (typeof document === 'undefined') return null;

    const root = document.documentElement;
    const shellEl = getRootShell();
    const prevLayout = root.getAttribute('data-vibe-layout') || '';

    if (!shellEl) {
        root.removeAttribute('data-vibe-layout');
        root.removeAttribute('data-vibe-layout-group');
        root.removeAttribute('data-vibe-panel');
        root.removeAttribute('data-vibe-shell');
        root.removeAttribute('data-vibe-sidebar-state');
        return null;
    }

    const attrs = ['data-vibe-layout', 'data-vibe-layout-group', 'data-vibe-panel', 'data-vibe-shell', 'data-vibe-sidebar-state'];
    for (const attr of attrs) {
        const val = shellEl.getAttribute(attr);
        if (val) {
            root.setAttribute(attr, val);
        } else {
            root.removeAttribute(attr);
        }
    }

    const nextLayout = root.getAttribute('data-vibe-layout') || '';
    if (prevLayout !== nextLayout) {
        window.dispatchEvent(new CustomEvent('vibe:layout-changed', {
            detail: { previous: prevLayout || null, current: nextLayout || null },
        }));
    }

    return shellEl;
}

export function extractSheetTarget(detail) {
    if (Array.isArray(detail)) return detail[0];
    if (detail !== null && typeof detail === 'object') return Object.values(detail)[0];
    return detail;
}

export function bindSidebarToggleShortcut() {
    if (typeof document === 'undefined' || window.__vibeLayoutShortcutBound) return;
    window.__vibeLayoutShortcutBound = true;

    document.addEventListener('keydown', (e) => {
        if (!(e.metaKey || e.ctrlKey) || e.altKey || e.shiftKey) return;
        if (String(e.key).toLowerCase() !== 'b') return;

        const target = e.target;
        if (target && (target.closest('input, textarea, select, [contenteditable="true"], .tox-tinymce') || target.isContentEditable)) {
            return;
        }

        const shell = getRootShell();
        const sidebarId = shell?.dataset?.vibeSidebarId;
        if (!sidebarId) return;

        const sidebarEl = document.getElementById(sidebarId);
        if (!sidebarEl) return;

        e.preventDefault();
        if (window.$vibe?.sheet) {
            window.$vibe.sheet(sidebarId).toggle();
        } else {
            window.dispatchEvent(new CustomEvent('toggle-sheet', { detail: sidebarId }));
        }
    });
}

export function initStickyHeaders(scope = document) {
    if (typeof document === 'undefined' || typeof IntersectionObserver === 'undefined') return;
    if (typeof CSS !== 'undefined' && CSS.supports?.('container-type: scroll-state')) {
        return;
    }

    const headers = scope.querySelectorAll('[data-vibe-sticky-header]');
    headers.forEach((header) => {
        if (header.dataset.vibeStickyObserved === 'true') return;
        header.dataset.vibeStickyObserved = 'true';

        const scrollRoot = header.closest('[data-vibe-scroll]') || header.closest('#docs-main-scroll');
        const sentinel = document.createElement('div');
        sentinel.setAttribute('aria-hidden', 'true');
        sentinel.style.cssText = 'position:relative;block-size:1px;margin-block-end:-1px;pointer-events:none;visibility:hidden;';
        header.parentNode?.insertBefore(sentinel, header);

        const obs = new IntersectionObserver(
            (entries) => {
                const entry = entries.at(-1);
                if (!entry) return;
                const topEdge = entry.rootBounds?.top ?? 0;
                const stuck = !entry.isIntersecting && entry.boundingClientRect.top <= topEdge + 1;
                header.classList.toggle('is-stuck', stuck);
                header.setAttribute('data-stuck', stuck ? 'true' : 'false');
            },
            {
                root: scrollRoot || null,
                threshold: [0, 1],
            }
        );

        obs.observe(sentinel);
        header._vibeStickyCleanup = () => {
            obs.disconnect();
            sentinel.remove();
            delete header.dataset.vibeStickyObserved;
        };
    });
}

export function vibeLayoutShell(config = {}) {
    return {
        sidebarId: config.sidebarId || 'sidebar-menu',
        isDark: typeof document !== 'undefined' ? document.documentElement.classList.contains('dark') : false,
        isFullscreen: typeof document !== 'undefined' ? !!document.fullscreenElement : false,
        isMobileBackdropOpen: false,
        sidebarState: 'expanded',
        _obs: null,
        _onThemeChanged: null,
        _onFullscreenChanged: null,
        _onResize: null,
        _backdropTimer: null,

        init() {
            syncRootAttributes();
            this.syncThemeState();
            this.syncFullscreenState();
            this.checkSidebarState();

            const el = document.getElementById(this.sidebarId);
            if (el && typeof MutationObserver !== 'undefined') {
                this._obs = new MutationObserver(() => this.checkSidebarState());
                this._obs.observe(el, { attributes: true, attributeFilter: ['data-state'] });
            }

            this._onThemeChanged = () => this.syncThemeState();
            this._onFullscreenChanged = () => this.syncFullscreenState();
            this._onResize = () => this.checkSidebarState();

            window.addEventListener('vibe-theme-changed', this._onThemeChanged);
            window.addEventListener('fullscreenchange', this._onFullscreenChanged);
            window.addEventListener('resize', this._onResize, { passive: true });
        },

        destroy() {
            clearTimeout(this._backdropTimer);
            if (this._obs) {
                this._obs.disconnect();
                this._obs = null;
            }
            if (this._onThemeChanged) window.removeEventListener('vibe-theme-changed', this._onThemeChanged);
            if (this._onFullscreenChanged) window.removeEventListener('fullscreenchange', this._onFullscreenChanged);
            if (this._onResize) window.removeEventListener('resize', this._onResize);
        },

        syncThemeState() {
            this.isDark = document.documentElement.classList.contains('dark');
        },

        toggleTheme(event = null) {
            if (window.VibeTheme) {
                window.VibeTheme.toggle(event);
            } else {
                document.documentElement.classList.toggle('dark');
            }
            this.syncThemeState();
        },

        syncFullscreenState() {
            this.isFullscreen = !!document.fullscreenElement;
        },

        toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen?.().catch(() => {});
            } else {
                document.exitFullscreen?.().catch(() => {});
            }
        },

        checkSidebarState() {
            const el = document.getElementById(this.sidebarId);
            if (!el) {
                this.isMobileBackdropOpen = false;
                return;
            }
            const state = el.getAttribute('data-state') || 'expanded';
            this.sidebarState = state;
            this.isMobileBackdropOpen = state === 'expanded' && window.innerWidth < 768;

            const shell = this.$el?.closest('[data-vibe-layout]') || getRootShell();
            if (shell) {
                shell.setAttribute('data-vibe-sidebar-state', state);
                document.documentElement.setAttribute('data-vibe-sidebar-state', state);
            }
        },

        handleSheetEvent(type, detail) {
            const target = extractSheetTarget(detail);
            if (type === 'open') {
                if (target === this.sidebarId && window.innerWidth < 768) {
                    this.isMobileBackdropOpen = true;
                }
            } else if (type === 'close') {
                if (target === this.sidebarId || target === '*' || !target) {
                    this.isMobileBackdropOpen = false;
                }
            } else if (type === 'toggle' && target === this.sidebarId) {
                clearTimeout(this._backdropTimer);
                this._backdropTimer = setTimeout(() => this.checkSidebarState(), 60);
            }
        },
    };
}

export function registerLayoutRuntime(onReady = null) {
    if (typeof window === 'undefined') return;

    const registerAlpine = () => {
        if (window.Alpine && typeof window.Alpine.data === 'function') {
            window.Alpine.data('vibeLayoutShell', vibeLayoutShell);
        }
    };

    const boot = () => {
        syncRootAttributes();
        initStickyHeaders();
        bindSidebarToggleShortcut();
        registerAlpine();
        if (typeof onReady === 'function') onReady();
    };

    if (!window.VibeLayout) {
        window.VibeLayout = {
            syncRootAttributes,
            vibeLayoutShell,
            initStickyHeaders,
            bindSidebarToggleShortcut,
            extractSheetTarget,
        };
    }

    if (!window.__vibeLayoutRuntimeListeners) {
        window.__vibeLayoutRuntimeListeners = true;
        document.addEventListener('alpine:init', registerAlpine);
        document.addEventListener('livewire:navigated', () => {
            syncRootAttributes();
            initStickyHeaders();
        });
    }

    boot();
}

export function registerLayoutHook(flag, callback) {
    if (typeof window === 'undefined') return;
    registerLayoutRuntime(callback);
    if (!window[flag]) {
        window[flag] = true;
        document.addEventListener('livewire:navigated', callback);
    }
}
