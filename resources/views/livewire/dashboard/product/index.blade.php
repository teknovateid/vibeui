<vibe:card class="w-full">
    <vibe:header class="flex justify-between items-center mb-4">
        <vibe:header.heading>Dashboard Product</vibe:header.heading>
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
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Password</th>
                    <th class="px-6 py-3">Position</th>

                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->username }}</td>
                        <td class="px-6 py-4">{{ $item->phone }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">{{ $item->password }}</td>
                        <td class="px-6 py-4">{{ $item->position }}</td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <vibe:button variant="ghost" size="sm" wire:click="edit({{ $item->id }})">Edit</vibe:button>
                            <vibe:button variant="danger" size="sm" type="button" @click="confirmDelete({{ $item->id }})">Hapus</vibe:button>
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

    <vibe:modal wire:model="isOpen" show="true">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <vibe:input wire:model="name" label="Name" type="text" placeholder="Masukkan Name" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:input wire:model="phone" label="Phone" type="number" placeholder="Masukkan Phone" />
                <vibe:input wire:model="email" label="Email" type="email" placeholder="Masukkan Email" />
                <vibe:input wire:model="password" label="Password" type="password" placeholder="Masukkan Password" />
                <vibe:input wire:model="position" label="Position" type="text" placeholder="Masukkan Position" />
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                <vibe:button variant="ghost" type="button" wire:click="$set('isOpen', false)">Batal</vibe:button>
                <vibe:button variant="primary" type="submit">
                    <span wire:loading.remove wire:target="save">Simpan Data</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </vibe:button>
            </div>
        </form>
    </vibe:modal>
</vibe:card>
