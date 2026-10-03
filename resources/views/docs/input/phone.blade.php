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

            {{-- 3. Output Nilai Bersih (Clean Digits) --}}
            <section id="clean-value" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Nilai Bersih (Clean Digits) untuk Database & Livewire</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan atribut <code>clean</code> agar input yang dikirimkan via form POST atau diterima oleh Livewire (<code>wire:model</code>) berupa digit angka bersih tanpa karakter pemisah seperti <code>+</code>, <code>-</code>, atau spasi:
                    </p>
                </div>

                <vibe:preview title="Clean Digits (International 628xx)">
                    <vibe:preview.code>
<\vibe:input.phone 
    label="Nomor WhatsApp" 
    name="phone_clean" 
    clean 
    value="081234567890" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3" x-data="{ postedVal: '6281234567890' }">
                        <div @phone-change="postedVal = $event.detail">
                            <vibe:input.phone 
                                label="Nomor WhatsApp (Clean)" 
                                name="phone_clean" 
                                clean 
                                value="081234567890" 
                            />
                        </div>
                        <div class="p-2.5 rounded-lg bg-muted/50 border border-border text-xs flex items-center justify-between">
                            <span class="text-muted-foreground font-mono">Value dipost/Livewire:</span>
                            <span class="font-mono font-bold text-primary" x-text="postedVal || '(kosong)'"></span>
                        </div>
                    </div>
                </vibe:preview>

                <div class="space-y-2 mt-4">
                    <h3 class="text-sm font-semibold text-foreground">Opsi Format Lokal (08xx)</h3>
                    <p class="text-xs text-muted-foreground">
                        Jika ingin menyimpan format awalan lokal (<code>08xx</code>) alih-alih kode negara internasional (<code>628xx</code>), gunakan <code>clean="local"</code> atau <code>:clean-prefix="false"</code>:
                    </p>
                </div>

                <vibe:preview title="Clean Local Format (08xx)">
                    <vibe:preview.code>
<\vibe:input.phone 
    label="Nomor Handphone Lokal" 
    name="phone_local" 
    clean="local" 
    value="081234567890" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3" x-data="{ postedLocal: '081234567890' }">
                        <div @phone-change="postedLocal = $event.detail">
                            <vibe:input.phone 
                                label="Nomor Handphone Lokal" 
                                name="phone_local" 
                                clean="local" 
                                value="081234567890" 
                            />
                        </div>
                        <div class="p-2.5 rounded-lg bg-muted/50 border border-border text-xs flex items-center justify-between">
                            <span class="text-muted-foreground font-mono">Value dipost/Livewire:</span>
                            <span class="font-mono font-bold text-primary" x-text="postedLocal || '(kosong)'"></span>
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Penggunaan Bersama Livewire --}}
            <section id="livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Integrasi dengan Livewire 3</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code>wire:model</code> langsung bersama atribut <code>clean</code>. Komponen akan otomatis menyinkronkan nilai angka murni ke properti PHP komponen:
                    </p>
                </div>

                <vibe:highlightjs language="blade">
{{-- Blade View --}}
<\vibe:input.phone 
    wire:model="phone" 
    clean 
    label="Nomor WhatsApp" 
    placeholder="+62 812-3456-7890" 
/>
                </vibe:highlightjs>

                <vibe:highlightjs language="php">
// Livewire Component PHP
class ContactForm extends Component
{
    public string $phone = ''; // Akan otomatis berisi '6281234567890' saat user mengetik

    public function save()
    {
        // Langsung simpan angka bersih ke database tanpa perlu preg_replace manual
        User::create([
            'phone' => $this->phone,
        ]);
    }
}
                </vibe:highlightjs>
            </section>

            {{-- 5. Kompatibilitas dengan vibe:form --}}
            <section id="dukungan-form" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Penggunaan Bersama vibe:form</h2>
                    <p class="text-sm text-muted-foreground">
                        Dapat langsung dimasukkan ke dalam form AJAX dengan fitur penyimpanan draft sesi:
                    </p>
                </div>

                <vibe:highlightjs language="blade">
<\vibe:form id="customer-form" action="/customers" method="POST" save-to-storage>
    @@csrf

    <\vibe:input.phone 
        name="phone_number" 
        clean 
        label="Nomor Telepon Kontak" 
        placeholder="+62 812-3456-7890" 
        required 
    />

    <\vibe:button type="submit">Simpan Kontak</\vibe:button>
</\vibe:form>
                </vibe:highlightjs>
            </section>

        </div>

        {{-- Table of Contents Sidebar --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
