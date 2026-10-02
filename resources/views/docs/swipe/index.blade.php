<x-docs.layouts.sidebar>
    <vibe:seo
        title="Swipe Button - Dokumentasi Vibe UI"
        description="Komponen Slide-to-Action / Swipe Button interaktif yang mengirim event tombol lengkap seperti button click, form submit, Livewire action, dan custom Alpine events."
        schema="techarticle"
        :breadcrumbs="[
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Docs', 'url' => '/docs'],
            ['name' => 'Components', 'url' => '/docs'],
            ['name' => 'Swipe Button', 'url' => '/docs/swipe']
        ]"
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" size="sm" class="rounded-full">Baru</vibe:badge>
                    <span class="text-xs text-muted-foreground">Actions & Buttons</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Swipe Button (<span class="font-mono text-primary">&lt;vibe:swipe&gt;</span>)</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen <em>Slide-to-Action</em> yang mengharuskan pengguna menggeser tuas hingga batas untuk mencegah ketidaksengajaan. Mendukung pengiriman event tombol native secara penuh seperti <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono">@click</code>, <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono">type="submit"</code>, <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono">wire:click</code>, serta event kustom Alpine.js.
                </p>

                {{-- Quick Props Strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['primary', 'success', 'destructive', 'warning', 'info', 'secondary'] as $v)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $v }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['xs', 'sm', 'md', 'lg', 'xl'] as $s)
                        <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">{{ $s }}</vibe:badge>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">@click</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">type="submit"</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">wire:click</vibe:badge>
                    <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">autoReset</vibe:badge>
                </div>
            </div>

            {{-- 1. Penggunaan Dasar --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Penggunaan Dasar</h2>
                    <p class="text-sm text-muted-foreground">
                        Geser tuas handle dari kiri ke kanan. Begitu tuas mencapai ambang batas (default 88%), aksi akan terpicu secara otomatis dengan haptic feedback dan mengunci posisi sukses.
                    </p>
                </div>

                <vibe:preview title="Dasar Swipe Button">
                    <vibe:preview.code>
<\vibe:swipe
    label="Geser untuk konfirmasi"
    confirmedLabel="Berhasil Dikonfirmasi!"
    :autoReset="2500"
    @confirmed="alert('Aksi swipe berhasil dieksekusi!')"
/>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">Konfirmasi Pesanan</h4>
                                <p class="text-xs text-muted-foreground">Geser tombol di bawah untuk memproses</p>
                            </div>
                            <vibe:badge variant="primary" size="xs">Siap</vibe:badge>
                        </div>
                        <vibe:swipe
                            id="demo-basic"
                            label="Geser untuk konfirmasi"
                            confirmedLabel="Berhasil Dikonfirmasi!"
                            :autoReset="2500"
                            @confirmed="window.$wire ? null : alert('Aksi swipe berhasil dieksekusi!')"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Mengirim Event Click & Method Button --}}
            <section id="event-click" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Interoperabilitas Event Click</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen memiliki tombol tersembunyi yang otomatis memicu event <code class="font-mono text-xs">@click</code> atau <code class="font-mono text-xs">onclick</code> native saat swipe selesai. Kode backend Anda dapat memperlakukannya persis seperti tombol biasa.
                    </p>
                </div>

                <vibe:preview title="Simulasi Button Click">
                    <vibe:preview.code>
<div x-data="{ clickCount: 0 }" class="space-y-3">
    <\vibe:swipe
        label="Geser untuk menambah hitungan"
        confirmedLabel="Tersimpan!"
        :autoReset="1500"
        @click="clickCount++"
    />
    <p class="text-sm">Total Klik: <span x-text="clickCount" class="font-bold"></span></p>
</div>
                    </vibe:preview.code>

                    <div x-data="{ clickCount: 0 }" class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">Counter Handler Native</h4>
                                <p class="text-xs text-muted-foreground">Memicu event native @click secara otomatis</p>
                            </div>
                            <span class="font-mono text-xs px-2.5 py-1 rounded-full bg-primary/10 text-primary font-bold" x-text="clickCount + ' kali diklik'"></span>
                        </div>
                        <vibe:swipe
                            id="demo-click"
                            label="Geser untuk menambah hitungan"
                            confirmedLabel="Event @click Dipicu!"
                            :autoReset="1500"
                            @click="clickCount++"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Form Submission (type="submit") --}}
            <section id="form-submit" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Pengiriman Formulir (Form Submit)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code class="font-mono text-xs">type="submit"</code> dan berikan atribut <code class="font-mono text-xs">name</code>. Komponen akan otomatis menyertakan input tersembunyi dan memanggil <code class="font-mono text-xs">form.requestSubmit()</code> untuk mengecek validasi HTML5 sebelum form dikirim.
                    </p>
                </div>

                <vibe:preview title="Slide to Submit Formulir">
                    <vibe:preview.code>
