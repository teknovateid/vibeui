<div>
    <vibe:breadcrumb title="Data User" class="mb-6">
        <vibe:breadcrumb.item href="{{ route('dashboard.index') }}">Dashboard</vibe:breadcrumb.item>
        <vibe:breadcrumb.item active>Data User</vibe:breadcrumb.item>
        <x-slot:button>
            <vibe:button class="btn-add" variant="primary" @click.stop="$dispatch('open-sheet', 'create-user')">Tambah Data</vibe:button>
        </x-slot:button>
    </vibe:breadcrumb>

    <vibe:card>

    </vibe:card>

    <vibe:sheet id="create-user" class="bg-vibe-50 dark:bg-vibe-950" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" defaultSize="500" closeOnOutsideClick="true">
        <form wire:submit="save" class="flex flex-1 flex-col h-full">
            <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
                <div class="flex flex-col">
                    <h3 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">Tambah User</h3>
                    <p class="text-sm text-vibe-500 dark:text-vibe-400 mt-1">
                        Silakan lengkapi data pada formulir di bawah ini.
                    </p>
                </div>
                <vibe:button type="button" class="p-2 shrink-0 text-vibe-400 hover:text-vibe-600 dark:hover:text-vibe-200" variant="ghost" @click="$dispatch('close-sheet', 'create-user')">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </vibe:button>
            </div>

            <!-- Body -->
            <div class="flex-1 p-6 space-y-2">
                <vibe:input wire:model="name" label="Name" type="text" placeholder="Masukkan Name" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:input wire:model="phone" label="Phone" type="number" placeholder="Masukkan Phone" />
                <vibe:input wire:model="email" label="Email" type="email" placeholder="Masukkan Email" />
                <vibe:input wire:model="password" label="Password" type="password" placeholder="Masukkan Password" />
                <vibe:input wire:model="position" label="Position" type="text" placeholder="Masukkan Position" />
            </div>

            <!-- Footer -->
            <div class="sticky bottom-0 z-10 px-6 py-4 flex justify-end gap-3 bg-vibe-100 dark:bg-vibe-900  mt-auto">
                <vibe:button variant="ghost" type="button" @click="$dispatch('close-sheet', 'create-user')">Batal</vibe:button>
                <vibe:button variant="primary" type="submit">
                    <span wire:loading.remove wire:target="save">Simpan Data</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </vibe:button>
            </div>
        </form>
    </vibe:sheet>


    <vibe:sheet id="edit-user" class="bg-vibe-50 dark:bg-vibe-950" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" defaultSize="500" closeOnOutsideClick="true">
        <form wire:submit="save" class="flex flex-1 flex-col h-full">
            <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
                <div class="flex flex-col">
                    <h3 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">Edit User</h3>
                    <p class="text-sm text-vibe-500 dark:text-vibe-400 mt-1">
                        Silakan lengkapi data pada formulir di bawah ini.
                    </p>
                </div>
                <vibe:button type="button" class="p-2 shrink-0 text-vibe-400 hover:text-vibe-600 dark:hover:text-vibe-200" variant="ghost" @click="$dispatch('close-sheet', 'edit-user')">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </vibe:button>
            </div>

            <!-- Body -->
            <div class="flex-1 p-6 space-y-2">
                <vibe:input wire:model="name" label="Name" type="text" placeholder="Masukkan Name" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:input wire:model="phone" label="Phone" type="number" placeholder="Masukkan Phone" />
                <vibe:input wire:model="email" label="Email" type="email" placeholder="Masukkan Email" />
                <vibe:input wire:model="password" label="Password" type="password" placeholder="Masukkan Password" />
                <vibe:input wire:model="position" label="Position" type="text" placeholder="Masukkan Position" />
            </div>

            <!-- Footer -->
            <div class="sticky bottom-0 z-10 px-6 py-4 flex justify-end gap-3 bg-vibe-100 dark:bg-vibe-900  mt-auto">
                <vibe:button variant="ghost" type="button" @click="$dispatch('close-sheet', 'edit-user')">Batal</vibe:button>
                <vibe:button variant="primary" type="submit">
                    <span wire:loading.remove wire:target="save">Simpan Data</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </vibe:button>
            </div>
        </form>
    </vibe:sheet>

</div>
