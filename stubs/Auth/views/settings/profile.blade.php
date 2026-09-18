<div>
    <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-300 mb-6">
        <span class="size-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
        <span>{!! __('vibe/settings.profile.logged_in_as', ['name' => '<strong>'.e($name).'</strong>']) !!} &bull; <span class="text-muted-foreground">{{ $email }}</span></span>
    </div>

    {{-- Avatar & Identity --}}
    <div class="flex items-center gap-4 mb-6">
        @php
            $initials = collect(explode(' ', $name ?: 'User'))
                ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                ->take(2)
                ->join('');
        @endphp
        <div class="size-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center text-xl font-bold ring-2 ring-primary/20 shrink-0 select-none">
            {{ $initials }}
        </div>
        <div class="space-y-1">
            <h4 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.profile.avatar_title') }}</h4>
            <p class="text-xs text-muted-foreground">{{ __('vibe/settings.profile.avatar_desc_gravatar') }}</p>
            <div class="flex items-center gap-2 pt-1">
                <vibe:button type="button" size="sm" variant="outline" class="text-xs cursor-pointer" @click="window.vibeToast ? vibeToast('Avatar disinkronkan secara otomatis dari Gravatar sesuai alamat email Anda.', { type: 'info', title: 'Gravatar Avatar' }) : null">
                    {{ __('vibe/settings.profile.change_photo') }}
                </vibe:button>
            </div>
        </div>
    </div>

    {{-- Form Fields --}}
    <form wire:submit.prevent="updateProfile" class="space-y-4 max-w-xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <vibe:input 
                    name="name" 
                    :label="__('vibe/settings.profile.full_name')" 
                    wire:model="name" 
                    :placeholder="__('vibe/settings.profile.full_name_placeholder')" 
                    required 
                />
                @error('name')
                    <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <vibe:input 
                    type="email" 
                    name="email" 
                    :label="__('vibe/settings.profile.email_address')" 
                    wire:model="email" 
                    :placeholder="__('vibe/settings.profile.email_placeholder')" 
                    required 
                />
                @error('email')
                    <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <vibe:input 
                    name="username" 
                    :label="__('vibe/settings.profile.username')" 
                    wire:model="username" 
                    :placeholder="__('vibe/settings.profile.username_placeholder')" 
                />
                @error('username')
                    <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <vibe:input 
                    name="phone" 
                    :label="__('vibe/settings.profile.phone')" 
                    wire:model="phone" 
                    :placeholder="__('vibe/settings.profile.phone_placeholder')" 
                />
                @error('phone')
                    <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <vibe:input 
                name="position" 
                label="Jabatan / Peran" 
                wire:model="position" 
                placeholder="cth. Lead Developer, Product Designer..." 
            />
            @error('position')
                <p class="text-xs text-destructive mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>


        {{-- Language Selector --}}
        <div class="space-y-2 pt-2">
            <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">{{ __('vibe/settings.profile.interface_language') }}</label>
            <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'id') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'id' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                    🇮🇩 Bahasa Indonesia
                </vibe:button>
                <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', 'en') }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ app()->getLocale() === 'en' ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                    🇺🇸 English (US)
                </vibe:button>
            </div>
        </div>

        {{-- Save Action --}}
        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
            <vibe:button type="submit" variant="primary" size="sm" class="cursor-pointer" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="updateProfile">
                    {{ __('vibe/settings.profile.save_changes') }}
                </span>
                <span wire:loading wire:target="updateProfile" class="inline-flex items-center gap-1.5">
                    <svg class="size-3.5 animate-spin" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span>Menyimpan ke database...</span>
                </span>
            </vibe:button>
        </div>
    </form>
</div>
