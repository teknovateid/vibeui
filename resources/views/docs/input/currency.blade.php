<x-docs.layouts.sidebar>
    <vibe:seo title="Input Currency & Thousand Separator — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.currency dengan pemisah ribuan otomatis (thousand separator) dan sinkronisasi nilai numerik bersih di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input Currency', 'url' => route('docs.input.currency')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.currency</vibe:badge>
                    <span class="text-xs text-muted-foreground">Thousand Separator & Numeric Binding</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input Currency (Thousand Separator)</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input mata uang dengan pemisah ribuan otomatis (*thousand separator*). Pengguna mengetik dengan format visual yang rapi (misal <code>Rp 1.500.000</code>), sementara backend menerima angka numerik murni (<code>1500000</code>) tanpa perlu pembersihan manual regex.
                </p>
            </div>

            {{-- 1. Penggunaan Format Rupiah Indonesia --}}
            <section id="format-rupiah" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Format Rupiah Indonesia (Default)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara bawaan, pemisah ribuan menggunakan titik (<code>.</code>) dan prefix mata uang <code>Rp</code>:
                    </p>
                </div>

                <vibe:preview title="Format Rupiah Standar">
                    <vibe:preview.code>
<\vibe:input.currency 
    label="Harga Produk" 
    prefix="Rp" 
    name="price" 
    value="750000"
    placeholder="0"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.currency 
                            label="Harga Produk" 
                            prefix="Rp" 
                            name="price" 
                            value="750000"
                            placeholder="0"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Dukungan Angka Desimal (Precision) --}}
            <section id="format-desimal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Nilai Desimal & Tarif (Precision)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan prop <code>precision="2"</code> dan <code>decimal-separator=","</code> untuk nilai keuangan yang membutuhkan sen:
                    </p>
                </div>

                <vibe:preview title="Format Desimal 2 Digit">
                    <vibe:preview.code>
<\vibe:input.currency 
    name="service_fee"
    label="Tarif Pajak / Biaya Layanan" 
    prefix="Rp" 
    thousand-separator="."
    decimal-separator=","
    precision="2" 
    value="12500.50"
    placeholder="0,00"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.currency 
                            name="service_fee"
                            label="Tarif Pajak / Biaya Layanan" 
                            prefix="Rp" 
                            thousand-separator="."
                            decimal-separator=","
                            precision="2" 
                            value="12500.50"
                            placeholder="0,00"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Format Mata Uang Asing (US Dollar) --}}
            <section id="mata-uang-asing" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Format Mata Uang Asing (USD / Euro)</h2>
                    <p class="text-sm text-muted-foreground">
                        Ganti <code>prefix</code>, <code>thousand-separator=","</code>, dan <code>decimal-separator="."</code> untuk format internasional:
                    </p>
                </div>

                <vibe:preview title="Format US Dollar">
                    <vibe:preview.code>
<\vibe:input.currency 
    name="usd_price"
    label="Monthly Subscription" 
    prefix="$" 
    thousand-separator=","
    decimal-separator="."
    precision="2" 
    placeholder="0.00"
    value="1299.99"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.currency 
                            name="usd_price"
                            label="Monthly Subscription" 
                            prefix="$" 
                            thousand-separator=","
                            decimal-separator="."
                            precision="2" 
                            placeholder="0.00"
                            value="1299.99"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Uji Nilai Murni (Live Proof of Clean Numeric Value) --}}
            <section id="uji-nilai-numerik" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Uji Coba Langsung: Tampilan vs Nilai Terkirim</h2>
                    <p class="text-sm text-muted-foreground">
                        Ketik nominal berapapun di kotak di bawah dan perhatikan bagaimana nilai yang terkirim ke server selalu berupa angka murni:
                    </p>
                </div>

                <div class="p-5 rounded-2xl border border-border bg-card space-y-4 shadow-xs" x-data="{
                    testPrice: '2500000'
                }">
                    <div class="max-w-sm">
                        <vibe:input.currency 
                            label="Ketik Nominal Uji Coba" 
                            prefix="Rp" 
                            name="demo_price" 
                            value="2500000"
                            @input="testPrice = $event.target.value"
                        />
                    </div>

                    <div class="p-3.5 rounded-xl bg-muted/40 border border-border text-xs space-y-1.5 font-mono">
                        <div class="flex items-center justify-between text-muted-foreground">
                            <span>Nilai Terkirim ke Controller / Livewire:</span>
                            <span class="text-primary font-bold text-sm" x-text="testPrice || '0'"></span>
                        </div>
                        <p class="text-[11px] text-muted-foreground font-sans">
                            ✓ Controller Laravel menerima <code>$request->demo_price</code> tanpa huruf <code>Rp</code> atau titik.
                        </p>
                    </div>
                </div>
            </section>

            {{-- 5. Kompatibilitas dengan vibe:form --}}
            <section id="dukungan-vibe-form" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Kompatibilitas Penuh dengan vibe:form</h2>
                    <p class="text-sm text-muted-foreground">
                        Dapat langsung diletakkan di dalam <code>&lt;vibe:form&gt;</code>:
                    </p>
                </div>

                <vibe:highlightjs language="blade">
<\vibe:form id="budget-form" action="/budget" method="POST" save-to-storage>
    @@csrf

    <\vibe:input.currency 
        name="project_budget" 
        label="Anggaran Proyek" 
        prefix="Rp" 
        thousand-separator="." 
        required 
    />

    <\vibe:button type="submit">Simpan Anggaran</\vibe:button>
</\vibe:form>
</vibe:highlightjs>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
