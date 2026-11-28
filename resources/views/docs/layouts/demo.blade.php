@php
    $componentName = "docs.layouts.{$style}";
@endphp

<x-dynamic-component :component="$componentName">
    <vibe:seo :title="__('docs/layouts.demo.title') . ' — ' . $style" :description="__('docs/layouts.demo.sample_card_desc')" />

    <div class="mx-auto w-full max-w-5xl space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" size="sm" class="font-mono">{{ $style }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/layouts.demo.subtitle', ['style' => $style]) }}</span>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground">{{ __('docs/layouts.demo.title') }}</h1>
            </div>

            <vibe:button href="{{ route('docs.layouts.index') }}" variant="outline" size="sm">
                {{ __('docs/layouts.demo.back_to_docs') }}
            </vibe:button>
        </div>

        <vibe:card class="p-5 space-y-4">
            <p class="text-sm text-muted-foreground">{{ __('docs/layouts.demo.switch_hint') }}</p>
            <div class="flex flex-wrap items-center gap-2">
                @foreach (['sidebar' => 'Modern Sidebar', 'sidebar-classic' => 'Classic Sidebar', 'topbar' => 'Horizontal Topbar'] as $key => $label)
                    <vibe:button
                        href="{{ route('docs.layouts.demo', $key) }}"
                        :variant="$style === $key ? 'primary' : 'outline'"
                        size="sm"
                    >
                        {{ $label }}
                    </vibe:button>
                @endforeach
            </div>
        </vibe:card>

        <vibe:card class="p-6 space-y-2">
            <h2 class="text-lg font-semibold text-foreground">{{ __('docs/layouts.demo.sample_card_title') }}</h2>
            <p class="text-sm text-muted-foreground leading-relaxed">
                {{ __('docs/layouts.demo.sample_card_desc') }}
            </p>
            <div class="pt-2 flex flex-wrap gap-2 text-xs font-mono">
                <vibe:badge variant="secondary">data-vibe-layout="{{ $style }}"</vibe:badge>
                <vibe:badge variant="outline">resources/css/vibe/layouts/{{ $style }}.css</vibe:badge>
                <vibe:badge variant="outline">resources/js/vibe/layouts/{{ $style }}.js</vibe:badge>
            </div>
        </vibe:card>
    </div>
</x-dynamic-component>
