<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/input.title')" :description="__('docs/input.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/input.title'), 'url' => '/docs/input']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">{{ __('docs/input.badge') }}</span>
                    <span class="text-xs text-muted-foreground">{{ __('docs/input.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/input.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/input.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['outline', 'filled', 'flush', 'ghost', 'accent'] as $v)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $v }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg', 'xl'] as $s)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $s }}</span>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:input name="full_name" label="{{ __('docs/input.basic_usage.label') }}" placeholder="{{ __('docs/input.basic_usage.placeholder') }}" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:input name="full_name" :label="__('docs/input.basic_usage.label')" :placeholder="__('docs/input.basic_usage.placeholder')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Variants --}}
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.variants.preview_title')">
                    <vibe:preview.code>
{{-- outline (default) --}}
<vibe:input variant="outline" label="{{ __('docs/input.variants.outline.label') }}" placeholder="{{ __('docs/input.variants.outline.placeholder') }}" />

{{-- filled --}}
<vibe:input variant="filled" label="{{ __('docs/input.variants.filled.label') }}" placeholder="{{ __('docs/input.variants.filled.placeholder') }}" />

{{-- flush --}}
<vibe:input variant="flush" label="{{ __('docs/input.variants.flush.label') }}" placeholder="{{ __('docs/input.variants.flush.placeholder') }}" />

{{-- ghost --}}
<vibe:input variant="ghost" label="{{ __('docs/input.variants.ghost.label') }}" placeholder="{{ __('docs/input.variants.ghost.placeholder') }}" />

{{-- accent --}}
<vibe:input variant="accent" label="{{ __('docs/input.variants.accent.label') }}" placeholder="{{ __('docs/input.variants.accent.placeholder') }}" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input variant="outline" :label="__('docs/input.variants.outline.label')" :placeholder="__('docs/input.variants.outline.placeholder')" />
                        <vibe:input variant="filled" :label="__('docs/input.variants.filled.label')" :placeholder="__('docs/input.variants.filled.placeholder')" />
                        <vibe:input variant="flush" :label="__('docs/input.variants.flush.label')" :placeholder="__('docs/input.variants.flush.placeholder')" />
                        <vibe:input variant="ghost" :label="__('docs/input.variants.ghost.label')" :placeholder="__('docs/input.variants.ghost.placeholder')" />
                        <vibe:input variant="accent" :label="__('docs/input.variants.accent.label')" :placeholder="__('docs/input.variants.accent.placeholder')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.sizes.preview_title')">
                    <vibe:preview.code>
<vibe:input size="sm" label="{{ __('docs/input.sizes.sm.label') }}" placeholder="{{ __('docs/input.sizes.sm.placeholder') }}" />
<vibe:input size="md" label="{{ __('docs/input.sizes.md.label') }}" placeholder="{{ __('docs/input.sizes.md.placeholder') }}" />
<vibe:input size="lg" label="{{ __('docs/input.sizes.lg.label') }}" placeholder="{{ __('docs/input.sizes.lg.placeholder') }}" />
<vibe:input size="xl" label="{{ __('docs/input.sizes.xl.label') }}" placeholder="{{ __('docs/input.sizes.xl.placeholder') }}" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input size="sm" :label="__('docs/input.sizes.sm.label')" :placeholder="__('docs/input.sizes.sm.placeholder')" />
                        <vibe:input size="md" :label="__('docs/input.sizes.md.label')" :placeholder="__('docs/input.sizes.md.placeholder')" />
                        <vibe:input size="lg" :label="__('docs/input.sizes.lg.label')" :placeholder="__('docs/input.sizes.lg.placeholder')" />
                        <vibe:input size="xl" :label="__('docs/input.sizes.xl.label')" :placeholder="__('docs/input.sizes.xl.placeholder')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Icons & Addons --}}
            <section id="ikon-dan-addon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.icons_addons.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.icons_addons.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.icons_addons.preview_title')">
                    <vibe:preview.code>
{{-- Leading icon (slot) --}}
<vibe:input label="{{ __('docs/input.icons_addons.search.label') }}" placeholder="{{ __('docs/input.icons_addons.search.placeholder') }}">
    <x-slot:icon>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
        </svg>
    </x-slot:icon>
</vibe:input>

{{-- Trailing icon (slot) --}}
<vibe:input type="email" label="Email" placeholder="name@email.com">
    <x-slot:trailingIcon>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect width="20" height="16" x="2" y="4" rx="2" />
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
        </svg>
    </x-slot:trailingIcon>
</vibe:input>

{{-- Prefix text --}}
<vibe:input label="{{ __('docs/input.icons_addons.website.label') }}" placeholder="{{ __('docs/input.icons_addons.website.placeholder') }}" prefix="https://" suffix=".com" />

{{-- Suffix text --}}
<vibe:input label="{{ __('docs/input.icons_addons.price.label') }}" type="number" placeholder="{{ __('docs/input.icons_addons.price.placeholder') }}" prefix="$" suffix="/month" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input :label="__('docs/input.icons_addons.search.label')" :placeholder="__('docs/input.icons_addons.search.placeholder')">
                            <x-slot:icon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </x-slot:icon>
                        </vibe:input>
                        <vibe:input type="email" label="Email" placeholder="name@email.com">
                            <x-slot:trailingIcon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            </x-slot:trailingIcon>
                        </vibe:input>
                        <vibe:input :label="__('docs/input.icons_addons.website.label')" :placeholder="__('docs/input.icons_addons.website.placeholder')" prefix="https://" suffix=".com" />
                        <vibe:input :label="__('docs/input.icons_addons.price.label')" type="number" :placeholder="__('docs/input.icons_addons.price.placeholder')" prefix="$" suffix="/month" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Pill Style --}}
            <section id="pill-style" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.pill.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.pill.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.pill.preview_title')">
                    <vibe:preview.code>
