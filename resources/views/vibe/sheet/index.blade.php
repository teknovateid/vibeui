@blaze(fold: true)

@props([
    'variant' => 'default',
    'layout' => 'relative', // relative, fixed, sticky, absolute
    'id' => uniqid('sheet-'),
    'position' => 'left', // left, right, top, bottom
    'behavior' => 'static', // static, collapsible, minify
    'resizable' => false,
    'defaultSize' => 350,
    'minSize' => 0,
    'maxSize' => 600,
    'minifiedSize' => 80,
    'showToggle' => false,
    'persist' => false, // save to localstorage
    'defaultState' => 'expanded',
    'closeOnOutsideClick' => false,
])

@php
    $positionClasses = match ($position) {
        'left' => 'border-r',
        'right' => 'border-l',
        'top' => 'border-b',
        'bottom' => 'border-t',
        default => 'border-r',
    };

    $variantClasses = match ($variant) {
        'accent' => 'bg-accent text-accent-foreground border-border',
        'muted' => 'bg-muted text-muted-foreground border-border',
        default => 'bg-card text-card-foreground border-border',
    };

    $layoutClasses = match ($layout) {
        'fixed' => match ($position) {
            'left' => 'fixed left-0 top-0 bottom-0 h-screen',
            'right' => 'fixed right-0 top-0 bottom-0 h-screen',
            'top' => 'fixed top-0 left-0 right-0 w-full',
            'bottom' => 'fixed bottom-0 left-0 right-0 w-full',
            default => 'fixed left-0 top-0 bottom-0 h-screen',
        },
        'absolute' => match ($position) {
            'left' => 'absolute left-0 top-0 bottom-0 h-full',
            'right' => 'absolute right-0 top-0 bottom-0 h-full',
            'top' => 'absolute top-0 left-0 right-0 w-full',
            'bottom' => 'absolute bottom-0 left-0 right-0 w-full',
            default => 'absolute left-0 top-0 bottom-0 h-full',
        },
        'sticky' => match ($position) {
            'left', 'right' => 'sticky top-0 h-screen',
            'top', 'bottom' => 'sticky left-0 w-full',
            default => 'sticky top-0 h-screen',
        },
        default => match ($position) {
            'right' => 'relative order-last h-full self-stretch',
            'bottom' => 'relative order-last w-full',
            'top' => 'relative w-full',
            default => 'relative h-full self-stretch',
        },
    };

    $initialSize = $defaultSize;
    if ($behavior !== 'static') {
        if ($defaultState === 'collapsed') {
            $initialSize = 0;
        } elseif ($defaultState === 'minified') {
            $initialSize = $minifiedSize;
        }
    }

    $overflowClasses = 'overflow-visible data-[state=collapsed]:overflow-hidden';

    $innerStyle = $behavior !== 'minify'
        ? match ($position) {
            'right' => "top: 0; right: 0; bottom: 0; width: {$defaultSize}px",
            'bottom' => "left: 0; right: 0; bottom: 0; height: {$defaultSize}px",
            'top' => "left: 0; right: 0; top: 0; height: {$defaultSize}px",
            default => "top: 0; left: 0; bottom: 0; width: {$defaultSize}px",
        }
        : 'top: 0; left: 0; right: 0; bottom: 0';
@endphp

