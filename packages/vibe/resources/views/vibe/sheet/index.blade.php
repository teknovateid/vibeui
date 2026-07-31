@blaze(fold: true)

@props([
    'variant' => 'default',
    'layout' => 'relative', // relative, fixed, sticky, absolute
    'id' => uniqid('sheet-'),
    'position' => 'left', // left, right, top, bottom
    'behavior' => 'static', // static, collapsible, minify
    'resizable' => false,
    'defaultSize' => 256,
    'minSize' => 0,
    'maxSize' => 600,
    'minifiedSize' => 80,
    'showToggle' => false,
    'persist' => false, // save to localstorage
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
        'accent' => 'bg-accent-100 dark:bg-accent-900 border-accent-200 dark:border-accent-800',
        default => 'bg-vibe-100 dark:bg-vibe-900 border-vibe-200 dark:border-vibe-800',
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
        default => 'relative',
    };
@endphp

<div id="{{ $id }}" x-data="{
    id: '{{ $id }}',
    behavior: '{{ $behavior }}',
    position: '{{ $position }}',
    isResizing: false,
    isInitialized: false,
    startSize: 0,
    startPos: 0,
    minifiedSize: {{ $minifiedSize }},
    minSize: {{ $minSize }},
    maxSize: {{ $maxSize }},

    size: {{ $defaultSize }},
    state: 'expanded',

    init() {
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

        this.$nextTick(() => {
            setTimeout(() => {
                this.isInitialized = true;
            }, 50);
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
        if (this.behavior === 'static') return this.size;
        if (this.state === 'collapsed') return 0;
        if (this.state === 'minified') return this.minifiedSize;
        return this.size;
    },

    startResize(e) {
        if (this.behavior === 'static' && !{{ $resizable ? 'true' : 'false' }}) return;
        this.isResizing = true;

        this.startSize = this.currentSize;

        let clientX = e.clientX !== undefined ? e.clientX : (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
        let clientY = e.clientY !== undefined ? e.clientY : (e.touches && e.touches[0] ? e.touches[0].clientY : 0);

        if (this.position === 'left' || this.position === 'right') {
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

        let clientX = e.clientX !== undefined ? e.clientX : (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
        let clientY = e.clientY !== undefined ? e.clientY : (e.touches && e.touches[0] ? e.touches[0].clientY : 0);

        let delta = 0;
        if (this.position === 'left') delta = clientX - this.startPos;
        else if (this.position === 'right') delta = this.startPos - clientX;
        else if (this.position === 'top') delta = clientY - this.startPos;
        else if (this.position === 'bottom') delta = this.startPos - clientY;

        let newSize = this.startSize + delta;


        let dynamicMaxSize = this.maxSize;
        if (this.position === 'left' || this.position === 'right') {
            if (window.innerWidth - 16 < dynamicMaxSize) dynamicMaxSize = window.innerWidth - 16;
        } else {
            if (window.innerHeight - 16 < dynamicMaxSize) dynamicMaxSize = window.innerHeight - 16;
        }

        if (newSize > dynamicMaxSize) newSize = dynamicMaxSize;

        if (this.behavior === 'static') {
            if (newSize < this.minSize) newSize = this.minSize;
        } else if (this.behavior === 'collapsible') {
            if (this.minSize > 0) {
                if (newSize < this.minSize) newSize = this.minSize;
            } else {
                if (newSize < 0) newSize = 0;
            }
        } else if (this.behavior === 'minify') {
            if (this.minSize > 0 && newSize < this.minSize && newSize > this.minifiedSize + 20) {
                newSize = this.minSize;
            }
            if (newSize < 0) newSize = 0;
        } else {
            if (newSize < 0) newSize = 0;
        }

        this.size = newSize;

        if (this.behavior === 'minify') {
            if (this.size < this.minifiedSize / 2) {
                this.state = 'collapsed';
            } else if (this.size <= this.minifiedSize + 20) { // Tambah zona 'snap' +20px
                this.state = 'minified';
            } else {
                this.state = 'expanded';
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
        if (this.behavior === 'static') return;

        if (this.behavior === 'collapsible') {
            this.state = this.state === 'expanded' ? 'collapsed' : 'expanded';
        } else if (this.behavior === 'minify') {
            this.state = this.state === 'expanded' ? 'minified' : 'expanded';
        }

        if (this.state === 'expanded' && this.size < this.minifiedSize + 50) {
            this.size = {{ $defaultSize }};
        }

        this.saveToStorage();
    }
}" @mouseup.window="stopResize()" @touchend.window="stopResize()" @mousemove.window="doResize($event)" @touchmove.window="doResize($event)" @toggle-sheet-{{ $id }}.window="toggle()" style="{{ $position === 'left' || $position === 'right' ? "width: {$defaultSize}px" : "height: {$defaultSize}px" }}" :style="(position === 'left' || position === 'right') ? `width: ${currentSize}px` : `height: ${currentSize}px`" :data-state="state" :class="{
    '': !isResizing && isInitialized
}" {{ $attributes->twMerge(['class' => "$variantClasses flex flex-col shrink-0 z-40 $positionClasses $layoutClasses group/sheet max-w-full max-h-full"]) }}>
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
                                let state = item.status !== undefined ? item.status : 'expanded';
                                let minSize = {{ $minSize }};
                                let maxSize = {{ $maxSize }};

                                if (size > maxSize) size = maxSize;
                                if (state === 'expanded' && size < minSize) size = minSize;

                                let currentSize = size;
                                if ('{{ $behavior }}' !== 'static') {
                                    if (state === 'collapsed') currentSize = 0;
                                    else if (state === 'minified') currentSize = {{ $minifiedSize }};
                                }
                                let isHorizontal = '{{ $position }}' === 'left' || '{{ $position }}' === 'right';
                                el.style[isHorizontal ? 'width' : 'height'] = currentSize + 'px';
                                el.setAttribute('data-state', state);
                                el.classList.add('group/sheet');
                            }
                        }
                    }
                } catch (e) {}
            })();
        </script>
    @endif

    <div class="flex-1 overflow-y-auto overflow-x-hidden w-full h-full relative" x-show="state !== 'collapsed'" x-transition.opacity>
        <div class="w-max min-w-full">
            {{ $slot }}
        </div>
    </div>


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
        <vibe:button @click="toggle()" class="absolute rounded-full w-6 h-6 flex items-center justify-center text-vibe-400 hover:text-vibe-600 shadow-sm z-50 transition-colors {{ $togglePositionClasses }}" :class="{
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
        <div @mousedown.prevent="startResize($event)" @touchstart.prevent="startResize($event)" class="absolute z-10 group/resizer flex items-center justify-center" :class="{
            'top-0 bottom-0 -right-2 w-4 cursor-col-resize': position === 'left',
            'top-0 bottom-0 -left-2 w-4 cursor-col-resize': position === 'right',
            'left-0 right-0 -bottom-2 h-4 cursor-row-resize': position === 'top',
            'left-0 right-0 -top-2 h-4 cursor-row-resize': position === 'bottom'
        }">
            <div class="transition-colors duration-300 rounded-full" :class="{
                'h-full w-0.5 group-hover/resizer:bg-vibe-500/30': position === 'left' || position === 'right',
                'w-full h-0.5 group-hover/resizer:bg-vibe-500/30': position === 'top' || position === 'bottom'
            }">
            </div>
        </div>
    @endif
</div>
