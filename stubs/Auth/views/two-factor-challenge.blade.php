<div class="space-y-6">
    {{-- Dynamic Header Section --}}
    @if (! $showingMethodSelector)
        <div class="space-y-1">
            <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                {{ __('auth/two_factor.title') }}
            </h1>
            <p class="text-xs sm:text-sm text-muted-foreground">
                @if ($selectedMethod === 'recovery')
                    {{ __('auth/two_factor.recovery_desc') }}
                @elseif ($selectedMethod === 'email')
                    {{ __('auth/two_factor.email_desc') }}
                @elseif ($selectedMethod === 'whatsapp')
                    {{ __('auth/two_factor.whatsapp_desc') }}
                @elseif ($selectedMethod === 'sms')
                    {{ __('auth/two_factor.sms_desc') }}
                @else
                    {{ __('auth/two_factor.totp_desc') }}
                @endif
            </p>
        </div>
    @else
        <div class="space-y-1">
            <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                {{ __('auth/two_factor.select_title') }}
            </h1>
            <p class="text-xs sm:text-sm text-muted-foreground">
                {{ __('auth/two_factor.select_description') }}
            </p>
        </div>
    @endif

    {{-- Error Feedback --}}
    @if ($errors->any())
        <vibe:card.alert variant="destructive" size="sm" dismissible>
            <x-slot:description>
                {{ $errors->first() }}
            </x-slot:description>
        </vibe:card.alert>
    @endif

    {{-- Status Pengiriman Kode Berjalan Otomatis (Email / WhatsApp / SMS) --}}
    @if (! $showingMethodSelector && in_array($selectedMethod, ['email', 'whatsapp', 'sms']) && ! $codeSent)
        <div x-init="$wire.sendOtp()" class="p-3 rounded-xl bg-primary/10 border border-primary/20 text-xs text-primary flex items-center justify-between gap-3 animate-pulse">
            <div class="flex items-center gap-2">
                <svg class="animate-spin size-4 shrink-0 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>{{ __('auth/two_factor.sending_code') }}</span>
            </div>
        </div>
    @endif

    {{-- Info Notifikasi Pengiriman Kode Berhasil (Email / WhatsApp / SMS) --}}
    @if ($sentMessage && in_array($selectedMethod, ['email', 'whatsapp', 'sms']))
        <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-400 flex items-start justify-between gap-3">
            <div class="flex items-start gap-2">
                <svg class="size-4 shrink-0 mt-0.5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                <div class="space-y-0.5">
                    <p class="font-semibold">{{ $sentMessage }}</p>
                    <p class="text-[11px] text-muted-foreground">{{ __('auth/two_factor.check_inbox') }}</p>
                </div>
            </div>

            <button 
                type="button" 
                wire:click="sendOtp" 
                wire:loading.attr="disabled"
                class="shrink-0 text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 hover:underline cursor-pointer disabled:opacity-50"
            >
                <span wire:loading.remove wire:target="sendOtp">{{ __('auth/two_factor.resend_code') }}</span>
                <span wire:loading wire:target="sendOtp">{{ __('auth/two_factor.resending') }}</span>
            </button>
        </div>
    @endif

    @if (! $showingMethodSelector)
        {{-- LAYAR 1: FORM VERIFIKASI (CHALLENGE) --}}
        <div class="space-y-5 animate-in fade-in duration-200">
            <form wire:submit="challenge" class="space-y-5">
                @if ($selectedMethod !== 'recovery')
                    {{-- Mode Kode OTP 6-Digit (TOTP, Email, WhatsApp, SMS) --}}
                    <div class="space-y-3">
                        <div class="p-3 rounded-xl border border-border bg-muted flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5 min-w-0">
                                @if ($selectedMethod === 'totp')
                                    <div class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.totp_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">Google Authenticator / Authy</p>
                                    </div>
                                @elseif ($selectedMethod === 'email')
                                    <div class="size-8 rounded-lg bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.email_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">{{ $availableMethods['email']['description'] ?? '' }}</p>
                                    </div>
                                @elseif ($selectedMethod === 'whatsapp')
                                    <div class="size-8 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.whatsapp_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">{{ $availableMethods['whatsapp']['description'] ?? '' }}</p>
                                    </div>
                                @elseif ($selectedMethod === 'sms')
                                    <div class="size-8 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.sms_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">{{ $availableMethods['sms']['description'] ?? '' }}</p>
                                    </div>
                                @endif
                            </div>

                            @if (isset($availableMethods[$selectedMethod]['badge']))
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-primary/10 text-primary shrink-0">
                                    {{ $availableMethods[$selectedMethod]['badge'] }}
                                </span>
                            @endif
                        </div>

                        <div class="py-6 flex justify-center items-center w-full">
                            <vibe:input.otp
                                id="two-factor-otp"
                                name="code"
                                length="6"
                                wire:model="code"
                                auto-submit
                            />
                        </div>

                        @if (in_array($selectedMethod, ['email', 'whatsapp', 'sms']))
                            <div class="flex items-center justify-between text-xs text-muted-foreground pt-1">
                                <span>{{ __('auth/two_factor.didnt_receive') }}</span>
                                <button 
                                    type="button" 
                                    wire:click="sendOtp" 
                                    wire:loading.attr="disabled"
                                    class="text-primary hover:underline font-medium cursor-pointer"
                                >
                                    <span wire:loading.remove wire:target="sendOtp">{{ __('auth/two_factor.resend_code') }}</span>
                                    <span wire:loading wire:target="sendOtp">{{ __('auth/two_factor.resending') }}</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="pt-1">
                        <vibe:button type="submit" variant="primary" class="w-full justify-center shadow-xs cursor-pointer" wire:loading.attr="disabled" wire:target="challenge">
                            <span wire:loading.remove wire:target="challenge">{{ __('auth/two_factor.verify_and_login') }} &rarr;</span>
                            <span wire:loading.inline-flex wire:target="challenge" class="inline-flex items-center justify-center gap-2">
                                <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>{{ __('auth/two_factor.verifying') }}</span>
                            </span>
                        </vibe:button>
                    </div>
                @else
                    {{-- Mode Kode Pemulihan Darurat --}}
                    <div class="space-y-3">
                        <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-1">
                            <p class="font-semibold flex items-center gap-1.5">
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                </svg>
                                <span>{{ __('auth/two_factor.recovery_box_title') }}</span>
                            </p>
                            <p class="leading-relaxed">
                                {{ __('auth/two_factor.recovery_box_desc') }}
                            </p>
                        </div>

                        <vibe:input 
                            wire:model="recovery_code"
                            id="recovery_code"
                            name="recovery_code"
                            label="{{ __('auth/two_factor.recovery_code_label') }}"
                            placeholder="xxxx-xxxx-xxxx"
                            required
                            autofocus
                            autocomplete="one-time-code"
                        />
                    </div>

                    {{-- Tombol Submit Recovery --}}
                    <div class="pt-1">
                        <vibe:button type="submit" variant="primary" class="w-full justify-center shadow-xs cursor-pointer" wire:loading.attr="disabled" wire:target="challenge">
                            <span wire:loading.remove wire:target="challenge">{{ __('auth/two_factor.verify_recovery') }} &rarr;</span>
                            <span wire:loading.inline-flex wire:target="challenge" class="inline-flex items-center justify-center gap-2">
                                <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>{{ __('auth/two_factor.verifying') }}</span>
                            </span>
                        </vibe:button>
                    </div>
                @endif
            </form>

            {{-- Tombol Switcher: Coba Cara Verifikasi Lain --}}
            @if (count($availableMethods) > 1)
                <div class="pt-2 border-t border-border/70">
                    <button 
                        type="button" 
                        wire:click="toggleMethodSelector" 
                        class="w-full py-2.5 px-3 rounded-xl border border-border/80 bg-muted/30 hover:bg-muted/70 text-xs font-semibold text-foreground flex items-center justify-between transition-all cursor-pointer group"
                    >
                        <span class="flex items-center gap-2">
                            <svg class="size-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 8h10"/><path d="M7 12h10"/><path d="M7 16h10"/>
                            </svg>
                            <span>{{ __('auth/two_factor.choose_another_way') }}</span>
                        </span>
                        <svg class="size-4 text-muted-foreground group-hover:text-foreground group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Cancel Link (Hanya ada di layar verifikasi) --}}
            <div class="pt-1 flex items-center justify-center text-xs">
                <button type="button" wire:click="cancel" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1.5 transition-colors cursor-pointer">
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    <span>{{ __('auth/two_factor.cancel_and_login') }}</span>
                </button>
            </div>
        </div>
    @else
        {{-- LAYAR 2: PILIH METODE VERIFIKASI (SEPERTI DI HALAMAN LAIN TAPI TETAP DI SINI) --}}
        <div class="space-y-4 animate-in fade-in duration-200">
            {{-- Daftar Kartu Pilihan Metode --}}
            <div class="space-y-2.5">
                @foreach ($availableMethods as $methodKey => $methodInfo)
                    <button 
                        type="button" 
                        wire:click="selectMethod('{{ $methodKey }}')" 
                        wire:loading.attr="disabled"
                        class="w-full p-3.5 rounded-xl border text-left flex items-center justify-between transition-all duration-150 cursor-pointer group {{ $selectedMethod === $methodKey ? 'border-primary/50 bg-primary/5 ring-1 ring-primary/30' : 'border-border/80 bg-card hover:bg-muted/50 hover:border-border' }}"
                    >
                        <div class="flex items-center gap-3.5 min-w-0">
                            <div class="size-10 rounded-xl flex items-center justify-center shrink-0 {{ $selectedMethod === $methodKey ? 'bg-primary text-primary-foreground shadow-xs' : 'bg-muted text-muted-foreground group-hover:text-primary group-hover:bg-primary/10 transition-colors' }}">
                                @if ($methodKey === 'totp')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                                @elseif ($methodKey === 'email')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                @elseif ($methodKey === 'whatsapp')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                                @elseif ($methodKey === 'sms')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                @elseif ($methodKey === 'recovery')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="7.5" cy="15.5" r="5.5"/><path d="m21 2-9.6 9.6"/><path d="m15.5 7.5 3 3L22 7l-3-3"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-semibold text-foreground group-hover:text-primary transition-colors">{{ $methodInfo['name'] }}</p>
                                    @if ($selectedMethod === $methodKey)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-primary/10 text-primary">
                                            {{ __('auth/two_factor.active_badge') }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-muted-foreground truncate mt-0.5">{{ $methodInfo['description'] }}</p>
                            </div>
                        </div>

                        <div class="shrink-0 ml-3 flex items-center gap-2">
                            <span wire:loading.inline-flex wire:target="selectMethod('{{ $methodKey }}')" class="size-4 items-center justify-center">
                                <svg class="animate-spin size-4 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                            <svg wire:loading.remove wire:target="selectMethod('{{ $methodKey }}')" class="size-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </div>
                    </button>
                @endforeach
            </div>

            {{-- Tombol Navigasi Layar Pemilihan (Hanya ada tombol Kembali ke Verifikasi) --}}
            <div class="pt-2">
                <vibe:button 
                    type="button" 
                    variant="outline" 
                    wire:click="toggleMethodSelector" 
                    class="w-full justify-center text-xs font-semibold cursor-pointer shadow-2xs"
                >
                    <svg class="size-3.5 mr-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                    <span>{{ __('auth/two_factor.back_to_challenge') }}</span>
                </vibe:button>
            </div>
        </div>
    @endif
</div>
