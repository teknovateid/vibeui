<x-docs.layouts.sidebar>
    <vibe:seo 
        title="Display Image Lightbox Component — Vibe UI" 
        description="Komponen preview gambar interaktif dengan modal fullscreen lightbox, navigasi gambar sebelumnya/selanjutnya berbasis grup, kontrol zoom responsif, serta gestur sentuh dan keyboard shortcut di Vibe UI." 
        schema="techarticle" 
        :breadcrumbs="[
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Docs', 'url' => '/docs'],
            ['name' => 'Display', 'url' => route('docs.display.image')],
            ['name' => 'Image (Lightbox)', 'url' => route('docs.display.image')]
        ]" 
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Display Component</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">vibe:display.image</vibe:badge>
                    <span class="text-xs text-muted-foreground">Fullscreen Lightbox • Grouped Navigation • Touch & Zoom</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Display Image Lightbox</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Komponen pratinjau gambar modern yang menampilkan thumbnail interaktif. Saat gambar diklik, modal <em>fullscreen lightbox</em> elegan akan terbuka dengan dukungan navigasi panah kiri/kanan (berdasarkan grup), kontrol zoom bertahap, drag saat diperbesar, gestur swipe di perangkat mobile, dan pintasan keyboard lengkap.
                </p>
            </div>

            {{-- 1. Grouped Gallery Preview --}}
            <section id="galeri-grup" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Galeri Gambar Terhubung (Next / Prev)</h2>
                    <p class="text-sm text-muted-foreground">
                        Gunakan atribut <code class="text-primary font-mono font-semibold">group="nama-grup"</code> untuk menghubungkan beberapa gambar. Saat dibuka, pengguna dapat berpindah antar gambar menggunakan tombol panah layar atau tombol keyboard <kbd class="px-1.5 py-0.5 rounded bg-muted border border-border text-[11px] font-mono">←</kbd> dan <kbd class="px-1.5 py-0.5 rounded bg-muted border border-border text-[11px] font-mono">→</kbd>.
                    </p>
                </div>

                <vibe:preview data-toc-ignore title="Galeri Pemandangan Alam">
                    <vibe:preview.code>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200&auto=format&fit=crop&q=80" 
        alt="Lembah Yosemite" 
        caption="Panorama Lembah Yosemite saat Matahari Terbit"
        group="alam"
        class="w-full aspect-[4/3] rounded-2xl shadow-sm"
    />

    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&auto=format&fit=crop&q=80" 
        alt="Padang Rumput Hijau" 
        caption="Padang Rumput Menghijau di Perbukitan"
        group="alam"
        class="w-full aspect-[4/3] rounded-2xl shadow-sm"
    />

    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200&auto=format&fit=crop&q=80" 
        alt="Danau Biru Bersih" 
        caption="Danau Biru Bersih Dikelilingi Pegunungan"
        group="alam"
        class="w-full aspect-[4/3] rounded-2xl shadow-sm"
    />
</div>
                    </vibe:preview.code>

                    <div class="w-full p-4 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <vibe:display.image 
                                src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200&auto=format&fit=crop&q=80" 
                                alt="Lembah Yosemite" 
                                caption="Panorama Lembah Yosemite saat Matahari Terbit"
                                group="alam"
                                class="w-full aspect-[4/3] rounded-2xl shadow-sm"
                            />

                            <vibe:display.image 
                                src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&auto=format&fit=crop&q=80" 
                                alt="Padang Rumput Hijau" 
                                caption="Padang Rumput Menghijau di Perbukitan"
                                group="alam"
                                class="w-full aspect-[4/3] rounded-2xl shadow-sm"
                            />

                            <vibe:display.image 
                                src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200&auto=format&fit=crop&q=80" 
                                alt="Danau Biru Bersih" 
                                caption="Danau Biru Bersih Dikelilingi Pegunungan"
                                group="alam"
                                class="w-full aspect-[4/3] rounded-2xl shadow-sm"
                            />
                        </div>
                    </div>
                </vibe:preview>
            </section>

            {{-- 2. Standalone Image Preview --}}
            <section id="gambar-tunggal" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Gambar Tunggal (Standalone)</h2>
                    <p class="text-sm text-muted-foreground">
                        Jika hanya ingin gambar individual dibuka dalam fullscreen tanpa tombol navigasi panah kiri/kanan, gunakan prop <code class="text-primary font-mono font-semibold">standalone</code>.
                    </p>
                </div>

                <vibe:preview data-toc-ignore title="Pratinjau Gambar Tunggal">
                    <vibe:preview.code>
<\vibe:display.image 
    src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&auto=format&fit=crop&q=80" 
    alt="Bintang di Langit Malam Pegunungan" 
    caption="Galaksi Bima Sakti di Puncak Alpen (Klik untuk Zoom)"
    standalone
    class="w-full max-w-xl aspect-video rounded-2xl shadow-md mx-auto"
