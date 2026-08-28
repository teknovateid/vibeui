@props(['title' => config('app.name', 'Vibe UI')])
<x-layouts.base :title="$title">
    <div class="flex h-screen overflow-hidden relative">
        <vibe:sheet id="sidebar-menu" position="left" layout="relative" class="absolute md:relative left-0 top-0 bottom-0 shadow-xl md:shadow-none" :resizable="true" behavior="minify" minSize="200" minifiedSize="80" :persist="true">
            <vibe:sheet.header class="flex items-center justify-between minified:justify-center px-3 py-2.5 border-none">
                <h1 class="text-2xl font-bold block minified:hidden truncate transition-opacity duration-300">{{ config('app.name') }}</h1>
                <div class="hidden minified:flex items-center justify-center size-9 rounded-lg bg-vibe-200 dark:bg-vibe-800 font-bold text-xl">
                    {{ substr(config('app.name'), 0, 1) }}
                </div>
                <vibe:button variant="ghost" class="p-2 transition-colors block minified:hidden" @click="$dispatch('toggle-sheet', 'sidebar-menu')">
                    <div class="flex items-center justify-center">
                        <!-- Icon when expanded -->
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM9.96967 8.46967C10.2626 8.17678 10.7374 8.17678 11.0303 8.46967L14.0303 11.4697C14.3232 11.7626 14.3232 12.2374 14.0303 12.5303L11.0303 15.5303C10.7374 15.8232 10.2626 15.8232 9.96967 15.5303C9.67678 15.2374 9.67678 14.7626 9.96967 14.4697L12.4393 12L9.96967 9.53033C9.67678 9.23744 9.67678 8.76256 9.96967 8.46967Z" fill="currentColor" />
                        </svg>
                    </div>
                </vibe:button>
            </vibe:sheet.header>

            <vibe:sheet.body class="px-3">
                <x-partials.sidebar-menu />
            </vibe:sheet.body>

            <vibe:sheet.footer class="p-3 minified:p-2 flex justify-center">
                <div class="flex bg-vibe-200 dark:bg-vibe-800 p-4 w-full minified:p-0 minified:size-9 rounded-lg"></div>
            </vibe:sheet.footer>

        </vibe:sheet>
        

        <div class="flex flex-col flex-1 min-w-0 h-full overflow-y-auto">
            <vibe:header class="bg-transparent! border-none!" size="sm">
                <vibe:header.heading class="gap-2 flex items-center">
                    <vibe:button variant="ghost"
                        class="p-2 hidden sidebar-minified:block sidebar-collapsed:block text-vibe-600 dark:text-vibe-400 hover:text-vibe-950 dark:hover:text-vibe-50 transition-colors" 
                        @click.stop="$dispatch('toggle-sheet', 'sidebar-menu')">
                        <div class="flex items-center justify-center">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9426 1.25H12.0574C14.3658 1.24999 16.1748 1.24998 17.5863 1.43975C19.031 1.63399 20.1711 2.03933 21.0659 2.93414C21.9607 3.82895 22.366 4.96897 22.5603 6.41371C22.75 7.82519 22.75 9.63423 22.75 11.9426V12.0574C22.75 14.3658 22.75 16.1748 22.5603 17.5863C22.366 19.031 21.9607 20.1711 21.0659 21.0659C20.1711 21.9607 19.031 22.366 17.5863 22.5603C16.1748 22.75 14.3658 22.75 12.0574 22.75H11.9426C9.63423 22.75 7.82519 22.75 6.41371 22.5603C4.96897 22.366 3.82895 21.9607 2.93414 21.0659C2.03933 20.1711 1.63399 19.031 1.43975 17.5863C1.24998 16.1748 1.24999 14.3658 1.25 12.0574V11.9426C1.24999 9.63423 1.24998 7.82519 1.43975 6.41371C1.63399 4.96897 2.03933 3.82895 2.93414 2.93414C3.82895 2.03933 4.96897 1.63399 6.41371 1.43975C7.82519 1.24998 9.63423 1.24999 11.9426 1.25ZM6.61358 2.92637C5.33517 3.09825 4.56445 3.42514 3.9948 3.9948C3.42514 4.56445 3.09825 5.33517 2.92637 6.61358C2.75159 7.91356 2.75 9.62177 2.75 12C2.75 14.3782 2.75159 16.0864 2.92637 17.3864C3.09825 18.6648 3.42514 19.4355 3.9948 20.0052C4.56445 20.5749 5.33517 20.9018 6.61358 21.0736C7.91356 21.2484 9.62177 21.25 12 21.25C14.3782 21.25 16.0864 21.2484 17.3864 21.0736C18.6648 20.9018 19.4355 20.5749 20.0052 20.0052C20.5749 19.4355 20.9018 18.6648 21.0736 17.3864C21.2484 16.0864 21.25 14.3782 21.25 12C21.25 9.62177 21.2484 7.91356 21.0736 6.61358C20.9018 5.33517 20.5749 4.56445 20.0052 3.9948C19.4355 3.42514 18.6648 3.09825 17.3864 2.92637C16.0864 2.75159 14.3782 2.75 12 2.75C9.62177 2.75 7.91356 2.75159 6.61358 2.92637ZM14.0303 8.46967C14.3232 8.76256 14.3232 8.76256 14.0303 8.46967L11.5607 12L14.0303 14.4697C14.3232 14.7626 14.3232 15.2374 14.0303 15.5303C13.7374 15.8232 13.2626 15.8232 12.9697 15.5303L9.96967 12.5303C9.67678 12.2374 9.67678 11.7626 9.96967 11.4697L12.9697 8.46967C13.2626 8.17678 13.7374 8.17678 14.0303 8.46967Z" fill="currentColor" />
                            </svg>
                        </div>
                    </vibe:button>
                </vibe:header.heading>

                <vibe:header.actions class="items-center h-full relative">

                    <vibe:button variant="ghost" class="p-2 rounded-full" @click.stop="$dispatch('toggle-sheet', 'notification-sheet')">
                        <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="1.5" class="solar solar-bell-outline">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.25C7.71983 1.25 4.25004 4.71979 4.25004 9V9.7041C4.25004 10.401 4.04375 11.0824 3.65717 11.6622L2.50856 13.3851C1.17547 15.3848 2.19318 18.1028 4.51177 18.7351C5.26738 18.9412 6.02937 19.1155 6.79578 19.2581L6.79768 19.2632C7.56667 21.3151 9.62198 22.75 12 22.75C14.378 22.75 16.4333 21.3151 17.2023 19.2632L17.2042 19.2581C17.9706 19.1155 18.7327 18.9412 19.4883 18.7351C21.8069 18.1028 22.8246 15.3848 21.4915 13.3851L20.3429 11.6622C19.9563 11.0824 19.75 10.401 19.75 9.7041V9C19.75 4.71979 16.2802 1.25 12 1.25ZM15.3764 19.537C13.1335 19.805 10.8664 19.8049 8.62349 19.5369C9.33444 20.5585 10.571 21.25 12 21.25C13.4289 21.25 14.6655 20.5585 15.3764 19.537ZM5.75004 9C5.75004 5.54822 8.54826 2.75 12 2.75C15.4518 2.75 18.25 5.54822 18.25 9V9.7041C18.25 10.6972 18.544 11.668 19.0948 12.4943L20.2434 14.2172C21.0086 15.3649 20.4245 16.925 19.0936 17.288C14.4494 18.5546 9.5507 18.5546 4.90644 17.288C3.57561 16.925 2.99147 15.3649 3.75664 14.2172L4.90524 12.4943C5.45609 11.668 5.75004 10.6972 5.75004 9.7041V9Z" fill="currentColor" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 size-2 bg-red-500 rounded-full ring-2 ring-vibe-50 dark:ring-vibe-950"></span>
                    </vibe:button>


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
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>

        <vibe:sheet id="notification-sheet" position="right" layout="absolute" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :persist="true">
            <vibe:sheet.header class="flex items-center justify-between p-4">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm text-vibe-950 dark:text-vibe-50">Notifikasi</span>
                    <span class="text-[10px] font-medium bg-vibe-200 dark:bg-vibe-800 text-vibe-800 dark:text-vibe-200 px-2 py-0.5 rounded-full">3 Baru</span>
                </div>
                <vibe:sheet.close />
            </vibe:sheet.header>

            <vibe:sheet.body class="p-2 divide-y divide-vibe-200 dark:divide-vibe-800">
                <!-- Notification Item 1 -->
                <div class="p-3 rounded-lg hover:bg-vibe-200/50 dark:hover:bg-vibe-800/50 transition-colors cursor-pointer flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-xs text-vibe-900 dark:text-vibe-100 flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-vibe-600 dark:bg-vibe-400"></span>
                            Pembaruan Sistem
                        </span>
                        <span class="text-[10px] text-vibe-400">2 menit lalu</span>
                    </div>
                    <p class="text-xs text-vibe-600 dark:text-vibe-400 pl-3.5">
                        Vibe UI versi terbaru telah aktif dengan fitur dan peningkatan performa.
                    </p>
                </div>

                <!-- Notification Item 2 -->
                <div class="p-3 rounded-lg hover:bg-vibe-200/50 dark:hover:bg-vibe-800/50 transition-colors cursor-pointer flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-xs text-vibe-900 dark:text-vibe-100 flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-green-500"></span>
                            Pengguna Baru
                        </span>
                        <span class="text-[10px] text-vibe-400">1 jam lalu</span>
                    </div>
                    <p class="text-xs text-vibe-600 dark:text-vibe-400 pl-3.5">
                        Pengguna baru baru saja mendaftarkan akun di sistem.
                    </p>
                </div>

                <!-- Notification Item 3 -->
                <div class="p-3 rounded-lg hover:bg-vibe-200/50 dark:hover:bg-vibe-800/50 transition-colors cursor-pointer flex flex-col gap-1">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-xs text-vibe-900 dark:text-vibe-100 flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-amber-500"></span>
                            Backup Selesai
                        </span>
                        <span class="text-[10px] text-vibe-400">3 jam lalu</span>
                    </div>
                    <p class="text-xs text-vibe-600 dark:text-vibe-400 pl-3.5">
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
</x-docs.layouts.base>
