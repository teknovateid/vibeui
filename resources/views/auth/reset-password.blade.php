<div class="space-y-4">
    @if (session('status'))
        <vibe:card.alert variant="success" size="sm" :description="session('status')" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" />
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
                class="w-full justify-center flex shadow-xs" 
                wire:loading.attr="disabled" 
                wire:target="resetPassword"
            >
                <span wire:loading.remove wire:target="resetPassword">{{ __('auth/actions.reset_password') }}</span>
                <span wire:loading.inline-flex wire:target="resetPassword" class="inline-flex items-center justify-center gap-2">
                    <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span>{{ __('auth/actions.saving') }}</span>
                </span>
            </vibe:button>
        </div>
    </form>
</div>
