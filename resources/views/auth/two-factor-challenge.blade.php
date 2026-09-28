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
        <vibe:card.alert variant="destructive" size="sm" dismissible animation="shake">
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
                <svg class="size-4 shrink-0 mt-0.5 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 12l5 5L20 6"/>
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
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10C4 6.229 4 4.343 5.172 3.172 6.343 2 8.229 2 12 2c3.771 0 5.657 0 6.828 1.172C20 4.343 20 6.229 20 10v4c0 3.771 0 5.657-1.172 6.828C17.657 22 15.771 22 12 22c-3.771 0-5.657 0-6.828-1.172C4 19.657 4 17.771 4 14v-4Z"/><path d="M15 19H9"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.totp_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">Google Authenticator / Authy</p>
                                    </div>
                                @elseif ($selectedMethod === 'email')
                                    <div class="size-8 rounded-lg bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12C2 8.229 2 6.343 3.172 5.172 4.343 4 6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172C22 6.343 22 8.229 22 12c0 3.771 0 5.657-1.172 6.828C19.657 20 17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172C2 17.657 2 15.771 2 12Z"/><path d="m6 8 2.159 1.799C9.996 11.33 10.914 12.095 12 12.095c1.086 0 2.005-.765 3.841-2.296L18 8"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.email_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">{{ $availableMethods['email']['description'] ?? '' }}</p>
                                    </div>
                                @elseif ($selectedMethod === 'whatsapp')
                                    <div class="size-8 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.523 22 22 17.523 22 12S17.523 2 12 2 2 6.477 2 12c0 1.6.376 3.112 1.043 4.453.178.356.237.763.134 1.148l-.595 2.226c-.259.966.625 1.85 1.591 1.592l2.226-.596c.385-.103.792-.044 1.148.134A9.957 9.957 0 0 0 12 22Z"/><path d="M8 10.5h8M8 14h5.5"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ __('auth/two_factor.whatsapp_title') }}</p>
                                        <p class="text-[11px] text-muted-foreground truncate">{{ $availableMethods['whatsapp']['description'] ?? '' }}</p>
                                    </div>
                                @elseif ($selectedMethod === 'sms')
                                    <div class="size-8 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0">
                                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18.676 19.963c.516-.05 1.014-.329 1.325-.709l1.42-1.496c.96-1.01.69-2.74-.537-3.447l-1.91-1.1c-.806-.464-1.787-.327-2.417.336l-.455.48s-1.083 1.14-4.038-1.972c-2.955-3.11-1.873-4.25-1.873-4.25l.287-.302c.707-.744.773-1.938.157-2.81L9.373 2.91C8.61 1.83 7.136 1.688 6.261 2.609L4.692 4.261c-.434.457-.724 1.048-.689 1.705.09 1.68.808 5.293 4.812 9.51 4.247 4.47 8.232 4.648 9.861 4.487Z"/></svg>
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
                        <vibe:button 
                            type="submit" 
                            variant="primary" 
                            class="w-full justify-center shadow-xs cursor-pointer" 
                            wire:target="challenge" 
                            :loading="__('auth/two_factor.verifying')"
                        >
                            {{ __('auth/two_factor.verify_and_login') }} &rarr;
                        </vibe:button>
                    </div>
                @else
                    {{-- Mode Kode Pemulihan Darurat --}}
                    <div class="space-y-3">
                        <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-1">
                            <p class="font-semibold flex items-center gap-1.5">
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16h.01"/>
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
                        <vibe:button 
                            type="submit" 
                            variant="primary" 
                            class="w-full justify-center shadow-xs cursor-pointer" 
                            wire:target="challenge" 
                            :loading="__('auth/two_factor.verifying')"
                        >
                            {{ __('auth/two_factor.verify_recovery') }} &rarr;
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
                            <svg class="size-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 7H4M15 12H4M9 17H4"/>
                            </svg>
                            <span>{{ __('auth/two_factor.choose_another_way') }}</span>
                        </span>
                        <svg class="size-4 text-muted-foreground group-hover:text-foreground group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Cancel Link (Hanya ada di layar verifikasi) --}}
            <div class="pt-1 flex items-center justify-center text-xs">
                <button type="button" wire:click="cancel" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1.5 transition-colors cursor-pointer">
                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 19l-7-7 7-7"/>
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
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10C4 6.229 4 4.343 5.172 3.172 6.343 2 8.229 2 12 2c3.771 0 5.657 0 6.828 1.172C20 4.343 20 6.229 20 10v4c0 3.771 0 5.657-1.172 6.828C17.657 22 15.771 22 12 22c-3.771 0-5.657 0-6.828-1.172C4 19.657 4 17.771 4 14v-4Z"/><path d="M15 19H9"/></svg>
                                @elseif ($methodKey === 'email')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12C2 8.229 2 6.343 3.172 5.172 4.343 4 6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172C22 6.343 22 8.229 22 12c0 3.771 0 5.657-1.172 6.828C19.657 20 17.771 20 14 20h-4c-3.771 0-5.657 0-6.828-1.172C2 17.657 2 15.771 2 12Z"/><path d="m6 8 2.159 1.799C9.996 11.33 10.914 12.095 12 12.095c1.086 0 2.005-.765 3.841-2.296L18 8"/></svg>
                                @elseif ($methodKey === 'whatsapp')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.523 22 22 17.523 22 12S17.523 2 12 2 2 6.477 2 12c0 1.6.376 3.112 1.043 4.453.178.356.237.763.134 1.148l-.595 2.226c-.259.966.625 1.85 1.591 1.592l2.226-.596c.385-.103.792-.044 1.148.134A9.957 9.957 0 0 0 12 22Z"/><path d="M8 10.5h8M8 14h5.5"/></svg>
                                @elseif ($methodKey === 'sms')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18.676 19.963c.516-.05 1.014-.329 1.325-.709l1.42-1.496c.96-1.01.69-2.74-.537-3.447l-1.91-1.1c-.806-.464-1.787-.327-2.417.336l-.455.48s-1.083 1.14-4.038-1.972c-2.955-3.11-1.873-4.25-1.873-4.25l.287-.302c.707-.744.773-1.938.157-2.81L9.373 2.91C8.61 1.83 7.136 1.688 6.261 2.609L4.692 4.261c-.434.457-.724 1.048-.689 1.705.09 1.68.808 5.293 4.812 9.51 4.247 4.47 8.232 4.648 9.861 4.487Z"/></svg>
                                @elseif ($methodKey === 'recovery')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15.681 14.587C19.171 14.587 22 11.769 22 8.293 22 4.818 19.171 2 15.681 2c-3.49 0-6.32 2.818-6.32 6.293 0 1.61.735 2.781.735 2.781L2.454 18.685a2.036 2.036 0 0 0 0 2.049l.882.878c.343.293 1.205.703 1.91.001l1.029-1.025c1.029 1.025 2.204.439 2.645-.146.735-1.025-.147-2.049-.147-2.049l.294-.293c1.41 1.405 2.645.586 3.086 0 .735-1.024 0-2.049 0-2.049-.294-.585-.882-.585-.147-1.317l.882-.878c.705.586 2.155.732 2.792.732Z"/><circle cx="15.681" cy="8.294" r="2.195"/></svg>
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
                            <svg wire:loading.remove wire:target="selectMethod('{{ $methodKey }}')" class="size-4 text-muted-foreground group-hover:text-primary group-hover:translate-x-0.5 transition-all" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5l7 7-7 7"/>
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
                    <svg class="size-3.5 mr-1.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>{{ __('auth/two_factor.back_to_challenge') }}</span>
                </vibe:button>
            </div>
        </div>
    @endif
</div>
