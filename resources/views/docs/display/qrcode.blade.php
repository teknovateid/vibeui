<x-docs.layouts.sidebar>
    <vibe:seo title="Display QR Code Component — Vibe UI" description="Dokumentasi dan generator interaktif komponen vibe:display.qrcode untuk menghasilkan QR Code vektor (SVG) asli yang 100% dapat dipindai oleh Google Authenticator, Authy, dan kamera smartphone di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Display', 'url' => route('docs.display.qrcode')],
        ['name' => 'QR Code', 'url' => route('docs.display.qrcode')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Display Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:display.qrcode</vibe:badge>
                    <span class="text-xs text-muted-foreground">ISO/IEC 18004 + SVG Vector</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Display QR Code</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen vektor QR Code mandiri berstandar ISO/IEC 18004. Menghasilkan grafik SVG murni yang tajam di semua kerapatan piksel, 100% dapat dipindai (*scannable*) oleh kamera ponsel dan aplikasi autentikator (Google Authenticator, Authy, dll.), tanpa dependensi layanan pihak ketiga.
                </p>
            </div>

            {{-- 1. Interactive QR Playground --}}
            <section id="interactive-playground" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Generator QR Code Interaktif</h2>
                    <p class="text-sm text-muted-foreground">
                        Ketik teks atau URL apa pun di bawah ini untuk melihat matriks QR Code berubah secara instan:
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-border bg-card shadow-xs space-y-6" x-data="{
                    text: 'https://vibeui.teknovate.co.id',
                    qrSize: 180,
                    qrLevel: 'M',
                    withDownload: true,
                    withCopy: true
                }">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                        {{-- Interactive Canvas Preview --}}
                        <div class="md:col-span-5 flex flex-col items-center justify-center p-6 rounded-xl bg-muted/40 border border-border/80 min-h-65">
                            <vibe:display.qrcode 
                                x-bind:value="text"
                                x-bind:size="qrSize"
                                x-bind:level="qrLevel"
                                :downloadable="true"
                                :copyable="true"
                                label="Pindai dengan kamera smartphone"
                            />
                        </div>

                        {{-- Controls Form --}}
                        <div class="md:col-span-7 space-y-4">
                            <div class="space-y-1.5">
                                <label class="text-xs font-semibold text-foreground">Isi Data / URL</label>
                                <vibe:input x-model="text" placeholder="Masukkan URL atau teks..." />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-foreground">Ukuran (px)</label>
                                    <select x-model.number="qrSize" class="w-full h-9 px-3 rounded-lg border border-input bg-background text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20">
                                        <option :value="140">140 px (Kecil)</option>
                                        <option :value="180">180 px (Standar)</option>
                                        <option :value="220">220 px (Besar)</option>
                                    </select>
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-foreground">Tingkat Koreksi Error</label>
                                    <select x-model="qrLevel" class="w-full h-9 px-3 rounded-lg border border-input bg-background text-sm text-foreground focus:outline-none focus:ring-2 focus:ring-primary/20">
                                        <option value="L">L — Rendah (~7%)</option>
                                        <option value="M">M — Sedang (~15%)</option>
                                        <option value="Q">Q — Kuartil (~25%)</option>
                                        <option value="H">H — Tinggi (~30%)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="p-3 rounded-xl bg-muted/50 border border-border text-xs text-muted-foreground">
                                <p class="font-medium text-foreground">💡 Tip Pemindaian:</p>
                                <p class="mt-0.5 leading-relaxed">Level <span class="font-mono text-primary font-semibold">H</span> sangat disarankan jika Anda ingin menempatkan logo/ikon kustom di bagian tengah QR Code.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. Penggunaan Dasar --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Penggunaan Dasar</h2>
                    <p class="text-sm text-muted-foreground">
                        Cukup berikan prop <code>value</code> yang berisi tautan atau string yang ingin di-encode:
                    </p>
                </div>

                <vibe:preview title="QR Code Tautan Website">
                    <vibe:preview.code>
<\vibe:display.qrcode 
    value="https://vibeui.teknovate.co.id" 
    size="180" 
/>
                    </vibe:preview.code>
                    <div class="p-2">
                        <vibe:display.qrcode 
                            value="https://vibeui.teknovate.co.id" 
                            size="180" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Autentikasi Dua Faktor (2FA / TOTP) --}}
            <section id="format-totp-2fa" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Format Two-Factor Authentication (2FA / TOTP)</h2>
                    <p class="text-sm text-muted-foreground">
                        Untuk aplikasi autentikator seperti Google Authenticator, Authy, atau Microsoft Authenticator, gunakan skema URI <code>otpauth://totp/</code>:
                    </p>
                </div>

                <vibe:preview title="Format URI Autentikator 2FA">
                    <vibe:preview.code>
