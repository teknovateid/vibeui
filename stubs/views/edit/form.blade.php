<vibe:card class="w-full max-w-2xl mx-auto mt-6">
    <vibe:header>
        <vibe:header.heading>[Title]</vibe:header.heading>
    </vibe:header>

    <div class="p-6">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                [FormFields]
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                [CancelAction]
                <vibe:button variant="primary" type="submit">
                    <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </vibe:button>
            </div>
        </form>
    </div>
</vibe:card>
