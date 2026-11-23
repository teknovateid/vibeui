<?php

return [
    'title' => 'Editor (WYSIWYG)',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen rich-text WYSIWYG editor modern ditenagai oleh TinyMCE 7 dengan fitur autocomplete variabel {{ model.kolom }}, sinkronisasi tema gelap/terang Vibe UI, preset toolbar fleksibel, integrasi upload gambar, dan dukungan penuh Livewire v3.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:editor&gt;</code> untuk menyediakan teks editor kaya format (rich-text) langsung di form Anda. Nilai HTML editor otomatis disinkronkan ke elemen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;textarea&gt;</code> asli sehingga bekerja mulus dengan form submission HTML standar.',
        'preview_title' => 'Editor Standar',
        'label' => 'Konten Artikel',
        'placeholder' => 'Mulai tuliskan konten artikel atau pengumuman Anda di sini...',
    ],

    'variables' => [
        'title' => 'Autocomplete & Dropdown Variabel {{ model.kolom }}',
        'desc' => 'Sisipkan token variabel dinamis seperti <code class="px-1.5 py-0.5 rounded bg-secondary text-secondary-foreground text-xs font-mono font-semibold">{{ user.name }}</code>. Anda dapat mengetikkan tanda <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">{{</code> langsung di editor untuk membuka popup autocomplete instan, atau memilihnya dari menu toolbar <strong>Variabel</strong>. Variabel disisipkan sebagai badge atomik terproteksi yang tidak mudah terhapus sebagian.',
        'preview_title' => 'Editor dengan Autocomplete Variabel',
        'label' => 'Template Pesan Notifikasi',
        'placeholder' => 'Ketik {{ untuk memunculkan pilihan variabel data pengguna dan pesanan...',
        'structure_title' => 'Format Struktur Data Variabel',
        'structure_desc' => 'Prop <code class="font-mono text-xs text-foreground">:variables</code> mendukung format array hierarkis (berkelompok) maupun format flat dot-notation.',
    ],

    'parsing' => [
        'title' => 'Parsing & Interpolasi Variabel di Backend (Laravel)',
        'badge' => 'Backend Integration',
        'desc' => 'Ketika template disimpan ke database, template berisi token variabel dinamis seperti <code class="font-mono text-xs text-foreground">{{ user.name }}</code> atau tag pembungkus badge <code class="font-mono text-xs text-foreground">&lt;span class="vibe-editor-variable"&gt;</code>. Vibe UI menyediakan class <code class="font-mono text-xs text-foreground">Vibe::parseTemplate()</code> dan helper <code class="font-mono text-xs text-foreground">vibe_parse_template()</code> untuk menginterpolasi template tersebut dengan data Model Eloquent atau Array secara instan dan aman.',
        'method_title' => 'Menggunakan Helper Bawaan Vibe UI',
        'method_desc' => 'Method ini otomatis mengekstrak kunci variabel, mencari nilainya dari model Eloquent atau array bertingkat (dot-notation), membersihkan tag badge HTML sehingga menjadi teks biasa yang rapi untuk email/PDF, serta melakukan proteksi XSS secara default.',
        'mailable_title' => 'Contoh Integrasi Mailable / Email Blast',
        'mailable_desc' => 'Gunakan hasil parsing langsung sebagai body HTML email Laravel Anda:',
        'manual_title' => 'Parsing Mandiri Menggunakan Regex (Opsional)',
        'manual_desc' => 'Jika Anda memerlukan logika parsing khusus di luar helper bawaan, Anda dapat menggunakan fungsi regex PHP manual berikut:',
    ],

    'presets' => [
        'title' => 'Preset Toolbar (Minimal, Basic, Standard, Full)',
        'desc' => 'Tersedia 4 pilihan preset toolbar siap pakai melalui prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">preset="..."</code> untuk menyesuaikan kebutuhan antarmuka aplikasi Anda:',
        'items' => [
            'minimal' => '<strong>Minimal</strong>: Hanya formatting teks dasar (Undo, Redo, Bold, Italic, Link, Clear format). Cocok untuk kolom komentar atau catatan singkat.',
            'basic' => '<strong>Basic</strong>: Menambahkan Heading/Paragraph selector, Blockquote, serta Bullet & Numbered List.',
            'standard' => '<strong>Standard (Default)</strong>: Toolbar lengkap dengan Alignment, Text & Highlight Color, Tabel, Gambar, dan Code View.',
            'full' => '<strong>Full</strong>: Menyertakan Menubar TinyMCE atas, seluruh toolset tabel lanjutan, Search & Replace, Word Count, Media, dan Fullscreen.',
        ],
        'preview_title' => 'Preset Minimal & Full',
        'minimal_label' => 'Komentar Singkat (preset="minimal")',
        'full_label' => 'Editor Dokumen Lengkap (preset="full" :menubar="true")',
    ],

    'custom_toolbar' => [
        'title' => 'Kustomisasi Toolbar & Plugin Bebas',
        'desc' => 'Anda dapat mendefinisikan susunan tombol toolbar sendiri dengan prop <code class="font-mono text-xs text-foreground">toolbar="..."</code> serta mengaktifkan plugin TinyMCE spesifik melalui prop <code class="font-mono text-xs text-foreground">:plugins="[...]"</code>.',
        'preview_title' => 'Custom Toolbar & Plugins',
        'label' => 'Editor Kustom (Format Teks, List, & Code View Saja)',
    ],

    'autoresize' => [
        'title' => 'Mode Autoresize (Tinggi Dinamis)',
        'desc' => 'Aktifkan prop <code class="font-mono text-xs text-foreground">:autoresize="true"</code> untuk membuat area editor otomatis membesar mengikuti panjang tulisan pengguna tanpa scrollbar ganda yang kaku. Anda juga dapat membatasi batas atasnya dengan <code class="font-mono text-xs text-foreground">:max-height="500"</code>.',
        'preview_title' => 'Editor dengan Autoresize',
        'label' => 'Tulis Catatan Panjang (Editor Mengembang Otomatis)',
    ],

    'image_upload' => [
        'title' => 'Integrasi Unggah Gambar (Drag & Drop / Paste)',
        'desc' => 'Editor mendukung drag-and-drop dan paste gambar langsung dari clipboard. Cukup berikan endpoint backend melalui prop <code class="font-mono text-xs text-foreground">upload-url="..."</code>. Vibe UI otomatis menyertakan header token CSRF Laravel dan menangani respon JSON.',
        'controller_title' => 'Contoh Controller Laravel Penangan Upload Gambar',
        'controller_desc' => 'Endpoint backend harus memvalidasi berkas dan mengembalikan JSON dengan format kunci <code class="font-mono text-xs text-foreground">{ "location": "https://..." }</code>.',
    ],

    'livewire' => [
        'title' => 'Integrasi Livewire v3 (Two-Way Data Binding)',
        'desc' => 'Komponen <code class="font-mono text-xs text-foreground">&lt;vibe:editor&gt;</code> terintegrasi secara native dengan Livewire 3 menggunakan <code class="font-mono text-xs text-foreground">wire:model</code> maupun <code class="font-mono text-xs text-foreground">wire:model.live</code>. Sinkronisasi dirancang menggunakan arsitektur event Alpine yang menghindari masalah cursor jumping atau loop update.',
    ],

    'states' => [
        'title' => 'Status Interaksi: Readonly, Disabled & Error Validation',
        'desc' => 'Editor memiliki state interaksi lengkap yang terintegrasi langsung dengan siklus form Laravel:',
        'preview_title' => 'Readonly & Validation Error State',
        'readonly_label' => 'Artikel Berstatus Publikasi (Read-only)',
        'disabled_label' => 'Editor Nonaktif (Disabled)',
        'error_label' => 'Konten dengan Pesan Error Validasi',
    ],

    'props' => [
        'title' => 'Referensi Props & Atribut',
        'desc' => 'Daftar lengkap properti dan atribut yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:editor&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'name' => 'Nama atribut input form. Otomatis terambil dari <code>wire:model</code> jika tidak diisi.',
            'id' => 'ID unik elemen HTML editor dan textarea.',
            'label' => 'Teks label utama yang tampil di atas editor.',
            'description' => 'Teks penjelasan / petunjuk pembantu di bawah label.',
            'placeholder' => 'Teks placeholder saat isi editor masih kosong.',
            'preset' => 'Preset toolbar & plugins: <code>\'minimal\'</code>, <code>\'basic\'</code>, <code>\'standard\'</code>, atau <code>\'full\'</code>.',
            'variables' => 'Array model dan kolom variabel untuk autocomplete dan menu toolbar. Mendukung format hierarkis maupun dot-notation.',
            'variableStyle' => 'Format visual variabel: <code>\'badge\'</code> (pill terproteksi atomic) atau <code>\'raw\'</code> (teks polos).',
            'variablePrefix' => 'Prefix pembuka variabel (default: <code>\'{{ \'</code>).',
            'variableSuffix' => 'Suffix penutup variabel (default: <code>\' }}\'</code>).',
            'variableButtonLabel' => 'Label teks pada tombol menu variabel di toolbar (default: <code>\'Variabel\'</code>).',
            'height' => 'Tinggi editor dalam satuan pixel (default: <code>350</code>).',
            'minHeight' => 'Batas tinggi minimum editor dalam satuan pixel (default: <code>200</code>).',
            'maxHeight' => 'Batas tinggi maksimum editor dalam satuan pixel saat menggunakan mode autoresize.',
            'autoresize' => 'Menyesuaikan tinggi editor secara otomatis mengikuti panjang konten teks.',
            'menubar' => 'Menampilkan atau menyembunyikan menubar atas TinyMCE (default: <code>false</code>).',
            'toolbar' => 'String kustomisasi tombol toolbar untuk menggantikan susunan default preset.',
            'toolbarMode' => 'Mode tampilan overflow toolbar: <code>\'sliding\'</code> (default: slide ke bawah di dalam header), <code>\'floating\'</code>, <code>\'wrap\'</code>, atau <code>\'scrolling\'</code>.',
            'toolbarSticky' => 'Membuat bilah toolbar tetap menempel (sticky) di bagian atas saat halaman atau editor digulir (default: <code>true</code>).',
            'toolbarStickyOffset' => 'Offset jarak tambahan dalam satuan pixel dari batas atas viewport saat toolbar sticky aktif (default: <code>0</code>).',
            'plugins' => 'String atau array plugin TinyMCE tambahan yang ingin diaktifkan.',
            'uploadUrl' => 'Endpoint backend URL untuk memproses unggah gambar secara otomatis dengan token CSRF.',
            'uploadParam' => 'Nama parameter form-data untuk file gambar saat dikirim ke server (default: <code>\'file\'</code>).',
            'statusbar' => 'Menampilkan status bar bawah TinyMCE (word count & resize handle). Default: <code>true</code>.',
            'readonly' => 'Menjadikan editor hanya bisa dibaca (read-only).',
            'disabled' => 'Menonaktifkan interaksi editor dan memberikan tampilan disabled.',
            'required' => 'Menandai editor sebagai field wajib diisi (menambahkan tanda asterisk merah).',
            'error' => 'Pesan error kustom atau flag boolean untuk memicu styling merah destructive.',
            'errorName' => 'Kunci error Laravel validation dalam <code>$errors</code> untuk deteksi error otomatis.',
            'info' => 'Teks informasi bantuan di bawah editor.',
            'wrapperClass' => 'Kelas CSS tambahan untuk elemen kontainer pembungkus terluar.',
        ],
    ],

    'slots' => [
        'title' => 'Referensi Slots',
        'desc' => 'Slot konten yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:editor&gt;</code>.',
        'columns' => [
            'name' => 'Nama Slot',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'default' => 'Konten HTML awal yang disisipkan ke dalam editor saat pertama kali dimuat. Alternatif dari prop <code>value="..."</code>.',
        ],
    ],

    'events' => [
        'title' => 'Event & Integrasi JavaScript',
        'desc' => 'Event DOM dan API JavaScript yang dapat Anda dengarkan atau kendalikan secara langsung.',
        'columns' => [
            'event' => 'Event / Method',
            'target' => 'Target',
            'desc' => 'Deskripsi',
        ],
        'items' => [
            'change' => 'Elemen <code class="font-mono text-xs">textarea</code>',
            'change_desc' => 'Dipicu setiap kali isi konten di dalam TinyMCE berubah atau saat fokus berpindah keluar (blur).',
            'input' => 'Elemen <code class="font-mono text-xs">textarea</code>',
            'input_desc' => 'Dipicu secara real-time saat pengguna mengetik di dalam editor.',
            'ready' => '<code class="font-mono text-xs">window</code>',
            'ready_desc' => 'Event kustom <code class="font-mono text-xs">vibe-editor-ready</code> dipancarkan saat modul editor JS berhasil diinisialisasi sepenuhnya.',
            'tinymce_get' => '<code class="font-mono text-xs">window.tinymce.get(id)</code>',
            'tinymce_get_desc' => 'Mengembalikan instance TinyMCE aktif untuk kontrol pemrograman tingkat lanjut seperti <code>getContent()</code> atau <code>setContent()</code>.',
        ],
    ],
];
