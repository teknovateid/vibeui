<x-docs.layouts.sidebar>
    <vibe:seo title="Input Number & Thousand Separator — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.number dengan format ribuan otomatis, kontrol pengiriman data bersih (raw) vs berformat, suffix unit, dan tombol stepper di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input Number', 'url' => route('docs.input.number')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.number</vibe:badge>
                    <span class="text-xs text-muted-foreground">Thousand Separator & Numeric Formatting</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input Number</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input numerik umum dengan pemisah ribuan otomatis (*thousand separator*) tanpa prefix mata uang. Secara default mengirimkan angka bersih murni (<code>1500000</code>) ke backend, serta dilengkapi opsi <code>keep-format</code> untuk mempertahankan titik dan koma, dukungan satuan <code>suffix</code>, batasan <code>min</code>/<code>max</code>, dan tombol <code>stepper</code>.
                </p>
            </div>

            {{-- 1. Penggunaan Dasar (Format Ribuan Tanpa Prefix) --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Penggunaan Dasar (Format Ribuan)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara bawaan, komponen langsung memformat angka dengan pemisah ribuan titik (<code>.</code>) tanpa prefix mata uang:
                    </p>
                </div>

                <vibe:preview title="Input Angka Ribuan Dasar">
                    <vibe:preview.code>
<\vibe:input.number 
    name="total_visitors" 
    label="Jumlah Pengunjung" 
    value="1250000" 
    placeholder="0" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.number 
                            name="total_visitors" 
                            label="Jumlah Pengunjung" 
                            value="1250000" 
                            placeholder="0" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Kontrol Pengiriman Data: Bersih (Raw) vs Berformat (keep-format) --}}
            <section id="data-posting" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Kontrol Pengiriman Data (Bersih vs Berformat)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara default (<code>raw=true</code>), data yang dikirimkan ke controller/database saat form di-submit adalah <strong>angka numerik murni tanpa titik maupun koma</strong> (misal <code>1500000</code>). Pasang prop <code>keep-format</code> (atau <code>:raw="false"</code>) jika Anda ingin mengirim string berformat lengkap dengan pemisahnya (misal <code>1.500.000</code>):
                    </p>
                </div>

                <vibe:preview title="Perbandingan Pengiriman Data Form POST">
                    <vibe:preview.code>
{{-- Default: Nilai POST bersih murni berupa angka integer/float (1500000) --}}
<\vibe:input.number 
    name="stock_clean" 
    label="Stok Barang (Nilai Bersih)" 
    value="1500000" 
/>

{{-- Opsi keep-format: Nilai POST mempertahankan titik dan koma ("1.500.000") --}}
<\vibe:input.number 
    name="stock_formatted" 
    label="Stok Laporan (Nilai Berformat)" 
    value="1500000" 
    keep-format 
/>
                    </vibe:preview.code>
                    <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                            <span class="text-xs font-bold text-foreground">Default: Data Bersih</span>
                            <vibe:input.number 
                                name="stock_clean" 
                                label="Stok Barang" 
                                value="1500000" 
                            />
                            <p class="text-[11px] text-muted-foreground">Nilai terkirim ke server: <code class="text-primary font-bold">1500000</code></p>
                        </div>
                        <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                            <span class="text-xs font-bold text-foreground">keep-format: Data Berformat</span>
                            <vibe:input.number 
                                name="stock_formatted" 
                                label="Stok Laporan" 
                                value="1500000" 
                                keep-format 
                            />
                            <p class="text-[11px] text-muted-foreground">Nilai terkirim ke server: <code class="text-primary font-bold">"1.500.000"</code></p>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Satuan Unit (Suffix) --}}
            <section id="satuan-suffix" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Satuan Unit (Suffix)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan prop <code>suffix</code> untuk menampilkan satuan unit di sisi kanan input seperti <code>kg</code>, <code>pcs</code>, <code>cm</code>, atau <code>%</code>:
                    </p>
                </div>

                <vibe:preview title="Input Angka dengan Satuan Suffix">
                    <vibe:preview.code>
