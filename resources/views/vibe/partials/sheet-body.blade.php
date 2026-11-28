@blaze

@props([
    'id',
    'layout',
    'behavior',
    'position',
    'persist' => false,
    'defaultSize' => 350,
    'defaultState' => 'collapsed',
    'minSize' => 0,
    'maxSize' => 600,
    'minifiedSize' => 80,
    'mobileSize' => '280',
    'innerStyle' => '',
    'dismissibleButton' => false,
    'showToggle' => false,
    'resizable' => false,
])

@php
    $isHorizontal = in_array($position, ['left', 'right'], true);
@endphp

@if ($persist)
    <script>
        (function() {
            try {
                let key = '{{ config('vibe.prefix', 'vibe') }}-sheet';
                let stored = localStorage.getItem(key);
                if (stored) {
                    let data = JSON.parse(stored);
                    let id = '{{ $id }}';
                    let item = Array.isArray(data) ? data.find(i => i.id === id) : (data[id] ? data[id] : null);
                    if (item) {
                        let el = document.getElementById(id);
                        if (el) {
                            let size = item.size !== undefined ? item.size : {{ $defaultSize }};
                            let state = item.status !== undefined ? item.status : '{{ $defaultState }}';
                            let minSize = {{ $minSize }};
                            let maxSize = {{ $maxSize }};
                            let mobileSize = '{{ $mobileSize }}';
                            let isMobile = window.innerWidth < 768;
                            let isHorizontal = '{{ $position }}' === 'left' || '{{ $position }}' === 'right';

                            if (isMobile && '{{ $behavior }}' === 'minify' && state === 'minified') {
                                state = 'collapsed';
                            }

                            if (size > maxSize) size = maxSize;
                            if (state === 'expanded' && size < minSize) size = minSize;

                            let currentSize = size;
                            if (isMobile) {
                                if (mobileSize === 'full') {
                                    currentSize = '100%';
                                } else {
                                    let numericMobileSize = parseInt(mobileSize, 10) || 280;
                                    let maxMobile = isHorizontal
                                        ? Math.min(numericMobileSize, window.innerWidth - 48)
                                        : Math.min(numericMobileSize, window.innerHeight - 48);
                                    currentSize = Math.max(0, maxMobile);
                                }
                            }
                            if ('{{ $behavior }}' !== 'static') {
                                if (state === 'collapsed') currentSize = 0;
                                else if (state === 'minified') currentSize = isMobile ? 0 : {{ $minifiedSize }};
                            }
                            let sizeStyle = typeof currentSize === 'string' ? currentSize : currentSize + 'px';
                            el.style[isHorizontal ? 'width' : 'height'] = sizeStyle;
                            if (currentSize === 0) el.style.borderWidth = '0px';
                            el.setAttribute('data-state', state);
                            el.classList.add('group/sheet');
                        }
                    }
                }
            } catch (e) {}
        })();
    </script>
@endif

@if ($layout === 'relative')
    <div data-sheet-content :style="isExpanding ? 'overflow: hidden' : null" class="flex-1 flex flex-col w-full h-full min-w-0 max-h-full min-h-0 overflow-visible group-data-[state=collapsed]/sheet:overflow-hidden">
        <div class="flex-1 flex flex-col h-full min-h-0 w-full overflow-visible group-data-[state=collapsed]/sheet:overflow-hidden transition-opacity duration-300 ease-in-out [&>form]:flex [&>form]:flex-col [&>form]:flex-1 [&>form]:h-full [&>form]:min-h-0"
             :class="state === 'collapsed' ? 'opacity-0 pointer-events-none' : 'opacity-100'"
             style="{{ $innerStyle }}"
             :style="behavior !== 'minify'
                 ? (isHorizontal
                     ? (isMobile ? 'width: 100%' : `width: ${size}px`)
                     : (isMobile ? 'height: 100%' : `height: ${size}px`))
                 : ''">
            {{ $slot }}
        </div>
    </div>
