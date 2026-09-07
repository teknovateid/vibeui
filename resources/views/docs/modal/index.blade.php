<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/modal.title')" :description="__('docs/modal.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Overlay & Dialog', 'url' => '/docs'],
        ['name' => __('docs/modal.title'), 'url' => '/docs/modal']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/modal.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/modal.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/modal.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/modal.description') }}
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['id', 'show', 'maxWidth', 'position', 'dismissible', 'remember', 'teleport'] as $p)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $p }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', 'full'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['top', 'center', 'bottom'] as $pos)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $pos }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['open-modal', 'close-modal'] as $ev)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $ev }}</vibe:badge>
                    @endforeach
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.basic_usage.preview_title')">
                    <vibe:preview.code>
{{-- Tombol pemicu buka modal --}}
<vibe:button @click="$dispatch('open-modal', 'demo-basic-modal')" variant="primary" size="sm">
    {{ __('docs/modal.basic_usage.btn') }}
</vibe:button>

{{-- Komponen Modal --}}
<vibe:modal id="demo-basic-modal">
    <div class="space-y-4">
        <div class="space-y-1 pr-6">
            <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.basic_usage.modal_title') }}</h3>
            <p class="text-sm text-muted-foreground">
                {{ __('docs/modal.basic_usage.modal_desc') }}
            </p>
        </div>

        <div class="flex items-center justify-end gap-2 pt-4 border-t border-border">
            <vibe:button type="button" variant="outline" size="sm" @click="close">
                {{ __('docs/modal.basic_usage.btn_cancel') }}
            </vibe:button>
            <vibe:button type="button" variant="primary" size="sm" @click="close">
                {{ __('docs/modal.basic_usage.btn_confirm') }}
            </vibe:button>
        </div>
    </div>
