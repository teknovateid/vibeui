<div class="space-y-4">

    {{-- Status Session Alert --}}
    @if (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" animation="pop" />
    @endif

    {{-- Development IP Warning Notice --}}
    @if (session('warning'))
        <vibe:card.alert variant="warning" size="sm" dismissible :title="__('auth/passkey.dev_mode_title')" :description="session('warning')" animation="pulse">
            @if (session('localhost_url'))
                <x-slot:actions>
                    <vibe:button href="{{ session('localhost_url') }}" size="xs" variant="primary">
                        <span>{{ __('auth/passkey.switch_to_localhost') }}</span>
                        <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
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

    {{-- Passkey Login Section --}}
    <div class="space-y-3">
        <vibe:button type="button" variant="outline" class="w-full justify-center shadow-2xs font-medium cursor-pointer" data-vibe-passkey="{{ $this->redirectAfterLoginUrl() }}" onclick="window.vibeLoginWithPasskey(this, '{{ $this->redirectAfterLoginUrl() }}')">
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

        <vibe:separator text="{{ __('auth/passkey.separator') }}" />
    </div>

    <form wire:submit="authenticate" class="space-y-4">
        <vibe:input wire:model="login" id="login" name="login" label="{{ $loginLabel }}" placeholder="{{ $loginPlaceholder }}" type="{{ $this->isOnlyEmail() ? 'email' : 'text' }}" required autofocus autocomplete="username webauthn" />

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
            <vibe:button type="submit" variant="primary" class="w-full justify-center flex shadow-xs" wire:loading.attr="disabled" wire:target="authenticate">
                <span wire:loading.remove wire:target="authenticate">{{ __('auth/actions.login') }}</span>
                <span wire:loading.inline-flex wire:target="authenticate" class="inline-flex items-center justify-center gap-2">
                    <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>{{ __('auth/actions.logging_in') }}</span>
                </span>
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
</div>
