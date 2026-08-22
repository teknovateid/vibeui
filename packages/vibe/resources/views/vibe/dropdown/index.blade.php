@blaze(fold: true)

@props([
    'label' => '',
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'p-1 bg-white dark:bg-vibe-950 border border-vibe-200 dark:border-vibe-800',
    'variant' => 'outline',
    'size' => 'md',
    'icon' => true,
    'keyboard' => false,
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'origin-top-left left-0',
        'top' => 'origin-top',
        'right', 'default' => 'origin-top-right right-0',
    };

    $widthClasses = match ($width) {
        '48' => 'w-48',
        '64' => 'w-64',
        'min' => 'min-w-min',
        default => $width,
    };
@endphp

<div class="relative inline-block text-left" x-data="{ 
    open: false,
    toggle() { this.open = !this.open },
    close() { this.open = false },
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
}" 
@if($keyboard) 
    @keydown.escape.window="close()" 
    @keydown.up.window="focusPrevious($event)"
    @keydown.down.window="focusNext($event)"
@endif 
@click.outside="close()" 
{{ $attributes }}>
    
    @if ($label || isset($trigger))
        <div @click="toggle()">
            @if (isset($trigger))
                {{ $trigger }}
            @else
                <vibe:button :variant="$variant" :size="$size" type="button" class="w-full justify-between gap-1.5" aria-haspopup="true" x-bind:aria-expanded="open">
                    {{ $label }}
                    @if($icon)
                        <svg class="-mr-1 h-5 w-5 opacity-70" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    @endif
                </vibe:button>
            @endif
        </div>

        <div x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute z-50 mt-2 {{ $widthClasses }} rounded-md shadow-lg {{ $alignmentClasses }}"
                style="display: none;"
                @click="close()"
                >
            <div x-ref="menuContainer" class="rounded-md shadow-sm {{ $contentClasses }}" role="menu" aria-orientation="vertical" tabindex="-1">
                {{ $slot }}
            </div>
        </div>
    @else
        {{ $slot }}
    @endif
</div>
