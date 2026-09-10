<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/avatar.title')" :description="__('docs/avatar.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/avatar.title'), 'url' => '/docs/avatar']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/avatar.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/avatar.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/avatar.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/avatar.description') }}
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['xs', 'sm', 'md', 'lg', 'xl', '2xl'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['circle', 'rounded', 'square'] as $sh)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $sh }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['online', 'busy', 'away', 'offline'] as $ind)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $ind }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:avatar.group&gt;</vibe:badge>
                </div>
            </div>

            {{-- 1. Basic Usage --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/avatar.basic_usage.preview_title')">
                    <vibe:preview.code>
{{-- 1. Gambar Foto Profil (src) --}}
<vibe:avatar
    src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80"
    alt="Sarah Jenkins"
/>

{{-- 2. Inisial Huruf (initials) --}}
<vibe:avatar initials="SJ" color="purple" />

{{-- 3. Ikon Kustom via Slot --}}
<vibe:avatar color="blue">
    <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
        <circle cx="9" cy="7" r="4" />
        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
    </svg>
</vibe:avatar>

{{-- 4. Siluet Bawaan (Fallback Otomatis) --}}
<vibe:avatar />
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-center justify-center gap-8 p-4">
                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar
                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80"
                                alt="Sarah Jenkins"
                            />
                            <span class="text-xs text-muted-foreground">{{ __('docs/avatar.basic_usage.image_label') }}</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar initials="SJ" color="purple" />
                            <span class="text-xs text-muted-foreground">{{ __('docs/avatar.basic_usage.initials_label') }}</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar color="blue">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </vibe:avatar>
                            <span class="text-xs text-muted-foreground">{{ __('docs/avatar.basic_usage.custom_icon_label') }}</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar />
                            <span class="text-xs text-muted-foreground">{{ __('docs/avatar.basic_usage.fallback_label') }}</span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Sizes --}}
            <section id="pilihan-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.sizes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.sizes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/avatar.sizes.preview_title')">
                    <vibe:preview.code>
<vibe:avatar size="xs" initials="XS" color="blue" />
<vibe:avatar size="sm" initials="SM" color="green" />
<vibe:avatar size="md" initials="MD" color="yellow" />
<vibe:avatar size="lg" initials="LG" color="orange" />
<vibe:avatar size="xl" initials="XL" color="red" />
<vibe:avatar size="2xl" initials="2X" color="purple" />
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-end justify-center gap-6 p-4">
                        @foreach ([
                            ['xs', 'XS', 'blue', '24px'],
                            ['sm', 'SM', 'green', '32px'],
                            ['md', 'MD', 'yellow', '40px'],
                            ['lg', 'LG', 'orange', '48px'],
                            ['xl', 'XL', 'red', '56px'],
                            ['2xl', '2X', 'purple', '64px']
                        ] as [$size, $text, $color, $pixel])
                            <div class="flex flex-col items-center gap-2">
                                <vibe:avatar :size="$size" :initials="$text" :color="$color" />
                                <div class="text-center">
                                    <span class="block text-xs font-mono font-semibold text-foreground">{{ $size }}</span>
                                    <span class="block text-[10px] text-muted-foreground">{{ $pixel }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Shapes --}}
            <section id="bentuk-sudut" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.shapes.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.shapes.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/avatar.shapes.preview_title')">
                    <vibe:preview.code>
{{-- 1. Lingkaran (circle / default) --}}
<vibe:avatar
    shape="circle"
    size="lg"
    src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
    indicator="online"
/>

{{-- 2. Sudut Rounded-md (rounded) --}}
<vibe:avatar
    shape="rounded"
    size="lg"
    src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
    indicator="online"
/>

{{-- 3. Sudut Rounded-lg (square) --}}
<vibe:avatar
    shape="square"
    size="lg"
    src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
    indicator="online"
