<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/settings/index.title')" :description="__('docs/page/settings/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/settings/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/settings/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/settings/index.breadcrumb.settings'), 'url' => route('docs.settings.account')],
        ['name' => 'Riwayat Login', 'url' => route('docs.settings.login-history')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{!! __('docs/page/settings/index.title') !!}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/settings/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/settings/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item href="{{ route('docs.settings.account') }}">{{ __('docs/page/settings/index.breadcrumb.settings') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>Riwayat Login</vibe:breadcrumb.item>
        </vibe:breadcrumb>

        <vibe:card class="p-0 overflow-hidden">
            <vibe:tabs selected="login-history" variant="sidebar" class="min-h-155">
                @include('docs.settings.tabs', ['active' => 'login-history'])

                <div class="flex-1 min-w-0 p-6 space-y-6">

                        {{-- Header --}}
                        <div class="border-b border-border/50 pb-4">
                            <h2 class="text-lg font-bold text-foreground">Riwayat Login & Sesi Aktif</h2>
                            <p class="text-xs text-muted-foreground mt-0.5">
                                Pantau semua aktivitas login dan akhiri sesi yang tidak dikenal.
                            </p>
                        </div>

                        @auth
                            {{-- Current Session Banner --}}
                            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20">
                                <span class="size-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                                <div class="flex-1 min-w-0 text-xs">
                                    <span class="font-semibold text-emerald-700 dark:text-emerald-300">Sesi Aktif Saat Ini</span>
                                    <span class="text-muted-foreground"> — {{ request()->userAgent() ? Str::limit(request()->userAgent(), 60) : 'Browser Anda' }}</span>
                                </div>
                                <span class="text-xs text-muted-foreground shrink-0">IP: {{ request()->ip() }}</span>
                            </div>

                            {{-- Login History Table --}}
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-foreground">Semua Sesi</h3>
                                    <vibe:button type="button" variant="ghost" size="sm" class="text-xs text-destructive hover:bg-destructive/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Semua sesi lain telah diakhiri.', { type: 'success', title: 'Sesi Diakhiri' }) : null">
                                        Akhiri Semua Sesi Lain
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
                                            'time' => 'Baru saja',
                                            'current' => true,
                                            'icon' => 'monitor',
                                        ],
                                        [
                                            'device' => 'MacBook Pro',
                                            'browser' => 'Safari 17',
                                            'os' => 'macOS Sonoma',
                                            'ip' => '103.147.8.22',
                                            'location' => 'Jakarta, Indonesia',
                                            'time' => '2 jam lalu',
                                            'current' => false,
                                            'icon' => 'laptop',
                                        ],
                                        [
                                            'device' => 'iPhone 15',
                                            'browser' => 'Safari Mobile',
                                            'os' => 'iOS 17',
                                            'ip' => '36.78.120.45',
                                            'location' => 'Surabaya, Indonesia',
                                            'time' => 'Kemarin, 20:14',
                                            'current' => false,
                                            'icon' => 'smartphone',
                                        ],
                                        [
                                            'device' => 'Android',
                                            'browser' => 'Chrome Mobile 127',
                                            'os' => 'Android 14',
                                            'ip' => '180.252.10.88',
                                            'location' => 'Bandung, Indonesia',
                                            'time' => '3 hari lalu',
                                            'current' => false,
                                            'icon' => 'smartphone',
                                        ],
                                        [
                                            'device' => 'Linux Desktop',
                                            'browser' => 'Firefox 128',
                                            'os' => 'Ubuntu 24.04',
                                            'ip' => '202.43.72.15',
                                            'location' => 'Tidak Diketahui',
                                            'time' => '5 hari lalu',
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
                                                            Sesi Ini
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
                                                <button type="button" data-device="{{ $session['device'] }}" class="shrink-0 text-xs text-muted-foreground hover:text-destructive font-medium transition-colors cursor-pointer mt-0.5" @click="window.vibeToast ? vibeToast('Sesi ' + $el.dataset.device + ' telah diakhiri.', { type: 'success', title: 'Sesi Diakhiri' }) : null">
                                                    Akhiri
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-xs text-muted-foreground italic">
                                    * Data riwayat login di atas adalah demo. Implementasi nyata memerlukan paket seperti <code class="font-mono bg-muted px-1 py-0.5 rounded">spatie/laravel-login-activity</code> atau model sesi kustom.
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
                                    <h3 class="text-sm font-semibold text-foreground">Login Diperlukan</h3>
                                    <p class="text-xs text-muted-foreground mt-1 max-w-xs mx-auto">
                                        Riwayat login dan sesi aktif hanya tersedia setelah Anda masuk ke akun.
                                    </p>
                                </div>
                                <vibe:button href="/login" variant="primary" size="sm">
                                    Masuk ke Akun
                                </vibe:button>
                            </div>
                        @endauth

                </div>
            </vibe:tabs>
        </vibe:card>
    </div>
</x-docs.layouts.sidebar>
