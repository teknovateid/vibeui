@aware(['isTailwind','isBootstrap', 'localisationPath'])
@if ($this->offlineIndicatorIsEnabled())
    <div wire:offline.class.remove="hidden" class="hidden" data-toc-ignore>
        <div class="flex items-center gap-3 rounded-xl border border-destructive/20 bg-destructive/10 px-4 py-2.5 text-destructive shadow-2xs backdrop-blur-xs transition-all mb-4">
            <div class="flex size-7 shrink-0 items-center justify-center rounded-lg bg-destructive/15 text-destructive">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="2" x2="22" y1="2" y2="22"/>
                    <path d="M8.5 16.5a5 5 0 0 1 7 0"/>
                    <path d="M2 8.82a15 15 0 0 1 4.17-2.65"/>
                    <path d="M10.66 5c4.01-.36 8.14.9 11.34 3.76"/>
                    <path d="M16.85 11.25a10 10 0 0 1 2.22 1.68"/>
                    <path d="M5 13a10 10 0 0 1 5.24-2.65"/>
                    <line x1="12" x2="12.01" y1="20" y2="20"/>
                </svg>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-xs font-semibold text-destructive leading-tight">
                    {{ __($localisationPath.'You are not connected to the internet') }}.
                </span>
                <span class="text-[11px] text-destructive/70 leading-tight mt-0.5">
                    Periksa koneksi jaringan Anda untuk memperbarui tabel data.
                </span>
            </div>
        </div>
    </div>
@endif
