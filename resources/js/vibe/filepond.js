import * as FilePondModule from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';

import '../../css/vibe/filepond.css';

const FilePond = FilePondModule.create ? FilePondModule : (FilePondModule.default || FilePondModule);
const resolvePlugin = (p) => (typeof p === 'function' ? p : (p && p.default ? p.default : p));

// Register plugins globally
if (FilePond && typeof FilePond.registerPlugin === 'function') {
    FilePond.registerPlugin(
        resolvePlugin(FilePondPluginFileValidateSize),
        resolvePlugin(FilePondPluginFileValidateType),
        resolvePlugin(FilePondPluginImagePreview),
        resolvePlugin(FilePondPluginImageCrop),
        resolvePlugin(FilePondPluginImageResize),
        resolvePlugin(FilePondPluginImageTransform),
        resolvePlugin(FilePondPluginFileEncode)
    );
}

// Expose FilePond to window for custom user scripts
window.FilePond = FilePond;

/**
 * Global lightbox modal for viewing full-size image previews
 */
function openImageLightbox(src, title) {
    let backdrop = document.getElementById('vibe-filepond-lightbox');
    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.id = 'vibe-filepond-lightbox';
        backdrop.className = 'filepond--lightbox-backdrop';
        backdrop.innerHTML = `
            <button type="button" class="filepond--lightbox-close" title="Tutup" aria-label="Tutup">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="filepond--lightbox-content">
                <img class="filepond--lightbox-img" src="" alt="" />
                <div class="filepond--lightbox-caption"></div>
            </div>
        `;
        document.body.appendChild(backdrop);

        const closeBtn = backdrop.querySelector('.filepond--lightbox-close');
        const close = () => {
            backdrop.classList.remove('active');
            setTimeout(() => {
                backdrop.style.display = 'none';
            }, 250);
        };

        closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            close();
        });

        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop || e.target.classList.contains('filepond--lightbox-close')) {
                close();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && backdrop.classList.contains('active')) {
                close();
            }
        });
    }

    const img = backdrop.querySelector('.filepond--lightbox-img');
    const cap = backdrop.querySelector('.filepond--lightbox-caption');
    img.src = src;
    img.alt = title || 'Image preview';
    cap.textContent = title || '';

    backdrop.style.display = 'flex';
    requestAnimationFrame(() => {
        backdrop.classList.add('active');
    });
}

// Blob URL tracking is per-instance (see _blobUrls in vibeFilepond) to prevent
// cross-instance revocation bugs where destroying one instance breaks others.
// [FIX BUG-4] Helper registers a URL into the given per-instance Set.
function registerCreatedBlobUrl(url, blobUrlSet) {
    if (url && typeof url === 'string' && url.startsWith('blob:') && blobUrlSet instanceof Set) {
        blobUrlSet.add(url);
    }
    return url;
}

// [FIX WARN-1] FilePond FileStatus enum with fallback for version compatibility.
// Using the enum prevents silent breakage if FilePond changes numeric status values.
const FileStatus = (FilePondModule && FilePondModule.FileStatus) || {
    INIT: 1,
    IDLE: 2,
    PROCESSING: 3,
    PROCESSING_COMPLETE: 5,
    PROCESSING_ERROR: 6,
    LOADING: 7,
    LOAD_ERROR: 8,
    PROCESSING_QUEUED: 9
};

/**
 * Attaches modern preview thumbnail for images or document icon with badge for other files
 */
