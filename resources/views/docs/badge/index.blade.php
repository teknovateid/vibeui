<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/badge.title')" :description="__('docs/badge.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/badge.title'), 'url' => '/docs/badge']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/badge.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/badge.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/badge.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/badge.description') }}
                </p>

                {{-- Quick Variants Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'accent', 'destructive', 'success', 'warning', 'info'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg', 'xl'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:badge>{{ __('docs/badge.basic_usage.default') }}</vibe:badge>
<vibe:badge variant="primary">{{ __('docs/badge.basic_usage.primary') }}</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge>{{ __('docs/badge.basic_usage.default') }}</vibe:badge>
                        <vibe:badge variant="primary">{{ __('docs/badge.basic_usage.primary') }}</vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.variants.preview_title')">
                    <vibe:preview.code>
<vibe:badge variant="default">Default</vibe:badge>
<vibe:badge variant="primary">Primary</vibe:badge>
<vibe:badge variant="secondary">Secondary</vibe:badge>
<vibe:badge variant="outline">Outline</vibe:badge>
<vibe:badge variant="ghost">Ghost</vibe:badge>
<vibe:badge variant="accent">Accent</vibe:badge>
<vibe:badge variant="destructive">Destructive</vibe:badge>
<vibe:badge variant="success">Success</vibe:badge>
<vibe:badge variant="warning">Warning</vibe:badge>
<vibe:badge variant="info">Info</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        @foreach (['default', 'primary', 'secondary', 'outline', 'ghost', 'accent', 'destructive', 'success', 'warning', 'info'] as $variant)
                            <vibe:badge :variant="$variant">{{ __('docs/badge.variants.items.' . $variant) }}</vibe:badge>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.sizes.preview_title')">
                    <vibe:preview.code>
<vibe:badge size="sm" variant="primary">Small (sm)</vibe:badge>
<vibe:badge size="md" variant="primary">Medium (md)</vibe:badge>
<vibe:badge size="lg" variant="primary">Large (lg)</vibe:badge>
<vibe:badge size="xl" variant="primary">Extra Large (xl)</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge size="sm" variant="primary">Small (sm)</vibe:badge>
                        <vibe:badge size="md" variant="primary">Medium (md)</vibe:badge>
                        <vibe:badge size="lg" variant="primary">Large (lg)</vibe:badge>
                        <vibe:badge size="xl" variant="primary">Extra Large (xl)</vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Pill Style --}}
            <section id="gaya-pill" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.pill.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.pill.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.pill.preview_title')">
                    <vibe:preview.code>
<vibe:badge class="rounded-full" variant="primary">Primary Pill</vibe:badge>
<vibe:badge class="rounded-full" variant="secondary">Secondary Pill</vibe:badge>
<vibe:badge class="rounded-full" variant="success">Success Pill</vibe:badge>
<vibe:badge class="rounded-full" variant="warning">Warning Pill</vibe:badge>
<vibe:badge class="rounded-full" variant="outline">Outline Pill</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge class="rounded-full" variant="primary">Primary Pill</vibe:badge>
                        <vibe:badge class="rounded-full" variant="secondary">Secondary Pill</vibe:badge>
                        <vibe:badge class="rounded-full" variant="success">Success Pill</vibe:badge>
                        <vibe:badge class="rounded-full" variant="warning">Warning Pill</vibe:badge>
                        <vibe:badge class="rounded-full" variant="outline">Outline Pill</vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Status Dot --}}
            <section id="status-dot" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.dot.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.dot.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.dot.preview_title')">
                    <vibe:preview.code>
<vibe:badge variant="success" dot dotPulse>{{ __('docs/badge.dot.online') }}</vibe:badge>
<vibe:badge variant="warning" dot dotPulse>{{ __('docs/badge.dot.away') }}</vibe:badge>
<vibe:badge variant="destructive" dot>{{ __('docs/badge.dot.offline') }}</vibe:badge>
<vibe:badge variant="info" dot>{{ __('docs/badge.dot.maintenance') }}</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge variant="success" dot dotPulse>{{ __('docs/badge.dot.online') }}</vibe:badge>
                        <vibe:badge variant="warning" dot dotPulse>{{ __('docs/badge.dot.away') }}</vibe:badge>
                        <vibe:badge variant="destructive" dot>{{ __('docs/badge.dot.offline') }}</vibe:badge>
                        <vibe:badge variant="info" dot>{{ __('docs/badge.dot.maintenance') }}</vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Icons & Prefix / Suffix --}}
            <section id="ikon-dan-addon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.icons_addons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.icons_addons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.icons_addons.preview_title')">
                    <vibe:preview.code>
{{-- Leading Icon --}}
<vibe:badge variant="primary">
    <x-slot:icon>
        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
        </svg>
    </x-slot:icon>
    Featured
