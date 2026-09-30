@props([
    'headerVariant' => 'sticky',
    'sticky' => true,
])

@php
    $isHeaderSticky = $headerVariant === 'sticky' && $sticky !== false;
@endphp

<x-layouts.base>
    <div class="flex h-screen overflow-hidden relative">
        <vibe:sheet variant="sidebar" id="sidebar-menu" position="left" layout="relative" class="absolute md:relative left-0 top-0 bottom-0 z-60 md:z-auto shadow-xl md:shadow-none" :resizable="true" behavior="minify" minSize="150" minifiedSize="80" :persist="true">
            <vibe:sheet.header class="flex items-center justify-between minified:justify-center minified:px-0 border-dashed">
                <h1 class="text-2xl font-bold block minified:hidden truncate transition-opacity duration-300">{{ config('app.name') }}</h1>
                <div class="hidden minified:flex items-center justify-center size-8 rounded-md p-1.5 bg-muted text-foreground font-bold text-xl shrink-0">
                    <img src="{{ asset('vibe/logo/logo.svg') }}" class="aspect-square size-full" alt="VibeUI Logo">
                </div>
                <vibe:button variant="ghost" class="md:hidden p-1.5 size-8 transition-colors block minified:hidden" @click="$dispatch('toggle-sheet', 'sidebar-menu')" aria-label="Toggle sidebar menu">
                    <div class="flex items-center justify-center">
                        <!-- Icon when expanded -->
                        <svg class="size-full" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
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
                <x-partials.sidebar-menu />
            </vibe:sheet.content>

            <vibe:sheet.footer class="px-0 py-3 border-dashed">

                <vibe:nav id="sidebar-footer-nav" {{ $attributes->twMerge(['class' => 'mb-1']) }}>
                    <vibe:nav.history persist class="max-h-30 pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar" />
                </vibe:nav>

                <div class="w-full px-3 minified:px-0">
                    <vibe:dropdown keyboard class="w-full">
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

                        <vibe:dropdown.content align="top" width="64" class="max-h-[calc(100vh-6rem)] overflow-y-auto vibe-scrollbar">
                        <div class="flex flex-col gap-0.5">
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12.204C2 9.915 2 8.771 2.52 7.823c.519-.949 1.467-1.537 3.364-2.715l2-1.241C9.889 2.622 10.892 2 12 2s2.11.622 4.116 1.867l2 1.241c1.897 1.178 2.845 1.766 3.364 2.715C22 8.771 22 9.915 22 12.204v1.521c0 3.901 0 5.851-1.172 7.063C19.657 22 17.771 22 14 22h-4c-3.771 0-5.657 0-6.828-1.212C2 19.576 2 17.626 2 13.725v-1.521Z" />
                                    <path d="M12 15v3" />
                                </svg>
                                Home
                            </vibe:dropdown.item>

                            <!-- Pages -->
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 10c0-3.771 0-5.657 1.172-6.828C5.343 2 7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172C21 4.343 21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828C18.657 22 16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172C3 19.657 3 17.771 3 14v-4Z" />
                                    <path d="M8 12h8M8 8h8M8 16h5" />
                                </svg>
                                Pages
                            </vibe:dropdown.item>

                            <!-- Active stream -->
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m17 9.5.658-.329c1.946-.973 2.92-1.46 3.63-.42.712.44.712 1.527.712 3.703v.292c0 2.176 0 3.263-.712 3.703-.711.44-1.684-.047-3.63-1.02L17 14.5V9.5Z" />
                                    <circle cx="12.5" cy="8.5" r="1.5" />
                                    <path d="M2 11.5c0-3.288 0-4.931.908-6.038.166-.202.352-.388.554-.554C4.569 4 6.213 4 9.5 4c3.288 0 4.931 0 6.038.908.202.166.388.352.554.554.908 1.107.908 2.75.908 6.038v1c0 3.288 0 4.931-.908 6.038a4.8 4.8 0 0 1-.554.554C14.431 20 12.788 20 9.5 20c-3.288 0-4.931 0-6.038-.908a4.8 4.8 0 0 1-.554-.554C2 17.431 2 15.788 2 12.5v-1Z" />
                                </svg>
                                Active stream
                            </vibe:dropdown.item>

                            <!-- People -->
                            <vibe:dropdown.item href="#" class="gap-3">
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="6" r="4" />
                                    <path d="M15 9a4 4 0 0 0 3-3 4 4 0 0 0-3-3" />
                                    <ellipse cx="9" cy="17" rx="7" ry="4" />
                                    <path d="M18 14c1.754.385 3 1.359 3 2.5 0 1.03-.986 1.923-2.47 2.37" />
                                </svg>
                                People
                            </vibe:dropdown.item>
                        </div>

                        <vibe:dropdown.divider />

                        <!-- Site settings -->
                        <vibe:dropdown.item href="#" class="gap-3">
                            <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M13.765 2.152C13.398 2 12.932 2 12 2c-.932 0-1.398 0-1.765.152a2.6 2.6 0 0 0-1.083.916 3.6 3.6 0 0 1-.143.864c-.02.557-.306 1.074-.79 1.353-.483.279-1.073.268-1.566.008a3.2 3.2 0 0 0-.82-.308 2.6 2.6 0 0 0-1.478.396 6.3 6.3 0 0 0-1.015 1.453c-.466.807-.7 1.21-.752 1.605a2.6 2.6 0 0 0 .396 1.478c.148.193.355.354.676.556.473.297.777.803.777 1.361s-.304 1.064-.777 1.361c-.321.202-.529.363-.676.556a2.6 2.6 0 0 0-.396 1.478c.052.395.286.798.752 1.605.466.807.7 1.21 1.015 1.453a2.6 2.6 0 0 0 1.478.396 3.2 3.2 0 0 0 .82-.308c.493-.26 1.083-.27 1.566.008.483.279.77.796.79 1.353.014.38.05.64.143.864a2.6 2.6 0 0 0 1.083.916C10.602 22 11.068 22 12 22c.932 0 1.398 0 1.765-.152a2.6 2.6 0 0 0 1.083-.916c.092-.224.129-.484.143-.864.02-.557.306-1.074.79-1.353.483-.279 1.073-.268 1.566-.008.336.177.58.276.82.308a2.6 2.6 0 0 0 1.479-.396c.315-.242.549-.646 1.014-1.453.466-.807.7-1.21.752-1.605a2.6 2.6 0 0 0-.396-1.478c-.148-.193-.355-.354-.676-.556a1.6 1.6 0 0 1-.777-1.361c0-.558.304-1.064.777-1.361.321-.202.528-.363.676-.556a2.6 2.6 0 0 0 .396-1.478c-.052-.395-.286-.798-.752-1.605-.465-.807-.7-1.21-1.014-1.453a2.6 2.6 0 0 0-1.479-.396 3.2 3.2 0 0 0-.82.308c-.493.26-1.083.27-1.566-.008-.483-.279-.77-.796-.79-1.353-.014-.38-.05-.64-.143-.864a2.6 2.6 0 0 0-1.083-.916Z" />
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
                                <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22C17.523 22 22 17.523 22 12c0-.463-.693-.539-.933-.143C19.929 13.74 17.862 15 15.5 15 11.91 15 9 12.09 9 8.5c0-2.362 1.26-4.429 3.143-5.567.396-.24.32-.933-.143-.933C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10Z" />
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
                            <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="9" r="3" />
                                <circle cx="12" cy="12" r="10" />
                                <path d="M17.969 20C17.81 17.109 16.925 15 12 15s-5.81 2.109-5.969 5" />
                            </svg>
                            My profile & preferences
                        </vibe:dropdown.item>

                        <!-- Help center -->
                        <vibe:dropdown.item href="#" class="gap-3">
                            <svg class="size-4 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M10.125 8.875A1.875 1.875 0 0 1 12 7c1.036 0 1.875.84 1.875 1.875 0 .687-.37 1.288-.922 1.615-.475.281-.953.708-.953 1.26V13" />
                                <circle cx="12" cy="16" r=".5" fill="currentColor" />
                            </svg>
                            Help center
                        </vibe:dropdown.item>



                        <div class="pt-2 mt-1 border-t border-border flex items-center justify-between px-2">
                            <vibe:button type="button" variant="ghost" size="sm">
                                Feedback
                            </vibe:button>

                            <vibe:button type="button" class="rounded-full text-destructive hover:bg-destructive/10 hover:text-destructive" variant="ghost" size="sm">
                                Logout
                            </vibe:button>
                        </div>
                    </vibe:dropdown.content>
                </vibe:dropdown>
                </div>

                <div class="pt-2.5 px-3 minified:px-0 flex items-center justify-between minified:justify-center text-[11px] text-muted-foreground border-t border-sidebar-border/40 mt-2">
                    <span class="font-medium text-xs text-muted-foreground/80 minified:hidden">Vibe UI</span>
                    <span class="font-mono text-[10px] px-1.5 py-0.5 rounded-md bg-sidebar-accent/60 text-muted-foreground font-semibold border border-sidebar-border/50">v{{ \Teknovate\VibeUi\Vibe::version() }}</span>
                </div>
            </vibe:sheet.footer>

        </vibe:sheet>

        {{-- Mobile Backdrop for Sidebar --}}
        <div
            x-data="{
                isOpen: false,
                checkState() {
                    let el = document.getElementById('sidebar-menu');
                    this.isOpen = el && el.getAttribute('data-state') === 'expanded' && window.innerWidth < 768;
                }
            }"
            x-init="
                checkState();
                let obs = new MutationObserver(() => checkState());
                let el = document.getElementById('sidebar-menu');
                if (el) obs.observe(el, { attributes: true, attributeFilter: ['data-state'] });
            "
            @resize.window="checkState()"
            @open-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === 'sidebar-menu' && window.innerWidth < 768) isOpen = true;"
            @close-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === 'sidebar-menu' || t === '*' || !t) isOpen = false;"
            @toggle-sheet.window="let d = $event.detail; let t = Array.isArray(d) ? d[0] : (typeof d === 'object' && d !== null ? Object.values(d)[0] : d); if (t === 'sidebar-menu') { setTimeout(() => checkState(), 60); }"
            x-show="isOpen"
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-xs z-55 md:hidden"
            aria-hidden="true"
            @click="$dispatch('close-sheet', 'sidebar-menu')"
            style="display: none;"
        ></div>

        <div id="docs-main-scroll" class="flex flex-col flex-1 min-w-0 h-full overflow-y-auto vibe-scrollbar group/docs {{ $isHeaderSticky ? 'has-sticky-header' : '' }}" style="--docs-toc-top: {{ $isHeaderSticky ? '5rem' : '1.5rem' }};">
            <vibe:header variant="header" :sticky="$isHeaderSticky" class="shadow-none border-dashed" size="sm">
                <vibe:header.heading class="gap-2 flex items-center min-w-0">
                    <vibe:button variant="ghost" class="p-2 text-muted-foreground hover:text-foreground transition-colors shrink-0" @click.stop="$dispatch('toggle-sheet', 'sidebar-menu')" aria-label="Toggle sidebar menu">
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
                </vibe:header.heading>

                <vibe:header.actions class="items-center h-full relative gap-1.5 shrink-0">
                    <vibe:button variant="ghost" class="p-2 md:hidden text-muted-foreground hover:text-foreground transition-colors" @click="$dispatch('open-modal', 'global-search-modal')" aria-label="Search">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11.5" cy="11.5" r="9.5" />
                            <path d="M18.5 18.5L22 22" />
                        </svg>
                    </vibe:button>
                    <vibe:button variant="default" type="button" @click="$dispatch('open-modal', 'global-search-modal')" class="hidden md:inline-flex items-center gap-2 px-2.5 py-1.5 text-xs text-muted-foreground rounded-full transition-all duration-200 cursor-pointer mr-0.5" title="Pencarian Cepat (⌘K / Ctrl+K)">
                        <svg class="size-3.5 text-muted-foreground shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11.5" cy="11.5" r="9.5" />
                            <path d="M18.5 18.5L22 22" />
                        </svg>
                        <span class="inline-block font-normal">{{ __('docs/sidebar.search') }}</span>
                        <kbd class="hidden md:inline-flex items-center gap-0.5 text-[10px] font-mono font-medium text-muted-foreground bg-background/80 px-1.5 py-0.5 rounded-full border border-border/80 shadow-2xs">
                            <span class="text-xs">⌘</span>K
                        </kbd>
                    </vibe:button>
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
            <main class="flex-1 px-4 py-8 min-w-0 w-full vibe-page-enter">
                <div class="mx-auto w-full max-w-[1600px] 2xl:max-w-[1800px]">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <x-partials.optional.notification-sheet />
    </div>

    <x-partials.optional.search-modal />
</x-layouts.base>
