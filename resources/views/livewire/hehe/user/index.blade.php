<div>
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
            <vibe:button variant="primary" wire:click="create">Tambah Data</vibe:button>
        </x-slot:button>
    </vibe:breadcrumb>

    <vibe:card class="w-full">
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Username</th>
                    <th class="px-6 py-3">Position</th>
                    <th class="px-6 py-3">Password</th>
                    
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
                    <td class="px-6 py-4">{{ $item->password }}</td>
                    
                            <td class="px-6 py-4 text-right space-x-2">
                                <vibe:button variant="ghost" size="sm" wire:click="edit({{ $item->id }})">Edit</vibe:button>
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
    
</section>


    <vibe:sheet id="{{ isset($editId) ? 'edit-sheet' : 'create-sheet' }}" class="bg-vibe-50 dark:bg-vibe-950" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" defaultSize="500" closeOnOutsideClick="true">
        @if($editId)
            <vibe:form id="edit-form" wire:submit="save" class="flex flex-1 flex-col h-full">
    <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
        <div class="flex flex-col">
            <h3 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">Edit Data</h3>
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
                <vibe:input wire:model="phone" label="Phone" type="text" placeholder="Masukkan Phone" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:input wire:model="position" label="Position" type="text" placeholder="Masukkan Position" />
                <vibe:input wire:model="password" label="Password" type="text" placeholder="Masukkan Password" />
                
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

        @else
            <vibe:form id="create-form" wire:submit="save" class="flex flex-1 flex-col h-full">
    <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
        <div class="flex flex-col">
            <h3 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">Tambah Data</h3>
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
                <vibe:input wire:model="phone" label="Phone" type="text" placeholder="Masukkan Phone" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:input wire:model="position" label="Position" type="text" placeholder="Masukkan Position" />
                <vibe:input wire:model="password" label="Password" type="text" placeholder="Masukkan Password" />
                
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

        @endif
    </vibe:sheet>
</div>
