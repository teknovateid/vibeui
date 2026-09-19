<div class="space-y-6">
    @php
        $currentSession = $sessions->firstWhere('is_current', true);
        $otherSessionsCount = $sessions->where('is_current', false)->count();
    @endphp

    {{-- Current Session Banner --}}
    @if ($currentSession)
        <div class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
            <span class="size-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
            <div class="flex-1 min-w-0 text-xs">
                <span class="font-semibold text-emerald-700 dark:text-emerald-300">{{ __('vibe/settings.login_history.current_session') }}</span>
                <span class="text-muted-foreground"> — {{ $currentSession->device }} ({{ $currentSession->browser }} &bull; {{ $currentSession->os }})</span>
            </div>
            <span class="text-xs text-muted-foreground shrink-0 font-mono">IP: {{ $currentSession->ip_address }}</span>
        </div>
    @endif

    {{-- Login History List --}}
    <div class="space-y-3">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.login_history.all_sessions') }}</h3>
                <p class="text-xs text-muted-foreground">{{ $sessions->count() }} sesi aktif terdeteksi di database.</p>
            </div>

            @if ($otherSessionsCount > 0)
                <vibe:button 
                    type="button" 
                    variant="ghost" 
                    size="sm" 
                    class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer" 
                    wire:click="confirmLogout"
                >
                    {{ __('vibe/settings.login_history.terminate_all_btn') }}
                </vibe:button>
            @endif
        </div>

        <div class="border border-border/60 rounded-2xl overflow-hidden divide-y divide-border/40">
            @forelse ($sessions as $session)
                <div class="p-4 flex items-start gap-4 {{ $session->is_current ? 'bg-emerald-500/5' : 'bg-card hover:bg-muted/20' }} transition-colors">
                    {{-- Device Icon --}}
                    <div class="size-9 rounded-xl shrink-0 flex items-center justify-center {{ $session->is_current ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-muted/60 text-muted-foreground' }}">
                        @if ($session->icon === 'smartphone')
                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                                <path d="M12 18h.01" />
                            </svg>
                        @else
                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                <line x1="8" x2="16" y1="21" y2="21" />
                                <line x1="12" x2="12" y1="17" y2="21" />
                            </svg>
                        @endif
                    </div>

                    {{-- Session Info --}}
                    <div class="flex-1 min-w-0 space-y-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-sm font-semibold text-foreground">{{ $session->device }}</span>
                            @if ($session->is_current)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                    <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                    {{ __('vibe/settings.login_history.this_session_badge') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 text-xs text-muted-foreground">
                            <span>{{ $session->browser }} · {{ $session->os }}</span>
                            <span class="font-mono">{{ $session->ip_address }}</span>
                        </div>
                        <p class="text-xs text-muted-foreground/70">{{ $session->last_active }}</p>
                    </div>

                    {{-- Action --}}
                    @if (!$session->is_current)
                        <button 
                            type="button" 
                            wire:click="terminateSession('{{ $session->id }}')" 
                            wire:confirm="Apakah Anda yakin ingin mengakhiri sesi perangkat ini?"
                            class="shrink-0 text-xs text-muted-foreground hover:text-destructive font-medium transition-colors cursor-pointer mt-0.5"
                        >
                            {{ __('vibe/settings.login_history.terminate_btn') }}
                        </button>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-xs text-muted-foreground">
                    Tidak ada catatan sesi yang ditemukan.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Terminate All Other Sessions Confirmation Modal --}}
    @if ($confirmingLogout)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-background/80 backdrop-blur-xs">
            <div class="w-full max-w-md p-6 rounded-2xl border border-border bg-card shadow-xl space-y-4 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-destructive/10 text-destructive">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-foreground">{{ __('vibe/settings.login_history.terminate_all_btn') }}</h4>
                        <p class="text-xs text-muted-foreground">Masukkan kata sandi akun Anda untuk mengonfirmasi pengakhiran seluruh sesi pada perangkat lain.</p>
                    </div>
                </div>

                <form wire:submit.prevent="terminateOtherSessions" class="space-y-4 pt-2">
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
                        <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" wire:click="$set('confirmingLogout', false)">
                            Batal
                        </vibe:button>
                        <vibe:button type="submit" variant="destructive" size="sm" class="cursor-pointer" wire:loading.attr="disabled" wire:target="terminateOtherSessions">
                            <span wire:loading.remove wire:target="terminateOtherSessions">
                                Akhiri Semua Sesi Lain
                            </span>
                            <span wire:loading.inline-flex wire:target="terminateOtherSessions" class="inline-flex items-center justify-center gap-1.5 leading-none">
                                <svg class="size-3.5 animate-spin shrink-0 text-current" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span>Memproses...</span>
                            </span>
                        </vibe:button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
