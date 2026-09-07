<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/chart.title')" :description="__('docs/chart.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/chart.title'), 'url' => '/docs/chart']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/chart.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/chart.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/chart.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/chart.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:config</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:data</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:options</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">height</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:sparkline</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Eloquent / DB</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">VibeChart</vibe:badge>
                </div>
            </div>

            {{-- 1. Cara Penggunaan (Basic Usage & Workflow) --}}
            <section id="cara-penggunaan" class="space-y-6">
                <div class="space-y-2">
                    <h2 class="text-2xl font-bold tracking-tight text-foreground">{{ __('docs/chart.usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground leading-relaxed max-w-3xl">
                        {!! __('docs/chart.usage.desc') !!}
                    </p>
                </div>

                {{-- Fitur Utama Komponen Box --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl bg-card border border-border space-y-1.5">
                        <div class="flex items-center gap-2 text-primary font-semibold text-xs">
                            <span class="size-2 rounded-full bg-primary animate-ping"></span>
                            {{ __('docs/chart.usage.features.vite_title') }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            {!! __('docs/chart.usage.features.vite_desc') !!}
                        </p>
                    </div>
                    <div class="p-4 rounded-xl bg-card border border-border space-y-1.5">
                        <div class="flex items-center gap-2 text-primary font-semibold text-xs">
                            <span class="size-2 rounded-full bg-chart-2"></span>
                            {{ __('docs/chart.usage.features.colors_title') }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            {!! __('docs/chart.usage.features.colors_desc') !!}
                        </p>
                    </div>
                    <div class="p-4 rounded-xl bg-card border border-border space-y-1.5">
                        <div class="flex items-center gap-2 text-primary font-semibold text-xs">
                            <span class="size-2 rounded-full bg-chart-4"></span>
                            {{ __('docs/chart.usage.features.native_title') }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            {!! __('docs/chart.usage.features.native_desc') !!}
                        </p>
                    </div>
                </div>

                {{-- Sub 1: Sintaks Pemanggilan Dasar --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/chart.usage.steps.step1_title') }}</h3>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.usage.steps.step1_desc') !!}
                    </p>

                    <vibe:preview data-toc-ignore :title="__('docs/chart.usage.preview_title')">
                        <vibe:preview.code>
                            <vibe:chart :config="[
                                'type' => 'bar',
                                'data' => [
                                    'labels' => __('docs/chart.usage.demo.labels'),
                                    'datasets' => [
                                        [
                                            'label' => __('docs/chart.usage.demo.dataset_label'),
                                            'data' => [8, 19, 34, 58],
                                            'borderColor' => 'destructive',
                                            'backgroundColor' => 'destructive/20',
                                            'borderWidth' => 1.5,
                                            'borderRadius' => 6,
                                        ],
                                    ],
                                ],
                            ]" :height="240" />
                        </vibe:preview.code>
                        <div class="w-full p-4 sm:p-6">
                            <vibe:card>
                                <vibe:card.header>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <vibe:card.title>{{ __('docs/chart.usage.demo.card_title') }}</vibe:card.title>
                                            <vibe:card.description>{{ __('docs/chart.usage.demo.card_desc') }}</vibe:card.description>
                                        </div>
                                        <vibe:badge variant="destructive" class="rounded-full font-mono text-xs">{{ __('docs/chart.usage.demo.badge_text') }}</vibe:badge>
                                    </div>
                                </vibe:card.header>
                                <vibe:card.content>
                                    <vibe:chart :config="[
                                        'type' => 'bar',
                                        'data' => [
                                            'labels' => __('docs/chart.usage.demo.labels'),
                                            'datasets' => [
                                                [
                                                    'label' => __('docs/chart.usage.demo.dataset_label'),
                                                    'data' => [8, 19, 34, 58],
                                                    'borderColor' => 'destructive',
                                                    'backgroundColor' => 'destructive/20',
                                                    'borderWidth' => 1.5,
                                                    'borderRadius' => 6,
                                                ],
                                            ],
                                        ],
                                    ]" :height="240" />
                                </vibe:card.content>
                            </vibe:card>
                        </div>
                    </vibe:preview>
                </div>

                {{-- Sub 2: Penyiapan Data dari Controller --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/chart.usage.steps.step2_title') }}</h3>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.usage.steps.step2_desc') !!}
                    </p>

                    @php
                        $controllerLabel = __('docs/chart.database.datasets.revenue');
                        $dashboardControllerCode = <<<PHP
namespace App\Http\Controllers;

use App\Models\SalesMetric;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 1. Eloquent Query
        \$metrics = SalesMetric::where('category', 'Semua Kategori')
            ->orderBy('id')
            ->get();

        // 2. Map database columns to :config Chart array
        \$salesChart = [
            'type' => 'bar',
            'data' => [
                'labels' => \$metrics->pluck('month')->toArray(),
                'datasets' => [
                    [
                        'label' => '{$controllerLabel}',
                        'data' => \$metrics->pluck('revenue')->map(fn(\$v) => round(\$v / 1000000))->toArray(),
                        'borderColor' => 'destructive',
                        'backgroundColor' => 'destructive/20',
                        'borderWidth' => 1.5,
                        'borderRadius' => 6,
                    ],
                ],
            ],
        ];

        // 3. Pass chart config to view
        return view('dashboard', compact('salesChart'));
    }
}
PHP;

                        $bladeCardTitle = __('docs/chart.database.card_title');
                        $bladeCardDesc = strip_tags(__('docs/chart.database.card_desc'));
                        $bladeUsageCode = <<<BLADE
<vibe:card>
    <vibe:card.header>
        <vibe:card.title>{$bladeCardTitle}</vibe:card.title>
        <vibe:card.description>{$bladeCardDesc}</vibe:card.description>
    </vibe:card.header>
    <vibe:card.content>
        <vibe:chart :config="\$salesChart" :height="240" />
    </vibe:card.content>
</vibe:card>
BLADE;

                        $cardStructureCode = <<<'BLADE'
<vibe:card>
    <vibe:card.header>
        <div class="flex items-center justify-between">
            <div>
                <vibe:card.title>{{ __('docs/chart.usage.step2_demo.card_title') }}</vibe:card.title>
                <vibe:card.description>{{ __('docs/chart.usage.step2_demo.card_desc') }}</vibe:card.description>
            </div>
            <vibe:badge variant="outline" class="rounded-full">Live</vibe:badge>
        </div>
    </vibe:card.header>
    <vibe:card.content>
        {{-- Tempatkan komponen chart di dalam card.content --}}
        <vibe:chart :config="$chartConfig" :height="240" />
    </vibe:card.content>
</vibe:card>
BLADE;
                    @endphp

                    <vibe:highlightjs language="php" title="app/Http/Controllers/DashboardController.php" :code="$dashboardControllerCode" />

                    <vibe:highlightjs language="blade" title="resources/views/dashboard.blade.php" :code="$bladeUsageCode" />
                </div>

                {{-- Sub 3: Pembungkusan dalam Vibe Card --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/chart.usage.steps.step3_title') }}</h3>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.usage.steps.step3_desc') !!}
                    </p>

                    <vibe:highlightjs language="blade" :title="__('docs/chart.usage.step2_demo.example_title')" :code="$cardStructureCode" />
                </div>

                {{-- Sub 4: Sistem Warna Tema & Opasitas Slash --}}
                <div class="space-y-3 pt-2">
                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/chart.usage.steps.step4_title') }}</h3>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.usage.steps.step4_desc') !!}
                    </p>

                    <div class="p-5 rounded-2xl bg-card border border-border space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <h4 class="font-semibold text-xs uppercase tracking-wider text-muted-foreground">{{ __('docs/chart.usage.color_tokens.semantic_title') }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-primary/10 border border-primary/20 text-xs font-mono text-foreground">
                                        <span class="size-2 rounded-full bg-primary"></span> primary
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-destructive/10 border border-destructive/20 text-xs font-mono text-destructive">
                                        <span class="size-2 rounded-full bg-destructive"></span> destructive
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-sky-500/10 border border-sky-500/20 text-xs font-mono text-sky-600 dark:text-sky-400">
                                        <span class="size-2 rounded-full bg-sky-500"></span> info
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-xs font-mono text-emerald-600 dark:text-emerald-400">
                                        <span class="size-2 rounded-full bg-emerald-500"></span> success
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-500/10 border border-amber-500/20 text-xs font-mono text-amber-600 dark:text-amber-400">
                                        <span class="size-2 rounded-full bg-amber-500"></span> warning
                                    </span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <h4 class="font-semibold text-xs uppercase tracking-wider text-muted-foreground">{{ __('docs/chart.usage.color_tokens.palette_title') }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-muted text-xs font-mono text-foreground">
                                        <span class="size-2 rounded-full bg-chart-1"></span> chart-1
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-muted text-xs font-mono text-foreground">
                                        <span class="size-2 rounded-full bg-chart-2"></span> chart-2
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-muted text-xs font-mono text-foreground">
                                        <span class="size-2 rounded-full bg-chart-3"></span> chart-3
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-muted text-xs font-mono text-foreground">
                                        <span class="size-2 rounded-full bg-chart-4"></span> chart-4
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-muted text-xs font-mono text-foreground">
                                        <span class="size-2 rounded-full bg-chart-5"></span> chart-5
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-border/60 text-xs space-y-1.5 text-muted-foreground">
                            <p><strong class="text-foreground">{{ __('docs/chart.usage.color_tokens.slash_opacity_title') }}</strong> {!! __('docs/chart.usage.color_tokens.slash_opacity_desc') !!}</p>
                            <p><strong class="text-foreground">{{ __('docs/chart.usage.color_tokens.dark_mode_title') }}</strong> {!! __('docs/chart.usage.color_tokens.dark_mode_desc') !!}</p>
                        </div>
                    </div>
                </div>

                {{-- Sub 5: Anatomi Konfigurasi Array --}}
                <div class="p-5 rounded-2xl bg-muted/40 border border-border text-xs space-y-2.5 leading-relaxed">
                    <p class="font-semibold text-foreground text-sm">{!! __('docs/chart.usage.config_anatomy.title') !!}</p>
                    <ul class="list-disc list-inside space-y-1.5 text-muted-foreground">
                        <li><code class="text-foreground font-semibold">type</code>: {!! __('docs/chart.usage.config_anatomy.type') !!}</li>
                        <li><code class="text-foreground font-semibold">data.labels</code>: {!! __('docs/chart.usage.config_anatomy.labels') !!}</li>
                        <li><code class="text-foreground font-semibold">data.datasets</code>: {!! __('docs/chart.usage.config_anatomy.datasets') !!}</li>
                        <li><code class="text-foreground font-semibold">options</code>: {!! __('docs/chart.usage.config_anatomy.options') !!}</li>
                        <li><code class="text-foreground font-semibold">:height</code>: {!! __('docs/chart.usage.config_anatomy.height') !!}</li>
                    </ul>
                </div>
            </section>

            {{-- 2. Metode Pemanggilan Chart (Invocation Methods) --}}
            <section id="metode-pemanggilan" class="space-y-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <h2 class="text-2xl font-bold tracking-tight text-foreground">{{ __('docs/chart.methods.title') }}</h2>
                        <vibe:badge size="sm" variant="outline" class="bg-primary/5 text-primary border-primary/20">{{ __('docs/chart.methods.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground leading-relaxed max-w-3xl">
                        {!! __('docs/chart.methods.desc') !!}
                    </p>
                </div>

                {{-- 4 Metode Info Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-primary"></span>
                            {{ __('docs/chart.methods.method1_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.methods.method1_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-chart-2"></span>
                            {{ __('docs/chart.methods.method2_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.methods.method2_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-chart-3"></span>
                            {{ __('docs/chart.methods.method3_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.methods.method3_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-chart-4"></span>
                            {{ __('docs/chart.methods.method4_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.methods.method4_desc') !!}
                        </p>
                    </div>
                </div>

                {{-- 1 Komponen Preview Tunggal untuk 4 Metode --}}
                <vibe:preview data-toc-ignore :title="__('docs/chart.methods.title')">
                    <vibe:preview.code>
                        <!-- ========================================================================= -->
                        <!-- METODE 1: Tag Blade dengan Konfigurasi Tunggal (:config) - DIREKOMENDASIKAN -->
                        <!-- ========================================================================= -->
                        <vibe:chart :config="[
                            'type' => 'bar',
                            'data' => [
                                'labels' => __('docs/chart.usage.demo.labels'),
                                'datasets' => [
                                    [
                                        'label' => __('docs/chart.usage.demo.dataset_label'),
                                        'data' => [8, 19, 34, 58],
                                        'borderColor' => 'destructive',
                                        'backgroundColor' => 'destructive/20',
                                        'borderWidth' => 1.5,
                                        'borderRadius' => 6,
                                    ],
                                ],
                            ],
                        ]" :height="240" />

                        <!-- ========================================================================= -->
                        <!-- METODE 2: Tag Blade dengan Properti Shorthand (type, :data, :options)     -->
                        <!-- ========================================================================= -->
                        <vibe:chart type="bar" :data="[
                            'labels' => __('docs/chart.usage.demo.labels'),
                            'datasets' => [
                                [
                                    'label' => __('docs/chart.usage.demo.dataset_label'),
                                    'data' => [8, 19, 34, 58],
                                    'borderColor' => 'destructive',
                                    'backgroundColor' => 'destructive/20',
                                    'borderWidth' => 1.5,
                                    'borderRadius' => 6,
                                ],
                            ],
                        ]" :options="[
                            'plugins' => [
                                'legend' => ['display' => true, 'position' => 'top'],
                            ],
                        ]" :height="240" />

                        <!-- ========================================================================= -->
                        <!-- METODE 3: Tag Blade dengan ID Kustom + Interaksi JavaScript Real-time     -->
                        <!-- ========================================================================= -->
                        <!-- 1. Definisikan komponen Blade dengan atribut id="..." kustom -->
                        <vibe:chart id="chart-monitoring-live" :config="[
                            'type' => 'bar',
                            'data' => [
                                'labels' => __('docs/chart.usage.demo.labels'),
                                'datasets' => [
                                    [
                                        'label' => __('docs/chart.usage.demo.dataset_label'),
                                        'data' => [8, 19, 34, 58],
                                        'borderColor' => 'destructive',
                                        'backgroundColor' => 'destructive/20',
                                        'borderWidth' => 1.5,
                                        'borderRadius' => 6,
                                    ],
                                ],
                            ],
                        ]" :height="240" />

                        <!-- 2. Kontrol atau update data dari JavaScript tanpa reload halaman -->
                        <script>
                            function refreshTiketData() {
                                const canvas = document.querySelector('#chart-monitoring-live canvas');
                                const chart = Chart.getChart(canvas);

                                if (chart) {
                                    chart.data.datasets[0].data = [15, 28, 45, 72];
                                    chart.update(); // Re-render animasi tanpa me-reload halaman
                                }
                            }
                        </script>

                        <!-- ========================================================================= -->
                        <!-- METODE 4: Murni JavaScript Menggunakan Canvas ID (VibeChart.create)       -->
                        <!-- ========================================================================= -->
                        <!-- 1. Elemen Canvas HTML biasa dengan ID -->
                        <div class="w-full h-60">
                            <canvas id="canvas-pure-js"></canvas>
                        </div>

                        <!-- 2. Inisialisasi menggunakan Helper VibeChart.create() -->
                        <script>
                            document.addEventListener('vibe-chart-ready', () => {
                                // VibeChart.create otomatis menerapkan tema Vibe UI & observer dark mode
                                VibeChart.create('#canvas-pure-js', {
                                    type: 'bar',
                                    data: {
                                        labels: @json(__('docs/chart.usage.demo.labels')),
                                        datasets: [{
                                            label: '{{ __('docs/chart.usage.demo.dataset_label') }}',
                                            data: [8, 19, 34, 58],
                                            borderColor: 'destructive',
                                            backgroundColor: 'destructive/20',
                                            borderWidth: 1.5,
                                            borderRadius: 6,
                                        }, ],
                                    },
                                });
                            });
                        </script>
                    </vibe:preview.code>

                    <div class="w-full p-4 sm:p-6" x-data="{
                        activeMethod: 1,
                        updateRandom() {
                            const canvas = document.querySelector('#chart-monitoring-live canvas');
                            if (canvas && window.Chart) {
                                const chart = window.Chart.getChart(canvas);
                                if (chart && chart.data && chart.data.datasets && chart.data.datasets[0]) {
                                    chart.data.datasets[0].data = [
                                        Math.floor(Math.random() * 25) + 5,
                                        Math.floor(Math.random() * 35) + 15,
                                        Math.floor(Math.random() * 45) + 20,
                                        Math.floor(Math.random() * 55) + 35
                                    ];
                                    chart.update();
                                }
                            }
                        },
                        switchMethod(method) {
                            this.activeMethod = method;
                            var self = this;
                            this.$nextTick(function() {
                                if (method === 4 && typeof window.initMethod4Demo === 'function') {
                                    window.initMethod4Demo();
                                }
                                var canvases = self.$el.querySelectorAll('canvas');
                                canvases.forEach(function(c) {
                                    if (window.Chart && window.Chart.getChart(c)) {
                                        window.Chart.getChart(c).resize();
                                    }
                                });
                            });
                        }
                    }">
                        <vibe:card>
                            <vibe:card.header>
                                <div class="w-full flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                                    <div>
                                        <vibe:card.title>{{ __('docs/chart.methods.card_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/chart.methods.card_desc') }}</vibe:card.description>
                                    </div>

                                    {{-- Segmented Controls untuk 4 Metode --}}
                                    <div class="inline-flex flex-wrap items-center gap-1 p-1 rounded-xl bg-muted/60 border border-border text-xs shrink-0 sm:ml-auto">
                                        <button type="button" @click="switchMethod(1)" :class="activeMethod === 1 ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg cursor-pointer transition-all duration-150">
                                            {{ __('docs/chart.methods.tabs.method1') }}
                                        </button>
                                        <button type="button" @click="switchMethod(2)" :class="activeMethod === 2 ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg cursor-pointer transition-all duration-150">
                                            {{ __('docs/chart.methods.tabs.method2') }}
                                        </button>
                                        <button type="button" @click="switchMethod(3)" :class="activeMethod === 3 ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg cursor-pointer transition-all duration-150">
                                            {{ __('docs/chart.methods.tabs.method3') }}
                                        </button>
                                        <button type="button" @click="switchMethod(4)" :class="activeMethod === 4 ? 'bg-background text-foreground shadow-xs font-semibold' : 'text-muted-foreground hover:text-foreground'" class="px-2.5 py-1 rounded-lg cursor-pointer transition-all duration-150">
                                            {{ __('docs/chart.methods.tabs.method4') }}
                                        </button>
                                    </div>
                                </div>
                            </vibe:card.header>

                            <vibe:card.content>
                                {{-- Panel Metode 1 --}}
                                <div x-show="activeMethod === 1" class="space-y-3">
                                    <div class="flex items-center justify-between text-xs text-muted-foreground pb-1 border-b border-border/40">
                                        <span>{!! __('docs/chart.methods.banners.method1') !!}</span>
                                        <vibe:badge size="sm" variant="secondary">{{ __('docs/chart.methods.banners.badge_recommended') }}</vibe:badge>
                                    </div>
                                    <vibe:chart :config="[
                                        'type' => 'bar',
                                        'data' => [
                                            'labels' => __('docs/chart.usage.demo.labels'),
                                            'datasets' => [
                                                [
                                                    'label' => __('docs/chart.usage.demo.dataset_label'),
                                                    'data' => [8, 19, 34, 58],
                                                    'borderColor' => 'destructive',
                                                    'backgroundColor' => 'destructive/20',
                                                    'borderWidth' => 1.5,
                                                    'borderRadius' => 6,
                                                ],
                                            ],
                                        ],
                                    ]" :height="240" />
                                </div>

                                {{-- Panel Metode 2 --}}
                                <div x-show="activeMethod === 2" x-cloak class="space-y-3">
                                    <div class="flex items-center justify-between text-xs text-muted-foreground pb-1 border-b border-border/40">
                                        <span>{!! __('docs/chart.methods.banners.method2') !!}</span>
                                        <vibe:badge size="sm" variant="outline">{{ __('docs/chart.methods.banners.badge_shorthand') }}</vibe:badge>
                                    </div>
                                    <vibe:chart type="bar" :data="[
                                        'labels' => __('docs/chart.usage.demo.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.usage.demo.dataset_label'),
                                                'data' => [8, 19, 34, 58],
                                                'borderColor' => 'destructive',
                                                'backgroundColor' => 'destructive/20',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                        ],
                                    ]" :options="[
                                        'plugins' => [
                                            'legend' => ['display' => true, 'position' => 'top'],
                                        ],
                                    ]" :height="240" />
                                </div>

                                {{-- Panel Metode 3 --}}
                                <div x-show="activeMethod === 3" x-cloak class="space-y-3">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-muted-foreground pb-1 border-b border-border/40">
                                        <span>{!! __('docs/chart.methods.banners.method3') !!}</span>
                                        <vibe:button size="sm" variant="outline" class="gap-1.5 self-start sm:self-auto" @click="updateRandom()">
                                            <svg class="size-3.5 animate-spin" style="animation-duration: 3s;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            {{ __('docs/chart.methods.banners.btn_randomize') }}
                                        </vibe:button>
                                    </div>
                                    <vibe:chart id="chart-monitoring-live" :config="[
                                        'type' => 'bar',
                                        'data' => [
                                            'labels' => __('docs/chart.usage.demo.labels'),
                                            'datasets' => [
                                                [
                                                    'label' => __('docs/chart.usage.demo.dataset_label'),
                                                    'data' => [8, 19, 34, 58],
                                                    'borderColor' => 'destructive',
                                                    'backgroundColor' => 'destructive/20',
                                                    'borderWidth' => 1.5,
                                                    'borderRadius' => 6,
                                                ],
                                            ],
                                        ],
                                    ]" :height="240" />
                                </div>

                                {{-- Panel Metode 4 --}}
                                <div x-show="activeMethod === 4" x-cloak class="space-y-3">
                                    <div class="flex items-center justify-between text-xs text-muted-foreground pb-1 border-b border-border/40">
                                        <span>{!! __('docs/chart.methods.banners.method4') !!}</span>
                                        <vibe:badge size="sm" variant="outline" class="bg-sky-500/10 text-sky-600 border-sky-500/20">{{ __('docs/chart.methods.banners.badge_js_api') }}</vibe:badge>
                                    </div>
                                    <div class="w-full h-60">
                                        <canvas id="canvas-pure-js-demo"></canvas>
                                    </div>
                                </div>
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Database & Eloquent Integration --}}
            <section id="database-integration" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.database.title') }}</h2>
                        <vibe:badge size="sm" variant="outline" class="bg-primary/5 text-primary border-primary/20">{{ __('docs/chart.database.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.database.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.database.preview_title')">
                    <vibe:preview.code>
                        <!-- Controller / Route -->
                        $monthlyMetrics = SalesMetric::where('category', 'Semua Kategori')->orderBy('id')->get();

                        <!-- Blade View -->
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.database.card_title') }}</vibe:card.title>
                                <vibe:card.description>{!! __('docs/chart.database.card_desc') !!}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                            'type' => 'line',
                                            'data' => [
                                                'labels' => $monthlyMetrics->pluck('month')->toArray(),
                                                'datasets' => [
                                                    [
                                                        'label' => __('docs/chart.database.datasets.revenue'),
                                                        'data' => $monthlyMetrics->pluck('revenue')->map(fn($v) => round($v / 1000000, 1))->toArray(),
                                                        'borderColor' => 'chart-1',
                                                        'backgroundColor' => 'chart-1/15',
                                                        'borderWidth' => 2,
                                                        'fill' => true,
                                                        'tension' => 0.4,
                                                    ],
                                                    [
                                                        'label' => __('docs/chart.database.datasets.profit'),
                                                        'data' => $monthlyMetrics->pluck('profit')->map(fn($v) => round($v / 1000000, 1))->toArray(),
                                                        'borderColor' => 'chart-2',
                                                        'backgroundColor' => 'chart-2/15',
                                                        'borderWidth' => 2,
                                                        'fill' => true,
                                                        'tension' => 0.4,
                                                    ],
                                                ],
                                            ],
                                        ]" :height="300" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        @php
                            $dbMonthly = $monthlyMetrics ?? \App\Models\SalesMetric::where('category', 'Semua Kategori')->orderBy('id')->get();
                        @endphp
                        <vibe:card>
                            <vibe:card.header>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <vibe:card.title>{{ __('docs/chart.database.card_title') }}</vibe:card.title>
                                        <vibe:card.description>{!! __('docs/chart.database.card_desc') !!}</vibe:card.description>
                                    </div>
                                    <vibe:badge size="sm" variant="outline" class="bg-emerald-500/10 text-emerald-600 border-emerald-500/20 font-medium">
                                        {{ __('docs/chart.database.months_tracked', ['count' => $dbMonthly->count()]) }}
                                    </vibe:badge>
                                </div>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                                                    'type' => 'line',
                                                                    'data' => [
                                                                        'labels' => $dbMonthly->pluck('month')->toArray(),
                                                                        'datasets' => [
                                                                            [
                                                                                'label' => __('docs/chart.database.datasets.revenue'),
                                                                                'data' => $dbMonthly->pluck('revenue')->map(fn($v) => round($v / 1000000, 1))->toArray(),
                                                                                'borderColor' => 'chart-1',
                                                                                'backgroundColor' => 'chart-1/15',
                                                                                'borderWidth' => 2,
                                                                                'fill' => true,
                                                                                'tension' => 0.4,
                                                                            ],
                                                                            [
                                                                                'label' => __('docs/chart.database.datasets.profit'),
                                                                                'data' => $dbMonthly->pluck('profit')->map(fn($v) => round($v / 1000000, 1))->toArray(),
                                                                                'borderColor' => 'chart-2',
                                                                                'backgroundColor' => 'chart-2/15',
                                                                                'borderWidth' => 2,
                                                                                'fill' => true,
                                                                                'tension' => 0.4,
                                                                            ],
                                                                        ],
                                                                    ],
                                                                ]" :height="300" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Bar & Column Chart --}}
            <section id="bar-chart" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.bar.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.bar.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.bar.preview_title')">
                    <vibe:preview.code>
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.bar.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.bar.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'bar',
                                    'data' => [
                                        'labels' => __('docs/chart.bar.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.bar.datasets.q1'),
                                                'data' => [44, 55, 57, 56, 61],
                                                'borderColor' => 'chart-1',
                                                'backgroundColor' => 'chart-1/80',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                            [
                                                'label' => __('docs/chart.bar.datasets.q2'),
                                                'data' => [76, 85, 101, 98, 87],
                                                'borderColor' => 'chart-2',
                                                'backgroundColor' => 'chart-2/80',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                        ],
                                    ],
                                ]" :height="260" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.bar.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.bar.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'bar',
                                    'data' => [
                                        'labels' => __('docs/chart.bar.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.bar.datasets.q1'),
                                                'data' => [44, 55, 57, 56, 61],
                                                'borderColor' => 'chart-1',
                                                'backgroundColor' => 'chart-1/80',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                            [
                                                'label' => __('docs/chart.bar.datasets.q2'),
                                                'data' => [76, 85, 101, 98, 87],
                                                'borderColor' => 'chart-2',
                                                'backgroundColor' => 'chart-2/80',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                        ],
                                    ],
                                ]" :height="260" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Area & Line Chart --}}
            <section id="line-chart" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.line.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.line.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.line.preview_title')">
                    <vibe:preview.code>
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.line.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.line.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => __('docs/chart.line.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.line.datasets.visitors'),
                                                'data' => [1250, 1890, 1420, 2100, 2480, 2900, 3150],
                                                'borderColor' => 'info',
                                                'backgroundColor' => 'info/15',
                                                'borderWidth' => 2.5,
                                                'fill' => true,
                                                'tension' => 0.35,
                                            ],
                                        ],
                                    ],
                                ]" :height="260" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.line.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.line.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => __('docs/chart.line.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.line.datasets.visitors'),
                                                'data' => [1250, 1890, 1420, 2100, 2480, 2900, 3150],
                                                'borderColor' => 'info',
                                                'backgroundColor' => 'info/15',
                                                'borderWidth' => 2.5,
                                                'fill' => true,
                                                'tension' => 0.35,
                                            ],
                                        ],
                                    ],
                                ]" :height="260" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Donut & Pie Chart (Database) --}}
            <section id="donut-pie" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.donut.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.donut.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.donut.preview_title')">
                    <vibe:preview.code>
                        @php
                            $dbCategories = $categoryMetrics ?? \App\Models\SalesMetric::where('month', 'Total')->orderByDesc('revenue')->get();
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Donut Chart --}}
                            <vibe:card>
                                <vibe:card.header>
                                    <vibe:card.title>{{ __('docs/chart.donut.donut_card_title') }}</vibe:card.title>
                                    <vibe:card.description>{{ __('docs/chart.donut.donut_card_desc') }}</vibe:card.description>
                                </vibe:card.header>
                                <vibe:card.content>
                                    <vibe:chart :config="[
                                                    'type' => 'doughnut',
                                                    'data' => [
                                                        'labels' => $dbCategories->pluck('category')->toArray(),
                                                        'datasets' => [
                                                            [
                                                                'data' => $dbCategories->pluck('revenue')->map(fn($v) => round($v / 1000000))->toArray(),
                                                                'backgroundColor' => ['chart-1', 'chart-2', 'chart-3', 'chart-4', 'chart-5'],
                                                                'borderWidth' => 2,
                                                            ],
                                                        ],
                                                    ],
                                                    'options' => [
                                                        'cutout' => '68%',
                                                    ],
                                                ]" :height="260" />
                                </vibe:card.content>
                            </vibe:card>

                            {{-- Pie Chart --}}
                            <vibe:card>
                                <vibe:card.header>
                                    <vibe:card.title>{{ __('docs/chart.donut.pie_card_title') }}</vibe:card.title>
                                    <vibe:card.description>{{ __('docs/chart.donut.pie_card_desc') }}</vibe:card.description>
                                </vibe:card.header>
                                <vibe:card.content>
                                    <vibe:chart :config="[
                                                    'type' => 'pie',
                                                    'data' => [
                                                        'labels' => $dbCategories->pluck('category')->toArray(),
                                                        'datasets' => [
                                                            [
                                                                'data' => $dbCategories->pluck('orders_count')->toArray(),
                                                                'backgroundColor' => ['primary', 'info', 'success', 'warning', 'destructive'],
                                                                'borderWidth' => 2,
                                                            ],
                                                        ],
                                                    ],
                                                ]" :height="260" />
                                </vibe:card.content>
                            </vibe:card>
                        </div>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        @php
                            $dbCategories = $categoryMetrics ?? \App\Models\SalesMetric::where('month', 'Total')->orderByDesc('revenue')->get();
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <vibe:card>
                                <vibe:card.header>
                                    <vibe:card.title>{{ __('docs/chart.donut.donut_card_title') }}</vibe:card.title>
                                    <vibe:card.description>{{ __('docs/chart.donut.donut_card_desc') }}</vibe:card.description>
                                </vibe:card.header>
                                <vibe:card.content>
                                    <vibe:chart :config="[
                                                                            'type' => 'doughnut',
                                                                            'data' => [
                                                                                'labels' => $dbCategories->pluck('category')->toArray(),
                                                                                'datasets' => [
                                                                                    [
                                                                                        'data' => $dbCategories->pluck('revenue')->map(fn($v) => round($v / 1000000))->toArray(),
                                                                                        'backgroundColor' => ['chart-1', 'chart-2', 'chart-3', 'chart-4', 'chart-5'],
                                                                                        'borderWidth' => 2,
                                                                                    ],
                                                                                ],
                                                                            ],
                                                                            'options' => [
                                                                                'cutout' => '68%',
                                                                            ],
                                                                        ]" :height="260" />
                                </vibe:card.content>
                            </vibe:card>

                            <vibe:card>
                                <vibe:card.header>
                                    <vibe:card.title>{{ __('docs/chart.donut.pie_card_title') }}</vibe:card.title>
                                    <vibe:card.description>{{ __('docs/chart.donut.pie_card_desc') }}</vibe:card.description>
                                </vibe:card.header>
                                <vibe:card.content>
                                    <vibe:chart :config="[
                                                                            'type' => 'pie',
                                                                            'data' => [
                                                                                'labels' => $dbCategories->pluck('category')->toArray(),
                                                                                'datasets' => [
                                                                                    [
                                                                                        'data' => $dbCategories->pluck('orders_count')->toArray(),
                                                                                        'backgroundColor' => ['primary', 'info', 'success', 'warning', 'destructive'],
                                                                                        'borderWidth' => 2,
                                                                                    ],
                                                                                ],
                                                                            ],
                                                                        ]" :height="260" />
                                </vibe:card.content>
                            </vibe:card>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Mixed Chart --}}
            <section id="mixed-chart" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.mixed.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.mixed.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.mixed.preview_title')">
                    <vibe:preview.code>
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.mixed.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.mixed.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'data' => [
                                        'labels' => __('docs/chart.mixed.labels'),
                                        'datasets' => [
                                            [
                                                'type' => 'bar',
                                                'label' => __('docs/chart.mixed.datasets.orders'),
                                                'data' => [380, 420, 510, 490, 620, 740, 810],
                                                'backgroundColor' => 'chart-1/35',
                                                'borderColor' => 'chart-1',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                            [
                                                'type' => 'line',
                                                'label' => __('docs/chart.mixed.datasets.conversion'),
                                                'data' => [9.05, 8.57, 9.11, 9.07, 9.12, 9.14, 9.10],
                                                'borderColor' => 'chart-3',
                                                'backgroundColor' => 'chart-3',
                                                'borderWidth' => 3,
                                                'tension' => 0.35,
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.mixed.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.mixed.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'data' => [
                                        'labels' => __('docs/chart.mixed.labels'),
                                        'datasets' => [
                                            [
                                                'type' => 'bar',
                                                'label' => __('docs/chart.mixed.datasets.orders'),
                                                'data' => [380, 420, 510, 490, 620, 740, 810],
                                                'backgroundColor' => 'chart-1/35',
                                                'borderColor' => 'chart-1',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                            [
                                                'type' => 'line',
                                                'label' => __('docs/chart.mixed.datasets.conversion'),
                                                'data' => [9.05, 8.57, 9.11, 9.07, 9.12, 9.14, 9.10],
                                                'borderColor' => 'chart-3',
                                                'backgroundColor' => 'chart-3',
                                                'borderWidth' => 3,
                                                'tension' => 0.35,
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Sparkline KPI --}}
            <section id="sparkline" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.sparkline.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.sparkline.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.sparkline.preview_title')">
                    <vibe:preview.code>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            {{-- Kartu Metrik 1 --}}
                            <vibe:card class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground font-medium">{{ __('docs/chart.sparkline.cards.revenue_title') }}</span>
                                    <vibe:badge variant="outline" size="sm" class="text-emerald-500 border-emerald-500/20 bg-emerald-500/10 font-semibold">+18%</vibe:badge>
                                </div>
                                <div class="text-2xl font-bold text-foreground">Rp 84.250.000</div>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
                                        'datasets' => [
                                            [
                                                'data' => [12, 14, 18, 24, 21, 35, 42, 50],
                                                'borderColor' => 'success',
                                                'backgroundColor' => 'success/15',
                                                'borderWidth' => 2,
                                                'fill' => true,
                                                'tension' => 0.4,
                                            ]
                                        ],
                                    ],
                                ]" :height="50" :sparkline="true" />
                            </vibe:card>

                            {{-- Kartu Metrik 2 --}}
                            <vibe:card class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground font-medium">{{ __('docs/chart.sparkline.cards.users_title') }}</span>
                                    <vibe:badge variant="outline" size="sm" class="text-sky-500 border-sky-500/20 bg-sky-500/10 font-semibold">+8.4%</vibe:badge>
                                </div>
                                <div class="text-2xl font-bold text-foreground">{{ __('docs/chart.sparkline.cards.users_val') }}</div>
                                <vibe:chart :config="[
                                    'type' => 'bar',
                                    'data' => [
                                        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
                                        'datasets' => [
                                            [
                                                'data' => [45, 60, 75, 50, 90, 65, 85, 100],
                                                'backgroundColor' => 'info',
                                                'borderRadius' => 4,
                                            ]
                                        ],
                                    ],
                                ]" :height="50" :sparkline="true" />
                            </vibe:card>

                            {{-- Kartu Metrik 3 --}}
                            <vibe:card class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground font-medium">{{ __('docs/chart.sparkline.cards.bounce_title') }}</span>
                                    <vibe:badge variant="outline" size="sm" class="text-amber-500 border-amber-500/20 bg-amber-500/10 font-semibold">-3.2%</vibe:badge>
                                </div>
                                <div class="text-2xl font-bold text-foreground">24.6%</div>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
                                        'datasets' => [
                                            [
                                                'data' => [65, 59, 50, 48, 42, 38, 30, 24],
                                                'borderColor' => 'warning',
                                                'borderWidth' => 2,
                                                'tension' => 0.4,
                                            ]
                                        ],
                                    ],
                                ]" :height="50" :sparkline="true" />
                            </vibe:card>
                        </div>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <vibe:card class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground font-medium">{{ __('docs/chart.sparkline.cards.revenue_title') }}</span>
                                    <vibe:badge variant="outline" size="sm" class="text-emerald-500 border-emerald-500/20 bg-emerald-500/10 font-semibold">+18%</vibe:badge>
                                </div>
                                <div class="text-2xl font-bold text-foreground">Rp 84.250.000</div>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
                                        'datasets' => [
                                            [
                                                'data' => [12, 14, 18, 24, 21, 35, 42, 50],
                                                'borderColor' => 'success',
                                                'backgroundColor' => 'success/15',
                                                'borderWidth' => 2,
                                                'fill' => true,
                                                'tension' => 0.4,
                                            ]
                                        ],
                                    ],
                                ]" :height="50" :sparkline="true" />
                            </vibe:card>

                            <vibe:card class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground font-medium">{{ __('docs/chart.sparkline.cards.users_title') }}</span>
                                    <vibe:badge variant="outline" size="sm" class="text-sky-500 border-sky-500/20 bg-sky-500/10 font-semibold">+8.4%</vibe:badge>
                                </div>
                                <div class="text-2xl font-bold text-foreground">{{ __('docs/chart.sparkline.cards.users_val') }}</div>
                                <vibe:chart :config="[
                                    'type' => 'bar',
                                    'data' => [
                                        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
                                        'datasets' => [
                                            [
                                                'data' => [45, 60, 75, 50, 90, 65, 85, 100],
                                                'backgroundColor' => 'info',
                                                'borderRadius' => 4,
                                            ]
                                        ],
                                    ],
                                ]" :height="50" :sparkline="true" />
                            </vibe:card>

                            <vibe:card class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-muted-foreground font-medium">{{ __('docs/chart.sparkline.cards.bounce_title') }}</span>
                                    <vibe:badge variant="outline" size="sm" class="text-amber-500 border-amber-500/20 bg-amber-500/10 font-semibold">-3.2%</vibe:badge>
                                </div>
                                <div class="text-2xl font-bold text-foreground">24.6%</div>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => [1, 2, 3, 4, 5, 6, 7, 8],
                                        'datasets' => [
                                            [
                                                'data' => [65, 59, 50, 48, 42, 38, 30, 24],
                                                'borderColor' => 'warning',
                                                'borderWidth' => 2,
                                                'tension' => 0.4,
                                            ]
                                        ],
                                    ],
                                ]" :height="50" :sparkline="true" />
                            </vibe:card>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Customization: Currency & Dual Axis --}}
            <section id="custom-scales" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.custom_scales.title') }}</h2>
                        <vibe:badge size="sm" variant="outline" class="bg-violet-500/10 text-violet-600 border-violet-500/20">{{ __('docs/chart.custom_scales.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.custom_scales.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.custom_scales.preview_title')">
                    <vibe:preview.code>
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.custom_scales.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.custom_scales.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => __('docs/chart.custom_scales.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.custom_scales.datasets.revenue'),
                                                'data' => [45000000, 52000000, 61000000, 58000000, 74000000, 88000000],
                                                'borderColor' => 'chart-1',
                                                'backgroundColor' => 'chart-1/20',
                                                'borderWidth' => 2,
                                                'fill' => true,
                                                'yAxisID' => 'y',
                                            ],
                                            [
                                                'label' => __('docs/chart.custom_scales.datasets.growth'),
                                                'data' => [12.5, 15.6, 17.3, -4.9, 27.6, 18.9],
                                                'borderColor' => 'chart-3',
                                                'borderWidth' => 2,
                                                'borderDash' => [5, 5],
                                                'yAxisID' => 'y1',
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'scales' => [
                                            'y' => [
                                                'type' => 'linear',
                                                'display' => true,
                                                'position' => 'left',
                                            ],
                                            'y1' => [
                                                'type' => 'linear',
                                                'display' => true,
                                                'position' => 'right',
                                                'grid' => [
                                                    'drawOnChartArea' => false,
                                                ],
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.custom_scales.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/chart.custom_scales.card_desc') }}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => __('docs/chart.custom_scales.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.custom_scales.datasets.revenue'),
                                                'data' => [45000000, 52000000, 61000000, 58000000, 74000000, 88000000],
                                                'borderColor' => 'chart-1',
                                                'backgroundColor' => 'chart-1/20',
                                                'borderWidth' => 2,
                                                'fill' => true,
                                                'yAxisID' => 'y',
                                            ],
                                            [
                                                'label' => __('docs/chart.custom_scales.datasets.growth'),
                                                'data' => [12.5, 15.6, 17.3, -4.9, 27.6, 18.9],
                                                'borderColor' => 'chart-3',
                                                'borderWidth' => 2,
                                                'borderDash' => [5, 5],
                                                'yAxisID' => 'y1',
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'scales' => [
                                            'y' => [
                                                'type' => 'linear',
                                                'display' => true,
                                                'position' => 'left',
                                            ],
                                            'y1' => [
                                                'type' => 'linear',
                                                'display' => true,
                                                'position' => 'right',
                                                'grid' => [
                                                    'drawOnChartArea' => false,
                                                ],
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Customization: Tooltip --}}
            <section id="custom-tooltip" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.custom_tooltip.title') }}</h2>
                        <vibe:badge size="sm" variant="outline" class="bg-amber-500/10 text-amber-600 border-amber-500/20">{{ __('docs/chart.custom_tooltip.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.custom_tooltip.desc') !!}
                    </p>
                </div>

                {{-- Fitur Tooltip Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-amber-500"></span>
                            {{ __('docs/chart.custom_tooltip.features.mode_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.custom_tooltip.features.mode_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                            {{ __('docs/chart.custom_tooltip.features.prefix_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.custom_tooltip.features.prefix_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-sky-500"></span>
                            {{ __('docs/chart.custom_tooltip.features.callbacks_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.custom_tooltip.features.callbacks_desc') !!}
                        </p>
                    </div>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.custom_tooltip.preview_title')">
                    <vibe:preview.code>
                        <vibe:card>
                            <vibe:card.header>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <vibe:card.title>{{ __('docs/chart.custom_tooltip.card_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/chart.custom_tooltip.card_desc') }}</vibe:card.description>
                                    </div>
                                    <vibe:badge variant="outline" class="rounded-full bg-emerald-500/10 text-emerald-600 border-emerald-500/20">
                                        {{ __('docs/chart.custom_tooltip.badge_hover') }}
                                    </vibe:badge>
                                </div>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'bar',
                                    'data' => [
                                        'labels' => __('docs/chart.custom_tooltip.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.custom_tooltip.datasets.revenue'),
                                                'data' => [45000000, 58000000, 62000000, 54000000, 78000000, 92000000],
                                                'borderColor' => 'primary',
                                                'backgroundColor' => 'primary/20',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                            [
                                                'type' => 'line',
                                                'label' => __('docs/chart.custom_tooltip.datasets.profit'),
                                                'data' => [18000000, 24000000, 27000000, 21000000, 36000000, 43000000],
                                                'borderColor' => 'chart-2',
                                                'backgroundColor' => 'chart-2/15',
                                                'borderWidth' => 2.5,
                                                'pointRadius' => 4,
                                                'pointHoverRadius' => 6,
                                                'fill' => false,
                                                'tension' => 0.4,
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'interaction' => [
                                            'mode' => 'index',
                                            'intersect' => false,
                                        ],
                                        'plugins' => [
                                            'tooltip' => [
                                                'mode' => 'index',
                                                'intersect' => false,
                                                'padding' => 12,
                                                'cornerRadius' => 10,
                                                'callbacks' => [
                                                    'label' => 'function(context) { return context.dataset.label + \': Rp \' + context.parsed.y.toLocaleString(\'id-ID\'); }',
                                                    'footer' => 'function(items) { let total = items.reduce((sum, item) => sum + item.parsed.y, 0); return \'Total: Rp \' + total.toLocaleString(\'id-ID\'); }',
                                                ],
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:card>
                            <vibe:card.header>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <vibe:card.title>{{ __('docs/chart.custom_tooltip.card_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/chart.custom_tooltip.card_desc') }}</vibe:card.description>
                                    </div>
                                    <vibe:badge variant="outline" class="rounded-full bg-emerald-500/10 text-emerald-600 border-emerald-500/20">
                                        {{ __('docs/chart.custom_tooltip.badge_hover') }}
                                    </vibe:badge>
                                </div>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart :config="[
                                    'type' => 'bar',
                                    'data' => [
                                        'labels' => __('docs/chart.custom_tooltip.labels'),
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.custom_tooltip.datasets.revenue'),
                                                'data' => [45000000, 58000000, 62000000, 54000000, 78000000, 92000000],
                                                'borderColor' => 'primary',
                                                'backgroundColor' => 'primary/20',
                                                'borderWidth' => 1.5,
                                                'borderRadius' => 6,
                                            ],
                                            [
                                                'type' => 'line',
                                                'label' => __('docs/chart.custom_tooltip.datasets.profit'),
                                                'data' => [18000000, 24000000, 27000000, 21000000, 36000000, 43000000],
                                                'borderColor' => 'chart-2',
                                                'backgroundColor' => 'chart-2/15',
                                                'borderWidth' => 2.5,
                                                'pointRadius' => 4,
                                                'pointHoverRadius' => 6,
                                                'fill' => false,
                                                'tension' => 0.4,
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'interaction' => [
                                            'mode' => 'index',
                                            'intersect' => false,
                                        ],
                                        'plugins' => [
                                            'tooltip' => [
                                                'mode' => 'index',
                                                'intersect' => false,
                                                'padding' => 12,
                                                'cornerRadius' => 10,
                                                'callbacks' => [
                                                    'label' => 'function(context) { return context.dataset.label + \': Rp \' + context.parsed.y.toLocaleString(\'id-ID\'); }',
                                                    'footer' => 'function(items) { let total = items.reduce((sum, item) => sum + item.parsed.y, 0); return \'Total: Rp \' + total.toLocaleString(\'id-ID\'); }',
                                                ],
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Customization: Zoom, Pan & Drag Selection --}}
            <section id="zoom-pan" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.zoom_pan.title') }}</h2>
                        <vibe:badge size="sm" variant="outline" class="bg-indigo-500/10 text-indigo-600 border-indigo-500/20">{{ __('docs/chart.zoom_pan.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.zoom_pan.desc') !!}
                    </p>
                </div>

                {{-- Fitur Zoom & Pan Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-indigo-500"></span>
                            {{ __('docs/chart.zoom_pan.features.wheel_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.zoom_pan.features.wheel_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                            {{ __('docs/chart.zoom_pan.features.pinch_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.zoom_pan.features.pinch_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-sky-500"></span>
                            {{ __('docs/chart.zoom_pan.features.pan_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.zoom_pan.features.pan_desc') !!}
                        </p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-card border border-border space-y-1">
                        <div class="flex items-center gap-1.5 font-semibold text-xs text-foreground">
                            <span class="size-1.5 rounded-full bg-amber-500"></span>
                            {{ __('docs/chart.zoom_pan.features.drag_title') }}
                        </div>
                        <p class="text-[11px] text-muted-foreground leading-normal">
                            {!! __('docs/chart.zoom_pan.features.drag_desc') !!}
                        </p>
                    </div>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.zoom_pan.preview_title')">
                    <vibe:preview.code>
                        <!-- Opsi 1: Menggunakan prop shorthand :zoom="true" -->
                        <vibe:chart :zoom="true" :config="$chartConfig" :height="280" />

                        <!-- Opsi 2: Konfigurasi penuh Zoom, Pan & Drag-to-Select di dalam :config -->
                        <vibe:card>
                            <vibe:card.header>
                                <div class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div>
                                        <vibe:card.title>{{ __('docs/chart.zoom_pan.card_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/chart.zoom_pan.card_desc') }}</vibe:card.description>
                                    </div>
                                    <!-- Toolbar Kontrol Zoom Vibe UI -->
                                    <div class="flex items-center justify-end gap-1.5 shrink-0 sm:ml-auto">
                                        <vibe:button size="sm" variant="outline" class="h-8 px-2.5" onclick="VibeChart.zoom('#chart-zoom-demo', 1.25)">
                                            + Zoom In
                                        </vibe:button>
                                        <vibe:button size="sm" variant="outline" class="h-8 px-2.5" onclick="VibeChart.zoom('#chart-zoom-demo', 0.8)">
                                            - Zoom Out
                                        </vibe:button>
                                        <vibe:button size="sm" variant="outline" class="h-8 px-2.5" onclick="VibeChart.resetZoom('#chart-zoom-demo')">
                                            Reset
                                        </vibe:button>
                                    </div>
                                </div>
                            </vibe:card.header>
                            <vibe:card.content>
                                <vibe:chart id="chart-zoom-demo" :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => ['Sep 1', 'Sep 2', 'Sep 3', '...', 'Sep 30'],
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.zoom_pan.datasets.traffic'),
                                                'data' => [120, 135, 148, 165, 190, 210, 225, 260, 310, 350, 410, 480],
                                                'borderColor' => 'primary',
                                                'backgroundColor' => 'primary/15',
                                                'fill' => true,
                                                'tension' => 0.35,
                                            ],
                                            [
                                                'label' => __('docs/chart.zoom_pan.datasets.server'),
                                                'data' => [45, 50, 52, 55, 62, 68, 72, 78, 89, 95, 102, 115],
                                                'borderColor' => 'chart-3',
                                                'borderDash' => [4, 4],
                                                'tension' => 0.35,
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'plugins' => [
                                            'zoom' => [
                                                'pan' => [
                                                    'enabled' => true,
                                                    'mode' => 'x',
                                                ],
                                                'zoom' => [
                                                    'wheel' => ['enabled' => true],
                                                    'pinch' => ['enabled' => true],
                                                    'mode' => 'x',
                                                    'drag' => [
                                                        'enabled' => false,
                                                        'borderColor' => 'primary',
                                                        'backgroundColor' => 'primary/20',
                                                        'borderWidth' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6" x-data="{
                        dragSelectMode: false,
                        zoomIn() {
                            const c = document.querySelector('#chart-zoom-demo canvas');
                            if (c && window.Chart) {
                                window.Chart.getChart(c)?.zoom(1.25);
                            }
                        },
                        zoomOut() {
                            const c = document.querySelector('#chart-zoom-demo canvas');
                            if (c && window.Chart) {
                                window.Chart.getChart(c)?.zoom(0.8);
                            }
                        },
                        resetZoom() {
                            const c = document.querySelector('#chart-zoom-demo canvas');
                            if (c && window.Chart) {
                                window.Chart.getChart(c)?.resetZoom();
                            }
                        },
                        toggleDragMode() {
                            this.dragSelectMode = !this.dragSelectMode;
                            const c = document.querySelector('#chart-zoom-demo canvas');
                            if (c && window.Chart) {
                                const chart = window.Chart.getChart(c);
                                if (chart?.options?.plugins?.zoom) {
                                    chart.options.plugins.zoom.zoom.drag.enabled = this.dragSelectMode;
                                    chart.options.plugins.zoom.pan.enabled = !this.dragSelectMode;
                                    chart.update('none');
                                }
                            }
                        }
                    }">
                        <vibe:card>
                            <vibe:card.header>
                                <div class="w-full flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div>
                                        <vibe:card.title>{{ __('docs/chart.zoom_pan.card_title') }}</vibe:card.title>
                                        <vibe:card.description>{{ __('docs/chart.zoom_pan.card_desc') }}</vibe:card.description>
                                    </div>

                                    {{-- Interactive Toolbar Controls --}}
                                    <div class="flex flex-wrap sm:flex-nowrap items-center justify-end gap-1.5 select-none shrink-0 sm:ml-auto">
                                        <button
                                            type="button"
                                            @click="toggleDragMode()"
                                            :class="dragSelectMode ? 'bg-primary text-primary-foreground border-primary' : 'bg-background text-foreground border-input hover:bg-accent'"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-lg border cursor-pointer transition-all duration-150 shadow-2xs shrink-0"
                                        >
                                            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <rect x="3" y="3" width="18" height="18" rx="2" stroke-dasharray="4 4" stroke-width="2" />
                                            </svg>
                                            <span x-text="dragSelectMode ? '{{ __('docs/chart.zoom_pan.mode_select') }}' : '{{ __('docs/chart.zoom_pan.mode_pan') }}'"></span>
                                        </button>

                                        <div class="inline-flex items-center rounded-lg border border-border bg-muted/60 p-0.5 text-xs shrink-0">
                                            <button
                                                type="button"
                                                @click="zoomIn()"
                                                class="px-2 py-1 rounded-md text-foreground hover:bg-background hover:shadow-2xs cursor-pointer transition-all"
                                                title="{{ __('docs/chart.zoom_pan.zoom_in_title') }}"
                                            >
                                                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                                </svg>
                                            </button>
                                            <button
                                                type="button"
                                                @click="zoomOut()"
                                                class="px-2 py-1 rounded-md text-foreground hover:bg-background hover:shadow-2xs cursor-pointer transition-all"
                                                title="{{ __('docs/chart.zoom_pan.zoom_out_title') }}"
                                            >
                                                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7" />
                                                </svg>
                                            </button>
                                            <button
                                                type="button"
                                                @click="resetZoom()"
                                                class="px-2 py-1 rounded-md text-foreground hover:bg-background hover:shadow-2xs cursor-pointer transition-all"
                                                title="{{ __('docs/chart.zoom_pan.reset_title') }}"
                                            >
                                                <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </vibe:card.header>
                            <vibe:card.content>
                                @php
                                    $zoomDemoLabels = ['Sep 1', 'Sep 2', 'Sep 3', 'Sep 4', 'Sep 5', 'Sep 6', 'Sep 7', 'Sep 8', 'Sep 9', 'Sep 10', 'Sep 11', 'Sep 12', 'Sep 13', 'Sep 14', 'Sep 15', 'Sep 16', 'Sep 17', 'Sep 18', 'Sep 19', 'Sep 20', 'Sep 21', 'Sep 22', 'Sep 23', 'Sep 24', 'Sep 25', 'Sep 26', 'Sep 27', 'Sep 28', 'Sep 29', 'Sep 30'];
                                    $zoomDemoTraffic = [120, 135, 148, 140, 165, 190, 210, 195, 180, 225, 240, 230, 215, 260, 290, 310, 295, 280, 320, 350, 340, 325, 360, 390, 410, 400, 385, 430, 460, 480];
                                    $zoomDemoServer = [45, 50, 52, 48, 55, 62, 68, 65, 60, 72, 75, 71, 68, 78, 85, 89, 84, 80, 91, 95, 92, 88, 94, 98, 102, 99, 95, 105, 110, 115];
                                @endphp
                                <vibe:chart id="chart-zoom-demo" :config="[
                                    'type' => 'line',
                                    'data' => [
                                        'labels' => $zoomDemoLabels,
                                        'datasets' => [
                                            [
                                                'label' => __('docs/chart.zoom_pan.datasets.traffic'),
                                                'data' => $zoomDemoTraffic,
                                                'borderColor' => 'primary',
                                                'backgroundColor' => 'primary/15',
                                                'borderWidth' => 2,
                                                'fill' => true,
                                                'tension' => 0.35,
                                                'pointRadius' => 2.5,
                                            ],
                                            [
                                                'label' => __('docs/chart.zoom_pan.datasets.server'),
                                                'data' => $zoomDemoServer,
                                                'borderColor' => 'chart-3',
                                                'backgroundColor' => 'chart-3/15',
                                                'borderWidth' => 2,
                                                'borderDash' => [4, 4],
                                                'fill' => false,
                                                'tension' => 0.35,
                                                'pointRadius' => 2.5,
                                            ],
                                        ],
                                    ],
                                    'options' => [
                                        'interaction' => [
                                            'mode' => 'index',
                                            'intersect' => false,
                                        ],
                                        'plugins' => [
                                            'zoom' => [
                                                'pan' => [
                                                    'enabled' => true,
                                                    'mode' => 'x',
                                                ],
                                                'zoom' => [
                                                    'wheel' => ['enabled' => true],
                                                    'pinch' => ['enabled' => true],
                                                    'mode' => 'x',
                                                    'drag' => [
                                                        'enabled' => false,
                                                        'borderColor' => 'primary',
                                                        'backgroundColor' => 'primary/20',
                                                        'borderWidth' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ]" :height="280" />
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 11. Customization: Direct JavaScript API --}}
            <section id="direct-js" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.direct_js.title') }}</h2>
                        <vibe:badge size="sm" variant="outline" class="bg-sky-500/10 text-sky-600 border-sky-500/20">{{ __('docs/chart.direct_js.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/chart.direct_js.desc') !!}
                    </p>
                </div>

                <vibe:preview data-toc-ignore :title="__('docs/chart.direct_js.preview_title')">
                    <vibe:preview.code>
                        {{-- Canvas Element --}}
                        <div class="w-full h-72">
                            <canvas id="standalone-chart"></canvas>
                        </div>

                        {{-- Script JS --}}
                        <script>
                            document.addEventListener('vibe-chart-ready', () => {
                                // VibeChart.create otomatis menerapkan tema Vibe UI & warna app.css
                                VibeChart.create('#standalone-chart', {
                                    type: 'radar',
                                    data: {
                                        labels: @json(__('docs/chart.direct_js.labels')),
                                        datasets: [{
                                                label: 'Vibe UI v2.5',
                                                data: [95, 90, 98, 88, 92, 96],
                                                borderColor: 'primary',
                                                backgroundColor: 'primary/20',
                                                borderWidth: 2,
                                            },
                                            {
                                                label: '{{ __('docs/chart.direct_js.datasets.industry_avg') }}',
                                                data: [70, 75, 68, 65, 80, 78],
                                                borderColor: 'muted-foreground',
                                                backgroundColor: 'muted-foreground/15',
                                                borderWidth: 2,
                                            }
                                        ]
                                    }
                                });
                            });
                        </script>
                    </vibe:preview.code>
                    <div class="w-full p-4 sm:p-6">
                        <vibe:card>
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/chart.direct_js.card_title') }}</vibe:card.title>
                                <vibe:card.description>{!! __('docs/chart.direct_js.card_desc') !!}</vibe:card.description>
                            </vibe:card.header>
                            <vibe:card.content>
                                <div class="w-full h-72 flex items-center justify-center">
                                    <canvas id="standalone-radar-demo" class="max-h-72"></canvas>
                                </div>
                            </vibe:card.content>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 12. Props Reference Table --}}
            <section id="props-reference" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/chart.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/chart.props.desc') }}
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/chart.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/chart.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/chart.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/chart.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $chartProps = [
                                    [':config', 'array | string', 'null', __('docs/chart.props.items.config')],
                                    [':height', 'number | string', '300', __('docs/chart.props.items.height')],
                                    [':sparkline', 'bool', 'false', __('docs/chart.props.items.sparkline')],
                                    [':zoom', 'bool | array', 'false', __('docs/chart.props.items.zoom')],
                                    ['type', 'string', "'line'", __('docs/chart.props.items.type')],
                                    [':data', 'array | string', '[]', __('docs/chart.props.items.data')],
                                    [':options', 'array | string', '[]', __('docs/chart.props.items.options')],
                                    ['options.plugins.tooltip', 'array', '{...}', __('docs/chart.props.items.tooltip')],
                                    ['options.plugins.zoom', 'array', '{...}', __('docs/chart.props.items.plugin_zoom')],
                                    ['VibeChart.zoom()', 'JavaScript API', '-', __('docs/chart.props.items.api_zoom')],
                                    ['VibeChart.resetZoom()', 'JavaScript API', '-', __('docs/chart.props.items.api_reset')],
                                    ['VibeChart.pan()', 'JavaScript API', '-', __('docs/chart.props.items.api_pan')],
                                    ['VibeChart.create()', 'JavaScript API', '-', __('docs/chart.props.items.api_create')],
                                    ['VibeChart.resolveColor()', 'JavaScript API', '-', __('docs/chart.props.items.api_resolve_color')],
                                ];
                            @endphp
                            @foreach ($chartProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar (Right Side) --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>

    {{-- Script for standalone demos --}}
    @push('body')
        <script>
            (function() {
                window.initMethod4Demo = () => {
                    const canvas = document.querySelector('#canvas-pure-js-demo');
                    // Cegah inisialisasi jika canvas tidak ada, Chart belum siap, atau canvas sedang hidden (display: none)
                    if (!canvas || !window.Chart || canvas.offsetParent === null) return;
                    let chart = window.Chart.getChart(canvas);
                    if (!chart && window.VibeChart) {
                        window.VibeChart.create(canvas, {
                            type: 'bar',
                            data: {
                                labels: @json(__('docs/chart.usage.demo.labels')),
                                datasets: [{
                                    label: '{{ __('docs/chart.usage.demo.dataset_label') }}',
                                    data: [8, 19, 34, 58],
                                    borderColor: 'destructive',
                                    backgroundColor: 'destructive/20',
                                    borderWidth: 1.5,
                                    borderRadius: 6,
                                }],
                            },
                        });
                    } else if (chart) {
                        chart.resize();
                    }
                };

                const initDemos = () => {
                    // 1. Inisialisasi Demo Metode 4 HANYA jika tab Metode 4 sedang aktif / elemen terlihat
                    window.initMethod4Demo();

                    // 2. Inisialisasi Demo Radar Standalone
                    const radarCanvas = document.querySelector('#standalone-radar-demo');
                    if (window.VibeChart && radarCanvas && radarCanvas.offsetParent !== null) {
                        const existing = window.Chart ? window.Chart.getChart(radarCanvas) : null;
                        if (!existing) {
                            window.VibeChart.create(radarCanvas, {
                                type: 'radar',
                                data: {
                                    labels: @json(__('docs/chart.direct_js.labels')),
                                    datasets: [{
                                            label: 'Vibe UI',
                                            data: [95, 90, 98, 88, 92, 96],
                                            borderColor: 'primary',
                                            backgroundColor: 'primary/20',
                                            borderWidth: 2,
                                        },
                                        {
                                            label: '{{ __('docs/chart.direct_js.datasets.industry_avg') }}',
                                            data: [70, 75, 68, 65, 80, 78],
                                            borderColor: 'muted-foreground',
                                            backgroundColor: 'muted-foreground/15',
                                            borderWidth: 2,
                                        }
                                    ]
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                            align: 'center'
                                        }
                                    }
                                }
                            });
                        }
                    }
                };

                const runInit = () => {
                    if (window.VibeChart) {
                        initDemos();
                    } else {
                        window.addEventListener('vibe-chart-ready', initDemos, {
                            once: true
                        });
                    }
                };

                // Lifecycle hooks untuk direct reload dan Livewire wire:navigate
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', runInit, { once: true });
                } else {
                    setTimeout(runInit, 50);
                }

                document.addEventListener('livewire:navigated', runInit);

                document.addEventListener('livewire:navigating', () => {
                    const radar = document.querySelector('#standalone-radar-demo');
                    if (radar && window.Chart) {
                        try {
                            window.Chart.getChart(radar)?.destroy();
                        } catch (e) {}
                    }
                    const m4 = document.querySelector('#canvas-pure-js-demo');
                    if (m4 && window.Chart) {
                        try {
                            window.Chart.getChart(m4)?.destroy();
                        } catch (e) {}
                    }
                });
            })();
        </script>
    @endpush
</x-docs.layouts.sidebar>