<form @submit.prevent="alert('Form berhasil di-submit!')">
    <\vibe:input
        label="Nomor Rekening Tujuan"
        value="8219-3910-2910"
        required
    />
    <div class="mt-4">
        <\vibe:swipe
            type="submit"
            name="confirmed_payment"
            value="verified"
            variant="success"
            label="Geser untuk Membayar"
            confirmedLabel="Pembayaran Terkirim!"
            :autoReset="2500"
        />
    </div>
</form>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs">
                        <div class="pb-4 mb-4 border-b border-border/60 flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">Pembayaran Checkout</h4>
                                <p class="text-xs text-muted-foreground">Validasi otomatis & form.requestSubmit()</p>
                            </div>
                            <span class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full">Rp 250.000</span>
                        </div>
                        <form @submit.prevent="alert('Formulir berhasil dikirim dengan data swipe!')" class="space-y-4">
                            <vibe:input
                                label="Nomor Rekening Tujuan"
                                placeholder="Contoh: 8219-3910-2910"
                                value="8219-3910-2910"
                                required
                            />
                            <vibe:swipe
                                id="demo-form-submit"
                                type="submit"
                                name="confirmed_payment"
                                value="verified"
                                variant="success"
                                label="Geser untuk Membayar"
                                confirmedLabel="Pembayaran Terkirim!"
                                :autoReset="2500"
                            />
                        </form>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Skala Kepadatan Ukuran (5-Tier Ergonomic Scale) --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Skala Ukuran (5-Tier Ergonomic Scale)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tersedia dalam 5 skala ergonomis yang dirancang khusus untuk kenyamanan interaksi sentuhan dan gestur swipe:
                        <code class="font-mono text-xs">xs (32px)</code>,
                        <code class="font-mono text-xs">sm (36px)</code>,
                        <code class="font-mono text-xs">md (44px - default)</code>,
                        <code class="font-mono text-xs">lg (48px)</code>, dan
                        <code class="font-mono text-xs">xl (56px)</code>.
                    </p>
                </div>

                <vibe:preview title="Variasi Ukuran Tinggi">
                    <vibe:preview.code>
{{-- Extra Small: 32px --}}
<\vibe:swipe size="xs" label="Extra Small (xs - 32px)" />

{{-- Small: 36px --}}
<\vibe:swipe size="sm" label="Small (sm - 36px)" />

{{-- Medium: 44px (default touch-friendly) --}}
<\vibe:swipe size="md" label="Medium (md - 44px)" />

{{-- Large: 48px --}}
<\vibe:swipe size="lg" label="Large (lg - 48px)" />

{{-- Extra Large: 56px (Hero / Checkout) --}}
<\vibe:swipe size="xl" label="Extra Large (xl - 56px)" />
                    </vibe:preview.code>

                    <div class="w-full max-w-lg mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-5">
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-medium text-foreground">size="xs" (32px / h-8)</span>
                                <span class="text-[11px] text-muted-foreground">Modal / Compact Action</span>
                            </div>
                            <vibe:swipe id="sz-xs" size="xs" label="Geser untuk konfirmasi (XS)" :autoReset="1500" />
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-medium text-foreground">size="sm" (36px / h-9)</span>
                                <span class="text-[11px] text-muted-foreground">Dense Form / Toolbar</span>
                            </div>
                            <vibe:swipe id="sz-sm" size="sm" label="Geser untuk konfirmasi (SM)" :autoReset="1500" />
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-medium text-foreground">size="md" (44px / h-11 - default)</span>
                                <span class="text-[11px] text-primary font-semibold">Standar Ergonomis Mobile</span>
                            </div>
                            <vibe:swipe id="sz-md" size="md" label="Geser untuk konfirmasi (MD)" :autoReset="1500" />
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-medium text-foreground">size="lg" (48px / h-12)</span>
                                <span class="text-[11px] text-muted-foreground">Prominent Checkout Button</span>
                            </div>
                            <vibe:swipe id="sz-lg" size="lg" label="Geser untuk konfirmasi (LG)" :autoReset="1500" />
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-medium text-foreground">size="xl" (56px / h-14)</span>
                                <span class="text-[11px] text-muted-foreground">Hero / High-Impact Slider</span>
                            </div>
                            <vibe:swipe id="sz-xl" size="xl" label="Geser untuk konfirmasi (XL)" :autoReset="1500" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Bentuk Sudut (Standard vs Pill) --}}
            <section id="gaya-sudut" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Bentuk Sudut (Standard vs Pill)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara default, Swipe Button mengikuti desain sistem tombol Vibe UI dengan sudut membulat standar (<code class="font-mono text-xs">rounded-lg</code> untuk md/lg, <code class="font-mono text-xs">rounded-md</code> untuk sm/xs, <code class="font-mono text-xs">rounded-xl</code> untuk xl). Jika menginginkan gaya kapsul/pill penuh, tambahkan class utility Tailwind <code class="font-mono text-xs">class="rounded-full"</code>.
                    </p>
                </div>

                <vibe:preview title="Standard Rounded vs Pill (rounded-full)">
                    <vibe:preview.code>
{{-- Standard Rounded (Default: rounded-lg selaras dengan tombol Vibe UI) --}}
<\vibe:swipe
    label="Standar Rounded (Default)"
    :autoReset="2000"
