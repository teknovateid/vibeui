<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/form.title')" :description="__('docs/form.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/form.title'), 'url' => '/docs/form']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/form.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/form.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/form.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/form.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">id</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">save-to-storage</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">storage-type: session</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">storage-type: local</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">auto-restore</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">:status="true"</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">delay</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">onSuccess</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">redirect-to</vibe:badge>
                </div>
            </div>

            <div x-data="{
                submittedData: {{ json_encode(session('submitted_data', null)) }},
                submittedAt: '{{ session('submitted_at', '') }}',
                init() {
                    window.addEventListener('vibe-form-submitted', (e) => {
                        const resData = e.detail?.data || {};
                        this.submittedData = resData.submitted_data || resData;
                        this.submittedAt = resData.submitted_at || new Date().toLocaleTimeString();
                    });
                }
            }">
                <template x-if="submittedData">
                    <div class="p-4 rounded-xl border border-success/30 bg-success/10 text-foreground flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-2xs">
                        <div class="flex items-center gap-2.5">
                            <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-success/20 text-success">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5" />
                                </svg>
                            </span>
                            <div>
                                <p class="text-xs font-semibold text-foreground">Pengujian Form (AJAX / Fetch) Berhasil Diposting ke FormController!</p>
                                <p class="text-[11px] text-muted-foreground">Waktu: <span class="font-mono" x-text="submittedAt"></span> • <span x-text="Object.keys(submittedData || {}).length"></span> fields diterima via JSON (tanpa refresh)</p>
                            </div>
                        </div>
                        <vibe:button @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'form-test-submission-modal' }))" variant="outline" size="sm" class="shrink-0 text-xs">
                            Lihat Modal $request->all()
                        </vibe:button>
                    </div>
                </template>
            </div>


            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/form.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:form class="space-y-4 max-w-lg mx-auto" action="{{ route('docs.form.store') }}" method="POST">
                            @csrf

                            <vibe:input name="full_name" label="{{ __('docs/form.basic_usage.name_label') }}" placeholder="{{ __('docs/form.basic_usage.name_placeholder') }}" required />

                            <vibe:input type="email" name="email" label="{{ __('docs/form.basic_usage.email_label') }}" placeholder="{{ __('docs/form.basic_usage.email_placeholder') }}" required />

                            <vibe:textarea name="message" label="{{ __('docs/form.basic_usage.message_label') }}" rows="3" placeholder="{{ __('docs/form.basic_usage.message_placeholder') }}" />

                            <div class="pt-2">
                                <vibe:button type="submit" variant="primary" class="w-full sm:w-auto">
                                    {{ __('docs/form.basic_usage.submit_btn') }}
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl mx-auto p-4 sm:p-6">
                        <vibe:form class="space-y-4" action="{{ route('docs.form.store') }}" method="POST">
                            @csrf
                            <vibe:input name="demo_full_name" label="{{ __('docs/form.basic_usage.name_label') }}" placeholder="{{ __('docs/form.basic_usage.name_placeholder') }}" />

                            <vibe:input type="email" name="demo_email" label="{{ __('docs/form.basic_usage.email_label') }}" placeholder="{{ __('docs/form.basic_usage.email_placeholder') }}" />

                            <vibe:textarea name="demo_message" label="{{ __('docs/form.basic_usage.message_label') }}" rows="3" placeholder="{{ __('docs/form.basic_usage.message_placeholder') }}" />

                            <div class="pt-2 flex items-center justify-end">
                                <vibe:button type="submit" variant="primary">
                                    {{ __('docs/form.basic_usage.submit_btn') }}
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Session Storage (storageType="session") --}}
            <section id="penyimpanan-session-storage" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.session_storage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.session_storage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/form.session_storage.preview_title')">
                    <vibe:preview.code>
                        {{-- Menyimpan draf ke sessionStorage (tab browser) --}}
                        <vibe:form id="checkout-session-form" :save-to-storage="true" storage-type="session" class="space-y-4">
                            <vibe:input name="card_holder" label="{{ __('docs/form.session_storage.card_holder') }}" placeholder="Alex Morgan" />

                            <vibe:input name="card_number" label="{{ __('docs/form.session_storage.card_number') }}" placeholder="TX-2026-9812-4410" />

                            <vibe:textarea name="notes" label="{{ __('docs/form.session_storage.notes') }}" rows="2" placeholder="{{ __('docs/form.session_storage.notes_placeholder') }}" />

                            <div class="flex items-center gap-2 pt-2">
                                <vibe:button type="submit" variant="primary">
                                    {{ __('docs/form.session_storage.submit_btn') }}
                                </vibe:button>
                                <vibe:button type="reset" variant="outline">
                                    {{ __('docs/form.session_storage.clear_btn') }}
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl mx-auto p-4 sm:p-6 space-y-4">
                        <div class="p-3.5 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground flex items-start gap-3">
                            <span class="p-1 rounded bg-primary/10 text-primary shrink-0 mt-0.5">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 16v-4" />
                                    <path d="M12 8h.01" />
                                </svg>
                            </span>
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <vibe:badge variant="outline" size="sm" class="bg-background text-primary border-primary/30">
                                        {{ __('docs/form.session_storage.badge') }}
                                    </vibe:badge>
                                    <span class="font-semibold text-xs text-foreground">window.sessionStorage</span>
                                </div>
                                <p class="text-xs text-muted-foreground leading-relaxed">{{ __('docs/form.session_storage.hint') }}</p>
                            </div>
                        </div>

                        <vibe:form id="demo-checkout-session-form" :save-to-storage="true" storage-type="session" action="{{ route('docs.form.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <vibe:input name="demo_card_holder" label="{{ __('docs/form.session_storage.card_holder') }}" placeholder="Alex Morgan" />

                            <vibe:input name="demo_card_number" label="{{ __('docs/form.session_storage.card_number') }}" placeholder="TX-2026-9812-4410" />

                            <vibe:textarea name="demo_checkout_notes" label="{{ __('docs/form.session_storage.notes') }}" rows="2" placeholder="{{ __('docs/form.session_storage.notes_placeholder') }}" />

                            <div class="flex items-center gap-2 pt-2">
                                <vibe:button type="submit" variant="primary">
                                    {{ __('docs/form.session_storage.submit_btn') }}
                                </vibe:button>
                                <vibe:button type="reset" variant="outline">
                                    {{ __('docs/form.session_storage.clear_btn') }}
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Local Storage (storageType="local") --}}
            <section id="penyimpanan-local-storage" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.local_storage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.local_storage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/form.local_storage.preview_title')">
                    <vibe:preview.code>
                        {{-- Menyimpan draf ke localStorage (tetap ada setelah browser ditutup) --}}
                        <vibe:form id="article-draft-form" :save-to-storage="true" storage-type="local" :expire-hours="48" class="space-y-4">
                            <vibe:input name="article_title" label="{{ __('docs/form.local_storage.article_title') }}" placeholder="{{ __('docs/form.local_storage.article_placeholder') }}" />

                            <vibe:textarea name="content" label="{{ __('docs/form.local_storage.content_label') }}" rows="3" placeholder="{{ __('docs/form.local_storage.content_placeholder') }}" />

                            <div class="flex items-center gap-2 pt-2">
                                <vibe:button type="submit" variant="primary">
                                    {{ __('docs/form.local_storage.submit_btn') }}
                                </vibe:button>
                                <vibe:button type="reset" variant="outline">
                                    {{ __('docs/form.local_storage.reset_btn') }}
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl mx-auto p-4 sm:p-6 space-y-4">
                        <vibe:card class="p-3 text-xs text-muted-foreground flex items-center gap-2">
                            <span class="size-2 rounded-full bg-success"></span>
                            <span>{{ __('docs/form.local_storage.hint') }}</span>
                        </vibe:card>

                        <vibe:form id="demo-article-draft-form" :save-to-storage="true" storage-type="local" :expire-hours="48" action="{{ route('docs.form.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <vibe:input name="demo_article_title" label="{{ __('docs/form.local_storage.article_title') }}" placeholder="{{ __('docs/form.local_storage.article_placeholder') }}" />

                            <vibe:textarea name="demo_article_content" label="{{ __('docs/form.local_storage.content_label') }}" rows="3" placeholder="{{ __('docs/form.local_storage.content_placeholder') }}" />

                            <div class="flex items-center gap-2 pt-2">
                                <vibe:button type="submit" variant="primary">
                                    {{ __('docs/form.local_storage.submit_btn') }}
                                </vibe:button>
                                <vibe:button type="reset" variant="outline">
                                    {{ __('docs/form.local_storage.reset_btn') }}
                                </vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>

                {{-- Peringatan Keamanan Local Storage --}}
                <vibe:card class="border border-warning/20 bg-warning/15 dark:bg-warning/15">
                    <div class="flex items-center gap-2.5 text-warning font-semibold mb-4">
                        <span class="flex size-7 items-center justify-center rounded-lg bg-warning/20 dark:bg-warning/30 text-warning shrink-0">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                <line x1="12" y1="9" x2="12" y2="13" />
                                <line x1="12" y1="17" x2="12.01" y2="17" />
                            </svg>
                        </span>
                        <span>{{ __('docs/form.local_storage.security_title') }}</span>
                    </div>
                    <p class="text-xs text-foreground leading-relaxed">
                        {!! __('docs/form.local_storage.security_desc') !!}
                    </p>
                    <ul class="text-xs text-foreground space-y-1.5 list-disc list-inside">
                        <li>{!! __('docs/form.local_storage.security_points.sensitive') !!}</li>
                        <li>{!! __('docs/form.local_storage.security_points.shared_device') !!}</li>
                        <li>{!! __('docs/form.local_storage.security_points.alternative') !!}</li>
                    </ul>
                </vibe:card>
            </section>

            {{-- 4. Multi-Column Grid Layout --}}
            <section id="tata-letak-grid" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.grid_layout.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.grid_layout.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/form.grid_layout.preview_title')">
                    <vibe:preview.code>
                        <vibe:form class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <vibe:input name="first_name" label="{{ __('docs/form.grid_layout.first_name') }}" placeholder="Alex" />

                            <vibe:input name="last_name" label="{{ __('docs/form.grid_layout.last_name') }}" placeholder="Morgan" />

                            <vibe:input type="tel" name="phone" label="{{ __('docs/form.grid_layout.phone') }}" placeholder="+62 812 3456 7890" />

                            <vibe:input name="role" label="{{ __('docs/form.grid_layout.role') }}" placeholder="Frontend Engineer" />

                            <div class="col-span-1 md:col-span-2">
                                <vibe:textarea name="address" label="{{ __('docs/form.grid_layout.address') }}" rows="2" placeholder="{{ __('docs/form.grid_layout.address_placeholder') }}" />
                            </div>

                            <div class="col-span-1 md:col-span-2 flex items-center justify-end gap-3 pt-2">
                                <vibe:button type="button" variant="outline">{{ __('docs/form.grid_layout.cancel_btn') }}</vibe:button>
                                <vibe:button type="button" variant="primary">{{ __('docs/form.grid_layout.save_btn') }}</vibe:button>
                            </div>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-3xl mx-auto p-4 sm:p-6">
                        <vibe:form class="grid grid-cols-1 md:grid-cols-2 gap-4" action="{{ route('docs.form.store') }}" method="POST">
                            @csrf
                            <vibe:input name="demo_first_name" label="{{ __('docs/form.grid_layout.first_name') }}" placeholder="Alex" />

                            <vibe:input name="demo_last_name" label="{{ __('docs/form.grid_layout.last_name') }}" placeholder="Morgan" />

                            <vibe:input type="tel" name="demo_phone" label="{{ __('docs/form.grid_layout.phone') }}" placeholder="+62 812 3456 7890" />

                            <vibe:input name="demo_role" label="{{ __('docs/form.grid_layout.role') }}" placeholder="Frontend Engineer" />

                            <div class="col-span-1 md:col-span-2">
                                <vibe:textarea name="demo_address" label="{{ __('docs/form.grid_layout.address') }}" rows="2" placeholder="{{ __('docs/form.grid_layout.address_placeholder') }}" />
                            </div>

                            <div class="col-span-1 md:col-span-2 flex items-center justify-end gap-3 pt-2">
                                <vibe:button type="reset" variant="outline">{{ __('docs/form.grid_layout.cancel_btn') }}</vibe:button>
                                <vibe:button type="submit" variant="primary">{{ __('docs/form.grid_layout.save_btn') }}</vibe:button>
                            </div>
                        </vibe:form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Card Form Layout --}}
            <section id="form-dalam-card" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.card_form.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.card_form.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/form.card_form.preview_title')">
                    <vibe:preview.code>
                        <vibe:card class="max-w-xl mx-auto">
                            <vibe:card.header>
                                <vibe:card.title>{{ __('docs/form.card_form.card_title') }}</vibe:card.title>
                                <vibe:card.description>{{ __('docs/form.card_form.card_desc') }}</vibe:card.description>
                            </vibe:card.header>

                            <vibe:card.content>
                                <vibe:form class="space-y-4">
                                    <vibe:input name="username" label="{{ __('docs/form.card_form.username') }}" placeholder="alexmorgan" value="alexmorgan" />

                                    <vibe:textarea name="bio" label="{{ __('docs/form.card_form.bio') }}" rows="3" placeholder="{{ __('docs/form.card_form.bio_placeholder') }}" />
                                </vibe:form>
                            </vibe:card.content>

                            <vibe:card.footer class="flex justify-end gap-2">
                                <vibe:button variant="outline">Batal</vibe:button>
                                <vibe:button variant="primary">{{ __('docs/form.card_form.save_changes') }}</vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl mx-auto p-4 sm:p-6">
                        <vibe:card>
                            <vibe:form id="demo-card-form" action="{{ route('docs.form.store') }}" method="POST">
                                @csrf
                                <vibe:card.header>
                                    <vibe:card.title>{{ __('docs/form.card_form.card_title') }}</vibe:card.title>
                                    <vibe:card.description>{{ __('docs/form.card_form.card_desc') }}</vibe:card.description>
                                </vibe:card.header>

                                <vibe:card.content>
                                    <div class="space-y-4">
                                        <vibe:input name="demo_username" label="{{ __('docs/form.card_form.username') }}" placeholder="alexmorgan" value="alexmorgan" />

                                        <vibe:textarea name="demo_bio" label="{{ __('docs/form.card_form.bio') }}" rows="3" placeholder="{{ __('docs/form.card_form.bio_placeholder') }}" />
                                    </div>
                                </vibe:card.content>

                                <vibe:card.footer class="flex justify-end gap-2">
                                    <vibe:button type="reset" variant="outline">Batal</vibe:button>
                                    <vibe:button type="submit" variant="primary">{{ __('docs/form.card_form.save_changes') }}</vibe:button>
                                </vibe:card.footer>
                            </vibe:form>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Modal & Sheet Awareness --}}
            <section id="integrasi-modal-sheet" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.modal_sheet.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.modal_sheet.desc') !!}
                    </p>
                </div>

                <vibe:card class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="flex size-9 items-center justify-center rounded-lg bg-primary/10 text-primary">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-sm font-semibold text-foreground">Dukungan Otomatis Window Events</h3>
                            <p class="text-xs text-muted-foreground">Kompatibel dengan Livewire reset dan dialog modal dinamis.</p>
                        </div>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Saat <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">&lt;vibe:form&gt;</code> disematkan di dalam <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">&lt;vibe:modal&gt;</code> atau <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">&lt;vibe:sheet&gt;</code>, script otomatis mendeteksi event browser <code class="font-mono text-foreground">open-modal</code> dan <code class="font-mono text-foreground">open-sheet</code> untuk mengembalikan draf isian pengguna meskipun komponen Livewire baru saja menjalankan inisialisasi ulang.
                    </p>
                </vibe:card>
            </section>

            {{-- 8. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/form.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/form.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:form Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:form&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/form.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $formProps = [
                                ['id', 'string|null', 'null', __('docs/form.props_items.id')],
                                ['ajax', 'bool', 'true', 'Aktifkan AJAX/fetch submission. Jika <code>false</code>, form melakukan submit browser standar (full page reload).'],
                                ['saveToStorage', 'bool', 'false', __('docs/form.props_items.saveToStorage')],
                                ['storageType', 'string', "'session'", __('docs/form.props_items.storageType')],
                                ['expireHours', 'int', '24', __('docs/form.props_items.expireHours')],
                                ['status', 'bool|string', 'false', 'Notifikasi otomatis setelah submit. <code>true</code> atau <code>\'toast\'</code> = tampilkan <strong>Toast</strong> (default). <code>\'alert\'</code> = tampilkan pop-up <strong>Alert</strong>.'],
                                ['delay', 'int|null', 'null', 'Jeda waktu (milidetik) sebelum aksi <code>onSuccess</code> atau <code>redirect-to</code> dieksekusi. Default auto <code>1000ms</code> jika status aktif dan ada aksi lanjutan.'],
                                ['redirect-to / redirectTo', 'string|null', 'null', 'URL tujuan redirect setelah submit sukses. Juga mendukung otomatis membaca <code>data.redirect</code> dari JSON respons server.'],
                                ['on-success / onSuccess', 'string|null', 'null', 'Ekspresi JS yang dieksekusi setelah <code>delay</code> saat sukses. Contoh: <code>$vibe.sheet(\'id\').close()</code> atau <code>$vibe.modal(\'id\').close()</code>.'],
                                ['on-error / onError', 'string|null', 'null', 'Ekspresi JS yang dieksekusi saat request gagal/error.'],
                            ];
                        @endphp
                        @foreach ($formProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- Comparison Table: session vs local vs Laravel session --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/form.storage_comparison.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.storage_comparison.columns.mechanism') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.storage_comparison.columns.location') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.storage_comparison.columns.lifetime') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/form.storage_comparison.columns.best_for') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">storageType="session"</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">{{ __('docs/form.storage_comparison.session_location') }}</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/form.storage_comparison.session_lifetime') }}</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/form.storage_comparison.session_best_for') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">storageType="local"</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">{{ __('docs/form.storage_comparison.local_location') }}</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/form.storage_comparison.local_lifetime') }}</vibe:table.cell>
                            <vibe:table.cell class="text-xs text-muted-foreground">{{ __('docs/form.storage_comparison.local_best_for') }} <span class="text-warning font-medium block mt-0.5">{{ __('docs/form.storage_comparison.local_warning') }}</span></vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>

                {{-- Automated Features Table --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/form.features.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/form.features.columns.feature') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/form.features.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">@input.debounce.500ms</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/form.features_items.debounce') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">@submit -> clearStorage()</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/form.features_items.clear') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">open-modal / open-sheet</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{{ __('docs/form.features_items.modal_sheet') }}</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Sanitisasi Internal</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">{!! __('docs/form.features_items.sanitize') !!}</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>


            {{-- 9. Status & Notification --}}
            <section id="notifikasi-status" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Notifikasi Error Otomatis (<code class="font-mono text-lg">:status="true"</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Aktifkan atribut <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">:status="true"</code> agar form otomatis menampilkan notifikasi <strong>error</strong> saat request gagal (validasi, CSRF expired, server error, dll). Secara default menggunakan <strong>Toast</strong>. Gunakan <code class="px-1 py-0.5 rounded bg-muted text-[11px] font-mono text-foreground">status="alert"</code> untuk menampilkan pop-up Alert.
                        Notifikasi saat <strong>sukses</strong> tidak ditampilkan secara otomatis — gunakan <code class="font-mono text-[11px] px-1 py-0.5 rounded bg-muted">onSuccess</code> untuk mengaturnya.
                    </p>
                </div>

                <vibe:preview title="status='toast' — Error Toast (default)">
                    <vibe:preview.code>
                        {{-- Coba submit dengan field kosong atau email tidak valid untuk melihat toast error --}}
                        <vibe:form class="space-y-4 max-w-md mx-auto" action="{{ route('docs.form.store') }}" method="POST" :status="true"
                            onSuccess="$vibe.toast.success('Data berhasil disimpan!')"
                        >
                            @csrf
                            <vibe:input name="name" label="Nama Lengkap" placeholder="Enter your name" required />
                            <vibe:input type="email" name="email" label="Email" placeholder="Enter your email" required />
                            <vibe:button type="submit" variant="primary">Submit</vibe:button>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto p-4 sm:p-6">
                        <vibe:form class="space-y-4" action="{{ route('docs.form.store') }}" method="POST" :status="true"
                            onSuccess="$vibe.toast.success('Data berhasil disimpan!')"
                        >
                            @csrf
                            <vibe:input name="demo_status_name" label="Nama Lengkap" placeholder="Enter your name" />
                            <vibe:input type="email" name="demo_status_email" label="Email" placeholder="Enter your email" />
                            <vibe:button type="submit" variant="primary">Submit</vibe:button>
                        </vibe:form>
                    </div>
                </vibe:preview>

                <vibe:preview title="status='alert' — Error Alert Pop-up">
                    <vibe:preview.code>
                        {{-- Coba submit dengan field kosong untuk melihat alert error pop-up --}}
                        <vibe:form class="space-y-4 max-w-md mx-auto" action="{{ route('docs.form.store') }}" method="POST" status="alert"
                            onSuccess="$vibe.alert.success('Data berhasil disimpan!')"
                        >
                            @csrf
                            <vibe:input name="name" label="Nama Lengkap" placeholder="Enter your name" required />
                            <vibe:button type="submit" variant="primary">Submit</vibe:button>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto p-4 sm:p-6">
                        <vibe:form class="space-y-4" action="{{ route('docs.form.store') }}" method="POST" status="alert"
                            onSuccess="$vibe.alert.success('Data berhasil disimpan!')"
                        >
                            @csrf
                            <vibe:input name="demo_alert_name" label="Nama Lengkap" placeholder="Enter your name" />
                            <vibe:button type="submit" variant="primary">Submit</vibe:button>
                        </vibe:form>
                    </div>
                </vibe:preview>

                {{-- Error Parsing Info --}}
                <vibe:card class="p-5 space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="flex size-9 items-center justify-center rounded-lg bg-destructive/10 text-destructive">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m14.5 9.5-5 5m0-5 5 5"/></svg>
                        </span>
                        <div>
                            <h3 class="text-sm font-semibold text-foreground">Error Parsing Otomatis</h3>
                            <p class="text-xs text-muted-foreground">Saat request gagal, sistem secara otomatis mengurai respons server dan menampilkan pesan yang jelas.</p>
                        </div>
                    </div>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>HTTP Status</vibe:table.column>
                            <vibe:table.column>Judul Notifikasi</vibe:table.column>
                            <vibe:table.column>Pesan</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @foreach([
                                ['422 Unprocessable Entity', 'Gagal Validasi', 'Menampilkan daftar error per-field dari Laravel validation (bullet points).'],
                                ['405 Method Not Allowed', '405 Method Not Allowed', 'Metode HTTP tidak didukung. Periksa method form atau route.'],
                                ['419 Page Expired', '419 Sesi Kedaluwarsa', 'Token CSRF kedaluwarsa. Silakan refresh halaman.'],
                                ['401 Unauthorized', '401 Tidak Terautentikasi', 'Sesi login Anda telah berakhir.'],
                                ['403 Forbidden', '403 Akses Ditolak', 'Anda tidak memiliki izin untuk aksi ini.'],
                                ['404 Not Found', '404 Endpoint Tidak Ditemukan', 'Endpoint yang dituju tidak ditemukan di server.'],
                                ['429 Too Many Requests', '429 Terlalu Banyak Permintaan', 'Terlalu banyak permintaan. Harap tunggu beberapa saat.'],
                                ['500 Server Error', '500 Terjadi Kesalahan Server', 'Error dari server (data.message) atau pesan generik.'],
                                ['Network Failure', 'Kesalahan Jaringan', 'Tidak dapat terhubung ke server. Periksa koneksi.'],
                            ] as [$status, $title, $message])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap text-xs">{{ $status }}</vibe:table.cell>
                                    <vibe:table.cell class="font-semibold text-foreground text-xs whitespace-nowrap">{{ $title }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $message }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </vibe:card>
            </section>

            {{-- 10. Post-Submit Actions --}}
            <section id="aksi-pasca-submit" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Aksi Pasca-Submit (<code class="font-mono text-lg">onSuccess</code>, <code class="font-mono text-lg">delay</code>, <code class="font-mono text-lg">redirect-to</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan atribut <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">onSuccess</code> untuk menjalankan ekspresi JavaScript setelah submit sukses.
                        <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">status</code> hanya menampilkan notifikasi <strong>error</strong> secara otomatis — notifikasi sukses, penutupan modal/sheet, dan redirect sepenuhnya diatur dari <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">onSuccess</code>.
                    </p>
                </div>

                <vibe:preview title="onSuccess: Toast + Tutup Sheet setelah submit">
                    <vibe:preview.code>
                        <vibe:button variant="primary" size="sm" @click="$vibe.sheet('demo-form-sheet').open()">
                            Buka Sheet Form
                        </vibe:button>

                        <vibe:sheet id="demo-form-sheet" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="400">
                            <vibe:form
                                action="{{ route('docs.form.store') }}"
                                method="POST"
                                :status="true"
                                onSuccess="$vibe.sheet('demo-form-sheet').close(); $vibe.toast.success('Data berhasil disimpan!')"
                            >
                                @csrf

                                <vibe:sheet.header class="flex items-center justify-between">
                                    <h3 class="font-semibold text-foreground">Form di dalam Sheet</h3>
                                    <vibe:sheet.close />
                                </vibe:sheet.header>

                                <vibe:sheet.content class="space-y-3">
                                    <vibe:input name="sheet_name" label="Nama" placeholder="Enter your name" />
                                    <vibe:input type="email" name="sheet_email" label="Email" placeholder="Enter your email" />
                                </vibe:sheet.content>

                                <vibe:sheet.footer>
                                    <vibe:button type="submit" variant="primary" class="w-full">Simpan</vibe:button>
                                </vibe:sheet.footer>
                            </vibe:form>
                        </vibe:sheet>
                    </vibe:preview.code>
                    <div class="p-4 flex justify-center">
                        <vibe:button variant="primary" size="sm" @click="$vibe.sheet('demo-form-sheet').open()">Buka Sheet Form</vibe:button>
                        <vibe:sheet id="demo-form-sheet" position="right" layout="fixed" behavior="collapsible" defaultState="collapsed" :closeOnOutsideClick="true" :defaultSize="400">
                            <vibe:form action="{{ route('docs.form.store') }}" method="POST" :status="true" onSuccess="$vibe.sheet('demo-form-sheet').close(); $vibe.toast.success('Data berhasil disimpan!')">
                                @csrf
                                <vibe:sheet.header class="flex items-center justify-between">
                                    <h3 class="font-semibold text-foreground">Form di dalam Sheet</h3>
                                    <vibe:sheet.close />
                                </vibe:sheet.header>
                                <vibe:sheet.content class="space-y-3">
                                    <vibe:input name="demo_sheet_name" label="Nama" placeholder="Enter your name" />
                                    <vibe:input type="email" name="demo_sheet_email" label="Email" placeholder="Enter your email" />
                                </vibe:sheet.content>
                                <vibe:sheet.footer>
                                    <vibe:button type="submit" variant="primary" class="w-full">Simpan</vibe:button>
                                </vibe:sheet.footer>
                            </vibe:form>
                        </vibe:sheet>
                    </div>
                </vibe:preview>

                {{-- Reference Table --}}
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>Atribut</vibe:table.column>
                        <vibe:table.column>Contoh Nilai</vibe:table.column>
                        <vibe:table.column>Keterangan</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @foreach([
                            ['onSuccess / on-success', '$vibe.sheet(\'id\').close(); $vibe.toast.success(\'Berhasil!\')', 'Tutup sheet + tampilkan toast sukses setelah submit.'],
                            ['onSuccess / on-success', '$vibe.modal(\'id\').close(); $vibe.toast.success(\'Berhasil!\')', 'Tutup modal + tampilkan toast sukses setelah submit.'],
                            ['delay', '500', 'Jeda (ms) sebelum onSuccess dieksekusi. Default 0.'],
                            ['redirect-to', '/users', 'URL tujuan setelah submit sukses (atau dari data.redirect respons server).'],
                        ] as [$prop, $example, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-xs text-muted-foreground">{{ $example }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground text-sm">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

            {{-- 11. Confirm Submit --}}
            <section id="konfirmasi-submit" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Konfirmasi Submit (<code class="font-mono text-lg">this.submit()</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Untuk meminta konfirmasi sebelum form dikirim, gunakan <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">$vibe.alert.confirm(message, callback, title?)</code>
                        bersama method <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">this.submit()</code> yang tersedia secara built-in di dalam scope form.
                        Tombol cukup bertipe <code class="font-mono text-xs bg-muted px-1 py-0.5 rounded">type="button"</code> agar tidak langsung submit.
                    </p>
                </div>

                <vibe:preview title="Konfirmasi via $vibe.alert.confirm + this.submit()">
                    <vibe:preview.code>
                        <vibe:form
                            action="{{ route('docs.form.store') }}"
                            method="POST"
                            :status="true"
                            onSuccess="$vibe.toast.success('Data berhasil disimpan!')"
                        >
                            @csrf
                            <vibe:input name="name" label="Nama" placeholder="Enter your name" />
                            <vibe:input type="email" name="email" label="Email" placeholder="Enter your email" />

                            {{-- Tombol type="button", memicu alert konfirmasi, lalu this.submit() --}}
                            <vibe:button
                                type="button"
                                variant="primary"
                                @click="$vibe.alert.confirm('Apakah Anda yakin ingin menyimpan data ini?', () => this.submit())"
                            >
                                Simpan dengan Konfirmasi
                            </vibe:button>
                        </vibe:form>
                    </vibe:preview.code>
                    <div class="w-full max-w-md mx-auto p-4 sm:p-6">
                        <vibe:form class="space-y-4" action="{{ route('docs.form.store') }}" method="POST" :status="true"
                            onSuccess="$vibe.toast.success('Data berhasil disimpan!')"
                        >
                            @csrf
                            <vibe:input name="demo_confirm_name" label="Nama" placeholder="Enter your name" />
                            <vibe:input type="email" name="demo_confirm_email" label="Email" placeholder="Enter your email" />
                            <vibe:button
                                type="button"
                                variant="primary"
                                @click="$vibe.alert.confirm('Apakah Anda yakin ingin menyimpan data ini?', () => this.submit())"
                            >
                                Simpan dengan Konfirmasi
                            </vibe:button>
                        </vibe:form>
                    </div>
                </vibe:preview>

                {{-- Full contoh dengan judul kustom --}}
                <vibe:preview title="Konfirmasi dengan Judul Kustom">
                    <vibe:preview.code>
                        <vibe:button
                            type="button"
                            variant="destructive"
                            @click="$vibe.alert.confirm(
                                'Tindakan ini tidak dapat dibatalkan. Yakin ingin menghapus?',
                                () => this.submit(),
                                'Konfirmasi Penghapusan'
                            )"
                        >
                            Hapus Data
                        </vibe:button>
                    </vibe:preview.code>
                </vibe:preview>

                {{-- API Reference --}}
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>API</vibe:table.column>
                        <vibe:table.column>Signature</vibe:table.column>
                        <vibe:table.column>Keterangan</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @foreach([
                            ['this.submit()', 'submit()', 'Method built-in form. Mengirim form via AJAX (sama seperti @submit) tanpa memerlukan event dari browser.'],
                            ['$vibe.alert.confirm()', 'confirm(message, onConfirm, title?)', 'Memunculkan dialog Alert konfirmasi. Jika user klik Konfirmasi, onConfirm callback dieksekusi.'],
                            ['$vibe.alert.confirm()', 'confirm({ message, title, confirmButton, ... })', 'Object form — mendukung penuh konfigurasi Alert kustom.'],
                        ] as [$api, $signature, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap text-xs">{{ $api }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-xs text-muted-foreground">{{ $signature }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground text-sm">{{ $desc }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
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
