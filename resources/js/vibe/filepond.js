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

function isSameOrigin(url) {
    if (!url || typeof url !== 'string') return false;
    if (url.startsWith('/') && !url.startsWith('//')) return true;
    try {
        const parsed = new URL(url, window.location.origin);
        return parsed.origin === window.location.origin;
    } catch (e) {
        return false;
    }
}

/**
 * Attaches modern preview thumbnail for images or document icon with badge for other files
 */
// [FIX BUG-4] Accepts per-instance blobUrlSet to avoid global Set cross-contamination
function attachCustomFileIcon(item, blobUrlSet, forceUpdate = false, comp = null) {
    if (!item) return;

    const findItemEl = () => {
        if (comp && comp.pond && comp.pond.element) {
            const root = comp.pond.element;
            const byId = document.getElementById(`filepond--item-${item.id}`);
            if (byId && root.contains(byId)) return byId;

            const allItems = Array.from(root.querySelectorAll('li.filepond--item'));
            const matched = allItems.find(el => {
                const elId = el.id || '';
                const dataId = el.getAttribute('data-filepond-item-id') || '';
                return elId === `filepond--item-${item.id}` ||
                       dataId === String(item.id) ||
                       elId.endsWith(`-${item.id}`);
            });
            if (matched) return matched;

            if (typeof comp.pond.getFiles === 'function') {
                const files = comp.pond.getFiles();
                const idx = files.findIndex(f => String(f.id) === String(item.id) || f === item);
                if (idx !== -1 && allItems[idx]) return allItems[idx];
            }
        }
        if (item.element && item.element.querySelector) return item.element;
        if (item.id) {
            return document.getElementById(`filepond--item-${item.id}`);
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

        // Check if avatar mode
        const wrapper = itemEl.closest('.filepond-avatar-mode') || itemEl.closest('[data-vibe-filepond].filepond-avatar-mode');
        const rootEl = itemEl.closest('.filepond--root');
        const isAvatar = Boolean(wrapper || (rootEl && (rootEl.classList.contains('filepond-avatar-mode') || rootEl.dataset.stylePanelLayout?.includes('circle'))));

        const fileWrapper = itemEl.querySelector('.filepond--file');
        if (!fileWrapper) return;

        const file = item.file;
        let name = (file && file.name) ? file.name : (item.filename || '');
        if (!name && typeof item.source === 'string') {
            try {
                name = decodeURIComponent(item.source.split('/').pop().split('?')[0]);
            } catch (e) {
                name = item.source.split('/').pop().split('?')[0];
            }
        }

        // Special handling for Avatar Mode:
        // Render crisp circular <img> inside avatar wrapper to display preloaded S3 images and local uploads without canvas CORS blanking
        if (isAvatar) {
            let avatarImgUrl = null;
            if (file instanceof File || file instanceof Blob) {
                if (file.size > 0) {
                    avatarImgUrl = URL.createObjectURL(file);
                    registerCreatedBlobUrl(avatarImgUrl, blobUrlSet);
                }
            }
            if (!avatarImgUrl) {
                if (typeof item.source === 'string' && item.source.length > 0) {
                    avatarImgUrl = item.source;
                } else if (typeof item.file === 'string' && item.file.length > 0) {
                    avatarImgUrl = item.file;
                }
            }

            if (avatarImgUrl) {
                let avatarImg = fileWrapper.querySelector('.filepond--avatar-preview-img');
                if (!avatarImg) {
                    avatarImg = document.createElement('img');
                    avatarImg.className = 'filepond--avatar-preview-img';
                    avatarImg.alt = name || 'Avatar preview';
                    fileWrapper.prepend(avatarImg);
                }
                if (avatarImg.src !== avatarImgUrl) {
                    avatarImg.src = avatarImgUrl;
                }
            }
            return;
        }

        const ext = (name.split('.').pop() || '').toUpperCase();
        const isImage = (file && file.type && file.type.startsWith('image/')) ||
                        ['JPG', 'JPEG', 'PNG', 'GIF', 'WEBP', 'SVG', 'AVIF'].includes(ext);

        // Ensure filename is visible
        const infoMain = itemEl.querySelector('.filepond--file-info-main');
        if (infoMain && (!infoMain.textContent.trim() || infoMain.textContent === 'undefined') && name) {
            infoMain.textContent = name;
        }

        // Sanitize and ensure size text is accurate (never allow NaN GB to display)
        const infoSub = itemEl.querySelector('.filepond--file-info-sub');
        const calculatedSize = (file && typeof file.size === 'number' && !isNaN(file.size) && file.size > 0)
            ? file.size
            : (item.fileSize && !isNaN(item.fileSize) && item.fileSize > 0 ? item.fileSize : 0);

        if (infoSub) {
            if (calculatedSize > 0) {
                infoSub.textContent = formatBytes(calculatedSize);
                infoSub.style.display = '';
            } else if (infoSub.textContent.includes('NaN')) {
                infoSub.textContent = '';
            }

            if (!infoSub._sanitizedObserver) {
                infoSub._sanitizedObserver = new MutationObserver(() => {
                    if (infoSub.textContent.includes('NaN')) {
                        const latestFile = item.file;
                        const latestSize = (latestFile && typeof latestFile.size === 'number' && !isNaN(latestFile.size) && latestFile.size > 0)
                            ? latestFile.size
                            : (item.fileSize && !isNaN(item.fileSize) && item.fileSize > 0 ? item.fileSize : 0);
                        infoSub.textContent = latestSize > 0 ? formatBytes(latestSize) : '';
                    }
                });
                infoSub._sanitizedObserver.observe(infoSub, { childList: true, characterData: true, subtree: true });
            }
        }

        // Auto-fetch file size in background only for same-origin URLs if size is unknown
        const remoteSource = (typeof item.source === 'string' && item.source.length > 0)
            ? item.source
            : (typeof item.file === 'string' ? item.file : null);
        if (calculatedSize <= 0 && remoteSource && !item._sizeFetchStarted && isSameOrigin(remoteSource)) {
            item._sizeFetchStarted = true;
            fetch(remoteSource, { method: 'HEAD' })
                .then(res => {
                    const len = res.headers.get('content-length');
                    if (len && +len > 0) {
                        const bytes = +len;
                        item.fileSize = bytes;
                        if (item.file && typeof item.file === 'object') {
                            item.file.size = bytes;
                        }
                        if (infoSub) {
                            infoSub.textContent = formatBytes(bytes);
                            infoSub.style.display = '';
                        }
                    }
                })
                .catch(() => {});
        }

        // Inject / Update Reorder Controls (Handle + Up/Down arrows)
        const isReorderEnabled = Boolean(
            (comp && (comp.config?.reorder || comp.config?.allowReorder)) ||
            rootEl?.getAttribute('data-allow-reorder') === 'true' ||
            rootEl?.classList.contains('filepond--allow-reorder')
        );

        // Make the li item draggable when reorder is enabled
        const liItemEl = fileWrapper.closest('li.filepond--item');
        if (liItemEl) {
            liItemEl.draggable = isReorderEnabled && !isAvatar;
        }

        let handleGroup = fileWrapper.querySelector('.filepond--reorder-group');
        if (isReorderEnabled && !isAvatar) {
            if (!handleGroup) {
                handleGroup = document.createElement('div');
                handleGroup.className = 'filepond--reorder-group';
                handleGroup.setAttribute('data-filepond-reorder-handle', '');
                handleGroup.innerHTML = `
                    <div class="filepond--reorder-handle" title="Tahan dan seret untuk memindahkan urutan" aria-label="Geser urutan">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="5" r="1"></circle>
                            <circle cx="9" cy="12" r="1"></circle>
                            <circle cx="9" cy="19" r="1"></circle>
                            <circle cx="15" cy="5" r="1"></circle>
                            <circle cx="15" cy="12" r="1"></circle>
                            <circle cx="15" cy="19" r="1"></circle>
                        </svg>
                    </div>
                    <div class="filepond--reorder-arrows">
                        <button type="button" class="filepond--reorder-btn filepond--reorder-btn-up" title="Pindah ke atas" aria-label="Pindah ke atas">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
                        </button>
                        <button type="button" class="filepond--reorder-btn filepond--reorder-btn-down" title="Pindah ke bawah" aria-label="Pindah ke bawah">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                `;

                const upBtn = handleGroup.querySelector('.filepond--reorder-btn-up');
                const downBtn = handleGroup.querySelector('.filepond--reorder-btn-down');

                upBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                    if (comp && typeof comp.moveUp === 'function') {
                        comp.moveUp(item.id);
                    }
                });

                downBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    e.preventDefault();
                    if (comp && typeof comp.moveDown === 'function') {
                        comp.moveDown(item.id);
                    }
                });

                // Insert AFTER icon container if it exists, otherwise prepend
                // This preserves icon visibility after reorder
                const existingIcon = fileWrapper.querySelector('.filepond--custom-file-icon');
                if (existingIcon) {
                    existingIcon.after(handleGroup);
                } else {
                    fileWrapper.prepend(handleGroup);
                }
            }
        } else if (handleGroup) {
            handleGroup.remove();
            handleGroup = null;
            if (liItemEl) liItemEl.draggable = false;
        }

        // Inject / Update Custom Download Action Button
        let downloadBtn = fileWrapper.querySelector('.filepond--action-download-item');
        if (!downloadBtn) {
            downloadBtn = document.createElement('button');
            downloadBtn.type = 'button';
            downloadBtn.className = 'filepond--file-action-button filepond--action-download-item';
            downloadBtn.setAttribute('title', 'Unduh berkas');
            downloadBtn.setAttribute('aria-label', 'Unduh berkas');
            downloadBtn.innerHTML = `
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
            `;

            // Only show download button for preloaded files or successfully uploaded files
            const isPreloaded = item.origin === 1 || Boolean(item.serverId) || (typeof item.source === 'string' && (item.source.startsWith('http') || item.source.startsWith('/')));
            const isComplete = item.status === 5; // ItemStatus.PROCESSING_COMPLETE
            if (!isPreloaded && !isComplete) {
                downloadBtn.style.display = 'none';
            } else {
                downloadBtn.style.display = '';
            }

            downloadBtn.addEventListener('click', async (e) => {
                e.stopPropagation();
                e.preventDefault();

                // Visual loading state on the button
                const originalSvg = downloadBtn.innerHTML;
                downloadBtn.disabled = true;
                downloadBtn.innerHTML = `
                    <svg class="animate-spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;

                const restoreBtn = () => {
                    downloadBtn.disabled = false;
                    downloadBtn.innerHTML = originalSvg;
                };

                const currentFile = item.file;
                const dlFilename = (currentFile && currentFile.name)
                    ? currentFile.name
                    : (item.filename || (typeof item.source === 'string' ? decodeURIComponent(item.source.split('/').pop().split('?')[0]) : 'file'));

                const triggerBlobDownload = (blobObj, filename) => {
                    const blobUrl = URL.createObjectURL(blobObj);
                    const a = document.createElement('a');
                    a.href = blobUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    setTimeout(() => URL.revokeObjectURL(blobUrl), 3000);
                };

                // 1. If previously downloaded blob is cached on item or in-memory File/Blob
                if (item._downloadBlob instanceof Blob) {
                    triggerBlobDownload(item._downloadBlob, dlFilename);
                    restoreBtn();
                    return;
                }

                if (currentFile instanceof Blob || currentFile instanceof File) {
                    try {
                        triggerBlobDownload(currentFile, dlFilename);
                        restoreBtn();
                        return;
                    } catch (err) {}
                }

                // 2. Resolve remote URL from source, file, or metadata
                const metaUrl = (typeof item.getMetadata === 'function') ? (item.getMetadata('url') || item.getMetadata('fileUrl')) : null;
                const remoteUrl = (typeof item.source === 'string' && item.source.length > 0)
                    ? item.source
                    : (typeof item.file === 'string' ? item.file : (metaUrl || null));

                if (remoteUrl) {
                    let blob = null;

                    // Strategy A: Bypass browser disk-cache collision with cache: 'no-store' & cache-buster
                    try {
                        const isS3Signed = remoteUrl.includes('X-Amz-Signature') || remoteUrl.includes('AWSAccessKeyId');
                        const separator = remoteUrl.includes('?') ? '&' : '?';
                        const fetchUrl = isS3Signed ? remoteUrl : `${remoteUrl}${separator}_vibe_dl=${Date.now()}`;
                        const res = await fetch(fetchUrl, {
                            mode: 'cors',
                            credentials: 'omit',
                            cache: 'no-store'
                        });
                        if (res.ok) {
                            blob = await res.blob();
                        }
                    } catch (e) {}

                    // Strategy B: Standard fetch if Strategy A didn't resolve
                    if (!blob) {
                        try {
                            const res = await fetch(remoteUrl, { mode: 'cors' });
                            if (res.ok) blob = await res.blob();
                        } catch (e) {}
                    }

                    // Strategy C: Canvas extraction for images (only on same-origin to prevent canvas tainted CORS errors)
                    if (!blob && isImage && isSameOrigin(remoteUrl)) {
                        try {
                            blob = await new Promise((resolve, reject) => {
                                const img = new Image();
                                img.crossOrigin = 'anonymous';
                                img.onload = () => {
                                    try {
                                        const canvas = document.createElement('canvas');
                                        canvas.width = img.naturalWidth || img.width;
                                        canvas.height = img.naturalHeight || img.height;
                                        const ctx = canvas.getContext('2d');
                                        ctx.drawImage(img, 0, 0);
                                        const mimeType = (file && file.type) || (dlFilename.toLowerCase().endsWith('.png') ? 'image/png' : 'image/jpeg');
                                        canvas.toBlob((b) => {
                                            if (b) resolve(b);
                                            else reject(new Error('Canvas toBlob failed'));
                                        }, mimeType);
                                    } catch (err) {
                                        reject(err);
                                    }
                                };
                                img.onerror = reject;
                                const separator = remoteUrl.includes('?') ? '&' : '?';
                                img.src = `${remoteUrl}${separator}_canvas_dl=${Date.now()}`;
                            });
                        } catch (e) {}
                    }

                    // If any strategy succeeded in getting a blob, download it!
                    if (blob) {
                        item._downloadBlob = blob;
                        triggerBlobDownload(blob, dlFilename);
                        restoreBtn();
                        return;
                    }

                    // Strategy D: Backend proxy download endpoint if available
                    try {
                        const proxyUrl = `/docs/filepond/download?url=${encodeURIComponent(remoteUrl)}&name=${encodeURIComponent(dlFilename)}`;
                        const a = document.createElement('a');
                        a.href = proxyUrl;
                        a.download = dlFilename;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        restoreBtn();
                        return;
                    } catch (e) {}

                    // Strategy E: Fallback anchor navigation
                    const a = document.createElement('a');
                    a.href = remoteUrl;
                    a.download = dlFilename;
                    a.target = '_blank';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                }

                restoreBtn();
            });

            fileWrapper.appendChild(downloadBtn);
        }

        // Custom File Icon or Image Thumbnail
        const existingIcon = fileWrapper.querySelector('.filepond--custom-file-icon');
        if (existingIcon) {
            const isThumb = existingIcon.classList.contains('filepond--thumbnail-preview-container');
            if (isThumb && !forceUpdate) return;
            if (!isImage && !forceUpdate) return;
            if (isImage && (file instanceof Blob || file instanceof File)) {
                existingIcon.remove();
            } else if (!forceUpdate) {
                return;
            } else {
                existingIcon.remove();
            }
        }

        let iconContainer = document.createElement('div');
        iconContainer.className = 'filepond--custom-file-icon';

        const insertIcon = () => {
            // Always insert icon BEFORE the reorder handle group so icon stays visible
            const existingHandle = fileWrapper.querySelector('.filepond--reorder-group');
            if (existingHandle && existingHandle.parentNode === fileWrapper) {
                fileWrapper.insertBefore(iconContainer, existingHandle);
            } else {
                fileWrapper.prepend(iconContainer);
            }
        };

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
                    if (imgUrl && imgUrl.startsWith('blob:')) return;
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

                insertIcon();
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

        insertIcon();
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
        config: config,
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

            // Initialize uploadedKeys from preloaded/existing files for Livewire & Alpine state
            const initialKeys = [];
            if (typeof config.existingFiles === 'string' && config.existingFiles.trim()) {
                initialKeys.push(config.existingFiles.trim());
            } else if (Array.isArray(config.existingFiles)) {
                config.existingFiles.forEach(f => {
                    if (typeof f === 'string' && f.trim()) initialKeys.push(f.trim());
                    else if (f && typeof f === 'object') initialKeys.push(f.source || f.url || f.key || '');
                });
            }
            if (initialKeys.length > 0) {
                this.uploadedKeys = [...new Set(initialKeys.filter(Boolean))];
            }

            // In avatar mode, ensure the root element has avatar class and clicking anywhere in the circle opens file picker
            if (config.avatar && this.pond.element) {
                this.pond.element.classList.add('filepond-avatar-mode');
                this.pond.element.addEventListener('click', (e) => {
                    if (e.target.closest('.filepond--file-action-button') || e.target.closest('.filepond--action-remove-item')) {
                        return;
                    }
                    this.browse();
                });
            }

            // Remove server-side fallback dropzone now that FilePond is mounted
            const fallbackEl = this.$el ? this.$el.querySelector('.filepond--fallback-dropzone') : null;
            if (fallbackEl) {
                fallbackEl.remove();
            }

            // Setup Upload Protection (Blocks submit & navigation while uploads are in progress)
            this.config = config;
            this.setupUploadProtection(config);

            if (config.reorder || config.allowReorder) {
                this.setupReordering();
            }


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
                this.pond.setOptions({ name: config.multiple ? `${cleanName}[]` : cleanName });
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
            const rawName = cfg.name || (self.input ? self.input.name : null);
            const baseName = rawName ? rawName.replace(/\[\]$/, '') : null;
            const resolvedName = baseName ? (cfg.multiple ? `${baseName}[]` : baseName) : null;

            const options = {
                name: resolvedName,
                credits: false,
                className: cfg.className || '',
                allowMultiple: Boolean(cfg.multiple),
                maxFiles: cfg.maxFiles ? parseInt(cfg.maxFiles, 10) : null,
                disabled: Boolean(cfg.disabled),
                required: Boolean(cfg.required),
                // Disable FilePond's native destructive auto-remove on abort/cancel
                instantUpload: false,

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
                // Native FilePond image preview plugin is ONLY needed for avatar circular mode.
                // Standard filepond cards already use attachCustomFileIcon with clean <img> thumbnails and lightbox zoom modal.
                // Setting allowImagePreview to true for standard cards causes FilePond to compute canvas dimensions
                // inside hidden 0x0 wrapper elements, which hangs the upload pipeline for raster images.
                allowImagePreview: Boolean(cfg.avatar),
                imagePreviewHeight: cfg.imagePreviewHeight ? parseInt(cfg.imagePreviewHeight, 10) : (cfg.avatar ? 130 : null),
                imagePreviewMinHeight: cfg.imagePreviewMinHeight ? parseInt(cfg.imagePreviewMinHeight, 10) : (cfg.avatar ? 130 : null),
                imagePreviewMaxHeight: cfg.imagePreviewMaxHeight ? parseInt(cfg.imagePreviewMaxHeight, 10) : (cfg.avatar ? 130 : null),
                // Exclude SVG from raster preview plugin (prevents getImageSize hanging; custom thumbnail renderer handles SVGs)
                imagePreviewFilterItem: (item) => {
                    const type = item.fileType || (item.file && item.file.type) || '';
                    const name = item.filename || (item.file && item.file.name) || '';
                    return !/svg/i.test(type) && !/\.svg$/i.test(name);
                },

                allowImageCrop: Boolean(cfg.imageCrop || cfg.imageCropAspectRatio || (cfg.avatar && cfg.imageCrop !== false)),
                imageCropAspectRatio: cfg.avatar ? '1:1' : (cfg.imageCropAspectRatio || null),

                allowImageResize: Boolean(cfg.imageResize || cfg.imageResizeTargetWidth || cfg.imageResizeTargetHeight || (cfg.avatar && cfg.imageResize !== false)),
                imageResizeTargetWidth: cfg.avatar ? 260 : (cfg.imageResizeTargetWidth ? parseInt(cfg.imageResizeTargetWidth, 10) : null),
                imageResizeTargetHeight: cfg.avatar ? 260 : (cfg.imageResizeTargetHeight ? parseInt(cfg.imageResizeTargetHeight, 10) : null),
                imageResizeMode: cfg.imageResizeMode || 'cover',

                allowImageTransform: Boolean(cfg.imageTransform || (cfg.avatar && cfg.imageTransform !== false)),
                imageTransformOutputQuality: cfg.imageQuality ? parseInt(cfg.imageQuality, 10) : null,
                // Exclude vector SVGs from raster canvas transformations
                imageTransformImageFilter: (file) => {
                    const type = (file && file.type) || '';
                    const name = (file && file.name) || '';
                    return !/svg/i.test(type) && !/\.svg$/i.test(name);
                },

                // File encode (base64)
                allowFileEncode: Boolean(cfg.encode),

                // Native form file sync (syncs FilePond files to native file input for form POST)
                // [FIX QA-3] Handle null (PHP null !== JS undefined) to allow Blade prop override
                storeAsFile: (cfg.storeAsFile !== null && cfg.storeAsFile !== undefined) ? Boolean(cfg.storeAsFile) : (!cfg.server && !cfg.presignUrl && !cfg.wireModel),

                // Avatar / Circle styling
                stylePanelLayout: cfg.avatar ? 'compact circle' : (cfg.panelLayout || null),
                styleLoadIndicatorPosition: cfg.avatar ? 'center bottom' : (cfg.loadIndicatorPosition || 'right'),
                styleProgressIndicatorPosition: cfg.avatar ? 'right bottom' : (cfg.progressIndicatorPosition || 'right'),
                styleButtonRemoveItemPosition: cfg.avatar ? 'left bottom' : (cfg.buttonRemoveItemPosition || 'right'),
                styleButtonProcessItemPosition: cfg.avatar ? 'right bottom' : (cfg.buttonProcessItemPosition || 'right'),

                // Modern crisp SVG icons (replaces FilePond's tiny 8px padded icons)
                iconRemove: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
                iconRetry: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>',
                iconProcess: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5"/><path d="m5 12 7-7 7 7"/></svg>',
                // Use X (remove) icon instead of back/undo arrow when uploaded:
                iconUndo: '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',

                // Labels & Translations
                ...(cfg.labels || {}),

                // Preloaded / Existing Files
                files: this.resolveInitialFiles(cfg.existingFiles),

                // Callbacks & Events
                oninitfile: (item) => {
                    attachCustomFileIcon(item, self._blobUrls, false, self); // [FIX BUG-4] pass per-instance set
                },
                onaddfilestart: (item) => {
                    self.serverError = null;
                    self.hasError = false;
                },
                onaddfile: (err, item) => {
                    attachCustomFileIcon(item, self._blobUrls, false, self); // [FIX BUG-4] pass per-instance set
                    self.syncFormInputsOrder();
                    self.updateArrowButtonStates();
                    self.updateReactiveState();
                    self.fireEvent('add', { item: item });

                    // Auto-start upload on add if instantUpload is desired (default true),
                    // but ONLY if an async server endpoint is configured (presignUrl, server, or wireModel)
                    // and storeAsFile is not active. Traditional form uploads should remain in IDLE ready state.
                    const hasAsyncServer = Boolean(cfg.presignUrl || cfg.server || cfg.wireModel);
                    const isStoreAsFile = (cfg.storeAsFile !== null && cfg.storeAsFile !== undefined)
                        ? Boolean(cfg.storeAsFile)
                        : !hasAsyncServer;

                    if (hasAsyncServer && !isStoreAsFile && cfg.instantUpload !== false) {
                        setTimeout(() => {
                            if (self.pond && typeof self.pond.processFile === 'function' && item && item.id) {
                                const current = typeof self.pond.getFile === 'function' ? self.pond.getFile(item.id) : null;
                                if (current && (current.status === FileStatus.IDLE || current.status === FileStatus.INIT)) {
                                    self.pond.processFile(item.id);
                                }
                            }
                        }, 25);
                    }
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

                    // Reveal download button for successfully uploaded file
                    if (item && item.id && self.pond && self.pond.element) {
                        const itemEl = self.pond.element.querySelector(`[data-filepond-item-id="${item.id}"]`);
                        const dlBtn = itemEl?.querySelector('.filepond--action-download-item');
                        if (dlBtn) dlBtn.style.display = '';
                    }

                    self.syncFormInputsOrder();
                    self.updateArrowButtonStates();
                    self.fireEvent('success', { item: item, key: item?.serverId, progress: 100 });
                },
                onprocessfileabort: (item) => {
                    if (item && item.id) {
                        self.activeUploads.delete(item.id);
                    }
                    self.updateReactiveState();
                    self.serverError = null; // clear server error on abort
                    self.hasError = false;

                    // Ensure download button is hidden on aborted/cancelled uploads
                    if (item && item.id && self.pond && self.pond.element) {
                        const itemEl = self.pond.element.querySelector(`[data-filepond-item-id="${item.id}"]`);
                        const dlBtn = itemEl?.querySelector('.filepond--action-download-item');
                        if (dlBtn) dlBtn.style.display = 'none';
                    }

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

                    // When an already-uploaded file is reverted/cancelled by the user, remove it completely from the list
                    // so it doesn't leave the file in an awkward un-uploaded state with an "upload again" button.
                    if (self.pond && typeof self.pond.removeFile === 'function' && item && item.id) {
                        setTimeout(() => {
                            const fileInPond = typeof self.pond.getFile === 'function' ? self.pond.getFile(item.id) : null;
                            if (fileInPond) {
                                self.pond.removeFile(item.id);
                            }
                        }, 20);
                    }
                },
                onremovefile: (err, item) => {
                    if (item && item.id) {
                        self.activeUploads.delete(item.id);
                    }
                    const fileIdentifier = item?.serverId || item?.source || item?.file?.name;
                    if (fileIdentifier) {
                        self.handleUploadRevert(fileIdentifier, cfg);
                    }
                    self.syncFormInputsOrder();
                    self.updateArrowButtonStates();
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
            const normalize = (f) => {
                if (typeof f === 'string' && f.trim()) {
                    const clean = f.trim();
                    const cleanName = decodeURIComponent(clean.split('/').pop().split('?')[0]);
                    return {
                        source: clean,
                        options: {
                            type: 'local',
                            file: {
                                name: cleanName,
                            }
                        }
                    };
                }
                if (f && typeof f === 'object') {
                    if (f.source) return f;
                    const src = f.url || f.src || f.path;
                    if (src) {
                        const cleanName = f.name || decodeURIComponent(src.split('/').pop().split('?')[0]);
                        return {
                            source: src,
                            options: {
                                type: 'local',
                                file: {
                                    name: cleanName,
                                    size: f.size || undefined,
                                    type: f.type || undefined,
                                }
                            }
                        };
                    }
                }
                return f;
            };

            if (typeof files === 'string') {
                return [normalize(files)].filter(Boolean);
            }
            if (Array.isArray(files)) {
                return files.map(normalize).filter(Boolean);
            }
            if (typeof files === 'object') {
                return [normalize(files)].filter(Boolean);
            }
            return [];
        },

        resolveServerConfig(cfg, self) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const universalFileLoader = (source, load, error, progress, abort, headers) => {
                const controller = new AbortController();
                fetch(source, { signal: controller.signal })
                    .then(res => {
                        if (!res.ok) throw new Error(`HTTP ${res.status}`);
                        return res.blob();
                    })
                    .then(blob => {
                        const filename = decodeURIComponent(source.split('/').pop().split('?')[0]);
                        let fileObj = blob;
                        try {
                            const detectedType = blob.type || (/\.png$/i.test(filename) ? 'image/png' : (/\.jpe?g$/i.test(filename) ? 'image/jpeg' : (/\.pdf$/i.test(filename) ? 'application/pdf' : 'application/octet-stream')));
                            fileObj = new File([blob], filename, { type: detectedType });
                        } catch (e) {}
                        load(fileObj);

                        setTimeout(() => {
                            if (self.pond && typeof self.pond.getFiles === 'function') {
                                const files = self.pond.getFiles();
                                const matched = files.find(f => f.source === source || (f.file && f.file.name === filename));
                                if (matched) {
                                    attachCustomFileIcon(matched, self._blobUrls, true, self);
                                }
                            }
                        }, 50);
                    })
                    .catch(err => {
                        if (err.name !== 'AbortError') {
                            const filename = decodeURIComponent(source.split('/').pop().split('?')[0]);
                            const detectedType = (/\.png$/i.test(filename) ? 'image/png' : (/\.jpe?g$/i.test(filename) ? 'image/jpeg' : (/\.pdf$/i.test(filename) ? 'application/pdf' : 'application/octet-stream')));
                            let mockFile = null;
                            try {
                                mockFile = new File([''], filename, { type: detectedType });
                            } catch (e) {
                                mockFile = new Blob([''], { type: detectedType });
                            }
                            load(mockFile);

                            setTimeout(() => {
                                if (self.pond && typeof self.pond.getFiles === 'function') {
                                    const files = self.pond.getFiles();
                                    const matched = files.find(f => f.source === source || (f.file && f.file.name === filename));
                                    if (matched) {
                                        attachCustomFileIcon(matched, self._blobUrls, true, self);
                                    }
                                }
                            }, 50);
                        }
                    });

                return {
                    abort: () => {
                        controller.abort();
                        abort();
                    }
                };
            };

            // 1. Presigned URL Direct-to-Cloud Upload (S3, Cloudflare R2, GCS, MinIO)
            if (cfg.presignUrl) {
                return {
                    process: (fieldName, file, metadata, load, error, progress, abort) => {
                        const fileName = (file && file.name) || (metadata && metadata.name) || 'uploaded-file';
                        const fileSize = (file && typeof file.size === 'number') ? file.size : 0;
                        const fileType = (file && file.type) || (/\.svg$/i.test(fileName) ? 'image/svg+xml' : 'application/octet-stream');

                        const uploadId = (metadata && metadata.id) ? metadata.id : (fileName + '_' + fileSize + '_' + Math.random());
                        self.activeUploads.add(uploadId);
                        self.updateReactiveState();

                        // Immediately activate FilePond indicator (indeterminate busy spinner)
                        progress(false, 0, 0);

                        const startDetail = { name: fileName, filename: fileName, size: fileSize, type: fileType, file };
                        self.fireEvent('start', startDetail);
                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-start', { detail: startDetail }));
                        if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-start', startDetail);

                        const requestPayload = {
                            filename: fileName,
                            size: fileSize,
                            type: fileType
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
                                    self.fireEvent('error', { error: errMsg, file, filename: fileName });
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
                                            fileKey = fileName;
                                        }
                                    }
                                    if (!fileKey) fileKey = fileName;

                                    const method = response.method || cfg.presignMethod || 'PUT';

                                    if (!uploadUrl || typeof uploadUrl !== 'string') {
                                        self.activeUploads.delete(uploadId);
                                        self.updateReactiveState();
                                        self.hasError = true;
                                        const errMsg = 'Presigned response missing upload URL';
                                        self.serverError = errMsg;
                                        error(errMsg);
                                        self.fireEvent('error', { error: errMsg, file, filename: fileName });
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg } }));
                                        return;
                                    }

                                    // Upload direct to Cloud
                                    xhrUpload = new XMLHttpRequest();
                                    xhrUpload.open(method, uploadUrl, true);

                                    // Set Content-Type for PUT if required
                                    let uploadContentType = fileType;
                                    if (method.toUpperCase() === 'PUT' && uploadContentType) {
                                        try {
                                            xhrUpload.setRequestHeader('Content-Type', uploadContentType);
                                        } catch (e) {}
                                    }

                                    // Set custom presigned headers (ignoring forbidden headers like Host)
                                    const forbiddenHeaders = ['host', 'content-length', 'connection'];
                                    if (customHeaders && typeof customHeaders === 'object') {
                                        for (const [hKey, hVal] of Object.entries(customHeaders)) {
                                            if (hKey && !forbiddenHeaders.includes(hKey.toLowerCase())) {
                                                try {
                                                    xhrUpload.setRequestHeader(hKey, Array.isArray(hVal) ? hVal.join(', ') : String(hVal));
                                                } catch (e) {}
                                            }
                                        }
                                    }

                                    xhrUpload.upload.onprogress = (e) => {
                                        if (e.lengthComputable) {
                                            progress(true, e.loaded, e.total);
                                            const pct = Math.round((e.loaded / e.total) * 100);
                                            const progressDetail = { loaded: e.loaded, total: e.total, percentage: pct, progress: pct, fileKey, key: fileKey, filename: fileName, file };
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-progress', { detail: progressDetail }));
                                            if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-progress', progressDetail);
                                        }
                                    };

                                    xhrUpload.onload = () => {
                                        self.activeUploads.delete(uploadId);
                                        self.updateReactiveState();
                                        if (xhrUpload.status >= 200 && xhrUpload.status < 300) {
                                            progress(true, fileSize, fileSize);
                                            load(fileKey);
                                            self.handleUploadSuccess(fileKey, cfg, file);
                                            const successDetail = { key: fileKey, url: uploadUrl.split('?')[0], isLocal: Boolean(response.is_local), filename: fileName, size: fileSize, file };
                                            window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-success', { detail: successDetail }));
                                            if (self.$dispatch) self.$dispatch('vibe-filepond-presigned-success', successDetail);
                                        } else {
                                            self.hasError = true;
                                            const errMsg = 'Direct upload failed with HTTP ' + xhrUpload.status;
                                            self.serverError = errMsg;
                                            error(errMsg);
                                            self.fireEvent('error', { error: errMsg, status: xhrUpload.status, file, filename: fileName });
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
                                        self.fireEvent('error', { error: errMsg, file, filename: fileName });
                                        window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-error', { detail: { error: errMsg } }));
                                    };

                                    xhrUpload.ontimeout = () => {
                                        self.activeUploads.delete(uploadId);
                                        self.updateReactiveState();
                                        self.hasError = true;
                                        const errMsg = 'Upload timed out';
                                        self.serverError = errMsg;
                                        error(errMsg);
                                        self.fireEvent('error', { error: errMsg, file, filename: fileName });
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
                                    self.fireEvent('error', { error: errMsg, file, filename: fileName });
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
                                self.fireEvent('error', { error: errMsg, status: xhrPresign.status, file, filename: fileName });
                            }
                        };

                        xhrPresign.onerror = () => {
                            self.activeUploads.delete(uploadId);
                            self.updateReactiveState();
                            self.hasError = true;
                            const errMsg = 'Network error requesting presigned URL';
                            self.serverError = errMsg;
                            error(errMsg);
                            self.fireEvent('error', { error: errMsg, file, filename: fileName });
                        };

                        xhrPresign.send(JSON.stringify(requestPayload));

                        return {
                            abort: () => {
                                self.activeUploads.delete(uploadId);
                                self.updateReactiveState();
                                if (xhrUpload) {
                                    try { xhrUpload.abort(); } catch (e) {}
                                }
                                try { xhrPresign.abort(); } catch (e) {}
                                abort();
                                self.fireEvent('abort', { filename: fileName, file });
                                window.dispatchEvent(new CustomEvent('vibe-filepond-presigned-abort'));
                            }
                        };
                    },

                    revert: (uniqueFileId, load, error) => {
                        self.handleUploadRevert(uniqueFileId, cfg);
                        load();
                    },

                    load: universalFileLoader,

                    remove: (source, load, error) => {
                        self.handleUploadRevert(source, cfg);
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
                    },
                    load: universalFileLoader,
                    remove: (source, load, error) => {
                        self.handleUploadRevert(source, cfg);
                        load();
                    }
                };
            }

            // 3. Custom Server Endpoint Config
            if (cfg.server) {
                const baseServer = (typeof cfg.server === 'string')
                    ? { url: cfg.server }
                    : { ...cfg.server };

                return {
                    load: universalFileLoader,
                    remove: (source, load, error) => {
                        self.handleUploadRevert(source, cfg);
                        load();
                    },
                    ...baseServer,
                    headers: {
                        ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}),
                        ...(baseServer.headers || {})
                    }
                };
            }

            // 4. Standalone / Form mode with initial files loader
            const hasInitialFiles = Array.isArray(cfg.existingFiles) ? cfg.existingFiles.length > 0 : Boolean(cfg.existingFiles);
            if (hasInitialFiles) {
                return {
                    load: universalFileLoader,
                    remove: (source, load, error) => {
                        self.handleUploadRevert(source, cfg);
                        load();
                    }
                };
            }

            // 5. File Encode or Default (null means FilePond will not upload async)
            return null;
        },

        handleUploadSuccess(fileKey, cfg, fileObj = null) {
            if (cfg.multiple) {
                if (!this.uploadedKeys.includes(fileKey)) {
                    this.uploadedKeys.push(fileKey);
                }
            } else {
                this.uploadedKeys = [fileKey];
            }

            // If Livewire wire:model is set with Presigned URL, sync key to Livewire property
            if (cfg.wireModel && this.$wire) {
                const val = cfg.multiple ? this.uploadedKeys : fileKey;
                this.$wire.set(cfg.wireModel, val);
            }

            this.updateReactiveState();

            // [FIX BUG-8] Guard against missing $dispatch in fallback Alpine context
            if (this.$dispatch) {
                this.$dispatch('vibe-filepond-presigned-success', { key: fileKey, keys: this.uploadedKeys });
            }
        },

        handleUploadRevert(fileKey, cfg) {
            if (!fileKey) return;
            this.uploadedKeys = this.uploadedKeys.filter(k => {
                if (k === fileKey) return false;
                try {
                    if (decodeURIComponent(k) === decodeURIComponent(fileKey)) return false;
                } catch (e) {}
                if (typeof k === 'string' && typeof fileKey === 'string') {
                    if (k.endsWith('/' + fileKey) || fileKey.endsWith('/' + k)) return false;
                }
                return true;
            });

            if (cfg.wireModel && this.$wire) {
                const val = cfg.multiple ? this.uploadedKeys : (this.uploadedKeys[0] || null);
                this.$wire.set(cfg.wireModel, val);
            }

            this.updateReactiveState();

            // [FIX BUG-8] Guard against missing $dispatch in fallback Alpine context
            if (this.$dispatch) {
                this.$dispatch('vibe-filepond-presigned-revert', { key: fileKey, keys: this.uploadedKeys });
            }
        },

        updateHiddenInputs(cfg) {
            // FilePond natively creates and manages hidden form input fields (<input type="hidden" name="...">)
            // for every preloaded file and uploaded server file inside its root element.
            // Keeping hiddenContainer clear prevents duplicate form input names and values from being submitted.
            const hiddenContainer = this.$refs.hiddenContainer;
            if (hiddenContainer) {
                hiddenContainer.innerHTML = '';
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
        },

        // =========================================================================
        // FilePond Item Reordering (Drag & Drop + Arrows + Input Order Sync)
        // =========================================================================

        setupReordering() {
            if (!this.pond || !this.pond.element) return;
            const root = this.pond.element;

            root.setAttribute('data-allow-reorder', 'true');
            root.classList.add('filepond--allow-reorder');

            this.bindPondReorderDrag();

            // Auto-sync form inputs when form submit starts
            const form = this.$el ? this.$el.closest('form') : null;
            if (form) {
                const submitHandler = () => {
                    this.syncFormInputsOrder();
                };
                form.addEventListener('submit', submitHandler, { capture: true });
                this._cleanupListeners.push(() => {
                    form.removeEventListener('submit', submitHandler, { capture: true });
                });
            }

            // Initial input order sync and button state update
            setTimeout(() => {
                this.syncFormInputsOrder();
                this.updateArrowButtonStates();
            }, 80);
        },

        findItemElement(itemId, fallbackIndex = null) {
            if (!this.pond || !this.pond.element) return null;
            const root = this.pond.element;

            // 1. Exact ID
            const direct = document.getElementById(`filepond--item-${itemId}`);
            if (direct && root.contains(direct)) return direct;

            // 2. Data attribute or ID suffix
            const allItems = Array.from(root.querySelectorAll('li.filepond--item'));
            const matched = allItems.find(el => {
                const elId = el.id || '';
                const dataId = el.getAttribute('data-filepond-item-id') || '';
                return elId === `filepond--item-${itemId}` ||
                       dataId === String(itemId) ||
                       elId.endsWith(`-${itemId}`);
            });
            if (matched) return matched;

            // 3. Fallback: match by index in pond.getFiles()
            if (typeof this.pond.getFiles === 'function') {
                const files = this.pond.getFiles();
                const idx = files.findIndex(f => String(f.id) === String(itemId) || f.id === itemId);
                if (idx !== -1 && allItems[idx]) return allItems[idx];
            }

            // 4. Numerical fallback
            if (fallbackIndex !== null && allItems[fallbackIndex]) {
                return allItems[fallbackIndex];
            }

            return null;
        },

        getItemIdFromElement(el) {
            if (!el) return null;
            const itemEl = el.closest('li.filepond--item');
            if (!itemEl) return null;

            // 1. Check data-filepond-item-id
            const dataId = itemEl.getAttribute('data-filepond-item-id');
            if (dataId) return dataId;

            // 2. Check id attribute (filepond--item-{id})
            const idAttr = itemEl.id || '';
            const match = idAttr.match(/filepond--item-(.+)$/);
            if (match) return match[1];

            // 3. Fallback by position among li.filepond--item
            if (this.pond && typeof this.pond.getFiles === 'function') {
                const allItems = Array.from(this.pond.element.querySelectorAll('li.filepond--item'));
                const idx = allItems.indexOf(itemEl);
                if (idx !== -1) {
                    const files = this.pond.getFiles();
                    if (files[idx]) return files[idx].id;
                }
            }

            return null;
        },

        bindPondReorderDrag() {
            if (!this.pond || !this.pond.element) return;
            const root = this.pond.element;
            const self = this;
            let draggingEl = null;
            let draggingId = null;

            // dragstart — only from our reorder handle
            const onDragStart = (e) => {
                const handle = e.target.closest('[data-filepond-reorder-handle]');
                if (!handle) {
                    // Not our handle — do not interfere (allow FilePond file drop from outside)
                    return;
                }

                const itemEl = handle.closest('li.filepond--item');
                if (!itemEl) return;

                draggingEl = itemEl;
                draggingId = self.getItemIdFromElement(itemEl);

                if (e.dataTransfer) {
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/plain', draggingId || '');
                    e.dataTransfer.setData('application/x-vibe-filepond', self.config?.id || 'filepond');

                    // Use item itself as drag image for native ghost
                    if (e.dataTransfer.setDragImage) {
                        const rect = itemEl.getBoundingClientRect();
                        const offsetX = Math.min(rect.width / 2, Math.max(10, e.clientX - rect.left));
                        const offsetY = Math.min(rect.height / 2, Math.max(10, e.clientY - rect.top));
                        e.dataTransfer.setDragImage(itemEl, offsetX, offsetY);
                    }
                }

                // Same visual feedback as dynamic-form.js
                setTimeout(() => {
                    if (draggingEl) draggingEl.classList.add('opacity-40', 'scale-[0.99]');
                }, 0);
            };

            // dragover — highlight drop target
            const onDragOver = (e) => {
                if (!draggingEl) return;
                const targetItem = e.target.closest('li.filepond--item');
                if (!targetItem || targetItem === draggingEl) return;

                e.preventDefault();
                if (e.dataTransfer) e.dataTransfer.dropEffect = 'move';

                // Remove from all others first
                Array.from(root.querySelectorAll('li.filepond--item')).forEach(el => {
                    el.classList.remove('ring-2', 'ring-primary', 'border-primary/60');
                });
                targetItem.classList.add('ring-2', 'ring-primary', 'border-primary/60');
            };

            // dragleave — remove highlight
            const onDragLeave = (e) => {
                const targetItem = e.target.closest('li.filepond--item');
                if (!targetItem) return;
                if (e.relatedTarget && targetItem.contains(e.relatedTarget)) return;
                targetItem.classList.remove('ring-2', 'ring-primary', 'border-primary/60');
            };

            // drop — perform reorder
            const onDrop = (e) => {
                if (!draggingEl || !draggingId) return;

                const sourceFormId = e.dataTransfer ? e.dataTransfer.getData('application/x-vibe-filepond') : null;
                if (sourceFormId && sourceFormId !== (self.config?.id || 'filepond')) {
                    cleanup();
                    return;
                }

                e.preventDefault();

                const targetItem = e.target.closest('li.filepond--item');
                if (targetItem && targetItem !== draggingEl) {
                    const targetId = self.getItemIdFromElement(targetItem);
                    if (targetId) {
                        // Determine before/after based on cursor position
                        const tRect = targetItem.getBoundingClientRect();
                        const isAbove = e.clientY < tRect.top + tRect.height / 2;
                        self.reorderById(draggingId, targetId, isAbove ? 'before' : 'after');
                    }
                }

                cleanup();
            };

            // dragend — cleanup regardless of drop success
            const onDragEnd = (e) => {
                cleanup();
            };

            const cleanup = () => {
                if (draggingEl) {
                    draggingEl.classList.remove('opacity-40', 'scale-[0.99]');
                }
                Array.from(root.querySelectorAll('li.filepond--item')).forEach(el => {
                    el.classList.remove('opacity-40', 'scale-[0.99]', 'ring-2', 'ring-primary', 'border-primary/60');
                });
                draggingEl = null;
                draggingId = null;
            };

            root.addEventListener('dragstart', onDragStart);
            root.addEventListener('dragover', onDragOver);
            root.addEventListener('dragleave', onDragLeave);
            root.addEventListener('drop', onDrop);
            root.addEventListener('dragend', onDragEnd);

            this._cleanupListeners.push(() => {
                root.removeEventListener('dragstart', onDragStart);
                root.removeEventListener('dragover', onDragOver);
                root.removeEventListener('dragleave', onDragLeave);
                root.removeEventListener('drop', onDrop);
                root.removeEventListener('dragend', onDragEnd);
            });
        },

        reorderById(fromId, toId, position = 'before') {
            if (!this.pond || fromId === toId) return;
            const files = typeof this.pond.getFiles === 'function' ? this.pond.getFiles() : [];
            const fromIndex = files.findIndex(f => String(f.id) === String(fromId) || f.id === fromId || f.serverId === fromId);
            const toIndex = files.findIndex(f => String(f.id) === String(toId) || f.id === toId || f.serverId === toId);

            if (fromIndex === -1 || toIndex === -1 || fromIndex === toIndex) return;

            let targetIndex = toIndex;
            if (position === 'after') {
                targetIndex = fromIndex < toIndex ? toIndex : toIndex + 1;
            } else {
                targetIndex = fromIndex < toIndex ? toIndex - 1 : toIndex;
            }

            if (targetIndex < 0) targetIndex = 0;
            if (targetIndex >= files.length) targetIndex = files.length - 1;
            if (fromIndex === targetIndex) return;

            this.reorderItem(fromIndex, targetIndex);
        },

        animateReorder(fromEl, toEl, callback) {
            if (!this.pond || !this.pond.element) {
                if (callback) callback();
                return;
            }

            const root = this.pond.element;
            const items = Array.from(root.querySelectorAll('li.filepond--item'));

            // FIRST: Capture initial positions
            const firstRects = new Map();
            items.forEach(el => firstRects.set(el, el.getBoundingClientRect()));

            // DO WORK: Reorder DOM and internal state
            if (callback) callback();

            // LAST, INVERT, PLAY: Animate items to new positions
            requestAnimationFrame(() => {
                items.forEach(el => {
                    const first = firstRects.get(el);
                    const last = el.getBoundingClientRect();
                    if (!first) return;

                    const deltaY = first.top - last.top;
                    if (Math.abs(deltaY) > 0.5) {
                        el.style.transform = `translate3d(0, ${deltaY}px, 0)`;
                        el.style.transition = 'transform 0s';

                        requestAnimationFrame(() => {
                            el.style.transform = '';
                            el.style.transition = 'transform 260ms cubic-bezier(0.2, 0, 0, 1)';
                        });
                    }
                });

                // Clear inline styles after animation completes
                setTimeout(() => {
                    items.forEach(el => {
                        el.style.transform = '';
                        el.style.transition = '';
                    });
                }, 300);
            });
        },

        highlightItem(el) {
            if (!el) return;
            const target = el.querySelector('.filepond--file-wrapper') || el;
            target.classList.add('filepond--reorder-highlight');
            setTimeout(() => {
                target.classList.remove('filepond--reorder-highlight');
            }, 800);
        },

        reorderItem(fromIndex, toIndex) {
            if (!this.pond || fromIndex === toIndex) return;
            const files = typeof this.pond.getFiles === 'function' ? this.pond.getFiles() : [];
            if (fromIndex < 0 || fromIndex >= files.length || toIndex < 0 || toIndex >= files.length) return;

            const fromItem = files[fromIndex];
            const toItem = files[toIndex];

            const fromEl = this.findItemElement(fromItem.id, fromIndex);
            const toEl = this.findItemElement(toItem.id, toIndex);

            const performMove = () => {
                // 1. Move in FilePond internal state using integer index (100% reliable)
                if (typeof this.pond.moveFile === 'function') {
                    this.pond.moveFile(fromIndex, toIndex);
                }

                // 2. Move in DOM if list container exists
                if (fromEl && toEl && fromEl.parentNode) {
                    const parent = fromEl.parentNode;
                    if (fromIndex < toIndex) {
                        parent.insertBefore(fromEl, toEl.nextSibling);
                    } else {
                        parent.insertBefore(fromEl, toEl);
                    }
                }

                // 3. Highlight moved item
                const movedEl = this.findItemElement(fromItem.id, toIndex);
                if (movedEl) {
                    this.highlightItem(movedEl);
                }

                // 4. Sync form inputs and buttons
                this.syncFormInputsOrder();
                this.updateArrowButtonStates();
                this.updateReactiveState();

                // 5. Fire reorder event
                const detail = {
                    id: this.config?.id || (this.input ? this.input.id : 'filepond'),
                    fromIndex,
                    toIndex,
                    files: this.pond.getFiles()
                };
                this.fireEvent('reorder', detail);
            };

            // Animate using FLIP
            this.animateReorder(fromEl, toEl, performMove);
        },

        moveUp(itemId) {
            if (!this.pond || typeof this.pond.getFiles !== 'function') return;
            const files = this.pond.getFiles();
            const idx = files.findIndex(f => String(f.id) === String(itemId) || f.id === itemId || f.serverId === itemId);
            if (idx > 0) {
                this.reorderItem(idx, idx - 1);
            }
        },

        moveDown(itemId) {
            if (!this.pond || typeof this.pond.getFiles !== 'function') return;
            const files = this.pond.getFiles();
            const idx = files.findIndex(f => String(f.id) === String(itemId) || f.id === itemId || f.serverId === itemId);
            if (idx !== -1 && idx < files.length - 1) {
                this.reorderItem(idx, idx + 1);
            }
        },

        updateArrowButtonStates() {
            if (!this.pond || !this.pond.element) return;
            const root = this.pond.element;
            const items = Array.from(root.querySelectorAll('li.filepond--item'));
            const total = items.length;

            items.forEach((itemEl, idx) => {
                const upBtn = itemEl.querySelector('.filepond--reorder-btn-up');
                const downBtn = itemEl.querySelector('.filepond--reorder-btn-down');

                if (upBtn) {
                    upBtn.disabled = (idx === 0);
                }
                if (downBtn) {
                    downBtn.disabled = (idx === total - 1);
                }
            });
        },

        syncFormInputsOrder() {
            if (!this.pond || typeof this.pond.getFiles !== 'function') return;
            const isReorderEnabled = Boolean(
                this.config?.reorder ||
                this.config?.allowReorder ||
                (this.pond.element && this.pond.element.getAttribute('data-allow-reorder') === 'true')
            );
            if (!isReorderEnabled) return;

            const baseName = (this.config?.name || (this.input ? this.input.name : '')).replace(/\[\]$/, '');
            if (!baseName) return;

            const files = this.pond.getFiles();
            const root = this.pond.element || this.$el;
            if (!root) return;

            // Collect all hidden inputs and file inputs created by FilePond
            const allInputs = Array.from(root.querySelectorAll(`input[name^="${baseName}"]`));
            const hiddenInputs = allInputs.filter(inp => inp.type === 'hidden');
            const fileInputs = allInputs.filter(inp => inp.type === 'file');

            // Track matched inputs so we don't assign twice
            const usedInputs = new Set();

            files.forEach((fileItem, idx) => {
                const indexedName = `${baseName}[${idx}]`;
                const fileObj = fileItem.file;
                const sourceVal = fileItem.serverId || (typeof fileItem.source === 'string' ? fileItem.source : null);

                let matchedInput = null;

                // Case 1: UploadedFile (File/Blob)
                if (fileObj instanceof File || (fileObj && typeof fileObj === 'object' && fileObj.name)) {
                    matchedInput = fileInputs.find(inp => {
                        if (usedInputs.has(inp)) return false;
                        if (inp.files && inp.files.length > 0) {
                            return inp.files[0].name === fileObj.name && (fileObj.size ? inp.files[0].size === fileObj.size : true);
                        }
                        return false;
                    });
                }

                // Case 2: Preloaded or Server-Uploaded string URL/Key
                if (!matchedInput && sourceVal) {
                    matchedInput = hiddenInputs.find(inp => {
                        if (usedInputs.has(inp)) return false;
                        return inp.value === sourceVal;
                    });
                }

                // Case 3: Fallback by item ID or filename match
                if (!matchedInput) {
                    matchedInput = allInputs.find(inp => {
                        if (usedInputs.has(inp)) return false;
                        if (sourceVal && inp.value && (inp.value.includes(sourceVal) || sourceVal.includes(inp.value))) return true;
                        if (fileItem.filename && inp.value && inp.value.includes(fileItem.filename)) return true;
                        return false;
                    });
                }

                // Case 4: Positional fallback from remaining unused inputs
                if (!matchedInput) {
                    matchedInput = allInputs.find(inp => !usedInputs.has(inp));
                }

                if (matchedInput) {
                    usedInputs.add(matchedInput);
                    matchedInput.setAttribute('name', indexedName);
                    matchedInput.name = indexedName;
                }
            });
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
