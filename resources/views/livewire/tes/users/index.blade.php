<vibe:card class="w-full">
    <vibe:header class="flex justify-between items-center mb-4">
        <vibe:header.heading>Tes Users</vibe:header.heading>
        <vibe:header.actions>
            <div class="flex items-center gap-2">
                <vibe:input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari data..." class="w-64" />
                <vibe:button variant="primary" wire:click="create">Tambah Data</vibe:button>
            </div>
        </vibe:header.actions>
    </vibe:header>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Position</th>

                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">{{ $item->phone }}</td>
                        <td class="px-6 py-4">{{ $item->username }}</td>
                        <td class="px-6 py-4">{{ $item->position }}</td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <vibe:button variant="ghost" size="sm" wire:click="edit({{ $item->id }})">Edit</vibe:button>
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

    <vibe:modal wire:model="isOpen">
        <vibe:form id="{{ isset($editId) ? 'edit-form' : 'create-form' }}" saveToStorage="{{ isset($editId) ? false : true }}" wire:submit="save" class="flex flex-1 flex-col h-full">
            <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
                <div class="flex flex-col">
                    <h3 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">{{ $editId ? 'Edit' : 'Tambah' }}</h3>
                    <p class="text-sm text-vibe-500 dark:text-vibe-400 mt-1">
                        Silakan lengkapi data pada formulir di bawah ini.
                    </p>
                </div>
                <vibe:button type="button" class="p-2 shrink-0 text-vibe-400 hover:text-vibe-600 dark:hover:text-vibe-200" variant="ghost" @click="close()">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </vibe:button>
            </div>

            <!-- Body -->
            <div class="flex-1 p-6 space-y-2">
                <vibe:input wire:model="name" label="Name" type="text" placeholder="Masukkan Name" />
                <vibe:input wire:model="email" label="Email" type="email" placeholder="Masukkan Email" />
                <vibe:input wire:model="phone" label="Phone" type="number" placeholder="Masukkan Phone" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:textarea wire:model="position" label="Position" placeholder="Masukkan Position" />

            </div>

            <!-- Footer -->
            <div class="sticky bottom-0 z-10 px-6 py-4 flex justify-end gap-3 bg-vibe-100 dark:bg-vibe-900  mt-auto">
                <vibe:button variant="ghost" type="button" @click="close">Batal</vibe:button>
                <vibe:button variant="primary" type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Simpan Data</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </vibe:button>
            </div>
        </vibe:form>

    </vibe:modal>
</vibe:card>
