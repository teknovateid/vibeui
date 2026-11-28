@php
    $defaultQrTtl = max(10, (int) config('vibe.auth.qr_login.ttl', 120));
    $initialRemainingQrTtl = $qrExpiresAt ? max(0, $qrExpiresAt - now()->timestamp) : $defaultQrTtl;
    $initialQrPayload = ($qrMode && in_array($qrStatus, ['pending', 'scanned', 'approved'], true) && $qrToken)
        ? [
            'token' => $qrToken,
            'ttl' => $initialRemainingQrTtl,
            'expiresAt' => $qrExpiresAt,
            'status' => $qrStatus,
            'exchangeCode' => $qrExchangeCode,
            'autoRefresh' => $qrAutoRefresh,
            'maxAutoRefresh' => $qrMaxAutoRefresh,
            'config' => $qrClientConfig,
        ]
        : null;
@endphp

<div
    class="space-y-5"
    @if (config('vibe.auth.qr_login.enabled', true))
        x-data="typeof window.vibeQrLogin === 'function' ? window.vibeQrLogin({ labels: @js(__('auth/qr_login')) }) : {
            status: 'pending',
            remainingSeconds: {{ $defaultQrTtl }},
            errorMessage: null,
            resetAutoRefresh() {},
            formattedRemaining() {
                const total = Math.max(0, Number(this.remainingSeconds || 0));
                const mins = Math.floor(total / 60);
                const secs = total % 60;
                return String(mins).padStart(2, '0') + ':' + String(secs).padStart(2, '0');
            },
            statusMessage() {
                let s = this.status;
                const el = this.$el?.querySelector('[data-qr-challenge]');
                if (el && el.dataset.qrChallenge) {
                    try { s = JSON.parse(el.dataset.qrChallenge).status || s; } catch (e) {}
                }
                return s === 'scanned' ? @js(__('auth/qr_login.status_scanned')) : @js(__('auth/qr_login.status_pending'));
            },
            init() {
                var self = this;
                const el = this.$el?.querySelector('[data-qr-challenge]');
                if (el && el.dataset.qrChallenge) {
                    try {
                        const parsed = JSON.parse(el.dataset.qrChallenge);
                        if (parsed && parsed.ttl !== undefined) {
                            this.remainingSeconds = Number(parsed.ttl) || 0;
                        }
                        if (parsed && parsed.status) {
                            this.status = parsed.status;
                        }
                    } catch (e) {}
                }
                window.addEventListener('vibe-qr-login-ready', function() {
                    if (typeof window.vibeQrLogin === 'function' && window.Alpine && self.$el && self.$el.isConnected) {
                        if (typeof window.Alpine.destroyTree === 'function') {
                            try { window.Alpine.destroyTree(self.$el); } catch (e) {}
                        }
                        delete self.$el._x_dataStack;
                        window.Alpine.initTree(self.$el);
                    }
                }, { once: true });
            }
        }"
    @endif
