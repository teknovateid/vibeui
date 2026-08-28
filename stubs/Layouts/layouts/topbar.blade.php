@props(['heading' => config('app.name', 'Vibe UI')])
<x-layouts.base>
    <div class="flex min-h-screen overflow-hidden">
        <div class="flex flex-col flex-1 w-full">
            <section class="bg-white dark:bg-vibe-900 border-b border-vibe-200 dark:border-vibe-800">
                <vibe:header class="border-none max-w-400 mx-auto">
                    <vibe:header.heading>
                        {{ $heading }}
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

                <div class="w-full max-w-7xl mx-auto">
                    <x-partials.topbar-menu class="flex gap-2 flex-row" />
                </div>
            </section>

            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layouts.base>
