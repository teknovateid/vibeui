<x-docs.layouts.sidebar>
    <vibe:seo 
        title="Input File & Upload — Vibe UI" 
        description="Dokumentasi dan demo interaktif komponen vibe:input.file di Vibe UI dengan dukungan varian dropzone, avatar, logo checkerboard, preview instan, multi-file, dan Livewire upload progress." 
        schema="techarticle" 
        :breadcrumbs="[
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Docs', 'url' => '/docs'],
            ['name' => 'Input', 'url' => route('docs.input.index')],
            ['name' => 'Input File', 'url' => route('docs.input.file')]
        ]" 
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Form Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:input.file</vibe:badge>
                    <span class="text-xs text-muted-foreground">Upload, Dropzone, Avatar & Logo</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Input File / Upload</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen pemilihan dan pengunggahan berkas native yang modern dan elegan. Mendukung <strong>pratinjau instan di sisi klien</strong> (instant preview), drag & drop area, mode multi-file dengan sinkronisasi <code>DataTransfer</code>, serta varian khusus untuk <strong>Logo</strong> (dengan background transparansi kotak-catur) dan <strong>Avatar</strong> profil.
                </p>
            </div>

            {{-- 1. Varian Default (Inline Bar) --}}
            <section id="varian-default" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Varian Standar (Inline Bar)</h2>
                    <p class="text-sm text-muted-foreground">
                        Cocok untuk formulir kompak, tabel, modal, atau formulir ringkas:
                    </p>
                </div>

                <vibe:preview title="Default Inline File Input">
                    <vibe:preview.code>
<\vibe:input.file 
    label="Dokumen Resume / CV"
    name="resume"
    accept=".pdf,.docx"
    max-size="5MB"
    hint="Format didukung: PDF, DOCX (Maks. 5MB)"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-4">
                        <vibe:input.file 
                            label="Dokumen Resume / CV"
                            name="resume"
                            accept=".pdf,.docx"
                            max-size="5MB"
                            hint="Format didukung: PDF, DOCX (Maks. 5MB)"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Varian Dropzone (Drag & Drop Card) --}}
            <section id="varian-dropzone" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Varian Dropzone (Drag & Drop)</h2>
                    <p class="text-sm text-muted-foreground">
                        Area upload berbingkai putus-putus (<em>dashed border</em>) yang luas dan mendukung aksi drag & drop langsung dari komputer pengguna:
                    </p>
                </div>

                <vibe:preview title="Dropzone Drag & Drop Upload">
                    <vibe:preview.code>
<\vibe:input.file 
    variant="dropzone"
    label="Unggah Berkas Pendukung"
    name="attachment"
    accept="image/*,.pdf"
    max-size="10MB"
    hint="PNG, JPG, WebP, atau PDF hingga 10MB"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-lg space-y-4">
                        <vibe:input.file 
                            variant="dropzone"
                            label="Unggah Berkas Pendukung"
                            name="attachment"
                            accept="image/*,.pdf"
                            max-size="10MB"
                            hint="PNG, JPG, WebP, atau PDF hingga 10MB"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Varian Logo (Brand & Aplikasi) --}}
            <section id="varian-logo" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Varian Logo (Brand / Navbar Logo)</h2>
                    <p class="text-sm text-muted-foreground">
                        Didesain khusus untuk identitas merek dan logo aplikasi. Dilengkapi <strong>pola kotak-catur transparan (*checkerboard grid*)</strong> agar logo berlatar belakang transparan (baik teks putih maupun hitam) terlihat jelas tanpa terpotong:
                    </p>
                </div>

                <vibe:preview title="Upload Logo Perusahaan">
                    <vibe:preview.code>
{{-- Logo Horizontal (3:1 / 4:1) --}}
<\vibe:input.file 
    variant="logo"
    aspect-ratio="horizontal"
    label="Logo Utama Aplikasi"
    name="app_logo"
    accept="image/png,image/svg+xml,image/webp,image/jpeg"
    hint="Format SVG atau PNG transparan. Rekomendasi 512x128px (Maks. 2MB)"
    description="Logo ini akan tampil di bilah navigasi dan dokumen cetak/faktur."
/>

{{-- Logo Square / App Icon (1:1) --}}
<\vibe:input.file 
    variant="logo"
    aspect-ratio="square"
    label="App Icon (Favicon)"
    name="app_icon"
    accept="image/png,image/svg+xml,image/x-icon"
    hint="Rekomendasi rasio 1:1 (min. 512x512px)"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-6">
                        <vibe:input.file 
                            variant="logo"
                            aspect-ratio="horizontal"
                            label="Logo Utama Aplikasi"
                            name="demo_app_logo"
                            accept="image/png,image/svg+xml,image/webp,image/jpeg"
                            hint="Format SVG atau PNG transparan. Rekomendasi 512x128px (Maks. 2MB)"
                            description="Logo ini akan tampil di bilah navigasi dan dokumen cetak/faktur."
                        />

                        <vibe:input.file 
                            variant="logo"
                            aspect-ratio="square"
                            label="App Icon (Favicon)"
                            name="demo_app_icon"
                            accept="image/png,image/svg+xml,image/x-icon"
                            hint="Rekomendasi rasio 1:1 (min. 512x512px)"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Varian Avatar (Foto Profil) --}}
            <section id="varian-avatar" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Varian Avatar (Foto Profil)</h2>
                    <p class="text-sm text-muted-foreground">
                        Komponen lingkaran profil dengan overlay kamera instan saat di-hover:
                    </p>
                </div>

                <vibe:preview title="Foto Profil Avatar">
                    <vibe:preview.code>
