/**
 * Vibe UI - Rich WYSIWYG Editor (TinyMCE Integration)
 * Alpine.js Driver for <vibe:editor>
 */

import tinymce from 'tinymce';
import 'tinymce/models/dom';
import 'tinymce/themes/silver';
import 'tinymce/icons/default';

// Core Plugins
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/autoresize';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/image';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/anchor';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/code';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/media';
import 'tinymce/plugins/table';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/accordion';

import '../../css/vibe/editor.css';

if (typeof window !== 'undefined') {
    window.tinymce = tinymce;
}

/**
 * Insert variable token into TinyMCE editor instance.
 */
function insertVariableToken(editor, key, style = 'badge', prefix = '{{ ', suffix = ' }}') {
    const cleanPrefix = (prefix || '{{ ').trim();
    const cleanSuffix = (suffix || ' }}').trim();
    const rawText = `${cleanPrefix} ${key} ${cleanSuffix}`;

    if (style === 'raw') {
        editor.insertContent(rawText);
    } else {
        const escapedKey = editor.dom.encode(key);
        const escapedText = editor.dom.encode(rawText);
        const html = `<span class="vibe-editor-variable mceNonEditable" contenteditable="false" data-variable="${escapedKey}" title="Variabel: ${escapedKey}">${escapedText}</span>&nbsp;`;
        editor.insertContent(html);
    }
}

/**
 * Alpine component state factory for <vibe:editor>
 */
