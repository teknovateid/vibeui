<div>
    <div class="mb-6 flex justify-end">
        <vibe:button @click="$dispatch('open-modal', 'test-modal')">
            Buka Modal
        </vibe:button>
    </div>

    <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
        <vibe:card>
            <h3 class="font-medium text-gray-700 dark:text-gray-300 text-sm">Total Pengguna</h3>
            <p class="mt-2 font-bold text-3xl">1,204</p>
        </vibe:card>
        <vibe:card>
            <h3 class="font-medium text-gray-700 dark:text-gray-300 text-sm">Pendapatan</h3>
            <p class="mt-2 font-bold text-3xl">Rp 15.000.000</p>
        </vibe:card>
        <vibe:card>
            <h3 class="font-medium text-gray-700 dark:text-gray-300 text-sm">Server Status</h3>
            <p class="mt-2 font-bold text-3xl">Online</p>
        </vibe:card>
    </div>

    <vibe:modal id="test-modal">
        <h2 class="text-xl mb-4">Ini Adalah Judul Modal</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
            Konten modal ada di sini. Modal ini sekarang mewarisi gaya langsung dari komponen Card, sehingga tampilan bayangan dan warna latarnya sudah terintegrasi secara mulus.
        </p>
        
        <div class="flex justify-end gap-3 mt-6">
            <vibe:button variant="ghost" @click="$dispatch('close-modal', 'test-modal')">Batal</vibe:button>
            <vibe:button variant="primary" @click="$dispatch('close-modal', 'test-modal')">Simpan Perubahan</vibe:button>
        </div>
    </vibe:modal>
</div>