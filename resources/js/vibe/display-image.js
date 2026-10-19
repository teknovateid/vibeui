/**
 * Vibe UI — Display Image Lightbox Manager (Event Delegation Engine)
 * High Performance: 0 Alpine instances per thumbnail, O(1) page load, Datatable-ready (10.000+ items).
 */

const LightboxStoreDefinition = {
    isOpen: false,
    currentIndex: 0,
    items: [],
    isStandalone: false,
    zoom: 1,
    panX: 0,
    panY: 0,
    isDragging: false,
    dragStartX: 0,
    dragStartY: 0,
    touchStartX: 0,
    touchStartY: 0,

    get currentItem() {
        return (this.items && this.items[this.currentIndex]) ? this.items[this.currentIndex] : { src: '', alt: '', caption: '' };
    },

    get total() {
        return this.items ? this.items.length : 0;
    },

    get hasNext() {
        return !this.isStandalone && this.total > 1;
    },

    get hasPrev() {
        return !this.isStandalone && this.total > 1;
    },

    openWithItems(items, initialIndex = 0) {
        this.resetZoom();
        this.items = items || [];
        this.currentIndex = Math.max(0, Math.min(initialIndex, this.items.length - 1));
        this.isStandalone = this.items.length <= 1;
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
    },

    openStandalone(item) {
        this.resetZoom();
        this.items = [item];
        this.currentIndex = 0;
        this.isStandalone = true;
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

function getStore() {
    return (window.Alpine && window.Alpine.store) ? window.Alpine.store('vibeImageLightbox') : window.VibeImageLightbox;
}

// Global Delegated Click Listener — Handles any number of images with 0 overhead
document.addEventListener('click', (e) => {
    // 1. Direct <vibe:display.image>
    let trigger = e.target.closest('[data-vibe-image]');
    let isGallery = false;
    let galleryWrapper = null;

    // 2. Regular <img> inside <vibe:display.image-gallery> wrapper
    if (!trigger) {
        if (e.target.tagName === 'IMG' && !e.target.hasAttribute('data-vibe-ignore')) {
            galleryWrapper = e.target.closest('[data-vibe-gallery]');
            if (galleryWrapper) {
                trigger = e.target;
                isGallery = true;
            }
        }
    }

    if (!trigger) return;

    e.preventDefault();
    const store = getStore();
    if (!store) return;

    if (isGallery && galleryWrapper) {
        const allImgs = Array.from(galleryWrapper.querySelectorAll('img:not([data-vibe-ignore])'));
        const items = allImgs.map(img => ({
            src: img.getAttribute('src') || '',
            alt: img.getAttribute('alt') || '',
            caption: img.getAttribute('title') || img.getAttribute('alt') || ''
        }));
        const curIndex = allImgs.indexOf(trigger);
        store.openWithItems(items, curIndex);
    } else {
        const src = trigger.dataset.src || trigger.getAttribute('src') || '';
        const alt = trigger.dataset.alt || trigger.getAttribute('alt') || '';
        const caption = trigger.dataset.caption || '';
        const group = trigger.dataset.group || 'default';
        const isStandalone = trigger.hasAttribute('data-standalone');

        if (isStandalone) {
            store.openStandalone({ src, alt, caption });
        } else {
            // Collect all visible images sharing the same group on-demand!
            const groupElements = Array.from(document.querySelectorAll(`[data-vibe-image][data-group="${group}"]`));
            const items = groupElements.map(el => ({
                src: el.dataset.src || el.getAttribute('src') || '',
                alt: el.dataset.alt || el.getAttribute('alt') || '',
                caption: el.dataset.caption || ''
            }));
            const curIndex = groupElements.indexOf(trigger);
            store.openWithItems(items, curIndex >= 0 ? curIndex : 0);
        }
    }
});

// Global Keyboard Accessibility Handler (Enter / Space on focused thumbnail)
document.addEventListener('keydown', (e) => {
    const store = getStore();

    // If Lightbox is open, handle lightbox keyboard navigation
    if (store && store.isOpen) {
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
        return;
    }

    // Enter / Space to open focused thumbnail
    if (e.key === 'Enter' || e.key === ' ') {
        const trigger = document.activeElement?.closest('[data-vibe-image]');
        if (trigger) {
            e.preventDefault();
            trigger.click();
        }
    }
});

export default tryInitStore;
