<x-docs.layouts.sidebar>
    <vibe:seo
        :title="__('docs/swipe.title') . ' - Vibe UI'"
        :description="__('docs/swipe.description')"
        schema="techarticle"
        :breadcrumbs="[
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Docs', 'url' => '/docs'],
            ['name' => 'Components', 'url' => '/docs'],
            ['name' => __('docs/swipe.title'), 'url' => '/docs/swipe']
        ]"
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" size="sm" class="rounded-full">{{ __('docs/swipe.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/swipe.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/swipe.title') }} (<span class="font-mono text-primary">&lt;vibe:swipe&gt;</span>)</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/swipe.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['primary', 'success', 'destructive', 'warning', 'info', 'secondary'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['xs', 'sm', 'md', 'lg', 'xl'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">@click</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="submit"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">wire:click</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">autoReset</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/swipe.basic_usage.desc') }}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.basic_usage.preview_title')">
                    <vibe:preview.code>
<\vibe:swipe
    label="{{ __('docs/swipe.basic_usage.label') }}"
    confirmedLabel="{{ __('docs/swipe.basic_usage.confirmed') }}"
    :autoReset="2500"
    @confirmed="alert('{{ __('docs/swipe.basic_usage.alert') }}')"
/>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">{{ __('docs/swipe.basic_usage.card_title') }}</h4>
                                <p class="text-xs text-muted-foreground">{{ __('docs/swipe.basic_usage.card_desc') }}</p>
                            </div>
                            <vibe:badge variant="primary" size="xs">{{ __('docs/swipe.basic_usage.card_badge') }}</vibe:badge>
                        </div>
                        <vibe:swipe
                            id="demo-basic"
                            :label="__('docs/swipe.basic_usage.label')"
                            :confirmedLabel="__('docs/swipe.basic_usage.confirmed')"
                            :autoReset="2500"
                            @confirmed="window.$wire ? null : alert('{{ addslashes(__('docs/swipe.basic_usage.alert')) }}')"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Click Event Interoperability --}}
            <section id="event-click" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.event_click.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.event_click.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.event_click.preview_title')">
                    <vibe:preview.code>
<div x-data="{ clickCount: 0 }" class="space-y-3">
    <\vibe:swipe
        label="{{ __('docs/swipe.event_click.label') }}"
        confirmedLabel="{{ __('docs/swipe.event_click.confirmed') }}"
        :autoReset="1500"
        @click="clickCount++"
    />
    <p class="text-sm">{{ __('docs/swipe.event_click.counter') }} <span x-text="clickCount" class="font-bold"></span></p>
</div>
                    </vibe:preview.code>

                    <div x-data="{ clickCount: 0 }" class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">{{ __('docs/swipe.event_click.card_title') }}</h4>
                                <p class="text-xs text-muted-foreground">{{ __('docs/swipe.event_click.card_desc') }}</p>
                            </div>
                            <span class="font-mono text-xs px-2.5 py-1 rounded-full bg-primary/10 text-primary font-bold" x-text="clickCount + ' x'"></span>
                        </div>
                        <vibe:swipe
                            id="demo-click"
                            :label="__('docs/swipe.event_click.label')"
                            :confirmedLabel="__('docs/swipe.event_click.confirmed')"
                            :autoReset="1500"
                            @click="clickCount++"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Form Submission --}}
            <section id="form-submit" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.form_submit.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.form_submit.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.form_submit.preview_title')">
                    <vibe:preview.code>
<form @submit.prevent="alert('{{ __('docs/swipe.form_submit.alert') }}')">
    <\vibe:input
        label="{{ __('docs/swipe.form_submit.input_label') }}"
        value="8219-3910-2910"
        required
    />
    <div class="mt-4">
        <\vibe:swipe
            type="submit"
            name="confirmed_payment"
            value="verified"
            variant="success"
            label="{{ __('docs/swipe.form_submit.label') }}"
            confirmedLabel="{{ __('docs/swipe.form_submit.confirmed') }}"
            :autoReset="2500"
        />
    </div>
