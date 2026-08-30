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
    $resolvedLang = $lang ?? ($language ?? 'blade');
    $minHeightStyle = $minHeight ? (is_numeric($minHeight) ? "min-height: {$minHeight}px;" : "min-height: {$minHeight};") : 'min-height: 180px;';
    $previewId = $id ?? ($title ? 'preview-' . \Illuminate\Support\Str::slug($title) : uniqid('preview-'));
    $canvasId = $previewId . '-canvas';
    $wrapperId = $previewId . '-wrapper';
    $codeId = $previewId . '-code';
    $viewportGroupId = $previewId . '-viewport-group';
    $themeGroupId = $previewId . '-theme-group';
@endphp

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

<div
    id="{{ $previewId }}"
    x-data="{
        id: '{{ $previewId }}',
        tab: {{ $persist ? "window.VibePreview.getProp('{$previewId}', 'tab', '{$tab}')" : "'{$tab}'" }},
        canvasTheme: {{ $persist ? "window.VibePreview.getProp('{$previewId}', 'canvasTheme', '{$canvasTheme}')" : "'{$canvasTheme}'" }},
        viewport: {{ $persist ? "window.VibePreview.getProp('{$previewId}', 'viewport', '{$viewport}')" : "'{$viewport}'" }},
        copied: false,
        persist: {{ $persist ? 'true' : 'false' }},
        isInitialized: false,

        init() {
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
            let text = codeBlock ? (codeBlock.innerText || codeBlock.textContent) : '';
            if (navigator.clipboard && text) {
                navigator.clipboard.writeText(text.trim()).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                });
            }
        }
    }"
    {{ $attributes->twMerge(['class' => 'group/preview relative flex flex-col rounded-2xl border border-vibe-200 dark:border-vibe-800 bg-vibe-50 dark:bg-vibe-950 overflow-hidden shadow-xs']) }}
