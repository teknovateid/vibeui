<div class="space-y-4">
    @if (session('status') == 'verification-link-sent')
        <vibe:card.alert variant="success" size="sm" :description="__('auth/messages.verification_sent')" animation="pop" />
    @else
        <p class="text-xs sm:text-sm text-muted-foreground leading-relaxed">
            {{ __('auth/messages.verification_notice') }}
        </p>
    @endif

    @if (session('error'))
        <vibe:card.alert variant="destructive" size="sm" dismissible :description="session('error')" animation="shake" />
    @endif

    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-3">
        <vibe:button 
            wire:click="sendVerification" 
            variant="primary" 
            class="w-full sm:w-auto justify-center"
            :loading="__('auth/actions.sending')"
        >
            {{ __('auth/actions.resend_verification') }}
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
