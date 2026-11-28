<div class="space-y-4">
    @if ($status ?? session('status'))
        <vibe:card.alert variant="success" size="sm" :description="$status ?? session('status')" animation="pop" />
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" animation="shake" />
    @endif

    <form wire:submit="sendResetLink" class="space-y-4">
        {{-- Email Input --}}
        <vibe:input 
            wire:model="email" 
            id="email" 
            name="email" 
            label="{{ __('auth/fields.email') }}" 
            type="email" 
            placeholder="{{ __('auth/fields.email_placeholder') }}" 
            required 
            autofocus 
            autocomplete="email" 
        />

        {{-- Submit Button --}}
        <div class="pt-2">
            <vibe:button 
                type="submit" 
                variant="primary" 
                class="w-full justify-center shadow-xs" 
                wire:target="sendResetLink"
                :loading="__('auth/actions.sending_link')"
            >
                {{ __('auth/actions.send_reset_link') }}
            </vibe:button>
        </div>

        {{-- Back to Login Link --}}
        <p class="text-center text-xs text-muted-foreground pt-2">
            {{ __('auth/links.remember_password') }}
            <a 
                href="{{ route('login') }}" 
                wire:navigate 
                class="font-semibold text-primary hover:underline underline-offset-4 ml-1 focus:outline-none focus:ring-1 focus:ring-ring rounded-xs"
            >
                {{ __('auth/links.back_to_login') }}
            </a>
        </p>
    </form>
</div>
