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

/**
 * Attaches modern preview thumbnail for images or document icon with badge for other files
 */
function attachCustomFileIcon(item) {
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
        const rootEl = itemEl.closest('.filepond--root');
        if (rootEl && (rootEl.classList.contains('filepond-avatar-mode') || rootEl.dataset.stylePanelLayout?.includes('circle'))) {
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
                    imgUrl = URL.createObjectURL(file);
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
                iconContainer.innerHTML = `
                    <div class="filepond--thumbnail-wrapper">
                        <img src="${imgUrl}" alt="${name}" class="filepond--thumbnail-img" />
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
    setTimeout(render, 30);
    setTimeout(render, 100);
    setTimeout(render, 250);
    setTimeout(render, 500);
}

/**
 * Alpine.js FilePond Component Factory
 */
export function vibeFilepond(config = {}) {
    return {
        pond: null,
        input: null,
        uploadedKeys: [],

        init() {
            this.input = this.$refs.input || this.$el.querySelector('input[type="file"]');
            if (!this.input) return;

            // Strip any accidental sr-only class from input element so FilePond does not inherit it
            if (this.input.classList && this.input.classList.contains('sr-only')) {
                this.input.classList.remove('sr-only');
            }

            if (FilePond && typeof FilePond.find === 'function') {
                const existing = FilePond.find(this.input);
                if (existing) {
                    this.pond = existing;
                    return;
                }
            }

            if (this.$el) {
                this.$el.__vibe_pond_inited = true;
            }

            const self = this;
            const pondOptions = this.buildPondOptions(config, self);

            this.pond = FilePond.create(this.input, pondOptions);

            // Remove server-side fallback dropzone now that FilePond is mounted
            const fallbackEl = this.$el ? this.$el.querySelector('.filepond--fallback-dropzone') : null;
            if (fallbackEl) {
                fallbackEl.remove();
            }

            // Preload demo/mock files if provided (useful for docs & showcase without network calls)
            if (config.demoFiles && Array.isArray(config.demoFiles) && config.demoFiles.length > 0) {
                config.demoFiles.forEach(df => {
                    const name = typeof df === 'string' ? df : (df.name || 'my-cv.pdf');
                    const size = (df && df.size) ? df.size : 122880; // 120 KB
                    const type = (df && df.type) ? df.type : (name.endsWith('.pdf') ? 'application/pdf' : 'application/octet-stream');

                    try {
                        const dummyBuffer = new Uint8Array(Math.min(size, 1024));
                        const blob = new Blob([dummyBuffer], { type });
                        const mockFile = new File([blob], name, { type, lastModified: Date.now() });
                        Object.defineProperty(mockFile, 'size', { value: size });

                        this.pond.addFile(mockFile);
                    } catch (e) {
                        console.warn('[VibeFilepond] Could not load demo file', e);
                    }
                });
            }

            // Safe teardown when element is detached (Livewire SPA wire:navigate)
            this._cleanupHandler = () => {
                if (this.pond) {
                    try {
                        this.pond.destroy();
                    } catch (e) {}
                    this.pond = null;
                }
            };
            document.addEventListener('livewire:navigating', this._cleanupHandler, { once: true });
        },

        destroy() {
            if (this._cleanupHandler) {
                document.removeEventListener('livewire:navigating', this._cleanupHandler);
            }
            if (this.pond) {
                try {
                    this.pond.destroy();
                } catch (e) {}
                this.pond = null;
            }
        },

        buildPondOptions(cfg, self) {
            const options = {
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
                imagePreviewHeight: cfg.imagePreviewHeight ? parseInt(cfg.imagePreviewHeight, 10) : null,
                imagePreviewMinHeight: cfg.imagePreviewMinHeight ? parseInt(cfg.imagePreviewMinHeight, 10) : null,
                imagePreviewMaxHeight: cfg.imagePreviewMaxHeight ? parseInt(cfg.imagePreviewMaxHeight, 10) : null,

                allowImageCrop: Boolean(cfg.imageCrop || cfg.imageCropAspectRatio || cfg.avatar),
                imageCropAspectRatio: cfg.avatar ? '1:1' : (cfg.imageCropAspectRatio || null),

                allowImageResize: Boolean(cfg.imageResize || cfg.imageResizeTargetWidth || cfg.imageResizeTargetHeight),
                imageResizeTargetWidth: cfg.imageResizeTargetWidth ? parseInt(cfg.imageResizeTargetWidth, 10) : null,
                imageResizeTargetHeight: cfg.imageResizeTargetHeight ? parseInt(cfg.imageResizeTargetHeight, 10) : null,
                imageResizeMode: cfg.imageResizeMode || 'cover',

                allowImageTransform: Boolean(cfg.imageTransform || cfg.imageCrop || cfg.imageResize || cfg.avatar),
                imageTransformOutputQuality: cfg.imageQuality ? parseInt(cfg.imageQuality, 10) : null,

                // File encode (base64)
                allowFileEncode: Boolean(cfg.encode),

                // Avatar / Circle styling
                stylePanelLayout: cfg.avatar ? 'compact circle' : (cfg.panelLayout || null),
                styleLoadIndicatorPosition: cfg.avatar ? 'center bottom' : (cfg.loadIndicatorPosition || 'right'),
                styleProgressIndicatorPosition: cfg.avatar ? 'right bottom' : (cfg.progressIndicatorPosition || 'right'),
                styleButtonRemoveItemPosition: cfg.avatar ? 'left bottom' : (cfg.buttonRemoveItemPosition || 'left'),
                styleButtonProcessItemPosition: cfg.avatar ? 'right bottom' : (cfg.buttonProcessItemPosition || 'right'),

                // Labels & Translations
                ...(cfg.labels || {}),

                // Preloaded / Existing Files
                files: this.resolveInitialFiles(cfg.existingFiles),

                // Callbacks & Events
                oninitfile: (item) => {
                    attachCustomFileIcon(item);
                },
                onaddfile: (err, item) => {
                    if (err) {
                        self.$dispatch('vibe-filepond-error', { error: err, item });
                        return;
                    }
                    attachCustomFileIcon(item);
                    self.$dispatch('vibe-filepond-addfile', { item: item.file });
                },
                onremovefile: (err, item) => {
                    self.$dispatch('vibe-filepond-removefile', { item: item?.file });
                },
                onprocessfile: (err, item) => {
                    if (err) {
                        self.$dispatch('vibe-filepond-error', { error: err, item });
                        return;
                    }
                    self.$dispatch('vibe-filepond-processfile', { item: item.file });
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
                        // Immediately activate FilePond indicator (indeterminate busy spinner)
                        progress(false, 0, 0);

                        const startDetail = { name: file.name, size: file.size, type: file.type };
                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-start', { detail: startDetail }));
                        if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-start', startDetail);

                        const requestPayload = {
                            filename: file.name,
                            size: file.size,
                            type: file.type || 'application/octet-stream'
                        };

                        const xhrPresign = new XMLHttpRequest();
                        let xhrUpload = null;

                        xhrPresign.open('POST', cfg.presignUrl, true);
                        xhrPresign.setRequestHeader('Content-Type', 'application/json');
                        xhrPresign.setRequestHeader('Accept', 'application/json');
                        xhrPresign.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        if (csrfToken) xhrPresign.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                        xhrPresign.onload = () => {
                            if (xhrPresign.status >= 200 && xhrPresign.status < 300) {
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
                                        error('Presigned response missing upload URL');
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: 'Presigned response missing upload URL' } }));
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
                                            progress(true, e.loaded, e.total);
                                            const pct = Math.round((e.loaded / e.total) * 100);
                                            const progressDetail = { loaded: e.loaded, total: e.total, percentage: pct, fileKey };
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-progress', { detail: progressDetail }));
                                            if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-progress', progressDetail);
                                        }
                                    };

                                    xhrUpload.onload = () => {
                                        if (xhrUpload.status >= 200 && xhrUpload.status < 300) {
                                            progress(true, file.size, file.size);
                                            load(fileKey);
                                            self.handleUploadSuccess(fileKey, cfg);
                                            const successDetail = { key: fileKey, url: uploadUrl.split('?')[0], isLocal: Boolean(response.is_local) };
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-success', { detail: successDetail }));
                                            if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-success', successDetail);
                                        } else {
                                            const errMsg = 'Direct upload failed with HTTP ' + xhrUpload.status;
                                            error(errMsg);
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg, status: xhrUpload.status } }));
                                        }
                                    };

                                    xhrUpload.onerror = () => {
                                        const errMsg = 'Network error during cloud upload';
                                        error(errMsg);
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg } }));
                                    };

                                    xhrUpload.send(file);
                                } catch (e) {
                                    error('Error parsing presigned JSON: ' + e.message);
                                }
                            } else {
                                error('Failed to fetch presigned URL: ' + xhrPresign.statusText);
                            }
                        };

                        xhrPresign.onerror = () => {
                            error('Network error requesting presigned URL');
                        };

                        xhrPresign.send(JSON.stringify(requestPayload));

                        return {
                            abort: () => {
                                if (xhrUpload) {
                                    xhrUpload.abort();
                                }
                                xhrPresign.abort();
                                abort();
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
                        self.$wire.upload(
                            cfg.wireModel,
                            file,
                            (uploadedFilename) => {
                                load(uploadedFilename);
                                self.$dispatch('vibe-filepond-uploaded', { file: uploadedFilename });
                            },
                            () => {
                                error('Livewire upload failed');
                                self.$dispatch('vibe-filepond-error', { error: 'Livewire upload failed' });
                            },
                            (event) => {
                                progress(event.detail.progress, event.detail.progress, 100);
                            }
                        );
                    },
                    revert: (filename, load) => {
                        if (typeof self.$wire.removeUpload === 'function') {
                            self.$wire.removeUpload(cfg.wireModel, filename, load);
                        } else {
                            load();
                        }
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

        handleUploadSuccess(fileKey, cfg) {
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

            this.$dispatch('vibe-filepond-presigned-success', { key: fileKey, keys: this.uploadedKeys });
        },

        handleUploadRevert(fileKey, cfg) {
            this.uploadedKeys = this.uploadedKeys.filter(k => k !== fileKey);

            if (cfg.wireModel && this.$wire) {
                const val = cfg.multiple ? this.uploadedKeys : (this.uploadedKeys[0] || null);
                this.$wire.set(cfg.wireModel, val);
            }

            this.updateHiddenInputs(cfg);
            this.$dispatch('vibe-filepond-presigned-revert', { key: fileKey, keys: this.uploadedKeys });
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
