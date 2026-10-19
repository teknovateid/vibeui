/**
 * Vibe UI — Display Image Lightbox Manager & Alpine Store
 */

const LightboxStoreDefinition = {
    isOpen: false,
    currentGroup: 'default',
    currentIndex: 0,
    groups: {},
    isStandalone: false,
    standaloneItem: null,
    zoom: 1,
    panX: 0,
    panY: 0,
    isDragging: false,
    dragStartX: 0,
    dragStartY: 0,
    touchStartX: 0,
    touchStartY: 0,

    get currentItem() {
        const list = this.items;
        return (list && list[this.currentIndex]) ? list[this.currentIndex] : { src: '', alt: '', caption: '' };
    },

    get items() {
        if (this.isStandalone) {
            return this.standaloneItem ? [this.standaloneItem] : [];
        }
        return (this.groups && this.groups[this.currentGroup]) ? this.groups[this.currentGroup] : [];
    },

    get total() {
        return this.items.length;
    },

    get hasNext() {
        return !this.isStandalone && this.total > 1;
    },

    get hasPrev() {
        return !this.isStandalone && this.total > 1;
    },

    register(group, item) {
        const grp = group || 'default';
        if (!this.groups[grp]) {
            this.groups[grp] = [];
        }
        const existingIndex = this.groups[grp].findIndex(i => (item.id && i.id === item.id) || i.src === item.src);
        if (existingIndex >= 0) {
            this.groups[grp][existingIndex] = { ...this.groups[grp][existingIndex], ...item };
        } else {
            this.groups[grp].push(item);
        }
    },

    unregister(group, id) {
        const grp = group || 'default';
        if (this.groups[grp]) {
            this.groups[grp] = this.groups[grp].filter(i => i.id !== id);
        }
    },

    open(group, srcOrIndex, options = {}) {
        this.resetZoom();

        if (options.standalone) {
            this.isStandalone = true;
            this.standaloneItem = {
                src: typeof srcOrIndex === 'string' ? srcOrIndex : '',
                alt: options.alt || '',
                caption: options.caption || ''
            };
            this.currentGroup = null;
            this.currentIndex = 0;
        } else {
            this.isStandalone = false;
            const grp = group || 'default';
            this.currentGroup = grp;
            if (!this.groups[grp]) {
                this.groups[grp] = [];
            }
            const list = this.groups[grp];

            if (typeof srcOrIndex === 'string') {
                let idx = list.findIndex(i => i.src === srcOrIndex);
                if (idx === -1) {
                    list.push({
                        id: 'item-' + Math.random().toString(36).substring(2, 9),
                        src: srcOrIndex,
                        alt: options.alt || '',
                        caption: options.caption || ''
                    });
                    idx = list.length - 1;
                }
                this.currentIndex = idx;
            } else if (typeof srcOrIndex === 'number') {
                this.currentIndex = Math.max(0, Math.min(srcOrIndex, Math.max(0, list.length - 1)));
            }
        }

        this.isOpen = true;
        document.body.style.overflow = 'hidden';
    },

    close() {
        this.isOpen = false;
        this.resetZoom();
        document.body.style.overflow = '';
    },

    next() {
        if (this.total <= 1) return;
        this.resetZoom();
        this.currentIndex = (this.currentIndex + 1) % this.total;
    },

    prev() {
        if (this.total <= 1) return;
        this.resetZoom();
        this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
    },

    zoomIn() {
        if (this.zoom < 3) {
            this.zoom = +(this.zoom + 0.5).toFixed(1);
        }
    },

    zoomOut() {
        if (this.zoom > 1) {
            this.zoom = +(this.zoom - 0.5).toFixed(1);
            if (this.zoom <= 1) {
                this.resetPan();
            }
        }
    },

    toggleZoom() {
        if (this.zoom > 1) {
            this.resetZoom();
        } else {
            this.zoom = 2;
        }
    },

    resetZoom() {
        this.zoom = 1;
        this.resetPan();
    },

    resetPan() {
        this.panX = 0;
        this.panY = 0;
        this.isDragging = false;
    },

    handleMouseDown(e) {
        if (this.zoom <= 1) return;
        this.isDragging = true;
        this.dragStartX = e.clientX - this.panX;
        this.dragStartY = e.clientY - this.panY;

        const onMouseMove = (moveEvent) => {
            if (!this.isDragging) return;
            this.panX = moveEvent.clientX - this.dragStartX;
            this.panY = moveEvent.clientY - this.dragStartY;
        };

        const onMouseUp = () => {
            this.isDragging = false;
            window.removeEventListener('mousemove', onMouseMove);
            window.removeEventListener('mouseup', onMouseUp);
        };

        window.addEventListener('mousemove', onMouseMove);
        window.addEventListener('mouseup', onMouseUp);
    },

    handleTouchStart(e) {
        if (e.touches && e.touches.length === 1) {
            this.touchStartX = e.touches[0].clientX;
            this.touchStartY = e.touches[0].clientY;
        }
    },

    handleTouchEnd(e) {
        if (this.zoom > 1) return;
        if (e.changedTouches && e.changedTouches.length === 1) {
            const diffX = e.changedTouches[0].clientX - this.touchStartX;
            const diffY = e.changedTouches[0].clientY - this.touchStartY;

            if (Math.abs(diffX) > 50 && Math.abs(diffX) > Math.abs(diffY)) {
                if (diffX < 0) {
                    this.next();
                } else {
                    this.prev();
                }
            } else if (diffY > 100 && Math.abs(diffY) > Math.abs(diffX)) {
                this.close();
            }
        }
    },

    download() {
        const item = this.currentItem;
        if (!item || !item.src) return;
        const a = document.createElement('a');
        a.href = item.src;
        a.download = item.src.split('/').pop().split('?')[0] || 'image';
        a.target = '_blank';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
};

function tryInitStore() {
    if (window.Alpine && window.Alpine.store) {
        if (!window.Alpine.store('vibeImageLightbox')) {
            window.Alpine.store('vibeImageLightbox', LightboxStoreDefinition);
        }
        window.VibeImageLightbox = window.Alpine.store('vibeImageLightbox');
        return true;
    }
    return false;
}

if (!tryInitStore()) {
    document.addEventListener('alpine:init', tryInitStore);
    document.addEventListener('livewire:init', tryInitStore);
    document.addEventListener('livewire:navigated', tryInitStore);
    document.addEventListener('DOMContentLoaded', tryInitStore);
    let attempts = 0;
    const interval = setInterval(() => {
        if (tryInitStore() || ++attempts > 40) {
            clearInterval(interval);
        }
    }, 50);
}

// Global Keyboard Handler
window.addEventListener('keydown', (e) => {
    const store = (window.Alpine && window.Alpine.store) ? window.Alpine.store('vibeImageLightbox') : window.VibeImageLightbox;
    if (!store || !store.isOpen) return;

    if (e.key === 'Escape') {
        store.close();
    } else if (e.key === 'ArrowRight') {
        store.next();
    } else if (e.key === 'ArrowLeft') {
        store.prev();
    } else if (e.key === '+' || e.key === '=') {
        store.zoomIn();
    } else if (e.key === '-') {
        store.zoomOut();
    }
});

export default tryInitStore;
