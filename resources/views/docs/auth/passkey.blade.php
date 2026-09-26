<x-docs.layouts.sidebar>
    <vibe:seo title="Autentikasi Biometrik Passkey (WebAuthn) — Vibe UI" description="Dokumentasi lengkap dan konsol uji coba langsung Passkey (FIDO2/WebAuthn) untuk login tanpa kata sandi menggunakan biometrik perangkat." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => route('docs.index')],
        ['name' => 'Authentication', 'url' => route('docs.auth.index')],
        ['name' => 'Passkey (WebAuthn)', 'url' => route('docs.auth.passkey')]
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-12">

            {{-- Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Passwordless</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">FIDO2 / WebAuthn</vibe:badge>
                    <span class="text-xs text-muted-foreground">laravel/passkeys & @laravel/passkeys</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Passkey (WebAuthn)</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Otentikasi biometrik modern menggunakan sidik jari (Touch ID), pemindai wajah (Face ID / Windows Hello), atau kunci keamanan fisik (YubiKey). Menghilangkan risiko serangan phishing dan credential stuffing secara total karena kata sandi tidak lagi disimpan atau dikirim ke server.
                </p>

                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="/login" variant="primary" size="sm">
                        <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Uji Login dengan Passkey
                    </vibe:button>
                    <vibe:button href="{{ route('docs.settings.security') }}" variant="outline" size="sm">
                        Pengaturan Keamanan & Passkey &rarr;
                    </vibe:button>
                </div>
            </div>

            {{-- Important WebAuthn Security Notice --}}
            <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 space-y-2 leading-relaxed">
                <div class="flex items-center gap-2 font-semibold">
                    <svg class="size-4 shrink-0 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Aturan Keamanan WebAuthn & Pendaftaran Passkey:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-muted-foreground pl-1">
                    <li><strong>Wajib Menggunakan Nama Domain:</strong> Browser melarang WebAuthn dijalankan pada IP mentah seperti <code>http://127.0.0.1:8000</code>. Akses selalu melalui <code>http://localhost:8000</code> atau domain HTTPS.</li>
                    <li><strong>Verifikasi Kata Sandi Terpusat (Sudo Mode):</strong> Menggunakan halaman <code>/confirm-password</code> untuk konfirmasi keamanan sebelum mendaftarkan perangkat baru tanpa perlu mengisi kata sandi berulang kali pada form.</li>
                    <li><strong>Enkripsi Kunci Asimetris:</strong> Kunci privat disimpan aman di Secure Enclave perangkat dan tidak pernah dikirim ke jaringan.</li>
                </ul>
            </div>

            {{-- 1. Interactive Passkey Test Console --}}
            <section id="demo-passkey" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Konsol Uji Coba Passkey (Live Console)</h2>
                    <p class="text-sm text-muted-foreground">
                        Uji verifikasi biometrik langsung dari peramban Anda:
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-border bg-card space-y-5 shadow-xs" x-data="{
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    loading: false,
                    statusText: '',
                    feedbackMessage: null,
                    feedbackType: 'info',
                    init() {
                        this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                    },
                    async submitRegisterPasskey() {
                        if (!this.registerName) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = 'Harap masukkan nama perangkat.';
                            return;
                        }

                        this.loading = true;
                        this.statusText = 'Menyiapkan sensor biometrik perangkat...';
                        this.feedbackMessage = null;

                        try {
                            if (!window.VibePasskeyService) {
                                throw new Error('Modul Passkey belum dimuat di peramban ini.');
                            }

                            const regRes = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (regRes.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Anda kini dapat masuk menggunakan biometrik perangkat.';
                                setTimeout(() => window.location.reload(), 2000);
                            } else if (regRes.confirmationRequired) {
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = '{{ route("password.confirm") }}';
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = regRes.message || 'Pendaftaran passkey dibatalkan oleh pengguna.';
                            }
                        } catch (err) {
                            if (err?.response?.status === 423 || err?.status === 423 || err?.message?.includes('423') || err?.message?.toLowerCase().includes('password confirmation')) {
                                this.statusText = 'Mengarahkan ke halaman konfirmasi kata sandi...';
                                window.location.href = '{{ route("password.confirm") }}';
                                return;
                            }
                            this.feedbackType = 'error';
                            this.feedbackMessage = err.message || 'Terjadi kesalahan saat memproses pendaftaran passkey.';
                        } finally {
                            this.loading = false;
                            this.statusText = '';
                        }
                    }
                }">
                    <div class="flex items-center justify-between border-b border-border pb-3">
                        <div class="flex items-center gap-2.5">
                            <div class="p-2 rounded-lg bg-primary/10 text-primary">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                    <path d="M14 13.12c0 2.38 0 6.38-1 8.88" />
                                    <path d="M17.29 21.02c.12-.6.43-2.3.5-3.02" />
                                    <path d="M2 12a10 10 0 0 1 18-6" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-foreground">Status Kompatibilitas Sensor Biometrik</h3>
                                <p class="text-xs text-muted-foreground">FIDO2 / WebAuthn browser support check</p>
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium" :class="supported ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-destructive/10 text-destructive'">
                            <span class="size-1.5 rounded-full" :class="supported ? 'bg-emerald-500' : 'bg-destructive'"></span>
                            <span x-text="supported ? 'Didukung Browser' : 'Tidak Didukung'"></span>
                        </span>
                    </div>

                    {{-- Warning if user is currently on 127.0.0.1 --}}
                    <template x-if="isIpAddress">
                        <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 flex items-center justify-between gap-3">
                            <span class="leading-relaxed">Anda sedang mengakses via <strong>127.0.0.1</strong>. Buka via <strong>localhost</strong> agar WebAuthn dapat berjalan.</span>
                            <a :href="localhostUrl" class="shrink-0 px-3 py-1.5 bg-amber-500 text-white rounded-lg font-medium hover:bg-amber-600 transition-colors text-xs">
                                Buka di Localhost &rarr;
                            </a>
                        </div>
                    </template>

                    {{-- Feedback message banner --}}
                    <div x-show="feedbackMessage" x-cloak class="p-3.5 rounded-xl text-xs space-y-1" :class="feedbackType === 'success' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 border border-emerald-500/20' : 'bg-destructive/10 text-destructive border border-destructive/20'">
                        <p class="font-semibold" x-text="feedbackType === 'success' ? '✓ Berhasil!' : '⚠ Perhatian:'"></p>
                        <p x-text="feedbackMessage" class="leading-relaxed"></p>
                    </div>

                    @auth
                        {{-- Logged in state: Register Passkey Form --}}
                        <div class="space-y-4">
                            <div class="p-3.5 rounded-xl bg-muted/40 border border-border flex items-center justify-between">
                                <div class="text-xs space-y-0.5">
                                    <div class="text-muted-foreground">Login sebagai:</div>
                                    <div class="font-semibold text-foreground">{{ auth()->user()->name }} ({{ auth()->user()->email }})</div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <vibe:button type="submit" variant="ghost" size="xs" class="text-muted-foreground hover:text-destructive">
                                        Logout
                                    </vibe:button>
                                </form>
                            </div>

                            {{-- Passkeys list --}}
                            @php
                                $userPasskeys = auth()->user()->passkeys ?? collect();
                            @endphp
                            <div class="space-y-2">
                                <h4 class="text-xs font-semibold text-foreground uppercase tracking-wider">Passkey Terdaftar ({{ $userPasskeys->count() }})</h4>
                                @if ($userPasskeys->isEmpty())
                                    <p class="text-xs text-muted-foreground italic">Belum ada passkey yang terdaftar di akun ini. Daftarkan perangkat Anda di bawah.</p>
                                @else
                                    <div class="divide-y divide-border rounded-xl border border-border overflow-hidden">
                                        @foreach ($userPasskeys as $key)
                                            <div class="p-3 bg-card flex items-center justify-between text-xs">
                                                <div class="space-y-0.5">
                                                    <div class="font-medium text-foreground flex items-center gap-1.5">
                                                        <svg class="size-3.5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4" />
                                                        </svg>
                                                        {{ $key->name }}
                                                    </div>
                                                    <div class="text-[10px] text-muted-foreground">Ditambahkan {{ $key->created_at?->diffForHumans() }}</div>
                                                </div>
                                                <form method="POST" action="/user/passkeys/{{ $key->id }}" onsubmit="return confirm('Hapus passkey ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-destructive/70 hover:text-destructive text-[11px] font-medium cursor-pointer">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Form Daftarkan Passkey --}}
                            <div class="pt-2 border-t border-border space-y-3">
                                <div>
                                    <h4 class="text-xs font-semibold text-foreground">Daftarkan Passkey Perangkat Ini</h4>
                                    <p class="text-[11px] text-muted-foreground">Daftarkan biometrik (Touch ID, Face ID, Windows Hello, atau YubiKey) pada perangkat ini.</p>
                                </div>

                                <form @submit.prevent="submitRegisterPasskey()" class="p-3.5 rounded-xl bg-muted/30 border border-border/70 space-y-3">
                                    <div class="space-y-1 max-w-sm">
                                        <label class="text-xs font-semibold text-foreground">Nama Perangkat</label>
                                        <input type="text" x-model="registerName" placeholder="Nama perangkat..." class="w-full px-3 py-2 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" required />
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 pt-1">
                                        <div class="text-[11px] text-muted-foreground flex items-center gap-1.5">
                                            <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4"/><path d="M14 13.12c0 2.38 0 6.38-1 8.88"/><path d="M2 12a10 10 0 0 1 18-6"/></svg>
                                            <span>Sensor biometrik perangkat akan langsung dipicu saat tombol ditekan.</span>
                                        </div>

                                        <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !registerName" class="shrink-0 cursor-pointer">
                                            <template x-if="!loading">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                                    <span>Daftarkan Passkey</span>
                                                </span>
                                            </template>
                                            <template x-if="loading">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="animate-spin size-3.5" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                    <span x-text="statusText || 'Memproses...'"></span>
                                                </span>
                                            </template>
                                        </vibe:button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Guest state --}}
                        <div class="space-y-3">
                            <p class="text-xs text-muted-foreground leading-relaxed">
                                Untuk mencoba mendaftarkan Passkey, Anda perlu masuk ke akun terlebih dahulu. Anda dapat masuk menggunakan akun demo berikut:
                            </p>

                            <div class="p-3 rounded-xl bg-muted/50 border border-border flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs">
                                <div>
                                    <span class="text-muted-foreground">Akun Demo: </span>
                                    <code class="font-semibold text-foreground">demo@vibeui.test</code>
                                    <span class="text-muted-foreground"> / Kata Sandi: </span>
                                    <code class="font-semibold text-foreground">password</code>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    @if (Route::has('dev.login.demo'))
                                        <form method="POST" action="{{ route('dev.login.demo') }}">
                                            @csrf
                                            <vibe:button type="submit" variant="primary" size="xs" class="cursor-pointer">
                                                1-Klik Login Demo
                                            </vibe:button>
                                        </form>
                                    @endif
                                    <vibe:button href="/login" variant="outline" size="xs">
                                        Buka Halaman Login
                                    </vibe:button>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </section>

            {{-- 2. Integrasi Kode Javascript Client-Side --}}
            <section id="integrasi-client" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Integrasi Client-Side (@laravel/passkeys)</h2>
                    <p class="text-sm text-muted-foreground">
                        Panggil modul Javascript resmi untuk mendaftarkan dan memverifikasi Passkey:
                    </p>
                </div>

                <vibe:highlightjs language="javascript">
