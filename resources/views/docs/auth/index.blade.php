<x-docs.layouts.sidebar>
    <vibe:seo title="Authentication System — Vibe UI" description="Dokumentasi lengkap sistem autentikasi Vibe UI: kredensial fleksibel (email, username, no. hp), rate limiting, viewable password, multi-layout (card, simple, split), dan login biometrik Passkey (WebAuthn)." schema="techarticle" :breadcrumbs="[
        ['name' => 'Home', 'url' => '/'],
        ['name' => 'Docs', 'url' => '/docs'],
        ['name' => 'Starter Kit', 'url' => '/docs/auth'],
        ['name' => 'Authentication', 'url' => '/docs/auth']
    ]" />

    @push('head')
        @vite('resources/js/vibe/passkeys.js')
    @endpush

    <div class="mx-auto w-full max-w-7xl grid grid-cols-12 gap-6 lg:gap-10 items-start">

        {{-- Main Documentation Content --}}
        <div id="docs-content" class="col-span-12 order-2 md:order-1 md:col-span-9 min-w-0 w-full space-y-14">

            {{-- Component Header --}}
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <vibe:badge variant="primary" class="rounded-full">Starter Kit & Auth</vibe:badge>
                    <vibe:badge variant="outline" class="rounded-full">Production Ready</vibe:badge>
                    <vibe:badge variant="secondary" class="rounded-full">WebAuthn / Passkey</vibe:badge>
                    <span class="text-xs text-muted-foreground">Livewire 3 + Tailwind CSS</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-foreground">Authentication System</h1>
                <p class="text-base text-muted-foreground leading-relaxed max-w-3xl">
                    Sistem otentikasi lengkap, aman, dan reaktif yang terinspirasi oleh standar <strong>Flux UI</strong> (Laravel Starter Kit). Dirancang modular dengan dukungan kredensial fleksibel (Email, Username, No. HP), toggle kata sandi viewable, rate limiting, verifikasi password untuk aksi sensitif, 3 pilihan varian layout (Card, Simple, Split), serta autentikasi biometrik modern <strong>Passkey (FIDO2/WebAuthn)</strong>.
                </p>

                {{-- Quick Links / Live Interactive Previews --}}
                <div class="flex flex-wrap items-center gap-2 pt-2">
                    <vibe:button href="/login" variant="primary" size="sm">
                        <svg class="size-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Buka /login (Card)
                    </vibe:button>

                    <vibe:button href="/login?layout=split" variant="outline" size="sm">
                        Buka /login (Split)
                    </vibe:button>

                    <vibe:button href="/login?layout=simple" variant="outline" size="sm">
                        Buka /login (Simple)
                    </vibe:button>

                    <vibe:button href="/register" variant="outline" size="sm">
                        Buka /register
                    </vibe:button>

                    <vibe:button href="/forgot-password" variant="outline" size="sm">
                        Buka /forgot-password
                    </vibe:button>

                    <vibe:button href="/confirm-password" variant="outline" size="sm">
                        Buka /confirm-password
                    </vibe:button>
                </div>
            </div>

            {{-- 1. Scaffolding CLI Command --}}
            <section id="scaffolding-cli" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">1. Scaffolding CLI (vibe:auth)</h2>
                    <p class="text-sm text-muted-foreground">
                        Pasang seluruh komponen Livewire auth, template Blade, migrasi, dan routing ke dalam aplikasi Laravel Anda dengan satu baris perintah interaktif:
                    </p>
                </div>

                <vibe:highlightjs language="bash" code="php artisan vibe:auth" />

                <div class="space-y-2 text-sm text-muted-foreground">
                    <p>Atau jalankan secara non-interaktif dengan menyertakan argumen:</p>
                    <vibe:highlightjs language="bash" code="php artisan vibe:auth --layout=card --login-by=email --force" />
                </div>

                <div class="p-4 rounded-xl bg-muted/40 border border-border space-y-2 text-xs text-muted-foreground">
                    <p class="font-semibold text-foreground">Struktur Berkas yang Dihasilkan:</p>
                    <ul class="list-disc list-inside space-y-1 pl-1 font-mono text-[11px]">
                        <li>app/Livewire/Auth/{Login, Register, ForgotPassword, ResetPassword, VerifyEmail, ConfirmPassword}.php</li>
                        <li>resources/views/auth/{login, register, forgot-password, reset-password, verify-email, confirm-password}.blade.php</li>
                        <li>resources/views/auth/layouts/{card, simple, split}.blade.php</li>
                        <li>routes/auth.php & config/passkeys.php</li>
                    </ul>
                </div>
            </section>

            {{-- 2. Varian Layout Autentikasi --}}
            <section id="varian-layout" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">2. Varian Layout Autentikasi (Multi-Layout)</h2>
                    <p class="text-sm text-muted-foreground">
                        Vibe UI menyediakan 3 pilihan layout responsif yang siap pakai sesuai dengan gaya aplikasi yang Anda bangun:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-1">
                    {{-- Card Layout --}}
                    <div class="p-4 rounded-2xl border border-border bg-card space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-primary">Card Layout</span>
                            <vibe:badge variant="primary" size="xs" class="rounded-full">Default</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Form berada di dalam kartu berbayang (elevated card) terpusat di tengah layar. Ideal untuk dashboard admin, SaaS, dan portal internal perusahaan.
                        </p>
                        <vibe:button href="/login?layout=card" variant="outline" size="xs" class="w-full justify-center">
                            Lihat Demo Card &rarr;
                        </vibe:button>
                    </div>

                    {{-- Simple Layout --}}
                    <div class="p-4 rounded-2xl border border-border bg-card space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-foreground">Simple Layout</span>
                            <vibe:badge variant="outline" size="xs" class="rounded-full">Minimalist</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Tampilan ultra-bersih tanpa bingkai kartu (frameless). Sangat pas untuk aplikasi mobile-first, portal edukasi, atau aplikasi bergaya clean minimalis.
                        </p>
                        <vibe:button href="/login?layout=simple" variant="outline" size="xs" class="w-full justify-center">
                            Lihat Demo Simple &rarr;
                        </vibe:button>
                    </div>

                    {{-- Split Layout --}}
                    <div class="p-4 rounded-2xl border border-border bg-card space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-foreground">Split Screen</span>
                            <vibe:badge variant="secondary" size="xs" class="rounded-full">Modern</vibe:badge>
                        </div>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Tampilan 2 kolom layar penuh. Kolom kiri memuat visual branding, gradient, atau testimonial, sementara kolom kanan memuat form otentikasi interaktif.
                        </p>
                        <vibe:button href="/login?layout=split" variant="outline" size="xs" class="w-full justify-center">
                            Lihat Demo Split &rarr;
                        </vibe:button>
                    </div>
                </div>

                <div class="space-y-2 text-sm text-muted-foreground pt-1">
                    <p>Atur layout default aplikasi di <code class="text-xs bg-muted px-1.5 py-0.5 rounded-md text-foreground font-mono">config/vibe.php</code>, atau ubah dinamis per permintaan via parameter URL <code class="text-xs bg-muted px-1.5 py-0.5 rounded-md text-foreground font-mono">?layout=split</code>:</p>
                    <vibe:highlightjs language="php">
