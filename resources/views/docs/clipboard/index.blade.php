<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/clipboard.title')" :description="__('docs/clipboard.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/clipboard.title'), 'url' => '/docs/clipboard']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/clipboard.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/clipboard.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/clipboard.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/clipboard.description') }}
                </p>

                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['outline', 'ghost', 'primary', 'secondary', 'field', 'code'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['xs', 'sm', 'md', 'lg', 'xl'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="basic-usage" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/clipboard.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/clipboard.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/clipboard.basic_usage.preview_title')">
                    <vibe:preview.code>
<\vibe:clipboard value="vibe_live_98a7f6e5d4c3b2a1" aria-label="Copy token" />
<\vibe:clipboard value="vibe_live_98a7f6e5d4c3b2a1" variant="primary">{{ __('docs/clipboard.basic_usage.copy_token') }}</\vibe:clipboard>
<\vibe:clipboard value="https://vibeui.teknovate.co.id" variant="secondary">{{ __('docs/clipboard.basic_usage.copy_url') }}</\vibe:clipboard>
                    </vibe:preview.code>
                    <div class="flex flex-wrap items-center gap-3">
                        <vibe:clipboard value="vibe_live_98a7f6e5d4c3b2a1" aria-label="Copy token" />
                        <vibe:clipboard value="vibe_live_98a7f6e5d4c3b2a1" variant="primary">{{ __('docs/clipboard.basic_usage.copy_token') }}</vibe:clipboard>
                        <vibe:clipboard value="https://vibeui.teknovate.co.id" variant="secondary">{{ __('docs/clipboard.basic_usage.copy_url') }}</vibe:clipboard>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Target Element (Invoker Commands) --}}
            <section id="target-element" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/clipboard.target.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/clipboard.target.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/clipboard.target.preview_title')">
                    <vibe:preview.code>
<div class="flex items-center gap-2">
    <code id="install-cmd-snippet" class="px-3 py-1.5 rounded-lg bg-muted font-mono text-sm">composer require teknovate/vibeui</code>
    <\vibe:clipboard target="install-cmd-snippet" aria-label="Copy composer command" />
</div>

<div class="flex items-end gap-2 mt-4">
    <div class="flex-1">
        <\vibe:input id="webhook-endpoint-input" value="https://api.example.com/webhooks/vibe" readonly />
    </div>
    <\vibe:clipboard target="webhook-endpoint-input" variant="outline">{{ __('docs/clipboard.target.target_label') }}</\vibe:clipboard>
</div>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs text-muted-foreground">{{ __('docs/clipboard.target.command_note') }}</span>
                            <code id="install-cmd-snippet" class="px-3 py-1.5 rounded-lg bg-muted font-mono text-xs sm:text-sm text-foreground border border-border">composer require teknovate/vibeui</code>
                            <vibe:clipboard target="install-cmd-snippet" aria-label="Copy composer command" />
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="flex-1 min-w-0">
                                <vibe:input id="webhook-endpoint-input" value="https://api.example.com/webhooks/vibe" readonly />
                            </div>
                            <vibe:clipboard target="webhook-endpoint-input" variant="outline" class="shrink-0">{{ __('docs/clipboard.target.target_label') }}</vibe:clipboard>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Field & Code Box Variants --}}
            <section id="field-code" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/clipboard.field_code.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/clipboard.field_code.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/clipboard.field_code.preview_title')">
                    <vibe:preview.code>
<\vibe:clipboard
    variant="field"
    :label="__('docs/clipboard.field_code.share_label')"
    value="https://vibeui.teknovate.co.id/invite/team-alpha"
/>

<\vibe:clipboard
    variant="field"
    :label="__('docs/clipboard.field_code.api_label')"
    :description="__('docs/clipboard.field_code.api_desc')"
    value="sk_live_51N9x8K2mPqRsTuVwXyZ"
    masked
/>

<\vibe:clipboard
    variant="code"
    prefix="$"
    value="php artisan vibe:install"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-5">
                        <vibe:clipboard
                            variant="field"
                            :label="__('docs/clipboard.field_code.share_label')"
                            value="https://vibeui.teknovate.co.id/invite/team-alpha"
                        />

                        <vibe:clipboard
                            variant="field"
                            :label="__('docs/clipboard.field_code.api_label')"
                            :description="__('docs/clipboard.field_code.api_desc')"
                            value="sk_live_51N9x8K2mPqRsTuVwXyZ"
                            masked
                        />

                        <vibe:clipboard
                            variant="code"
                            prefix="$"
                            value="php artisan vibe:install"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Sizes, Bubbles & Toast --}}
            <section id="sizes-bubbles" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/clipboard.sizes_bubbles.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/clipboard.sizes_bubbles.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/clipboard.sizes_bubbles.preview_title')">
                    <vibe:preview.code>
