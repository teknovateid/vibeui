<?php

return [
    'title' => 'Clipboard',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen salin ke clipboard yang aksesibel untuk tombol icon/teks mandiri, target elemen DOM via Invoker Commands, kotak field & code read-only dengan opsi masker rahasia, bubble live-region, serta integrasi opsional Vibe Toast.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:clipboard&gt;</code> dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">value</code> untuk tombol salin ikon maupun tombol berlabel.',
        'preview_title' => 'Tombol Salin Mandiri',
        'copy_token' => 'Salin Token',
        'copy_url' => 'Salin URL',
    ],

    'target' => [
        'title' => 'Menyalin dari Elemen Target (Invoker Commands)',
        'desc' => 'Arahkan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">target</code> ke ID elemen DOM mana pun. Vibe Clipboard menggunakan Invoker Commands native (<code class="font-mono text-xs text-foreground">command="--copy"</code> + <code class="font-mono text-xs text-foreground">commandfor</code>) beserta fallback klik otomatis untuk browser lama.',
        'preview_title' => 'Salin Teks & Nilai Input via ID',
        'target_label' => 'Salin Endpoint Webhook',
        'command_note' => 'Perintah instalasi:',
    ],

    'field_code' => [
        'title' => 'Varian Field & Code Box',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="field"</code> untuk tautan berbagi atau API key (tambahkan <code class="font-mono text-xs text-foreground">masked</code> untuk nilai rahasia) dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant="code"</code> untuk perintah terminal.',
        'preview_title' => 'Field Read-only, Secret Masked & Snippet Kode',
        'api_label' => 'Production Secret Key',
        'api_desc' => 'Jaga kerahasiaan token ini. Nilai tetap bisa disalin meski disembunyikan.',
        'share_label' => 'Tautan Berbagi Publik',
    ],

    'sizes_bubbles' => [
        'title' => 'Ukuran, Bubble & Toast',
        'desc' => 'Mengikuti grid kontrol proporsional Vibe UI (<code class="font-mono text-xs text-foreground">xs</code> 28px hingga <code class="font-mono text-xs text-foreground">xl</code> 44px), dengan posisi bubble (<code class="font-mono text-xs text-foreground">top</code>, <code class="font-mono text-xs text-foreground">bottom</code>, <code class="font-mono text-xs text-foreground">left</code>, <code class="font-mono text-xs text-foreground">right</code>, atau <code class="font-mono text-xs text-foreground">false</code>) serta <code class="font-mono text-xs text-foreground">toast</code> opsional.',
        'preview_title' => 'Ukuran Proporsional & Opsi Notifikasi',
        'with_toast' => 'Salin + Toast',
        'bubble_right' => 'Bubble Kanan',
    ],

    'hover_block' => [
        'title' => 'Blok Salin Berulang (.vibe-copyable)',
        'desc' => 'Bungkus kartu kode atau nilai token berulang dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.vibe-copyable</code> agar tombol salin muncul halus saat hover/fokus keyboard dan tetap terlihat di layar sentuh.',
        'preview_title' => 'Blok Salin Hover & Aksesibel Keyboard',
    ],

    'props' => [
        'title' => 'Referensi Props & JS API',
        'desc' => 'Anda juga dapat menyalin secara terprogram lewat JavaScript melalui <code class="font-mono text-xs text-foreground">window.VibeClipboard.copy(text, opts)</code> atau <code class="font-mono text-xs text-foreground">$vibe.copy(text)</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
    ],

    'props_items' => [
        'value' => 'Teks statis yang akan disalin (atau ekspresi reaktif Alpine).',
        'target' => 'ID elemen DOM target yang diikat lewat commandfor native.',
        'variant' => 'Varian tombol atau mode kotak read-only (field / code).',
        'size' => 'Ukuran proporsional sejajar input & tombol (xs hingga xl).',
        'label' => 'Label di atas mode kotak, atau teks tombol.',
        'description' => 'Teks bantuan di bawah label pada mode kotak.',
        'copyLabel' => 'Label tombol kustom atau judul tooltip saat idle.',
        'copiedLabel' => 'Teks feedback saat penyalinan berhasil.',
        'failedLabel' => 'Teks feedback saat akses clipboard ditolak.',
        'bubble' => 'Posisi bubble konfirmasi atau false untuk mode screen-reader saja.',
        'duration' => 'Durasi tampilan status berhasil/gagal dalam milidetik.',
        'toast' => 'Memunculkan notifikasi Vibe Toast bersamaan dengan feedback inline.',
        'masked' => 'Menyamarkan nilai rahasia dengan tombol intip sambil tetap menyalin nilai asli.',
        'prefix' => 'Awalan teks (misal $) untuk mode field/code.',
        'ariaLabel' => 'Nama aksesibel untuk tombol icon-only.',
        'disabled' => 'Menonaktifkan tombol dan interaksi salin.',
    ],
];
