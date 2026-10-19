<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/number.title')" :description="__('docs/number.description')" schema="techarticle" :breadcrumbs="[
        ['name' => __('docs/number.breadcrumbs.home'), 'url' => '/'],
        ['name' => __('docs/number.breadcrumbs.docs'), 'url' => '/docs'],
        ['name' => __('docs/number.breadcrumbs.input'), 'url' => route('docs.input.index')],
        ['name' => __('docs/number.breadcrumbs.input_number'), 'url' => route('docs.input.number')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">{{ __('docs/number.badge') }}</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.number</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/number.sub_badge') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/number.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {!! __('docs/number.description') !!}
                </p>
            </div>

            {{-- 1. Penggunaan Dasar (Format Ribuan Tanpa Prefix) --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/number.basic_usage.preview_title')">
                    <vibe:preview.code>
<\vibe:input.number 
    name="total_visitors" 
    label="{{ __('docs/number.basic_usage.label') }}" 
    value="1250000" 
    placeholder="0" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.number 
                            name="total_visitors" 
                            label="{{ __('docs/number.basic_usage.label') }}" 
                            value="1250000" 
                            placeholder="0" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Kontrol Pengiriman Data: Bersih (Raw) vs Berformat (keep-format) --}}
            <section id="data-posting" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.data_posting.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.data_posting.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/number.data_posting.preview_title')">
                    <vibe:preview.code>
{{-- Default: raw=true --}}
<\vibe:input.number 
    name="stock_clean" 
    label="{{ __('docs/number.data_posting.clean_label') }}" 
    value="1500000" 
/>

{{-- keep-format: raw=false --}}
<\vibe:input.number 
    name="stock_formatted" 
    label="{{ __('docs/number.data_posting.formatted_label') }}" 
    value="1500000" 
    keep-format 
/>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                            <span class="text-xs font-bold text-foreground">{{ __('docs/number.data_posting.clean_card_title') }}</span>
                            <vibe:input.number 
                                name="stock_clean" 
                                label="{{ __('docs/number.data_posting.clean_label') }}" 
                                value="1500000" 
                            />
                            <p class="text-[11px] text-muted-foreground">{{ __('docs/number.data_posting.clean_hint') }} <code class="text-primary font-bold">1500000</code></p>
                        </div>
                        <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                            <span class="text-xs font-bold text-foreground">{{ __('docs/number.data_posting.formatted_card_title') }}</span>
                            <vibe:input.number 
                                name="stock_formatted" 
                                label="{{ __('docs/number.data_posting.formatted_label') }}" 
                                value="1500000" 
                                keep-format 
                            />
                            <p class="text-[11px] text-muted-foreground">{{ __('docs/number.data_posting.formatted_hint') }} <code class="text-primary font-bold">"1.500.000"</code></p>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Satuan Unit (Suffix) --}}
            <section id="satuan-suffix" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.suffix.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.suffix.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/number.suffix.preview_title')">
                    <vibe:preview.code>
<\vibe:input.number name="weight" label="{{ __('docs/number.suffix.weight_label') }}" suffix="kg" value="25" />
<\vibe:input.number name="quantity" label="{{ __('docs/number.suffix.quantity_label') }}" suffix="pcs" value="500" />
<\vibe:input.number name="discount" label="{{ __('docs/number.suffix.discount_label') }}" suffix="%" value="15" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input.number name="weight" label="{{ __('docs/number.suffix.weight_label') }}" suffix="kg" value="25" />
                        <vibe:input.number name="quantity" label="{{ __('docs/number.suffix.quantity_label') }}" suffix="pcs" value="500" />
                        <vibe:input.number name="discount" label="{{ __('docs/number.suffix.discount_label') }}" suffix="%" value="15" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Nilai Desimal & Presisi (Precision) --}}
            <section id="desimal-presisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.precision.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.precision.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/number.precision.preview_title')">
                    <vibe:preview.code>
<\vibe:input.number 
    name="metric_volume" 
    label="{{ __('docs/number.precision.volume_label') }}" 
    suffix="liter" 
    precision="2" 
    value="1250.75" 
    placeholder="0,00" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.number 
                            name="metric_volume" 
                            label="{{ __('docs/number.precision.volume_label') }}" 
                            suffix="liter" 
                            precision="2" 
                            value="1250.75" 
                            placeholder="0,00" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Tombol Stepper Mini (+/-) & Batasan Min/Max --}}
            <section id="stepper-min-max" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.stepper.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.stepper.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/number.stepper.preview_title')">
                    <vibe:preview.code>
<\vibe:input.number 
    name="box_qty" 
    label="{{ __('docs/number.stepper.box_label') }}" 
    stepper 
    min="1" 
    max="50" 
    step="5" 
    value="10" 
    clamp 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.number 
                            name="box_qty" 
                            label="{{ __('docs/number.stepper.box_label') }}" 
                            stepper 
                            min="1" 
                            max="50" 
                            step="5" 
                            value="10" 
                            clamp 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Pengujian Form Submit ke Controller ($request->all()) --}}
            <section id="uji-coba-controller" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.controller_test.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.controller_test.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/number.controller_test.preview_title')">
                    <vibe:preview.code>