@else
    <div data-sheet-content :style="isExpanding ? 'overflow: hidden' : null" class="absolute inset-0 pointer-events-none flex flex-col overflow-visible group-data-[state=collapsed]/sheet:overflow-hidden">
        <div class="absolute flex flex-col pointer-events-auto h-full w-full overflow-visible group-data-[state=collapsed]/sheet:overflow-hidden transition-opacity duration-300 ease-in-out [&>form]:flex [&>form]:flex-col [&>form]:flex-1 [&>form]:h-full [&>form]:min-h-0"
             :class="state === 'collapsed' ? 'opacity-0 pointer-events-none' : 'opacity-100'"
             style="{{ $innerStyle }}"
             :style="behavior !== 'minify'
                 ? (position === 'right'
                     ? (isMobile ? 'top: 0; right: 0; bottom: 0; width: 100%' : `top: 0; right: 0; bottom: 0; width: ${size}px`)
                     : position === 'bottom'
                     ? (isMobile ? 'left: 0; right: 0; top: 0; height: 100%' : `left: 0; right: 0; top: 0; height: ${size}px`)
                     : position === 'top'
                     ? (isMobile ? 'left: 0; right: 0; bottom: 0; height: 100%' : `left: 0; right: 0; bottom: 0; height: ${size}px`)
                     : (isMobile ? 'top: 0; left: 0; bottom: 0; width: 100%' : `top: 0; left: 0; bottom: 0; width: ${size}px`))
                 : 'top: 0; left: 0; right: 0; bottom: 0'">
            {{ $slot }}
        </div>
    </div>
@endif

@if ($dismissibleButton)
    <div class="absolute top-3 right-3 z-30 pointer-events-auto transition-opacity duration-200 group-data-[state=collapsed]/sheet:hidden group-data-[state=collapsed]/sheet:opacity-0 group-data-[state=minified]/sheet:hidden">
        <vibe:sheet.close />
    </div>
@endif

@if ($showToggle && $behavior !== 'static')
    @php
        $togglePositionClasses = match ($position) {
            'left' => '-right-3 top-4',
            'right' => '-left-3 top-4',
            'top' => '-bottom-3 left-1/2 -translate-x-1/2',
            'bottom' => '-top-3 left-1/2 -translate-x-1/2',
            default => '-right-3 top-4',
        };
    @endphp
    <vibe:button @click="toggle()" aria-label="{{ __('vibe/sheet.toggle') }}" class="absolute rounded-full w-6 h-6 flex items-center justify-center text-muted-foreground hover:text-foreground shadow-sm z-30 transition-colors {{ $togglePositionClasses }}" x-bind:class="{
        '-right-3 top-4': position === 'left',
        '-left-3 top-4': position === 'right',
        '-bottom-3 left-1/2 -translate-x-1/2': position === 'top',
        '-top-3 left-1/2 -translate-x-1/2': position === 'bottom'
    }">
        <svg class="w-4 h-4" :class="{
            'transition-transform duration-300': isInitialized,
            'rotate-180': (position === 'left' && state !== 'expanded') || (position === 'right' && state === 'expanded'),
            'rotate-90': (position === 'top' && state === 'expanded') || (position === 'bottom' && state !== 'expanded'),
            '-rotate-90': (position === 'bottom' && state === 'expanded') || (position === 'top' && state !== 'expanded')
        }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 19l-7-7 7-7" />
        </svg>
    </vibe:button>
@endif

@if ($resizable)
    <div
        @mousedown.prevent="startResize($event)"
        @touchstart.prevent="startResize($event)"
        class="hidden md:flex absolute z-20 items-center justify-center group/resizer touch-none select-none"
        :class="{
            'top-0 bottom-0 -right-2.5 w-5 cursor-col-resize': position === 'left',
            'top-0 bottom-0 -left-2.5 w-5 cursor-col-resize': position === 'right',
            'left-0 right-0 -bottom-2.5 h-5 cursor-row-resize': position === 'top',
            'left-0 right-0 -top-2.5 h-5 cursor-row-resize': position === 'bottom'
        }"
    >
        <div
            class="transition-all duration-200 rounded-full group-hover/resizer:opacity-100"
            :class="[
                isResizing ? 'opacity-100' : 'opacity-0',
                isHorizontal
                    ? 'h-full w-0.5 group-hover/resizer:bg-muted-foreground/60 ' + (isResizing ? 'bg-primary' : '')
                    : 'w-full h-0.5 group-hover/resizer:bg-muted-foreground/60 ' + (isResizing ? 'bg-primary' : '')
            ]"
        ></div>
    </div>
@endif
