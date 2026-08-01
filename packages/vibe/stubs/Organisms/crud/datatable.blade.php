<vibe:card class="w-full">
    <vibe:header class="flex justify-between items-center mb-4">
        <vibe:header.heading>[Title]</vibe:header.heading>
        <vibe:header.actions>
            <div class="flex items-center gap-2">
                <vibe:input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari data..." class="w-64" />
                [CreateAction]
            </div>
        </vibe:header.actions>
    </vibe:header>

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
                        <vibe:button variant="danger" size="sm" wire:click="delete({{ $item->id }})" wire:confirm="Yakin ingin menghapus data ini?">Hapus</vibe:button>
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

    [Modals]
</vibe:card>
