<x-docs.layouts.sidebar>
    <vibe:seo title="Input Generate Component — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.generate untuk pembuatan kode voucher, referral, SKU, nomor resi, token unik secara instan di frontend maupun validasi/generasi via API backend di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input Generate', 'url' => route('docs.input.generate')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.generate</vibe:badge>
                    <span class="text-xs text-muted-foreground">Frontend Web Crypto + Livewire 3 + REST API</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input Generate</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input spesialis untuk membuat kode unik seperti kupon voucher, kode referral, SKU inventaris, nomor resi, token API, dan UUID v4. Dapat bekerja secara instan tanpa latensi di sisi browser (**Client-Side**) maupun terintegrasi dengan endpoint backend (**REST API**) untuk pembuatan kode server atau validasi keunikan (*uniqueness availability check*).
                </p>

                {{-- Quick feature tags --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">crypto.getRandomValues</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">Async Uniqueness Check</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">Pattern Masking</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">Copy to Clipboard</vibe:badge>
                    <vibe:badge variant="secondary" size="sm" class="font-mono text-[11px]">Livewire 3 Ready</vibe:badge>
                </div>
            </div>

            {{-- 1. Penggunaan Dasar: Client-Side Random Code --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Penggunaan Dasar (Client-Side Random Code)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara default, komponen menggunakan Web Crypto API untuk membuat string acak alfanumerik yang aman secara instan saat pengguna menekan tombol generate di sisi kanan input:
                    </p>
                </div>

                <vibe:preview title="Kode Promo Acak (Voucher/Referral)">
                    <vibe:preview.code>
<\vibe:input.generate 
    label="Kode Referral / Promo" 
    description="Klik ikon panah putar di sebelah kanan untuk membuat kode baru."
    prefix="VIBE-" 
    :length="6" 
    placeholder="Tekan generate untuk mengisi..." 
    copyable 
    name="referral_code" 
/>
                    </vibe:preview.code>
                    <div class="max-w-md space-y-3">
                        <vibe:input.generate 
                            label="Kode Referral / Promo" 
                            description="Klik ikon panah putar di sebelah kanan untuk membuat kode baru."
                            prefix="VIBE-" 
                            :length="6" 
                            placeholder="Tekan generate untuk mengisi..." 
                            copyable 
                            name="referral_code" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Format Pola Kustom (Pattern & Masking) --}}
            <section id="format-pola" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Format Pola Kustom (Pattern Masking)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan prop <code>generator="pattern"</code> dan atribut <code>pattern="..."</code> untuk menentukan susunan kode khusus. Simbol <code>#</code> mewakili angka, <code>*</code> alfanumerik, dan <code>@</code> huruf kapital:
                    </p>
                </div>

                <vibe:preview title="Pola SKU Inventaris & Serial Number">
                    <vibe:preview.code>
{{-- Format SKU: SKU-[4 Angka]-[3 Huruf] --}}
<\vibe:input.generate 
    label="Nomor SKU Produk" 
    generator="pattern" 
    pattern="SKU-####-@@@" 
    placeholder="SKU-0000-XXX" 
    name="sku_number" 
/>

{{-- Serial Number Berkelompok (Chunk 4 pemisah strip) --}}
<\vibe:input.generate 
    label="Serial Aktivasi Lisensi" 
    :length="12" 
    chunk="4" 
    separator="-" 
    placeholder="XXXX-XXXX-XXXX" 
    name="license_key" 
/>
                    </vibe:preview.code>
                    <div class="max-w-md space-y-4">
                        <vibe:input.generate 
                            label="Nomor SKU Produk" 
                            generator="pattern" 
                            pattern="SKU-####-@@@" 
                            placeholder="SKU-0000-XXX" 
                            name="sku_number" 
                        />

                        <vibe:input.generate 
                            label="Serial Aktivasi Lisensi" 
                            :length="12" 
                            chunk="4" 
                            separator="-" 
                            placeholder="XXXX-XXXX-XXXX" 
                            name="license_key" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Generasi UUID v4 --}}
            <section id="generasi-uuid" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Generasi UUID v4</h2>
                    <p class="text-sm text-muted-foreground">
                        Membuat Universally Unique Identifier versi 4 standar (RFC 4122) yang ideal untuk kunci idempotensi, ID transaksi unik, atau secret token:
                    </p>
                </div>

                <vibe:preview title="UUID v4 Idempotency Key">
                    <vibe:preview.code>
<\vibe:input.generate 
    label="Idempotency Request Key" 
    generator="uuid" 
    :uppercase="false" 
    placeholder="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx" 
    copyable 
    name="idempotency_key" 
