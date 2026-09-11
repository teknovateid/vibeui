<?php

return [
    'title' => 'Context Menu',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen context menu yang muncul saat klik kanan di posisi kursor. Dirancang sebagai satu instance menu global — aman digunakan dengan data banyak. Kompatibel dengan card, baris tabel, datatable, dan elemen HTML apapun.',

    'basic_usage' => [
        'title' => 'Penggunaan Dasar',
        'desc' => 'Bungkus elemen apapun dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:context&gt;</code> dan arahkan ke <code class="font-mono text-xs text-foreground">&lt;vibe:context.menu&gt;</code> via prop <code class="font-mono text-xs text-foreground">menu</code>. Klik kanan pada elemen target untuk membuka menu.',
        'preview_title' => 'Card dengan Context Menu',
        'card_text' => 'Klik kanan pada card ini',
        'card_hint' => 'Coba klik kanan di mana saja pada card ini',
        'edit' => 'Edit',
        'duplicate' => 'Duplikat',
        'delete' => 'Hapus',
    ],

    'datatable' => [
        'title' => 'Integrasi Datatable (Single Global Menu)',
        'desc' => 'Untuk datatable dengan banyak baris, gunakan <strong>satu</strong> <code class="font-mono text-xs text-foreground">&lt;vibe:context.menu&gt;</code> global di luar loop. Setiap baris mendispatch event <code class="font-mono text-xs text-foreground">open-context</code> dengan payload <code class="font-mono text-xs text-foreground">data</code>. Menu mengaksesnya secara reaktif via <code class="font-mono text-xs text-foreground">$context.data</code>.',
        'preview_title' => 'Klik kanan pada baris manapun',
        'col_name' => 'Nama',
        'col_email' => 'Email',
        'col_role' => 'Peran',
        'edit_row' => 'Edit',
        'view_row' => 'Lihat Detail',
        'delete_row' => 'Hapus',
        'selected_label' => 'Dipilih:',
    ],

    'with_submenu' => [
        'title' => 'Dengan Submenu (context.sub)',
        'desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:context.sub&gt;</code> untuk submenu bersarang. Submenu otomatis flip ke kiri jika mendekati tepi kanan viewport.',
        'preview_title' => 'Context Menu dengan Submenu',
        'area_text' => 'Klik kanan di sini',
        'open' => 'Buka',
        'share' => 'Bagikan ke...',
        'share_email' => 'Email',
        'share_slack' => 'Slack',
        'share_teams' => 'Microsoft Teams',
        'rename' => 'Ganti Nama',
        'delete' => 'Hapus',
    ],

    'programmatic' => [
        'title' => 'Kontrol Programatik ($vibe.context)',
        'desc' => 'Buka context menu secara programatik menggunakan <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.context(\'id\').show(x, y, data?)</code> atau tutup semua dengan <code class="font-mono text-xs bg-muted px-1.5 py-0.5 rounded text-foreground">$vibe.contexts.close()</code>.',
        'preview_title' => 'Kontrol Programatik Context Menu',
        'open_btn' => 'Buka Context Menu',
        'close_btn' => 'Tutup Semua',
        'edit' => 'Edit',
        'duplicate' => 'Duplikat',
        'delete' => 'Hapus',
    ],

    'props' => [
        'title' => 'Referensi Props & Subkomponen',
        'desc' => 'Spesifikasi lengkap props dan subkomponen yang tersedia untuk suite komponen <code class="font-mono text-xs text-foreground">&lt;vibe:context&gt;</code>.',
        'columns' => [
            'prop' => 'Prop',
            'type' => 'Tipe',
            'default' => 'Default',
            'desc' => 'Deskripsi',
        ],
        'events_title' => 'Window Events & Referensi $vibe Helper',
        'events_desc' => 'Komponen context menu merespons window event dan $vibe Alpine.js helper berikut:',
        'th_event' => 'Helper / Window Event',
        'th_payload' => 'Payload',
        'th_event_desc' => 'Deskripsi',
        'events' => [
            [
                'name' => "\$vibe.context('id').show(x, y, data?) / @open-context",
                'payload' => "{ menu: 'id', x, y, data }",
                'desc' => 'Membuka context menu di posisi x/y dengan payload data opsional yang dapat diakses via $context.data.',
            ],
            [
                'name' => "\$vibe.context('id').close() / @close-context",
                'payload' => "'id'",
                'desc' => 'Menutup context menu dengan ID yang ditentukan.',
            ],
            [
                'name' => "\$vibe.contexts.close() / @close-context",
                'payload' => "'*'",
                'desc' => 'Menutup semua context menu yang sedang terbuka di halaman.',
            ],
        ],
    ],

    'props_items' => [
        'context' => [
            'menu' => 'ID dari <vibe:context.menu> yang akan dibuka saat klik kanan.',
        ],
        'menu' => [
            'id' => 'ID unik menu. Digunakan oleh trigger untuk menarget menu ini via prop menu atau $vibe.context(\'id\').',
        ],
        'item' => [
            'href' => 'Jika diisi, dirender sebagai link navigasi <a>.',
            'variant' => "Varian item: 'default' atau 'destructive'.",
            'disabled' => 'Nonaktifkan item (abu-abu, tidak dapat diklik).',
        ],
        'item_delete' => [
            'title' => 'Teks judul untuk dialog konfirmasi.',
            'message' => 'Isi pesan untuk dialog konfirmasi.',
            'confirmText' => 'Label tombol konfirmasi.',
            'cancelText' => 'Label tombol batal.',
            'url' => 'URL form DELETE untuk penggunaan non-Livewire. Gunakan route().',
            'wire:click' => 'Livewire action — dibaca via $attributes->wire(\'click\').',
        ],
        'sub' => [
            'label' => 'Teks label trigger untuk submenu.',
            'align' => "Alignment submenu: 'right' (default) atau 'left'.",
            'width' => "Lebar submenu: '48', '56', '64', '80', dll.",
        ],
    ],
];
