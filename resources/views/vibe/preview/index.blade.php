@blaze

@props([
    'id' => null,
    'persist' => false,
    'title' => null,
    'tab' => 'preview',
    'canvasTheme' => 'auto',
    'viewport' => '100%',
    'center' => true,
    'viewports' => true,
    'themeSwitch' => true,
    'pattern' => 'dots',
    'minHeight' => null,
    'code' => null,
    'language' => 'blade',
    'lang' => null,
])

@php
    $resolvedLang = $lang ?: $language;
    $minHeightStyle = $minHeight ? (is_numeric($minHeight) ? "min-height: {$minHeight}px;" : "min-height: {$minHeight};") : 'min-height: 180px;';
    $previewId = $id ?? ($title ? 'preview-' . \Illuminate\Support\Str::slug($title) : uniqid('preview-'));
    $canvasId = $previewId . '-canvas';
    $wrapperId = $previewId . '-wrapper';
    $codeId = $previewId . '-code';
    $viewportGroupId = $previewId . '-viewport-group';
    $themeGroupId = $previewId . '-theme-group';
@endphp

@pushOnce('head', 'vibe-preview-script')
<script>
    if (!window.VibePreview) {
        window.VibePreview = {
            getStored: function(id) {
                try {
                    var key = (window.VIBE_PREFIX || 'vibe') + '-preview';
                    var stored = localStorage.getItem(key);
                    if (stored) {
                        var data = JSON.parse(stored);
                        return Array.isArray(data) ? data.find(function(i) { return i.id === id; }) : data[id];
                    }
                } catch(e) {}
                return null;
            },
            getProp: function(id, prop, fallback) {
                var item = this.getStored(id);
                return (item && item[prop] !== undefined) ? item[prop] : fallback;
            }
        };
    }
</script>
@endPushOnce

<div
    id="{{ $previewId }}"
    data-toc-ignore
    x-data="{
        id: '{{ $previewId }}',
        tab: {{ $persist ? "window.VibePreview.getProp('{$previewId}', 'tab', '{$tab}')" : "'{$tab}'" }},
        canvasTheme: {{ $persist ? "window.VibePreview.getProp('{$previewId}', 'canvasTheme', '{$canvasTheme}')" : "'{$canvasTheme}'" }},
        viewport: {{ $persist ? "window.VibePreview.getProp('{$previewId}', 'viewport', '{$viewport}')" : "'{$viewport}'" }},
        copied: false,
        persist: {{ $persist ? 'true' : 'false' }},
        isInitialized: false,

        init() {
            // Relocate preview.code from canvas to code viewer container
            let codeContainer = this.$el.querySelector('#' + this.id + '-code');
            let codeEls = this.$el.querySelectorAll('[data-vibe-preview-code]');
            codeEls.forEach(el => {
                if (codeContainer && el.parentElement !== codeContainer) {
                    codeContainer.appendChild(el);
                }
                el.style.display = '';
            });

            this.$nextTick(() => {
                setTimeout(() => {
                    this.isInitialized = true;
                }, 50);
            });
            @if ($persist)
            this.$watch('tab', () => this.saveToStorage());
            this.$watch('canvasTheme', () => this.saveToStorage());
            this.$watch('viewport', () => this.saveToStorage());
            @endif
        },

        saveToStorage() {
            if (!this.persist) return;
            try {
                let key = (window.VIBE_PREFIX || 'vibe') + '-preview';
                let stored = localStorage.getItem(key);
                let data = [];
                if (stored) {
                    let parsed = JSON.parse(stored);
                    if (Array.isArray(parsed)) data = parsed;
                }
                let index = data.findIndex(i => i.id === this.id);
                let itemData = {
                    id: this.id,
                    tab: this.tab,
                    canvasTheme: this.canvasTheme,
                    viewport: this.viewport
                };
                if (index > -1) {
                    data[index] = itemData;
                } else {
                    data.push(itemData);
                }
                localStorage.setItem(key, JSON.stringify(data));
            } catch (e) {}
        },

        copyAllCode() {
            let codeBlock = this.$el.querySelector('[data-vibe-highlight]') || this.$el.querySelector('code.hljs');
            let text = codeBlock ? (codeBlock.dataset.rawCode || codeBlock.innerText || codeBlock.textContent) : '';
            if (navigator.clipboard && text) {
                navigator.clipboard.writeText(text.trim()).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                });
            }
        }
    }"
    {{ $attributes->twMerge(['class' => 'group/preview relative flex flex-col rounded-2xl border border-border bg-card text-card-foreground shadow-xs']) }}
