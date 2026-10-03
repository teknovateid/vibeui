<x-docs.layouts.sidebar>
    <vibe:seo title="Input Multiple & Tags — Vibe UI" description="Dokumentasi dan demo interaktif komponen vibe:input.multiple untuk input tags/chips dengan auto-parsing multi-delimiter, color cycle, dan format POST fleksibel di Vibe UI." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Input', 'url' => route('docs.input.index')],
        ['name' => 'Input Multiple / Tags', 'url' => route('docs.input.multiple')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.multiple</vibe:badge>
                    <vibe:badge variant="success" class="rounded-full">vibe:input.tags</vibe:badge>
                    <span class="text-xs text-muted-foreground">Auto-Parser & Chips</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input Multiple / Tags</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen input interaktif untuk memasukkan banyak data sekaligus (tags, keywords, chips, daftar API keys, teknologi) dengan tampilan visual seperti <code>&lt;vibe:select multiple&gt;</code>. Dilengkapi fitur <strong>auto-parsing multi-delimiter</strong> saat mengetik atau paste teks, rotasi warna badge (<em>color cycle</em>), serta serialisasi nilai form POST yang dapat disesuaikan (misal: <code>laravel,nextjs,php</code> atau pemisah pipa <code>key1|key2|key3</code>).
                </p>
            </div>

            {{-- 1. Penggunaan Dasar --}}
            <section id="penggunaan-dasar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Penggunaan Dasar (Pemisah Koma Default)</h2>
                    <p class="text-sm text-muted-foreground">
                        Ketik teks lalu tekan tombol <kbd class="px-1.5 py-0.5 text-xs font-semibold bg-muted border border-border rounded">Enter</kbd> atau tanda koma <kbd class="px-1.5 py-0.5 text-xs font-semibold bg-muted border border-border rounded">,</kbd> untuk membuat badge baru. Tekan <kbd class="px-1.5 py-0.5 text-xs font-semibold bg-muted border border-border rounded">Backspace</kbd> saat input kosong untuk menghapus badge terakhir.
                    </p>
                </div>

                <vibe:preview title="Input Multiple Standar">
                    <vibe:preview.code>
<\vibe:input.multiple 
    name="skills" 
    label="Keahlian & Topik" 
    placeholder="Ketik topik lalu tekan koma atau Enter..."
    :value="['Laravel', 'Livewire', 'Tailwind CSS']" 
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-3">
                        <vibe:input.multiple 
                            name="demo_skills" 
                            label="Keahlian & Topik" 
                            placeholder="Ketik topik lalu tekan koma atau Enter..."
                            :value="['Laravel', 'Livewire', 'Tailwind CSS']" 
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Separator Kustom (Pipe |) & Auto-Parsing API Keys --}}
            <section id="separator-kustom" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Separator Kustom Melalui Atribut (Contoh: Pipe <code>|</code>)</h2>
                    <p class="text-sm text-muted-foreground">
                        Atribut <code>separator="|"</code> akan otomatis menjadikan karakter pipa <code>|</code> sebagai pemicu pemisahan input saat mengetik/paste, sekaligus perekat nilai string saat form dipost (menghasilkan nilai <code>key1|key2|key3</code>):
                    </p>
                </div>

                <vibe:preview title="Auto-Parsing API Keys dengan Separator |">
                    <vibe:preview.code>
<\vibe:input.multiple 
    name="api_tokens" 
    label="API Keys / Token Layanan" 
    description="Ketik atau paste beberapa kunci dengan pemisah '|' (pipe)"
    separator="|"
    value="sk_dev_98234|sk_staging_88712|sk_prod_11902"
    placeholder="Ketik token lalu tekan | atau Enter..."
    copyable
    clearable
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg space-y-3">
                        <vibe:input.multiple 
                            name="demo_api_tokens" 
                            label="API Keys / Token Layanan" 
                            description="Ketik atau paste beberapa kunci dengan pemisah '|' (pipe)"
                            separator="|"
                            value="sk_dev_98234|sk_staging_88712|sk_prod_11902"
                            placeholder="Ketik token lalu tekan | atau Enter..."
                            copyable
                            clearable
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Variasi Warna Badge Dinamis (Color Cycle) --}}
            <section id="color-cycle" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Variasi Warna Badge Berbeda (Color Cycle)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan prop <code>badge-variant="cycle"</code> agar setiap badge yang dimasukkan atau di-parse otomatis memperoleh warna berbeda (info, primary, success, warning, purple, pink, emerald, cyan) dari palet kurasi Vibe UI:
                    </p>
                </div>

                <vibe:preview title="Color Cycling Badges">
                    <vibe:preview.code>
