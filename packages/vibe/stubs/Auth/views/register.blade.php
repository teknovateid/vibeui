<div class="space-y-4">
    @if (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" animation="pop" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" animation="shake" />
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
            class="w-full justify-center shadow-xs" 
            wire:target="register"
            :loading="__('auth/actions.registering')"
        >
            {{ __('auth/actions.register') }}
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
