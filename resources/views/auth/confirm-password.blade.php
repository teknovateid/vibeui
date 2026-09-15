<form wire:submit="confirmPassword" class="space-y-4">
    {{-- Password Input --}}
    <vibe:input 
        wire:model="password" 
        id="password" 
        name="password" 
        label="{{ __('auth.fields.password') }}" 
        type="password" 
        viewable 
        required 
        autofocus 
        autocomplete="current-password" 
        placeholder="{{ __('auth.fields.password_placeholder') }}" 
    />

    {{-- Submit Button --}}
    <div class="pt-2">
        <vibe:button 
            type="submit" 
            variant="primary" 
            class="w-full justify-center flex shadow-xs" 
            wire:loading.attr="disabled"
            wire:target="confirmPassword"
        >
            <span wire:loading.remove wire:target="confirmPassword">{{ __('auth.actions.confirm') }}</span>
            <span wire:loading wire:target="confirmPassword" class="inline-flex items-center gap-2">
                <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                {{ __('auth.actions.verifying') }}
            </span>
        </vibe:button>
    </div>
</form>
