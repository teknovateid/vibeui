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
                    @foreach (['id', 'maxWidth', 'position', 'variant', 'dismissible', 'dismissibleButton', 'show', 'persist', 'teleport'] as $p)
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

                        {{-- Komponen Modal dengan Subkomponen Semantik --}}
                        <vibe:modal id="demo-basic-modal">
                            <vibe:modal.header>
                                <span>{{ __('docs/modal.basic_usage.modal_title') }}</span>
                                <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.basic_usage.modal_desc') }}</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <p class="leading-relaxed">
                                    Struktur modal Vibe UI kini mendukung subkomponen modular yang terstruktur, rapi, dan mudah dikustomisasi.
                                </p>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">
                                    {{ __('docs/modal.basic_usage.btn_cancel') }}
                                </vibe:button>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">
                                    {{ __('docs/modal.basic_usage.btn_confirm') }}
                                </vibe:button>
                            </vibe:modal.footer>
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
                            <vibe:modal.header>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex size-7 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                        </svg>
                                    </span>
                                    <span>{{ __('docs/modal.basic_usage.modal_title') }}</span>
                                </div>
                                <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.basic_usage.modal_desc') }}</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground leading-relaxed">
                                    Dialog modal berbasis <em>compound subcomponents</em> ini memiliki header, konten, dan footer yang terisolasi dengan rapi. Anda juga dapat langsung menambahkan custom styling pada dialog modal melalui atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class="..."</code>.
                                </p>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">
                                    {{ __('docs/modal.basic_usage.btn_cancel') }}
                                </vibe:button>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">
                                    {{ __('docs/modal.basic_usage.btn_confirm') }}
                                </vibe:button>
                            </vibe:modal.footer>
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
                            <vibe:modal.header>
                                <span>Modal Size: sm</span>
                                <p class="text-sm font-normal text-muted-foreground">Ukuran modal sm untuk konten ringkas.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan ukuran sm (max-w-sm).</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- 2. Standard (2xl - Default) --}}
                        <vibe:modal id="modal-size-2xl" maxWidth="2xl">
                            <vibe:modal.header>
                                <span>Modal Size: 2xl (Default)</span>
                                <p class="text-sm font-normal text-muted-foreground">Ukuran default 2xl cocok untuk sebagian besar dialog.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan ukuran standar 2xl.</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- 3. Extra Large (4xl) --}}
                        <vibe:modal id="modal-size-4xl" maxWidth="4xl">
                            <vibe:modal.header>
                                <span>Modal Size: 4xl</span>
                                <p class="text-sm font-normal text-muted-foreground">Ukuran luas untuk tabel atau formulir multitab.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan ukuran 4xl.</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- 4. Full Width (full) --}}
                        <vibe:modal id="modal-size-full" maxWidth="full">
                            <vibe:modal.header>
                                <span>Modal Size: full</span>
                                <p class="text-sm font-normal text-muted-foreground">Ukuran layar penuh untuk tampilan dashboard/editor luas.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan ukuran layar penuh.</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center justify-center gap-2 p-4">
                        @php
                            $sizeDemos = [['key' => 'sm', 'label' => __('docs/modal.sizes.sm_btn'), 'variant' => 'outline'], ['key' => 'md', 'label' => __('docs/modal.sizes.md_btn'), 'variant' => 'outline'], ['key' => 'lg', 'label' => __('docs/modal.sizes.lg_btn'), 'variant' => 'outline'], ['key' => '2xl', 'label' => __('docs/modal.sizes.xl2_btn'), 'variant' => 'primary'], ['key' => '4xl', 'label' => __('docs/modal.sizes.xl4_btn'), 'variant' => 'outline'], ['key' => 'full', 'label' => __('docs/modal.sizes.full_btn'), 'variant' => 'outline']];
                        @endphp

                        @foreach ($sizeDemos as $s)
                            <vibe:button @click="$dispatch('open-modal', 'modal-size-{{ $s['key'] }}')" variant="{{ $s['variant'] }}" size="sm">
                                {{ $s['label'] }}
                            </vibe:button>

                            <vibe:modal id="modal-size-{{ $s['key'] }}" maxWidth="{{ $s['key'] }}">
                                <vibe:modal.header>
                                    <span>{{ __('docs/modal.sizes.modal_title', ['size' => $s['key']]) }}</span>
                                    <p class="text-sm font-normal text-muted-foreground">
                                        {!! __('docs/modal.sizes.modal_desc', ['size' => $s['key']]) !!}
                                    </p>
                                </vibe:modal.header>

                                <vibe:modal.content>
                                    <div class="p-3 rounded-lg bg-muted/50 border border-border/60 text-xs font-mono text-muted-foreground">
                                        &lt;vibe:modal id="modal-size-{{ $s['key'] }}" maxWidth="{{ $s['key'] }}"&gt;
                                    </div>
                                    <p class="text-sm text-muted-foreground leading-relaxed">
                                        Dialog modal ini memiliki lebar maksimum <code class="font-mono text-xs font-semibold">{{ $s['key'] }}</code>. Layout isi diatur menggunakan subkomponen <code class="font-mono text-xs">&lt;vibe:modal.header&gt;</code>, <code class="font-mono text-xs">&lt;vibe:modal.content&gt;</code>, dan <code class="font-mono text-xs">&lt;vibe:modal.footer&gt;</code>.
                                    </p>
                                </vibe:modal.content>

                                <vibe:modal.footer>
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/modal.sizes.btn_close') }}
                                    </vibe:button>
                                </vibe:modal.footer>
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
                            <vibe:modal.header>
                                <span>Posisi Atas (Top)</span>
                                <p class="text-sm font-normal text-muted-foreground">Modal muncul di bagian atas viewport.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan position="top".</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- 2. Posisi Tengah (Center - Default) --}}
                        <vibe:modal id="modal-pos-center" position="center">
                            <vibe:modal.header>
                                <span>Posisi Tengah (Center)</span>
                                <p class="text-sm font-normal text-muted-foreground">Modal muncul tepat di tengah layar.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan position="center".</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- 3. Posisi Bawah (Bottom) --}}
                        <vibe:modal id="modal-pos-bottom" position="bottom">
                            <vibe:modal.header>
                                <span>Posisi Bawah (Bottom)</span>
                                <p class="text-sm font-normal text-muted-foreground">Modal muncul di bagian bawah viewport.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Konten modal dengan position="bottom".</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">Tutup</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center justify-center gap-3 p-4">
                        @php
                            $posDemos = [['key' => 'top', 'label' => __('docs/modal.positions.top_btn'), 'icon' => 'arrow-up'], ['key' => 'center', 'label' => __('docs/modal.positions.center_btn'), 'icon' => 'minimize-2'], ['key' => 'bottom', 'label' => __('docs/modal.positions.bottom_btn'), 'icon' => 'arrow-down']];
                        @endphp

                        @foreach ($posDemos as $pos)
                            <vibe:button @click="$dispatch('open-modal', 'modal-pos-{{ $pos['key'] }}')" variant="outline" size="sm">
                                {{ $pos['label'] }}
                            </vibe:button>

                            <vibe:modal id="modal-pos-{{ $pos['key'] }}" position="{{ $pos['key'] }}">
                                <vibe:modal.header>
                                    <span>{{ __('docs/modal.positions.modal_title', ['position' => $pos['key']]) }}</span>
                                    <p class="text-sm font-normal text-muted-foreground">
                                        {!! __('docs/modal.positions.modal_desc', ['position' => $pos['key']]) !!}
                                    </p>
                                </vibe:modal.header>

                                <vibe:modal.content>
                                    <p class="text-sm text-muted-foreground leading-relaxed">
                                        Modal ini diatur menggunakan prop <code class="font-mono text-xs font-semibold">position="{{ $pos['key'] }}"</code>. Seluruh struktur rapi tersusun dalam subkomponen semantik.
                                    </p>
                                </vibe:modal.content>

                                <vibe:modal.footer>
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/modal.positions.btn_close') }}
                                    </vibe:button>
                                </vibe:modal.footer>
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

                        {{-- Modal statis tanpa close backdrop, escape, atau tombol silang X --}}
                        <vibe:modal id="modal-static-demo" :dismissible="false" :dismissibleButton="false" maxWidth="md">
                            <vibe:modal.header>
                                <div class="flex items-center gap-2 text-destructive">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                        <line x1="12" y1="9" x2="12" y2="13" />
                                        <line x1="12" y1="17" x2="12.01" y2="17" />
                                    </svg>
                                    <span>{{ __('docs/modal.non_dismissible.modal_title') }}</span>
                                </div>
                                <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.non_dismissible.modal_desc') }}</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground leading-relaxed">
                                    Tindakan ini permanen. Pengguna harus secara eksplisit memilih salah satu tombol aksi di bawah untuk menutup dialog.
                                </p>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">
                                    {{ __('docs/modal.non_dismissible.btn_cancel') }}
                                </vibe:button>
                                <vibe:button type="button" variant="destructive" size="sm" @click="close">
                                    {{ __('docs/modal.non_dismissible.btn_confirm') }}
                                </vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </vibe:preview.code>

                    <div class="flex items-center justify-center p-4">
                        <vibe:button @click="$dispatch('open-modal', 'modal-static-demo')" variant="destructive" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            {{ __('docs/modal.non_dismissible.btn') }}
                        </vibe:button>

                        <vibe:modal id="modal-static-demo" :dismissible="false" :dismissibleButton="false" maxWidth="md">
                            <vibe:modal.header>
                                <div class="flex items-center gap-2 text-destructive">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                        <line x1="12" y1="9" x2="12" y2="13" />
                                        <line x1="12" y1="17" x2="12.01" y2="17" />
                                    </svg>
                                    <span>{{ __('docs/modal.non_dismissible.modal_title') }}</span>
                                </div>
                                <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.non_dismissible.modal_desc') }}</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground leading-relaxed">
                                    Tindakan ini permanen. Mengklik backdrop luar atau menekan tombol Escape tidak akan menutup dialog ini. Tombol silang penutup (X) juga disembunyikan menggunakan <code class="font-mono text-xs font-semibold">:dismissibleButton="false"</code>.
                                </p>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <vibe:button type="button" variant="outline" size="sm" @click="close">
                                    {{ __('docs/modal.non_dismissible.btn_cancel') }}
                                </vibe:button>
                                <vibe:button type="button" variant="destructive" size="sm" @click="close">
                                    {{ __('docs/modal.non_dismissible.btn_confirm') }}
                                </vibe:button>
                            </vibe:modal.footer>
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
                            <form @submit.prevent="close">
                                <vibe:modal.header>
                                    <span>{{ __('docs/modal.form_modal.modal_title') }}</span>
                                    <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.form_modal.modal_desc') }}</p>
                                </vibe:modal.header>

                                <vibe:modal.content class="space-y-4">
                                    <vibe:input name="user_name" :label="__('docs/modal.form_modal.field_name')" :placeholder="__('docs/modal.form_modal.field_name_placeholder')" required />

                                    <vibe:input name="user_email" type="email" :label="__('docs/modal.form_modal.field_email')" :placeholder="__('docs/modal.form_modal.field_email_placeholder')" required />

                                    <vibe:select name="user_role" :label="__('docs/modal.form_modal.field_role')" :placeholder="__('docs/modal.form_modal.field_role_placeholder')">
                                        <vibe:select.option value="admin">{{ __('docs/modal.form_modal.role_admin') }}</vibe:select.option>
                                        <vibe:select.option value="editor">{{ __('docs/modal.form_modal.role_editor') }}</vibe:select.option>
                                        <vibe:select.option value="viewer">{{ __('docs/modal.form_modal.role_viewer') }}</vibe:select.option>
                                    </vibe:select>
                                </vibe:modal.content>

                                <vibe:modal.footer>
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/modal.form_modal.btn_cancel') }}
                                    </vibe:button>
                                    <vibe:button type="submit" variant="primary" size="sm">
                                        {{ __('docs/modal.form_modal.btn_submit') }}
                                    </vibe:button>
                                </vibe:modal.footer>
                            </form>
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
                            <form @submit.prevent="close">
                                <vibe:modal.header>
                                    <span>{{ __('docs/modal.form_modal.modal_title') }}</span>
                                    <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.form_modal.modal_desc') }}</p>
                                </vibe:modal.header>

                                <vibe:modal.content class="space-y-4">
                                    <vibe:input name="user_name" :label="__('docs/modal.form_modal.field_name')" :placeholder="__('docs/modal.form_modal.field_name_placeholder')" required />

                                    <vibe:input name="user_email" type="email" :label="__('docs/modal.form_modal.field_email')" :placeholder="__('docs/modal.form_modal.field_email_placeholder')" required />

                                    <vibe:select name="user_role" :label="__('docs/modal.form_modal.field_role')" :placeholder="__('docs/modal.form_modal.field_role_placeholder')">
                                        <vibe:select.option value="admin">{{ __('docs/modal.form_modal.role_admin') }}</vibe:select.option>
                                        <vibe:select.option value="editor">{{ __('docs/modal.form_modal.role_editor') }}</vibe:select.option>
                                        <vibe:select.option value="viewer">{{ __('docs/modal.form_modal.role_viewer') }}</vibe:select.option>
                                    </vibe:select>
                                </vibe:modal.content>

                                <vibe:modal.footer>
                                    <vibe:button type="button" variant="outline" size="sm" @click="close">
                                        {{ __('docs/modal.form_modal.btn_cancel') }}
                                    </vibe:button>
                                    <vibe:button type="submit" variant="primary" size="sm">
                                        {{ __('docs/modal.form_modal.btn_submit') }}
                                    </vibe:button>
                                </vibe:modal.footer>
                            </form>
                        </vibe:modal>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Persist / Dismiss Persistence --}}
            <section id="modal-persist" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/modal.persist.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/modal.persist.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/modal.persist.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Modal dengan persistensi status: tetap terbuka saat browser direfresh jika belum ditutup --}}
                        <vibe:button @click="$dispatch('open-modal', 'modal-persist-demo')" variant="outline" size="sm">
                            Buka Modal Persisten
                        </vibe:button>

                        <vibe:modal id="modal-persist-demo" :persist="true" maxWidth="lg">
                            <vibe:modal.header>
                                <span>{{ __('docs/modal.persist.modal_title') }}</span>
                                <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.persist.modal_desc') }}</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <div class="p-3 rounded-lg bg-muted/40 border border-border text-xs text-muted-foreground">
                                    {!! __('docs/modal.persist.reload_tip') !!}
                                </div>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">
                                    {{ __('docs/modal.persist.btn_understand') }}
                                </vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>

                        {{-- 2. Modal pengumuman sekali tampil (langsung muncul di awal, tidak muncul lagi setelah ditutup) --}}
                        <vibe:modal id="modal-announcement" :show="true" :persist="true" maxWidth="lg">
                            <vibe:modal.header>
                                <span>Pengumuman Penting</span>
                                <p class="text-sm font-normal text-muted-foreground">Hanya muncul satu kali di awal sesi.</p>
                            </vibe:modal.header>
                            <vibe:modal.content>
                                <p class="text-sm text-muted-foreground">Setelah ditutup, status tersimpan di LocalStorage dan tidak akan muncul kembali.</p>
                            </vibe:modal.content>
                            <vibe:modal.footer>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">Mengerti</vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-wrap items-center justify-center gap-3 p-4" x-data="{
                        resetPersist() {
                            if (window.Alpine && Alpine.store('vibeModals')) {
                                Alpine.store('vibeModals').reset('modal-persist-demo');
                            } else if (window.VibeModal) {
                                window.VibeModal.reset('modal-persist-demo');
                            }
                            if (typeof vibeToast === 'function') {
                                vibeToast({
                                    type: 'success',
                                    title: '{{ __('docs/modal.persist.reset_btn') }}',
                                    message: '{{ __('docs/modal.persist.reset_toast') }}'
                                });
                            }
                        }
                    }">
                        <vibe:button @click="$dispatch('open-modal', 'modal-persist-demo')" variant="outline" size="sm">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 11 18-5v12L3 14v-3z" />
                                <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                            </svg>
                            {{ __('docs/modal.persist.btn') }}
                        </vibe:button>

                        <vibe:button @click="resetPersist" variant="ghost" size="sm" class="text-muted-foreground hover:text-foreground">
                            <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                            {{ __('docs/modal.persist.reset_btn') }}
                        </vibe:button>

                        <vibe:modal id="modal-persist-demo" :persist="true" maxWidth="lg">
                            <vibe:modal.header>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex size-7 items-center justify-center rounded-lg bg-info/10 text-info">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <line x1="12" y1="16" x2="12" y2="12" />
                                            <line x1="12" y1="8" x2="12.01" y2="8" />
                                        </svg>
                                    </span>
                                    <span>{{ __('docs/modal.persist.modal_title') }}</span>
                                </div>
                                <p class="text-sm font-normal text-muted-foreground">{{ __('docs/modal.persist.modal_desc') }}</p>
                            </vibe:modal.header>

                            <vibe:modal.content>
                                <div class="p-3 rounded-lg bg-muted/40 border border-border text-xs text-muted-foreground">
                                    {!! __('docs/modal.persist.reload_tip') !!}
                                </div>
                            </vibe:modal.content>

                            <vibe:modal.footer>
                                <vibe:button type="button" variant="primary" size="sm" @click="close">
                                    {{ __('docs/modal.persist.btn_understand') }}
                                </vibe:button>
                            </vibe:modal.footer>
                        </vibe:modal>
                    </div>
                </vibe:preview>

                <vibe:card class="inline-flex gap-3 text-sm">
                    <svg class="size-5 text-primary shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <div>
                        {!! __('docs/modal.persist.announcement_note') !!}
                    </div>
                </vibe:card>
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
                                    <form wire:submit="saveUser">
                                        <vibe:modal.header>
                                            <span>Form Pengguna</span>
                                            <p class="text-sm font-normal text-muted-foreground">Isi data akun pengguna baru.</p>
                                        </vibe:modal.header>

                                        <vibe:modal.content class="space-y-4">
                                            <vibe:input wire:model="name" label="Nama" required />
                                            <vibe:input wire:model="email" type="email" label="Email" required />
                                        </vibe:modal.content>

                                        <vibe:modal.footer>
                                            <vibe:button type="button" variant="outline" size="sm" @click="close">
                                                Batal
                                            </vibe:button>
                                            <vibe:button type="submit" variant="primary" size="sm">
                                                Simpan
                                            </vibe:button>
                                        </vibe:modal.footer>
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

                {{-- Subcomponents Anatomy Table --}}
                <div class="space-y-2">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/modal.props.subcomponents_title') }}</h3>
                    <p class="text-sm text-muted-foreground">{{ __('docs/modal.props.subcomponents_desc') }}</p>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/modal.props.th_sub') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/modal.props.th_sub_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/modal.props.subcomponents') as $sub)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $sub['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $sub['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Props Table --}}
                <div class="space-y-2">
                    <h3 class="text-base font-semibold text-foreground">Daftar Properti (Props)</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/modal.props.th_prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/modal.props.th_type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/modal.props.th_default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/modal.props.th_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/modal.props.items') as $item)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $item['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $item['type'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $item['default'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $item['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Window Events Table --}}
                <div class="space-y-2 pt-4">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/modal.props.events_title') }}</h3>
                    <p class="text-sm text-muted-foreground">{{ __('docs/modal.props.events_desc') }}</p>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/modal.props.th_event') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/modal.props.th_payload') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/modal.props.th_event_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach (__('docs/modal.props.events') as $ev)
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $ev['name'] }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground text-xs whitespace-nowrap">{{ $ev['payload'] }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $ev['desc'] }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