<\vibe:input.number name="weight" label="Berat Barang" suffix="kg" value="25" />
<\vibe:input.number name="quantity" label="Jumlah Unit" suffix="pcs" value="500" />
<\vibe:input.number name="discount" label="Persentase Diskon" suffix="%" value="15" />
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input.number name="weight" label="Berat Barang" suffix="kg" value="25" />
                        <vibe:input.number name="quantity" label="Jumlah Unit" suffix="pcs" value="500" />
                        <vibe:input.number name="discount" label="Persentase Diskon" suffix="%" value="15" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Nilai Desimal & Presisi (Precision) --}}
            <section id="desimal-presisi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Nilai Desimal & Presisi</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan prop <code>precision="2"</code> untuk mendukung angka desimal di belakang koma:
                    </p>
                </div>

                <vibe:preview title="Input Angka Desimal">
                    <vibe:preview.code>
<\vibe:input.number 
    name="metric_volume" 
    label="Volume Cairan" 
    suffix="liter" 
    precision="2" 
    value="1250.75" 
    placeholder="0,00" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.number 
                            name="metric_volume" 
                            label="Volume Cairan" 
                            suffix="liter" 
                            precision="2" 
                            value="1250.75" 
                            placeholder="0,00" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Tombol Stepper Mini (+/-) & Batasan Min/Max --}}
            <section id="stepper-min-max" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Tombol Stepper Mini (+/-) & Batasan Min/Max</h2>
                    <p class="text-sm text-muted-foreground">
                        Aktifkan tombol naik/turun mini di sisi kanan dengan prop <code>stepper</code>, dan batasi rentang angka dengan <code>min</code>, <code>max</code>, <code>step</code>, serta <code>clamp</code>:
                    </p>
                </div>

                <vibe:preview title="Stepper Mini dengan Batasan Min/Max">
                    <vibe:preview.code>
<\vibe:input.number 
    name="box_qty" 
    label="Jumlah Kotak (Min 1, Max 50, Step 5)" 
    stepper 
    min="1" 
    max="50" 
    step="5" 
    value="10" 
    clamp 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.number 
                            name="box_qty" 
                            label="Jumlah Kotak (Min 1, Max 50, Step 5)" 
                            stepper 
                            min="1" 
                            max="50" 
                            step="5" 
                            value="10" 
                            clamp 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Pengujian Form Submit ke Controller ($request->all()) --}}
            <section id="uji-coba-controller" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Pengujian Form Submit ke Controller</h2>
                    <p class="text-sm text-muted-foreground">
                        Kirim data form di bawah ini ke controller untuk membuktikan secara langsung bagaimana nilai <code>$request->all()</code> diterima di sisi server (bersih vs berformat):
                    </p>
                </div>

                <vibe:preview title="Pengujian Form Submit ke Controller">
                    <vibe:preview.code>
<\vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
    @@csrf
    <\vibe:card>
        <\vibe:card.header>
            <h3 class="text-sm sm:text-base font-semibold text-foreground">Pengujian Form Input Number</h3>
            <p class="text-xs text-muted-foreground mt-0.5">Kirim data ke controller dan lihat hasil tangkapan $request->all() di modal.</p>
        </\vibe:card.header>

        <\vibe:card.content class="space-y-4">
            {{-- 1. Default: Data terkirim bersih murni tanpa titik/koma (2500000) --}}
            <\vibe:input.number 
                name="stock_clean" 
                label="Stok Barang (Default: Data Bersih)" 
                value="2500000" 
                suffix="pcs" 
                placeholder="0" 
            />

            {{-- 2. Opsi keep-format: Data terkirim membawa pemisah titik dan koma ("1.500.000,75") --}}
            <\vibe:input.number 
                name="metric_formatted" 
                label="Angka Laporan (keep-format: Membawa Titik & Koma)" 
                value="1500000.75" 
                precision="2" 
                suffix="kg" 
                keep-format 
                placeholder="0,00" 
            />

            {{-- 3. Stepper dengan Batasan Min/Max --}}
            <\vibe:input.number 
                name="order_qty" 
                label="Kuantitas Order (Stepper Min 1, Max 100, Step 5)" 
                value="15" 
                stepper 
                min="1" 
                max="100" 
                step="5" 
                clamp 
            />
        </\vibe:card.content>

        <\vibe:card.footer>
            <\vibe:button class="w-full" type="submit" variant="primary">
                Kirim Form & Uji $request->all()
            </\vibe:button>
        </\vibe:card.footer>
    </\vibe:card>
