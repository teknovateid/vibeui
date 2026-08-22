<x-docs.layouts.base :title="$title">
    <div class="flex min-h-screen overflow-hidden">
        <div class="flex flex-col flex-1 w-full">
            <section class="bg-white dark:bg-vibe-900 border-b border-vibe-200 dark:border-vibe-800">
                <vibe:header class="border-none max-w-400 mx-auto">
                    <vibe:header.heading>
                        {{ $title }}
                    </vibe:header.heading>

                    <vibe:header.actions>
                        <vibe:dropdown>
                            <vibe:dropdown.trigger>
                                <vibe:avatar size="sm" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Name" />
                            </vibe:dropdown.trigger>

                            <vibe:dropdown.items>
                                <vibe:dropdown.item href="#">Profile</vibe:dropdown.item>
                                <vibe:dropdown.item href="#">Settings</vibe:dropdown.item>
                                <vibe:dropdown.item href="#">Logout</vibe:dropdown.item>
                            </vibe:dropdown.items>
                        </vibe:dropdown>

                    </vibe:header.actions>
                </vibe:header>

                <div class="w-full max-w-7xl mx-auto">
                    <x-docs.partials.menu class="flex gap-2 flex-row" />
                </div>
            </section>

            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-docs.layouts.base>