</vibe:modal>
                    </vibe:preview.code>

                    <div class="flex items-center justify-center p-4">
                        <vibe:button @click="$dispatch('open-modal', 'demo-basic-modal')" variant="primary" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2" />
                                <path d="M3 9h18" />
                                <path d="M9 21V9" />
                            </svg>
                            {{ __('docs/modal.basic_usage.btn') }}
                        </vibe:button>

                        <vibe:modal id="demo-basic-modal">
                            <div class="space-y-4">
                                <div class="space-y-1.5 pr-6">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex size-7 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                            </svg>
                                        </span>
                                        <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.basic_usage.modal_title') }}</h3>
                                    </div>
                                    <p class="text-sm text-muted-foreground leading-relaxed">
                                        {{ __('docs/modal.basic_usage.modal_desc') }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-end gap-2 pt-4 border-t border-border">
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/modal.basic_usage.btn_cancel') }}
                                    </vibe:button>
                                    <vibe:button type="button" variant="primary" size="sm" @click="close">
                                        {{ __('docs/modal.basic_usage.btn_confirm') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </vibe:modal>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Sizes --}}
            <section id="pilihan-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.sizes.preview_title')">
                    <vibe:preview.code>
{{-- 1. Small (sm) --}}
<vibe:modal id="modal-size-sm" maxWidth="sm">
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">{{ __('docs/modal.sizes.modal_title', ['size' => 'sm']) }}</h3>
        <p class="text-sm text-muted-foreground">{!! __('docs/modal.sizes.modal_desc', ['size' => 'sm']) !!}</p>
        <vibe:button type="button" variant="outline" size="sm" @click="close">{{ __('docs/modal.sizes.btn_close') }}</vibe:button>
    </div>
</vibe:modal>

{{-- 2. Standard (2xl - Default) --}}
<vibe:modal id="modal-size-2xl" maxWidth="2xl">
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">{{ __('docs/modal.sizes.modal_title', ['size' => '2xl']) }}</h3>
        <p class="text-sm text-muted-foreground">{!! __('docs/modal.sizes.modal_desc', ['size' => '2xl']) !!}</p>
        <vibe:button type="button" variant="outline" size="sm" @click="close">{{ __('docs/modal.sizes.btn_close') }}</vibe:button>
    </div>
</vibe:modal>

{{-- 3. Extra Large (4xl) --}}
<vibe:modal id="modal-size-4xl" maxWidth="4xl">
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">{{ __('docs/modal.sizes.modal_title', ['size' => '4xl']) }}</h3>
        <p class="text-sm text-muted-foreground">{!! __('docs/modal.sizes.modal_desc', ['size' => '4xl']) !!}</p>
        <vibe:button type="button" variant="outline" size="sm" @click="close">{{ __('docs/modal.sizes.btn_close') }}</vibe:button>
    </div>
</vibe:modal>

{{-- 4. Full Width (full) --}}
<vibe:modal id="modal-size-full" maxWidth="full">
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">{{ __('docs/modal.sizes.modal_title', ['size' => 'full']) }}</h3>
        <p class="text-sm text-muted-foreground">{!! __('docs/modal.sizes.modal_desc', ['size' => 'full']) !!}</p>
        <vibe:button type="button" variant="outline" size="sm" @click="close">{{ __('docs/modal.sizes.btn_close') }}</vibe:button>
    </div>
</vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center justify-center gap-2 p-4">
                        @php
                            $sizeDemos = [
                                ['key' => 'sm', 'label' => __('docs/modal.sizes.sm_btn'), 'variant' => 'outline'],
                                ['key' => 'md', 'label' => __('docs/modal.sizes.md_btn'), 'variant' => 'outline'],
                                ['key' => 'lg', 'label' => __('docs/modal.sizes.lg_btn'), 'variant' => 'outline'],
                                ['key' => '2xl', 'label' => __('docs/modal.sizes.xl2_btn'), 'variant' => 'primary'],
                                ['key' => '4xl', 'label' => __('docs/modal.sizes.xl4_btn'), 'variant' => 'outline'],
                                ['key' => 'full', 'label' => __('docs/modal.sizes.full_btn'), 'variant' => 'outline'],
                            ];
                        @endphp

                        @foreach ($sizeDemos as $s)
                            <vibe:button @click="$dispatch('open-modal', 'modal-size-{{ $s['key'] }}')" variant="{{ $s['variant'] }}" size="sm">
                                {{ $s['label'] }}
                            </vibe:button>

                            <vibe:modal id="modal-size-{{ $s['key'] }}" maxWidth="{{ $s['key'] }}">
                                <div class="space-y-4">
                                    <div class="space-y-1 pr-6">
                                        <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.sizes.modal_title', ['size' => $s['key']]) }}</h3>
                                        <p class="text-sm text-muted-foreground leading-relaxed">
                                            {!! __('docs/modal.sizes.modal_desc', ['size' => $s['key']]) !!}
                                        </p>
                                    </div>
                                    <div class="p-4 rounded-lg bg-muted/50 border border-border/60 text-xs font-mono text-muted-foreground">
                                        &lt;vibe:modal id="modal-size-{{ $s['key'] }}" maxWidth="{{ $s['key'] }}"&gt;
                                    </div>
                                    <div class="flex items-center justify-end pt-3 border-t border-border">
                                        <vibe:button type="button" variant="outline" size="sm" @click="close">
                                            {{ __('docs/modal.sizes.btn_close') }}
                                        </vibe:button>
                                    </div>
                                </div>
                            </vibe:modal>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Positions --}}
            <section id="posisi-layar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.positions.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.positions.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.positions.preview_title')">
                    <vibe:preview.code>
{{-- 1. Posisi Atas (Top) --}}
<vibe:modal id="modal-pos-top" position="top">
    ...
</vibe:modal>

{{-- 2. Posisi Tengah (Center - Default) --}}
<vibe:modal id="modal-pos-center" position="center">
    ...
</vibe:modal>

{{-- 3. Posisi Bawah (Bottom) --}}
<vibe:modal id="modal-pos-bottom" position="bottom">
    ...
</vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center justify-center gap-3 p-4">
                        @php
                            $posDemos = [
                                ['key' => 'top', 'label' => __('docs/modal.positions.top_btn'), 'icon' => 'arrow-up'],
                                ['key' => 'center', 'label' => __('docs/modal.positions.center_btn'), 'icon' => 'minimize-2'],
                                ['key' => 'bottom', 'label' => __('docs/modal.positions.bottom_btn'), 'icon' => 'arrow-down'],
                            ];
                        @endphp

                        @foreach ($posDemos as $pos)
                            <vibe:button @click="$dispatch('open-modal', 'modal-pos-{{ $pos['key'] }}')" variant="outline" size="sm">
                                {{ $pos['label'] }}
                            </vibe:button>

                            <vibe:modal id="modal-pos-{{ $pos['key'] }}" position="{{ $pos['key'] }}">
                                <div class="space-y-4">
                                    <div class="space-y-1 pr-6">
                                        <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.positions.modal_title', ['position' => $pos['key']]) }}</h3>
                                        <p class="text-sm text-muted-foreground leading-relaxed">
                                            {!! __('docs/modal.positions.modal_desc', ['position' => $pos['key']]) !!}
                                        </p>
                                    </div>
                                    <div class="flex items-center justify-end pt-3 border-t border-border">
                                        <vibe:button type="button" variant="outline" size="sm" @click="close">
                                            {{ __('docs/modal.positions.btn_close') }}
                                        </vibe:button>
                                    </div>
                                </div>
                            </vibe:modal>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Non-Dismissible / Static Modal --}}
            <section id="modal-statis" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.non_dismissible.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.non_dismissible.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.non_dismissible.preview_title')">
                    <vibe:preview.code>
<vibe:button @click="$dispatch('open-modal', 'modal-static-demo')" variant="destructive" size="sm">
    {{ __('docs/modal.non_dismissible.btn') }}
</vibe:button>

<vibe:modal id="modal-static-demo" :dismissible="false" maxWidth="md">
    <div class="space-y-4">
        <div class="flex items-start gap-3">
            <div class="p-2 rounded-full bg-destructive/10 text-destructive shrink-0 mt-0.5">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>
            <div class="space-y-1">
                <h3 class="text-base font-semibold text-foreground">{{ __('docs/modal.non_dismissible.modal_title') }}</h3>
                <p class="text-sm text-muted-foreground leading-relaxed">
                    {{ __('docs/modal.non_dismissible.modal_desc') }}
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end gap-2 pt-3 border-t border-border">
            <vibe:button type="button" variant="outline" size="sm" @click="close">
                {{ __('docs/modal.non_dismissible.btn_cancel') }}
            </vibe:button>
            <vibe:button type="button" variant="destructive" size="sm" @click="close">
                {{ __('docs/modal.non_dismissible.btn_confirm') }}
            </vibe:button>
        </div>
    </div>
