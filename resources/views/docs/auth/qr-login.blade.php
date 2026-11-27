<x-docs.layouts.sidebar>
    <vibe:seo
        title="Login QR Code (Pusher & Swappable Drivers) — Vibe UI"
        description="Dokumentasi lengkap fitur Login dengan QR Code lintas perangkat di Vibe UI menggunakan Laravel Broadcasting (default Pusher, mudah diganti ke Reverb, Ably, Polling, atau driver kustom)."
        schema="techarticle"
        :breadcrumbs="[
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Docs', 'url' => route('docs.index')],
            ['name' => 'Authentication', 'url' => route('docs.auth.index')],
            ['name' => 'QR Code Login', 'url' => route('docs.auth.qr-login')]
        ]"
    />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Hero Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Cross-Device</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Default: Pusher</vibe:badge>
                    <vibe:badge variant="secondary" class="rounded-full">Swappable Driver</vibe:badge>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Login dengan QR Code</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Autentikasi lintas perangkat tanpa mengetik kata sandi. Perangkat baru (desktop) menampilkan QR Code dari <code class="font-mono text-xs">&lt;vibe:display.qrcode&gt;</code> beserta <strong>Pairing Code 8 karakter</strong> di bawahnya, sedangkan perangkat yang sudah login memindai QR atau memasukkan kode tersebut di <code class="font-mono text-xs">/qr-login/approve</code> melalui sistem <strong>Laravel Broadcasting</strong> (default <strong>Pusher</strong>).
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="/login?method=qrcode" variant="primary" size="sm">
                        Buka /login?method=qrcode &rarr;
                    </vibe:button>
                    <vibe:button href="{{ route('docs.display.qrcode') }}" variant="outline" size="sm">
                        Komponen Display QR Code
                    </vibe:button>
                </div>
            </div>

            {{-- 1. Konfigurasi Minimal & Laravel Broadcasting --}}
            <section id="konfigurasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Konfigurasi Minimal (Memakai Broadcasting Bawaan Laravel)</h2>
                    <p class="text-sm text-muted-foreground">
                        Kredensial WebSocket tidak diduplikasi di Vibe UI—semua koneksi langsung membaca <code class="font-mono text-xs">config/broadcasting.php</code> milik Laravel. Di <code class="font-mono text-xs">config/vibe.php</code> hanya terdapat 6 opsi ringkas:
                    </p>
                </div>

                <vibe:highlight language="php" class="rounded-xl overflow-hidden text-xs">
'auth' => [
    'qr_login' => [
        'enabled' => env('VIBE_QR_LOGIN_ENABLED', true),
        'driver' => env('VIBE_QR_LOGIN_DRIVER', 'pusher'),
        'ttl' => (int) env('VIBE_QR_LOGIN_TTL', 120), // durasi QR & kode sebelum expired (detik, min. 10)
        'auto_refresh' => env('VIBE_QR_LOGIN_AUTO_REFRESH', true), // langsung generate kode baru saat expired
        'max_auto_refresh' => (int) env('VIBE_QR_LOGIN_MAX_AUTO_REFRESH', 0), // 0 = tanpa batas
        'bypass_two_factor' => env('VIBE_QR_LOGIN_BYPASS_2FA', false),
    ],
],
                </vibe:highlight>

                <div class="space-y-2">
                    <h3 class="text-sm font-semibold text-foreground">Pengaturan Default (Pusher &amp; Auto-Regenerate) di <code class="font-mono text-xs">.env</code></h3>
                    <vibe:highlight language="env" class="rounded-xl overflow-hidden text-xs">
VIBE_QR_LOGIN_ENABLED=true
VIBE_QR_LOGIN_DRIVER=pusher
VIBE_QR_LOGIN_TTL=120
VIBE_QR_LOGIN_AUTO_REFRESH=true
VIBE_QR_LOGIN_MAX_AUTO_REFRESH=0

PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=ap1
                    </vibe:highlight>
                </div>
            </section>

            {{-- 2. Mengganti Driver --}}
            <section id="mengganti-driver" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Mengganti Driver Transport (Swappable)</h2>
                    <p class="text-sm text-muted-foreground">
                        Cukup ubah nilai <code class="font-mono text-xs">VIBE_QR_LOGIN_DRIVER</code> ke salah satu koneksi di <code class="font-mono text-xs">config/broadcasting.php</code> atau gunakan driver <code class="font-mono text-xs">polling</code> tanpa mengubah kode Livewire/Blade:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-foreground font-mono">pusher</span>
                            <vibe:badge variant="primary" size="xs" class="rounded-full">Default</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Menggunakan <code class="font-mono">pusher/pusher-php-server</code> + <code class="font-mono">pusher-js</code> berdasarkan koneksi <code class="font-mono">broadcasting.connections.pusher</code>.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-foreground font-mono">reverb</span>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">Self-Hosted</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Set <code class="font-mono">VIBE_QR_LOGIN_DRIVER=reverb</code> dan isi variabel standar <code class="font-mono">REVERB_*</code> di <code class="font-mono">.env</code>.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-foreground font-mono">ably / mercure / lainnya</span>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">Laravel Echo</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Mengirim event melalui koneksi Laravel Broadcasting pilihan Anda dan mendengarkan lewat <code class="font-mono">window.Echo</code> atau adapter JS kustom.
                        </p>
                    </div>

                    <div class="p-4 rounded-xl border border-border bg-card space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-foreground font-mono">polling</span>
                            <vibe:badge variant="secondary" size="xs" class="rounded-full">Zero WebSocket</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Set <code class="font-mono">VIBE_QR_LOGIN_DRIVER=polling</code> untuk fallback HTTP polling ke endpoint status terautentikasi sesi (ideal untuk pengembangan lokal tanpa kunci Pusher).
                        </p>
                    </div>
                </div>

                <div class="space-y-2 pt-2">
                    <h3 class="text-sm font-semibold text-foreground">Mendaftarkan Custom Driver (Backend & Frontend)</h3>
                    <vibe:highlight language="php" class="rounded-xl overflow-hidden text-xs">
use Teknovate\VibeUi\Contracts\QrLoginDriver;
use Teknovate\VibeUi\Vibe;

// Di AppServiceProvider::boot()
Vibe::qrLogin()->extend('my-socket', function ($app): QrLoginDriver {
    return new \App\Services\CustomQrDriver();
});
                    </vibe:highlight>

                    <vibe:highlight language="javascript" class="rounded-xl overflow-hidden text-xs">
// Daftarkan transport JS pasangannya bila bukan pusher/reverb/Echo
window.VibeQrLogin?.registerDriver('my-socket', (config, onUpdate, onError) => {
    const ws = new WebSocket(`wss://socket.example.com/${config.channel}`);
    ws.onmessage = (event) => onUpdate(JSON.parse(event.data));
    ws.onerror = (err) => onError(err);
    return () => ws.close();
});
                    </vibe:highlight>
                </div>
            </section>

            {{-- 3. Keamanan & CLI --}}
            <section id="keamanan" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Keamanan &amp; CLI Scaffolding</h2>
                    <p class="text-sm text-muted-foreground">
                        Setiap permintaan QR mengikat <code class="font-mono text-xs">deviceSecret</code> acak ke session browser peminta, menggunakan lock atomik sekali pakai, memvalidasi status dari halaman persetujuan terautentikasi (<code class="font-mono text-xs">/qr-login/approve/{token}</code>), dan secara default tetap menghormati kebijakan 2FA akun.
                    </p>
                </div>

                <vibe:highlight language="bash" class="rounded-xl overflow-hidden text-xs">
# Scaffold auth dengan QR Login aktif (default)
php artisan vibe:auth --with-qr-login

# Atau nonaktifkan QR Login saat scaffolding
php artisan vibe:auth --without-qr-login
                </vibe:highlight>
            </section>

            {{-- Navigation Footer --}}
            <div class="pt-8 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('docs.auth.passkey') }}" class="w-full sm:w-auto inline-flex items-center gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group">
                    <svg class="size-4 text-muted-foreground group-hover:text-primary transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19l-7-7 7-7"/></svg>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Sebelumnya</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Passkey (WebAuthn)</span>
                    </div>
                </a>

                <a href="{{ route('docs.auth.index') }}" class="w-full sm:w-auto inline-flex items-center justify-between sm:justify-end gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group text-right">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Kembali ke Hub</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Ikhtisar Autentikasi &rarr;</span>
                    </div>
                </a>
            </div>
        </div>

        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>
    </div>
</x-docs.layouts.sidebar>