<vibe:input class="rounded-full" label="Search" placeholder="{{ __('docs/input.pill.placeholder') }}">
    <x-slot:icon>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
        </svg>
    </x-slot:icon>
</vibe:input>

<vibe:input class="rounded-full" variant="filled" label="Filled Pill" placeholder="Rounded filled..." />
<vibe:input class="rounded-full" variant="accent" label="Accent Pill" placeholder="Rounded accent..." />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input class="rounded-full" label="Search" :placeholder="__('docs/input.pill.placeholder')">
                            <x-slot:icon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </x-slot:icon>
                        </vibe:input>
                        <vibe:input class="rounded-full" variant="filled" label="Filled Pill" placeholder="Rounded filled..." />
                        <vibe:input class="rounded-full" variant="accent" label="Accent Pill" placeholder="Rounded accent..." />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Helper & Description --}}
            <section id="deskripsi-dan-bantuan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.helper.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.helper.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.helper.preview_title')">
                    <vibe:preview.code>
<vibe:input name="email" type="email" label="{{ __('docs/input.helper.label') }}" description="{{ __('docs/input.helper.description') }}" info="{{ __('docs/input.helper.info') }}" placeholder="{{ __('docs/input.helper.placeholder') }}" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:input name="email" type="email" :label="__('docs/input.helper.label')" :description="__('docs/input.helper.description')" :info="__('docs/input.helper.info')" :placeholder="__('docs/input.helper.placeholder')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Error & Validation --}}
            <section id="error-dan-validasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.error.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.error.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.error.preview_title')">
                    <vibe:preview.code>
{{-- Error from prop directly --}}
<vibe:input name="password" type="password" label="Password" value="12345" error="{{ __('docs/input.error.message') }}" />

{{-- Error with placeholder --}}
<vibe:input name="phone" label="Phone Number" error="{{ __('docs/input.error.message') }}" placeholder="+1 (555) 000-0000" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input name="password" type="password" label="Password" value="12345" :error="__('docs/input.error.message')" />
                        <vibe:input name="phone" label="Phone Number" :error="__('docs/input.error.message')" placeholder="+1 (555) 000-0000" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Status: Disabled & Readonly --}}
            <section id="status-input" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.status.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.status.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.status.preview_title')">
                    <vibe:preview.code>
{{-- Disabled --}}
<vibe:input label="{{ __('docs/input.status.disabled_label') }}" value="USR-994821" disabled />

{{-- Readonly --}}
<vibe:input label="{{ __('docs/input.status.readonly_label') }}" value="VIBE-REF-2025" readonly />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input :label="__('docs/input.status.disabled_label')" value="USR-994821" disabled />
                        <vibe:input :label="__('docs/input.status.readonly_label')" value="VIBE-REF-2025" readonly />
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Livewire Integration --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.livewire.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/input.livewire.preview_title')">
                    <vibe:preview.code>
{{-- In Blade template --}}
<form wire:submit="save">
    <vibe:input wire:model.live="name" label="{{ __('docs/input.livewire.label') }}" placeholder="{{ __('docs/input.livewire.placeholder') }}" />

    <vibe:input wire:model="email" type="email" label="Email" placeholder="name@email.com" info="Used for login." />

    <vibe:button type="submit" variant="primary">
        Save Changes
    </vibe:button>
</form>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input :label="__('docs/input.livewire.label') . ' (wire:model.live)'" :placeholder="__('docs/input.livewire.placeholder')" />
                        <vibe:input type="email" label="Email (wire:model)" placeholder="name@email.com" info="Used for login." />
                        <vibe:button variant="primary" class="w-full">Save Changes</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/input.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/input.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/input.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/input.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/input.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/input.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $props = [
                                ['label', 'string', 'null', 'Label text above the input.'],
                                ['id', 'string', 'auto', 'HTML input id attribute. Default: name or uniqid().'],
                                ['name', 'string', 'null', 'HTML name attribute. Automatically extracted from wire:model if omitted.'],
                                ['type', 'string', "'text'", 'HTML input type: text, email, password, number, url, tel, etc.'],
                                ['size', "'sm'|'md'|'lg'|'xl'", "'md'", 'Input height and text size.'],
                                ['variant', "'outline'|'filled'|'flush'|'ghost'|'accent'", "'outline'", 'Visual style variant.'],
                                ['description', 'string', 'null', 'Small helper text below the label, before the input.'],
                                ['info', 'string', 'null', 'Helper note below the input. Hidden when error exists.'],
                                ['error', 'string|bool', 'null', 'Custom error message or boolean to trigger error state.'],
                                ['errorName', 'string', 'null', 'Laravel validation error key if different from name (e.g. user.phone).'],
                                ['prefix', 'string', 'null', 'Text on the left side of the input (e.g. "https://", "$").'],
                                ['suffix', 'string', 'null', 'Text on the right side of the input (e.g. ".com", "/month").'],
                                ['class', 'string', 'null', 'Extra classes for input merged via twMerge (e.g. "rounded-full" for pill style).'],
                                ['wrapperClass', 'string', 'null', 'Extra class for the outer wrapper div.']
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
                <p class="text-sm font-semibold text-foreground pt-2">{{ __('docs/input.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/input.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/input.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">icon</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">SVG icon on the left side (leading icon). Use <code class="font-mono text-foreground">&lt;x-slot:icon&gt;</code>.</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground">trailingIcon</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">SVG icon on the right side (trailing icon). Use <code class="font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code>.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
