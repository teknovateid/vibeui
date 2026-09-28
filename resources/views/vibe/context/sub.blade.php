@blaze(fold: true)

@props([
    'label' => '',
    'align' => 'right',
    'width' => '48',
])

@php
    $widthClasses = match ((string) $width) {
        '48', 'xs' => 'w-48',
        '56'       => 'w-56',
        '64', 'sm' => 'w-64',
        '72'       => 'w-72',
        '80', 'md' => 'w-80',
        '96', 'lg' => 'w-96',
        'xl'       => 'w-[28rem]',
        '2xl'      => 'w-[32rem]',
        'min'      => 'min-w-min',
        default    => str_starts_with((string) $width, 'w-') ? (string) $width : "w-{$width}",
    };
@endphp

<div
    x-data="{
        subOpen: false,
        toggleSub() { this.subOpen = !this.subOpen; },
        closeSub() { this.subOpen = false; },
        adjustSubPosition() {
            const menu = this.$refs.subMenu;
            if (!menu) return;

            // Remove previous direction classes
            menu.classList.remove('left-full', 'ml-1', 'right-full', 'mr-1');

            // Default: open to the right
            menu.classList.add('left-full', 'ml-1');

            const rect = menu.getBoundingClientRect();
            if (rect.right > window.innerWidth) {
                menu.classList.remove('left-full', 'ml-1');
                menu.classList.add('right-full', 'mr-1');
            }
        }
    }"
    x-init="$watch('subOpen', v => { if (v) $nextTick(() => adjustSubPosition()); })"
    @keydown.right.prevent="subOpen = true"
    @keydown.left.prevent="closeSub()"
    class="relative w-full"
    {{ $attributes }}
>
    <vibe:button
        variant="ghost"
        class="w-full justify-between font-normal px-3 py-1.5 text-sm text-foreground hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
        role="menuitem"
        data-vibe-context-sub-trigger
        @click.stop="toggleSub()"
    >
        <span class="flex items-center gap-2">
            @if (isset($trigger))
                {{ $trigger }}
            @else
                {{ $label }}
            @endif
        </span>
        <svg class="w-4 h-4 text-muted-foreground transition-transform duration-200" :class="{ 'rotate-90': subOpen }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 5l7 7-7 7" />
        </svg>
    </vibe:button>

    <div
        x-show="subOpen"
        x-ref="subMenu"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute top-0 left-full ml-1 z-50 {{ $widthClasses }} rounded-md shadow-lg"
        style="display: none;"
        @click.stop
    >
        <div class="rounded-md shadow-sm p-1 bg-popover text-popover-foreground border border-border" role="menu">
            {{ $slot }}
        </div>
    </div>
</div>