// [FIX BUG-4] Accepts per-instance blobUrlSet to avoid global Set cross-contamination
function attachCustomFileIcon(item, blobUrlSet) {
    if (!item) return;

    const findItemEl = () => {
        if (item.element && item.element.querySelector) return item.element;
        if (item.id) {
            return document.getElementById(`filepond--item-${item.id}`) ||
                   document.querySelector(`#filepond--item-${item.id}`) ||
                   document.querySelector(`[data-filepond-item-id="${item.id}"]`);
        }
        return null;
    };

    const formatBytes = (bytes, decimals = 1) => {
        if (!+bytes) return '0 B';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
    };

    const render = () => {
        const itemEl = findItemEl();
        if (!itemEl) return;

        // Skip avatar mode since it has its own circular layout
        const wrapper = itemEl.closest('.filepond-avatar-mode') || itemEl.closest('[data-vibe-filepond].filepond-avatar-mode');
        const rootEl = itemEl.closest('.filepond--root');
        if (wrapper || (rootEl && (rootEl.classList.contains('filepond-avatar-mode') || rootEl.dataset.stylePanelLayout?.includes('circle')))) {
            return;
        }

        const fileWrapper = itemEl.querySelector('.filepond--file');
        if (!fileWrapper || fileWrapper.querySelector('.filepond--custom-file-icon')) return;

        const file = item.file;
        const name = (file && file.name) ? file.name : (item.filename || '');
        const ext = (name.split('.').pop() || '').toUpperCase();
        const isImage = (file && file.type && file.type.startsWith('image/')) ||
                        ['JPG', 'JPEG', 'PNG', 'GIF', 'WEBP', 'SVG', 'AVIF'].includes(ext);

        // Ensure filename and size text are visible
        const infoMain = itemEl.querySelector('.filepond--file-info-main');
        if (infoMain && !infoMain.textContent.trim() && name) {
            infoMain.textContent = name;
        }
        const infoSub = itemEl.querySelector('.filepond--file-info-sub');
        if (infoSub && !infoSub.textContent.trim() && file && file.size) {
            infoSub.textContent = formatBytes(file.size);
        }

        let iconContainer = document.createElement('div');
        iconContainer.className = 'filepond--custom-file-icon';

        if (isImage) {
            // Determine image source URL
            let imgUrl = null;
            if (file instanceof Blob || file instanceof File) {
                try {
                    imgUrl = registerCreatedBlobUrl(URL.createObjectURL(file), blobUrlSet);
                } catch (e) {
                    imgUrl = null;
                }
            } else if (typeof item.source === 'string' && item.source.length > 0) {
                imgUrl = item.source;
            } else if (typeof item.file === 'string' && item.file.length > 0) {
                imgUrl = item.file;
            }

            if (imgUrl) {
                iconContainer.classList.add('filepond--thumbnail-preview-container');
                iconContainer.setAttribute('title', 'Klik untuk melihat pratinjau penuh');
                // [FIX QA-5] Escape filename to prevent XSS in alt attribute
                const escapedName = name.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                iconContainer.innerHTML = `
                    <div class="filepond--thumbnail-wrapper">
                        <img src="${imgUrl}" alt="${escapedName}" class="filepond--thumbnail-img" />
                        <div class="filepond--thumbnail-overlay">
                            <svg class="filepond--thumbnail-zoom-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                <line x1="11" y1="8" x2="11" y2="14"></line>
                                <line x1="8" y1="11" x2="14" y2="11"></line>
                            </svg>
                        </div>
                    </div>
                `;

                const imgEl = iconContainer.querySelector('.filepond--thumbnail-img');
                imgEl.onerror = () => {
                    // Fallback to badge icon if image decoding fails
                    const fallback = document.createElement('div');
                    fallback.className = 'filepond--custom-file-icon';
                    fallback.innerHTML = `
                        <div class="filepond--doc-icon-wrapper">
                            <svg class="filepond--doc-sheet-svg" viewBox="0 0 32 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 4C2 2.89543 2.89543 2 4 2H19.5858C20.1163 2 20.625 2.21071 21 2.58579L29.4142 11C29.7893 11.375 30 11.8837 30 12.4142V34C30 35.1046 29.1046 36 28 36H4C2.89543 36 2 35.1046 2 34V4Z" class="filepond--doc-sheet-bg" stroke="currentColor" stroke-width="1.75"/>
                                <path d="M19 2V10C19 11.1046 19.8954 12 21 12H29" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
                            </svg>
                            <span class="filepond--ext-badge filepond-badge-img">${ext.slice(0, 4) || 'IMG'}</span>
                        </div>
                    `;
                    iconContainer.replaceWith(fallback);
                };

                iconContainer.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openImageLightbox(imgUrl, name);
                });

                fileWrapper.prepend(iconContainer);
                return;
            }
        }

        // Non-image or fallback: Document Sheet Icon with Colored Badge
        let badgeClass = 'filepond-badge-generic';
        if (['PDF'].includes(ext)) badgeClass = 'filepond-badge-pdf';
        else if (['DOC', 'DOCX', 'TXT', 'RTF', 'ODT'].includes(ext)) badgeClass = 'filepond-badge-doc';
        else if (['XLS', 'XLSX', 'CSV', 'ODS'].includes(ext)) badgeClass = 'filepond-badge-sheet';
        else if (['PPT', 'PPTX', 'KEY'].includes(ext)) badgeClass = 'filepond-badge-pres';
        else if (['ZIP', 'RAR', '7Z', 'TAR', 'GZ'].includes(ext)) badgeClass = 'filepond-badge-zip';
        else if (['MP4', 'MOV', 'AVI', 'MKV', 'WEBM'].includes(ext)) badgeClass = 'filepond-badge-video';
        else if (['MP3', 'WAV', 'OGG', 'FLAC', 'AAC'].includes(ext)) badgeClass = 'filepond-badge-audio';
        else if (['JPG', 'JPEG', 'PNG', 'GIF', 'WEBP', 'SVG'].includes(ext)) badgeClass = 'filepond-badge-img';

        iconContainer.innerHTML = `
            <div class="filepond--doc-icon-wrapper">
                <svg class="filepond--doc-sheet-svg" viewBox="0 0 32 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 4C2 2.89543 2.89543 2 4 2H19.5858C20.1163 2 20.625 2.21071 21 2.58579L29.4142 11C29.7893 11.375 30 11.8837 30 12.4142V34C30 35.1046 29.1046 36 28 36H4C2.89543 36 2 35.1046 2 34V4Z" class="filepond--doc-sheet-bg" stroke="currentColor" stroke-width="1.75"/>
                    <path d="M19 2V10C19 11.1046 19.8954 12 21 12H29" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round"/>
                </svg>
                <span class="filepond--ext-badge ${badgeClass}">${ext.slice(0, 4) || 'FILE'}</span>
            </div>
        `;

        fileWrapper.prepend(iconContainer);
    };

    render();
    requestAnimationFrame(() => {
        render();
        setTimeout(render, 60);
    });
}

/**
 * Alpine.js FilePond Component Factory
 */