// 1. Pendaftaran Passkey Baru (setelah verifikasi password akun)
async function registerPasskey(name) {
    const response = await window.VibePasskeyService.register(name);
    if (response.success) {
        console.log('Passkey berhasil didaftarkan ke peramban!');
    }
}

// 2. Login dengan Passkey (Passwordless)
async function loginWithPasskey() {
    const response = await window.VibePasskeyService.authenticate();
    if (response.success) {
        window.location.href = '/docs';
    }
}
</vibe:highlightjs>
            </section>

            {{-- 6. Disabling Passkeys Configuration --}}
            <section id="disable-passkey" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-foreground">Menonaktifkan Passkey (WebAuthn)</h2>
                    <p class="text-sm text-muted-foreground leading-relaxed">
                        Jika aplikasi Anda hanya ingin mengandalkan autentikasi klasik (email/kata sandi) dan Two-Factor Authentication (2FA), Vibe UI menyediakan dua cara mudah untuk menonaktifkan Passkey secara menyeluruh.
                    </p>
                </div>

                {{-- Option A: Runtime Environment Toggle --}}
                <div class="space-y-3 p-5 rounded-2xl border border-border bg-card shadow-xs">
                    <div class="flex items-center gap-2">
                        <vibe:badge variant="primary" size="sm" class="rounded-full">Metode 1</vibe:badge>
                        <h3 class="font-semibold text-foreground text-sm">Runtime Feature Flag (.env & Config)</h3>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Cukup ubah variabel <code class="font-mono text-primary font-semibold">PASSKEYS_ENABLED</code> di dalam file <code class="font-mono">.env</code> Anda menjadi <code class="font-mono">false</code>:
                    </p>
                    <vibe:highlightjs language="ini" class="rounded-xl overflow-hidden text-xs">
