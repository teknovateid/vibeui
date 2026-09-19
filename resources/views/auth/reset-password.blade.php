<div class="space-y-4">
    @if (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" animation="pop" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" animation="shake" />
    @endif

    <form wire:submit="resetPassword" class="space-y-4">
        {{-- Email (Prefilled) --}}
        <vibe:input 
            wire:model="email" 
            id="email" 
            name="email" 
            label="{{ __('auth/fields.email') }}" 
            type="email" 
            required 
            autocomplete="email" 
            readonly 
        />

        {{-- New Password --}}
        <vibe:input 
            wire:model="password" 
            id="password" 
            name="password" 
            label="{{ __('auth/fields.new_password') }}" 
            type="password" 
            viewable 
            required 
            autofocus 
            autocomplete="new-password" 
            placeholder="{{ __('auth/fields.password_placeholder') }}" 
        />

        {{-- Confirm New Password --}}
        <vibe:input 
            wire:model="password_confirmation" 
            id="password_confirmation" 
            name="password_confirmation" 
            label="{{ __('auth/fields.confirm_new_password') }}" 
            type="password" 
            viewable 
            required 
            autocomplete="new-password" 
            placeholder="{{ __('auth/fields.password_placeholder') }}" 
        />

        {{-- Submit Button --}}
        <div class="pt-2">
            <vibe:button 
                type="submit" 
                variant="primary" 
                class="w-full justify-center shadow-xs" 
                wire:target="resetPassword"
                :loading="__('auth/actions.saving')"
            >
                {{ __('auth/actions.reset_password') }}
            </vibe:button>
        </div>
    </form>
</div>
