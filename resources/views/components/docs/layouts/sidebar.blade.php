@props([
    'headerVariant' => 'sticky',
    'sticky' => true,
])

@php
    $isHeaderSticky = $headerVariant === 'sticky' && $sticky !== false;
@endphp

<x-docs.layouts.base>
    <div class="flex h-screen overflow-hidden relative">
        <vibe:sheet id="sidebar-menu" position="left" layout="relative" class="bg-sidebar text-sidebar-foreground border-r border-sidebar-border absolute md:relative left-0 top-0 bottom-0 shadow-xl md:shadow-none" :resizable="true" behavior="minify" minSize="150" minifiedSize="80" :persist="true">
            <vibe:sheet.header class="flex items-center justify-between minified:justify-center minified:px-0 border-none">
                <div class="flex items-center gap-2 minified:hidden truncate transition-opacity duration-300">
                    <h1 class="text-2xl font-bold truncate">{{ config('app.name') }}</h1>
                    <span class="text-[10px] font-mono font-semibold px-1.5 py-0.5 rounded-md bg-primary/10 text-primary shrink-0">v{{ \Teknovate\VibeUi\Vibe::version() }}</span>
                </div>
                <div class="hidden minified:flex items-center justify-center size-9 rounded-lg bg-muted text-foreground font-bold text-xl shrink-0">
                    {{ substr(config('app.name'), 0, 1) }}
                </div>
                <vibe:button variant="ghost" class="md:hidden p-2 transition-colors block minified:hidden" @click="$dispatch('toggle-sheet', 'sidebar-menu')" aria-label="Toggle sidebar menu">
                    <div class="flex items-center justify-center">
                        <!-- Icon when expanded -->
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 9L10.5 12L13.5 15" />
                                <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                            </g>
                        </svg>
                    </div>
                </vibe:button>
            </vibe:sheet.header>

            <vibe:sheet.content id="sidebar-menu-body" class="pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar">
                <x-docs.partials.sidebar-menu />
            </vibe:sheet.content>

            <vibe:sheet.footer class="px-0 py-3">

                <vibe:nav id="sidebar-footer-nav" {{ $attributes->twMerge(['class' => 'mb-1']) }}>
                    <vibe:nav.history persist class="max-h-30 pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar" />
                </vibe:nav>

                <vibe:dropdown keyboard class="w-full px-3 minified:px-0">
                    <x-slot:trigger>
                        <div class="w-full minified:w-fit minified:mx-auto minified:rounded-full flex items-center justify-between p-3 rounded-lg bg-sidebar-accent/50 text-sidebar-foreground border border-sidebar-border hover:bg-sidebar-accent hover:text-sidebar-accent-foreground group cursor-pointer minified:p-0 minified:border-none">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="relative flex shrink-0 ">
                                    <vibe:avatar size="sm" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=64&h=64&auto=format&fit=crop" alt="Masum Parvej" />
                                    <span class="absolute minified:hidden bottom-0 right-0 size-2 bg-emerald-500 rounded-full ring-2 ring-sidebar"></span>
                                </div>

                                <div class="flex flex-col text-left min-w-0 minified:hidden ">
                                    <span class="text-xs font-semibold text-sidebar-foreground truncate leading-tight">Masum Parvej</span>
                                    <span class="text-[10px] text-muted-foreground truncate leading-tight mt-0.5"><!--email_off-->masum@hugeicons.com<!--/email_off--></span>
                                </div>
                            </div>

                            <div class="shrink-0 minified:hidden ml-1">
                                <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded-full text-[9px] font-bold bg-emerald-100 dark:bg-emerald-500/20 text-emerald-800 dark:text-emerald-300 border border-emerald-300/60 dark:border-emerald-500/30">
                                    <svg class="size-2.5 fill-current shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                                    </svg>
                                    PRO
                                </span>
                            </div>
                        </div>
                    </x-slot:trigger>

                    <vibe:dropdown.content align="top" width="64">
                        <div class="flex flex-col gap-0.5">
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                Home
                            </vibe:dropdown.item>

                            <!-- Pages -->
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                Pages
                            </vibe:dropdown.item>

                            <!-- Active stream -->
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m22 8-6 4 6 4V8Z" />
                                    <rect width="14" height="12" x="2" y="6" rx="2" ry="2" />
                                </svg>
                                Active stream
                            </vibe:dropdown.item>

                            <!-- People -->
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                People
                            </vibe:dropdown.item>
                        </div>

                        <vibe:dropdown.divider />

                        <!-- Site settings -->
                        <vibe:dropdown.item href="#" class="gap-3">
                            <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Site settings
                        </vibe:dropdown.item>


                        <vibe:dropdown.item class="gap-3 flex w-full justify-between items-center" x-data="{
                            isDark: document.documentElement.classList.contains('dark'),
                            toggleTheme(e) {
                                window.VibeTheme ? window.VibeTheme.toggle(e) : document.documentElement.classList.toggle('dark');
                                this.isDark = document.documentElement.classList.contains('dark');
                            }
                        }" @vibe-theme-changed.window="isDark = document.documentElement.classList.contains('dark')" @click.stop="toggleTheme($event)">
                            <div class="flex items-center gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                                </svg>
                                <span>Dark mode</span>
                            </div>

                            <!-- Toggle Switch UI -->
                            <div class="w-8 h-4.5 rounded-full p-0.5 transition-colors duration-200 ease-in-out relative flex items-center" :class="isDark ? 'bg-primary' : 'bg-muted'">
                                <div class="size-3.5 rounded-full bg-background shadow-xs transition-transform duration-200 ease-in-out" :class="isDark ? 'translate-x-3.5' : 'translate-x-0'"></div>
                            </div>
                        </vibe:dropdown.item>

                        <!-- My profile & preferences -->
                        <vibe:dropdown.item href="#" class="gap-3">
                            <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="10" r="3" />
                                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                            </svg>
                            My profile & preferences
                        </vibe:dropdown.item>

                        <!-- Help center -->
                        <vibe:dropdown.item href="#" class="gap-3">
                            <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                <path d="M12 8v3" />
                                <circle cx="12" cy="14" r="0.5" fill="currentColor" />
                            </svg>
                            Help center
                        </vibe:dropdown.item>



                        <div class="pt-2 mt-1 border-t border-border flex items-center justify-between px-2">
                            <vibe:button type="button" variant="ghost" size="sm">
                                Feedback
                            </vibe:button>

                            <vibe:button type="button" class="rounded-full select:bg-red-100 dark:select:bg-red-900/30 select:text-red-500!" variant="ghost" size="sm">
                                Logout
                            </vibe:button>
                        </div>
                    </vibe:dropdown.content>
                </vibe:dropdown>
            </vibe:sheet.footer>

        </vibe:sheet>

        <div id="docs-main-scroll" class="flex flex-col flex-1 min-w-0 h-full overflow-y-auto vibe-scrollbar group/docs {{ $isHeaderSticky ? 'has-sticky-header' : '' }}" style="--docs-toc-top: {{ $isHeaderSticky ? '5rem' : '1.5rem' }};">
            <vibe:header :variant="$isHeaderSticky ? 'sticky' : 'default'" class="bg-header text-header-foreground border-b border-header-border shadow-none" size="sm">
                <vibe:header.heading class="gap-2 flex items-center">
                    <vibe:button variant="ghost" class="p-2 text-muted-foreground hover:text-foreground transition-colors" @click.stop="$dispatch('toggle-sheet', 'sidebar-menu')" aria-label="Toggle sidebar menu">
                        <div class="flex items-center justify-center">
                            <svg class="size-6 sidebar-collapsed:hidden sidebar-minified:hidden" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 9L10.5 12L13.5 15" />
                                    <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                                </g>
                            </svg>
                            <svg class="size-6 hidden sidebar-collapsed:block sidebar-minified:block" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 9L13.5 12L10.5 15" />
                                    <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                                </g>
                            </svg>
                        </div>
                    </vibe:button>
                    <vibe:button type="button" @click="$dispatch('open-modal', 'global-search-modal')" class="md:inline-flex items-center gap-2 px-2.5 py-1.5 text-xs text-muted-foreground rounded-full transition-all duration-200 cursor-pointer mr-0.5" title="Pencarian Cepat (⌘K / Ctrl+K)">
                        <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span class="inline-block font-normal">{{ __('docs/sidebar.search') }}</span>
                        <kbd class="hidden md:inline-flex items-center gap-0.5 text-[10px] font-mono font-medium text-muted-foreground bg-background/80 px-1.5 py-0.5 rounded-full border border-border/80 shadow-2xs">
                            <span class="text-xs">⌘</span>K
                        </kbd>
                    </vibe:button>
                </vibe:header.heading>

                <vibe:header.actions class="items-center h-full relative gap-1.5">
                    <vibe:button variant="ghost" class="p-2 text-muted-foreground hover:text-foreground transition-colors" x-data="{
                        isFullscreen: false,
                        toggleFullscreen() {
                            if (!document.fullscreenElement) {
                                document.documentElement.requestFullscreen().catch(err => console.error(err));
                            } else {
                                if (document.exitFullscreen) {
                                    document.exitFullscreen().catch(err => console.error(err));
                                }
                            }
                        }
                    }" @fullscreenchange.window="isFullscreen = !!document.fullscreenElement" @click="toggleFullscreen()" aria-label="Toggle fullscreen" title="Toggle Fullscreen">

                        <svg x-show="!isFullscreen" class="size-6" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" d="M6 9.99739C6.01447 8.29083 6.10921 7.35004 6.72963 6.72963C7.35004 6.10921 8.29083 6.01447 9.99739 6" />
                                <path stroke-linecap="round" d="M6 14.0007C6.01447 15.7072 6.10921 16.648 6.72963 17.2684C7.35004 17.8888 8.29083 17.9836 9.99739 17.998" />
                                <path stroke-linecap="round" d="M17.9976 9.99739C17.9831 8.29083 17.8883 7.35004 17.2679 6.72963C16.6475 6.10921 15.7067 6.01447 14.0002 6" />
                                <path stroke-linecap="round" d="M17.9976 14.0007C17.9831 15.7072 17.8883 16.648 17.2679 17.2684C16.6475 17.8888 15.7067 17.9836 14.0002 17.998" />
                                <path d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" opacity=".5" />
                            </g>
                        </svg>


                        <svg x-show="isFullscreen" class="size-6" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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

                    <vibe:button variant="ghost" class="p-2 text-muted-foreground hover:text-foreground transition-colors" @click.stop="$dispatch('toggle-sheet', 'notification-sheet')" aria-label="Toggle notifications" title="Notifications">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M18.7491 9.70957V9.00496C18.7491 5.13623 15.7274 2 12 2C8.27256 2 5.25087 5.13623 5.25087 9.00496V9.70957C5.25087 10.5552 5.00972 11.3818 4.5578 12.0854L3.45036 13.8095C2.43882 15.3843 3.21105 17.5249 4.97036 18.0229C9.57274 19.3257 14.4273 19.3257 19.0296 18.0229C20.789 17.5249 21.5612 15.3843 20.5496 13.8095L19.4422 12.0854C18.9903 11.3818 18.7491 10.5552 18.7491 9.70957Z" />
                                <path stroke-linecap="round" d="M7.5 19C8.15503 20.7478 9.92246 22 12 22C14.0775 22 15.845 20.7478 16.5 19" opacity=".5" />
                            </g>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 size-2 bg-red-500 rounded-full ring-2 ring-background"></span>
                    </vibe:button>

                    {{-- <div class="h-[80%] w-px bg-border" role="separator"></div> --}}
                </vibe:header.actions>
            </vibe:header>
            <main class="flex-1 p-4 min-w-0 w-full vibe-page-enter">
                {{ $slot }}
            </main>
        </div>

        <x-docs.partials.optional.notification-sheet />
    </div>

    <x-docs.partials.optional.search-modal />
</x-docs.layouts.base>