// config/vibe.php
'auth' => [
    'default_layout' => 'card', // Pilihan: 'card', 'simple', 'split'
],
</vibe:highlightjs>
                </div>
            </section>

            {{-- 3. Konfigurasi Kredensial Login Fleksibel --}}
            <section id="login-kredensial" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">3. Kustomisasi Metode Login (Flexible Credentials)</h2>
                    <p class="text-sm text-muted-foreground">
                        Sistem otentikasi Vibe UI dirancang modular. Pengguna dapat login menggunakan alamat email, nama pengguna (username), nomor telepon, atau kombinasi ketiganya:
                    </p>
                </div>

                <vibe:highlightjs language="php">
// config/vibe.php
'auth' => [
    /*
    | Kredensial Login yang Diizinkan (Array):
    | - ['email']                      : Login hanya menggunakan email (Standar)
    | - ['email', 'username']          : Login menggunakan email atau username
    | - ['email', 'username', 'phone'] : Login menggunakan email, username, atau no. HP
    | - ['username']                   : Login khusus username
    | - ['phone']                      : Login khusus nomor handphone
    */
    'login_by' => ['email', 'username'],

    /*
    | Pengalihan Setelah Login / Registrasi Berhasil:
    */
    'redirect_after_login' => '/docs',
],
</vibe:highlightjs>

                <vibe:alert variant="info" class="text-xs">
                    Komponen Livewire <code>Login.php</code> secara otomatis menguji format input pengguna saat submit: jika berformat alamat email divalidasi via kolom <code>email</code>, jika berupa nomor telepon divalidasi via kolom <code>phone</code>, dan jika berupa teks biasa divalidasi via <code>username</code>. Label dan teks bantuan form otomatis menyesuaikan opsi yang aktif.
                </vibe:alert>
            </section>

            {{-- 4. Fitur Viewable Password Toggle --}}
            <section id="password-toggle" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">4. Viewable Password Toggle (&lt;vibe:input viewable&gt;)</h2>
                    <p class="text-sm text-muted-foreground">
                        Identik dengan komponen <code class="text-xs font-mono bg-muted px-1 py-0.5 rounded">&lt;flux:input type="password" viewable&gt;</code>, Vibe UI menyertakan atribut <code class="text-xs font-mono bg-muted px-1 py-0.5 rounded">viewable</code> yang menambahkan toggle mata (tampilkan/sembunyikan kata sandi) secara instan tanpa JavaScript manual:
                    </p>
                </div>

                <vibe:preview title="Toggle Password Interaktif">
                    <div class="max-w-sm w-full">
                        <vibe:input label="Kata Sandi" type="password" viewable placeholder="Masukkan kata sandi akun..." />
                    </div>
                    <x-slot:code>