/>
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-center justify-center gap-10 p-4">
                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar
                                shape="circle"
                                size="lg"
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
                                indicator="online"
                            />
                            <span class="text-xs font-mono font-medium text-muted-foreground">shape="circle"</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar
                                shape="rounded"
                                size="lg"
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
                                indicator="online"
                            />
                            <span class="text-xs font-mono font-medium text-muted-foreground">shape="rounded"</span>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar
                                shape="square"
                                size="lg"
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80"
                                indicator="online"
                            />
                            <span class="text-xs font-mono font-medium text-muted-foreground">shape="square"</span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Status Indicator --}}
            <section id="indikator-status" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.indicators.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.indicators.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/avatar.indicators.preview_title')">
                    <vibe:preview.code>
<vibe:avatar initials="ON" color="green" indicator="online" />
<vibe:avatar initials="BS" color="red" indicator="busy" />
<vibe:avatar initials="AW" color="yellow" indicator="away" />
<vibe:avatar initials="OF" color="orange" indicator="offline" />
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-center justify-center gap-8 p-4">
                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar initials="ON" color="green" indicator="online" size="lg" />
                            <div class="flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-success"></span>
                                <span class="text-xs font-medium text-foreground">{{ __('docs/avatar.indicators.online') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar initials="BS" color="red" indicator="busy" size="lg" />
                            <div class="flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-destructive"></span>
                                <span class="text-xs font-medium text-foreground">{{ __('docs/avatar.indicators.busy') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar initials="AW" color="yellow" indicator="away" size="lg" />
                            <div class="flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-warning"></span>
                                <span class="text-xs font-medium text-foreground">{{ __('docs/avatar.indicators.away') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-2">
                            <vibe:avatar initials="OF" color="orange" indicator="offline" size="lg" />
                            <div class="flex items-center gap-1.5">
                                <span class="size-2 rounded-full bg-muted-foreground"></span>
                                <span class="text-xs font-medium text-foreground">{{ __('docs/avatar.indicators.offline') }}</span>
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Initials Color Palette --}}
            <section id="palet-warna-inisial" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.colors.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.colors.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/avatar.colors.preview_title')">
                    <vibe:preview.code>
<vibe:avatar initials="BL" color="blue" />
<vibe:avatar initials="GR" color="green" />
<vibe:avatar initials="RD" color="red" />
<vibe:avatar initials="PR" color="purple" />
<vibe:avatar initials="YL" color="yellow" />
<vibe:avatar initials="PK" color="pink" />
<vibe:avatar initials="OR" color="orange" />
<vibe:avatar initials="DF" /> {{-- default secondary --}}
                    </vibe:preview.code>
                    <div class="w-full flex flex-wrap items-center justify-center gap-5 p-4">
                        @foreach ([
                            ['blue', 'BL'],
                            ['green', 'GR'],
                            ['red', 'RD'],
                            ['purple', 'PR'],
                            ['yellow', 'YL'],
                            ['pink', 'PK'],
                            ['orange', 'OR'],
                            ['default', 'DF']
                        ] as [$col, $ini])
                            <div class="flex flex-col items-center gap-1.5">
                                <vibe:avatar :initials="$ini" :color="$col !== 'default' ? $col : null" size="md" />
                                <span class="text-[11px] font-mono text-muted-foreground">{{ $col }}</span>
                            </div>
                        @endforeach
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Avatar Group --}}
            <section id="avatar-group" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.group_sec.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.group_sec.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/avatar.group_sec.preview_title')">
                    <vibe:preview.code>
{{-- 1. Overlapping Group dengan Limit & Counter --}}
<vibe:avatar.group limit="4" :total="9">
    <vibe:avatar src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Sarah" />
    <vibe:avatar src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80" alt="Alex" />
    <vibe:avatar src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80" alt="Emily" />
    <vibe:avatar initials="JD" color="blue" />
</vibe:avatar.group>

{{-- 2. Non-overlapping Group (:overlap="false") --}}
<vibe:avatar.group :overlap="false" size="sm">
    <vibe:avatar initials="A" color="purple" />
    <vibe:avatar initials="B" color="green" />
    <vibe:avatar initials="C" color="orange" />
</vibe:avatar.group>
                    </vibe:preview.code>
                    <div class="w-full flex flex-col items-center justify-center gap-8 p-6">
                        <div class="flex flex-col items-center gap-3">
                            <span class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">{{ __('docs/avatar.group_sec.sample_team') }}</span>
                            <vibe:avatar.group limit="4" :total="9" size="md">
                                <vibe:avatar src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Sarah" />
                                <vibe:avatar src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80" alt="Alex" />
                                <vibe:avatar src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80" alt="Emily" />
                                <vibe:avatar initials="JD" color="blue" />
                            </vibe:avatar.group>
                            <span class="text-xs text-muted-foreground">limit="4" :total="9" (menampilkan 4 avatar + sisa 5 pengguna)</span>
                        </div>

                        <div class="flex flex-col items-center gap-3">
                            <span class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">Mode Renggang (:overlap="false")</span>
                            <vibe:avatar.group :overlap="false" size="sm">
                                <vibe:avatar initials="MK" color="purple" />
                                <vibe:avatar initials="RB" color="green" />
                                <vibe:avatar initials="TL" color="orange" />
                                <vibe:avatar initials="AN" color="blue" />
                            </vibe:avatar.group>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Props & Slots Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/avatar.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/avatar.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:avatar Props --}}
                <p class="text-sm font-semibold text-foreground">&lt;vibe:avatar&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/avatar.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/avatar.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/avatar.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/avatar.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $avatarProps = [
                                ['src', 'string|null', 'null', __('docs/avatar.props_items.avatar.src')],
                                ['alt', 'string', "''", __('docs/avatar.props_items.avatar.alt')],
                                ['initials', 'string|null', 'null', __('docs/avatar.props_items.avatar.initials')],
                                ['size', 'string', "'md'", __('docs/avatar.props_items.avatar.size')],
                                ['shape', 'string', "'circle'", __('docs/avatar.props_items.avatar.shape')],
                                ['indicator', 'string|null', 'null', __('docs/avatar.props_items.avatar.indicator')],
                                ['color', 'string|null', 'null', __('docs/avatar.props_items.avatar.color')],
                            ];
                        @endphp
                        @foreach ($avatarProps as [$prop, $type, $default, $desc])
                            <vibe:table.row>
                                <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground">{!! $desc !!}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>

                {{-- vibe:avatar.group Props --}}
                <p class="text-sm font-semibold text-foreground pt-4">&lt;vibe:avatar.group&gt;</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/avatar.props.columns.prop') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/avatar.props.columns.type') }}</vibe:table.column>
                        <vibe:table.column class="whitespace-nowrap">{{ __('docs/avatar.props.columns.default') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/avatar.props.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $groupProps = [
                                ['limit', 'int|null', 'null', __('docs/avatar.props_items.group.limit')],
                                ['total', 'int|null', 'null', __('docs/avatar.props_items.group.total')],
                                ['size', 'string', "'md'", __('docs/avatar.props_items.group.size')],
                                ['overlap', 'bool', 'true', __('docs/avatar.props_items.group.overlap')],
                            ];
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

                {{-- Slots Reference --}}
                <p class="text-sm font-semibold text-foreground pt-4">{{ __('docs/avatar.slots.title') }}</p>
                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/avatar.slots.columns.slot') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/avatar.slots.columns.desc') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">default ($slot)</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Pada <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code>, digunakan untuk memasukkan ikon kustom (misal SVG ikon tim/bot). Pada <code class="font-mono text-xs text-foreground">&lt;vibe:avatar.group&gt;</code>, berisi kumpulan elemen <code class="font-mono text-xs text-foreground">&lt;vibe:avatar&gt;</code>.</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
