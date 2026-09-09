<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/date-time.title')" :description="__('docs/date-time.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/date-time.title'), 'url' => '/docs/date-time']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/date-time.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/date-time.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/date-time.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/date-time.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="single"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="range"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="datetime"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="datetime-range"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="time"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="time-range"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="multiple"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:presets="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">startName / endName</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:time24="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:inline="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:dualMonth="true"</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage (Single Date) --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.basic_usage.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time name="birth_date" label="{{ __('docs/date-time.basic_usage.birth_label') }}" placeholder="{{ __('docs/date-time.basic_usage.birth_placeholder') }}" description="Pilih tanggal lahir untuk melengkapi profil pengguna." clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time name="birth_date" label="{{ __('docs/date-time.basic_usage.birth_label') }}" placeholder="{{ __('docs/date-time.basic_usage.birth_placeholder') }}" description="Pilih tanggal lahir untuk melengkapi profil pengguna." clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Fast-Jump Month & Year Selection --}}
            <section id="fast-jump" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.fast_jump.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.fast_jump.desc') !!}
                    </p>
                </div>

                <div class="p-3.5 rounded-xl border border-primary/20 bg-primary/5 text-xs text-foreground flex items-center gap-3">
                    <svg class="size-5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <span><strong>Tips Penggunaan:</strong> Klik teks bulan (misal: <em>September</em>) atau angka tahun (misal: <em>2026</em>) di bagian atas popup untuk melompat antar dekade dan bulan secara instan.</span>
                </div>

                <vibe:preview :title="__('docs/date-time.fast_jump.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time name="archive_date" label="Arsip Dokumen Lampau" value="1998-05-21" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time name="archive_date" label="Arsip Dokumen Lampau" value="1998-05-21" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Date Range & Presets & Dual Form Output --}}
            <section id="rentang-tanggal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.range_presets.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.range_presets.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.range_presets.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time type="range" name="transaction_period" startName="start_date" endName="end_date" label="{{ __('docs/date-time.range_presets.period_label') }}" :presets="true" :dualMonth="true" clearable />
                    </vibe:preview.code>
                    <div class="max-w-md mx-auto p-4 space-y-4">
                        <vibe:date-time type="range" name="transaction_period" startName="start_date" endName="end_date" label="{{ __('docs/date-time.range_presets.period_label') }}" :presets="true" :dualMonth="true" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. DateTime (Tanggal & Jam) --}}
            <section id="datetime" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.datetime.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.datetime.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.datetime.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time type="datetime" name="publish_schedule" label="{{ __('docs/date-time.datetime.schedule_label') }}" :time24="true" minuteStep="5" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time type="datetime" name="publish_schedule" label="{{ __('docs/date-time.datetime.schedule_label') }}" :time24="true" minuteStep="5" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. DateTime Range (Rentang Tanggal & Waktu) --}}
            <section id="datetime-range" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.datetime_range.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.datetime_range.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.datetime_range.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time type="datetime-range" name="event_schedule" startName="event_start" endName="event_end" label="{{ __('docs/date-time.datetime_range.event_period_label') }}" :presets="true" :dualMonth="true" :time24="true" clearable />
                    </vibe:preview.code>
                    <div class="max-w-md mx-auto p-4 space-y-4">
                        <vibe:date-time type="datetime-range" name="event_schedule" startName="event_start" endName="event_end" label="{{ __('docs/date-time.datetime_range.event_period_label') }}" :presets="true" :dualMonth="true" :time24="true" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Time Only (Pemilih Waktu) --}}
            <section id="pemilih-waktu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.time_only.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.time_only.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.time_only.preview_title')">
                    <vibe:preview.code>
                        {{-- Format 24 Jam --}}
                        <vibe:date-time type="time" name="opening_time" label="{{ __('docs/date-time.time_only.opening_label') }}" value="08:30" :time24="true" />

                        {{-- Format 12 Jam AM/PM --}}
                        <vibe:date-time type="time" name="closing_time" label="{{ __('docs/date-time.time_only.closing_label') }}" value="09:00 PM" :time24="false" />
                    </vibe:preview.code>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-lg mx-auto p-4">
                        <vibe:date-time type="time" name="opening_time" label="{{ __('docs/date-time.time_only.opening_label') }}" value="08:30" :time24="true" />

                        <vibe:date-time type="time" name="closing_time" label="{{ __('docs/date-time.time_only.closing_label') }}" value="09:00 PM" :time24="false" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Time Range (Rentang Waktu / Jam Kerja) --}}
            <section id="rentang-waktu" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.time_range.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.time_range.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.time_range.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time type="time-range" name="working_shift" startName="shift_start" endName="shift_end" label="{{ __('docs/date-time.time_range.shift_label') }}" value="08:00 - 17:00" :time24="true" minuteStep="15" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time type="time-range" name="working_shift" startName="shift_start" endName="shift_end" label="{{ __('docs/date-time.time_range.shift_label') }}" value="08:00 - 17:00" :time24="true" minuteStep="15" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Multiple Dates Selection --}}
            <section id="banyak-tanggal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.multiple.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.multiple.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.multiple.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time type="multiple" name="leave_days" label="{{ __('docs/date-time.multiple.holidays_label') }}" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time type="multiple" name="leave_days" label="{{ __('docs/date-time.multiple.holidays_label') }}" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Inline Calendar & Event Markers --}}
            <section id="kalender-inline" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.inline.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.inline.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.inline.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time :inline="true" name="booking_slot" :markers="[
                            date('Y-m-12') => 'emerald',
                            date('Y-m-15') => 'primary',
                            date('Y-m-22') => 'rose',
                        ]" />
                    </vibe:preview.code>
                    <div class="max-w-md mx-auto p-4">
                        <vibe:date-time :inline="true" name="booking_slot" :markers="[
                            date('Y-m-12') => 'emerald',
                            date('Y-m-15') => 'primary',
                            date('Y-m-22') => 'rose'
                        ]" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Props Reference --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.props.desc') !!}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/date-time.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/date-time.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/date-time.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/date-time.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $propsList = [['type / mode', 'string', "'single'", "Mode picker: `'single'`, `'datetime'`, `'range'`, `'datetime-range'`, `'time'`, `'time-range'`, `'multiple'`, atau `'month'`."], ['name', 'string|null', 'null', 'Nama input form untuk disubmit ke controller backend.'], ['startName', 'string|null', 'null', 'Nama input form khusus untuk tanggal mulai pada mode range (dual input output).'], ['endName', 'string|null', 'null', 'Nama input form khusus untuk tanggal selesai pada mode range (dual input output).'], ['label', 'string|null', 'null', 'Label teks di atas input field.'], ['presets', 'bool|array', 'false', 'Menampilkan shortcut rentang tanggal populer (*Hari Ini, 7 Hari Terakhir, dll*).'], ['time24', 'bool', 'true', 'Format 24 jam (`true`) atau format 12 jam dengan switch AM/PM (`false`).'], ['minuteStep', 'int', '1', 'Kelipatan pilihan menit pada time selector (misal 5, 10, atau 15).'], ['showSeconds', 'bool', 'false', 'Menampilkan input pemilihan detik.'], ['dualMonth', 'bool', 'false', 'Menampilkan 2 bulan sekaligus berdampingan pada layar desktop untuk mode range.'], ['inline', 'bool', 'false', 'Menampilkan kalender langsung tertanam di halaman tanpa floating popover.'], ['clearable', 'bool', 'true', 'Menampilkan tombol silang untuk mengosongkan nilai yang sudah dipilih.'], ['minDate', 'string|null', 'null', 'Batas tanggal paling awal yang dapat dipilih (format `YYYY-MM-DD`).'], ['maxDate', 'string|null', 'null', 'Batas tanggal paling akhir yang dapat dipilih (format `YYYY-MM-DD`).'], ['disabledDates', 'array', '[]', 'Daftar tanggal tertentu yang dinonaktifkan / tidak bisa dipilih.'], ['disabledDaysOfWeek', 'array', '[]', 'Hari dalam sepekan yang dinonaktifkan (misal `[0, 6]` untuk akhir pekan).'], ['markers', 'array', '[]', 'Array asosiatif tanggal ke warna status dot penanda (`primary`, `emerald`, `rose`, `amber`).'], ['locale', 'string|null', 'app()->getLocale()', "Bahasa antarmuka kalender: `'id'` (Indonesia) atau `'en'` (Inggris)."], ['firstDayOfWeek', 'int', '1', 'Hari pertama dalam seminggu: `1` (Senin) atau `0` (Minggu).']];
                        @endphp
                        @foreach ($propsList as [$prop, $type, $default, $desc])
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

            {{-- Form Submission Test Section --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">Pengujian Form ($request->all())</h2>
                        <vibe:badge variant="primary" size="sm">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Uji coba pengiriman nilai berbagai mode date-time (single date, range dengan start/end input, datetime, dan time-range) langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Saat disubmit, modal otomatis muncul menampilkan payload <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code>.
                    </p>
                </div>

                <vibe:preview title="Form Testing Sandbox">
                    <vibe:preview.code>
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                            @csrf
                            <vibe:card>
                                <vibe:card.header>
                                    <h3 class="text-sm sm:text-base font-semibold text-foreground">Penjadwalan & Periode Waktu</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">Uji coba pengiriman nilai date, range, datetime, dan time-range langsung ke backend controller.</p>
                                </vibe:card.header>

                                <vibe:card.content class="space-y-4">
                                    {{-- Single Date --}}
                                    <vibe:date-time name="birth_date" label="Tanggal Lahir" placeholder="Pilih tanggal lahir..." clearable />

                                    {{-- Date Range with startName & endName --}}
                                    <vibe:date-time type="range" name="vacation_period" startName="vacation_start" endName="vacation_end" label="Periode Cuti / Liburan (Range)" :presets="true" :dualMonth="true" clearable />

                                    {{-- DateTime --}}
                                    <vibe:date-time type="datetime" name="consultation_schedule" label="Jadwal Konsultasi (DateTime)" :time24="true" minuteStep="15" clearable />

                                    {{-- Time Range --}}
                                    <vibe:date-time type="time-range" name="operational_hours" startName="open_time" endName="close_time" label="Jam Operasional Layanan (Time Range)" value="09:00 - 18:00" :time24="true" minuteStep="30" clearable />
                                </vibe:card.content>

                                <vibe:card.footer>
                                    <vibe:button class="w-full" type="submit" variant="primary">
                                        Kirim Form & Uji $request->all()
                                    </vibe:button>
                                </vibe:card.footer>
                            </vibe:card>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">Penjadwalan & Periode Waktu</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Uji coba pengiriman nilai date, range, datetime, dan time-range langsung ke backend controller.</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:date-time name="birth_date" label="Tanggal Lahir" placeholder="Pilih tanggal lahir..." clearable />

                                <vibe:date-time type="range" name="vacation_period" startName="vacation_start" endName="vacation_end" label="Periode Cuti / Liburan (Range)" :presets="true" :dualMonth="true" clearable />

                                <vibe:date-time type="datetime" name="consultation_schedule" label="Jadwal Konsultasi (DateTime)" :time24="true" minuteStep="15" clearable />

                                <vibe:date-time type="time-range" name="operational_hours" startName="open_time" endName="close_time" label="Jam Operasional Layanan (Time Range)" value="09:00 - 18:00" :time24="true" minuteStep="30" clearable />
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    Kirim Form & Uji $request->all()
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
