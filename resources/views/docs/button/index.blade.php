<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/button.title')" :description="__('docs/button.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/button.title'), 'url' => '/docs/button']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/button.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/button.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/button.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/button.description') }}
                </p>

                {{-- Quick Variants Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'surface', 'accent', 'destructive', 'success', 'warning', 'info', 'link'] as $v)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $v }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:button>
    {{ __('docs/button.basic_usage.default_btn') }}
</vibe:button>

<vibe:button variant="primary">
    {{ __('docs/button.basic_usage.primary_btn') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:button>{{ __('docs/button.basic_usage.default_btn') }}</vibe:button>
                        <vibe:button variant="primary">{{ __('docs/button.basic_usage.primary_btn') }}</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.variants.preview_title')">
                    <vibe:preview.code>
{{-- Core Variants --}}
<vibe:button variant="default">{{ __('docs/button.variants.items.default') }}</vibe:button>
<vibe:button variant="primary">{{ __('docs/button.variants.items.primary') }}</vibe:button>
<vibe:button variant="secondary">{{ __('docs/button.variants.items.secondary') }}</vibe:button>
<vibe:button variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
<vibe:button variant="ghost">{{ __('docs/button.variants.items.ghost') }}</vibe:button>
<vibe:button variant="surface">{{ __('docs/button.variants.items.surface') }}</vibe:button>
<vibe:button variant="accent">{{ __('docs/button.variants.items.accent') }}</vibe:button>

{{-- Feedback / Status Variants --}}
<vibe:button variant="destructive">{{ __('docs/button.variants.items.destructive') }}</vibe:button>
<vibe:button variant="success">{{ __('docs/button.variants.items.success') }}</vibe:button>
<vibe:button variant="warning">{{ __('docs/button.variants.items.warning') }}</vibe:button>
<vibe:button variant="info">{{ __('docs/button.variants.items.info') }}</vibe:button>

{{-- Link Variant --}}
<vibe:button variant="link">{{ __('docs/button.variants.items.link') }}</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'surface', 'accent', 'destructive', 'success', 'warning', 'info', 'link'] as $v)
                            <vibe:button :variant="$v">{{ __('docs/button.variants.items.' . $v) }}</vibe:button>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.sizes.preview_title')">
                    <vibe:preview.code>
<vibe:button size="xs" variant="primary">Extra Small (xs)</vibe:button>
<vibe:button size="sm" variant="primary">Small (sm)</vibe:button>
<vibe:button size="md" variant="primary">Medium (md)</vibe:button>
<vibe:button size="lg" variant="primary">Large (lg)</vibe:button>
<vibe:button size="xl" variant="primary">Extra Large (xl)</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button size="xs" variant="primary">Extra Small (xs)</vibe:button>
                        <vibe:button size="sm" variant="primary">Small (sm)</vibe:button>
                        <vibe:button size="md" variant="primary">Medium (md)</vibe:button>
                        <vibe:button size="lg" variant="primary">Large (lg)</vibe:button>
                        <vibe:button size="xl" variant="primary">Extra Large (xl)</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Icons & Addons --}}
            <section id="tombol-ikon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.icons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.icons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.icons.preview_title')">
                    <vibe:preview.code>
{{-- Leading Icon --}}
<vibe:button variant="primary">
    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14" />
        <path d="M12 5v14" />
    </svg>
    {{ __('docs/button.icons.download') }}
</vibe:button>

{{-- Trailing Icon --}}
<vibe:button variant="outline">
    {{ __('docs/button.icons.continue') }}
    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14" />
        <path d="m12 5 7 7-7 7" />
    </svg>
</vibe:button>

{{-- Icon-Only Buttons (xs, sm, md, lg) --}}
<vibe:button size="icon-xs" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
    </svg>
</vibe:button>
<vibe:button size="icon-sm" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
    <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
    </svg>
</vibe:button>
<vibe:button size="icon-md" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
    </svg>
</vibe:button>
<vibe:button size="icon-lg" variant="secondary" aria-label="{{ __('docs/button.icons.filter') }}">
    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
    </svg>
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="primary">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            {{ __('docs/button.icons.download') }}
                        </vibe:button>

                        <vibe:button variant="outline">
                            {{ __('docs/button.icons.continue') }}
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </vibe:button>

                        <vibe:button size="icon-xs" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-sm" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-md" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                        <vibe:button size="icon-lg" variant="secondary" :aria-label="__('docs/button.icons.filter')">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Pill Style --}}
            <section id="pill-style" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.pill.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.pill.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.pill.preview_title')">
                    <vibe:preview.code>
<vibe:button class="rounded-full" variant="primary">{{ __('docs/button.pill.popular') }}</vibe:button>
<vibe:button class="rounded-full" variant="secondary">{{ __('docs/button.pill.explore') }}</vibe:button>
<vibe:button class="rounded-full" variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
<vibe:button class="rounded-full" variant="accent">{{ __('docs/button.variants.items.accent') }}</vibe:button>