</vibe:badge>

{{-- Trailing Icon --}}
<vibe:badge variant="secondary">
    Verified
    <x-slot:trailingIcon>
        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 6 9 17l-5-5"/>
        </svg>
    </x-slot:trailingIcon>
</vibe:badge>

{{-- Prefix and Suffix --}}
<vibe:badge variant="outline" prefix="$" suffix="USD">99.00</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge variant="primary">
                            <x-slot:icon>
                                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                </svg>
                            </x-slot:icon>
                            Featured
                        </vibe:badge>

                        <vibe:badge variant="secondary">
                            Verified
                            <x-slot:trailingIcon>
                                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                            </x-slot:trailingIcon>
                        </vibe:badge>

                        <vibe:badge variant="outline" prefix="$" suffix="USD">99.00</vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Dismissible --}}
            <section id="badge-dismissible" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.dismissible.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.dismissible.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.dismissible.preview_title')">
                    <vibe:preview.code>
<vibe:badge variant="secondary" dismissible>Laravel</vibe:badge>
<vibe:badge variant="secondary" dismissible>TailwindCSS</vibe:badge>
<vibe:badge variant="secondary" dismissible>Livewire</vibe:badge>
<vibe:badge variant="primary" dismissible>AlpineJS</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge variant="secondary" dismissible>Laravel</vibe:badge>
                        <vibe:badge variant="secondary" dismissible>TailwindCSS</vibe:badge>
                        <vibe:badge variant="secondary" dismissible>Livewire</vibe:badge>
                        <vibe:badge variant="primary" dismissible>AlpineJS</vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Badge as Link --}}
            <section id="badge-link" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.link.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.link.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/badge.link.preview_title')">
                    <vibe:preview.code>
<vibe:badge href="/docs/button" variant="accent">
    {{ __('docs/badge.link.changelog') }}
    <x-slot:trailingIcon>
        <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
    </x-slot:trailingIcon>
</vibe:badge>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:badge href="/docs/button" variant="accent">
                            {{ __('docs/badge.link.changelog') }}
                            <x-slot:trailingIcon>
                                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14M12 5l7 7-7 7"/>
                                </svg>
                            </x-slot:trailingIcon>
                        </vibe:badge>
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Props Reference Table --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/badge.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/badge.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/badge.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/badge.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/badge.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/badge.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $badgeProps = [
                                ['variant', "'default'|'primary'|'secondary'|'outline'|'ghost'|'accent'|'destructive'|'success'|'warning'|'info'", "'default'", 'Skema warna dan varian visual badge.'],
                                ['size', "'sm'|'md'|'lg'|'xl'", "'md'", 'Ukuran tinggi, padding horizontal, dan ukuran tipografi badge.'],
                                ['icon', 'string|slot|null', 'null', 'Ikon visual yang disisipkan di sisi kiri (leading icon).'],
                                ['trailingIcon', 'string|slot|null', 'null', 'Ikon visual yang disisipkan di sisi kanan (trailing icon).'],
                                ['prefix', 'string|null', 'null', 'Teks awalan sebelum slot utama (misal simbol mata uang).'],
                                ['suffix', 'string|null', 'null', 'Teks akhiran setelah slot utama.'],
                                ['dot', 'bool', 'false', 'Menampilkan titik indikator status di sisi kiri.'],
                                ['dotPulse', 'bool', 'false', 'Menambahkan efek animasi ping radar pada status dot.'],
                                ['dismissible', 'bool', 'false', 'Menampilkan tombol hapus interaktif di sisi kanan badge.'],
                                ['href', 'string|null', 'null', 'Jika diisi, badge otomatis dirender sebagai hyperlink `<a wire:navigate>`.'],
                                ['class', 'string|null', 'null', 'Kelas Tailwind tambahan via `twMerge` (misal `rounded-full` untuk gaya pill).'],
                            ];
                        @endphp
                        @foreach ($badgeProps as [$prop, $type, $default, $desc])
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
                <p class="text-sm font-semibold text-foreground pt-2">{{ __('docs/badge.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/badge.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/badge.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">default ($slot)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Teks label atau konten utama yang ditampilkan di dalam badge.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">icon</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Slot untuk ikon kustom di sisi depan (leading).</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">trailingIcon</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Slot untuk ikon kustom di sisi belakang (trailing).</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
