<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/textarea.title')" :description="__('docs/textarea.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/textarea.title'), 'url' => '/docs/textarea']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/textarea.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/textarea.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/textarea.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/textarea.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['primary', 'outline', 'filled', 'flush', 'ghost'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:autoResize="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:showCount="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">rows="3"</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/textarea.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/textarea.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/textarea.basic_usage.preview_title')">
                    <vibe:preview.code>
<vibe:textarea 
    name="bio" 
    label="{{ __('docs/textarea.basic_usage.bio_label') }}" 
    placeholder="{{ __('docs/textarea.basic_usage.bio_placeholder') }}" 
    rows="3" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:textarea 
                            name="bio" 
                            :label="__('docs/textarea.basic_usage.bio_label')" 
                            :placeholder="__('docs/textarea.basic_usage.bio_placeholder')" 
                            rows="3" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Auto-Resize --}}
            <section id="auto-resize" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/textarea.autoresize.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/textarea.autoresize.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/textarea.autoresize.preview_title')">
                    <vibe:preview.code>
<vibe:textarea 
    name="notes" 
    label="{{ __('docs/textarea.autoresize.feedback_label') }}" 
    placeholder="{{ __('docs/textarea.autoresize.feedback_placeholder') }}" 
    :autoResize="true" 
    rows="2" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:textarea 
                            name="notes" 
                            :label="__('docs/textarea.autoresize.feedback_label')" 
                            :placeholder="__('docs/textarea.autoresize.feedback_placeholder')" 
                            :autoResize="true" 
                            rows="2" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Character Counter --}}
            <section id="penghitung-karakter" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/textarea.counter.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/textarea.counter.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/textarea.counter.preview_title')">
                    <vibe:preview.code>
<vibe:textarea 
    name="tweet" 
    label="{{ __('docs/textarea.counter.tweet_label') }}" 
    placeholder="{{ __('docs/textarea.counter.tweet_placeholder') }}" 
    :maxlength="150" 
    :showCount="true" 
    rows="3" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md">
                        <vibe:textarea 
                            name="tweet" 
                            :label="__('docs/textarea.counter.tweet_label')" 
                            :placeholder="__('docs/textarea.counter.tweet_placeholder')" 
                            :maxlength="150" 
                            :showCount="true" 
                            rows="3" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Form Testing ($request->all()) --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">Pengujian Form ($request->all())</h2>
                        <vibe:badge variant="primary" size="sm">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Uji coba pengiriman nilai berbagai variasi textarea langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Saat disubmit, modal otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code>.
                    </p>
                </div>

                <vibe:preview title="Form Testing Sandbox">
                    <vibe:preview.code>
<vibe:form action="{{ route('docs.form.store') }}" method="POST" class="space-y-4 max-w-lg mx-auto">
    @csrf

    <vibe:textarea 
        name="feedback_summary" 
        label="Ringkasan Masukan" 
        placeholder="Tuliskan ringkasan pengalaman Anda di sini..." 
        rows="2"
        required
    />

    <vibe:textarea 
        name="detailed_notes" 
        label="Catatan Lengkap (Auto-Resize & Counter)" 
        placeholder="Ketik catatan lebih panjang, tinggi textarea akan menyesuaikan otomatis..." 
        :autoResize="true"
        :showCount="true"
        :maxlength="300"
        rows="3"
    />

    <div class="pt-2 flex items-center gap-3">
        <vibe:button type="submit" variant="primary">
            Kirim Form & Uji $request->all()
        </vibe:button>
    </div>
</vibe:form>
                    </vibe:preview.code>
                    <div class="max-w-lg mx-auto p-4">
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <vibe:textarea 
                                name="feedback_summary" 
                                label="Ringkasan Masukan" 
                                placeholder="Tuliskan ringkasan pengalaman Anda di sini..." 
                                rows="2"
                                required
                            />

                            <vibe:textarea 
                                name="detailed_notes" 
                                label="Catatan Lengkap (Auto-Resize & Counter)" 
                                placeholder="Ketik catatan lebih panjang, tinggi textarea akan menyesuaikan otomatis..." 
                                :autoResize="true"
                                :showCount="true"
                                :maxlength="300"
                                rows="3"
                            />

                            <div class="pt-2 flex items-center gap-3">
                                <vibe:button type="submit" variant="primary">
                                    Kirim Form & Uji $request->all()
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/textarea.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/textarea.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/textarea.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/textarea.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/textarea.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/textarea.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $textareaProps = [
                                ['name', 'string', 'null', __('docs/textarea.props.items.name')],
                                ['id', 'string', 'auto', __('docs/textarea.props.items.id')],
                                ['label', 'string', 'null', __('docs/textarea.props.items.label')],
                                ['description', 'string', 'null', __('docs/textarea.props.items.description')],
                                ['placeholder', 'string', 'null', __('docs/textarea.props.items.placeholder')],
                                ['rows', 'int', '3', __('docs/textarea.props.items.rows')],
                                ['size', "'sm'|'md'|'lg'|'xl'", "'md'", __('docs/textarea.props.items.size')],
                                ['variant', "'primary'|'outline'|'filled'|'flush'|'ghost'", "'primary'", __('docs/textarea.props.items.variant')],
                                ['autoResize', 'bool', 'false', __('docs/textarea.props.items.autoResize')],
                                ['showCount', 'bool', 'false', __('docs/textarea.props.items.showCount')],
                                ['maxlength', 'int', 'null', __('docs/textarea.props.items.maxlength')],
                                ['info', 'string', 'null', __('docs/textarea.props.items.info')],
                                ['error', 'string|bool', 'null', __('docs/textarea.props.items.error')],
                                ['errorName', 'string', 'null', __('docs/textarea.props.items.errorName')],
                                ['disabled', 'bool', 'false', __('docs/textarea.props.items.disabled')],
                                ['readonly', 'bool', 'false', __('docs/textarea.props.items.readonly')],
                                ['wrapperClass', 'string', 'null', __('docs/textarea.props.items.wrapperClass')],
                            ];
                        @endphp
                        @foreach ($textareaProps as [$prop, $type, $default, $desc])
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
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