{{-- Circular Icon Button --}}
<vibe:button class="rounded-full" size="icon-md" variant="primary" aria-label="Add Item">
    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14" />
        <path d="M12 5v14" />
    </svg>
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button class="rounded-full" variant="primary">{{ __('docs/button.pill.popular') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="secondary">{{ __('docs/button.pill.explore') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
                        <vibe:button class="rounded-full" variant="accent">{{ __('docs/button.variants.items.accent') }}</vibe:button>
                        <vibe:button class="rounded-full" size="icon-md" variant="primary" aria-label="Add Item">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Loading State --}}
            <section id="status-loading" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.loading.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.loading.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.loading.preview_title')">
                    <vibe:preview.code>
<vibe:button loading variant="primary">
    {{ __('docs/button.loading.saving') }}
</vibe:button>

<vibe:button loading variant="outline">
    {{ __('docs/button.loading.deleting') }}
</vibe:button>

<vibe:button loading variant="secondary" size="icon-md" aria-label="Loading action">
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button loading variant="primary">
                            {{ __('docs/button.loading.saving') }}
                        </vibe:button>
                        <vibe:button loading variant="outline">
                            {{ __('docs/button.loading.deleting') }}
                        </vibe:button>
                        <vibe:button loading variant="secondary" size="icon-md" aria-label="Loading action">
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Disabled State & Type --}}
            <section id="status-disabled" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.status.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.status.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.status.preview_title')">
                    <vibe:preview.code>
{{-- Disabled Buttons --}}
<vibe:button disabled variant="primary">{{ __('docs/button.status.disabled') }}</vibe:button>
<vibe:button disabled variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
<vibe:button disabled variant="destructive">{{ __('docs/button.variants.items.destructive') }}</vibe:button>

{{-- HTML Form Button Types --}}
<vibe:button type="submit" variant="primary">{{ __('docs/button.status.submit') }}</vibe:button>
<vibe:button type="reset" variant="secondary">{{ __('docs/button.status.reset') }}</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button disabled variant="primary">{{ __('docs/button.status.disabled') }}</vibe:button>
                        <vibe:button disabled variant="outline">{{ __('docs/button.variants.items.outline') }}</vibe:button>
                        <vibe:button disabled variant="destructive">{{ __('docs/button.variants.items.destructive') }}</vibe:button>
                        <vibe:button type="submit" variant="primary">{{ __('docs/button.status.submit') }}</vibe:button>
                        <vibe:button type="reset" variant="secondary">{{ __('docs/button.status.reset') }}</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Button as Link --}}
            <section id="tombol-link" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.link.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.link.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.link.preview_title')">
                    <vibe:preview.code>
{{-- Rendered as <a wire:navigate href="..."> --}}
<vibe:button href="/docs" variant="primary">
    {{ __('docs/button.link.docs') }}
</vibe:button>

<vibe:button href="/docs/input" variant="outline">
    Explore Input
    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M5 12h14" />
        <path d="m12 5 7 7-7 7" />
    </svg>
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button href="/docs" variant="primary">
                            {{ __('docs/button.link.docs') }}
                        </vibe:button>
                        <vibe:button href="/docs/input" variant="outline">
                            Explore Input
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Livewire Integration --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.livewire.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/button.livewire.preview_title')">
                    <vibe:preview.code>
{{-- In Blade template --}}
<vibe:button wire:click="save" wire:loading.attr="disabled" wire:target="save" variant="primary">
    {{ __('docs/button.livewire.sync') }}
</vibe:button>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3 justify-center">
                        <vibe:button variant="primary">
                            {{ __('docs/button.livewire.sync') }}
                        </vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/button.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/button.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/button.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $props = [
                                ['variant', "'default'|'primary'|'secondary'|'outline'|'ghost'|'surface'|'accent'|'destructive'|'success'|'warning'|'info'|'link'", "'default'", 'Skema warna dan gaya tombol visual.'],
                                ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'icon-xs'|'icon-sm'|'icon-md'|'icon-lg'", "'md'", 'Ukuran tinggi, padding, dan font tombol.'],
                                ['type', "'button'|'submit'|'reset'", "'button'", 'Atribut tipe tombol HTML standar (jika bukan link).'],
                                ['href', 'string|null', 'null', 'Jika diisi, tombol dirender sebagai link `<a wire:navigate>`.'],
                                ['loading', 'bool', 'false', 'Menampilkan animasi spinner loading bawaan dan menonaktifkan klik.'],
                                ['disabled', 'bool', 'false', 'Menonaktifkan tombol serta menerapkan pengurangan opasitas.'],
                                ['class', 'string|null', 'null', 'Kelas Tailwind tambahan yang dimerge via `twMerge` (misal: `rounded-full` untuk gaya pill).']
                            ];
                        @endphp
                        @foreach ($props as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Slots table --}}
                <p class="text-sm font-semibold text-foreground pt-2">{{ __('docs/button.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/button.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/button.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">default ($slot)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Label tombol, teks utama, atau kombinasi ikon SVG dan teks di dalam tombol.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