>
    {{-- Preview Toolbar Header --}}
    <div class="relative flex items-center justify-between min-h-10.5 px-3.5 py-2 bg-muted/40 dark:bg-muted/20 border-b border-border text-xs">
        {{-- Left: Segmented Tab Buttons --}}
        <div class="relative z-10 flex items-center gap-2 shrink-0">
            <div class="inline-flex items-center gap-0.5 p-0.5 rounded-lg bg-muted/90 dark:bg-muted/60 border border-border/80 shadow-2xs select-none">
                <button
                    data-vibe-btn-tab="preview"
                    type="button"
                    @click="tab = 'preview'"
                    :class="{
                        'bg-background text-foreground shadow-xs font-semibold': tab === 'preview',
                        'text-muted-foreground hover:text-foreground hover:bg-background/40 font-medium': tab !== 'preview'
                    }"
                    class="inline-flex items-center justify-center gap-1.5 px-3 min-h-7 rounded-md text-xs cursor-pointer focus:outline-none transition-all duration-150 {{ $tab === 'preview' ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-background/40 font-medium' }}"
                    aria-label="{{ __('vibe/preview.show_preview') }}"
                >
                    <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                        <circle cx="12" cy="3" r="3" />
                    </svg>
                    <span>{{ __('vibe/preview.preview') }}</span>
                </button>

                <button
                    data-vibe-btn-tab="code"
                    type="button"
                    @click="tab = 'code'; $nextTick(() => {
                        let blocks = $el.closest('[id^=preview-]')?.querySelectorAll('code[data-vibe-highlight]');
                        if (blocks && window.hljs) {
                            blocks.forEach(b => {
                                if (b.dataset.highlighted !== 'yes') window.hljs.highlightElement(b);
                            });
                        }
                    })"
                    :class="{
                        'bg-background text-foreground shadow-xs font-semibold': tab === 'code',
                        'text-muted-foreground hover:text-foreground hover:bg-background/40 font-medium': tab !== 'code'
                    }"
                    class="inline-flex items-center justify-center gap-1.5 px-3 min-h-7 rounded-md text-xs cursor-pointer focus:outline-none transition-all duration-150 {{ $tab === 'code' ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground hover:bg-background/40 font-medium' }}"
                    aria-label="{{ __('vibe/preview.show_code') }}"
                >
                    <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6" />
                        <polyline points="8 6 2 12 8 18" />
                    </svg>
                    <span>{{ __('vibe/preview.code') }}</span>
                </button>
            </div>
        </div>

        {{-- Center: Title (True Absolute Geometric Center) --}}
        @if ($title)
            <div class="pointer-events-none absolute inset-x-0 inset-y-0 hidden md:flex items-center justify-center px-32 text-center">
                <span class="truncate font-semibold text-xs text-foreground">{{ $title }}</span>
            </div>
        @endif

        {{-- Right: Toolbar Controls (Viewport Resizer + Dark/Light Mode Switcher) --}}
        <div class="relative z-10 flex items-center justify-end gap-1.5 shrink-0">
            {{-- Viewport Switcher (Only visible in Preview tab) --}}
            @if ($viewports)
                <div
                    id="{{ $viewportGroupId }}"
                    x-show="tab === 'preview'"
                    class="hidden sm:inline-flex items-center gap-0.5 p-0.5 rounded-lg bg-muted/90 dark:bg-muted/60 border border-border/80 shadow-2xs select-none"
                    style="{{ $tab === 'code' ? 'display: none;' : '' }}"
                >
                    {{-- Desktop 100% --}}
                    <button
                        data-vibe-btn-viewport="100%"
                        type="button"
                        @click="viewport = '100%'"
                        :class="{
                            'bg-background text-foreground shadow-xs': viewport === '100%',
                            'text-muted-foreground hover:text-foreground hover:bg-background/40': viewport !== '100%'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-all duration-150 {{ $viewport === '100%' ? 'bg-background text-foreground shadow-xs' : 'text-muted-foreground hover:text-foreground hover:bg-background/40' }}"
                        title="{{ __('vibe/preview.desktop_view') }}"
                        aria-label="{{ __('vibe/preview.desktop_view') }}"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="3" rx="2" />
                            <line x1="8" x2="16" y1="21" y2="21" />
                            <line x1="12" x2="12" y1="17" y2="21" />
                        </svg>
                    </button>

                    {{-- Tablet 768px --}}
                    <button
                        data-vibe-btn-viewport="768px"
                        type="button"
                        @click="viewport = '768px'"
                        :class="{
                            'bg-background text-foreground shadow-xs': viewport === '768px',
                            'text-muted-foreground hover:text-foreground hover:bg-background/40': viewport !== '768px'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-all duration-150 {{ $viewport === '768px' ? 'bg-background text-foreground shadow-xs' : 'text-muted-foreground hover:text-foreground hover:bg-background/40' }}"
                        title="{{ __('vibe/preview.tablet_view') }}"
                        aria-label="{{ __('vibe/preview.tablet_view') }}"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="14" x="3" y="5" rx="2" ry="2" />
                            <line x1="12" x2="12.01" y1="16" y2="16" />
                        </svg>
                    </button>

                    {{-- Mobile 375px --}}
                    <button
                        data-vibe-btn-viewport="375px"
                        type="button"
                        @click="viewport = '375px'"
                        :class="{
                            'bg-background text-foreground shadow-xs': viewport === '375px',
                            'text-muted-foreground hover:text-foreground hover:bg-background/40': viewport !== '375px'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-all duration-150 {{ $viewport === '375px' ? 'bg-background text-foreground shadow-xs' : 'text-muted-foreground hover:text-foreground hover:bg-background/40' }}"
                        title="{{ __('vibe/preview.mobile_view') }}"
                        aria-label="{{ __('vibe/preview.mobile_view') }}"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                            <path d="M12 18h.01" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Isolated Canvas Dark/Light Theme Switcher --}}
            @if ($themeSwitch)
                <div
                    id="{{ $themeGroupId }}"
                    x-show="tab === 'preview'"
                    class="inline-flex items-center gap-0.5 p-0.5 rounded-lg bg-muted/90 dark:bg-muted/60 border border-border/80 shadow-2xs select-none"
                    style="{{ $tab === 'code' ? 'display: none;' : '' }}"
                >
                    {{-- Auto / System Mode --}}
                    <button
                        data-vibe-btn-theme="auto"
                        type="button"
                        @click="canvasTheme = 'auto'"
                        :class="{
                            'bg-background text-foreground shadow-xs': canvasTheme === 'auto',
                            'text-muted-foreground hover:text-foreground hover:bg-background/40': canvasTheme !== 'auto'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-all duration-150 {{ $canvasTheme === 'auto' ? 'bg-background text-foreground shadow-xs' : 'text-muted-foreground hover:text-foreground hover:bg-background/40' }}"
                        title="{{ __('vibe/preview.theme_auto') }}"
                        aria-label="{{ __('vibe/preview.theme_auto') }}"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="3" rx="2" />
                            <line x1="8" x2="16" y1="21" y2="21" />
                            <line x1="12" x2="12" y1="17" y2="21" />
                        </svg>
                    </button>

                    {{-- Force Light Mode --}}
                    <button
                        data-vibe-btn-theme="light"
                        type="button"
                        @click="canvasTheme = 'light'"
                        :class="{
                            'bg-background text-amber-500 shadow-xs': canvasTheme === 'light',
                            'text-muted-foreground hover:text-foreground hover:bg-background/40': canvasTheme !== 'light'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-all duration-150 {{ $canvasTheme === 'light' ? 'bg-background text-amber-500 shadow-xs' : 'text-muted-foreground hover:text-foreground hover:bg-background/40' }}"
                        title="{{ __('vibe/preview.theme_light') }}"
                        aria-label="{{ __('vibe/preview.theme_light') }}"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41" />
                        </svg>
                    </button>

                    {{-- Force Dark Mode --}}
                    <button
                        data-vibe-btn-theme="dark"
                        type="button"
                        @click="canvasTheme = 'dark'"
                        :class="{
                            'bg-background text-indigo-400 shadow-xs': canvasTheme === 'dark',
                            'text-muted-foreground hover:text-foreground hover:bg-background/40': canvasTheme !== 'dark'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-all duration-150 {{ $canvasTheme === 'dark' ? 'bg-background text-indigo-400 shadow-xs' : 'text-muted-foreground hover:text-foreground hover:bg-background/40' }}"
                        title="{{ __('vibe/preview.theme_dark') }}"
                        aria-label="{{ __('vibe/preview.theme_dark') }}"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Interactive Live Preview Canvas Area --}}
    <div
        id="{{ $canvasId }}"
        x-show="tab === 'preview'"
        data-canvas-theme="{{ $canvasTheme }}"
        :data-canvas-theme="canvasTheme"
        class="relative w-full rounded-b-2xl transition-colors duration-300 {{ $canvasTheme === 'dark' ? 'dark' : ($canvasTheme === 'light' ? 'light' : '') }}"
        :class="{
            'dark': canvasTheme === 'dark',
            'light': canvasTheme === 'light'
        }"
        style="{{ $tab === 'code' ? 'display: none;' : '' }}"
    >
        {{-- Background Pattern Decoration --}}
        @if ($pattern === 'dots')
            <div class="pointer-events-none absolute inset-0 rounded-b-2xl opacity-25 dark:opacity-15 bg-[radial-gradient(#737373_1px,transparent_1px)] dark:bg-[radial-gradient(#d4d4d8_1px,transparent_1px)] bg-size-[16px_16px]"></div>
        @elseif ($pattern === 'grid')
            <div class="pointer-events-none absolute inset-0 rounded-b-2xl opacity-25 dark:opacity-20 bg-[linear-gradient(to_right,#8080801a_1px,transparent_1px),linear-gradient(to_bottom,#8080801a_1px,transparent_1px)] dark:bg-[linear-gradient(to_right,#ffffff1a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff1a_1px,transparent_1px)] bg-size-[24px_24px]"></div>
        @endif

        {{-- Resizable Inner Wrapper --}}
        <div
            id="{{ $wrapperId }}"
            class="relative transition-all duration-300 mx-auto w-full p-6 {{ $center ? 'flex items-center justify-center sm:p-10' : 'sm:p-8' }}"
            style="max-width: {{ $viewport }}; {{ $minHeightStyle }}"
            :style="{ maxWidth: viewport }"
        >
            {{ $slot }}
        </div>
    </div>

    {{-- Code Viewer Area --}}
    <div
        id="{{ $codeId }}"
        x-show="tab === 'code'"
        class="rounded-b-2xl overflow-hidden"
        style="{{ $tab === 'code' ? 'display: block;' : 'display: none;' }}"
    >
        @if (isset($code) && !empty($code))
            @if ($code instanceof \Illuminate\Support\HtmlString || (is_object($code) && method_exists($code, '__toString')))
                {{ $code }}
            @else
                <vibe:preview.code :code="(string) $code" :language="$resolvedLang" />
            @endif
        @elseif (isset($codeSlot))
            {{ $codeSlot }}
        @endif
    </div>
