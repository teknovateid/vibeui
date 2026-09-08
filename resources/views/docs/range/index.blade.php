<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/range.title')" :description="__('docs/range.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/range.title'), 'url' => '/docs/range']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/range.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/range.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/range.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/range.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">sm</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">md (default)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">lg</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:showValue="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">valuePrefix</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">valueSuffix</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">step</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:checkpoints="['10 GB', ...]"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:marks="[2, 4, ...]"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">strict / :strict="false"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">minLabel / maxLabel</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:range 
    name="volume" 
    label="{{ __('docs/range.basic_usage.volume_label') }}" 
    description="{{ __('docs/range.basic_usage.volume_desc') }}" 
    :value="60" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:range 
                            name="volume" 
                            :label="__('docs/range.basic_usage.volume_label')" 
                            :description="__('docs/range.basic_usage.volume_desc')" 
                            :value="60" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Live Value Display --}}
            <section id="indikator-nilai" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.value_display.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.value_display.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.value_display.preview_title')">
                    <vibe:preview.code>
<div class="space-y-6">
    <vibe:range 
        name="budget" 
        label="{{ __('docs/range.value_display.budget_label') }}" 
        :showValue="true" 
        valuePrefix="$" 
        :min="100" 
        :max="2500" 
        :step="50" 
        :value="750" 
    />

    <vibe:range 
        name="zoom" 
        label="{{ __('docs/range.value_display.zoom_label') }}" 
        :showValue="true" 
        valueSuffix="%" 
        :min="25" 
        :max="400" 
        :value="100" 
    />
</div>
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-6">
                        <vibe:range 
                            name="budget_live" 
                            :label="__('docs/range.value_display.budget_label')" 
                            :showValue="true" 
                            valuePrefix="$" 
                            :min="100" 
                            :max="2500" 
                            :step="50" 
                            :value="750" 
                        />

                        <vibe:range 
                            name="zoom_live" 
                            :label="__('docs/range.value_display.zoom_label')" 
                            :showValue="true" 
                            valueSuffix="%" 
                            :min="25" 
                            :max="400" 
                            :value="100" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Steps & Min/Max Marks --}}
            <section id="step-dan-label" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.steps.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.steps.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.steps.preview_title')">
                    <vibe:preview.code>
<vibe:range 
    name="storage" 
    label="{{ __('docs/range.steps.capacity_label') }}" 
    :showValue="true" 
    valueSuffix=" GB" 
    :min="10" 
    :max="500" 
    :step="10" 
    :value="120" 
    minLabel="10 GB" 
    maxLabel="500 GB" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:range 
                            name="storage_live" 
                            :label="__('docs/range.steps.capacity_label')" 
                            :showValue="true" 
                            valueSuffix=" GB" 
                            :min="10" 
                            :max="500" 
                            :step="10" 
                            :value="120" 
                            minLabel="10 GB" 
                            maxLabel="500 GB" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Flexible Marks (Select In-Between Values like 3 GB) --}}
            <section id="titik-poin-fleksibel" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.marks_continuous.title') }}</h2>
                        <vibe:badge variant="secondary" size="sm" class="text-[10px]">Nilai Antara Aktif</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.marks_continuous.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.marks_continuous.preview_title')">
                    <vibe:preview.code>
{{-- Slider RAM: Titik patokan pada 2 GB, 4 GB, 6 GB, 8 GB — namun pengguna tetap dapat memilih nilai tengah seperti 3 GB --}}
<vibe:range 
    name="ram_flexible" 
    label="{{ __('docs/range.marks_continuous.ram_label') }}" 
    description="{{ __('docs/range.marks_continuous.ram_desc') }}" 
    :min="1" 
    :max="8" 
    :step="1" 
    :marks="[2 => '2 GB', 4 => '4 GB', 6 => '6 GB', 8 => '8 GB']" 
    valueSuffix=" GB" 
    :value="3" 
    :showValue="true" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:range 
                            name="ram_flexible_demo" 
                            :label="__('docs/range.marks_continuous.ram_label')" 
                            :description="__('docs/range.marks_continuous.ram_desc')" 
                            :min="1" 
                            :max="8" 
                            :step="1" 
                            :marks="[2 => '2 GB', 4 => '4 GB', 6 => '6 GB', 8 => '8 GB']" 
                            valueSuffix=" GB" 
                            :value="3" 
                            :showValue="true" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Checkpoints & Strict Snap (Locked to Checkpoints Only) --}}
            <section id="titik-poin-checkpoints" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.checkpoints.title') }}</h2>
                        <vibe:badge variant="primary" size="sm" class="text-[10px]">Strict Snap</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.checkpoints.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.checkpoints.preview_title')">
                    <vibe:preview.code>
{{-- Paket Storage Cloud: Slider dikunci ketat (strict), tidak bisa memilih nilai di antara titik --}}
<vibe:range 
    name="storage_plan" 
    label="{{ __('docs/range.checkpoints.storage_label') }}" 
    description="{{ __('docs/range.checkpoints.storage_desc') }}" 
    :checkpoints="['10 GB', '20 GB', '30 GB', '50 GB', '100 GB']" 
    strict 
    value="20 GB" 
    :showValue="true" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:range 
                            name="storage_plan_demo" 
                            :label="__('docs/range.checkpoints.storage_label')" 
                            :description="__('docs/range.checkpoints.storage_desc')" 
                            :checkpoints="['10 GB', '20 GB', '30 GB', '50 GB', '100 GB']" 
                            strict 
                            value="20 GB" 
                            :showValue="true" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Auto Marks --}}
            <section id="marks-otomatis" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.marks.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.marks.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.marks.preview_title')">
                    <vibe:preview.code>
