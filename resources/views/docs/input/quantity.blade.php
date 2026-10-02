<x-docs.layouts.sidebar>
    <vibe:seo title="Input Quantity & Stepper — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.quantity dengan tombol plus minus, kontrol continuous hold, density scale, dan integrasi Livewire di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input Quantity', 'url' => route('docs.input.quantity')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.quantity</vibe:badge>
                    <span class="text-xs text-muted-foreground">Stepper & Continuous Increment</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input Quantity & Stepper</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input kuantitas numerik dengan tombol tambah (<code>+</code>) dan kurang (<code>-</code>) terintegrasi. Dilengkapi proteksi batas minimum/maksimum, navigasi panah keyboard, dukungan continuous hold (tahan tombol untuk perubahan cepat), serta penyesuaian tata letak (split, grouped, stacked).
                </p>
            </div>

            {{-- 1. Penggunaan Dasar (Split Layout) --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Penggunaan Dasar (Layout Split)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara bawaan, tombol minus diletakkan di sisi paling kiri dan tombol plus di sisi paling kanan dengan touch target yang luas:
                    </p>
                </div>

                <vibe:preview title="Quantity Stepper Standar">
                    <vibe:preview.code>
<\vibe:input.quantity 
    label="Jumlah Barang" 
    name="quantity" 
    :value="1" 
    :min="1" 
    :max="50" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-xs space-y-3">
                        <vibe:input.quantity 
                            label="Jumlah Barang" 
                            name="quantity_demo_1" 
                            :value="1" 
                            :min="1" 
                            :max="50" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Pilihan Tata Letak (Layout) --}}
            <section id="pilihan-layout" class="space-y-6">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Pilihan Tata Letak (Layout)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tersedia 5 pilihan variasi tata letak tombol stepper sesuai kebutuhan antarmuka:
                    </p>
                </div>

                {{-- 2.1 Layout Gap (Detached Stepper) --}}
                <div id="layout-gap" class="space-y-3 pt-2">
                    <h3 class="text-base font-semibold text-foreground flex items-center gap-2">
                        <span>A. Layout Gap (Tombol Terpisah & Jarak Spasi)</span>
                        <vibe:badge variant="primary" size="sm" class="rounded-full">Rekomendasi</vibe:badge>
                    </h3>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code>layout="gap"</code> (atau alias <code>layout="separated"</code>) untuk memisahkan tombol <code>[-]</code> dan <code>[+]</code> dari field input dengan jarak spasi (gap). Tambahkan <code>class="rounded-full"</code> untuk menghasilkan tombol bulat penuh (*circular*) dan input berbentuk kapsul (*pill*):
                    </p>

                    <vibe:preview title="Layout Gap / Detached Stepper">
                        <vibe:preview.code>
{{-- Layout Gap Standar --}}
<\vibe:input.quantity 
    label="Kuantitas Item (Layout Gap Standar)" 
    layout="gap" 
    :value="2" 
    :min="1" 
    :max="20" 
/>

{{-- Layout Gap Pill / Circular (rounded-full) --}}
<\vibe:input.quantity 
    label="Pill & Circular Buttons (Modern E-Commerce)" 
    layout="gap" 
    class="rounded-full" 
    :value="5" 
    :min="1" 
    :max="50" 
/>
                        </vibe:preview.code>
                        <div class="w-full max-w-sm space-y-5">
                            <vibe:input.quantity 
                                label="Kuantitas Item (Layout Gap Standar)" 
                                layout="gap" 
                                :value="2" 
                                :min="1" 
                                :max="20" 
                            />

                            <vibe:input.quantity 
                                label="Pill & Circular Buttons (Modern E-Commerce)" 
                                layout="gap" 
                                class="rounded-full" 
                                :value="5" 
                                :min="1" 
                                :max="50" 
                            />
                        </div>
                    </vibe:preview>
                </div>

                {{-- 2.2 Layout Subtle (Floating Pill Buttons) --}}
                <div id="layout-subtle" class="space-y-3 pt-4">
                    <h3 class="text-base font-semibold text-foreground">
                        B. Layout Subtle (Floating Stepper dengan Background Lembut)
                    </h3>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code>layout="subtle"</code> untuk tampilan modern minimalis di mana tombol mengambang di atas container dengan latar belakang lembut (<code>bg-muted/50</code>):
                    </p>

                    <vibe:preview title="Layout Subtle / Minimal">
                        <vibe:preview.code>
{{-- Layout Subtle Standar --}}
<\vibe:input.quantity 
    label="Subtle Controls" 
    layout="subtle" 
    :value="3" 
    :min="1" 
