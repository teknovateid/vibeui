# Vibe UI - Assistant Rules & Guidelines

1. **Build Restrictions**:
   - **JANGAN PERNAH** menjalankan perintah `npm run build`. Aplikasi menggunakan Vite dev server yang berjalan di background.

2. **Cache Clearing**:
   - **SELALU** jalankan `php artisan optimize:clear` setiap kali selesai melakukan perubahan pada kode/proyek.

3. **File Editing Scope (Single Source of Truth)**:
   - **JANGAN PERNAH** mengedit file di dalam direktori `packages/vibe/` secara langsung untuk file yang disinkronkan.
   - Semua perubahan komponen, CSS, JS, views, dan skill bawaan paket harus dilakukan di dalam `resources/` atau `.agents/skills/vibeui/` (misalnya `resources/views/vibe/`, `resources/css/vibe/`, `resources/js/vibe/`, `.agents/skills/vibeui/`).
   - Plugin `vibeSyncPlugin` di dalam [vite.config.js](file:///home/fahril/PROJECTS/Teknovate/vibe-ui/vite.config.js) akan otomatis menyinkronkan seluruh perubahan ke `packages/vibe/` secara real-time (verifikasi dengan `php artisan vibe:sync --check`).

4. **Component Guidelines**:
   - Jangan gunakan atribut/prop `pill` pada komponen `<vibe:input>` dan `<vibe:button>`. Untuk gaya pill/membulat penuh, gunakan class utility Tailwind `class="rounded-full"`.
   - Gunakan selalu sintaks tag kustom `<vibe:component>` (bukan `<x-vibe::component>`).