</vibe:modal>
                    </vibe:preview.code>

                    <div class="flex items-center justify-center p-4">
                        <vibe:button @click="$dispatch('open-modal', 'modal-static-demo')" variant="destructive" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            {{ __('docs/modal.non_dismissible.btn') }}
                        </vibe:button>

                        <vibe:modal id="modal-static-demo" :dismissible="false" maxWidth="md">
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 rounded-full bg-destructive/10 text-destructive shrink-0 mt-0.5">
                                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                                            <line x1="12" y1="9" x2="12" y2="13"/>
                                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                                        </svg>
                                    </div>
                                    <div class="space-y-1">
                                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/modal.non_dismissible.modal_title') }}</h3>
                                        <p class="text-sm text-muted-foreground leading-relaxed">
                                            {{ __('docs/modal.non_dismissible.modal_desc') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-2 pt-3 border-t border-border">
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/modal.non_dismissible.btn_cancel') }}
                                    </vibe:button>
                                    <vibe:button type="button" variant="destructive" size="sm" @click="close">
                                        {{ __('docs/modal.non_dismissible.btn_confirm') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </vibe:modal>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Form & Auto-focus --}}
            <section id="formulir-autofokus" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.form_modal.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.form_modal.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.form_modal.preview_title')">
                    <vibe:preview.code>
<vibe:button @click="$dispatch('open-modal', 'modal-form-demo')" variant="primary" size="sm">
    {{ __('docs/modal.form_modal.btn') }}
</vibe:button>

<vibe:modal id="modal-form-demo" maxWidth="lg">
    <div class="space-y-5">
        <div class="space-y-1 pr-6">
            <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.form_modal.modal_title') }}</h3>
            <p class="text-sm text-muted-foreground">{{ __('docs/modal.form_modal.modal_desc') }}</p>
        </div>

        <form class="space-y-4" @submit.prevent="close">
            <vibe:input 
                name="user_name" 
                :label="__('docs/modal.form_modal.name_label')" 
                :placeholder="__('docs/modal.form_modal.name_placeholder')" 
                required 
            />

            <vibe:input 
                name="user_email" 
                type="email" 
                :label="__('docs/modal.form_modal.email_label')" 
                :placeholder="__('docs/modal.form_modal.email_placeholder')" 
                required 
            />

            <vibe:select name="user_role" :label="__('docs/modal.form_modal.role_label')" :placeholder="__('docs/modal.form_modal.role_placeholder')">
                <vibe:select.option value="admin">{{ __('docs/modal.form_modal.role_admin') }}</vibe:select.option>
                <vibe:select.option value="editor">{{ __('docs/modal.form_modal.role_editor') }}</vibe:select.option>
                <vibe:select.option value="user">{{ __('docs/modal.form_modal.role_user') }}</vibe:select.option>
            </vibe:select>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-border">
                <vibe:button type="button" variant="outline" size="sm" @click="close">
                    {{ __('docs/modal.form_modal.btn_cancel') }}
                </vibe:button>
                <vibe:button type="submit" variant="primary" size="sm">
                    {{ __('docs/modal.form_modal.btn_submit') }}
                </vibe:button>
            </div>
        </form>
    </div>
</vibe:modal>
                    </vibe:preview.code>

                    <div class="flex items-center justify-center p-4">
                        <vibe:button @click="$dispatch('open-modal', 'modal-form-demo')" variant="primary" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <line x1="19" y1="8" x2="19" y2="14" />
                                <line x1="22" y1="11" x2="16" y2="11" />
                            </svg>
                            {{ __('docs/modal.form_modal.btn') }}
                        </vibe:button>

                        <vibe:modal id="modal-form-demo" maxWidth="lg">
                            <div class="space-y-5">
                                <div class="space-y-1 pr-6">
                                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.form_modal.modal_title') }}</h3>
                                    <p class="text-sm text-muted-foreground">{{ __('docs/modal.form_modal.modal_desc') }}</p>
                                </div>

                                <form class="space-y-4" @submit.prevent="close">
                                    <vibe:input 
                                        name="user_name" 
                                        :label="__('docs/modal.form_modal.name_label')" 
                                        :placeholder="__('docs/modal.form_modal.name_placeholder')" 
                                        required 
                                    />

                                    <vibe:input 
                                        name="user_email" 
                                        type="email" 
                                        :label="__('docs/modal.form_modal.email_label')" 
                                        :placeholder="__('docs/modal.form_modal.email_placeholder')" 
                                        required 
                                    />

                                    <vibe:select name="user_role" :label="__('docs/modal.form_modal.role_label')" :placeholder="__('docs/modal.form_modal.role_placeholder')">
                                        <vibe:select.option value="admin">{{ __('docs/modal.form_modal.role_admin') }}</vibe:select.option>
                                        <vibe:select.option value="editor">{{ __('docs/modal.form_modal.role_editor') }}</vibe:select.option>
                                        <vibe:select.option value="user">{{ __('docs/modal.form_modal.role_user') }}</vibe:select.option>
                                    </vibe:select>

                                    <div class="flex items-center justify-end gap-2 pt-4 border-t border-border">
                                        <vibe:button type="button" variant="outline" size="sm" @click="close">
                                            {{ __('docs/modal.form_modal.btn_cancel') }}
                                        </vibe:button>
                                        <vibe:button type="submit" variant="primary" size="sm">
                                            {{ __('docs/modal.form_modal.btn_submit') }}
                                        </vibe:button>
                                    </div>
                                </form>
                            </div>
                        </vibe:modal>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Remember / Dismiss Persistence --}}
            <section id="modal-pengumuman" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.remember.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.remember.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.remember.preview_title')">
                    <vibe:preview.code>
{{-- Modal dengan prop remember="true" --}}
<vibe:modal id="modal-announcement-demo" :remember="true" maxWidth="lg">
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">{{ __('docs/modal.remember.modal_title') }}</h3>
        <p class="text-sm text-muted-foreground">
            {{ __('docs/modal.remember.modal_desc') }}
        </p>

        <div class="flex justify-end pt-3 border-t border-border">
            <vibe:button type="button" variant="primary" size="sm" @click="close">
                {{ __('docs/modal.remember.btn_understand') }}
            </vibe:button>
        </div>
    </div>
</vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center justify-center gap-3 p-4" x-data="{
                        resetRemember() {
                            if (window.Alpine && Alpine.store('vibeModals')) {
                                let idx = Alpine.store('vibeModals').dismissed.indexOf('modal-announcement-demo');
                                if (idx > -1) {
                                    Alpine.store('vibeModals').dismissed.splice(idx, 1);
                                }
                            }
                            if (typeof vibeToast === 'function') {
                                vibeToast({
                                    type: 'success',
                                    title: '{{ __('docs/modal.remember.reset_btn') }}',
                                    message: '{{ __('docs/modal.remember.reset_toast') }}'
                                });
                            }
                        }
                    }">
                        <vibe:button @click="$dispatch('open-modal', 'modal-announcement-demo')" variant="outline" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 11 18-5v12L3 14v-3z"/>
                                <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>
                            </svg>
                            {{ __('docs/modal.remember.btn') }}
                        </vibe:button>

                        <vibe:button @click="resetRemember" variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                <path d="M3 3v5h5"/>
                            </svg>
                            {{ __('docs/modal.remember.reset_btn') }}
                        </vibe:button>

                        <vibe:modal id="modal-announcement-demo" :remember="true" maxWidth="lg">
                            <div class="space-y-4">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex size-7 items-center justify-center rounded-lg bg-info/10 text-info">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"/>
                                            <line x1="12" y1="16" x2="12" y2="12"/>
                                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                                        </svg>
                                    </span>
                                    <h3 class="text-lg font-semibold text-foreground">{{ __('docs/modal.remember.modal_title') }}</h3>
                                </div>
                                <p class="text-sm text-muted-foreground leading-relaxed">
                                    {{ __('docs/modal.remember.modal_desc') }}
                                </p>
                                <div class="p-3 rounded-lg bg-muted/40 border border-border text-xs text-muted-foreground">
                                    💡 <strong>Info:</strong> Setelah modal ini ditutup, status dismiss dicatat di LocalStorage. Klik tombol <em>"{{ __('docs/modal.remember.reset_btn') }}"</em> untuk membuka kembali demo ini.
                                </div>
                                <div class="flex items-center justify-end pt-3 border-t border-border">
                                    <vibe:button type="button" variant="primary" size="sm" @click="close">
                                        {{ __('docs/modal.remember.btn_understand') }}
                                    </vibe:button>
                                </div>
                            </div>
                        </vibe:modal>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Livewire Integration --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.livewire.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.livewire.desc') !!}
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <span class="inline-flex size-5 items-center justify-center rounded bg-primary/10 text-primary text-[11px] font-mono font-bold">1</span>
                            {{ __('docs/modal.livewire.backend_title') }}
                        </h3>
                        <vibe:preview.code>
namespace App\Livewire;

use Livewire\Component;

class UserManagement extends Component
{
    public function openCreateModal(): void
    {
        // Membuka modal dari backend PHP
        $this->dispatch('open-modal', 'create-user-modal');
    }