# Nonaktifkan autentikasi Passkey & WebAuthn secara global
PASSKEYS_ENABLED=false
</vibe:highlightjs>
                    <p class="text-xs text-muted-foreground leading-relaxed pt-1">
                        Secara otomatis sistem akan:
                    </p>
                    <ul class="list-disc list-inside text-xs text-muted-foreground space-y-1 pl-1">
                        <li>Mematikan seluruh endpoint rute WebAuthn (<code class="font-mono">/passkeys/*</code> dan <code class="font-mono">/user/passkeys/*</code>) sehingga mengembalikan <strong>404 Not Found</strong>.</li>
                        <li>Menyembunyikan tombol "Masuk dengan Passkey" dan garis pemisah di halaman Login.</li>
                        <li>Menyembunyikan tombol "Konfirmasi dengan Passkey" di modal konfirmasi kata sandi (sudo mode).</li>
                        <li>Menyembunyikan kartu manajemen dan pendaftaran Passkey di halaman <em>Pengaturan Keamanan</em>.</li>
                        <li>Mencegah pemuatan berkas aset JavaScript <code class="font-mono">passkeys.js</code> ke peramban.</li>
                    </ul>
                </div>

                {{-- Option B: CLI Scaffolding --}}
                <div class="space-y-3 p-5 rounded-2xl border border-border bg-card shadow-xs">
                    <div class="flex items-center gap-2">
                        <vibe:badge variant="secondary" size="sm" class="rounded-full">Metode 2</vibe:badge>
                        <h3 class="font-semibold text-foreground text-sm">CLI Scaffolding Generator (Proyek Baru)</h3>
                    </div>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Saat men-scaffold sistem otentikasi Vibe UI pertama kali, gunakan opsi <code class="font-mono text-primary font-semibold">--without-passkeys</code>:
                    </p>
                    <vibe:highlightjs language="bash" class="rounded-xl overflow-hidden text-xs">
php artisan vibe:auth --without-passkeys
</vibe:highlightjs>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Atau jawab <strong>No</strong> saat prompt interaktif CLI menanyakan: <em>"Do you want to enable Passkey (WebAuthn / Biometric) authentication?"</em>. Generator akan otomatis melewati migrasi passkey, trait pada model User, dan aset skrip passkey.
                    </p>
                </div>
            </section>

            {{-- Navigation Footer --}}
            <div class="pt-8 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('docs.auth.two-factor') }}" class="w-full sm:w-auto inline-flex items-center gap-2 p-3.5 rounded-xl border border-border bg-card hover:border-primary/50 transition-colors group">
                    <svg class="size-4 text-muted-foreground group-hover:text-primary transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    <div>
                        <span class="text-[10px] uppercase font-bold text-muted-foreground tracking-wider block">Sebelumnya</span>
                        <span class="text-xs font-semibold text-foreground group-hover:text-primary transition-colors">Two-Factor Authentication (2FA)</span>
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

        {{-- Table of Contents (TOC) --}}
        <div class="col-span-12 md:col-span-3 order-1 md:order-2 sticky top-6 space-y-4">
            <vibe:toc selector="#docs-content" />
        </div>

    </div>
</x-docs.layouts.sidebar>
