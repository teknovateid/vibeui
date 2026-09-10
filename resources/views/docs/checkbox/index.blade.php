<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/checkbox.title')" :description="__('docs/checkbox.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/checkbox.title'), 'url' => '/docs/checkbox']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/checkbox.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/checkbox.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/checkbox.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/checkbox.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">sm</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">md (default)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">lg</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">primary</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">accent</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">card</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">indeterminate</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/checkbox.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:checkbox name="terms" label="{{ __('docs/checkbox.basic_usage.label') }}" description="{{ __('docs/checkbox.basic_usage.desc_text') }}" checked />
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:checkbox name="terms" :label="__('docs/checkbox.basic_usage.label')" :description="__('docs/checkbox.basic_usage.desc_text')" checked />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. State Indeterminate --}}
            <section id="state-indeterminate" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.indeterminate.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.indeterminate.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/checkbox.indeterminate.preview_title')">
                    <vibe:preview.code>
                        <vibe:checkbox name="select_all" :indeterminate="true" label="{{ __('docs/checkbox.indeterminate.label') }}" />
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:checkbox name="select_all" :indeterminate="true" :label="__('docs/checkbox.indeterminate.label')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Sizes --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/checkbox.sizes.preview_title')">
                    <vibe:preview.code>
                        <vibe:checkbox size="sm" label="{{ __('docs/checkbox.sizes.sm') }}" checked />
                        <vibe:checkbox size="md" label="{{ __('docs/checkbox.sizes.md') }}" checked />
                        <vibe:checkbox size="lg" label="{{ __('docs/checkbox.sizes.lg') }}" checked />
                    </vibe:preview.code>
                    <div class="flex flex-col gap-3">
                        <vibe:checkbox size="sm" :label="__('docs/checkbox.sizes.sm')" checked />
                        <vibe:checkbox size="md" :label="__('docs/checkbox.sizes.md')" checked />
                        <vibe:checkbox size="lg" :label="__('docs/checkbox.sizes.lg')" checked />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Card Variant --}}
            <section id="varian-card" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.card.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.card.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/checkbox.card.preview_title')">
                    <vibe:preview.code>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <vibe:checkbox variant="card" name="opt_email" label="{{ __('docs/checkbox.card.opt1_title') }}" description="{{ __('docs/checkbox.card.opt1_desc') }}" checked />
                            <vibe:checkbox variant="card" name="opt_2fa" label="{{ __('docs/checkbox.card.opt2_title') }}" description="{{ __('docs/checkbox.card.opt2_desc') }}" />
                        </div>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <vibe:checkbox variant="card" name="opt_email" :label="__('docs/checkbox.card.opt1_title')" :description="__('docs/checkbox.card.opt1_desc')" checked />
                        <vibe:checkbox variant="card" name="opt_2fa" :label="__('docs/checkbox.card.opt2_title')" :description="__('docs/checkbox.card.opt2_desc')" />
                    </div>
                </vibe:preview>

                <div class="pt-2">
                    <h3 class="text-sm font-semibold text-foreground mb-1">{{ __('docs/checkbox.card.card_hidden_title') }}</h3>
                    <p class="text-xs text-muted-foreground mb-3">{!! __('docs/checkbox.card.card_hidden_desc') !!}</p>
                </div>

                <vibe:preview :title="__('docs/checkbox.card.card_hidden_title')">
                    <vibe:preview.code>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <vibe:checkbox variant="card" hide-indicator name="plan_pro" label="{{ __('docs/checkbox.card.hidden1_title') }}" description="{{ __('docs/checkbox.card.hidden1_desc') }}" checked />
                            <vibe:checkbox variant="card" hide-indicator name="plan_ent" label="{{ __('docs/checkbox.card.hidden2_title') }}" description="{{ __('docs/checkbox.card.hidden2_desc') }}" />
                        </div>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <vibe:checkbox variant="card" hide-indicator name="plan_pro" :label="__('docs/checkbox.card.hidden1_title')" :description="__('docs/checkbox.card.hidden1_desc')" checked />
                        <vibe:checkbox variant="card" hide-indicator name="plan_ent" :label="__('docs/checkbox.card.hidden2_title')" :description="__('docs/checkbox.card.hidden2_desc')" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Checkbox Group --}}
            <section id="checkbox-group" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.checkbox_group.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.checkbox_group.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/checkbox.checkbox_group.preview_title')">
                    <vibe:preview.code>
                        <vibe:checkbox.group label="{{ __('docs/checkbox.checkbox_group.group_label') }}" description="{{ __('docs/checkbox.checkbox_group.group_desc') }}" orientation="grid" :columns="2">
                            <vibe:checkbox name="skills[]" value="laravel" label="Laravel & PHP" checked />
                            <vibe:checkbox name="skills[]" value="tailwind" label="Tailwind CSS v4" checked />
                            <vibe:checkbox name="skills[]" value="alpine" label="Alpine.js" />
                            <vibe:checkbox name="skills[]" value="livewire" label="Livewire 3" />
                        </vibe:checkbox.group>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg">
                        <vibe:checkbox.group :label="__('docs/checkbox.checkbox_group.group_label')" :description="__('docs/checkbox.checkbox_group.group_desc')" orientation="grid" :columns="2">
                            <vibe:checkbox name="skills[]" value="laravel" label="Laravel & PHP" checked />
                            <vibe:checkbox name="skills[]" value="tailwind" label="Tailwind CSS v4" checked />
                            <vibe:checkbox name="skills[]" value="alpine" label="Alpine.js" />
                            <vibe:checkbox name="skills[]" value="livewire" label="Livewire 3" />
                        </vibe:checkbox.group>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/checkbox.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/checkbox.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/checkbox.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/checkbox.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $checkboxProps = [['name', 'string', 'null', __('docs/checkbox.props.items.name')], ['id', 'string', 'auto', __('docs/checkbox.props.items.id')], ['value', 'string', "'1'", __('docs/checkbox.props.items.value')], ['label', 'string', 'null', __('docs/checkbox.props.items.label')], ['description', 'string', 'null', __('docs/checkbox.props.items.description')], ['checked', 'bool', 'false', __('docs/checkbox.props.items.checked')], ['indeterminate', 'bool', 'false', __('docs/checkbox.props.items.indeterminate')], ['size', "'sm'|'md'|'lg'", "'md'", __('docs/checkbox.props.items.size')], ['variant', "'primary'|'accent'|'card'", "'primary'", __('docs/checkbox.props.items.variant')], ['indicator', 'bool', 'true', __('docs/checkbox.props.items.indicator')], ['hideIndicator', 'bool', 'false', __('docs/checkbox.props.items.hideIndicator')], ['info', 'string', 'null', __('docs/checkbox.props.items.info')], ['error', 'string|bool', 'null', __('docs/checkbox.props.items.error')], ['errorName', 'string', 'null', __('docs/checkbox.props.items.errorName')], ['disabled', 'bool', 'false', __('docs/checkbox.props.items.disabled')], ['wrapperClass', 'string', 'null', __('docs/checkbox.props.items.wrapperClass')]];
                        @endphp
                        @foreach ($checkboxProps as [$prop, $type, $default, $desc])
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
                        <h3 class="text-lg font-bold text-foreground">{{ __('docs/checkbox.group_props.title') }}</h3>
                        <p class="text-sm text-muted-foreground">
                            {!! __('docs/checkbox.group_props.desc') !!}
                        </p>
                    </div>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/checkbox.group_props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/checkbox.group_props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/checkbox.group_props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/checkbox.group_props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $groupProps = [['label', 'string', 'null', __('docs/checkbox.group_props.items.label')], ['description', 'string', 'null', __('docs/checkbox.group_props.items.description')], ['orientation', "'vertical'|'horizontal'|'grid'", "'vertical'", __('docs/checkbox.group_props.items.orientation')], ['columns', '2|3|4', '2', __('docs/checkbox.group_props.items.columns')], ['required', 'bool', 'false', __('docs/checkbox.group_props.items.required')], ['error', 'string|bool', 'null', __('docs/checkbox.group_props.items.error')], ['errorName', 'string', 'null', __('docs/checkbox.group_props.items.errorName')]];
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
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/checkbox.test.title') }}</h2>
                        <vibe:badge variant="primary" size="sm">{{ __('docs/checkbox.test.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/checkbox.test.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/checkbox.test.preview_title')">
                    <vibe:preview.code>
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                            @csrf
                            <vibe:card>
                                <vibe:card.header>
                                    <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/checkbox.test.card_title') }}</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/checkbox.test.card_desc') }}</p>
                                </vibe:card.header>

                                <vibe:card.content class="space-y-5">
                                    {{-- Single Boolean Checkbox --}}
                                    <vibe:checkbox name="agree_terms" value="1" :label="__('docs/checkbox.test.agree_label')" :description="__('docs/checkbox.test.agree_desc')" checked />

                                    {{-- Array Checkbox Group --}}
                                    <vibe:checkbox.group :label="__('docs/checkbox.test.channels_group_label')" :description="__('docs/checkbox.test.channels_group_desc')">
                                        <vibe:checkbox name="notifications[]" value="email" :label="__('docs/checkbox.test.channel_email')" checked />
                                        <vibe:checkbox name="notifications[]" value="sms" :label="__('docs/checkbox.test.channel_sms')" />
                                        <vibe:checkbox name="notifications[]" value="whatsapp" :label="__('docs/checkbox.test.channel_whatsapp')" checked />
                                    </vibe:checkbox.group>

                                    {{-- Card Style Checkboxes --}}
                                    <div class="space-y-2">
                                        <label class="block text-xs font-semibold text-foreground">{{ __('docs/checkbox.test.addons_heading') }}</label>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <vibe:checkbox variant="card" name="addons[]" value="cloud_backup" :label="__('docs/checkbox.test.addon_backup_label')" :description="__('docs/checkbox.test.addon_backup_desc')" checked />
                                            <vibe:checkbox variant="card" name="addons[]" value="priority_support" :label="__('docs/checkbox.test.addon_support_label')" :description="__('docs/checkbox.test.addon_support_desc')" />
                                        </div>
                                    </div>
                                </vibe:card.content>

                                <vibe:card.footer>
                                    <vibe:button class="w-full" type="submit" variant="primary">
                                        {{ __('docs/checkbox.test.submit_btn') }}
                                    </vibe:button>
                                </vibe:card.footer>
                            </vibe:card>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/checkbox.test.card_title') }}</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/checkbox.test.card_desc') }}</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-5">
                                <vibe:checkbox name="agree_terms" value="1" :label="__('docs/checkbox.test.agree_label')" :description="__('docs/checkbox.test.agree_desc')" checked />

                                <vibe:checkbox.group :label="__('docs/checkbox.test.channels_group_label')" :description="__('docs/checkbox.test.channels_group_desc')">
                                    <vibe:checkbox name="notifications[]" value="email" :label="__('docs/checkbox.test.channel_email')" checked />
                                    <vibe:checkbox name="notifications[]" value="sms" :label="__('docs/checkbox.test.channel_sms')" />
                                    <vibe:checkbox name="notifications[]" value="whatsapp" :label="__('docs/checkbox.test.channel_whatsapp')" checked />
                                </vibe:checkbox.group>

                                <div class="space-y-2">
                                    <label class="block text-xs font-semibold text-foreground">{{ __('docs/checkbox.test.addons_heading') }}</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <vibe:checkbox variant="card" name="addons[]" value="cloud_backup" :label="__('docs/checkbox.test.addon_backup_label')" :description="__('docs/checkbox.test.addon_backup_desc')" checked />
                                        <vibe:checkbox variant="card" name="addons[]" value="priority_support" :label="__('docs/checkbox.test.addon_support_label')" :description="__('docs/checkbox.test.addon_support_desc')" />
                                    </div>
                                </div>
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    {{ __('docs/checkbox.test.submit_btn') }}
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>
                </vibe:preview>
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
