@props([
    'active' => 'account',
])

<vibe:tabs.list class="w-full md:w-64 shrink-0 flex flex-col gap-0.5 p-3 border-b md:border-b-0 md:border-r border-border/60 bg-muted/40">
    @auth
        <p class="px-2 pt-1 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.account') }}</p>

        <vibe:tabs.tab name="account" href="{{ route('docs.settings.account') }}" variant="sidebar" :active="$active === 'account'">
            <x-slot:icon>
                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="9" r="3" />
                    <circle cx="12" cy="12" r="10" />
                    <path d="M17.969 20C17.81 17.109 16.925 15 12 15s-5.81 2.109-5.969 5" />
                </svg>
            </x-slot:icon>
            {{ __('vibe/settings.tabs.account.label') }}
        </vibe:tabs.tab>

        <vibe:tabs.tab name="security" href="{{ route('docs.settings.security') }}" variant="sidebar" :active="$active === 'security'">
            <x-slot:icon>
                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16c0 2.828 0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16Z" />
                    <circle cx="12" cy="16" r="2" />
                    <path d="M6 10V8a6 6 0 1 1 12 0v2" />
                </svg>
            </x-slot:icon>
            {{ __('vibe/settings.tabs.security.label') }}
            <x-slot:right>
                <svg class="size-3 text-muted-foreground/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 16c0-2.828 0-4.243.879-5.121C3.757 10 5.172 10 8 10h8c2.828 0 4.243 0 5.121.879C22 11.757 22 13.172 22 16c0 2.828 0 4.243-.879 5.121C20.243 22 18.828 22 16 22H8c-2.828 0-4.243 0-5.121-.879C2 20.243 2 18.828 2 16Z" />
                    <circle cx="12" cy="16" r="2" />
                    <path d="M6 10V8a6 6 0 1 1 12 0v2" />
                </svg>
            </x-slot:right>
        </vibe:tabs.tab>

        <vibe:tabs.tab name="login-history" href="{{ route('docs.settings.login-history') }}" variant="sidebar" :active="$active === 'login-history'">
            <x-slot:icon>
                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 6v6l4 2" />
                </svg>
            </x-slot:icon>
            {{ __('vibe/settings.tabs.login_history.label') }}
        </vibe:tabs.tab>
    @endauth

    {{-- Group: Preferensi --}}
    <p class="px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.preferences') }}</p>

    <vibe:tabs.tab name="appearance" href="{{ route('docs.settings.appearance') }}" variant="sidebar" :active="$active === 'appearance'" badge="Live" badgeVariant="primary">
        <x-slot:icon>
            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20a8 8 0 1 1 0-16M12 12h9m0 0-3-3m3 3-3 3" />
                    </svg>
                    <span>{{ __('vibe/settings.tabs.logout') }}</span>
                </vibe:button>
            </form>
        </div>
    @endauth
</vibe:tabs.list>