<\vibe:input.multiple 
    name="categories" 
    label="Kategori Produk / Label" 
    badge-variant="cycle"
    placeholder="Ketik label..."
    :value="['Backend', 'Frontend', 'DevOps', 'Mobile', 'UI/UX', 'Cloud Computing']" 
    clearable
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg space-y-3">
                        <vibe:input.multiple 
                            name="demo_categories" 
                            label="Kategori Produk / Label" 
                            badge-variant="cycle"
                            placeholder="Ketik label..."
                            :value="['Backend', 'Frontend', 'DevOps', 'Mobile', 'UI/UX', 'Cloud Computing']" 
                            clearable
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Auto-Parsing Saat Paste Teks Multi-Nilai --}}
            <section id="auto-paste" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Auto-Parsing Saat Paste (Clipboard Parsing)</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen memiliki listener clipboard pintar yang mendeteksi teks salinan dari CSV, file teks, atau baris baru (<em>newline</em>) dan langsung memecahnya menjadi deretan badge individu seketika:
                    </p>
                </div>

                <vibe:preview title="Demo Paste Teks">
                    <vibe:preview.code>
{{-- Coba copy teks ini: 'Laravel|Next.js|Vue|React|Svelte|Angular' lalu paste ke input di bawah --}}
<\vibe:input.multiple 
    name="paste_demo" 
    label="Daftar Frameworks" 
    description="Coba salin teks 'Laravel|Next.js|Vue|React|Svelte' lalu paste langsung ke kotak input"
    separator="|"
    badge-variant="cycle"
    placeholder="Paste teks dipisahkan | atau koma di sini..."
    clearable
    copyable
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg space-y-3">
                        <vibe:input.multiple 
                            name="demo_paste_demo" 
                            label="Daftar Frameworks" 
                            description="Coba salin teks 'Laravel|Next.js|Vue|React|Svelte' lalu paste langsung ke kotak input"
                            separator="|"
                            badge-variant="cycle"
                            placeholder="Paste teks dipisahkan | atau koma di sini..."
                            clearable
                            copyable
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Opsi Format Nilai POST ke Server --}}
            <section id="format-post" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Serialisasi Nilai Saat Form Di-Submit (POST)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan prop <code>post-format</code> dan <code>post-separator</code> untuk mengatur format nilai yang dikirim ke controller Laravel saat form di-submit:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    <div class="p-4 rounded-xl border border-border bg-card/60 space-y-2">
                        <span class="font-mono font-semibold text-primary">post-format="string" (Default)</span>
                        <p class="text-muted-foreground">Menghasilkan string tunggal yang digabungkan koma (atau sesuai <code>separator</code>):</p>
                        <code class="block p-2 rounded bg-muted/60 font-mono text-[11px] text-foreground">"laravel,nextjs,php"</code>
                    </div>
                    <div class="p-4 rounded-xl border border-border bg-card/60 space-y-2">
                        <span class="font-mono font-semibold text-primary">post-format="array"</span>
                        <p class="text-muted-foreground">Menghasilkan multiple input tersembunyi <code>name[]</code> sehingga Laravel otomatis membacanya sebagai array PHP:</p>
                        <code class="block p-2 rounded bg-muted/60 font-mono text-[11px] text-foreground">['laravel', 'nextjs', 'php']</code>
                    </div>
                    <div class="p-4 rounded-xl border border-border bg-card/60 space-y-2">
                        <span class="font-mono font-semibold text-primary">post-format="json"</span>
                        <p class="text-muted-foreground">Menghasilkan string JSON terenkapsulasi:</p>
                        <code class="block p-2 rounded bg-muted/60 font-mono text-[11px] text-foreground">'["laravel","nextjs","php"]'</code>
                    </div>
                </div>

                <vibe:preview title="Input Multiple dengan Format POST String Koma">
                    <vibe:preview.code>
{{-- Input dengan delimiter pipa |, tapi saat dipost digabung dengan koma ',' --}}
<\vibe:input.multiple 
    name="technologies" 
    label="Pilihan Teknologi" 
    :delimiters="['|', ',', 'Enter']"
    post-separator=","
    badge-variant="cycle"
    value="laravel,nextjs,php"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-3">
                        <vibe:input.multiple 
                            name="demo_technologies" 
                            label="Pilihan Teknologi" 
                            :delimiters="['|', ',', 'Enter']"
                            post-separator=","
                            badge-variant="cycle"
                            value="laravel,nextjs,php"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Batasan Item (Min, Max) & Duplikasi --}}
            <section id="limit-duplikasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Batasan Item (Min / Max) & Pencegahan Duplikasi</h2>
                    <p class="text-sm text-muted-foreground">
                        Atur batas maksimum badge dengan <code>:max="5"</code> dan batas minimum dengan <code>:min="1"</code>. Secara default, item yang duplikat otomatis diabaikan:
                    </p>
                </div>

                <vibe:preview title="Maksimal 4 Tag">
                    <vibe:preview.code>
