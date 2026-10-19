<?php

return [
    'title' => 'Input Number',
    'badge' => 'Komponen Form',
    'group' => 'Form & Input',
    'sub_badge' => 'Thousand Separator & Numeric Formatting',
    'description' => 'Komponen input numerik serbaguna dengan pemisah ribuan otomatis (thousand separator) tanpa prefix mata uang. Secara default mengirimkan angka bersih murni (1500000) ke backend, serta dilengkapi opsi keep-format untuk mempertahankan titik dan koma, dukungan satuan suffix, batasan min/max, dan tombol stepper.',

    'breadcrumbs' => [
        'home' => 'Home',
        'docs' => 'Docs',
        'input' => 'Input',
        'input_number' => 'Input Number',
    ],

    // Section 1: Penggunaan Dasar
    'basic_usage' => [
        'title' => '1. Penggunaan Dasar (Format Ribuan)',
        'desc' => 'Secara bawaan, komponen langsung memformat angka dengan pemisah ribuan titik (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.</code>) tanpa prefix mata uang:',
        'preview_title' => 'Input Angka Ribuan Dasar',
        'label' => 'Jumlah Pengunjung',
        'placeholder' => '0',
    ],

    // Section 2: Data Posting (Clean vs Formatted)
    'data_posting' => [
        'title' => '2. Kontrol Pengiriman Data (Bersih vs Berformat)',
        'desc' => 'Secara default (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">raw=true</code>), data yang dikirimkan ke controller/database saat form di-submit adalah <strong>angka numerik murni tanpa titik maupun koma</strong> (misal <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">1500000</code>). Pasang prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">keep-format</code> (atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:raw="false"</code>) jika Anda ingin mengirim string berformat lengkap dengan pemisahnya (misal <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">1.500.000</code>):',
        'preview_title' => 'Perbandingan Pengiriman Data Form POST',
        'clean_card_title' => 'Default: Data Bersih',
        'clean_label' => 'Stok Barang',
        'clean_hint' => 'Nilai terkirim ke server:',
        'formatted_card_title' => 'keep-format: Data Berformat',
        'formatted_label' => 'Stok Laporan',
        'formatted_hint' => 'Nilai terkirim ke server:',
    ],

    // Section 3: Satuan Unit (Suffix)
    'suffix' => [
        'title' => '3. Satuan Unit (Suffix)',
        'desc' => 'Tambahkan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code> untuk menampilkan satuan unit di sisi kanan input seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">kg</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">pcs</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">cm</code>, atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">%</code>:',
        'preview_title' => 'Input Angka dengan Satuan Suffix',
        'weight_label' => 'Berat Barang',
        'quantity_label' => 'Jumlah Unit',
        'discount_label' => 'Persentase Diskon',
    ],

    // Section 4: Desimal & Presisi
    'precision' => [
        'title' => '4. Nilai Desimal & Presisi',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">precision="2"</code> untuk mendukung angka desimal di belakang koma:',
        'preview_title' => 'Input Angka Desimal',
        'volume_label' => 'Volume Cairan',
        'volume_placeholder' => '0,00',
    ],

    // Section 5: Stepper Mini
    'stepper' => [
        'title' => '5. Tombol Stepper Mini (+/-) & Batasan Min/Max',
        'desc' => 'Aktifkan tombol naik/turun mini di sisi kanan dengan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">stepper</code>, dan batasi rentang angka dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">min</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">max</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">step</code>, serta <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">clamp</code>:',
        'preview_title' => 'Stepper Mini dengan Batasan Min/Max',
        'box_label' => 'Jumlah Kotak (Min 1, Max 50, Step 5)',
    ],

    // Section 6: Controller Test
    'controller_test' => [
        'title' => '6. Pengujian Form Submit ke Controller',
        'desc' => 'Kirim data form di bawah ini ke controller untuk membuktikan secara langsung bagaimana nilai <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$request->all()</code> diterima di sisi server (bersih vs berformat):',
        'preview_title' => 'Pengujian Form Submit ke Controller',
        'card_title' => 'Pengujian Form Input Number',
        'card_desc' => 'Kirim data ke controller dan lihat hasil tangkapan $request->all() di modal.',
        'clean_label' => 'Stok Barang (Default: Data Bersih)',
        'formatted_label' => 'Angka Laporan (keep-format: Membawa Titik & Koma)',
        'order_label' => 'Kuantitas Order (Stepper Min 1, Max 100, Step 5)',
        'submit_btn' => 'Kirim Form & Uji $request->all()',
    ],

    // Section 7: Props Reference
    'props_table' => [
        'title' => '7. Referensi Props & Atribut',
        'desc' => 'Daftar lengkap atribut dan prop yang didukung oleh komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input.number&gt;</code>:',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'name' => 'Nama input untuk form submission dan model binding.',
            'value' => 'Nilai awal input numerik.',
            'raw' => 'Jika true, mengirimkan angka numerik bersih tanpa titik/koma ke backend.',
            'keepFormat' => 'Alias untuk raw=false. Jika aktif, mengirimkan string berformat lengkap ke backend.',
            'prefix' => 'Teks atau simbol awalan di sisi kiri (default null, tanpa prefix Rp).',
            'suffix' => 'Teks satuan di sisi kanan (misal "kg", "pcs", "%").',
            'thousandSeparator' => 'Karakter pemisah ribuan.',
            'decimalSeparator' => 'Karakter pemisah desimal.',
            'precision' => 'Jumlah digit angka di belakang koma (0 = integer).',
            'integer' => 'Paksa nilai bulat tanpa pecahan.',
            'round' => 'Bulatkan nilai ke integer terdekat jika terdapat pecahan.',
            'allowNegative' => 'Izinkan nilai negatif (tanda minus).',
            'min' => 'Batas nilai minimum.',
            'max' => 'Batas nilai maksimum.',
            'step' => 'Besaran nilai pertambahan/pengurangan stepper atau keyboard arrow.',
            'clamp' => 'Otomatis sesuaikan angka ke batas min/max saat blur.',
            'stepper' => 'Tampilkan tombol naik/turun mini di sisi kanan input.',
            'keyboard' => 'Dukung penekanan tombol panah atas/bawah pada keyboard.',
            'size' => 'Skala ukuran tinggi dan teks input.',
            'variant' => 'Variasi gaya visual border dan latar.',
            'disabled' => 'Menonaktifkan interaksi input.',
            'readonly' => 'Input hanya dapat dibaca.',
        ],
    ],
];