    public function saveUser(): void
    {
        // Logika simpan data...
        
        // Menutup modal setelah berhasil
        $this->dispatch('close-modal', 'create-user-modal');
    }

    public function render()
    {
        return view('livewire.user-management');
    }
}
                        </vibe:preview.code>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <span class="inline-flex size-5 items-center justify-center rounded bg-primary/10 text-primary text-[11px] font-mono font-bold">2</span>
                            {{ __('docs/modal.livewire.frontend_title') }}
                        </h3>
                        <vibe:preview.code>
<div>
    {{-- Trigger memanggil method Livewire --}}
    <vibe:button wire:click="openCreateModal" variant="primary" size="sm">
        Tambah Pengguna Baru
    </vibe:button>

    {{-- Modal yang siap menerima event open-modal dari Livewire --}}
    <vibe:modal id="create-user-modal">
        <form wire:submit="saveUser" class="space-y-4">
            <h3 class="text-lg font-semibold text-foreground">Form Pengguna</h3>

            <vibe:input wire:model="name" label="Nama" required />
            <vibe:input wire:model="email" type="email" label="Email" required />

            <div class="flex justify-end gap-2 pt-4 border-t border-border">
                <vibe:button type="button" variant="outline" size="sm" @click="close">
                    Batal
                </vibe:button>
                <vibe:button type="submit" variant="primary" size="sm">
                    Simpan
                </vibe:button>
            </div>
        </form>
    </vibe:modal>
</div>
                        </vibe:preview.code>
                    </div>
                </div>
            </section>

            {{-- 8. API Reference Table --}}
            <section id="referensi-api" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.props.desc') !!}
                    </p>
                </div>

                {{-- Props Table --}}
                <div class="overflow-x-auto rounded-xl border border-border bg-card shadow-2xs">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-muted/50 text-xs font-semibold uppercase tracking-wider text-muted-foreground border-b border-border">
                            <tr>
                                <th class="px-4 py-3">{{ __('docs/modal.props.th_prop') }}</th>
                                <th class="px-4 py-3">{{ __('docs/modal.props.th_type') }}</th>
                                <th class="px-4 py-3">{{ __('docs/modal.props.th_default') }}</th>
                                <th class="px-4 py-3">{{ __('docs/modal.props.th_desc') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border font-mono text-xs">
                            @foreach (__('docs/modal.props.items') as $item)
                                <tr class="hover:bg-muted/20 transition-colors">
                                    <td class="px-4 py-3 font-semibold text-primary">{{ $item['name'] }}</td>
                                    <td class="px-4 py-3 text-muted-foreground">{{ $item['type'] }}</td>
                                    <td class="px-4 py-3 text-foreground">{{ $item['default'] }}</td>
                                    <td class="px-4 py-3 font-sans text-xs text-muted-foreground">{{ $item['desc'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Window Events Table --}}
                <div class="space-y-2 pt-4">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/modal.props.events_title') }}</h3>
                    <p class="text-sm text-muted-foreground">{{ __('docs/modal.props.events_desc') }}</p>

                    <div class="overflow-x-auto rounded-xl border border-border bg-card shadow-2xs mt-2">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-muted/50 text-xs font-semibold uppercase tracking-wider text-muted-foreground border-b border-border">
                                <tr>
                                    <th class="px-4 py-3">{{ __('docs/modal.props.th_event') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/modal.props.th_payload') }}</th>
                                    <th class="px-4 py-3">{{ __('docs/modal.props.th_event_desc') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border font-mono text-xs">
                                @foreach (__('docs/modal.props.events') as $ev)
                                    <tr class="hover:bg-muted/20 transition-colors">
                                        <td class="px-4 py-3 font-semibold text-primary">{{ $ev['name'] }}</td>
                                        <td class="px-4 py-3 text-foreground">{{ $ev['payload'] }}</td>
                                        <td class="px-4 py-3 font-sans text-xs text-muted-foreground">{{ $ev['desc'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
