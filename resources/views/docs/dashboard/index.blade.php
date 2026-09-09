<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/dashboard/index.title')" :description="__('docs/page/dashboard/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/dashboard/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/dashboard/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/dashboard/index.breadcrumb.dashboard'), 'url' => route('docs.dashboard.show', 'index')],
    ]" />

    <div class="mx-auto w-full space-y-6">
        <vibe:breadcrumb title="{{ __('docs/page/dashboard/index.title') }}">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/dashboard/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/dashboard/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('docs/page/dashboard/index.breadcrumb.dashboard') }}</vibe:breadcrumb.item>

            <x-slot:button>
                <div class="flex flex-wrap items-center gap-2.5 shrink-0" x-data="{ activeTimeframe: 'last_30_days' }">
                    {{-- Quick Timeframe Pills --}}
                    <div class="inline-flex items-center p-1 rounded-xl bg-muted/70 border border-border/60 text-xs font-medium">
                        <button type="button" @click="activeTimeframe = 'today'" :class="activeTimeframe === 'today' ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg transition-all cursor-pointer select-none">
                            {{ __('docs/page/dashboard/index.actions.today') }}
                        </button>
                        <button type="button" @click="activeTimeframe = 'last_7_days'" :class="activeTimeframe === 'last_7_days' ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg transition-all cursor-pointer select-none">
                            {{ __('docs/page/dashboard/index.actions.last_7_days') }}
                        </button>
                        <button type="button" @click="activeTimeframe = 'last_30_days'" :class="activeTimeframe === 'last_30_days' ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg transition-all cursor-pointer select-none">
                            {{ __('docs/page/dashboard/index.actions.last_30_days') }}
                        </button>
                        <button type="button" @click="activeTimeframe = 'this_year'" :class="activeTimeframe === 'this_year' ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg transition-all cursor-pointer select-none">
                            {{ __('docs/page/dashboard/index.actions.this_year') }}
                        </button>
                    </div>

                    {{-- Export Button --}}
                    <vibe:button type="button" variant="outline" size="sm" class="gap-1.5 shadow-2xs cursor-pointer" @click="window.vibeToast ? vibeToast('Laporan penjualan CSV siap diunduh.', { type: 'success', title: 'Export Berhasil' }) : alert('Laporan siap diunduh')">
                        <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                            <line x1="12" y1="15" x2="12" y2="3" />
                        </svg>
                        <span>{{ __('docs/page/dashboard/index.actions.export') }}</span>
                    </vibe:button>

                    {{-- Add Product Button --}}
                    <vibe:button type="button" variant="primary" size="sm" class="gap-1.5 shadow-xs cursor-pointer" @click="window.vibeAlert ? vibeAlert({ title: 'Tambah Produk Baru', message: 'Formulir pembuatan produk katalog baru dibuka.' }) : null">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        <span>{{ __('docs/page/dashboard/index.actions.add_product') }}</span>
                    </vibe:button>
                </div>
            </x-slot:button>
        </vibe:breadcrumb>

        <vibe:grid id="ecommerce-dashboard-grid" :cols="12" :persist="true" :resizable="true" :reorderable="true" storageKey="vibe-dashboard-layout">
            {{-- ========================================================================= --}}
            {{-- ROW 1: KEY PERFORMANCE INDICATOR CARDS (4 CARDS, colSpan=3)               --}}
            {{-- ========================================================================= --}}

            {{-- 1. Total Revenue Card --}}
            <vibe:grid.card id="kpi-revenue" title="{{ __('docs/page/dashboard/index.metrics.revenue.title') }}" description="{{ __('docs/page/dashboard/index.metrics.revenue.desc') }}" :colSpan="3" :minColSpan="2">
                <x-slot:actions>
                    <div class="size-8 rounded-lg bg-success/10 text-success flex items-center justify-center">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                </x-slot:actions>

                <div class="space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl sm:text-3xl font-extrabold tracking-tight text-foreground">
                            Rp 284.950.000
                        </span>
                        <vibe:badge variant="success" size="sm" class="font-semibold gap-1">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.revenue.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Sparkline Curve --}}
                    <div class="h-10 w-full overflow-hidden">
                        <svg class="w-full h-full text-success" viewBox="0 0 100 28" fill="none" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="revenue-grad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="currentColor" stop-opacity="0.25" />
                                    <stop offset="100%" stop-color="currentColor" stop-opacity="0.0" />
                                </linearGradient>
                            </defs>
                            <path d="M0,22 Q15,25 30,16 T60,12 T85,6 T100,2 L100,28 L0,28 Z" fill="url(#revenue-grad)" />
                            <path d="M0,22 Q15,25 30,16 T60,12 T85,6 T100,2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>

                    <p class="text-xs text-muted-foreground leading-relaxed">
                        {{ __('docs/page/dashboard/index.metrics.revenue.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- 2. Total Orders Card --}}
            <vibe:grid.card id="kpi-orders" title="{{ __('docs/page/dashboard/index.metrics.orders.title') }}" description="{{ __('docs/page/dashboard/index.metrics.orders.desc') }}" :colSpan="3" :minColSpan="2">
                <x-slot:actions>
                    <div class="size-8 rounded-lg bg-sky-500/10 text-sky-600 dark:text-sky-400 flex items-center justify-center">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                        </svg>
                    </div>
                </x-slot:actions>

                <div class="space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl sm:text-3xl font-extrabold tracking-tight text-foreground">
                            1.842
                        </span>
                        <vibe:badge variant="outline" size="sm" class="bg-sky-500/10 text-sky-600 dark:text-sky-400 border-sky-500/20 font-semibold gap-1">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.orders.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Sparkline Curve --}}
                    <div class="h-10 w-full overflow-hidden">
                        <svg class="w-full h-full text-sky-500" viewBox="0 0 100 28" fill="none" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="orders-grad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="currentColor" stop-opacity="0.25" />
                                    <stop offset="100%" stop-color="currentColor" stop-opacity="0.0" />
                                </linearGradient>
                            </defs>
                            <path d="M0,20 Q20,10 40,18 T75,8 T100,4 L100,28 L0,28 Z" fill="url(#orders-grad)" />
                            <path d="M0,20 Q20,10 40,18 T75,8 T100,4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>

                    <p class="text-xs text-muted-foreground leading-relaxed">
                        {{ __('docs/page/dashboard/index.metrics.orders.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- 3. New Customers Card --}}
            <vibe:grid.card id="kpi-customers" title="{{ __('docs/page/dashboard/index.metrics.customers.title') }}" description="{{ __('docs/page/dashboard/index.metrics.customers.desc') }}" :colSpan="3" :minColSpan="2">
                <x-slot:actions>
                    <div class="size-8 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                </x-slot:actions>

                <div class="space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl sm:text-3xl font-extrabold tracking-tight text-foreground">
                            584
                        </span>
                        <vibe:badge variant="outline" size="sm" class="bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border-indigo-500/20 font-semibold gap-1">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.customers.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Customer Avatars Preview --}}
                    <div class="flex items-center justify-between pt-1">
                        <vibe:avatar.group :limit="4" size="sm" :overlap="true">
                            <vibe:avatar initials="FA" color="blue" />
                            <vibe:avatar initials="SN" color="purple" />
                            <vibe:avatar initials="RD" color="green" />
                            <vibe:avatar initials="BW" color="orange" />
                            <vibe:avatar initials="MH" color="pink" />
                        </vibe:avatar.group>
                        <span class="text-[11px] font-medium text-muted-foreground">+580 pembeli baru</span>
                    </div>

                    <p class="text-xs text-muted-foreground leading-relaxed">
                        {{ __('docs/page/dashboard/index.metrics.customers.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- 4. Average Order Value Card --}}
            <vibe:grid.card id="kpi-aov" title="{{ __('docs/page/dashboard/index.metrics.avg_order.title') }}" description="{{ __('docs/page/dashboard/index.metrics.avg_order.desc') }}" :colSpan="3" :minColSpan="2">
                <x-slot:actions>
                    <div class="size-8 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                    </div>
                </x-slot:actions>

                <div class="space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl sm:text-3xl font-extrabold tracking-tight text-foreground">
                            Rp 154.690
                        </span>
                        <vibe:badge variant="outline" size="sm" class="bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20 font-semibold gap-1">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.avg_order.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Target Completion Progress Bar --}}
                    <div class="space-y-1 pt-1">
                        <div class="flex justify-between text-[11px] font-medium text-muted-foreground">
                            <span>Target: Rp 150.000</span>
                            <span class="text-amber-600 dark:text-amber-400 font-semibold">103.1%</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-muted overflow-hidden">
                            <div class="h-full bg-linear-to-r from-amber-500 to-amber-400 rounded-full" style="width: 100%"></div>
                        </div>
                    </div>

                    <p class="text-xs text-muted-foreground leading-relaxed">
                        {{ __('docs/page/dashboard/index.metrics.avg_order.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- ========================================================================= --}}
            {{-- ROW 2: SALES ANALYTICS CHART (colSpan=8) & TOP PRODUCTS (colSpan=4)       --}}
            {{-- ========================================================================= --}}

            {{-- 5. Sales & Revenue Analytics Chart Widget --}}
            <vibe:grid.card id="widget-sales-trend" title="{{ __('docs/page/dashboard/index.charts.sales_trend.title') }}" description="{{ __('docs/page/dashboard/index.charts.sales_trend.desc') }}" :colSpan="8" :minColSpan="4">
                <x-slot:actions>
                    <div class="flex items-center gap-3" x-data="{ mode: 'monthly' }">
                        <div class="hidden sm:flex items-center gap-2 text-xs">
                            <span class="inline-flex items-center gap-1.5 text-muted-foreground">
                                <span class="size-2 rounded-full bg-primary"></span>
                                {{ __('docs/page/dashboard/index.charts.sales_trend.revenue_legend') }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-muted-foreground">
                                <span class="size-2 rounded-full bg-success"></span>
                                {{ __('docs/page/dashboard/index.charts.sales_trend.profit_legend') }}
                            </span>
                        </div>

                        <div class="inline-flex p-0.5 rounded-lg bg-muted border border-border/50 text-[11px]">
                            <button type="button" @click="mode = 'weekly'" :class="mode === 'weekly' ? 'bg-background text-foreground shadow-2xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2 py-0.5 rounded-md transition-colors cursor-pointer">
                                {{ __('docs/page/dashboard/index.charts.sales_trend.tabs.weekly') }}
                            </button>
                            <button type="button" @click="mode = 'monthly'" :class="mode === 'monthly' ? 'bg-background text-foreground shadow-2xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2 py-0.5 rounded-md transition-colors cursor-pointer">
                                {{ __('docs/page/dashboard/index.charts.sales_trend.tabs.monthly') }}
                            </button>
                            <button type="button" @click="mode = 'yearly'" :class="mode === 'yearly' ? 'bg-background text-foreground shadow-2xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2 py-0.5 rounded-md transition-colors cursor-pointer">
                                {{ __('docs/page/dashboard/index.charts.sales_trend.tabs.yearly') }}
                            </button>
                        </div>
                    </div>
                </x-slot:actions>

                <div class="space-y-4">
                    {{-- Interactive Bar Visualizer --}}
                    @php
                        $monthlyData = [['m' => 'Jan', 'rev' => 140, 'profit' => 45, 'pct' => 50], ['m' => 'Feb', 'rev' => 175, 'profit' => 60, 'pct' => 62], ['m' => 'Mar', 'rev' => 210, 'profit' => 72, 'pct' => 75], ['m' => 'Apr', 'rev' => 195, 'profit' => 68, 'pct' => 70], ['m' => 'Mei', 'rev' => 245, 'profit' => 88, 'pct' => 85], ['m' => 'Jun', 'rev' => 230, 'profit' => 80, 'pct' => 80], ['m' => 'Jul', 'rev' => 260, 'profit' => 92, 'pct' => 92], ['m' => 'Agu', 'rev' => 285, 'profit' => 105, 'pct' => 100]];
                    @endphp

                    <div class="h-56 w-full flex items-end justify-between gap-2 pt-6 px-2">
                        @foreach ($monthlyData as $bar)
                            <div class="flex-1 flex flex-col items-center gap-2 h-full justify-end group/bar relative">
                                {{-- Hover Tooltip --}}
                                <div class="opacity-0 group-hover/bar:opacity-100 transition-opacity duration-150 absolute -top-8 left-1/2 -translate-x-1/2 px-2 py-1 rounded-md bg-foreground text-background text-[10px] font-mono whitespace-nowrap shadow-lg pointer-events-none z-10">
                                    <span>Rp {{ $bar['rev'] }} jt</span>
                                    <span class="text-success"> (Laba: Rp {{ $bar['profit'] }} jt)</span>
                                </div>

                                {{-- Bar Pair Container --}}
                                <div class="w-full max-w-10 flex items-end justify-center gap-1 h-full">
                                    {{-- Gross Revenue Bar --}}
                                    <div class="w-1/2 bg-primary/30 group-hover/bar:bg-primary transition-all duration-300 rounded-t-md relative" style="height: {{ $bar['pct'] }}%"></div>
                                    {{-- Net Profit Bar --}}
                                    <div class="w-1/2 bg-success/30 group-hover/bar:bg-success transition-all duration-300 rounded-t-md relative" style="height: {{ round($bar['pct'] * 0.45) }}%"></div>
                                </div>

                                <span class="text-xs text-muted-foreground font-mono font-medium select-none">{{ $bar['m'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottom Summary Metrics Strip --}}
                    <div class="grid grid-cols-3 gap-2 pt-3 border-t border-border/60 bg-muted/20 -mx-4 -mb-4 p-4 rounded-b-xl text-center">
                        <div>
                            <span class="text-[11px] text-muted-foreground font-medium block">
                                {{ __('docs/page/dashboard/index.charts.sales_trend.total_sales') }}
                            </span>
                            <span class="text-sm sm:text-base font-bold text-foreground">Rp 1.42 Miliar</span>
                        </div>
                        <div class="border-x border-border/60">
                            <span class="text-[11px] text-muted-foreground font-medium block">
                                {{ __('docs/page/dashboard/index.charts.sales_trend.net_profit') }}
                            </span>
                            <span class="text-sm sm:text-base font-bold text-success">Rp 482 Jt (33.9%)</span>
                        </div>
                        <div>
                            <span class="text-[11px] text-muted-foreground font-medium block">
                                {{ __('docs/page/dashboard/index.charts.sales_trend.daily_avg') }}
                            </span>
                            <span class="text-sm sm:text-base font-bold text-foreground">Rp 9.5 Juta</span>
                        </div>
                    </div>
                </div>
            </vibe:grid.card>

            {{-- 6. Top Selling Products Widget --}}
            <vibe:grid.card id="widget-top-products" title="{{ __('docs/page/dashboard/index.products.top_title') }}" description="{{ __('docs/page/dashboard/index.products.top_desc') }}" :colSpan="4" :minColSpan="3">
                <x-slot:actions>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">
                        {{ __('docs/page/dashboard/index.products.badge') }}
                    </vibe:badge>
                </x-slot:actions>

                <div class="divide-y divide-border/60 -mx-4 -my-2">
                    @php
                        $topProducts = [
                            [
                                'name' => 'Mechanical Keyboard Vibe Pro',
                                'category' => 'Aksesori PC',
                                'price' => 'Rp 1.450.000',
                                'sold' => 342,
                                'stock' => 18,
                                'color' => 'bg-primary/10 text-primary',
                            ],
                            [
                                'name' => 'Ultra-wide 4K Monitor 34"',
                                'category' => 'Hardware & Layar',
                                'price' => 'Rp 6.890.000',
                                'sold' => 128,
                                'stock' => 6,
                                'color' => 'bg-info/10 text-info',
                            ],
                            [
                                'name' => 'Ergonomic Wireless Mouse X',
                                'category' => 'Periferal',
                                'price' => 'Rp 450.000',
                                'sold' => 512,
                                'stock' => 84,
                                'color' => 'bg-success/10 text-success',
                            ],
                            [
                                'name' => 'Desk Mat Leather Minimalist',
                                'category' => 'Aksesori Meja',
                                'price' => 'Rp 180.000',
                                'sold' => 410,
                                'stock' => 35,
                                'color' => 'bg-warning/10 text-warning',
                            ],
                            [
                                'name' => 'USB-C Hub Multiport 8-in-1',
                                'category' => 'Kabel & Adaptor',
                                'price' => 'Rp 320.000',
                                'sold' => 295,
                                'stock' => 12,
                                'color' => 'bg-destructive/10 text-destructive',
                            ],
                        ];
                    @endphp

                    @foreach ($topProducts as $item)
                        <div class="flex items-center justify-between p-3 px-4 hover:bg-muted/40 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="size-9 rounded-lg {{ $item['color'] }} flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ substr($item['name'], 0, 2) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold text-foreground truncate">{{ $item['name'] }}</p>
                                    <p class="text-[11px] text-muted-foreground">{{ $item['category'] }} • {{ $item['price'] }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-2">
                                <span class="text-xs font-bold text-foreground block">{{ $item['sold'] }} terjual</span>
                                <span class="text-[10px] {{ $item['stock'] <= 10 ? 'text-rose-500 font-semibold' : 'text-muted-foreground' }}">
                                    Stok: {{ $item['stock'] }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <x-slot:footer>
                    <div class="w-full flex items-center justify-between pt-1">
                        <span class="text-xs text-muted-foreground">Total 48 SKU aktif</span>
                        <a href="#" class="text-xs font-semibold text-primary hover:underline inline-flex items-center gap-1">
                            {{ __('docs/page/dashboard/index.products.view_all_products') }}
                            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                        </a>
                    </div>
                </x-slot:footer>
            </vibe:grid.card>

            {{-- ========================================================================= --}}
            {{-- ROW 3: RECENT INBOUND ORDERS (colSpan=8) & TRAFFIC ACQUISITION (colSpan=4) --}}
            {{-- ========================================================================= --}}

            {{-- 7. Recent Inbound Orders Table Widget --}}
            <vibe:grid.card id="widget-recent-orders" title="{{ __('docs/page/dashboard/index.orders.title') }}" description="{{ __('docs/page/dashboard/index.orders.desc') }}" :colSpan="8" :minColSpan="4">
                <x-slot:actions>
                    <vibe:button variant="ghost" size="xs" class="gap-1 cursor-pointer">
                        <span>{{ __('docs/page/dashboard/index.actions.view_all') }}</span>
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </vibe:button>
                </x-slot:actions>

                <div class="w-full overflow-x-auto">
                    @php
                        $orders = [
                            [
                                'id' => '#ORD-9842',
                                'customer' => 'Dimas Prasetyo',
                                'email' => 'dimas@example.com',
                                'avatar' => 'DP',
                                'color' => 'blue',
                                'items' => '1x Mechanical Keyboard Pro',
                                'total' => 'Rp 1.450.000',
                                'status' => 'completed',
                                'date' => '10 menit lalu',
                            ],
                            [
                                'id' => '#ORD-9841',
                                'customer' => 'Sarah Amalia',
                                'email' => 'sarah@example.com',
                                'avatar' => 'SA',
                                'color' => 'purple',
                                'items' => '1x Ultra-wide 4K Monitor 34"',
                                'total' => 'Rp 6.890.000',
                                'status' => 'processing',
                                'date' => '32 menit lalu',
                            ],
                            [
                                'id' => '#ORD-9840',
                                'customer' => 'Budi Santoso',
                                'email' => 'budi@example.com',
                                'avatar' => 'BS',
                                'color' => 'green',
                                'items' => '2x Ergonomic Mouse X',
                                'total' => 'Rp 900.000',
                                'status' => 'completed',
                                'date' => '1 jam lalu',
                            ],
                            [
                                'id' => '#ORD-9839',
                                'customer' => 'Reza Firmansyah',
                                'email' => 'reza@example.com',
                                'avatar' => 'RF',
                                'color' => 'yellow',
                                'items' => '1x Desk Mat Minimalist',
                                'total' => 'Rp 180.000',
                                'status' => 'pending',
                                'date' => '2 jam lalu',
                            ],
                            [
                                'id' => '#ORD-9838',
                                'customer' => 'Jessica Tan',
                                'email' => 'jessica@example.com',
                                'avatar' => 'JT',
                                'color' => 'pink',
                                'items' => '3x USB-C Hub 8-in-1',
                                'total' => 'Rp 960.000',
                                'status' => 'cancelled',
                                'date' => '4 jam lalu',
                            ],
                        ];
                    @endphp

                <vibe:table variant="flush" dense>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/page/dashboard/index.orders.columns.order_id') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/page/dashboard/index.orders.columns.customer') }}</vibe:table.column>
                        <vibe:table.column class="hidden sm:table-cell">{{ __('docs/page/dashboard/index.orders.columns.items') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/page/dashboard/index.orders.columns.total') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/page/dashboard/index.orders.columns.status') }}</vibe:table.column>
                        <vibe:table.column class="text-right">{{ __('docs/page/dashboard/index.orders.columns.action') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @foreach ($orders as $o)
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-semibold text-primary whitespace-nowrap">
                                    {{ $o['id'] }}
                                    <span class="block text-[10px] text-muted-foreground font-sans font-normal">{{ $o['date'] }}</span>
                                </vibe:table.cell>
                                <vibe:table.cell>
                                    <div class="flex items-center gap-2.5">
                                        <vibe:avatar :initials="$o['avatar']" :color="$o['color']" size="xs" />
                                        <div class="min-w-0">
                                            <span class="font-medium text-foreground block truncate">{{ $o['customer'] }}</span>
                                            <span class="text-[10px] text-muted-foreground block truncate">{{ $o['email'] }}</span>
                                        </div>
                                    </div>
                                </vibe:table.cell>
                                <vibe:table.cell class="hidden sm:table-cell text-muted-foreground truncate max-w-45">
                                    {{ $o['items'] }}
                                </vibe:table.cell>
                                <vibe:table.cell class="font-semibold text-foreground whitespace-nowrap">
                                    {{ $o['total'] }}
                                </vibe:table.cell>
                                <vibe:table.cell class="whitespace-nowrap">
                                    @if ($o['status'] === 'completed')
                                        <vibe:badge variant="success" size="sm">
                                            {{ __('docs/page/dashboard/index.orders.status.completed') }}
                                        </vibe:badge>
                                    @elseif ($o['status'] === 'processing')
                                        <vibe:badge variant="info" size="sm">
                                            {{ __('docs/page/dashboard/index.orders.status.processing') }}
                                        </vibe:badge>
                                    @elseif ($o['status'] === 'pending')
                                        <vibe:badge variant="warning" size="sm">
                                            {{ __('docs/page/dashboard/index.orders.status.pending') }}
                                        </vibe:badge>
                                    @else
                                        <vibe:badge variant="danger" size="sm">
                                            {{ __('docs/page/dashboard/index.orders.status.cancelled') }}
                                        </vibe:badge>
                                    @endif
                                </vibe:table.cell>
                                <vibe:table.cell class="text-right whitespace-nowrap">
                                    <vibe:dropdown keyboard>
                                        <x-slot:trigger>
                                            <button type="button" class="size-7 rounded-md hover:bg-accent flex items-center justify-center text-muted-foreground hover:text-foreground transition-colors cursor-pointer">
                                                <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="1" />
                                                    <circle cx="19" cy="12" r="1" />
                                                    <circle cx="5" cy="12" r="1" />
                                                </svg>
                                            </button>
                                        </x-slot:trigger>

                                        <vibe:dropdown.content align="right" width="48">
                                            <vibe:dropdown.item href="#">
                                                {{ __('docs/page/dashboard/index.actions.details') }}
                                            </vibe:dropdown.item>
                                            <vibe:dropdown.item href="#">
                                                {{ __('docs/page/dashboard/index.actions.invoice') }}
                                            </vibe:dropdown.item>
                                            <vibe:dropdown.divider />
                                            <vibe:dropdown.item href="#">
                                                {{ __('docs/page/dashboard/index.actions.contact') }}
                                            </vibe:dropdown.item>
                                        </vibe:dropdown.content>
                                    </vibe:dropdown>
                                </vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
                </div>
            </vibe:grid.card>

            {{-- 8. Customer Acquisition & Conversion Channels Widget --}}
            <vibe:grid.card id="widget-traffic-channels" title="{{ __('docs/page/dashboard/index.charts.channels.title') }}" description="{{ __('docs/page/dashboard/index.charts.channels.desc') }}" :colSpan="4" :minColSpan="3">
                <div class="space-y-4">
                    {{-- Conversion Rate Highlight --}}
                    <div class="p-3.5 rounded-xl bg-primary/5 border border-primary/15 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-muted-foreground font-medium block">
                                {{ __('docs/page/dashboard/index.charts.channels.conversion_label') }}
                            </span>
                            <span class="text-xl font-bold text-primary">3.84%</span>
                        </div>
                        <vibe:badge variant="outline" size="sm" class="bg-primary/10 text-primary border-primary/20 font-semibold">
                            Tinggi
                        </vibe:badge>
                    </div>

                    {{-- Channel Progress Breakdown --}}
                    <div class="space-y-3 pt-1">
                        {{-- 1. Organic --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-medium text-foreground flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-success"></span>
                                    {{ __('docs/page/dashboard/index.charts.channels.organic') }}
                                </span>
                                <span class="font-mono text-muted-foreground font-semibold">42% (Rp 119.6 jt)</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-muted overflow-hidden">
                                <div class="h-full bg-success rounded-full" style="width: 42%"></div>
                            </div>
                        </div>

                        {{-- 2. Social Media --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-medium text-foreground flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-info"></span>
                                    {{ __('docs/page/dashboard/index.charts.channels.social') }}
                                </span>
                                <span class="font-mono text-muted-foreground font-semibold">28% (Rp 79.8 jt)</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-muted overflow-hidden">
                                <div class="h-full bg-info rounded-full" style="width: 28%"></div>
                            </div>
                        </div>

                        {{-- 3. Direct --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-medium text-foreground flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-primary"></span>
                                    {{ __('docs/page/dashboard/index.charts.channels.direct') }}
                                </span>
                                <span class="font-mono text-muted-foreground font-semibold">18% (Rp 51.3 jt)</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-muted overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: 18%"></div>
                            </div>
                        </div>

                        {{-- 4. Referral --}}
                        <div class="space-y-1">
                            <div class="flex justify-between text-xs">
                                <span class="font-medium text-foreground flex items-center gap-1.5">
                                    <span class="size-2 rounded-full bg-warning"></span>
                                    {{ __('docs/page/dashboard/index.charts.channels.referral') }}
                                </span>
                                <span class="font-mono text-muted-foreground font-semibold">12% (Rp 34.2 jt)</span>
                            </div>
                            <div class="w-full h-1.5 rounded-full bg-muted overflow-hidden">
                                <div class="h-full bg-warning rounded-full" style="width: 12%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </vibe:grid.card>

            {{-- ========================================================================= --}}
            {{-- ROW 4: INVENTORY ALERTS (colSpan=6) & STORE ACTIVITY LOG (colSpan=6)       --}}
            {{-- ========================================================================= --}}

            {{-- 9. Low Stock Inventory Alerts Widget --}}
            <vibe:grid.card id="widget-inventory-alerts" title="{{ __('docs/page/dashboard/index.alerts.inventory_title') }}" description="{{ __('docs/page/dashboard/index.alerts.inventory_desc') }}" :colSpan="6" :minColSpan="3">
                <x-slot:actions>
                    <vibe:badge variant="outline" size="sm" class="bg-rose-500/10 text-rose-600 dark:text-rose-400 border-rose-500/20 font-medium">
                        3 Perlu Restock
                    </vibe:badge>
                </x-slot:actions>

                <div class="space-y-3">
                    {{-- Alert Item 1 --}}
                    <div class="flex items-center justify-between p-3 rounded-xl border border-rose-500/20 bg-rose-500/5">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="size-8 rounded-lg bg-rose-500/15 text-rose-600 dark:text-rose-400 flex items-center justify-center font-bold text-xs shrink-0">
                                4K
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-foreground truncate">Ultra-wide 4K Monitor 34"</p>
                                <p class="text-[11px] text-rose-600 dark:text-rose-400 font-medium">
                                    {{ __('docs/page/dashboard/index.alerts.critical') }} • Sisa 4 unit (Batas min: 10)
                                </p>
                            </div>
                        </div>
                        <vibe:button variant="outline" size="xs" class="shrink-0 text-xs border-rose-500/30 text-rose-600 hover:bg-rose-500/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Pesanan pengadaan stok monitor terkirim ke supplier.', { type: 'info' }) : null">
                            {{ __('docs/page/dashboard/index.actions.restock') }}
                        </vibe:button>
                    </div>

                    {{-- Alert Item 2 --}}
                    <div class="flex items-center justify-between p-3 rounded-xl border border-amber-500/20 bg-amber-500/5">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="size-8 rounded-lg bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-xs shrink-0">
                                KB
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-foreground truncate">Mechanical Keyboard Vibe Pro</p>
                                <p class="text-[11px] text-amber-600 dark:text-amber-400 font-medium">
                                    {{ __('docs/page/dashboard/index.alerts.warning') }} • Sisa 9 unit (Batas min: 15)
                                </p>
                            </div>
                        </div>
                        <vibe:button variant="outline" size="xs" class="shrink-0 text-xs border-amber-500/30 text-amber-600 hover:bg-amber-500/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Pesanan pengadaan stok keyboard terkirim.', { type: 'info' }) : null">
                            {{ __('docs/page/dashboard/index.actions.restock') }}
                        </vibe:button>
                    </div>

                    {{-- Alert Item 3 --}}
                    <div class="flex items-center justify-between p-3 rounded-xl border border-amber-500/20 bg-amber-500/5">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="size-8 rounded-lg bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-xs shrink-0">
                                HB
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-foreground truncate">USB-C Hub Multiport 8-in-1</p>
                                <p class="text-[11px] text-amber-600 dark:text-amber-400 font-medium">
                                    {{ __('docs/page/dashboard/index.alerts.warning') }} • Sisa 12 unit (Batas min: 20)
                                </p>
                            </div>
                        </div>
                        <vibe:button variant="outline" size="xs" class="shrink-0 text-xs border-amber-500/30 text-amber-600 hover:bg-amber-500/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Pesanan pengadaan stok hub terkirim.', { type: 'info' }) : null">
                            {{ __('docs/page/dashboard/index.actions.restock') }}
                        </vibe:button>
                    </div>
                </div>
            </vibe:grid.card>

            {{-- 10. Store Activity Feed Widget --}}
            <vibe:grid.card id="widget-store-activity" title="{{ __('docs/page/dashboard/index.activity.title') }}" description="{{ __('docs/page/dashboard/index.activity.desc') }}" :colSpan="6" :minColSpan="3">
                <div class="space-y-3.5">
                    {{-- Activity 1 --}}
                    <div class="flex items-start gap-3">
                        <div class="size-2 rounded-full bg-success mt-1.5 shrink-0 ring-4 ring-success/15"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Pesanan #ORD-9842 dikirim via JNE Express
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5">
                                Resi: JNE88291048291 • Tujuan: Jakarta Selatan • 5 menit lalu
                            </p>
                        </div>
                    </div>

                    {{-- Activity 2 --}}
                    <div class="flex items-start gap-3">
                        <div class="size-2 rounded-full bg-info mt-1.5 shrink-0 ring-4 ring-info/15"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Pembayaran Rp 6.890.000 berhasil diverifikasi
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5">
                                Metode: BCA Virtual Account • Pelanggan: Sarah Amalia • 32 menit lalu
                            </p>
                        </div>
                    </div>

                    {{-- Activity 3 --}}
                    <div class="flex items-start gap-3">
                        <div class="size-2 rounded-full bg-warning mt-1.5 shrink-0 ring-4 ring-warning/15"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Ulasan Bintang 5 diterima dari Budi Santoso
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5">
                                "Mouse sangat nyaman digunakan untuk coding seharian!" • 1 jam lalu
                            </p>
                        </div>
                    </div>

                    {{-- Activity 4 --}}
                    <div class="flex items-start gap-3">
                        <div class="size-2 rounded-full bg-primary mt-1.5 shrink-0 ring-4 ring-primary/15"></div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Sinkronisasi katalog marketplace (Tokopedia & Shopee)
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5">
                                48 produk berhasil diperbarui secara otomatis • 2 jam lalu
                            </p>
                        </div>
                    </div>
                </div>
            </vibe:grid.card>
        </vibe:grid>
    </div>
</x-docs.layouts.sidebar>
