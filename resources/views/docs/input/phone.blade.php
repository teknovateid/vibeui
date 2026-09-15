<x-docs.layouts.sidebar>
    <vibe:seo title="Input Phone Component — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.phone untuk format dan masking nomor handphone otomatis di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input Phone', 'url' => route('docs.input.phone')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.phone</vibe:badge>
                    <span class="text-xs text-muted-foreground">Auto Masking & Country Flag</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input Phone</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input nomor telepon dan handphone dengan pemformatan otomatis sesuai pola masking. Menolak huruf secara otomatis, mendukung kode negara dengan ikon bendera, serta kompatibel dengan <code>vibe:form</code> dan <code>wire:model</code>.
                </p>
            </div>

            {{-- 1. Format Handphone Indonesia (+62) --}}
            <section id="format-indonesia" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Nomor Handphone Indonesia (+62)</h2>
                    <p class="text-sm text-muted-foreground">
                        Secara default menggunakan pola <code>+62 8##-####-####</code> dan menampilkan bendera merah putih Indonesia:
                    </p>
                </div>

                <vibe:preview title="Nomor WhatsApp / Handphone Indonesia">
                    <vibe:preview.code>
<\vibe:input.phone 
    label="Nomor WhatsApp Aktif" 
    name="whatsapp" 
    placeholder="+62 812-3456-7890" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.phone 
                            label="Nomor WhatsApp Aktif" 
                            name="whatsapp" 
                            placeholder="+62 812-3456-7890" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Format Telepon Kantor / Rumah --}}
            <section id="format-kantor" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Format Telepon Kantor (Area Code)</h2>
                    <p class="text-sm text-muted-foreground">
                        Sesuaikan atribut <code>mask</code> untuk nomor telepon kabel atau format lain:
                    </p>
                </div>

                <vibe:preview title="Format Nomor Kantor (021)">
                    <vibe:preview.code>
<\vibe:input.phone 
    label="Telepon Kantor" 
    country="custom"
    mask="(021) ###-####" 
    placeholder="(021) 555-1234" 
    name="office_phone" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.phone 
                            label="Telepon Kantor" 
                            country="custom"
                            mask="(021) ###-####" 
                            placeholder="(021) 555-1234" 
                            name="office_phone" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Kompatibilitas dengan vibe:form --}}
            <section id="dukungan-form" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Penggunaan Bersama vibe:form</h2>
                    <p class="text-sm text-muted-foreground">
                        Dapat langsung dimasukkan ke dalam form AJAX dengan fitur penyimpanan draft sesi:
                    </p>
                </div>

                <vibe:highlightjs language="blade">
<\vibe:form id="customer-form" action="/customers" method="POST" save-to-storage>
    @@csrf

    <\vibe:input.phone 
        name="phone_number" 
        label="Nomor Telepon Kontak" 
        placeholder="+62 812-3456-7890" 
        required 
    />

    <\vibe:button type="submit">Simpan Kontak</\vibe:button>
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