<\vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
    @@csrf
    <\vibe:card>
        <\vibe:card.header>
            <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/number.controller_test.card_title') }}</h3>
            <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/number.controller_test.card_desc') }}</p>
        </\vibe:card.header>

        <\vibe:card.content class="space-y-4">
            <\vibe:input.number 
                name="stock_clean" 
                label="{{ __('docs/number.controller_test.clean_label') }}" 
                value="2500000" 
                suffix="pcs" 
                placeholder="0" 
            />

            <\vibe:input.number 
                name="metric_formatted" 
                label="{{ __('docs/number.controller_test.formatted_label') }}" 
                value="1500000.75" 
                precision="2" 
                suffix="kg" 
                keep-format 
                placeholder="0,00" 
            />

            <\vibe:input.number 
                name="order_qty" 
                label="{{ __('docs/number.controller_test.order_label') }}" 
                value="15" 
                stepper 
                min="1" 
                max="100" 
                step="5" 
                clamp 
            />
        </\vibe:card.content>

        <\vibe:card.footer>
            <\vibe:button class="w-full" type="submit" variant="primary">
                {{ __('docs/number.controller_test.submit_btn') }}
            </\vibe:button>
        </\vibe:card.footer>
    </\vibe:card>
</\vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/number.controller_test.card_title') }}</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/number.controller_test.card_desc') }}</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:input.number 
                                    name="stock_clean" 
                                    label="{{ __('docs/number.controller_test.clean_label') }}" 
                                    value="2500000" 
                                    suffix="pcs" 
                                    placeholder="0" 
                                />

                                <vibe:input.number 
                                    name="metric_formatted" 
                                    label="{{ __('docs/number.controller_test.formatted_label') }}" 
                                    value="1500000.75" 
                                    precision="2" 
                                    suffix="kg" 
                                    keep-format 
                                    placeholder="0,00" 
                                />

                                <vibe:input.number 
                                    name="order_qty" 
                                    label="{{ __('docs/number.controller_test.order_label') }}" 
                                    value="15" 
                                    stepper 
                                    min="1" 
                                    max="100" 
                                    step="5" 
                                    clamp 
                                />
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    {{ __('docs/number.controller_test.submit_btn') }}
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>
                </vibe:preview>
            </section>

            {{-- 7. Tabel Referensi Props & Atribut --}}
            <section id="props-referensi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/number.props_table.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/number.props_table.desc') !!}
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border">
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>{{ __('docs/number.props_table.columns.prop') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/number.props_table.columns.type') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/number.props_table.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/number.props_table.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $propsList = [
                                    ['name', 'string', 'null', __('docs/number.props_table.items.name')],
                                    ['value', 'string|numeric', 'null', __('docs/number.props_table.items.value')],
                                    ['raw', 'bool', 'true', __('docs/number.props_table.items.raw')],
                                    ['keepFormat', 'bool', 'false', __('docs/number.props_table.items.keepFormat')],
                                    ['prefix', 'string|null', 'null', __('docs/number.props_table.items.prefix')],
                                    ['suffix', 'string|null', 'null', __('docs/number.props_table.items.suffix')],
                                    ['thousandSeparator', 'string', "'.'", __('docs/number.props_table.items.thousandSeparator')],
                                    ['decimalSeparator', 'string', "','", __('docs/number.props_table.items.decimalSeparator')],
                                    ['precision', 'int', '0', __('docs/number.props_table.items.precision')],
                                    ['integer', 'bool', 'false', __('docs/number.props_table.items.integer')],
                                    ['round', 'bool', 'false', __('docs/number.props_table.items.round')],
                                    ['allowNegative', 'bool', 'false', __('docs/number.props_table.items.allowNegative')],
                                    ['min', 'numeric|null', 'null', __('docs/number.props_table.items.min')],
                                    ['max', 'numeric|null', 'null', __('docs/number.props_table.items.max')],
                                    ['step', 'numeric', '1', __('docs/number.props_table.items.step')],
                                    ['clamp', 'bool', 'false', __('docs/number.props_table.items.clamp')],
                                    ['stepper', 'bool', 'false', __('docs/number.props_table.items.stepper')],
                                    ['keyboard', 'bool', 'true', __('docs/number.props_table.items.keyboard')],
                                    ['size', "'xs'|'sm'|'md'|'lg'|'xl'", "'md'", __('docs/number.props_table.items.size')],
                                    ['variant', "'primary'|'outline'|'filled'|'flush'|'ghost'", "'primary'", __('docs/number.props_table.items.variant')],
                                    ['disabled', 'bool', 'false', __('docs/number.props_table.items.disabled')],
                                    ['readonly', 'bool', 'false', __('docs/number.props_table.items.readonly')],
                                ];
                            @endphp
                            @foreach ($propsList as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs leading-relaxed">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