/>

{{-- Pill Shape (Membulat penuh dengan utility class) --}}
<\vibe:swipe
    class="rounded-full"
    variant="success"
    label="Pill Style (class='rounded-full')"
    :autoReset="2000"
/>
                    </vibe:preview.code>

                    <div class="w-full max-w-lg mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-5">
                        <div class="space-y-1.5">
                            <span class="text-xs font-semibold text-foreground">Standard Rounded (Default - Selaras dengan Button & Input)</span>
                            <vibe:swipe id="shape-default" label="Geser untuk konfirmasi (Standard)" :autoReset="2000" />
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-xs font-semibold text-foreground">Pill Style (<code class="font-mono text-primary font-normal">class="rounded-full"</code>)</span>
                            <vibe:swipe id="shape-pill" class="rounded-full" variant="success" label="Geser untuk konfirmasi (Pill)" :autoReset="2000" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Varian Warna Semantik --}}
            <section id="varian-warna" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Varian Warna Semantik</h2>
                    <p class="text-sm text-muted-foreground">
                        Pilihan tema warna kontekstual untuk berbagai skenario seperti transaksi pembayaran (<code class="font-mono text-xs">success</code>), konfirmasi hapus data (<code class="font-mono text-xs">destructive</code>), atau status umum.
                    </p>
                </div>

                <vibe:preview title="Pilihan Varian Warna">
                    <vibe:preview.code>
{{-- Primary --}}
<\vibe:swipe variant="primary" label="Geser untuk Melanjutkan" />

{{-- Success: Cocok untuk Slide-to-Pay / Selesaikan Pesanan --}}
<\vibe:swipe variant="success" label="Geser untuk Membayar" />

{{-- Destructive: Cocok untuk Slide-to-Delete / Aksi Kritis --}}
<\vibe:swipe variant="destructive" label="Geser untuk Menghapus Akun" confirmedLabel="Akun Dihapus" />

{{-- Warning --}}
<\vibe:swipe variant="warning" label="Geser untuk Batalkan Pesanan" />

{{-- Info --}}
<\vibe:swipe variant="info" label="Geser untuk Sinkronisasi" />

