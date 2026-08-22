<x-docs.layouts.base :title="$title">
    <div class="flex min-h-screen overflow-hidden">
        <vibe:sheet id="sidebar-menu" position="left" layout="relative" :resizable="true" behavior="minify" minSize="200" minifiedSize="80" :persist="true">
            <div class="w-full">
                <x-docs.partials.sidebar-menu />
            </div>
        </vibe:sheet>
        <div class="flex flex-col flex-1 w-full">
            <vibe:header class="bg-transparent! border-none!">
                <vibe:header.heading class="gap-2 flex items-center">
                    <vibe:button variant="ghost" class="p-2 text-vibe-600 dark:text-vibe-400 hover:text-black dark:hover:text-white transition-colors" @click="$dispatch('toggle-sheet', 'sidebar-menu')">
                        <div x-data="{
                            state: 'expanded',
                            init() {
                                let s = document.getElementById('sidebar-menu');
                                if (s) {
                                    this.state = s.dataset.state || 'expanded';
                                    new MutationObserver(() => this.state = s.dataset.state)
                                        .observe(s, { attributes: true, attributeFilter: ['data-state'] });
                                }
                            }
                        }" class="flex items-center justify-center">

                            <svg id="sidebar-icon-expanded" x-show="state === 'expanded'" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM9.96967 8.46967C10.2626 8.17678 10.7374 8.17678 11.0303 8.46967L14.0303 11.4697C14.3232 11.7626 14.3232 12.2374 14.0303 12.5303L11.0303 15.5303C10.7374 15.8232 10.2626 15.8232 9.96967 15.5303C9.67678 15.2374 9.67678 14.7626 9.96967 14.4697L12.4393 12L9.96967 9.53033C9.67678 9.23744 9.67678 8.76256 9.96967 8.46967Z" fill="currentColor" />
                            </svg>
                            <svg id="sidebar-icon-minified" x-show="state !== 'expanded'" style="display: none;" class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5" class="solar solar-square-alt-arrow-left-outline">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM14.0303 8.46967C14.3232 8.76256 14.3232 9.23744 14.0303 9.53033L11.5607 12L14.0303 14.4697C14.3232 14.7626 14.3232 15.2374 14.0303 15.5303C13.7374 15.8232 13.2626 15.8232 12.9697 15.5303L9.96967 12.5303C9.67678 12.2374 9.67678 11.7626 9.96967 11.4697L12.9697 8.46967C13.2626 8.17678 13.7374 8.17678 14.0303 8.46967Z" fill="currentColor" />
                            </svg>

                        </div>
                        <script>
                            (function() {
                                let s = document.getElementById('sidebar-menu');
                                if (s && s.getAttribute('data-state') && s.getAttribute('data-state') !== 'expanded') {
                                    document.getElementById('sidebar-icon-expanded').style.display = 'none';
                                    document.getElementById('sidebar-icon-minified').style.display = 'block';
                                }
                            })();
                        </script>
                    </vibe:button>
                </vibe:header.heading>

                <vibe:header.actions>
                    <vibe:dropdown keyboard>
                        <x-slot:trigger>
                            <vibe:avatar size="sm" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Name" class="cursor-pointer" />
                        </x-slot:trigger>

                        <vibe:dropdown.item href="#">Profile</vibe:dropdown.item>

                        <vibe:dropdown.sub label="Settings">
                            <vibe:dropdown.item href="#">Account</vibe:dropdown.item>
                            <vibe:dropdown.item href="#">Privacy</vibe:dropdown.item>
                            <vibe:dropdown.item href="#">Notifications</vibe:dropdown.item>
                        </vibe:dropdown.sub>

                        <vibe:dropdown.divider />
                        <vibe:dropdown.item href="#" class="hover:bg-red-100 focus:bg-red-100 dark:hover:bg-red-900/30 dark:focus:bg-red-900/30 hover:text-red-500! focus:text-red-500!">Logout</vibe:dropdown.item>
                    </vibe:dropdown>
                </vibe:header.actions>
            </vibe:header>
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-docs.layouts.base>
