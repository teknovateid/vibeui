@push('head')
    @vite('resources/js/vibe/passkeys.js')
@endpush

<div class="space-y-4">
    @if(session('status') === 'idle_timeout' || session('auth.session_locked'))
        <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-600 dark:text-amber-400 flex items-start gap-2.5">
            <svg class="size-4 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            <div class="space-y-0.5">
                <p class="font-semibold">Sesi Terkunci Otomatis</p>
                <p class="text-muted-foreground">Tidak ada aktivitas selama beberapa saat. Masukkan kata sandi atau gunakan passkey untuk membuka kunci, atau keluar jika bukan perangkat Anda.</p>
            </div>
        </div>
    @endif

    {{-- Passkey Confirm Button --}}
    <div class="space-y-3">
        <vibe:button type="button" variant="outline" class="w-full justify-center shadow-2xs font-medium cursor-pointer" onclick="window.vibeConfirmWithPasskey(this, '{{ session()->get('url.intended') ?: route('docs.settings.security') }}')">
            <span class="vibe-passkey-text inline-flex items-center gap-2">
                <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                    <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                    <path d="M2 12a10 10 0 0 1 18-6" />
                </svg>
                <span>Confirm with passkey</span>
            </span>
            <span class="vibe-passkey-loading inline-flex items-center gap-2" style="display: none;">
                <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Connecting...</span>
            </span>
        </vibe:button>

        <vibe:separator text="OR CONFIRM WITH PASSWORD" />
    </div>

    <form wire:submit="confirmPassword" class="space-y-4">
        {{-- Password Input --}}
        <vibe:input wire:model="password" id="password" name="password" label="Password" type="password" viewable required autofocus autocomplete="current-password" placeholder="Password" />

        {{-- Submit Button --}}
        <div class="pt-2">
            <vibe:button type="submit" variant="primary" class="w-full justify-center flex shadow-xs" wire:loading.attr="disabled" wire:target="confirmPassword">
                <span wire:loading.remove wire:target="confirmPassword">Confirm</span>
                <span wire:loading wire:target="confirmPassword" class="inline-flex items-center gap-2">
                    <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Verifying...</span>
                </span>
            </vibe:button>
        </div>
    </form>

    {{-- Logout Option --}}
    <div class="pt-3 flex items-center justify-between border-t border-border text-xs">
        <span class="text-muted-foreground">Bukan akun Anda?</span>
        <button type="button" wire:click="logout" class="inline-flex items-center gap-1.5 font-medium text-destructive hover:text-destructive/80 transition-colors cursor-pointer py-1 px-2 rounded-md hover:bg-destructive/10">
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" x2="9" y1="12" y2="12"/>
            </svg>
            <span>Log out</span>
        </button>
    </div>
</div>
