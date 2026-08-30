<vibe:form id="[FormId]" wire:submit="save" class="flex flex-1 flex-col h-full">
    <div class="px-6 py-4 flex justify-between gap-4 w-full items-start">
        <div class="flex flex-col">
            <h3 class="text-lg font-bold text-foreground">[Title]</h3>
            <p class="text-sm text-muted-foreground mt-1">
                Silakan lengkapi data pada formulir di bawah ini.
            </p>
        </div>
        <vibe:button type="button" class="p-2 shrink-0 text-muted-foreground hover:text-foreground" variant="ghost" @click="close()">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </vibe:button>
    </div>

    <!-- Body -->
    <div class="flex-1 p-6 space-y-2">
        [FormFields]
    </div>

    <!-- Footer -->
    <div class="sticky bottom-0 z-10 px-6 py-4 flex justify-end gap-3 bg-muted border-t border-border mt-auto">
        <vibe:button variant="ghost" type="button" @click="close">Batal</vibe:button>
        <vibe:button variant="primary" type="submit" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">Simpan Data</span>
            <span wire:loading wire:target="save">Menyimpan...</span>
        </vibe:button>
    </div>
</vibe:form>
