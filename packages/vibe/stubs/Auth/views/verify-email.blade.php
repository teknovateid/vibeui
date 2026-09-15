<div class="space-y-4">
    @if (session('status') == 'verification-link-sent')
        <vibe:card.alert variant="success" size="sm" :description="__('auth/messages.verification_sent')" />
    @else
        <p class="text-xs sm:text-sm text-muted-foreground leading-relaxed">
            {{ __('auth/messages.verification_notice') }}
        </p>
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" />
    @endif

    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3">
        <vibe:button 
            wire:click="sendVerification" 
            variant="primary" 
            class="w-full sm:w-auto justify-center flex"
            wire:loading.attr="disabled"
            wire:target="sendVerification"
        >
            <span wire:loading.remove wire:target="sendVerification">{{ __('auth/actions.resend_verification') }}</span>
            <span wire:loading.inline-flex wire:target="sendVerification" class="inline-flex items-center justify-center gap-2">
                <svg class="animate-spin size-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                <span>{{ __('auth/actions.sending') }}</span>
            </span>
        </vibe:button>

        <vibe:button 
            wire:click="logout" 
            variant="outline" 
            class="w-full sm:w-auto justify-center text-muted-foreground hover:text-foreground"
        >
            {{ __('auth/actions.logout') }}
        </vibe:button>
    </div>
</div>