&lt;vibe:input
    label="Kata Sandi"
    type="password"
    viewable
    placeholder="Masukkan kata sandi akun..."
/&gt;
                    </x-slot:code>
                </vibe:preview>
            </section>

            {{-- 5. Komponen Pemisah (<vibe:separator>) --}}
            <section id="separator-component" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">5. Komponen Pemisah Form (&lt;vibe:separator&gt;)</h2>
                    <p class="text-sm text-muted-foreground">
                        Garis pemisah horizontal atau vertikal dengan teks label di tengah untuk membedakan opsi autentikasi alternatif (seperti login OAuth sosial atau Passkey):
                    </p>
                </div>

                <vibe:preview title="Pemisah Horizontal dengan Teks Label">
                    <div class="w-full max-w-sm space-y-3">
                        <vibe:button variant="outline" class="w-full justify-center">
                            <svg class="size-4 mr-2" viewBox="0 0 24 24"><path fill="currentColor" d="M12.545 10.239v3.821h5.445c-.712 2.315-2.647 3.972-5.445 3.972a6.033 6.033 0 1 1 0-12.064c1.498 0 2.866.549 3.921 1.453l2.814-2.814A9.97 9.97 0 0 0 12.545 2C7.021 2 2.543 6.477 2.543 12s4.478 10 10.002 10c8.396 0 10.249-7.85 9.426-11.761h-9.426Z"/></svg>
                            Masuk dengan Google
                        </vibe:button>
                        <vibe:separator text="atau masuk dengan kredensial" />
                        <vibe:input label="Email" type="email" placeholder="nama@domain.com" />
                    </div>
                    <x-slot:code>
&lt;vibe:button variant="outline" class="w-full justify-center"&gt;
    Masuk dengan Google
&lt;/vibe:button&gt;

&lt;vibe:separator text="atau masuk dengan kredensial" /&gt;

