@php
    $currentLocale = app()->getLocale();
    $localeOptions = [
        'id' => [
            'flag' => 'ID',
            'label' => 'Bahasa Indonesia',
            'desc' => 'Indonesia (Default)',
        ],
        'en' => [
            'flag' => 'US',
            'label' => 'English (US)',
            'desc' => 'United States',
        ],
    ];
@endphp

<div class="space-y-6">
    {{-- Status Banner --}}
    <div class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-700 dark:text-emerald-300">
        <span class="size-2 rounded-full bg-emerald-500 shrink-0 animate-pulse"></span>
        <span>{!! __('vibe/settings.profile.logged_in_as', ['name' => '<strong>'.e($name).'</strong>']) !!} &bull; <span class="text-muted-foreground">{{ $email }}</span></span>
    </div>

    {{-- Section 1: Foto Profil --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 items-start w-full gap-6 xl:gap-x-12">
        <div class="xl:col-span-4 space-y-1 min-w-0">
            <div class="flex flex-wrap items-center gap-2">
                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.profile.avatar_title') }}</h3>
                <vibe:badge :variant="$avatarUrl ? 'success' : 'secondary'" class="rounded-full font-medium">
                    {{ $avatarUrl ? __('vibe/settings.profile.avatar_custom_badge') : __('vibe/settings.profile.avatar_default_badge') }}
                </vibe:badge>
            </div>
            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.profile.avatar_desc') }}</p>
        </div>

        <div
            class="xl:col-span-8 space-y-3 w-full min-w-0"
            x-data="{
                handleCircleRemoveClick(event) {
                    const removeBtn = event.target?.closest?.('.filepond--action-remove-item');
                    if (!removeBtn) return;

                    const itemEl = removeBtn.closest('.filepond--item');
                    const state = itemEl?.getAttribute('data-filepond-item-state') || '';
                    if (state === 'idle' || state === 'processing-complete') {
                        $wire.removeAvatar();
                    }
                },
                resetFilepond() {
                    const el = $el.querySelector('[data-vibe-filepond]');
                    if (el && window.Alpine && typeof window.Alpine.$data === 'function') {
                        const data = window.Alpine.$data(el);
                        if (data && typeof data.clear === 'function') {
                            data.clear();
                        }
                    }
                }
            }"
            x-on:click.capture="handleCircleRemoveClick($event)"
            x-on:profile-avatar-removed.window="resetFilepond()"
        >
            <div class="rounded-xl border border-border/60 bg-muted/40 p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center gap-5">
                <div class="w-[130px] shrink-0 mx-auto sm:mx-0">
                    <vibe:filepond
                        variant="avatar"
                        wire:model="avatar_file"
                        protect-upload
                        :files="$avatarUrl ? [$avatarUrl] : []"
                        name="avatar_tmp"
                        accept="image/jpeg,image/png,image/webp,image/gif,image/avif"
                        max-file-size="5MB"
                    />
                </div>

                <div class="flex-1 min-w-0 space-y-2 text-center sm:text-left">
                    <div class="space-y-1">
                        <p class="text-sm font-semibold text-foreground truncate">{{ $name }}</p>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            {{ $avatarUrl ? __('vibe/settings.profile.avatar_desc') : __('vibe/settings.profile.avatar_empty_hint') }}
                        </p>
                    </div>

                    @if ($avatarUrl)
                        <div class="pt-1">
                            <vibe:button
                                type="button"
                                size="sm"
                                variant="ghost"
                                class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer"
                                wire:click="removeAvatar"
                                wire:loading.attr="disabled"
                                wire:target="removeAvatar"
                            >
                                {{ __('vibe/settings.profile.remove_photo') }}
                            </vibe:button>
                        </div>
                    @endif
                </div>
            </div>

            @error('avatar_file')
                <p class="text-xs text-destructive font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <vibe:separator />

    {{-- Section 2: Informasi Pribadi --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 items-start w-full gap-6 xl:gap-x-12">
        <div class="xl:col-span-4 space-y-1 min-w-0">
            <div class="flex flex-wrap items-center gap-2">
                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.profile.personal_info_title') }}</h3>
                <vibe:badge :variant="$emailVerified ? 'success' : 'warning'" :dot="$emailVerified" class="rounded-full font-medium">
                    {{ $emailVerified ? __('vibe/settings.profile.email_verified_badge') : __('vibe/settings.profile.email_unverified_badge') }}
                </vibe:badge>
            </div>
            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.profile.personal_info_desc') }}</p>
        </div>

        <div class="xl:col-span-8 space-y-4 w-full min-w-0">
            @if (! $emailVerified)
                <vibe:card.alert variant="warning" size="sm">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 w-full">
                        <span>{{ __('vibe/settings.profile.email_unverified_alert') }}</span>
                        <vibe:button
                            type="button"
                            variant="outline"
                            size="xs"
                            class="shrink-0 cursor-pointer"
                            wire:click="resendEmailVerification"
                            wire:loading.attr="disabled"
                            wire:target="resendEmailVerification"
                        >
                            <span wire:loading.remove wire:target="resendEmailVerification">
                                {{ __('vibe/settings.profile.resend_verification_btn') }}
                            </span>
                            <span wire:loading.inline-flex wire:target="resendEmailVerification" class="inline-flex items-center gap-1.5">
                                {{ __('vibe/settings.profile.sending_verification') }}
                            </span>
                        </vibe:button>
                    </div>
                </vibe:card.alert>
            @endif

            <form wire:submit.prevent="updateProfile" class="space-y-4 w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <vibe:input
                            name="name"
                            :label="__('vibe/settings.profile.full_name')"
                            wire:model="name"
                            :placeholder="__('vibe/settings.profile.full_name_placeholder')"
                            required
                        />
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
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <vibe:input
                            name="username"
                            :label="__('vibe/settings.profile.username')"
                            wire:model="username"
                            :placeholder="__('vibe/settings.profile.username_placeholder')"
                            required
                        />
                    </div>

                    <div>
                        <vibe:input
                            name="phone"
                            :label="__('vibe/settings.profile.phone')"
                            wire:model="phone"
                            :placeholder="__('vibe/settings.profile.phone_placeholder')"
                            required
                        />
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <vibe:button type="submit" variant="primary" size="sm" class="cursor-pointer" wire:loading.attr="disabled" wire:target="updateProfile">
                        <span wire:loading.remove wire:target="updateProfile">
                            {{ __('vibe/settings.profile.save_changes') }}
                        </span>
                        <span wire:loading.inline-flex wire:target="updateProfile" class="inline-flex items-center justify-center gap-1.5 leading-none">
                            <svg class="size-3.5 animate-spin shrink-0 text-current" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span>{{ __('vibe/settings.profile.saving') }}</span>
                        </span>
                    </vibe:button>
                </div>
            </form>
        </div>
    </div>

    <vibe:separator />

    {{-- Section 3: Detail Akun --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 items-start w-full gap-6 xl:gap-x-12">
        <div class="xl:col-span-4 space-y-1 min-w-0">
            <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.profile.account_detail_title') }}</h3>
            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.profile.account_detail_desc') }}</p>
        </div>

        <div class="xl:col-span-8 space-y-3 w-full min-w-0">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="rounded-xl border border-border/60 bg-muted/40 p-3.5 space-y-1">
                    <p class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('vibe/settings.profile.joined_at') }}
                    </p>
                    <p class="text-sm font-semibold text-foreground">{{ $joinedAtLabel ?: '-' }}</p>
                    @if ($joinedHumanLabel)
                        <p class="text-xs text-muted-foreground">{{ $joinedHumanLabel }}</p>
                    @endif
                </div>

                <div class="rounded-xl border border-border/60 bg-muted/40 p-3.5 space-y-1">
                    <p class="text-[11px] font-semibold text-muted-foreground uppercase tracking-wider">
                        {{ __('vibe/settings.profile.email_status_label') }}
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-foreground">
                            {{ $emailVerified ? __('vibe/settings.profile.email_verified_badge') : __('vibe/settings.profile.email_unverified_badge') }}
                        </span>
                    </div>
                    <p class="text-xs text-muted-foreground">
                        {{ $emailVerified && $emailVerifiedAtLabel ? __('vibe/settings.profile.email_verified_at', ['date' => $emailVerifiedAtLabel]) : __('vibe/settings.profile.email_pending_verify') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <vibe:separator />

    {{-- Section 4: Bahasa Antarmuka --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 items-start w-full gap-6 xl:gap-x-12">
        <div class="xl:col-span-4 space-y-1 min-w-0">
            <div class="flex flex-wrap items-center gap-2">
                <h3 class="font-semibold text-foreground text-base">{{ __('vibe/settings.profile.interface_language') }}</h3>
                <vibe:badge variant="primary" class="rounded-full font-semibold uppercase">
                    {{ $currentLocale }}
                </vibe:badge>
            </div>
            <p class="text-muted-foreground text-xs">{{ __('vibe/settings.profile.language_desc') }}</p>
        </div>

        <div class="xl:col-span-8 space-y-3 w-full min-w-0">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach ($localeOptions as $code => $option)
                    @php
                        $isSelectedLocale = $currentLocale === $code;
                    @endphp
                    <a
                        href="{{ route('locale.switch', $code) }}"
                        class="flex items-center justify-between gap-3 rounded-xl border p-3.5 transition-all {{ $isSelectedLocale ? 'border-primary bg-primary/5 ring-2 ring-primary/15' : 'border-border/60 bg-muted/40 hover:bg-muted/70' }}"
                    >
                        <div class="flex items-center gap-3 min-w-0">
                            <span class="inline-flex items-center justify-center size-8 rounded-lg text-xs font-bold shrink-0 {{ $isSelectedLocale ? 'bg-primary text-primary-foreground' : 'bg-background border border-border text-muted-foreground' }}">
                                {{ $option['flag'] }}
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-foreground truncate">{{ $option['label'] }}</p>
                                <p class="text-xs text-muted-foreground truncate">{{ $option['desc'] }}</p>
                            </div>
                        </div>

                        @if ($isSelectedLocale)
                            <vibe:badge variant="primary" class="rounded-full shrink-0">
                                {{ __('vibe/settings.profile.language_active') }}
                            </vibe:badge>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
