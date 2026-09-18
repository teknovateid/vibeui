<div x-data="vibeTwoFactorSettings()">
    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
        <div class="space-y-1 max-w-lg w-full">
            <div class="flex items-center gap-2">
                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.two_factor.title') }}</h3>
                <div>
                    <vibe:badge size="sm" variant="success" class="rounded-full font-semibold" x-show="enabled" x-cloak>
                        {{ __('vibe/settings.two_factor.enabled') }}
                    </vibe:badge>
                    <vibe:badge size="sm" variant="secondary" class="rounded-full font-medium" x-show="!enabled">
                        {{ __('vibe/settings.two_factor.disabled') }}
                    </vibe:badge>
                </div>
            </div>
            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.two_factor.desc') }}</p>
        </div>

        <div class="space-y-4 w-full">
            {{-- Header & Quick Info --}}
            <div class="flex justify-between items-center gap-3">
                <div>
                    <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.two_factor.methods_title') }}</p>
                    <p class="text-xs text-muted-foreground">{{ __('vibe/settings.two_factor.methods_desc') }}</p>
                </div>
            </div>

            {{-- Daftar Pilihan Metode 2FA --}}
            <div class="space-y-2.5">
                {{-- Metode 1: Authenticator App (TOTP) --}}
                <div class="flex justify-between items-center gap-3 bg-muted p-3 rounded-xl transition-colors">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex justify-center items-center bg-primary/10 rounded-lg size-9 text-primary shrink-0">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                                <path d="M12 18h.01" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.two_factor.totp_title') }}</p>
                            </div>
                            <p class="text-xs text-muted-foreground truncate">{{ __('vibe/settings.two_factor.totp_desc') }}</p>
                        </div>
                    </div>
                    <div class="shrink-0 flex items-center gap-1.5">
                        <vibe:button variant="primary" type="button" size="xs" x-show="!totpEnabled" @click="openSetup('totp')" ::disabled="loading" class="rounded-full">
                            {{ __('vibe/settings.two_factor.enable_btn') }}
                        </vibe:button>
                        <vibe:button.delete class="rounded-full" size="xs" x-show="totpEnabled" x-cloak action="disable2FA('totp')" :title="__('vibe/settings.two_factor.disable_totp_title')" :message="__('vibe/settings.two_factor.disable_totp_confirm')">
                            {{ __('vibe/settings.two_factor.disable_btn') }}
                        </vibe:button.delete>
                    </div>
                </div>

                {{-- Metode 2: Email OTP --}}
                <div class="flex justify-between items-center gap-3 bg-muted p-3 rounded-xl transition-colors">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex justify-center items-center bg-blue-500/10 rounded-lg size-9 text-blue-600 dark:text-blue-400 shrink-0">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.two_factor.email_title') }}</p>
                            </div>
                            <p class="text-xs text-muted-foreground truncate" x-text="userEmail ? '{{ __('vibe/settings.two_factor.email_desc') }}' + ' (' + userEmail + ')' : '{{ __('vibe/settings.two_factor.email_desc') }}'"></p>
                        </div>
                    </div>
                    <div class="shrink-0 flex items-center gap-1.5">
                        <vibe:button variant="primary" type="button" size="xs" x-show="!emailEnabled" @click="openSetup('email')" ::disabled="loading" class="rounded-full">
                            {{ __('vibe/settings.two_factor.enable_btn') }}
                        </vibe:button>
                        <vibe:button.delete class="rounded-full" size="xs" x-show="emailEnabled" x-cloak action="disable2FA('email')" :title="__('vibe/settings.two_factor.disable_email_title')" :message="__('vibe/settings.two_factor.disable_email_confirm')">
                            {{ __('vibe/settings.two_factor.disable_btn') }}
                        </vibe:button.delete>
                    </div>
                </div>

                {{-- Metode 3: WhatsApp / SMS OTP (Stub) --}}
                <div class="flex justify-between items-center gap-3 bg-muted/10 opacity-75 p-3 border border-border/70 border-dashed rounded-xl">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex justify-center items-center bg-emerald-500/10 rounded-lg size-9 text-emerald-600 dark:text-emerald-400 shrink-0">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.two_factor.whatsapp_title') }}</p>
                                <vibe:badge size="sm" variant="secondary" class="rounded-full">{{ __('vibe/settings.two_factor.coming_soon') }}</vibe:badge>
                            </div>
                            <p class="text-xs text-muted-foreground truncate">{{ __('vibe/settings.two_factor.whatsapp_desc') }}</p>
                        </div>
                    </div>
                    <div class="shrink-0">
                        <vibe:badge size="sm" variant="outline" class="rounded-full font-mono">{{ __('vibe/settings.two_factor.stub_ready') }}</vibe:badge>
                    </div>
                </div>
            </div>

            {{-- Footer: Recovery Codes --}}
            <div x-show="enabled" x-cloak class="flex flex-wrap justify-between items-center gap-2 pt-3 border-border/50 border-t">
                <div class="text-muted-foreground text-xs">
                    <span>{{ __('vibe/settings.two_factor.recovery_codes_title') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <vibe:button type="button" variant="outline" size="xs" @click="openRecoveryCodes()" ::disabled="loading" class="cursor-pointer">
                        {{ __('vibe/settings.two_factor.view_codes_btn') }}
                    </vibe:button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Setup 2FA: Authenticator App (TOTP) --}}
    <vibe:modal id="modal-2fa-totp">
        <form wire:submit="confirmTwoFactor">
            <vibe:modal.header>
                <div class="font-semibold text-foreground text-base">
                    <span x-show="step === 0">{{ __('vibe/settings.two_factor.setup_totp_title') }}</span>
                    <span x-show="step === 1" x-cloak>{{ __('vibe/settings.two_factor.save_recovery_title') }}</span>
                </div>
                <p class="mt-0.5 font-normal text-muted-foreground text-xs">
                    <span x-show="step === 0">{{ __('vibe/settings.two_factor.setup_totp_desc') }}</span>
                    <span x-show="step === 1" x-cloak>{{ __('vibe/settings.two_factor.save_recovery_desc') }}</span>
                </p>
            </vibe:modal.header>

            <vibe:modal.content>
                {{-- Feedback Alert --}}
                <div x-show="feedback && feedbackType === 'success'" x-cloak class="mb-4">
                    <vibe:card.alert variant="success" size="sm" animation="pop">
                        <span x-text="feedback"></span>
                    </vibe:card.alert>
                </div>
                <div x-show="feedback && feedbackType === 'error'" x-cloak class="mb-4">
                    <vibe:card.alert variant="destructive" size="sm" animation="shake">
                        <span x-text="feedback"></span>
                    </vibe:card.alert>
                </div>

                {{-- Step 0: QR Code & OTP --}}
                <div x-show="step === 0" class="space-y-5">
                    <div class="flex sm:flex-row flex-col items-center gap-5 bg-muted/40 p-4 border border-border rounded-xl">
                        <vibe:display.qrcode 
                            x-bind:value="qrCodeUrl" 
                            :size="180" 
                            level="M" 
                            :margin="4"
                            class="rounded-xl bg-white shadow-2xs border border-border/80 shrink-0" 
                        />
                        <div class="flex-1 space-y-2 sm:text-left text-center">
                            <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.two_factor.scan_qr_title') }}</p>
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                {{ __('vibe/settings.two_factor.scan_qr_desc') }}
                            </p>
                            <div class="pt-1">
                                <span class="block mb-1 text-xs text-muted-foreground">{{ __('vibe/settings.two_factor.or_manual_key') }}</span>
                                <div class="flex items-center gap-1.5">
                                    <code class="flex-1 bg-background px-2.5 py-1 border border-border rounded font-mono text-xs text-foreground truncate tracking-wider select-all" x-text="secretKey"></code>
                                    <vibe:button type="button" variant="outline" size="xs" @click="copySecret()" class="cursor-pointer shrink-0">
                                        <span x-text="copiedSecret ? '{{ __('vibe/settings.two_factor.copied') }}' : '{{ __('vibe/settings.two_factor.copy') }}'"></span>
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="flex justify-between items-center font-semibold text-foreground text-xs">
                            <span>{{ __('vibe/settings.two_factor.enter_app_code') }}</span>
                            <span class="font-normal text-xs text-muted-foreground">{{ __('vibe/settings.two_factor.can_paste') }}</span>
                        </label>
                        <div>
                            <vibe:input.otp id="setup-2fa-otp-totp" wire:model="code" :auto-submit="true" length="6" size="md" />
                        </div>
                    </div>
                </div>

                {{-- Step 1: Recovery Codes --}}
                <div x-show="step === 1" x-cloak class="space-y-4">
                    <vibe:card.alert variant="warning" size="sm" :title="__('vibe/settings.two_factor.recovery_warning_title')">
                        {{ __('vibe/settings.two_factor.recovery_warning_desc_totp') }}
                    </vibe:card.alert>

                    <div class="gap-2 grid grid-cols-2 sm:grid-cols-4 bg-muted/40 p-3.5 border border-border rounded-xl font-mono text-foreground text-xs">
                        @forelse ($recoveryCodes as $index => $c)
                            <div wire:key="recovery-code-totp-{{ $index }}" class="bg-background p-2 border border-border rounded-lg text-center select-all">
                                {{ $c }}
                            </div>
                        @empty
                            <div class="col-span-full text-center py-2 text-muted-foreground text-xs">
                                {{ __('vibe/settings.two_factor.no_recovery_codes') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </vibe:modal.content>

            <vibe:modal.footer>
                <div x-show="step === 0" class="flex justify-between items-center w-full">
                    <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('modal-2fa-totp').close()">
                        {{ __('vibe/settings.two_factor.cancel') }}
                    </vibe:button>
                    <vibe:button type="submit" variant="primary" size="sm" wire:loading.attr="disabled" class="cursor-pointer">
                        <span wire:loading.remove wire:target="confirmTwoFactor">{{ __('vibe/settings.two_factor.enable_2fa_btn') }}</span>
                        <span wire:loading wire:target="confirmTwoFactor">{{ __('vibe/settings.two_factor.verifying') }}</span>
                    </vibe:button>
                </div>

                <div x-show="step === 1" x-cloak class="flex justify-between items-center w-full">
                    <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('{{ __('vibe/settings.two_factor.copied_all_toast') }}', { type: 'success' })">
                        {{ __('vibe/settings.two_factor.copy_all') }}
                    </vibe:button>
                    <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="$vibe.modal('modal-2fa-totp').close(); $wire.set('step', 0)">
                        {{ __('vibe/settings.two_factor.done_btn') }}
                    </vibe:button>
                </div>
            </vibe:modal.footer>
        </form>
    </vibe:modal>

    {{-- Modal Setup 2FA: Email OTP --}}
    <vibe:modal id="modal-2fa-email">
        <form wire:submit="confirmTwoFactor">
            <vibe:modal.header>
                <div class="font-semibold text-foreground text-base">
                    <span x-show="step === 0">{{ __('vibe/settings.two_factor.setup_email_title') }}</span>
                    <span x-show="step === 1" x-cloak>{{ __('vibe/settings.two_factor.save_recovery_title') }}</span>
                </div>
                <p class="mt-0.5 font-normal text-muted-foreground text-xs">
                    <span x-show="step === 0">{{ __('vibe/settings.two_factor.setup_email_desc') }}</span>
                    <span x-show="step === 1" x-cloak>{{ __('vibe/settings.two_factor.save_recovery_desc') }}</span>
                </p>
            </vibe:modal.header>

            <vibe:modal.content>
                {{-- Feedback Alert --}}
                <div x-show="feedback && feedbackType === 'success'" x-cloak class="mb-4">
                    <vibe:card.alert variant="success" size="sm" animation="pop">
                        <span x-text="feedback"></span>
                    </vibe:card.alert>
                </div>
                <div x-show="feedback && feedbackType === 'info'" x-cloak class="mb-4">
                    <vibe:card.alert variant="info" size="sm" animation="pulse">
                        <span x-text="feedback"></span>
                    </vibe:card.alert>
                </div>
                <div x-show="feedback && feedbackType === 'error'" x-cloak class="mb-4">
                    <vibe:card.alert variant="destructive" size="sm" animation="shake">
                        <span x-text="feedback"></span>
                    </vibe:card.alert>
                </div>

                {{-- Step 0: Email Info & OTP --}}
                <div x-show="step === 0" class="space-y-5">
                    <div class="flex items-start gap-3.5 bg-blue-500/5 p-4 border border-blue-500/20 rounded-xl">
                        <div class="flex justify-center items-center bg-blue-500/10 mt-0.5 rounded-lg size-9 text-blue-600 dark:text-blue-400 shrink-0">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="16" x="2" y="4" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </div>
                        <div class="flex-1 space-y-1 text-xs">
                            <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.two_factor.email_sent_title') }}</p>
                            <p class="text-muted-foreground leading-relaxed">
                                {!! __('vibe/settings.two_factor.email_sent_desc', ['email' => '<span class="font-mono font-medium text-foreground" x-text="userEmail"></span>']) !!}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="font-semibold text-foreground text-xs">
                                {{ __('vibe/settings.two_factor.enter_email_code') }}
                            </label>
                            <div class="text-xs">
                                <span x-show="cooldown > 0" class="text-muted-foreground">{{ __('vibe/settings.two_factor.resend_in', ['seconds' => '']) }}<span class="font-mono font-semibold" x-text="cooldown"></span>s</span>
                                <vibe:button type="button" variant="link" size="xs" x-show="cooldown <= 0" wire:click="resendEmailOtp" wire:loading.attr="disabled" class="cursor-pointer font-semibold">
                                    <span wire:loading.remove wire:target="resendEmailOtp">{{ __('vibe/settings.two_factor.resend_btn') }}</span>
                                    <span wire:loading wire:target="resendEmailOtp">{{ __('vibe/settings.two_factor.sending') }}</span>
                                </vibe:button>
                            </div>
                        </div>
                        <div>
                            <vibe:input.otp id="setup-2fa-otp-email" wire:model="code" :auto-submit="true" length="6" size="md" />
                        </div>
                    </div>
                </div>

                {{-- Step 1: Recovery Codes --}}
                <div x-show="step === 1" x-cloak class="space-y-4">
                    <vibe:card.alert variant="warning" size="sm" :title="__('vibe/settings.two_factor.recovery_warning_title')">
                        {{ __('vibe/settings.two_factor.recovery_warning_desc_email') }}
                    </vibe:card.alert>

                    <div class="gap-2 grid grid-cols-2 sm:grid-cols-4 bg-muted/40 p-3.5 border border-border rounded-xl font-mono text-foreground text-xs">
                        @forelse ($recoveryCodes as $index => $c)
                            <div wire:key="recovery-code-email-{{ $index }}" class="bg-background p-2 border border-border rounded-lg text-center select-all">
                                {{ $c }}
                            </div>
                        @empty
                            <div class="col-span-full text-center py-2 text-muted-foreground text-xs">
                                {{ __('vibe/settings.two_factor.no_recovery_codes') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </vibe:modal.content>

            <vibe:modal.footer>
                <div x-show="step === 0" class="flex justify-between items-center w-full">
                    <vibe:button type="button" variant="outline" size="sm" @click="$vibe.modal('modal-2fa-email').close()">
                        {{ __('vibe/settings.two_factor.cancel') }}
                    </vibe:button>
                    <vibe:button type="submit" variant="primary" size="sm" wire:loading.attr="disabled" class="cursor-pointer">
                        <span wire:loading.remove wire:target="confirmTwoFactor">{{ __('vibe/settings.two_factor.enable_2fa_btn') }}</span>
                        <span wire:loading wire:target="confirmTwoFactor">{{ __('vibe/settings.two_factor.verifying') }}</span>
                    </vibe:button>
                </div>

                <div x-show="step === 1" x-cloak class="flex justify-between items-center w-full">
                    <vibe:button type="button" variant="outline" size="sm" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('{{ __('vibe/settings.two_factor.copied_all_toast') }}', { type: 'success' })">
                        {{ __('vibe/settings.two_factor.copy_all') }}
                    </vibe:button>
                    <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="$vibe.modal('modal-2fa-email').close(); $wire.set('step', 0)">
                        {{ __('vibe/settings.two_factor.done_btn') }}
                    </vibe:button>
                </div>
            </vibe:modal.footer>
        </form>
    </vibe:modal>

    {{-- Modal View Recovery Codes --}}
    <vibe:modal id="modal-2fa-recovery" maxWidth="md">
        <vibe:modal.header>
            <div class="font-semibold text-foreground text-base">{{ __('vibe/settings.two_factor.recovery_modal_title') }}</div>
            <p class="mt-0.5 font-normal text-muted-foreground text-xs">{{ __('vibe/settings.two_factor.recovery_modal_subtitle') }}</p>
        </vibe:modal.header>

        <vibe:modal.content>
            <div class="space-y-4">
                <vibe:card.alert variant="warning" size="sm">
                    {{ __('vibe/settings.two_factor.recovery_modal_alert') }}
                </vibe:card.alert>

                <div class="gap-2 grid grid-cols-2 bg-muted/40 p-3.5 border border-border rounded-xl font-mono text-foreground text-xs">
                    @forelse ($recoveryCodes as $index => $c)
                        <div wire:key="recovery-code-view-{{ $index }}" class="bg-background p-2 border border-border rounded-lg text-center select-all">
                            {{ $c }}
                        </div>
                    @empty
                        <div class="col-span-full text-center py-2 text-muted-foreground text-xs">
                            {{ __('vibe/settings.two_factor.no_recovery_codes') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </vibe:modal.content>

        <vibe:modal.footer>
            <div class="flex justify-between items-center w-full">
                <vibe:button type="button" variant="ghost" size="xs" class="hover:bg-destructive/10 text-destructive cursor-pointer" @click="if(confirm('{{ __('vibe/settings.two_factor.regenerate_codes_btn') }}?')) $wire.regenerateRecoveryCodes()">
                    {{ __('vibe/settings.two_factor.regenerate_new_codes') }}
                </vibe:button>
                <div class="flex items-center gap-2">
                    <vibe:button type="button" variant="outline" size="xs" class="cursor-pointer" @click="navigator.clipboard.writeText(recoveryCodes.join('\n')); if(window.vibeToast) vibeToast('{{ __('vibe/settings.two_factor.copied_all_toast') }}', { type: 'success' })">
                        {{ __('vibe/settings.two_factor.copy_all') }}
                    </vibe:button>
                    <vibe:button type="button" variant="primary" size="xs" class="cursor-pointer" @click="$vibe.modal('modal-2fa-recovery').close()">
                        {{ __('vibe/settings.two_factor.close') }}
                    </vibe:button>
                </div>
            </div>
        </vibe:modal.footer>
    </vibe:modal>

    <script>
        function vibeTwoFactorSettings() {
            return {
                loading: false,
                copiedSecret: false,
                cooldown: 0,
                cooldownTimer: null,
                emailOtpSentLocally: false,

                get totpEnabled() { return this.$wire.totpEnabled; },
                get emailEnabled() { return this.$wire.emailEnabled; },
                get enabled() { return this.totpEnabled || this.emailEnabled; },
                get userEmail() { return this.$wire.userEmail; },
                get isGuest() { return this.$wire.isGuest; },
                get step() { return this.$wire.step; },
                get secretKey() { return this.$wire.secretKey; },
                get qrCodeUrl() { return this.$wire.qrCodeUrl; },
                get feedback() { return this.$wire.feedback; },
                get feedbackType() { return this.$wire.feedbackType; },
                get recoveryCodes() { return this.$wire.recoveryCodes; },
                get emailOtpSent() { return Boolean(this.$wire.emailOtpSent || this.emailOtpSentLocally); },

                init() {
                    this.cooldown = this.$wire.cooldown || 0;
                    if (this.$wire.emailOtpSent) {
                        this.emailOtpSentLocally = true;
                    }
                    if (this.cooldown > 0) {
                        this.startCooldown(this.cooldown);
                    }

                    this.$wire.on('start-cooldown', (event) => {
                        let secs = typeof event === 'object' && event !== null ? (event.seconds || event[0]?.seconds || 60) : (event || 60);
                        this.emailOtpSentLocally = true;
                        this.startCooldown(secs);
                    });

                    this.$wire.on('vibe-toast', (event) => {
                        let data = Array.isArray(event) ? event[0] : (typeof event === 'object' && event !== null ? event : { message: event });
                        if (window.vibeToast && data?.message) {
                            vibeToast(data.message, { type: data.type || 'info', title: data.title });
                        }
                    });
                },

                async openSetup(method = 'totp') {
                    if (this.isGuest) {
                        if (window.vibeToast) {
                            vibeToast('Silakan login terlebih dahulu untuk mengaktifkan 2FA akun Anda.', {
                                type: 'warning',
                                title: 'Perlu Login'
                            });
                        }
                        return;
                    }

                    // Jika metode email dan OTP sudah terkirim serta countdown masih berjalan:
                    // Tampilkan kembali modal sebelumnya tanpa request kirim email baru ke server!
                    if (method === 'email' && this.emailOtpSent && this.cooldown > 0) {
                        if (window.$vibe && window.$vibe.modal) {
                            window.$vibe.modal('modal-2fa-email').show();
                        } else {
                            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'modal-2fa-email' }));
                        }
                        return;
                    }

                    this.loading = true;
                    try {
                        if (method === 'totp') {
                            await this.$wire.setupTotp();
                        } else if (method === 'email') {
                            await this.$wire.setupEmail();
                        }
                    } finally {
                        this.loading = false;
                    }
                },

                startCooldown(seconds) {
                    if (this.cooldownTimer) clearInterval(this.cooldownTimer);
                    this.cooldown = seconds;
                    this.cooldownTimer = setInterval(() => {
                        if (this.cooldown > 0) {
                            this.cooldown--;
                        } else {
                            clearInterval(this.cooldownTimer);
                            this.cooldownTimer = null;
                        }
                    }, 1000);
                },

                copySecret() {
                    if (this.secretKey) {
                        navigator.clipboard.writeText(this.secretKey);
                        this.copiedSecret = true;
                        setTimeout(() => {
                            this.copiedSecret = false;
                        }, 2000);
                    }
                },

                async openRecoveryCodes() {
                    this.loading = true;
                    try {
                        await this.$wire.getRecoveryCodes();
                    } finally {
                        this.loading = false;
                    }
                },

                async disable2FA(method) {
                    if (!method) return;
                    this.loading = true;
                    try {
                        await this.$wire.disable(method);
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }

        if (typeof window !== 'undefined') {
            window.vibeTwoFactorSettings = vibeTwoFactorSettings;
            if (window.Alpine) {
                window.Alpine.data('vibeTwoFactorSettings', vibeTwoFactorSettings);
            } else {
                document.addEventListener('alpine:init', () => {
                    window.Alpine.data('vibeTwoFactorSettings', vibeTwoFactorSettings);
                });
            }
        }
    </script>
</div>
