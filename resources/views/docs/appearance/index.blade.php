<x-docs.layouts.sidebar>
    <vibe:seo title="Pengaturan Tampilan & Tema (Appearance)" description="Dokumentasi sistem tampilan Vibe UI dengan dual-storage: Local Storage & Global Database + Cache." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Appearance', 'url' => '/docs/appearance']
    ]" />

    <div class="mx-auto w-full max-w-7xl space-y-12">
        <!-- Page Header -->
        <div class="space-y-4">
            <div class="flex items-center gap-2">
                <vibe:badge variant="secondary" class="rounded-full">Arsitektur Tema</vibe:badge>
                <span class="text-xs text-muted-foreground">Dual Storage & Zero-FOUC Engine</span>
            </div>

            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">
                Pengaturan Tampilan & Tema
            </h1>

            <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                Vibe UI menyediakan sistem pengaturan tema canggih yang mendukung 2 metode penyimpanan fleksibel: 
                <strong>Browser Local Storage</strong> (preferensi personal per-browser) dan <strong>Global Setting</strong> (Database + Cache terpusat dengan otorisasi berbasis Laravel Gate).
            </p>

            <div class="flex flex-wrap items-center gap-1.5 pt-1">
                <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">localStorage</vibe:badge>
                <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Database + Cache</vibe:badge>
                <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Zero-FOUC Shield</vibe:badge>
                <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Theme Locking</vibe:badge>
                <vibe:badge variant="outline" size="sm" class="font-mono text-[11px]">Agnostic Gate</vibe:badge>
            </div>
        </div>

        <!-- Section 1: Dua Metode Penyimpanan -->
        <section class="space-y-6">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-foreground">1. Dua Metode Penyimpanan</h2>
                <p class="text-sm text-muted-foreground">
                    Sistem dirancang untuk mendukung kebutuhan pengguna akhir maupun standarisasi *branding* perusahaan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <vibe:card class="p-5 space-y-3 bg-card border-border">
                    <div class="flex items-center gap-2">
                        <div class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="20" height="14" x="2" y="3" rx="2" />
                                <line x1="8" x2="16" y1="21" y2="21" />
                                <line x1="12" x2="12" y1="17" y2="21" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground text-sm">Metode 1: Browser Local Storage</h3>
                            <span class="text-[11px] text-muted-foreground">Client-Side Preferences</span>
                        </div>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Menyimpan preferensi tampilan unik per-perangkat/browser pengguna pada kunci <code class="font-mono text-foreground bg-muted px-1 py-0.5 rounded">vibe-theme</code> dan <code class="font-mono text-foreground bg-muted px-1 py-0.5 rounded">vibe-theme-tokens</code>. Cocok untuk preferensi mode gelap/terang personal, font, atau densitas tabel tanpa membebani server database.
                    </p>
                </vibe:card>

                <vibe:card class="p-5 space-y-3 bg-card border-border">
                    <div class="flex items-center gap-2">
                        <div class="size-8 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0">
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                                <path d="M2 12h20" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-foreground text-sm">Metode 2: Global Database + Cache</h3>
                            <span class="text-[11px] text-muted-foreground">Server-Side Centralized Theme</span>
                        </div>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Menyimpan token tema resmi di tabel database <code class="font-mono text-foreground bg-muted px-1 py-0.5 rounded">theme_settings</code> dan di-cache secara permanen via <code class="font-mono text-foreground bg-muted px-1 py-0.5 rounded">Cache::rememberForever()</code>. Menghasilkan performa instan dengan <strong>0 query database</strong> saat halaman dibuka.
                    </p>
                </vibe:card>
            </div>
        </section>

        <!-- Section 2: Hierarki Tampilan (Cascade Strategy) -->
        <section class="space-y-6">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-foreground">2. Alur Penentuan Tema (*Cascade Strategy*)</h2>
                <p class="text-sm text-muted-foreground">
                    Secara default aplikasi menggunakan mode <strong>Hybrid</strong>, dengan alur prioritas sebagai berikut:
                </p>
            </div>

            <div class="p-4 rounded-xl border border-border bg-muted/30 space-y-3 text-xs leading-relaxed text-muted-foreground">
                <ol class="list-decimal list-inside space-y-2">
                    <li>
                        <strong class="text-foreground">Injeksi Server (Anti-FOUC):</strong> Server mengambil CSS tema global langsung dari Cache server dan menyuntikkannya ke tag <code class="font-mono bg-muted px-1 py-0.5 rounded">&lt;head&gt;</code> sebelum browser mulai menggambar (*zero flash*).
                    </li>
                    <li>
                        <strong class="text-foreground">Pemeriksaan Penguncian (*Theme Lock*):</strong> Jika pengelola sistem mengaktifkan opsi <strong>Kunci Tampilan Global</strong> (<code class="font-mono bg-muted px-1 py-0.5 rounded">is_locked = true</code>), seluruh override browser lokal diabaikan dan tema resmi dipaksakan secara seragam.
                    </li>
                    <li>
                        <strong class="text-foreground">Personal Override:</strong> Jika tema tidak dikunci, skrip klien memeriksa preferensi di <code class="font-mono bg-muted px-1 py-0.5 rounded">localStorage</code>. Jika ada, preferensi personal pengguna diterapkan secara otomatis.
                    </li>
                </ol>
            </div>
        </section>

        <!-- Section 3: Konfigurasi Otorisasi (Agnostik & Netral) -->
        <section class="space-y-6">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-foreground">3. Otorisasi Fleksibel (Developer Preference)</h2>
                <p class="text-sm text-muted-foreground">
                    Layaknya Flux UI atau Starter Kit modern, Vibe UI <strong>tidak memaksakan</strong> model user atau struktur role tertentu. Hak akses pengelolaan tema global sepenuhnya dikendalikan via <strong>Laravel Gate</strong> sesuai preferensi developer.
                </p>
            </div>

            <div class="space-y-4">
                <p class="text-xs text-muted-foreground">
                    Untuk membatasi hak akses agar hanya role tertentu yang dapat menyimpan tema global ke database/cache, daftarkan Gate di <code class="font-mono text-foreground bg-muted px-1 py-0.5 rounded">app/Providers/AppServiceProvider.php</code>:
                </p>

                <vibe:highlightjs language="php" title="app/Providers/AppServiceProvider.php">
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Daftarkan Gate sesuai sistem otentikasi / role yang Anda gunakan:
        Gate::define('vibe.manage-theme', function ($user = null) {
            // Contoh jika menggunakan Spatie Permission:
            // return $user?->hasRole('admin');

            // Contoh jika menggunakan kolom boolean pada users:
            // return (bool) $user?->is_admin;

            // Contoh jika menggunakan kolom posisi/jabatan:
            return in_array($user?->position, ['Administrator', 'Super Admin']);
        });
    }
}
                </vibe:highlightjs>

                <p class="text-xs text-muted-foreground">
                    Kemudian tentukan nama gate tersebut pada <code class="font-mono text-foreground bg-muted px-1 py-0.5 rounded">config/vibe.php</code>:
                </p>

                <vibe:highlightjs language="php" title="config/vibe.php">
