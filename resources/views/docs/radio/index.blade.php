<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/radio.title')" :description="__('docs/radio.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/radio.title'), 'url' => '/docs/radio']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/radio.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/radio.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/radio.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/radio.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">sm</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">md (default)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">lg</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">default</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">card</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">accent</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/radio.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/radio.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/radio.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:radio.group 
    name="billing" 
    label="{{ __('docs/radio.basic_usage.plan_label') }}" 
    description="{{ __('docs/radio.basic_usage.plan_desc') }}"
>
    <vibe:radio name="billing" value="monthly" label="{{ __('docs/radio.basic_usage.opt1') }}" checked />
    <vibe:radio name="billing" value="yearly" label="{{ __('docs/radio.basic_usage.opt2') }}" />
    <vibe:radio name="billing" value="lifetime" label="{{ __('docs/radio.basic_usage.opt3') }}" />
</vibe:radio.group>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:radio.group 
                            name="billing_demo" 
                            :label="__('docs/radio.basic_usage.plan_label')" 
                            :description="__('docs/radio.basic_usage.plan_desc')"
                        >
                            <vibe:radio name="billing_demo" value="monthly" :label="__('docs/radio.basic_usage.opt1')" checked />
                            <vibe:radio name="billing_demo" value="yearly" :label="__('docs/radio.basic_usage.opt2')" />
                            <vibe:radio name="billing_demo" value="lifetime" :label="__('docs/radio.basic_usage.opt3')" />
                        </vibe:radio.group>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/radio.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/radio.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/radio.sizes.preview_title')">
                    <vibe:preview.code>
<vibe:radio name="demo_size" value="sm" size="sm" label="{{ __('docs/radio.sizes.sm') }}" checked />
<vibe:radio name="demo_size" value="md" size="md" label="{{ __('docs/radio.sizes.md') }}" />
<vibe:radio name="demo_size" value="lg" size="lg" label="{{ __('docs/radio.sizes.lg') }}" />
                    </vibe:preview.code>
                    <div class="flex flex-col gap-3">
                        <vibe:radio name="demo_size_live" value="sm" size="sm" :label="__('docs/radio.sizes.sm')" checked />
                        <vibe:radio name="demo_size_live" value="md" size="md" :label="__('docs/radio.sizes.md')" />
                        <vibe:radio name="demo_size_live" value="lg" size="lg" :label="__('docs/radio.sizes.lg')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Card Variant --}}
            <section id="varian-card" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/radio.card.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/radio.card.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/radio.card.preview_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
    <vibe:radio 
        variant="card" 
        name="plan_card" 
        value="dev" 
        label="{{ __('docs/radio.card.card1_title') }}" 
        description="{{ __('docs/radio.card.card1_desc') }}" 
        checked 
    />
    <vibe:radio 
        variant="card" 
        name="plan_card" 
        value="business" 
        label="{{ __('docs/radio.card.card2_title') }}" 
        description="{{ __('docs/radio.card.card2_desc') }}" 
    />
</div>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <vibe:radio 
                            variant="card" 
                            name="plan_card_live" 
                            value="dev" 
                            :label="__('docs/radio.card.card1_title')" 
                            :description="__('docs/radio.card.card1_desc')" 
                            checked 
                        />
                        <vibe:radio 
                            variant="card" 
                            name="plan_card_live" 
                            value="business" 
                            :label="__('docs/radio.card.card2_title')" 
                            :description="__('docs/radio.card.card2_desc')" 
                        />
                    </div>
                </vibe:preview>

                <div class="pt-2">
                    <h3 class="text-sm font-semibold text-foreground mb-1">{{ __('docs/radio.card.card_hidden_title') }}</h3>
                    <p class="text-xs text-muted-foreground mb-3">{!! __('docs/radio.card.card_hidden_desc') !!}</p>
                </div>

                <vibe:preview :title="__('docs/radio.card.card_hidden_title')">
                    <vibe:preview.code>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
    <vibe:radio 
        variant="card" 
        hide-indicator 
        name="billing_cycle" 
        value="monthly" 
        label="{{ __('docs/radio.card.hidden1_title') }}" 
        description="{{ __('docs/radio.card.hidden1_desc') }}" 
    />
    <vibe:radio 
        variant="card" 
        hide-indicator 
        name="billing_cycle" 
        value="annual" 
        label="{{ __('docs/radio.card.hidden2_title') }}" 
        description="{{ __('docs/radio.card.hidden2_desc') }}" 
        checked 
    />
