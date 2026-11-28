@props([
    'panel' => null,
    'shell' => 'inset',
    'headerVariant' => 'sticky',
    'sticky' => true,
    'headerSize' => 'sm',
    'sidebarId' => 'sidebar-menu',
    'sidebarPosition' => 'left',
    'sidebarBehavior' => 'minify',
    'sidebarResizable' => true,
    'sidebarPersist' => true,
    'sidebarSize' => 260,
    'minSize' => 150,
    'maxSize' => 420,
    'minifiedSize' => 76,
    'mobileSize' => 280,
    'mainScrollId' => 'docs-main-scroll',
    'sidebarScrollId' => 'sidebar-menu-body',
    'navVariant' => 'subtle',
    'navDensity' => 'default',
    'navIndicator' => false,
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
    @pushOnce('head', 'vibe-layout-sidebar')
        @vite(['resources/css/vibe/layouts/sidebar.css', 'resources/js/vibe/layouts/sidebar.js'])
    @endPushOnce
@endif

<x-layouts.base
    layout="sidebar"
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
            <vibe:sheet.header data-vibe-sidebar-header class="flex items-center justify-between minified:justify-center minified:px-0 border-dashed">
                @isset($sidebarHeader)
                    {{ $sidebarHeader }}
                @else
                    @isset($brand)
                        <div class="block minified:hidden truncate">{{ $brand }}</div>
                    @else
                        <h1 class="text-2xl font-bold leading-none block minified:hidden truncate transition-opacity duration-300">{{ config('app.name') }}</h1>
                    @endisset

                    @isset($brandMini)
                        <div class="hidden minified:flex items-center justify-center shrink-0">{{ $brandMini }}</div>
                    @else
                        <div class="hidden minified:flex items-center justify-center size-8 rounded-md p-1.5 bg-muted text-foreground font-bold text-xl shrink-0">
                            <img src="{{ asset('vibe/logo/logo.svg') }}" class="aspect-square size-full" alt="VibeUI Logo">
                        </div>
                    @endisset

                    <vibe:button variant="ghost" class="md:hidden p-1.5 size-8 transition-colors block minified:hidden" @click="$dispatch('toggle-sheet', '{{ $sidebarId }}')" aria-label="Toggle sidebar menu">
                        <div class="flex items-center justify-center">
                            <svg class="size-full" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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

            <vibe:sheet.content id="{{ $sidebarScrollId }}" data-vibe-scroll="sidebar" class="pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar">
                @isset($sidebarBeforeMenu)
                    {{ $sidebarBeforeMenu }}
                @endisset

                @isset($sidebarMenu)
                    {{ $sidebarMenu }}
                @else
                    <x-partials.sidebar-menu
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

            <vibe:sheet.footer class="px-0 py-3 border-dashed">
                @if ($showHistory)
                    <vibe:nav id="sidebar-footer-nav" {{ $attributes->twMerge(['class' => 'mb-1']) }}>
                        <vibe:nav.history persist class="max-h-30 pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar" />
                    </vibe:nav>
                @endif

                @isset($sidebarFooter)
                    {{ $sidebarFooter }}
                @elseif ($showUserMenu)
                    <div class="w-full px-3 minified:px-0">
                        <vibe:dropdown keyboard class="w-full">
                            <x-slot:trigger>
                                <div class="w-full minified:w-fit minified:mx-auto minified:rounded-full flex items-center justify-between p-3 rounded-lg bg-muted/50 text-sidebar-foreground border border-sidebar-border hover:bg-muted group cursor-pointer minified:p-0 minified:border-none">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <div class="relative flex shrink-0">
                                            <vibe:avatar size="sm" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=64&h=64&auto=format&fit=crop" alt="Masum Parvej" />
                                            <span class="absolute minified:hidden bottom-0 right-0 size-2 bg-emerald-500 rounded-full ring-2 ring-sidebar"></span>
                                        </div>

                                        <div class="flex flex-col text-left min-w-0 minified:hidden">
                                            <span class="text-xs font-semibold text-sidebar-foreground truncate leading-tight">Masum Parvej</span>
                                            <span class="text-[10px] text-muted-foreground truncate leading-tight mt-0.5"><!--email_off-->masum@hugeicons.com<!--/email_off--></span>
                                        </div>
                                    </div>

                                    <div class="shrink-0 minified:hidden ml-1">
                                        <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full text-[9px] font-bold bg-emerald-100 dark:bg-emerald-500/20 text-emerald-800 dark:text-emerald-300 border border-emerald-300/60 dark:border-emerald-500/30">
                                            <svg class="size-2.5 fill-current shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                                            </svg>
                                            PRO
                                        </span>
                                    </div>
                                </div>
                            </x-slot:trigger>

                            <vibe:dropdown.content align="top" width="64" class="max-h-[calc(100vh-6rem)] overflow-y-auto vibe-scrollbar">
                                <div class="flex flex-col gap-0.5">
                                    <vibe:dropdown.item href="#" class="gap-3">
                                        <svg class="size-4 text-muted-foreground shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2 12.204C2 9.915 2 8.771 2.52 7.823c.519-.949 1.467-1.537 3.364-2.715l2-1.241C9.889 2.622 10.892 2 12 2s2.11.622 4.116 1.867l2 1.241c1.897 1.178 2.845 1.766 3.364 2.715C22 8.771 22 9.915 22 12.204v1.521c0 3.901 0 5.851-1.172 7.063C19.657 22 17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.212C2 19.576 2 17.626 2 13.725v-1.521Z" />
                                            <path d="M12 15v3" />
                                        </svg>
                                        Home
                                    </vibe:dropdown.item>
                                    <vibe:dropdown.item href="#" class="gap-3">
                                        <svg class="size-4 text-muted-foreground shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172C21 4.343 21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828C18.657 22 16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172C3 19.657 3 17.771 3 14v-4Z" />
                                            <path d="M8 12h8M8 8h8M8 16h5" />
                                        </svg>
                                        Pages
                                    </vibe:dropdown.item>
                                </div>

                                <vibe:dropdown.divider />

                                <!-- Site settings -->
                                <vibe:dropdown.item href="#" class="gap-3">
                                    <svg class="size-4 text-muted-foreground shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3" />
                                        <path d="M13.765 2.152C13.398 2 12.932 2 12 2c-.932 0-1.398 0-1.765.152a2.6 2.6 0 0 0-1.083.916 3.6 3.6 0 0 1-.143.864c-.02.557-.306 1.074-.79 1.353-.483.279-1.073.268-1.566.008a3.2 3.2 0 0 0-.82-.308 2.6 2.6 0 0 0-1.478.396 6.3 6.3 0 0 0-1.015 1.453c-.466.807-.7 1.21-.752 1.605a2.6 2.6 0 0 0 .396 1.478c.148.193.355.354.676.556.473.297.777.803.777 1.361s-.304 1.064-.777 1.361c-.321.202-.529.363-.676.556a2.6 2.6 0 0 0-.396 1.478c.052.395.286.798.752 1.605.466.807.7 1.21 1.015 1.453a2.6 2.6 0 0 0 1.478.396 3.2 3.2 0 0 0 .82-.308c.493-.26 1.083-.27 1.566.008.483.279.77.796.79 1.353.014.38.05.64.143.864a2.6 2.6 0 0 0 1.083.916C10.602 22 11.068 22 12 22c.932 0 1.398 0 1.765-.152a2.6 2.6 0 0 0 1.083-.916c.092-.224.129-.484.143-.864.02-.557.306-1.074.79-1.353.483-.279 1.073-.268 1.566-.008.336.177.58.276.82.308a2.6 2.6 0 0 0 1.479-.396c.315-.242.549-.646 1.014-1.453.466-.807.7-1.21.752-1.605a2.6 2.6 0 0 0-.396-1.478c-.148-.193-.355-.354-.676-.556a1.6 1.6 0 0 1-.777-1.361c0-.558.304-1.064.777-1.361.321-.202.528-.363.676-.556a2.6 2.6 0 0 0 .396-1.478c-.052-.395-.286-.798-.752-1.605-.465-.807-.7-1.21-1.014-1.453a2.6 2.6 0 0 0-1.479-.396 3.2 3.2 0 0 0-.82.308c-.493.26-1.083.27-1.566-.008-.483-.279-.77-.796-.79-1.353-.014-.38-.05-.64-.143-.864a2.6 2.6 0 0 0-1.083-.916Z" />
                                    </svg>
                                    Site settings
                                </vibe:dropdown.item>

                                <vibe:dropdown.item class="gap-3 flex w-full justify-between items-center" @click.stop="toggleTheme($event)">
                                    <div class="flex items-center gap-3">
                                        <svg class="size-4 text-muted-foreground shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22C17.523 22 22 17.523 22 12c0-.463-.693-.539-.933-.143C19.929 13.74 17.862 15 15.5 15 11.91 15 9 12.09 9 8.5c0-2.362 1.26-4.429 3.143-5.567.396-.24.32-.933-.143-.933C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10Z" />
                                        </svg>
                                        <span>Dark mode</span>
                                    </div>

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

                    <div class="pt-2.5 px-3 minified:px-0 flex items-center justify-between minified:justify-center text-[11px] text-muted-foreground border-t border-sidebar-border/40 mt-2">
                        <span class="font-medium text-xs text-muted-foreground/80 minified:hidden">Vibe UI</span>
                        <span class="font-mono text-[10px] px-1.5 py-0.5 rounded-md bg-muted text-muted-foreground font-semibold border border-sidebar-border/50">v{{ \Teknovate\VibeUi\Vibe::version() }}</span>
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

        <div data-vibe-main-shell class="flex flex-col flex-1 min-w-0 h-full min-h-0 overflow-hidden">
            <div id="{{ $mainScrollId }}" data-vibe-scroll="main" class="flex flex-col flex-1 min-w-0 h-full min-h-0 overflow-y-auto overscroll-y-contain vibe-scrollbar group/docs {{ $isHeaderSticky ? 'has-sticky-header' : '' }}" style="--docs-toc-top: {{ $isHeaderSticky ? '5rem' : '1.5rem' }};">
                <div @if($isHeaderSticky) data-vibe-sticky-header-container @endif>
                    <vibe:header variant="header" :sticky="$isHeaderSticky" data-vibe-layout-header :data-vibe-sticky-header="$isHeaderSticky ? 'true' : null" class="shadow-none border-dashed" :size="$headerSize">
                    <vibe:header.heading class="gap-2 flex items-center min-w-0">
                        <vibe:button variant="ghost" size="icon-md" class="text-muted-foreground hover:text-foreground transition-colors shrink-0" @click.stop="$dispatch('toggle-sheet', '{{ $sidebarId }}')" aria-label="Toggle sidebar menu">
                            <div class="flex items-center justify-center">
                                <svg class="size-5 sidebar-collapsed:hidden sidebar-minified:hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 9L10.5 12L13.5 15" />
                                        <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                                    </g>
                                </svg>
                                <svg class="size-5 hidden sidebar-collapsed:block sidebar-minified:block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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
            </div>

                <main id="vibe-main-content" tabindex="-1" data-vibe-main-content-wrap class="flex-1 min-w-0 w-full outline-none vibe-page-enter">
                    <div data-vibe-main-container class="mx-auto w-full max-w-[1600px] 2xl:max-w-[1800px]">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @if ($showNotifications)
            <x-partials.optional.notification-sheet />
        @endif
    </div>

    @if ($showSearch)
        <x-partials.optional.search-modal />
    @endif

    @isset($modals)
        {{ $modals }}
    @endisset
</x-layouts.base>
