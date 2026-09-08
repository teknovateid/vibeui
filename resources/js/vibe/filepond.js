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

            // Scoped click listener ensuring clicking anywhere on the drop panel triggers file dialog
            this._clickHandler = (e) => {
                if (e.target.closest('button, a, .filepond--file-action-button, .filepond--action-remove-item, .filepond--action-retry-item-processing, .filepond--action-abort-item-processing, .filepond--action-revert-item-processing')) {
                    return;
                }
                if (e.target.tagName === 'INPUT' && e.target.type === 'file') {
                    return;
                }
                if (this.pond && typeof this.pond.browse === 'function') {
                    e.preventDefault();
                    this.pond.browse();
                }
            };
            this.$el.addEventListener('click', this._clickHandler);

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
            if (this._clickHandler && this.$el) {
                this.$el.removeEventListener('click', this._clickHandler);
            }
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
                onaddfile: (err, item) => {
                    if (err) {
                        self.$dispatch('vibe-filepond-error', { error: err, item });
                        return;
                    }
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

                                    const fileKey = response.key || response.path || response.file_key || file.name;
                                    const method = response.method || cfg.presignMethod || 'PUT';

                                    if (!uploadUrl || typeof uploadUrl !== 'string') {
                                        error('Presigned response missing upload URL');
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: 'Presigned response missing upload URL' } }));
                                        return;
                                    }

                                    // Upload direct to Cloud
                                    const xhrUpload = new XMLHttpRequest();
                                    xhrUpload.open(method, uploadUrl, true);

                                    // Set Content-Type for PUT
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

                                    abort(() => {
                                        xhrUpload.abort();
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-abort'));
                                    });

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

                        abort(() => {
                            xhrPresign.abort();
                        });

                        xhrPresign.send(JSON.stringify(requestPayload));
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
