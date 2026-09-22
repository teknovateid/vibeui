<x-docs.layouts.sidebar>
    <vibe:seo :title="__('docs/show.title')" :description="__('docs/show.description')" schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => __('docs/show.title'), 'url' => '/docs/show']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="secondary" class="rounded-full">{{ __('docs/show.badge') }}</vibe:badge>
                    <span class="text-xs text-muted-foreground">{{ __('docs/show.group') }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">{{ __('docs/show.title') }}</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    {{ __('docs/show.description') }}
                </p>

                {{-- Quick Badges Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:button.show&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:show&gt;</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">&lt;vibe:show.each&gt;</vibe:badge>
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">vibe-show</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">vibe-show-attr</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">vibe-show-html</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">vibe-show-each</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">$iteration</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">$index</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">.</vibe:badge>
                </div>
            </div>

            {{-- 1. Penggunaan Dasar --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.basic_usage.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.basic_usage.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/show.basic_usage.preview_title')">
                    <vibe:preview.code>
{{-- Menggunakan <vibe:card> untuk wadah data yang dipopulasikan --}}
<\vibe:card class="max-w-lg space-y-4">
    <div class="space-y-1">
        <span class="text-xs text-muted-foreground">Nama:</span>
        <\vibe:show key="user.name" class="font-bold text-foreground block">
            Nama pengguna akan tampil di sini
        </\vibe:show>
    </div>

    <\vibe:separator />

    {{-- Menggunakan dot-notation bersarang --}}
    <div class="space-y-1">
        <span class="text-xs text-muted-foreground">Telepon:</span>
        <\vibe:show key="user.contact.phone" class="font-mono text-sm block">
            +62 812-3456-7890
        </\vibe:show>
    </div>

    <\vibe:separator />

    {{-- Menggunakan atribut vibe-show langsung pada elemen HTML standar --}}
    <div class="space-y-1">
        <span class="text-xs text-muted-foreground">Biografi:</span>
        <p class="text-sm text-muted-foreground leading-relaxed" vibe-show="user.bio">
            Biografi pengguna akan tampil di sini
        </p>
    </div>
</\vibe:card>
                    </vibe:preview.code>

                    <vibe:card class="w-full max-w-lg space-y-4">
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">&lt;vibe:show key="user.name"&gt;:</span>
                            <vibe:show key="user.name" class="font-bold text-foreground block">
                                Masum Parvej
                            </vibe:show>
                        </div>
                        <vibe:separator />
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">&lt;vibe:show key="user.contact.phone"&gt;:</span>
                            <span class="font-mono text-sm text-foreground block">+62 812-3456-7890</span>
                        </div>
                        <vibe:separator />
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">vibe-show="user.bio":</span>
                            <p class="text-sm text-muted-foreground leading-relaxed" vibe-show="user.bio">
                                Senior Product Designer &amp; Frontend Developer. Building high-quality design systems.
                            </p>
                        </div>
                    </vibe:card>
                </vibe:preview>
            </section>

            {{-- 2. Binding Atribut & Konten HTML --}}
            <section id="binding-atribut-html" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.advanced_binding.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.advanced_binding.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/show.advanced_binding.preview_title')">
                    <vibe:preview.code>
<\vibe:card class="max-w-xl">
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        {{-- 1. Binding Atribut Gambar (src) --}}
        <\vibe:show key="user.avatar" as="img" attr="src" alt="Avatar Pengguna" class="size-16 rounded-full object-cover border border-border shrink-0" />

        <div class="space-y-2 min-w-0">
            <div class="flex items-center gap-2">
                <h4 class="font-bold text-foreground" vibe-show="user.name">Masum Parvej</h4>
                <\vibe:badge variant="success" size="sm">Verified Member</\vibe:badge>
            </div>

            {{-- 2. Render Konten HTML Mentah (html) --}}
            <\vibe:show key="user.bio_html" html as="div" class="p-2.5 rounded-lg bg-muted/50 text-xs text-foreground" />

            {{-- 3. Binding Atribut Link (href) --}}
            <div>
                <a href="#" vibe-show="user.website" vibe-show-attr="href" target="_blank" class="text-xs text-primary hover:underline font-mono">
                    <\vibe:show key="user.website">https://hugeicons.com</\vibe:show> &rarr;
                </a>
            </div>
        </div>
    </div>
</\vibe:card>
                    </vibe:preview.code>

                    <vibe:card class="w-full max-w-xl">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <vibe:avatar size="xl" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" alt="Avatar" />
                            <div class="space-y-2 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-foreground">Masum Parvej</span>
                                    <vibe:badge variant="success" size="sm">Verified Member</vibe:badge>
                                </div>
                                <div class="p-2.5 rounded-lg bg-muted/40 text-xs text-foreground">
                                    Senior <strong>Product Designer</strong> &amp; <em>Frontend Developer</em> at Hugeicons.
                                </div>
                                <div>
                                    <a href="https://hugeicons.com" target="_blank" class="text-xs text-primary hover:underline font-mono">https://hugeicons.com &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </vibe:card>
                </vibe:preview>
            </section>

            {{-- 3. Trigger Fetch: <vibe:button.show> --}}
            <section id="trigger-fetch" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.button_show.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.button_show.desc') !!}
                    </p>
                </div>

                {{-- Preview 3A: Modal Target --}}
                <vibe:preview :title="__('docs/show.button_show.preview_title')">
                    <vibe:preview.code>
<\vibe:button.show
    :url="route('docs.button.show-demo')"
    target="user-show-modal"
    variant="primary"
>
    {{ __('docs/show.button_show.trigger_btn') }}
</\vibe:button.show>

<\vibe:modal id="user-show-modal" max-width="2xl">
    <div class="p-6 space-y-6">
        <div class="flex items-center gap-4">
            <\vibe:avatar vibe-show="avatar" size="xl" />
            <div>
                <div class="flex items-center gap-2">
                    <h3 class="text-lg font-bold text-foreground" vibe-show="name"></h3>
                    <\vibe:badge variant="success" size="sm" vibe-show="status"></\vibe:badge>
                </div>
                <p class="text-xs text-muted-foreground" vibe-show="email"></p>
            </div>
        </div>

        {{-- Komponen Form Vibe UI Otomatis Terisi Sesuai Atribut 'name' --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <\vibe:input name="name" label="Nama Lengkap" />
            <\vibe:input name="email" label="Alamat Email" />
            <\vibe:textarea name="bio" label="Biografi Singkat" class="sm:col-span-2" rows="2" />
            <\vibe:select name="role" label="Peran Akun" :options="['admin' => 'Administrator', 'user' => 'Reguler User']" />
            <div class="flex items-center pt-6">
                <\vibe:switch name="is_active" label="Status Akun Aktif" />
            </div>
        </div>

        {{-- Looping Baris Tabel Produk via <vibe:table> --}}
        <div class="space-y-2">
            <h4 class="text-xs font-semibold text-foreground uppercase tracking-wider">Produk Terdaftar:</h4>
            <\vibe:table dense>
                <\vibe:table.header>
                    <\vibe:table.column class="w-12 text-center">No</\vibe:table.column>
                    <\vibe:table.column>Nama Produk</\vibe:table.column>
                    <\vibe:table.column class="text-right">Harga</\vibe:table.column>
                </\vibe:table.header>
                <tbody vibe-show-each="products" class="divide-y divide-border/60">
                    <template>
                        <tr class="hover:bg-muted/30 transition-colors">
                            <td class="py-2.5 px-3 text-center text-xs text-muted-foreground" vibe-show="$iteration"></td>
                            <td class="py-2.5 px-3 font-medium text-foreground" vibe-show="name"></td>
                            <td class="py-2.5 px-3 text-right font-semibold text-primary" vibe-show="price"></td>
                        </tr>
                    </template>
                    <tr data-vibe-empty class="hidden">
                        <td colspan="3" class="py-4 text-center text-xs text-muted-foreground">
                            Tidak ada produk.
                        </td>
                    </tr>
                </tbody>
            </\vibe:table>
        </div>
    </div>
</\vibe:modal>
                    </vibe:preview.code>

                    <div class="flex flex-col items-center justify-center p-6 gap-4">
                        <vibe:button.show
                            :url="route('docs.button.show-demo')"
                            target="user-show-modal"
                            variant="primary"
                        >
                            {{ __('docs/show.button_show.trigger_btn') }}
                        </vibe:button.show>

                        <vibe:modal id="user-show-modal" max-width="2xl">
                            <div class="p-6 space-y-6">
                                <div class="flex items-center gap-4">
                                    <vibe:avatar vibe-show="avatar" size="xl" />
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h3 class="text-lg font-bold text-foreground" vibe-show="name"></h3>
                                            <vibe:badge variant="success" size="sm" vibe-show="status"></vibe:badge>
                                        </div>
                                        <p class="text-xs text-muted-foreground" vibe-show="email"></p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <vibe:input name="name" label="Nama Lengkap" />
                                    <vibe:input name="email" label="Alamat Email" />
                                    <vibe:textarea name="bio" label="Biografi Singkat" class="sm:col-span-2" rows="2" />
                                    <vibe:select name="role" label="Peran Akun" :options="['admin' => 'Administrator', 'user' => 'Reguler User']" />
                                    <div class="flex items-center pt-6">
                                        <vibe:switch name="is_active" label="Status Akun Aktif" />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <h4 class="text-xs font-semibold text-foreground uppercase tracking-wider">Produk Terdaftar:</h4>
                                    <vibe:table dense>
                                        <vibe:table.header>
                                            <vibe:table.column class="w-12 text-center">No</vibe:table.column>
                                            <vibe:table.column>Nama Produk</vibe:table.column>
                                            <vibe:table.column class="text-right">Harga</vibe:table.column>
                                        </vibe:table.header>
                                        <tbody vibe-show-each="products" class="divide-y divide-border/60">
                                            <template>
                                                <tr class="hover:bg-muted/30 transition-colors">
                                                    <td class="py-2.5 px-3 text-center text-xs text-muted-foreground" vibe-show="$iteration"></td>
                                                    <td class="py-2.5 px-3 font-medium text-foreground" vibe-show="name"></td>
                                                    <td class="py-2.5 px-3 text-right font-semibold text-primary" vibe-show="price"></td>
                                                </tr>
                                            </template>
                                            <tr data-vibe-empty class="hidden">
                                                <td colspan="3" class="py-4 text-center text-xs text-muted-foreground">
                                                    Tidak ada produk.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </vibe:table>
                                </div>
                            </div>
                        </vibe:modal>
                    </div>
                </vibe:preview>

                {{-- Preview 3B: Sheet (Drawer) & Inline Targets --}}
                <vibe:preview :title="__('docs/show.button_show.sheet_preview_title')">
                    <vibe:preview.code>
{{-- 1. Trigger untuk Side Sheet (Drawer) --}}
<\vibe:button.show
    :url="route('docs.button.show-demo')"
    target="user-show-sheet"
    variant="secondary"
>
    {{ __('docs/show.button_show.trigger_sheet_btn') }}
</\vibe:button.show>

<\vibe:sheet id="user-show-sheet" position="right" size="md">
    <\vibe:sheet.header>
        <h3 class="font-bold text-lg" vibe-show="name">Detail User</h3>
        <p class="text-xs text-muted-foreground" vibe-show="email"></p>
    </\vibe:sheet.header>
    <\vibe:sheet.content class="p-6 space-y-4">
        <div class="flex items-center gap-3">
            <\vibe:avatar vibe-show="avatar" size="lg" />
            <div>
                <h4 class="font-bold text-sm text-foreground" vibe-show="name"></h4>
                <\vibe:badge variant="outline" size="sm" vibe-show="role"></\vibe:badge>
            </div>
        </div>
        <p class="text-xs text-muted-foreground leading-relaxed" vibe-show="bio"></p>

        {{-- Daftar Keahlian via Primitive Array Looping --}}
        <div class="space-y-1.5 pt-2">
            <span class="text-xs font-semibold text-foreground uppercase tracking-wider">Skills:</span>
            <\vibe:show.each key="skills" as="div" class="flex flex-wrap gap-1.5">
                <\vibe:badge variant="surface" size="sm" vibe-show="."></\vibe:badge>
            </\vibe:show.each>
        </div>
    </\vibe:sheet.content>
</\vibe:sheet>

{{-- 2. Trigger untuk Kontainer Inline (Card Langsung di Halaman) --}}
<\vibe:button.show
    :url="route('docs.button.show-demo')"
    target="user-inline-card"
    variant="outline"
>
    {{ __('docs/show.button_show.trigger_inline_btn') }}
</\vibe:button.show>

<\vibe:card id="user-inline-card" class="max-w-md border-dashed">
    <div class="flex items-center gap-3">
        <\vibe:avatar vibe-show="avatar" size="md" />
        <div>
            <h4 class="font-bold text-sm text-foreground" vibe-show="name">Menunggu data...</h4>
            <p class="text-xs text-muted-foreground" vibe-show="email">Klik tombol di atas untuk memuat</p>
        </div>
    </div>
</\vibe:card>
                    </vibe:preview.code>

                    <div class="space-y-6 p-4">
                        <div class="flex flex-wrap items-center gap-3">
                            <vibe:button.show
                                :url="route('docs.button.show-demo')"
                                target="user-show-sheet"
                                variant="secondary"
                            >
                                {{ __('docs/show.button_show.trigger_sheet_btn') }}
                            </vibe:button.show>

                            <vibe:button.show
                                :url="route('docs.button.show-demo')"
                                target="user-inline-card"
                                variant="outline"
                            >
                                {{ __('docs/show.button_show.trigger_inline_btn') }}
                            </vibe:button.show>
                        </div>

                        {{-- Side Sheet Target --}}
                        <vibe:sheet id="user-show-sheet" position="right" class="z-0" size="md">
                            <vibe:sheet.header>
                                <h3 class="font-bold text-lg" vibe-show="name">Detail User</h3>
                                <p class="text-xs text-muted-foreground" vibe-show="email"></p>
                            </vibe:sheet.header>
                            <vibe:sheet.content class="p-6 space-y-4">
                                <div class="flex items-center gap-3">
                                    <vibe:avatar vibe-show="avatar" size="lg" />
                                    <div>
                                        <h4 class="font-bold text-sm text-foreground" vibe-show="name"></h4>
                                        <vibe:badge variant="outline" size="sm" vibe-show="role"></vibe:badge>
                                    </div>
                                </div>
                                <p class="text-xs text-muted-foreground leading-relaxed" vibe-show="bio"></p>

                                <div class="space-y-1.5 pt-2">
                                    <span class="text-xs font-semibold text-foreground uppercase tracking-wider">Skills:</span>
                                    <vibe:show.each key="skills" as="div" class="flex flex-wrap gap-1.5">
                                        <vibe:badge variant="surface" size="sm" vibe-show="."></vibe:badge>
                                    </vibe:show.each>
                                </div>
                            </vibe:sheet.content>
                        </vibe:sheet>

                        {{-- Inline Target Card --}}
                        <vibe:card id="user-inline-card" class="w-full max-w-md border-dashed bg-card/60">
                            <div class="flex items-center gap-3">
                                <vibe:avatar vibe-show="avatar" size="md" />
                                <div>
                                    <h4 class="font-bold text-sm text-foreground" vibe-show="name">Menunggu data...</h4>
                                    <p class="text-xs text-muted-foreground" vibe-show="email">Klik tombol 'Muat ke Kartu' di atas untuk mempopulasikan area ini.</p>
                                </div>
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Looping Array: <vibe:show.each> --}}
            <section id="looping-data" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.looping.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.looping.desc') !!}
                    </p>
                </div>

                {{-- Preview 4A: Table Looping --}}
                <vibe:preview :title="__('docs/show.looping.preview_title')">
                    <vibe:preview.code>
{{-- Menggunakan komponen <vibe:table> dan <vibe:show.each as="tbody"> --}}
<\vibe:table>
    <\vibe:table.header>
        <\vibe:table.column class="w-12 text-center">No</\vibe:table.column>
        <\vibe:table.column>Produk</\vibe:table.column>
        <\vibe:table.column class="text-right">Harga</\vibe:table.column>
    </\vibe:table.header>
    <\vibe:show.each key="products" as="tbody" empty="Belum ada produk terdaftar." empty-colspan="3" class="divide-y divide-border/60">
        <tr class="hover:bg-muted/30 transition-colors">
            <td class="py-3 px-4 text-center font-mono text-xs text-muted-foreground" vibe-show="$iteration"></td>
            <td class="py-3 px-4 font-medium text-foreground" vibe-show="name"></td>
            <td class="py-3 px-4 text-right font-semibold text-primary" vibe-show="price"></td>
        </tr>
    </\vibe:show.each>
</\vibe:table>
                    </vibe:preview.code>

                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="w-12 text-center">No</vibe:table.column>
                            <vibe:table.column>Produk</vibe:table.column>
                            <vibe:table.column class="text-right">Harga</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            <vibe:table.row>
                                <vibe:table.cell class="text-center font-mono text-xs text-muted-foreground">1</vibe:table.cell>
                                <vibe:table.cell class="font-medium text-foreground">MacBook Pro M3 Max</vibe:table.cell>
                                <vibe:table.cell class="text-right font-semibold text-primary">Rp 38.500.000</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="text-center font-mono text-xs text-muted-foreground">2</vibe:table.cell>
                                <vibe:table.cell class="font-medium text-foreground">Studio Display 27"</vibe:table.cell>
                                <vibe:table.cell class="text-right font-semibold text-primary">Rp 24.999.000</vibe:table.cell>
                            </vibe:table.row>
                            <vibe:table.row>
                                <vibe:table.cell class="text-center font-mono text-xs text-muted-foreground">3</vibe:table.cell>
                                <vibe:table.cell class="font-medium text-foreground">Magic Keyboard with Touch ID</vibe:table.cell>
                                <vibe:table.cell class="text-right font-semibold text-primary">Rp 2.450.000</vibe:table.cell>
                            </vibe:table.row>
                        </vibe:table.rows>
                    </vibe:table>
                </vibe:preview>

                {{-- Preview 4B: Grid Cards & Primitive Looping --}}
                <vibe:preview :title="__('docs/show.looping.grid_preview_title')">
                    <vibe:preview.code>
{{-- 1. Looping Kartu Grid Menggunakan <vibe:card> --}}
<\vibe:show.each key="products" as="div" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
    <\vibe:card class="space-y-2">
        <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-muted-foreground">#<span vibe-show="$iteration"></span></span>
            <\vibe:badge variant="primary" size="xs">Ready</\vibe:badge>
        </div>
        <h4 class="font-bold text-sm text-foreground truncate" vibe-show="name"></h4>
        <p class="text-xs font-semibold text-primary" vibe-show="price"></p>
    </\vibe:card>
</\vibe:show.each>

{{-- 2. Looping Primitive Array (vibe-show=".") --}}
<div class="flex flex-wrap gap-1.5 pt-2">
    <\vibe:show.each key="skills" as="div" class="contents">
        <\vibe:badge variant="outline" size="sm" vibe-show="."></\vibe:badge>
    </\vibe:show.each>
</div>
                    </vibe:preview.code>

                    <div class="space-y-6 w-full">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-mono text-muted-foreground">#1</span>
                                    <vibe:badge variant="primary" size="xs">Ready</vibe:badge>
                                </div>
                                <h4 class="font-bold text-sm text-foreground truncate">MacBook Pro M3 Max</h4>
                                <p class="text-xs font-semibold text-primary">Rp 38.500.000</p>
                            </vibe:card>
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-mono text-muted-foreground">#2</span>
                                    <vibe:badge variant="primary" size="xs">Ready</vibe:badge>
                                </div>
                                <h4 class="font-bold text-sm text-foreground truncate">Studio Display 27"</h4>
                                <p class="text-xs font-semibold text-primary">Rp 24.999.000</p>
                            </vibe:card>
                            <vibe:card class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-mono text-muted-foreground">#3</span>
                                    <vibe:badge variant="primary" size="xs">Ready</vibe:badge>
                                </div>
                                <h4 class="font-bold text-sm text-foreground truncate">Magic Keyboard</h4>
                                <p class="text-xs font-semibold text-primary">Rp 2.450.000</p>
                            </vibe:card>
                        </div>

                        <vibe:card class="space-y-2">
                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wider">Primitive Badges (.):</span>
                            <div class="flex flex-wrap gap-1.5">
                                <vibe:badge variant="outline" size="sm">Design Systems</vibe:badge>
                                <vibe:badge variant="outline" size="sm">Tailwind CSS</vibe:badge>
                                <vibe:badge variant="outline" size="sm">Alpine.js</vibe:badge>
                                <vibe:badge variant="outline" size="sm">Laravel Blade</vibe:badge>
                            </div>
                        </vibe:card>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Dukungan Komponen Form Vibe UI --}}
            <section id="dukungan-komponen" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.components_support.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.components_support.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/show.components_support.preview_title')">
                    <vibe:preview.code>
{{-- Komponen Form Otomatis Terhubung dengan Data via name="..." di dalam <vibe:card> --}}
<\vibe:card class="max-w-2xl">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        {{-- Otomatis dipetakan dari key 'name', 'email', 'bio' --}}
        <\vibe:input name="name" label="Nama" />
        <\vibe:input name="email" label="Email" />
        <\vibe:textarea name="bio" label="Bio" class="sm:col-span-2" rows="2" />
        <\vibe:select name="role" label="Peran" :options="['admin' => 'Admin', 'user' => 'User']" />
        <div class="flex items-center pt-6">
            <\vibe:switch name="is_active" label="Aktif" />
        </div>
        <\vibe:range name="skill_level" label="Tingkat Kemahiran" :min="0" :max="100" class="sm:col-span-2" />
        <div class="flex items-center gap-3 pt-2 sm:col-span-2">
            <\vibe:avatar vibe-show="avatar" size="lg" />
            <\vibe:badge vibe-show="status" variant="success"></\vibe:badge>
        </div>
    </div>
</\vibe:card>
                    </vibe:preview.code>

                    <vibe:card class="w-full max-w-2xl">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <vibe:input label="Nama" value="Masum Parvej" readonly />
                            <vibe:input label="Email" value="masum@hugeicons.com" readonly />
                            <vibe:textarea label="Bio" class="sm:col-span-2" rows="2" readonly>Senior Product Designer &amp; Frontend Developer.</vibe:textarea>
                            <vibe:select label="Peran" :options="['admin' => 'Admin', 'user' => 'User']" value="admin" disabled />
                            <div class="flex items-center pt-6">
                                <vibe:switch label="Status Aktif" checked disabled />
                            </div>
                            <div class="flex items-center gap-3 pt-2 sm:col-span-2">
                                <vibe:avatar size="md" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" />
                                <vibe:badge variant="success" size="sm">Verified Member</vibe:badge>
                            </div>
                        </div>
                    </vibe:card>
                </vibe:preview>
            </section>

            {{-- 6. API JavaScript & Custom Events --}}
            <section id="api-javascript" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.javascript_api.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.javascript_api.desc') !!}
                    </p>
                </div>

                <vibe:preview :title="__('docs/show.javascript_api.preview_title')">
                    <vibe:preview.code>
{{-- 1. Populasi Data Terprogram via JavaScript --}}
<script>
    // Mempopulasikan data ke kontainer elemen langsung tanpa tombol AJAX
    const myData = {
        title: 'Proyek Baru Vibe UI',
        description: 'Eksplorasi antarmuka modern dengan Blade & Tailwind.',
        author: 'Fahril'
    };

    VibeShow.populate(myData, document.getElementById('project-card'));

    // Atau memicu fetchAndShow secara terprogram
    // VibeShow.fetchAndShow(null, { url: '/api/posts/1', target: 'post-detail' });
</script>

{{-- 2. Menangkap Event Custom DOM pada <vibe:card> --}}
<\vibe:card
    id="project-card"
    x-data="{ lastUpdated: null }"
    @vibe:show:success="lastUpdated = new Date().toLocaleTimeString()"
    class="max-w-md space-y-2"
>
    <h3 class="font-bold text-foreground" vibe-show="title">Judul Default</h3>
    <p class="text-xs text-muted-foreground" vibe-show="description">Deskripsi</p>
    <span class="text-[10px] text-muted-foreground" x-show="lastUpdated" x-text="'Diperbarui pada: ' + lastUpdated"></span>
</\vibe:card>
                    </vibe:preview.code>

                    <vibe:card
                        id="js-api-demo-container"
                        x-data="{
                            status: 'Belum dipopulasikan',
                            loadData() {
                                VibeShow.populate({
                                    title: 'Teknovate Next-Gen Design System',
                                    description: 'Komponen Blade ultra cepat dan reaktif bertenaga Alpine & Tailwind.',
                                    tags: ['Blade', 'Tailwind', 'Pest', 'Vite']
                                }, this.$el);
                            }
                        }"
                        @vibe:show:success="status = 'Berhasil dipopulasikan pada ' + new Date().toLocaleTimeString()"
                        class="w-full max-w-xl space-y-4"
                    >
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono text-primary" x-text="status"></span>
                            <vibe:button size="xs" variant="outline" @click="loadData()">
                                Jalankan VibeShow.populate()
                            </vibe:button>
                        </div>
                        <vibe:card variant="outline" class="space-y-1 bg-muted/20">
                            <h4 class="font-bold text-sm text-foreground" vibe-show="title">Judul Awal (Placeholder)</h4>
                            <p class="text-xs text-muted-foreground" vibe-show="description">Klik tombol di atas untuk menjalankan VibeShow.populate() secara dinamis.</p>
                        </vibe:card>
                    </vibe:card>
                </vibe:preview>
            </section>

            {{-- 7. Props Reference --}}
            <section id="referensi-props" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">{{ __('docs/show.props.title') }}</h2>
                    <p class="text-sm text-muted-foreground">
                        {!! __('docs/show.props.desc') !!}
                    </p>
                </div>

                {{-- vibe:button.show --}}
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-foreground">Props &lt;vibe:button.show&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/show.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $buttonProps = [
                                    ['url', 'string', 'null', 'URL endpoint AJAX untuk mengambil data JSON (wajib).'],
                                    ['target', 'string', 'null', 'ID kontainer target atau CSS selector yang akan diisi data dan ditampilkan (wajib). Otomatis membuka modal atau sheet jika ID sesuai.'],
                                    ['method', "'GET'|'POST'", "'GET'", 'Metode HTTP request yang digunakan untuk request AJAX.'],
                                    ['variant', "'ghost'|'primary'|'secondary'|'outline'|...", "'ghost'", 'Skema visual tampilan tombol Vibe.'],
                                    ['size', "'xs'|'sm'|'md'|'lg'|'xl'|'icon-xs'|'icon-sm'|'icon-md'|'icon-lg'", "'md'", 'Ukuran tinggi, padding, dan ikon tombol.'],
                                    ['title', 'string|null', 'null', 'Tooltip atau label judul tombol (default dari translasi: "Lihat detail" / "View details").'],
                                ];
                            @endphp
                            @foreach ($buttonProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:show --}}
                <div class="space-y-2 pt-2">
                    <p class="text-sm font-semibold text-foreground">Props &lt;vibe:show&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/show.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $showProps = [
                                    ['key', 'string', 'null', 'Kunci path data JSON pada respon (mendukung dot-notation seperti user.profile.name atau bracket notation items[0].title).'],
                                    ['as', 'string', "'span'", 'Tag HTML yang digunakan untuk merender elemen pembungkus (misal: span, div, p, h3, img).'],
                                    ['html', 'bool', 'false', 'Jika bernilai true, konten diisi menggunakan innerHTML sehingga aman merender tag HTML.'],
                                    ['attr', 'string|null', 'null', 'Nama atribut elemen HTML tujuan yang nilainya akan diisi oleh data (misal: src, href, title, alt).'],
                                ];
                            @endphp
                            @foreach ($showProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- vibe:show.each --}}
                <div class="space-y-2 pt-2">
                    <p class="text-sm font-semibold text-foreground">Props &lt;vibe:show.each&gt;</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.default') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/show.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $eachProps = [
                                    ['key', 'string', 'null', 'Kunci data bertipe array/list pada respon server (wajib).'],
                                    ['as', 'string', "'div'", 'Tag HTML kontainer pembungkus (misal: tbody untuk tabel, div untuk kartu/grid, ul untuk list).'],
                                    ['empty', 'string|null', 'null', 'Teks pesan kosong yang ditampilkan jika array bernilai kosong atau null.'],
                                    ['empty-colspan', 'int|null', 'null', 'Jumlah kolom (colspan) untuk baris pesan kosong saat as="tbody".'],
                                ];
                            @endphp
                            @foreach ($eachProps as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>

                {{-- Special Attributes & Template Variables --}}
                <div class="space-y-2 pt-2">
                    <p class="text-sm font-semibold text-foreground">Atribut Khusus &amp; Variabel Template</p>
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.prop') }}</vibe:table.column>
                            <vibe:table.column class="whitespace-nowrap">{{ __('docs/show.props.columns.type') }}</vibe:table.column>
                            <vibe:table.column>{{ __('docs/show.props.columns.desc') }}</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $specials = [
                                    ['vibe-show="path"', 'HTML Attribute', 'Mengikat elemen HTML apa pun ke properti data respon server (alternatif dari tag &lt;vibe:show&gt;).'],
                                    ['vibe-show-attr="name"', 'HTML Attribute', 'Menentukan nama atribut HTML yang nilainya akan diisi oleh path vibe-show (misal: src, href, title).'],
                                    ['vibe-show-html', 'HTML Attribute', 'Menginstruksikan engine agar mengisi nilai ke innerHTML elemen alih-alih textContent.'],
                                    ['vibe-show-each="path"', 'HTML Attribute', 'Menandai kontainer pembungkus perulangan array (alternatif dari tag &lt;vibe:show.each&gt;).'],
                                    ['data-vibe-empty', 'HTML Attribute', 'Menandai elemen baris atau div yang otomatis ditampilkan ketika data array respon kosong.'],
                                    ['$iteration', 'Template Variable', 'Nomor urut perulangan berbasis 1 (1, 2, 3, ...) di dalam template perulangan.'],
                                    ['$index', 'Template Variable', 'Indeks perulangan array berbasis 0 (0, 1, 2, ...) di dalam template perulangan.'],
                                    ['.', 'Template Variable', 'Merujuk pada nilai item itu sendiri (berguna untuk array data bertipe primitif seperti string atau number).'],
                                ];
                            @endphp
                            @foreach ($specials as [$item, $type, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $item }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground">{{ $desc }}</vibe:table.cell>
                                </vibe:table.row>
                            @endforeach
                        </vibe:table.rows>
                    </vibe:table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