>

    {{-- Dynamic Card Header --}}
    @if (! $qrMode)
        <div class="space-y-1">
            <h1 class="text-xl font-bold tracking-tight text-card-foreground">{{ __('auth/titles.login') }}</h1>
            <p class="text-xs sm:text-sm text-muted-foreground">{{ __('auth/titles.login_description') }}</p>
        </div>
    @else
        <div class="space-y-1">
            <h1 class="text-xl font-bold tracking-tight text-card-foreground">{{ __('auth/qr_login.panel_title') }}</h1>
            <p class="text-xs sm:text-sm text-muted-foreground">{{ __('auth/qr_login.panel_hint') }}</p>
        </div>
    @endif

    {{-- Status Session Alert --}}
    @if (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" animation="pop" />
    @endif

    @if (config('passkeys.enabled', true))
        {{-- Development IP Warning Notice --}}
        @if (session('warning'))
            <vibe:card.alert variant="warning" size="sm" dismissible :title="__('auth/passkey.dev_mode_title')" :description="session('warning')" animation="pulse">
                @if (session('localhost_url'))
                    <x-slot:actions>
                        <vibe:button href="{{ session('localhost_url') }}" size="xs" variant="primary">
                            <span>{{ __('auth/passkey.switch_to_localhost') }}</span>
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 12h16m0 0l-6-6m6 6l-6 6" />
                            </svg>
                        </vibe:button>
                    </x-slot:actions>
                @endif
            </vibe:card.alert>
        @endif

        {{-- Passkey Error Notice --}}
        @if (session('error'))
            <vibe:card.alert variant="destructive" size="sm" dismissible :title="__('auth/passkey.failed_title')" :description="session('error')" animation="shake" />
        @endif
    @endif

    @if (! $qrMode)
        @if (config('passkeys.enabled', true) || config('vibe.auth.qr_login.enabled', true))
            {{-- Passwordless Login Options (Passkey & QR Code) --}}
            <div class="space-y-2.5">
                @if (config('passkeys.enabled', true))
                    <vibe:button type="button" variant="outline" class="w-full justify-center shadow-2xs font-medium cursor-pointer" data-vibe-passkey="{{ $this->redirectAfterLoginUrl() }}" onclick="window.vibeLoginWithPasskey(this, '{{ $this->redirectAfterLoginUrl() }}')">
                        <span class="vibe-passkey-text inline-flex items-center gap-2">
                            <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                <path d="M2 12a10 10 0 0 1 18-6" />
                                <path d="M2 16h.01" />
                                <path d="M21.8 16c.2-2 .131-5.354 0-6" />
                                <path d="M5 19.5C5.5 18 6 15 6 12a6 6 0 0 1 .34-2" />
                                <path d="M8.65 22c.21-.66.45-1.32.57-2" />
                                <path d="M9 6.8a6 6 0 0 1 9 5.2v2" />
                            </svg>
                            <span>{{ __('auth/passkey.login_button') }}</span>
                        </span>
                        <span class="vibe-passkey-loading inline-flex items-center justify-center gap-2" style="display: none;">
                            <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>{{ __('auth/passkey.connecting') }}</span>
                        </span>
                    </vibe:button>
                @endif

                @if (config('vibe.auth.qr_login.enabled', true))
                    <vibe:button
                        type="button"
                        variant="outline"
                        class="w-full justify-center shadow-2xs font-medium cursor-pointer"
                        wire:click="startQrLogin"
                        wire:target="startQrLogin"
                        :loading="__('auth/qr_login.opening')"
                    >
                        <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="5" height="5" x="3" y="3" rx="1"/>
                            <rect width="5" height="5" x="16" y="3" rx="1"/>
                            <rect width="5" height="5" x="3" y="16" rx="1"/>
                            <path d="M21 16h-3a2 2 0 0 0-2 2v3"/>
                            <path d="M21 21v.01"/>
                            <path d="M12 7v3a2 2 0 0 1-2 2H7"/>
                            <path d="M3 12h.01"/>
                            <path d="M12 3h.01"/>
                            <path d="M12 16v.01"/>
                            <path d="M16 12h1"/>
                            <path d="M21 12v.01"/>
                            <path d="M12 21v-1"/>
                        </svg>
                        <span>{{ __('auth/qr_login.login_button') }}</span>
                    </vibe:button>
                @endif

                <vibe:separator text="{{ __('auth/passkey.separator') }}" />
            </div>
        @endif

        <form wire:submit="authenticate" class="space-y-4">
            <vibe:input wire:model="login" id="login" name="login" label="{{ $loginLabel }}" placeholder="{{ $loginPlaceholder }}" type="{{ $this->isOnlyEmail() ? 'email' : 'text' }}" required autofocus autocomplete="{{ config('passkeys.enabled', true) ? 'username webauthn' : 'username' }}" />

            {{-- Password Input with Viewable Toggle --}}
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-xs font-semibold text-foreground select-none">
                        {{ __('auth/fields.password') }} <span class="text-destructive font-bold ml-0.5" aria-hidden="true">*</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate class="text-xs font-medium text-primary hover:underline underline-offset-4 focus:outline-none focus:ring-1 focus:ring-ring rounded-xs transition-colors">
                            {{ __('auth/links.forgot_password') }}
                        </a>
                    @endif
                </div>

                <vibe:input wire:model="password" id="password" name="password" type="password" viewable required autocomplete="current-password" placeholder="••••••••" />
            </div>

            {{-- Remember Me Checkbox --}}
            <div class="flex items-center justify-between pt-1">
                <vibe:checkbox wire:model="remember" id="remember" name="remember" label="{{ __('auth/links.remember_me') }}" />
            </div>

            {{-- Submit Button with Loading State --}}
            <div class="pt-2">
                <vibe:button 
                    type="submit" 
                    variant="primary" 
                    class="w-full justify-center shadow-xs" 
                    wire:target="authenticate" 
                    :loading="__('auth/actions.logging_in')"
                >
                    {{ __('auth/actions.login') }}
                </vibe:button>
            </div>

            {{-- Register Link --}}
            @if (Route::has('register'))
                <p class="text-center text-xs text-muted-foreground pt-3">
                    {{ __('auth/links.dont_have_account') }}
                    <a href="{{ route('register') }}" wire:navigate class="font-semibold text-primary hover:underline underline-offset-4 ml-1 focus:outline-none focus:ring-1 focus:ring-ring rounded-xs">
                        {{ __('auth/links.sign_up_now') }}
                    </a>
                </p>
            @endif
        </form>
    @else
        {{-- QR Code Login Panel --}}
        <div class="space-y-5 animate-in fade-in duration-200">
            @if ($qrStatus === 'unconfigured' || $qrError)
                <vibe:card.alert
                    :variant="$qrStatus === 'unconfigured' ? 'warning' : 'destructive'"
                    size="sm"
                    :description="$qrError"
                />
            @endif

            @if ($qrApproveUrl && $qrStatus !== 'unconfigured')
                <div
                    class="flex flex-col items-center gap-3.5"
                    data-qr-challenge="{{ $initialQrPayload ? json_encode($initialQrPayload) : '' }}"
                >
                    <div class="relative inline-flex items-center justify-center" wire:key="qr-challenge-{{ $qrToken }}">
                        <div class="transition-all duration-200" :class="{ 'opacity-20 blur-[2px] pointer-events-none scale-[0.98]': ['expired', 'rejected', 'error'].includes(status) }">
                            <vibe:display.qrcode
                                :value="$qrApproveUrl"
                                size="184"
                                level="M"
                                class="p-3.5 rounded-2xl shadow-sm border-black/5 dark:border-white/10"
                            />
                        </div>

                        <div
                            :class="{ 'hidden': !['expired', 'rejected', 'error'].includes(status) }"
                            class="absolute inset-0 p-4 {{ in_array($qrStatus, ['expired', 'rejected', 'error'], true) ? '' : 'hidden' }}"
                        >
                            <div class="size-full flex items-center justify-center text-center">
                                <div class="rounded-xl bg-background/90 backdrop-blur-sm border border-border/80 px-4 py-3 shadow-md space-y-2.5">
                                    <p class="text-xs font-medium text-foreground" x-text="statusMessage()"></p>
                                    <vibe:button
                                        type="button"
                                        variant="primary"
                                        size="xs"
                                        class="rounded-full shadow-xs"
                                        @click="resetAutoRefresh()"
                                        wire:click="refreshQrLogin"
                                        wire:target="refreshQrLogin"
                                        :loading="__('auth/qr_login.opening')"
                                    >
                                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                            <path d="M3 3v5h5" />
                                            <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                                            <path d="M16 16h5v5" />
                                        </svg>
                                        <span>{{ __('auth/qr_login.refresh') }}</span>
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Single-Line Status & Countdown Pill --}}
                    <div
                        wire:ignore
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-border/70 bg-muted/45 text-xs max-w-full"
                    >
                        <span class="size-2 rounded-full shrink-0 animate-pulse" :class="{
                            'bg-amber-500': status === 'scanned' || status === 'refreshing',
                            'bg-emerald-500': status === 'approved' || status === 'pending',
                            'bg-destructive': ['rejected', 'expired', 'error'].includes(status)
                        }"></span>
                        <span class="font-medium truncate" :class="{
                            'text-amber-600 dark:text-amber-400': status === 'scanned' || status === 'refreshing',
                            'text-emerald-600 dark:text-emerald-400': status === 'approved',
                            'text-destructive': ['rejected', 'expired', 'error'].includes(status),
                            'text-muted-foreground': status === 'pending'
                        }" x-text="statusMessage()">{{ $qrStatus === 'scanned' ? __('auth/qr_login.status_scanned') : __('auth/qr_login.status_pending') }}</span>
                        <span
                            x-show="remainingSeconds > 0 && ['pending', 'scanned'].includes(status)"
                            x-cloak
                            x-text="formattedRemaining()"
                            class="pl-2 border-l border-border/70 font-mono text-[11px] font-semibold tabular-nums text-foreground/80 shrink-0"
                        ></span>
                    </div>
                </div>

                @if ($qrCode)
                    <div class="space-y-2.5">
                        <vibe:separator text="{{ __('auth/qr_login.code_separator') }}" />

                        <div
                            wire:key="qr-code-{{ $qrToken }}"
                            data-qr-code="{{ $qrCode }}"
                            class="flex items-center justify-between gap-3 px-4 py-2.5 rounded-xl border border-border/80 bg-muted/35"
                            x-data="{
                                copied: false,
                                async copyCode(buttonEl = null) {
                                    const code = this.$el?.dataset?.qrCode || @js($qrCode);
                                    if (!code) return;
                                    let ok = false;
                                    if (window.VibeCore) {
                                        ok = await window.VibeCore.copy(code, {
                                            button: buttonEl,
                                            statusEl: this.$refs.qrCopyStatus,
                                            copiedText: @js(__('auth/qr_login.copied_code')),
                                            failedText: @js(__('auth/qr_login.copy_code')),
                                        });
                                    } else if (navigator.clipboard) {
                                        await navigator.clipboard.writeText(code);
                                        ok = true;
                                    }
                                    if (ok) {
                                        this.copied = true;
                                        setTimeout(() => { this.copied = false; }, 2000);
                                    }
                                }
                            }"
                        >
                            <span class="font-mono text-base font-bold tracking-[0.22em] text-foreground select-all truncate">
                                {{ $qrCode }}
                            </span>

                            <span x-ref="qrCopyStatus" role="status" aria-live="polite" class="sr-only"></span>
                            <button
                                type="button"
                                @click="copyCode($el)"
                                aria-label="{{ __('auth/qr_login.copy_code') }}"
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium border border-border/70 bg-background text-muted-foreground hover:text-foreground hover:border-border transition-colors cursor-pointer shrink-0"
                            >
                                <svg x-show="!copied" class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                    <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                </svg>
                                <svg x-show="copied" x-cloak class="size-3.5 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                                <span x-text="copied ? @js(__('auth/qr_login.copied_code')) : @js(__('auth/qr_login.copy_code'))"></span>
                            </button>
                        </div>

                        <p class="text-[11px] text-center text-muted-foreground">
                            {!! __('auth/qr_login.pairing_code_hint', ['link' => '<a href="' . e(route('qr-login.approve')) . '" target="_blank" rel="noopener" class="font-mono text-foreground/85 underline decoration-border underline-offset-2 hover:text-primary transition-colors">/qr-login/approve</a>']) !!}
                        </p>
                    </div>
                @endif
            @endif

            <div class="pt-1">
                <vibe:button
                    type="button"
                    variant="outline"
                    class="w-full justify-center shadow-2xs font-medium cursor-pointer"
                    wire:click="cancelQrLogin"
                >
                    {{ __('auth/qr_login.back_to_password') }}
                </vibe:button>
            </div>
        </div>
    @endif
</div>
