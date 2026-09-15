@blaze

@props([
    'value' => '',
    'size' => 180,
    'level' => 'M', // L, M, Q, H
    'color' => '#000000',
    'background' => '#ffffff',
    'margin' => 2,
    'downloadable' => false,
    'copyable' => false,
    'label' => null,
    'id' => null,
])

@php
    $id = $id ?? uniqid('vibe-qr-');
    $numericSize = (int) $size;
@endphp

@pushOnce('head', 'vibe-qrcode-script')
    @vite(['resources/js/vibe/qrcode.js'])
@endPushOnce

<div 
    id="{{ $id }}"
    {{ $attributes->twMerge(['class' => 'inline-flex flex-col items-center justify-center p-3 rounded-2xl bg-white text-neutral-900 border border-neutral-200/80 shadow-xs transition-all select-none']) }}
    x-data="{
        value: @js((string) $value),
        size: {{ $numericSize }},
        level: '{{ $level }}',
        color: '{{ $color }}',
        background: '{{ $background }}',
        margin: {{ (int) $margin }},
        svgHtml: '',
        copied: false,

        init() {
            this.render();
            this.$watch('value', () => this.render());
        },

        render() {
            if (!this.value) {
                this.svgHtml = '';
                return;
            }
            if (window.VibeQrCode) {
                this.svgHtml = window.VibeQrCode.renderSvg(this.value, {
                    size: this.size,
                    level: this.level,
                    color: this.color,
                    background: this.background,
                    margin: this.margin
                });
            } else {
                let timer = setInterval(() => {
                    if (window.VibeQrCode) {
                        clearInterval(timer);
                        this.render();
                    }
                }, 50);
                setTimeout(() => clearInterval(timer), 3000);
            }
        },

        downloadSvg() {
            if (!this.svgHtml || !window.VibeQrCode) return;
            window.VibeQrCode.downloadSvg(this.svgHtml, 'qrcode.svg');
        },

        downloadPng() {
            if (!this.svgHtml || !window.VibeQrCode) return;
            window.VibeQrCode.downloadPng(this.svgHtml, Math.max(300, this.size * 2), 'qrcode.png');
        },

        copyPayload() {
            if (!this.value) return;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(this.value).then(() => {
                    this.copied = true;
                    setTimeout(() => { this.copied = false; }, 2000);
                });
            }
        }
    }"
>
    {{-- QR Code Matrix SVG Box --}}
    <div 
        class="flex items-center justify-center overflow-hidden rounded-xl bg-white"
        style="width: {{ $numericSize }}px; height: {{ $numericSize }}px;"
        x-html="svgHtml"
    >
        {{-- Fallback placeholder while JS loads --}}
        <div class="flex items-center justify-center size-full text-muted-foreground animate-pulse">
            <svg class="size-8 opacity-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect width="18" height="18" x="3" y="3" rx="2"/>
                <path d="M7 7h.01M17 7h.01M7 17h.01M17 17h.01"/>
            </svg>
        </div>
    </div>

    {{-- Optional Label Caption --}}
    @if ($label)
        <p class="mt-2.5 text-xs font-medium text-neutral-600 text-center max-w-[{{ $numericSize + 20 }}px] leading-tight">
            {{ $label }}
        </p>
    @endif

    {{-- Optional Action Buttons (Download / Copy) --}}
    @if ($downloadable || $copyable)
        <div class="mt-3 pt-2.5 border-t border-neutral-100 flex items-center justify-center gap-1.5 w-full">
            @if ($downloadable)
                <button 
                    type="button" 
                    @click="downloadPng()" 
                    class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[11px] font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 transition-colors focus:outline-none cursor-pointer"
                    title="Unduh format PNG"
                    aria-label="Unduh QR Code format PNG"
                >
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" x2="12" y1="15" y2="3"/>
                    </svg>
                    <span>PNG</span>
                </button>

                <button 
                    type="button" 
                    @click="downloadSvg()" 
                    class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[11px] font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 transition-colors focus:outline-none cursor-pointer"
                    title="Unduh format SVG vector"
                    aria-label="Unduh QR Code format SVG"
                >
                    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" x2="12" y1="15" y2="3"/>
                    </svg>
                    <span>SVG</span>
                </button>
            @endif

            @if ($copyable)
                <button 
                    type="button" 
                    @click="copyPayload()" 
                    class="inline-flex items-center gap-1 px-2 py-1 rounded-md text-[11px] font-medium text-neutral-600 hover:text-neutral-900 hover:bg-neutral-100 transition-colors focus:outline-none cursor-pointer"
                    title="Salin isi data QR"
                    aria-label="Salin data QR"
                >
                    <template x-if="!copied">
                        <span class="inline-flex items-center gap-1">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                            </svg>
                            <span>Salin</span>
                        </span>
                    </template>
                    <template x-if="copied">
                        <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            <span>Tersalin!</span>
                        </span>
                    </template>
                </button>
            @endif
        </div>
    @endif
</div>
