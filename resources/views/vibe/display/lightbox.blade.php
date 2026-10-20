@blaze

<div
    x-data="{
        get store() {
            return (window.Alpine && window.Alpine.store) ? window.Alpine.store('vibeImageLightbox') : window.VibeImageLightbox;
        }
    }"
    x-show="store && store.isOpen"
    x-cloak
    x-transition:enter="transition ease-out duration-250"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-9999 flex flex-col justify-between bg-black/95 backdrop-blur-md select-none touch-none text-white overflow-hidden"
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('vibe/image.lightbox_title') }}"
>
    {{-- Top Bar (Header Controls) --}}
    <div class="relative z-30 flex items-center justify-between px-4 py-3 sm:px-6 bg-linear-to-b from-black/80 via-black/40 to-transparent">
        {{-- Left: Image Counter (X / Y) --}}
        <div class="flex items-center gap-2">
            <template x-if="store && !store.isStandalone && store.total > 0">
                <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-medium text-neutral-200 shadow-sm tracking-wide">
                    <svg class="size-3.5 opacity-70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2"/>
                        <path d="m3 9 18 0"/>
                    </svg>
                    <span x-text="(store.currentIndex + 1) + ' / ' + store.total"></span>
                </div>
            </template>
        </div>

        {{-- Right: Actions (Zoom, Download, Close) --}}
        <div class="flex items-center gap-1.5 sm:gap-2">
            {{-- Zoom Out Button --}}
            <button
                type="button"
                @click="store && store.zoomOut()"
                :disabled="!store || store.zoom <= 1"
                class="size-8 sm:size-9 rounded-full bg-white/10 hover:bg-white/20 disabled:opacity-30 disabled:pointer-events-none text-neutral-200 hover:text-white transition-all flex items-center justify-center cursor-pointer focus:outline-none"
                title="{{ __('vibe/image.zoom_out') }}"
                aria-label="{{ __('vibe/image.zoom_out_aria') }}"
            >
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" x2="16.65" y1="21" y2="16.65"/>
                    <line x1="8" x2="14" y1="11" y2="11"/>
                </svg>
            </button>

            {{-- Zoom Level Indicator / Reset Button --}}
            <button
                type="button"
                @click="store && store.resetZoom()"
                class="px-2.5 py-1 rounded-full bg-white/10 hover:bg-white/20 text-[11px] sm:text-xs font-mono font-medium text-neutral-200 hover:text-white transition-all cursor-pointer focus:outline-none min-w-12 text-center"
                title="{{ __('vibe/image.reset_zoom') }}"
                aria-label="{{ __('vibe/image.reset_zoom_aria') }}"
            >
                <span x-text="store ? Math.round(store.zoom * 100) + '%' : '100%'">100%</span>
            </button>

            {{-- Zoom In Button --}}
            <button
                type="button"
                @click="store && store.zoomIn()"
                :disabled="!store || store.zoom >= 3"
                class="size-8 sm:size-9 rounded-full bg-white/10 hover:bg-white/20 disabled:opacity-30 disabled:pointer-events-none text-neutral-200 hover:text-white transition-all flex items-center justify-center cursor-pointer focus:outline-none"
                title="{{ __('vibe/image.zoom_in') }}"
                aria-label="{{ __('vibe/image.zoom_in_aria') }}"
            >
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" x2="16.65" y1="21" y2="16.65"/>
                    <line x1="11" x2="11" y1="8" y2="14"/>
                    <line x1="8" x2="14" y1="11" y2="11"/>
                </svg>
            </button>

            <div class="h-4 w-px bg-white/20 mx-1"></div>

            {{-- Download Button --}}
            <button
                type="button"
                @click="store && store.download()"
                class="size-8 sm:size-9 rounded-full bg-white/10 hover:bg-white/20 text-neutral-200 hover:text-white transition-all flex items-center justify-center cursor-pointer focus:outline-none"
                title="{{ __('vibe/image.download') }}"
                aria-label="{{ __('vibe/image.download_aria') }}"
            >
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" x2="12" y1="15" y2="3"/>
                </svg>
            </button>

            {{-- Close Button --}}
            <button
                type="button"
                @click="store && store.close()"
                class="size-8 sm:size-9 rounded-full bg-white/10 hover:bg-white/25 text-neutral-200 hover:text-white transition-all flex items-center justify-center cursor-pointer focus:outline-none ml-1 group"
                title="{{ __('vibe/image.close') }}"
                aria-label="{{ __('vibe/image.close_aria') }}"
            >
                <svg class="size-4 group-hover:rotate-90 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Main Image Stage Canvas --}}
    <div
        class="relative flex-1 min-h-0 w-full flex items-center justify-center p-4 sm:p-8 overflow-hidden"
        @click.self="store && store.close()"
        @touchstart="store && store.handleTouchStart($event)"
        @touchend="store && store.handleTouchEnd($event)"
    >
        {{-- Floating Navigation: Previous Button (Left) --}}
        <template x-if="store && store.hasPrev">
            <button
                type="button"
                @click.stop="store.prev()"
                class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20 size-11 sm:size-12 rounded-full bg-black/40 hover:bg-black/70 active:scale-95 text-white/80 hover:text-white backdrop-blur-md border border-white/15 flex items-center justify-center transition-all cursor-pointer shadow-lg focus:outline-none"
                title="{{ __('vibe/image.prev') }}"
                aria-label="{{ __('vibe/image.prev_aria') }}"
            >
                <svg class="size-6 -ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>
        </template>

        {{-- Centered Displayed Image --}}
        <div class="relative max-w-full max-h-full flex items-center justify-center pointer-events-auto">
            <template x-if="store && store.currentItem">
                <img
                    :src="store.currentItem.src"
                    :alt="store.currentItem.alt || ''"
                    class="max-w-full max-h-[78vh] object-contain transition-transform duration-150 ease-out rounded-lg shadow-2xl select-none"
                    :class="store.zoom > 1 ? (store.isDragging ? 'cursor-grabbing' : 'cursor-grab') : 'cursor-zoom-in'"
                    :style="'transform: translate(' + store.panX + 'px, ' + store.panY + 'px) scale(' + store.zoom + ');'"
                    @dblclick="store.toggleZoom()"
                    @mousedown="store.handleMouseDown($event)"
                    draggable="false"
                />
            </template>
        </div>

        {{-- Floating Navigation: Next Button (Right) --}}
        <template x-if="store && store.hasNext">
            <button
                type="button"
                @click.stop="store.next()"
                class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20 size-11 sm:size-12 rounded-full bg-black/40 hover:bg-black/70 active:scale-95 text-white/80 hover:text-white backdrop-blur-md border border-white/15 flex items-center justify-center transition-all cursor-pointer shadow-lg focus:outline-none"
                title="{{ __('vibe/image.next') }}"
                aria-label="{{ __('vibe/image.next_aria') }}"
            >
                <svg class="size-6 -mr-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </template>
    </div>

    {{-- Bottom Bar (Caption & Details) --}}
    <div
        x-show="store && store.currentItem && (store.currentItem.caption || store.currentItem.alt)"
        class="relative z-30 px-6 py-4 bg-linear-to-t from-black/85 via-black/50 to-transparent text-center"
    >
        <p
            x-text="store && store.currentItem ? (store.currentItem.caption || store.currentItem.alt) : ''"
            class="text-xs sm:text-sm text-neutral-300 font-normal max-w-2xl mx-auto line-clamp-2 leading-relaxed"
        ></p>
    </div>
</div>
