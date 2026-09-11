@blaze(fold: true)

@props([
    'id' => null,
])

@php
    $contextId = $id ?? uniqid('context-');
@endphp

<div
    id="{{ $contextId }}"
    x-data="{
        id: '{{ $contextId }}',
        open: false,
        x: 0,
        y: 0,
        data: {},
        lastOpenTime: 0,

        init() {
            // Close context menu on ANY scroll across the document or inside scrollable containers (capture: true)
            const handleScroll = () => {
                if (this.open && Date.now() - this.lastOpenTime > 60) {
                    this.close();
                }
            };
            window.addEventListener('scroll', handleScroll, true);
            this.$cleanup(() => {
                window.removeEventListener('scroll', handleScroll, true);
            });
        },

        show(x, y, data = {}) {
            this.lastOpenTime = Date.now();
            this.x = x;
            this.y = y;
            this.data = data;
            this.open = true;
            this.$nextTick(() => this.adjustPosition());
        },

        close() {
            this.open = false;
        },

        closeOutside() {
            if (Date.now() - this.lastOpenTime < 100) return;
            this.close();
        },

        closeOnContextmenu() {
            // Guard: don't close if we just opened (event bubbling from trigger)
            if (Date.now() - this.lastOpenTime < 150) return;
            this.close();
        },

        adjustPosition() {
            const menu = this.$refs.menu;
            if (!menu) return;

            const rect = menu.getBoundingClientRect();
            const vw = window.innerWidth;
            const vh = window.innerHeight;

            let finalX = this.x;
            let finalY = this.y;

            // Flip horizontally if overflows right edge
            if (this.x + rect.width > vw) {
                finalX = this.x - rect.width;
            }

            // Flip vertically if overflows bottom edge
            if (this.y + rect.height > vh) {
                finalY = this.y - rect.height;
            }

            // Clamp to viewport boundaries
            finalX = Math.max(4, finalX);
            finalY = Math.max(4, finalY);

            menu.style.left = finalX + 'px';
            menu.style.top = finalY + 'px';
        }
    }"
    @open-context.window="
        const d = $event.detail;
        const target = Array.isArray(d) ? d[0]?.menu : d?.menu;
        if (target === id) show(d.x ?? 0, d.y ?? 0, d.data ?? {})
    "
    @close-context.window="
        const d = $event.detail;
        const target = Array.isArray(d) ? d[0] : d;
        if (target === id || target === '*' || !target) close()
    "
    @click.outside="closeOutside()"
    @keydown.escape.window="close()"
    @contextmenu.window="closeOnContextmenu()"
>
    {{-- Portal overlay: fixed position, rendered at body level via absolute stacking --}}
    <div
        x-show="open"
        x-ref="menu"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        :style="'position: fixed; z-index: 9999; left: ' + x + 'px; top: ' + y + 'px;'"
        style="display: none;"
        role="menu"
        aria-orientation="vertical"
    >
        <div
            {{ $attributes->twMerge(['class' => 'min-w-48 rounded-md shadow-lg p-1 bg-popover text-popover-foreground border border-border']) }}
            @click="close()"
        >
            {{ $slot }}
        </div>
    </div>
</div>