{{-- Secondary --}}
<\vibe:swipe variant="secondary" label="Geser untuk Simpan ke Arsip" />
                    </vibe:preview.code>

                    <div class="w-full max-w-lg mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-muted-foreground">Primary (Default)</span>
                            <vibe:swipe id="var-primary" variant="primary" label="Geser untuk Melanjutkan" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400">Success (Pembayaran / Konfirmasi Aman)</span>
                            <vibe:swipe id="var-success" variant="success" label="Geser untuk Membayar" confirmedLabel="Pembayaran Berhasil!" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-rose-600 dark:text-rose-400">Destructive (Hapus Akun / Tindakan Kritis)</span>
                            <vibe:swipe id="var-danger" variant="destructive" label="Geser untuk Menghapus Data" confirmedLabel="Data Berhasil Dihapus!" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-amber-600 dark:text-amber-400">Warning (Peringatan Penting)</span>
                            <vibe:swipe id="var-warning" variant="warning" label="Geser untuk Batalkan Pesanan" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-sky-600 dark:text-sky-400">Info (Sinkronisasi / Unduh Berkas)</span>
                            <vibe:swipe id="var-info" variant="info" label="Geser untuk Sinkronisasi Cloud" :autoReset="2000" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs font-medium text-muted-foreground">Secondary (Arsip / Simpan Draf)</span>
                            <vibe:swipe id="var-secondary" variant="secondary" label="Geser untuk Simpan ke Arsip" :autoReset="2000" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Integrasi Livewire & Loading State --}}
            <section id="livewire-dan-loading" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Integrasi Livewire & Loading State</h2>
                    <p class="text-sm text-muted-foreground">
                        Dapat disambungkan langsung dengan method Livewire menggunakan <code class="font-mono text-xs">wire:click</code>. Tuas handle otomatis menampilkan spinner animasi selama request jaringan berlangsung.
                    </p>
                </div>

                <vibe:preview title="Async Loading & Livewire">
                    <vibe:preview.code>
{{-- Livewire wire:click langsung --}}
<\vibe:swipe
    wire:click="processCheckout"
    wire:target="processCheckout"
    label="Geser untuk Checkout"
    loadingLabel="Memproses transaksi..."
    confirmedLabel="Transaksi Sukses!"
/>

{{-- Pengendalian manual prop ::loading --}}
<\vibe:swipe
    ::loading="isProcessing"
    label="Geser untuk Verifikasi"
/>
                    </vibe:preview.code>

                    <div x-data="{ isProcessing: false, resultText: 'Menunggu konfirmasi swipe...' }" class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">Simulasi Async Worker</h4>
                                <p class="text-xs text-muted-foreground">Spinner aktif saat memproses request</p>
                            </div>
                            <span class="text-xs font-mono text-muted-foreground" x-text="isProcessing ? 'Memproses...' : 'Idle'"></span>
                        </div>
                        <vibe:swipe
                            id="demo-async-swipe"
                            ::loading="isProcessing"
                            label="Geser untuk Kirim Pesanan"
                            confirmedLabel="Pesanan Selesai!"
                            @confirmed="
                                isProcessing = true;
                                resultText = 'Sedang memproses pesanan ke server...';
                                setTimeout(() => {
                                    isProcessing = false;
                                    resultText = 'Server merespon: Pesanan #8921 berhasil diproses!';
                                }, 2000);
                            "
                        />
                        <div class="flex items-center justify-between text-xs text-muted-foreground px-1">
                            <span>Status Server:</span>
                            <span class="font-medium text-foreground" x-text="resultText"></span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Reset Otomatis & Kontrol Reset Eksternal --}}
            <section id="kontrol-reset" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Reset Otomatis & Eksternal</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code class="font-mono text-xs">:autoReset="true"</code> (2000ms) atau tentukan durasi dalam milidetik (misal <code class="font-mono text-xs">:autoReset="1500"</code>). Anda juga dapat mereset tombol swipe dari komponen luar menggunakan event <code class="font-mono text-xs">$dispatch('reset-swipe', id)</code>.
                    </p>
                </div>

                <vibe:preview title="Reset Eksternal via Alpine Event">
                    <vibe:preview.code>
<div class="space-y-3">
    <\vibe:swipe
        id="swipe-custom-reset"
        label="Geser tuas ini"
        confirmedLabel="Terkonfirmasi!"
    />

    {{-- Tombol Reset Eksternal --}}
    <\vibe:button
        size="sm"
        variant="outline"
        @click="$dispatch('reset-swipe', 'swipe-custom-reset')"
    >
        Reset Posisi Tuas
    </\vibe:button>
</div>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-border/60">
                            <div>
                                <h4 class="text-sm font-semibold text-foreground">Reset Eksternal</h4>
                                <p class="text-xs text-muted-foreground">Trigger reset posisi dari tombol luar</p>
                            </div>
                            <vibe:button
                                size="xs"
                                variant="outline"
                                @click="$dispatch('reset-swipe', 'swipe-custom-reset')"
                            >
                                Reset Posisi Tuas
                            </vibe:button>
                        </div>
                        <vibe:swipe
                            id="swipe-custom-reset"
                            label="Geser tuas ini"
                            confirmedLabel="Terkonfirmasi!"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Status Disabled & Readonly --}}
            <section id="status-disabled" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Status Disabled</h2>
                    <p class="text-sm text-muted-foreground">
                        Mencegah pengguna menggeser tuas saat kondisi formulir belum valid atau otorisasi belum terpenuhi.
                    </p>
                </div>

                <vibe:preview title="Disabled Swipe Button">
                    <vibe:preview.code>
