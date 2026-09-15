<div class="space-y-4">
    @if ($status ?? session('status'))
        <vibe:card.alert variant="success" size="sm" :description="$status ?? session('status')" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" />
    @endif

    <form wire:submit="sendResetLink" class="space-y-4">
        {{-- Email Input --}}
        <vibe:input 
            wire:model="email" 
            id="email" 
            name="email" 
            label="{{ __('auth.fields.email') }}" 
            type="email" 
            placeholder="{{ __('auth.fields.email_placeholder') }}" 
            required 
            autofocus 
            autocomplete="email" 
        />

        {{-- Submit Button --}}
        <div class="pt-2">
            <vibe:button 
                type="submit" 
                variant="primary" 
                class="w-full justify-center flex shadow-xs" 
                wire:loading.attr="disabled"
                wire:target="sendResetLink"
            >
                <span wire:loading.remove wire:target="sendResetLink">{{ __('auth.actions.send_reset_link') }}</span>
                <span wire:loading.inline-flex wire:target="sendResetLink" class="inline-flex items-center justify-center gap-2">
                    <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span>{{ __('auth.actions.sending_link') }}</span>
                </span>
            </vibe:button>
        </div>

        {{-- Back to Login Link --}}
        <p class="text-center text-xs text-muted-foreground pt-2">
            {{ __('auth.links.remember_password') }}
            <a 
                href="{{ route('login') }}" 
                wire:navigate 
                class="font-semibold text-primary hover:underline underline-offset-4 ml-1 focus:outline-none focus:ring-1 focus:ring-ring rounded-xs"
            >
                {{ __('auth.links.back_to_login') }}
            </a>
        </p>
    </form>
</div>