export function vibeFilepond(config = {}) {
    return {
        pond: null,
        input: null,
        uploadedKeys: [],
        activeUploads: new Set(),
        _blobUrls: new Set(), // [FIX BUG-4] Per-instance blob URL tracking
        _isNavigatingAway: false,
        _cleanupListeners: [],

        // Reactive states for Alpine
        isUploading: false,
        fileCount: 0,
        files: [],
        hasError: Boolean(config.hasError),
        serverError: config.errorMessage || null, // Runtime error from server or validation

        init() {
            this.input = this.$refs.input || this.$el.querySelector('input[type="file"]');
            if (!this.input) return;

            if (typeof this.$cleanup === 'function') {
                this.$cleanup(() => this.destroy());
            }

            // Strip any accidental sr-only class from input element so FilePond does not inherit it
            if (this.input.classList && this.input.classList.contains('sr-only')) {
                this.input.classList.remove('sr-only');
            }

            // Sync config.name if input's name was changed externally (e.g. by dynamic-form auto-namespacing)
            if (this.input && this.input.name && this.input.name !== config.name) {
                config.name = this.input.name.replace(/\[\]$/, '');
            }

            if (FilePond && typeof FilePond.find === 'function') {
                const existing = FilePond.find(this.input);
                if (existing) {
                    this.pond = existing;
                    this.updateReactiveState();
                    const existingFallback = this.$el ? this.$el.querySelector('.filepond--fallback-dropzone') : null;
                    if (existingFallback) existingFallback.remove();
                    return;
                }
            }

            if (this.$el) {
                this.$el.__vibe_pond_inited = true;
            }

            const self = this;
            const pondOptions = this.buildPondOptions(config, self);

            this.pond = FilePond.create(this.input, pondOptions);
            this.updateReactiveState();

            // In avatar mode, ensure the root element has avatar class and clicking anywhere in the circle opens file picker
            if (config.avatar && this.pond.element) {
                this.pond.element.classList.add('filepond-avatar-mode');
                this.pond.element.addEventListener('click', (e) => {
                    if (e.target.closest('.filepond--file-action-button') || e.target.closest('.filepond--action-remove-item')) {
                        return;
                    }
                    if (this.pond && this.pond.getFiles().length === 0) {
                        this.browse();
                    }
                });
            }

            // Remove server-side fallback dropzone now that FilePond is mounted
            const fallbackEl = this.$el ? this.$el.querySelector('.filepond--fallback-dropzone') : null;
            if (fallbackEl) {
                fallbackEl.remove();
            }

            // Setup Upload Protection (Blocks submit & navigation while uploads are in progress)
            this.setupUploadProtection(config);


            // [FIX WARN-4] Always destroy pond on Livewire navigation to prevent memory leaks.
            // Previous condition was too restrictive and could leave FilePond instances alive.
            this._cleanupHandler = () => {
                if (this.pond) {
                    try {
                        this.pond.destroy();
                    } catch (e) {}
                    this.pond = null;
                }
            };
            document.addEventListener('livewire:navigating', this._cleanupHandler);
        },

        destroy() {
            // [FIX BUG-4] Revoke only this instance's blob URLs — not all instances'
            if (this._blobUrls) {
                this._blobUrls.forEach(url => { try { URL.revokeObjectURL(url); } catch (e) {} });
                this._blobUrls.clear();
            }
            if (this._cleanupHandler) {
                document.removeEventListener('livewire:navigating', this._cleanupHandler);
            }
            if (Array.isArray(this._cleanupListeners)) {
                this._cleanupListeners.forEach(fn => {
                    try { fn(); } catch (e) {}
                });
                this._cleanupListeners = [];
            }
            if (this.pond) {
                try {
                    this.pond.destroy();
                } catch (e) {}
                this.pond = null;
            }
        },

        // Public Programmatic API
        browse() {
            if (this.pond && typeof this.pond.browse === 'function') {
                this.pond.browse();
            } else if (this.input) {
                this.input.click();
            }
        },

        clear() {
            this.serverError = null;
            this.hasError = false;
            if (this.pond && typeof this.pond.removeFiles === 'function') {
                this.pond.removeFiles();
            }
            this.uploadedKeys = [];
            this.updateHiddenInputs(config);
            this.updateReactiveState();
        },

        setName(newName) {
            if (!newName) return;
            const cleanName = newName.replace(/\[\]$/, '');
            config.name = cleanName;
            if (this.input) {
                this.input.name = config.multiple ? `${cleanName}[]` : cleanName;
            }
            if (this.pond && typeof this.pond.setOptions === 'function') {
                this.pond.setOptions({ name: cleanName });
            }
            if (this.$el) {
                this.$el.querySelectorAll('input').forEach(inp => {
                    const isMultiple = inp.getAttribute('name')?.endsWith('[]');
                    inp.setAttribute('name', isMultiple ? `${cleanName}[]` : cleanName);
                });
            }
        },

        removeFiles() {
            this.clear();
        },

        getFiles() {
            return this.pond && typeof this.pond.getFiles === 'function' ? this.pond.getFiles() : [];
        },

        removeFile(query) {
            if (this.pond && typeof this.pond.removeFile === 'function') {
                this.pond.removeFile(query);
            }
            this.updateReactiveState();
        },

        processFiles() {
            if (this.pond && typeof this.pond.processFiles === 'function') {
                this.pond.processFiles();
            }
        },

        updateReactiveState() {
            this.isUploading = this.hasPendingUploads();
            this.fileCount = this.pond && typeof this.pond.getFiles === 'function' ? this.pond.getFiles().length : 0;
            this.files = this.pond && typeof this.pond.getFiles === 'function' ? this.pond.getFiles() : [];
        },

        extractErrorMessage(err) {
            if (!err) return null;
            if (typeof err === 'string') {
                try {
                    const parsed = JSON.parse(err);
                    return this.extractErrorMessage(parsed);
                } catch (e) {
                    return err;
                }
            }
            if (typeof err === 'object') {
                if (err.body) {
                    return this.extractErrorMessage(err.body);
                }
                if (err.errors && typeof err.errors === 'object') {
                    const firstField = Object.values(err.errors).flat();
                    if (firstField.length && firstField[0]) return String(firstField[0]);
                }
                if (err.message && typeof err.message === 'string') {
                    return err.message;
                }
                if (err.main) {
                    return err.main + (err.sub ? ': ' + err.sub : '');
                }
                if (err.type === 'error' && err.body) {
                    return this.extractErrorMessage(err.body);
                }
            }
            return 'An error occurred during upload';
        },

        // Centralized Event Dispatcher
        fireEvent(action, data = {}) {
            const pondId = config.id || (this.input ? this.input.id : 'filepond');
            const name = config.name || (this.input ? this.input.name : '');
            const item = data.item || null;
            const file = data.file || (item ? (item.file instanceof File ? item.file : item.file) : null);
            const filename = data.filename || (file && file.name) || (item && item.filename) || (typeof data.file === 'string' ? data.file : '') || '';
            const size = data.size !== undefined ? data.size : ((file && file.size) ? file.size : (item && item.fileSize ? item.fileSize : 0));
            const type = data.type || (file && file.type) || (item && item.fileType ? item.fileType : '') || '';
            const key = data.key || (item && item.serverId) || (typeof data.file === 'string' ? data.file : null);
            const keys = Array.isArray(data.keys) ? data.keys : this.uploadedKeys;
            const progress = data.progress !== undefined ? data.progress : (action === 'success' ? 100 : 0);
            const loaded = data.loaded !== undefined ? data.loaded : Math.round((size || 0) * (progress / 100));
            const total = data.total !== undefined ? data.total : (size || 0);
            const error = data.error || null;

            const detail = {
                id: pondId,
                name: name,
                event: action, // 'add' | 'start' | 'progress' | 'success' | 'revert' | 'abort' | 'remove' | 'error'
                file: file,
                filename: filename,
                size: size,
                type: type,
                progress: progress,
                loaded: loaded,
                total: total,
                key: key,
                keys: keys,
                error: error,
                item: item,
                pond: this.pond
            };

            // [FIX DOUBLE-FIRE] Alpine's $dispatch fires a bubbling CustomEvent that naturally
            // propagates to window — so @vibe-filepond.window listeners catch it automatically.
            // Calling window.dispatchEvent separately fires a SECOND event on window, causing
            // every action to appear twice in event monitors. window.dispatchEvent is only used
            // as a fallback when $dispatch (Alpine context) is not available.

            const hasDispatch = typeof this.$dispatch === 'function';

            // 1. Unified Event: 'vibe-filepond'
            if (hasDispatch) {
                this.$dispatch('vibe-filepond', detail);
            } else {
                if (this.$el) this.$el.dispatchEvent(new CustomEvent('vibe-filepond', { detail, bubbles: true, composed: true }));
                window.dispatchEvent(new CustomEvent('vibe-filepond', { detail }));
            }

            // 2. Action Event: 'vibe-filepond:{action}'
            if (hasDispatch) {
                this.$dispatch(`vibe-filepond:${action}`, detail);
            } else {
                if (this.$el) this.$el.dispatchEvent(new CustomEvent(`vibe-filepond:${action}`, { detail, bubbles: true, composed: true }));
                window.dispatchEvent(new CustomEvent(`vibe-filepond:${action}`, { detail }));
            }

            // 3. Targeted Event: 'vibe-filepond:{id}:{action}'
            if (hasDispatch) {
                this.$dispatch(`vibe-filepond:${pondId}:${action}`, detail);
            } else {
                if (this.$el) this.$el.dispatchEvent(new CustomEvent(`vibe-filepond:${pondId}:${action}`, { detail, bubbles: true, composed: true }));
                window.dispatchEvent(new CustomEvent(`vibe-filepond:${pondId}:${action}`, { detail }));
            }

            // 4. Local shorthand: 'file-{action}' (element-scoped only, no window)
            if (hasDispatch) {
                this.$dispatch(`file-${action}`, detail);
            } else if (this.$el) {
                this.$el.dispatchEvent(new CustomEvent(`file-${action}`, { detail, bubbles: true, composed: true }));
            }

            // 5. Backward compatibility for legacy listeners
            if (action === 'add') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-addfile', { item: file });
            } else if (action === 'start') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-processfilestart', { item: file });
            } else if (action === 'success') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-processfile', { item: file });
            } else if (action === 'abort') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-processfileabort', { item: file });
            } else if (action === 'revert') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-processfilerevert', { item: file });
            } else if (action === 'remove') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-removefile', { item: file });
            } else if (action === 'error') {
                if (this.$dispatch) this.$dispatch('vibe-filepond-error', { error: error, item: item });
            }
        },

        buildPondOptions(cfg, self) {
            const options = {
                name: cfg.name || (self.input ? self.input.name : null),
                credits: false,
                className: cfg.className || '',
                allowMultiple: Boolean(cfg.multiple),
                maxFiles: cfg.maxFiles ? parseInt(cfg.maxFiles, 10) : null,
                disabled: Boolean(cfg.disabled),
                required: Boolean(cfg.required),

                // File validation
                allowFileSizeValidation: Boolean(cfg.maxFileSize || cfg.minFileSize || cfg.maxTotalFileSize),
                maxFileSize: cfg.maxFileSize || null,
                minFileSize: cfg.minFileSize || null,
                maxTotalFileSize: cfg.maxTotalFileSize || null,

                allowFileTypeValidation: Boolean(cfg.acceptedFileTypes && cfg.acceptedFileTypes.length),
                acceptedFileTypes: Array.isArray(cfg.acceptedFileTypes)
                    ? cfg.acceptedFileTypes
                    : (cfg.acceptedFileTypes ? cfg.acceptedFileTypes.split(',').map(s => s.trim()) : null),

                // Image features
                allowImagePreview: cfg.imagePreview !== false,
                imagePreviewHeight: cfg.imagePreviewHeight ? parseInt(cfg.imagePreviewHeight, 10) : (cfg.avatar ? 130 : null),
                imagePreviewMinHeight: cfg.imagePreviewMinHeight ? parseInt(cfg.imagePreviewMinHeight, 10) : (cfg.avatar ? 130 : null),
                imagePreviewMaxHeight: cfg.imagePreviewMaxHeight ? parseInt(cfg.imagePreviewMaxHeight, 10) : (cfg.avatar ? 130 : null),

                allowImageCrop: Boolean(cfg.imageCrop || cfg.imageCropAspectRatio || cfg.avatar),
                imageCropAspectRatio: cfg.avatar ? '1:1' : (cfg.imageCropAspectRatio || null),

                allowImageResize: Boolean(cfg.imageResize || cfg.imageResizeTargetWidth || cfg.imageResizeTargetHeight || cfg.avatar),
                imageResizeTargetWidth: cfg.avatar ? 260 : (cfg.imageResizeTargetWidth ? parseInt(cfg.imageResizeTargetWidth, 10) : null),
                imageResizeTargetHeight: cfg.avatar ? 260 : (cfg.imageResizeTargetHeight ? parseInt(cfg.imageResizeTargetHeight, 10) : null),
                imageResizeMode: cfg.imageResizeMode || 'cover',

                allowImageTransform: Boolean(cfg.imageTransform || cfg.imageCrop || cfg.imageResize || cfg.avatar),
                imageTransformOutputQuality: cfg.imageQuality ? parseInt(cfg.imageQuality, 10) : null,

                // File encode (base64)
                allowFileEncode: Boolean(cfg.encode),

                // Native form file sync (syncs FilePond files to native file input for form POST)
                // [FIX QA-3] Handle null (PHP null !== JS undefined) to allow Blade prop override
                storeAsFile: (cfg.storeAsFile !== null && cfg.storeAsFile !== undefined) ? Boolean(cfg.storeAsFile) : (!cfg.server && !cfg.presignUrl && !cfg.wireModel),

                // Avatar / Circle styling
                stylePanelLayout: cfg.avatar ? 'compact circle' : (cfg.panelLayout || null),
                styleLoadIndicatorPosition: cfg.avatar ? 'center bottom' : (cfg.loadIndicatorPosition || 'right'),
                styleProgressIndicatorPosition: cfg.avatar ? 'right bottom' : (cfg.progressIndicatorPosition || 'right'),
                styleButtonRemoveItemPosition: cfg.avatar ? 'left bottom' : (cfg.buttonRemoveItemPosition || 'left'),
                styleButtonProcessItemPosition: cfg.avatar ? 'right bottom' : (cfg.buttonProcessItemPosition || 'right'),

                // Modern crisp SVG icons (replaces FilePond's tiny 8px padded icons)
                iconRemove: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
                iconRetry: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>',
                iconProcess: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5"/><path d="m5 12 7-7 7 7"/></svg>',
                iconUndo: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/></svg>',

                // Labels & Translations
                ...(cfg.labels || {}),

                // Preloaded / Existing Files
                files: this.resolveInitialFiles(cfg.existingFiles),

                // Callbacks & Events
                oninitfile: (item) => {
                    attachCustomFileIcon(item, self._blobUrls); // [FIX BUG-4] pass per-instance set
                },
                onaddfilestart: (item) => {
                    self.serverError = null;
                    self.hasError = false;
                },
                onaddfile: (err, item) => {
                    if (err) {
                        self.hasError = true;
                        self.serverError = self.extractErrorMessage(err);
                        self.fireEvent('error', { error: err, item: item });
                        return;
                    }
                    attachCustomFileIcon(item, self._blobUrls); // [FIX BUG-4] pass per-instance set
                    self.updateReactiveState();
                    self.fireEvent('add', { item: item });
                },
                onerror: (err, item, status) => {
                    self.hasError = true;
                    if (!self.serverError) {
                        self.serverError = self.extractErrorMessage(err);
                    }
                    self.fireEvent('error', { error: err, item: item, status: status });
                },
                onprocessfilestart: (item) => {
                    if (item && item.id) {
                        self.activeUploads.add(item.id);
                    }
                    self.updateReactiveState();
                    self.fireEvent('start', { item: item });
                },
                onprocessfileprogress: (item, progress) => {
                    const percent = Math.round((progress || 0) * 100);
                    const fileSize = item?.fileSize || (item?.file ? item.file.size : 0);
                    const loaded = Math.round(fileSize * (progress || 0));
                    self.fireEvent('progress', {
                        item: item,
                        progress: percent,
                        loaded: loaded,
                        total: fileSize,
                        filename: item?.filename || item?.file?.name,
                        size: fileSize,
                        file: item?.file
                    });
                },
                onprocessfile: (err, item) => {
                    if (item && item.id) {
                        self.activeUploads.delete(item.id);
                    }
                    self.updateReactiveState();
                    if (err) {
                        self.hasError = true;
                        if (!self.serverError) {
                            self.serverError = self.extractErrorMessage(err);
                        }
                        self.fireEvent('error', { error: err, item: item });
                        return;
                    }
                    self.serverError = null; // clear any previous server error on successful upload
                    self.hasError = false;
                    self.fireEvent('success', { item: item, key: item?.serverId, progress: 100 });
                },
                onprocessfileabort: (item) => {
                    if (item && item.id) {
                        self.activeUploads.delete(item.id);
                    }
                    self.updateReactiveState();
                    self.serverError = null; // clear server error on abort
                    self.hasError = false;
                    self.fireEvent('abort', { item: item });
                },
                onprocessfilerevert: (item) => {
                    if (item && item.id) {
                        self.activeUploads.delete(item.id);
                    }
                    self.updateReactiveState();
                    self.serverError = null; // clear server error on revert
                    self.hasError = false;
                    self.fireEvent('revert', { item: item, key: item?.serverId });
                },
                onremovefile: (err, item) => {
                    if (item && item.id) {
                        self.activeUploads.delete(item.id);
                    }
                    self.updateReactiveState();
                    self.serverError = null; // clear server error when file is removed
                    self.hasError = false;
                    self.fireEvent('remove', { item: item });
                }
            };

            // Setup Server Handling (Presigned URL > Livewire wire:model > Standard server > Default)
            options.server = this.resolveServerConfig(cfg, self);

            return options;
        },

        resolveInitialFiles(files) {
            if (!files) return [];
            if (typeof files === 'string') {
                return [{ source: files, options: { type: 'local' } }];
            }
            if (Array.isArray(files)) {
                return files.map(file => {
                    if (typeof file === 'string') {
                        return { source: file, options: { type: 'local' } };
                    }
                    return file;
                });
            }
            return [];
        },

        resolveServerConfig(cfg, self) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';


            // 1. Presigned URL Direct-to-Cloud Upload (S3, Cloudflare R2, GCS, MinIO)
            if (cfg.presignUrl) {
                return {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const uploadId = (metadata && metadata.id) ? metadata.id : (file.name + '_' + file.size + '_' + Math.random());
                        self.activeUploads.add(uploadId);
                        self.updateReactiveState();

                        // Immediately activate FilePond indicator (indeterminate busy spinner)
                        progress(false, 0, 0);

                        const startDetail = { name: file.name, filename: file.name, size: file.size, type: file.type, file };
                        self.fireEvent('start', startDetail);
                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-start', { detail: startDetail }));
                        if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-start', startDetail);

                        const requestPayload = {
                            filename: file.name,
                            size: file.size,
                            type: file.type || 'application/octet-stream'
                        };

                        const xhrPresign = new XMLHttpRequest();
                        let xhrUpload = null;

                        let presignUrl = cfg.presignUrl;
                        if (typeof presignUrl === 'string' && typeof window !== 'undefined' && window.location && window.location.protocol === 'https:' && presignUrl.startsWith('http:')) {
                            try {
                                const parsed = new URL(presignUrl, window.location.origin);
                                if (parsed.host === window.location.host) {
                                    presignUrl = presignUrl.replace(/^http:/, 'https:');
                                }
                            } catch (e) {}
                        }

                        xhrPresign.open('POST', presignUrl, true);
                        xhrPresign.setRequestHeader('Content-Type', 'application/json');
                        xhrPresign.setRequestHeader('Accept', 'application/json');
                        xhrPresign.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        if (csrfToken) xhrPresign.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                        xhrPresign.onload = () => {
                            if (xhrPresign.status >= 200 && xhrPresign.status < 300) {
                                // Guard against HTML responses (e.g. redirected by web middleware or session expiry)
                                const contentType = xhrPresign.getResponseHeader('Content-Type') || '';
                                if (contentType.includes('text/html') || (xhrPresign.responseText && xhrPresign.responseText.trim().startsWith('<'))) {
                                    self.activeUploads.delete(uploadId);
                                    self.updateReactiveState();
                                    self.hasError = true;
                                    const errMsg = 'Endpoint presigned mengembalikan HTML (bukan JSON). Pastikan endpoint mengembalikan JSON.';
                                    self.serverError = errMsg;
                                    error(errMsg);
                                    self.fireEvent('error', { error: errMsg, file });
                                    return;
                                }

                                try {
                                    const response = JSON.parse(xhrPresign.responseText);
                                    let uploadUrl = response.url || response.upload_url || response.presigned_url;
                                    let customHeaders = response.headers || {};

                                    // If Laravel returned temporaryUploadUrl array directly ({ url: { url: '...', headers: {} } })
                                    if (uploadUrl && typeof uploadUrl === 'object') {
                                        if (uploadUrl.headers && Object.keys(customHeaders).length === 0) {
                                            customHeaders = uploadUrl.headers;
                                        }
                                        uploadUrl = uploadUrl.url || uploadUrl.upload_url || uploadUrl.presigned_url;
                                    }

                                    let fileKey = response.key || response.path || response.file_key;
                                    if (!fileKey && uploadUrl && typeof uploadUrl === 'string') {
                                        try {
                                            const parsedUrl = new URL(uploadUrl);
                                            const rawPath = decodeURIComponent(parsedUrl.pathname).replace(/^\//, '');
                                            const pathParts = rawPath.split('/');
                                            fileKey = pathParts.length > 1 ? pathParts.slice(1).join('/') : rawPath;
                                        } catch (e) {
                                            fileKey = file.name;
                                        }
                                    }
                                    if (!fileKey) fileKey = file.name;

                                    const method = response.method || cfg.presignMethod || 'PUT';

                                    if (!uploadUrl || typeof uploadUrl !== 'string') {
                                        self.activeUploads.delete(uploadId);
                                        self.updateReactiveState();
                                        self.hasError = true;
                                        const errMsg = 'Presigned response missing upload URL';
                                        self.serverError = errMsg;
                                        error(errMsg);
                                        self.fireEvent('error', { error: errMsg, file });
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg } }));
                                        return;
                                    }

                                    // Upload direct to Cloud
                                    xhrUpload = new XMLHttpRequest();
                                    xhrUpload.open(method, uploadUrl, true);

                                    // Set Content-Type for PUT if required
                                    if (method.toUpperCase() === 'PUT' && file.type) {
                                        xhrUpload.setRequestHeader('Content-Type', file.type);
                                    }

                                    // Set custom presigned headers (ignoring forbidden headers like Host)
                                    const forbiddenHeaders = ['host', 'content-length', 'connection'];
                                    for (const [hKey, hVal] of Object.entries(customHeaders)) {
                                        if (!forbiddenHeaders.includes(hKey.toLowerCase())) {
                                            xhrUpload.setRequestHeader(hKey, Array.isArray(hVal) ? hVal.join(', ') : hVal);
                                        }
                                    }

                                    xhrUpload.upload.onprogress = (e) => {
                                        if (e.lengthComputable) {
                                            // [FIX BUG-5] Only call progress() — this triggers FilePond's onprocessfileprogress
                                            // which fires fireEvent('progress'). Calling fireEvent here directly would duplicate it.
                                            progress(true, e.loaded, e.total);
                                            // Dispatch presigned-specific legacy event only (not unified, to avoid duplication)
                                            const pct = Math.round((e.loaded / e.total) * 100);
                                            const progressDetail = { loaded: e.loaded, total: e.total, percentage: pct, progress: pct, fileKey, key: fileKey, filename: file.name, file };
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-progress', { detail: progressDetail }));
                                            if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-progress', progressDetail);
                                        }
                                    };

                                    xhrUpload.onload = () => {
                                        self.activeUploads.delete(uploadId);
                                        self.updateReactiveState();
                                        if (xhrUpload.status >= 200 && xhrUpload.status < 300) {
                                            progress(true, file.size, file.size);
                                            load(fileKey);
                                            self.handleUploadSuccess(fileKey, cfg, file);
                                            const successDetail = { key: fileKey, url: uploadUrl.split('?')[0], isLocal: Boolean(response.is_local), filename: file.name, size: file.size, file };
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-success', { detail: successDetail }));
                                            if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-success', successDetail);
                                        } else {
                                            self.hasError = true;
                                            const errMsg = 'Direct upload failed with HTTP ' + xhrUpload.status;
                                            self.serverError = errMsg;
                                            error(errMsg);
                                            self.fireEvent('error', { error: errMsg, status: xhrUpload.status, file });
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg, status: xhrUpload.status } }));
                                        }
                                    };

                                    xhrUpload.onerror = () => {
                                        self.activeUploads.delete(uploadId);
                                        self.updateReactiveState();
                                        self.hasError = true;
                                        const errMsg = 'Network error during cloud upload';
                                        self.serverError = errMsg;
                                        error(errMsg);
                                        self.fireEvent('error', { error: errMsg, file });
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg } }));
                                    };

                                    xhrUpload.send(file);
                                } catch (e) {
                                    self.activeUploads.delete(uploadId);
                                    self.updateReactiveState();
                                    self.hasError = true;
                                    const errMsg = 'Error parsing presigned JSON: ' + e.message;
                                    self.serverError = errMsg;
                                    error(errMsg);
                                    self.fireEvent('error', { error: errMsg, file });
                                }
                            } else {
                                self.activeUploads.delete(uploadId);
                                self.updateReactiveState();
                                self.hasError = true;
                                // Parse Laravel validation error (422) or generic HTTP error
                                let errMsg = xhrPresign.statusText || 'Request failed';
                                try {
                                    const errJson = JSON.parse(xhrPresign.responseText);
                                    const extracted = self.extractErrorMessage(errJson);
                                    if (extracted) errMsg = extracted;
                                } catch (e) {
                                    if (xhrPresign.responseText) errMsg = xhrPresign.responseText;
                                }
                                self.serverError = errMsg;
                                error(errMsg);
                                self.fireEvent('error', { error: errMsg, status: xhrPresign.status, file, filename: file.name });
                            }
                        };

                        xhrPresign.onerror = () => {
                            self.activeUploads.delete(uploadId);
                            self.updateReactiveState();
                            self.hasError = true;
                            const errMsg = 'Network error requesting presigned URL';
                            self.serverError = errMsg;
                            error(errMsg);
                            self.fireEvent('error', { error: errMsg, file, filename: file.name });
                        };

                        xhrPresign.send(JSON.stringify(requestPayload));

                        return {
                            abort: () => {
                                self.activeUploads.delete(uploadId);
                                self.updateReactiveState();
                                if (xhrUpload) {
                                    xhrUpload.abort();
                                }
                                xhrPresign.abort();
                                abort();
                                self.fireEvent('abort', { filename: file.name, file });
                                window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-abort'));
                            }
                        };
                    },

                    revert: (uniqueFileId, load, error) => {
                        self.handleUploadRevert(uniqueFileId, cfg);
                        load();
                    }
                };
            }

            // 2. Native Livewire v3 Mode
            if (cfg.wireModel && self.$wire) {
                return {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const uploadId = (metadata && metadata.id) ? metadata.id : (file.name + '_' + file.size + '_' + Math.random());
                        self.activeUploads.add(uploadId);
                        self.updateReactiveState();
                        self.fireEvent('start', { filename: file.name, size: file.size, type: file.type, file });

                        self.$wire.upload(
                            cfg.wireModel,
                            file,
                            (uploadedFilename) => {
                                self.activeUploads.delete(uploadId);
                                self.updateReactiveState();
                                load(uploadedFilename);
                                self.fireEvent('success', { file: uploadedFilename, filename: uploadedFilename, key: uploadedFilename });
                                self.$dispatch('vibe-filepond-uploaded', { file: uploadedFilename });
                            },
                            () => {
                                self.activeUploads.delete(uploadId);
                                self.updateReactiveState();
                                self.hasError = true;
                                const errMsg = 'Livewire upload failed';
                                self.serverError = errMsg;
                                error(errMsg);
                                self.fireEvent('error', { error: errMsg, file });
                                self.$dispatch('vibe-filepond-error', { error: errMsg });
                            },
                            (event) => {
                                progress(event.detail.progress, event.detail.progress, 100);
                                self.fireEvent('progress', { progress: event.detail.progress, filename: file.name, file });
                            }
                        );
                    },
                    revert: (filename, load) => {
                        if (typeof self.$wire.removeUpload === 'function') {
                            self.$wire.removeUpload(cfg.wireModel, filename, load);
                        } else {
                            load();
                        }
                        self.fireEvent('revert', { file: filename, filename: filename, key: filename });
                        self.$dispatch('vibe-filepond-reverted', { file: filename });
                    }
                };
            }

            // 3. Custom Server Endpoint Config
            if (cfg.server) {
                if (typeof cfg.server === 'string') {
                    return {
                        url: cfg.server,
                        headers: csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}
                    };
                }
                return {
                    ...cfg.server,
                    headers: {
                        ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
                        ...(cfg.server.headers || {})
                    }
                };
            }

            // 4. File Encode or Default (null means FilePond will not upload async)
            return null;
        },

        handleUploadSuccess(fileKey, cfg, fileObj = null) {
            if (cfg.multiple) {
                this.uploadedKeys.push(fileKey);
            } else {
                this.uploadedKeys = [fileKey];
            }

            // If Livewire wire:model is set with Presigned URL, sync key to Livewire property
            if (cfg.wireModel && this.$wire) {
                const val = cfg.multiple ? this.uploadedKeys : fileKey;
                this.$wire.set(cfg.wireModel, val);
            }

            // Update hidden inputs if present for regular forms
            this.updateHiddenInputs(cfg);
            this.updateReactiveState();

            // [FIX BUG-8] Guard against missing $dispatch in fallback Alpine context
            if (this.$dispatch) {
                this.$dispatch('vibe-filepond-presigned-success', { key: fileKey, keys: this.uploadedKeys });
            }
        },

        handleUploadRevert(fileKey, cfg) {
            this.uploadedKeys = this.uploadedKeys.filter(k => k !== fileKey);

            if (cfg.wireModel && this.$wire) {
                const val = cfg.multiple ? this.uploadedKeys : (this.uploadedKeys[0] || null);
                this.$wire.set(cfg.wireModel, val);
            }

            this.updateHiddenInputs(cfg);
            this.updateReactiveState();

            // [FIX BUG-8] Guard against missing $dispatch in fallback Alpine context
            if (this.$dispatch) {
                this.$dispatch('vibe-filepond-presigned-revert', { key: fileKey, keys: this.uploadedKeys });
            }
        },

        updateHiddenInputs(cfg) {
            const hiddenContainer = this.$refs.hiddenContainer;
            if (!hiddenContainer || !cfg.name) return;

            hiddenContainer.innerHTML = '';
            if (cfg.multiple) {
                this.uploadedKeys.forEach(k => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `${cfg.name}[]`;
                    input.value = k;
                    hiddenContainer.appendChild(input);
                });
            } else if (this.uploadedKeys.length) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = cfg.name;
                input.value = this.uploadedKeys[0];
                hiddenContainer.appendChild(input);
            }
        },

        hasPendingUploads() {
            if (this.activeUploads && this.activeUploads.size > 0) {
                return true;
            }
            if (this.pond && typeof this.pond.getFiles === 'function') {
                try {
                    const files = this.pond.getFiles();
                    return files.some(item => {
                        const s = item.status;
                        // [FIX WARN-1] Use FileStatus enum (version-safe) instead of hardcoded numbers
                        return s === FileStatus.INIT ||
                               s === FileStatus.PROCESSING ||
                               s === FileStatus.LOADING ||
                               s === FileStatus.PROCESSING_QUEUED;
                    });
                } catch (e) {}
            }
            return false;
        },

        setupUploadProtection(cfg) {
            const protect = cfg.protect;
            if (!protect || !protect.enabled) return;

            const self = this;

            // 1. Form Submit Protection
            if (protect.protectSubmit !== false) {
                const handleSubmit = (e) => {
                    if (self._isNavigatingAway) return;

                    // Check if the submitted form contains this filepond instance
                    const form = self.$el ? self.$el.closest('form') : null;
                    const eventForm = e.target && e.target.tagName === 'FORM' ? e.target : e.target?.closest?.('form');

                    if (form && eventForm && (form === eventForm || form.contains(e.target))) {
                        if (self.hasPendingUploads()) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            e.stopPropagation();
                            self.showSubmitBlockedAlert(protect);
                            return false;
                        }
                    }
                };

                // Capture phase ensures we intercept before form submit / button click handlers
                document.addEventListener('submit', handleSubmit, { capture: true });
                this._cleanupListeners.push(() => {
                    document.removeEventListener('submit', handleSubmit, { capture: true });
                });
            }

            // 2. Navigation Protection (Links, Livewire, & Popstate)
            if (protect.preventNavigation !== false) {
                const handleLinkNavigation = (e) => {
                    if (self._isNavigatingAway || window.__vibeFilepondBypassProtection) return;
                    if (!self.hasPendingUploads()) return;

                    const link = e.target.closest('a');
                    if (!link) return;

                    const href = link.getAttribute('href');
                    if (!href) return;

                    // Ignore anchor jumps on same page, javascript:, mailto:, tel:, new window, download
                    if (href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
                    if (link.target && link.target !== '_self') return;
                    if (link.hasAttribute('download')) return;
                    if (e.button !== undefined && e.button !== 0) return;
                    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

                    // Check if link target is current page URL (same page hash jump)
                    try {
                        const targetUrl = new URL(link.href, window.location.href);
                        const currentUrl = new URL(window.location.href);
                        if (targetUrl.origin === currentUrl.origin && targetUrl.pathname === currentUrl.pathname && targetUrl.search === currentUrl.search) {
                            return;
                        }
                    } catch (err) {}

                    // Intercept and prevent navigation completely
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    e.stopPropagation();

                    // Debounce alert between mousedown and click
                    if (e.type === 'click' || !self._lastAlertTime || (Date.now() - self._lastAlertTime > 600)) {
                        self._lastAlertTime = Date.now();
                        self.showNavigationBlockedAlert(link.href, protect);
                    }
                };

                // Intercept mousedown and click in capture phase (Livewire wire:navigate triggers on mousedown!)
                document.addEventListener('mousedown', handleLinkNavigation, { capture: true });
                document.addEventListener('click', handleLinkNavigation, { capture: true });
                this._cleanupListeners.push(() => {
                    document.removeEventListener('mousedown', handleLinkNavigation, { capture: true });
                    document.removeEventListener('click', handleLinkNavigation, { capture: true });
                });

                // Keydown navigation (Enter key on focused link)
                const handleKeyNavigation = (e) => {
                    if (e.key === 'Enter') {
                        handleLinkNavigation(e);
                    }
                };
                document.addEventListener('keydown', handleKeyNavigation, { capture: true });
                this._cleanupListeners.push(() => {
                    document.removeEventListener('keydown', handleKeyNavigation, { capture: true });
                });

                // Livewire / Alpine SPA cancelable event before navigation starts (livewire:navigate & alpine:navigate)
                const handleLivewireNavigate = (e) => {
                    if (self._isNavigatingAway || window.__vibeFilepondBypassProtection) return;
                    if (self.hasPendingUploads()) {
                        // Calling preventDefault on livewire:navigate or alpine:navigate cancels the navigation!
                        e.preventDefault();
                        e.stopImmediatePropagation();

                        let rawUrl = e.detail ? (e.detail.url || e.detail) : null;
                        let dest = rawUrl ? (rawUrl.href || rawUrl.toString()) : null;

                        if (!self._lastAlertTime || (Date.now() - self._lastAlertTime > 600)) {
                            self._lastAlertTime = Date.now();
                            self.showNavigationBlockedAlert(dest, protect);
                        }
                    }
                };
                document.addEventListener('livewire:navigate', handleLivewireNavigate, { capture: true });
                document.addEventListener('alpine:navigate', handleLivewireNavigate, { capture: true });
                this._cleanupListeners.push(() => {
                    document.removeEventListener('livewire:navigate', handleLivewireNavigate, { capture: true });
                    document.removeEventListener('alpine:navigate', handleLivewireNavigate, { capture: true });
                });

                // Popstate (Browser back / forward button)
                const handlePopState = (e) => {
                    if (self._isNavigatingAway || window.__vibeFilepondBypassProtection) return;
                    if (self.hasPendingUploads()) {
                        history.pushState(null, document.title, window.location.href);
                        if (!self._lastAlertTime || (Date.now() - self._lastAlertTime > 600)) {
                            self._lastAlertTime = Date.now();
                            self.showNavigationBlockedAlert(null, protect);
                        }
                    }
                };
                window.addEventListener('popstate', handlePopState);
                this._cleanupListeners.push(() => {
                    window.removeEventListener('popstate', handlePopState);
                });
            }

            // 3. Tab/Window Unload Protection (beforeunload)
            if (protect.preventUnload !== false) {
                const handleBeforeUnload = (e) => {
                    if (self._isNavigatingAway || window.__vibeFilepondBypassProtection) return;
                    if (self.hasPendingUploads()) {
                        e.preventDefault();
                        e.returnValue = '';
                        return '';
                    }
                };

                window.addEventListener('beforeunload', handleBeforeUnload);
                this._cleanupListeners.push(() => {
                    window.removeEventListener('beforeunload', handleBeforeUnload);
                });
            }
        },

        showSubmitBlockedAlert(protect = {}) {
            const title = protect.title || 'Unggahan Belum Selesai';
            const message = protect.submitMessage || 'Berkas Anda masih dalam proses pengunggahan. Harap tunggu hingga semua berkas selesai diunggah sebelum mengirim formulir.';
            const stayBtnText = protect.stayButton || 'Mengerti';

            const hasVibeAlert = Boolean(document.getElementById('vibe-alert-container') || typeof window.vibeAlert === 'function');

            if (hasVibeAlert) {
                const payload = {
                    type: 'warning',
                    title: title,
                    message: message,
                    sound: true,
                    blocking: true,
                    confirmButton: {
                        text: stayBtnText
                    }
                };
                if (typeof window.vibeAlert === 'function') {
                    window.vibeAlert(payload);
                } else {
                    window.dispatchEvent(new CustomEvent('alert', { detail: payload }));
                }
            } else {
                alert(title + '\n\n' + message);
            }
        },

        showNavigationBlockedAlert(targetUrl, protect = {}) {
            const self = this;
            const title = protect.title || 'Unggahan Belum Selesai';
            const message = protect.navigationMessage || 'Berkas Anda masih dalam proses pengunggahan. Jika Anda meninggalkan halaman ini sekarang, proses unggah akan dibatalkan. Apakah Anda yakin ingin berpindah halaman?';
            const leaveBtnText = protect.leaveButton || 'Tinggalkan Halaman';
            const stayBtnText = protect.stayButton || 'Tetap di Sini';

            const hasVibeAlert = Boolean(document.getElementById('vibe-alert-container') || typeof window.vibeAlert === 'function');

            const proceed = () => {
                window.__vibeFilepondBypassProtection = true;
                self._isNavigatingAway = true;
                if (targetUrl) {
                    const dest = typeof targetUrl === 'string' ? targetUrl : (targetUrl.href || targetUrl.toString());
                    if (dest) {
                        window.location.href = dest;
                        return;
                    }
                }
                history.back();
            };

            if (hasVibeAlert) {
                const payload = {
                    type: 'confirm',
                    title: title,
                    message: message,
                    sound: true,
                    blocking: true,
                    confirmButton: {
                        text: leaveBtnText,
                        class: 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
                        action: proceed
                    },
                    closeButton: {
                        text: stayBtnText
                    }
                };
                if (typeof window.vibeAlert === 'function') {
                    window.vibeAlert(payload);
                } else {
                    window.dispatchEvent(new CustomEvent('alert', { detail: payload }));
                }
            } else {
                if (confirm(title + '\n\n' + message)) {
                    proceed();
                }
            }
        }
    };
}

window.vibeFilepond = vibeFilepond;

// Auto-register in Alpine & Window when available
function registerVibeFilepond() {
    if (typeof window !== 'undefined') {
        window.vibeFilepond = vibeFilepond;
        if (window.Alpine && typeof window.Alpine.data === 'function') {
            try {
                window.Alpine.data('vibeFilepond', vibeFilepond);
            } catch (e) {}
        }
    }
}

if (typeof window !== 'undefined') {
    registerVibeFilepond();
    document.addEventListener('alpine:init', registerVibeFilepond);
    document.addEventListener('livewire:init', registerVibeFilepond);
    document.addEventListener('livewire:navigated', registerVibeFilepond);
    window.dispatchEvent(new CustomEvent('vibe-filepond-ready'));
}
