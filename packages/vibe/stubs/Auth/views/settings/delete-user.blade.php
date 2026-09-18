<div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
    <div class="space-y-1 max-w-lg w-full">
        <h3 class="font-semibold text-destructive text-base">{{ __('vibe/settings.security.danger_zone_title') }}</h3>
        <p class="text-muted-foreground text-xs">{{ __('vibe/settings.security.danger_zone_desc') }}</p>
    </div>

    <div class="space-y-4 w-full">
        <div class="flex justify-between items-center gap-4">
            <div>
                <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.security.delete_account_title') }}</p>
                <p class="mt-0.5 text-muted-foreground text-xs">{{ __('vibe/settings.security.delete_account_desc') }}</p>
            </div>
            <vibe:button type="button" variant="destructive" size="sm" class="cursor-pointer shrink-0" wire:click="confirmUserDeletion">
                {{ __('vibe/settings.security.delete_account_btn') }}
            </vibe:button>
        </div>
    </div>

    {{-- Confirmation Modal --}}
    @if ($confirmingDeletion)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-background/80 backdrop-blur-xs">
            <div class="w-full max-w-md p-6 rounded-2xl border border-border bg-card shadow-xl space-y-4 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-destructive/10 text-destructive">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-foreground">{{ __('vibe/settings.security.delete_account_title') }}</h4>
                        <p class="text-xs text-muted-foreground">Tindakan ini permanen. Masukkan kata sandi akun Anda untuk konfirmasi.</p>
                    </div>
                </div>

                <form wire:submit.prevent="deleteUser" class="space-y-4 pt-2">
                    <div>
                        <vibe:input 
                            type="password" 
                            name="password" 
                            label="Kata Sandi Akun" 
                            viewable 
                            wire:model="password" 
                            placeholder="Masukkan kata sandi..." 
                            required 
                        />
                        @error('password')
                            <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-border/50">
                        <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" wire:click="$set('confirmingDeletion', false)">
                            Batal
                        </vibe:button>
                        <vibe:button type="submit" variant="destructive" size="sm" class="cursor-pointer" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="deleteUser">
                                Hapus Akun Sekarang
                            </span>
                            <span wire:loading wire:target="deleteUser" class="inline-flex items-center gap-1.5">
                                <svg class="size-3.5 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span>Menghapus...</span>
                            </span>
                        </vibe:button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
