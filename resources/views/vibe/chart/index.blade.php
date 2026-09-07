@blaze(fold: true)

@props([
    'id' => null,
    'config' => null,
    'type' => 'line',
    'data' => null,
    'options' => null,
    'height' => 300,
    'sparkline' => false,
    'zoom' => false,
])

@php
    $chartId = $id ?? 'chart-' . Str::random(8);

    // Build the configuration
    if ($config !== null) {
        $finalConfig = is_string($config) ? json_decode($config, true) ?? [] : $config;
    } else {
        $finalConfig = [
            'type' => $type,
            'data' => is_string($data) ? json_decode($data, true) ?? [] : ($data ?? []),
            'options' => is_string($options) ? json_decode($options, true) ?? [] : ($options ?? []),
        ];
    }

    if ($sparkline) {
        $finalConfig['options'] = $finalConfig['options'] ?? [];
        $finalConfig['options']['plugins'] = $finalConfig['options']['plugins'] ?? [];
        $finalConfig['options']['plugins']['legend'] = ['display' => false];
        $finalConfig['options']['scales'] = [
            'x' => ['display' => false],
            'y' => ['display' => false],
        ];
    }

    if ($zoom) {
        $finalConfig['options'] = $finalConfig['options'] ?? [];
        $finalConfig['options']['plugins'] = $finalConfig['options']['plugins'] ?? [];
        $defaultZoomConfig = [
            'pan' => [
                'enabled' => true,
                'mode' => 'x',
            ],
            'zoom' => [
                'wheel' => ['enabled' => true],
                'pinch' => ['enabled' => true],
                'mode' => 'x',
            ],
        ];
        if (is_array($zoom)) {
            $finalConfig['options']['plugins']['zoom'] = array_replace_recursive($defaultZoomConfig, $zoom);
        } else {
            $finalConfig['options']['plugins']['zoom'] = $finalConfig['options']['plugins']['zoom'] ?? $defaultZoomConfig;
        }
    }

    $heightStyle = is_numeric($height) ? "min-height: {$height}px; height: {$height}px;" : "min-height: {$height}; height: {$height};";

    $configJson = !empty($finalConfig) ? json_encode($finalConfig, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) : '{}';
@endphp

@pushOnce('body', 'vibe-chart')
    @vite(['resources/css/vibe/chart.css', 'resources/js/vibe/chart.js'])
@endPushOnce

<div
    id="{{ $chartId }}"
    data-vibe-chart
    {{ $attributes->twMerge(['class' => 'vibe-chart-wrapper relative w-full overflow-hidden transition-all duration-200 select-none']) }}
    style="{{ $heightStyle }}"
    x-data="typeof vibeChart !== 'undefined' ? vibeChart({{ $configJson }}) : {
        loading: true,
        init() {
            window.addEventListener('vibe-chart-ready', () => {
                let instance = window.vibeChart({{ $configJson }});
                Object.assign(this, instance);
                this.$nextTick(() => {
                    this.renderChart();
                    this.setupThemeListener();
                });
                if (typeof this.$cleanup === 'function') {
                    this.$cleanup(() => this.destroy());
                }
            }, { once: true });
        }
    }"
>
    {{-- Shimmer Skeleton Placeholder while loading --}}
    <div
        x-show="loading"
        x-cloak
        class="vibe-chart-skeleton absolute inset-0 z-10 flex flex-col justify-end gap-2 p-3 bg-card/40 backdrop-blur-[1px] rounded-xl pointer-events-none"
    >
        <div class="w-full h-full flex items-end gap-2.5 pb-2 px-2">
            <div class="flex-1 bg-muted/40 rounded-t-md h-[40%] animate-pulse"></div>
            <div class="flex-1 bg-muted/50 rounded-t-md h-[70%] animate-pulse"></div>
            <div class="flex-1 bg-muted/30 rounded-t-md h-[55%] animate-pulse"></div>
            <div class="flex-1 bg-muted/60 rounded-t-md h-[85%] animate-pulse"></div>
            <div class="flex-1 bg-muted/40 rounded-t-md h-[60%] animate-pulse"></div>
            <div class="flex-1 bg-muted/50 rounded-t-md h-[95%] animate-pulse"></div>
        </div>
    </div>

    {{-- HTML5 Canvas Render Target --}}
    <canvas
        x-ref="canvas"
        class="w-full h-full relative z-0"
    ></canvas>
</div>