</div>

@if ($persist)
<script>
    (function() {
        try {
            var item = window.VibePreview ? window.VibePreview.getStored('{{ $previewId }}') : null;
            if (item) {
                var root = document.getElementById('{{ $previewId }}');
                var canvas = document.getElementById('{{ $canvasId }}');
                var wrapper = document.getElementById('{{ $wrapperId }}');
                var codeView = document.getElementById('{{ $codeId }}');
                var viewportGroup = document.getElementById('{{ $viewportGroupId }}');
                var themeGroup = document.getElementById('{{ $themeGroupId }}');

                // 1. Tab buttons & panel anti-FOUC
                if (item.tab) {
                    var btnPreview = root ? root.querySelector('[data-vibe-btn-tab="preview"]') : null;
                    var btnCode = root ? root.querySelector('[data-vibe-btn-tab="code"]') : null;
                    var activeTabClasses = ['bg-background', 'text-foreground', 'shadow-xs', 'font-semibold'];
                    var inactiveTabClasses = ['text-muted-foreground', 'hover:text-foreground', 'hover:bg-background/40', 'font-medium'];

                    if (item.tab === 'code') {
                        if (canvas) canvas.style.display = 'none';
                        if (codeView) codeView.style.display = 'block';
                        if (viewportGroup) viewportGroup.style.display = 'none';
                        if (themeGroup) themeGroup.style.display = 'none';

                        if (btnPreview) {
                            activeTabClasses.forEach(function(c) { btnPreview.classList.remove(c); });
                            inactiveTabClasses.forEach(function(c) { btnPreview.classList.add(c); });
                        }
                        if (btnCode) {
                            inactiveTabClasses.forEach(function(c) { btnCode.classList.remove(c); });
                            activeTabClasses.forEach(function(c) { btnCode.classList.add(c); });
                        }
                    } else if (item.tab === 'preview') {
                        if (canvas) canvas.style.display = 'block';
                        if (codeView) codeView.style.display = 'none';
                        if (viewportGroup) viewportGroup.style.display = '';
                        if (themeGroup) themeGroup.style.display = '';

                        if (btnPreview) {
                            inactiveTabClasses.forEach(function(c) { btnPreview.classList.remove(c); });
                            activeTabClasses.forEach(function(c) { btnPreview.classList.add(c); });
                        }
                        if (btnCode) {
                            activeTabClasses.forEach(function(c) { btnCode.classList.remove(c); });
                            inactiveTabClasses.forEach(function(c) { btnCode.classList.add(c); });
                        }
                    }
                }

                // 2. Viewport buttons & canvas width anti-FOUC
                if (item.viewport) {
                    if (wrapper) wrapper.style.maxWidth = item.viewport;
                    var vpButtons = root ? root.querySelectorAll('[data-vibe-btn-viewport]') : [];
                    var activeVpClasses = ['bg-background', 'text-foreground', 'shadow-xs'];
                    var inactiveVpClasses = ['text-muted-foreground', 'hover:text-foreground', 'hover:bg-background/40'];

                    vpButtons.forEach(function(btn) {
                        if (btn.getAttribute('data-vibe-btn-viewport') === item.viewport) {
                            inactiveVpClasses.forEach(function(c) { btn.classList.remove(c); });
                            activeVpClasses.forEach(function(c) { btn.classList.add(c); });
                        } else {
                            activeVpClasses.forEach(function(c) { btn.classList.remove(c); });
                            inactiveVpClasses.forEach(function(c) { btn.classList.add(c); });
                        }
                    });
                }

                // 3. Canvas Theme & theme buttons anti-FOUC
                if (item.canvasTheme) {
                    if (canvas) {
                        canvas.setAttribute('data-canvas-theme', item.canvasTheme);
                        canvas.classList.remove('dark', 'light');
                        if (item.canvasTheme === 'dark') {
                            canvas.classList.add('dark');
                        } else if (item.canvasTheme === 'light') {
                            canvas.classList.add('light');
                        }
                    }

                    var themeButtons = root ? root.querySelectorAll('[data-vibe-btn-theme]') : [];
                    themeButtons.forEach(function(btn) {
                        var t = btn.getAttribute('data-vibe-btn-theme');
                        btn.classList.remove('bg-background', 'text-foreground', 'text-amber-500', 'text-indigo-400', 'shadow-xs');
                        if (t === item.canvasTheme) {
                            btn.classList.add('bg-background', 'shadow-xs');
                            if (t === 'light') btn.classList.add('text-amber-500');
                            else if (t === 'dark') btn.classList.add('text-indigo-400');
                            else btn.classList.add('text-foreground');
                            btn.classList.remove('text-muted-foreground', 'hover:bg-background/40');
                        } else {
                            btn.classList.add('text-muted-foreground', 'hover:text-foreground', 'hover:bg-background/40');
                        }
                    });
                }
            }
        } catch (e) {}
    })();
</script>
@endif
