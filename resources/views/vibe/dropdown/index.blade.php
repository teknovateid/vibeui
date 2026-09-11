@blaze(fold: true)

@props([
    'id' => null,
    'keyboard' => false,
])

@php
    $dropdownId = $id ?? uniqid('dropdown-');
@endphp

<div id="{{ $dropdownId }}" {{ $attributes->twMerge(['class' => 'relative inline-block text-left']) }} x-data="{
    id: '{{ $dropdownId }}',
    open: false,
    lastTriggerTime: 0,
    init() {
        this.$watch('open', value => {
            if (value) {
                this.$nextTick(() => {
                    this.adjustPosition();
                });
            }
        });
    },
    show() {
        this.lastTriggerTime = Date.now();
        this.open = true;
    },
    toggle() {
        this.lastTriggerTime = Date.now();
        this.open = !this.open;
    },
    close() {
        this.open = false;
    },
    closeOutside() {
        if (Date.now() - this.lastTriggerTime < 150) return;
        this.close();
    },
    adjustPosition() {
        if (!this.$refs.menuContainer) return;
        let menu = this.$refs.menuContainer.parentElement;
        let rect = menu.getBoundingClientRect();
        let isBottomFull = menu.classList.contains('bottom-full');

        if (rect.right > window.innerWidth) {
            menu.classList.remove('left-0', 'origin-top-left', 'origin-bottom-left');
            menu.classList.add('right-0', isBottomFull ? 'origin-bottom-right' : 'origin-top-right');
        } else if (rect.left < 0) {
            menu.classList.remove('right-0', 'origin-top-right', 'origin-bottom-right');
            menu.classList.add('left-0', isBottomFull ? 'origin-bottom-left' : 'origin-top-left');
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
}" @open-dropdown.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === id) show()"
    @close-dropdown.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === id || t === '*' || !t) close()"
    @toggle-dropdown.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === id) toggle()"
    @if ($keyboard)
    @keydown.escape.window="close()"
    @keydown.up.window="focusPrevious($event)"
    @keydown.down.window="focusNext($event)"
    @endif
    @click.outside="closeOutside()"
    @resize.window="open ? adjustPosition() : null">

    @if (isset($trigger))
        <div @click="toggle()" class="cursor-pointer inline-block w-full">
            {{ $trigger }}
        </div>

        {{ $slot }}
    @else
        {{ $slot }}
    @endif
</div>
