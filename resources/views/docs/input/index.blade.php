<x-docs.layouts.sidebar>
    <vibe:seo title="Input" description="Komponen input teks fleksibel dan elegan dengan dukungan varian ukuran, label, error state, dan integrasi Livewire." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Components', 'url' => '/docs'],
        ['name' => 'Input', 'url' => '/docs/input']
    ]" />

    <div class="mx-auto max-w-6xl space-y-12">
        <!-- Page Header -->
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-vibe-200 dark:bg-vibe-800 text-vibe-800 dark:text-vibe-200">
                    Komponen
                </span>
                <span class="text-xs text-vibe-500 dark:text-vibe-400">Form & Input</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-vibe-950 dark:text-vibe-50">
                Input
            </h1>
            <p class="text-base text-vibe-600 dark:text-vibe-400 leading-relaxed">
                Komponen input teks yang modern dan elegan dengan dukungan label otomatis, deskripsi, ukuran (<code class="font-mono text-xs text-vibe-900 dark:text-vibe-100">sm</code>, <code class="font-mono text-xs text-vibe-900 dark:text-vibe-100">md</code>, <code class="font-mono text-xs text-vibe-900 dark:text-vibe-100">lg</code>), pesan error validasi, dan kompatibilitas Livewire.
            </p>
        </div>

        <!-- Section 1: Basic Usage -->
        <section class="space-y-4">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Penggunaan Dasar
                </h2>
                <p class="text-sm text-vibe-600 dark:text-vibe-400">
                    Gunakan tag <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">&lt;vibe:input&gt;</code> untuk membuat input teks dengan label dan placeholder:
                </p>
            </div>

            @php
                $basicCode = <<<'HTML'
<div class="w-full max-w-sm">
    <vibe:input
        label="Nama Lengkap"
        placeholder="Masukkan nama lengkap Anda..."
    />