export function vibeEditor(config = {}) {
    return {
        id: config.id || 'editor-' + Math.random().toString(36).substring(2, 9),
        name: config.name || null,
        value: config.value || '',
        placeholder: config.placeholder || '',
        preset: config.preset || 'standard',
        height: config.height || 350,
        minHeight: config.minHeight || 200,
        maxHeight: config.maxHeight || null,
        autoresize: Boolean(config.autoresize),
        menubar: config.menubar !== undefined ? config.menubar : false,
        toolbar: config.toolbar || null,
        toolbarMode: config.toolbarMode || 'sliding',
        toolbarSticky: config.toolbarSticky !== undefined ? Boolean(config.toolbarSticky) : true,
        toolbarStickyOffset: config.toolbarStickyOffset || 0,
        plugins: config.plugins || null,
        statusbar: config.statusbar !== undefined ? Boolean(config.statusbar) : true,
        readonly: Boolean(config.readonly),
        disabled: Boolean(config.disabled),
        uploadUrl: config.uploadUrl || null,
        uploadParam: config.uploadParam || 'file',
        uploadDisk: config.uploadDisk || null,
        uploadFolder: config.uploadFolder || null,
        variables: Array.isArray(config.variables) ? config.variables : [],
        groupedVariables: typeof config.groupedVariables === 'object' && config.groupedVariables !== null ? config.groupedVariables : {},
        variableStyle: config.variableStyle || 'badge',
        variablePrefix: config.variablePrefix || '{{ ',
        variableSuffix: config.variableSuffix || ' }}',
        variableButtonLabel: config.variableButtonLabel || 'Variabel',
        baseUrl: config.baseUrl || '/vibe/tinymce',
        wireModelName: config.wireModelName || null,
        isWireLive: Boolean(config.isWireLive),

        // UI & Lifecycle State
        editor: null,
        isMounted: false,
        isFocused: false,
        isDark: false,
        debounceTimer: null,
        themeObserver: null,
        _onThemeChange: null,

        init() {
            this.isDark = document.documentElement.classList.contains('dark');
            
            // Watch for external Livewire / Alpine value changes
            this.$watch('value', (newVal) => {
                if (this.editor && this.editor.initialized) {
                    const current = this.editor.getContent();
                    if ((newVal || '') !== current) {
                        this.editor.setContent(newVal || '');
                    }
                }
            });

            // Handle parent form reset
            const form = this.$el.closest('form');
            if (form) {
                form.addEventListener('reset', () => {
                    setTimeout(() => {
                        if (this.editor && this.editor.initialized) {
                            this.editor.setContent(this.value || '');
                        }
                    }, 50);
                });
            }

            // Listen for theme change events
            this._onThemeChange = () => {
                const currentIsDark = document.documentElement.classList.contains('dark');
                if (this.isDark !== currentIsDark && this.editor) {
                    this.isDark = currentIsDark;
                    this.reinit();
                }
            };
            window.addEventListener('vibe-theme-changed', this._onThemeChange);

            // MutationObserver on documentElement for class changes (dark mode toggle)
            this.themeObserver = new MutationObserver((mutations) => {
                for (const mutation of mutations) {
                    if (mutation.attributeName === 'class') {
                        const currentIsDark = document.documentElement.classList.contains('dark');
                        if (this.isDark !== currentIsDark && this.editor) {
                            this.isDark = currentIsDark;
                            this.reinit();
                        }
                    }
                }
            });
            this.themeObserver.observe(document.documentElement, { attributes: true });

            // Mount TinyMCE
            this.$nextTick(() => {
                this.mountEditor();
            });
        },

        mountEditor() {
            const self = this;
            const targetEl = document.getElementById(this.id);
            if (!targetEl) return;

            // Resolve Plugins
            let pluginsList = this.resolvePlugins();

            // Resolve Toolbar
            let toolbarStr = this.resolveToolbar();

            // Determine Skin & Content CSS
            const skinName = this.isDark ? 'oxide-dark' : 'oxide';
            const contentCssName = this.isDark ? 'dark' : 'default';

            const initConfig = {
                target: targetEl,
                license_key: 'gpl',
                base_url: this.baseUrl,
                skin_url: '/vibe/tinymce/skins/ui/' + skinName,
                content_css: '/vibe/tinymce/skins/content/' + contentCssName + '/content.min.css',
                skin: skinName,
                menubar: this.menubar,
                toolbar: toolbarStr,
                toolbar_mode: this.toolbarMode,
                toolbar_sticky: this.toolbarSticky,
                toolbar_sticky_offset: this.toolbarStickyOffset,
                plugins: pluginsList,
                height: this.height,
                min_height: this.minHeight,
                max_height: this.maxHeight,
                statusbar: this.statusbar,
                readonly: this.readonly || this.disabled,
                placeholder: this.placeholder,
                branding: false,
                promotion: false,
                elementpath: false,
                convert_urls: false,
                relative_urls: false,
                noneditable_class: 'mceNonEditable',
                noneditable_regexp: [/\{\{\s*[a-zA-Z0-9_\-\.]+\s*\}\}/g],

                // Content CSS Styles inside Iframe
                content_style: `
                    body {
                        font-family: var(--font-sans, Figtree, ui-sans-serif, system-ui, sans-serif);
                        font-size: 14.5px;
                        line-height: 1.65;
                        color: ${this.isDark ? '#fafafa' : '#09090b'};
                        background-color: ${this.isDark ? '#121215' : '#ffffff'};
                        padding: 0.875rem 1rem;
                        margin: 0;
                        outline: none !important;
                    }
                    body:focus, .mce-content-body:focus {
                        outline: none !important;
                        box-shadow: none !important;
                    }
                    .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                        color: ${this.isDark ? '#71717a' : '#a1a1aa'} !important;
                        font-style: normal !important;
                        opacity: 0.8 !important;
                    }
                    a {
                        color: ${this.isDark ? '#60a5fa' : '#2563eb'};
                    }
                    .vibe-editor-variable {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        padding: 0.125rem 0.5rem;
                        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
                        font-size: 0.75rem;
                        font-weight: 600;
                        line-height: 1.25;
                        color: ${this.isDark ? '#fafafa' : '#18181b'};
                        background-color: ${this.isDark ? '#27272a' : '#f4f4f5'};
                        border: 1px solid ${this.isDark ? '#3f3f46' : '#e4e4e7'};
                        border-radius: 9999px;
                        user-select: all;
                        cursor: default;
                        vertical-align: middle;
                        margin: 0 2px;
                        white-space: nowrap;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                    }
                `,

                setup: (editor) => {
                    self.editor = editor;

                    // Register Variable Menu Button in Toolbar
                    if (self.variables.length > 0 || Object.keys(self.groupedVariables).length > 0) {
                        editor.ui.registry.addMenuButton('variables', {
                            text: self.variableButtonLabel,
                            icon: 'code-sample',
                            tooltip: 'Sisipkan Variabel {{ model.kolom }}',
                            fetch: (callback) => {
                                const grouped = self.groupedVariables;
                                const menuItems = [];
                                const groupNames = Object.keys(grouped);

                                if (groupNames.length > 0) {
                                    groupNames.forEach(groupName => {
                                        const items = grouped[groupName] || [];
                                        const subItems = items.map(item => ({
                                            type: 'menuitem',
                                            text: item.label ? `${item.label} ({{ ${item.key} }})` : `{{ ${item.key} }}`,
                                            onAction: () => {
                                                insertVariableToken(editor, item.key, self.variableStyle, self.variablePrefix, self.variableSuffix);
                                            }
                                        }));

                                        menuItems.push({
                                            type: 'nestedmenuitem',
                                            text: groupName,
                                            getSubmenuItems: () => subItems
                                        });
                                    });
                                } else {
                                    self.variables.forEach(item => {
                                        menuItems.push({
                                            type: 'menuitem',
                                            text: item.label ? `${item.label} ({{ ${item.key} }})` : `{{ ${item.key} }}`,
                                            onAction: () => {
                                                insertVariableToken(editor, item.key, self.variableStyle, self.variablePrefix, self.variableSuffix);
                                            }
                                        });
                                    });
                                }

                                callback(menuItems);
                            }
                        });

                        // Register Autocompleter for '{{' Trigger
                        editor.ui.registry.addAutocompleter('vibe-variables-autocompleter', {
                            trigger: '{{',
                            minChars: 0,
                            columns: 1,
                            fetch: (pattern) => {
                                const query = (pattern || '').toLowerCase().trim();
                                const matches = self.variables.filter(v => {
                                    return !query ||
                                        v.key.toLowerCase().includes(query) ||
                                        (v.label && v.label.toLowerCase().includes(query)) ||
                                        (v.group && v.group.toLowerCase().includes(query));
                                });

                                return new Promise(resolve => {
                                    const results = matches.map(v => ({
                                        type: 'cardmenuitem',
                                        value: v.key,
                                        label: v.key,
                                        items: [
                                            {
                                                type: 'cardtext',
                                                text: `{{ ${v.key} }}`,
                                                classes: ['vibe-ac-token']
                                            },
                                            {
                                                type: 'cardtext',
                                                text: v.label ? `${v.label}${v.group ? ' (' + v.group + ')' : ''}` : (v.group || ''),
                                                classes: ['vibe-ac-desc']
                                            }
                                        ]
                                    }));
                                    resolve(results);
                                });
                            },
                            onAction: (autocompleteApi, rng, value) => {
                                editor.selection.setRng(rng);
                                insertVariableToken(editor, value, self.variableStyle, self.variablePrefix, self.variableSuffix);
                                autocompleteApi.hide();
                            }
                        });
                    }

                    // Focus & Blur Events
                    editor.on('focus', () => {
                        self.isFocused = true;
                    });
                    editor.on('blur', () => {
                        self.isFocused = false;
                        self.syncContent();
                    });

                    // Input & Change Sync
                    editor.on('input change keyup undo redo', () => {
                        self.queueSyncContent();
                    });

                    // Init Finish
                    editor.on('init', () => {
                        self.isMounted = true;
                        if (self.value) {
                            editor.setContent(self.value);
                        }
                    });
                },

                // Image Upload Handler
                images_upload_handler: (blobInfo, progress) => {
                    return new Promise((resolve, reject) => {
                        if (!self.uploadUrl) {
                            // Fallback to inline base64 data URI
                            resolve('data:' + blobInfo.blob().type + ';base64,' + blobInfo.base64());
                            return;
                        }

                        const xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', self.uploadUrl);

                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        if (token) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }

                        xhr.upload.onprogress = (e) => {
                            if (e.lengthComputable) {
                                progress(Math.round((e.loaded / e.total) * 100));
                            }
                        };

                        xhr.onload = () => {
                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }
                            try {
                                const json = JSON.parse(xhr.responseText);
                                const url = json.location || json.url || json.path;
                                if (!url) {
                                    reject('Invalid JSON response: missing location/url');
                                    return;
                                }
                                resolve(url);
                            } catch (err) {
                                reject('Invalid JSON response: ' + xhr.responseText);
                            }
                        };

                        xhr.onerror = () => {
                            reject('Image upload failed due to a network error.');
                        };

                        const formData = new FormData();
                        formData.append(self.uploadParam, blobInfo.blob(), blobInfo.filename());
                        if (self.uploadDisk) formData.append('disk', self.uploadDisk);
                        if (self.uploadFolder) formData.append('folder', self.uploadFolder);

                        xhr.send(formData);
                    });
                }
            };

            tinymce.init(initConfig).catch(err => {
                console.error('[Vibe Editor] Failed to initialize TinyMCE:', err);
            });
        },

        resolvePlugins() {
            if (this.plugins) {
                return Array.isArray(this.plugins) ? this.plugins.join(' ') : this.plugins;
            }

            const basePlugins = 'advlist autolink lists link image table code wordcount searchreplace visualblocks';
            const autoresizePlugin = this.autoresize ? ' autoresize' : '';

            switch (this.preset) {
                case 'minimal':
                    return 'autolink link lists' + autoresizePlugin;
                case 'basic':
                    return 'autolink lists link' + autoresizePlugin;
                case 'full':
                    return 'advlist autolink lists link image media table code wordcount searchreplace visualblocks fullscreen preview accordion' + autoresizePlugin;
                case 'standard':
                default:
                    return basePlugins + autoresizePlugin;
            }
        },

        resolveToolbar() {
            if (this.toolbar) {
                return this.toolbar;
            }

            const hasVariables = this.variables.length > 0 || Object.keys(this.groupedVariables).length > 0;
            const varBtn = hasVariables ? ' variables' : '';

            switch (this.preset) {
                case 'minimal':
                    return 'undo redo | bold italic underline | link' + varBtn;
                case 'basic':
                    return 'undo redo | blocks | bold italic underline strikethrough | bullist numlist | link' + varBtn + ' | removeformat';
                case 'full':
                    return 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | accordion' + varBtn + ' | removeformat code fullscreen preview';
                case 'standard':
                default:
                    return 'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright | bullist numlist | link image table' + varBtn + ' | removeformat code';
            }
        },

        queueSyncContent() {
            if (this.debounceTimer) {
                clearTimeout(this.debounceTimer);
            }
            this.debounceTimer = setTimeout(() => {
                this.syncContent();
            }, 180);
        },

        syncContent() {
            if (!this.editor) return;
            const content = this.editor.getContent();
            this.value = content;

            if (this.$refs.textarea) {
                this.$refs.textarea.value = content;
                this.$refs.textarea.dispatchEvent(new Event('input', { bubbles: true }));
                this.$refs.textarea.dispatchEvent(new Event('change', { bubbles: true }));
            }

            if (this.wireModelName && this.$wire) {
                if (this.isWireLive) {
                    this.$wire.set(this.wireModelName, content, false);
                } else {
                    this.$wire.set(this.wireModelName, content);
                }
            }
        },

        reinit() {
            if (this.editor) {
                const currentContent = this.editor.getContent();
                try {
                    tinymce.remove('#' + this.id);
                } catch (e) {}
                this.editor = null;
                this.isMounted = false;
                this.value = currentContent;
                this.$nextTick(() => {
                    this.mountEditor();
                });
            }
        },

        destroy() {
            if (this.themeObserver) {
                this.themeObserver.disconnect();
                this.themeObserver = null;
            }
            if (this._onThemeChange) {
                window.removeEventListener('vibe-theme-changed', this._onThemeChange);
                this._onThemeChange = null;
            }
            if (this.debounceTimer) {
                clearTimeout(this.debounceTimer);
                this.debounceTimer = null;
            }
            if (this.editor) {
                try {
                    tinymce.remove('#' + this.id);
                } catch (e) {}
                this.editor = null;
            }
        }
    };
}

if (typeof window !== 'undefined') {
    window.vibeEditor = vibeEditor;

    document.addEventListener('alpine:init', () => {
        if (window.Alpine && typeof window.Alpine.data === 'function') {
            window.Alpine.data('vibeEditor', vibeEditor);
        }
    });

    if (window.Alpine && typeof window.Alpine.data === 'function') {
        window.Alpine.data('vibeEditor', vibeEditor);
    }

    window.dispatchEvent(new CustomEvent('vibe-editor-ready'));
}
