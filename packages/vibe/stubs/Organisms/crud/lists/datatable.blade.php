<section  x-data="{
    confirmDelete(id) {
        $dispatch('alert', {
            type: 'confirm',
            title: 'Konfirmasi Hapus',
            message: 'Apakah Anda yakin ingin menghapus data user ini? Tindakan ini tidak dapat dibatalkan.',
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

    <vibe:card class="w-full">
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        [TableHeaders]
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            [TableData]
                            <td class="px-6 py-4 text-right space-x-2">
                                [EditAction]
                                <vibe:button variant="danger" size="sm" @click="confirmDelete({{ $item->id }})">Hapus</vibe:button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="px-6 py-4 text-center text-gray-500">
                                Data tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            {{ $items->links() }}
        </div>
    </vibe:card>
    [Modals]
</section>
