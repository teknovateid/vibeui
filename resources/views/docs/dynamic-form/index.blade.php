<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/dynamic-form.title')" :description="__('docs/dynamic-form.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/dynamic-form.title'), 'url' => '/docs/dynamic-form']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/dynamic-form.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/dynamic-form.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/dynamic-form.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/dynamic-form.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">name="experiences"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">variant="card|table|bordered|ghost"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">min="1" max="10"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:allow-reorder="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:allow-duplicate="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:collapsible="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;x-slot:template&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:schema="[...]"</vibe:badge>
                    <vibe:badge variant="primary" size="sm" class="font-mono text-[11px]">&lt;vibe:select.remote&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Penggunaan Dasar (Card Variant) --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dynamic-form.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dynamic-form.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dynamic-form.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:dynamic-form name="experiences" label="Riwayat Pengalaman Kerja" description="Tambahkan satu atau lebih pengalaman kerja Anda." min="1" max="5" add-text="Tambah Pengalaman" variant="card" :allow-reorder="true" :allow-duplicate="true">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <vibe:input name="company" label="Perusahaan" placeholder="PT Contoh Nama" required />
                                <vibe:input name="position" label="Posisi / Jabatan" placeholder="Web Developer" required />
                                <vibe:select name="type" label="Tipe Pekerjaan" placeholder="Pilih status kerja" :options="[
                                    'fulltime' => 'Purna Waktu (Full-time)',
                                    'contract' => 'Kontrak',
                                    'freelance' => 'Freelance / Remote'
                                ]" />
                                <vibe:date-time name="start_date" label="Tanggal Mulai Bekerja" placeholder="Pilih tanggal..." />
                                <vibe:textarea name="notes" label="Deskripsi Pekerjaan" rows="2" class="md:col-span-2" placeholder="Tuliskan ringkasan tanggung jawab..." />
                            </div>
                        </vibe:dynamic-form>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-2">
                        <vibe:dynamic-form name="experiences_demo" label="Riwayat Pengalaman Kerja" description="Tambahkan satu atau lebih pengalaman kerja Anda." min="1" max="5" add-text="Tambah Pengalaman" variant="card" :allow-reorder="true" :allow-duplicate="true">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <vibe:input name="company" label="Perusahaan" placeholder="PT Contoh Nama" required />
                                <vibe:input name="position" label="Posisi / Jabatan" placeholder="Web Developer" required />
                                <vibe:select name="type" label="Tipe Pekerjaan" placeholder="Pilih status kerja" :options="[
                                    'fulltime' => 'Purna Waktu (Full-time)',
                                    'contract' => 'Kontrak',
                                    'freelance' => 'Freelance / Remote'
                                ]" />
                                <vibe:date-time name="start_date" label="Tanggal Mulai Bekerja" placeholder="Pilih tanggal..." />
                                <vibe:textarea name="notes" label="Deskripsi Pekerjaan" rows="2" class="md:col-span-2" placeholder="Tuliskan ringkasan tanggung jawab..." />
                            </div>
                        </vibe:dynamic-form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Mode Edit dengan PHP @foreach --}}
            <section id="mode-foreach" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dynamic-form.foreach_mode.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dynamic-form.foreach_mode.desc') !!}
                    </p>
                </div>

                @php
                    // Simulasi data dari database
                    $demoExisting = [
                        [
                            'id' => 101,
                            'company' => 'PT Teknovate Solution',
                            'position' => 'Senior Frontend Engineer',
                            'type' => 'fulltime',
                            'start_date' => '2023-02-15',
                            'notes' => 'Mengembangkan arsitektur UI berbasis Blade dan Tailwind CSS.',
                        ],
                        [
                            'id' => 102,
                            'company' => 'Inovasi Digital Labs',
                            'position' => 'UI/UX Designer',
                            'type' => 'contract',
                            'start_date' => '2022-06-01',
                            'notes' => 'Merancang design system dan prototipe aplikasi mobile.',
                        ],
                    ];
                    $userCareers = $demoExisting;
                @endphp

                <vibe:preview :title="__('docs/dynamic-form.foreach_mode.preview_title')">
                    <vibe:preview.code>
                        <vibe:dynamic-form name="careers" label="Riwayat Karir Pengguna" variant="card" add-text="Tambah Riwayat Baru">
                            {{-- 1. Loop Data Lama dengan Blade @foreach --}}
                            @foreach ($userCareers as $index => $item)
                                <vibe:dynamic-form.item :index="$index" :title="$item['company']">
                                    <input type="hidden" name="careers[{{ $index }}][id]" value="{{ $item['id'] }}" />

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <vibe:input name="careers[{{ $index }}][company]" label="Perusahaan" value="{{ $item['company'] }}" required />
                                        <vibe:input name="careers[{{ $index }}][position]" label="Jabatan" value="{{ $item['position'] }}" required />
                                        <vibe:select name="careers[{{ $index }}][type]" label="Tipe" :value="$item['type']" :options="['fulltime' => 'Full-time', 'contract' => 'Kontrak', 'freelance' => 'Freelance']" />
                                        <vibe:date-time name="careers[{{ $index }}][start_date]" label="Tanggal Mulai" :value="$item['start_date']" />
                                        <vibe:textarea name="careers[{{ $index }}][notes]" label="Catatan" class="md:col-span-2">{{ $item['notes'] }}</vibe:textarea>
                                    </div>
                                </vibe:dynamic-form.item>
                            @endforeach

                            {{-- 2. Cetak Biru untuk Baris Baru --}}
                            <x-slot:template>
                                <vibe:dynamic-form.item index="__INDEX__" title="Riwayat Baru">
                                    <input type="hidden" name="careers[__INDEX__][id]" value="" />

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <vibe:input name="careers[__INDEX__][company]" label="Perusahaan" placeholder="Nama perusahaan..." required />
                                        <vibe:input name="careers[__INDEX__][position]" label="Jabatan" placeholder="Posisi..." required />
                                        <vibe:select name="careers[__INDEX__][type]" label="Tipe" :options="['fulltime' => 'Full-time', 'contract' => 'Kontrak', 'freelance' => 'Freelance']" />
                                        <vibe:date-time name="careers[__INDEX__][start_date]" label="Tanggal Mulai" />
                                        <vibe:textarea name="careers[__INDEX__][notes]" label="Catatan" class="md:col-span-2" />
                                    </div>
                                </vibe:dynamic-form.item>
                            </x-slot:template>
                        </vibe:dynamic-form>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-2">
                        <vibe:dynamic-form name="careers_demo" label="Riwayat Karir Pengguna" variant="card" add-text="Tambah Riwayat Baru">
                            @foreach ($demoExisting as $index => $item)
                                <vibe:dynamic-form.item :index="$index" :title="$item['company']">
                                    <input type="hidden" name="careers_demo[{{ $index }}][id]" value="{{ $item['id'] }}" />

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <vibe:input name="careers_demo[{{ $index }}][company]" label="Perusahaan" value="{{ $item['company'] }}" required />
                                        <vibe:input name="careers_demo[{{ $index }}][position]" label="Jabatan" value="{{ $item['position'] }}" required />
                                        <vibe:select name="careers_demo[{{ $index }}][type]" label="Tipe" :value="$item['type']" :options="['fulltime' => 'Full-time', 'contract' => 'Kontrak', 'freelance' => 'Freelance']" />
                                        <vibe:date-time name="careers_demo[{{ $index }}][start_date]" label="Tanggal Mulai" :value="$item['start_date']" />
                                        <vibe:textarea name="careers_demo[{{ $index }}][notes]" label="Catatan" class="md:col-span-2">{{ $item['notes'] }}</vibe:textarea>
                                    </div>
                                </vibe:dynamic-form.item>
                            @endforeach

                            <x-slot:template>
                                <vibe:dynamic-form.item index="__INDEX__" title="Riwayat Baru">
                                    <input type="hidden" name="careers_demo[__INDEX__][id]" value="" />

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <vibe:input name="careers_demo[__INDEX__][company]" label="Perusahaan" placeholder="Nama perusahaan..." required />
                                        <vibe:input name="careers_demo[__INDEX__][position]" label="Jabatan" placeholder="Posisi..." required />
                                        <vibe:select name="careers_demo[__INDEX__][type]" label="Tipe" :options="['fulltime' => 'Full-time', 'contract' => 'Kontrak', 'freelance' => 'Freelance']" />
                                        <vibe:date-time name="careers_demo[__INDEX__][start_date]" label="Tanggal Mulai" />
                                        <vibe:textarea name="careers_demo[__INDEX__][notes]" label="Catatan" class="md:col-span-2" />
                                    </div>
                                </vibe:dynamic-form.item>
                            </x-slot:template>
                        </vibe:dynamic-form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Table Variant --}}
            <section id="varian-tabel" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dynamic-form.table_variant.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dynamic-form.table_variant.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dynamic-form.table_variant.preview_title')">
                    <vibe:preview.code>
                        <vibe:dynamic-form name="order_items" label="Daftar Barang Pesanan" variant="table" add-text="Tambah Baris Barang" min="1">
                            <div class="grid grid-cols-12 gap-3 items-center">
                                <div class="col-span-12 md:col-span-5">
                                    <vibe:input name="item_name" placeholder="Nama produk / layanan" required />
                                </div>
                                <div class="col-span-6 md:col-span-3">
                                    <vibe:select name="category" placeholder="Pilih Kategori" :options="['hw' => 'Hardware', 'sw' => 'Software', 'srv' => 'Layanan Support']" />
                                </div>
                                <div class="col-span-6 md:col-span-2">
                                    <vibe:input name="qty" type="number" placeholder="Qty" value="1" min="1" />
                                </div>
                                <div class="col-span-12 md:col-span-2">
                                    <vibe:date-time name="due_date" placeholder="Tgl kirim" />
                                </div>
                            </div>
                        </vibe:dynamic-form>
                    </vibe:preview.code>

                    <div class="w-full max-w-3xl mx-auto p-2">
                        <vibe:dynamic-form name="order_items_demo" label="Daftar Barang Pesanan" variant="table" add-text="Tambah Baris Barang" min="1">
                            <div class="grid grid-cols-12 gap-3 items-center">
                                <div class="col-span-12 md:col-span-5">
                                    <vibe:input name="item_name" placeholder="Nama produk / layanan" required />
                                </div>
                                <div class="col-span-6 md:col-span-3">
                                    <vibe:select name="category" placeholder="Pilih Kategori" :options="['hw' => 'Hardware', 'sw' => 'Software', 'srv' => 'Layanan Support']" />
                                </div>
                                <div class="col-span-6 md:col-span-2">
                                    <vibe:input name="qty" type="number" placeholder="Qty" value="1" min="1" />
                                </div>
                                <div class="col-span-12 md:col-span-2">
                                    <vibe:date-time name="due_date" placeholder="Tgl kirim" />
                                </div>
                            </div>
                        </vibe:dynamic-form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Mode Skema (Schema Mode) --}}
            <section id="mode-skema" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dynamic-form.schema_mode.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dynamic-form.schema_mode.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dynamic-form.schema_mode.preview_title')">
                    <vibe:preview.code>
                        <vibe:dynamic-form name="education" label="Riwayat Pendidikan" :schema="[
                            ['type' => 'input', 'name' => 'institution', 'label' => 'Nama Kampus / Sekolah', 'required' => true],
                            ['type' => 'select', 'name' => 'degree', 'label' => 'Jenjang', 'options' => ['s1' => 'S1 Sarjana', 's2' => 'S2 Magister', 'd3' => 'D3 Diploma']],
                            ['type' => 'date-time', 'name' => 'graduation_date', 'label' => 'Tgl Kelulusan'],
                            ['type' => 'textarea', 'name' => 'achievements', 'label' => 'Penghargaan / Aktivitas', 'colSpan' => 2]
                        ]" />
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-2">
                        <vibe:dynamic-form name="education_demo" label="Riwayat Pendidikan" :schema="[
                            ['type' => 'input', 'name' => 'institution', 'label' => 'Nama Kampus / Sekolah', 'required' => true],
                            ['type' => 'select', 'name' => 'degree', 'label' => 'Jenjang', 'options' => ['s1' => 'S1 Sarjana', 's2' => 'S2 Magister', 'd3' => 'D3 Diploma']],
                            ['type' => 'date-time', 'name' => 'graduation_date', 'label' => 'Tgl Kelulusan'],
                            ['type' => 'textarea', 'name' => 'achievements', 'label' => 'Penghargaan / Aktivitas', 'colSpan' => 2]
                        ]" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Integrasi Select Berbasis API (vibe:select.remote) --}}
            <section id="select-remote" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/dynamic-form.select_remote.title') }}</h2>
                        <vibe:badge variant="primary" size="sm">Baru</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dynamic-form.select_remote.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dynamic-form.select_remote.preview_title')" minHeight="360px">
                    <vibe:preview.code>
                        <vibe:dynamic-form name="project_tasks" :label="__('docs/dynamic-form.select_remote.form_label')" :description="__('docs/dynamic-form.select_remote.form_desc')" min="1" max="5" :add-text="__('docs/dynamic-form.select_remote.add_task')" variant="card" :allow-reorder="true" :allow-duplicate="true">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <vibe:input name="task_title" :label="__('docs/dynamic-form.select_remote.task_title')" :placeholder="__('docs/dynamic-form.select_remote.task_placeholder')" required />
                                <vibe:select.remote name="assignee_id" :label="__('docs/dynamic-form.select_remote.assignee')" :placeholder="__('docs/dynamic-form.select_remote.assignee_placeholder')" :api="route('docs.select.api')" clearable keyboard />
                                <vibe:select name="priority" :label="__('docs/dynamic-form.select_remote.priority')" :placeholder="__('docs/dynamic-form.select_remote.priority_placeholder')" :options="[
                                    'low' => 'Rendah (Low)',
                                    'medium' => 'Sedang (Medium)',
                                    'high' => 'Tinggi (High)',
                                    'urgent' => 'Mendesak (Urgent)'
                                ]" />
                                <vibe:date-time name="due_date" :label="__('docs/dynamic-form.select_remote.due_date')" :placeholder="__('docs/dynamic-form.select_remote.due_placeholder')" />
                            </div>
                        </vibe:dynamic-form>
                    </vibe:preview.code>

                    <div class="w-full max-w-2xl mx-auto p-2">
                        <vibe:dynamic-form name="project_tasks_demo" :label="__('docs/dynamic-form.select_remote.form_label')" :description="__('docs/dynamic-form.select_remote.form_desc')" min="1" max="5" :add-text="__('docs/dynamic-form.select_remote.add_task')" variant="card" :allow-reorder="true" :allow-duplicate="true">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <vibe:input name="task_title" :label="__('docs/dynamic-form.select_remote.task_title')" :placeholder="__('docs/dynamic-form.select_remote.task_placeholder')" required />
                                <vibe:select.remote name="assignee_id" :label="__('docs/dynamic-form.select_remote.assignee')" :placeholder="__('docs/dynamic-form.select_remote.assignee_placeholder')" :api="route('docs.select.api')" clearable keyboard />
                                <vibe:select name="priority" :label="__('docs/dynamic-form.select_remote.priority')" :placeholder="__('docs/dynamic-form.select_remote.priority_placeholder')" :options="[
                                    'low' => 'Rendah (Low)',
                                    'medium' => 'Sedang (Medium)',
                                    'high' => 'Tinggi (High)',
                                    'urgent' => 'Mendesak (Urgent)'
                                ]" />
                                <vibe:date-time name="due_date" :label="__('docs/dynamic-form.select_remote.due_date')" :placeholder="__('docs/dynamic-form.select_remote.due_placeholder')" />
                            </div>
                        </vibe:dynamic-form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Pengujian Form Submit (Live Demo) --}}
            <section id="pengujian-submit" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/dynamic-form.test_submit.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/dynamic-form.test_submit.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/dynamic-form.test_submit.preview_title')">
                    <vibe:preview.code>
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <vibe:dynamic-form name="members" :label="__('docs/dynamic-form.test_form.label')" :description="__('docs/dynamic-form.test_form.desc')" min="1" max="4" :add-text="__('docs/dynamic-form.test_form.add_member')" variant="card" :allow-reorder="true" :allow-duplicate="true">
                                <div class="space-y-4">
                                    {{-- 1. Input, Select Remote, Select, Date-time --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <vibe:input name="member_name" :label="__('docs/dynamic-form.test_form.member_name')" :placeholder="__('docs/dynamic-form.test_form.name_placeholder')" required />
                                        <vibe:select.remote name="supervisor_id" :label="__('docs/dynamic-form.test_form.supervisor')" :placeholder="__('docs/dynamic-form.test_form.supervisor_placeholder')" :api="route('docs.select.api')" clearable keyboard />
                                        <vibe:select name="role" :label="__('docs/dynamic-form.test_form.role')" :options="[
                                            'lead' => 'Project Lead',
                                            'dev' => 'Developer',
                                            'ui_ux' => 'UI/UX Designer',
                                            'qa' => 'QA Engineer'
                                        ]" :placeholder="__('docs/dynamic-form.test_form.role_placeholder')" />
                                        <vibe:date-time name="join_date" :label="__('docs/dynamic-form.test_form.join_date')" :placeholder="__('docs/dynamic-form.test_form.join_placeholder')" />
                                    </div>

                                    {{-- 2. Textarea, Range, Switch --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <vibe:textarea name="notes" :label="__('docs/dynamic-form.test_form.notes')" rows="3" :placeholder="__('docs/dynamic-form.test_form.notes_placeholder')" />
                                        <div class="space-y-3">
                                            <vibe:range name="skill_score" :label="__('docs/dynamic-form.test_form.skill_score')" :min="0" :max="100" :step="5" :value="80" :showValue="true" valueSuffix="%" />
                                            <vibe:switch name="is_remote" :label="__('docs/dynamic-form.test_form.is_remote')" :description="__('docs/dynamic-form.test_form.remote_desc')" :checked="true" />
                                        </div>
                                    </div>

                                    {{-- 3. Radio, Checkbox, Filepond --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-border/40">
                                        <div class="space-y-1.5">
                                            <label class="block text-xs font-semibold text-foreground">{{ __('docs/dynamic-form.test_form.contract_type') }}</label>
                                            <vibe:radio name="contract_type" value="fulltime" label="Full-Time" :checked="true" />
                                            <vibe:radio name="contract_type" value="contract" :label="__('docs/dynamic-form.test_form.contract')" />
                                            <vibe:radio name="contract_type" value="freelance" label="Freelance" />
                                        </div>
                                        <div class="space-y-1.5">
                                            <label class="block text-xs font-semibold text-foreground">{{ __('docs/dynamic-form.test_form.facilities') }}</label>
                                            <vibe:checkbox name="has_laptop" value="1" :label="__('docs/dynamic-form.test_form.laptop')" :checked="true" />
                                            <vibe:checkbox name="has_server_access" value="1" :label="__('docs/dynamic-form.test_form.server_access')" />
                                            <vibe:checkbox name="signed_nda" value="1" :label="__('docs/dynamic-form.test_form.signed_nda')" :checked="true" />
                                        </div>
                                    </div>
                                    <vibe:filepond name="avatar" :label="__('docs/dynamic-form.test_form.avatar')" size="sm" :imagePreview="true" />
                                </div>
                            </vibe:dynamic-form>

                            <vibe:button type="submit" variant="primary" class="mt-4">
                                {{ __('docs/dynamic-form.test_form.submit_btn_code') }}
                            </vibe:button>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-3xl mx-auto p-2">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm font-semibold text-foreground">{{ __('docs/dynamic-form.test_form.card_title') }}</h3>
                                <p class="text-xs text-muted-foreground">{{ __('docs/dynamic-form.test_form.card_desc') }}</p>
                            </vibe:card.header>

                            <vibe:card.content>
                                <vibe:dynamic-form name="members" min="1" max="4" :add-text="__('docs/dynamic-form.test_form.add_member')" variant="card" :allow-reorder="true" :allow-duplicate="true">
                                    <div class="space-y-4">
                                        {{-- 1. Input, Select Remote, Select, Date-time --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                            <vibe:input name="member_name" :label="__('docs/dynamic-form.test_form.member_name')" :placeholder="__('docs/dynamic-form.test_form.name_placeholder')" />
                                            <vibe:select.remote name="supervisor_id" :label="__('docs/dynamic-form.test_form.supervisor')" :placeholder="__('docs/dynamic-form.test_form.supervisor_placeholder')" :api="route('docs.select.api')" clearable keyboard />
                                            <vibe:select name="role" :label="__('docs/dynamic-form.test_form.role')" :options="[
                                                'lead' => 'Project Lead',
                                                'dev' => 'Developer',
                                                'ui_ux' => 'UI/UX Designer',
                                                'qa' => 'QA Engineer'
                                            ]" :placeholder="__('docs/dynamic-form.test_form.role_placeholder')" />
                                            <vibe:date-time name="join_date" :label="__('docs/dynamic-form.test_form.join_date')" :placeholder="__('docs/dynamic-form.test_form.join_placeholder')" />
                                        </div>

                                        {{-- 2. Textarea, Range, Switch --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <vibe:textarea name="notes" :label="__('docs/dynamic-form.test_form.notes')" rows="3" :placeholder="__('docs/dynamic-form.test_form.notes_placeholder')" />
                                            <div class="space-y-3">
                                                <vibe:range name="skill_score" :label="__('docs/dynamic-form.test_form.skill_score')" :min="0" :max="100" :step="5" :value="80" :showValue="true" valueSuffix="%" />
                                                <vibe:switch name="is_remote" :label="__('docs/dynamic-form.test_form.is_remote')" :description="__('docs/dynamic-form.test_form.remote_desc')" :checked="true" />
                                            </div>
                                        </div>

                                        {{-- 3. Radio, Checkbox, Filepond --}}
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-border/40">
                                            <div class="space-y-1.5">
                                                <label class="block text-xs font-semibold text-foreground">{{ __('docs/dynamic-form.test_form.contract_type') }}</label>
                                                <vibe:radio name="contract_type" value="fulltime" label="Full-Time" :checked="true" />
                                                <vibe:radio name="contract_type" value="contract" :label="__('docs/dynamic-form.test_form.contract')" />
                                                <vibe:radio name="contract_type" value="freelance" label="Freelance" />
                                            </div>
                                            <div class="space-y-1.5">
                                                <label class="block text-xs font-semibold text-foreground">{{ __('docs/dynamic-form.test_form.facilities') }}</label>
                                                <vibe:checkbox name="has_laptop" value="1" :label="__('docs/dynamic-form.test_form.laptop')" :checked="true" />
                                                <vibe:checkbox name="has_server_access" value="1" :label="__('docs/dynamic-form.test_form.server_access')" />
                                                <vibe:checkbox name="signed_nda" value="1" :label="__('docs/dynamic-form.test_form.signed_nda')" :checked="true" />
                                            </div>
                                        </div>
                                        <vibe:filepond name="avatar" :label="__('docs/dynamic-form.test_form.avatar')" size="sm" :imagePreview="true" />
                                    </div>
                                </vibe:dynamic-form>
                            </vibe:card.content>

                            <vibe:card.footer class="flex items-center justify-between">
                                <p class="text-xs text-muted-foreground">{{ __('docs/dynamic-form.test_form.ajax_hint') }}</p>
                                <vibe:button type="submit" variant="primary">
                                    <svg class="size-3.5 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                        <polyline points="17 21 17 13 7 13 7 21" />
                                        <polyline points="7 3 7 8 15 8" />
                                    </svg>
                                    <span>{{ __('docs/dynamic-form.test_form.submit_btn') }}</span>
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>
                </vibe:preview>
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