</form>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs">
                        <div class="pb-4 mb-4 border-b border-border/60 flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">{{ __('docs/swipe.form_submit.card_title') }}</h4>
                                <p class="text-xs text-muted-foreground">{{ __('docs/swipe.form_submit.card_desc') }}</p>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full">{{ __('docs/swipe.form_submit.card_amount') }}</span>
                        </div>
                        <form @submit.prevent="alert('{{ addslashes(__('docs/swipe.form_submit.alert')) }}')" class="space-y-4">
                            <vibe:input
                                :label="__('docs/swipe.form_submit.input_label')"
                                :placeholder="__('docs/swipe.form_submit.input_ph')"
                                value="8219-3910-2910"
                                required
                            />
                            <vibe:swipe
                                id="demo-form-submit"
                                type="submit"
                                name="confirmed_payment"
                                value="verified"
                                variant="success"
                                :label="__('docs/swipe.form_submit.label')"
                                :confirmedLabel="__('docs/swipe.form_submit.confirmed')"
                                :autoReset="2500"
                            />
                        </form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.sizes.preview_title')">
                    <vibe:preview.code>
{{-- Extra Small: 32px --}}
<\vibe:swipe size="xs" label="Extra Small (xs - 32px)" />

{{-- Small: 36px --}}
<\vibe:swipe size="sm" label="Small (sm - 36px)" />

{{-- Medium: 44px (default touch-friendly) --}}
<\vibe:swipe size="md" label="Medium (md - 44px)" />

{{-- Large: 48px --}}
<\vibe:swipe size="lg" label="Large (lg - 48px)" />

{{-- Extra Large: 56px (Hero / Checkout) --}}
<\vibe:swipe size="xl" label="Extra Large (xl - 56px)" />
                    </vibe:preview.code>

                    <div class="w-full max-w-lg mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-5">
                        @foreach ([
                            'xs' => ['h' => '32px / h-8', 'use' => __('docs/swipe.sizes.xs_use')],
                            'sm' => ['h' => '36px / h-9', 'use' => __('docs/swipe.sizes.sm_use')],
                            'md' => ['h' => '44px / h-11', 'use' => __('docs/swipe.sizes.md_use')],
                            'lg' => ['h' => '48px / h-12', 'use' => __('docs/swipe.sizes.lg_use')],
                            'xl' => ['h' => '56px / h-14', 'use' => __('docs/swipe.sizes.xl_use')],
                        ] as $sz => $info)
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-mono font-medium text-foreground">size="{{ $sz }}" ({{ $info['h'] }}{{ $sz === 'md' ? ' - default' : '' }})</span>
                                    <span class="text-[11px] {{ $sz === 'md' ? 'text-primary font-semibold' : 'text-muted-foreground' }}">{{ $info['use'] }}</span>
                                </div>
                                <vibe:swipe id="sz-{{ $sz }}" size="{{ $sz }}" :label="__('docs/swipe.sizes.label') . ' (' . strtoupper($sz) . ')'" :autoReset="1500" />
                            </div>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Corner Shape --}}
            <section id="gaya-sudut" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.corner_shape.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.corner_shape.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.corner_shape.preview_title')">
                    <vibe:preview.code>
{{-- Standard Rounded (Default: rounded-lg selaras dengan tombol Vibe UI) --}}
<\vibe:swipe
    label="{{ __('docs/swipe.corner_shape.label_standard') }}"
    :autoReset="2000"
/>

{{-- Pill Shape (Membulat penuh dengan utility class) --}}
<\vibe:swipe
    class="rounded-full"
    variant="success"
    label="{{ __('docs/swipe.corner_shape.label_pill') }}"
    :autoReset="2000"
/>
                    </vibe:preview.code>

                    <div class="w-full max-w-lg mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-5">
                        <div class="space-y-1.5">
                            <span class="text-xs font-semibold text-foreground">{{ __('docs/swipe.corner_shape.standard_label') }}</span>
                            <vibe:swipe id="shape-default" :label="__('docs/swipe.corner_shape.label_standard')" :autoReset="2000" />
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-xs font-semibold text-foreground">{{ __('docs/swipe.corner_shape.pill_label') }} (<code class="font-mono text-primary font-normal">class="rounded-full"</code>)</span>
                            <vibe:swipe id="shape-pill" class="rounded-full" variant="success" :label="__('docs/swipe.corner_shape.label_pill')" :autoReset="2000" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Color Variants --}}
            <section id="varian-warna" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.variants.preview_title')">
                    <vibe:preview.code>
{{-- Primary --}}
<\vibe:swipe variant="primary" label="{{ __('docs/swipe.variants.slide_continue') }}" />

{{-- Success --}}
<\vibe:swipe variant="success" label="{{ __('docs/swipe.variants.slide_pay') }}" />

{{-- Destructive --}}
<\vibe:swipe variant="destructive" label="{{ __('docs/swipe.variants.slide_delete') }}" confirmedLabel="{{ __('docs/swipe.variants.done_delete_acct') }}" />

{{-- Warning --}}
<\vibe:swipe variant="warning" label="{{ __('docs/swipe.variants.slide_cancel') }}" />

