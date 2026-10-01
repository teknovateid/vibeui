<div class="space-y-4 w-full">
    <div class="flex flex-wrap items-center gap-3">
        <vibe:button
            wire:click="dispatchToModal"
            variant="primary"
            size="sm"
        >
            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M9 3v18" />
            </svg>
            Dispatch ke Modal ($this->dispatch)
        </vibe:button>

        <vibe:button
            wire:click="dispatchToSheet"
            variant="outline"
            size="sm"
        >
            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M15 3v18" />
            </svg>
            Dispatch ke Sheet ($this->dispatch)
        </vibe:button>

        <span class="text-xs text-muted-foreground ml-auto hidden sm:inline-block">
            Eksekusi langsung dari method PHP Livewire
        </span>
    </div>

    {{-- Target Modal --}}
    <vibe:modal id="demo-livewire-modal" title="Detail Pengguna (Livewire $this->dispatch)">
        <div class="p-6 space-y-4">
            <div class="space-y-1">
                <span class="text-xs text-muted-foreground font-mono">&lt;vibe:show key="name"&gt;:</span>
                <vibe:show key="name" class="text-base font-bold text-foreground block" />
            </div>
            <vibe:separator />
            <div class="grid grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-muted-foreground block">Email:</span>
                    <vibe:show key="email" class="font-medium" />
                </div>
                <div>
                    <span class="text-muted-foreground block">Peran:</span>
                    <vibe:show key="role" class="font-semibold text-primary" />
                </div>
                <div>
                    <span class="text-muted-foreground block">Telepon:</span>
                    <vibe:show key="phone" class="font-mono" />
                </div>
                <div>
                    <span class="text-muted-foreground block">Status:</span>
                    <vibe:badge vibe-show="status" variant="success" size="sm" />
                </div>
                <div class="col-span-2">
                    <span class="text-muted-foreground block">Departemen:</span>
                    <vibe:show key="department" class="font-medium" />
                </div>
                <div class="col-span-2">
                    <span class="text-muted-foreground block">Biografi:</span>
                    <vibe:show key="bio" class="text-muted-foreground leading-relaxed block mt-0.5" />
                </div>
            </div>
        </div>
    </vibe:modal>

    {{-- Target Sheet --}}
    <vibe:sheet id="demo-livewire-sheet" position="right" size="md">
        <vibe:sheet.header>
            <h3 class="font-bold text-base text-foreground">Detail Pengguna (Livewire $this->dispatch)</h3>
        </vibe:sheet.header>

        <vibe:sheet.content class="p-6 space-y-6">
            <div class="flex items-center gap-3 border-b border-border pb-4">
                <vibe:avatar vibe-show="avatar" size="xl" />
                <div class="min-w-0">
                    <h4 class="text-base font-bold text-foreground truncate" vibe-show="name"></h4>
                    <p class="text-xs text-muted-foreground truncate" vibe-show="email"></p>
                </div>
                <vibe:badge vibe-show="status" variant="success" size="sm" class="ml-auto" />
            </div>

            <div class="space-y-3 text-xs"> 
                <div>
                    <span class="text-muted-foreground block">Peran &amp; Departemen:</span>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="font-medium" vibe-show="role"></span>
                        <span class="text-muted-foreground/50">&bull;</span>
                        <span class="text-muted-foreground" vibe-show="department"></span>
                    </div>
                </div>
                <div>
                    <span class="text-muted-foreground block">Nomor Telepon:</span>
                    <span class="font-mono font-medium" vibe-show="phone"></span>
                </div>
                <div>
                    <span class="text-muted-foreground block">Biografi:</span>
                    <p class="text-muted-foreground mt-0.5 leading-relaxed" vibe-show="bio"></p>
                </div>

                <div class="pt-2">
                    <span class="text-muted-foreground block mb-2 font-medium">Aktivitas Terakhir (&lt;vibe:show.each&gt;):</span>
                    <div vibe-show-each="activities" class="space-y-2">
                        <template>
                            <div class="p-2.5 rounded-lg border bg-muted/40 text-xs">
                                <div class="flex justify-between font-medium">
                                    <span vibe-show="action"></span>
                                    <span vibe-show="time" class="text-muted-foreground text-[10px]"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </vibe:sheet.content>

        <vibe:sheet.footer class="flex justify-end">
            <vibe:button size="sm" variant="outline" @click="$dispatch('close-sheet', 'demo-livewire-sheet')">
                Tutup Sheet
            </vibe:button>
        </vibe:sheet.footer>
    </vibe:sheet>
</div>
