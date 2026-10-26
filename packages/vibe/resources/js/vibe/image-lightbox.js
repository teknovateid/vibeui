/**
 * Vibe UI — Image Lightbox Manager (High-Performance Event Delegation Engine)
 * Features: 0 Alpine instances per thumbnail, O(1) page load, Datatable-ready (10,000+ items).
 * Supports: Zoom in/out, Pan & Drag, Next/Prev gallery navigation, Touch swipe, Keyboard accessibility.
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
    isDownloading: false,

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
        if (!this.hasNext) return;
        this.resetZoom();
        this.currentIndex = (this.currentIndex + 1) % this.total;
    },

    prev() {
        if (!this.hasPrev) return;
        this.resetZoom();
        this.currentIndex = (this.currentIndex - 1 + this.total) % this.total;
    },

    zoomIn() {
        this.zoom = Math.min(3, Number((this.zoom + 0.5).toFixed(1)));
    },

    zoomOut() {
        this.zoom = Math.max(1, Number((this.zoom - 0.5).toFixed(1)));
        if (this.zoom === 1) {
            this.panX = 0;
            this.panY = 0;
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
        this.panX = 0;
        this.panY = 0;
        this.isDragging = false;
    },

    async download() {
        if (!this.currentItem || !this.currentItem.src || this.isDownloading) return;
        this.isDownloading = true;
        const url = this.currentItem.src;

        // Derive clean, safe filename
        let baseName = (this.currentItem.alt || 'downloaded-image')
            .trim()
            .toLowerCase()
            .replace(/[^a-z0-9_\-\s]/gi, '')
            .replace(/\s+/g, '-');
        if (!baseName || baseName === '-') baseName = 'image';

        try {
            const response = await fetch(url, { mode: 'cors' });
            if (!response.ok) throw new Error('Fetch status ' + response.status);
            const blob = await response.blob();

            // Determine file extension
            const mime = blob.type || '';
            let ext = 'jpg';
            if (mime.includes('png')) ext = 'png';
            else if (mime.includes('webp')) ext = 'webp';
            else if (mime.includes('svg')) ext = 'svg';
            else if (mime.includes('gif')) ext = 'gif';
            else if (mime.includes('avif')) ext = 'avif';
            else {
                const match = url.match(/\.([a-zA-Z0-9]+)(?:\?.*)?$/);
                if (match && match[1] && match[1].length <= 5) ext = match[1];
            }

            const filename = baseName.endsWith('.' + ext) ? baseName : `${baseName}.${ext}`;
            const blobUrl = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = blobUrl;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            setTimeout(() => URL.revokeObjectURL(blobUrl), 3000);
        } catch (err) {
            // Fallback for CORS: render to canvas if image loaded, or trigger direct download link
            try {
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => {
                    try {
                        const canvas = document.createElement('canvas');
                        canvas.width = img.naturalWidth;
                        canvas.height = img.naturalHeight;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0);
                        canvas.toBlob((blob) => {
                            if (blob) {
                                const blobUrl = URL.createObjectURL(blob);
                                const a = document.createElement('a');
                                a.style.display = 'none';
                                a.href = blobUrl;
                                a.download = baseName.endsWith('.jpg') ? baseName : `${baseName}.jpg`;
                                document.body.appendChild(a);
                                a.click();
                                document.body.removeChild(a);
                                setTimeout(() => URL.revokeObjectURL(blobUrl), 3000);
                            } else {
                                this.directDownload(url, baseName);
                            }
                        }, 'image/jpeg', 0.95);
                    } catch (e) {
                        this.directDownload(url, baseName);
                    }
                };
                img.onerror = () => {
                    this.directDownload(url, baseName);
                };
                img.src = url;
            } catch (e) {
                this.directDownload(url, baseName);
            }
        } finally {
            this.isDownloading = false;
        }
    },

    directDownload(url, filename) {
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
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
        if (e.touches.length === 1) {
            this.touchStartX = e.touches[0].clientX;
            this.touchStartY = e.touches[0].clientY;
        }
    },

    handleTouchEnd(e) {
        if (this.zoom > 1 || !e.changedTouches.length) return;
        const deltaX = e.changedTouches[0].clientX - this.touchStartX;
        const deltaY = e.changedTouches[0].clientY - this.touchStartY;

        // Horizontal swipe threshold: 50px
        if (Math.abs(deltaX) > 50 && Math.abs(deltaY) < 60) {
            if (deltaX < 0) {
                this.next();
            } else {
                this.prev();
            }
        }
    }
};

function tryInitStore() {
    if (window.Alpine) {
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
    // 1. Direct <vibe:image zoom> trigger
    let trigger = e.target.closest('[data-vibe-image]');
    let isGallery = false;
    let galleryWrapper = null;

    // 2. Regular <img> inside <vibe:image.gallery> wrapper
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

    // Don't open lightbox if thumbnail is in an error/fallback state
    const fallbackEl = trigger.querySelector ? trigger.querySelector('[data-image-fallback]') : null;
    if (fallbackEl && fallbackEl.style.display !== 'none' && !trigger.querySelector('img:not([data-image-fallback])')) {
        return;
    }

    e.preventDefault();
    const store = getStore();
    if (!store) return;

    if (isGallery && galleryWrapper) {
        // Collect all images within gallery wrapper
        const allItems = Array.from(galleryWrapper.querySelectorAll('[data-vibe-image], img:not([data-vibe-ignore])'));
        // Filter out duplicate inner imgs from [data-vibe-image]
        const uniqueItems = allItems.filter(el => {
            if (el.tagName === 'IMG' && el.closest('[data-vibe-image]')) return false;
            return true;
        });

        const items = uniqueItems.map(el => ({
            src: el.dataset.src || el.getAttribute('src') || '',
            alt: el.dataset.alt || el.getAttribute('alt') || '',
            caption: el.dataset.caption || el.getAttribute('title') || el.getAttribute('alt') || ''
        })).filter(item => item.src && !item.src.includes('not-found'));

        const curIndex = uniqueItems.indexOf(trigger);
        store.openWithItems(items, curIndex >= 0 ? curIndex : 0);
    } else {
        const src = trigger.dataset.src || trigger.getAttribute('src') || '';
        const alt = trigger.dataset.alt || trigger.getAttribute('alt') || '';
        const caption = trigger.dataset.caption || '';
        const group = trigger.dataset.group || '';
        const isStandalone = trigger.hasAttribute('data-standalone') || !group;

        if (isStandalone) {
            store.openStandalone({ src, alt, caption });
        } else {
            // Collect all visible images sharing the same group across the document
            const groupElements = Array.from(document.querySelectorAll(`[data-vibe-image][data-group="${group}"]`));
            const items = groupElements.map(el => ({
                src: el.dataset.src || el.getAttribute('src') || '',
                alt: el.dataset.alt || el.getAttribute('alt') || '',
                caption: el.dataset.caption || ''
            })).filter(item => item.src);
            const curIndex = groupElements.indexOf(trigger);
            store.openWithItems(items, curIndex >= 0 ? curIndex : 0);
        }
    }
});

// Global Keyboard Accessibility Handler (Enter / Space on focused thumbnail, Esc / Arrows for Lightbox)
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