'theme' => [
    'storage_mode' => env('VIBE_THEME_STORAGE_MODE', 'hybrid'), // 'hybrid', 'local_only', 'global_only'
    'gate' => env('VIBE_THEME_GATE', 'vibe.manage-theme'),
    'cache_key' => 'vibe:theme:global',
],
                </vibe:highlightjs>
            </div>
        </section>

        <!-- Section 4: Layanan Programatik (ThemeService) -->
        <section class="space-y-6">
            <div class="space-y-1">
                <h2 class="text-xl font-bold text-foreground">4. Penggunaan Programatik (ThemeService)</h2>
                <p class="text-sm text-muted-foreground">
                    Developer dapat memanipulasi tema global secara langsung dari controller, seeder, atau artisan command:
                </p>
            </div>

            <vibe:highlightjs language="php" title="PHP / Controller Usage">
use Teknovate\VibeUi\Services\ThemeService;

$themeService = app(ThemeService::class);

// 1. Ambil tema global saat ini dari cache (0 query jika sudah ter-cache):
$global = $themeService->getGlobalTheme();

// 2. Simpan atau perbarui tema global:
$themeService->saveGlobalTheme(
    tokens: [
        'mode' => 'dark',
        'customHex' => '#6366f1',
        'selectedRadius' => '0.75rem',
        'selectedFontName' => 'Inter'
    ],
    css: ':root { --primary: #6366f1; }',
    isLocked: true, // Kunci tema agar user tidak bisa override
    updatedBy: auth()->user()?->name ?? 'Admin'
);

// 3. Reset tema global ke bawaan Vibe UI:
$themeService->resetGlobalTheme();

// 4. Bersihkan cache saja:
$themeService->clearCache();
            </vibe:highlightjs>
        </section>

        <!-- Section 5: HTTP Endpoints -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-foreground">5. Rute & HTTP Endpoints</h2>
            <div class="overflow-x-auto rounded-xl border border-border">
                <table class="w-full text-xs text-left">
                    <thead class="bg-muted text-muted-foreground uppercase text-[10px] tracking-wider border-b border-border">
                        <tr>
                            <th class="py-2.5 px-3">Metode</th>
                            <th class="py-2.5 px-3">URL</th>
                            <th class="py-2.5 px-3">Nama Rute</th>
                            <th class="py-2.5 px-3">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        <tr>
                            <td class="py-2.5 px-3"><vibe:badge size="sm" variant="info">GET</vibe:badge></td>
                            <td class="py-2.5 px-3 font-mono">/vibe-api/theme/global</td>
                            <td class="py-2.5 px-3 font-mono">vibe.theme.global.show</td>
                            <td class="py-2.5 px-3">Mengambil data tema global dan status izin pengguna saat ini.</td>
                        </tr>
                        <tr>
                            <td class="py-2.5 px-3"><vibe:badge size="sm" variant="success">POST</vibe:badge></td>
                            <td class="py-2.5 px-3 font-mono">/vibe-api/theme/global</td>
                            <td class="py-2.5 px-3 font-mono">vibe.theme.global.save</td>
                            <td class="py-2.5 px-3">Menyimpan tokens dan string CSS ke database & memperbarui cache.</td>
                        </tr>
                        <tr>
                            <td class="py-2.5 px-3"><vibe:badge size="sm" variant="destructive">POST</vibe:badge></td>
                            <td class="py-2.5 px-3 font-mono">/vibe-api/theme/global/reset</td>
                            <td class="py-2.5 px-3 font-mono">vibe.theme.global.reset</td>
                            <td class="py-2.5 px-3">Menghapus tema kustom global dan membersihkan cache.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-docs.layouts.sidebar>
