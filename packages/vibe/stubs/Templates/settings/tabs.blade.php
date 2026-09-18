@props([
    'active' => 'account',
])

<vibe:tabs.list class="w-full md:w-64 shrink-0 flex flex-col gap-0.5 p-3 border-b md:border-b-0 md:border-r border-border/60 bg-muted/40">
    @auth
        <p class="px-2 pt-1 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.account') }}</p>

        <vibe:tabs.tab name="account" href="{{ route('[path].settings.account') }}" variant="sidebar" :active="$active === 'account'">
            <x-slot:icon>
                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="5" />
                    <path d="M20 21a8 8 0 0 0-16 0" />
                </svg>
            </x-slot:icon>
            {{ __('vibe/settings.tabs.account.label') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="security" href="{{ route('[path].settings.security') }}" variant="sidebar" :active="$active === 'security'">
            <x-slot:icon>
                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
            </x-slot:icon>
            {{ __('vibe/settings.tabs.security.label') }}
            <x-slot:right>
                <svg class="size-3 text-muted-foreground/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect width="18" height="11" x="3" y="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
            </x-slot:right>
        </vibe:tabs.tab>

        <vibe:tabs.tab name="login-history" href="{{ route('[path].settings.login-history') }}" variant="sidebar" :active="$active === 'login-history'">
            <x-slot:icon>
                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                    <path d="M3 3v5h5" />
                    <path d="M12 7v5l4 2" />
                </svg>
            </x-slot:icon>
            {{ __('vibe/settings.tabs.login_history.label') }}
        </vibe:tabs.tab>
    @endauth

    {{-- Group: Preferensi --}}
    <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.preferences') }}</p>

    <vibe:tabs.tab name="appearance" href="{{ route('[path].settings.appearance') }}" variant="sidebar" :active="$active === 'appearance'" badge="Live" badgeVariant="primary">
        <x-slot:icon>
            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                <path d="M5 3v4" />
                <path d="M19 17v4" />
            </svg>
        </x-slot:icon>
        {{ __('vibe/settings.tabs.appearance.label') }}
    </vibe:tabs.tab>



    @auth
        <div class="mt-auto pt-3 border-t border-border/40">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <vibe:button type="submit" variant="ghost" class="w-full justify-start text-muted-foreground hover:bg-destructive/10 hover:text-destructive transition-all">
                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="2" x2="9" y1="12" y2="12" />
                    </svg>
                    <span>{{ __('vibe/settings.tabs.logout') }}</span>
                </vibe:button>
            </form>
        </div>
    @endauth
</vibe:tabs.list>
