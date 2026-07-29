<x-layouts.base :title="$title">
    <div class="flex min-h-screen overflow-hidden">
        <x-partials.sidebar />
        <div class="flex flex-col flex-1 w-full">
            <x-partials.header :title="$title" />
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-layouts.base>