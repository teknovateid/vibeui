<?php

return [
    'title' => 'Range Slider',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen slider rentang angka (range input) yang disempurnakan dengan active filled track, indikator nilai live, kustomisasi step, serta dukungan drag dan sentuhan mobile.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:range&gt;</code> untuk memilih nilai dalam rentang angka.',
        'preview_title' => 'Slider Dasar',
        'volume_label' => 'Tingkat Volume',
        'volume_desc' => 'Atur intensitas volume audio pemutar musik.',
    ],

    'value_display' => [
        'title' => 'Indikator Nilai Live & Prefix/Suffix',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:showValue="true"</code> untuk menampilkan badge nilai live, serta <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">valuePrefix</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">valueSuffix</code>.',
        'preview_title' => 'Slider dengan Nilai Live',
        'budget_label' => 'Anggaran Bulanan',
        'zoom_label' => 'Skala Zoom',
    ],

    'steps' => [
        'title' => 'Step & Min/Max Marks',
        'desc' => 'Atur kelipatan angka dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">step</code>, serta tampilkan batas bawah/atas dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">minLabel</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">maxLabel</code>.',
        'preview_title' => 'Slider dengan Step Tertentu',
        'capacity_label' => 'Kapasitas Penyimpanan Cloud',
    ],

    'marks_continuous' => [
        'title' => 'Titik Poin dengan Nilai Fleksibel (Bisa Pilih Nilai Antara)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:marks="[2 => \'2 GB\', 4 => \'4 GB\', 6 => \'6 GB\', 8 => \'8 GB\']"</code> untuk memunculkan titik-titik patokan visual pada track dan tombol label di bawahnya, sementara pengguna <strong>tetap bebas memilih nilai di antaranya</strong> (misalnya memilih <strong>3 GB</strong> di antara 2 GB dan 4 GB).',
        'preview_title' => 'Slider RAM dengan Nilai Antara',
        'ram_label' => 'Alokasi Memori RAM Server',
        'ram_desc' => 'Titik patokan tersedia pada 2 GB, 4 GB, 6 GB, dan 8 GB. Anda tetap dapat memilih kapasitas di antaranya (seperti 3 GB atau 5 GB).',
    ],

    'checkpoints' => [
        'title' => 'Titik Checkpoint Terkunci (Strict Snap)',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:checkpoints="[\'10 GB\', \'20 GB\', \'30 GB\', \'50 GB\', \'100 GB\']"</code> atau tambahkan atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">strict</code> jika Anda ingin mengunci slider secara ketat sehingga pengguna <strong>tidak bisa memilih nilai di antara checkpoint</strong>.',
        'preview_title' => 'Paket Penyimpanan Cloud (Diskrit)',
        'storage_label' => 'Pilihan Paket Penyimpanan Cloud',
        'storage_desc' => 'Pilih paket kuota diskrit yang tersedia. Slider hanya dapat berpindah ke checkpoint.',
    ],

    'marks' => [
        'title' => 'Titik Poin Otomatis (:marks="true")',
        'desc' => 'Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">:marks="true"</code> untuk otomatis menampilkan titik-titik pembagi (tick marks) pada track berdasarkan nilai <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">step</code>.',
        'preview_title' => 'Slider dengan Tick Marks Otomatis',
        'rating_label' => 'Skala Kepuasan Layanan (1 - 5 Bintang)',
    ],

    'sizes_status' => [
        'title' => 'Ukuran, Status Disabled & Validasi Error',
        'desc' => 'Tersedia 3 pilihan ukuran (<code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code>), dukungan status native <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code>, serta penanganan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code> validasi dengan aksen warna merah pada track.',
        'preview_title' => 'Variasi Ukuran dan Status',
        'sm_label' => 'Ukuran Kecil (sm)',
        'md_label' => 'Ukuran Standar (md)',
        'lg_label' => 'Ukuran Besar (lg)',
        'disabled_label' => 'Slider Dinonaktifkan (disabled)',
        'error_label' => 'Batas Penggunaan CPU (error)',
        'error_msg' => 'Beban CPU tidak boleh melebihi ambang batas toleransi sistem (75%).',
    ],

    'props' => [
        'title' => 'Referensi Props & Atribut',
        'desc' => 'Daftar lengkap properti dan atribut konfigurasi yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:range&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'name' => 'Nama input formulir. Otomatis diekstrak dari <code>wire:model</code> jika dihilangkan.',
            'id' => 'Atribut HTML <code>id</code> unik untuk range input dan relasi <code>label</code>.',
            'label' => 'Teks label utama di atas slider.',
            'description' => 'Teks keterangan pembantu di bawah label sebelum slider input.',
            'value' => 'Nilai awal saat inisialisasi (angka numerik atau string label checkpoint).',
            'min' => 'Batas minimum slider untuk rentang numerik standar.',
            'max' => 'Batas maksimum slider untuk rentang numerik standar.',
            'step' => 'Kelipatan kenaikan pergeseran nilai slider numerik.',
            'marks' => 'Array titik pembagi visual (misal <code>[2 => \'2 GB\', 4 => \'4 GB\']</code>) atau boolean <code>true</code> untuk pembagian otomatis. Memungkinkan pemilihan nilai di antara titik.',
            'checkpoints' => 'Array opsi diskrit (misal: <code>[\'10 GB\', \'20 GB\', \'30 GB\']</code>). Secara default mengunci pergeseran slider hanya ke titik checkpoint.',
            'strict' => 'Kontrol penguncian ketat: jika <code>true</code>, pengguna hanya bisa memilih checkpoint (tidak bisa memilih nilai antara). Jika <code>false</code>, pengguna bebas memilih nilai di antaranya.',
            'size' => 'Ukuran track dan thumb slider: <code>\'sm\'</code>, <code>\'md\'</code>, atau <code>\'lg\'</code>.',
            'showValue' => 'Menampilkan badge realtime nilai yang sedang aktif di sebelah kanan atas label.',
            'valuePrefix' => 'Teks awalan pada badge nilai live (contoh: <code>$</code> atau <code>Rp</code>).',
            'valueSuffix' => 'Teks akhiran/satuan pada badge nilai live (contoh: <code>GB</code>, <code>%</code>, <code>★</code>).',
            'minLabel' => 'Label teks kustom untuk batas bawah di bawah slider. Default menampilkan angka <code>min</code>.',
            'maxLabel' => 'Label teks kustom untuk batas atas di bawah slider. Default menampilkan angka <code>max</code>.',
            'error' => 'Pesan string error kustom atau boolean untuk memicu styling track merah.',
            'errorName' => 'Kunci error validasi Laravel <code>$errors</code> jika berbeda dari atribut <code>name</code>.',
            'disabled' => 'Atribut HTML native untuk menonaktifkan slider dan tombol loncat checkpoint.',
            'wrapperClass' => 'Class CSS tambahan untuk elemen kontainer pembungkus terluar.',
        ],
    ],
];
