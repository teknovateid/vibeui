/**
 * Vibe UI - Sheet / Drawer Component
 * Manages collapsible, static, and minify sheets with mobile awareness, drag resize, and persistence.
 */
import { VibeStorage } from './core';

export function vibeSheet(config = {}) {
    return {
        id: null,
        layout: 'fixed',
        behavior: 'collapsible',
        position: 'right',
        isResizing: false,
        isExpanding: false,
        isInitialized: false,
        lastTriggerTime: 0,
        startSize: 0,
        startPos: 0,
        _expandTimer: null,
        minifiedSize: 80,
        minSize: 0,
        maxSize: 600,
        mobileSize: '280',
        defaultSize: 350,
        size: 350,
        state: 'collapsed',
        persist: false,
        persistKey: 'vibe-sheet',
        resizable: false,
        closeOnOutsideClick: true,
        teleport: false,
        isMobile: typeof window !== 'undefined' ? window.innerWidth < 768 : false,
        ...config,

        get isHorizontal() {
            return this.position === 'left' || this.position === 'right';
        },

        init() {
            if (this.teleport && this.layout === 'fixed' && this.state !== 'collapsed') {
                window._vibeOpenSheetCount = (window._vibeOpenSheetCount || 0) + 1;
                document.body.classList.add('overflow-hidden');
            }

            if (!this._vibeResizeListenerAttached) {
                this._vibeResizeListenerAttached = true;
                this._onWindowResize = () => {
                    this.isMobile = window.innerWidth < 768;
                    if (this.isMobile && this.behavior === 'minify' && this.state === 'minified') {
                        this.state = 'collapsed';
                    }
                };
                window.addEventListener('resize', this._onWindowResize);
            }

            if (this.persist) {
                try {
                    const stored = localStorage.getItem(this.persistKey);
                    if (stored) {
                        const data = JSON.parse(stored);
                        if (Array.isArray(data)) {
                            const item = data.find(i => i.id === this.id);
                            if (item) {
                                this.size = item.size ?? this.size;
                                this.state = item.status ?? this.state;
                            }
                        } else if (data && data[this.id]) {
                            this.size = data[this.id].size ?? this.size;
                            this.state = data[this.id].status ?? this.state;
                        }
                    }
                } catch (e) {}
            }

            if (this.isMobile && this.behavior === 'minify' && this.state === 'minified') {
                this.state = 'collapsed';
            }

            this.$nextTick(() => {
                setTimeout(() => {
                    this.isInitialized = true;
                }, 50);
            });

            this.$watch('state', (value, oldValue) => {
                if (oldValue === 'collapsed' && value !== 'collapsed') {
                    clearTimeout(this._expandTimer);
                    this.isExpanding = true;
                    this._expandTimer = setTimeout(() => {
                        this.isExpanding = false;
                    }, 320);
                } else if (value === 'collapsed') {
                    clearTimeout(this._expandTimer);
                    this.isExpanding = false;
                }

                if (this.teleport && this.layout === 'fixed') {
                    if (value !== 'collapsed') {
                        window._vibeOpenSheetCount = (window._vibeOpenSheetCount || 0) + 1;
                        document.body.classList.add('overflow-hidden');
                    } else {
                        window._vibeOpenSheetCount = Math.max(0, (window._vibeOpenSheetCount || 1) - 1);
                        if (window._vibeOpenSheetCount <= 0 && (!window._vibeOpenModalCount || window._vibeOpenModalCount <= 0)) {
                            document.body.classList.remove('overflow-hidden');
                        }
                    }
                }

                if (value === 'expanded' || value === 'minified') {
                    setTimeout(() => {
                        const input = this.$el?.querySelector('input:not([type=hidden]):not([disabled]), textarea:not([disabled]), select:not([disabled])');
                        if (input) input.focus();
                    }, 100);
                }
            });

            if (typeof this.$cleanup === 'function') {
                this.$cleanup(() => {
                    clearTimeout(this._expandTimer);
                    if (this._onWindowResize) {
                        window.removeEventListener('resize', this._onWindowResize);
                    }
                    if (this.teleport && this.layout === 'fixed' && this.state !== 'collapsed') {
                        window._vibeOpenSheetCount = Math.max(0, (window._vibeOpenSheetCount || 1) - 1);
                        if (window._vibeOpenSheetCount <= 0 && (!window._vibeOpenModalCount || window._vibeOpenModalCount <= 0)) {
                            document.body.classList.remove('overflow-hidden');
                        }
                    }
                });
            }
        },

        saveToStorage() {
            if (!this.persist) return;
            VibeStorage.upsertItem(this.persistKey, this.id, {
                id: this.id,
                size: this.size,
                status: this.state,
            });
        },

        get currentSize() {
            if (this.isResizing) return this.size;
            if (this.behavior === 'static') return this.size;
            if (this.state === 'collapsed') return 0;
            if (this.state === 'minified') return this.isMobile ? 0 : this.minifiedSize;
            if (this.isMobile) {
                if (this.mobileSize === 'full') {
                    return '100%';
                }
                const numericMobileSize = parseInt(this.mobileSize, 10) || 280;
                const maxMobile = this.isHorizontal
                    ? Math.min(numericMobileSize, window.innerWidth - 48)
                    : Math.min(numericMobileSize, window.innerHeight - 48);
                return Math.max(0, maxMobile);
            }
            return this.size;
        },

        startResize(e) {
            if (this.isMobile) return;
            if (this.behavior === 'static' && !this.resizable) return;
            this.isResizing = true;
            this.startSize = this.currentSize;

            const clientX = (e.touches && e.touches.length > 0) ? e.touches[0].clientX : (e.clientX !== undefined ? e.clientX : 0);
            const clientY = (e.touches && e.touches.length > 0) ? e.touches[0].clientY : (e.clientY !== undefined ? e.clientY : 0);

            if (this.isHorizontal) {
                this.startPos = clientX;
                document.body.style.cursor = 'col-resize';
            } else {
                this.startPos = clientY;
                document.body.style.cursor = 'row-resize';
            }

            document.body.style.userSelect = 'none';
        },

        doResize(e) {
            if (!this.isResizing) return;

            const clientX = (e.touches && e.touches.length > 0) ? e.touches[0].clientX : (e.clientX !== undefined ? e.clientX : 0);
            const clientY = (e.touches && e.touches.length > 0) ? e.touches[0].clientY : (e.clientY !== undefined ? e.clientY : 0);

            let delta = 0;
            if (this.position === 'left') delta = clientX - this.startPos;
            else if (this.position === 'right') delta = this.startPos - clientX;
            else if (this.position === 'top') delta = clientY - this.startPos;
            else if (this.position === 'bottom') delta = this.startPos - clientY;

            let newSize = this.startSize + delta;

            let dynamicMaxSize = this.maxSize;
            if (this.isHorizontal) {
                if (window.innerWidth - 16 < dynamicMaxSize) dynamicMaxSize = Math.max(0, window.innerWidth - 16);
            } else {
                if (window.innerHeight - 16 < dynamicMaxSize) dynamicMaxSize = Math.max(0, window.innerHeight - 16);
            }

            const effectiveMinSize = Math.min(this.minSize, dynamicMaxSize);

            if (newSize > dynamicMaxSize) newSize = dynamicMaxSize;

            if (this.behavior === 'static') {
                if (newSize < effectiveMinSize) newSize = effectiveMinSize;
            } else if (this.behavior === 'collapsible') {
                if (effectiveMinSize > 0) {
                    if (newSize < effectiveMinSize) newSize = effectiveMinSize;
                } else if (newSize < 0) {
                    newSize = 0;
                }
            } else if (this.behavior === 'minify') {
                if (this.isMobile) {
                    if (newSize < 0) newSize = 0;
                } else {
                    if (effectiveMinSize > 0 && newSize < effectiveMinSize && newSize > this.minifiedSize + 20) {
                        newSize = effectiveMinSize;
                    }
                    if (newSize < 0) newSize = 0;
                }
            } else if (newSize < 0) {
                newSize = 0;
            }

            this.size = newSize;

            if (this.behavior === 'minify') {
                if (this.isMobile) {
                    this.state = this.size < (effectiveMinSize > 0 ? effectiveMinSize / 2 : 80) ? 'collapsed' : 'expanded';
                } else if (this.size < this.minifiedSize / 2) {
                    this.state = 'collapsed';
                } else if (this.size <= this.minifiedSize + 20) {
                    this.state = 'minified';
                } else {
                    this.state = 'expanded';
                }
            } else {
                this.state = this.size === 0 ? 'collapsed' : 'expanded';
            }
        },

        stopResize() {
            if (this.isResizing) {
                this.isResizing = false;
                document.body.style.cursor = '';
                document.body.style.userSelect = '';
                this.saveToStorage();
            }
        },

        toggle() {
            this.lastTriggerTime = Date.now();
            if (this.behavior === 'static') return;

            if (this.behavior === 'collapsible' || (this.behavior === 'minify' && this.isMobile)) {
                this.state = this.state === 'expanded' ? 'collapsed' : 'expanded';
            } else if (this.behavior === 'minify') {
                this.state = this.state === 'expanded' ? 'minified' : 'expanded';
            }

            if (this.state === 'expanded' && this.size < this.minifiedSize + 50) {
                this.size = this.defaultSize;
            }

            this.saveToStorage();
        },

        close() {
            if (this.behavior === 'static') return;
            this.state = 'collapsed';
            this.saveToStorage();
        },

        open() {
            this.lastTriggerTime = Date.now();
            if (this.behavior === 'static') return;
            this.state = 'expanded';
            this.saveToStorage();
        },

        handleOutsideClick(event) {
            if (!this.closeOnOutsideClick) return;
            if (this.state === 'collapsed') return;
            if (Date.now() - this.lastTriggerTime <= 150) return;
            if (event && event.target && event.target.closest('dialog, [role=dialog], [role=alertdialog], [data-vibe-sheet-ignore], [data-vibe-portal], .vibe-modal, .vibe-dropdown-menu, .vibe-select-dropdown, #vibe-alert-container, .flatpickr-calendar')) return;
            this.close();
        }
    };
}

if (typeof window !== 'undefined') {
    window.vibeSheet = vibeSheet;

    document.addEventListener('alpine:init', () => {
        if (window.Alpine && typeof window.Alpine.data === 'function') {
            window.Alpine.data('vibeSheet', vibeSheet);
        }
    });

    if (window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeSheet', vibeSheet);
    }

    window.dispatchEvent(new CustomEvent('vibe-sheet-ready'));
}