</div>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <vibe:radio 
                            variant="card" 
                            hide-indicator 
                            name="billing_cycle_live" 
                            value="monthly" 
                            :label="__('docs/radio.card.hidden1_title')" 
                            :description="__('docs/radio.card.hidden1_desc')" 
                        />
                        <vibe:radio 
                            variant="card" 
                            hide-indicator 
                            name="billing_cycle_live" 
                            value="annual" 
                            :label="__('docs/radio.card.hidden2_title')" 
                            :description="__('docs/radio.card.hidden2_desc')" 
                            checked 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/radio.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/radio.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/radio.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/radio.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/radio.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/radio.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $radioProps = [
                                ['name', 'string', 'null', __('docs/radio.props.items.name')],
                                ['id', 'string', 'auto', __('docs/radio.props.items.id')],
                                ['value', 'string', 'null', __('docs/radio.props.items.value')],
                                ['label', 'string', 'null', __('docs/radio.props.items.label')],
                                ['description', 'string', 'null', __('docs/radio.props.items.description')],
                                ['checked', 'bool', 'false', __('docs/radio.props.items.checked')],
                                ['size', "'sm'|'md'|'lg'", "'md'", __('docs/radio.props.items.size')],
                                ['variant', "'default'|'card'|'accent'", "'default'", __('docs/radio.props.items.variant')],
                                ['indicator', 'bool', 'true', __('docs/radio.props.items.indicator')],
                                ['hideIndicator', 'bool', 'false', __('docs/radio.props.items.hideIndicator')],
                                ['error', 'string|bool', 'null', __('docs/radio.props.items.error')],
                                ['errorName', 'string', 'null', __('docs/radio.props.items.errorName')],
                                ['disabled', 'bool', 'false', __('docs/radio.props.items.disabled')],
                                ['wrapperClass', 'string', 'null', __('docs/radio.props.items.wrapperClass')],
                            ];
                        @endphp
                        @foreach ($radioProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Group Props --}}
                <div class="space-y-3 pt-4">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-foreground">{{ __('docs/radio.group_props.title') }}</h3>
                        <p class="text-sm text-muted-foreground">
                            {!! __('docs/radio.group_props.desc') !!}
                        </p>
                    </div>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/radio.group_props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/radio.group_props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/radio.group_props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/radio.group_props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $groupProps = [
                                    ['label', 'string', 'null', __('docs/radio.group_props.items.label')],
                                    ['name', 'string', 'null', __('docs/radio.group_props.items.name')],
                                    ['description', 'string', 'null', __('docs/radio.group_props.items.description')],
                                    ['orientation', "'vertical'|'horizontal'|'grid'", "'vertical'", __('docs/radio.group_props.items.orientation')],
                                    ['columns', '2|3|4', '2', __('docs/radio.group_props.items.columns')],
                                    ['required', 'bool', 'false', __('docs/radio.group_props.items.required')],
                                    ['error', 'string|bool', 'null', __('docs/radio.group_props.items.error')],
                                    ['errorName', 'string', 'null', __('docs/radio.group_props.items.errorName')],
                                ];
                            @endphp
                            @foreach ($groupProps as [$prop, $type, $default, $desc])
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

            {{-- Form Submission Test Section --}}
            <section id="uji-coba-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">Pengujian Form ($request->all())</h2>
                        <vibe:badge variant="primary" size="sm">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Uji coba pengiriman nilai komponen radio dan radio group (default & card style) langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Saat disubmit, modal otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code>.
                    </p>
                </div>

                <vibe:preview title="Form Testing Sandbox">
                    <vibe:preview.code>
<vibe:form action="{{ route('docs.form.store') }}" method="POST" class="space-y-5 max-w-lg mx-auto">
    @csrf

    {{-- Radio Group Standar --}}
    <vibe:radio.group
        name="membership_tier"
        label="Tingkat Keanggotaan"
        description="Pilih level akses akun yang sesuai kebutuhan"
    >
        <vibe:radio name="membership_tier" value="starter" label="Starter Plan (Gratis)" />
        <vibe:radio name="membership_tier" value="professional" label="Professional ($29/bln)" checked />
        <vibe:radio name="membership_tier" value="enterprise" label="Enterprise Custom" />
    </vibe:radio.group>

    {{-- Radio Group Card Variant --}}
    <vibe:radio.group
        name="payment_gateway"
        label="Metode Pembayaran Utama"
        description="Pilih gerbang pembayaran favorit"
        variant="card"
    >
        <vibe:radio
            variant="card"
            name="payment_gateway"
            value="credit_card"
            label="Kartu Kredit / Debit"
            description="Visa, Mastercard, JCB instant"
            checked
        />
        <vibe:radio
            variant="card"
            name="payment_gateway"
            value="bank_transfer"
            label="Virtual Account Bank"
            description="BCA, Mandiri, BNI, BRI otomatis"
        />
        <vibe:radio
            variant="card"
            name="payment_gateway"
            value="qris"
            label="QRIS & E-Wallet"
            description="GoPay, OVO, ShopeePay, Dana"
        />
    </vibe:radio.group>

    <div class="pt-2 flex items-center gap-3">
        <vibe:button type="submit" variant="primary">
            Kirim Form & Uji $request->all()
        </vibe:button>
    </div>
</vibe:form>
                    </vibe:preview.code>
                    <div class="max-w-lg mx-auto p-4">
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <vibe:radio.group
                                name="membership_tier"
                                label="Tingkat Keanggotaan"
                                description="Pilih level akses akun yang sesuai kebutuhan"
                            >
                                <vibe:radio name="membership_tier" value="starter" label="Starter Plan (Gratis)" />
                                <vibe:radio name="membership_tier" value="professional" label="Professional ($29/bln)" checked />
                                <vibe:radio name="membership_tier" value="enterprise" label="Enterprise Custom" />
                            </vibe:radio.group>

                            <vibe:radio.group
                                name="payment_gateway"
                                label="Metode Pembayaran Utama"
                                description="Pilih gerbang pembayaran favorit"
                                variant="card"
                            >
                                <vibe:radio
                                    variant="card"
                                    name="payment_gateway"
                                    value="credit_card"
                                    label="Kartu Kredit / Debit"
                                    description="Visa, Mastercard, JCB instant"
                                    checked
                                />
                                <vibe:radio
                                    variant="card"
                                    name="payment_gateway"
                                    value="bank_transfer"
                                    label="Virtual Account Bank"
                                    description="BCA, Mandiri, BNI, BRI otomatis"
                                />
                                <vibe:radio
                                    variant="card"
                                    name="payment_gateway"
                                    value="qris"
                                    label="QRIS & E-Wallet"
                                    description="GoPay, OVO, ShopeePay, Dana"
                                />
                            </vibe:radio.group>

                            <div class="pt-2 flex items-center gap-3">
                                <vibe:button type="submit" variant="primary">
                                    Kirim Form & Uji $request->all()
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
                @include('docs.partials.form-result-banner')
            </section>

        </div>

        {{-- Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
