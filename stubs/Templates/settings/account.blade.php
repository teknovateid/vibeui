<x-[path].layouts.[style]>
    <vibe:seo :title="__('vibe/settings.title')" :description="__('vibe/settings.subtitle')" :breadcrumbs="[
        ['name' => __('vibe/settings.breadcrumb.home'), 'url' => '/'],
        ['name' => __('vibe/settings.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('vibe/settings.breadcrumb.settings'), 'url' => route('[path].settings.account')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('vibe/settings.title') !!}">
            <vibe:breadcrumb.item href="{{ route('[path].index') }}">{{ __('vibe/settings.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('vibe/settings.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('vibe/settings.breadcrumb.settings') }}</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="account" variant="sidebar" class="min-h-155">
                @include('[path].settings.tabs', ['active' => 'account'])

                <div class="flex-1 min-w-0 p-6 space-y-6">
                    {{-- Header --}}
                    <div class="border-b border-border/50 pb-4">
                        <h2 class="text-lg font-bold text-foreground">{{ __('vibe/settings.profile.header_title') }}</h2>
                        <p class="text-xs text-muted-foreground mt-0.5">
                            {{ __('vibe/settings.profile.header_desc') }}
                        </p>
                    </div>

                    @auth
                        <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-300">
                            <span class="size-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
                            <span>{!! __('vibe/settings.profile.logged_in_as', ['name' => '<strong>'.e(auth()->user()->name).'</strong>']) !!}</span>
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
                                <vibe:input name="full_name" :label="__('vibe/settings.profile.full_name')" value="{{ auth()->user()->name }}" :placeholder="__('vibe/settings.profile.full_name_placeholder')" />
                                <vibe:input type="email" name="email" :label="__('vibe/settings.profile.email_address')" value="{{ auth()->user()->email }}" :placeholder="__('vibe/settings.profile.email_placeholder')" />
                            </div>
                            @if (isset(auth()->user()->username))
                                <vibe:input name="username" :label="__('vibe/settings.profile.username')" value="{{ auth()->user()->username ?? '' }}" :placeholder="__('vibe/settings.profile.username_placeholder')" />
                            @endif
                            @if (isset(auth()->user()->phone))
                                <vibe:input name="phone" :label="__('vibe/settings.profile.phone')" value="{{ auth()->user()->phone ?? '' }}" :placeholder="__('vibe/settings.profile.phone_placeholder')" />
                            @endif
                            <vibe:textarea name="bio" :label="__('vibe/settings.profile.bio')" :placeholder="__('vibe/settings.profile.bio_placeholder')" rows="2"></vibe:textarea>

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
                        </div>

                        {{-- Save Action --}}
                        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('{{ __('vibe/settings.profile.saved_toast') }}', { type: 'success', title: '{{ __('vibe/settings.profile.saved_title') }}' }) : null">
                                {{ __('vibe/settings.profile.save_changes') }}
                            </vibe:button>
                        </div>
                    @else
                        {{-- Guest: dummy data + login prompt --}}
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
                                <vibe:input name="full_name" :label="__('vibe/settings.profile.full_name')" value="Masum Parvej" :placeholder="__('vibe/settings.profile.full_name_placeholder')" />
                                <vibe:input type="email" name="email" :label="__('vibe/settings.profile.email_address')" value="masum@hugeicons.com" :placeholder="__('vibe/settings.profile.email_placeholder')" />
                            </div>
                            <vibe:textarea name="bio" :label="__('vibe/settings.profile.bio')" :placeholder="__('vibe/settings.profile.bio_placeholder')" rows="2">UI/UX Designer & Design Systems Architect at Teknovate.</vibe:textarea>

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
                        </div>

                        <div class="pt-4 border-t border-border/50 flex items-center justify-end">
                            <vibe:button type="button" variant="primary" size="sm" class="cursor-pointer" @click="window.vibeToast ? vibeToast('{{ __('vibe/settings.profile.saved_toast') }}', { type: 'success', title: '{{ __('vibe/settings.profile.saved_title') }}' }) : null">
                                {{ __('vibe/settings.profile.save_changes') }}
                            </vibe:button>
                        </div>
                    @endauth
                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-[path].layouts.[style]>