/>

{{-- Layout Subtle dengan class rounded-full --}}
<\vibe:input.quantity 
    label="Subtle Pill Controls" 
    layout="subtle" 
    class="rounded-full" 
    :value="8" 
    :min="1" 
/>
                        </vibe:preview.code>
                        <div class="w-full max-w-sm space-y-5">
                            <vibe:input.quantity 
                                label="Subtle Controls" 
                                layout="subtle" 
                                :value="3" 
                                :min="1" 
                            />

                            <vibe:input.quantity 
                                label="Subtle Pill Controls" 
                                layout="subtle" 
                                class="rounded-full" 
                                :value="8" 
                                :min="1" 
                            />
                        </div>
                    </vibe:preview>
                </div>

                {{-- 2.3 Layout Grouped & Stacked --}}
                <div id="layout-grouped-stacked" class="space-y-3 pt-4">
                    <h3 class="text-base font-semibold text-foreground">
                        C. Layout Grouped (Segmented Pill) & Stacked (Vertical Spinner)
                    </h3>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code>layout="grouped"</code> untuk gaya kapsul tersegmentasi rapat dengan garis batas pemisah, atau <code>layout="stacked"</code> untuk kontrol panah atas-bawah bertumpuk di sebelah kanan ala desktop number spinner:
                    </p>

                    <vibe:preview title="Layout Grouped & Stacked">
                        <vibe:preview.code>
{{-- Layout Grouped (Segmented Pill) --}}
<\vibe:input.quantity 
    label="Grouped (Pill Segmented)" 
    layout="grouped" 
    :value="5" 
    :min="1" 
/>

{{-- Layout Stacked (Vertical Spinner Controls) --}}
<\vibe:input.quantity 
    label="Stacked (Vertical Controls)" 
    layout="stacked" 
    :value="10" 
    :min="0" 
/>
                        </vibe:preview.code>
                        <div class="w-full max-w-sm space-y-5">
                            <vibe:input.quantity 
                                label="Grouped (Pill Segmented)" 
                                layout="grouped" 
                                :value="5" 
                                :min="1" 
                            />

                            <vibe:input.quantity 
                                label="Stacked (Vertical Controls)" 
                                layout="stacked" 
                                :value="10" 
                                :min="0" 
                            />
                        </div>
                    </vibe:preview>
                </div>
            </section>

            {{-- 3. Skala Ukuran (Density Scale) --}}
            <section id="skala-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Skala Ukuran (Density Scale)</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen kuantitas selaras dengan sistem ukuran tombol dan input Vibe UI (<code>xs: 28px</code>, <code>sm: 32px</code>, <code>md: 36px</code>, <code>lg: 40px</code>, <code>xl: 44px</code>):
                    </p>
                </div>

                <vibe:preview title="Pilihan Ukuran Komponen">
                    <vibe:preview.code>
<\vibe:input.quantity size="xs" label="Extra Small (28px / xs - Compact Table)" :value="1" />
<\vibe:input.quantity size="sm" label="Small (32px / sm)" :value="2" />
<\vibe:input.quantity size="md" label="Medium (36px / md - Default)" :value="4" />
<\vibe:input.quantity size="lg" label="Large (40px / lg)" :value="8" />
<\vibe:input.quantity size="xl" label="Extra Large (44px / xl - Touch Friendly)" :value="16" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input.quantity size="xs" label="Extra Small (28px / xs - Compact Table)" :value="1" />
                        <vibe:input.quantity size="sm" label="Small (32px / sm)" :value="2" />
                        <vibe:input.quantity size="md" label="Medium (36px / md - Default)" :value="4" />
                        <vibe:input.quantity size="lg" label="Large (40px / lg)" :value="8" />
                        <vibe:input.quantity size="xl" label="Extra Large (44px / xl - Touch Friendly)" :value="16" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Satuan Unit & Desimal Step --}}
            <section id="satuan-dan-step" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Satuan Unit & Nilai Desimal (Step)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan prop <code>unit</code> untuk menampilkan teks satuan di samping angka, dan tentukan nilai <code>step</code> desimal untuk pengukuran bobot atau takaran:
                    </p>
                </div>

                <vibe:preview title="Unit & Step Kustom">
                    <vibe:preview.code>
{{-- Satuan Pcs --}}
<\vibe:input.quantity label="Jumlah Pesanan" unit="pcs" :value="12" :min="1" />

