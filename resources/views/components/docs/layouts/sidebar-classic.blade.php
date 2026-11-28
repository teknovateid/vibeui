@props([
    'panel' => null,
    'shell' => 'flush',
    'headerVariant' => 'default',
    'sticky' => false,
    'headerSize' => 'sm',
    'sidebarId' => 'sidebar-menu',
    'sidebarPosition' => 'left',
    'sidebarBehavior' => 'minify',
    'sidebarResizable' => true,
    'sidebarPersist' => true,
    'sidebarSize' => 260,
    'minSize' => 200,
    'maxSize' => 420,
    'minifiedSize' => 72,
    'mobileSize' => 280,
    'mainScrollId' => 'docs-main-scroll',
    'sidebarScrollId' => 'sidebar-menu-body',
    'navVariant' => 'line',
    'navDensity' => 'compact',
    'navIndicator' => true,
    'navPinnable' => true,
    'showSearch' => true,
    'showFullscreen' => true,
    'showNotifications' => true,
    'showHistory' => true,
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
    @pushOnce('head', 'vibe-layout-sidebar-classic')
        @vite(['resources/css/vibe/layouts/sidebar-classic.css', 'resources/js/vibe/layouts/sidebar-classic.js'])
    @endPushOnce
@endif

<x-docs.layouts.base
    layout="sidebar-classic"
    layoutGroup="panel"
    :panel="$panel"
    :shell="$shell"
    :sidebarId="$sidebarId"
    :styles="$styles"
    :scripts="$scripts"
    :cssVars="$resolvedCssVars"
>
    <div data-vibe-shell-frame class="flex h-dvh overflow-hidden relative">
        <vibe:sheet
            variant="sidebar"
            :id="$sidebarId"
            :position="$sidebarPosition"
            layout="relative"
            class="absolute md:relative left-0 top-0 bottom-0 z-60 md:z-30 shadow-xl md:shadow-none"
            :resizable="$sidebarResizable"
            :behavior="$sidebarBehavior"
            :minSize="$minSize"
            :maxSize="$maxSize"
            :minifiedSize="$minifiedSize"
            :defaultSize="$sidebarSize"
            :mobileSize="$mobileSize"
            :persist="$sidebarPersist"
        >
            <vibe:sheet.header data-vibe-sidebar-header class="flex items-center justify-between minified:justify-center minified:px-0 border-b border-sidebar-border">
                @isset($sidebarHeader)
                    {{ $sidebarHeader }}
                @else
                    @isset($brand)
                        <div class="block minified:hidden truncate">{{ $brand }}</div>
                    @else
                        <h1 class="text-xl font-bold leading-none tracking-tight block minified:hidden truncate transition-opacity duration-300">{{ config('app.name') }}</h1>
                    @endisset

                    @isset($brandMini)
                        <div class="hidden minified:flex items-center justify-center shrink-0">{{ $brandMini }}</div>
                    @else
                        <div class="hidden minified:flex items-center justify-center size-9 rounded-md bg-muted text-foreground font-bold text-xl shrink-0">
                            <img src="{{ asset('vibe/logo/logo.svg') }}" class="aspect-square size-[60%]" alt="VibeUI Logo">
                        </div>
                    @endisset

                    <vibe:button variant="ghost" class="p-2 transition-colors block minified:hidden" @click="$dispatch('toggle-sheet', '{{ $sidebarId }}')" aria-label="Toggle sidebar menu">
                        <div class="flex items-center justify-center">
                            <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 9L10.5 12L13.5 15" />
                                    <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                                </g>
                            </svg>
                        </div>
                    </vibe:button>
                @endisset
            </vibe:sheet.header>

            <vibe:sheet.content id="{{ $sidebarScrollId }}" data-vibe-scroll="sidebar" class="pl-2.5 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar">
                @isset($sidebarBeforeMenu)
                    {{ $sidebarBeforeMenu }}
                @endisset

                @isset($sidebarMenu)
                    {{ $sidebarMenu }}
                @else
                    <x-docs.partials.sidebar-classic-menu
                        :variant="$navVariant"
                        :density="$navDensity"
                        :indicator="$navIndicator"
                        :pinnable="$navPinnable"
                    />
                @endisset

                @isset($sidebarAfterMenu)
                    {{ $sidebarAfterMenu }}
                @endisset
            </vibe:sheet.content>

            <vibe:sheet.footer class="px-0 py-3 border-t border-sidebar-border">
                @if ($showHistory)
                    <vibe:nav id="sidebar-footer-nav" {{ $attributes->twMerge(['class' => 'mb-1']) }}>
                        <vibe:nav.history persist class="max-h-30 pl-2.5 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar" />
                    </vibe:nav>
                @endif

                @isset($sidebarFooter)
                    {{ $sidebarFooter }}
                @elseif ($showUserMenu)
                    <div class="w-full px-3 minified:px-0">
                        <vibe:dropdown keyboard class="w-full">
                            <x-slot:trigger>
                                <div class="w-full minified:w-fit minified:mx-auto minified:rounded-md flex items-center justify-between p-2.5 rounded-md bg-muted/40 text-sidebar-foreground border border-sidebar-border hover:bg-muted group cursor-pointer minified:p-0 minified:border-none">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <div class="relative flex shrink-0">
                                            <vibe:avatar size="sm" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=64&h=64&auto=format&fit=crop" alt="Masum Parvej" />
                                        </div>

                                        <div class="flex flex-col text-left min-w-0 minified:hidden">
                                            <span class="text-xs font-semibold text-foreground truncate leading-tight">Masum Parvej</span>
                                            <span class="text-[10px] text-muted-foreground truncate leading-tight mt-0.5"><!--email_off-->masum@hugeicons.com<!--/email_off--></span>
                                        </div>
                                    </div>
                                </div>
                            </x-slot:trigger>

                            <vibe:dropdown.content align="top" width="64" class="max-h-[calc(100vh-6rem)] overflow-y-auto vibe-scrollbar">
                                <div class="flex flex-col gap-0.5">
                                    <vibe:dropdown.item href="#" class="gap-3">Home</vibe:dropdown.item>
                                    <vibe:dropdown.item href="#" class="gap-3">Pages</vibe:dropdown.item>
                                </div>

                                <vibe:dropdown.divider />

                                <!-- Site settings -->
                                <vibe:dropdown.item href="#" class="gap-3">
                                    Site settings
                                </vibe:dropdown.item>

                                <vibe:dropdown.item class="gap-3 flex w-full justify-between items-center" @click.stop="toggleTheme($event)">
                                    <span>Dark mode</span>
                                    <div class="w-8 h-4.5 rounded-full p-0.5 transition-colors duration-200 ease-in-out relative flex items-center" :class="isDark ? 'bg-primary' : 'bg-muted'">
                                        <div class="size-3.5 rounded-full bg-background shadow-xs transition-transform duration-200 ease-in-out" :class="isDark ? 'translate-x-3.5' : 'translate-x-0'"></div>
                                    </div>
                                </vibe:dropdown.item>

                                <div class="pt-2 mt-1 border-t border-border flex items-center justify-between px-2">
                                    <vibe:button type="button" variant="ghost" size="sm">Feedback</vibe:button>
                                    <vibe:button type="button" class="rounded-full text-destructive hover:bg-destructive/10 hover:text-destructive" variant="ghost" size="sm">Logout</vibe:button>
                                </div>
                            </vibe:dropdown.content>
                        </vibe:dropdown>
                    </div>

                    <div class="pt-2.5 px-3 minified:px-0 flex items-center justify-between minified:justify-center text-[11px] text-muted-foreground border-t border-sidebar-border/60 mt-2">
                        <span class="font-medium text-xs text-muted-foreground/80 minified:hidden">Vibe UI</span>
                        <span class="font-mono text-[10px] px-1.5 py-0.5 rounded bg-muted text-muted-foreground font-semibold border border-sidebar-border/60">v{{ \Teknovate\VibeUi\Vibe::version() }}</span>
                    </div>
                @endisset
            </vibe:sheet.footer>
        </vibe:sheet>

        @isset($backdrop)
            {{ $backdrop }}
        @else
            <div
                x-show="isMobileBackdropOpen"
                x-transition:enter="transition-opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/50 backdrop-blur-xs z-55 md:hidden"
                aria-hidden="true"
                @click="$dispatch('close-sheet', '{{ $sidebarId }}')"
                style="display: none;"
            ></div>
        @endisset

        <div id="{{ $mainScrollId }}" data-vibe-scroll="main" data-vibe-main-shell class="flex flex-col flex-1 min-w-0 h-full min-h-0 overflow-y-auto overscroll-y-contain vibe-scrollbar group/docs {{ $isHeaderSticky ? 'has-sticky-header' : '' }}" style="--docs-toc-top: {{ $isHeaderSticky ? '5rem' : '1.5rem' }};">
            <vibe:header variant="header" :sticky="$isHeaderSticky" data-vibe-layout-header :data-vibe-sticky-header="$isHeaderSticky ? 'true' : null" :size="$headerSize">
                <vibe:header.heading class="gap-2 flex items-center min-w-0">
                    <vibe:button variant="ghost" size="icon-md" class="hidden sidebar-minified:inline-flex sidebar-collapsed:inline-flex text-muted-foreground hover:text-foreground transition-colors shrink-0" @click.stop="$dispatch('toggle-sheet', '{{ $sidebarId }}')" aria-label="Toggle sidebar menu">
                        <div class="flex items-center justify-center">
                            <svg class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 9L13.5 12L10.5 15" />
                                    <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                                </g>
                            </svg>
                        </div>
                    </vibe:button>

                    @isset($headerStart)
                        {{ $headerStart }}
                    @endisset
                </vibe:header.heading>

                @isset($headerCenter)
                    <div class="hidden lg:flex items-center justify-center min-w-0">
                        {{ $headerCenter }}
                    </div>
                @endisset

                <vibe:header.actions class="items-center h-full relative gap-1.5 shrink-0">
                    @isset($headerActions)
                        {{ $headerActions }}
                    @else
                        <vibe:partials.layout-actions
                            :showSearch="$showSearch"
                            :showFullscreen="$showFullscreen"
                            :showNotifications="$showNotifications"
                        />
                    @endisset
                </vibe:header.actions>
            </vibe:header>

            <main id="vibe-main-content" tabindex="-1" data-vibe-main-content-wrap class="flex-1 min-w-0 w-full outline-none vibe-page-enter">
                <div data-vibe-main-container class="mx-auto w-full max-w-[1600px] 2xl:max-w-[1800px]">
                    {{ $slot }}
                </div>
            </main>
        </div>

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