/>
                    </vibe:preview.code>

                    <div class="w-full flex justify-center p-4 sm:p-6">
                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1519681393784-d120267933ba?w=1200&auto=format&fit=crop&q=80" 
                            alt="Bintang di Langit Malam Pegunungan" 
                            caption="Galaksi Bima Sakti di Puncak Alpen (Klik untuk Zoom)"
                            standalone
                            class="w-full max-w-xl aspect-video rounded-2xl shadow-md mx-auto"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 3. Kustomisasi Ukuran & Aspect Ratio Murni via Class --}}
            <section id="kustomisasi-class" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Fleksibilitas Ukuran & Rasio Aspek via Class</h2>
                    <p class="text-sm text-muted-foreground">
                        Ukuran lebar, tinggi, dan rasio aspek ditentukan bebas menggunakan class utility Tailwind (<code class="text-primary font-mono">aspect-square</code>, <code class="text-primary font-mono">aspect-[21/9]</code>, <code class="text-primary font-mono">size-36</code>, dll.) tanpa dibatasi oleh konfigurasi bawaan.
                    </p>
                </div>

                <vibe:preview data-toc-ignore title="Variasi Bentuk & Rasio">
                    <vibe:preview.code>
<div class="flex flex-wrap items-center gap-6 justify-center">
    {{-- Kotak (Square) --}}
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1534447677768-be436bb09401?w=800&auto=format&fit=crop&q=80" 
        alt="Foto Kotak" 
        caption="Rasio Kotak 1:1"
        group="variasi-bentuk"
        class="w-36 aspect-square rounded-2xl shadow-sm"
    />

    {{-- Portret (3:4) --}}
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131?w=800&auto=format&fit=crop&q=80" 
        alt="Kucing Lucu" 
        caption="Format Portret 3:4"
        group="variasi-bentuk"
        class="w-36 aspect-[3/4] rounded-2xl shadow-sm"
    />

    {{-- Bulat (Circle Avatar Lightbox) --}}
    <\vibe:display.image 
        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&auto=format&fit=crop&q=80" 
        alt="Foto Profil" 
        caption="Avatar Pengguna — Dapat Diperbesar"
        standalone
        class="size-28 rounded-full shadow-sm"
    />
</div>
                    </vibe:preview.code>

                    <div class="w-full flex flex-wrap items-center gap-6 justify-center p-6">
                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1534447677768-be436bb09401?w=800&auto=format&fit=crop&q=80" 
                            alt="Foto Kotak" 
                            caption="Rasio Kotak 1:1"
                            group="variasi-bentuk"
                            class="w-36 aspect-square rounded-2xl shadow-sm"
                        />

                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131?w=800&auto=format&fit=crop&q=80" 
                            alt="Kucing Lucu" 
                            caption="Format Portret 3:4"
                            group="variasi-bentuk"
                            class="w-36 aspect-[3/4] rounded-2xl shadow-sm"
                        />

                        <vibe:display.image 
                            src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=800&auto=format&fit=crop&q=80" 
                            alt="Foto Profil" 
                            caption="Avatar Pengguna — Dapat Diperbesar"
                            standalone
                            class="size-28 rounded-full shadow-sm"
                        />
                    </div>
                </vibe:preview>
            </section>

            {{-- 4. Kontainer Galeri Otomatis (HTML / WYSIWYG) --}}
            <section id="kontainer-galeri" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Kontainer Galeri Otomatis (vibe:display.image-gallery)</h2>
                    <p class="text-sm text-muted-foreground">
                        Sangat cocok untuk artikel blog atau konten teks yang merender tag <code class="text-primary font-mono">&lt;img&gt;</code> HTML biasa. Bungkus dengan <code class="text-primary font-mono">&lt;vibe:display.image-gallery&gt;</code>, maka semua gambar di dalamnya otomatis dapat diklik dan terhubung dalam satu navigasi.
                    </p>
                </div>

                <vibe:preview data-toc-ignore title="Pembungkus Gambar Otomatis">
                    <vibe:preview.code>
<\vibe:display.image-gallery group="arsitektur-kamar" class="grid grid-cols-2 gap-4 max-w-xl mx-auto">
    <img 
        src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80" 
        alt="Kamar Tidur Utama" 
        class="w-full aspect-video rounded-xl object-cover shadow-xs"
    />
    <img 
        src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&auto=format&fit=crop&q=80" 
        alt="Kamar Mandi Minimalis" 
        class="w-full aspect-video rounded-xl object-cover shadow-xs"
    />