/>
                    </vibe:preview.code>
                    <div class="max-w-md space-y-3">
                        <vibe:input.generate 
                            label="Idempotency Request Key" 
                            generator="uuid" 
                            :uppercase="false" 
                            placeholder="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx" 
                            copyable 
                            name="idempotency_key" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Pengecekan Keunikan Realtime ke API (Uniqueness Check) --}}
            <section id="pengecekan-api" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Pengecekan Keunikan Real-Time ke API (Availability Check)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan prop <code>check-url="/endpoint"</code> untuk otomatis melakukan verifikasi ketersediaan kode ke backend (baik saat tombol generate ditekan ataupun saat diketik manual dengan debounce):
                    </p>
                </div>

                <vibe:preview title="Verifikasi Ketersediaan Kode Voucher">
                    <vibe:preview.code>
{{-- Coba generate atau ketik 'PROMO-USED' untuk melihat status tidak tersedia --}}
<\vibe:input.generate 
    label="Klaim Kode Voucher Khusus" 
    description="Coba ketik 'PROMO-USED' untuk simulasi kode yang sudah terdaftar."
    prefix="PROMO-" 
    :length="5" 
    check-url="/docs/input/generate/api/check" 
    auto-check 
    copyable 
    name="voucher_check" 
/>
                    </vibe:preview.code>
                    <div class="max-w-md space-y-3">
                        <vibe:input.generate 
                            label="Klaim Kode Voucher Khusus" 
                            description="Coba ketik 'PROMO-USED' untuk simulasi kode yang sudah terdaftar."
                            prefix="PROMO-" 
                            :length="5" 
                            check-url="/docs/input/generate/api/check" 
                            auto-check 
                            copyable 
                            name="voucher_check" 
                        />
                    </div>
                </vibe:preview>
                
                <div class="p-4 rounded-xl border border-border bg-card/60 text-xs space-y-2">
                    <h4 class="font-semibold text-foreground flex items-center gap-1.5">
                        <span class="size-2 rounded-full bg-primary inline-block"></span>
                        Format Response JSON dari Endpoint <code>check-url</code>
                    </h4>
                    <p class="text-muted-foreground leading-relaxed">
                        Endpoint backend Anda cukup mengembalikan JSON dengan key boolean <code>available</code> atau <code>valid</code> beserta opsional <code>message</code>:
                    </p>
                    <vibe:highlightjs language="json">
{
    "available": true,
    "code": "PROMO-7K9W2",
    "message": "Kode 'PROMO-7K9W2' tersedia dan belum terpakai."
}
                    </vibe:highlightjs>
                </div>
            </section>

            {{-- 5. Generasi Kode Langsung dari Server API --}}
            <section id="generasi-api" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Pembuatan Kode Langsung dari Server (API Backend Direct)</h2>
                    <p class="text-sm text-muted-foreground">
                        Jika pembuatan kode memiliki aturan algoritma bisnis yang rumit di backend (misal penghitungan checksum atau sequence nomor faktur), gunakan prop <code>url="/api/endpoint"</code>. Komponen akan mengirim request AJAX dan mengisi input secara otomatis:
                    </p>
                </div>

                <vibe:preview title="Generate Nomor Faktur dari Backend API">
                    <vibe:preview.code>
<\vibe:input.generate 
    label="Nomor Faktur Penjualan" 
    description="Kode didapatkan secara langsung dari response controller backend."
    url="/docs/input/generate/api/code" 
    method="POST" 
    prefix="INV-2026-" 
    :length="8" 
    placeholder="Klik generate untuk mengambil dari server..." 
    copyable 
    name="invoice_number" 
/>
                    </vibe:preview.code>
                    <div class="max-w-md space-y-3">
                        <vibe:input.generate 
                            label="Nomor Faktur Penjualan" 
                            description="Kode didapatkan secara langsung dari response controller backend."
                            url="/docs/input/generate/api/code" 
                            method="POST" 
                            prefix="INV-2026-" 
                            :length="8" 
                            placeholder="Klik generate untuk mengambil dari server..." 
                            copyable 
                            name="invoice_number" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Pilihan Ukuran (Sizes) --}}
            <section id="pilihan-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Pilihan Ukuran (Sizes)</h2>
                    <p class="text-sm text-muted-foreground">
                        Mendukung lima ukuran standar Vibe UI: <code>xs</code>, <code>sm</code>, <code>md</code>, <code>lg</code>, dan <code>xl</code>:
                    </p>
                </div>

                <vibe:preview title="Variasi Ukuran Input Generate">
                    <vibe:preview.code>
<\vibe:input.generate size="xs" prefix="XS-" placeholder="Ukuran XS" />
<\vibe:input.generate size="sm" prefix="SM-" placeholder="Ukuran SM" />
<\vibe:input.generate size="md" prefix="MD-" placeholder="Ukuran MD (Default)" />
<\vibe:input.generate size="lg" prefix="LG-" placeholder="Ukuran LG" />
<\vibe:input.generate size="xl" prefix="XL-" placeholder="Ukuran XL" />
                    </vibe:preview.code>
                    <div class="max-w-md space-y-3">
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="xs"</span>
                            <vibe:input.generate size="xs" prefix="XS-" placeholder="Ukuran XS" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="sm"</span>
                            <vibe:input.generate size="sm" prefix="SM-" placeholder="Ukuran SM" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="md" (Default)</span>
                            <vibe:input.generate size="md" prefix="MD-" placeholder="Ukuran MD" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="lg"</span>
                            <vibe:input.generate size="lg" prefix="LG-" placeholder="Ukuran LG" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="xl"</span>
                            <vibe:input.generate size="xl" prefix="XL-" placeholder="Ukuran XL" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Varian Desain (Variants) --}}
            <section id="varian-desain" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">7. Varian Desain (Variants)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tersedia varian <code>primary</code>, <code>outline</code>, <code>filled</code>, <code>flush</code>, dan <code>ghost</code>:
                    </p>
                </div>

                <vibe:preview title="Variasi Tampilan Tema">
                    <vibe:preview.code>
