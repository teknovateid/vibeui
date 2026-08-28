@blaze(fold: true)

@props([
    'keyboard' => false,
])

<div {{ $attributes->twMerge(['class' => 'relative inline-block text-left']) }} x-data="{
    open: false,
    align: 'right',
    init() {
        this.$watch('open', value => {
            if (value) {
                this.$nextTick(() => {
                    this.adjustPosition();
                });
            }
        });
    },
    toggle() { this.open = !this.open },
    close() { this.open = false },
    adjustPosition() {
        if (!this.$refs.menuContainer) return;
        let menu = this.$refs.menuContainer.parentElement; // The absolute wrapper

        // Remove dynamic classes
        menu.classList.remove('left-0', 'right-0', 'origin-top-left', 'origin-top-right');

        // Set default based on align prop
        if (this.align === 'left') {
            menu.classList.add('left-0', 'origin-top-left');
        } else {
            menu.classList.add('right-0', 'origin-top-right');
        }

        let rect = menu.getBoundingClientRect();

        if (this.align === 'left') {
            if (rect.right > window.innerWidth) {
                menu.classList.remove('left-0', 'origin-top-left');
                menu.classList.add('right-0', 'origin-top-right');
            }
        } else {
            if (rect.left < 0) {
                menu.classList.remove('right-0', 'origin-top-right');
                menu.classList.add('left-0', 'origin-top-left');
            }
        }
    },
    getVisibleItems() {
        return Array.from(this.$refs.menuContainer ? this.$refs.menuContainer.querySelectorAll('[role=\'menuitem\'], button, a') : [])
            .filter(el => el.offsetWidth > 0 || el.offsetHeight > 0);
    },
    focusNext(e) {
        if (!this.open) return;
        e?.preventDefault();
        let items = this.getVisibleItems();
        let currentIndex = items.indexOf(document.activeElement);
        let nextIndex = Math.min(currentIndex + 1, items.length - 1);
        if (items[nextIndex]) items[nextIndex].focus();
    },
    focusPrevious(e) {
        if (!this.open) return;
        e?.preventDefault();
        let items = this.getVisibleItems();
        let currentIndex = items.indexOf(document.activeElement);
        if (currentIndex === -1) currentIndex = items.length;
        let nextIndex = Math.max(currentIndex - 1, 0);
        if (items[nextIndex]) items[nextIndex].focus();
    }
}" @if ($keyboard)
    @keydown.escape.window="close()"
    @keydown.up.window="focusPrevious($event)"
    @keydown.down.window="focusNext($event)"
    @endif
    @click.outside="close()"
    @resize.window="open ? adjustPosition() : null">

    @if (isset($trigger))
        <div @click="toggle()" class="cursor-pointer inline-block">
            {{ $trigger }}
        </div>

        {{ $slot }}
    @else
        {{ $slot }}
    @endif
</div>
