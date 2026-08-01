<section>
    <vibe:breadcrumb title="Data User" class="mb-6">
        <vibe:breadcrumb.item href="{{ route('dashboard.index') }}">Dashboard</vibe:breadcrumb.item>
        <vibe:breadcrumb.item active>Data User</vibe:breadcrumb.item>
        <x-slot:button>
            <vibe:button class="btn-add" variant="primary" wire:click="create">Tambah Data</vibe:button>
        </x-slot:button>
    </vibe:breadcrumb>

    <vibe:grid-list id="user-list">
        <x-slot:header>
            <div class="max-w-sm">
                <vibe:input class="search-data" size="md" wire:model.live.debounce.300ms="search" placeholder="Cari user berdasarkan nama..." type="search" />
            </div>
        </x-slot:header>

        @forelse($items as $item)
            <vibe:card class="flex flex-col justify-between h-full">
                <div>
                    <h4 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">{{ $item->name }}</h4>
                    <p class="text-sm font-medium text-vibe-500 dark:text-vibe-400 mt-1">{{ $item->username }}</p>

                    <div class="mt-4 space-y-2 text-sm text-vibe-600 dark:text-vibe-300">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-vibe-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            {{ $item->email }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-vibe-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.864-1.041l-3.286-.481c-.52-.076-1.033.2-1.208.712l-.97 2.899c-5.04-2.61-9.24-6.81-11.85-11.85l2.899-.97c.512-.175.788-.688.712-1.208l-.481-3.286c-.075-.513-.525-.864-1.041-.864H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            {{ $item->phone }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-vibe-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                            {{ $item->position }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2 border-t border-vibe-200 dark:border-vibe-800 pt-4">
                    <vibe:button size="sm" variant="ghost" wire:click="edit({{ $item->id }})">Edit</vibe:button>
                    <vibe:button size="sm" variant="danger" type="button" @click="$dispatch('alert', { type: 'confirm', title: 'Konfirmasi Hapus', message: 'Apakah Anda yakin ingin menghapus data user ini? Tindakan ini tidak dapat dibatalkan.', confirmButton: { text: 'Ya, Hapus', action: () => $wire.delete({{ $item->id }}) }, closeButton: 'Batal', sound: '{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}' })">Hapus</vibe:button>
                </div>
            </vibe:card>
        @empty
            <vibe:card class="col-span-full py-12 text-center">
                <p class="text-vibe-500 dark:text-vibe-400">Tidak ada data user yang ditemukan.</p>
            </vibe:card>
        @endforelse

    </vibe:grid-list>
    <div class="mt-4">
        {{ $items->links(data: ['scrollTo' => false]) }}
    </div>

    <vibe:sheet id="user-form" class="bg-vibe-50 dark:bg-vibe-950" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" defaultSize="500" closeOnOutsideClick="true">
        <form wire:submit="save" class="flex flex-1 flex-col h-full">
            <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
                <div class="flex flex-col">
                    <h3 class="text-lg font-bold text-vibe-900 dark:text-vibe-100">{{ $editId ? 'Edit User' : 'Tambah User' }}</h3>
                    <p class="text-sm text-vibe-500 dark:text-vibe-400 mt-1">
                        Silakan lengkapi data pada formulir di bawah ini.
                    </p>
                </div>
                <vibe:button type="button" class="p-2 shrink-0 text-vibe-400 hover:text-vibe-600 dark:hover:text-vibe-200" variant="ghost" @click="$dispatch('close-sheet', 'user-form')">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </vibe:button>
            </div>

            <!-- Body -->
            <div class="flex-1 p-6 space-y-2">
                <vibe:input wire:model="name" label="Name" type="text" placeholder="Masukkan Name" />
                <vibe:input wire:model="username" label="Username" type="text" placeholder="Masukkan Username" />
                <vibe:input wire:model="phone" label="Phone" type="tel" placeholder="Masukkan Phone" />
                <vibe:input wire:model="email" label="Email" type="email" placeholder="Masukkan Email" />
            </div>

            <!-- Footer -->
            <div class="sticky bottom-0 z-10 px-6 py-4 flex justify-end gap-3 bg-vibe-100 dark:bg-vibe-900  mt-auto">
                <vibe:button variant="ghost" type="button" @click="$dispatch('close-sheet', 'user-form')">Batal</vibe:button>
                <vibe:button variant="primary" type="submit">
                    <span wire:loading.remove wire:target="save">Simpan Data</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </vibe:button>
            </div>
        </form>
    </vibe:sheet>


    {{-- @alert([
    'type' => 'success',
    'message' => 'Data user berhasil dihapus!',
    'sound' => asset('vibe/sounds/mixkit-software-interface-remove-2576.wav'),
]) --}}
    @push('body')
        <script>
            vibeAlert({
                type: 'success',
                title: 'Konfirmasi Hapus',
                message: 'Apakah Anda yakin ingin menghapus data user ini? Tindakan ini tidak dapat dibatalkan.',
                confirmButton: {
                    text: 'Ya, Hapus',
                    class: 'inline-flex justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 transition-colors',
                    action: () => vibeAlert({
                        type: 'success',
                        timeout: false,
                        message: 'Data user berhasil dihapus!'
                    })
                },
                closeButton: {
                    text: 'Batal',
                    action: () => vibeAlert({
                        type: 'info',
                        message: 'Dibatalkan!'
                    })
                },
                position:'top-center',
                sound: "{{ asset('vibe/sounds/mixkit-software-interface-remove-2576.wav') }}",
            });
        </script>
    @endpush


</section>
