<section class="p-6">
    <div class="mx-auto max-w-7xl text-black dark:text-white">
        <div class="mb-6">
            <h1 class="text-2xl font-bold mb-4">Uji Coba Modal</h1>
            <vibe:button x-data @click="$dispatch('open-modal', 'basic')">Buka Modal</vibe:button>
        </div>

        <vibe:modal id="basic" show="true">
            <div class="p-4">
                <h3 class="text-lg font-bold mb-2">Halo dari Vibe!</h3>
                <p class="text-gray-600 dark:text-gray-300">Ini adalah contoh modal yang baru saja Anda buat. Coba klik di luar modal atau tekan tombol X untuk menutupnya.</p>
                <div class="mt-6 flex justify-end">
                    <vibe:button x-data @click="$dispatch('close-modal', 'basic')" variant="outline">Tutup</vibe:button>
                </div>
            </div>
        </vibe:modal>
    </div>
</section>
