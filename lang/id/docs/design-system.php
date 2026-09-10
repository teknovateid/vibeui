<?php

return [
    'seo_title' => 'Desain Sistem Warna — Vibe UI',
    'seo_description' => 'Rumus lengkap penggunaan warna semantik dalam Vibe UI: token CSS, pola variant per komponen, formula match(), dan panduan konsistensi warna di seluruh sistem.',
    'breadcrumb' => 'Desain Sistem Warna',

    'header' => [
        'badge' => 'Desain Sistem',
        'subtitle' => 'Panduan & Referensi',
        'title' => 'Desain Sistem Warna',
        'desc' => 'Panduan lengkap tentang token warna semantik Vibe UI, rumus <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">match()</code> variant per komponen, pola penggunaan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">color-mix()</code>, dan aturan konsistensi warna di seluruh sistem komponen.',
    ],

    'sections' => [
        'tokens' => [
            'title' => 'Token Warna Semantik',
            'desc' => 'Vibe UI menggunakan CSS Custom Properties sebagai sumber kebenaran tunggal warna. Semua komponen <strong>wajib</strong> menggunakan token ini — bukan nilai hex langsung — agar theme light/dark berfungsi otomatis.',
            'palette' => [
                'primary' => ['name' => 'primary', 'role' => 'Aksi utama, foreground default'],
                'secondary' => ['name' => 'secondary', 'role' => 'Aksi sekunder, surface muted'],
                'success' => ['name' => 'success', 'role' => 'Konfirmasi, selesai, hemat'],
                'warning' => ['name' => 'warning', 'role' => 'Peringatan, ambang batas'],
                'destructive' => ['name' => 'destructive', 'role' => 'Error, bahaya, hapus'],
                'info' => ['name' => 'info', 'role' => 'Informasi, bantuan, sistem'],
                'accent' => ['name' => 'accent', 'role' => 'Hover surface, highlight halus'],
                'muted' => ['name' => 'muted', 'role' => 'Teks sekunder, placeholder'],
            ],
            'surface_table' => [
                'title' => 'Token Surface & Struktur',
                'columns' => [
                    'token' => 'Token CSS',
                    'light' => 'Light',
                    'dark' => 'Dark',
                    'usage' => 'Kegunaan',
                ],
                'items' => [
                    'background' => 'Latar halaman utama',
                    'foreground' => 'Teks utama di atas background',
                    'card' => 'Surface kartu & panel',
                    'card_foreground' => 'Teks di atas kartu',
                    'popover' => 'Surface dropdown, tooltip, popover',
                    'border' => 'Garis pembatas, outline',
                    'input' => 'Background input kosong / track',
                    'ring' => 'Focus ring outline',
                    'muted_foreground' => 'Teks placeholder, hint, caption',
                    'sidebar' => 'Background sidebar nav',
                    'header' => 'Background header/topbar',
                ],
            ],
        ],

        'formulas' => [
            'title' => 'Rumus Variant: Solid vs Soft',
            'desc' => 'Vibe UI memakai dua formula utama untuk komponen interaktif. Pilih formula berdasarkan <strong>bobot visual</strong> yang diinginkan.',
            'solid' => [
                'title' => 'Formula SOLID',
                'badge' => 'Button, Switch Track, Range',
                'desc' => 'Digunakan untuk elemen interaktif utama: tombol primary, track slider aktif, toggle switch.',
            ],
            'soft' => [
                'title' => 'Formula SOFT (Tinted)',
                'badge' => 'Badge, Alert, Card Highlight',
                'desc' => 'Digunakan untuk indikator status, badge, dan highlight ringan agar tidak terlalu dominan secara visual.',
            ],
            'opacity' => [
                'title' => 'Aturan Opacity Modifier Standar',
                'columns' => [
                    'modifier' => 'Modifier',
                    'usage' => 'Kegunaan',
                    'example' => 'Contoh Kelas',
                ],
                'items' => [
                    ['mod' => '/90', 'usage' => 'Hover state tombol solid', 'example' => 'hover:bg-primary/90'],
                    ['mod' => '/80', 'usage' => 'Hover state secondary/muted', 'example' => 'hover:bg-secondary/80'],
                    ['mod' => '/15', 'usage' => 'Background soft badge/alert', 'example' => 'bg-success/15'],
                    ['mod' => '/20', 'usage' => 'Border soft badge/alert', 'example' => 'border-success/20'],
                    ['mod' => '/10', 'usage' => 'Hover overlay ghost/icon', 'example' => 'hover:bg-foreground/10'],
                    ['mod' => '/25–35', 'usage' => 'Focus ring via color-mix()', 'example' => 'color-mix(in srgb, --primary 25%, transparent)'],
                    ['mod' => '/50', 'usage' => 'Disabled state opacity', 'example' => 'disabled:opacity-50'],
                    ['mod' => '/70', 'usage' => 'Teks sekunder/caption ringan', 'example' => 'text-muted-foreground/70'],
                ],
            ],
        ],

        'components' => [
            'title' => 'Rumus Warna Per Komponen',
            'desc' => 'Tabel referensi pola warna untuk setiap komponen. Semua komponen menggunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">match($variant)</code> PHP untuk men-generate class Tailwind secara bersih.',
            'button' => [
                'title' => 'Button',
                'columns' => [
                    'variant' => 'Variant',
                    'formula' => 'Formula Warna',
                    'hover' => 'Hover',
                ],
            ],
            'badge' => [
                'title' => 'Badge',
                'formula_label' => '📐 Rumus Badge (Soft/Tinted — berbeda dari Button):',
                'note' => '💡 Badge menggunakan pola <strong>soft tinted</strong> (opacity /15 background + warna teks langsung), bukan solid background seperti Button.',
            ],
            'switch' => [
                'title' => 'Switch',
                'formula_label' => '📐 Rumus Track Switch (Checked State):',
                'note' => '💡 Switch menggunakan <strong>pola SOLID</strong> pada track aktif, dengan thumb selalu <code class="font-mono">bg-background</code> untuk kontras maksimal.',
            ],
            'range' => [
                'title' => 'Range Slider',
                'formula_label' => '📐 Rumus Range (CSS Custom Property via PHP match()):',
            ],
            'form_group' => [
                'title' => 'Input, Textarea, Select, Date-Time',
                'badge' => 'Kelompok Form',
                'labels' => [
                    'default' => 'Default',
                    'default_placeholder' => 'Nilai normal',
                    'error' => 'Error State',
                    'error_placeholder' => 'Nilai tidak valid',
                    'error_msg' => 'Field ini wajib diisi.',
                    'info' => 'Info State',
                    'info_placeholder' => 'Nilai dengan petunjuk',
                    'info_msg' => 'Format: dd/mm/yyyy',
                    'readonly' => 'Readonly',
                    'readonly_val' => 'Tidak bisa diubah',
                ],
                'formula_label' => '📐 Rumus Kelompok Form (state-based, tidak ada prop variant warna):',
                'note' => '💡 Komponen form <strong>tidak memiliki prop <code class="font-mono">variant</code> warna</strong>. Warna hanya berubah berdasarkan state: normal, error, disabled/readonly.',
            ],
            'dropdown' => [
                'title' => 'Dropdown',
                'formula_label' => '📐 Rumus Dropdown Item Colors:',
                'note' => '💡 Dropdown item semantik menggunakan pola <strong>teks berwarna + background /10</strong> saat hover — formula paling ringan untuk item dalam panel kecil.',
            ],
            'modal_sheet' => [
                'title' => 'Modal & Sheet',
                'formula_label' => '📐 Rumus Modal & Sheet:',
            ],
        ],

        'color_mix' => [
            'title' => 'Formula <code class="text-lg">color-mix()</code> — Focus Ring & Hover Glow',
            'desc' => 'CSS <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">color-mix(in srgb, ...)</code> digunakan untuk membuat warna semi-transparent dari token padat — sangat berguna untuk focus ring dan active glow effects.',
            'columns' => [
                'formula' => 'Formula',
                'usage' => 'Kegunaan',
                'where' => 'Tempat digunakan',
            ],
            'items' => [
                ['formula' => 'color-mix(in srgb, var(--primary) 25%, transparent)', 'usage' => 'Focus ring lembut tombol/input', 'where' => 'Button :active ring, Input focus'],
                ['formula' => 'color-mix(in srgb, var(--range-active-color) 25%, transparent)', 'usage' => 'Active ring slider thumb', 'where' => 'Range Slider :active state'],
                ['formula' => 'color-mix(in srgb, var(--ring) 35%, transparent)', 'usage' => 'Focus-visible ring utama', 'where' => 'Range Slider :focus-visible'],
                ['formula' => 'color-mix(in srgb, var(--primary-foreground) 35%, transparent)', 'usage' => 'Shimmer beam di progress bar', 'where' => 'NProgress bar ::after'],
            ],
            'faq_title' => '📌 Mengapa color-mix() dan bukan opacity modifier Tailwind?',
            'faq_desc' => 'Tailwind opacity modifier (<code class="font-mono">bg-primary/25</code>) hanya bekerja pada elemen bertipe <code class="font-mono">background</code>. Untuk <code class="font-mono">box-shadow</code> dan <code class="font-mono">border-color</code> yang membutuhkan warna semi-transparan dari token CSS dinamis, <code class="font-mono">color-mix()</code> adalah satu-satunya pilihan yang bekerja konsisten di semua browser modern.',
        ],

        'dark_mode' => [
            'title' => 'Aturan Dark Mode',
            'desc' => 'Karena semua warna komponen menggunakan token CSS (bukan hex langsung), dark mode otomatis berfungsi hanya dengan mengganti nilai variabel CSS di root <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">.dark</code> — tanpa perlu menulis kelas <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">dark:</code> per komponen.',
            'correct_title' => '✅ Pattern yang Benar',
            'correct_desc' => 'Token ini otomatis berubah nilai saat tema berganti.',
            'avoid_title' => '❌ Pattern yang Harus Dihindari',
            'avoid_desc' => 'Nilai literal tidak responsif terhadap perubahan tema.',
            'exceptions_title' => '📌 Pengecualian yang Diizinkan',
            'exceptions' => [
                'Warna <code class="font-mono">bg-black/50</code> untuk backdrop overlay modal (nilai absolut yang diinginkan di kedua tema).',
                'Warna accent ungu/violet yang dipatok (<code class="font-mono">oklch(0.511 0.262 276.966)</code>) di range variant <code class="font-mono">accent</code> — karena token <code class="font-mono">--accent</code> di Vibe UI dipakai untuk surface hover (bukan warna ungu).',
                'Warna chart (<code class="font-mono">--chart-1</code> s/d <code class="font-mono">--chart-5</code>) yang dapat berbeda antara light dan dark.',
            ],
        ],

        'guidelines' => [
            'title' => 'Panduan Memilih Variant',
            'desc' => 'Gunakan tabel ini sebagai acuan cepat untuk memilih variant yang tepat secara semantik di setiap konteks UI.',
            'columns' => [
                'context' => 'Konteks / Skenario',
                'variant' => 'Variant yang Tepat',
                'note' => 'Catatan',
            ],
            'items' => [
                ['context' => 'Aksi utama (Submit, Save, Konfirmasi)', 'variant' => 'primary', 'note' => 'Selalu gunakan primary untuk CTA paling penting di halaman'],
                ['context' => 'Aksi sekunder (Cancel, Back, Reset)', 'variant' => 'secondary / outline', 'note' => 'secondary lebih solid, outline lebih ringan'],
                ['context' => 'Hapus / Destruktif / Tidak bisa dibatalkan', 'variant' => 'danger', 'note' => 'Wajib danger untuk aksi permanen yang tidak bisa di-undo'],
                ['context' => 'Berhasil / Selesai / Aktif / Hemat', 'variant' => 'success', 'note' => 'Konfirmasi pembayaran, badge status aktif, slider kapasitas optimal'],
                ['context' => 'Peringatan / Threshold / Hampir penuh', 'variant' => 'warning', 'note' => 'Ambang batas penggunaan, validasi ringan, konfigurasi penting'],
                ['context' => 'Informasi / Panduan / Bantuan sistem', 'variant' => 'info', 'note' => 'Alert informatif, badge informasi, range parameter sistem'],
                ['context' => 'Aksen / Premium / Fitur khusus', 'variant' => 'accent', 'note' => 'Slider rating bintang, toggle fitur premium, highlight spesial'],
                ['context' => 'Aksi ghost/navigasi dalam card/list', 'variant' => 'ghost', 'note' => 'Tombol edit inline, icon action, menu konteks'],
                ['context' => 'Surface card/panel/container', 'variant' => 'surface', 'note' => 'Tombol yang menyatu dengan kartu, aksi belum terlalu penting'],
            ],
        ],
    ],
];