</\vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">Pengujian Form Input Number</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Kirim data ke controller dan lihat hasil tangkapan $request->all() di modal.</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:input.number 
                                    name="stock_clean" 
                                    label="Stok Barang (Default: Data Bersih)" 
                                    value="2500000" 
                                    suffix="pcs" 
                                    placeholder="0" 
                                />

                                <vibe:input.number 
                                    name="metric_formatted" 
                                    label="Angka Laporan (keep-format: Membawa Titik & Koma)" 
                                    value="1500000.75" 
                                    precision="2" 
                                    suffix="kg" 
                                    keep-format 
                                    placeholder="0,00" 
                                />

                                <vibe:input.number 
                                    name="order_qty" 
                                    label="Kuantitas Order (Stepper Min 1, Max 100, Step 5)" 
                                    value="15" 
                                    stepper 
                                    min="1" 
                                    max="100" 
                                    step="5" 
                                    clamp 
                                />
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

            {{-- 7. Tabel Referensi Props & Atribut --}}
            <section id="props-referensi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">7. Referensi Props & Atribut</h2>
                    <p class="text-sm text-muted-foreground">
                        Daftar lengkap atribut dan prop yang didukung oleh komponen <code>&lt;vibe:input.number&gt;</code>:
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border">
                    <vibe:table>
                        <vibe:table.header>
                            <vibe:table.column>Prop</vibe:table.column>
                            <vibe:table.column>Tipe</vibe:table.column>
                            <vibe:table.column>Default</vibe:table.column>
                            <vibe:table.column>Deskripsi</vibe:table.column>
                        </vibe:table.header>
                        <vibe:table.rows>
                            @php
                                $propsList = [
                                    ['name', 'string', 'null', 'Nama input untuk form submission dan model binding.'],
                                    ['value', 'string|numeric', 'null', 'Nilai awal input numerik.'],
                                    ['raw', 'bool', 'true', 'Jika true, mengirimkan angka numerik bersih tanpa titik/koma ke backend.'],
                                    ['keepFormat', 'bool', 'false', 'Alias untuk raw=false. Jika aktif, mengirimkan string berformat lengkap ke backend.'],
                                    ['prefix', 'string|null', 'null', 'Teks atau simbol awalan di sisi kiri (default null, tanpa Rp).'],
                                    ['suffix', 'string|null', 'null', 'Teks satuan di sisi kanan (misal "kg", "pcs", "%").'],
                                    ['thousandSeparator', 'string', "'.'", 'Karakter pemisah ribuan.'],
                                    ['decimalSeparator', 'string', "','", 'Karakter pemisah desimal.'],
                                    ['precision', 'int', '0', 'Jumlah digit angka di belakang koma (0 = integer).'],
                                    ['integer', 'bool', 'false', 'Paksa nilai bulat tanpa pecahan.'],
                                    ['round', 'bool', 'false', 'Bulatkan nilai ke integer terdekat jika terdapat pecahan.'],
                                    ['allowNegative', 'bool', 'false', 'Izinkan nilai negatif (tanda minus).'],
                                    ['min', 'numeric|null', 'null', 'Batas nilai minimum.'],
                                    ['max', 'numeric|null', 'null', 'Batas nilai maksimum.'],
                                    ['step', 'numeric', '1', 'Besaran nilai pertambahan/pengurangan stepper atau keyboard arrow.'],
                                    ['clamp', 'bool', 'false', 'Otomatis sesuaikan angka ke batas min/max saat blur.'],
                                    ['stepper', 'bool', 'false', 'Tampilkan tombol naik/turun mini di sisi kanan input.'],
                                    ['keyboard', 'bool', 'true', 'Dukung penekanan tombol panah atas/bawah pada keyboard.'],
                                    ['size', "'xs'|'sm'|'md'|'lg'|'xl'", "'md'", 'Skala ukuran tinggi dan teks input.'],
                                    ['variant', "'primary'|'outline'|'filled'|'flush'|'ghost'", "'primary'", 'Variasi gaya visual border dan latar.'],
                                    ['disabled', 'bool', 'false', 'Menonaktifkan interaksi input.'],
                                    ['readonly', 'bool', 'false', 'Input hanya dapat dibaca.'],
                                ];
                            @endphp
                            @foreach ($propsList as [$prop, $type, $default, $desc])
                                <vibe:table.row>
                                    <vibe:table.cell class="font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</vibe:table.cell>
                                    <vibe:table.cell class="font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</vibe:table.cell>
                                    <vibe:table.cell class="text-muted-foreground text-xs leading-relaxed">{{ $desc }}</vibe:table.cell>
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

    {{-- Reusable Modal Pengujian $request->all() --}}
    @include('docs.partials.form-test-modal')
</x-docs.layouts.sidebar>