<\vibe:input.multiple 
    name="tags_limited" 
    label="Tags Favorit (Maks 4)" 
    :max="4" 
    :min="1" 
    info="Maksimal 4 item dapat ditambahkan"
    :value="['Alpha', 'Beta']"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:input.multiple 
                            name="demo_tags_limited" 
                            label="Tags Favorit (Maks 4)" 
                            :max="4" 
                            :min="1" 
                            info="Maksimal 4 item dapat ditambahkan"
                            :value="['Alpha', 'Beta']"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Pilihan Ukuran (Sizes) --}}
            <section id="ukuran" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">7. Pilihan Ukuran (Sizes)</h2>
                    <p class="text-sm text-muted-foreground">
                        Tersedia 5 varian ukuran: <code>xs</code>, <code>sm</code>, <code>md</code> (default), <code>lg</code>, dan <code>xl</code>. Ukuran badge di dalamnya otomatis menyesuaikan proporsi container:
                    </p>
                </div>

                <vibe:preview title="Varian Ukuran">
                    <vibe:preview.code>
<\vibe:input.multiple size="sm" label="Small (sm)" :value="['Laravel', 'PHP']" />
<\vibe:input.multiple size="md" label="Medium (md - Default)" :value="['Laravel', 'Tailwind']" />
<\vibe:input.multiple size="lg" label="Large (lg)" :value="['Laravel', 'Vue.js']" />
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-4">
                        <vibe:input.multiple size="sm" label="Small (sm)" :value="['Laravel', 'PHP']" />
                        <vibe:input.multiple size="md" label="Medium (md - Default)" :value="['Laravel', 'Tailwind']" />
                        <vibe:input.multiple size="lg" label="Large (lg)" :value="['Laravel', 'Vue.js']" />
                    </div>
                </vibe:preview>
            </section>

            {{-- 8. Pengujian Form Submission dengan Modal --}}
            <section id="pengujian-form" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">8. Pengujian Form Submission ($request->all())</h2>
                        <vibe:badge variant="primary" size="sm">Live Controller Test</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Uji pengiriman formulir nyata ke endpoint <code>FormController@store</code>. Saat form di-submit, controller akan mengembalikan payload JSON yang akan langsung ditampilkan pada modal interaktif:
                    </p>
                </div>

                <vibe:preview title="Simulasi Form Submission dengan Modal">
                    <vibe:preview.code>
<vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
    @csrf
    <vibe:card>
        <vibe:card.header>
            <h3 class="text-sm sm:text-base font-semibold text-foreground">Pengujian Form Input Multiple</h3>
            <p class="text-xs text-muted-foreground mt-0.5">Kirim data ke controller dan lihat hasilnya di modal.</p>
        </vibe:card.header>

        <vibe:card.content class="space-y-4">
            <vibe:input.multiple 
                name="skills" 
                label="Keahlian & Tags (Separator Koma)" 
                separator="," 
                badge-variant="cycle"
                :value="['Laravel', 'Next.js', 'Tailwind']" 
                copyable
                clearable
            />

            <vibe:input.multiple 
                name="api_tokens" 
                label="API Tokens (Separator Pipe |)" 
                separator="|" 
                badge-variant="cycle"
                :value="['KEY_DEV_1', 'KEY_STAGING_2']" 
                copyable
                clearable
            />
        </vibe:card.content>

        <vibe:card.footer>
            <vibe:button class="w-full" type="submit" variant="primary">
                Kirim Form & Uji $request->all()
            </vibe:button>
        </vibe:card.footer>
    </vibe:card>
