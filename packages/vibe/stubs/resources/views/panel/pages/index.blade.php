<x-[path].layouts.[style]>
    <vibe:seo title="[Title]" />

    <div class="mx-auto w-full max-w-7xl">
        <div class="mb-6 flex justify-end">
            <vibe:button @click="$dispatch('open-modal', 'test-modal')">
                Buka Modal
            </vibe:button>
        </div>

        <div class="gap-6 grid grid-cols-1 md:grid-cols-3">
            <vibe:card>
                <h3 class="font-medium text-muted-foreground text-sm">Total Pengguna</h3>
                <p class="mt-2 font-bold text-3xl text-foreground">1,204</p>
            </vibe:card>
            <vibe:card>
                <h3 class="font-medium text-muted-foreground text-sm">Pendapatan</h3>
                <p class="mt-2 font-bold text-3xl text-foreground">Rp 15.000.000</p>
            </vibe:card>
            <vibe:card>
                <h3 class="font-medium text-muted-foreground text-sm">Server Status</h3>
                <p class="mt-2 font-bold text-3xl text-foreground">Online</p>
            </vibe:card>
        </div>

        <vibe:modal id="test-modal">
            <vibe:modal.header>
                <span>Ini Adalah Judul Modal</span>
            </vibe:modal.header>
            <vibe:modal.content>
                <p class="text-muted-foreground">
                    Konten modal ada di sini. Modal ini sekarang mewarisi gaya langsung dari komponen Card, sehingga tampilan bayangan dan warna latarnya sudah terintegrasi secara mulus.
                </p>
            </vibe:modal.content>
            <vibe:modal.footer>
                <vibe:button variant="ghost" @click="close">Batal</vibe:button>
                <vibe:button variant="primary" @click="$dispatch('close-modal', 'test-modal')">Simpan Perubahan</vibe:button>
            </vibe:modal.footer>
        </vibe:modal>
    </div>
</x-[path].layouts.[style]>