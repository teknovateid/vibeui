<x-[path].layouts.[style]>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('[path].settings.account')],
        ['name' => __('vibe/settings.breadcrumb.security'), 'url' => route('[path].settings.security')],
    ]" />

    <div class="space-y-6 mx-auto w-full">
        <vibe:breadcrumb title="{!! __('vibe/settings.title') !!}">
            <vibe:breadcrumb.item href="{{ route('[path].index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('[path].settings.account') }}">{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.breadcrumb.security') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="security" variant="sidebar" class="min-h-155">
                @include('[path].settings.tabs', ['active' => 'security'])

                <div class="flex flex-col gap-6 p-6 w-full">
                    {{-- Header --}}
                    <div class="pb-4 border-border/50 border-b">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="font-bold text-foreground text-lg">{{ __('vibe/settings.security.header_title') }}</h2>
                                <p class="mt-0.5 text-muted-foreground text-xs">
                                    {{ __('vibe/settings.security.header_desc') }}
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
                        <div class="space-y-1 max-w-lg w-full">
                            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.security.password_title') }}</h3>
                            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.security.password_desc') }}</p>
                        </div>

                        <div class="space-y-4 w-full">
                            <vibe:input type="password" name="current_password" :label="__('vibe/settings.security.current_password')" viewable :placeholder="__('vibe/settings.security.current_password_placeholder')" />
                            <vibe:input type="password" name="new_password" :label="__('vibe/settings.security.new_password')" viewable :placeholder="__('vibe/settings.security.new_password_placeholder')" />
                            <vibe:input type="password" name="confirm_password" :label="__('vibe/settings.security.confirm_password')" viewable :placeholder="__('vibe/settings.security.confirm_password_placeholder')" />
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer float-end flex" @click="window.vibeToast ? vibeToast('{{ __('vibe/settings.security.password_updated_toast') }}', { type: 'success', title: '{{ __('vibe/settings.security.password_updated_title') }}' }) : null">
                                {{ __('vibe/settings.security.update_password_btn') }}
                            </vibe:button>
                        </div>
                    </div>

                    <vibe:separator />

                    <div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20" x-data="passkeyController()">
                        <div class="space-y-1 max-w-lg w-full">
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.security.passkey_title') }}</h3>
                                <vibe:badge size="sm" variant="success" dot class="rounded-full" x-show="supported" x-cloak>
                                    {{ __('vibe/settings.security.browser_supported') }}
                                </vibe:badge>
                                <vibe:badge size="sm" variant="destructive" class="rounded-full" x-show="!supported">
                                    {{ __('vibe/settings.security.browser_not_supported') }}
                                </vibe:badge>
                            </div>
                            <p class="text-muted-foreground text-xs">
                                {{ __('vibe/settings.security.passkey_desc') }}
                            </p>
                        </div>

                        <div class="space-y-4 w-full">
                            <div x-show="isIpAddress" x-cloak>
                                <vibe:card.alert variant="warning" size="sm">
                                    <div class="flex sm:flex-row flex-col justify-between sm:items-center gap-3 w-full">
                                        <span>{!! __('vibe/settings.security.passkey_ip_alert') !!}</span>
                                        <a :href="localhostUrl" class="bg-amber-500 hover:bg-amber-600 px-2.5 py-1 rounded-lg font-medium text-white text-xs transition-colors shrink-0">{!! __('vibe/settings.security.passkey_open_localhost') !!}</a>
                                    </div>
                                </vibe:card.alert>
                            </div>

                            {{-- Feedback Message --}}
                            <div x-show="feedbackMessage && feedbackType === 'success'" x-cloak>
                                <vibe:card.alert variant="success" size="sm" title="✓ Berhasil!">
                                    <span x-text="feedbackMessage"></span>
                                </vibe:card.alert>
                            </div>
                            <div x-show="feedbackMessage && feedbackType !== 'success'" x-cloak>
                                <vibe:card.alert variant="destructive" size="sm" title="⚠ Perhatian:">
                                    <span x-text="feedbackMessage"></span>
                                </vibe:card.alert>
                            </div>

                            @php
                                $userPasskeys = auth()->user()?->passkeys ?? collect();
                            @endphp

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.security.registered_passkeys') }}</p>
                                        <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.registered_passkeys_desc') }}</p>
                                    </div>
                                    <vibe:badge size="sm" variant="secondary" class="rounded-full">{{ __('vibe/settings.security.registered_badge', ['count' => $userPasskeys->count()]) }}</vibe:badge>
                                </div>

                                @if ($userPasskeys->isEmpty())
                                    <div class="flex items-center gap-3.5 bg-muted p-3.5 rounded-xl">
                                        <div class="flex justify-center items-center bg-primary/10 rounded-xl size-9 shrink-0">
                                            <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                        </div>
                                        <div>
                                            <p class="font-semibold text-foreground text-sm">{{ __('vibe/settings.security.no_passkeys') }}</p>
                                            <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.no_passkeys_desc') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="rounded-xl divide-y divide-border/40 overflow-hidden">
                                        @foreach ($userPasskeys as $passkey)
                                            <div class="flex justify-between items-center gap-3 bg-muted p-3">
                                                <div class="flex items-center gap-3 min-w-0">
                                                    <div class="flex justify-center items-center bg-primary/10 rounded-lg size-8 text-primary shrink-0">
                                                        <svg class="size-4 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="font-semibold text-foreground text-sm truncate">{{ $passkey->name }}</p>
                                                        <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.added_time', ['time' => $passkey->created_at?->diffForHumans()]) }}</p>
                                                    </div>
                                                </div>
                                                <vibe:button.delete class="rounded-full" size="xs" :url="route('passkey.destroy', $passkey)" :title="__('vibe/settings.security.delete_passkey_title')" :message="__('vibe/settings.security.delete_passkey_message', ['name' => $passkey->name])">
                                                    {{ __('vibe/settings.security.delete_passkey') }}
                                                </vibe:button.delete>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="space-y-3 pt-3 border-border/50 border-t">
                                    <vibe:form :ajax="false" @submit.prevent="submitRegisterPasskey()" class="space-y-3">
                                        <div class="space-y-1.5">
                                            <vibe:input x-model="registerName" :label="__('vibe/settings.security.register_new_passkey')" :description="__('vibe/settings.security.register_new_passkey_desc')" :placeholder="__('vibe/settings.security.register_new_passkey_placeholder')" required />
                                        </div>

                                        <div class="flex sm:flex-row flex-col justify-between items-start sm:items-center gap-3 pt-0.5">
                                            <span class="flex items-center gap-1.5 text-xs text-muted-foreground">
                                                {{ __('vibe/settings.security.sensor_prompt') }}
                                            </span>

                                            <vibe:button type="submit" variant="primary" size="sm" ::disabled="registering || loading || !registerName" class="cursor-pointer shrink-0">
                                                <template x-if="!registering && !loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <span>{{ __('vibe/settings.security.register_button') }}</span>
                                                    </span>
                                                </template>
                                                <template x-if="registering || loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <svg class="size-3 animate-spin" viewBox="0 0 24 24" fill="none">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        <span x-text="statusText || '{{ __('vibe/settings.security.processing') }}'"></span>
                                                    </span>
                                                </template>
                                            </vibe:button>
                                        </div>
                                    </vibe:form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <vibe:separator />

                    {{-- 2FA Section (Livewire Component) --}}
                    <livewire:settings.two-factor />

                    <vibe:separator />

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
                                <vibe:button type="button" variant="destructive" size="sm" class="cursor-pointer shrink-0">
                                    {{ __('vibe/settings.security.delete_account_btn') }}
                                </vibe:button>
                            </div>
                        </div>
                    </div>

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>

    @pushOnce('head', 'vibe-security-scripts')
        @vite(['resources/js/vibe/qrcode.js', 'resources/js/vibe/passkeys.js'])
    @endPushOnce

    @push('body')
        <script>
            function passkeyController() {
                return {
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    loading: false,
                    registering: false,
                    statusText: '',
                    feedbackMessage: null,
                    feedbackType: 'info',
                    init() {
                        this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                    },
                    async submitRegisterPasskey() {
                        if (!this.registerName) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = 'Harap masukkan nama perangkat.';
                            return;
                        }

                        this.loading = true;
                        this.registering = true;
                        this.statusText = 'Menyiapkan sensor biometrik perangkat...';
                        this.feedbackMessage = null;

                        try {
                            if (!window.VibePasskeyService) {
                                throw new Error('Modul Passkey belum dimuat.');
                            }

                            const regRes = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (regRes.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Halaman akan diperbarui...';
                                setTimeout(() => window.location.reload(), 1500);
                            } else if (regRes.confirmationRequired) {
                                const confirmUrl = '{{ Route::has('password.confirm') ? route('password.confirm') : '/confirm-password' }}';
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = confirmUrl;
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = regRes.message || 'Pendaftaran passkey dibatalkan oleh pengguna.';
                            }
                        } catch (err) {
                            if (err?.response?.status === 423 || err?.status === 423 || err?.message?.includes('423') || err?.message?.toLowerCase().includes('password confirmation')) {
                                const confirmUrl = '{{ Route::has('password.confirm') ? route('password.confirm') : '/confirm-password' }}';
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = confirmUrl;
                                return;
                            }
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Terjadi kesalahan saat memproses pendaftaran passkey.';
                        } finally {
                            this.loading = false;
                            this.registering = false;
                            this.statusText = '';
                        }
                    }
                };
            }

            if (typeof window !== 'undefined') {
                window.passkeyController = passkeyController;
                if (window.Alpine) {
                    window.Alpine.data('passkeyController', passkeyController);
                } else {
                    document.addEventListener('alpine:init', () => {
                        window.Alpine.data('passkeyController', passkeyController);
                    });
                }
            }
        </script>
    @endpush
</x-[path].layouts.[style]>
