<?php

return [
    'title' => 'Chart',
    'badge' => 'Komponen',
    'group' => 'Visualisasi Data',
    'description' => 'Komponen grafik berbasis Chart.js dengan helper JS cerdas dan pemuatan on-demand via Vite (@pushOnce). Memungkinkan developer mengakses 100% fitur native Chart.js dengan konfigurasi fleksibel, integrasi otomatis warna app.css, dukungan data dari Database / Eloquent, serta reaktif terhadap tema Light/Dark.',

    // Section 1: Cara Penggunaan (Basic Usage)
    'usage' => [
        'title' => 'Cara Penggunaan',
        'desc' => 'Pelajari panduan lengkap mengimplementasikan komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:chart&gt;</code>, mulai dari sintaks dasar pemanggilan, alur pengiriman data dari Controller, struktur konfigurasi array, hingga integrasi warna tema dan reaktivitas tema Dark Mode.',
        'preview_title' => 'Contoh Dasar Komponen Chart',
        'features' => [
            'vite_title' => 'On-Demand Vite Bundle',
            'vite_desc' => 'Chart.js hanya dimuat otomatis saat komponen dipanggil via <code class="font-mono text-[11px] text-foreground">@pushOnce</code>. Tidak membebani halaman lain.',
            'colors_title' => 'Sistem Warna app.css',
            'colors_desc' => 'Mendukung token warna semantik (<code class="font-mono text-[11px] text-foreground">destructive/20</code>, <code class="font-mono text-[11px] text-foreground">chart-1</code>) dengan reaktivitas Dark Mode otomatis.',
            'native_title' => '100% Fitur Native Chart.js',
            'native_desc' => 'Bebas mengatur skala, dual axis, plugins kustom, animasi, dan format callback tanpa batasan wrapper.',
        ],
        'steps' => [
            'step1_title' => '1. Sintaks Pemanggilan Komponen',
            'step1_desc' => 'Panggil tag <code class="font-mono text-xs text-foreground">&lt;vibe:chart&gt;</code> dengan prop <code class="font-mono text-xs text-foreground">:config</code> dan <code class="font-mono text-xs text-foreground">:height</code>. Komponen otomatis memuat dependensi Chart.js secara on-demand via Vite tanpa perlu script tag manual.',
            'step2_title' => '2. Penyiapan Data dari Controller (Database / Eloquent)',
            'step2_desc' => 'Ambil data dinamis langsung dari database menggunakan Eloquent Model, petakan kolom tabel menggunakan metode <code class="font-mono text-xs text-foreground">pluck()</code> ke dalam konfigurasi chart, lalu oper variabel tersebut ke view Blade.',
            'step3_title' => '3. Pembungkusan dalam Vibe Card',
            'step3_desc' => 'Untuk antarmuka dashboard yang rapi dan konsisten, bungkus komponen chart di dalam <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code> bersama elemen header, title, dan description.',
            'step4_title' => '4. Sistem Warna Tema & Opasitas Slash',
            'step4_desc' => 'Gunakan token semantik seperti <code class="font-mono text-xs text-foreground">primary</code>, <code class="font-mono text-xs text-foreground">destructive/20</code>, atau <code class="font-mono text-xs text-foreground">chart-1</code> s/d <code class="font-mono text-xs text-foreground">chart-5</code> dari <code class="font-mono text-xs text-foreground">app.css</code>. Helper JS otomatis memperbarui warna saat tema berganti antara Light dan Dark mode.',
        ],
        'demo' => [
            'card_title' => 'Status Tiket Bantuan',
            'card_desc' => 'Monitoring insiden aktif per tingkat urgensi',
            'badge_text' => '119 Tiket',
            'dataset_label' => 'Jumlah Tiket Aktif',
            'labels' => ['Kritis', 'Tinggi', 'Sedang', 'Rendah'],
        ],
        'step2_demo' => [
            'card_title' => 'Judul Metrik Grafik',
            'card_desc' => 'Deskripsi atau periode data grafik',
            'example_title' => 'Contoh Struktur Card Standar',
        ],
        'color_tokens' => [
            'semantic_title' => 'Token Warna Semantik',
            'palette_title' => 'Palet Bagan Terkurasi (app.css)',
            'slash_opacity_title' => 'Sintaks Opasitas Slash Tailwind:',
            'slash_opacity_desc' => 'Tambahkan <code class="text-foreground font-mono">/persentase</code> pada token warna, misalnya <code class="text-foreground font-mono">\'destructive/20\'</code> (20% opasitas), <code class="text-foreground font-mono">\'primary/15\'</code>, atau <code class="text-foreground font-mono">\'chart-1/80\'</code>. Komponen otomatis menghitung nilai RGBA yang cocok.',
            'dark_mode_title' => 'Reaktivitas Dark Mode:',
            'dark_mode_desc' => 'Helper JS mengamati perubahan kelas tema <code class="text-foreground font-mono">.dark</code> secara otomatis. Garis grid, teks label, tooltip, dan warna grafik seketika menyesuaikan diri tanpa perlu me-reload halaman.',
        ],
        'config_anatomy' => [
            'title' => 'Ringkasan Struktur Konfigurasi <code>:config</code>:',
            'type' => 'Jenis visualisasi grafik (misal: <code>\'bar\'</code>, <code>\'line\'</code>, <code>\'doughnut\'</code>, <code>\'pie\'</code>, <code>\'radar\'</code>, <code>\'polarArea\'</code>).',
            'labels' => 'Array label string untuk sumbu horizontal (X) atau nama kategori irisan donat/pie.',
            'datasets' => 'Array berisi satu atau lebih objek series data dengan atribut seperti <code>label</code>, <code>data</code>, <code>borderColor</code>, <code>backgroundColor</code>, <code>borderWidth</code>, dan <code>borderRadius</code>.',
            'options' => 'Opsi lanjutan native Chart.js (skala <code>scales</code>, legenda <code>plugins.legend</code>, tooltip, dan animasi) yang dapat dikustomisasi secara leluasa.',
            'height' => 'Mengatur tinggi kanvas dalam pixel (misal <code>:height="240"</code>) atau string CSS (misal <code>height="300px"</code>). Lebar chart otomatis mengikuti kontainer pembungkus (100% fluid).',
        ],
    ],

    // Section: Metode Pemanggilan Chart (Methods)
    'methods' => [
        'title' => 'Metode Pemanggilan Chart',
        'badge' => '4 Metode',
        'desc' => 'Terdapat beberapa metode fleksibel untuk memanggil dan mengontrol chart di Vibe UI, mulai dari tag komponen Blade dengan konfigurasi terstruktur (<code class="font-mono text-xs text-foreground">:config</code>), properti shorthand terpisah, tag Blade dengan custom ID untuk manipulasi data real-time lewat JavaScript, hingga inisialisasi murni menggunakan canvas ID dan helper JavaScript (<code class="font-mono text-xs text-foreground">VibeChart.create</code>).',
        'card_title' => 'Uji Coba 4 Metode Pemanggilan',
        'card_desc' => 'Pilih tab di bawah untuk melihat live preview dari masing-masing metode',
        'method1_title' => 'Metode 1: :config',
        'method1_desc' => 'Objek konfigurasi tunggal terstruktur native Chart.js v4. Paling direkomendasikan.',
        'method2_title' => 'Metode 2: Shorthand',
        'method2_desc' => 'Properti terpisah (<code class="font-mono text-[10px]">type</code>, <code class="font-mono text-[10px]">:data</code>, <code class="font-mono text-[10px]">:options</code>) tanpa root array config.',
        'method3_title' => 'Metode 3: ID + JS',
        'method3_desc' => 'Tag Blade dengan custom ID untuk manipulasi data real-time via <code class="font-mono text-[10px]">Chart.getChart()</code>.',
        'method4_title' => 'Metode 4: Pure JS',
        'method4_desc' => 'Inisialisasi murni pada elemen kanvas via <code class="font-mono text-[10px]">VibeChart.create(\'#id\', config)</code>.',
        'tabs' => [
            'method1' => 'Metode 1 (:config)',
            'method2' => 'Metode 2 (Shorthand)',
            'method3' => 'Metode 3 (ID + JS)',
            'method4' => 'Metode 4 (Pure JS)',
        ],
        'banners' => [
            'method1' => 'Metode 1: Tag Blade dengan objek array terstruktur <code class="font-mono text-foreground font-semibold">:config</code>',
            'badge_recommended' => 'Rekomendasi',
            'method2' => 'Metode 2: Tag Blade dengan properti shorthand (<code class="font-mono text-foreground">type</code>, <code class="font-mono text-foreground">:data</code>, <code class="font-mono text-foreground">:options</code>)',
            'badge_shorthand' => 'Shorthand',
            'method3' => 'Metode 3: Tag Blade dengan atribut <code class="font-mono text-foreground">id="chart-monitoring-live"</code> & kontrol JavaScript',
            'btn_randomize' => 'Acak Data via JavaScript',
            'method4' => 'Metode 4: Murni elemen kanvas HTML <code class="font-mono text-foreground">#canvas-pure-js-demo</code> via <code class="font-mono text-foreground">VibeChart.create()</code>',
            'badge_js_api' => 'JavaScript API',
        ],
    ],

    // Section 2: Database & Eloquent Integration
    'database' => [
        'title' => 'Integrasi Data Database & Eloquent',
        'badge' => 'Database',
        'desc' => 'Komponen ini dapat menerima data dinamis langsung dari Model Eloquent atau Query Builder Laravel. Cukup petakan koleksi database menggunakan metode <code class="font-mono text-xs text-foreground">pluck()</code> ke dalam array <code class="font-mono text-xs text-foreground">labels</code> dan <code class="font-mono text-xs text-foreground">data</code> pada dataset.',
        'preview_title' => 'Grafik Tren dari Database (SalesMetric::all())',
        'card_title' => 'Tren Keuangan 2026 (Live Database)',
        'card_desc' => 'Data riil dari tabel database <code class="font-mono text-xs">sales_metrics</code>',
        'months_tracked' => ':count Bulan Terdata',
        'datasets' => [
            'revenue' => 'Pendapatan Kotor (Jt)',
            'profit' => 'Laba Bersih (Jt)',
        ],
    ],

    // Section 3: Bar & Column Chart
    'bar' => [
        'title' => 'Bar & Column Chart',
        'desc' => 'Grafik batang untuk membandingkan metrik antar kategori. Mendukung sudut membulat modern (<code class="font-mono text-xs text-foreground">borderRadius</code>) dan pewarnaan otomatis menggunakan token semantik <code class="font-mono text-xs text-foreground">chart-1</code> s/d <code class="font-mono text-xs text-foreground">chart-5</code> dari <code class="font-mono text-xs text-foreground">app.css</code>.',
        'preview_title' => 'Perbandingan Penjualan Kuartal per Kategori',
        'card_title' => 'Perbandingan Penjualan Kuartal',
        'card_desc' => 'Realisasi transaksi per kategori produk',
        'labels' => ['Elektronik', 'Fashion', 'Makanan', 'Kesehatan', 'Otomotif'],
        'datasets' => [
            'q1' => 'Kuartal 1',
            'q2' => 'Kuartal 2',
        ],
    ],

    // Section 4: Area & Line Chart
    'line' => [
        'title' => 'Area & Line Chart (Gradien & Kurva Halus)',
        'desc' => 'Grafik garis dan area dengan kurva spline halus (<code class="font-mono text-xs text-foreground">tension: 0.4</code>) dan isian gradien latar (<code class="font-mono text-xs text-foreground">fill: true</code>). Sangat ideal untuk data tren pendapatan dan metrik waktu.',
        'preview_title' => 'Tren Pertumbuhan Pendapatan Bulanan',
        'card_title' => 'Tren Kunjungan & Sesi Aktif',
        'card_desc' => 'Visualisasi garis kurva halus dengan isian warna',
        'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        'datasets' => [
            'visitors' => 'Pengunjung Unik',
        ],
    ],

    // Section 5: Donut & Pie Chart
    'donut' => [
        'title' => 'Donut & Pie Chart',
        'desc' => 'Grafik donat dan lingkaran untuk visualisasi proporsi distribusi data. Dilengkapi palet warna Vibe UI otomatis serta legenda interaktif yang dapat diklik untuk menyembunyikan/menampilkan seri data.',
        'preview_title' => 'Distribusi Penjualan per Kategori (Database)',
        'donut_card_title' => 'Proporsi Pendapatan (Database)',
        'donut_card_desc' => 'Data di-pluck dari SalesMetric per kategori',
        'pie_card_title' => 'Distribusi Jumlah Pesanan',
        'pie_card_desc' => 'Total pesanan per kategori produk',
    ],

    // Section 6: Mixed Chart (Multi-Type)
    'mixed' => [
        'title' => 'Mixed Chart (Gabungan Bar & Line)',
        'desc' => 'Salah satu keunggulan arsitektur Chart.js native adalah kemudahan menggabungkan tipe chart berbeda dalam satu bidang koordinat, misalnya batang untuk volume pesanan dan garis untuk rasio konversi.',
        'preview_title' => 'Kombinasi Volume Pesanan (Bar) & Rasio Konversi (Line)',
        'card_title' => 'Volume Pesanan & Rasio Konversi',
        'card_desc' => 'Kombinasi Bar dan Line dalam satu bidang koordinat',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
        'datasets' => [
            'orders' => 'Volume Pesanan',
            'conversion' => 'Rasio Konversi (%)',
        ],
    ],

    // Section 7: Sparkline
    'sparkline' => [
        'title' => 'Sparkline (Mini KPI Chart)',
        'desc' => 'Gunakan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:sparkline="true"</code> untuk menyembunyikan sumbu koordinat dan legenda, menghasilkan grafik mini yang indah untuk disematkan di dalam komponen <code class="font-mono text-xs text-foreground">&lt;vibe:card&gt;</code>.',
        'preview_title' => 'Kartu Metrik Ringkas dengan Sparkline',
        'cards' => [
            'revenue_title' => 'Total Pendapatan',
            'users_title' => 'Pengguna Baru',
            'users_val' => '1.482 Sesi',
            'bounce_title' => 'Bounce Rate',
        ],
    ],

    // Section 8: Customization - Format Currency & Scales
    'custom_scales' => [
        'title' => 'Kustomisasi: Format Rupiah & Dual Sumbu Y',
        'badge' => 'Kustomisasi',
        'desc' => 'Gunakan konfigurasi native <code class="font-mono text-xs text-foreground">scales.y.ticks</code> untuk memformat angka menjadi format mata uang Rupiah, atau gunakan dua sumbu koordinat (kiri untuk nominal uang, kanan untuk persentase).',
        'preview_title' => 'Format Mata Uang Rupiah (IDR) & Dual Axis',
        'card_title' => 'Dual Axis: Pendapatan (IDR) & Pertumbuhan (%)',
        'card_desc' => 'Sumbu kiri untuk nominal, sumbu kanan untuk persentase',
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        'datasets' => [
            'revenue' => 'Total Pendapatan (IDR)',
            'growth' => 'Pertumbuhan MoM (%)',
        ],
    ],

    // Section 9: Customization - Custom Tooltips
    'custom_tooltip' => [
        'title' => 'Kustomisasi: Custom Tooltip',
        'badge' => 'Kustomisasi',
        'desc' => 'Sesuaikan tampilan, perilaku, dan format data tooltip interaktif. Anda dapat mengaktifkan mode multi-series (<code class="font-mono text-xs text-foreground">mode: "index"</code>), menambahkan prefix/suffix mata uang (<code class="font-mono text-xs text-foreground">prefix: "Rp "</code>), mengatur callback JavaScript kustom untuk kalkulasi khusus, hingga mengkustomisasi warna dan gaya sudut membulat.',
        'preview_title' => 'Kustomisasi Tooltip dengan Format Rupiah & Mode Index',
        'features' => [
            'mode_title' => 'Mode & Interaktivitas',
            'mode_desc' => 'Aktifkan <code class="font-mono text-[10px]">mode: \'index\'</code> dan <code class="font-mono text-[10px]">intersect: false</code> untuk menampilkan tooltip seluruh series sekaligus saat kursor melayang di atas sumbu X.',
            'prefix_title' => 'Shorthand Prefix & Suffix',
            'prefix_desc' => 'Cukup sertakan <code class="font-mono text-[10px]">\'prefix\' =&gt; \'Rp \'</code> atau <code class="font-mono text-[10px]">\'suffix\' =&gt; \' Jt\'</code> di dalam konfigurasi tooltip untuk format instan tanpa kode JS tambahan.',
            'callbacks_title' => 'Kustomisasi Callbacks',
            'callbacks_desc' => 'Gunakan callback function pada <code class="font-mono text-[10px]">callbacks.label</code> atau <code class="font-mono text-[10px]">callbacks.footer</code> untuk kalkulasi dinamis seperti total akumulasi seluruh series.',
        ],
        'card_title' => 'Analisis Omzet & Laba Bersih',
        'card_desc' => 'Arahkan kursor ke grafik untuk melihat tooltip gabungan berformat mata uang',
        'badge_hover' => 'Multi-series Hover',
        'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
        'datasets' => [
            'revenue' => 'Omzet Penjualan',
            'profit' => 'Laba Bersih',
        ],
    ],

    // Section 10: Customization - Zoom, Pan & Drag Selection
    'zoom_pan' => [
        'title' => 'Kustomisasi: Zoom, Pan & Drag Selection',
        'badge' => 'Interaktivitas',
        'desc' => 'Dukungan interaktivitas tingkat lanjut untuk eksplorasi data mendalam. Pengguna dapat memperbesar/memperkecil grafik menggunakan scroll mouse (<code class="font-mono text-xs text-foreground">wheel</code>), gestur cubit (<code class="font-mono text-xs text-foreground">pinch</code>), menggeser koordinat (<code class="font-mono text-xs text-foreground">pan/drag</code>), melakukan seleksi kotak area tertentu (<code class="font-mono text-xs text-foreground">drag-to-zoom</code>), serta menggunakan tombol kontrol zoom programatik.',
        'preview_title' => 'Eksplorasi Data Interaktif: Zoom In/Out, Pan & Seleksi Area Kotak',
        'features' => [
            'wheel_title' => 'Wheel Zoom (Mouse)',
            'wheel_desc' => 'Putar roda scroll mouse ke atas atau ke bawah di atas area grafik untuk memperbesar (zoom in) dan memperkecil (zoom out) rentang data secara mulus.',
            'pinch_title' => 'Pinch Zoom (Touch)',
            'pinch_desc' => 'Mendukung gestur cubit multi-touch pada layar sentuh smartphone atau tablet untuk navigasi rentang data yang intuitif dan responsif.',
            'pan_title' => 'Pan / Drag Sumbu',
            'pan_desc' => 'Klik dan tahan tombol mouse (atau geser jari pada mobile) untuk menggeser grafik ke kiri dan ke kanan guna mengeksplorasi riwayat data.',
            'drag_title' => 'Drag-to-Zoom (Select)',
            'drag_desc' => 'Tarik kursor membentuk kotak seleksi pada area data tertentu untuk langsung memperbesar rentang waktu yang disorot dengan akurat.',
        ],
        'card_title' => 'Metrik Trafik & Beban Server (30 Hari)',
        'card_desc' => 'Gunakan scroll mouse untuk zoom, drag mouse untuk geser, atau gunakan toolbar interaktif',
        'mode_select' => 'Mode: Kotak Seleksi',
        'mode_pan' => 'Mode: Pan/Geser',
        'zoom_in_title' => 'Perbesar (Zoom In)',
        'zoom_out_title' => 'Perkecil (Zoom Out)',
        'reset_title' => 'Reset Skala Default',
        'datasets' => [
            'traffic' => 'Kunjungan Harian (Ribu)',
            'server' => 'Beban Server (Req/s)',
        ],
    ],

    // Section 11: Customization - Direct JavaScript (VibeChart.create)
    'direct_js' => [
        'title' => 'Kustomisasi: Inisialisasi Murni via JavaScript',
        'badge' => 'JavaScript API',
        'desc' => 'Selain menggunakan tag Blade, Anda dapat memanggil helper global <code class="font-mono text-xs text-foreground">VibeChart.create(target, config)</code> langsung di dalam tag script JavaScript atau komponen Alpine.js Anda.',
        'preview_title' => 'Inisialisasi Menggunakan VibeChart.create()',
        'card_title' => 'Grafik Radar Mandiri (JavaScript Helper)',
        'card_desc' => 'Dibuat menggunakan <code class="font-mono text-xs">VibeChart.create(\'#standalone-radar-demo\', config)</code>',
        'labels' => ['Kecepatan', 'Stabilitas', 'Desain', 'Dukungan', 'Fitur', 'Keamanan'],
        'datasets' => [
            'industry_avg' => 'Rata-rata Industri',
        ],
    ],

    // Section 12: Helper JS & Token Colors
    'helper' => [
        'title' => 'Helper JS & Warna Dinamis app.css',
        'desc' => 'Helper <code class="font-mono text-xs text-foreground">VibeChart</code> otomatis menerjemahkan nama warna token seperti <code class="font-mono text-xs text-foreground">primary</code>, <code class="font-mono text-xs text-foreground">info</code>, <code class="font-mono text-xs text-foreground">chart-1/20</code> (dengan opasitas) ke nilai warna CSS aktif. Saat tema Light/Dark berganti, chart seketika diperbarui tanpa memuat ulang halaman.',
        'preview_title' => 'Kustomisasi Warna Semantik & Opasitas Slash',
    ],

    // Section 13: Props Reference Table
    'props' => [
        'title' => 'Referensi Props & Konfigurasi',
        'desc' => 'Daftar parameter yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:chart&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'config' => 'Objek konfigurasi native Chart.js lengkap (type, data, options). Mendukung seluruh opsi resmi Chart.js tanpa batasan.',
            'height' => 'Tinggi kanvas dalam pixel (angka) atau satuan CSS (string, misal <code>"240"</code> atau <code>"300px"</code>).',
            'sparkline' => 'Jika <code>true</code>, otomatis mematikan sumbu X & Y serta legenda untuk menghasilkan grafik ringkas metrik KPI.',
            'zoom' => 'Mengaktifkan interaktivitas Zoom (wheel & pinch) dan Pan (drag). Dapat diisi <code>true</code> untuk konfigurasi default atau array kustom (drag-to-zoom, mode x/y/xy).',
            'type' => 'Tipe grafik shorthand jika tidak memakai prop :config: <code>bar</code>, <code>line</code>, <code>doughnut</code>, <code>pie</code>, <code>radar</code>, dll.',
            'data' => 'Objek data shorthand yang berisi <code>labels</code> dan <code>datasets</code>.',
            'options' => 'Objek options shorthand untuk konfigurasi skala (scales), plugins, dan animasi Chart.js.',
            'tooltip' => 'Kustomisasi tooltip interaktif: <code>mode</code> ("index"/"nearest"), <code>intersect</code> (bool), <code>prefix</code> ("Rp "), <code>suffix</code> (" Jt"), <code>callbacks</code> (label/footer), dll.',
            'plugin_zoom' => 'Konfigurasi native <code>chartjs-plugin-zoom</code>: <code>pan</code> (drag mouse/mobile), <code>zoom.wheel</code> (mouse wheel), <code>zoom.pinch</code> (touch), dan <code>zoom.drag</code> (box select).',
            'api_zoom' => 'Memperbesar skala grafik secara programatik: <code>VibeChart.zoom(target, factor)</code>.',
            'api_reset' => 'Mereset skala zoom ke default: <code>VibeChart.resetZoom(target)</code>.',
            'api_pan' => 'Menggeser koordinat grafik: <code>VibeChart.pan(target, amount, mode)</code>.',
            'api_create' => 'Membuat chart mandiri pada elemen target: <code>VibeChart.create(selectorOrElement, config)</code>.',
            'api_resolve_color' => 'Helper untuk menerjemahkan token warna: <code>VibeChart.resolveColor("primary", isDark, opacity)</code>.',
        ],
    ],
];
