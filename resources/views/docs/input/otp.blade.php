<x-docs.layouts.sidebar>
    <vibe:seo title="Input OTP Component — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.otp untuk kode verifikasi 2FA, token SMS, dan PIN keamanan multi-slot di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input OTP', 'url' => route('docs.input.otp')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.otp</vibe:badge>
                    <span class="text-xs text-muted-foreground">Livewire 3 + Alpine.js + vibe:form</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input OTP</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input multi-slot khusus untuk kode verifikasi satu kali (One-Time Password / 2FA) dan PIN transaksi. Dilengkapi fitur otomatisasi fokus digit, navigasi mundur dengan tombol backspace, dukungan paste kode penuh, mode sensor (mask), dan kompatibilitas penuh dengan <code>vibe:form</code> maupun <code>wire:model</code>.
                </p>
            </div>

            {{-- 1. Penggunaan Dasar (6 Digit) --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Penggunaan Dasar (6 Digit OTP)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara default, komponen merender 6 kotak slot digit dengan auto-focus maju dan mundur:
                    </p>
                </div>

                <vibe:preview title="Standar 6 Digit OTP">
                    <vibe:preview.code>
<\vibe:input.otp 
    label="Kode Otentikasi" 
    description="Masukkan 6 digit kode dari aplikasi autentikator Anda." 
    length="6" 
    name="code"
/>
                    </vibe:preview.code>
                    <div class="space-y-3">
                        <vibe:input.otp 
                            label="Kode Otentikasi" 
                            description="Masukkan 6 digit kode dari aplikasi autentikator Anda." 
                            length="6" 
                            name="code"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Mode PIN Transaksi (Masked 4 Digit) --}}
            <section id="mode-pin-mask" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Mode PIN Keamanan (Masking)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan atribut <code>mask</code> untuk menyamarkan angka menjadi bulatan rahasia (seperti PIN ATM / e-wallet):
                    </p>
                </div>

                <vibe:preview title="4 Digit PIN dengan Masking">
                    <vibe:preview.code>
<\vibe:input.otp 
    label="PIN Transaksi Keamanan" 
    description="Karakter disamarkan demi privasi."
    length="4" 
    mask 
    name="pin"
/>
                    </vibe:preview.code>
                    <div class="space-y-3">
                        <vibe:input.otp 
                            label="PIN Transaksi Keamanan" 
                            description="Karakter disamarkan demi privasi."
                            length="4" 
                            mask 
                            name="pin"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Pilihan Ukuran (Sizes) --}}
            <section id="pilihan-ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Pilihan Ukuran Kotak (Sizes)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tersedia 4 pilihan ukuran: <code>sm</code>, <code>md</code> (default), <code>lg</code>, dan <code>xl</code>:
                    </p>
                </div>

                <vibe:preview title="Variasi Ukuran Slot Digit">
                    <vibe:preview.code>
<\vibe:input.otp name="otp_sm" length="4" size="sm" />
<\vibe:input.otp name="otp_md" length="4" size="md" />
<\vibe:input.otp name="otp_lg" length="4" size="lg" />
<\vibe:input.otp name="otp_xl" length="4" size="xl" />
                    </vibe:preview.code>
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="sm" (Kecil)</span>
                            <vibe:input.otp name="otp_sm" length="4" size="sm" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="md" (Standar)</span>
                            <vibe:input.otp name="otp_md" length="4" size="md" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="lg" (Besar)</span>
                            <vibe:input.otp name="otp_lg" length="4" size="lg" />
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-muted-foreground font-mono">size="xl" (Ekstra Besar)</span>
                            <vibe:input.otp name="otp_xl" length="4" size="xl" />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Kompatibilitas dengan vibe:form & Form Tradisional --}}
            <section id="dukungan-form" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Integrasi Form Tradisional, Livewire & vibe:form</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen menyediakan hidden input otomatis yang menggabungkan seluruh digit menjadi satu string utuh:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    {{-- Form HTML Standar --}}
                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <h3 class="font-bold text-foreground">A. Form Tradisional (Controller)</h3>
                        <p class="text-muted-foreground leading-relaxed">
                            Cukup sertakan atribut <code>name="token"</code>. Di controller, ambil nilai dengan <code>$request->token</code> (menghasilkan string utuh misal <code>"829103"</code>).
                        </p>
                        <vibe:highlightjs language="blade">
<form method="POST" action="/verify">
    @@csrf
    <\vibe:input.otp name="token" length="6" />
    <\vibe:button type="submit">Kirim</\vibe:button>
</form>
</vibe:highlightjs>
                    </div>

                    {{-- vibe:form AJAX & Auto-Save --}}
                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <h3 class="font-bold text-foreground">B. Komponen vibe:form</h3>
                        <p class="text-muted-foreground leading-relaxed">
                            Mendukung pengiriman AJAX via <code>FormData</code> dan auto-save ke storage. Saat user kembali, kode otomatis direstorasi ke kotak-kotak slot.
                        </p>
                        <vibe:highlightjs language="blade">
<\vibe:form id="otp-form" action="/verify" save-to-storage>
    @@csrf
    <\vibe:input.otp name="token" length="6" auto-submit />
</\vibe:form>
</vibe:highlightjs>
                    </div>
                </div>
            </section>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
