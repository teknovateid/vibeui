<?php

return [
    'title' => 'DataTable',
    'badge' => 'Komponen Enterprise',
    'group' => 'Komponen UI',
    'description' => 'Tabel data server-side berperforma tinggi bertenaga Rappasoft yang didesain ulang sepenuhnya menggunakan token tema Vibe UI. Dilengkapi pencarian debounced, sorting multi-kolom, seleksi visibilitas kolom, aksi massal (bulk actions), filter per-kolom, baris footer agregasi, mode bergaris (bordered), dan navigasi paginasi elegan.',

    'common' => [
        'preview_component' => 'Komponen Preview',
        'livewire_component' => 'Komponen Livewire',
        'home' => 'Beranda',
        'docs' => 'Dokumentasi',
    ],

    'code' => [
        'blade_call_1' => 'Cara 1: Menggunakan Tag Helper Vibe UI (Direkomendasikan)',
        'blade_call_2' => 'Atau menggunakan alias Livewire kebab-case',
        'blade_call_3' => 'Cara 2: Menggunakan Tag Livewire Asli',
        'blade_call_4' => 'Cara 3: Menggunakan Direktif Blade Klasik',
        'prop_forwarding_1' => 'Forwarding parameter id dan status ke komponen Livewire',
        'prop_forwarding_2' => 'Menambahkan class styling wrapper kustom',
        'bordered_1' => 'Cara 1: Menggunakan Class Utility (Sangat Praktis & Bersih)',
        'bordered_2' => 'Cara 2: Menggunakan Atribut Boolean "bordered"',
        'bordered_3' => 'Cara 3: Menggunakan Komponen dengan Konfigurasi PHP Class',
        'comment_bordered_enabled' => 'Mengaktifkan border penuh pada setiap baris & kolom',
        'comment_default_sort' => 'Urutan bawaan',
        'comment_export_csv' => 'Ekspor data terpilih ke file CSV',
        'comment_delete_selected' => 'Hapus data terpilih',
        'comment_clear_selected' => 'Bersihkan pilihan setelah aksi selesai',
        'comment_secondary_header' => 'Mengaktifkan baris header sekunder untuk pencarian per kolom',
        'comment_footer_status' => 'Mengaktifkan baris footer tabel',
        'comment_header_as_footer' => 'Menampilkan baris judul kolom juga sebagai footer di bagian bawah tabel',
        'comment_large_dataset' => 'Menetapkan pilihan data per halaman hingga 250 baris dengan default 50 baris',
        'placeholder_id' => 'ID...',
        'placeholder_name' => 'Cari nama...',
        'placeholder_email' => 'Cari email...',
        'filter_all_domains' => 'Semua Domain',
        'blade_call_lazy' => 'Cara 1: Menggunakan Tag Helper dengan Atribut Boolean "lazy"',
        'blade_call_binding' => 'Cara 2: Menggunakan Dynamic Boolean Binding (:lazy)',
        'blade_call_native_lazy' => 'Cara 3: Menggunakan Tag Asli Livewire dengan Atribut lazy',
        'comment_placeholder' => 'Tampilan placeholder loading kustom sebelum tabel masuk ke viewport',
        'loading_text' => 'Memuat data tabel...',
    ],

    'how_to_call' => [
        'title' => 'Cara Memanggil DataTable',
        'desc' => 'Komponen DataTable di Vibe UI berbasis Livewire, sehingga Anda memiliki berbagai cara fleksibel untuk memanggil dan merendernya di dalam file Blade view aplikasi Anda:',
        'vibe_tag' => [
            'title' => 'Menggunakan Tag Helper <vibe:datatable>',
            'desc' => 'Cara paling bersih dan direkomendasikan di ekosistem Vibe UI. Menerima nama class FQCN (Fully Qualified Class Name) secara langsung atau string alias Livewire:',
        ],
        'livewire_tag' => [
            'title' => 'Menggunakan Tag Asli <livewire:...>',
            'desc' => 'Jika Anda lebih menyukai sintaks tag bawaan Livewire, Anda tetap dapat memanggilnya langsung menggunakan nama alias kebab-case komponen:',
        ],
        'blade_directive' => [
            'title' => 'Menggunakan Direktif @livewire',
            'desc' => 'Sintaks klasik Blade helper `@livewire(...)` juga didukung penuh untuk memanggil class maupun alias:',
        ],
        'prop_forwarding' => [
            'title' => 'Meneruskan Properti & Parameter (Prop Forwarding)',
            'desc' => 'Semua atribut tambahan yang Anda sematkan pada tag `<vibe:datatable>` akan otomatis diteruskan (forwarded) ke komponen Livewire di dalamnya:',
        ],
    ],

    'basic_usage' => [
        'title' => 'Basic Usage',
        'desc' => 'Contoh implementasi dasar DataTable dengan mewarisi <code class="font-mono text-xs">VibeDataTableComponent</code>. Mendukung pengurutan kolom klik header dan pencarian debounced live secara otomatis.',
        'preview_title' => 'Preview: Basic DataTable',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap menggunakan <code class="font-mono text-xs">parent::configure()</code> dan pendefinisian query model via <code class="font-mono text-xs">builder()</code>.',
    ],

    'bordered' => [
        'title' => 'Bordered Table',
        'desc' => 'Menampilkan garis batas pembatas (borders) vertikal dan horizontal pada setiap sel header (<code class="font-mono text-xs">&lt;th&gt;</code>) dan data (<code class="font-mono text-xs">&lt;td&gt;</code>). Dapat diaktifkan secara instan cukup dengan menambahkan <code class="font-mono text-xs">class="border"</code> atau atribut <code class="font-mono text-xs">bordered</code> pada tag Blade, maupun melalui method <code class="font-mono text-xs">$this-&gt;setBorderedEnabled()</code> di PHP class.',
        'preview_title' => 'Preview: Bordered DataTable',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap menggunakan method <code class="font-mono text-xs">setBorderedEnabled()</code> atau <code class="font-mono text-xs">setBorderedStatus(true)</code> di dalam <code class="font-mono text-xs">configure()</code>.',
    ],

    'columns' => [
        'title' => 'Kustomisasi Kolom & Tombol Aksi',
        'desc' => 'Menampilkan data terformat (seperti badge avatar atau tanggal) dan tombol aksi (Edit, Hapus) pada setiap baris data menggunakan method <code class="font-mono text-xs">format()</code> dan <code class="font-mono text-xs">html()</code>.',
        'preview_title' => 'Preview: Kolom Kustom & Tombol Aksi',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap dengan kolom badge kustom dan tombol aksi baris menggunakan <code class="font-mono text-xs">&lt;vibe:button&gt;</code>.',
    ],

    'bulk_actions' => [
        'title' => 'Aksi Massal (Bulk Actions)',
        'desc' => 'Memungkinkan pengguna memilih beberapa atau seluruh baris data menggunakan checkbox, lalu mengeksekusi aksi massal seperti ekspor CSV atau hapus data secara serentak.',
        'preview_title' => 'Preview: Aksi Massal (Bulk Actions)',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap dengan pendefinisian <code class="font-mono text-xs">setBulkActions()</code> dan method handler aksi massal.',
    ],

    'column_search' => [
        'title' => 'Pencarian di Setiap Kolom',
        'desc' => 'Memasang input pencarian langsung di bawah judul masing-masing kolom menggunakan fitur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">secondaryHeader</code>, memungkinkan pengguna memfilter baris berdasarkan kolom ID, nama, atau email secara independen.',
        'preview_title' => 'Preview: Pencarian di Setiap Kolom',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP lengkap dengan public properties terikat, pengaktifan <code class="font-mono text-xs">setSecondaryHeaderStatus(true)</code>, dan query bersyarat <code class="font-mono text-xs">when()</code>.',
    ],

    'footer_column_search' => [
        'title' => 'Pencarian di Setiap Kolom (Footer)',
        'desc' => 'Menempatkan input pencarian per kolom di bagian bawah tabel (<code class="font-mono text-xs">&lt;tfoot&gt;</code>) alih-alih di bawah header. Cocok untuk tabel dengan data banyak di mana pengguna ingin menyaring data dari dasar tabel menggunakan fitur <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">-&gt;footer(...)</code> dan <code class="font-mono text-xs">$this-&gt;setFooterStatus(true)</code>.',
        'preview_title' => 'Preview: Pencarian di Setiap Kolom (Footer)',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP lengkap dengan pemanggilan <code class="font-mono text-xs">setFooterStatus(true)</code> di dalam <code class="font-mono text-xs">configure()</code> dan closure <code class="font-mono text-xs">-&gt;footer(...)</code> pada definisi setiap kolom.',
    ],

    'filters' => [
        'title' => 'Filter Popover Kustom',
        'desc' => 'Menambahkan tombol popover filter di toolbar atas tabel untuk memfilter data dengan dropdown kriteria tertentu (misalnya domain email atau rentang tanggal).',
        'preview_title' => 'Preview: Filter Popover Kustom',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap dengan method <code class="font-mono text-xs">filters()</code> menggunakan class <code class="font-mono text-xs">SelectFilter</code>.',
    ],

    'footer_calc' => [
        'title' => 'Footer Kolom & Kalkulasi Ringkasan',
        'desc' => 'Menampilkan baris kalkulasi ringkasan (summary / aggregate) di bagian bawah tabel (<code class="font-mono text-xs">&lt;tfoot&gt;</code>), seperti total baris, jumlah nominal, atau statistik lainnya.',
        'preview_title' => 'Preview: Footer Kolom & Kalkulasi Ringkasan',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap dengan method <code class="font-mono text-xs">setFooterStatus(true)</code> dan closure callback <code class="font-mono text-xs">footer()</code> pada kolom.',
    ],

    'header_as_footer' => [
        'title' => 'Header Sebagai Footer (Use Header as Footer)',
        'desc' => 'Menampilkan ulang judul kolom header di bagian paling bawah tabel (<code class="font-mono text-xs">&lt;tfoot&gt;</code>) dengan styling identik. Sangat berguna pada tabel data panjang agar pengguna tidak perlu menggulir kembali ke atas untuk melihat judul kolom.',
        'preview_title' => 'Preview: Header Sebagai Footer',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Cukup tambahkan <code class="font-mono text-xs">setUseHeaderAsFooterStatus(true)</code> di dalam method <code class="font-mono text-xs">configure()</code>.',
    ],

    'performance' => [
        'title' => 'Performa Dataset Besar (Large Dataset)',
        'desc' => 'Mendemonstrasikan keandalan dan kecepatan pemrosesan server-side DataTable pada ribuan data baris dengan opsi tampilan 25, 50, 100, hingga 250 data sekaligus per halaman tanpa penurunan performa.',
        'preview_title' => 'Preview: Performa Dataset Besar',
        'livewire_title' => 'Komponen Livewire',
        'livewire_desc' => 'Kode PHP class lengkap dengan opsi per-page besar (<code class="font-mono text-xs">25, 50, 100, 250</code>), default 50 data per halaman, dan pengurutan multi-kolom.',
    ],

    'lazy_loading' => [
        'title' => 'Lazy Loading (Optimasi Performa)',
        'desc' => 'Gunakan atribut <code class="font-mono text-xs">lazy</code> pada tag <code class="font-mono text-xs">&lt;vibe:datatable&gt;</code> untuk menunda pemuatan komponen Livewire dan eksekusi query database sampai tabel benar-benar terlihat di layar pengguna (Intersection Observer).',
        'preview_title' => 'Preview: Lazy Loading DataTable',
        'syntax_title' => 'Sintaks Penggunaan',
        'benefits_title' => 'Keuntungan Utama Lazy Loading',
        'card_1_title' => 'Hemat Query Database',
        'benefit_1' => 'Database tidak akan menjalankan query <code class="font-mono text-xs">COUNT(*)</code> atau <code class="font-mono text-xs">SELECT</code> sebelum tabel masuk ke viewport pengguna.',
        'card_2_title' => 'Render First Paint Cepat',
        'benefit_2' => 'Memangkas ukuran awal payload HTML dan mempercepat proses render DOM browser.',
        'card_3_title' => 'Ideal untuk Multi-Tabel',
        'benefit_3' => 'Sangat ideal untuk halaman dashboard analitik, layout bertab, atau halaman yang memuat banyak tabel.',
        'placeholder_title' => 'Kustomisasi Tampilan Placeholder Loading (Opsional)',
        'placeholder_desc' => 'Vibe UI secara bawaan sudah menyediakan skeleton loading table shimmer di dalam <code class="font-mono text-xs">VibeDataTableComponent</code> untuk mencegah layout shift (CLS). Jika ingin tampilan khusus, Anda dapat dengan mudah meng-override method <code class="font-mono text-xs">placeholder()</code> pada class DataTable Anda.',
    ],

    'api_reference' => [
        'title' => 'Referensi Lengkap API & Konfigurasi',
        'desc' => 'Daftar method konfigurasi dan properti tag yang paling sering digunakan pada komponen DataTable Vibe UI.',
        'configure_table' => [
            'title' => 'Daftar Metode configure() yang Sering Digunakan',
            'method_col' => 'Metode',
            'desc_col' => 'Penjelasan',
            'methods' => [
                'parent_configure' => 'Wajib dipanggil pertama kali untuk memuat tema dan token styling Vibe UI.',
                'set_primary_key' => 'Menentukan primary key unik model untuk seleksi baris dan identifikasi data.',
                'set_bordered_enabled' => 'Mengaktifkan garis batas pembatas (border) vertikal dan horizontal pada setiap sel tabel.',
                'set_default_sort' => 'Menetapkan kolom dan arah pengurutan bawaan saat pertama kali dimuat.',
                'set_bulk_actions' => 'Mendefinisikan aksi massal checkbox baris (seperti export CSV atau hapus terpilih).',
                'set_secondary_header_status' => 'Mengaktifkan baris header sekunder tepat di bawah judul kolom untuk input pencarian per kolom.',
                'set_footer_status' => 'Mengaktifkan baris footer di bagian bawah tabel untuk agregasi / total baris.',
                'set_use_header_as_footer_status' => 'Menjadikan dan menampilkan baris judul header kolom juga sebagai footer di bagian bawah tabel.',
                'set_search_debounce' => 'Mengatur jeda waktu (dalam milidetik) penundaan query pencarian live agar hemat server.',
                'set_per_page_accepted' => 'Daftar opsi jumlah data per halaman yang tersedia pada dropdown paginasi.',
                'set_column_select_status' => 'Mengaktifkan tombol selector untuk menyembunyikan atau menampilkan kolom secara dinamis.',
            ],
        ],
        'props_table' => [
            'title' => 'Properti Tag Helper <vibe:datatable>',
            'prop_col' => 'Properti',
            'type_col' => 'Tipe',
            'default_col' => 'Default',
            'desc_col' => 'Deskripsi',
            'props' => [
                'component' => 'Nama class FQCN (misal App\Livewire\DemoBasicTable::class) atau alias kebab-case Livewire.',
                'bordered' => 'Mengaktifkan garis batas pembatas (border) penuh di sekeliling setiap sel header dan baris data tabel langsung dari Blade.',
                'lazy' => 'Mengaktifkan pemuatan asinkron berbasis Intersection Observer. Komponen hanya akan di-render saat masuk ke dalam viewport layar pengguna.',
                'attributes' => 'Semua atribut tambahan akan otomatis diteruskan (forwarded) ke elemen kontainer pembungkus tabel.',
                'slot' => 'Konten slot opsional jika tag digunakan sebagai wrapper kontainer tabel kustom.',
            ],
        ],
    ],
];