<vibe:range 
    name="satisfaction" 
    label="{{ __('docs/range.marks.rating_label') }}" 
    :min="1" 
    :max="5" 
    :step="1" 
    :marks="true" 
    :value="4" 
    :showValue="true" 
    valueSuffix=" ★" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:range 
                            name="satisfaction_demo" 
                            :label="__('docs/range.marks.rating_label')" 
                            :min="1" 
                            :max="5" 
                            :step="1" 
                            :marks="true" 
                            :value="4" 
                            :showValue="true" 
                            valueSuffix=" ★" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Sizes, Status & Error --}}
            <section id="ukuran-dan-status" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.sizes_status.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.sizes_status.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/range.sizes_status.preview_title')">
                    <vibe:preview.code>
<div class="space-y-6">
    {{-- Size Variations --}}
    <vibe:range name="size_sm" label="{{ __('docs/range.sizes_status.sm_label') }}" size="sm" :value="30" />
    <vibe:range name="size_md" label="{{ __('docs/range.sizes_status.md_label') }}" size="md" :value="50" />
    <vibe:range name="size_lg" label="{{ __('docs/range.sizes_status.lg_label') }}" size="lg" :value="70" />

    {{-- Disabled State --}}
    <vibe:range 
        name="disabled_slider" 
        label="{{ __('docs/range.sizes_status.disabled_label') }}" 
        :value="40" 
        :checkpoints="['10 GB', '20 GB', '50 GB']" 
        disabled 
    />

    {{-- Error State --}}
    <vibe:range 
        name="cpu_limit" 
        label="{{ __('docs/range.sizes_status.error_label') }}" 
        :value="85" 
        :showValue="true" 
        valueSuffix="%" 
        error="{{ __('docs/range.sizes_status.error_msg') }}" 
    />
</div>
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-6">
                        <vibe:range name="size_sm_demo" :label="__('docs/range.sizes_status.sm_label')" size="sm" :value="30" />
                        <vibe:range name="size_md_demo" :label="__('docs/range.sizes_status.md_label')" size="md" :value="50" />
                        <vibe:range name="size_lg_demo" :label="__('docs/range.sizes_status.lg_label')" size="lg" :value="70" />

                        <vibe:range 
                            name="disabled_slider_demo" 
                            :label="__('docs/range.sizes_status.disabled_label')" 
                            :value="40" 
                            :checkpoints="['10 GB', '20 GB', '50 GB']" 
                            disabled 
                        />

                        <vibe:range 
                            name="cpu_limit_demo" 
                            :label="__('docs/range.sizes_status.error_label')" 
                            :value="85" 
                            :showValue="true" 
                            valueSuffix="%" 
                            :error="__('docs/range.sizes_status.error_msg')" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Props Reference Table --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/range.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/range.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/range.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/range.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/range.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/range.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $props = [
                                ['name', 'string', 'null', __('docs/range.props.items.name')],
                                ['id', 'string', 'auto', __('docs/range.props.items.id')],
                                ['label', 'string', 'null', __('docs/range.props.items.label')],
                                ['description', 'string', 'null', __('docs/range.props.items.description')],
                                ['value', 'numeric|string', 'null', __('docs/range.props.items.value')],
                                ['min', 'numeric', '0', __('docs/range.props.items.min')],
                                ['max', 'numeric', '100', __('docs/range.props.items.max')],
                                ['step', 'numeric', '1', __('docs/range.props.items.step')],
                                ['checkpoints', 'array', 'null', __('docs/range.props.items.checkpoints')],
                                ['marks', 'bool|array', 'null', __('docs/range.props.items.marks')],
                                ['strict', 'bool', 'auto', __('docs/range.props.items.strict')],
                                ['size', "'sm'|'md'|'lg'", "'md'", __('docs/range.props.items.size')],
                                ['showValue', 'bool', 'false', __('docs/range.props.items.showValue')],
                                ['valuePrefix', 'string', "''", __('docs/range.props.items.valuePrefix')],
                                ['valueSuffix', 'string', "''", __('docs/range.props.items.valueSuffix')],
                                ['minLabel', 'string', 'null', __('docs/range.props.items.minLabel')],
                                ['maxLabel', 'string', 'null', __('docs/range.props.items.maxLabel')],
                                ['error', 'string|bool', 'null', __('docs/range.props.items.error')],
                                ['errorName', 'string', 'null', __('docs/range.props.items.errorName')],
                                ['disabled', 'bool', 'false', __('docs/range.props.items.disabled')],
                                ['wrapperClass', 'string', 'null', __('docs/range.props.items.wrapperClass')],
                            ];
                        @endphp
                        @foreach ($props as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>
        </div>

        {{-- Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>
</x-docs.layouts.sidebar>
