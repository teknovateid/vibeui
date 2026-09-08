@props([
    'headerVariant' => 'default',
    'sticky' => false,
])

@php
    $isHeaderSticky = ($headerVariant === 'sticky') && ($sticky !== false);
@endphp

<x-layouts.base>
    <div class="flex h-screen overflow-hidden relative">
        <vibe:sheet id="sidebar-menu" position="left" layout="relative" class="absolute md:relative left-0 top-0 bottom-0 shadow-xl md:shadow-none" :resizable="true" behavior="minify" minSize="200" minifiedSize="80" :persist="true">
            <vibe:sheet.header class="flex items-center justify-between minified:justify-center minified:px-0 border-none">
                <h1 class="text-2xl font-bold block minified:hidden truncate transition-opacity duration-300">{{ config('app.name') }}</h1>
                <div class="hidden minified:flex items-center justify-center size-9 rounded-lg bg-muted text-foreground font-bold text-xl shrink-0">
                    {{ substr(config('app.name'), 0, 1) }}
                </div>
                <vibe:button variant="ghost" class="p-2 transition-colors block minified:hidden" @click="$dispatch('toggle-sheet', 'sidebar-menu')" aria-label="Toggle sidebar menu">
                    <div class="flex items-center justify-center">
                        <!-- Icon when expanded -->
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C2.05749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM14.0303 8.46967C14.3232 8.76256 14.3232 8.76256 14.0303 8.46967L11.5607 12L14.0303 14.4697C14.3232 14.7626 14.3232 15.2374 14.0303 15.5303C13.7374 15.8232 13.2626 15.8232 12.9697 15.5303L9.96967 12.5303C9.67678 12.2374 9.67678 11.7626 9.96967 11.4697L12.9697 8.46967C13.2626 8.17678 13.7374 8.17678 14.0303 8.46967Z" fill="currentColor" />
                        </svg>
                    </div>
                </vibe:button>
            </vibe:sheet.header>

            <vibe:sheet.body id="sidebar-menu-body" class="pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar">
                <x-partials.sidebar-classic-menu />
            </vibe:sheet.body>

            <vibe:sheet.footer class="px-0 py-3">

                <vibe:nav id="sidebar-footer-nav" {{ $attributes->twMerge(['class' => 'mb-1']) }}>
                    <vibe:nav.history persist class="max-h-30 pl-3 pr-1.5 minified:px-0 overflow-y-auto overflow-x-hidden vibe-scrollbar" />
                </vibe:nav>

                <vibe:dropdown keyboard class="w-full px-3 minified:px-0">
                    <x-slot:trigger>
                        <div class="w-full minified:w-fit minified:mx-auto minified:rounded-full flex items-center justify-between p-3 rounded-lg bg-card text-card-foreground border border-border hover:bg-accent hover:text-accent-foreground group cursor-pointer minified:p-0 minified:border-none">
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="relative flex shrink-0 ">
                                    <vibe:avatar size="sm" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=64&h=64&auto=format&fit=crop" alt="Masum Parvej" />
                                    <span class="absolute minified:hidden bottom-0 right-0 size-2 bg-emerald-500 rounded-full ring-2 ring-background"></span>
                                </div>

                                <div class="flex flex-col text-left min-w-0 minified:hidden ">
                                    <span class="text-xs font-semibold text-foreground truncate leading-tight">Masum Parvej</span>
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

                    <vibe:dropdown.body align="top" width="64">
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
                    </vibe:dropdown.body>
                </vibe:dropdown>
            </vibe:sheet.footer>

        </vibe:sheet>

        <div id="docs-main-scroll" 
             class="flex flex-col flex-1 min-w-0 h-full overflow-y-auto vibe-scrollbar group/docs {{ $isHeaderSticky ? 'has-sticky-header' : '' }}"
             style="--docs-toc-top: {{ $isHeaderSticky ? '5rem' : '1.5rem' }};">
            <vibe:header :variant="$isHeaderSticky ? 'sticky' : 'default'" size="sm" class="{{ $isHeaderSticky ? '' : 'bg-transparent! border-none' }}" x-data>
                <vibe:header.heading class="gap-2 flex items-center">
                    <vibe:button variant="ghost" class="p-2 hidden sidebar-minified:block sidebar-collapsed:block text-muted-foreground hover:text-foreground transition-colors" @click.stop="$dispatch('toggle-sheet', 'sidebar-menu')" aria-label="Toggle sidebar menu">
                        <div class="flex items-center justify-center">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C2.05749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM14.0303 8.46967C14.3232 8.76256 14.3232 8.76256 14.0303 8.46967L11.5607 12L14.0303 14.4697C14.3232 14.7626 14.3232 15.2374 14.0303 15.5303C13.7374 15.8232 13.2626 15.8232 12.9697 15.5303L9.96967 12.5303C9.67678 12.2374 9.67678 11.7626 9.96967 11.4697L12.9697 8.46967C13.2626 8.17678 13.7374 8.17678 14.0303 8.46967Z" fill="currentColor" />
                            </svg>
                        </div>
                    </vibe:button>
                </vibe:header.heading>

                <vibe:header.actions class="items-center h-full relative gap-1.5">

                    <!-- Language Switcher -->
                    <div class="flex items-center rounded-lg border border-border bg-muted/40 p-0.5 text-xs font-medium">
                        <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'id') }}" class="px-2 py-1 rounded-md transition-all {{ app()->getLocale() === 'id' ? 'bg-background text-foreground shadow-xs font-bold' : 'text-muted-foreground hover:text-foreground' }}">
                            ID
                        </vibe:button>
                        <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'en') }}" class="px-2 py-1 rounded-md transition-all {{ app()->getLocale() === 'en' ? 'bg-background text-foreground shadow-xs font-bold' : 'text-muted-foreground hover:text-foreground' }}">
                            EN
                        </vibe:button>
                    </div>

                    <vibe:button variant="ghost" class="p-2 relative rounded-full" x-data="{
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
                        <svg x-show="!isFullscreen" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h6v6" />
                            <path d="M9 21H3v-6" />
                            <path d="M21 3l-7 7" />
                            <path d="M3 21l7-7" />
                        </svg>
                        <svg x-show="isFullscreen" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                            <path d="M4 14h6v6" />
                            <path d="M20 10h-6V4" />
                            <path d="M14 10l7-7" />
                            <path d="M10 14l-7 7" />
                        </svg>
                    </vibe:button>

                    <vibe:button variant="ghost" class="p-2 relative rounded-full" @click.stop="$dispatch('toggle-sheet', 'notification-sheet')" aria-label="Toggle notifications" title="Notifications">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5" class="solar solar-bell-outline">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C7.71983 1.25 4.25004 4.71979 4.25004 9V9.7041C4.25004 10.401 4.04375 11.0824 3.65717 11.6622L2.50856 13.3851C1.17547 15.3848 2.19318 18.1028 4.51177 18.7351C5.26738 18.9412 6.02937 19.1155 6.79578 19.2581L6.79768 19.2632C7.56667 21.3151 9.62198 22.75 12 22.75C14.378 22.75 16.4333 21.3151 17.2023 19.2632L17.2042 19.2581C17.9706 19.1155 18.7327 18.9412 19.4883 18.7351C21.8069 18.1028 22.8246 15.3848 21.4915 13.3851L20.3429 11.6622C19.9563 11.0824 19.75 10.401 19.75 9.7041V9C19.75 4.71979 16.2802 1.25 12 1.25ZM15.3764 19.537C13.1335 19.805 10.8664 19.8049 8.62349 19.5369C9.33444 20.5585 10.571 21.25 12 21.25C13.4289 21.25 14.6655 20.5585 15.3764 19.537ZM5.75004 9C5.75004 5.54822 8.54826 2.75 12 2.75C15.4518 2.75 18.25 5.54822 18.25 9V9.7041C18.25 10.6972 18.544 11.668 19.0948 12.4943L20.2434 14.2172C21.0086 15.3649 20.4245 16.925 19.0936 17.288C14.4494 18.5546 9.5507 18.5546 4.90644 17.288C3.57561 16.925 2.99147 15.3649 3.75664 14.2172L4.90524 12.4943C5.45609 11.668 5.75004 10.6972 5.75004 9.7041V9Z" fill="currentColor" />
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

        <vibe:sheet id="notification-sheet" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" persist>
            <vibe:sheet.header class="flex items-center justify-between p-4">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm text-foreground">{{ __('docs/sidebar.notifications.title') }}</span>
                    <span class="text-[10px] font-medium bg-muted text-muted-foreground px-2 py-0.5 rounded-full">{{ __('docs/sidebar.notifications.new', ['count' => 3]) }}</span>
                </div>
                <vibe:sheet.close />
            </vibe:sheet.header>

            <vibe:sheet.body class="p-2 divide-y divide-border">
                <!-- Notification Item 1 -->
                <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-primary"></span>
                            Pembaruan Sistem
                        </span>
                        <span class="text-[10px] text-muted-foreground">2 menit lalu</span>
                    </div>
                    <p class="text-xs text-muted-foreground pl-3.5">
                        Vibe UI versi terbaru telah aktif dengan fitur dan peningkatan performa.
                    </p>
                </div>

                <!-- Notification Item 2 -->
                <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-green-500"></span>
                            Pengguna Baru
                        </span>
                        <span class="text-[10px] text-muted-foreground">1 jam lalu</span>
                    </div>
                    <p class="text-xs text-muted-foreground pl-3.5">
                        Pengguna baru baru saja mendaftarkan akun di sistem.
                    </p>
                </div>

                <!-- Notification Item 3 -->
                <div class="p-3 rounded-lg hover:bg-accent/60 transition-colors cursor-pointer flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-xs text-foreground flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-amber-500"></span>
                            Backup Selesai
                        </span>
                        <span class="text-[10px] text-muted-foreground">3 jam lalu</span>
                    </div>
                    <p class="text-xs text-muted-foreground pl-3.5">
                        Backup harian database telah berhasil disimpan dengan aman.
                    </p>
                </div>
            </vibe:sheet.body>

            <vibe:sheet.footer class="p-3">
                <vibe:button variant="outline" size="sm" class="w-full text-xs">
                    Tandai Semua Sudah Dibaca
                </vibe:button>
            </vibe:sheet.footer>
        </vibe:sheet>
    </div>
</x-layouts.base>
