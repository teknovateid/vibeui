<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.index')],
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb :title="__('docs/page/settings/index.title')">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs default="{{ auth()->check() ? 'account' : 'appearance' }}" layout="cols" variant="sidebar" syncUrl="tab" class="w-full">

                {{-- ================================================================= --}}
                {{-- TABS LIST (sidebar kiri)                                          --}}
                {{-- ================================================================= --}}
                <vibe:tabs.list class="w-full md:w-56 shrink-0 flex flex-row md:flex-col overflow-x-auto md:overflow-visible hide-scroll gap-1 md:gap-0.5 p-2 md:p-3 border-b md:border-b-0 md:border-r border-border/60 bg-muted/40">
                    <p class="hidden md:block px-2 pt-1 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.account') }}</p>
                    <vibe:tabs.tab name="account">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.profile.label') }}</span>
                        @auth<span class="ml-auto size-1.5 rounded-full bg-emerald-500 shrink-0"></span>@endauth
                    </vibe:tabs.tab>

                    <vibe:tabs.tab name="security">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.security.label') }}</span>
                    </vibe:tabs.tab>

                    {{-- Group: Preferensi --}}
                    <p class="hidden md:block px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.preferences') }}</p>

                    <vibe:tabs.tab name="appearance">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                                <path d="M5 3v4" />
                                <path d="M19 17v4" />
                            </svg>
                        </x-slot:icon>
                        <span class="flex-1 text-left">{{ __('docs/page/settings/index.tabs.appearance.label') }}</span>
                    </vibe:tabs.tab>

                    <vibe:tabs.tab name="notifications">
                        <x-slot:icon>
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ __('docs/page/settings/index.tabs.notifications.label') }}</span>
                    </vibe:tabs.tab>

                    {{-- Group: Sesi & Perangkat (auth only) --}}
                    @auth
                        <p class="hidden md:block px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.sessions') }}</p>

                        <vibe:tabs.tab name="login-history">
                            <x-slot:icon>
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                    <path d="M12 7v5l4 2" />
                                </svg>
                            </x-slot:icon>
                            <span>{{ __('vibe/settings.tabs.login_history.label') }}</span>
                        </vibe:tabs.tab>

                        <vibe:tabs.tab name="passkey">
                            <x-slot:icon>
                                <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                    <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                    <path d="M2 12a10 10 0 0 1 18-6" />
                                </svg>
                            </x-slot:icon>
                            <span>{{ __('vibe/settings.tabs.passkey.label') }}</span>
                            @php $passkeyCount = auth()->user()->passkeys?->count() ?? 0; @endphp
                            @if ($passkeyCount > 0)
                                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-primary/10 text-primary">{{ $passkeyCount }}</span>
                            @endif
                        </vibe:tabs.tab>

                        <div class="hidden md:block mt-auto pt-3 border-t border-border/40">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium text-muted-foreground hover:bg-destructive/10 hover:text-destructive transition-all cursor-pointer">
                                    <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <polyline points="16 17 21 12 16 7" />
                                        <line x1="21" x2="9" y1="12" y2="12" />
                                    </svg>
                                    <span>{{ __('vibe/settings.tabs.logout') }}</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="hidden md:block px-2 pt-3 pb-1 text-[10px] font-bold uppercase tracking-widest text-muted-foreground/60">{{ __('vibe/settings.tabs_groups.sessions') }}</p>
                        <vibe:tabs.tab name="login-history">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                                <path d="M12 7v5l4 2" />
                            </svg>
                            <span>{{ __('vibe/settings.tabs.login_history.label') }}</span>
                            <svg class="size-3.5 ml-auto text-muted-foreground/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </vibe:tabs.tab>
                        <vibe:tabs.tab name="passkey">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                <path d="M2 12a10 10 0 0 1 18-6" />
                            </svg>
                            <span>{{ __('vibe/settings.tabs.passkey.label') }}</span>
                            <svg class="size-3.5 ml-auto text-muted-foreground/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </vibe:tabs.tab>
                    @endauth
                </vibe:tabs.list>

                {{-- ================================================================= --}}
                {{-- PANEL 1: ACCOUNT                                                  --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="account" class="flex-1 min-w-0 p-6 space-y-6">
                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">

                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.profile.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.profile.header_desc') }}
                        </p>
                    </div>

                    @auth
                        {{-- Logged-in: data nyata --}}

                        {{-- Auth Info Banner --}}
                        <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-300">
                            <span class="size-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
                            <span>{!! __('vibe/settings.profile.logged_in_as', ['name' => auth()->user()->name]) !!}</span>
                        </div>

                        {{-- Avatar & Identity --}}
                        <div class="flex items-center gap-4">
                            @php
                                $initials = collect(explode(' ', auth()->user()->name))
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
                                    <vibe:button type="button" size="sm" variant="outline" class="text-xs cursor-pointer">
                                        {{ __('vibe/settings.profile.change_photo') }}
                                    </vibe:button>
                                    <vibe:button type="button" size="sm" variant="ghost" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer">
                                        {{ __('vibe/settings.profile.remove_photo') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        {{-- Form Fields (data nyata dari auth()) --}}
                        <div class="space-y-4 max-w-xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <vibe:input name="full_name" label="{{ __('vibe/settings.profile.full_name') }}" value="{{ auth()->user()->name }}" placeholder="{{ __('vibe/settings.profile.full_name_placeholder') }}" />
                                <vibe:input type="email" name="email" label="{{ __('vibe/settings.profile.email_address') }}" value="{{ auth()->user()->email }}" placeholder="{{ __('vibe/settings.profile.email_placeholder') }}" />
                            </div>
                            @if (isset(auth()->user()->username))
                                <vibe:input name="username" label="{{ __('vibe/settings.profile.username') }}" value="{{ auth()->user()->username ?? '' }}" placeholder="{{ __('vibe/settings.profile.username_placeholder') }}" />
                            @endif
                            @if (isset(auth()->user()->phone))
                                <vibe:input name="phone" label="{{ __('vibe/settings.profile.phone') }}" value="{{ auth()->user()->phone ?? '' }}" placeholder="{{ __('vibe/settings.profile.phone_placeholder') }}" />
                            @endif
                            <vibe:textarea name="bio" label="{{ __('vibe/settings.profile.bio') }}" placeholder="{{ __('vibe/settings.profile.bio_placeholder') }}" rows="2"></vibe:textarea>

                            {{-- Language Selector --}}
                            <div class="space-y-2 pt-2">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">{{ __('vibe/settings.profile.interface_language') }}</label>
                                <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                    @php
                                        $locOpts = ['id' => '🇮🇩 Bahasa Indonesia', 'en' => '🇺🇸 English (US)'];
                                        $curLoc = app()->getLocale();
                                    @endphp
                                    @foreach ($locOpts as $c => $l)
                                        <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', $c) }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ $curLoc === $c ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                            {{ $l }}
                                        </vibe:button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Save Action --}}
                        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.profile.saved_toast')), { type: 'success', title: @js(__('vibe/settings.profile.saved_title')) }) : null">
                                {{ __('vibe/settings.profile.save_btn') }}
                            </vibe:button>
                        </div>
                    @else
                        {{-- Guest: dummy data + login prompt --}}

                        {{-- Guest Banner --}}
                        <div class="flex items-center gap-3 px-3.5 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{!! __('vibe/settings.profile.guest_notice') !!}</span>
                            <a href="/login" class="ml-auto shrink-0 px-3 py-1 rounded-lg bg-amber-500 text-white font-semibold hover:bg-amber-600 transition-colors">{{ __('vibe/settings.profile.login_button') }}</a>
                        </div>

                        {{-- Avatar & Identity (dummy) --}}
                        <div class="flex items-center gap-4">
                            <vibe:avatar size="lg" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=75&w=128&h=128&auto=format&fit=crop" alt="User Avatar" class="ring-2 ring-primary/20 shrink-0" />
                            <div class="space-y-1">
                                <h4 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.profile.avatar_title') }}</h4>
                                <div class="flex items-center gap-2">
                                    <vibe:button type="button" size="sm" variant="outline" class="text-xs cursor-pointer">
                                        {{ __('vibe/settings.profile.change_photo') }}
                                    </vibe:button>
                                    <vibe:button type="button" size="sm" variant="ghost" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer">
                                        {{ __('vibe/settings.profile.remove_photo') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </div>

                        {{-- Essential Fields (dummy) --}}
                        <div class="space-y-4 max-w-xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <vibe:input name="full_name" label="{{ __('vibe/settings.profile.full_name') }}" value="Masum Parvej" placeholder="{{ __('vibe/settings.profile.full_name_placeholder') }}" />
                                <vibe:input type="email" name="email" label="{{ __('vibe/settings.profile.email_address') }}" value="masum@hugeicons.com" placeholder="{{ __('vibe/settings.profile.email_placeholder') }}" />
                            </div>
                            <vibe:textarea name="bio" label="{{ __('vibe/settings.profile.bio') }}" placeholder="{{ __('vibe/settings.profile.bio_placeholder') }}" rows="2">UI/UX Designer &amp; Design Systems Architect at Teknovate.</vibe:textarea>

                            <div class="space-y-2 pt-2">
                                <label class="text-xs font-semibold text-foreground uppercase tracking-wider block">{{ __('vibe/settings.profile.interface_language') }}</label>
                                <div class="inline-flex p-1 rounded-xl bg-muted/50 border border-border/60 gap-1">
                                    @php
                                        $locOpts2 = ['id' => '🇮🇩 Bahasa Indonesia', 'en' => '🇺🇸 English (US)'];
                                        $curLoc2 = app()->getLocale();
                                    @endphp
                                    @foreach ($locOpts2 as $c => $l)
                                        <vibe:button variant="ghost" size="sm" href="{{ route('locale.switch', $c) }}" class="px-3 py-1.5 rounded-lg text-xs transition-all {{ $curLoc2 === $c ? 'bg-card text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground' }}">
                                            {{ $l }}
                                        </vibe:button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.profile.saved_toast')), { type: 'success', title: @js(__('vibe/settings.profile.saved_title')) }) : null">
                                {{ __('vibe/settings.profile.save_btn') }}
                            </vibe:button>
                        </div>
                    @endauth
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 2: SECURITY                                                 --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="security" class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.security.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.security.header_desc') }}
                        </p>
                    </div>

                    @auth
                        {{-- Auth: tampilkan info akun aktif --}}
                        <div class="flex items-center gap-3 p-3.5 rounded-xl bg-muted/40 border border-border">
                            <div class="size-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="5" />
                                    <path d="M20 21a8 8 0 0 0-16 0" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-foreground">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-muted-foreground truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                {{ __('vibe/settings.login_history.active_now') }}
                            </span>
                        </div>
                    @else
                        {{-- Guest banner --}}
                        <div class="flex items-center gap-3 px-3.5 py-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300">
                            <svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{!! __('vibe/settings.profile.guest_notice') !!}</span>
                            <a href="/login" class="ml-auto shrink-0 px-3 py-1 rounded-lg bg-amber-500 text-white font-semibold hover:bg-amber-600 transition-colors">{{ __('vibe/settings.profile.login_button') }}</a>
                        </div>
                    @endauth

                    {{-- Change Password --}}
                    <div class="space-y-1">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.security.password_title') }}</h3>
                        <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.password_desc') }}</p>
                    </div>

                    <div class="space-y-4 max-w-md">
                        @auth
                            <vibe:input type="password" name="current_password" label="{{ __('vibe/settings.security.current_password') }}" viewable placeholder="{{ __('vibe/settings.security.current_password_placeholder') }}" />
                        @endauth
                        <vibe:input type="password" name="new_password" label="{{ __('vibe/settings.security.new_password') }}" viewable placeholder="{{ __('vibe/settings.security.new_password_placeholder') }}" />
                        <vibe:input type="password" name="confirm_password" label="{{ __('vibe/settings.security.confirm_password') }}" viewable placeholder="{{ __('vibe/settings.security.confirm_password_placeholder') }}" />
                    </div>

                    <div class="pt-4 border-t border-border/50 flex items-center justify-end max-w-md">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.security.password_updated_toast')), { type: 'success', title: @js(__('vibe/settings.security.password_updated_title')) }) : null">
                            {{ __('vibe/settings.security.update_password_btn') }}
                        </vibe:button>
                    </div>

                    {{-- Two-Factor Authentication --}}
                    <div class="pt-2 space-y-4">
                        <div class="space-y-1">
                            <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.security.two_factor_title') }}</h3>
                            <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.two_factor_desc') }}</p>
                        </div>

                        <div class="max-w-md border border-border/60 rounded-2xl p-4 space-y-4">
                            <vibe:switch name="enable_2fa" label="{{ __('vibe/settings.security.enable_2fa') }}" description="{{ __('vibe/settings.security.totp_desc') }}" />

                            <div class="p-3.5 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                <p class="text-xs font-semibold text-foreground">{{ __('vibe/settings.security.methods_title') }}</p>
                                <div class="space-y-1.5 text-xs text-muted-foreground">
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3.5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <span>Authenticator App (TOTP) — Google Authenticator, Authy</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3.5 text-emerald-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                        <span>SMS / WhatsApp OTP</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="size-3.5 text-muted-foreground/40 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="18" x2="6" y1="6" y2="18" />
                                            <line x1="6" x2="18" y1="6" y2="18" />
                                        </svg>
                                        <span class="text-muted-foreground/50">Email OTP ({{ __('vibe/settings.security.coming_soon') }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Danger Zone --}}
                    <div class="pt-2 space-y-3">
                        <div class="space-y-1">
                            <h3 class="text-sm font-semibold text-destructive">{{ __('vibe/settings.security.danger_zone_title') }}</h3>
                            <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.danger_zone_desc') }}</p>
                        </div>
                        <div class="max-w-md p-4 rounded-2xl border border-destructive/30 bg-destructive/5 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-foreground">{{ __('vibe/settings.security.delete_account_title') }}</p>
                                <p class="text-xs text-muted-foreground mt-0.5">{{ __('vibe/settings.security.delete_account_desc') }}</p>
                            </div>
                            <vibe:button type="button" variant="ghost" size="sm" class="shrink-0 text-destructive border border-destructive/30 hover:bg-destructive hover:text-destructive-foreground cursor-pointer" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.security.delete_account_confirm_desc')), { type: 'warning', title: @js(__('vibe/settings.security.attention_title')) }) : null">
                                {{ __('vibe/settings.security.delete_account_btn') }}
                            </vibe:button>
                        </div>
                    </div>
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 3: APPEARANCE (LIVE THEME ENGINE)                           --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="appearance" class="flex-1 min-w-0 p-6 sm:p-8 space-y-8">
                    <div x-data="appearanceController()" x-init="init()" class="space-y-8">
                        {{-- 1. Header Bar with Status & Actions --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-border/60">
                            <div class="flex items-start gap-3.5">
                                <div class="size-11 rounded-2xl bg-primary/10 text-primary flex items-center justify-center shrink-0 ring-1 ring-primary/20 shadow-xs">
                                    <svg class="size-5.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z" />
                                        <path d="M5 3v4" />
                                        <path d="M19 17v4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2.5">
                                        <h2 class="text-xl font-bold tracking-tight text-foreground">
                                            {{ __('docs/page/settings/index.tabs.appearance.label') }}
                                        </h2>
                                        <vibe:badge variant="success" size="sm" class="rounded-full" dot dotPulse>
                                            Live Engine
                                        </vibe:badge>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-1 leading-relaxed max-w-xl">
                                        {{ __('docs/page/settings/index.tabs.appearance.desc') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0 self-end sm:self-auto">
                                <button type="button" @click="resetToDefault()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-border/80 bg-background/80 hover:bg-muted text-xs font-medium text-muted-foreground hover:text-foreground transition-all cursor-pointer shadow-2xs">
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                        <path d="M3 3v5h5" />
                                    </svg>
                                    <span>{{ __('vibe/settings.appearance.reset_btn_short') }}</span>
                                </button>
                                <button type="button" @click="savePreferences()" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-primary text-primary-foreground hover:opacity-90 text-xs font-semibold shadow-xs transition-all cursor-pointer active:scale-95">
                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    <span>{{ __('vibe/settings.appearance.save_theme_btn') }}</span>
                                </button>
                            </div>
                        </div>

                        {{-- 3. Mode Antarmuka (Light / Dark / System) with Visual Cards --}}
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                    {{ __('docs/page/settings/index.appearance.theme_mode_title') }}
                                </label>
                                <p class="text-xs text-muted-foreground mt-0.5">
                                    {{ __('docs/page/settings/index.appearance.theme_mode_desc') }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                {{-- Light Card --}}
                                <button type="button" @click="setMode('light', $event)" class="relative text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer group flex flex-col justify-between gap-3.5 overflow-hidden" :class="mode === 'light' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-md' : 'bg-muted/30 border-border hover:border-primary/50 hover:bg-muted/50'">
                                    <div class="flex items-center justify-between">
                                        <div class="size-9 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center border border-amber-500/20">
                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="4" />
                                                <path d="M12 2v2" />
                                                <path d="M12 20v2" />
                                                <path d="m4.93 4.93 1.41 1.41" />
                                                <path d="m17.66 17.66 1.41 1.41" />
                                                <path d="M2 12h2" />
                                                <path d="M20 12h2" />
                                                <path d="m6.34 17.66-1.41 1.41" />
                                                <path d="m19.07 4.93-1.41 1.41" />
                                            </svg>
                                        </div>
                                        <div x-show="mode === 'light'" class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[11px] shadow-xs">
                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    {{-- Mini UI representation --}}
                                    <div class="h-12 w-full rounded-xl bg-white border border-zinc-200 p-1.5 flex gap-1.5 shadow-2xs">
                                        <div class="w-1/4 h-full rounded-md bg-zinc-100"></div>
                                        <div class="flex-1 h-full flex flex-col gap-1.5 justify-center">
                                            <div class="w-full h-2 rounded-xs bg-zinc-100"></div>
                                            <div class="w-2/3 h-2 rounded-xs bg-primary/40"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-foreground">{{ __('vibe/settings.appearance.modes.light') }}</p>
                                        <p class="text-[11px] text-muted-foreground mt-0.5">{{ __('vibe/settings.appearance.modes_desc.light') }}</p>
                                    </div>
                                </button>

                                {{-- Dark Card --}}
                                <button type="button" @click="setMode('dark', $event)" class="relative text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer group flex flex-col justify-between gap-3.5 overflow-hidden" :class="mode === 'dark' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-md' : 'bg-muted/30 border-border hover:border-primary/50 hover:bg-muted/50'">
                                    <div class="flex items-center justify-between">
                                        <div class="size-9 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center border border-indigo-500/20">
                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                                            </svg>
                                        </div>
                                        <div x-show="mode === 'dark'" class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[11px] shadow-xs">
                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    {{-- Mini UI representation --}}
                                    <div class="h-12 w-full rounded-xl bg-zinc-950 border border-zinc-800 p-1.5 flex gap-1.5 shadow-2xs">
                                        <div class="w-1/4 h-full rounded-md bg-zinc-900"></div>
                                        <div class="flex-1 h-full flex flex-col gap-1.5 justify-center">
                                            <div class="w-full h-2 rounded-xs bg-zinc-900"></div>
                                            <div class="w-2/3 h-2 rounded-xs bg-primary/50"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-foreground">{{ __('vibe/settings.appearance.modes.dark') }}</p>
                                        <p class="text-[11px] text-muted-foreground mt-0.5">{{ __('vibe/settings.appearance.modes_desc.dark') }}</p>
                                    </div>
                                </button>

                                {{-- System Card --}}
                                <button type="button" @click="setMode('system', $event)" class="relative text-left p-4 rounded-2xl border transition-all duration-200 cursor-pointer group flex flex-col justify-between gap-3.5 overflow-hidden" :class="mode === 'system' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-md' : 'bg-muted/30 border-border hover:border-primary/50 hover:bg-muted/50'">
                                    <div class="flex items-center justify-between">
                                        <div class="size-9 rounded-xl bg-cyan-500/10 text-cyan-500 flex items-center justify-center border border-cyan-500/20">
                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                                <line x1="8" x2="16" y1="21" y2="21" />
                                                <line x1="12" x2="12" y1="17" y2="21" />
                                            </svg>
                                        </div>
                                        <div x-show="mode === 'system'" class="size-5 rounded-full bg-primary text-primary-foreground flex items-center justify-center text-[11px] shadow-xs">
                                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                                <polyline points="20 6 9 17 4 12" />
                                            </svg>
                                        </div>
                                    </div>
                                    {{-- Mini UI representation (split) --}}
                                    <div class="h-12 w-full rounded-xl border border-zinc-300 dark:border-zinc-700 flex overflow-hidden shadow-2xs">
                                        <div class="w-1/2 h-full bg-white p-1.5 flex gap-1 items-center">
                                            <div class="w-1/3 h-full rounded-xs bg-zinc-100"></div>
                                            <div class="flex-1 h-2 bg-primary/30 rounded-xs"></div>
                                        </div>
                                        <div class="w-1/2 h-full bg-zinc-950 p-1.5 flex gap-1 items-center border-l border-zinc-700">
                                            <div class="w-1/3 h-full rounded-xs bg-zinc-900"></div>
                                            <div class="flex-1 h-2 bg-primary/50 rounded-xs"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-foreground">{{ __('vibe/settings.appearance.modes.system') }}</p>
                                        <p class="text-[11px] text-muted-foreground mt-0.5">{{ __('vibe/settings.appearance.modes_desc.system') }}</p>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {{-- 4. Warna Aksen Utama (--primary) --}}
                        <div class="space-y-3 pt-6 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                        {{ __('docs/page/settings/index.appearance.primary_color_title') }}
                                    </label>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        {{ __('docs/page/settings/index.appearance.primary_color_desc') }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-muted/60 border border-border/80 shadow-2xs">
                                    <span class="size-2.5 rounded-full" :style="{ backgroundColor: getActivePrimaryColor() }"></span>
                                    <span class="font-semibold text-foreground" x-text="getActiveColorName()"></span>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-3 pt-1">
                                <template x-for="(val, key) in presets" :key="key">
                                    <button type="button" @click="selectPreset(key)" :title="val.name" class="size-10 rounded-2xl transition-all duration-200 hover:scale-110 active:scale-95 cursor-pointer flex items-center justify-center relative shadow-xs group" :class="selectedPreset === key ? 'ring-2 ring-primary ring-offset-2 ring-offset-background scale-105 shadow-sm' : 'hover:shadow-md'" :style="{ backgroundColor: val.color }">
                                        <svg x-show="selectedPreset === key" class="size-4 text-white drop-shadow-xs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </button>
                                </template>

                                {{-- Custom Color Picker Pill --}}
                                <label title="{{ __('vibe/settings.appearance.color_picker_title') }}" class="h-10 px-3.5 rounded-2xl border-2 border-dashed transition-all cursor-pointer relative flex items-center gap-2 group hover:border-primary shrink-0" :class="selectedPreset === 'custom' ? 'border-primary ring-2 ring-primary/30 bg-primary/5 shadow-xs' : 'border-border/80 hover:bg-muted/40'">
                                    <input type="color" x-model="customHex" @input.debounce.50ms="applyCustomHex(customHex)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                    <span class="size-4 rounded-full border border-black/10 shadow-2xs" :style="{ backgroundColor: customHex }"></span>
                                    <span class="text-xs font-mono font-semibold" :class="selectedPreset === 'custom' ? 'text-primary' : 'text-muted-foreground group-hover:text-foreground'" x-text="customHex"></span>
                                    <svg class="size-3.5 text-muted-foreground group-hover:text-primary transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        {{-- 5. Kustomisasi Sidebar --}}
                        <div class="space-y-4 pt-6 border-t border-border/50">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                            {{ __('docs/page/settings/index.appearance.sidebar_title') }}
                                        </label>
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-muted text-muted-foreground border border-border/60" x-text="getActiveSidebarName()"></span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        {{ __('docs/page/settings/index.appearance.sidebar_desc') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Sidebar Preset Cards --}}
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5">
                                <template x-for="(val, key) in sidebarPresets" :key="key">
                                    <button type="button" @click="selectSidebarPreset(key)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedSidebarPreset === key ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                        {{-- Visual Mini Sidebar Strip --}}
                                        <div class="h-10 w-full rounded-lg border flex overflow-hidden shadow-2xs" :style="{
                                            backgroundColor: (mode === 'dark' ? val.dark.bg : val.light.bg),
                                            borderColor: (mode === 'dark' ? val.dark.border : val.light.border)
                                        }">
                                            <div class="w-1/3 h-full border-r p-1 flex flex-col gap-1" :style="{ borderColor: (mode === 'dark' ? val.dark.border : val.light.border) }">
                                                <div class="size-1.5 rounded-full" :style="{ backgroundColor: getActivePrimaryColor() }"></div>
                                                <div class="w-full h-1 rounded-xs opacity-40" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                            </div>
                                            <div class="flex-1 h-full p-1 flex items-center justify-center">
                                                <div class="w-3/4 h-1.5 rounded-xs opacity-20" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-semibold truncate text-foreground" x-text="val.name"></span>
                                            <span x-show="selectedSidebarPreset === key" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        </div>
                                    </button>
                                </template>

                                {{-- Custom Sidebar Button --}}
                                <button type="button" @click="selectedSidebarPreset = 'custom'; updateGeneratedCss(); injectOverrideCss();" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedSidebarPreset === 'custom' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                    <div class="h-10 w-full rounded-lg border-2 border-dashed border-border/80 flex items-center justify-center shadow-2xs" :style="{ backgroundColor: customSidebarBg }">
                                        <span class="text-xs font-bold" :style="{ color: customSidebarFg }">🎨</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-semibold text-foreground">{{ __('vibe/settings.appearance.custom_pill') }}</span>
                                        <span x-show="selectedSidebarPreset === 'custom'" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                    </div>
                                </button>
                            </div>

                            {{-- Custom Sidebar Color Studio --}}
                            <div x-show="selectedSidebarPreset === 'custom'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-4 rounded-2xl bg-card border border-border/70 shadow-xs space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-foreground">{{ __('vibe/settings.appearance.studio_sidebar_title') }}</span>
                                    <button type="button" @click="autoAdjustSidebarColors()" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-muted hover:bg-muted/80 text-xs text-muted-foreground hover:text-foreground font-medium transition-colors cursor-pointer">
                                        <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2v4" />
                                            <path d="m4.93 4.93 2.83 2.83" />
                                            <path d="M2 12h4" />
                                            <path d="m4.93 19.07 2.83-2.83" />
                                        </svg>
                                        <span>{{ __('vibe/settings.appearance.auto_contrast_btn') }}</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                                    {{-- Background --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.sidebar_bg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customSidebarBg }">
                                                <input type="color" x-model="customSidebarBg" @input.debounce.50ms="applyCustomSidebarBg(customSidebarBg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customSidebarBg" @change="applyCustomSidebarBg(customSidebarBg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Foreground --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.sidebar_fg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customSidebarFg }">
                                                <input type="color" x-model="customSidebarFg" @input.debounce.50ms="applyCustomSidebarFg(customSidebarFg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customSidebarFg" @change="applyCustomSidebarFg(customSidebarFg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Border --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.sidebar_border') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customSidebarBorder }">
                                                <input type="color" x-model="customSidebarBorder" @input.debounce.50ms="applyCustomSidebarBorder(customSidebarBorder)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customSidebarBorder" @change="applyCustomSidebarBorder(customSidebarBorder)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 6. Kustomisasi Header --}}
                        <div class="space-y-4 pt-6 border-t border-border/50">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                            {{ __('docs/page/settings/index.appearance.header_title') }}
                                        </label>
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md bg-muted text-muted-foreground border border-border/60" x-text="getActiveHeaderName()"></span>
                                    </div>
                                    <p class="text-xs text-muted-foreground mt-0.5">
                                        {{ __('docs/page/settings/index.appearance.header_desc') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Header Preset Cards --}}
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-2.5">
                                <template x-for="(val, key) in headerPresets" :key="key">
                                    <button type="button" @click="selectHeaderPreset(key)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedHeaderPreset === key ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                        {{-- Visual Mini Header Strip --}}
                                        <div class="h-10 w-full rounded-lg border flex flex-col overflow-hidden shadow-2xs" :style="{
                                            backgroundColor: (mode === 'dark' ? val.dark.bg : val.light.bg),
                                            borderColor: (mode === 'dark' ? val.dark.border : val.light.border)
                                        }">
                                            <div class="h-4 w-full border-b px-1.5 flex items-center justify-between" :style="{ borderColor: (mode === 'dark' ? val.dark.border : val.light.border) }">
                                                <div class="w-1/3 h-1 rounded-xs opacity-50" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                                <div class="size-2 rounded-full" :style="{ backgroundColor: getActivePrimaryColor() }"></div>
                                            </div>
                                            <div class="flex-1 w-full p-1 flex items-center justify-center bg-black/5 dark:bg-white/5">
                                                <div class="w-1/2 h-1 rounded-xs opacity-20" :style="{ backgroundColor: (mode === 'dark' ? val.dark.fg : val.light.fg) }"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-[11px] font-semibold truncate text-foreground" x-text="val.name"></span>
                                            <span x-show="selectedHeaderPreset === key" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        </div>
                                    </button>
                                </template>

                                {{-- Custom Header Button --}}
                                <button type="button" @click="selectedHeaderPreset = 'custom'; updateGeneratedCss(); injectOverrideCss();" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex flex-col gap-2 group relative" :class="selectedHeaderPreset === 'custom' ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border/70 hover:border-primary/40 hover:bg-muted/50'">
                                    <div class="h-10 w-full rounded-lg border-2 border-dashed border-border/80 flex items-center justify-center shadow-2xs" :style="{ backgroundColor: customHeaderBg }">
                                        <span class="text-xs font-bold" :style="{ color: customHeaderFg }">✨</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-[11px] font-semibold text-foreground">{{ __('vibe/settings.appearance.custom_pill') }}</span>
                                        <span x-show="selectedHeaderPreset === 'custom'" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                    </div>
                                </button>
                            </div>

                            {{-- Custom Header Color Studio --}}
                            <div x-show="selectedHeaderPreset === 'custom'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="p-4 rounded-2xl bg-card border border-border/70 shadow-xs space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-foreground">{{ __('vibe/settings.appearance.studio_header_title') }}</span>
                                    <button type="button" @click="autoAdjustHeaderColors()" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-muted hover:bg-muted/80 text-xs text-muted-foreground hover:text-foreground font-medium transition-colors cursor-pointer">
                                        <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2v4" />
                                            <path d="m4.93 4.93 2.83 2.83" />
                                            <path d="M2 12h4" />
                                            <path d="m4.93 19.07 2.83-2.83" />
                                        </svg>
                                        <span>{{ __('vibe/settings.appearance.auto_contrast_btn') }}</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                                    {{-- Background --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.header_bg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customHeaderBg }">
                                                <input type="color" x-model="customHeaderBg" @input.debounce.50ms="applyCustomHeaderBg(customHeaderBg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customHeaderBg" @change="applyCustomHeaderBg(customHeaderBg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Foreground --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.header_fg') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customHeaderFg }">
                                                <input type="color" x-model="customHeaderFg" @input.debounce.50ms="applyCustomHeaderFg(customHeaderFg)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customHeaderFg" @change="applyCustomHeaderFg(customHeaderFg)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>

                                    {{-- Border --}}
                                    <div class="p-3 rounded-xl bg-muted/40 border border-border/60 space-y-2">
                                        <label class="text-[11px] font-semibold text-foreground block">{{ __('docs/page/settings/index.appearance.header_border') }}</label>
                                        <div class="flex items-center gap-2">
                                            <label class="size-9 rounded-xl border border-border shadow-2xs cursor-pointer shrink-0 relative overflow-hidden flex items-center justify-center" :style="{ backgroundColor: customHeaderBorder }">
                                                <input type="color" x-model="customHeaderBorder" @input.debounce.50ms="applyCustomHeaderBorder(customHeaderBorder)" class="absolute inset-0 opacity-0 cursor-pointer size-full" />
                                            </label>
                                            <input type="text" x-model="customHeaderBorder" @change="applyCustomHeaderBorder(customHeaderBorder)" class="w-full text-xs font-mono px-3 py-2 rounded-xl border border-border bg-background text-foreground focus:ring-2 focus:ring-primary focus:outline-none" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 7. Bentuk Radius & Tipografi --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6 border-t border-border/50">
                            {{-- Corner Radius --}}
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                        {{ __('docs/page/settings/index.appearance.radius_title') }}
                                    </label>
                                    <span class="text-xs font-mono font-semibold text-primary px-2.5 py-0.5 rounded-md bg-primary/10 border border-primary/20" x-text="selectedRadius"></span>
                                </div>
                                <div class="grid grid-cols-5 gap-2">
                                    <template x-for="r in radii" :key="r.value">
                                        <button type="button" @click="selectRadius(r.value)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer flex flex-col items-center gap-2 group text-center" :class="selectedRadius === r.value ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:border-primary/40 hover:bg-muted/50'">
                                            <div class="size-7 border-2 border-primary/70 bg-primary/10 transition-all flex items-center justify-center" :style="{ borderRadius: r.value }">
                                                <span class="size-2 bg-primary" :style="{ borderRadius: r.value }"></span>
                                            </div>
                                            <span class="text-[11px] font-medium text-foreground truncate w-full" x-text="r.label"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Font Family --}}
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                        {{ __('docs/page/settings/index.appearance.font_title') }}
                                    </label>
                                    <span class="text-xs font-medium text-primary px-2.5 py-0.5 rounded-md bg-primary/10 border border-primary/20" x-text="selectedFontName"></span>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="f in fonts" :key="f.name">
                                        <button type="button" @click="selectFont(f.value, f.name)" class="p-2.5 rounded-xl border transition-all duration-200 cursor-pointer text-left flex items-center gap-3 group" :class="selectedFontName === f.name ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:border-primary/40 hover:bg-muted/50'">
                                            <span class="text-xl font-bold text-foreground/80 group-hover:text-primary transition-colors" :style="{ fontFamily: f.value }">Aa</span>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-xs font-semibold text-foreground truncate" :style="{ fontFamily: f.value }" x-text="f.name"></p>
                                                <p class="text-[10px] text-muted-foreground truncate" x-text="f.desc"></p>
                                            </div>
                                            <span x-show="selectedFontName === f.name" class="size-1.5 rounded-full bg-primary shrink-0"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- 8. Bahasa Antarmuka (Interface Language) --}}
                        <div class="space-y-3 pt-6 border-t border-border/50">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold uppercase tracking-wider text-foreground block">
                                    {{ __('docs/page/settings/index.profile.language') }}
                                </label>
                                <span class="text-xs text-muted-foreground font-medium">{{ __('docs/page/settings/index.profile.language_active') }}</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-md">
                                @php
                                    $languageCards = [
                                        'id' => ['flag' => '🇮🇩', 'title' => 'Bahasa Indonesia', 'sub' => 'ID - Standar Nasional'],
                                        'en' => ['flag' => '🇺🇸', 'title' => 'English', 'sub' => 'US - International'],
                                    ];
                                    $activeLang = app()->getLocale();
                                @endphp
                                @foreach ($languageCards as $code => $card)
                                    @php $isSelected = ($activeLang === $code); @endphp
                                    <a href="{{ route('locale.switch', $code) }}" class="p-3 rounded-xl border transition-all flex items-center gap-3 {{ $isSelected ? 'bg-card border-primary ring-2 ring-primary/20 shadow-xs' : 'bg-muted/20 border-border hover:bg-muted/40 text-muted-foreground hover:text-foreground' }}">
                                        <span class="text-xl">{{ $card['flag'] }}</span>
                                        <div>
                                            <p class="text-xs font-semibold text-foreground">{{ $card['title'] }}</p>
                                            <p class="text-[10px] text-muted-foreground">{{ $card['sub'] }}</p>
                                        </div>
                                        @if ($isSelected)
                                            <span class="ml-auto size-1.5 rounded-full bg-primary"></span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    {{-- Alpine.js Appearance Manager Script --}}
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 4: NOTIFICATIONS                                            --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="notifications" class="flex-1 min-w-0 p-6 space-y-6">

                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.notifications.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.notifications.header_desc') }}
                        </p>
                    </div>

                    {{-- Email Notifications --}}
                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.notifications.email_title') }}</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_security" label="{{ __('vibe/settings.notifications.security_alerts_label') }}" description="{{ __('vibe/settings.notifications.security_alerts_desc') }}" checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_orders" label="{{ __('vibe/settings.notifications.orders_label') }}" description="{{ __('vibe/settings.notifications.orders_desc') }}" checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_product" label="{{ __('vibe/settings.notifications.product_label') }}" description="{{ __('vibe/settings.notifications.product_desc') }}" />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_newsletter" label="{{ __('vibe/settings.notifications.newsletter_label') }}" description="{{ __('vibe/settings.notifications.newsletter_desc') }}" />
                            </div>
                        </div>
                    </div>

                    {{-- Push / In-App Notifications --}}
                    <div class="space-y-2 pt-2">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.notifications.inapp_section_title') }}</h3>
                        <div class="max-w-xl space-y-0 divide-y divide-border/40 border border-border/60 rounded-2xl overflow-hidden">
                            <div class="p-4">
                                <vibe:switch name="alert_sound" label="{{ __('vibe/settings.notifications.sound_label') }}" description="{{ __('vibe/settings.notifications.sound_desc') }}" checked />
                            </div>
                            <div class="p-4">
                                <vibe:switch name="alert_desktop" label="{{ __('vibe/settings.notifications.desktop_label') }}" description="{{ __('vibe/settings.notifications.desktop_desc') }}" />
                            </div>
                        </div>
                    </div>

                    {{-- Save Action --}}
                    <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                        <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.notifications.saved_toast')), { type: 'success', title: @js(__('vibe/settings.notifications.saved_title')) }) : null">
                            {{ __('vibe/settings.notifications.save_btn') }}
                        </vibe:button>
                    </div>
                </vibe:tabs.panel>

                {{-- ================================================================= --}}
                {{-- PANEL 5: LOGIN HISTORY (auth only)                               --}}
                {{-- ================================================================= --}}
                <vibe:tabs.panel name="login-history" class="flex-1 min-w-0 p-6 space-y-6">

                        {{-- Header --}}
                        <div class="border-b border-border/50 pb-4">
                            <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.login_history.header_title') }}</h2>
                            <p class="text-xs text-muted-foreground mt-0.5">
                                {{ __('vibe/settings.login_history.header_desc') }}
                            </p>
                        </div>

                        @auth
                            {{-- Current Session Banner --}}
                            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                                <span class="size-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                                <div class="flex-1 min-w-0 text-xs">
                                    <span class="font-semibold text-emerald-700 dark:text-emerald-300">{{ __('vibe/settings.login_history.current_session') }}</span>
                                    <span class="text-muted-foreground"> — {{ request()->userAgent() ? Str::limit(request()->userAgent(), 60) : __('vibe/settings.login_history.your_browser') }}</span>
                                </div>
                                <span class="text-xs text-muted-foreground shrink-0">IP: {{ request()->ip() }}</span>
                            </div>

                            {{-- Login History Table --}}
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.login_history.all_sessions') }}</h3>
                                    <vibe:button type="button" variant="ghost" size="sm" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.login_history.terminated_all_toast')), { type: 'success', title: @js(__('vibe/settings.login_history.terminated_all_title')) }) : null">
                                        {{ __('vibe/settings.login_history.terminate_all_btn') }}
                                    </vibe:button>
                                </div>

                                {{-- Mock login history data --}}
                                @php
                                    $loginHistory = [
                                        [
                                            'device' => 'Windows PC',
                                            'browser' => 'Chrome 127',
                                            'os' => 'Windows 11',
                                            'ip' => request()->ip(),
                                            'location' => 'Makassar, Indonesia',
                                            'time' => now()->diffForHumans(),
                                            'current' => true,
                                            'icon' => 'monitor',
                                        ],
                                        [
                                            'device' => 'MacBook Pro',
                                            'browser' => 'Safari 17',
                                            'os' => 'macOS Sonoma',
                                            'ip' => '103.147.8.22',
                                            'location' => 'Jakarta, Indonesia',
                                            'time' => now()->subHours(2)->diffForHumans(),
                                            'current' => false,
                                            'icon' => 'laptop',
                                        ],
                                        [
                                            'device' => 'iPhone 15',
                                            'browser' => 'Safari Mobile',
                                            'os' => 'iOS 17',
                                            'ip' => '36.78.120.45',
                                            'location' => 'Surabaya, Indonesia',
                                            'time' => now()->subDay()->setTime(20, 14)->diffForHumans(),
                                            'current' => false,
                                            'icon' => 'smartphone',
                                        ],
                                        [
                                            'device' => 'Android',
                                            'browser' => 'Chrome Mobile 127',
                                            'os' => 'Android 14',
                                            'ip' => '180.252.10.88',
                                            'location' => 'Bandung, Indonesia',
                                            'time' => now()->subDays(3)->diffForHumans(),
                                            'current' => false,
                                            'icon' => 'smartphone',
                                        ],
                                        [
                                            'device' => 'Linux Desktop',
                                            'browser' => 'Firefox 128',
                                            'os' => 'Ubuntu 24.04',
                                            'ip' => '202.43.72.15',
                                            'location' => __('vibe/settings.login_history.unknown_device'),
                                            'time' => now()->subDays(5)->diffForHumans(),
                                            'current' => false,
                                            'icon' => 'monitor',
                                        ],
                                    ];
                                @endphp

                                <div class="border border-border/60 rounded-2xl overflow-hidden divide-y divide-border/40">
                                    @foreach ($loginHistory as $session)
                                        <div class="p-4 flex items-start gap-4 {{ $session['current'] ? 'bg-emerald-500/5' : 'bg-card hover:bg-muted/20' }} transition-colors">
                                            {{-- Device Icon --}}
                                            <div class="size-9 rounded-xl shrink-0 flex items-center justify-center {{ $session['current'] ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-muted/60 text-muted-foreground' }}">
                                                @if ($session['icon'] === 'smartphone')
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                                                        <path d="M12 18h.01" />
                                                    </svg>
                                                @else
                                                    <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <rect width="20" height="14" x="2" y="3" rx="2" />
                                                        <line x1="8" x2="16" y1="21" y2="21" />
                                                        <line x1="12" x2="12" y1="17" y2="21" />
                                                    </svg>
                                                @endif
                                            </div>

                                            {{-- Session Info --}}
                                            <div class="flex-1 min-w-0 space-y-1">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <span class="text-sm font-semibold text-foreground">{{ $session['device'] }}</span>
                                                    @if ($session['current'])
                                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                            {{ __('vibe/settings.login_history.this_session_badge') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 text-xs text-muted-foreground">
                                                    <span>{{ $session['browser'] }} · {{ $session['os'] }}</span>
                                                    <span class="font-mono">{{ $session['ip'] }}</span>
                                                    <span>{{ $session['location'] }}</span>
                                                </div>
                                                <p class="text-xs text-muted-foreground/70">{{ $session['time'] }}</p>
                                            </div>

                                            {{-- Action --}}
                                            @if (!$session['current'])
                                                <button type="button" data-device="{{ $session['device'] }}" class="shrink-0 text-xs text-muted-foreground hover:text-destructive font-medium transition-colors cursor-pointer mt-0.5" @click="window.vibeToast ? vibeToast(@js(__('vibe/settings.login_history.terminated_single_toast')).replace(':device', $el.dataset.device), { type: 'success', title: @js(__('vibe/settings.login_history.terminated_single_title')) }) : null">
                                                    {{ __('vibe/settings.login_history.terminate_btn') }}
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-xs text-muted-foreground italic">
                                    {!! __('vibe/settings.login_history.demo_notice', ['package' => '<code class="font-mono bg-muted px-1 py-0.5 rounded">spatie/laravel-login-activity</code>']) !!}
                                </p>
                            </div>
                        @else
                            {{-- Guest: redirect prompt --}}
                            <div class="flex flex-col items-center justify-center py-16 text-center space-y-4">
                                <div class="size-16 rounded-2xl bg-muted/60 flex items-center justify-center">
                                    <svg class="size-8 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.login_history.guest_title') }}</h3>
                                    <p class="text-xs text-muted-foreground mt-1 max-w-xs mx-auto">
                                        {{ __('vibe/settings.login_history.guest_desc') }}
                                    </p>
                                </div>
                                <vibe:button href="/login" variant="primary" size="sm">
                                    {{ __('vibe/settings.login_history.guest_btn') }}
                                </vibe:button>
                            </div>
                        @endauth
                    </vibe:tabs.panel>

                    {{-- ================================================================= --}}
                    {{-- PANEL 6: PASSKEY (auth only)                                     --}}
                    {{-- ================================================================= --}}
                    <vibe:tabs.panel name="passkey" class="flex-1 min-w-0 p-6 space-y-6">
                        @push('head')
                            @vite('resources/js/vibe/passkeys.js')
                        @endpush

                        {{-- Header --}}
                        <div class="border-b border-border/50 pb-4">
                            <div class="flex items-center gap-2.5">
                                <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.security.passkey_title') }}</h2>
                                <vibe:badge variant="primary" size="sm" class="rounded-full">Passwordless</vibe:badge>
                            </div>
                            <p class="text-xs text-muted-foreground mt-0.5">
                                {{ __('vibe/settings.security.passkey_desc') }}
                            </p>
                        </div>

                        @auth
                            <div x-data="{
                                supported: false,
                                isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                                localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                                registerName: @js(__('vibe/settings.security.passkey_device_default')) + ' (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometric')) + ')',
                                accountPassword: '',
                                showPassword: false,
                                loading: false,
                                statusText: '',
                                feedbackMessage: null,
                                feedbackType: 'info',
                                init() {
                                    this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                                },
                                async submitRegisterPasskey() {
                                    if (!this.accountPassword) {
                                        this.feedbackType = 'error';
                                        this.feedbackMessage = @js(__('vibe/settings.security.enter_account_password_first'));
                                        return;
                                    }

                                    this.loading = true;
                                    this.statusText = @js(__('vibe/settings.security.verifying_password'));
                                    this.feedbackMessage = null;

                                    try {
                                        // 1. Verifikasi kata sandi terlebih dahulu
                                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                                        const verifyRes = await fetch('/confirm-password', {
                                             method: 'POST',
                                             headers: {
                                                 'Content-Type': 'application/json',
                                                 'X-CSRF-TOKEN': csrfToken,
                                                 'Accept': 'application/json',
                                             },
                                             body: JSON.stringify({ password: this.accountPassword }),
                                        });

                                        if (!verifyRes.ok && verifyRes.status !== 204 && !verifyRes.redirected) {
                                             const data = await verifyRes.json().catch(() => ({}));
                                             this.feedbackType = 'error';
                                             this.feedbackMessage = data?.errors?.password?.[0] || data?.message || @js(__('vibe/settings.security.password_incorrect'));
                                             this.loading = false;
                                             return;
                                        }

                                        // 2. Jika kata sandi benar, lanjutkan pendaftaran WebAuthn Passkey
                                        this.statusText = @js(__('vibe/settings.security.passkey_sensor_preparing'));
                                        if (!window.VibePasskeyService) {
                                             throw new Error(@js(__('vibe/settings.security.passkey_module_not_loaded')));
                                        }

                                        const regRes = await window.VibePasskeyService.register(this.registerName || @js(__('vibe/settings.security.passkey_device_default')));
                                        if (regRes.success) {
                                             this.feedbackType = 'success';
                                             this.feedbackMessage = @js(__('vibe/settings.security.passkey_registered_success'));
                                             this.accountPassword = '';
                                             setTimeout(() => window.location.reload(), 1500);
                                        } else {
                                             this.feedbackType = 'error';
                                             this.feedbackMessage = regRes.message || @js(__('vibe/settings.security.passkey_canceled_user'));
                                        }
                                    } catch (err) {
                                        this.feedbackType = 'error';
                                        this.feedbackMessage = err.message || @js(__('vibe/settings.security.passkey_error_processing'));
                                    } finally {
                                        this.loading = false;
                                        this.statusText = '';
                                    }
                                }
                            }">

                                {{-- Browser Support Badge --}}
                                <div class="flex items-center justify-between">
                                    <div class="space-y-0.5">
                                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.security.browser_status') }}</h3>
                                        <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.browser_status_desc') }}</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold" :class="supported ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-destructive/10 text-destructive'">
                                        <span class="size-2 rounded-full" :class="supported ? 'bg-emerald-500' : 'bg-destructive'"></span>
                                        <span x-text="supported ? @js(__('vibe/settings.security.browser_supported')) : @js(__('vibe/settings.security.browser_not_supported'))"></span>
                                    </span>
                                </div>

                                {{-- IP Address Warning --}}
                                <template x-if="isIpAddress">
                                    <div class="p-3.5 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 flex items-center justify-between gap-3">
                                        <span>{!! __('vibe/settings.security.passkey_ip_alert') !!}</span>
                                        <a :href="localhostUrl" class="shrink-0 px-3 py-1.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors">{!! __('vibe/settings.security.passkey_open_localhost') !!}</a>
                                    </div>
                                </template>

                                {{-- Feedback Message --}}
                                <div x-show="feedbackMessage" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                                    <p class="font-semibold" x-text="feedbackType === 'success' ? '✓ ' + @js(__('vibe/settings.security.success_title')) : '⚠ ' + @js(__('vibe/settings.security.attention_title'))"></p>
                                    <p x-text="feedbackMessage" class="leading-relaxed"></p>
                                </div>

                                {{-- Registered Passkeys List --}}
                                @php
                                    $userPasskeys = auth()->user()->passkeys ?? collect();
                                @endphp

                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-foreground">
                                            {{ __('vibe/settings.security.registered_passkeys') }}
                                            <span class="ml-1.5 px-1.5 py-0.5 text-[10px] font-bold rounded-full bg-primary/10 text-primary">{{ $userPasskeys->count() }}</span>
                                        </h3>
                                    </div>

                                    @if ($userPasskeys->isEmpty())
                                        <div class="flex items-center gap-3.5 p-4 rounded-xl bg-muted/40 border border-dashed border-border/80">
                                            <div class="size-10 rounded-xl bg-muted flex items-center justify-center shrink-0">
                                                <svg class="size-5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                                    <path d="M2 12a10 10 0 0 1 18-6" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-foreground">{{ __('vibe/settings.security.no_passkeys') }}</p>
                                                <p class="text-xs text-muted-foreground mt-0.5">{{ __('vibe/settings.security.no_passkeys_desc') }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="border border-border/60 rounded-2xl overflow-hidden divide-y divide-border/40">
                                            @foreach ($userPasskeys as $passkey)
                                                <div class="p-4 flex items-center justify-between gap-4 bg-card hover:bg-muted/20 transition-colors">
                                                    <div class="flex items-center gap-3 min-w-0">
                                                        <div class="size-9 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                                            <svg class="size-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                                                <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                                                <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                                                <path d="M2 12a10 10 0 0 1 18-6" />
                                                            </svg>
                                                        </div>
                                                        <div class="min-w-0">
                                                            <p class="text-sm font-semibold text-foreground truncate">{{ $passkey->name }}</p>
                                                            <p class="text-xs text-muted-foreground">{{ __('vibe/settings.security.added_time', ['time' => $passkey->created_at?->diffForHumans()]) }}</p>
                                                        </div>
                                                    </div>
                                                    <form method="POST" action="/user/passkeys/{{ $passkey->id }}" onsubmit="return confirm(@js(__('vibe/settings.security.delete_passkey_message', ['name' => $passkey->name])));">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-xs text-muted-foreground hover:text-destructive font-medium transition-colors cursor-pointer px-2 py-1 rounded-lg hover:bg-destructive/10">
                                                            {{ __('vibe/settings.security.delete_passkey') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                {{-- Add New Passkey (Wajib Kata Sandi Terlebih Dahulu) --}}
                                <div class="pt-3 border-t border-border/50 space-y-4">
                                    <div>
                                        <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.security.register_new_passkey') }}</h3>
                                        <p class="text-xs text-muted-foreground mt-0.5">
                                            {{ __('vibe/settings.security.register_new_passkey_desc') }}
                                        </p>
                                    </div>

                                    <form @submit.prevent="submitRegisterPasskey()" class="p-4 rounded-2xl bg-muted/30 border border-border/60 space-y-3.5">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-semibold text-foreground">{{ __('vibe/settings.security.device_name') }}</label>
                                                <input
                                                    type="text"
                                                    x-model="registerName"
                                                    placeholder="{{ __('vibe/settings.security.register_new_passkey_placeholder') }}"
                                                    class="w-full px-3 py-2 text-sm rounded-xl border border-input bg-background text-foreground shadow-2xs focus:ring-2 focus:ring-primary focus:outline-none"
                                                    required
                                                />
                                            </div>
                                            <div class="space-y-1.5">
                                                <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                                    <span>{{ __('vibe/settings.security.account_password') }}</span>
                                                    <span class="text-[10px] text-muted-foreground font-normal">{{ __('vibe/settings.security.security_verification') }}</span>
                                                </label>
                                                <div class="relative">
                                                    <input
                                                        :type="showPassword ? 'text' : 'password'"
                                                        x-model="accountPassword"
                                                        placeholder="{{ __('vibe/settings.security.password_placeholder') }}"
                                                        autocomplete="current-password"
                                                        class="w-full px-3 py-2 pr-10 text-sm rounded-xl border border-input bg-background text-foreground shadow-2xs focus:ring-2 focus:ring-primary focus:outline-none"
                                                        required
                                                    />
                                                    <button
                                                        type="button"
                                                        @click="showPassword = !showPassword"
                                                        class="absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer"
                                                        tabindex="-1"
                                                    >
                                                        <svg x-show="!showPassword" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                        <svg x-show="showPassword" x-cloak class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pt-1">
                                            <div class="text-[11px] text-muted-foreground flex items-center gap-1.5">
                                                <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                                <span>{{ __('vibe/settings.security.passkey_verify_note') }}</span>
                                            </div>

                                            <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !accountPassword" class="cursor-pointer shrink-0">
                                                <template x-if="!loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        <span>{{ __('vibe/settings.security.confirm_and_register_passkey') }}</span>
                                                    </span>
                                                </template>
                                                <template x-if="loading">
                                                    <span class="inline-flex items-center gap-1.5">
                                                        <svg class="animate-spin size-3.5" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                        <span x-text="statusText || @js(__('vibe/settings.security.processing'))"></span>
                                                    </span>
                                                </template>
                                            </vibe:button>
                                        </div>
                                    </form>
                                </div>

                                {{-- Info Note --}}
                                <div class="p-3.5 rounded-xl bg-muted/40 border border-border/60 text-xs text-muted-foreground space-y-1 leading-relaxed">
                                    <p class="font-semibold text-foreground">{{ __('vibe/settings.security.how_passkeys_work_title') }}</p>
                                    <p>{{ __('vibe/settings.security.how_passkeys_work_desc') }}</p>
                                </div>

                            </div>
                        @else
                            {{-- Guest: lock screen --}}
                            <div class="flex flex-col items-center justify-center py-16 text-center space-y-4">
                                <div class="size-16 rounded-2xl bg-muted/60 flex items-center justify-center">
                                    <svg class="size-8 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                        <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                        <path d="M2 12a10 10 0 0 1 18-6" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-foreground">{{ __('vibe/settings.login_history.guest_title') }}</h3>
                                    <p class="text-xs text-muted-foreground mt-1 max-w-xs mx-auto">
                                        {{ __('vibe/settings.security.guest_passkey_desc') }}
                                    </p>
                                </div>
                                <vibe:button href="/login" variant="primary" size="sm">{{ __('vibe/settings.login_history.guest_btn') }}</vibe:button>
                            </div>
                        @endauth
                    </vibe:tabs.panel>

            </vibe:tabs>
        </vibe:card>
    </div>
</x-docs.layouts.sidebar>