&lt;vibe:input label="Email" type="email" placeholder="nama@domain.com" /&gt;
                    </x-slot:code>
                </vibe:preview>
            </section>

            {{-- 6. Login & Registrasi Passkey (WebAuthn / FIDO2) --}}
            <section id="login-passkey" class="space-y-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-foreground">6. Autentikasi Biometrik Passkey (WebAuthn / FIDO2)</h2>
                        <vibe:badge variant="primary" size="sm" class="rounded-full">Passwordless</vibe:badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        Otentikasi biometrik modern menggunakan sidik jari (Touch ID), pemindai wajah (Face ID / Windows Hello), atau kunci keamanan fisik (YubiKey) berbasis paket resmi <strong>laravel/passkeys</strong> dan <strong>@laravel/passkeys</strong>.
                    </p>
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
                        <li><strong>Wajib Menggunakan Nama Domain:</strong> Browser melarang WebAuthn dijalankan pada IP mentah seperti <code>http://127.0.0.1:8000</code>. Akses selalu melalui <code>http://localhost:8000</code> atau <code>localhost:8001</code>.</li>
                        <li><strong>Verifikasi Kata Sandi Sebelum Pendaftaran:</strong> Untuk mencegah pendaftaran perangkat tanpa izin pada sesi yang tertinggal, pengguna <strong>wajib memasukkan kata sandi akun terlebih dahulu</strong>. Setelah kata sandi divalidasi, barulah browser meminta otorisasi biometrik.</li>
                        <li><strong>Enkripsi Kunci Asimetris:</strong> Kunci privat disimpan aman di Secure Enclave perangkat dan tidak pernah dikirim ke server. Server hanya menyimpan kunci publik untuk memvalidasi tanda tangan kriptografis saat login.</li>
                    </ul>
                </div>

                {{-- Interactive Passkey Test Console (Dengan Wajib Password Terlebih Dahulu) --}}
                <div class="p-5 rounded-2xl border border-border bg-card space-y-5 shadow-xs" x-data="{
                    supported: false,
                    isIpAddress: typeof window !== 'undefined' && (window.location.hostname === '127.0.0.1' || window.location.hostname === '::1'),
                    localhostUrl: typeof window !== 'undefined' ? window.location.href.replace('127.0.0.1', 'localhost') : '',
                    registerName: 'Perangkat Saya (' + (navigator.userAgent.includes('Mac') ? 'Mac Touch ID' : (navigator.userAgent.includes('Windows') ? 'Windows Hello' : 'Biometrik')) + ')',
                    accountPassword: '',
                    showPassword: false,
                    loading: false,
                    statusText: '',
                    feedbackMessage: null,
                    feedbackType: 'info',
                    init() {
                        this.supported = !!(window.PublicKeyCredential && (window.VibePasskeyService?.isSupported() ?? true));
                    },
                    async submitRegisterPasskey() {
                        if (!this.accountPassword) {
                            this.feedbackType = 'error';
                            this.feedbackMessage = 'Harap masukkan kata sandi akun Anda terlebih dahulu untuk verifikasi keamanan.';
                            return;
                        }

                        this.loading = true;
                        this.statusText = 'Memverifikasi kata sandi akun...';
                        this.feedbackMessage = null;

                        try {
                            // 1. Verifikasi kata sandi terlebih dahulu via POST /confirm-password
                            const csrfToken = document.querySelector('meta[name=&quot;csrf-token&quot;]')?.getAttribute('content') || '{{ csrf_token() }}';
                            const verifyRes = await fetch('/confirm-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({ password: this.accountPassword }),
                            });

                            if (!verifyRes.ok && verifyRes.status !== 204 && !verifyRes.redirected) {
                                const data = await verifyRes.json().catch(() => ({}));
                                this.feedbackType = 'error';
                                this.feedbackMessage = data?.errors?.password?.[0] || data?.message || 'Kata sandi salah. Silakan coba lagi.';
                                this.loading = false;
                                return;
                            }

                            // 2. Jika kata sandi valid, lanjutkan registrasi biometrik WebAuthn
                            this.statusText = 'Menyiapkan sensor biometrik perangkat...';
                            if (!window.VibePasskeyService) {
                                throw new Error('Modul Passkey belum dimuat.');
                            }

                            const regRes = await window.VibePasskeyService.register(this.registerName || 'Perangkat Saya');
                            if (regRes.success) {
                                this.feedbackType = 'success';
                                this.feedbackMessage = 'Passkey berhasil didaftarkan! Silakan coba logout dan masuk menggunakan tombol Masuk dengan Passkey.';
                                this.accountPassword = '';
                                setTimeout(() => window.location.reload(), 2000);
                            } else {
                                this.feedbackType = 'error';
                                this.feedbackMessage = regRes.message || 'Pendaftaran passkey dibatalkan oleh pengguna.';
                            }
                        } catch (err) {
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
                                <h3 class="text-sm font-semibold text-foreground">Uji Coba Langsung Passkey (WebAuthn)</h3>
                                <p class="text-xs text-muted-foreground">Tes alur verifikasi kata sandi + registrasi biometrik dari browser Anda</p>
                            </div>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium" :class="supported ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-destructive/10 text-destructive'">
                            <span class="size-1.5 rounded-full" :class="supported ? 'bg-emerald-500' : 'bg-destructive'"></span>
                            <span x-text="supported ? 'Browser Didukung' : 'Tidak Didukung'"></span>
                        </span>
                    </div>

                    {{-- Warning if user is currently on 127.0.0.1 --}}
                    <template x-if="isIpAddress">
                        <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-700 dark:text-amber-300 flex items-center justify-between gap-3">
                            <span class="leading-relaxed">Anda sedang mengakses via <strong>127.0.0.1</strong>. Buka via <strong>localhost</strong> agar WebAuthn dapat berjalan normal.</span>
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
                                    <p class="text-xs text-muted-foreground italic">Belum ada passkey yang terdaftar di akun ini. Masukkan kata sandi di bawah untuk mendaftarkan perangkat Anda.</p>
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

                            {{-- Form Daftarkan Passkey (Wajib Kata Sandi Terlebih Dahulu) --}}
                            <div class="pt-2 border-t border-border space-y-3">
                                <div>
                                    <h4 class="text-xs font-semibold text-foreground">Daftarkan Passkey Perangkat Ini</h4>
                                    <p class="text-[11px] text-muted-foreground">Masukkan kata sandi akun Anda terlebih dahulu untuk verifikasi keamanan.</p>
                                </div>

                                <form @submit.prevent="submitRegisterPasskey()" class="p-3.5 rounded-xl bg-muted/30 border border-border/70 space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div class="space-y-1">
                                            <label class="text-xs font-semibold text-foreground">Nama Perangkat</label>
                                            <input type="text" x-model="registerName" placeholder="Nama perangkat (misal: Touch ID MacBook)" class="w-full px-3 py-2 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" required />
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-xs font-semibold text-foreground flex items-center justify-between">
                                                <span>Kata Sandi Akun</span>
                                                <span class="text-[10px] text-muted-foreground font-normal">Wajib verifikasi</span>
                                            </label>
                                            <div class="relative">
                                                <input :type="showPassword ? 'text' : 'password'" x-model="accountPassword" placeholder="Masukkan kata sandi akun..." autocomplete="current-password" class="w-full px-3 py-2 pr-9 text-xs rounded-lg border border-input bg-background text-foreground shadow-2xs focus:ring-1 focus:ring-primary focus:outline-none" required />
                                                <button type="button" @click="showPassword = !showPassword" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground cursor-pointer" tabindex="-1">
                                                    <svg x-show="!showPassword" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                    <svg x-show="showPassword" x-cloak class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 pt-1">
                                        <div class="text-[11px] text-muted-foreground flex items-center gap-1.5">
                                            <svg class="size-3.5 text-primary shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            <span>Kata sandi divalidasi via <code>/confirm-password</code> sebelum pendaftaran biometrik.</span>
                                        </div>

                                        <vibe:button type="submit" variant="primary" size="sm" ::disabled="loading || !accountPassword" class="shrink-0 cursor-pointer">
                                            <template x-if="!loading">
                                                <span class="inline-flex items-center gap-1.5">
                                                    <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                                    <span>Konfirmasi & Daftarkan Passkey</span>
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
                        {{-- Guest state: prompt login or 1-click test login --}}
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

                {{-- Client-Side Integration Code --}}
                <div class="space-y-3 text-sm text-muted-foreground pt-2">
                    <p class="font-semibold text-foreground">Integrasi Client-Side (@laravel/passkeys):</p>
                    <vibe:highlightjs language="javascript">
// 1. Pendaftaran Passkey Baru (dengan verifikasi kata sandi akun terlebih dahulu)
async function registerNewPasskey(deviceName, accountPassword) {
    // Verifikasi kata sandi akun terlebih dahulu
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const verifyRes = await fetch('/confirm-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ password: accountPassword }),
    });

    if (!verifyRes.ok) {
        throw new Error('Kata sandi salah. Silakan coba lagi.');
    }

    // Setelah kata sandi terverifikasi, picu prompt WebAuthn browser
    const response = await Passkeys.register({ name: deviceName });
    return response;
}