{{-- Info --}}
<\vibe:swipe variant="info" label="{{ __('docs/swipe.variants.slide_sync') }}" />

{{-- Secondary --}}
<\vibe:swipe variant="secondary" label="{{ __('docs/swipe.variants.slide_archive') }}" />
                    </vibe:preview.code>

                    <div class="w-full max-w-lg mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-muted-foreground">{{ __('docs/swipe.variants.primary_label') }}</span>
                            <vibe:swipe id="var-primary" variant="primary" :label="__('docs/swipe.variants.slide_continue')" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">{{ __('docs/swipe.variants.success_label') }}</span>
                            <vibe:swipe id="var-success" variant="success" :label="__('docs/swipe.variants.slide_pay')" :confirmedLabel="__('docs/swipe.variants.done_payment')" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-rose-600 dark:text-rose-400">{{ __('docs/swipe.variants.destructive_label') }}</span>
                            <vibe:swipe id="var-danger" variant="destructive" :label="__('docs/swipe.variants.slide_delete')" :confirmedLabel="__('docs/swipe.variants.done_delete')" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-amber-600 dark:text-amber-400">{{ __('docs/swipe.variants.warning_label') }}</span>
                            <vibe:swipe id="var-warning" variant="warning" :label="__('docs/swipe.variants.slide_cancel')" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-sky-600 dark:text-sky-400">{{ __('docs/swipe.variants.info_label') }}</span>
                            <vibe:swipe id="var-info" variant="info" :label="__('docs/swipe.variants.slide_sync')" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-muted-foreground">{{ __('docs/swipe.variants.secondary_label') }}</span>
                            <vibe:swipe id="var-secondary" variant="secondary" :label="__('docs/swipe.variants.slide_archive')" :autoReset="2000" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Livewire & Loading --}}
            <section id="livewire-dan-loading" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.livewire.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.livewire.preview_title')">
                    <vibe:preview.code>
{{-- Livewire wire:click langsung --}}
<\vibe:swipe
    wire:click="processCheckout"
    wire:target="processCheckout"
    label="{{ __('docs/swipe.livewire.label_checkout') }}"
    loadingLabel="{{ __('docs/swipe.livewire.label_loading') }}"
    confirmedLabel="{{ __('docs/swipe.livewire.label_confirmed') }}"
/>

{{-- Pengendalian manual prop ::loading --}}
<\vibe:swipe
    ::loading="isProcessing"
    label="{{ __('docs/swipe.livewire.label_checkout') }}"
/>
                    </vibe:preview.code>

                    <div
                        x-data="{
                            isProcessing: false,
                            resultText: '{{ addslashes(__('docs/swipe.livewire.status_waiting')) }}'
                        }"
                        class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4"
                    >
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">{{ __('docs/swipe.livewire.card_title') }}</h4>
                                <p class="text-xs text-muted-foreground">{{ __('docs/swipe.livewire.card_desc') }}</p>
                            </div>
                            <span class="text-xs font-mono text-muted-foreground" x-text="isProcessing ? '{{ addslashes(__('docs/swipe.livewire.processing')) }}' : '{{ addslashes(__('docs/swipe.livewire.idle')) }}'"></span>
                        </div>
                        <vibe:swipe
                            id="demo-async-swipe"
                            ::loading="isProcessing"
                            :label="__('docs/swipe.livewire.label_send')"
                            :confirmedLabel="__('docs/swipe.livewire.label_done')"
                            @confirmed="
                                isProcessing = true;
                                resultText = '{{ addslashes(__('docs/swipe.livewire.status_processing')) }}';
                                setTimeout(() => {
                                    isProcessing = false;
                                    resultText = 'Server merespon: OK';
                                }, 2000);
                            "
                        />
                        <div class="flex items-center justify-between text-xs text-muted-foreground px-1">
                            <span>{{ __('docs/swipe.livewire.status_label') }}</span>
                            <span class="font-medium text-foreground" x-text="resultText"></span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Auto Reset & External Control --}}
            <section id="kontrol-reset" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.reset.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/swipe.reset.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.reset.preview_title')">
                    <vibe:preview.code>
<div class="space-y-3">
    <\vibe:swipe
        id="swipe-custom-reset"
        label="{{ __('docs/swipe.reset.label') }}"
        confirmedLabel="{{ __('docs/swipe.reset.confirmed') }}"
    />

    {{-- Tombol Reset Eksternal --}}
    <\vibe:button
        size="sm"
        variant="outline"
        @click="$dispatch('reset-swipe', 'swipe-custom-reset')"
    >
        {{ __('docs/swipe.reset.btn_reset') }}
    <\/\vibe:button>
