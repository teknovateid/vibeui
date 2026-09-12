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
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="month"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:presets="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">startName / endName</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:time24="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:inline="true"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">:dualMonth="true"</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">sm / md / lg / xl</vibe:badge>
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
                        <vibe:date-time name="birth_date" label="{{ __('docs/date-time.basic_usage.birth_label') }}" placeholder="{{ __('docs/date-time.basic_usage.birth_placeholder') }}" :description="__('docs/date-time.basic_usage.birth_desc')" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time name="birth_date" label="{{ __('docs/date-time.basic_usage.birth_label') }}" placeholder="{{ __('docs/date-time.basic_usage.birth_placeholder') }}" :description="__('docs/date-time.basic_usage.birth_desc')" clearable />
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
                    <span><strong>{{ __('docs/date-time.fast_jump.tip_title') }}</strong> {!! __('docs/date-time.fast_jump.tip_desc') !!}</span>
                </div>

                <vibe:preview :title="__('docs/date-time.fast_jump.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time name="archive_date" :label="__('docs/date-time.fast_jump.archive_label')" value="1998-05-21" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time name="archive_date" :label="__('docs/date-time.fast_jump.archive_label')" value="1998-05-21" clearable />
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
                        <vibe:date-time
                            type="datetime-range"
                            name="event_schedule"
                            startName="event_start"
                            endName="event_end"
                            label="{{ __('docs/date-time.datetime_range.event_period_label') }}"
                            startTimeLabel="{{ __('docs/date-time.datetime_range.start_time_label') }}"
                            endTimeLabel="{{ __('docs/date-time.datetime_range.end_time_label') }}"
                            :presets="true"
                            :dualMonth="true"
                            :time24="true"
                            clearable
                        />
                    </vibe:preview.code>
                    <div class="max-w-md mx-auto p-4 space-y-4">
                        <vibe:date-time
                            type="datetime-range"
                            name="event_schedule"
                            startName="event_start"
                            endName="event_end"
                            label="{{ __('docs/date-time.datetime_range.event_period_label') }}"
                            startTimeLabel="{{ __('docs/date-time.datetime_range.start_time_label') }}"
                            endTimeLabel="{{ __('docs/date-time.datetime_range.end_time_label') }}"
                            :presets="true"
                            :dualMonth="true"
                            :time24="true"
                            clearable
                        />
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

            {{-- 9. Month Only (Bulan & Tahun Saja) --}}
            <section id="bulan-tahun" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.month_only.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.month_only.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.month_only.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time type="month" name="payroll_period" label="{{ __('docs/date-time.month_only.payroll_label') }}" value="{{ date('Y-m') }}" clearable />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time type="month" name="payroll_period" label="{{ __('docs/date-time.month_only.payroll_label') }}" value="{{ date('Y-m') }}" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 10. Date Constraints & Disabled Days --}}
            <section id="batasan-tanggal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.constraints.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.constraints.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.constraints.preview_title')">
                    <vibe:preview.code>
                        {{-- 1. Single Date: Batas Min, Max & Hari Libur (disabledDaysOfWeek) --}}
                        <vibe:date-time
                            name="appointment_date"
                            label="{{ __('docs/date-time.constraints.single_label') }}"
                            description="{{ __('docs/date-time.constraints.single_desc') }}"
                            :min="now()"
                            :max="now()->addDays(30)"
                            :disabledDaysOfWeek="[0, 6]"
                            clearable
                        />

                        {{-- 2. Date Range: Batas Min, Max, minRange & maxRange --}}
                        <vibe:date-time
                            type="range"
                            name="rental_period"
                            label="{{ __('docs/date-time.constraints.range_label') }}"
                            description="{{ __('docs/date-time.constraints.range_desc') }}"
                            :min="now()"
                            :max="now()->addDays(60)"
                            minRange="2"
                            maxRange="7"
                            presets
                            clearable
                        />

                        {{-- 3. Datetime Range: Batas Min, Max, minRange & maxRange dengan Dual Month & Waktu --}}
                        <vibe:date-time
                            type="datetime-range"
                            name="hall_reservation"
                            label="{{ __('docs/date-time.constraints.datetime_range_label') }}"
                            description="{{ __('docs/date-time.constraints.datetime_range_desc') }}"
                            :min="now()"
                            :max="now()->addMonths(2)"
                            minRange="1"
                            maxRange="5"
                            :dualMonth="true"
                            time24
                            clearable
                        />
                    </vibe:preview.code>

                    <div class="space-y-6 w-full max-w-lg mx-auto p-4">
                        {{-- 1. Single Date --}}
                        <vibe:date-time
                            name="appointment_date"
                            label="{{ __('docs/date-time.constraints.single_label') }}"
                            description="{{ __('docs/date-time.constraints.single_desc') }}"
                            :min="now()"
                            :max="now()->addDays(30)"
                            :disabledDaysOfWeek="[0, 6]"
                            clearable
                        />

                        {{-- 2. Date Range --}}
                        <vibe:date-time
                            type="range"
                            name="rental_period"
                            label="{{ __('docs/date-time.constraints.range_label') }}"
                            description="{{ __('docs/date-time.constraints.range_desc') }}"
                            :min="now()"
                            :max="now()->addDays(60)"
                            minRange="2"
                            maxRange="7"
                            presets
                            clearable
                        />

                        {{-- 3. Datetime Range --}}
                        <vibe:date-time
                            type="datetime-range"
                            name="hall_reservation"
                            label="{{ __('docs/date-time.constraints.datetime_range_label') }}"
                            description="{{ __('docs/date-time.constraints.datetime_range_desc') }}"
                            :min="now()"
                            :max="now()->addMonths(2)"
                            minRange="1"
                            maxRange="5"
                            :dualMonth="true"
                            time24
                            clearable
                        />
                    </div>
                </vibe:preview>

                {{-- 10.4 Boundary Formats Reference Table --}}
                <div class="space-y-2 pt-2">
                    <div class="space-y-0.5">
                        <h3 class="text-sm font-semibold text-foreground">{{ __('docs/date-time.constraints.formats_title') }}</h3>
                        <p class="text-xs text-muted-foreground">{{ __('docs/date-time.constraints.formats_desc') }}</p>
                    </div>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/date-time.constraints.table_col_format') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/date-time.constraints.table_col_example') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/date-time.constraints.table_col_desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Carbon / DateTime</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary font-semibold whitespace-nowrap">:min="now()"<br>:max="now()->addDays(30)"</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/date-time.constraints.format_carbon_desc') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">ISO Date String</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary font-semibold whitespace-nowrap">min="2026-09-01"<br>max="2026-12-31"</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/date-time.constraints.format_iso_desc') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Special Keywords</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary font-semibold whitespace-nowrap">min="today"<br>min="now"</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/date-time.constraints.format_keywords_desc') }}</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">Integer Day Bounds</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-primary font-semibold whitespace-nowrap">minRange="2"<br>maxRange="7"</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{{ __('docs/date-time.constraints.format_ranges_desc') }}</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

            {{-- 11. Sizes & Variants --}}
            <section id="ukuran-varian" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.sizes_variants.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.sizes_variants.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.sizes_variants.preview_title')">
                    <vibe:preview.code>
                        {{-- Small (sm) --}}
                        <vibe:date-time size="sm" label="{{ __('docs/date-time.sizes_variants.size_sm') }}" value="{{ date('Y-m-d') }}" clearable />

                        {{-- Medium (md - default) --}}
                        <vibe:date-time size="md" label="{{ __('docs/date-time.sizes_variants.size_md') }}" value="{{ date('Y-m-d') }}" clearable />

                        {{-- Large (lg) --}}
                        <vibe:date-time size="lg" label="{{ __('docs/date-time.sizes_variants.size_lg') }}" value="{{ date('Y-m-d') }}" clearable />

                        {{-- Extra Large (xl) with Outline Variant --}}
                        <vibe:date-time size="xl" variant="outline" label="{{ __('docs/date-time.sizes_variants.size_xl') }}" value="{{ date('Y-m-d') }}" clearable />
                    </vibe:preview.code>
                    <div class="space-y-4 max-w-sm mx-auto p-4">
                        <vibe:date-time size="sm" label="{{ __('docs/date-time.sizes_variants.size_sm') }}" value="{{ date('Y-m-d') }}" clearable />
                        <vibe:date-time size="md" label="{{ __('docs/date-time.sizes_variants.size_md') }}" value="{{ date('Y-m-d') }}" clearable />
                        <vibe:date-time size="lg" label="{{ __('docs/date-time.sizes_variants.size_lg') }}" value="{{ date('Y-m-d') }}" clearable />
                        <vibe:date-time size="xl" variant="outline" label="{{ __('docs/date-time.sizes_variants.size_xl') }}" value="{{ date('Y-m-d') }}" clearable />
                    </div>
                </vibe:preview>
            </section>

            {{-- 12. Validation & Error States --}}
            <section id="validasi-error" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.validation.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.validation.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.validation.preview_title')">
                    <vibe:preview.code>
                        <vibe:date-time
                            name="contract_end_date"
                            label="{{ __('docs/date-time.validation.label') }}"
                            error="{{ __('docs/date-time.validation.error_message') }}"
                            required
                        />
                    </vibe:preview.code>
                    <div class="max-w-sm mx-auto p-4">
                        <vibe:date-time
                            name="contract_end_date"
                            label="{{ __('docs/date-time.validation.label') }}"
                            error="{{ __('docs/date-time.validation.error_message') }}"
                            required
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 13. Inline Calendar & Event Markers --}}
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

            {{-- 8. Form Submission Test --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">{{ __('docs/date-time.test.title') }}</h2>
                        <vibe:badge variant="primary" size="sm">{{ __('docs/date-time.test.badge') }}</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/date-time.test.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/date-time.test.preview_title')">
                    <vibe:preview.code>
                        <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                            @csrf
                            <vibe:card>
                                <vibe:card.header>
                                    <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/date-time.test.card_title') }}</h3>
                                    <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/date-time.test.card_desc') }}</p>
                                </vibe:card.header>

                                 <vibe:card.content class="space-y-4">
                                    {{-- Single Date --}}
                                    <vibe:date-time name="birth_date" :label="__('docs/date-time.test.birth_label')" :placeholder="__('docs/date-time.test.birth_placeholder')" clearable />

                                    {{-- Multiple Dates --}}
                                    <vibe:date-time type="multiple" name="training_days" :label="__('docs/date-time.test.multiple_label')" :placeholder="__('docs/date-time.test.multiple_placeholder')" clearable />

                                    {{-- Date Range with startName & endName --}}
                                    <vibe:date-time type="range" name="vacation_period" startName="vacation_start" endName="vacation_end" :label="__('docs/date-time.test.range_label')" :presets="true" :dualMonth="true" clearable />

                                    {{-- DateTime --}}
                                    <vibe:date-time type="datetime" name="consultation_schedule" :label="__('docs/date-time.test.datetime_label')" :time24="true" minuteStep="15" clearable />

                                    {{-- DateTime Range (Dual Date + Dual Time) --}}
                                    <vibe:date-time type="datetime-range" name="event_booking" startName="event_start" endName="event_end" :label="__('docs/date-time.test.datetime_range_label')" :presets="true" :dualMonth="true" :time24="true" clearable />

                                    {{-- Time Range --}}
                                    <vibe:date-time type="time-range" name="operational_hours" startName="open_time" endName="close_time" :label="__('docs/date-time.test.time_range_label')" value="09:00 - 18:00" :time24="true" minuteStep="30" clearable />
                                </vibe:card.content>

                                <vibe:card.footer>
                                    <vibe:button class="w-full" type="submit" variant="primary">
                                        {{ __('docs/date-time.test.submit_btn') }}
                                    </vibe:button>
                                </vibe:card.footer>
                            </vibe:card>
                        </vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">{{ __('docs/date-time.test.card_title') }}</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">{{ __('docs/date-time.test.card_desc') }}</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:date-time name="birth_date" :label="__('docs/date-time.test.birth_label')" :placeholder="__('docs/date-time.test.birth_placeholder')" clearable />

                                <vibe:date-time type="multiple" name="training_days" :label="__('docs/date-time.test.multiple_label')" :placeholder="__('docs/date-time.test.multiple_placeholder')" clearable />

                                <vibe:date-time type="range" name="vacation_period" startName="vacation_start" endName="vacation_end" :label="__('docs/date-time.test.range_label')" :presets="true" :dualMonth="true" clearable />

                                <vibe:date-time type="datetime" name="consultation_schedule" :label="__('docs/date-time.test.datetime_label')" :time24="true" minuteStep="15" clearable />

                                <vibe:date-time type="datetime-range" name="event_booking" startName="event_start" endName="event_end" :label="__('docs/date-time.test.datetime_range_label')" :presets="true" :dualMonth="true" :time24="true" clearable />

                                <vibe:date-time type="time-range" name="operational_hours" startName="open_time" endName="close_time" :label="__('docs/date-time.test.time_range_label')" value="09:00 - 18:00" :time24="true" minuteStep="30" clearable />
                            </vibe:card.content>

                            <vibe:card.footer>
                                <vibe:button class="w-full" type="submit" variant="primary">
                                    {{ __('docs/date-time.test.submit_btn') }}
                                </vibe:button>
                            </vibe:card.footer>
                        </vibe:card>
                    </vibe:form>
                </vibe:preview>
            </section>

            {{-- 9. Props Reference --}}
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
                            $propsList = [
                                ['type / mode', 'string', "'single'", __('docs/date-time.props_items.type')],
                                ['name', 'string|null', 'null', __('docs/date-time.props_items.name')],
                                ['startName', 'string|null', 'null', __('docs/date-time.props_items.startName')],
                                ['endName', 'string|null', 'null', __('docs/date-time.props_items.endName')],
                                ['label', 'string|null', 'null', __('docs/date-time.props_items.label')],
                                ['description', 'string|null', 'null', __('docs/date-time.props_items.description')],
                                ['placeholder', 'string|null', 'null', __('docs/date-time.props_items.placeholder')],
                                ['value', 'string|null', 'null', __('docs/date-time.props_items.value')],
                                ['presets', 'bool|array', 'false', __('docs/date-time.props_items.presets')],
                                ['time24', 'bool', 'true', __('docs/date-time.props_items.time24')],
                                ['minuteStep', 'int', '1', __('docs/date-time.props_items.minuteStep')],
                                ['secondStep', 'int', '1', __('docs/date-time.props_items.secondStep')],
                                ['showSeconds', 'bool', 'false', __('docs/date-time.props_items.showSeconds')],
                                ['dualMonth', 'bool', 'false', __('docs/date-time.props_items.dualMonth')],
                                ['inline', 'bool', 'false', __('docs/date-time.props_items.inline')],
                                ['clearable', 'bool', 'true', __('docs/date-time.props_items.clearable')],
                                ['min / minDate', 'string|null', 'null', __('docs/date-time.props_items.minDate')],
                                ['max / maxDate', 'string|null', 'null', __('docs/date-time.props_items.maxDate')],
                                ['minRange', 'int|null', 'null', __('docs/date-time.props_items.minRange')],
                                ['maxRange', 'int|null', 'null', __('docs/date-time.props_items.maxRange')],
                                ['disabledDates', 'array', '[]', __('docs/date-time.props_items.disabledDates')],
                                ['disabledDaysOfWeek', 'array', '[]', __('docs/date-time.props_items.disabledDaysOfWeek')],
                                ['markers', 'array', '[]', __('docs/date-time.props_items.markers')],
                                ['locale', 'string|null', 'app()->getLocale()', __('docs/date-time.props_items.locale')],
                                ['firstDayOfWeek', 'int', '1', __('docs/date-time.props_items.firstDayOfWeek')],
                                ['size', 'string', "'md'", __('docs/date-time.props_items.size')],
                                ['variant', 'string', "'primary'", __('docs/date-time.props_items.variant')],
                                ['error', 'string|bool|null', 'null', __('docs/date-time.props_items.error')],
                                ['required', 'bool', 'false', __('docs/date-time.props_items.required')],
                                ['disabled', 'bool', 'false', __('docs/date-time.props_items.disabled')],
                                ['readonly', 'bool', 'false', __('docs/date-time.props_items.readonly')],
                                ['startTimeLabel', 'string|null', 'null', __('docs/date-time.props_items.startTimeLabel')],
                                ['endTimeLabel', 'string|null', 'null', __('docs/date-time.props_items.endTimeLabel')],
                                ['timeLabel', 'string|null', 'null', __('docs/date-time.props_items.timeLabel')],
                            ];
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

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