// 2. Login dengan Passkey (Passwordless)
async function loginWithPasskey() {
    const response = await Passkeys.verify();
    window.location.href = '/docs';
}
</vibe:highlightjs>
                </div>
            </section>

            {{-- 7. Password Confirmation Modal & Flow --}}
            <section id="password-confirm" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">7. Konfirmasi Kata Sandi (Password Confirmation)</h2>
                    <p class="text-sm text-muted-foreground">
                        Laravel menyediakan middleware <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">password.confirm</code> untuk mengamankan tindakan sensitif (seperti pendaftaran Passkey, perubahan kata sandi, atau penghapusan data).
                    </p>
                </div>

                <div class="space-y-3 text-sm text-muted-foreground">
                    <p>Endpoint <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">POST /confirm-password</code> di <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">routes/auth.php</code> otomatis mengembalikan respon JSON <code>204 No Content</code> jika request menyertakan header <code>Accept: application/json</code>, atau melakukan redirect jika dikirim via form biasa:</p>

                    <vibe:highlightjs language="php">
// routes/auth.php
Route::middleware('auth')->group(function () {
    Route::get('/confirm-password', ConfirmPassword::class)->name('password.confirm');

    Route::post('/confirm-password', function (Request $request) {
        $request->validate(['password' => ['required', 'string']]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()?->email,
            'password' => $request->password,
        ])) {
            return response()->json([
                'errors' => ['password' => [__('auth.password')]],
            ], 422);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        if ($request->expectsJson()) {
            return response()->noContent();
        }

        return redirect()->intended('/');
    })->name('password.confirm.post');
});
</vibe:highlightjs>
                </div>
            </section>

            {{-- 8. Reset Kata Sandi & Verifikasi Email --}}
            <section id="reset-dan-verifikasi" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">8. Alur Reset Kata Sandi & Verifikasi Email</h2>
                    <p class="text-sm text-muted-foreground">
                        Seluruh alur pemulihan akun dan verifikasi email menggunakan Livewire 3 dengan umpan balik real-time tanpa refresh halaman:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl border border-border bg-card space-y-2">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <svg class="size-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <span>Lupa Kata Sandi (/forgot-password)</span>
                        </h3>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Pengguna memasukkan email akun, sistem memvalidasi eksistensi user dan mengirimkan email berisi tautan token yang ditandatangani secara kriptografis (signed token).
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl border border-border bg-card space-y-2">
                        <h3 class="text-sm font-semibold text-foreground flex items-center gap-2">
                            <svg class="size-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                            <span>Verifikasi Email (/verify-email)</span>
                        </h3>
                        <p class="text-xs text-muted-foreground leading-relaxed">
                            Dilindungi middleware <code>verified</code>. Menampilkan pemberitahuan bahwa email aktivasi telah dikirimkan, lengkap dengan tombol kirim ulang instan via AJAX Livewire.
                        </p>
                    </div>
                </div>
            </section>

            {{-- 9. Keamanan & Rate Limiting --}}
            <section id="keamanan-sistem" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">9. Proteksi Keamanan & Session Management</h2>
                    <p class="text-sm text-muted-foreground">
                        Penerapan praktik keamanan terbaik (security best practices) bawaan:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs text-muted-foreground">
                    <div class="p-3.5 rounded-xl bg-muted/40 border border-border space-y-1.5">
                        <div class="font-semibold text-foreground flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-emerald-500"></span>
                            Rate Limiting & Throttling
                        </div>
                        <p>Pembatasan percobaan login (maksimal 5 kali percobaan gagal sebelum cooldown) untuk menangkal serangan brute-force.</p>
                    </div>

                    <div class="p-3.5 rounded-xl bg-muted/40 border border-border space-y-1.5">
                        <div class="font-semibold text-foreground flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-emerald-500"></span>
                            Session Fixation Protection
                        </div>
                        <p>ID sesi di-regenerasi secara otomatis (<code>$request->session()->regenerate()</code>) setiap kali otentikasi berhasil.</p>
                    </div>

                    <div class="p-3.5 rounded-xl bg-muted/40 border border-border space-y-1.5">
                        <div class="font-semibold text-foreground flex items-center gap-1.5">
                            <span class="size-2 rounded-full bg-emerald-500"></span>
                            CSRF Token Binding
                        </div>
                        <p>Setiap interaksi formulir dan panggilan AJAX WebAuthn diverifikasi menggunakan token CSRF Laravel yang valid.</p>
                    </div>
                </div>
            </section>

            {{-- 10. Daftar Endpoint & Rute Bawaan --}}
            <section id="daftar-rute" class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-foreground">10. Daftar Endpoint & Rute Bawaan</h2>
                    <p class="text-sm text-muted-foreground">
                        Seluruh rute telah dikonfigurasi di <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">routes/auth.php</code> dan paket <code class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded">laravel/passkeys</code>:
                    </p>
                </div>

                <vibe:table>
                    <vibe:table.header>
                        <vibe:table.column>HTTP Method</vibe:table.column>
                        <vibe:table.column>URI</vibe:table.column>
                        <vibe:table.column>Handler / Paket</vibe:table.column>
                        <vibe:table.column>Keterangan</vibe:table.column>
                    </vibe:table.header>
                    <vibe:table.rows>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/login</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\Login</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Halaman login (Kredensial Fleksibel & Passkey)</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/passkeys/login/options</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">WebAuthn challenge untuk login biometrik</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/passkeys/login</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Verifikasi assertion & autentikasi passkey</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/confirm-password</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\ConfirmPassword</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Halaman konfirmasi kata sandi untuk aksi sensitif</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/confirm-password</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">routes/auth.php</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Validasi kata sandi (mengembalikan JSON 204 atau redirect)</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/user/passkeys/options</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Pendaftaran passkey perangkat baru (password.confirm)</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/user/passkeys</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Simpan kredensial passkey baru yang terverifikasi</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-rose-600">DELETE</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/user/passkeys/{passkey}</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">laravel/passkeys</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Hapus passkey yang tersimpan di akun</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/register</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\Register</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Pendaftaran akun pengguna baru</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/forgot-password</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\ForgotPassword</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Permintaan tautan reset kata sandi</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/reset-password/{token}</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\ResetPassword</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Form eksekusi reset kata sandi baru</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-emerald-600">GET</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/verify-email</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">App\Livewire\Auth\VerifyEmail</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Pemberitahuan verifikasi email akun</vibe:table.cell>
                        </vibe:table.row>
                        <vibe:table.row>
                            <vibe:table.cell class="font-mono font-bold text-amber-600">POST</vibe:table.cell>
                            <vibe:table.cell class="font-mono font-medium text-foreground">/logout</vibe:table.cell>
                            <vibe:table.cell class="font-mono text-xs text-muted-foreground">Session Invalidate & Regenerate</vibe:table.cell>
                            <vibe:table.cell class="text-muted-foreground">Keluar dari sesi akun & invalidasi token</vibe:table.cell>
                        </vibe:table.row>
                    </vibe:table.rows>
                </vibe:table>
            </section>

        </div>

        {{-- Table of Contents Sidebar (Right Side) --}}
        <aside class="col-span-12 order-1 md:order-2 md:col-span-3 w-full md:sticky md:top-6 group-has-[header.sticky]/docs:md:top-20">
            <vibe:toc selector="#docs-content" />
        </aside>

    </div>
</x-docs.layouts.sidebar>