</div>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">{{ __('docs/swipe.reset.card_title') }}</h4>
                                <p class="text-xs text-muted-foreground">{{ __('docs/swipe.reset.card_desc') }}</p>
                            </div>
                            <vibe:button
                                size="xs"
                                variant="outline"
                                @click="$dispatch('reset-swipe', 'swipe-custom-reset')"
                            >
                                {{ __('docs/swipe.reset.btn_reset') }}
                            </vibe:button>
                        </div>
                        <vibe:swipe
                            id="swipe-custom-reset"
                            :label="__('docs/swipe.reset.label')"
                            :confirmedLabel="__('docs/swipe.reset.confirmed')"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Disabled --}}
            <section id="status-disabled" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.disabled.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/swipe.disabled.desc') }}
                    </p>
                </div>

                <vibe:preview :title="__('docs/swipe.disabled.preview_title')">
                    <vibe:preview.code>
<\vibe:swipe
    disabled
    label="{{ __('docs/swipe.disabled.label') }}"
/>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs">
                        <vibe:swipe
                            id="demo-disabled"
                            disabled
                            :label="__('docs/swipe.disabled.label')"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/swipe.props_ref.title') }}</h2>
                    <p class="text-sm text-muted-foreground">{!! __('docs/swipe.props_ref.desc') !!}</p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-border bg-muted/40 text-muted-foreground font-semibold">
                                <th class="p-3">{{ __('docs/swipe.props_ref.col_prop') }}</th>
                                <th class="p-3">{{ __('docs/swipe.props_ref.col_type') }}</th>
                                <th class="p-3">{{ __('docs/swipe.props_ref.col_default') }}</th>
                                <th class="p-3">{{ __('docs/swipe.props_ref.col_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">type</td>
                                <td class="p-3 font-mono">'button'|'submit'</td>
                                <td class="p-3 font-mono">'button'</td>
                                <td class="p-3">{!! __('docs/swipe.props_ref.prop_type_desc') !!}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">size</td>
                                <td class="p-3 font-mono">'xs'|'sm'|'md'|'lg'|'xl'</td>
                                <td class="p-3 font-mono">'md'</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_size_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">variant</td>
                                <td class="p-3 font-mono">'primary'|'success'|'destructive'|'warning'|'info'|'secondary'</td>
                                <td class="p-3 font-mono">'primary'</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_variant_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">name</td>
                                <td class="p-3 font-mono">string|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_name_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">value</td>
                                <td class="p-3 font-mono">string|numeric</td>
                                <td class="p-3 font-mono">'1'</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_value_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">label</td>
                                <td class="p-3 font-mono">string</td>
                                <td class="p-3 font-mono text-muted-foreground italic">vibe/swipe.label</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_label_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">confirmedLabel</td>
                                <td class="p-3 font-mono">string</td>
                                <td class="p-3 font-mono text-muted-foreground italic">vibe/swipe.confirmed_label</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_confirmed_label_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">threshold</td>
                                <td class="p-3 font-mono">float (0.5 - 1.0)</td>
                                <td class="p-3 font-mono">0.88</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_threshold_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">autoReset</td>
                                <td class="p-3 font-mono">bool|int</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_auto_reset_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">loading</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_loading_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">haptic</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">true</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_haptic_desc') }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">disabled</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">{{ __('docs/swipe.props_ref.prop_disabled_desc') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">{{ __('docs/swipe.props_ref.events_title') }}</h3>
                    <ul class="list-disc list-inside text-xs text-muted-foreground space-y-1">
                        <li><code class="font-mono text-primary font-semibold">@click</code> / <code class="font-mono text-primary font-semibold">wire:click</code>: {{ __('docs/swipe.props_ref.event_click') }}</li>
                        <li><code class="font-mono text-primary font-semibold">@confirmed</code> / <code class="font-mono text-primary font-semibold">@swiped</code>: {!! __('docs/swipe.props_ref.event_confirmed') !!}</li>
                        <li><code class="font-mono text-primary font-semibold">@swipe-start</code>: {{ __('docs/swipe.props_ref.event_start') }}</li>
                        <li><code class="font-mono text-primary font-semibold">@swiping</code>: {!! __('docs/swipe.props_ref.event_swiping') !!}</li>
                        <li><code class="font-mono text-primary font-semibold">@reset</code>: {{ __('docs/swipe.props_ref.event_reset') }}</li>
                        <li><code class="font-mono text-primary font-semibold">$dispatch('reset-swipe', id)</code>: {{ __('docs/swipe.props_ref.event_dispatch') }}</li>
                    </ul>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20 space-y-4">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
