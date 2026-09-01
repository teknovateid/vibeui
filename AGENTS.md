# Vibe UI - Assistant Rules & Guidelines

1. **Build Restrictions**:
   - **JANGAN PERNAH** menjalankan perintah `npm run build`. Aplikasi menggunakan Vite dev server yang berjalan di background.

2. **Cache Clearing**:
   - **SELALU** jalankan `php artisan optimize:clear` setiap kali selesai melakukan perubahan pada kode/proyek.

3. **File Editing Scope (Single Source of Truth)**:
   - **JANGAN PERNAH** mengedit file di dalam direktori `packages/vibe/` secara langsung.
   - Semua perubahan komponen, CSS, JS, dan views harus dilakukan di dalam `resources/` (misalnya `resources/views/vibe/`, `resources/css/vibe/`, `resources/js/vibe/`).
   - Plugin `vibeSyncPlugin` di dalam [vite.config.js](file:///home/fahril/PROJECTS/Teknovate/vibe-ui/vite.config.js) akan otomatis menyinkronkan seluruh perubahan ke `packages/vibe/` secara real-time.

4. **Component Guidelines**:
   - Jangan gunakan atribut/prop `pill` pada komponen `<vibe:input>` dan `<vibe:button>`. Untuk gaya pill/membulat penuh, gunakan class utility Tailwind `class="rounded-full"`.
   - Gunakan selalu sintaks tag kustom `<vibe:component>` (bukan `<x-vibe::component>`).
