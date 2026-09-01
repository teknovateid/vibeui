<?php

return [
    'title' => 'Button',
    'badge' => 'Komponen',
    'group' => 'Komponen UI',
    'description' => 'Komponen tombol serbaguna dengan beragam varian warna, 9 ukuran (termasuk icon-only), indikator loading spinner bawaan, dukungan navigasi link otomatis dengan wire:navigate, serta integrasi penuh dengan Livewire.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Penggunaan Dasar',
    'basic_usage_desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:button&gt;</code> untuk membuat tombol standar. Secara default, tombol menggunakan varian <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">default</code> dan ukuran <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code>.',

    // Section 2: Variants
    'variants_title' => 'Varian Tampilan',
    'variants_desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol skema warna dan hierarki visual tombol. Tersedia 12 varian yang siap digunakan untuk berbagai kebutuhan antarmuka.',
    'variant_default' => 'Default',
    'variant_primary' => 'Primary',
    'variant_secondary' => 'Secondary',
    'variant_outline' => 'Outline',
    'variant_ghost' => 'Ghost',
    'variant_surface' => 'Surface',
    'variant_accent' => 'Accent',
    'variant_destructive' => 'Destructive',
    'variant_success' => 'Success',
    'variant_warning' => 'Warning',
    'variant_info' => 'Info',
    'variant_link' => 'Link',

    // Section 3: Sizes
    'sizes_title' => 'Ukuran (Sizes)',
    'sizes_desc' => 'Tersedia 5 pilihan ukuran standar berbasis teks: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xs</code> (28px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',

    // Section 4: Icon Buttons
    'icons_title' => 'Tombol Ikon & Posisi Ikon',
    'icons_desc' => 'Ikon SVG dapat disisipkan langsung ke dalam slot sebagai awalan atau akhiran teks. Untuk tombol yang hanya memuat ikon (icon-only), gunakan salah satu ukuran ikon khusus: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-xs</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-sm</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-md</code>, atau <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">icon-lg</code>.',

    // Section 5: Pill
    'pill_title' => 'Pill Style',
    'pill_desc' => 'Gunakan class Tailwind <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> untuk membuat tombol dengan radius sudut membulat penuh, ideal untuk filter chips, badge action, atau tombol melingkar.',

    // Section 6: Loading State
    'loading_title' => 'Status Loading',
    'loading_desc' => 'Gunakan prop boolean <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">loading</code> untuk menampilkan animasi spinner otomatis di sisi kiri teks dan secara langsung menonaktifkan interaksi klik pengguna.',

    // Section 7: Status Disabled & Type
    'status_title' => 'Status Disabled & Tipe Tombol',
    'status_desc' => 'Atribut HTML standar seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> didukung secara penuh dengan visual pengurangan opasitas dan pemblokiran pointer event. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">type</code> untuk menentukan aksi form (<code class="font-mono text-xs text-foreground">submit</code>, <code class="font-mono text-xs text-foreground">button</code>, <code class="font-mono text-xs text-foreground">reset</code>).',

    // Section 8: Button as Link
    'link_title' => 'Tombol Sebagai Link (href)',
    'link_desc' => 'Jika Anda meneruskan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">href</code>, komponen akan dirender sebagai tag hyperlink <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;a wire:navigate&gt;</code> dengan gaya tombol penuh, mempertahankan navigasi SPA instan.',

    // Section 9: Livewire Integration
    'livewire_title' => 'Integrasi Livewire',
    'livewire_desc' => 'Komponen Button mendukung seluruh direktif aksi Livewire secara seamless seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:click</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:loading.attr="disabled"</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:target</code>.',

    // Section 10: Props Reference
    'props_title' => 'Referensi Props',
    'props_desc' => 'Daftar lengkap atribut dan properti yang didukung oleh komponen <code class="font-mono text-xs text-foreground">&lt;vibe:button&gt;</code>.',
    'table_prop' => 'Prop',
    'table_type' => 'Tipe',
    'table_default' => 'Default',
    'table_desc' => 'Deskripsi',

    // Section 11: Slots Reference
    'slots_title' => 'Slots',
    'slots_desc' => 'Daftar slot yang didukung oleh komponen.',
    'table_slot' => 'Slot',
];
