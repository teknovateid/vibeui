<x-docs.layouts.sidebar>
    <vibe:seo title="Desain Sistem Warna — Vibe UI" description="Rumus lengkap penggunaan warna semantik dalam Vibe UI: token CSS, pola variant per komponen, formula match(), dan panduan konsistensi warna di seluruh sistem." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Desain Sistem Warna', 'url' => '/docs/design-system']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">Desain Sistem</vibe:badge>
                    <span class="text-xs text-muted-foreground">Panduan & Referensi</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Desain Sistem Warna</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Panduan lengkap tentang token warna semantik Vibe UI, rumus <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">match()</code> variant per komponen, pola penggunaan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">color-mix()</code>, dan aturan konsistensi warna di seluruh sistem komponen.
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
                    <h2 class="text-xl font-bold text-foreground">Token Warna Semantik</h2>
                    <p class="text-sm text-muted-foreground">
                        Vibe UI menggunakan CSS Custom Properties sebagai sumber kebenaran tunggal warna. Semua komponen <strong>wajib</strong> menggunakan token ini — bukan nilai hex langsung — agar theme light/dark berfungsi otomatis.
                    </p>
                </div>

                {{-- Palette Visual --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @php
                        $palette = [['name' => 'primary', 'bg' => 'bg-primary', 'text' => 'text-primary-foreground', 'token' => '--primary', 'value' => '#0a0b0a / #f9fafa (dark)', 'role' => 'Aksi utama, foreground default'], ['name' => 'secondary', 'bg' => 'bg-secondary', 'text' => 'text-secondary-foreground', 'token' => '--secondary', 'value' => '#f4f5f5 / #262726 (dark)', 'role' => 'Aksi sekunder, surface muted'], ['name' => 'success', 'bg' => 'bg-success', 'text' => 'text-success-foreground', 'token' => '--success', 'value' => '#10b981', 'role' => 'Konfirmasi, selesai, hemat'], ['name' => 'warning', 'bg' => 'bg-warning', 'text' => 'text-warning-foreground', 'token' => '--warning', 'value' => '#f59e0b', 'role' => 'Peringatan, ambang batas'], ['name' => 'destructive', 'bg' => 'bg-destructive', 'text' => 'text-destructive-foreground', 'token' => '--destructive', 'value' => '#ef4444', 'role' => 'Error, bahaya, hapus'], ['name' => 'info', 'bg' => 'bg-info', 'text' => 'text-info-foreground', 'token' => '--info', 'value' => '#0ea5e9', 'role' => 'Informasi, bantuan, sistem'], ['name' => 'accent', 'bg' => 'bg-accent', 'text' => 'text-accent-foreground', 'token' => '--accent', 'value' => '#f4f5f5 / #1e1f1e (dark)', 'role' => 'Hover surface, highlight halus'], ['name' => 'muted', 'bg' => 'bg-muted', 'text' => 'text-muted-foreground', 'token' => '--muted', 'value' => '#f4f5f5 / #1e1f1e (dark)', 'role' => 'Teks sekunder, placeholder']];
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
                    <h3 class="text-base font-semibold text-foreground">Token Surface & Struktur</h3>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>Token CSS</vibe:table.column>
                            <vibe:table.column>Light</vibe:table.column>
                            <vibe:table.column>Dark</vibe:table.column>
                            <vibe:table.column>Kegunaan</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $surfaceTokens = [['--background', '#f9fafa', '#0a0b0a', 'Latar halaman utama'], ['--foreground', '#0a0b0a', '#f9fafa', 'Teks utama di atas background'], ['--card', '#ffffff', '#181918', 'Surface kartu & panel'], ['--card-foreground', '#0a0b0a', '#f9fafa', 'Teks di atas kartu'], ['--popover', '#ffffff', '#181918', 'Surface dropdown, tooltip, popover'], ['--border', '#e5e6e5', '#262726', 'Garis pembatas, outline'], ['--input', '#e5e6e5', '#262726', 'Background input kosong / track'], ['--ring', '#0a0b0a', '#a2a4a3', 'Focus ring outline'], ['--muted-foreground', '#717372', '#a2a4a3', 'Teks placeholder, hint, caption'], ['--sidebar', '#ffffff', '#121312', 'Background sidebar nav'], ['--header', '#ffffff', '#121312', 'Background header/topbar']];
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
                    <h2 class="text-xl font-bold text-foreground">Rumus Variant: Solid vs Soft</h2>
                    <p class="text-sm text-muted-foreground">
                        Vibe UI memakai dua formula utama untuk komponen interaktif. Pilih formula berdasarkan <strong>bobot visual</strong> yang diinginkan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- SOLID --}}
                    <vibe:card class="overflow-hidden">
                        <vibe:card.header class="bg-primary text-primary-foreground rounded-none border-b-0 flex-row items-center justify-between gap-3">
                            <span class="font-semibold text-sm">Formula SOLID</span>
                            <vibe:badge variant="secondary" size="sm">Button, Switch Track, Range</vibe:badge>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <p class="text-xs text-muted-foreground">Digunakan untuk elemen interaktif utama: tombol primary, track slider aktif, toggle switch.</p>
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
                            <span class="font-semibold text-sm">Formula SOFT (Tinted)</span>
                            <vibe:badge variant="success" size="sm">Badge, Alert, Card Highlight</vibe:badge>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <p class="text-xs text-muted-foreground">Digunakan untuk indikator status, badge, dan highlight ringan agar tidak terlalu dominan secara visual.</p>
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
                        <h3 class="font-semibold text-sm text-foreground">Aturan Opacity Modifier Standar</h3>
                    </vibe:card.header>
                    <vibe:card.content>
                        <vibe:table variant="flush">
                            <vibe:table.header>
                                <vibe:table.column>Modifier</vibe:table.column>
                                <vibe:table.column>Kegunaan</vibe:table.column>
                                <vibe:table.column>Contoh Kelas</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @php
                                    $opacityRules = [['/90', 'Hover state tombol solid', 'hover:bg-primary/90'], ['/80', 'Hover state secondary/muted', 'hover:bg-secondary/80'], ['/15', 'Background soft badge/alert', 'bg-success/15'], ['/20', 'Border soft badge/alert', 'border-success/20'], ['/10', 'Hover overlay ghost/icon', 'hover:bg-foreground/10'], ['/25–35', 'Focus ring via color-mix()', 'color-mix(in srgb, --primary 25%, transparent)'], ['/50', 'Disabled state opacity', 'disabled:opacity-50'], ['/70', 'Teks sekunder/caption ringan', 'text-muted-foreground/70']];
                                @endphp
                                @foreach ($opacityRules as [$mod, $usage, $example])
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $mod }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground text-xs">{{ $usage }}</vibe:table.cell>
                                        <vibe:table.cell class="font-mono text-muted-foreground text-xs">{{ $example }}</vibe:table.cell>
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
                    <h2 class="text-xl font-bold text-foreground">Rumus Warna Per Komponen</h2>
                    <p class="text-sm text-muted-foreground">
                        Tabel referensi pola warna untuk setiap komponen. Semua komponen menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">match($variant)</code> PHP untuk men-generate class Tailwind secara bersih.
                    </p>
                </div>

                {{-- BUTTON --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">Button</h3>
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
                                <vibe:table.column>Variant</vibe:table.column>
                                <vibe:table.column>Formula Warna</vibe:table.column>
                                <vibe:table.column>Hover</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @php
                                    $buttonVariants = [['primary', 'bg-primary text-primary-foreground', 'hover:bg-primary/90'], ['secondary', 'bg-secondary text-secondary-foreground', 'hover:bg-secondary/80'], ['outline', 'border border-input bg-background text-foreground', 'hover:bg-accent hover:text-accent-foreground'], ['ghost', 'text-foreground', 'hover:bg-accent hover:text-accent-foreground'], ['surface', 'bg-card border border-border/80 text-card-foreground', 'hover:bg-accent/60'], ['accent', 'bg-accent text-accent-foreground border border-accent', 'hover:bg-accent/80'], ['danger', 'bg-destructive text-destructive-foreground', 'hover:bg-destructive/90'], ['success', 'bg-success text-success-foreground', 'hover:bg-success/90'], ['warning', 'bg-warning text-warning-foreground', 'hover:bg-warning/90'], ['info', 'bg-info text-info-foreground', 'hover:bg-info/90'], ['link', 'text-primary underline-offset-4', 'hover:underline']];
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
                        <h3 class="text-base font-semibold text-foreground">Badge</h3>
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
                            <p class="text-xs text-muted-foreground font-semibold">📐 Rumus Badge (Soft/Tinted — berbeda dari Button):</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
'danger'  => 'bg-destructive/15 text-destructive border border-destructive/20'
'success' => 'bg-success/15     text-success     border border-success/20'
'warning' => 'bg-warning/15     text-warning     border border-warning/20'
'info'    => 'bg-info/15        text-info        border border-info/20'</pre>
                            <p class="text-[11px] text-muted-foreground">💡 Badge menggunakan pola <strong>soft tinted</strong> (opacity /15 background + warna teks langsung), bukan solid background seperti Button.</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- SWITCH --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">Switch</h3>
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
                            <p class="text-xs text-muted-foreground font-semibold">📐 Rumus Track Switch (Checked State):</p>
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
                            <p class="text-[11px] text-muted-foreground">💡 Switch menggunakan <strong>pola SOLID</strong> pada track aktif, dengan thumb selalu <code class="font-mono">bg-background</code> untuk kontras maksimal.</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- RANGE --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">Range Slider</h3>
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
                            <p class="text-xs text-muted-foreground font-semibold">📐 Rumus Range (CSS Custom Property via PHP match()):</p>
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
                        <h3 class="text-base font-semibold text-foreground">Input, Textarea, Select, Date-Time</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">Kelompok Form</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <vibe:input name="ds_i1" label="Default" placeholder="Nilai normal" />
                            <vibe:input name="ds_i2" label="Error State" placeholder="Nilai tidak valid" error="Field ini wajib diisi." />
                            <vibe:input name="ds_i3" label="Info State" placeholder="Nilai dengan petunjuk" info="Format: dd/mm/yyyy" />
                            <vibe:input name="ds_i4" label="Readonly" value="Tidak bisa diubah" readonly />
                        </div>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">📐 Rumus Kelompok Form (state-based, tidak ada prop variant warna):</p>
                            <pre class="text-xs font-mono text-foreground overflow-x-auto">
Normal   => border border-input bg-background
           focus: ring-2 ring-ring ring-offset-background

Error    => border-destructive/70 bg-destructive/5
           ring-destructive/30, text-destructive (label & icon)

Info     => helper text: text-muted-foreground text-xs
           (hanya tampil jika tidak ada error)

Disabled => opacity-50 cursor-not-allowed
Readonly => cursor-default (tanpa opacity reduction)</pre>
                            <p class="text-[11px] text-muted-foreground">💡 Komponen form <strong>tidak memiliki prop <code class="font-mono">variant</code> warna</strong>. Warna hanya berubah berdasarkan state: normal, error, disabled/readonly.</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- DROPDOWN --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">Dropdown</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/dropdown/</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">📐 Rumus Dropdown Item Colors:</p>
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
                            <p class="text-[11px] text-muted-foreground">💡 Dropdown item semantik menggunakan pola <strong>teks berwarna + background /10</strong> saat hover — formula paling ringan untuk item dalam panel kecil.</p>
                        </div>
                    </vibe:card.content>
                </vibe:card>

                {{-- MODAL & SHEET --}}
                <vibe:card>
                    <vibe:card.header class="flex-row items-center justify-between gap-3">
                        <h3 class="text-base font-semibold text-foreground">Modal & Sheet</h3>
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[10px]">vibe/modal/, sheet/</vibe:badge>
                    </vibe:card.header>
                    <vibe:card.content>
                        <div class="rounded-lg bg-muted p-3 space-y-2">
                            <p class="text-xs text-muted-foreground font-semibold">📐 Rumus Modal & Sheet:</p>
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
                    <h2 class="text-xl font-bold text-foreground">Formula <code class="text-lg">color-mix()</code> — Focus Ring & Hover Glow</h2>
                    <p class="text-sm text-muted-foreground">
                        CSS <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">color-mix(in srgb, ...)</code> digunakan untuk membuat warna semi-transparent dari token padat — sangat berguna untuk focus ring dan active glow effects.
                    </p>
                </div>

                <vibe:card>
                    <vibe:card.content class="space-y-4">
                        <vibe:table variant="flush">
                            <vibe:table.header>
                                <vibe:table.column>Formula</vibe:table.column>
                                <vibe:table.column>Kegunaan</vibe:table.column>
                                <vibe:table.column>Tempat digunakan</vibe:table.column>
                            </vibe:table.header>
                            <vibe:table.rows>
                                @php
                                    $colorMixRules = [['color-mix(in srgb, var(--primary) 25%, transparent)', 'Focus ring lembut tombol/input', 'Button :active ring, Input focus'], ['color-mix(in srgb, var(--range-active-color) 25%, transparent)', 'Active ring slider thumb', 'Range Slider :active state'], ['color-mix(in srgb, var(--ring) 35%, transparent)', 'Focus-visible ring utama', 'Range Slider :focus-visible'], ['color-mix(in srgb, var(--primary-foreground) 35%, transparent)', 'Shimmer beam di progress bar', 'NProgress bar ::after']];
                                @endphp
                                @foreach ($colorMixRules as [$formula, $usage, $where])
                                    <vibe:table.row>
                                        <vibe:table.cell class="font-mono text-foreground text-xs">{{ $formula }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground text-xs">{{ $usage }}</vibe:table.cell>
                                        <vibe:table.cell class="text-muted-foreground/70 text-xs">{{ $where }}</vibe:table.cell>
                                    </vibe:table.row>
                                @endforeach
                            </vibe:table.rows>
                        </vibe:table>

                        <div class="rounded-lg bg-muted p-3 space-y-1">
                            <p class="text-xs font-semibold text-foreground">📌 Mengapa color-mix() dan bukan opacity modifier Tailwind?</p>
                            <p class="text-xs text-muted-foreground">
                                Tailwind opacity modifier (<code class="font-mono">bg-primary/25</code>) hanya bekerja pada elemen bertipe <code class="font-mono">background</code>. Untuk <code class="font-mono">box-shadow</code> dan <code class="font-mono">border-color</code> yang membutuhkan warna semi-transparan dari token CSS dinamis, <code class="font-mono">color-mix()</code> adalah satu-satunya pilihan yang bekerja konsisten di semua browser modern.
                            </p>
                        </div>
                    </vibe:card.content>
                </vibe:card>
            </section>

            {{-- ═══════════════════════════════════════ 5. DARK MODE ═══════════════════════════════════════ --}}
            <section id="aturan-dark-mode" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Aturan Dark Mode</h2>
                    <p class="text-sm text-muted-foreground">
                        Karena semua warna komponen menggunakan token CSS (bukan hex langsung), dark mode otomatis berfungsi hanya dengan mengganti nilai variabel CSS di root <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.dark</code> — tanpa perlu menulis kelas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dark:</code> per komponen.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <vibe:card>
                        <vibe:card.header>
                            <h3 class="font-semibold text-sm text-foreground">✅ Pattern yang Benar</h3>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <pre class="bg-muted rounded-lg p-3 text-xs font-mono text-foreground overflow-x-auto">
// ✅ Gunakan token semantik:
'bg-primary text-primary-foreground'
'bg-card border-border text-foreground'
'text-muted-foreground'
'hover:bg-accent'</pre>
                            <p class="text-xs text-muted-foreground">Token ini otomatis berubah nilai saat tema berganti.</p>
                        </vibe:card.content>
                    </vibe:card>

                    <vibe:card>
                        <vibe:card.header>
                            <h3 class="font-semibold text-sm text-destructive">❌ Pattern yang Harus Dihindari</h3>
                        </vibe:card.header>
                        <vibe:card.content class="space-y-3">
                            <pre class="bg-muted rounded-lg p-3 text-xs font-mono text-foreground overflow-x-auto">
// ❌ Hindari warna literal:
'bg-gray-800 text-white'
'bg-white border-gray-200'

// ❌ Hindari dark: per komponen:
'dark:bg-gray-900 dark:text-gray-100'</pre>
                            <p class="text-xs text-muted-foreground">Nilai literal tidak responsif terhadap perubahan tema.</p>
                        </vibe:card.content>
                    </vibe:card>
                </div>

                <vibe:card>
                    <vibe:card.header>
                        <p class="text-xs font-semibold text-foreground">📌 Pengecualian yang Diizinkan</p>
                    </vibe:card.header>
                    <vibe:card.content>
                        <ul class="text-xs text-muted-foreground space-y-1.5 list-disc list-inside">
                            <li>Warna <code class="font-mono">bg-black/50</code> untuk backdrop overlay modal (nilai absolut yang diinginkan di kedua tema).</li>
                            <li>Warna accent ungu/violet yang dipatok (<code class="font-mono">oklch(0.511 0.262 276.966)</code>) di range variant <code class="font-mono">accent</code> — karena token <code class="font-mono">--accent</code> di Vibe UI dipakai untuk surface hover (bukan warna ungu).</li>
                            <li>Warna chart (<code class="font-mono">--chart-1</code> s/d <code class="font-mono">--chart-5</code>) yang dapat berbeda antara light dan dark.</li>
                        </ul>
                    </vibe:card.content>
                </vibe:card>
            </section>

            {{-- ═══════════════════════════════════════ 6. PANDUAN MEMILIH VARIANT ═══════════════════════════════════════ --}}
            <section id="panduan-pemilihan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Panduan Memilih Variant</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan tabel ini sebagai acuan cepat untuk memilih variant yang tepat secara semantik di setiap konteks UI.
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>Konteks / Skenario</vibe:table.column>
                        <vibe:table.column>Variant yang Tepat</vibe:table.column>
                        <vibe:table.column>Catatan</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        @php
                            $guidelines = [['Aksi utama (Submit, Save, Konfirmasi)', 'primary', 'Selalu gunakan primary untuk CTA paling penting di halaman'], ['Aksi sekunder (Cancel, Back, Reset)', 'secondary / outline', 'secondary lebih solid, outline lebih ringan'], ['Hapus / Destruktif / Tidak bisa dibatalkan', 'danger', 'Wajib danger untuk aksi permanen yang tidak bisa di-undo'], ['Berhasil / Selesai / Aktif / Hemat', 'success', 'Konfirmasi pembayaran, badge status aktif, slider kapasitas optimal'], ['Peringatan / Threshold / Hampir penuh', 'warning', 'Ambang batas penggunaan, validasi ringan, konfigurasi penting'], ['Informasi / Panduan / Bantuan sistem', 'info', 'Alert informatif, badge informasi, range parameter sistem'], ['Aksen / Premium / Fitur khusus', 'accent', 'Slider rating bintang, toggle fitur premium, highlight spesial'], ['Aksi ghost/navigasi dalam card/list', 'ghost', 'Tombol edit inline, icon action, menu konteks'], ['Surface card/panel/container', 'surface', 'Tombol yang menyatu dengan kartu, aksi belum terlalu penting']];
                        @endphp
                        @foreach ($guidelines as [$context, $variant, $note])
                            <vibe:table.row>
                                <vibe:table.cell class="text-foreground text-xs">{{ $context }}</vibe:table.cell>
                                <vibe:table.cell class="font-mono font-bold text-foreground text-xs whitespace-nowrap">{{ $variant }}</vibe:table.cell>
                                <vibe:table.cell class="text-muted-foreground text-xs">{{ $note }}</vibe:table.cell>
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
