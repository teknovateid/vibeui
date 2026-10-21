<div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
    @php
        $currentSession = $sessions->firstWhere('is_current', true);
        $otherSessions = $sessions->where('is_current', false);
        $otherSessionsCount = $otherSessions->count();
    @endphp

    {{-- Left Column: Section Title & Description (Security Tab Pattern) --}}
    <div class="space-y-1 max-w-lg w-full">
        <div class="flex items-center gap-2">
            <h3 class="font-semibold text-foreground text-base">
                {{ __('vibe/settings.security.sessions_title') }}
            </h3>
            <vibe:badge size="sm" variant="secondary" class="rounded-full font-medium">
                {{ $sessions->count() }} Sesi
            </vibe:badge>
        </div>
        <p class="text-muted-foreground text-xs">
            {{ __('vibe/settings.security.sessions_desc') }}
        </p>
    </div>

    {{-- Right Column: Interactive Content & Sessions List --}}
    <div class="space-y-4 w-full">
        {{-- Header & Quick Info --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <p class="font-semibold text-foreground text-sm">
                    {{ __('vibe/settings.login_history.all_sessions') }}
                </p>
                <p class="text-xs text-muted-foreground">
                    {{ __('vibe/settings.login_history.devices_signed_in', ['count' => $sessions->count(), 'name' => auth()->user()?->name ?? 'akun Anda']) }}
                </p>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                @if ($otherSessionsCount > 0)
                    <vibe:button 
                        type="button" 
                        variant="outline" 
                        size="sm" 
                        class="rounded-full text-xs cursor-pointer flex items-center gap-1.5" 
                        wire:click="confirmLogout('other')"
                    >
                        <svg class="size-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" x2="9" y1="12" y2="12" />
                        </svg>
                        <span>{{ __('vibe/settings.login_history.sign_out_others_btn') }}</span>
                    </vibe:button>
                @endif

                @if ($sessions->count() > 1)
                    <vibe:button 
                        type="button" 
                        variant="destructive" 
                        size="sm" 
                        class="rounded-full text-xs cursor-pointer" 
                        wire:click="confirmLogout('all')"
                    >
                        {{ __('vibe/settings.login_history.terminate_all_devices_btn') }}
                    </vibe:button>
                @endif
            </div>
        </div>

        {{-- Sessions Container --}}
        @if ($sessions->isEmpty())
            <div class="flex items-center gap-3.5 bg-muted p-3.5 rounded-xl text-xs text-muted-foreground">
                <div class="flex justify-center items-center bg-primary/10 rounded-xl size-9 shrink-0 text-primary">
                    <svg class="size-4.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect width="20" height="14" x="2" y="3" rx="2" />
                        <line x1="8" x2="16" y1="21" y2="21" />
                        <line x1="12" x2="12" y1="17" y2="21" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-foreground text-sm">Tidak ada sesi aktif</p>
                    <p class="text-xs text-muted-foreground">Belum ada sesi yang tercatat di akun Anda.</p>
                </div>
            </div>
        @else
            {{-- This Device Section --}}
            @if ($currentSession)
                <div class="space-y-2">
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('vibe/settings.login_history.this_device') }}
                    </p>
                    <div class="rounded-xl border border-border/60 bg-muted/50 p-4 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="flex justify-center items-center bg-primary/10 rounded-xl size-9 text-primary shrink-0">
                                    @if ($currentSession->icon === 'smartphone')
                                        <svg class="size-4.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="12" height="18" x="6" y="3" rx="3" />
                                            <circle cx="12" cy="17" r="0.75" fill="currentColor" />
                                        </svg>
                                    @elseif ($currentSession->icon === 'tablet')
                                        <svg class="size-4.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="16" height="20" x="4" y="2" rx="3" />
                                            <circle cx="12" cy="18" r="0.75" fill="currentColor" />
                                        </svg>
                                    @elseif ($currentSession->icon === 'laptop')
                                        <svg class="size-4.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="18" height="12" x="3" y="4" rx="2" />
                                            <path d="M2 20h20" />
                                        </svg>
                                    @else
                                        <svg class="size-4.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <rect width="20" height="14" x="2" y="3" rx="2" />
                                            <line x1="8" x2="16" y1="21" y2="21" />
                                            <line x1="12" x2="12" y1="17" y2="21" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-semibold text-foreground text-sm truncate">{{ $currentSession->device }}</span>
                                        <vibe:badge size="sm" variant="success" dot class="rounded-full text-[10px]">
                                            {{ __('vibe/settings.login_history.this_session_badge') }}
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-0.5 flex items-center gap-1.5 flex-wrap">
                                        <span>{{ $currentSession->browser }} &bull; {{ $currentSession->os }}</span>
                                        <span class="text-muted-foreground/40">&bull;</span>
                                        <span>{{ $currentSession->last_active }}</span>
                                        <span class="text-muted-foreground/40">&bull;</span>
                                        <span class="font-mono text-[11px]">IP: {{ $currentSession->ip_address }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="shrink-0 sm:self-center">
                                <vibe:button 
                                    type="button"
                                    variant="ghost"
                                    size="xs"
                                    class="text-xs text-destructive hover:bg-destructive/10 rounded-full cursor-pointer"
                                    wire:click="confirmLogout('single', '{{ $currentSession->id }}', '{{ $currentSession->device }}')"
                                >
                                    {{ __('vibe/settings.login_history.terminate_current_btn') }}
                                </vibe:button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Other Devices Section --}}
            @if ($otherSessions->isNotEmpty())
                <div class="space-y-2 pt-2">
                    <p class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('vibe/settings.login_history.other_devices') }}
                    </p>
                    <div class="rounded-xl border border-border/50 divide-y divide-border/40 overflow-hidden bg-muted/30">
                        @foreach ($otherSessions as $session)
                            <div class="flex justify-between items-center gap-3 p-3.5 hover:bg-muted/60 transition-colors">
                                <div class="flex items-center gap-3.5 min-w-0">
                                    <div class="flex justify-center items-center bg-primary/10 rounded-lg size-8 text-primary shrink-0">
                                        @if ($session->icon === 'smartphone')
                                            <svg class="size-4 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="12" height="18" x="6" y="3" rx="3" />
                                                <circle cx="12" cy="17" r="0.75" fill="currentColor" />
                                            </svg>
                                        @elseif ($session->icon === 'tablet')
                                            <svg class="size-4 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="16" height="20" x="4" y="2" rx="3" />
                                                <circle cx="12" cy="18" r="0.75" fill="currentColor" />
                                            </svg>
                                        @elseif ($session->icon === 'laptop')
                                            <svg class="size-4 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="18" height="12" x="3" y="4" rx="2" />
                                                <path d="M2 20h20" />
                                            </svg>
                                        @else
                                            <svg class="size-4 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                                <line x1="8" x2="16" y1="21" y2="21" />
                                                <line x1="12" x2="12" y1="17" y2="21" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="font-semibold text-foreground text-sm truncate">{{ $session->device }}</span>
                                            @if (!empty($session->is_online))
                                                <vibe:badge size="sm" variant="secondary" class="rounded-full text-[10px]">
                                                    {{ __('vibe/settings.login_history.active_now') }}
                                                </vibe:badge>
                                            @endif
                                        </div>
                                        <p class="text-xs text-muted-foreground mt-0.5 flex items-center gap-1.5 flex-wrap">
                                            <span>{{ $session->browser }} &bull; {{ $session->os }}</span>
                                            <span class="text-muted-foreground/40">&bull;</span>
                                            <span>{{ $session->last_active }}</span>
                                            <span class="text-muted-foreground/40">&bull;</span>
                                            <span class="font-mono text-[11px]">IP: {{ $session->ip_address }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <vibe:button 
                                        type="button"
                                        variant="ghost"
                                        size="xs"
                                        class="text-xs text-destructive hover:bg-destructive/10 rounded-full cursor-pointer"
                                        wire:click="confirmLogout('single', '{{ $session->id }}', '{{ $session->device }}')"
                                    >
                                        {{ __('vibe/settings.login_history.sign_out_btn') }}
                                    </vibe:button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>

    {{-- Confirmation Modal (Matching Delete User & 2FA Modal in Security Tab) --}}
    @if ($confirmingLogout)
        @php
            $isCurrent = ($logoutMode === 'single' && $selectedSessionId === $currentSession?->id);
        @endphp
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-background/80 backdrop-blur-xs">
            <div class="w-full max-w-md p-6 rounded-2xl border border-border bg-card shadow-xl space-y-4 animate-in fade-in zoom-in-95 duration-200">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-destructive/10 text-destructive shrink-0">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" x2="9" y1="12" y2="12" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-foreground">
                            @if ($logoutMode === 'all')
                                {{ __('vibe/settings.login_history.terminate_all_devices_btn') }}
                            @elseif ($logoutMode === 'other')
                                {{ __('vibe/settings.login_history.sign_out_others_btn') }}
                            @elseif ($isCurrent)
                                {{ __('vibe/settings.login_history.terminate_current_btn') }}
                            @else
                                {{ __('vibe/settings.login_history.terminate_single_title') }}
                            @endif
                        </h4>
                        <p class="text-xs text-muted-foreground">
                            @if ($logoutMode === 'all')
                                {{ __('vibe/settings.login_history.terminate_all_devices_desc') }}
                            @elseif ($logoutMode === 'other')
                                {{ __('vibe/settings.login_history.terminate_other_devices_desc') }}
                            @elseif ($isCurrent)
                                {{ __('vibe/settings.login_history.confirm_logout_this_device_desc') }}
                            @else
                                {{ __('vibe/settings.login_history.confirm_terminate_single_desc') }}
                            @endif
                        </p>
                    </div>
                </div>

                <form wire:submit.prevent="executeLogout" class="space-y-4 pt-2">
                    <div>
                        <vibe:input 
                            type="password" 
                            name="password" 
                            label="{{ __('vibe/settings.login_history.account_password') }}" 
                            viewable 
                            wire:model="password" 
                            placeholder="{{ __('vibe/settings.login_history.password_placeholder') }}" 
                            required 
                        />
                        @error('password')
                            <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-border/50">
                        <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" wire:click="$set('confirmingLogout', false)">
                            {{ __('vibe/settings.login_history.cancel') }}
                        </vibe:button>
                        <vibe:button type="submit" variant="destructive" size="sm" class="cursor-pointer" wire:loading.attr="disabled" wire:target="executeLogout">
                            <span wire:loading.remove wire:target="executeLogout">
                                @if ($logoutMode === 'all')
                                    {{ __('vibe/settings.login_history.terminate_all_devices_btn') }}
                                @elseif ($logoutMode === 'other')
                                    {{ __('vibe/settings.login_history.sign_out_others_btn') }}
                                @elseif ($isCurrent)
                                    {{ __('vibe/settings.login_history.terminate_current_btn') }}
                                @else
                                    {{ __('vibe/settings.login_history.sign_out_btn') }}
                                @endif
                            </span>
                            <span wire:loading.inline-flex wire:target="executeLogout" class="inline-flex items-center justify-center gap-1.5 leading-none">
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
