@push('head')
    @vite('resources/js/vibe/passkeys.js')
@endpush

<div class="space-y-4">
    @if (session('status') === 'idle_timeout' || session('auth.session_locked'))
        <vibe:card.alert
            variant="warning"
            size="sm"
            :title="__('auth/messages.session_locked')"
            :description="__('auth/messages.session_locked_description')"
        />
    @elseif (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" />
    @endif

    {{-- Passkey Confirm Button --}}
    @php
        $targetRouteName = session('auth.target_route');
        $fallbackUrl = Route::has('docs.settings.security')
            ? route('docs.settings.security')
            : (Route::has('settings.security') ? route('settings.security') : url('/'));
        $intendedPasskeyUrl = session('url.intended')
            ?: ($targetRouteName
                ? (Route::has($targetRouteName) ? route($targetRouteName) : url($targetRouteName))
                : $fallbackUrl);
    @endphp
    <div class="space-y-3">
        <vibe:button type="button" variant="outline" class="w-full justify-center shadow-2xs font-medium cursor-pointer" onclick="window.vibeConfirmWithPasskey(this, '{{ $intendedPasskeyUrl }}')">
            <span class="vibe-passkey-text inline-flex items-center gap-2">
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
                <span>{{ __('auth/passkey.confirm_button') }}</span>
            </span>
            <span class="vibe-passkey-loading inline-flex items-center justify-center gap-2" style="display: none;">
                <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>{{ __('auth/passkey.connecting') }}</span>
            </span>
        </vibe:button>

        <vibe:separator text="{{ __('auth/passkey.confirm_separator') }}" />
    </div>

    <form wire:submit="confirmPassword" class="space-y-4">
        {{-- Password Input --}}
        <vibe:input wire:model="password" id="password" name="password" :label="__('auth/fields.password')" type="password" viewable required autofocus autocomplete="current-password" :placeholder="__('auth/fields.password_placeholder')" />

        {{-- Submit Button --}}
        <div class="pt-2">
            <vibe:button type="submit" variant="primary" class="w-full justify-center flex shadow-xs" wire:loading.attr="disabled" wire:target="confirmPassword">
                <span wire:loading.remove wire:target="confirmPassword">{{ __('auth/actions.confirm') }}</span>
                <span wire:loading.inline-flex wire:target="confirmPassword" class="inline-flex items-center justify-center gap-2">
                    <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>{{ __('auth/actions.verifying') }}</span>
                </span>
            </vibe:button>
        </div>
    </form>

    {{-- Logout Option --}}
    <div class="pt-3 flex items-center justify-between border-t border-border text-xs">
        <span class="text-muted-foreground">{{ __('auth/messages.not_your_account') }}</span>
        <button type="button" wire:click="logout" class="inline-flex items-center gap-1.5 font-medium text-destructive hover:text-destructive/80 transition-colors cursor-pointer py-1 px-2 rounded-md hover:bg-destructive/10">
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" x2="9" y1="12" y2="12"/>
            </svg>
            <span>{{ __('auth/actions.logout') }}</span>
        </button>
    </div>
</div>