</div>
HTML;
            @endphp

            <vibe:preview title="Basic Input" :code="$basicCode" persist>
                <div class="w-full max-w-sm">
                    <vibe:input
                        label="Nama Lengkap"
                        placeholder="Masukkan nama lengkap Anda..."
                    />
                </div>
            </vibe:preview>
        </section>

        <!-- Section 2: Input Sizes -->
        <section class="space-y-4">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Varian Ukuran
                </h2>
                <p class="text-sm text-vibe-600 dark:text-vibe-400">
                    Tersedia 3 pilihan ukuran melalui prop <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">size</code> yaitu <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">sm</code>, <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">md</code>, dan <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">lg</code> (default: <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">lg</code>):
                </p>
            </div>

            @php
                $sizesCode = <<<'HTML'
<div class="w-full max-w-sm space-y-4">
    <vibe:input size="sm" label="Small (sm)" placeholder="Ukuran kecil..." />
    <vibe:input size="md" label="Medium (md)" placeholder="Ukuran sedang..." />
    <vibe:input size="lg" label="Large (lg)" placeholder="Ukuran besar..." />
</div>
HTML;
            @endphp

            <vibe:preview title="Ukuran Input" :code="$sizesCode" persist>
                <div class="w-full max-w-sm space-y-4">
                    <vibe:input size="sm" label="Small (sm)" placeholder="Ukuran kecil..." />
                    <vibe:input size="md" label="Medium (md)" placeholder="Ukuran sedang..." />
                    <vibe:input size="lg" label="Large (lg)" placeholder="Ukuran besar..." />
                </div>
            </vibe:preview>
        </section>

        <!-- Section 3: Description & Helper Info -->
        <section class="space-y-4">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Deskripsi & Bantuan
                </h2>
                <p class="text-sm text-vibe-600 dark:text-vibe-400">
                    Sertakan informasi panduan di atas atau di bawah input dengan prop <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">description</code> dan <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">info</code>:
                </p>
            </div>

            @php
                $helperCode = <<<'HTML'
<div class="w-full max-w-sm">
    <vibe:input
        label="Alamat Email"
        description="Gunakan email aktif perusahaan Anda."
        info="Kami tidak akan pernah membagikan email Anda ke pihak ketiga."
        type="email"
        placeholder="nama@perusahaan.com"
    />
</div>
HTML;
            @endphp

            <vibe:preview title="Input dengan Panduan" :code="$helperCode" persist>
                <div class="w-full max-w-sm">
                    <vibe:input
                        label="Alamat Email"
                        description="Gunakan email aktif perusahaan Anda."
                        info="Kami tidak akan pernah membagikan email Anda ke pihak ketiga."
                        type="email"
                        placeholder="nama@perusahaan.com"
                    />
                </div>
            </vibe:preview>
        </section>

        <!-- Section 4: Error States -->
        <section class="space-y-4">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Status Validasi Error
                </h2>
                <p class="text-sm text-vibe-600 dark:text-vibe-400">
                    Komponen otomatis membaca error Laravel MessageBag via <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">name</code> / <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">wire:model</code>, atau secara manual via prop <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">error</code>:
                </p>
            </div>

            @php
                $errorCode = <<<'HTML'
<div class="w-full max-w-sm">
    <vibe:input
        label="Kata Sandi"
        type="password"
        value="12345"
        error="Kata sandi harus memiliki minimal 8 karakter."
    />
</div>
HTML;
            @endphp

            <vibe:preview title="Input Error State" :code="$errorCode" persist>
                <div class="w-full max-w-sm">
                    <vibe:input
                        label="Kata Sandi"
                        type="password"
                        value="12345"
                        error="Kata sandi harus memiliki minimal 8 karakter."
                    />
                </div>
            </vibe:preview>
        </section>

        <!-- Section 5: Disabled State -->
        <section class="space-y-4">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Status Dinonaktifkan (Disabled)
                </h2>
                <p class="text-sm text-vibe-600 dark:text-vibe-400">
                    Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">disabled</code> untuk menonaktifkan interaksi pada input:
                </p>
            </div>

            @php
                $disabledCode = <<<'HTML'
<div class="w-full max-w-sm">
    <vibe:input
        label="ID Pengguna"
        value="USR-994821"
        disabled
    />
</div>
HTML;
            @endphp

            <vibe:preview title="Input Disabled" :code="$disabledCode" persist>
                <div class="w-full max-w-sm">
                    <vibe:input
                        label="ID Pengguna"
                        value="USR-994821"
                        disabled
                    />
                </div>
            </vibe:preview>
        </section>

        <!-- Section 6: Props Reference Table -->
        <section class="space-y-4">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-vibe-950 dark:text-vibe-50">
                    Daftar Props & Atribut
                </h2>
                <p class="text-sm text-vibe-600 dark:text-vibe-400">
                    Berikut daftar properti yang didukung oleh komponen <code class="px-1.5 py-0.5 rounded bg-vibe-200 dark:bg-vibe-800 text-xs font-mono text-vibe-900 dark:text-vibe-100">&lt;vibe:input&gt;</code>:
                </p>
            </div>

            <div class="overflow-x-auto rounded-xl border border-vibe-200 dark:border-vibe-800 bg-white dark:bg-vibe-950">
                <table class="w-full text-left text-xs">
                    <thead class="border-b border-vibe-200 dark:border-vibe-800 bg-vibe-100/75 dark:bg-vibe-900/60 text-vibe-900 dark:text-vibe-100 font-semibold">
                        <tr>
                            <th class="px-4 py-3">Prop</th>
                            <th class="px-4 py-3">Tipe Data</th>
                            <th class="px-4 py-3">Default</th>
                            <th class="px-4 py-3">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-vibe-200 dark:divide-vibe-800 text-vibe-700 dark:text-vibe-300">
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-vibe-900 dark:text-vibe-100">label</td>
                            <td class="px-4 py-3 font-mono text-vibe-500">string</td>
                            <td class="px-4 py-3 font-mono text-vibe-400">null</td>
                            <td class="px-4 py-3">Teks label di atas input.</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-vibe-900 dark:text-vibe-100">type</td>
                            <td class="px-4 py-3 font-mono text-vibe-500">string</td>
                            <td class="px-4 py-3 font-mono text-vibe-400">'text'</td>
                            <td class="px-4 py-3">Tipe input HTML (text, email, password, number, dll.).</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-vibe-900 dark:text-vibe-100">size</td>
                            <td class="px-4 py-3 font-mono text-vibe-500">'sm' | 'md' | 'lg'</td>
                            <td class="px-4 py-3 font-mono text-vibe-400">'lg'</td>
                            <td class="px-4 py-3">Ukuran dimensi dan teks input.</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-vibe-900 dark:text-vibe-100">description</td>
                            <td class="px-4 py-3 font-mono text-vibe-500">string</td>
                            <td class="px-4 py-3 font-mono text-vibe-400">null</td>
                            <td class="px-4 py-3">Teks bantuan kecil di bawah label.</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-vibe-900 dark:text-vibe-100">info</td>
                            <td class="px-4 py-3 font-mono text-vibe-500">string</td>
                            <td class="px-4 py-3 font-mono text-vibe-400">null</td>
                            <td class="px-4 py-3">Teks keterangan atau panduan di bawah input.</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-vibe-900 dark:text-vibe-100">error</td>
                            <td class="px-4 py-3 font-mono text-vibe-500">string</td>
                            <td class="px-4 py-3 font-mono text-vibe-400">null</td>
                            <td class="px-4 py-3">Pesan error kustom untuk memicu state validasi error.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-docs.layouts.sidebar>
