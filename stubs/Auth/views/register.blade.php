<div class="space-y-4">
    @if (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" />
    @endif

    <form wire:submit="register" class="space-y-4">
    {{-- Full Name --}}
    <vibe:input 
        wire:model="name" 
        id="name" 
        name="name" 
        label="{{ __('auth/fields.name') }}" 
        placeholder="{{ __('auth/fields.name_placeholder') }}" 
        required 
        autofocus 
        autocomplete="name" 
    />

    {{-- Email & Phone Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <vibe:input 
            wire:model="email" 
            id="email" 
            name="email" 
            label="{{ __('auth/fields.email') }}" 
            type="email" 
            placeholder="{{ __('auth/fields.email_placeholder') }}" 
            required 
            autocomplete="email" 
        />

        <vibe:input 
            wire:model="phone" 
            id="phone" 
            name="phone" 
            label="{{ __('auth/fields.phone') }}" 
            type="tel" 
            placeholder="{{ __('auth/fields.phone_placeholder') }}" 
            required 
            autocomplete="tel" 
        />
    </div>

    {{-- Username --}}
    <vibe:input 
        wire:model="username" 
        id="username" 
        name="username" 
        label="{{ __('auth/fields.username') }}" 
        placeholder="{{ __('auth/fields.username_placeholder') }}" 
        prefix="@" 
        required 
        autocomplete="username" 
    />

    {{-- Passwords Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <vibe:input 
            wire:model="password" 
            id="password" 
            name="password" 
            label="{{ __('auth/fields.password') }}" 
            type="password" 
            viewable 
            required 
            autocomplete="new-password" 
            placeholder="{{ __('auth/fields.password_placeholder') }}" 
        />

        <vibe:input 
            wire:model="password_confirmation" 
            id="password_confirmation" 
            name="password_confirmation" 
            label="{{ __('auth/fields.password_confirmation') }}" 
            type="password" 
            viewable 
            required 
            autocomplete="new-password" 
            placeholder="{{ __('auth/fields.password_placeholder') }}" 
        />
    </div>

    {{-- Submit Button --}}
    <div class="pt-2">
        <vibe:button 
            type="submit" 
            variant="primary" 
            class="w-full justify-center flex shadow-xs" 
            wire:loading.attr="disabled"
            wire:target="register"
        >
            <span wire:loading.remove wire:target="register">{{ __('auth/actions.register') }}</span>
            <span wire:loading.inline-flex wire:target="register" class="inline-flex items-center justify-center gap-2">
                <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span>{{ __('auth/actions.registering') }}</span>
            </span>
        </vibe:button>
    </div>

    {{-- Login Link --}}
    @if (Route::has('login'))
        <p class="text-center text-xs text-muted-foreground pt-2">
            {{ __('auth/links.already_registered') }}
            <a 
                href="{{ route('login') }}" 
                wire:navigate 
                class="font-semibold text-primary hover:underline underline-offset-4 ml-1 focus:outline-none focus:ring-1 focus:ring-ring rounded-xs"
            >
                {{ __('auth/links.sign_in_now') }}
            </a>
        </p>
    @endif
</form>
</div>