<\vibe:input.file 
    variant="avatar"
    label="Foto Profil Akun"
    name="profile_photo"
    accept="image/*"
    max-size="2MB"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-md space-y-4">
                        <vibe:input.file 
                            variant="avatar"
                            label="Foto Profil Akun"
                            name="demo_profile_photo"
                            accept="image/*"
                            max-size="2MB"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Dukungan Multi-File (Multiple Upload) --}}
            <section id="multi-file" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Pemilihan Banyak Berkas (Multi-File)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan prop <code>multiple</code> untuk mengizinkan pengguna memilih banyak berkas sekaligus. Dilengkapi tombol hapus individual per berkas:
                    </p>
                </div>

                <vibe:preview title="Multi-File dengan Dropzone">
                    <vibe:preview.code>
<\vibe:input.file 
    variant="dropzone"
    label="Galeri Foto Produk"
    name="gallery[]"
    multiple
    max-files="6"
    accept="image/*"
    hint="Unggah hingga 6 foto produk (PNG, JPG, WebP)"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-4">
                        <vibe:input.file 
                            variant="dropzone"
                            label="Galeri Foto Produk"
                            name="demo_gallery"
                            multiple
                            max-files="6"
                            accept="image/*"
                            hint="Unggah hingga 6 foto produk (PNG, JPG, WebP)"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 6. Mode Edit dengan existingUrl --}}
            <section id="mode-edit" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Mode Edit Formulir (Existing URL)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan prop <code>existing-url</code> untuk menampilkan berkas/gambar lama yang sudah ada di database atau storage:
                    </p>
                </div>

                <vibe:preview title="Mode Edit dengan Gambar yang Sudah Ada">
                    <vibe:preview.code>
<\vibe:input.file 
    variant="logo"
    label="Logo Perusahaan Saat Ini"
    name="company_logo"
    existing-url="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400&auto=format&fit=crop&q=60"
    hint="Klik Ganti untuk mengunggah logo baru atau Hapus untuk mengosongkannya"
/>
                    </vibe:preview.code>
                    <div class="w-full max-w-xl space-y-4">
                        <vibe:input.file 
                            variant="logo"
                            label="Logo Perusahaan Saat Ini"
                            name="demo_existing_logo"
                            existing-url="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400&auto=format&fit=crop&q=60"
                            hint="Klik Ganti untuk mengunggah logo baru atau Hapus untuk mengosongkannya"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 7. Integrasi Livewire 3 --}}
            <section id="integrasi-livewire" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">7. Integrasi Penuh dengan Livewire 3</h2>
                    <p class="text-sm text-muted-foreground">
                        Kompatibel penuh dengan <code>wire:model</code> dan otomatis menampilkan animasi <em>progress bar</em> saat Livewire mengunggah berkas sementara:
                    </p>
                </div>

                <vibe:highlightjs language="blade">
<\vibe:input.file 
    wire:model="avatar"
    variant="avatar"
    label="Foto Profil"
    :existing-url="$user->avatar_url"
/>

<\vibe:input.file 
    wire:model="documents"
    variant="dropzone"
    multiple
    label="Dokumen Klaim"
/>
</vibe:highlightjs>
            </section>

            {{-- 8. Tabel Spesifikasi Props --}}
            <section id="spesifikasi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">8. Spesifikasi Props</h2>
                    <p class="text-sm text-muted-foreground">Daftar lengkap atribut yang didukung oleh komponen <code>&lt;vibe:input.file&gt;</code>:</p>
                </div>

                <div class="rounded-xl border border-border overflow-hidden bg-card shadow-2xs">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-muted/50 border-b border-border text-foreground font-semibold">
                            <tr>
                                <th class="p-3">Prop</th>
                                <th class="p-3">Tipe</th>
                                <th class="p-3">Default</th>
                                <th class="p-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/60 text-muted-foreground">
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">variant</td>
                                <td class="p-3 font-mono">'default'|'dropzone'|'avatar'|'logo'</td>
                                <td class="p-3 font-mono">'default'</td>
                                <td class="p-3">Gaya tampilan visual komponen</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">aspectRatio</td>
                                <td class="p-3 font-mono">'horizontal'|'square'|'video'|'auto'</td>
                                <td class="p-3 font-mono">'auto'</td>
                                <td class="p-3">Rasio aspek preview (horizontal untuk logo navbar, square untuk favicon/icon)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">multiple</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Izinkan pemilihan banyak berkas sekaligus dengan daftar kartu preview</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">maxFiles</td>
                                <td class="p-3 font-mono">int|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Batas jumlah berkas maksimum saat menggunakan mode <code>multiple</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">maxSize</td>
                                <td class="p-3 font-mono">string|int|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Batas ukuran berkas maksimum (misal: <code>"2MB"</code>, <code>"500KB"</code>) dengan validasi instan klien</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">accept</td>
                                <td class="p-3 font-mono">string|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Filter format tipe MIME (misal: <code>"image/*"</code>, <code>".pdf,.docx"</code>)</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">existingUrl</td>
                                <td class="p-3 font-mono">string|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">URL berkas/logo lama untuk formulir mode edit dengan tombol hapus</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">hint</td>
                                <td class="p-3 font-mono">string|null</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Teks petunjuk format atau dimensi rekomendasi di samping/bawah tombol</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">size</td>
                                <td class="p-3 font-mono">'sm'|'md'|'lg'</td>
                                <td class="p-3 font-mono">'md'</td>
                                <td class="p-3">Ukuran dimensi avatar dan kotak logo</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">disabled</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Nonaktifkan interaksi upload berkas</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono font-semibold text-foreground">required</td>
                                <td class="p-3 font-mono">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Tandai input sebagai wajib diisi</td>
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
