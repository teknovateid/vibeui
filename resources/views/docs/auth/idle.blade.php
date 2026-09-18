<x-docs.layouts.sidebar>
    <vibe:seo title="Idle Timeout & Session Lock — Vibe UI" description="Dokumentasi dan demo interaktif fitur Idle Timeout & Auto Session Lock Vibe UI untuk memproteksi sesi pengguna saat tidak aktif." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => route('docs.index')],
        ['name' => 'Authentication', 'url' => route('docs.auth.index')],
        ['name' => 'Idle Timeout', 'url' => route('docs.auth.idle')]
    ]" />

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Inactivity Protection</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Auto Lock</vibe:badge>
                    <span class="text-xs text-muted-foreground">Middleware: 'idle:{seconds}'</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Idle Timeout & Session Lock</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Melindungi workstation pengguna yang ditinggalkan tanpa pengawasan. Skrip client memantau aktivitas (mouse, keyboard, sentuhan layar, scroll). Jika pengguna pasif melebihi batas waktu yang ditentukan, sistem secara otomatis mengunci sesi dan mengarahkannya ke halaman konfirmasi sandi.
                </p>
            </div>

            {{-- 1. Live Interactive Demo: Idle Playground --}}
            <section id="demo-idle" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Simulator Inaktivitas (Live Playground)</h2>
                    <p class="text-sm text-muted-foreground">
                        Atur durasi timeout simulasi, diamkan kursor atau coba berinteraksi untuk melihat timer di-reset secara otomatis:
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-border bg-card space-y-6 shadow-xs relative overflow-hidden" x-data="{
                    configuredTimeout: 10,
                    remaining: 10,
                    isLocked: false,
                    lastActivity: 'Inisialisasi',
                    activityCount: 0,
                    intervalId: null,

                    init() {
                        this.resetTimer();
                        this.startCountdown();
                    },

                    startCountdown() {
                        if (this.intervalId) clearInterval(this.intervalId);
                        this.intervalId = setInterval(() => {
                            if (!this.isLocked) {
                                if (this.remaining > 0) {
                                    this.remaining--;
                                } else {
                                    this.isLocked = true;
                                }
                            }
                        }, 1000);
                    },

                    registerActivity(type) {
                        if (this.isLocked) return;
                        this.lastActivity = type + ' (' + new Date().toLocaleTimeString() + ')';
                        this.activityCount++;
                        this.remaining = this.configuredTimeout;
                    },

                    resetTimer() {
                        this.remaining = this.configuredTimeout;
                        this.isLocked = false;
                        this.startCountdown();
                    },

                    unlockSession() {
                        this.isLocked = false;
                        this.resetTimer();
                    }
                }" @mousemove.window.debounce.300ms="registerActivity('Gerakan Mouse')" @keydown.window.debounce.300ms="registerActivity('Tekan Keyboard')">

                    {{-- Lock screen overlay simulation --}}
                    <div x-show="isLocked" x-cloak class="absolute inset-0 z-30 bg-background/90 backdrop-blur-sm flex flex-col items-center justify-center p-6 text-center animate-in fade-in zoom-in-95 duration-200">
                        <div class="size-14 rounded-2xl bg-destructive/10 text-destructive flex items-center justify-center mb-3">
                            <svg class="size-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <h4 class="text-base font-bold text-foreground">Sesi Terkunci Karena Tidak Aktif</h4>
                        <p class="text-xs text-muted-foreground max-w-sm mt-1 mb-4">
                            Pengguna terdeteksi pasif selama <span x-text="configuredTimeout"></span> detik. Sesi Anda telah diamankan.
                        </p>
                        <vibe:button type="button" variant="primary" size="sm" @click="unlockSession()" class="cursor-pointer">
                            Buka Kunci Sesi (Simulasi Unlock)
                        </vibe:button>
                    </div>

                    {{-- Top Status Bar --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-border pb-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="size-2.5 rounded-full" :class="isLocked ? 'bg-destructive animate-ping' : (remaining <= 3 ? 'bg-amber-500 animate-pulse' : 'bg-emerald-500')"></span>
                                <h3 class="text-sm font-semibold text-foreground">
                                    <span x-text="isLocked ? 'Status: Terkunci' : (remaining <= 3 ? 'Status: Peringatan Idle' : 'Status: Aktif Memantau')"></span>
                                </h3>
                            </div>
                            <p class="text-xs text-muted-foreground">
                                Sisa waktu menuju penguncian: <strong class="text-foreground text-sm" x-text="remaining + ' detik'"></strong>
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-xs text-muted-foreground">Durasi Timeout:</span>
                            <div class="flex items-center gap-1.5 bg-muted p-1 rounded-lg">
                                <button type="button" @click="configuredTimeout = 5; resetTimer();" :class="configuredTimeout === 5 ? 'bg-background text-foreground font-bold shadow-2xs' : 'text-muted-foreground hover:text-foreground'" class="px-2 py-0.5 text-xs rounded transition-all cursor-pointer">5s</button>
                                <button type="button" @click="configuredTimeout = 10; resetTimer();" :class="configuredTimeout === 10 ? 'bg-background text-foreground font-bold shadow-2xs' : 'text-muted-foreground hover:text-foreground'" class="px-2 py-0.5 text-xs rounded transition-all cursor-pointer">10s</button>
                                <button type="button" @click="configuredTimeout = 20; resetTimer();" :class="configuredTimeout === 20 ? 'bg-background text-foreground font-bold shadow-2xs' : 'text-muted-foreground hover:text-foreground'" class="px-2 py-0.5 text-xs rounded transition-all cursor-pointer">20s</button>
                            </div>
                        </div>
                    </div>

                    {{-- Progress Bar Countdown --}}
                    <div class="space-y-1.5">
                        <div class="w-full h-2.5 rounded-full bg-muted overflow-hidden">
                            <div class="h-full transition-all duration-1000 ease-linear rounded-full" :class="remaining <= 3 ? 'bg-destructive' : 'bg-primary'" :style="'width: ' + ((remaining / configuredTimeout) * 100) + '%;'"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-muted-foreground">
                            <span>Mulai (<span x-text="configuredTimeout"></span>s)</span>
                            <span>Aktivitas Terakhir: <strong class="text-foreground" x-text="lastActivity"></strong></span>
                            <span>Terkunci (0s)</span>
                        </div>
                    </div>

                    {{-- Activity Test Box --}}
                    <div class="p-4 rounded-xl bg-muted/40 border border-border flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                        <div class="space-y-0.5">
                            <p class="font-semibold text-foreground">Coba Gerakkan Mouse atau Ketik Keyboard</p>
                            <p class="text-muted-foreground">Setiap aktivitas pengguna otomatis me-reset countdown timer kembali ke durasi penuh.</p>
                        </div>
                        <div class="px-3 py-1.5 rounded-lg bg-background border border-border font-mono text-[11px] shrink-0">
                            Total Event: <strong class="text-primary" x-text="activityCount"></strong>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 2. Penggunaan Middleware di Route --}}
            <section id="penggunaan-middleware" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Cara Penggunaan di Laravel Routes</h2>
                    <p class="text-sm text-muted-foreground">
                        Tambahkan alias middleware <code class="text-xs bg-muted px-1.5 py-0.5 rounded font-mono text-foreground">idle:{seconds}</code> pada rute atau grup rute yang ingin Anda proteksi:
                    </p>
                </div>

                <vibe:highlightjs language="php">
