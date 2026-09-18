<div class="space-y-6 flex flex-col xl:flex-row items-start w-full gap-x-20">
    <div class="space-y-1 max-w-lg w-full">
        <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.security.password_title') }}</h3>
        <p class="text-muted-foreground text-xs">{{ __('vibe/settings.security.password_desc') }}</p>
    </div>

    <form wire:submit.prevent="updatePassword" class="space-y-4 w-full">

        <div>
            <vibe:input 
                type="password" 
                name="password" 
                :label="__('vibe/settings.security.new_password')" 
                viewable 
                wire:model="password" 
                :placeholder="__('vibe/settings.security.new_password_placeholder')" 
                required 
            />
            @error('password')
                <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <vibe:input 
                type="password" 
                name="password_confirmation" 
                :label="__('vibe/settings.security.confirm_password')" 
                viewable 
                wire:model="password_confirmation" 
                :placeholder="__('vibe/settings.security.confirm_password_placeholder')" 
                required 
            />
            @error('password_confirmation')
                <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end pt-2">
            <vibe:button type="submit" variant="primary" size="sm" class="cursor-pointer" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="updatePassword">
                    {{ __('vibe/settings.security.update_password_btn') }}
                </span>
                <span wire:loading wire:target="updatePassword" class="inline-flex items-center gap-1.5">
                    <svg class="size-3.5 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span>Memperbarui...</span>
                </span>
            </vibe:button>
        </div>
    </form>
</div>