<\vibe:input.generate variant="primary" prefix="PRM-" placeholder="Primary Variant" />
<\vibe:input.generate variant="outline" prefix="OUT-" placeholder="Outline Variant" />
<\vibe:input.generate variant="filled" prefix="FLD-" placeholder="Filled Variant" />
<\vibe:input.generate variant="flush" prefix="FLS-" placeholder="Flush Variant" />
                    </vibe:preview.code>
                    <div class="max-w-md space-y-3">
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">variant="primary" (Default)</span>
                            <vibe:input.generate variant="primary" prefix="PRM-" placeholder="Primary Variant" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">variant="outline"</span>
                            <vibe:input.generate variant="outline" prefix="OUT-" placeholder="Outline Variant" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">variant="filled"</span>
                            <vibe:input.generate variant="filled" prefix="FLD-" placeholder="Filled Variant" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">variant="flush"</span>
                            <vibe:input.generate variant="flush" prefix="FLS-" placeholder="Flush Variant" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Referensi Properti & Atribut --}}
            <section id="referensi-properti" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">8. Referensi Properti (Props)</h2>
                    <p class="text-sm text-muted-foreground">
                        Daftar lengkap konfigurasi props yang didukung oleh komponen:
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-muted/50 border-b border-border">
                            <tr>
                                <th class="p-3 font-semibold text-foreground">Prop / Atribut</th>
                                <th class="p-3 font-semibold text-foreground">Tipe</th>
                                <th class="p-3 font-semibold text-foreground">Default</th>
                                <th class="p-3 font-semibold text-foreground">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">generator</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">'random'</td>
                                <td class="p-3 text-muted-foreground">Mode generasi sisi frontend: <code>'random'</code>, <code>'pattern'</code>, <code>'uuid'</code>, atau <code>'none'</code>.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">length</td>
                                <td class="p-3 font-mono text-muted-foreground">int</td>
                                <td class="p-3 font-mono text-muted-foreground">8</td>
                                <td class="p-3 text-muted-foreground">Panjang karakter hasil acak pada mode random.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">charset</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">'alphanumeric'</td>
                                <td class="p-3 text-muted-foreground">Pilihan karakter: <code>'alphanumeric'</code>, <code>'numeric'</code>, <code>'alphabetic'</code>, <code>'uppercase'</code>, <code>'hex'</code>, atau string kustom.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">pattern</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">null</td>
                                <td class="p-3 text-muted-foreground">Format pola (mask). Simbol <code>#</code> = angka, <code>*</code> = alfanumerik, <code>@</code> = huruf kapital.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">prefix / suffix</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">null</td>
                                <td class="p-3 text-muted-foreground">Teks awalan dan akhiran tetap yang otomatis ditambahkan ke kode.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">chunk & separator</td>
                                <td class="p-3 font-mono text-muted-foreground">int / string</td>
                                <td class="p-3 font-mono text-muted-foreground">null</td>
                                <td class="p-3 text-muted-foreground">Membagi kode menjadi grup berkala (contoh: <code>chunk="4" separator="-"</code> menghasilkan <code>XXXX-XXXX-XXXX</code>).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">url</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">null</td>
                                <td class="p-3 text-muted-foreground">Endpoint API backend untuk meminta kode (mengirim AJAX saat tombol generate diklik).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">method</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">'POST'</td>
                                <td class="p-3 text-muted-foreground">Metode HTTP saat memanggil <code>url</code> (<code>'POST'</code> atau <code>'GET'</code>).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">checkUrl</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono text-muted-foreground">null</td>
                                <td class="p-3 text-muted-foreground">Endpoint API backend untuk memvalidasi keunikan / ketersediaan kode secara real-time.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">autoCheck</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono text-muted-foreground">true</td>
                                <td class="p-3 text-muted-foreground">Otomatis memvalidasi keunikan ke <code>checkUrl</code> saat kode di-generate atau diketik.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">copyable</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono text-muted-foreground">true</td>
                                <td class="p-3 text-muted-foreground">Menampilkan tombol salin kode ke clipboard dengan indikator feedback centang.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-medium">autoGenerate</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono text-muted-foreground">false</td>
                                <td class="p-3 text-muted-foreground">Otomatis men-generate kode saat pertama kali komponen dirender jika input masih kosong.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
