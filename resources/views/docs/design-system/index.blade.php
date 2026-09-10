<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/design-system.seo_title')" :description="__('docs/design-system.seo_description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => __('docs/design-system.breadcrumb'), 'url' => '/docs/design-system']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/design-system.header.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/design-system.header.subtitle') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/design-system.header.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {!! __('docs/design-system.header.desc') !!}
                </p>
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--primary</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--secondary</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--success</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--warning</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--destructive</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--info</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">--accent</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">match($variant)</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">color-mix()</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">/15 opacity</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">/90 hover</vibe:badge>
                </div>
            </div>

            {{-- ═══════════════════════════════════════ 1. TOKEN WARNA ═══════════════════════════════════════ --}}
            <section id="token-warna" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/design-system.sections.tokens.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/design-system.sections.tokens.desc') !!}
                    </p>
                </div>

                {{-- Palette Visual --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @php
                        $palette = [
                            ['name' => 'primary',     'bg' => 'bg-primary',     'text' => 'text-primary-foreground',     'token' => '--primary',     'value' => '#0a0b0a / #f9fafa (dark)', 'role' => __('docs/design-system.sections.tokens.palette.primary.role')],
                            ['name' => 'secondary',   'bg' => 'bg-secondary',   'text' => 'text-secondary-foreground',   'token' => '--secondary',   'value' => '#f4f5f5 / #262726 (dark)', 'role' => __('docs/design-system.sections.tokens.palette.secondary.role')],
                            ['name' => 'success',     'bg' => 'bg-success',     'text' => 'text-success-foreground',     'token' => '--success',     'value' => '#10b981',                  'role' => __('docs/design-system.sections.tokens.palette.success.role')],
                            ['name' => 'warning',     'bg' => 'bg-warning',     'text' => 'text-warning-foreground',     'token' => '--warning',     'value' => '#f59e0b',                  'role' => __('docs/design-system.sections.tokens.palette.warning.role')],
                            ['name' => 'destructive', 'bg' => 'bg-destructive', 'text' => 'text-destructive-foreground', 'token' => '--destructive', 'value' => '#ef4444',                  'role' => __('docs/design-system.sections.tokens.palette.destructive.role')],
                            ['name' => 'info',        'bg' => 'bg-info',        'text' => 'text-info-foreground',        'token' => '--info',        'value' => '#0ea5e9',                  'role' => __('docs/design-system.sections.tokens.palette.info.role')],
                            ['name' => 'accent',      'bg' => 'bg-accent',      'text' => 'text-accent-foreground',      'token' => '--accent',      'value' => '#f4f5f5 / #1e1f1e (dark)', 'role' => __('docs/design-system.sections.tokens.palette.accent.role')],
                            ['name' => 'muted',       'bg' => 'bg-muted',       'text' => 'text-muted-foreground',       'token' => '--muted',       'value' => '#f4f5f5 / #1e1f1e (dark)', 'role' => __('docs/design-system.sections.tokens.palette.muted.role')],
                        ];
                    @endphp
                    @foreach ($palette as $color)
                        <vibe:card class="overflow-hidden">
                            <div class="{{ $color['bg'] }} {{ $color['text'] }} px-4 py-5 flex flex-col gap-1">
                                <span class="text-xs font-mono font-bold opacity-80">{{ $color['token'] }}</span>
                                <span class="text-base font-semibold capitalize">{{ $color['name'] }}</span>
                            </div>
                            <div class="px-3 py-2.5 space-y-0.5">
                                <p class="text-[11px] text-muted-foreground font-mono truncate">{{ $color['value'] }}</p>
                                <p class="text-[11px] text-muted-foreground/70">{{ $color['role'] }}</p>
                            </div>
                        </vibe:card>
                    @endforeach
                </div>

                {{-- Surface Tokens Table --}}
                <div class="space-y-3">
                    <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.tokens.surface_table.title') }}</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>{{ __('docs/design-system.sections.tokens.surface_table.columns.token') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/design-system.sections.tokens.surface_table.columns.light') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/design-system.sections.tokens.surface_table.columns.dark') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/design-system.sections.tokens.surface_table.columns.usage') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $surfaceTokens = [
                                    ['--background',       '#f9fafa', '#0a0b0a', __('docs/design-system.sections.tokens.surface_table.items.background')],
                                    ['--foreground',       '#0a0b0a', '#f9fafa', __('docs/design-system.sections.tokens.surface_table.items.foreground')],
                                    ['--card',             '#ffffff', '#181918', __('docs/design-system.sections.tokens.surface_table.items.card')],
                                    ['--card-foreground',  '#0a0b0a', '#f9fafa', __('docs/design-system.sections.tokens.surface_table.items.card_foreground')],
                                    ['--popover',          '#ffffff', '#181918', __('docs/design-system.sections.tokens.surface_table.items.popover')],
                                    ['--border',           '#e5e6e5', '#262726', __('docs/design-system.sections.tokens.surface_table.items.border')],
                                    ['--input',            '#e5e6e5', '#262726', __('docs/design-system.sections.tokens.surface_table.items.input')],
                                    ['--ring',             '#0a0b0a', '#a2a4a3', __('docs/design-system.sections.tokens.surface_table.items.ring')],
                                    ['--muted-foreground', '#717372', '#a2a4a3', __('docs/design-system.sections.tokens.surface_table.items.muted_foreground')],
                                    ['--sidebar',          '#ffffff', '#121312', __('docs/design-system.sections.tokens.surface_table.items.sidebar')],
                                    ['--header',           '#ffffff', '#121312', __('docs/design-system.sections.tokens.surface_table.items.header')],
                                ];
                            @endphp
                            @foreach ($surfaceTokens as [$token, $light, $dark, $usage])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $token }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground text-xs whitespace-nowrap">{{ $light }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground text-xs whitespace-nowrap">{{ $dark }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs">{{ $usage }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

            {{-- ═══════════════════════════════════════ 2. RUMUS VARIANT ═══════════════════════════════════════ --}}
            <section id="rumus-variant" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/design-system.sections.formulas.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/design-system.sections.formulas.desc') !!}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- SOLID --}}
                    <vibe:card class="overflow-hidden">
                        <vibe:card.header class="bg-primary text-primary-foreground rounded-none border-b-0 flex-row items-center justify-between gap-3">
                            <span class="font-semibold text-sm">{{ __('docs/design-system.sections.formulas.solid.title') }}</span>
                            <vibe:badge variant="secondary" size="sm">{{ __('docs/design-system.sections.formulas.solid.badge') }}</vibe:badge>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <p class="text-xs text-muted-foreground">{{ __('docs/design-system.sections.formulas.solid.desc') }}</p>
                            <pre class="bg-muted rounded-lg p-3 text-xs font-mono text-foreground overflow-x-auto">
'primary' => 'bg-primary text-primary-foreground hover:bg-primary/90'
'success' => 'bg-success text-success-foreground hover:bg-success/90'
'warning' => 'bg-warning text-warning-foreground hover:bg-warning/90'
'danger'  => 'bg-destructive text-destructive-foreground hover:bg-destructive/90'
'info'    => 'bg-info text-info-foreground hover:bg-info/90'</pre>
                            <div class="flex flex-wrap gap-2 pt-1">
                                <vibe:button variant="primary" size="sm">Primary</vibe:button>
                                <vibe:button variant="success" size="sm">Success</vibe:button>
                                <vibe:button variant="warning" size="sm">Warning</vibe:button>
                                <vibe:button variant="danger" size="sm">Danger</vibe:button>
                                <vibe:button variant="info" size="sm">Info</vibe:button>
                            </div>
                        </vibe:card.content>
                    </vibe:card>

                    {{-- SOFT --}}
                    <vibe:card class="overflow-hidden">
                        <vibe:card.header class="bg-success/15 text-success border-b border-success/20 rounded-none flex-row items-center justify-between gap-3">
                            <span class="font-semibold text-sm">{{ __('docs/design-system.sections.formulas.soft.title') }}</span>
                            <vibe:badge variant="success" size="sm">{{ __('docs/design-system.sections.formulas.soft.badge') }}</vibe:badge>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <p class="text-xs text-muted-foreground">{{ __('docs/design-system.sections.formulas.soft.desc') }}</p>
                            <pre class="bg-muted rounded-lg p-3 text-xs font-mono text-foreground overflow-x-auto">
'success' => 'bg-success/15 text-success border border-success/20'
'warning' => 'bg-warning/15 text-warning border border-warning/20'
'danger'  => 'bg-destructive/15 text-destructive border border-destructive/20'
'info'    => 'bg-info/15 text-info border border-info/20'</pre>
                            <div class="flex flex-wrap gap-2 pt-1">
                                <vibe:badge variant="success">Success</vibe:badge>
                                <vibe:badge variant="warning">Warning</vibe:badge>
                                <vibe:badge variant="danger">Danger</vibe:badge>
                                <vibe:badge variant="info">Info</vibe:badge>
                            </div>
                        </vibe:card.content>
                    </vibe:card>
                </div>

                {{-- Opacity Modifier Table --}}
                <vibe:card>
                    <vibe:card.header>
                        <h3 class="font-semibold text-sm text-foreground">{{ __('docs/design-system.sections.formulas.opacity.title') }}</h3>
                    </vibe:card.header>
                    <vibe:card.content>
                        <vibe:table variant="flush">
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/design-system.sections.formulas.opacity.columns.modifier') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/design-system.sections.formulas.opacity.columns.usage') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/design-system.sections.formulas.opacity.columns.example') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @foreach (__('docs/design-system.sections.formulas.opacity.items') as $rule)
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $rule['mod'] }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground text-xs">{{ $rule['usage'] }}</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground text-xs">{{ $rule['example'] }}</vibe:table.cell>
                                    </vibe:table.row>
                                @endforeach
                            </vibe:table.rows>
                        </vibe:table>
                    </vibe:card.content>
                </vibe:card>
            </section>

            {{-- ═══════════════════════════════════════ 3. RUMUS PER KOMPONEN ═══════════════════════════════════════ --}}
            <section id="rumus-per-komponen" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/design-system.sections.components.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/design-system.sections.components.desc') !!}
                    </p>
                </div>

                {{-- BUTTON --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.button.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/button/index.blade.php</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content class="space-y-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2">
                            <vibe:button variant="primary" size="sm" class="w-full">primary</vibe:button>
                            <vibe:button variant="secondary" size="sm" class="w-full">secondary</vibe:button>
                            <vibe:button variant="outline" size="sm" class="w-full">outline</vibe:button>
                            <vibe:button variant="ghost" size="sm" class="w-full">ghost</vibe:button>
                            <vibe:button variant="surface" size="sm" class="w-full">surface</vibe:button>
                            <vibe:button variant="accent" size="sm" class="w-full">accent</vibe:button>
                            <vibe:button variant="danger" size="sm" class="w-full">danger</vibe:button>
                            <vibe:button variant="success" size="sm" class="w-full">success</vibe:button>
                            <vibe:button variant="warning" size="sm" class="w-full">warning</vibe:button>
                            <vibe:button variant="info" size="sm" class="w-full">info</vibe:button>
                            <vibe:button variant="link" size="sm" class="w-full">link</vibe:button>
                        </div>
                        <vibe:table variant="flush">
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/design-system.sections.components.button.columns.variant') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/design-system.sections.components.button.columns.formula') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/design-system.sections.components.button.columns.hover') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @php
                                    $buttonVariants = [
                                        ['primary',   'bg-primary text-primary-foreground',                   'hover:bg-primary/90'],
                                        ['secondary', 'bg-secondary text-secondary-foreground',               'hover:bg-secondary/80'],
                                        ['outline',   'border border-input bg-background text-foreground',   'hover:bg-accent hover:text-accent-foreground'],
                                        ['ghost',     'text-foreground',                                      'hover:bg-accent hover:text-accent-foreground'],
                                        ['surface',   'bg-card border border-border/80 text-card-foreground', 'hover:bg-accent/60'],
                                        ['accent',    'bg-accent text-accent-foreground border border-accent','hover:bg-accent/80'],
                                        ['danger',    'bg-destructive text-destructive-foreground',           'hover:bg-destructive/90'],
                                        ['success',   'bg-success text-success-foreground',                   'hover:bg-success/90'],
                                        ['warning',   'bg-warning text-warning-foreground',                   'hover:bg-warning/90'],
                                        ['info',      'bg-info text-info-foreground',                         'hover:bg-info/90'],
                                        ['link',      'text-primary underline-offset-4',                      'hover:underline'],
                                    ];
                                @endphp
                                @foreach ($buttonVariants as [$variant, $base, $hover])
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $variant }}</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground text-xs">{{ $base }}</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground/70 text-xs">{{ $hover }}</vibe:table.cell>
                                    </vibe:table.row>
                                @endforeach
                            </vibe:table.rows>
                        </vibe:table>
                    </vibe:card.content>
                </vibe:card>

                {{-- BADGE --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.badge.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/badge/index.blade.php</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content class="space-y-4">
                        <div class="flex flex-wrap gap-2">
                            <vibe:badge variant="primary">primary</vibe:badge>
                            <vibe:badge variant="secondary">secondary</vibe:badge>
                            <vibe:badge variant="outline">outline</vibe:badge>
                            <vibe:badge variant="ghost">ghost</vibe:badge>
                            <vibe:badge variant="accent">accent</vibe:badge>
                            <vibe:badge variant="danger">danger</vibe:badge>
                            <vibe:badge variant="success">success</vibe:badge>
                            <vibe:badge variant="warning">warning</vibe:badge>
                            <vibe:badge variant="info">info</vibe:badge>
                        </div>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">{{ __('docs/design-system.sections.components.badge.formula_label') }}</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
'danger'  => 'bg-destructive/15 text-destructive border border-destructive/20'
'success' => 'bg-success/15     text-success     border border-success/20'
'warning' => 'bg-warning/15     text-warning     border border-warning/20'
'info'    => 'bg-info/15        text-info        border border-info/20'</pre>
                            <p class="text-[11px] text-muted-foreground">{!! __('docs/design-system.sections.components.badge.note') !!}</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- SWITCH --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.switch.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/switch/index.blade.php</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 w-full max-w-lg">
                            <vibe:switch name="sw_p" variant="primary" label="Primary" checked />
                            <vibe:switch name="sw_s" variant="success" label="Success" checked />
                            <vibe:switch name="sw_w" variant="warning" label="Warning" checked />
                            <vibe:switch name="sw_d" variant="danger" label="Danger" checked />
                            <vibe:switch name="sw_i" variant="info" label="Info" checked />
                            <vibe:switch name="sw_a" variant="accent" label="Accent" checked />
                        </div>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">{{ __('docs/design-system.sections.components.switch.formula_label') }}</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
Track inactive  => 'bg-input border-border/70'
Track checked:
  'primary' => 'peer-checked:bg-primary peer-checked:border-primary'
  'success' => 'peer-checked:bg-success peer-checked:border-success'
  'warning' => 'peer-checked:bg-warning peer-checked:border-warning'
  'danger'  => 'peer-checked:bg-destructive peer-checked:border-destructive'
  'info'    => 'peer-checked:bg-info peer-checked:border-info'
  'accent'  => 'peer-checked:bg-accent-foreground peer-checked:border-accent-foreground'

Thumb       => 'bg-background' (selalu putih/hitam sesuai theme)</pre>
                            <p class="text-[11px] text-muted-foreground">{!! __('docs/design-system.sections.components.switch.note') !!}</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- RANGE --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.range.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/range/index.blade.php</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content class="space-y-4">
                        <div class="w-full max-w-md space-y-4">
                            <vibe:range name="ds_r_p" variant="primary" label="Primary" :value="65" :showValue="true" valueSuffix="%" />
                            <vibe:range name="ds_r_s" variant="success" label="Success" :value="55" :showValue="true" valueSuffix="%" />
                            <vibe:range name="ds_r_w" variant="warning" label="Warning" :value="72" :showValue="true" valueSuffix="%" />
                            <vibe:range name="ds_r_d" variant="danger" label="Danger" :value="88" :showValue="true" valueSuffix="%" />
                            <vibe:range name="ds_r_i" variant="info" label="Info" :value="30" :showValue="true" valueSuffix="%" />
                            <vibe:range name="ds_r_a" variant="accent" label="Accent" :value="50" :showValue="true" valueSuffix="%" />
                        </div>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">{{ __('docs/design-system.sections.components.range.formula_label') }}</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
// PHP match() menghasilkan nilai --range-active-color:
'primary'   => 'var(--primary)'
'secondary' => 'var(--secondary-foreground)'
'success'   => 'var(--success)'
'warning'   => 'var(--warning)'
'danger'    => 'var(--destructive)'
'info'      => 'var(--info)'
'accent'    => 'oklch(0.511 0.262 276.966)' // dipatok agar konsisten

// CSS mengonsumsi variable ini di vibe.css:
track: linear-gradient(to right, var(--range-active-color) var(--progress), var(--range-track-color) var(--progress))
thumb: border 2px solid var(--range-active-color)
ring:  color-mix(in srgb, var(--range-active-color) 25%, transparent)</pre>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- INPUT GROUP --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.form_group.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">{{ __('docs/design-system.sections.components.form_group.badge') }}</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <vibe:input name="ds_i1" :label="__('docs/design-system.sections.components.form_group.labels.default')" :placeholder="__('docs/design-system.sections.components.form_group.labels.default_placeholder')" />
                            <vibe:input name="ds_i2" :label="__('docs/design-system.sections.components.form_group.labels.error')" :placeholder="__('docs/design-system.sections.components.form_group.labels.error_placeholder')" :error="__('docs/design-system.sections.components.form_group.labels.error_msg')" />
                            <vibe:input name="ds_i3" :label="__('docs/design-system.sections.components.form_group.labels.info')" :placeholder="__('docs/design-system.sections.components.form_group.labels.info_placeholder')" :info="__('docs/design-system.sections.components.form_group.labels.info_msg')" />
                            <vibe:input name="ds_i4" :label="__('docs/design-system.sections.components.form_group.labels.readonly')" :value="__('docs/design-system.sections.components.form_group.labels.readonly_val')" readonly />
                        </div>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">{{ __('docs/design-system.sections.components.form_group.formula_label') }}</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
Normal   => border border-input bg-background
           focus: ring-2 ring-ring ring-offset-background

Error    => border-destructive/70 bg-destructive/5
           ring-destructive/30, text-destructive (label & icon)

Info     => helper text: text-muted-foreground text-xs
           (hanya tampil jika tidak ada error)

Disabled => opacity-50 cursor-not-allowed
Readonly => cursor-default (tanpa opacity reduction)</pre>
                            <p class="text-[11px] text-muted-foreground">{!! __('docs/design-system.sections.components.form_group.note') !!}</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- DROPDOWN --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.dropdown.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/dropdown/</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">{{ __('docs/design-system.sections.components.dropdown.formula_label') }}</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
// Panel/Popover surface:
bg-popover border border-border shadow-lg rounded-xl

// Item default:
text-popover-foreground hover:bg-accent hover:text-accent-foreground

// Item dengan variant semantik:
'danger'  => 'text-destructive hover:bg-destructive/10 hover:text-destructive'
'success' => 'text-success   hover:bg-success/10   hover:text-success'
'warning' => 'text-warning   hover:bg-warning/10   hover:text-warning'
'info'    => 'text-info      hover:bg-info/10      hover:text-info'

// Divider:   border-t border-border my-1
// Disabled:  opacity-50 pointer-events-none cursor-not-allowed</pre>
                            <p class="text-[11px] text-muted-foreground">{!! __('docs/design-system.sections.components.dropdown.note') !!}</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- MODAL & SHEET --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">{{ __('docs/design-system.sections.components.modal_sheet.title') }}</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/modal/, sheet/</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">{{ __('docs/design-system.sections.components.modal_sheet.formula_label') }}</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
// Overlay backdrop:
bg-black/50 (fixed inset-0, z-50)

// Panel surface:
bg-popover border border-border shadow-xl rounded-xl

// Header (opsional garis bawah):
border-b border-border

// Footer (opsional garis atas):
border-t border-border bg-muted/30

// Tombol Close (×):
text-muted-foreground hover:text-foreground hover:bg-accent rounded-lg

// Variant destruktif:
border-t-4 border-t-destructive</pre>
                        </div>
                    </vibe:card.content>
                </vibe:card>
            </section>

            {{-- ═══════════════════════════════════════ 4. COLOR-MIX ═══════════════════════════════════════ --}}
            <section id="formula-color-mix" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{!! __('docs/design-system.sections.color_mix.title') !!}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/design-system.sections.color_mix.desc') !!}
                    </p>
                </div>

                <vibe:card>
                    <vibe:card.content class="space-y-4">
                        <vibe:table variant="flush">
                            <vibe:table.header>
                                <vibe:table.column>{{ __('docs/design-system.sections.color_mix.columns.formula') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/design-system.sections.color_mix.columns.usage') }}</vibe:table.column>
                                <vibe:table.column>{{ __('docs/design-system.sections.color_mix.columns.where') }}</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @foreach (__('docs/design-system.sections.color_mix.items') as $cmRule)
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono text-foreground text-xs">{{ $cmRule['formula'] }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground text-xs">{{ $cmRule['usage'] }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground/70 text-xs">{{ $cmRule['where'] }}</vibe:table.cell>
                                    </vibe:table.row>
                                @endforeach
                            </vibe:table.rows>
                        </vibe:table>

                        <div class="rounded-lg bg-muted p-3 space-y-1">
                            <p class="text-xs font-semibold text-foreground">{{ __('docs/design-system.sections.color_mix.faq_title') }}</p>
                            <p class="text-xs text-muted-foreground">
                                {!! __('docs/design-system.sections.color_mix.faq_desc') !!}
                            </p>
                        </div>
                    </vibe:card.content>
                </vibe:card>
            </section>

            {{-- ═══════════════════════════════════════ 5. DARK MODE ═══════════════════════════════════════ --}}
            <section id="aturan-dark-mode" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/design-system.sections.dark_mode.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/design-system.sections.dark_mode.desc') !!}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <vibe:card>
                        <vibe:card.header>
                            <h3 class="font-semibold text-sm text-foreground">{{ __('docs/design-system.sections.dark_mode.correct_title') }}</h3>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <pre class="bg-muted rounded-lg p-3 text-xs font-mono text-foreground overflow-x-auto">
// ✅ Gunakan token semantik:
'bg-primary text-primary-foreground'
'bg-card border-border text-foreground'
'text-muted-foreground'
'hover:bg-accent'</pre>
                            <p class="text-xs text-muted-foreground">{{ __('docs/design-system.sections.dark_mode.correct_desc') }}</p>
                        </vibe:card.content>
                    </vibe:card>

                    <vibe:card>
                        <vibe:card.header>
                            <h3 class="font-semibold text-sm text-destructive">{{ __('docs/design-system.sections.dark_mode.avoid_title') }}</h3>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <pre class="bg-muted rounded-lg p-3 text-xs font-mono text-foreground overflow-x-auto">
// ❌ Hindari warna literal:
'bg-gray-800 text-white'
'bg-white border-gray-200'

// ❌ Hindari dark: per komponen:
'dark:bg-gray-900 dark:text-gray-100'</pre>
                            <p class="text-xs text-muted-foreground">{{ __('docs/design-system.sections.dark_mode.avoid_desc') }}</p>
                        </vibe:card.content>
                    </vibe:card>
                </div>

                <vibe:card>
                    <vibe:card.header>
                        <p class="text-xs font-semibold text-foreground">{{ __('docs/design-system.sections.dark_mode.exceptions_title') }}</p>
                    </vibe:card.header>
                    <vibe:card.content>
                        <ul class="text-xs text-muted-foreground space-y-1.5 list-disc list-inside">
                            @foreach (__('docs/design-system.sections.dark_mode.exceptions') as $exception)
                                <li>{!! $exception !!}</li>
                            @endforeach
                        </ul>
                    </vibe:card.content>
                </vibe:card>
            </section>

            {{-- ═══════════════════════════════════════ 6. PANDUAN MEMILIH VARIANT ═══════════════════════════════════════ --}}
            <section id="panduan-pemilihan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/design-system.sections.guidelines.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {{ __('docs/design-system.sections.guidelines.desc') }}
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>{{ __('docs/design-system.sections.guidelines.columns.context') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/design-system.sections.guidelines.columns.variant') }}</vibe:table.column>
                        <vibe:table.column>{{ __('docs/design-system.sections.guidelines.columns.note') }}</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @foreach (__('docs/design-system.sections.guidelines.items') as $guide)
                            <vibe:table.row>
                                <vibe:table.cell class="text-foreground text-xs">{{ $guide['context'] }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono font-bold text-foreground text-xs whitespace-nowrap">{{ $guide['variant'] }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground text-xs">{{ $guide['note'] }}</vibe:table.cell>
                            </vibe:table.row>
                        @endforeach
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>

</x-docs.layouts.sidebar>
