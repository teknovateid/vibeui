<?php

return [
    'title' => 'Select',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen pilihan interaktif (combobox) yang elegan dan kaya fitur. Dilengkapi pencarian instan, pengelompokan opsi, avatar gambar, ikon kustom, deskripsi subteks, serta paritas penuh ukuran dan varian dengan komponen Input.',

    // Section 1: Basic Usage
    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select&gt;</code> bersama <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.option&gt;</code> untuk membuat menu pilihan interaktif.',
        'preview_title' => 'Select Dasar',
        'label' => 'Peran Akun',
        'placeholder' => 'Pilih peran akun...',
    ],

    // Section 1.2: Selected Values (2 Methods)
    'selected_methods' => [
        'title' => 'Menentukan Opsi Terpilih (2 Metode: value & selected)',
        'desc' => 'Komponen Vibe UI menyediakan dua cara fleksibel untuk menentukan opsi yang aktif atau terpilih secara default, baik untuk <strong>Single Select</strong> maupun <strong>Multiple Select</strong>:<br><br>
        1. <strong>Metode 1 (Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">value</code> pada <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select&gt;</code>)</strong>: Tentukan nilai yang dipilih di tingkat komponen induk. Mendukung string tunggal (misal <code class="font-mono text-xs">value="active"</code>) maupun array nilai untuk mode multiple (misal <code class="font-mono text-xs">:value="[\'react\', \'vue\']"</code>).<br>
        2. <strong>Metode 2 (Atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">selected</code> pada <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.option&gt;</code>)</strong>: Pasang atribut boolean <code class="font-mono text-xs">selected</code> atau ekspresi <code class="font-mono text-xs">:selected="..."</code> langsung pada tag opsi. Pada mode multiple, Anda cukup menambahkan <code class="font-mono text-xs">selected</code> pada lebih dari satu opsi sekaligus.',
        'preview_title' => 'Perbandingan 2 Metode Opsi Terpilih',
        'single_tab' => 'Pilihan Tunggal (Single Select)',
        'multi_tab' => 'Pilihan Ganda (Multiple Select)',
        'method1_title' => 'Metode 1: Menggunakan Prop value di <vibe:select>',
        'method1_label' => 'Status Akun (via prop value)',
        'method1_placeholder' => 'Pilih status...',
        'method2_title' => 'Metode 2: Menggunakan Atribut selected di <vibe:select.option>',
        'method2_label' => 'Departemen (via option selected)',
        'method2_placeholder' => 'Pilih departemen...',
        'multi_method1_title' => 'Metode 1: Array :value="[\'...\']"',
        'multi_method1_label' => 'Teknologi Frontend (via prop value)',
        'multi_method1_placeholder' => 'Pilih teknologi...',
        'multi_method2_title' => 'Metode 2: Multiple <option selected>',
        'multi_method2_label' => 'Keahlian Backend (via option selected)',
        'multi_method2_placeholder' => 'Pilih keahlian...',
    ],

    // Section 1.5: Label, Description & Info
    'label_info' => [
        'title' => 'Label, Deskripsi & Info',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> untuk menambahkan teks keterangan di bawah label, dan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> untuk teks bantuan di bawah komponen select.',
        'preview_title' => 'Label, Deskripsi & Info Bantuan',
        'plan_label' => 'Paket Berlangganan',
        'plan_desc' => 'Pilih paket yang sesuai kebutuhan tim Anda.',
        'plan_placeholder' => 'Pilih paket...',
        'tz_label' => 'Zona Waktu',
        'tz_info' => 'Waktu ditampilkan sesuai zona waktu yang dipilih.',
        'tz_placeholder' => 'Pilih zona waktu...',
    ],

    // Section 2: Searchable
    'searchable' => [
        'title' => 'Pencarian Real-Time (Searchable)',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">searchable</code> untuk memunculkan kotak pencarian instan di bagian atas popover dropdown.',
        'preview_title' => 'Select dengan Fitur Pencarian',
        'label' => 'Negara Domisili',
        'placeholder' => 'Cari dan pilih negara...',
        'search_placeholder' => 'Ketik nama negara...',
    ],

    // Section 3: Option Groups
    'groups' => [
        'title' => 'Pengelompokan Opsi (Option Groups)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.group label="..."&gt;</code> untuk memisahkan opsi ke dalam beberapa kategori. Header grup otomatis tersembunyi jika hasil pencarian tidak mencocokkan kategori tersebut.',
        'preview_title' => 'Select dengan Pengelompokan Kategori',
        'label' => 'Keahlian Utama',
        'placeholder' => 'Pilih keahlian...',
    ],

    // Section 4: Avatars & Icons
    'avatars_icons' => [
        'title' => 'Opsi Kaya (Avatar & Ikon)',
        'desc' => 'Setiap opsi dapat diperkaya dengan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">avatar="url"</code> untuk foto profil/gambar, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon="svg"</code> untuk ikon, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description="..."</code> untuk subteks penjelasan.',
        'preview_title' => 'Select dengan Avatar & Deskripsi',
        'label' => 'Pilih Penanggung Jawab',
        'placeholder' => 'Pilih staf penanggung jawab...',
    ],

    // Section 5: Variants
    'variants' => [
        'title' => 'Varian Tampilan',
        'desc' => 'Memiliki 5 varian tampilan yang persis sama dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code>.',
        'preview_title' => 'Varian Tampilan Select',
    ],

    // Section 6: Sizes
    'sizes' => [
        'title' => 'Skala Ukuran',
        'desc' => 'Tersedia 4 pilihan ukuran: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, bawaan), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',
        'preview_title' => 'Skala Ukuran Select',
    ],

    // Section 7: States
    'states' => [
        'title' => 'Status & Validasi',
        'desc' => 'Dukungan status <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> pada seluruh select maupun pada opsi tertentu, serta penanda <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">required</code> dan pesan validasi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',
        'preview_title' => 'Status dan Validasi',
        'disabled_label' => 'Wilayah Server (Terkunci)',
        'disabled_placeholder' => 'Pilihan dinonaktifkan...',
        'error_label' => 'Kategori Layanan',
        'error_msg' => 'Kategori layanan wajib dipilih.',
    ],

    // Section 8: Keyboard Navigation
    'keyboard' => [
        'title' => 'Navigasi Keyboard',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keyboard</code> (atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:keyboard="true"</code>) untuk mengaktifkan navigasi menggunakan tombol panah atas/bawah, Enter, Space, dan Escape seperti pada komponen dropdown.',
        'preview_title' => 'Select dengan Navigasi Keyboard',
        'label' => 'Navigasi Keyboard',
        'placeholder' => 'Gunakan tombol panah keyboard...',
    ],

    // Section 9: Multiple Select & Limits
    'multiple' => [
        'title' => 'Pilihan Ganda & Batasan (Multiple, Min & Max)',
        'desc' => 'Tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">multiple</code> untuk memilih lebih dari 1 opsi sekaligus. Item yang terpilih akan otomatis ditampilkan dalam bentuk chip/badge elegan yang dapat dihapus individual. Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:min="n"</code> untuk menentukan batas minimum pilihan dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:max="n"</code> untuk membatasi jumlah maksimum opsi yang dapat dipilih.',
        'preview_title' => 'Pilihan Ganda (Multi-Select)',
        'basic_title' => 'Pilihan Ganda Dasar',
        'basic_label' => 'Keahlian Teknis',
        'basic_placeholder' => 'Pilih beberapa keahlian...',
        'searchable_title' => 'Pilihan Ganda dengan Fitur Pencarian',
        'searchable_label' => 'Framework & Teknologi',
        'searchable_placeholder' => 'Cari dan pilih framework...',
        'limits_title' => 'Batasan Jumlah Pilihan (Min & Max)',
        'limits_label' => 'Topik Minat (Minimal 2, Maksimal 4)',
        'limits_placeholder' => 'Pilih 2 hingga 4 topik...',
        'limits_info' => 'Item tidak bisa dihapus jika sudah mencapai batas minimal 2, dan opsi lain terkunci saat mencapai maksimal 4.',
    ],

    // Props table
    'props' => [
        'title' => 'Properti Komponen',
        'select_title' => 'Props <vibe:select>',
        'group_title' => 'Props <vibe:select.group>',
        'option_title' => 'Props <vibe:select.option>',
        'col_prop' => 'Properti',
        'col_type' => 'Tipe Data',
        'col_default' => 'Nilai Default',
        'col_desc' => 'Deskripsi',
    ],

    'demo_options' => [
        'sm' => 'Pilihan Kecil',
        'md' => 'Pilihan Sedang',
        'lg' => 'Pilihan Besar',
        'xl' => 'Pilihan Ekstra',
        'server_label' => 'Alokasi Server',
        'server_placeholder' => 'Pilih server...',
        'no_limits_badge' => 'Tanpa Batasan (Bebas Pilih/Kosong)',
    ],

    'test' => [
        'title' => 'Pengujian Form ($request->all())',
        'badge' => 'Live Controller Test',
        'desc' => 'Uji coba pengiriman nilai komponen select (single select, searchable, dan multi-select) langsung ke <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">FormController@store</code>. Saat disubmit, modal otomatis muncul menampilkan hasil <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code>.',
        'preview_title' => 'Form Testing Sandbox',
        'card_title' => 'Penugasan Peran & Keahlian Tim',
        'card_desc' => 'Uji coba pengiriman nilai select single, searchable, dan multi-select ke backend controller.',
        'role_label' => 'Pilihan Role Pengguna',
        'role_placeholder' => 'Pilih Role...',
        'role_superadmin' => 'Super Administrator',
        'role_editor' => 'Lead Content Editor',
        'role_developer' => 'Full-stack Developer',
        'dept_label' => 'Departemen Perusahaan',
        'dept_placeholder' => 'Cari Departemen...',
        'dept_engineering' => 'Teknologi & Engineering',
        'dept_design' => 'UI/UX & Product Design',
        'dept_marketing' => 'Digital Marketing',
        'dept_finance' => 'Keuangan & Akuntansi',
        'frameworks_label' => 'Keahlian Framework (Multiple)',
        'frameworks_placeholder' => 'Pilih Framework...',
        'submit_btn' => 'Kirim Form & Uji $request->all()',
    ],

    'props_items' => [
        'label' => 'Label teks di atas komponen select.',
        'name' => 'Nama input untuk formulir standar atau form submission.',
        'id' => 'Atribut ID unik elemen select.',
        'placeholder' => 'Teks placeholder saat belum ada item yang dipilih.',
        'size' => 'Ukuran komponen: "sm", "md", "lg", atau "xl".',
        'variant' => 'Varian gaya visual komponen select.',
        'disabled' => 'Menonaktifkan komponen select sehingga tidak dapat diinteraksi.',
        'readonly' => 'Mode hanya-baca, input tidak dapat diubah.',
        'multiple' => 'Mengaktifkan mode pemilihan banyak item sekaligus (Multi-Select).',
        'searchable' => 'Menampilkan kolom filter/pencarian real-time di dalam dropdown popover.',
        'clearable' => 'Menampilkan tombol silang untuk menghapus seluruh opsi terpilih secara instan.',
        'keyboard' => 'Mengaktifkan kontrol navigasi keyboard penuh (panah atas/bawah, Enter, Escape).',
        'max' => 'Batas jumlah maksimal opsi yang dapat dipilih (khusus mode multiple).',
        'min' => 'Batas jumlah minimal opsi yang wajib dipertahankan (khusus mode multiple).',
        'indicator' => 'Menampilkan ikon panah/chevron indikator dropdown.',
        'description' => 'Teks bantuan kecil di bawah label.',
        'info' => 'Pesan catatan informatif di bagian bawah select.',
        'error' => 'Pesan error khusus atau status boolean validasi.',
        'errorName' => 'Nama kunci validasi Laravel alternatif jika berbeda dari atribut name.',
        'wrapperClass' => 'Kelas CSS tambahan yang disematkan pada elemen container pembungkus.',
        'badgeVariant' => 'Varian warna lencana pill badge terpilih pada mode multiple.',
        'required' => 'Menandai input wajib diisi.',
        'group_label' => 'Label teks judul header grup opsi.',
        'group_disabled' => 'Menonaktifkan seluruh opsi di dalam grup secara serentak.',
        'option_value' => 'Nilai sesungguhnya (value) yang dikirimkan saat formulir disubmit.',
        'option_disabled' => 'Menonaktifkan opsi individual agar tidak dapat dipilih pengguna.',
        'option_selected' => 'Menandai opsi ini otomatis terpilih saat pertama kali dimuat.',
    ],

    // Section 10: Remote API Select
    'remote' => [
        'title' => 'Select Berbasis API (<vibe:select.remote>)',
        'desc' => 'Gunakan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.remote&gt;</code> untuk mengambil dan menyaring opsi langsung dari endpoint backend secara asinkron (Ajax/Fetch). Komponen ini dilengkapi dengan fitur pencarian debounced, pembatalan request (AbortController), pemuatan otomatis, rendering avatar & deskripsi langsung dari respons JSON, serta mode edit dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:initial-label</code>.',
        'basic_title' => 'Pencarian Pengguna dari API Controller',
        'basic_label' => 'Pilih Pengguna dari API',
        'basic_placeholder' => 'Cari nama atau email pengguna...',
        'edit_title' => 'Mode Edit Form (Nilai & Label Awal)',
        'edit_label' => 'Penanggung Jawab Proyek (Data Tersimpan)',
        'multiple_title' => 'Pilihan Ganda Berbasis API (Multi-Select Remote)',
        'multiple_label' => 'Anggota Tim Terpilih',
        'multiple_placeholder' => 'Cari dan tambahkan anggota...',
        'edit_multiple_title' => 'Mode Edit Pilihan Ganda (Multi-Select Remote Terpilih)',
        'edit_multiple_desc' => 'Untuk mengisi data awal yang sudah tersimpan pada formulir edit (misal relasi Many-to-Many pada Eloquent), cukup gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:value</code>. Komponen mendukung array objek/koleksi lengkap (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:value="$collaborators"</code>) maupun array ID biasa (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:value="[\'13\', \'24\']"</code>) bersama <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:initial-label="[\'Alanna\', \'Corene\']"</code>.',
        'edit_multiple_label' => 'Kolaborator Proyek (Data Tersimpan)',
        'props_title' => 'Props <vibe:select.remote>',
        'backend_title' => 'Implementasi Backend Controller & Endpoint API',
        'backend_desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:select.remote&gt;</code> mengirimkan HTTP GET request ke URL <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:api</code> dengan parameter query pencarian (default: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">?q=keyword</code>). Backend harus mengembalikan respons array JSON.',
        'route_title' => '1. Pendaftaran Route Laravel',
        'controller_title' => '2. Fungsi Controller Backend (SelectController@api)',
        'controller_desc' => 'Contoh implementasi controller yang melakukan filter query pencarian pada database pengguna dan memformat koleksi menjadi array JSON yang kompatibel:',
        'schema_title' => '3. Struktur Skema Respons JSON',
        'schema_desc' => 'Endpoint API harus mengembalikan array JSON dengan objek-objek opsi yang memiliki kunci berikut:',
        'schema_value' => 'ID atau nilai unik opsi yang dikirimkan saat form disubmit (wajib).',
        'schema_label' => 'Teks judul utama opsi yang ditampilkan di dalam dropdown dan tombol pemicu (wajib).',
        'schema_description' => 'Teks deskripsi keterangan kecil di bawah label. Jika null atau tidak dikirim, otomatis tidak ditampilkan tanpa menyisakan ruang kosong (opsional).',
        'schema_icon' => 'URL gambar avatar (JPG/PNG/WebP), markup SVG murni (&lt;svg...&gt;), atau inisial teks lingkaran. Otomatis disembunyikan jika tidak ada (opsional).',
        'schema_disabled' => 'Boolean bernilai true jika opsi ini ingin dikunci agar tidak dapat dipilih pengguna (opsional).',
        'advanced_title' => 'Konfigurasi Pencarian Lanjutan (Props Tambahan)',
        'advanced_desc' => 'Anda dapat menyesuaikan nama query parameter, batas minimum karakter sebelum fetch, waktu tunda debounce, serta HTTP headers tambahan untuk autentikasi API:',
    ],
];