>
    {{-- Preview Toolbar Header --}}
    <div class="relative flex items-center justify-between min-h-10.5 px-3.5 py-2 bg-vibe-100/70 dark:bg-vibe-900/60 border-b border-vibe-200 dark:border-vibe-800 text-xs">
        {{-- Left: Segmented Tab Buttons --}}
        <div class="relative z-10 flex items-center gap-2 shrink-0">
            <div class="inline-flex items-center gap-0.5 p-0.5 rounded-lg bg-vibe-200/80 dark:bg-vibe-800/80 border border-vibe-300/40 dark:border-vibe-700/40 select-none">
                <button
                    data-vibe-btn-tab="preview"
                    type="button"
                    @click="tab = 'preview'"
                    :class="{
                        'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs font-semibold': tab === 'preview',
                        'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 font-medium': tab !== 'preview'
                    }"
                    class="inline-flex items-center justify-center gap-1.5 px-3 min-h-7 rounded-md text-xs cursor-pointer focus:outline-none transition-colors duration-150 {{ $tab === 'preview' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs font-semibold' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 font-medium' }}"
                    aria-label="Tampilkan live preview"
                >
                    <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <span>Preview</span>
                </button>

                <button
                    data-vibe-btn-tab="code"
                    type="button"
                    @click="tab = 'code'"
                    :class="{
                        'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs font-semibold': tab === 'code',
                        'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 font-medium': tab !== 'code'
                    }"
                    class="inline-flex items-center justify-center gap-1.5 px-3 min-h-7 rounded-md text-xs cursor-pointer focus:outline-none transition-colors duration-150 {{ $tab === 'code' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs font-semibold' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 font-medium' }}"
                    aria-label="Tampilkan kode sumber"
                >
                    <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6" />
                        <polyline points="8 6 2 12 8 18" />
                    </svg>
                    <span>Code</span>
                </button>
            </div>
        </div>

        {{-- Center: Title (True Absolute Geometric Center) --}}
        @if ($title)
            <div class="pointer-events-none absolute inset-x-0 inset-y-0 flex items-center justify-center px-36 text-center">
                <span class="truncate font-semibold text-xs text-vibe-900 dark:text-vibe-100">{{ $title }}</span>
            </div>
        @endif

        {{-- Right: Toolbar Controls (Viewport Resizer + Dark/Light Mode Switcher) --}}
        <div class="relative z-10 flex items-center justify-end gap-1.5 shrink-0">
            {{-- Viewport Switcher (Only visible in Preview tab) --}}
            @if ($viewports)
                <div
                    id="{{ $viewportGroupId }}"
                    x-show="tab === 'preview'"
                    class="hidden sm:inline-flex items-center gap-0.5 p-0.5 rounded-lg bg-vibe-200/80 dark:bg-vibe-800/80 border border-vibe-300/40 dark:border-vibe-700/40 select-none"
                    style="{{ $tab === 'code' ? 'display: none;' : '' }}"
                >
                    {{-- Desktop 100% --}}
                    <button
                        data-vibe-btn-viewport="100%"
                        type="button"
                        @click="viewport = '100%'"
                        :class="{
                            'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs': viewport === '100%',
                            'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50': viewport !== '100%'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-colors duration-150 {{ $viewport === '100%' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50' }}"
                        title="Desktop (100%)"
                        aria-label="Tampilan desktop 100%"
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
                            'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs': viewport === '768px',
                            'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50': viewport !== '768px'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-colors duration-150 {{ $viewport === '768px' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50' }}"
                        title="Tablet (768px)"
                        aria-label="Tampilan tablet 768px"
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
                            'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs': viewport === '375px',
                            'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50': viewport !== '375px'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-colors duration-150 {{ $viewport === '375px' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50' }}"
                        title="Mobile (375px)"
                        aria-label="Tampilan mobile 375px"
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
                    class="inline-flex items-center gap-0.5 p-0.5 rounded-lg bg-vibe-200/80 dark:bg-vibe-800/80 border border-vibe-300/40 dark:border-vibe-700/40 select-none"
                    style="{{ $tab === 'code' ? 'display: none;' : '' }}"
                >
                    {{-- Auto / System Mode --}}
                    <button
                        data-vibe-btn-theme="auto"
                        type="button"
                        @click="canvasTheme = 'auto'"
                        :class="{
                            'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs': canvasTheme === 'auto',
                            'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50': canvasTheme !== 'auto'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-colors duration-150 {{ $canvasTheme === 'auto' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50' }}"
                        title="Mode Otomatis (Mengikuti tema web)"
                        aria-label="Mode tema otomatis"
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
                            'bg-white dark:bg-vibe-950 text-amber-500 shadow-xs': canvasTheme === 'light',
                            'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50': canvasTheme !== 'light'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-colors duration-150 {{ $canvasTheme === 'light' ? 'bg-white dark:bg-vibe-950 text-amber-500 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50' }}"
                        title="Uji Canvas Mode Terang"
                        aria-label="Uji mode terang"
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
                            'bg-white dark:bg-vibe-950 text-indigo-400 shadow-xs': canvasTheme === 'dark',
                            'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50': canvasTheme !== 'dark'
                        }"
                        class="inline-flex items-center justify-center size-7 rounded-md cursor-pointer focus:outline-none transition-colors duration-150 {{ $canvasTheme === 'dark' ? 'bg-white dark:bg-vibe-950 text-indigo-400 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50' }}"
                        title="Uji Canvas Mode Gelap"
                        aria-label="Uji mode gelap"
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
        class="relative w-full overflow-hidden transition-all duration-300 {{ $canvasTheme === 'dark' ? 'dark bg-vibe-950 text-vibe-50' : ($canvasTheme === 'light' ? 'light bg-white text-vibe-950' : 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50') }}"
        :class="{
            'dark bg-vibe-950 text-vibe-50': canvasTheme === 'dark',
            'light bg-white text-vibe-950': canvasTheme === 'light',
            'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50': canvasTheme === 'auto'
        }"
        style="{{ $tab === 'code' ? 'display: none;' : '' }}"
    >
        {{-- Background Pattern Decoration --}}
        @if ($pattern === 'dots')
            <div class="pointer-events-none absolute inset-0 opacity-[0.25] dark:opacity-[0.15] bg-[radial-gradient(#737373_1px,transparent_1px)] bg-size-[16px_16px]"></div>
        @elseif ($pattern === 'grid')
            <div class="pointer-events-none absolute inset-0 opacity-[0.2] dark:opacity-[0.12] bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-size-[24px_24px]"></div>
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
                    var activeTabClasses = ['bg-white', 'dark:bg-vibe-950', 'text-vibe-950', 'dark:text-vibe-50', 'shadow-xs', 'font-semibold'];
                    var inactiveTabClasses = ['text-vibe-600', 'dark:text-vibe-400', 'hover:text-vibe-950', 'dark:hover:text-vibe-50', 'font-medium'];

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
                    var activeVpClasses = ['bg-white', 'dark:bg-vibe-950', 'text-vibe-950', 'dark:text-vibe-50', 'shadow-xs'];
                    var inactiveVpClasses = ['text-vibe-600', 'dark:text-vibe-400', 'hover:text-vibe-950', 'dark:hover:text-vibe-50'];

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
                        canvas.classList.remove('dark', 'light', 'bg-white', 'bg-vibe-950', 'text-vibe-50', 'text-vibe-950');
                        if (item.canvasTheme === 'dark') {
                            canvas.classList.add('dark', 'bg-vibe-950', 'text-vibe-50');
                        } else if (item.canvasTheme === 'light') {
                            canvas.classList.add('light', 'bg-white', 'text-vibe-950');
                        } else {
                            canvas.classList.add('bg-white', 'dark:bg-vibe-950', 'text-vibe-950', 'dark:text-vibe-50');
                        }
                    }

                    var themeButtons = root ? root.querySelectorAll('[data-vibe-btn-theme]') : [];
                    themeButtons.forEach(function(btn) {
                        var t = btn.getAttribute('data-vibe-btn-theme');
                        btn.classList.remove('bg-white', 'dark:bg-vibe-950', 'text-vibe-950', 'dark:text-vibe-50', 'text-amber-500', 'text-indigo-400', 'shadow-xs');
                        if (t === item.canvasTheme) {
                            btn.classList.add('bg-white', 'dark:bg-vibe-950', 'shadow-xs');
                            if (t === 'light') btn.classList.add('text-amber-500');
                            else if (t === 'dark') btn.classList.add('text-indigo-400');
                            else btn.classList.add('text-vibe-950', 'dark:text-vibe-50');
                            btn.classList.remove('text-vibe-600', 'dark:text-vibe-400');
                        } else {
                            btn.classList.add('text-vibe-600', 'dark:text-vibe-400', 'hover:text-vibe-950', 'dark:hover:text-vibe-50');
                        }
                    });
                }
            }
        } catch (e) {}
    })();
</script>
@endif