<div id="{{ $id }}" x-data="{
    id: '{{ $id }}',
    behavior: '{{ $behavior }}',
    position: '{{ $position }}',
    isResizing: false,
    isInitialized: false,
    lastTriggerTime: 0,
    startSize: 0,
    startPos: 0,
    minifiedSize: {{ $minifiedSize }},
    minSize: {{ $minSize }},
    maxSize: {{ $maxSize }},

    size: {{ $defaultSize }},
    state: '{{ $defaultState }}',
    isMobile: window.innerWidth < 768,

    get isHorizontal() {
        return this.position === 'left' || this.position === 'right';
    },

    init() {
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 768;
            if (this.isMobile && this.behavior === 'minify' && this.state === 'minified') {
                this.state = 'collapsed';
            }
        });

        @if ($persist) let key = '{{ config('vibe.prefix', 'vibe') }}-sheet';
                let stored = localStorage.getItem(key);
                if (stored) {
                    try {
                        let data = JSON.parse(stored);
                        if (Array.isArray(data)) {
                            let item = data.find(i => i.id === this.id);
                            if (item) {
                                this.size = item.size ?? this.size;
                                this.state = item.status ?? this.state;
                            }
                        } else if (data[this.id]) {
                            this.size = data[this.id].size ?? this.size;
                            this.state = data[this.id].status ?? this.state;
                        }
                    } catch (e) {}
                } @endif

        if (this.isMobile && this.behavior === 'minify' && this.state === 'minified') {
            this.state = 'collapsed';
        }

        this.$nextTick(() => {
            setTimeout(() => {
                this.isInitialized = true;
            }, 50);
        });

        this.$watch('state', value => {
            if (value === 'expanded' || value === 'minified') {
                setTimeout(() => {
                    let input = this.$el.querySelector('input:not([type=hidden]):not([disabled]), textarea:not([disabled]), select:not([disabled])');
                    if (input) input.focus();
                }, 100);
            }
        });
    },

    saveToStorage() {
        @if($persist)
        let key = '{{ config('vibe.prefix', 'vibe') }}-sheet';
        let stored = localStorage.getItem(key);
        let data = [];
        if (stored) {
            try {
                let parsed = JSON.parse(stored);
                if (Array.isArray(parsed)) {
                    data = parsed;
                }
            } catch (e) {}
        }

        let index = data.findIndex(i => i.id === this.id);
        let newItem = {
            id: this.id,
            size: this.size,
            status: this.state
        };

        if (index !== -1) {
            data[index] = newItem;
        } else {
            data.push(newItem);
        }

        localStorage.setItem(key, JSON.stringify(data));
        @endif
    },

    get currentSize() {
        if (this.isResizing) return this.size;
        if (this.behavior === 'static') return this.size;
        if (this.state === 'collapsed') return 0;
        if (this.state === 'minified') return this.isMobile ? 0 : this.minifiedSize;
        return this.size;
    },

    startResize(e) {
        if (this.behavior === 'static' && !{{ $resizable ? 'true' : 'false' }}) return;
        this.isResizing = true;

        this.startSize = this.currentSize;

        let clientX = (e.touches && e.touches.length > 0) ? e.touches[0].clientX : (e.clientX !== undefined ? e.clientX : 0);
        let clientY = (e.touches && e.touches.length > 0) ? e.touches[0].clientY : (e.clientY !== undefined ? e.clientY : 0);

        if (this.isHorizontal) {
            this.startPos = clientX;
            document.body.style.cursor = 'col-resize';
        } else {
            this.startPos = clientY;
            document.body.style.cursor = 'row-resize';
        }

        document.body.style.userSelect = 'none';
    },

    doResize(e) {
        if (!this.isResizing) return;

        let clientX = (e.touches && e.touches.length > 0) ? e.touches[0].clientX : (e.clientX !== undefined ? e.clientX : 0);
        let clientY = (e.touches && e.touches.length > 0) ? e.touches[0].clientY : (e.clientY !== undefined ? e.clientY : 0);

        let delta = 0;
        if (this.position === 'left') delta = clientX - this.startPos;
        else if (this.position === 'right') delta = this.startPos - clientX;
        else if (this.position === 'top') delta = clientY - this.startPos;
        else if (this.position === 'bottom') delta = this.startPos - clientY;

        let newSize = this.startSize + delta;

        let dynamicMaxSize = this.maxSize;
        if (this.isHorizontal) {
            if (window.innerWidth - 16 < dynamicMaxSize) dynamicMaxSize = Math.max(0, window.innerWidth - 16);
        } else {
            if (window.innerHeight - 16 < dynamicMaxSize) dynamicMaxSize = Math.max(0, window.innerHeight - 16);
        }

        let effectiveMinSize = Math.min(this.minSize, dynamicMaxSize);

        if (newSize > dynamicMaxSize) newSize = dynamicMaxSize;

        if (this.behavior === 'static') {
            if (newSize < effectiveMinSize) newSize = effectiveMinSize;
        } else if (this.behavior === 'collapsible') {
            if (effectiveMinSize > 0) {
                if (newSize < effectiveMinSize) newSize = effectiveMinSize;
            } else {
                if (newSize < 0) newSize = 0;
            }
        } else if (this.behavior === 'minify') {
            if (this.isMobile) {
                if (newSize < 0) newSize = 0;
            } else {
                if (effectiveMinSize > 0 && newSize < effectiveMinSize && newSize > this.minifiedSize + 20) {
                    newSize = effectiveMinSize;
                }
                if (newSize < 0) newSize = 0;
            }
        } else {
            if (newSize < 0) newSize = 0;
        }

        this.size = newSize;

        if (this.behavior === 'minify') {
            if (this.isMobile) {
                if (this.size < (effectiveMinSize > 0 ? effectiveMinSize / 2 : 80)) {
                    this.state = 'collapsed';
                } else {
                    this.state = 'expanded';
                }
            } else {
                if (this.size < this.minifiedSize / 2) {
                    this.state = 'collapsed';
                } else if (this.size <= this.minifiedSize + 20) { // Snap zone +20px
                    this.state = 'minified';
                } else {
                    this.state = 'expanded';
                }
            }
        } else {
            if (this.size === 0) {
                this.state = 'collapsed';
            } else {
                this.state = 'expanded';
            }
        }
    },

    stopResize() {
        if (this.isResizing) {
            this.isResizing = false;

            document.body.style.cursor = '';
            document.body.style.userSelect = '';

            this.saveToStorage();
        }
    },

    toggle() {
        this.lastTriggerTime = Date.now();
        if (this.behavior === 'static') return;

        if (this.behavior === 'collapsible' || (this.behavior === 'minify' && this.isMobile)) {
            this.state = this.state === 'expanded' ? 'collapsed' : 'expanded';
        } else if (this.behavior === 'minify') {
            this.state = this.state === 'expanded' ? 'minified' : 'expanded';
        }

        if (this.state === 'expanded' && this.size < this.minifiedSize + 50) {
            this.size = {{ $defaultSize }};
        }

        this.saveToStorage();
    },

    close() {
        if (this.behavior === 'static') return;
        this.state = 'collapsed';
        this.saveToStorage();
    },

    open() {
        this.lastTriggerTime = Date.now();
        if (this.behavior === 'static') return;
        this.state = 'expanded';
        this.saveToStorage();
    }
}" @mouseup.window="stopResize()" @touchend.window="stopResize()" @touchcancel.window="stopResize()" @mousemove.window="doResize($event)" @touchmove.window="doResize($event)" @open-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}') { lastTriggerTime = Date.now(); state = 'expanded'; saveToStorage(); }" @close-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}' || t === '*' || !t) { state = 'collapsed'; saveToStorage(); }" @toggle-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === '{{ $id }}') { lastTriggerTime = Date.now(); toggle(); }" @click.outside="if ({{ $closeOnOutsideClick ? 'true' : 'false' }} && state !== 'collapsed' && Date.now() - lastTriggerTime > 150) { state = 'collapsed'; saveToStorage(); }" style="{{ ($position === 'left' || $position === 'right' ? "width: {$initialSize}px" : "height: {$initialSize}px") . ($initialSize === 0 ? '; border-width: 0px' : '') }}" :style="[
    isHorizontal ? `width: ${currentSize}px` : `height: ${currentSize}px`,
    currentSize === 0 ? 'border-width: 0' : ''
].filter(Boolean).join('; ')" data-state="{{ $defaultState }}" :data-state="state" data-dismissible="{{ $closeOnOutsideClick ? 'true' : 'false' }}" :class="{
    'transition-[width,height,transform] duration-300 ease-in-out': !isResizing && isInitialized
}" {{ $attributes->twMerge(['class' => "$variantClasses flex flex-col shrink-0 z-60 $positionClasses $layoutClasses group/sheet max-w-full max-h-full overflow-visible"]) }}>
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
                                let isMobile = window.innerWidth < 768;

                                if (isMobile && '{{ $behavior }}' === 'minify' && state === 'minified') {
                                    state = 'collapsed';
                                }

                                if (size > maxSize) size = maxSize;
                                if (state === 'expanded' && size < minSize) size = minSize;

                                let currentSize = size;
                                if ('{{ $behavior }}' !== 'static') {
                                    if (state === 'collapsed') currentSize = 0;
                                    else if (state === 'minified') currentSize = isMobile ? 0 : {{ $minifiedSize }};
                                }
                                let isHorizontal = '{{ $position }}' === 'left' || '{{ $position }}' === 'right';
                                el.style[isHorizontal ? 'width' : 'height'] = currentSize + 'px';
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
        {{-- Relative layout: normal flex flow, contained so nothing bleeds when size is 0.
             group-data-[state=collapsed]/sheet:overflow-hidden bereaksi ke data-state attribute
             yang di-set oleh PHP & anti-FOUC script — zero flash tanpa perlu Alpine aktif. --}}
        <div data-sheet-content class="flex-1 flex flex-col w-full h-full min-w-0 max-h-full min-h-0 group-data-[state=collapsed]/sheet:overflow-hidden"
             :class="{ 'overflow-visible': state !== 'collapsed' }">
            <div class="flex-1 flex flex-col h-full min-h-0 w-full group-data-[state=collapsed]/sheet:overflow-hidden"
                 :class="{ 'overflow-visible': state !== 'collapsed' }"
                 style="{{ $innerStyle }}"
                 :style="behavior !== 'minify'
                     ? (isHorizontal ? `width: ${size}px` : `height: ${size}px`)
                     : ''">
                {{ $slot }}
            </div>
        </div>
    @else
        {{-- Fixed/absolute/sticky layout: clip-wrapper untuk content, tidak mempengaruhi resize handle. --}}
        <div data-sheet-content class="absolute inset-0 pointer-events-none flex flex-col group-data-[state=collapsed]/sheet:overflow-hidden"
             :class="{ 'overflow-visible': state !== 'collapsed' }">
            <div class="absolute flex flex-col pointer-events-auto h-full w-full group-data-[state=collapsed]/sheet:overflow-hidden"
                 :class="{ 'overflow-visible': state !== 'collapsed' }"
                 style="{{ $innerStyle }}"
                 :style="behavior !== 'minify'
                     ? (position === 'right'
                         ? `top: 0; right: 0; bottom: 0; width: ${size}px`
                         : position === 'bottom'
                         ? `left: 0; right: 0; bottom: 0; height: ${size}px`
                         : position === 'top'
                         ? `left: 0; right: 0; top: 0; height: ${size}px`
                         : `top: 0; left: 0; bottom: 0; width: ${size}px`)
                     : 'top: 0; left: 0; right: 0; bottom: 0'">
                {{ $slot }}
            </div>
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
        <vibe:button @click="toggle()" aria-label="{{ __('vibe/sheet.toggle') }}" class="absolute rounded-full w-6 h-6 flex items-center justify-center text-muted-foreground hover:text-foreground shadow-sm z-60 transition-colors {{ $togglePositionClasses }}" x-bind:class="{
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
            }" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
            </svg>
        </vibe:button>
    @endif

    <!-- Resize Handle -->
    @if ($resizable)
        <div
            @mousedown.prevent="startResize($event)"
            @touchstart.prevent="startResize($event)"
            class="absolute z-20 flex items-center justify-center group/resizer touch-none select-none"
            :class="{
                'top-0 bottom-0 -right-2.5 w-5 cursor-col-resize': position === 'left',
                'top-0 bottom-0 -left-2.5 w-5 cursor-col-resize': position === 'right',
                'left-0 right-0 -bottom-2.5 h-5 cursor-row-resize': position === 'top',
                'left-0 right-0 -top-2.5 h-5 cursor-row-resize': position === 'bottom'
            }"
        >
            {{-- Garis visual: transparan by default, muncul saat hover atau sedang di-resize --}}
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
</div>