<\vibe:swipe
    disabled
    label="Geser untuk konfirmasi (Nonaktif)"
/>
                    </vibe:preview.code>

                    <div class="w-full max-w-md mx-auto p-6 rounded-2xl bg-card border border-border shadow-xs">
                        <vibe:swipe
                            id="demo-disabled"
                            disabled
                            label="Geser untuk konfirmasi (Nonaktif)"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 9. Referensi Props & Events --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Referensi Props & Atribut</h2>
                    <p class="text-sm text-muted-foreground">Daftar lengkap konfigurasi prop komponen <code class="font-mono text-xs">&lt;vibe:swipe&gt;</code>.</p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-border bg-muted/40 text-muted-foreground font-semibold">
                                <th class="p-3">Prop</th>
                                <th class="p-3">Tipe Data</th>
                                <th class="p-3">Bawaan</th>
                                <th class="p-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60">
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">type</td>
                                <td class="p-3 font-mono">'button'|'submit'</td>
                                <td class="p-3 font-mono">'button'</td>
                                <td class="p-3">Tipe tombol aksi. Saat 'submit', otomatis memanggil <code>form.requestSubmit()</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">size</td>
                                <td class="p-3 font-mono">'xs'|'sm'|'md'|'lg'|'xl'</td>
                                <td class="p-3 font-mono">'md'</td>
                                <td class="p-3">Skala tinggi dan ukuran tuas (32px, 36px, 44px, 48px, 56px)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">variant</td>
                                <td class="p-3 font-mono">'primary'|'success'|'destructive'|'warning'|'info'|'secondary'</td>
                                <td class="p-3 font-mono">'primary'</td>
                                <td class="p-3">Tema warna visual track, fill, dan tuas handle</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">name</td>
                                <td class="p-3 font-mono">string|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Nama field hidden input saat swipe terkonfirmasi di form</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">value</td>
                                <td class="p-3 font-mono">string|numeric</td>
                                <td class="p-3 font-mono">'1'</td>
                                <td class="p-3">Nilai value yang dikirimkan saat swipe terkonfirmasi</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">label</td>
                                <td class="p-3 font-mono">string</td>
                                <td class="p-3 font-mono">'Geser untuk konfirmasi'</td>
                                <td class="p-3">Teks panduan pada lintasan track</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">confirmedLabel</td>
                                <td class="p-3 font-mono">string</td>
                                <td class="p-3 font-mono">'Terkonfirmasi'</td>
                                <td class="p-3">Teks yang ditampilkan setelah tuas mencapai 100%</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">threshold</td>
                                <td class="p-3 font-mono">float (0.5 - 1.0)</td>
                                <td class="p-3 font-mono">0.88</td>
                                <td class="p-3">Persentase batas geser untuk memicu aksi sukses (default 88%)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">autoReset</td>
                                <td class="p-3 font-mono">bool|int</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Reset otomatis tuas ke awal (true = 2000ms, atau tentukan milidetik)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">loading</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Menampilkan status loading spinner pada tuas</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">haptic</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">true</td>
                                <td class="p-3">Memberikan getaran haptic feedback pada smartphone modern</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">disabled</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Menonaktifkan interaksi swipe dan klik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">Event DOM & Alpine.js:</h3>
                    <ul class="list-disc list-inside text-xs text-muted-foreground space-y-1">
                        <li><code class="font-mono text-primary font-semibold">@click</code> / <code class="font-mono text-primary font-semibold">wire:click</code>: Dipicu secara native saat handle mencapai 100%.</li>
                        <li><code class="font-mono text-primary font-semibold">@confirmed</code> / <code class="font-mono text-primary font-semibold">@swiped</code>: Dipancarkan dengan detail <code class="font-mono">{ id, value }</code>.</li>
                        <li><code class="font-mono text-primary font-semibold">@swipe-start</code>: Dipancarkan saat pengguna mulai menyentuh/menggeser tuas.</li>
                        <li><code class="font-mono text-primary font-semibold">@swiping</code>: Dipancarkan secara kontinu saat bergeser memuat <code class="font-mono">{ progress, currentX, maxX }</code>.</li>
                        <li><code class="font-mono text-primary font-semibold">@reset</code>: Dipancarkan saat posisi tuas kembali ke awal.</li>
                        <li><code class="font-mono text-primary font-semibold">$dispatch('reset-swipe', id)</code>: Event global window untuk mereset swipe secara eksternal.</li>
                    </ul>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20 space-y-4">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