</vibe:form>
                    </vibe:preview.code>

                    <vibe:form action="{{ route('docs.form.store') }}" method="POST" class="w-full max-w-lg mx-auto">
                        @csrf
                        <vibe:card>
                            <vibe:card.header>
                                <h3 class="text-sm sm:text-base font-semibold text-foreground">Pengujian Form Input Multiple</h3>
                                <p class="text-xs text-muted-foreground mt-0.5">Kirim data ke controller dan lihat hasilnya di modal.</p>
                            </vibe:card.header>

                            <vibe:card.content class="space-y-4">
                                <vibe:input.multiple 
                                    name="skills" 
                                    label="Keahlian & Tags (Separator Koma)" 
                                    separator="," 
                                    badge-variant="cycle"
                                    :value="['Laravel', 'Next.js', 'Tailwind']" 
                                    copyable
                                    clearable
                                />

                                <vibe:input.multiple 
                                    name="api_tokens" 
                                    label="API Tokens (Separator Pipe |)" 
                                    separator="|" 
                                    badge-variant="cycle"
                                    :value="['KEY_DEV_1', 'KEY_STAGING_2']" 
                                    copyable
                                    clearable
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

            {{-- 9. Tabel Props Lengkap --}}
            <section id="props-referensi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">9. Referensi Props & Atribut</h2>
                    <p class="text-sm text-muted-foreground">
                        Daftar lengkap atribut dan prop yang didukung oleh komponen <code>&lt;vibe:input.multiple&gt;</code> dan aliasnya <code>&lt;vibe:input.tags&gt;</code>:
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
                                    ['separator', 'string', "','", 'Karakter pemisah input & output POST utama (misal "," atau "|").'],
                                    ['delimiters', 'array|string|null', 'null', 'Daftar delimiter tambahan saat input parsing jika berbeda dari separator.'],
                                    ['postSeparator', 'string|null', 'null', 'Karakter pemisah saat form dipost jika ingin berbeda dari input separator.'],
                                    ['postFormat', "'string'|'array'|'json'", "'string'", 'Format data output saat form dipost.'],
                                    ['value', 'string|array', '[]', 'Nilai awal (bisa array PHP atau string dengan pemisah).'],
                                    ['badgeVariant', "'secondary'|'primary'|'outline'|'cycle'", "'secondary'", 'Gaya badge (pilih "cycle" untuk warna berbeda tiap badge).'],
                                    ['colorCycle', 'array', "['info',...]", 'Daftar varian warna untuk mode badge-variant="cycle".'],
                                    ['max / maxTags', 'int|null', 'null', 'Batas maksimum jumlah item yang boleh dimasukkan.'],
                                    ['min / minTags', 'int|null', 'null', 'Batas minimum jumlah item yang harus dipertahankan.'],
                                    ['allowDuplicates', 'bool', 'false', 'Izinkan nilai duplikat dimasukkan ke dalam daftar.'],
                                    ['placeholder', 'string', "'Tambah item...'", 'Teks placeholder saat input kosong.'],
                                    ['clearable', 'bool', 'true', 'Tampilkan tombol silang untuk menghapus seluruh item sekaligus.'],
                                    ['copyable', 'bool', 'false', 'Tampilkan tombol salin untuk menyalin seluruh item ke clipboard.'],
                                    ['size', "'xs'|'sm'|'md'|'lg'|'xl'", "'md'", 'Ukuran visual container input dan badge.'],
                                    ['variant', "'primary'|'outline'|'filled'|'flush'|'ghost'", "'primary'", 'Variasi gaya visual border dan latar input.'],
                                    ['disabled', 'bool', 'false', 'Menonaktifkan interaksi pada komponen input.'],
                                    ['readonly', 'bool', 'false', 'Membuat input hanya bisa dibaca tanpa dapat dihapus/ditambah.'],
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
