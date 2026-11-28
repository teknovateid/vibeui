@props([
    'showSearch' => true,
    'showFullscreen' => true,
    'showNotifications' => true,
    'compactSearch' => false,
])

<div {{ $attributes->twMerge(['class' => 'flex items-center gap-1.5 shrink-0']) }}>
    @if ($showSearch)
        <vibe:button variant="ghost" size="icon-md" class="{{ $compactSearch ? '' : 'md:hidden' }} text-muted-foreground hover:text-foreground transition-colors" @click="$dispatch('open-modal', 'global-search-modal')" aria-label="{{ __('docs/sidebar.search') }}">
            <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11.5" cy="11.5" r="9.5" />
                <path d="M18.5 18.5L22 22" />
            </svg>
        </vibe:button>
        @if (! $compactSearch)
            <vibe:button variant="default" size="sm" type="button" @click="$dispatch('open-modal', 'global-search-modal')" class="hidden md:inline-flex items-center gap-2 rounded-full text-muted-foreground hover:text-foreground transition-all duration-200 cursor-pointer mr-0.5" title="Quick Search (⌘K / Ctrl+K)">
                <svg class="size-3.5 text-muted-foreground shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11.5" cy="11.5" r="9.5" />
                    <path d="M18.5 18.5L22 22" />
                </svg>
                <span class="inline-block font-normal">{{ __('docs/sidebar.search') }}</span>
                <kbd class="hidden md:inline-flex items-center gap-0.5 text-[10px] font-mono font-medium text-muted-foreground bg-background/80 px-1.5 py-0.5 rounded-full border border-border/80 shadow-2xs">
                    <span class="text-xs">⌘</span>K
                </kbd>
            </vibe:button>
        @endif
    @endif

    @if ($showFullscreen)
        <vibe:button variant="ghost" size="icon-md" class="text-muted-foreground hover:text-foreground transition-colors" @click="toggleFullscreen()" aria-label="Toggle fullscreen" title="Toggle Fullscreen">
            <svg x-show="!isFullscreen" class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" d="M6 9.99739C6.01447 8.29083 6.10921 7.35004 6.72963 6.72963C7.35004 6.10921 8.29083 6.01447 9.99739 6" />
                    <path stroke-linecap="round" d="M6 14.0007C6.01447 15.7072 6.10921 16.648 6.72963 17.2684C7.35004 17.8888 8.29083 17.9836 9.99739 17.998" />
                    <path stroke-linecap="round" d="M17.9976 9.99739C17.9831 8.29083 17.8883 7.35004 17.2679 6.72963C16.6475 6.10921 15.7067 6.01447 14.0002 6" />
                    <path stroke-linecap="round" d="M17.9976 14.0007C17.9831 15.7072 17.8883 16.648 17.2679 17.2684C16.6475 17.8888 15.7067 17.9836 14.0002 17.998" />
                    <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                </g>
            </svg>

            <svg x-show="isFullscreen" style="display: none;" class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" d="M9.99756 6.00065C9.98309 7.70722 9.88834 8.64801 9.26793 9.26842C8.64752 9.88883 7.70673 9.98358 6.00017 9.99805" />
                    <path stroke-linecap="round" d="M9.99756 17.9974C9.98309 16.2908 9.88834 15.35 9.26793 14.7296C8.64752 14.1092 7.70673 14.0145 6.00017 14" />
                    <path stroke-linecap="round" d="M14 6.00065C14.0145 7.70722 14.1092 8.64801 14.7296 9.26842C15.35 9.88883 16.2908 9.98358 17.9974 9.99805" />
                    <path stroke-linecap="round" d="M14 17.9974C14.0145 16.2908 14.1092 15.35 14.7296 14.7296C15.35 14.1092 16.2908 14.0145 17.9974 14" />
                    <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                </g>
            </svg>
        </vibe:button>
    @endif

    @if ($showNotifications)
        <vibe:button variant="ghost" size="icon-md" class="text-muted-foreground hover:text-foreground transition-colors relative" @click.stop="$dispatch('toggle-sheet', 'notification-sheet')" aria-label="Toggle notifications" title="Notifications">
            <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M18.7491 9.70957V9.00496C18.7491 5.13623 15.7274 2 12 2C8.27256 2 5.25087 5.13623 5.25087 9.00496V9.70957C5.25087 10.5552 5.00972 11.3818 4.5578 12.0854L3.45036 13.8095C2.43882 15.3843 3.21105 17.5249 4.97036 18.0229C9.57274 19.3257 14.4273 19.3257 19.0296 18.0229C20.789 17.5249 21.5612 15.3843 20.5496 13.8095L19.4422 12.0854C18.9903 11.3818 18.7491 10.5552 18.7491 9.70957Z" />
                    <path stroke-linecap="round" d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19" opacity=".5" />
                </g>
            </svg>
            <span class="absolute top-2 right-2 size-2 bg-red-500 rounded-full ring-2 ring-background"></span>
        </vibe:button>
    @endif

    {{ $slot }}
</div>
