<section  x-data="{
    confirmDelete(id) {
        $dispatch('alert', {
            type: 'confirm',
            title: 'Konfirmasi Hapus',
            message: 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
            confirmButton: {
                text: 'Ya, Hapus',
                class: 'inline-flex justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 transition-colors',
                action: () => {
                    $wire.delete(id);
                }
            },
            closeButton: {
                text: 'Batal',
                action: () => vibeToast({
                    type: 'info',
                    message: 'Dibatalkan!'
                })
            },
            position: 'top-center',
            sound: '{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}'
        });
    }
}">

    <vibe:breadcrumb title="{{ (new \ReflectionClass($this))->getAttributes(\Livewire\Attributes\Title::class)[0]?->getArguments()[0] ?? 'Default Title' }}" class="mb-6">
        <vibe:breadcrumb.item href="{{ route('dashboard.index') }}">Dashboard</vibe:breadcrumb.item>
        <vibe:breadcrumb.item active>{{ (new \ReflectionClass($this))->getAttributes(\Livewire\Attributes\Title::class)[0]?->getArguments()[0] ?? 'Default Title' }}</vibe:breadcrumb.item>
        <x-slot:button>
            [CreateAction]
        </x-slot:button>
    </vibe:breadcrumb>

    <vibe:grid-list id="data-list">
        <x-slot:header>
            <div class="max-w-sm">
                <vibe:input class="search-data" size="md" wire:model.live.debounce.300ms="search" placeholder="Cari data..." type="search" />
            </div>
        </x-slot:header>

        @forelse($items as $item)
            <vibe:card class="flex flex-col justify-between h-full">
                <div class="flex-1 space-y-2">
                    [ListGridData]
                </div>

                <div class="mt-6 flex items-center justify-end gap-2 border-t border-vibe-200 dark:border-vibe-800 pt-4">
                    [EditAction]
                    <vibe:button size="sm" variant="danger" type="button" @click="confirmDelete({{ $item->id }})">Hapus</vibe:button>
                </div>
            </vibe:card>
        @empty
            <vibe:card class="col-span-full py-12 text-center">
                <p class="text-vibe-500 dark:text-vibe-400">Data tidak ditemukan.</p>
            </vibe:card>
        @endforelse
    </vibe:grid-list>

    <div class="mt-4">
        {{ $items->links('vibe.pagination.index', data: ['scrollTo' => false]) }}
    </div>

    [Modals]
</section>
