<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/page/dashboard/index.title')" :description="__('docs/page/dashboard/index.subtitle')" :breadcrumbs="[
        ['name' => __('docs/page/dashboard/index.breadcrumb.home'), 'url' => '/'],
        ['name' => __('docs/page/dashboard/index.breadcrumb.pages'), 'url' => '#'],
        ['name' => __('docs/page/dashboard/index.breadcrumb.dashboard'), 'url' => route('docs.dashboard.show', 'index')],
    ]" />

    @php
        // 1. Konfigurasi Sparkline Chart untuk KPI Revenue
        $revenueSparklineConfig = [
            'type' => 'line',
            'data' => [
                'labels' => ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7'],
                'datasets' => [[
                    'data' => [180, 210, 195, 240, 230, 265, 285],
                    'borderColor' => 'success',
                    'backgroundColor' => 'success/15',
                    'fill' => true,
                    'tension' => 0.4,
                    'borderWidth' => 2,
                    'pointRadius' => 0,
                ]],
            ],
        ];

        // 2. Konfigurasi Sparkline Chart untuk KPI Orders
        $ordersSparklineConfig = [
            'type' => 'line',
            'data' => [
                'labels' => ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7'],
                'datasets' => [[
                    'data' => [210, 250, 225, 290, 275, 310, 345],
                    'borderColor' => 'info',
                    'backgroundColor' => 'info/15',
                    'fill' => true,
                    'tension' => 0.4,
                    'borderWidth' => 2,
                    'pointRadius' => 0,
                ]],
            ],
        ];

        // 3. Konfigurasi Bar Chart Utama (Sales & Revenue Trend)
        $salesTrendChartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
                'datasets' => [
                    [
                        'label' => __('docs/page/dashboard/index.charts.sales_trend.revenue_legend'),
                        'data' => [140, 175, 210, 195, 245, 230, 260, 285],
                        'backgroundColor' => 'primary',
                        'borderColor' => 'primary',
                        'borderWidth' => 1,
                        'borderRadius' => 6,
                    ],
                    [
                        'label' => __('docs/page/dashboard/index.charts.sales_trend.profit_legend'),
                        'data' => [45, 60, 72, 68, 88, 80, 92, 105],
                        'backgroundColor' => 'success',
                        'borderColor' => 'success',
                        'borderWidth' => 1,
                        'borderRadius' => 6,
                    ],
                ],
            ],
            'options' => [
                'plugins' => [
                    'legend' => ['display' => false],
                ],
            ],
        ];

        // 4. Data Top Selling Products
        $topProducts = [
            [
                'name' => 'Mechanical Keyboard Vibe Pro',
                'category' => 'Aksesori PC',
                'price' => 'Rp 1.450.000',
                'sold' => 342,
                'stock' => 18,
                'badge' => 'primary',
            ],
            [
                'name' => 'Ultra-wide 4K Monitor 34"',
                'category' => 'Hardware & Layar',
                'price' => 'Rp 6.890.000',
                'sold' => 128,
                'stock' => 6,
                'badge' => 'info',
            ],
            [
                'name' => 'Ergonomic Wireless Mouse X',
                'category' => 'Periferal',
                'price' => 'Rp 450.000',
                'sold' => 512,
                'stock' => 84,
                'badge' => 'success',
            ],
            [
                'name' => 'Desk Mat Leather Minimalist',
                'category' => 'Aksesori Meja',
                'price' => 'Rp 180.000',
                'sold' => 410,
                'stock' => 35,
                'badge' => 'warning',
            ],
            [
                'name' => 'USB-C Hub Multiport 8-in-1',
                'category' => 'Kabel & Adaptor',
                'price' => 'Rp 320.000',
                'sold' => 295,
                'stock' => 12,
                'badge' => 'destructive',
            ],
        ];

        // 5. Data Recent Inbound Orders
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

    <div class="mx-auto w-full space-y-8">
        {{-- ========================================================================= --}}
        {{-- TOP BREADCRUMB & QUICK ACTIONS                                            --}}
        {{-- ========================================================================= --}}
        <vibe:breadcrumb :title="__('docs/page/dashboard/index.title')">
            <vibe:breadcrumb.item href="{{ route('docs.index') }}">{{ __('docs/page/dashboard/index.breadcrumb.home') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item>{{ __('docs/page/dashboard/index.breadcrumb.pages') }}</vibe:breadcrumb.item>
            <vibe:breadcrumb.item active>{{ __('docs/page/dashboard/index.breadcrumb.dashboard') }}</vibe:breadcrumb.item>

            <x-slot:button>
                <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                    {{-- Timeframe Selector menggunakan <vibe:tabs> --}}
                    <vibe:tabs selected="last_30_days" variant="pill" size="xs" class="w-auto">
                        <vibe:tabs.list class="p-1">
                            <vibe:tabs.tab name="today">{{ __('docs/page/dashboard/index.actions.today') }}</vibe:tabs.tab>
                            <vibe:tabs.tab name="last_7_days">{{ __('docs/page/dashboard/index.actions.last_7_days') }}</vibe:tabs.tab>
                            <vibe:tabs.tab name="last_30_days">{{ __('docs/page/dashboard/index.actions.last_30_days') }}</vibe:tabs.tab>
                            <vibe:tabs.tab name="this_year">{{ __('docs/page/dashboard/index.actions.this_year') }}</vibe:tabs.tab>
                        </vibe:tabs.list>
                    </vibe:tabs>

                    {{-- Export Button --}}
                    <vibe:button type="button" variant="outline" size="sm" class="gap-1.5 shadow-2xs cursor-pointer" @click="window.vibeToast ? vibeToast('Laporan penjualan CSV siap diunduh.', { type: 'success', title: 'Export Berhasil' }) : null">
                        <svg class="size-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                            <line x1="12" y1="15" x2="12" y2="3" />
                        </svg>
                        <span>{{ __('docs/page/dashboard/index.actions.export') }}</span>
                    </vibe:button>

                    {{-- Add Product Button (Membuka <vibe:modal>) --}}
                    <vibe:button type="button" variant="primary" size="sm" class="gap-1.5 shadow-xs cursor-pointer" @click="$dispatch('open-modal', 'add-product-modal')">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        <span>{{ __('docs/page/dashboard/index.actions.add_product') }}</span>
                    </vibe:button>
                </div>
            </x-slot:button>
        </vibe:breadcrumb>

        {{-- ========================================================================= --}}
        {{-- MAIN INTERACTIVE BENTO GRID                                               --}}
        {{-- ========================================================================= --}}
        <vibe:grid id="ecommerce-dashboard-grid" :cols="12" gap="4" :persist="true" :resizable="true" :reorderable="true" storageKey="vibe-ecommerce-dashboard-v2">
            {{-- Toolbar dengan tombol Reset Layout resmi --}}
            <vibe:grid.toolbar
                :title="__('docs/page/dashboard/index.toolbar.title')"
                :description="__('docs/page/dashboard/index.toolbar.desc')"
            />

            {{-- ===================================================================== --}}
            {{-- ROW 1: 4 KEY PERFORMANCE INDICATOR CARDS (4 x colSpan=3 = 12 cols)    --}}
            {{-- ===================================================================== --}}

            {{-- 1. Total Revenue Card --}}
            <vibe:grid.card id="kpi-revenue" :title="__('docs/page/dashboard/index.metrics.revenue.title')" :description="__('docs/page/dashboard/index.metrics.revenue.desc')" :colSpan="3" :minColSpan="3">
                <x-slot:actions>
                    <vibe:badge variant="success" size="sm" class="size-8 p-0 flex items-center justify-center rounded-lg">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </vibe:badge>
                </x-slot:actions>

                <div class="flex flex-col justify-between h-full space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl font-extrabold tracking-tight text-foreground truncate">
                            Rp 284.950.000
                        </span>
                        <vibe:badge variant="success" size="sm" class="font-semibold gap-1 shrink-0">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.revenue.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Komponen <vibe:chart> Sparkline --}}
                    <vibe:chart id="sparkline-revenue" :sparkline="true" :height="44" :config="$revenueSparklineConfig" />

                    <p class="text-xs text-muted-foreground leading-relaxed truncate">
                        {{ __('docs/page/dashboard/index.metrics.revenue.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- 2. Total Orders Card --}}
            <vibe:grid.card id="kpi-orders" :title="__('docs/page/dashboard/index.metrics.orders.title')" :description="__('docs/page/dashboard/index.metrics.orders.desc')" :colSpan="3" :minColSpan="3">
                <x-slot:actions>
                    <vibe:badge variant="info" size="sm" class="size-8 p-0 flex items-center justify-center rounded-lg">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                        </svg>
                    </vibe:badge>
                </x-slot:actions>

                <div class="flex flex-col justify-between h-full space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl font-extrabold tracking-tight text-foreground">
                            1.842
                        </span>
                        <vibe:badge variant="info" size="sm" class="font-semibold gap-1 shrink-0">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.orders.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Komponen <vibe:chart> Sparkline --}}
                    <vibe:chart id="sparkline-orders" :sparkline="true" :height="44" :config="$ordersSparklineConfig" />

                    <p class="text-xs text-muted-foreground leading-relaxed truncate">
                        {{ __('docs/page/dashboard/index.metrics.orders.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- 3. New Customers Card --}}
            <vibe:grid.card id="kpi-customers" :title="__('docs/page/dashboard/index.metrics.customers.title')" :description="__('docs/page/dashboard/index.metrics.customers.desc')" :colSpan="3" :minColSpan="3">
                <x-slot:actions>
                    <vibe:badge variant="secondary" size="sm" class="size-8 p-0 flex items-center justify-center rounded-lg">
                        <svg class="size-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </vibe:badge>
                </x-slot:actions>

                <div class="flex flex-col justify-between h-full space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl font-extrabold tracking-tight text-foreground">
                            584
                        </span>
                        <vibe:badge variant="secondary" size="sm" class="font-semibold gap-1 shrink-0">
                            <svg class="size-3 text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.customers.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Komponen <vibe:avatar.group> --}}
                    <div class="flex items-center justify-between py-1.5">
                        <vibe:avatar.group :limit="4" size="sm" :overlap="true">
                            <vibe:avatar initials="FA" color="blue" />
                            <vibe:avatar initials="SN" color="purple" />
                            <vibe:avatar initials="RD" color="green" />
                            <vibe:avatar initials="BW" color="orange" />
                            <vibe:avatar initials="MH" color="pink" />
                        </vibe:avatar.group>
                        <vibe:badge variant="outline" size="sm" class="text-[10px]">+580 baru</vibe:badge>
                    </div>

                    <p class="text-xs text-muted-foreground leading-relaxed truncate">
                        {{ __('docs/page/dashboard/index.metrics.customers.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- 4. Average Order Value Card --}}
            <vibe:grid.card id="kpi-aov" :title="__('docs/page/dashboard/index.metrics.avg_order.title')" :description="__('docs/page/dashboard/index.metrics.avg_order.desc')" :colSpan="3" :minColSpan="3">
                <x-slot:actions>
                    <vibe:badge variant="warning" size="sm" class="size-8 p-0 flex items-center justify-center rounded-lg">
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                        </svg>
                    </vibe:badge>
                </x-slot:actions>

                <div class="flex flex-col justify-between h-full space-y-3">
                    <div class="flex items-baseline justify-between gap-2">
                        <span class="text-2xl font-extrabold tracking-tight text-foreground truncate">
                            Rp 154.690
                        </span>
                        <vibe:badge variant="warning" size="sm" class="font-semibold gap-1 shrink-0">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15" />
                            </svg>
                            {{ __('docs/page/dashboard/index.metrics.avg_order.badge') }}
                        </vibe:badge>
                    </div>

                    {{-- Komponen <vibe:range> Readonly sebagai Indikator Target --}}
                    <div class="pt-1">
                        <vibe:range
                            size="xs"
                            variant="warning"
                            :min="0"
                            :max="150"
                            :value="150"
                            minLabel="Target: Rp 150rb"
                            maxLabel="103.1%"
                            :readonly="true"
                        />
                    </div>

                    <p class="text-xs text-muted-foreground leading-relaxed truncate">
                        {{ __('docs/page/dashboard/index.metrics.avg_order.comparison') }}
                    </p>
                </div>
            </vibe:grid.card>

            {{-- ===================================================================== --}}
            {{-- ROW 2: SALES TREND CHART (colSpan=8) & TOP PRODUCTS (colSpan=4)       --}}
            {{-- ===================================================================== --}}

            {{-- 5. Sales & Revenue Analytics Chart Widget --}}
            <vibe:grid.card id="widget-sales-trend" :title="__('docs/page/dashboard/index.charts.sales_trend.title')" :description="__('docs/page/dashboard/index.charts.sales_trend.desc')" :colSpan="8" :minColSpan="6">
                <x-slot:actions>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:flex items-center gap-2 text-xs">
                            <vibe:badge variant="outline" size="sm" class="gap-1.5 border-transparent bg-transparent">
                                <span class="size-2 rounded-full bg-primary"></span>
                                {{ __('docs/page/dashboard/index.charts.sales_trend.revenue_legend') }}
                            </vibe:badge>
                            <vibe:badge variant="outline" size="sm" class="gap-1.5 border-transparent bg-transparent">
                                <span class="size-2 rounded-full bg-success"></span>
                                {{ __('docs/page/dashboard/index.charts.sales_trend.profit_legend') }}
                            </vibe:badge>
                        </div>

                        <vibe:tabs selected="monthly" variant="pill" size="xs" class="w-auto">
                            <vibe:tabs.list class="p-0.5">
                                <vibe:tabs.tab name="weekly">{{ __('docs/page/dashboard/index.charts.sales_trend.tabs.weekly') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="monthly">{{ __('docs/page/dashboard/index.charts.sales_trend.tabs.monthly') }}</vibe:tabs.tab>
                                <vibe:tabs.tab name="yearly">{{ __('docs/page/dashboard/index.charts.sales_trend.tabs.yearly') }}</vibe:tabs.tab>
                            </vibe:tabs.list>
                        </vibe:tabs>
                    </div>
                </x-slot:actions>

                <div class="space-y-4">
                    {{-- Komponen <vibe:chart> Utama --}}
                    <vibe:chart id="main-sales-trend-chart" :height="245" :config="$salesTrendChartConfig" />
                </div>

                <x-slot:footer>
                    <div class="grid grid-cols-3 gap-2 text-center">
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
                </x-slot:footer>
            </vibe:grid.card>

            {{-- 6. Top Selling Products Widget --}}
            <vibe:grid.card id="widget-top-products" :title="__('docs/page/dashboard/index.products.top_title')" :description="__('docs/page/dashboard/index.products.top_desc')" :colSpan="4" :minColSpan="4">
                <x-slot:actions>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">
                        {{ __('docs/page/dashboard/index.products.badge') }}
                    </vibe:badge>
                </x-slot:actions>

                <div class="divide-y divide-border/60 -mx-4 -my-2">
                    @foreach ($topProducts as $item)
                        <div class="flex items-center justify-between p-3 px-4 hover:bg-muted/40 transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                <vibe:badge :variant="$item['badge']" size="sm" class="size-9 rounded-lg p-0 flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ substr($item['name'], 0, 2) }}
                                </vibe:badge>
                                <div class="min-w-0">
                                    <p class="text-xs font-semibold text-foreground truncate">{{ $item['name'] }}</p>
                                    <p class="text-[11px] text-muted-foreground truncate">{{ $item['category'] }} • {{ $item['price'] }}</p>
                                </div>
                            </div>
                            <div class="text-right shrink-0 pl-2">
                                <span class="text-xs font-bold text-foreground block">{{ $item['sold'] }} terjual</span>
                                <vibe:badge :variant="$item['stock'] <= 10 ? 'destructive' : 'outline'" size="sm" class="text-[10px] px-1.5 py-0">
                                    Stok: {{ $item['stock'] }}
                                </vibe:badge>
                            </div>
                        </div>
                    @endforeach
                </div>

                <x-slot:footer>
                    <div class="w-full flex items-center justify-between">
                        <span class="text-xs text-muted-foreground">Total 48 SKU aktif</span>
                        <vibe:button variant="ghost" size="xs" href="#" class="text-primary hover:text-primary gap-1">
                            <span>{{ __('docs/page/dashboard/index.products.view_all_products') }}</span>
                            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                        </vibe:button>
                    </div>
                </x-slot:footer>
            </vibe:grid.card>

            {{-- ===================================================================== --}}
            {{-- ROW 3: RECENT INBOUND ORDERS (colSpan=8) & ACQUISITION (colSpan=4)    --}}
            {{-- ===================================================================== --}}

            {{-- 7. Recent Inbound Orders Table Widget --}}
            <vibe:grid.card id="widget-recent-orders" :title="__('docs/page/dashboard/index.orders.title')" :description="__('docs/page/dashboard/index.orders.desc')" :colSpan="8" :minColSpan="6">
                <x-slot:actions>
                    <vibe:button variant="ghost" size="xs" class="gap-1 cursor-pointer">
                        <span>{{ __('docs/page/dashboard/index.actions.view_all') }}</span>
                        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </vibe:button>
                </x-slot:actions>

                <div class="w-full overflow-x-auto -mx-1">
                    <vibe:table variant="flush" dense hoverable>
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
                                                <vibe:button type="button" variant="ghost" size="icon-xs" class="text-muted-foreground hover:text-foreground">
                                                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="1" />
                                                        <circle cx="19" cy="12" r="1" />
                                                        <circle cx="5" cy="12" r="1" />
                                                    </svg>
                                                </vibe:button>
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
            <vibe:grid.card id="widget-traffic-channels" :title="__('docs/page/dashboard/index.charts.channels.title')" :description="__('docs/page/dashboard/index.charts.channels.desc')" :colSpan="4" :minColSpan="4">
                <div class="space-y-4">
                    {{-- Conversion Rate Highlight menggunakan <vibe:card variant="flat"> --}}
                    <vibe:card variant="flat" class="p-3.5 border border-primary/15 bg-primary/5 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-muted-foreground font-medium block">
                                {{ __('docs/page/dashboard/index.charts.channels.conversion_label') }}
                            </span>
                            <span class="text-xl font-bold text-primary">3.84%</span>
                        </div>
                        <vibe:badge variant="outline" size="sm" class="bg-primary/10 text-primary border-primary/20 font-semibold">
                            Optimal
                        </vibe:badge>
                    </vibe:card>

                    {{-- Channel Breakdown menggunakan <vibe:range :readonly="true"> --}}
                    <div class="space-y-3 pt-1">
                        <vibe:range
                            :label="__('docs/page/dashboard/index.charts.channels.organic')"
                            size="xs"
                            variant="success"
                            :min="0"
                            :max="100"
                            :value="42"
                            :showValue="true"
                            valueSuffix="% (Rp 119.6 jt)"
                            :readonly="true"
                        />

                        <vibe:range
                            :label="__('docs/page/dashboard/index.charts.channels.social')"
                            size="xs"
                            variant="info"
                            :min="0"
                            :max="100"
                            :value="28"
                            :showValue="true"
                            valueSuffix="% (Rp 79.8 jt)"
                            :readonly="true"
                        />

                        <vibe:range
                            :label="__('docs/page/dashboard/index.charts.channels.direct')"
                            size="xs"
                            variant="primary"
                            :min="0"
                            :max="100"
                            :value="18"
                            :showValue="true"
                            valueSuffix="% (Rp 51.3 jt)"
                            :readonly="true"
                        />

                        <vibe:range
                            :label="__('docs/page/dashboard/index.charts.channels.referral')"
                            size="xs"
                            variant="warning"
                            :min="0"
                            :max="100"
                            :value="12"
                            :showValue="true"
                            valueSuffix="% (Rp 34.2 jt)"
                            :readonly="true"
                        />
                    </div>
                </div>
            </vibe:grid.card>

            {{-- ===================================================================== --}}
            {{-- ROW 4: INVENTORY ALERTS (colSpan=6) & STORE ACTIVITY LOG (colSpan=6)  --}}
            {{-- ===================================================================== --}}

            {{-- 9. Low Stock Inventory Alerts Widget --}}
            <vibe:grid.card id="widget-inventory-alerts" :title="__('docs/page/dashboard/index.alerts.inventory_title')" :description="__('docs/page/dashboard/index.alerts.inventory_desc')" :colSpan="6" :minColSpan="4">
                <x-slot:actions>
                    <vibe:badge variant="danger" size="sm" class="font-medium">
                        3 Perlu Restock
                    </vibe:badge>
                </x-slot:actions>

                <div class="space-y-3">
                    {{-- Alert Item 1 menggunakan <vibe:card variant="outline"> --}}
                    <vibe:card variant="outline" class="p-3 border-destructive/25 bg-destructive/5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <vibe:badge variant="danger" size="sm" class="size-8 rounded-lg p-0 flex items-center justify-center font-bold text-xs shrink-0">
                                4K
                            </vibe:badge>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-foreground truncate">Ultra-wide 4K Monitor 34"</p>
                                <p class="text-[11px] text-destructive font-medium truncate">
                                    {{ __('docs/page/dashboard/index.alerts.critical') }} • Sisa 4 unit (Batas min: 10)
                                </p>
                            </div>
                        </div>
                        <vibe:button variant="outline" size="xs" class="shrink-0 text-xs border-destructive/30 text-destructive hover:bg-destructive/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Pesanan pengadaan stok monitor terkirim ke supplier.', { type: 'info' }) : null">
                            {{ __('docs/page/dashboard/index.actions.restock') }}
                        </vibe:button>
                    </vibe:card>

                    {{-- Alert Item 2 --}}
                    <vibe:card variant="outline" class="p-3 border-warning/25 bg-warning/5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <vibe:badge variant="warning" size="sm" class="size-8 rounded-lg p-0 flex items-center justify-center font-bold text-xs shrink-0">
                                KB
                            </vibe:badge>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-foreground truncate">Mechanical Keyboard Vibe Pro</p>
                                <p class="text-[11px] text-warning font-medium truncate">
                                    {{ __('docs/page/dashboard/index.alerts.warning') }} • Sisa 9 unit (Batas min: 15)
                                </p>
                            </div>
                        </div>
                        <vibe:button variant="outline" size="xs" class="shrink-0 text-xs border-warning/30 text-warning hover:bg-warning/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Pesanan pengadaan stok keyboard terkirim.', { type: 'info' }) : null">
                            {{ __('docs/page/dashboard/index.actions.restock') }}
                        </vibe:button>
                    </vibe:card>

                    {{-- Alert Item 3 --}}
                    <vibe:card variant="outline" class="p-3 border-warning/25 bg-warning/5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <vibe:badge variant="warning" size="sm" class="size-8 rounded-lg p-0 flex items-center justify-center font-bold text-xs shrink-0">
                                HB
                            </vibe:badge>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-foreground truncate">USB-C Hub Multiport 8-in-1</p>
                                <p class="text-[11px] text-warning font-medium truncate">
                                    {{ __('docs/page/dashboard/index.alerts.warning') }} • Sisa 12 unit (Batas min: 20)
                                </p>
                            </div>
                        </div>
                        <vibe:button variant="outline" size="xs" class="shrink-0 text-xs border-warning/30 text-warning hover:bg-warning/10 cursor-pointer" @click="window.vibeToast ? vibeToast('Pesanan pengadaan stok hub terkirim.', { type: 'info' }) : null">
                            {{ __('docs/page/dashboard/index.actions.restock') }}
                        </vibe:button>
                    </vibe:card>
                </div>
            </vibe:grid.card>

            {{-- 10. Store Activity Feed Widget --}}
            <vibe:grid.card id="widget-store-activity" :title="__('docs/page/dashboard/index.activity.title')" :description="__('docs/page/dashboard/index.activity.desc')" :colSpan="6" :minColSpan="4">
                <div class="space-y-3">
                    <vibe:card variant="flat" class="p-3 flex items-start gap-3">
                        <vibe:badge variant="success" size="sm" class="mt-0.5 shrink-0">Terkirim</vibe:badge>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Pesanan #ORD-9842 dikirim via JNE Express
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5 truncate">
                                Resi: JNE88291048291 • Tujuan: Jakarta Selatan • 5 menit lalu
                            </p>
                        </div>
                    </vibe:card>

                    <vibe:card variant="flat" class="p-3 flex items-start gap-3">
                        <vibe:badge variant="info" size="sm" class="mt-0.5 shrink-0">Lunas</vibe:badge>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Pembayaran Rp 6.890.000 berhasil diverifikasi
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5 truncate">
                                Metode: BCA Virtual Account • Pelanggan: Sarah Amalia • 32 menit lalu
                            </p>
                        </div>
                    </vibe:card>

                    <vibe:card variant="flat" class="p-3 flex items-start gap-3">
                        <vibe:badge variant="warning" size="sm" class="mt-0.5 shrink-0">Ulasan</vibe:badge>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Ulasan Bintang 5 diterima dari Budi Santoso
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5 truncate">
                                "Mouse sangat nyaman digunakan untuk coding seharian!" • 1 jam lalu
                            </p>
                        </div>
                    </vibe:card>

                    <vibe:card variant="flat" class="p-3 flex items-start gap-3">
                        <vibe:badge variant="secondary" size="sm" class="mt-0.5 shrink-0">Sistem</vibe:badge>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-semibold text-foreground truncate">
                                Sinkronisasi katalog marketplace (Tokopedia & Shopee)
                            </p>
                            <p class="text-[11px] text-muted-foreground mt-0.5 truncate">
                                48 produk berhasil diperbarui secara otomatis • 2 jam lalu
                            </p>
                        </div>
                    </vibe:card>
                </div>
            </vibe:grid.card>
        </vibe:grid>

        {{-- ========================================================================= --}}
        {{-- MODAL TAMBAH PRODUK (MENGGUNAKAN KOMPONEN FORM VIBE UI)                   --}}
        {{-- ========================================================================= --}}
        <vibe:modal id="add-product-modal" size="lg">
            <vibe:modal.header>
                <span>{{ __('docs/page/dashboard/index.actions.add_product') }}</span>
            </vibe:modal.header>
            <vibe:modal.content>
                <vibe:form id="add-product-form" class="space-y-4" @submit.prevent="$dispatch('close-modal', 'add-product-modal'); if (window.vibeToast) vibeToast('Produk baru berhasil ditambahkan ke katalog.', { type: 'success' });">
                    <vibe:input label="Nama Produk" name="product_name" placeholder="Contoh: Mechanical Keyboard Vibe Pro" required />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <vibe:select label="Kategori" name="category" placeholder="Pilih kategori">
                            <vibe:select.option value="pc" label="Aksesori PC" />
                            <vibe:select.option value="monitor" label="Hardware & Layar" />
                            <vibe:select.option value="peripheral" label="Periferal" />
                            <vibe:select.option value="desk" label="Aksesori Meja" />
                        </vibe:select>

                        <vibe:input.currency label="Harga Jual" name="price" currency="IDR" value="450000" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <vibe:input.quantity label="Stok Awal" name="stock" :min="1" :max="999" :value="25" />
                        <vibe:input.generate label="Kode SKU" name="sku" prefix="PRD-" :length="8" />
                    </div>

                    <vibe:textarea label="Deskripsi Singkat" name="description" rows="3" placeholder="Spesifikasi utama produk..." />

                    <vibe:switch label="Aktifkan & Publikasikan ke Katalog" description="Produk akan langsung tampil di halaman toko utama." checked />
                </vibe:form>
            </vibe:modal.content>
            <vibe:modal.footer>
                <vibe:button type="button" variant="ghost" @click="close">Batal</vibe:button>
                <vibe:button type="button" variant="primary" @click="$dispatch('close-modal', 'add-product-modal'); if (window.vibeToast) vibeToast('Produk baru berhasil ditambahkan ke katalog.', { type: 'success' });">
                    Simpan Produk
                </vibe:button>
            </vibe:modal.footer>
        </vibe:modal>

        {{-- ========================================================================= --}}
        {{-- SECTION FULL SOURCE CODE DI BAGIAN BAWAH HALAMAN                          --}}
        {{-- ========================================================================= --}}
        <vibe:separator />

        <section id="full-source-code" class="space-y-4 pb-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold tracking-tight text-foreground">Full Source Code</h2>
                        <vibe:badge variant="secondary" size="sm" class="font-mono">Blade</vibe:badge>
                    </div>
                    <p class="text-xs sm:text-sm text-muted-foreground mt-0.5">
                        Salin seluruh kode template di bawah ini untuk membuat halaman eCommerce Dashboard lengkap dengan komponen Vibe UI.
                    </p>
                </div>
            </div>

            @php
                // Membaca kode sumber halaman ini secara bersih tanpa menyertakan blok pembaca kode itu sendiri
                $dashboardFilePath = resource_path('views/docs/dashboard/index.blade.php');
                $fullDashboardCode = file_exists($dashboardFilePath) ? file_get_contents($dashboardFilePath) : file_get_contents(__FILE__);
                $splitMarker = '{{-- ========================================================================= --}}' . "\n" . '        {{-- SECTION FULL SOURCE CODE DI BAGIAN BAWAH HALAMAN';
                if (str_contains($fullDashboardCode, '{{-- SECTION FULL SOURCE CODE DI BAGIAN BAWAH HALAMAN')) {
                    $parts = explode('{{-- SECTION FULL SOURCE CODE DI BAGIAN BAWAH HALAMAN', $fullDashboardCode);
                    $cleanTop = preg_replace('/<vibe:separator\s*\/>\s*\{\{--\s*=+\s*--\}\}\s*$/s', '', rtrim($parts[0]));
                    $fullDashboardCode = rtrim($cleanTop) . "\n    </div>\n</x-docs.layouts.sidebar>\n";
                }
            @endphp

            <vibe:highlightjs
                language="blade"
                title="resources/views/docs/dashboard/index.blade.php"
                :lineNumbers="true"
                :copyable="true"
                maxHeight="680px"
                :code="$fullDashboardCode"
            />
        </section>
    </div>
</x-docs.layouts.sidebar>
