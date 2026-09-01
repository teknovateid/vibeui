<?php

return [
    'title' => 'Input',
    'badge' => 'Komponen',
    'group' => 'Form & Input',
    'description' => 'Komponen input teks yang modern dan fleksibel. Mendukung 5 varian tampilan, 4 ukuran, ikon leading/trailing, prefix/suffix teks, state error & disabled, serta integrasi penuh dengan Livewire wire:model.',

    // Section 1: Basic Usage
    'basic_usage_title' => 'Penggunaan Dasar',
    'basic_usage_desc' => 'Gunakan tag <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;vibe:input&gt;</code> untuk membuat input dengan label bawaan. Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> otomatis tersinkron dengan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">id</code> dan Laravel validation.',
    'basic_input_label' => 'Nama Lengkap',
    'basic_input_placeholder' => 'Masukkan nama lengkap Anda...',

    // Section 2: Variants
    'variants_title' => 'Varian Tampilan',
    'variants_desc' => 'Prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">variant</code> mengontrol gaya visual input. Tersedia 5 pilihan untuk berbagai konteks desain.',
    'variant_outline' => 'Outline (default)',
    'variant_filled' => 'Filled',
    'variant_flush' => 'Flush',
    'variant_ghost' => 'Ghost',
    'variant_accent' => 'Accent',

    // Section 3: Sizes
    'sizes_title' => 'Ukuran',
    'sizes_desc' => 'Tersedia 4 pilihan ukuran: <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">sm</code> (32px), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">md</code> (36px, default), <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">lg</code> (40px), dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">xl</code> (44px).',

    // Section 4: Icons & Addons
    'icons_addons_title' => 'Ikon & Addon',
    'icons_addons_desc' => 'Gunakan slot <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:icon&gt;</code> untuk sisi kiri dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">&lt;x-slot:trailingIcon&gt;</code> untuk sisi kanan. Gunakan prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">prefix</code> / <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">suffix</code> untuk teks statis.',

    // Section 5: Pill
    'pill_title' => 'Pill Style',
    'pill_desc' => 'Gunakan class Tailwind <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">rounded-full</code> untuk membuat input dengan sudut membulat penuh, sangat cocok untuk field pencarian.',

    // Section 6: Helper & Description
    'helper_title' => 'Deskripsi & Teks Bantuan',
    'helper_desc' => 'Gunakan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">description</code> untuk teks penjelasan di bawah label, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">info</code> untuk catatan pembantu di bawah field input.',

    // Section 7: Error & Validation
    'error_title' => 'Error & Validasi',
    'error_desc' => 'Secara otomatis menampilkan error dari <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">$errors</code> Laravel sesuai <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">name</code> input, atau teruskan pesan string kustom via prop <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">error</code>.',

    // Section 8: Status
    'status_title' => 'Status: Disabled & Readonly',
    'status_desc' => 'Mendukung attribute native HTML seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">disabled</code> dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">readonly</code> dengan gaya visual otomatis.',

    // Section 9: Livewire
    'livewire_title' => 'Integrasi Livewire',
    'livewire_desc' => 'Mendukung directive Livewire seperti <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model</code>, <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.live</code>, dan <code class="px-1.5 py-0.5 rounded bg-muted text-xs font-mono text-foreground">wire:model.blur</code> secara transparan.',

    // Section 10: Props Reference
    'props_title' => 'Referensi Props',
    'props_desc' => 'Daftar lengkap properti yang tersedia pada komponen <code class="font-mono text-xs text-foreground">&lt;vibe:input&gt;</code>.',
    'table_prop' => 'Prop',
    'table_type' => 'Tipe',
    'table_default' => 'Default',
    'table_desc' => 'Deskripsi',

    // Section 11: Slots
    'slots_title' => 'Slots',
    'slots_desc' => 'Daftar slot kustom yang tersedia.',
    'table_slot' => 'Slot',
];
