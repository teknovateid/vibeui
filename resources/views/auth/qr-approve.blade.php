@php
    $formatVersionLabel = static fn (string $label): string => trim((string) preg_replace('/(?:\.0)+\b/', '', $label));
    $deviceType = $device['type'] ?? 'Desktop';
    $deviceBrowser = $formatVersionLabel((string) ($device['browser'] ?? 'Browser'));
    $devicePlatform = $formatVersionLabel((string) ($device['platform'] ?? 'Unknown OS'));
    $deviceIp = $device['ip'] ?? '127.0.0.1';

    $deviceIconPaths = match ($deviceType) {
        'Mobile' => '<rect width="14" height="20" x="5" y="2" rx="2"/><path d="M12 18h.01"/>',
        'Tablet' => '<rect width="16" height="20" x="4" y="2" rx="2"/><path d="M12 18h.01"/>',
        default => '<rect width="20" height="14" x="2" y="3" rx="2"/><path d="M8 21h8m-4-4v4"/>',
    };
@endphp

<div class="space-y-5">
    @if ($entryMode)
        {{-- Pairing Code Entry View (1-step auto-submit & approve) --}}
        <div class="space-y-1">
            <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                {{ __('auth/qr_login.code_entry_title') }}
            </h1>
            <p class="text-xs sm:text-sm text-muted-foreground">
                {{ __('auth/qr_login.code_entry_description') }}
            </p>
        </div>

        @if ($currentUser)
            <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-muted/50 border border-border/60">
                <vibe:avatar
                    size="sm"
                    indicator="online"
                    :src="$currentUser->avatar_url ?? null"
                    :name="$currentUser->name ?? $currentUser->email ?? 'User'"
                />
                <div class="min-w-0 leading-tight">
                    <p class="text-xs text-foreground truncate">
                        <span class="text-muted-foreground">{{ __('auth/qr_login.signed_in_as') }}</span>
                        <span class="font-semibold">{{ $currentUser->name ?? $currentUser->email }}</span>
                    </p>
                    @if (! empty($currentUser->email) && ! empty($currentUser->name))
                        <p class="text-[11px] text-muted-foreground truncate">{{ $currentUser->email }}</p>
                    @endif
                </div>
            </div>
        @endif

        <form wire:submit="submitPairingCode" class="space-y-4">
            <div class="space-y-2 flex flex-col items-center">
                <vibe:input.otp
                    wire:model="pairingCode"
                    id="pairingCode"
                    name="pairingCode"
                    length="8"
                    alphanumeric
                    separator="-"
                    auto-submit
                    autofocus
                    :label="__('auth/qr_login.code_input_label')"
                />
                <p class="text-[11px] text-center text-muted-foreground">
                    {{ __('auth/qr_login.code_instant_hint') }}
                </p>
            </div>

            <vibe:button
                type="submit"
                variant="primary"
                class="w-full justify-center shadow-xs"
                wire:target="submitPairingCode"
                :loading="__('auth/qr_login.code_checking')"
            >
                {{ __('auth/qr_login.code_submit_button') }}
            </vibe:button>

            <p class="text-center text-xs text-muted-foreground pt-1">
                <a href="{{ url('/') }}" wire:navigate class="font-medium hover:text-foreground transition-colors">
                    &larr; {{ __('auth/qr_login.back_home') }}
                </a>
            </p>
        </form>
    @elseif ($valid)
        {{-- QR Scan Approval View (Explicit Confirm/Decline) --}}
        <div class="space-y-1">
            <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                {{ __('auth/qr_login.approve_title') }}
            </h1>
            <p class="text-xs sm:text-sm text-muted-foreground">
                {{ __('auth/qr_login.approve_description') }}
            </p>
        </div>

        <div class="rounded-2xl border border-border/80 bg-card overflow-hidden">
            {{-- Requesting Device Header --}}
            <div class="flex items-center gap-3.5 p-4 bg-muted/35">
                <div class="size-10 rounded-xl bg-primary/10 border border-primary/15 flex items-center justify-center text-primary shrink-0">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        {!! $deviceIconPaths !!}
                    </svg>
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-sm font-semibold text-foreground truncate">{{ $deviceBrowser }}</p>
                        <vibe:badge variant="outline" size="xs" class="rounded-full shrink-0">
                            {{ $deviceType }}
                        </vibe:badge>
                    </div>
                    <p class="text-xs text-muted-foreground truncate mt-0.5">{{ $devicePlatform }}</p>
                </div>
            </div>

            {{-- Metadata Rows --}}
            <dl class="divide-y divide-border/50 border-t border-border/60 text-xs">
                <div class="px-4 py-3 flex items-start justify-between gap-4">
                    <dt class="text-muted-foreground shrink-0">{{ __('auth/qr_login.ip_label') }}</dt>
                    <dd class="font-mono font-medium text-foreground text-right break-all leading-relaxed">{{ $deviceIp }}</dd>
                </div>

                @if ($currentUser)
                    <div class="px-4 py-3 flex items-center justify-between gap-3 bg-muted/20">
                        <dt class="text-muted-foreground shrink-0">{{ __('auth/qr_login.account_label') }}</dt>
                        <dd class="flex items-center gap-2 min-w-0 justify-end">
                            <vibe:avatar
                                size="xs"
                                indicator="online"
                                :src="$currentUser->avatar_url ?? null"
                                :name="$currentUser->name ?? $currentUser->email ?? 'User'"
                            />
                            <div class="min-w-0 text-right leading-tight">
                                <p class="font-semibold text-foreground truncate">{{ $currentUser->name ?? $currentUser->email }}</p>
                                @if (! empty($currentUser->email) && ! empty($currentUser->name))
                                    <p class="text-[11px] text-muted-foreground truncate">{{ $currentUser->email }}</p>
                                @endif
                            </div>
                        </dd>
                    </div>
                @endif
            </dl>
        </div>

        <p class="flex items-start gap-2 px-0.5 text-[11px] text-muted-foreground leading-relaxed">
            <svg class="size-3.5 text-amber-500 shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/>
            </svg>
            <span>{{ __('auth/qr_login.security_warning') }}</span>
        </p>

        <div class="grid grid-cols-2 gap-2.5 pt-1">
            <vibe:button
                type="button"
                variant="outline"
                class="w-full justify-center"
                wire:click="reject"
                wire:target="reject,approve"
                :loading="__('auth/qr_login.rejecting')"
            >
                {{ __('auth/qr_login.reject_button') }}
            </vibe:button>

            <vibe:button
                type="button"
                variant="primary"
                class="w-full justify-center shadow-xs"
                wire:click="approve"
                wire:target="approve,reject"
                :loading="__('auth/qr_login.approving')"
            >
                {{ __('auth/qr_login.approve_button') }}
            </vibe:button>
        </div>
    @else
        {{-- Result View (Approved / Rejected / Expired) --}}
        <div class="text-center space-y-4">
            @if ($status === 'approved')
                <div class="mx-auto size-12 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center ring-4 ring-emerald-500/[0.05]">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="space-y-1">
                    <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                        {{ __('auth/qr_login.approved_title') }}
                    </h1>
                    <p class="text-xs sm:text-sm text-muted-foreground">
                        {{ $feedback ?: __('auth/qr_login.approved_success') }}
                    </p>
                </div>

                @if (! empty($device) || $currentUser)
                    <div class="w-full rounded-xl border border-border/75 bg-muted/25 text-left divide-y divide-border/50 overflow-hidden">
                        @if (! empty($device))
                            <div class="flex items-center gap-3 px-3.5 py-3">
                                <div class="size-9 rounded-lg bg-background border border-border/70 text-foreground/80 flex items-center justify-center shrink-0">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        {!! $deviceIconPaths !!}
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <p class="text-xs font-semibold text-foreground truncate">{{ $deviceBrowser }}</p>
                                        <span class="text-[11px] text-muted-foreground shrink-0">{{ $devicePlatform }}</span>
                                    </div>
                                    <p class="text-[11px] font-mono text-muted-foreground break-all mt-0.5">{{ $deviceIp }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($currentUser)
                            <div class="flex items-center justify-between gap-3 px-3.5 py-2.5 bg-background/60 text-xs">
                                <span class="text-muted-foreground shrink-0">{{ __('auth/qr_login.account_label') }}</span>
                                <div class="flex items-center gap-2 min-w-0 justify-end">
                                    <vibe:avatar
                                        size="xs"
                                        indicator="online"
                                        :src="$currentUser->avatar_url ?? null"
                                        :name="$currentUser->name ?? $currentUser->email ?? 'User'"
                                    />
                                    <span class="font-medium text-foreground truncate">{{ $currentUser->name ?? $currentUser->email }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @elseif ($status === 'rejected')
                <div class="mx-auto size-12 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center ring-4 ring-amber-500/[0.05]">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </div>
                <div class="space-y-1">
                    <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                        {{ __('auth/qr_login.rejected_title') }}
                    </h1>
                    <p class="text-xs sm:text-sm text-muted-foreground">
                        {{ $feedback ?: __('auth/qr_login.rejected_success') }}
                    </p>
                </div>
            @else
                <div class="mx-auto size-12 rounded-full bg-destructive/10 border border-destructive/20 text-destructive flex items-center justify-center ring-4 ring-destructive/[0.05]">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"/>
                        <polyline points="12 7 12 12 15 14"/>
                    </svg>
                </div>
                <div class="space-y-1">
                    <h1 class="text-xl font-bold tracking-tight text-card-foreground">
                        {{ __('auth/qr_login.unavailable_title') }}
                    </h1>
                    <p class="text-xs sm:text-sm text-muted-foreground">
                        {{ $feedback ?: __('auth/qr_login.approve_expired') }}
                    </p>
                </div>
            @endif
        </div>

        @if ($broadcastWarning)
            <vibe:card.alert
                variant="warning"
                size="sm"
                :title="__('auth/qr_login.broadcast_warning_title')"
                :description="$broadcastWarning"
            />
        @endif

        <div class="flex flex-col gap-2 pt-1">
            @if (in_array($status, ['expired', 'already_processed'], true))
                <vibe:button type="button" wire:click="resetToCodeEntry" variant="primary" class="w-full justify-center shadow-xs">
                    {{ __('auth/qr_login.try_another_code') }}
                </vibe:button>
                <vibe:button href="{{ url('/') }}" wire:navigate variant="outline" class="w-full justify-center">
                    {{ __('auth/qr_login.back_home') }}
                </vibe:button>
            @else
                <vibe:button href="{{ url('/') }}" wire:navigate :variant="$status === 'approved' ? 'primary' : 'outline'" class="w-full justify-center shadow-xs">
                    {{ __('auth/qr_login.back_home') }}
                </vibe:button>
                <p class="text-center text-xs text-muted-foreground pt-1">
                    <button type="button" wire:click="resetToCodeEntry" class="font-medium hover:text-foreground transition-colors cursor-pointer">
                        {{ __('auth/qr_login.approve_another_device') }}
                    </button>
                </p>
            @endif
        </div>
    @endif
</div>