<\vibe:display.qrcode 
    value="otpauth://totp/Vibe%20UI:user@example.com?secret=JBSWY3DPEHPK3PXP&issuer=Vibe%20UI" 
    size="180" 
    level="M"
    label="Pindai dengan Google Authenticator"
/>
                    </vibe:preview.code>
                    <div class="p-2">
                        <vibe:display.qrcode 
                            value="otpauth://totp/Vibe%20UI:user@example.com?secret=JBSWY3DPEHPK3PXP&issuer=Vibe%20UI" 
                            size="180" 
                            level="M"
                            label="Pindai dengan Google Authenticator"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Tombol Unduh & Salin (Actions Toolbar) --}}
            <section id="tombol-aksi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Tombol Aksi (Download & Copy)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan prop <code>downloadable</code> untuk mengizinkan pengguna mengunduh file PNG/SVG, atau <code>copyable</code> untuk menyalin payload ke clipboard:
                    </p>
                </div>

                <vibe:preview title="QR Code dengan Toolbar Ekspor">
                    <vibe:preview.code>
<\vibe:display.qrcode 
    value="https://teknovate.co.id" 
    size="180" 
    label="Teknovate Solusi Digital"
    downloadable 
    copyable 
/>
                    </vibe:preview.code>
                    <div class="p-2">
                        <vibe:display.qrcode 
                            value="https://teknovate.co.id" 
                            size="180" 
                            label="Teknovate Solusi Digital"
                            downloadable 
                            copyable 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Kustomisasi Warna & Margin --}}
            <section id="kustomisasi-warna" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Kustomisasi Warna & Margin</h2>
                    <p class="text-sm text-muted-foreground">
                        Sesuaikan warna modul (<code>color</code>) dan latar belakang (<code>background</code>) agar selaras dengan identitas brand Anda:
                    </p>
                </div>

                <vibe:preview title="Kustomisasi Warna Brand">
                    <vibe:preview.code>
<\vibe:display.qrcode 
    value="https://teknovate.co.id" 
    color="#4f46e5"
    background="#eef2ff"
    size="180" 
    margin="3"
    label="Tema Indigo Brand"
/>
                    </vibe:preview.code>
                    <div class="p-2">
                        <vibe:display.qrcode 
                            value="https://teknovate.co.id" 
                            color="#4f46e5"
                            background="#eef2ff"
                            size="180" 
                            margin="3"
                            label="Tema Indigo Brand"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Tabel Props --}}
            <section id="tabel-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Daftar Props & Konfigurasi</h2>
                    <p class="text-sm text-muted-foreground">
                        Parameter atribut yang tersedia pada komponen <code>&lt;vibe:display.qrcode&gt;</code>:
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-border bg-muted/60 text-muted-foreground font-semibold">
                                <th class="p-3">Prop</th>
                                <th class="p-3">Tipe</th>
                                <th class="p-3">Bawaan</th>
                                <th class="p-3">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-foreground">
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">value</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">''</td>
                                <td class="p-3">Payload teks, tautan URL, atau URI skema yang di-encode ke dalam QR Code.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">size</td>
                                <td class="p-3 font-mono text-muted-foreground">int|string</td>
                                <td class="p-3 font-mono">180</td>
                                <td class="p-3">Dimensi lebar dan tinggi QR Code dalam satuan piksel (px).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">level</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">'M'</td>
                                <td class="p-3">Tingkat toleransi error: <code>'L'</code> (7%), <code>'M'</code> (15%), <code>'Q'</code> (25%), <code>'H'</code> (30%).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">color</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">'#000000'</td>
                                <td class="p-3">Warna modul/blok hitam QR Code (hex atau CSS color).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">background</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">'#ffffff'</td>
                                <td class="p-3">Warna latar belakang QR Code (hex, CSS color, atau 'transparent').</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">margin</td>
                                <td class="p-3 font-mono text-muted-foreground">int</td>
                                <td class="p-3 font-mono">2</td>
                                <td class="p-3">Ketebalan zona tenang (*quiet zone*) di tepi QR Code dalam unit modul.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">downloadable</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Menampilkan tombol unduh file format SVG vektor dan format PNG raster.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">copyable</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Menampilkan tombol salin string payload data ke clipboard.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">label</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Teks keterangan singkat yang ditampilkan di bawah matriks QR Code.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