{{-- Satuan Bobot & Step Desimal --}}
<\vibe:input.quantity label="Berat Biji Kopi" unit="kg" :step="0.5" :value="1.5" :min="0.5" :max="25" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-5">
                        <vibe:input.quantity label="Jumlah Pesanan" unit="pcs" :value="12" :min="1" />
                        <vibe:input.quantity label="Berat Biji Kopi" unit="kg" :step="0.5" :value="1.5" :min="0.5" :max="25" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Interaksi: Continuous Hold & Keyboard Navigation --}}
            <section id="interaksi-kontrol" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Fitur Interaksi (Continuous Hold & Keyboard)</h2>
                    <p class="text-sm text-muted-foreground">
                        Pengguna dapat menekan dan menahan tombol tambah/kurang untuk melakukan perubahan nilai beruntun (*continuous stepping*), atau menggunakan tombol <kbd class="px-1.5 py-0.5 text-xs bg-muted border border-border rounded font-mono">↑</kbd> dan <kbd class="px-1.5 py-0.5 text-xs bg-muted border border-border rounded font-mono">↓</kbd> pada keyboard:
                    </p>
                </div>

                <vibe:preview title="Tahan Tombol untuk Menambah/Mengurang Cepat">
                    <vibe:preview.code>
<\vibe:input.quantity 
    label="Stok Barang Gudang" 
    description="Tekan dan tahan tombol [+] atau [-] untuk stepper cepat"
    :value="100" 
    :step="5" 
    :min="0" 
    :max="1000" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm">
                        <vibe:input.quantity 
                            label="Stok Barang Gudang" 
                            description="Tekan dan tahan tombol [+] atau [-] untuk stepper cepat"
                            :value="100" 
                            :step="5" 
                            :min="0" 
                            :max="1000" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. State: Disabled, Readonly & Error --}}
            <section id="state-komponen" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. State: Disabled, Readonly & Validasi Error</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen mendukung seluruh state formulir standar:
                    </p>
                </div>

                <vibe:preview title="State Komponen">
                    <vibe:preview.code>
{{-- State Disabled --}}
<\vibe:input.quantity label="Stok Habis" :value="0" disabled />

{{-- State Readonly --}}
<\vibe:input.quantity label="Kuota Terkunci" :value="5" readonly />