use Illuminate\Support\Facades\Route;

// Proteksi rute riwayat login dengan batas inaktivitas 600 detik (10 menit)
Route::middleware(['auth', 'idle:600'])->group(function () {
    Route::get('/settings/login-history', [LoginHistoryController::class, 'index']);
    Route::get('/finance/dashboard', [FinanceController::class, 'dashboard']);
});
</vibe:highlightjs>

                <div class="p-4 rounded-xl bg-muted/40 border border-border space-y-2 text-xs text-muted-foreground">
                    <p class="font-semibold text-foreground">Apa yang Terjadi di Balik Layar?</p>
                    <ol class="list-decimal list-inside space-y-1 pl-1 text-[11px] leading-relaxed">
                        <li>Middleware menyuntikkan atribut <code>data-idle-timeout</code> dan meta tag ke dalam layout <code>base.blade.php</code>.</li>
                        <li>Skrip <code>idle.js</code> secara otomatis membaca durasi tersebut dan memasang listener pada window browser.</li>
                        <li>Jika pengguna aktif, skrip secara berkala mengirimkan ping ke <code>/keep-alive</code> untuk memperpanjang sesi Laravel.</li>
                        <li>Jika timer habis, pengguna diarahkan ke <code>/confirm-password/idle-lock</code> dan sesi ditandai terkunci.</li>
                    </ol>
                </div>
            </section>

            {{-- 3. Mekanisme Keep-Alive --}}
            <section id="keep-alive" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Keep-Alive Endpoint (/keep-alive)</h2>
                    <p class="text-sm text-muted-foreground">
                        Mencegah sesi PHP / Laravel kedaluwarsa di server ketika pengguna sedang aktif membaca atau mengetik dokumen panjang di browser tanpa melakukan submit:
                    </p>
                </div>

                <vibe:highlightjs language="javascript">
// idle.js mengirim ping ringan setiap beberapa menit saat aktivitas terdeteksi
fetch('/keep-alive', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
    }
});
</vibe:highlightjs>
            </section>

            {{-- Navigation Footer --}}
            <div class="pt-8 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('docs.auth.confirm') }}" class="w-full sm:w-auto inline-flex items-center gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group">
                    <svg class="size-4 text-muted-foreground group-hover:text-primary transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Sebelumnya</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Konfirmasi Password (Sudo Mode)</span>
                    </div>
                </a>

                <a href="{{ route('docs.auth.two-factor') }}" class="w-full sm:w-auto inline-flex items-center justify-between sm:justify-end gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group text-right">
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Selanjutnya</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Two-Factor Authentication (2FA) &rarr;</span>
                    </div>
                </a>
            </div>

        </div>

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
