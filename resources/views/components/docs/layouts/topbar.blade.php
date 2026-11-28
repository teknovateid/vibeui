@props([
    'panel' => null,
    'shell' => 'horizontal',
    'headerVariant' => 'sticky',
    'sticky' => true,
    'collapseMode' => 'auto',
    'hoverPreview' => true,
    'showSearch' => true,
    'showFullscreen' => true,
    'showNotifications' => true,
    'showUserMenu' => true,
    'containerMaxWidth' => '1600px',
    'styles' => [],
    'scripts' => [],
    'includeDefaultAssets' => true,
    'cssVars' => [],
])

@php
    $isHeaderSticky = $headerVariant === 'sticky' && $sticky !== false;
    $resolvedCssVars = array_merge(
        array_filter([
            'content-max-width' => $containerMaxWidth,
        ], static fn ($val) => $val !== null && $val !== ''),
        is_array($cssVars) ? $cssVars : []
    );
@endphp

@if ($includeDefaultAssets)
    @pushOnce('head', 'vibe-layout-topbar')
        @vite(['resources/css/vibe/layouts/topbar.css', 'resources/js/vibe/layouts/topbar.js'])
    @endPushOnce
@endif

<x-docs.layouts.base
    layout="topbar"
    layoutGroup="panel"
    :panel="$panel"
    :shell="$shell"
    :styles="$styles"
    :scripts="$scripts"
    :cssVars="$resolvedCssVars"
>
    <div data-vibe-shell-frame class="min-h-dvh flex flex-col">
        <header
            data-vibe-topbar-header
            @if ($isHeaderSticky) data-vibe-sticky-header @endif
            data-collapse-mode="{{ $collapseMode }}"
            data-hover-preview="{{ $hoverPreview ? 'true' : 'false' }}"
            class="{{ $isHeaderSticky ? 'sticky top-0 z-45' : 'relative z-30' }}"
        >
            <div data-vibe-topbar-inner class="vibe-topbar-inner">
                <div class="flex items-center gap-3 shrink-0">
                    @isset($brand)
                        {{ $brand }}
                    @else
                        <a href="{{ Route::has('docs.index') ? route('docs.index') : '/' }}" wire:navigate class="inline-flex items-center gap-2.5 text-foreground focus-visible:outline-2 focus-visible:outline-ring rounded-lg">
                            <span class="size-8 rounded-lg bg-primary/10 border border-border/60 p-1.5 flex items-center justify-center shrink-0">
                                <img src="{{ asset('vibe/logo/logo.svg') }}" class="size-full aspect-square" alt="{{ config('app.name') }}">
                            </span>
                            <span class="text-base font-bold tracking-tight truncate">{{ config('app.name') }}</span>
                        </a>
                    @endisset
                </div>

                <nav aria-label="Primary" data-vibe-topbar-nav class="min-w-0">
                    <vibe:button
                        type="button"
                        variant="outline"
                        size="sm"
                        data-vibe-topbar-trigger
                        popovertarget="vibe-topbar-menu"
                        popovertargetaction="toggle"
                        aria-controls="vibe-topbar-menu"
                        aria-expanded="false"
                        aria-label="Menu"
                    >
                        <svg class="size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                        <span>Menu</span>
                    </vibe:button>

                    <ul id="vibe-topbar-menu" data-vibe-topbar-menu popover="auto">
                        @isset($topbarMenu)
                            {{ $topbarMenu }}
                        @else
                            <x-docs.partials.topbar-menu />
                        @endisset
                    </ul>
                </nav>

                <div class="flex items-center gap-1.5 shrink-0">
                    @isset($headerActions)
                        {{ $headerActions }}
                    @else
                        <vibe:partials.layout-actions
                            :showSearch="$showSearch"
                            :showFullscreen="$showFullscreen"
                            :showNotifications="$showNotifications"
                            compactSearch
                        >
                            @if ($showUserMenu)
                                <vibe:dropdown keyboard>
                                    <x-slot:trigger>
                                        <vibe:button type="button" variant="ghost" size="sm" class="px-2 gap-2 rounded-full">
                                            <vibe:avatar size="xs" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=64&h=64&auto=format&fit=crop" alt="User Avatar" />
                                            <span class="hidden sm:inline text-xs font-medium text-foreground">Account</span>
                                        </vibe:button>
                                    </x-slot:trigger>
                                    <vibe:dropdown.content align="bottom-right" width="56">
                                        <!-- Site settings -->
                                        <vibe:dropdown.item href="#" class="gap-3">Site settings</vibe:dropdown.item>
                                        <vibe:dropdown.item class="gap-3 flex w-full justify-between items-center" @click.stop="toggleTheme($event)">
                                            <span>Dark mode</span>
                                            <span class="text-xs text-muted-foreground" x-text="isDark ? 'Dark' : 'Light'">Light</span>
                                        </vibe:dropdown.item>
                                    </vibe:dropdown.content>
                                </vibe:dropdown>
                            @endif
                        </vibe:partials.layout-actions>
                    @endisset
                </div>
            </div>

            @isset($subHeader)
                <div class="border-t border-border/60 bg-background/80">
                    <div data-vibe-main-container class="mx-auto w-full max-w-[1600px] px-4 sm:px-6 py-2">
                        {{ $subHeader }}
                    </div>
                </div>
            @endisset
        </header>

        <div id="docs-main-scroll" data-vibe-scroll="main" data-vibe-main-shell class="flex-1 min-w-0 w-full {{ $isHeaderSticky ? 'has-sticky-header' : '' }}">
            <main id="vibe-main-content" tabindex="-1" data-vibe-main-content-wrap class="w-full min-w-0 outline-none vibe-page-enter">
                <div data-vibe-main-container class="mx-auto w-full max-w-[1600px] 2xl:max-w-[1800px]">
                    {{ $slot }}
                </div>
            </main>
        </div>

        @isset($footer)
            <footer class="border-t border-border bg-card/40 mt-auto">
                <div data-vibe-main-container class="mx-auto w-full max-w-[1600px] px-4 sm:px-6 py-4 text-xs text-muted-foreground">
                    {{ $footer }}
                </div>
            </footer>
        @endisset

        @if ($showNotifications)
            <x-docs.partials.optional.notification-sheet />
        @endif
    </div>

    @if ($showSearch)
        <x-docs.partials.optional.search-modal />
    @endif

    @isset($modals)
        {{ $modals }}
    @endisset
</x-docs.layouts.base>