{{-- State Error --}}
<\vibe:input.quantity 
    label="Porsi Melebihi Batas" 
    :value="15" 
    error="Maksimal pembelian hanya diperbolehkan 10 porsi per akun" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-5">
                        <vibe:input.quantity label="Stok Habis" :value="0" disabled />
                        <vibe:input.quantity label="Kuota Terkunci" :value="5" readonly />
                        <vibe:input.quantity 
                            label="Porsi Melebihi Batas" 
                            :value="15" 
                            error="Maksimal pembelian hanya diperbolehkan 10 porsi per akun" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Contoh Kasus: Keranjang Belanja & Booking --}}
            <section id="kasus-cart" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">7. Contoh Kasus Riil (E-Commerce & Reservasi)</h2>
                    <p class="text-sm text-muted-foreground">
                        Penerapan komponen pada item keranjang belanja makanan dan pemilihan jumlah tamu reservasi:
                    </p>
                </div>

                <vibe:preview title="Item Keranjang Makanan & Reservasi">
                    <div class="w-full max-w-md space-y-4">
                        {{-- Food Cart Item with Circular Gap Buttons --}}
                        <div class="p-4 bg-card rounded-xl border border-border flex items-center justify-between gap-4 shadow-2xs">
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-foreground truncate">Iced Caramel Macchiato</h4>
                                <p class="text-xs text-muted-foreground mt-0.5">Ukuran Large • Extra Shot</p>
                                <span class="text-xs font-bold text-primary mt-1 inline-block">Rp 38.000</span>
                            </div>
                            <div class="w-36 shrink-0">
                                <vibe:input.quantity size="sm" layout="gap" class="rounded-full" :value="2" :min="1" :max="10" />
                            </div>
                        </div>

                        {{-- Hotel Guest Stepper with Unit --}}
                        <div class="p-4 bg-card rounded-xl border border-border flex items-center justify-between gap-4 shadow-2xs">
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-foreground truncate">Tamu Dewasa</h4>
                                <p class="text-xs text-muted-foreground mt-0.5">Usia 13 tahun ke atas</p>
                            </div>
                            <div class="w-36 shrink-0">
                                <vibe:input.quantity size="sm" layout="subtle" unit="Org" :value="2" :min="1" :max="8" />
                            </div>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Tabel Props & Spesifikasi --}}
            <section id="daftar-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">8. Daftar Props & Parameter</h2>
                    <p class="text-sm text-muted-foreground">
                        Parameter yang tersedia untuk konfigurasi komponen <code>&lt;vibe:input.quantity&gt;</code>:
                    </p>
                </div>

                <div class="overflow-x-auto border border-border rounded-xl">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-muted/50 border-b border-border text-foreground font-semibold">
                            <tr>
                                <th class="p-3">Prop</th>
                                <th class="p-3">Tipe</th>
                                <th class="p-3">Default</th>
                                <th class="p-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60 text-muted-foreground">
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">name</td>
                                <td class="p-3 font-mono">string</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Nama field form (fallback otomatis ke <code>wire:model</code>)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">value</td>
                                <td class="p-3 font-mono">numeric</td>
                                <td class="p-3 font-mono">1</td>
                                <td class="p-3">Nilai awal kuantitas</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">min</td>
                                <td class="p-3 font-mono">numeric</td>
                                <td class="p-3 font-mono">0</td>
                                <td class="p-3">Batas minimum (tombol <code>-</code> otomatis nonaktif saat mencapai batas)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">max</td>
                                <td class="p-3 font-mono">numeric</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Batas maksimum (tombol <code>+</code> otomatis nonaktif saat mencapai batas)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">step</td>
                                <td class="p-3 font-mono">numeric</td>
                                <td class="p-3 font-mono">1</td>
                                <td class="p-3">Besaran kenaikan/penurunan tiap klik (mendukung desimal seperti <code>0.5</code>)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">size</td>
                                <td class="p-3 font-mono">'xs'|'sm'|'md'|'lg'|'xl'</td>
                                <td class="p-3 font-mono">'md'</td>
                                <td class="p-3">Skala density tinggi (28px, 32px, 36px, 40px, 44px)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">layout</td>
                                <td class="p-3 font-mono">'split'|'gap'|'grouped'|'subtle'|'stacked'</td>
                                <td class="p-3 font-mono">'split'</td>
                                <td class="p-3">
                                    Pilihan susunan tata letak:
                                    <ul class="list-disc list-inside mt-1 space-y-0.5 text-[11px]">
                                        <li><code>split</code>: Tombol terhubung di kiri & kanan (bawaan)</li>
                                        <li><code>gap</code> / <code>separated</code>: Tombol terpisah dari input dengan jarak spasi</li>
                                        <li><code>subtle</code> / <code>minimal</code>: Tombol mengambang di container latar lembut</li>
                                        <li><code>grouped</code>: Kapsul segmented dengan garis pemisah rapat</li>
                                        <li><code>stacked</code>: Tombol panah atas-bawah bertumpuk di kanan</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">unit</td>
                                <td class="p-3 font-mono">string</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Teks satuan di samping angka (misal: <code>"pcs"</code>, <code>"kg"</code>, <code>"Org"</code>)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">longPress</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">true</td>
                                <td class="p-3">Aktifkan continuous stepping saat tombol ditahan</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">disabled</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Menonaktifkan seluruh kontrol komponen</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">readonly</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Hanya menampilkan nilai tanpa bisa diubah</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20 space-y-4">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
