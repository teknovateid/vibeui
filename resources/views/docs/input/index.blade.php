<x-docs.layouts.sidebar>
    <vibe:seo title="Input" description="Komponen input teks fleksibel dengan 5 varian tampilan, 4 ukuran, dukungan ikon, prefix/suffix, state validasi, dan integrasi penuh Livewire wire:model." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => 'Input', 'url' => '/docs/input']
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-muted text-muted-foreground">Komponen</span>
                    <span class="text-xs text-muted-foreground">Form & Input</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input teks yang modern dan fleksibel. Mendukung 5 varian tampilan, 4 ukuran, ikon leading/trailing, prefix/suffix teks, pill style, state error & disabled, serta integrasi penuh dengan Livewire <code class="font-mono text-xs text-foreground font-semibold">wire:model</code>.
                </p>

                {{-- Quick props badge strip --}}
                <div class="flex flex-wrap items-center gap-1.5 pt-1">
                    @foreach (['outline', 'filled', 'flush', 'ghost', 'accent'] as $v)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $v }}</span>
                    @endforeach
                    <span class="text-muted-foreground/40 text-xs">|</span>
                    @foreach (['sm', 'md', 'lg', 'xl'] as $s)
                        <span class="px-2 py-0.5 rounded-md bg-muted text-muted-foreground text-[11px] font-mono font-medium border border-border">{{ $s }}</span>
                    @endforeach
                </div>
            </div>

            
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Penggunaan Dasar</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> untuk membuat input dengan label bawaan. Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> otomatis tersinkron dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code> dan Laravel validation.
                    </p>
                </div>

                @php
                    $basicCode = <<<'HTML'
                    <vibe:input
                        name="full_name"
                        label="Nama Lengkap"
                        placeholder="Masukkan nama lengkap Anda..."
                    />
                    HTML;
                @endphp

                <vibe:preview title="Basic Input" :code="$basicCode">
                    <div class="w-full max-w-sm">
                        <vibe:input name="full_name" label="Nama Lengkap" placeholder="Masukkan nama lengkap Anda..." />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="varian-tampilan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Varian Tampilan</h2>
                    <p class="text-sm text-muted-foreground">
                        Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol gaya visual input. Tersedia 5 pilihan untuk berbagai konteks desain.
                    </p>
                </div>

                @php
                    $variantCode = <<<'HTML'
                    {{-- outline (default) — border klasik --}}
                    <vibe:input variant="outline" label="Outline" placeholder="Varian default..." />

                    {{-- filled — background solid, border transparan --}}
                    <vibe:input variant="filled" label="Filled" placeholder="Tampilan solid..." />

                    {{-- flush — hanya border bawah, minimalis --}}
                    <vibe:input variant="flush" label="Flush" placeholder="Garis bawah saja..." />

                    {{-- ghost — tanpa border, cocok di dalam card --}}
                    <vibe:input variant="ghost" label="Ghost" placeholder="Transparan penuh..." />

                    {{-- accent — menggunakan warna aksen tema --}}
                    <vibe:input variant="accent" label="Accent" placeholder="Warna aksen..." />
                    HTML;
                @endphp

                <vibe:preview title="Varian Input" :code="$variantCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input variant="outline" label="Outline (default)" placeholder="Varian default..." />
                        <vibe:input variant="filled" label="Filled" placeholder="Tampilan solid..." />
                        <vibe:input variant="flush" label="Flush" placeholder="Garis bawah saja..." />
                        <vibe:input variant="ghost" label="Ghost" placeholder="Transparan penuh..." />
                        <vibe:input variant="accent" label="Accent" placeholder="Warna aksen..." />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Ukuran</h2>
                    <p class="text-sm text-muted-foreground">
                        Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">size</code> mengatur tinggi dan ukuran teks input. Default adalah <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>.
                    </p>
                </div>

                @php
                    $sizesCode = <<<'HTML'
                    <vibe:input size="sm" label="Small (sm)"   placeholder="Tinggi 32px, text-xs..." />
                    <vibe:input size="md" label="Medium (md)"  placeholder="Tinggi 36px, text-sm..." />
                    <vibe:input size="lg" label="Large (lg)"   placeholder="Tinggi 40px, text-sm..." />
                    <vibe:input size="xl" label="X-Large (xl)" placeholder="Tinggi 44px, text-base..." />
                    HTML;
                @endphp

                <vibe:preview title="Ukuran Input" :code="$sizesCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input size="sm" label="Small (sm)" placeholder="Tinggi 32px, text-xs..." />
                        <vibe:input size="md" label="Medium (md)" placeholder="Tinggi 36px, text-sm..." />
                        <vibe:input size="lg" label="Large (lg)" placeholder="Tinggi 40px, text-sm..." />
                        <vibe:input size="xl" label="X-Large (xl)" placeholder="Tinggi 44px, text-base..." />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="ikon-dan-addon" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Ikon & Addon</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan ikon di sisi kiri dengan slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon</code>, di kanan dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">trailingIcon</code>. Untuk teks, gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">prefix</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code>.
                    </p>
                </div>

                @php
                    $iconCode = <<<'HTML'
                    {{-- Leading icon (slot) --}}
                    <vibe:input label="Cari" placeholder="Ketik untuk mencari...">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                            </svg>
                        </x-slot:icon>
                    </vibe:input>

                    {{-- Trailing icon (slot) --}}
                    <vibe:input type="email" label="Email" placeholder="nama@email.com">
                        <x-slot:trailingIcon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </x-slot:trailingIcon>
                    </vibe:input>

                    {{-- Prefix teks --}}
                    <vibe:input label="Website" placeholder="namadomain" prefix="https://" suffix=".com" />

                    {{-- Suffix teks --}}
                    <vibe:input label="Harga" type="number" placeholder="0" prefix="Rp" suffix="/bulan" />
                    HTML;
                @endphp

                <vibe:preview title="Input dengan Ikon & Addon" :code="$iconCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input label="Cari" placeholder="Ketik untuk mencari...">
                            <x-slot:icon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </x-slot:icon>
                        </vibe:input>
                        <vibe:input type="email" label="Email" placeholder="nama@email.com">
                            <x-slot:trailingIcon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2" />
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                </svg>
                            </x-slot:trailingIcon>
                        </vibe:input>
                        <vibe:input label="Website" placeholder="namadomain" prefix="https://" suffix=".com" />
                        <vibe:input label="Harga" type="number" placeholder="0" prefix="Rp" suffix="/bulan" />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="pill-style" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Pill Style</h2>
                    <p class="text-sm text-muted-foreground">
                        Prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">pill</code> mengubah sudut input menjadi fully rounded. Cocok untuk komponen search bar atau filter chip.
                    </p>
                </div>

                @php
                    $pillCode = <<<'HTML'
                    <vibe:input pill label="Search" placeholder="Cari sesuatu..." >
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                            </svg>
                        </x-slot:icon>
                    </vibe:input>

                    <vibe:input pill variant="filled" label="Filled Pill" placeholder="Rounded filled..." />
                    <vibe:input pill variant="accent" label="Accent Pill" placeholder="Rounded accent..." />
                    HTML;
                @endphp

                <vibe:preview title="Pill Style" :code="$pillCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input pill label="Search" placeholder="Cari sesuatu...">
                            <x-slot:icon>
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                            </x-slot:icon>
                        </vibe:input>
                        <vibe:input pill variant="filled" label="Filled Pill" placeholder="Rounded filled..." />
                        <vibe:input pill variant="accent" label="Accent Pill" placeholder="Rounded accent..." />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="deskripsi-dan-bantuan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Deskripsi & Teks Bantuan</h2>
                    <p class="text-sm text-muted-foreground">
                        Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> menampilkan teks kecil di bawah label (sebelum input). Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> menampilkan teks panduan di bawah input (hanya jika tidak ada error).
                    </p>
                </div>

                @php
                    $helperCode = <<<'HTML'
                    <vibe:input
                        name="email"
                        type="email"
                        label="Alamat Email"
                        description="Gunakan email aktif yang bisa dihubungi."
                        info="Kami tidak akan pernah membagikan email Anda ke pihak terbaik."
                        placeholder="nama@perusahaan.com"
                    />
                    HTML;
                @endphp

                <vibe:preview title="Input dengan Teks Bantuan" :code="$helperCode">
                    <div class="w-full max-w-sm">
                        <vibe:input name="email" type="email" label="Alamat Email" description="Gunakan email aktif yang bisa dihubungi." info="Kami tidak akan pernah membagikan email Anda ke pihak ketiga." placeholder="nama@perusahaan.com" />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="error-dan-validasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Error & Validasi</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen secara otomatis membaca error dari Laravel <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$errors</code> menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code>. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code> untuk pesan kustom, atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">errorName</code> jika key validasi berbeda dari name.
                    </p>
                </div>

                @php
                    $errorCode = <<<'HTML'
                    {{-- Error dari prop langsung --}}
                    <vibe:input
                        name="password"
                        type="password"
                        label="Kata Sandi"
                        value="12345"
                        error="Kata sandi minimal 8 karakter dan harus mengandung angka."
                    />

                    {{-- Error otomatis dari Laravel $errors (setelah form submit) --}}
                    <vibe:input
                        name="username"
                        label="Username"
                        wire:model="username"
                    />

                    {{-- Error dengan key berbeda (errorName) --}}
                    <vibe:input
                        name="user[phone]"
                        errorName="user.phone"
                        label="Nomor Telepon"
                        error="Format nomor telepon tidak valid."
                    />
                    HTML;
                @endphp

                <vibe:preview title="Input Error State" :code="$errorCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input name="password" type="password" label="Kata Sandi" value="12345" error="Kata sandi minimal 8 karakter dan harus mengandung angka." />
                        <vibe:input name="user_phone" label="Nomor Telepon" error="Format nomor telepon tidak valid." placeholder="+62 812 3456 7890" />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="status-input" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Status: Disabled & Readonly</h2>
                    <p class="text-sm text-muted-foreground">
                        Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> menonaktifkan input sepenuhnya (tidak bisa diklik atau difokus). Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">readonly</code> memungkinkan fokus dan copy, namun nilai tidak bisa diubah.
                    </p>
                </div>

                @php
                    $stateCode = <<<'HTML'
                    {{-- Disabled: tidak bisa diklik --}}
                    <vibe:input
                        label="ID Pengguna (Disabled)"
                        value="USR-994821"
                        disabled
                    />

                    {{-- Readonly: bisa difokus & dicopy, tidak bisa diubah --}}
                    <vibe:input
                        label="Kode Referral (Readonly)"
                        value="VIBE-REF-2025"
                        readonly
                    />
                    HTML;
                @endphp

                <vibe:preview title="Disabled & Readonly" :code="$stateCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input label="ID Pengguna (Disabled)" value="USR-994821" disabled />
                        <vibe:input label="Kode Referral (Readonly)" value="VIBE-REF-2025" readonly />
                    </div>
                </vibe:preview>
            </section>

            
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Integrasi Livewire</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code> seperti biasa. Komponen secara otomatis membaca <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> dari directive tersebut dan menyinkronkan error validasi Laravel.
                    </p>
                </div>

                @php
                    $livewireCode = <<<'HTML'
                    {{-- Di Livewire Component (PHP) --}}
                    class ProfileForm extends Component
                    {
                        #[Validate('required|min:3|max:50')]
                        public string $name = '';

                        #[Validate('required|email')]
                        public string $email = '';

                        public function save()
                        {
                            $this->validate();
                            // simpan data...
                        }
                    }

                    {{-- Di Blade template --}}
                    <form wire:submit="save">
                        <vibe:input
                            wire:model.live="name"
                            label="Nama Lengkap"
                            placeholder="Masukkan nama..."
                        />

                        <vibe:input
                            wire:model="email"
                            type="email"
                            label="Email"
                            placeholder="nama@email.com"
                            info="Digunakan untuk login."
                        />

                        <vibe:button type="submit" variant="primary">
                            Simpan Perubahan
                        </vibe:button>
                    </form>
                    HTML;
                @endphp

                <vibe:preview title="Livewire wire:model" :code="$livewireCode">
                    <div class="w-full max-w-sm space-y-4">
                        <vibe:input label="Nama Lengkap (wire:model.live)" placeholder="Masukkan nama..." />
                        <vibe:input type="email" label="Email (wire:model)" placeholder="nama@email.com" info="Digunakan untuk login." />
                        <vibe:button variant="primary" class="w-full">Simpan Perubahan</vibe:button>
                    </div>
                </vibe:preview>
            </section>

            
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">Referensi Props</h2>
                    <p class="text-sm text-muted-foreground">
                        Semua properti yang didukung oleh komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code>. Atribut HTML standar (seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">class</code>, dll.) diteruskan langsung ke elemen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;input&gt;</code>.
                    </p>
                </div>

                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3 whitespace-nowrap">Prop</th>
                                <th class="px-4 py-3 whitespace-nowrap">Tipe</th>
                                <th class="px-4 py-3 whitespace-nowrap">Default</th>
                                <th class="px-4 py-3">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            @php
                                $props = [
                                    ['label', 'string', 'null', 'Teks label di atas input.'],
                                    ['id', 'string', 'auto', 'Atribut id input. Default: nilai name atau uniqid().'],
                                    ['name', 'string', 'null', 'Atribut name. Otomatis diambil dari wire:model jika tidak diisi.'],
                                    ['type', 'string', "'text'", 'Tipe input HTML: text, email, password, number, url, tel, dll.'],
                                    ['size', "'sm'|'md'|'lg'|'xl'", "'md'", 'Ukuran tinggi dan teks input.'],
                                    ['variant', "'outline'|'filled'|'flush'|'ghost'|'accent'", "'outline'", 'Gaya visual input.'],
                                    ['description', 'string', 'null', 'Teks kecil di bawah label, sebelum input.'],
                                    ['info', 'string', 'null', 'Teks panduan di bawah input. Tersembunyi jika ada error.'],
                                    ['error', 'string|bool', 'null', 'Pesan error kustom atau boolean untuk memicu error state.'],
                                    ['errorName', 'string', 'null', 'Key validasi Laravel jika berbeda dari name (misal: user.phone).'],
                                    ['prefix', 'string', 'null', 'Teks di sisi kiri input (misal: "https://", "Rp").'],
                                    ['suffix', 'string', 'null', 'Teks di sisi kanan input (misal: ".com", "/bulan").'],
                                    ['pill', 'bool', 'false', 'Mengubah radius sudut menjadi fully rounded (pill shape).'],
                                    ['wrapperClass', 'string', 'null', 'Class tambahan untuk div pembungkus luar.'],
                                ];
                            @endphp
                            @foreach ($props as [$prop, $type, $default, $desc])
                                <tr class="hover:bg-accent/40 transition-colors">
                                    <td class="px-4 py-3 font-mono font-bold text-foreground whitespace-nowrap">{{ $prop }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground whitespace-nowrap">{{ $type }}</td>
                                    <td class="px-4 py-3 font-mono text-muted-foreground/70 whitespace-nowrap">{{ $default }}</td>
                                    <td class="px-4 py-3 text-muted-foreground">{{ $desc }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Slots table --}}
                <p class="text-sm font-semibold text-foreground pt-2">Slots</p>
                <div class="overflow-x-auto rounded-xl border border-border bg-card text-card-foreground">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border bg-muted/60 text-foreground font-semibold">
                            <tr>
                                <th class="px-4 py-3">Slot</th>
                                <th class="px-4 py-3">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border text-muted-foreground">
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground">icon</td>
                                <td class="px-4 py-3 text-muted-foreground">Ikon SVG di sisi kiri input (leading icon). Gunakan <code class="font-mono text-foreground">&lt;x-slot:icon&gt;</code>.</td>
                            </tr>
                            <tr class="hover:bg-accent/40 transition-colors">
                                <td class="px-4 py-3 font-mono font-bold text-foreground">trailingIcon</td>
                                <td class="px-4 py-3 text-muted-foreground">Ikon SVG di sisi kanan input (trailing icon). Gunakan <code class="font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code>.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