</\vibe:display.image-gallery>
                    </vibe:preview.code>

                    <div class="w-full p-4 sm:p-6">
                        <vibe:display.image-gallery group="arsitektur-kamar" class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl mx-auto">
                            <img 
                                src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&auto=format&fit=crop&q=80" 
                                alt="Kamar Tidur Utama" 
                                class="w-full aspect-video rounded-xl object-cover shadow-xs"
                            />
                            <img 
                                src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&auto=format&fit=crop&q=80" 
                                alt="Kamar Mandi Minimalis" 
                                class="w-full aspect-video rounded-xl object-cover shadow-xs"
                            />
                        </vibe:display.image-gallery>
                    </div>
                </vibe:preview>
            </section>

            {{-- 5. Pintasan Keyboard & Gestur --}}
            <section id="pintasan-keyboard" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Interaksi Pintasan Keyboard & Gestur Layar Sentuh</h2>
                    <p class="text-sm text-muted-foreground">
                        Modal lightbox dilengkapi dengan navigasi aksesibel yang memanjakan pengguna desktop maupun mobile:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card space-y-3">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="4" rx="2"/>
                                <path d="M6 8h.01M10 8h.01M14 8h.01M18 8h.01M8 12h8M6 12h.01M18 12h.01"/>
                            </svg>
                            Pintasan Keyboard (Desktop)
                        </h3>
                        <ul class="text-xs space-y-2 text-muted-foreground">
                            <li class="flex items-center justify-between">
                                <span>Pindah gambar sebelumnya</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">ArrowLeft (←)</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Pindah gambar selanjutnya</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">ArrowRight (→)</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Tutup modal lightbox</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">Escape (Esc)</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Perbesar & Perkecil Zoom</span>
                                <kbd class="px-2 py-0.5 rounded bg-muted border border-border font-mono text-foreground font-semibold">+ / -</kbd>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Toggle Zoom Cepat</span>
                                <span class="font-mono text-foreground font-semibold">Double Click</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-3">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <svg class="size-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="14" height="20" x="5" y="2" rx="2"/>
                                <path d="M12 18h.01"/>
                            </svg>
                            Gestur Layar Sentuh (Mobile)
                        </h3>
                        <ul class="text-xs space-y-2 text-muted-foreground">
                            <li class="flex items-center justify-between">
                                <span>Geser ke Kiri (Swipe Left)</span>
                                <span class="font-medium text-foreground">Gambar Selanjutnya</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Geser ke Kanan (Swipe Right)</span>
                                <span class="font-medium text-foreground">Gambar Sebelumnya</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Tarik ke Bawah (Swipe Down)</span>
                                <span class="font-medium text-foreground">Tutup Lightbox</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span>Drag saat diperbesar</span>
                                <span class="font-medium text-foreground">Geser posisi detail gambar</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            {{-- 6. Tabel Referensi Props --}}
            <section id="referensi-props" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">6. Referensi Props & Atribut</h2>
                    <p class="text-sm text-muted-foreground">
                        Parameter atribut yang tersedia pada komponen <code>&lt;vibe:display.image&gt;</code>:
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
                                <td class="p-3 font-mono text-primary font-semibold">src</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono"><em>(wajib)</em></td>
                                <td class="p-3">Tautan URL atau path gambar yang akan ditampilkan.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">alt</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">''</td>
                                <td class="p-3">Teks alternatif untuk aksesibilitas dan teks caption bawaan pada lightbox.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">group</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">'default'</td>
                                <td class="p-3">Nama grup galeri untuk merangkai navigasi sebelumnya/selanjutnya (Prev / Next).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">caption</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">null</td>
                                <td class="p-3">Keterangan deskripsi gambar yang ditampilkan di bagian bawah modal lightbox.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">standalone</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Jika <code>true</code>, gambar dibuka tersendiri tanpa tombol navigasi panah kiri/kanan.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">class</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">''</td>
                                <td class="p-3">Class Tailwind untuk mengatur ukuran (<code>w-*</code>, <code>h-*</code>), rasio aspek (<code>aspect-*</code>), border radius, dan bayangan.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">imgClass</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">'w-full h-full object-cover'</td>
                                <td class="p-3">Class Tailwind khusus yang diterapkan langsung pada elemen tag <code>&lt;img&gt;</code>.</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">loading</td>
                                <td class="p-3 font-mono text-muted-foreground">string</td>
                                <td class="p-3 font-mono">'lazy'</td>
                                <td class="p-3">Mode pemuatan gambar native browser (<code>'lazy'</code> atau <code>'eager'</code>).</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-mono text-primary font-semibold">showCaption</td>
                                <td class="p-3 font-mono text-muted-foreground">bool</td>
                                <td class="p-3 font-mono">false</td>
                                <td class="p-3">Jika <code>true</code>, caption juga akan dirender di bawah thumbnail pada tata letak halaman.</td>
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