@foreach (['xs', 'sm', 'md', 'lg', 'xl'] as $sz)
    <\vibe:clipboard size="{{ $sz }}" value="Size {{ $sz }}" aria-label="Copy {{ $sz }}" />
@endforeach

<\vibe:clipboard value="Notification payload" toast>{{ __('docs/clipboard.sizes_bubbles.with_toast') }}</\vibe:clipboard>
<\vibe:clipboard value="Right bubble" bubble="right">{{ __('docs/clipboard.sizes_bubbles.bubble_right') }}</\vibe:clipboard>
                    </vibe:preview.code>
                    <div class="space-y-4 w-full">
                        <div class="flex flex-wrap items-center gap-3">
                            @foreach (['xs', 'sm', 'md', 'lg', 'xl'] as $sz)
                                <vibe:clipboard :size="$sz" value="Size {{ $sz }}" aria-label="Copy {{ $sz }}" />
                            @endforeach
                        </div>

                        <div class="flex flex-wrap items-center gap-3">
                            <vibe:clipboard value="Notification payload" toast>{{ __('docs/clipboard.sizes_bubbles.with_toast') }}</vibe:clipboard>
                            <vibe:clipboard value="Right bubble" bubble="right" variant="secondary">{{ __('docs/clipboard.sizes_bubbles.bubble_right') }}</vibe:clipboard>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Hover & Keyboard-Accessible Repeated Block --}}
            <section id="hover-block" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/clipboard.hover_block.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/clipboard.hover_block.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/clipboard.hover_block.preview_title')">
                    <vibe:preview.code>
<div class="vibe-copyable rounded-xl border border-border bg-muted/40 p-4 pr-12 font-mono text-xs sm:text-sm">
    <pre id="env-snippet" class="overflow-x-auto" tabindex="0">VIBE_PREFIX=vibe
VIBE_THEME=system</pre>
    <\vibe:clipboard target="env-snippet" size="sm" bubble="left" aria-label="Copy environment variables" />
</div>
                    </vibe:preview.code>
                    <div class="vibe-copyable w-full max-w-xl rounded-xl border border-border bg-muted/40 p-4 pr-12 font-mono text-xs sm:text-sm">
                        <pre id="env-snippet" class="overflow-x-auto focus:outline-none" tabindex="0">VIBE_PREFIX=vibe
VIBE_THEME=system</pre>
                        <vibe:clipboard target="env-snippet" size="sm" bubble="left" aria-label="Copy environment variables" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Props & JS API Reference --}}
            <section id="props-reference" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/clipboard.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/clipboard.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/clipboard.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/clipboard.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/clipboard.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/clipboard.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $clipboardProps = [
                                ['value', 'string|null', 'null', __('docs/clipboard.props_items.value')],
                                ['target', 'string|null', 'null', __('docs/clipboard.props_items.target')],
                                ['variant', "'outline'|'ghost'|'primary'|'secondary'|'surface'|'default'|'field'|'code'", "'outline'", __('docs/clipboard.props_items.variant')],
                                ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'icon-xs'..'icon-xl'", "'md'", __('docs/clipboard.props_items.size')],
                                ['label', 'string|null', 'null', __('docs/clipboard.props_items.label')],
                                ['description', 'string|null', 'null', __('docs/clipboard.props_items.description')],
                                ['copyLabel', 'string|null', 'null', __('docs/clipboard.props_items.copyLabel')],
                                ['copiedLabel', 'string|null', 'null', __('docs/clipboard.props_items.copiedLabel')],
                                ['failedLabel', 'string|null', 'null', __('docs/clipboard.props_items.failedLabel')],
                                ['bubble', "'top'|'bottom'|'left'|'right'|false", "'top'", __('docs/clipboard.props_items.bubble')],
                                ['duration', 'int', '2000', __('docs/clipboard.props_items.duration')],
                                ['toast', 'bool|string', 'false', __('docs/clipboard.props_items.toast')],
                                ['masked', 'bool', 'false', __('docs/clipboard.props_items.masked')],
                                ['prefix', 'string|null', 'null', __('docs/clipboard.props_items.prefix')],
                                ['ariaLabel', 'string|null', 'null', __('docs/clipboard.props_items.ariaLabel')],
                                ['disabled', 'bool', 'false', __('docs/clipboard.props_items.disabled')],
                            ];
                        @endphp
                        @foreach ($clipboardProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
