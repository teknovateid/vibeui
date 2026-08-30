@props([
    'title' => null,
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
    $resolvedLang = $lang ?? $language ?? 'blade';
    $minHeightStyle = $minHeight ? (is_numeric($minHeight) ? "min-height: {$minHeight}px;" : "min-height: {$minHeight};") : 'min-height: 180px;';
@endphp

<div
    x-data="{
        tab: 'preview',
        canvasTheme: 'auto',
        viewport: '100%',
        copied: false,
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
    <div class="flex flex-wrap items-center justify-between gap-2 px-3.5 py-2.5 bg-vibe-100/70 dark:bg-vibe-900/60 border-b border-vibe-200 dark:border-vibe-800 text-xs">
        {{-- Left: Title & Tabs --}}
        <div class="flex items-center gap-2.5 min-w-0">
            @if ($title)
                <span class="text-xs font-semibold text-vibe-900 dark:text-vibe-100 truncate mr-1">
                    {{ $title }}
                </span>
            @endif

            {{-- Segmented Tab Buttons --}}
            <div class="inline-flex items-center p-0.5 rounded-lg bg-vibe-200/80 dark:bg-vibe-800/80 border border-vibe-300/40 dark:border-vibe-700/40 select-none">
                <button
                    type="button"
                    @click="tab = 'preview'"
                    :class="tab === 'preview' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs font-semibold' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 font-medium'"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] transition-all cursor-pointer focus:outline-none"
                    aria-label="Tampilkan live preview"
                >
                    <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <span>Preview</span>
                </button>

                <button
                    type="button"
                    @click="tab = 'code'"
                    :class="tab === 'code' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs font-semibold' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 font-medium'"
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] transition-all cursor-pointer focus:outline-none"
                    aria-label="Tampilkan kode sumber"
                >
                    <svg class="size-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="16 18 22 12 16 6"/>
                        <polyline points="8 6 2 12 8 18"/>
                    </svg>
                    <span>Code</span>
                </button>
            </div>
        </div>

        {{-- Right: Toolbar Controls (Viewport Resizer + Dark/Light Mode Switcher + Quick Copy) --}}
        <div class="flex items-center gap-1.5 shrink-0">
            {{-- Viewport Switcher (Only visible in Preview tab) --}}
            @if ($viewports)
                <div x-show="tab === 'preview'" class="hidden sm:inline-flex items-center p-0.5 rounded-lg bg-vibe-200/80 dark:bg-vibe-800/80 border border-vibe-300/40 dark:border-vibe-700/40 select-none">
                    {{-- Desktop 100% --}}
                    <button
                        type="button"
                        @click="viewport = '100%'"
                        :class="viewport === '100%' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50'"
                        class="p-1 rounded-md transition-all cursor-pointer focus:outline-none"
                        title="Desktop (100%)"
                        aria-label="Tampilan desktop 100%"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="3" rx="2"/>
                            <line x1="8" x2="16" y1="21" y2="21"/>
                            <line x1="12" x2="12" y1="17" y2="21"/>
                        </svg>
                    </button>

                    {{-- Tablet 768px --}}
                    <button
                        type="button"
                        @click="viewport = '768px'"
                        :class="viewport === '768px' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50'"
                        class="p-1 rounded-md transition-all cursor-pointer focus:outline-none"
                        title="Tablet (768px)"
                        aria-label="Tampilan tablet 768px"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="16" height="20" x="4" y="2" rx="2" ry="2"/>
                            <line x1="12" x2="12.01" y1="18" y2="18"/>
                        </svg>
                    </button>

                    {{-- Mobile 375px --}}
                    <button
                        type="button"
                        @click="viewport = '375px'"
                        :class="viewport === '375px' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50'"
                        class="p-1 rounded-md transition-all cursor-pointer focus:outline-none"
                        title="Mobile (375px)"
                        aria-label="Tampilan mobile 375px"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2"/>
                            <path d="M12 18h.01"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Isolated Canvas Dark/Light Theme Switcher --}}
            @if ($themeSwitch)
                <div x-show="tab === 'preview'" class="inline-flex items-center p-0.5 rounded-lg bg-vibe-200/80 dark:bg-vibe-800/80 border border-vibe-300/40 dark:border-vibe-700/40 select-none">
                    {{-- Auto / System Mode --}}
                    <button
                        type="button"
                        @click="canvasTheme = 'auto'"
                        :class="canvasTheme === 'auto' ? 'bg-white dark:bg-vibe-950 text-vibe-950 dark:text-vibe-50 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50'"
                        class="p-1 rounded-md transition-all cursor-pointer focus:outline-none"
                        title="Mode Otomatis (Mengikuti tema web)"
                        aria-label="Mode tema otomatis"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="3" rx="2"/>
                            <line x1="8" x2="16" y1="21" y2="21"/>
                            <line x1="12" x2="12" y1="17" y2="21"/>
                        </svg>
                    </button>

                    {{-- Force Light Mode --}}
                    <button
                        type="button"
                        @click="canvasTheme = 'light'"
                        :class="canvasTheme === 'light' ? 'bg-white dark:bg-vibe-950 text-amber-500 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50'"
                        class="p-1 rounded-md transition-all cursor-pointer focus:outline-none"
                        title="Uji Canvas Mode Terang"
                        aria-label="Uji mode terang"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4"/>
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </button>

                    {{-- Force Dark Mode --}}
                    <button
                        type="button"
                        @click="canvasTheme = 'dark'"
                        :class="canvasTheme === 'dark' ? 'bg-white dark:bg-vibe-950 text-indigo-400 shadow-xs' : 'text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50'"
                        class="p-1 rounded-md transition-all cursor-pointer focus:outline-none"
                        title="Uji Canvas Mode Gelap"
                        aria-label="Uji mode gelap"
                    >
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Quick Copy Button --}}
            <button
                type="button"
                @click="copyAllCode()"
                class="inline-flex items-center justify-center size-7 rounded-lg text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 hover:bg-vibe-200 dark:hover:bg-vibe-800 transition-colors cursor-pointer focus:outline-none"
                title="Salin kode ke clipboard"
                aria-label="Salin kode"
            >
                <svg x-show="!copied" class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                </svg>
                <svg x-show="copied" x-cloak class="size-3.5 text-emerald-600 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Interactive Live Preview Canvas Area --}}
    <div
        x-show="tab === 'preview'"
        class="relative w-full overflow-hidden transition-all duration-300"
        :class="{
            'dark bg-vibe-950 text-vibe-50': canvasTheme === 'dark',
            'bg-white text-vibe-950': canvasTheme === 'light',
            'bg-vibe-100/30 dark:bg-vibe-900/20 text-vibe-950 dark:text-vibe-50': canvasTheme === 'auto'
        }"
    >
        {{-- Background Pattern Decoration --}}
        @if ($pattern === 'dots')
            <div class="pointer-events-none absolute inset-0 opacity-[0.25] dark:opacity-[0.15] bg-[radial-gradient(#737373_1px,transparent_1px)] [background-size:16px_16px]"></div>
        @elseif ($pattern === 'grid')
            <div class="pointer-events-none absolute inset-0 opacity-[0.2] dark:opacity-[0.12] bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]"></div>
        @endif

        {{-- Resizable Inner Wrapper --}}
        <div
            class="relative transition-all duration-300 mx-auto w-full @if($center) flex items-center justify-center p-6 sm:p-10 @else p-6 sm:p-8 @endif"
            :style="{ maxWidth: viewport, {{ $minHeightStyle }} }"
        >
            {{ $slot }}
        </div>
    </div>

    {{-- Code Viewer Area --}}
    <div x-show="tab === 'code'" x-cloak style="display: none;">
        @if ($code)
            <vibe:preview.code :code="$code" :language="$resolvedLang" />
        @else
            {{ $codeSlot ?? '' }}
        @endif
    </div>
</div>
