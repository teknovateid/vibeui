<?php

return [
    'title' => 'Show (Data Binding)',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Sistem data binding otomatis yang memudahkan pengambilan dan penataan data JSON dari endpoint AJAX ke elemen HTML, data looping (tabel, grid, list), serta seluruh komponen form Vibe UI tanpa perlu penulisan kode JavaScript manual.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar & Pengikatan Kunci',
        'desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show key="..."&gt;</code> atau atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show="..."</code> pada elemen HTML apa pun untuk mengikat data berdasarkan key dari respon server. Mendukung dot-notation bersarang (contoh: <code class="font-mono text-xs">user.profile.name</code>) dan notasi kurung array (<code class="font-mono text-xs">items[0].title</code>).',
        'preview_title' => 'Binding Data Tunggal',
    ],

    'advanced_binding' => [
        'title' => 'Binding Atribut & Konten HTML',
        'desc' => 'Kaitkan nilai data ke atribut elemen HTML menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show attr="namaAtribut"&gt;</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show-attr="namaAtribut"</code> (misal: <code class="font-mono text-xs">src</code>, <code class="font-mono text-xs">href</code>, <code class="font-mono text-xs">alt</code>). Render teks HTML mentah secara aman menggunakan opsi <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">html</code> atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show-html</code>.',
        'preview_title' => 'Atribut Dinamis & Konten HTML',
    ],

    'button_show' => [
        'title' => 'Trigger Fetch (<vibe:button.show>)',
        'desc' => 'Komponen <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button.show&gt;</code> bertindak sebagai tombol trigger yang mengeksekusi request AJAX ke <code class="font-mono text-xs">url</code>, mengontrol indikator status pemuatan (loading), dan otomatis mempopulasikan data ke elemen <code class="font-mono text-xs">target</code>. Jika target berupa Modal atau Sheet, komponen otomatis membukanya setelah data berhasil dimuat.',
        'preview_title' => 'Tombol Trigger AJAX dengan Modal',
        'sheet_preview_title' => 'Trigger AJAX dengan Side Sheet (Drawer)',
        'inline_preview_title' => 'Pengisian Data ke Kontainer Inline',
        'trigger_btn' => 'Tampilkan Data Pengguna',
        'trigger_sheet_btn' => 'Buka Detail Sheet',
        'trigger_inline_btn' => 'Muat ke Kartu',
    ],

    'looping' => [
        'title' => 'Perulangan Data Array / List (<vibe:show.each>)',
        'desc' => 'Untuk koleksi data array/list seperti <code class="font-mono text-xs">user.products</code>, gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:show.each&gt;</code> atau atribut <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">vibe-show-each="..."</code>. Bekerja sempurna dengan baris tabel (<code class="font-mono text-xs">as="tbody"</code>) maupun grid kartu (<code class="font-mono text-xs">as="div"</code>). Gunakan variabel counter <code class="font-mono text-xs">$iteration</code> (mulai dari 1) atau <code class="font-mono text-xs">$index</code> (mulai dari 0), serta <code class="font-mono text-xs">vibe-show="."</code> untuk array bertipe primitif.',
        'preview_title' => 'Looping Baris Tabel',
        'grid_preview_title' => 'Looping Kartu & Grid dengan Badge',
    ],

    'components_support' => [
        'title' => 'Sinkronisasi Komponen Form Vibe UI',
        'desc' => 'Engine VibeShow secara otomatis mendeteksi dan mengisi komponen form Vibe UI: <code class="font-mono text-xs">&lt;vibe:input&gt;</code>, <code class="font-mono text-xs">&lt;vibe:textarea&gt;</code>, <code class="font-mono text-xs">&lt;vibe:select&gt;</code> (tunggal & multiple), <code class="font-mono text-xs">&lt;vibe:checkbox&gt;</code>, <code class="font-mono text-xs">&lt;vibe:radio&gt;</code>, <code class="font-mono text-xs">&lt;vibe:switch&gt;</code>, <code class="font-mono text-xs">&lt;vibe:range&gt;</code>, <code class="font-mono text-xs">&lt;vibe:avatar&gt;</code>, dan <code class="font-mono text-xs">&lt;vibe:badge&gt;</code>. Kontrol form dengan atribut <code class="font-mono text-xs">name</code> akan otomatis dicocokkan dengan struktur respon data.',
        'preview_title' => 'Otomatisasi Sinkronisasi Form',
    ],

    'javascript_api' => [
        'title' => 'API JavaScript & Event DOM',
        'desc' => 'Anda juga dapat mempopulasikan data secara terprogram (programmatic) dalam script JavaScript atau komponen Alpine buatan Anda via <code class="font-mono text-xs">VibeShow.populate()</code> atau memicu fetch via <code class="font-mono text-xs">VibeShow.fetchAndShow()</code>. Engine juga memicu custom event DOM <code class="font-mono text-xs">vibe:show:updated</code> dan <code class="font-mono text-xs">vibe:show:success</code>.',
        'preview_title' => 'Populasi Terprogram & Listening Event',
    ],

    'props' => [
        'title' => 'Referensi Props & Atribut',
        'desc' => 'Daftar lengkap atribut, properti, dan variabel template yang didukung oleh ekosistem VibeShow.',
        'columns' => [
            'prop' => 'Prop / Atribut',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],
];

