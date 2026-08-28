@props([
    'label' => '',
    'isOpen' => false,
    'position' => 'absolute',
    'align' => 'right',
    'width' => '48',
])

<div x-data="{ 
        subOpen: @js($isOpen),
        position: @js($position),
        init() {
            this.$watch('open', value => {
                if (!value) this.subOpen = @js($isOpen);
            });
            this.$watch('subOpen', value => {
                if (value && this.position === 'absolute') {
                    this.$nextTick(() => this.adjustPosition());
                }
            });
        },
        closeSub() {
            this.subOpen = false;
            if (this.$refs.trigger) this.$refs.trigger.focus();
        },
        adjustPosition() {
            if (!this.$refs.menu) return;
            
            // Remove previous dynamic classes
            this.$refs.menu.classList.remove('right-full', 'mr-1', 'left-full', 'ml-1', 'left-0', 'mt-10');
            
            // Default to right
            this.$refs.menu.classList.add('left-full', 'ml-1');
            
            let rect = this.$refs.menu.getBoundingClientRect();
            
            // If it overflows right side
            if (rect.right > window.innerWidth) {
                this.$refs.menu.classList.remove('left-full', 'ml-1');
                this.$refs.menu.classList.add('right-full', 'mr-1');
                
                // If it now overflows left side (screen too small for both sides)
                let newRect = this.$refs.menu.getBoundingClientRect();
                if (newRect.left < 0) {
                    this.$refs.menu.classList.remove('right-full', 'mr-1');
                    // Fallback to dropping down overlapping the parent menu
                    this.$refs.menu.classList.add('left-0', 'mt-10'); 
                }
            }
        }
     }" 
     @keydown.right.prevent="subOpen = true"
     @keydown.left.prevent="closeSub()"
     @resize.window="subOpen && position === 'absolute' ? adjustPosition() : null"
     class="relative w-full" 
     {{ $attributes }}>

    <vibe:button 
        x-ref="trigger"
        variant="ghost" 
        class="w-full justify-between font-normal px-3 py-1.5 text-sm text-vibe-700 dark:text-vibe-300 hover:bg-vibe-100 hover:text-vibe-900 dark:hover:bg-vibe-800 dark:hover:text-vibe-100 focus:bg-vibe-100 focus:text-vibe-900 dark:focus:bg-vibe-800 dark:focus:text-vibe-100"
        role="menuitem"
        @click.stop.prevent="subOpen = !subOpen"
    >
        <span class="flex items-center gap-2">
            @if(isset($trigger))
                {{ $trigger }}
            @else
                {{ $label }}
            @endif
        </span>
        <svg class="w-4 h-4 text-vibe-400 transition-transform duration-200" :class="{ 'rotate-90': subOpen }" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
        </svg>
    </vibe:button>

    @php
        if ($position === 'absolute') {
            $positionClasses = match ($align) {
                'left' => 'absolute top-0 right-full mr-1 z-50',
                'right', 'default' => 'absolute top-0 left-full ml-1 z-50',
            };
            $widthClasses = match ((string) $width) {
                '48', 'xs' => 'w-48',
                '56' => 'w-56',
                '64', 'sm' => 'w-64',
                '72' => 'w-72',
                '80', 'md' => 'w-80',
                '96', 'lg' => 'w-96',
                'xl' => 'w-[28rem]',
                '2xl' => 'w-[32rem]',
                'min' => 'min-w-min',
                'full' => 'w-full',
                default => str_starts_with((string) $width, 'w-') || str_starts_with((string) $width, 'max-w-') ? (string) $width : "w-{$width}",
            };
            $wrapperClasses = "$positionClasses $widthClasses rounded-md shadow-lg";
            $innerClasses = "rounded-md shadow-sm p-1 bg-vibe-50 dark:bg-vibe-900 border border-vibe-200 dark:border-vibe-800 text-vibe-900 dark:text-vibe-100";
        } else {
            $wrapperClasses = "relative w-full mt-1";
            $treeStyles = 
                "[&>*]:relative " .
                "[&>*:before]:content-[''] [&>*:before]:absolute [&>*:before]:top-0 [&>*:before]:-left-3 [&>*:before]:w-3 [&>*:before]:h-1/2 [&>*:before]:border-l [&>*:before]:border-b [&>*:before]:border-vibe-200 dark:[&>*:before]:border-vibe-800 [&>*:before]:rounded-bl-md " .
                "[&>*:first-child:before]:-top-1 [&>*:first-child:before]:h-[calc(50%+0.25rem)] " .
                "[&>*:not(:last-child):after]:content-[''] [&>*:not(:last-child):after]:absolute [&>*:not(:last-child):after]:top-0 [&>*:not(:last-child):after]:-left-3 [&>*:not(:last-child):after]:w-px [&>*:not(:last-child):after]:h-[calc(100%+0.25rem)] [&>*:not(:last-child):after]:bg-vibe-200 dark:[&>*:not(:last-child):after]:bg-vibe-800";
            $innerClasses = "pl-3 ml-3 flex flex-col gap-1 $treeStyles";
        }
    @endphp

    <div x-show="subOpen"
        x-ref="menu"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="{{ $wrapperClasses }}"
        style="display: none;"
    >
        <div class="{{ $innerClasses }}" role="menu" aria-orientation="vertical">
            {{ $slot }}
        </div>
    </div>
</div>
